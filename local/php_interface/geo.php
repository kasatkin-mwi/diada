<?
use \Bitrix\Main\Service\GeoIp;

function getIpUserlocation() {
    \Bitrix\Main\Loader::includeModule("sale");
    
    /*$ipAddress = GeoIp\Manager::getRealIp();
    
    GeoIp\Manager::useCookieToStoreInfo(true);
    $result = GeoIp\Manager::getDataResult($ipAddress, "ru")->getGeoData();
    $country = $result->countryCode;
    
    $location_id = \Bitrix\Sale\Location\GeoIp::getLocationId($ipAddress, "ru");
    
    return $location_id ? $location_id : '';*/
    
    $arCountry = Array(
        'RU' => 1,
        'KZ' => 17068,
        'BY' => 17061,
        'KG' => 17088,
    );

    $obCity = new CCity();
    $arCity = $obCity->GetFullInfo();
     
    $arFilter = Array('LID' => LANGUAGE_ID);

    if ($arCity['CITY_NAME']['VALUE'])
        $arFilter['CITY_NAME_LANG'] = $arCity['CITY_NAME']['VALUE'];
    else if ($arCountry[$arCity['COUNTRY_CODE']['VALUE']])
        $arFilter['COUNTRY_ID'] = $arCountry[$arCity['COUNTRY_CODE']['VALUE']];
    else
        $arFilter['ID'] = 84;
    
    $res = CSaleLocation::GetList(
        Array(),
        $arFilter
    );
    if ($ar_res = $res->Fetch())
    {
        return $ar_res['CITY_ID'] ? $ar_res['CITY_ID'] : ($ar_res['REGION_ID'] ? $ar_res['REGION_ID'] : $ar_res['COUNTRY_ID']);
    }
    else
    {    
        $arFilter = Array('LID' => LANGUAGE_ID);
        $arFilter['ID'] = 84;
        
        $res = CSaleLocation::GetList(
            Array(),
            $arFilter
        );
        if ($ar_res = $res->Fetch())
        {
            return $ar_res['CITY_ID'] ? $ar_res['CITY_ID'] : ($ar_res['REGION_ID'] ? $ar_res['REGION_ID'] : $ar_res['COUNTRY_ID']);
        }    
    }  
}

function getUserLocation() {
    \Bitrix\Main\Loader::includeModule("sale");
	global $APPLICATION;
	$LOCATION_ID = $APPLICATION->get_cookie('locationId');
    if (!$LOCATION_ID) 
    {
		$LOCATION_ID = getIpUserlocation();
		define('LOCATION_IS_FROM_IP', true);
	}
	if ($LOCATION_ID > 0) {
		$res = CSaleLocation::GetList(
			Array(),
			Array('ID' => $LOCATION_ID, 'LID' => LANGUAGE_ID)
		);
		if ($ar_res = $res->Fetch())
        {
            return $ar_res['CITY_NAME'] ? $ar_res['CITY_NAME'] : ($ar_res['REGION_NAME'] ? $ar_res['REGION_NAME'] : $ar_res['COUNTRY_NAME']);
        }
        else
        {
            try
            {
                $parameters = array(
                    'select' => array(
                        'ID',
                        'CODE',
                        'SORT',
                        'PARENT_ID',
                        'LONGITUDE',
                        'LATITUDE',
                        'TYPE_ID',
                        'LNAME' => 'NAME.NAME',
                        'SHORT_NAME' => 'NAME.SHORT_NAME',
                        'LEFT_MARGIN',
                        'RIGHT_MARGIN',
                    ),
                    'filter' => array(
                        'NAME.LANGUAGE_ID' => LANGUAGE_ID
                    )
                );
                $path = array();
                $path_names = array();
                
                $res = Bitrix\Sale\Location\LocationTable::getPathToNode($LOCATION_ID, $parameters);
                
                if($res)
                {                                                                                        
                    $res->addReplacedAliases(array('LNAME' => 'NAME'));
                    
                    while($item = $res->Fetch())
                    {
                        //$path[intval($item['ID'])] = $item;
                        $path_names[intval($item['ID'])] = $item['NAME'];
                    }
                }
                
                if(isset($path_names[$LOCATION_ID]))
                {
                    return $path_names[$LOCATION_ID];
                }  
            }
            catch(Bitrix\Main\SystemException $e)
            {
                $LOCATION_ID = getIpUserlocation();
                define('LOCATION_IS_FROM_IP', true);
                $APPLICATION->set_cookie('locationId', 0);
                if ($LOCATION_ID > 0) {
                    $res = CSaleLocation::GetList(
                        Array(),
                        Array('ID' => $LOCATION_ID, 'LID' => LANGUAGE_ID)
                    );
                    if ($ar_res = $res->Fetch())
                    {
                        return $ar_res['CITY_NAME'] ? $ar_res['CITY_NAME'] : ($ar_res['REGION_NAME'] ? $ar_res['REGION_NAME'] : $ar_res['COUNTRY_NAME']);
                    }
                    else
                    {
                        try
                        {
                            $parameters = array(
                                'select' => array(
                                    'ID',
                                    'CODE',
                                    'SORT',
                                    'PARENT_ID',
                                    'LONGITUDE',
                                    'LATITUDE',
                                    'TYPE_ID',
                                    'LNAME' => 'NAME.NAME',
                                    'SHORT_NAME' => 'NAME.SHORT_NAME',
                                    'LEFT_MARGIN',
                                    'RIGHT_MARGIN',
                                ),
                                'filter' => array(
                                    'NAME.LANGUAGE_ID' => LANGUAGE_ID
                                )
                            );
                            $path = array();
                            $path_names = array();
                            
                            $res = Bitrix\Sale\Location\LocationTable::getPathToNode($LOCATION_ID, $parameters);
                            
                            if($res)
                            {                                                                                        
                                $res->addReplacedAliases(array('LNAME' => 'NAME'));
                                
                                while($item = $res->Fetch())
                                {
                                    //$path[intval($item['ID'])] = $item;
                                    $path_names[intval($item['ID'])] = $item['NAME'];
                                }
                            }
                            
                            if(isset($path_names[$LOCATION_ID]))
                            {
                                return $path_names[$LOCATION_ID];
                            }  
                        }
                        catch(Bitrix\Main\SystemException $e)
                        {
                            
                        } 
                    }
                }
            } 
        }
	}
}

function defineLocationGroupID() {
	global $APPLICATION;
	$LOCATION_GROUP_ID = 1;

	$LOCATION_ID = $APPLICATION->get_cookie('locationId');
	$LOCATION_ID = $LOCATION_ID ? $LOCATION_ID : getIpUserlocation();

	$res = CSaleLocationGroup::GetLocationList(
		Array('LOCATION_ID' => $LOCATION_ID)
	);
	while ($ar_res = $res->Fetch()) {
		if (!CSaleLocationGroup::GetByID($ar_res['LOCATION_GROUP_ID']))
			continue;
		$LOCATION_GROUP_ID = intval($ar_res['LOCATION_GROUP_ID']);
		break;
	}

	define('LOCATION_GROUP_ID', $LOCATION_GROUP_ID);
}

function getLocationGroupPriceType() {
	global $USER;
	if ($USER->GetID() != 1853)
		return 'base';
	if (!defined('LOCATION_GROUP_ID'))
		defineLocationGroupID();
        $arr = Array(
            2 => 'moskva_i_moskovskaya_oblast',
            3 => 'sankt_peterburg_i_leningradskaya_oblast',
            4 => 'nizhniy_novgorod_i_oblast',
            1 => 'drugoy_gorod_rossii',
            5 => 'belarus',
            6 => 'kazahstan',
            8 => 'kyirgyizstan',
            9 => 'kostroma_i_oblast',
            10 => 'armeniya',
        );
	return $arr[LOCATION_GROUP_ID];
}

/*function getContactsElementID($IBLOCK_ID = 20) {
	if (!defined('LOCATION_GROUP_ID'))
		defineLocationGroupID();
	$obCache = new CPHPCache;
	if ($obCache->InitCache(3600, 'LOCATION_GROUP_ID_'.LOCATION_GROUP_ID.$IBLOCK_ID)) {
		$vars = $obCache->GetVars();
		$ELEMENT_ID = $vars['ELEMENT_ID'];
	}
	else {
		CModule::IncludeModule('iblock');
		$res = CIBlockElement::GetList(
			Array(
				'property_DEFAULT' => 'nulls,desc'
			),
			Array(
				'IBLOCK_ID' => $IBLOCK_ID,
				Array(
					'LOGIC' => 'OR',
					Array('PROPERTY_REGION' => LOCATION_GROUP_ID),
					Array('PROPERTY_DEFAULT_VALUE' => 'Y'),
				)
			),
			false,
			Array('nTopCount' => 1),
			Array('ID')
		);
		if ($ar_res = $res->GetNext()) {
			$ELEMENT_ID = $ar_res['ID'];
			if ($obCache->StartDataCache())
				$obCache->EndDataCache(Array('ELEMENT_ID' => $ar_res['ID']));
		}
	}
	return $ELEMENT_ID;
}*/
function getContactsElementID($IBLOCK_ID = 20) {
    $userLocation = $GLOBALS["APPLICATION"]->get_cookie('locationId');
    if (!($userLocation>0)){
        $userLocation = 84;
    }
    $obCache = new CPHPCache;
    if ($GLOBALS["USER"]->IsAdmin()){
        $sub = "USER";//"TEST_MODE";
    }
    else{
        $sub = "USER";
    }
    if ($obCache->InitCache(3600, 'LOCATION_GROUP_ID_'.$userLocation.$IBLOCK_ID.$sub)) {
        $vars = $obCache->GetVars();
        $ELEMENT_ID = $vars['ELEMENT_ID'];
    }
    else {
        CModule::IncludeModule('iblock');
        $item = \Bitrix\Sale\Location\LocationTable::getById($userLocation)->fetch();
        $LIST_LOC_USER = array($item["ID"]=>NULL,$item["REGION_ID"]=>NULL,$item["COUNTRY_ID"]=>NULL);
        foreach ($LIST_LOC_USER as $idLoc=>&$idGroup) {
            if ($idLoc>0) {
                if ($data = Bitrix\Sale\Location\GroupLocationTable::getList(array("filter" => array("LOCATION_ID" => $idLoc)))->fetch()){
                    $idGroup = $data["LOCATION_GROUP_ID"];
                }
                else{
                    unset($LIST_LOC_USER[$idLoc]);
                }
            }
            else{
                unset($LIST_LOC_USER[$idLoc]);
            }
        }
        $ELEMENT_ID = NULL;
        foreach ($LIST_LOC_USER as $idLoc) {
            $res = CIBlockElement::GetList(
                Array(
                    'PROPERTY_DEFAULT' => 'nulls,desc'
                ),
                Array(
                    'IBLOCK_ID' => $IBLOCK_ID,
                    "PROPERTY_N_LOCATION_ID" => $idLoc,
                ),
                false,
                false,
                Array('ID')
            );
            if ($res->SelectedRowsCount()>0){
                if ($ar_res = $res->GetNext()) {
                    $ELEMENT_ID = $ar_res['ID'];
                    if ($obCache->StartDataCache())
                        $obCache->EndDataCache(Array('ELEMENT_ID' => $ar_res['ID']));
                }
                break;
            }
        }
        if ($ELEMENT_ID == NULL){
            $userLocation = 84;
            $item = \Bitrix\Sale\Location\LocationTable::getById($userLocation)->fetch();
            $LIST_LOC_USER = array($item["ID"]=>NULL,$item["REGION_ID"]=>NULL,$item["COUNTRY_ID"]=>NULL);
            foreach ($LIST_LOC_USER as $idLoc=>&$idGroup) {
                if ($idLoc>0) {
                    if ($data = Bitrix\Sale\Location\GroupLocationTable::getList(array("filter" => array("LOCATION_ID" => $idLoc)))->fetch()){
                        $idGroup = $data["LOCATION_GROUP_ID"];
                    }
                    else{
                        unset($LIST_LOC_USER[$idLoc]);
                    }
                }
                else{
                    unset($LIST_LOC_USER[$idLoc]);
                }
            }
            foreach ($LIST_LOC_USER as $idLoc) {
                $res = CIBlockElement::GetList(
                    Array(
                        'PROPERTY_DEFAULT' => 'nulls,desc'
                    ),
                    Array(
                        'IBLOCK_ID' => $IBLOCK_ID,
                        "PROPERTY_N_LOCATION_ID" => $idLoc,
                    ),
                    false,
                    false,
                    Array('ID')
                );
                if ($res->SelectedRowsCount()>0){
                    if ($ar_res = $res->GetNext()) {
                        $ELEMENT_ID = $ar_res['ID'];
                        if ($obCache->StartDataCache())
                            $obCache->EndDataCache(Array('ELEMENT_ID' => $ar_res['ID']));
                    }
                    break;
                }
            }
        }
    }
    return $ELEMENT_ID;
}
?>