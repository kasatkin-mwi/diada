<?php
use Bitrix\Main,
	Bitrix\Main\Loader,
	Bitrix\Main\Config\Option,
	Bitrix\Main\Web\Json,
	Bitrix\Main\Localization\Loc,
	Bitrix\Sale,
	Bitrix\Sale\Order,
	Bitrix\Sale\PersonType,
	Bitrix\Sale\Shipment,
	Bitrix\Sale\PaySystem,
	Bitrix\Sale\Payment,
	Bitrix\Sale\Delivery,
	Bitrix\Sale\Location\LocationTable,
	Bitrix\Sale\Result,
	Bitrix\Sale\DiscountCouponsManager,
    Bitrix\Sale\Location\GeoIp,
	Bitrix\Sale\Services\Company; 
use Bitrix\Main\Service\GeoIp\SypexGeo;

if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();
CBitrixComponent::includeComponentClass("bitrix:sale.order.ajax");
/**
 * @var $APPLICATION CMain
 * @var $USER CUser
 */

Loc::loadMessages(__FILE__);

if (!Loader::includeModule("sale"))
{
	ShowError(Loc::getMessage("SOA_MODULE_NOT_INSTALL"));
	return;
}

class SaleOrderAjaxSalavey extends SaleOrderAjax
{
	protected $UserEmailEmpty;
    protected function autoRegisterUser()
    {
        $getEmail = $this->request->get('save') == 'Y';
        $personType = $this->request->get('PERSON_TYPE');
        if ($personType <= 0)
        {
            $personTypes = PersonType::load($this->getSiteId());
            foreach ($personTypes as $type)
            {
                $personType = $type['ID'];
                break;
            }

            unset($personTypes, $type);
        }

        $userProps = Sale\PropertyValue::getMeaningfulValues($personType, $this->getPropertyValuesFromRequest());
        $userId = false;
        $saveToSession = false;
		
		$rand = randString(7, array(
		  "abcdefghijklnmopqrstuvwxyz",
		  "ABCDEFGHIJKLNMOPQRSTUVWXYZ",
		));

        if ($this->UserEmailEmpty == "" && $getEmail){
            $this->UserEmailEmpty = $rand."@diada-email.ru";
        }
        if (strlen($userProps['EMAIL']) == ""){
            $userProps['EMAIL'] = $this->UserEmailEmpty;
        }
        $this->arUserResult["USER_EMAIL"] = $userProps['EMAIL'];
        

        if (
            $this->arParams['ALLOW_APPEND_ORDER'] === 'Y'
            && Option::get('main', 'new_user_email_uniq_check', '') === 'Y'
            && (($userProps['EMAIL'] != '' && !preg_match("/^auto_(\d+)@diada-email.ru/",$this->arUserResult["USER_EMAIL"])) || $userProps['PHONE'] != '')
        )
        {
            $existingUserId = 0;
			if ( !$userProps['EMAIL'] ){
				$userProps['EMAIL'] = $rand."@diada-email.ru";
			}
			

            if ($userProps['EMAIL'] != '' && !preg_match("/^auto_(\d+)@diada-email.ru/",$this->arUserResult["USER_EMAIL"]))
            {
                $res = Bitrix\Main\UserTable::getRow(array(
                    'filter' => array(
                        '=ACTIVE' => 'Y',
                        '=EMAIL' => $userProps['EMAIL']
                    ),
                    'select' => array('ID')
                ));
                if (isset($res['ID']))
                {
                    $existingUserId = (int)$res['ID'];
                }
            }

            if ($existingUserId == 0 && !empty($userProps['PHONE']))
            {
                $normalizedPhone = $this->getNormalizedPhone($userProps['PHONE']);
                $normalizedPhoneForRegistration = $this->getNormalizedPhoneForRegistration($userProps['PHONE']);

                if (!empty($normalizedPhone))
                {
                    $res = Bitrix\Main\UserTable::getRow(array(
                        'filter' => array(
                            'ACTIVE' => 'Y',
                            array(
                                'LOGIC' => 'OR',
                                '=PHONE_AUTH.PHONE_NUMBER' => $normalizedPhoneForRegistration,
                                '=PERSONAL_PHONE' => $normalizedPhone,
                                '=PERSONAL_MOBILE' => $normalizedPhone
                            )
                        ),
                        'select' => array('ID')
                    ));
                    if (isset($res['ID']))
                    {
                        $existingUserId = (int)$res['ID'];
                    }
                }
            }

            if ($existingUserId > 0)
            {
                $userId = $existingUserId;
                $saveToSession = true;

                if ($this->arParams['IS_LANDING_SHOP'] === 'Y')
                {
                    CUser::AppendUserGroup($userId, \Bitrix\Crm\Order\BuyerGroup::getDefaultGroups());
                }
            }
            else
            {
				
                $userId = $this->registerAndLogIn($userProps);
            }
        }
        elseif ($userProps['EMAIL'] != '' || Option::get('main', 'new_user_email_required', '') === 'N')
        {
			
            $userId = $this->registerAndLogIn($userProps);
        }
        else
        {
			
            $this->addError(Loc::getMessage('STOF_ERROR_EMAIL'), self::AUTH_BLOCK);
        }

        return array($userId, $saveToSession);
    }
    /**
     * Returns user property value from CUser
     *
     * @param    $property
     * @return    string
     */
    protected function getValueFromCUser($property)
    {
        global $USER;

        $value = '';

        if ($property['IS_EMAIL'] === 'Y')
        {
            $value = $USER->GetEmail();
        }
        elseif ($property['IS_PAYER'] === 'Y')
        {
            $rsUser = CUser::GetByID($USER->GetID());
            if ($arUser = $rsUser->Fetch())
            {
                $value = CUser::FormatName(
                    CSite::GetNameFormat(false),
                    array(
                        'NAME' => $arUser['NAME'],
                        'LAST_NAME' => $arUser['LAST_NAME'],
                        'SECOND_NAME' => $arUser['SECOND_NAME']
                    ),
                    false,
                    false
                );
            }
        }
        elseif ($property['IS_PHONE'] === 'Y')
        {
            $phoneRow = \Bitrix\Main\UserPhoneAuthTable::getRow([
                'select' => ['PHONE_NUMBER'],
                'filter' => ['=USER_ID' => $USER->GetID()],
            ]);

            if ($phoneRow)
            {
                $value = $phoneRow['PHONE_NUMBER'];
            }
            else
            {
                $rsUser = CUser::GetByID($USER->GetID());

                if ($arUser = $rsUser->Fetch())
                {
                    if (!empty($arUser['PERSONAL_PHONE']))
                    {
                        $value = $arUser['PERSONAL_PHONE'];
                    }
                    elseif (!empty($arUser['PERSONAL_MOBILE']))
                    {
                        $value = $arUser['PERSONAL_MOBILE'];
                    }
                }
            }
        }
        elseif ($property['IS_ADDRESS'] === 'Y')
        {
            $rsUser = CUser::GetByID($USER->GetID());
            if ($arUser = $rsUser->Fetch())
            {
                if (!empty($arUser['PERSONAL_STREET']))
                {
                    $value = $arUser['PERSONAL_STREET'];
                }
            }
        }
        elseif(
            $property['CODE'] == "ORG_NAME"
            ||
            $property['CODE'] == "ORG_TYPE"
            ||
            $property['CODE'] == "CONTACT_PERSON"
            ||
            $property['CODE'] == "COMPANY_ADDRESS"
            ||
            $property['CODE'] == "BANK"
            ||
            $property['CODE'] == "CHECKING_ACCOUNT"
            ||
            $property['CODE'] == "KR_BILL"
            ||
            $property['CODE'] == "INN"
            ||
            $property['CODE'] == "KPP"
            ||
            $property['CODE'] == "BANK_BIK"
            ||
            $property['CODE'] == "OKDP"
            ||
            $property['CODE'] == "OKPO"
            ||
            $property['CODE'] == "OKONX_OKVED"
        )
        {
            $rsUser = CUser::GetList(
                ($by="id"), 
                ($order="desc"), 
                array("ID" => $USER->GetID()), 
                array(
                    "SELECT" => array("UF_*")
                )
            );
            if ($arUser = $rsUser->Fetch())
            {
                if($property["CODE"] == "ORG_NAME" && !empty($arUser["UF_NAME"]))
                {  
                    $value = $arUser["UF_NAME"];        
                }
                if($property["CODE"] == "ORG_TYPE" && !empty($arUser["UF_TYPE"]))
                {  
                    $value = $arUser["UF_TYPE"];        
                }
                if($property["CODE"] == "CONTACT_PERSON" && !empty($arUser["UF_CONTACT"]))
                {  
                    $value = $arUser["UF_CONTACT"];        
                }
                if($property["CODE"] == "COMPANY_ADDRESS" && !empty($arUser["UF_YUR_ADDRESS"]))
                {  
                    $value = $arUser["UF_YUR_ADDRESS"];        
                }
                if($property["CODE"] == "BANK" && !empty($arUser["UF_BANK"]))
                {  
                    $value = $arUser["UF_BANK"];        
                }
                if($property["CODE"] == "CHECKING_ACCOUNT" && !empty($arUser["UF_SCHET"]))
                {  
                    $value = $arUser["UF_SCHET"];        
                }
                if($property["CODE"] == "KR_BILL" && !empty($arUser["UF_KORSCHET"]))
                {  
                    $value = $arUser["UF_KORSCHET"];        
                }
                if($property["CODE"] == "INN" && !empty($arUser["UF_INN"]))
                {  
                    $value = $arUser["UF_INN"];        
                }
                if($property["CODE"] == "KPP" && !empty($arUser["UF_KPP"]))
                {  
                    $value = $arUser["UF_KPP"];        
                }
                if($property["CODE"] == "BANK_BIK" && !empty($arUser["UF_BIK"]))
                {  
                    $value = $arUser["UF_BIK"];        
                }
                if($property["CODE"] == "OKDP" && !empty($arUser["UF_OKDP"]))
                {  
                    $value = $arUser["UF_OKDP"];        
                }
                if($property["CODE"] == "OKPO" && !empty($arUser["UF_OKPO"]))
                {  
                    $value = $arUser["UF_OKPO"];        
                } 
                if($property["CODE"] == "OKONX_OKVED" && !empty($arUser["UF_OKVED"]))
                {  
                    $value = $arUser["UF_OKVED"];        
                }    
            }    
        }

        return $value;
    }
	/*protected function initProperties(Order $order, $isPersonTypeChanged)
	{
		$arResult =& $this->arResult;
		$profileProperties = array();
		$orderProperties = $this->getPropertyValuesFromRequest();

		$this->initUserProfiles($order, $isPersonTypeChanged);
        $getEmail = $this->request->get('save') == 'Y';
		$firstLoad = $this->request->getRequestMethod() === 'GET';
		$isProfileChanged = $this->arUserResult['PROFILE_CHANGE'] === 'Y';

		$loadFromProfile = $firstLoad || $isProfileChanged || $isPersonTypeChanged;
		$justAuthorized = $this->request->get('do_authorize') === 'Y' || $this->request->get('do_register') === 'Y';
		$haveProfileId = intval($this->arUserResult['PROFILE_ID']) > 0;

		$useProfileProperties = ($loadFromProfile || $justAuthorized) && $haveProfileId;
		if ($useProfileProperties)
		{
			$profileProperties = Sale\OrderUserProperties::getProfileValues((int)($this->arUserResult['PROFILE_ID']));
		}

		$ipAddress = '';

		if($this->arParams['SPOT_LOCATION_BY_GEOIP'] === 'Y')
			$ipAddress = \Bitrix\Main\Service\GeoIp\Manager::getRealIp();

		$propertyCollection = $order->getPropertyCollection();
		
        /** @var Sale\PropertyValue $property *//*
		foreach ($propertyCollection as $property)
		{
			if ($property->isUtil())
				continue;

			$arProperty = $property->getProperty();
            
			if ($arProperty['USER_PROPS'] === 'Y')
			{
				if ($isProfileChanged && !$haveProfileId)
				{
					$curVal = '';
				}
				elseif ($useProfileProperties)
				{
					$curVal = $profileProperties[$arProperty['ID']];
				}
				elseif (isset($orderProperties[$arProperty['ID']]))
				{
					$curVal = $orderProperties[$arProperty['ID']];
				}
				else
				{
					$curVal = '';
				}
			}
			else
			{
				$curVal = $orderProperties[$arProperty['ID']];
			}
            
			if ($arResult['HAVE_PREPAYMENT'] && !empty($arResult['PREPAY_ORDER_PROPS'][$arProperty['CODE']]))
			{
				if ($arProperty['TYPE'] === 'LOCATION')
				{
					$cityName = ToUpper($arResult['PREPAY_ORDER_PROPS'][$arProperty['CODE']]);
					$arLocation = LocationTable::getList(array(
						'select' => array('CODE'),
						'filter' => array('NAME.NAME_UPPER' => $cityName),
					))->fetch();
					if (!empty($arLocation))
					{
						$curVal = $arLocation['CODE'];
					}
				}
				else
				{
					$curVal = $arResult['PREPAY_ORDER_PROPS'][$arProperty['CODE']];
				}
			}

			if ($arProperty['TYPE'] == 'LOCATION' && empty($curVal) && strlen($ipAddress) > 0)
			{
				$locCode = GeoIp::getLocationCode($ipAddress, LANGUAGE_ID);

				if(strlen($locCode) > 0)
					$curVal = $locCode;
			}
			elseif ($arProperty['IS_ZIP'] == 'Y' && empty($curVal) && strlen($ipAddress) > 0)
			{
				$zip = GeoIp::getZipCode($ipAddress);

				if(strlen($zip) > 0)
					$curVal = $zip;
			}
            
			if (empty($curVal))
			{
				// getting default value for all properties except LOCATION (LOCATION - only for first load or person type change)
				if (
					$arProperty['TYPE'] !== 'LOCATION'
					|| (
						$arProperty['TYPE'] === 'LOCATION'
						&& ($firstLoad || $isPersonTypeChanged)
					)
				)
				{
					if (!empty($arProperty['DEFAULT_VALUE']))
					{
						$curVal = $arProperty['DEFAULT_VALUE'];
					}
					elseif ($loadFromProfile || $justAuthorized)
					{
						$curVal = $this->getValueFromCUser($arProperty);
					}
				}
			}
            
			if ($arProperty['TYPE'] === 'LOCATION')
			{
				if ((!$loadFromProfile || $this->request->get('PROFILE_ID') === '0')
					&& $this->request->get('location_type') != 'code'
				)
				{
					$curVal = CSaleLocation::getLocationCODEbyID($curVal);
				}
			}
            
			$this->arUserResult['ORDER_PROP'][$arProperty['ID']] = $curVal;
		}

		$this->checkZipProperty($order, $useProfileProperties);
		$this->checkAltLocationProperty($order, $useProfileProperties, $profileProperties);
        
		foreach (GetModuleEvents('sale', 'OnSaleComponentOrderProperties', true) as $arEvent)
			ExecuteModuleEventEx($arEvent, array(&$this->arUserResult, $this->request, &$this->arParams, &$this->arResult));
		if ($this->UserEmailEmpty == "" && $getEmail){
			$this->UserEmailEmpty = "auto_".time()."@diada-email.ru";
		}
		if (!$this->arUserResult['ORDER_PROP'][6]){
			$this->arUserResult['ORDER_PROP'][6]=$this->UserEmailEmpty;
		}
		if ($this->isOrderConfirmed)
		{
			$res = $propertyCollection->checkErrors(array('PROPERTIES' => $this->arUserResult['ORDER_PROP']), array(), true);
			file_put_contents($_SERVER["DOCUMENT_ROOT"]."/upload/data_order_log.txt",print_r($this->arUserResult['ORDER_PROP'],true));
			if (!$res->isSuccess())
			{
				$this->addError($res, self::PROPERTY_BLOCK);
			}
		}
		$res = $propertyCollection->setValuesFromPost(array('PROPERTIES' => $this->arUserResult['ORDER_PROP']), array());
		if ($this->isOrderConfirmed && !$res->isSuccess())
		{
			$this->addError($res, self::PROPERTY_BLOCK);
		}
	}*/
    protected function initProperties(Order $order, $isPersonTypeChanged)
    {
        $arResult =& $this->arResult;
        $orderProperties = $this->getPropertyValuesFromRequest();
        $orderProperties = $this->addLastLocationPropertyValues($orderProperties);

        $this->initUserProfiles($order, $isPersonTypeChanged);
        
        $getEmail = $this->request->get('save') == 'Y';
        $firstLoad = $this->request->getRequestMethod() === 'GET';
        $justAuthorized = $this->request->get('do_authorize') === 'Y'
            || $this->request->get('do_register') === 'Y'
            || $this->request->get('SMS_CODE');

        $isProfileChanged = $this->arUserResult['PROFILE_CHANGE'] === 'Y';
        $haveProfileId = (int)$this->arUserResult['PROFILE_ID'] > 0;

        $shouldUseProfile = ($firstLoad || $justAuthorized || $isPersonTypeChanged || $isProfileChanged);
        $willUseProfile = $shouldUseProfile && $haveProfileId;

        $profileProperties = [];

        if ($haveProfileId)
        {
            $profileProperties = Sale\OrderUserProperties::getProfileValues((int)$this->arUserResult['PROFILE_ID']);
        }

        $ipAddress = '';

        if ($this->arParams['SPOT_LOCATION_BY_GEOIP'] === 'Y')
        {
            $ipAddress = \Bitrix\Main\Service\GeoIp\Manager::getRealIp();
        }
        $locationVal = 0;
        foreach ($this->getFullPropertyList($order) as $property)
        {
            if ($property['USER_PROPS'] === 'Y')
            {
                if ($isProfileChanged && !$haveProfileId)
                {
                    $curVal = '';
                }
                elseif (
                    $willUseProfile
                    || (
                        !isset($orderProperties[$property['ID']])
                        && isset($profileProperties[$property['ID']])
                    )
                )
                {
                    $curVal = $profileProperties[$property['ID']];
                }
                elseif (isset($orderProperties[$property['ID']]))
                {
                    $curVal = $orderProperties[$property['ID']];
                }
                else
                {
                    $curVal = '';
                }
            }
            else
            {
                $curVal = isset($orderProperties[$property['ID']]) ? $orderProperties[$property['ID']] : '';
            }
            if ($property['TYPE'] === 'LOCATION' && !empty($curVal))
            {
                $locationVal = $curVal;    
            }

            if ($arResult['HAVE_PREPAYMENT'] && !empty($arResult['PREPAY_ORDER_PROPS'][$property['CODE']]))
            {
                if ($property['TYPE'] === 'LOCATION')
                {
                    $cityName = ToUpper($arResult['PREPAY_ORDER_PROPS'][$property['CODE']]);
                    $arLocation = LocationTable::getList([
                        'select' => ['CODE'],
                        'filter' => ['NAME.NAME_UPPER' => $cityName],
                    ])->fetch();

                    if (!empty($arLocation))
                    {
                        $curVal = $arLocation['CODE'];
                        $locationVal = $curVal; 
                    }
                }
                else
                {
                    $curVal = $arResult['PREPAY_ORDER_PROPS'][$property['CODE']];
                }
            }

            if ($property['TYPE'] === 'LOCATION' && empty($curVal) && !empty($ipAddress))
            {
                $locCode = GeoIp::getLocationCode($ipAddress);

                if (!empty($locCode))
                {
                    $curVal = $locCode;
                    $locationVal = $curVal; 
                }
            }
            elseif (($property['IS_ZIP'] === 'Y') && empty($curVal) && (!empty($ipAddress)))
            {   
                
                $zip = GeoIp::getZipCode($ipAddress);

                if (!empty($zip))
                {
                    $curVal = $zip;
                }
            }
            elseif ($property['IS_PHONE'] === 'Y' && !empty($curVal))
            {
                $curVal = $this->getNormalizedPhone($curVal);
            }

            if (empty($curVal))
            {
                // getting default value for all properties except LOCATION
                // (LOCATION - just for first load or person type change or new profile)
                if ($property['TYPE'] !== 'LOCATION' || !$willUseProfile)
                {
                    global $USER;

                    if ($shouldUseProfile && $USER->IsAuthorized())
                    {
                        $curVal = $this->getValueFromCUser($property);
                    }

                    if (empty($curVal) && !empty($property['DEFAULT_VALUE']))
                    {
                        $curVal = $property['DEFAULT_VALUE'];
                    }
                }
            }

            if ($property['TYPE'] === 'LOCATION')
            {
                
                if (
                    (!$shouldUseProfile || $this->request->get('PROFILE_ID') === '0')
                    && $this->request->get('location_type') !== 'code'
                )
                {     
                    $curVal = CSaleLocation::getLocationCODEbyID($curVal);
                    $locationVal = $curVal;   
                }
				if ( empty($curVal) ){
					$curVal = $_SESSION['SESS_CITY_ID'];
				}	
            }

            $this->arUserResult['ORDER_PROP'][$property['ID']] = $curVal;
        }
        
        
        
        foreach ($this->getFullPropertyList($order) as $property)
        {
            if ($property['ID'] == 69 && !empty($locationVal))
            {  
                if($this->arUserResult['ORDER_PROP'][$property['ID']] == $this->request->get('ORDER_PROP_'.$property['ID']) && !empty($this->request->get('ORDER_PROP_'.$property['ID'])))
                {
                    $this->arUserResult['ZIP_PROPERTY_CHANGED'] = 'Y';    
                }
                
                if($this->arUserResult['ZIP_PROPERTY_CHANGED'] !== 'Y')
                {
                    $res = Sale\Location\Admin\LocationHelper::getZipByLocation($locationVal);

                    if ($arZip = $res->fetch())
                    {
                        if (!empty($arZip['XML_ID']))
                        {
                            $this->arUserResult['ORDER_PROP'][$property['ID']] = $arZip['XML_ID'];
                        }
                    }    
                }
            }            
        }
        
        $this->checkZipProperty($order, $willUseProfile);
        $this->checkZipPropertyBb($order, $willUseProfile);    
        $this->checkAltLocationProperty($order, $willUseProfile, $profileProperties);
        
        foreach (GetModuleEvents('sale', 'OnSaleComponentOrderProperties', true) as $arEvent)
        {
            ExecuteModuleEventEx($arEvent, [&$this->arUserResult, $this->request, &$this->arParams, &$this->arResult]);
        }
        if ($this->UserEmailEmpty == "" && $getEmail){
            $this->UserEmailEmpty = "auto_".time()."@diada-email.ru";
        }
        if (!$this->arUserResult['ORDER_PROP'][6]){
            $this->arUserResult['ORDER_PROP'][6]=$this->UserEmailEmpty;
        }
        $this->setOrderProperties($order);
    }
    protected function checkZipPropertyBb(Order $order, $loadFromProfile)
    {
        $propertyCollection = $order->getPropertyCollection();
        $zip = $propertyCollection->getItemByOrderPropertyId(69);
        $location = $propertyCollection->getDeliveryLocation();
        if (!empty($zip) && !empty($location))
        {
            $locId = $location->getField('ORDER_PROPS_ID');
            $locValue = $this->arUserResult['ORDER_PROP'][$locId];

            // need to override flag for zip data from profile
            if ($loadFromProfile)
            {
                $this->arUserResult['ZIP_PROPERTY_CHANGED'] = 'Y';
            }

            $requestLocation = $this->request->get('RECENT_DELIVERY_VALUE');
            // reload zip when user manually choose another location
            if ($requestLocation !== null && $locValue !== $requestLocation)
            {
                $this->arUserResult['ZIP_PROPERTY_CHANGED'] = 'N';
            }

            // don't autoload zip property if user manually changed it
            if ($this->arUserResult['ZIP_PROPERTY_CHANGED'] !== 'Y')
            {
                $res = Sale\Location\Admin\LocationHelper::getZipByLocation($locValue);

                if ($arZip = $res->fetch())
                {
                    if (!empty($arZip['XML_ID']))
                    {
                        $this->arUserResult['ORDER_PROP'][$zip->getField('ORDER_PROPS_ID')] = $arZip['XML_ID'];
                    }
                }
            }
        }
    }
    protected function getLocationHtml($property, $locationTemplate)
    {
        global $APPLICATION;

        
        $locationOutput = array();
        $showDefault = true;

        $propertyId = (int)$property['ID'];
        $isMultiple = $property['MULTIPLE'] == 'Y' && $property['IS_LOCATION'] != 'Y';

        $locationAltPropDisplayManual = $this->request->get('LOCATION_ALT_PROP_DISPLAY_MANUAL');
        $altPropManual = isset($locationAltPropDisplayManual[$propertyId]) && (bool)$locationAltPropDisplayManual[$propertyId];
        
        $location = $this->order->getPropertyCollection()->getItemByOrderPropertyId($propertyId);
        $actualValues = $location->getValue();

        if (!is_array($actualValues))
        {
            $actualValues = array($actualValues);
        }
        
        if (!empty($actualValues) && is_array($actualValues))
        {
		
			
		
            foreach ($actualValues as $key => $value)
            {   


				if ( $value == $_SESSION['SESS_CITY_ID'] ){
					$city = getUserLocation();
					if ( !city ){
						$city = \Bitrix\Main\Service\GeoIp\Manager::getCityName('', 'ru');
					}
					$res = \Bitrix\Sale\Location\LocationTable::getList(array(
					'filter' => array('=NAME.NAME' => $city),
					'select' => array('CODE', 'ID')
					));
					while ($item = $res->fetch()) {
						$value = $item['CODE']; 
					}
				}
			
                $parameters = array(
                    'CODE' => $value,
                    'INPUT_NAME' => 'ORDER_PROP_'.$propertyId.($isMultiple ? '['.$key.']' : ''),
                    'CACHE_TYPE' => 'A',
                    'CACHE_TIME' => '36000000',
                    'SEARCH_BY_PRIMARY' => 'N',
                    'SHOW_DEFAULT_LOCATIONS' => $showDefault ? 'Y' : 'N',
                    'PROVIDE_LINK_BY' => 'code',
                    'JS_CALLBACK' => 'submitFormProxy',
                    'JS_CONTROL_DEFERRED_INIT' => $propertyId.($isMultiple ? '_'.$key : ''),
                    'JS_CONTROL_GLOBAL_ID' => $propertyId.($isMultiple ? '_'.$key : ''),
                    'DISABLE_KEYBOARD_INPUT' => 'Y',
                    'PRECACHE_LAST_LEVEL' => 'N',
                    'PRESELECT_TREE_TRUNK' => 'Y',
                    'SUPPRESS_ERRORS' => 'Y',
                    'FILTER_BY_SITE' => 'Y',
                    'FILTER_SITE_ID' => $this->getSiteId()
                );
                
                ob_start();

                $template = "";
                if ($locationTemplate == 'steps')
                {
                    $template = "page";
                    echo '<input type="hidden" id="LOCATION_ALT_PROP_DISPLAY_MANUAL['.$propertyId
                        .']" name="LOCATION_ALT_PROP_DISPLAY_MANUAL['.$propertyId.']" value="'
                        .($altPropManual ? '1' : '0').'" />';        
                }

                $APPLICATION->IncludeComponent(
                    'bitrix:sale.location.selector.'.$locationTemplate,
                    $template,
                    $parameters,
                    null,
                    array('HIDE_ICONS' => 'Y')
                );

                $locationOutput[] = ob_get_contents();
                ob_end_clean();

                $showDefault = false;
            }
        }

        if ($isMultiple)
        {
            $parameters = array(
                'CODE' => '',
                'INPUT_NAME' => 'ORDER_PROP_'.$propertyId.'[#key#]',
                'CACHE_TYPE' => 'A',
                'CACHE_TIME' => '36000000',
                'SEARCH_BY_PRIMARY' => 'N',
                'SHOW_DEFAULT_LOCATIONS' => 'N',
                'PROVIDE_LINK_BY' => 'code',
                'JS_CALLBACK' => 'submitFormProxy',
                'JS_CONTROL_DEFERRED_INIT' => $propertyId.'_key__',
                'JS_CONTROL_GLOBAL_ID' => $propertyId.'_key__',
                'DISABLE_KEYBOARD_INPUT' => 'Y',
                'PRECACHE_LAST_LEVEL' => 'N',
                'PRESELECT_TREE_TRUNK' => 'Y',
                'SUPPRESS_ERRORS' => 'Y',
                'FILTER_BY_SITE' => 'Y',
                'FILTER_SITE_ID' => $this->getSiteId()
            );

            ob_start();

            $APPLICATION->IncludeComponent(
                'bitrix:sale.location.selector.'.$locationTemplate,
                '',
                $parameters,
                null,
                array('HIDE_ICONS' => 'Y')
            );

            $locationOutput['clean'] = ob_get_contents();
            ob_end_clean();
        }
		
        return $locationOutput;
    }
    protected function refreshOrderAjaxAction()
    {
        global $USER;

        $error = false;
        $this->request->set($this->request->get('order'));
        if ($this->checkSession)
        {
            $this->order = $this->createOrder($USER->GetID() ? $USER->GetID() : CSaleUser::GetAnonymousUserID());
            $this->prepareResultArray();
            self::scaleImages($this->arResult['JS_DATA'], $this->arParams['SERVICES_IMAGES_SCALING']);
        }
        else
            $error = Loc::getMessage('SESSID_ERROR');
        
        $arOldPrice = 0;
        $showOldPrice = 0;
        foreach($this->arResult["BASKET_ITEMS"] as $item)
        {
            $oldPriceset = false;
            foreach( $item["PROPS"] as $prop)
            {
                if($prop["CODE"] == "HIDE_OLD_PRICE" && floatval($prop["VALUE"]) > floatval($item["PRICE"]))
                {
                    $arOldPrice = $arOldPrice + ($prop["VALUE"] * $item["QUANTITY"]);
                    $showOldPrice = true;
                    $oldPriceset = true;
                    break;    
                }
            }
            
            if(!$oldPriceset)
            {   
                if (floatval($item["BASE_PRICE"]) > floatval($item["PRICE"]))
                {
                    $arOldPrice = $arOldPrice + ($item["BASE_PRICE"] * $item["QUANTITY"]);
                    $showOldPrice = true;
                }    
                else
                {
                    $arOldPrice = $arOldPrice + ($item["PRICE"] * $item["QUANTITY"]);
                }
            }
        }
           
        if (floatval($arOldPrice) > 0 && $showOldPrice)
        {
            $this->arResult['JS_DATA']['TOTAL']['PRICE_WITHOUT_DISCOUNT_VALUE'] = $arOldPrice;
            $this->arResult['JS_DATA']['TOTAL']['PRICE_WITHOUT_DISCOUNT'] = SaleFormatCurrency($arOldPrice, $this->arResult["BASE_LANG_CURRENCY"]);
            
            $this->arResult['JS_DATA']['TOTAL']['DISCOUNT_PRICE'] = $this->arResult['JS_DATA']['TOTAL']['PRICE_WITHOUT_DISCOUNT_VALUE'] - $this->arResult['JS_DATA']['TOTAL']["ORDER_PRICE"];
            $this->arResult['JS_DATA']['TOTAL']['DISCOUNT_PRICE_FORMATED'] = SaleFormatCurrency($this->arResult['JS_DATA']['TOTAL']['DISCOUNT_PRICE'], $this->arResult["BASE_LANG_CURRENCY"]);
        }

        if($this->arResult['JS_DATA']["PAY_SYSTEM"]) {
            foreach ($this->arResult['JS_DATA']["PAY_SYSTEM"] as $key => $item) {
                if ($this->arParams["PAY_KEEPER_UNSET"] == "Y" && $item["PAY_SYSTEM_ID"] == 17) {
                    unset($this->arResult['JS_DATA']["PAY_SYSTEM"][$key]);
                    $this->arResult['JS_DATA']["PAY_SYSTEM"] = array_values($this->arResult['JS_DATA']["PAY_SYSTEM"]);
                }
            }
        }
        
        $this->showAjaxAnswer(array(
            'order' => $this->arResult['JS_DATA'],
            'locations' => $this->arResult['LOCATIONS'],
            'error' => $error
        ));
    }
}
?>
