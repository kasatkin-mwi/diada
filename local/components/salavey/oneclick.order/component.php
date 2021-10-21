<?php
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

if (!CModule::IncludeModule('iblock')) return false;

$locationPriceType = getLocationGroupPriceType();
$__arPrice = CIBlockPriceTools::GetCatalogPrices(1, array($locationPriceType));

//var_dump($arParams['PRODUCT_ID']);
/**
 * Bitrix vars
 *
 * @var array $arParams
 * @var array $arResult
 * @var CBitrixComponent $this
 * @global CMain $APPLICATION
 * @global CUser $USER
 */
//var_dump($arParams['PRODUCT_ID']);
global $USER;
CModule::IncludeModule('iblock');
CModule::IncludeModule('sale');
CModule::IncludeModule('catalog');
$arResult["PARAMS_HASH"] = md5(serialize($arParams) . $this->GetTemplateName());
$arParams["USE_CAPTCHA"] = (($arParams["USE_CAPTCHA"] != "N" && !$USER->IsAuthorized()) ? "Y" : "N");
$arParams["EVENT_NAME"] = trim($arParams["EVENT_NAME"]);
$arParams["USER_DESCRIPTION"] = !empty($arParams["USER_DESCRIPTION"]) ? $arParams["USER_DESCRIPTION"] : "Быстрый заказ";
if ($arParams["EVENT_NAME"] == '')
    $arParams["EVENT_NAME"] = "FEEDBACK_FORM";
$arParams["EMAIL_TO"] = trim($arParams["EMAIL_TO"]);
if ($arParams["EMAIL_TO"] == '')
    $arParams["EMAIL_TO"] = COption::GetOptionString("main", "email_from");
$arParams["OK_TEXT"] = trim($arParams["OK_TEXT"]);
if ($arParams["OK_TEXT"] == '')
    $arParams["OK_TEXT"] = GetMessage("MF_OK_MESSAGE");

$product_id = $arParams["PRODUCT_ID"];
if ((int)$_REQUEST['QUANTITY'] > 0) {
    $quantity_ = $_REQUEST['QUANTITY'];
} else {
    $quantity_ = 1;
}
$arResult['QUANTITY'] = $quantity_;
$ar_res = CCatalogProduct::GetByIDEx($product_id);
$arResult['PRODUCT_NAME'] = $ar_res['NAME'];
$arResult['PRODUCT_ID'] = $product_id;
if ($_SERVER["REQUEST_METHOD"] == "POST" && $_REQUEST["submit"] <> '' && (!isset($_REQUEST["PARAMS_HASH"]) || $arResult["PARAMS_HASH"] === $_REQUEST["PARAMS_HASH"])) {
    $arResult["AUTHOR_MAIL"] = $_REQUEST['user_email'];
    $arResult["ERROR_MESSAGE"] = array();
    if (check_bitrix_sessid()) {
        if (empty($arParams["REQUIRED_FIELDS"]) || !in_array("NONE", $arParams["REQUIRED_FIELDS"])) {
            //if (strlen($_REQUEST["user_name"]) <= 2) array_push($arResult["ERROR_MESSAGE"], "NAME");
            if (strlen(str_replace(array('+', ' ', '(' , ')', '-', '_'), '', $_REQUEST["user_phone"])) <= 4) 
                array_push($arResult["ERROR_MESSAGE"], "PHONE");
                
            if($arParams["SHOW_EMAIL"] == "Y")
            {
                if (empty($arResult["AUTHOR_MAIL"]) || !check_email(trim($arResult["AUTHOR_MAIL"]))) 
                    array_push($arResult["ERROR_MESSAGE"], "EMAIL");
            }
        }
      
        if (empty($arResult["ERROR_MESSAGE"])) {
            $arFields = Array(
                "AUTHOR" => $_REQUEST["user_name"],
                "PHONE" => str_replace(array('+', ' ', '(' , ')', '-', '_'), '', $_REQUEST["user_phone"]),
                "EMAIL_TO" => $arParams["EMAIL_TO"]
            );

            $phone = $arFields['PHONE'];
            $name = $_REQUEST['user_name'];
            if ($ar_res) {
                $is_error = false;
                global $USER;
                $user_id = $USER->GetID();
                $price = 0;
                $dbPrice = CPrice::GetList(
                    array("QUANTITY_FROM" => "ASC", "QUANTITY_TO" => "ASC", "SORT" => "ASC"),
                    array("PRODUCT_ID" => $ar_res['ID'], 'CATALOG_GROUP_ID' => 1),
                    false,
                    false,
                    array("ID", "CATALOG_GROUP_ID", "PRICE", "CURRENCY", "QUANTITY_FROM", "QUANTITY_TO")
                );
                while ($arPrice = $dbPrice->Fetch()) {
                    $arDiscounts = CCatalogDiscount::GetDiscountByPrice(
                        $arPrice["ID"],
                        $USER->GetUserGroupArray(),
                        "N",
                        SITE_ID
                    );
                    $discountPrice = CCatalogProduct::CountPriceWithDiscount(
                        $arPrice["PRICE"],
                        $arPrice["CURRENCY"],
                        $arDiscounts
                    );
                    $arPrice["DISCOUNT_PRICE"] = $discountPrice;
                    if ((float)$discountPrice > 0) {
                        $price = round(($discountPrice * $quantity_), 2);
                        $one_price = $discountPrice;
                        $disc_price = (int)$arPrice['PRICE'] - (int)$discountPrice;
                    }
                    else {
                        $price = $arPrice['PRICE'] * $quantity_;
                        $one_price = $arPrice['PRICE'];
                        $disc_price = 0;
                    }
                }
                $arPrice__ = CIBlockPriceTools::GetCatalogPrices(1, array('base'));
                $setName = $_REQUEST['SET'];
                $complect = '';
                if ($setName == 'MASTER' || $setName == 'PROFI') {
                    if ($setName == 'MASTER') {
                        $complect = '(комплект "МАСТЕР")';
                    } else {
                        $complect = '( комплект "ПРОФИ")';
                    }
                    $rsID = CIBlockElement::GetList(array(), array('ID' => $product_id, "ACTIVE" => "Y"));
                    $arID = $rsID->GetNextElement();
                    if (!empty($arID)) {
                        $arFields__ = $arID->GetFields();
                        $arProps = $arID->GetProperties();

                    }
                    $arAllSetsID = array();
                    $arAllSetsID[] = $arFields__['ID'];

                    if (is_array($arProps['SET_' . $setName]['VALUE']) && count($arProps['SET_' . $setName]['VALUE']) > 0) {
                        $arResult['SETS'][$setName]['GOODS_ID'][] = $arFields__['ID'];
                        foreach ($arProps['SET_' . $setName]['VALUE'] as $id) {
                            $arResult['SETS'][$setName]['GOODS_ID'][] = $id;
                            $arAllSetsID[] = $id;
                            //$i++;
                        }
                        $arResult['SETS'][$setName]['ECONOMY'] = $arProps['SET_' . $setName . '_DISCOUNT']['VALUE'];
                        $arResult['SETS'][$setName]['ECONOMY_'] = $arProps['SET_' . $setName . '_DISCOUNT']['VALUE'];
                    }


                    if (count($arAllSetsID) > 0) {
                        $arFilter1 = array('IBLOCK_ID' => 1, 'ID' => $arAllSetsID);
                        $arSelect1 = array('ID', 'NAME', 'PREVIEW_PICTURE', 'DETAIL_PAGE_URL', 'CATALOG_GROUP_1');
                        $rsGoodsInSet = CIBlockElement::GetList(array(), $arFilter1, false, false, $arSelect1);
                        $arResult["GOODS_IN_SETS_WITH_DISCOUNT"] = array();
                        while ($arGoodsInSet = $rsGoodsInSet->GetNextElement()) {
                            $arGoodsInSetFields = $arGoodsInSet->GetFields();
                            $arPrice__s = CIBlockPriceTools::GetItemPrices(1, $arPrice__, $arGoodsInSetFields);
                            //$dump_1 = print_r($arGoodsInSetFields, true);
                            //AddMessage2Log('zz '.$dump_1);
                            $arResult["GOODS_IN_SETS_WITH_DISCOUNT"][$arGoodsInSetFields['ID']] = array(
                                'NAME' => $arGoodsInSetFields['NAME'],
                                'ID' => $arGoodsInSetFields['ID'],
                                'DETAIL_PAGE_URL' => $arGoodsInSetFields['DETAIL_PAGE_URL'],
                                'PRICE' => $arPrice__s,
                                'PREVIEW_PICTURE' => $arGoodsInSetFields['PREVIEW_PICTURE'],
                            );
                            //var_dump($arResult["GOODS_IN_SETS_WITH_DISCOUNT"][$arGoodsInSetFields['ID']]);
                        }
                    }
                    foreach ($arResult['SETS'] as $setName => $set) {
                        $economy = $set['ECONOMY'];
                        $oldPrice = 0;
                        $newPrice = 0;

                        foreach ($set['GOODS_ID'] as $id) {
                            $oldPrice += $arResult["GOODS_IN_SETS_WITH_DISCOUNT"][$id]['PRICE']['base']['VALUE'];
                            $newPrice += intval($arResult["GOODS_IN_SETS_WITH_DISCOUNT"][$id]['PRICE']['base']['DISCOUNT_VALUE']);
                            // записываем в результирующий массив скидку
                            //AddMessage2Log('hz '.print_r($arResult["GOODS_IN_SETS_WITH_DISCOUNT"][$id], true));
                            $arResult['SETS'][$setName]['GOODS_DISCOUNT'][$id] = $arResult["GOODS_IN_SETS_WITH_DISCOUNT"][$id]['PRICE']['base']['DISCOUNT_DIFF'];

                            $arResult['SETS'][$setName]['GOODS_PRICE'][$id] = $arResult["GOODS_IN_SETS_WITH_DISCOUNT"][$id]['PRICE']['base']["DISCOUNT_VALUE"];
                            $arResult['SETS'][$setName]['GOODS_NAME'][$id] = $arResult["GOODS_IN_SETS_WITH_DISCOUNT"][$id]['NAME'];
                        }
                        $arResult['SETS'][$setName]['ECONOMY'] = $economy + $oldPrice - $newPrice;
                        $arResult['SETS'][$setName]['OLD_PRICE'] = $oldPrice;
                        $arResult['SETS'][$setName]['NEW_PRICE'] = $newPrice;
                        $arResult['SETS'][$setName]['PRICE_WITH_DISCOUNT'] = $arResult['SETS'][$setName]['OLD_PRICE'] - $arResult['SETS'][$setName]['ECONOMY'];
                        $arResult['SETS'][$setName]['QUANTITY'] = $quantity_;
                    }
                }
                
                if (!$user_id) {
                    
                    $pass = rand(100000, 999999);
                    $pass = 'AA' . $pass . 'zz';
                    $groups = array(5);

                    do {
                        $login = str_replace(array("+", " ", "(", ")", "-", '_'), '', $arFields['PHONE']);//.'_'.randString(3);
                        $login .= '_' . randString(3);
                        $rsUser = CUser::GetByLogin($login);
                    }while ($rsUser->Fetch());
                    if (!$arResult["AUTHOR_MAIL"]) 
                    {
                        $mail = $login . '@fastorderdiada.ru';
                    }
                    else
                    {
                        $mail = $arResult["AUTHOR_MAIL"];
                    }
                    
                    if ($arResult["AUTHOR_MAIL"] != '')
                    {
                        $res = Bitrix\Main\UserTable::getRow(array(
                            'filter' => array(
                                '=ACTIVE' => 'Y',
                                '=EMAIL' => $arResult["AUTHOR_MAIL"]
                            ),
                            'select' => array('ID')
                        ));
                        if (isset($res['ID']))
                        {
                            $user_id = (int)$res['ID'];
                        }
                    }
                    
                    if(!empty($phone) && $user_id <= 0)
                    {
                        $res = Bitrix\Main\UserTable::getRow(array(
                            'filter' => array(
                                'ACTIVE' => 'Y',
                                array(
                                    'LOGIC' => 'OR',
                                    '=PERSONAL_PHONE' => $phone,
                                    '=PERSONAL_MOBILE' => $phone
                                )
                            ),
                            'select' => array('ID')
                        ));
                        if (isset($res['ID']))
                        {
                            $user_id = (int)$res['ID'];
                        }
                    }
                    if($user_id <= 0)
                    {
                        $user_fields = array(
                            "NAME" => $name,
                            "EMAIL" => $mail,
                            "LOGIN" => $login,
                            "PERSONAL_PHONE" => $arFields['PHONE'],
                            "LID" => "ru",
                            "ACTIVE" => "Y",
                            "GROUP_ID" => $groups,
                            "PASSWORD" => $pass,
                            "CONFIRM_PASSWORD" => $pass,
                        );                              
                        $user_id = $USER->Add($user_fields);
                        $USER->Authorize($user_id);
                        $user_id = $USER->GetID();
                        $error_text = $USER->LAST_ERROR;
                        if($user_id > 0)
                        {
                            $arParams["OK_TEXT"] = $arParams["OK_TEXT"]." Ваш пароль для авторизации: $pass";
                        }
                    }
                    $arResult["AUTHOR_MAIL"] = $mail;
                }

                if ($user_id > 0) {
                    if(false) {
                        if ($arResult['SETS'][$setName]["PRICE_WITH_DISCOUNT"] > 0) {
                            $price = $arResult['SETS'][$setName]["PRICE_WITH_DISCOUNT"] * $arResult['SETS'][$setName]['QUANTITY'];
                        }
                        $arFields2 = array(
                            "PAY_SYSTEM_ID" => 1,
                            "LID" => SITE_ID,
                            "PERSON_TYPE_ID" => 1,
                            "PRICE" => $price,
                            "PAYED" => "N",
                            "CANCELED" => "N",
                            "STATUS_ID" => "N",
                            "DELIVERY_ID" => 23,
                            "CURRENCY" => "RUB",
                            "USER_ID" => $user_id,
                            "USER_DESCRIPTION" => $arParams["USER_DESCRIPTION"]
                        );
                        Bitrix\Sale\Notify::setNotifyDisable(true);
                        $ORDER_ID = IntVal(CSaleOrder::Add($arFields2));
                        if ($ORDER_ID > 0) {
                            // заносим в свойства имя
                            $arField = array(
                                "ORDER_ID" => $ORDER_ID,
                                "ORDER_PROPS_ID" => 3,
                                "NAME" => "Имя",
                                "CODE" => "",
                                "VALUE" => $name
                            );
                            CSaleOrderPropsValue::Add($arField);
                            // заносим в свойства телефон
                            $arField = array(
                                "ORDER_ID" => $ORDER_ID,
                                "ORDER_PROPS_ID" => 5,
                                "NAME" => "Телефон",
                                "CODE" => "",
                                "VALUE" => $phone
                            );
                            CSaleOrderPropsValue::Add($arField);
                            // заносим в свойства местоположение
                            $arField = array(
                                "ORDER_ID" => $ORDER_ID,
                                "ORDER_PROPS_ID" => 17,
                                "NAME" => "LOCATION",
                                "CODE" => "",
                                "VALUE" => 1317,
                            );
                            CSaleOrderPropsValue::Add($arField);
                            $arField = array(
                                "ORDER_ID" => $ORDER_ID,
                                "ORDER_PROPS_ID" => 6,
                                "NAME" => "Ваш E-Mail",
                                "CODE" => "",
                                "VALUE" => $arResult["AUTHOR_MAIL"] ? $arResult["AUTHOR_MAIL"] : $USER->GetEmail(),
                            );
                            CSaleOrderPropsValue::Add($arField);
                            $arField = array(
                                "ORDER_ID" => $ORDER_ID,
                                "ORDER_PROPS_ID" => 18,
                                "NAME" => "Группа местоположений",
                                "CODE" => "",
                                "VALUE" => $locationPriceType,
                            );
                            CSaleOrderPropsValue::Add($arField);
                            if ($arResult['SETS'][$setName]["PRICE_WITH_DISCOUNT"] > 0) {
                                $price = $arResult['SETS'][$setName]["PRICE_WITH_DISCOUNT"];
                            }
                            $arProps = array();
                            CSaleBasket::DeleteAll(CSaleBasket::GetBasketUserID());
                            if ($setName == 'MASTER' || $setName == 'PROFI') {
                                foreach ($arResult['SETS'][$setName]['GOODS_ID'] as $k => $id) {
                                    $dum_p = print_r($arResult['SETS'][$setName], true);
                                    AddMessage2Log('massiv: ' . $dum_p);
                                    $res = CPrice::GetList(Array(), Array('PRODUCT_ID' => $id, 'CATALOG_GROUP_ID' => $__arPrice[$locationPriceType]['ID']));
                                    $price = $res->Fetch();
                                    $arPrice = CCatalogProduct::GetOptimalPrice(
                                        $id,
                                        1,
                                        Array(),
                                        'N',
                                        $price ? Array($price) : Array(),
                                        's1'
                                    );
                                    $buf = $arPrice['DISCOUNT_PRICE'];
                                    if (!$k)
                                        $buf -= $arResult['SETS'][$setName]['ECONOMY_'];
                                    $add = Add2BasketByProductID($id, $quantity_, Array(
                                        'CUSTOM_PRICE' => 'Y',
                                        'IGNORE_CALLBACK_FUNC' => 'Y',
                                        'PRICE' => $buf,
                                    ), Array());
                                }
                            } else {
                                $res = CPrice::GetList(Array(), Array('PRODUCT_ID' => $ar_res['ID'], 'CATALOG_GROUP_ID' => $__arPrice[$locationPriceType]['ID']));
                                $price = $res->Fetch();
                                Add2Basket($price['ID'], $quantity_);
                            }
                            CSaleBasket::OrderBasket($ORDER_ID);
                        }
                    }
                    else{
                        if ($arResult['SETS'][$setName]["PRICE_WITH_DISCOUNT"] > 0) {
                            $price = $arResult['SETS'][$setName]["PRICE_WITH_DISCOUNT"] * $arResult['SETS'][$setName]['QUANTITY'];
                        }
                        $order = Bitrix\Sale\Order::create(SITE_ID, IntVal($user_id));
                        $order->setPersonTypeId(1);
                        $order->setField('CURRENCY', "RUB");
                        $order->setField('USER_DESCRIPTION', $arParams["USER_DESCRIPTION"]);
                        
                        CSaleBasket::DeleteAll(CSaleBasket::GetBasketUserID());
                        
                        $basket = Bitrix\Sale\Basket::loadItemsForFUser(Bitrix\Sale\Fuser::getId(), SITE_ID);
                        /////
                        if (CModule::IncludeModule("iblock") &&  CModule::IncludeModule('sale') && CModule::IncludeModule("catalog"))
                        {
                            $locationPriceType = getLocationGroupPriceType();
                            $arPrice = CIBlockPriceTools::GetCatalogPrices(1, array($locationPriceType));
                            $mainGoodID = intval($arResult['PRODUCT_ID']);
                            $quantity = intval($arResult['QUANTITY']);
                            $setID = $_REQUEST['SET'];
                            $arSetsName = array('BASE', 'MASTER', 'PROFI');
                            $arSetsNameRu = array('Базовый комплект', 'комплект Мастер', 'комплект Профи');
                            $arFilter = array('IBLOCK_ID' => 1, 'ID' => $mainGoodID);
                            $arSelect = array(
                                'ID',
                                'NAME',
                                $arPrice[$locationPriceType]['SELECT'],
                                'DETAIL_PAGE_URL',
                                'PROPERTY_SET_' . $arSetsName[$setID],
                                'PROPERTY_SET_' . $arSetsName[$setID] . '_DISCOUNT',
                                "IBLOCK_ID",
                                "XML_ID"
                            );

                            $rsMainGood = CIBlockElement::GetList(array(), $arFilter, false, false, $arSelect);
                            $arSetGoodsID = array();

                            $mainProductInfo = $arMainGood = $rsMainGood->GetNext();

                            $setDiscountSelf = $arMainGood['PROPERTY_SET_' . $arSetsName[$setID] . '_DISCOUNT_VALUE'];
                            $mainGoodName = $arMainGood['NAME'];
                            $mainGoodURL = $arMainGood['DETAIL_PAGE_URL'];
                            $arSetGoodsID[] = $arMainGood['ID'];
                            if ($arMainGood['PROPERTY_SET_' . $arSetsName[$setID] . '_VALUE'] != '') {
                                $arSetGoodsID[] = $arMainGood['PROPERTY_SET_' . $arSetsName[$setID] . '_VALUE'];//в комплект первый из набора
                            }

                            while ($arMainGood = $rsMainGood->GetNext()) {
                                $arSetGoodsID[] = $arMainGood['PROPERTY_SET_' . $arSetsName[$setID] . '_VALUE'];
                            }
                            $arFilter = array('IBLOCK_ID' => 1, 'ID' => $arSetGoodsID);
                            $arSelect = array('ID', 'NAME', $arPrice[$locationPriceType]['SELECT'], 'DETAIL_PAGE_URL');

                            $rsGoodsInSet = CIBlockElement::GetList(array(), $arFilter, false, false, $arSelect);
                            $arGoods = array();
                            while ($arGoodsInSet = $rsGoodsInSet->GetNext()) {
                                $arGoodPrices = CIBlockPriceTools::GetItemPrices(1, $arPrice, $arGoodsInSet);
                                $arGoods[] = array
                                (
                                    'NAME' => $arGoodsInSet['NAME'],
                                    'ID' => $arGoodsInSet['ID'],
                                    'DETAIL_PAGE_URL' => $arGoodsInSet['DETAIL_PAGE_URL'],
                                    'PRICES' => $arGoodPrices
                                );
                            }
                            $arProps = array();
                            $SET_PRICE_WITHOUT_DISCOUNT = 0;
                            $SET_PRICE_WITH_DISCOUNT = 0;
                            $SET_DISCOUNT = 0;
                            if (!empty($setID) && isset($setID)) $arProps[] = array('NAME' => 'Комплектация', 'VALUE' => $arSetsNameRu[$setID], "SORT" => 1);
                            foreach ($arGoods as $index => $good) {
                                $arProps[] = array(
                                    'NAME' => "Товар №" . ($index + 1),
                                    'CODE' => "PRODUCT №" . ($index + 1),
                                    'VALUE' => $good['NAME'],
                                    'SORT' => ($index + 1) * 100
                                );
                                $SET_PRICE_WITHOUT_DISCOUNT += $good['PRICES'][$locationPriceType]['VALUE_VAT'];
                                $SET_PRICE_WITH_DISCOUNT += $good['PRICES'][$locationPriceType]['DISCOUNT_VALUE_VAT'];
                                $SET_DISCOUNT += $good['PRICES'][$locationPriceType]['DISCOUNT_DIFF'];
                            }
                            $SET_DISCOUNT += $setDiscountSelf; //сумма скидок товаров и скидка самого комплекта
                            $FINAL_PRICE = $SET_PRICE_WITHOUT_DISCOUNT - $SET_DISCOUNT;
                            $customPrice = "Y";

                            /*$arGoodForBasket = array(
                                "PRODUCT_ID" => $mainGoodID,
                                "PRICE" => $FINAL_PRICE,
                                "CURRENCY" => "RUB",
                                "QUANTITY" => $quantity,
                                "NAME" => $mainGoodName." (" . $arSetsNameRu[$setID] . ")",
                                "DETAIL_PAGE_URL" => $mainGoodURL,
                                "NOTES" => $setID . '_'.count($arGoods),
                                "LID" => LANG,
                                "BASE_PRICE" => $SET_PRICE_WITHOUT_DISCOUNT,
                                "DISCOUNT_PRICE" => $SET_DISCOUNT,
                                "DISCOUNT_NAME" => "Величина скидки за комплект",
                                "CAN_BUY" => "Y",
                                "MODULE" => "catalog",
                                ///"IGNORE_CALLBACK_FUNC" => $customPrice,
                               // "LAST_DISCOUNT" => $customPrice,
                                "CUSTOM_PRICE" => $customPrice,
                                "PROPS" => $arProps,
                                "PRODUCT_PROVIDER_CLASS" => "CCatalogProductProvider"
                            );
                            $strIBlockXmlID = (string)CIBlock::GetArrayByID($mainProductInfo['IBLOCK_ID'], 'XML_ID');
                            $arGoodForBasket["PRODUCT_XML_ID"] = $mainProductInfo['XML_ID'];
                            $arGoodForBasket["CATALOG_XML_ID"] = $strIBlockXmlID;
                            CSaleBasket::Add($arGoodForBasket);*/
                            $dbPrices = CPrice::GetList(
                                array(),
                                array( 
                                    "PRODUCT_ID" => $mainGoodID,
                                    "CATALOG_GROUP_ID" => 1
                                ),
                                false,
                                false,
                                array()
                            );
                            if($price = $dbPrices->Fetch())
                            {
                                $OffersCost = $price;
                            }
                            $strIBlockXmlID = (string)CIBlock::GetArrayByID($mainProductInfo['IBLOCK_ID'], 'XML_ID');
                            
                            $newItem = $basket->createItem("catalog", $mainGoodID);
                            $newItem->setFields(array(
                                'NAME' => $mainGoodName." (" . $arSetsNameRu[$setID] . ")", 
                                'PRODUCT_PRICE_ID' => $OffersCost['ID'], 
                                'PRICE_TYPE_ID' => $OffersCost['CATALOG_GROUP_ID'], 
                                'CURRENCY' => Bitrix\Main\Config\Option::get('sale', 'default_currency', 'RUB'),
                                'QUANTITY' => 1,
                                'BASE_PRICE' => $SET_PRICE_WITHOUT_DISCOUNT,
                                'DISCOUNT_PRICE' => $SET_DISCOUNT,
                                'DISCOUNT_NAME' => "Величина скидки за комплект",
                                'DETAIL_PAGE_URL' => $mainGoodURL,
                                'CATALOG_XML_ID' => $strIBlockXmlID,
                                'PRODUCT_XML_ID' => $mainProductInfo['XML_ID'],
                                'PRODUCT_PROVIDER_CLASS' => 'CCatalogProductProvider',
                                'LID' => SITE_ID,
                                "CUSTOM_PRICE" => $customPrice,
                            ));
                            $basketPropertyCollection = $newItem->getPropertyCollection();
                            $basketPropertyCollection->setProperty($arProps);
                            $newItem->save();    
                        }
                        
                        //$basket = Bitrix\Sale\Basket::loadItemsForFUser(Bitrix\Sale\Fuser::getId(), SITE_ID);
                        $basket->refreshData(array('PRICE', 'COUPONS'));
                        $order->setBasket($basket);
                        
                        $shipmentCollection = $order->getShipmentCollection();
                        
                        $service = \Bitrix\Sale\Delivery\Services\Manager::getObjectById(23);
                        $shipment = $shipmentCollection->createItem($service);
                        $shipmentItemCollection = $shipment->getShipmentItemCollection();
                        
                        foreach($shipmentCollection as $shipment)
                        {
                            if (!$shipment->isSystem())
                            {
                                foreach ($basket as $basketItem) 
                                {
                                    $item = $shipmentItemCollection->createItem($basketItem);
                                    $item->setQuantity($basketItem->getQuantity());
                                }  
                            }
                        }
                        
                        $paymentCollection = $order->getPaymentCollection();
                        $payment = $paymentCollection->createItem();
                        $paySystemService = Bitrix\Sale\PaySystem\Manager::getObjectById(1);
                        /**
                         * @var Bitrix\Sale\Payment $payment
                         */
                        $payment->setFields(array(
                            'PAY_SYSTEM_ID' => $paySystemService->getField("PAY_SYSTEM_ID"),
                            'PAY_SYSTEM_NAME' => $paySystemService->getField("NAME"),
                            'SUM' => $order->getPrice(),
                            'CURRENCY' => $order->getCurrency(),
                        ));

                        $propertyCollection = $order->getPropertyCollection();
                        $listObjProps = array();
                        $property = $propertyCollection->getItemByOrderPropertyId(3)->setValue($_REQUEST['user_name']);
                        $property = $propertyCollection->getItemByOrderPropertyId(5)->setValue(str_replace(array('+', ' ', '(' , ')', '-', '_'), '', $_REQUEST["user_phone"]));
                        $property = $propertyCollection->getItemByOrderPropertyId(6)->setValue($arResult["AUTHOR_MAIL"] ? $arResult["AUTHOR_MAIL"] : $USER->GetEmail());
                        //$property = $propertyCollection->getItemByOrderPropertyId(17)->setValue(1317);
                        $property = $propertyCollection->getItemByOrderPropertyId(17)->setValue('0000073738');
                        //$order->re
                        
                        $order->doFinalAction(true);
                        $result = $order->save();
                        $arResult["ORDER_ID"] = $order->getId();
                    }
                }
            }
            $arFieldz = array(
                'NAME' => $name,
                'PHONE' => $phone,
                'ORDER_ID' => $arResult["ORDER_ID"],
            );
            CEvent::Send('NEW_FAST_ORDER', SITE_ID, $arFieldz);
            $_SESSION["MF_NAME"] = htmlspecialcharsbx($_REQUEST["user_name"]);
            $_SESSION["MF_PHONE"] = htmlspecialcharsbx(str_replace(array('+', ' ', '(' , ')', '-', '_'), '', $_REQUEST["user_phone"]));
            $arResult["OK_MESSAGE"] = htmlspecialcharsbx(str_replace("#ORDER_ID#", $arResult['ORDER_ID'],$arParams["OK_TEXT"]));
        }
        $arResult["AUTHOR_NAME"] = htmlspecialcharsbx($_REQUEST["user_name"]);
        $arResult["PHONE"] = htmlspecialcharsbx(str_replace(array('+', ' ', '(' , ')', '-', '_'), '', $_REQUEST["user_phone"]));
    }
    else  $arResult["ERROR_MESSAGE"][] = GetMessage("MF_SESS_EXP");
}
$this->IncludeComponentTemplate();