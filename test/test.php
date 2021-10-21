<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("");?>

<?
\Bitrix\Main\Loader::includeModule("sale");
\Bitrix\Main\Loader::includeModule("iblock");
$phone_number = '79533118815';
$userResult = getUserByPhone($phone_number);
if(isset($userResult['ID']) && intval($userResult['ID']) > 0)
{
    $orderUserId = $userResult['ID'];   
}

if(intval($orderUserId) <= 0)
{
    $defGroup = Bitrix\Main\Config\Option::get('main', 'new_user_registration_def_group', '');
    if (!empty($defGroup))
    {
        $groupId = explode(',', $defGroup);
        $arPolicy = $USER->GetGroupPolicy($groupId);
    }
    else
    {
        $groupId = false;
        $arPolicy = $USER->GetGroupPolicy(array());
    }

    $passwordMinLength = (int)$arPolicy['PASSWORD_LENGTH'];
    if ($passwordMinLength <= 0)
    {
        $passwordMinLength = 6;
    }

    $passwordChars = array(
        'abcdefghijklnmopqrstuvwxyz',
        'ABCDEFGHIJKLNMOPQRSTUVWXYZ',
        '0123456789',
    );
    if ($arPolicy['PASSWORD_PUNCTUATION'] === 'Y')
    {
        $passwordChars[] = ",.<>/?;:'\"[]{}\|`~!@#\$%^&*()-_+=";
    }

    $newPassword = $newPasswordConfirm = randString($passwordMinLength + 2, $passwordChars);
    $email = 'auto_1579773653@diada-email.ru';
    if(preg_match("/^auto_(\d+)@diada-email.ru/", $email))
    {
        $email = "auto_".time().rand(5)."@diada-email.ru"; 
    }
    $user = new CUser;
    $arAuthResult = $user->Add(array(
        'LOGIN' => $email,
        'NAME' => $newName,
        'LAST_NAME' => $newLastName,
        'PASSWORD' => $newPassword,
        'CONFIRM_PASSWORD' => $newPasswordConfirm,
        'EMAIL' => $email,
        'GROUP_ID' => $groupId,
        'ACTIVE' => 'Y',
        'LID' => 's1',
        'PERSONAL_PHONE' => $phone_number,
    ));
    
    if($_SERVER['REMOTE_ADDR'] == '109.86.1.53')
    {
        echo '<pre>'; echo '<br>'; var_export($arAuthResult); echo '</pre>';     
        echo '<pre>'; echo '<br>'; var_export($user->LAST_ERROR); echo '</pre>';     
    }
    die;
    if(intval($arAuthResult) > 0)
    {
        $orderUserId = intval($arAuthResult);    
    }
    else
    {

    }
}

die;
$arFields["PRODUCT_ID"] = 2576;
//$arFields["PRODUCT_ID"] = 2584;
$arFields["AMOUNT"] = 0;
$obElement = CIBlockElement::GetList(
    array(), 
    array(
        'ID' => $arFields["PRODUCT_ID"] 
    ), 
    false, 
    false, 
    array(
        'ID',
        'PROPERTY_INDIKATOR',
        'PROPERTY_SHOW_AVAILABLE'
    )
);
if($arElement = $obElement->Fetch())
{
    if (!empty($arElement['PROPERTY_SHOW_AVAILABLE_VALUE']))
    {
        if($arFields["AMOUNT"] <= 0)
        {
            //CIBlockElement::SetPropertyValuesEx($arFields["PRODUCT_ID"], false, Array('INDIKATOR' => 28));
            //echo '<pre>'; echo '<br>'; var_export(28); echo '</pre>'; die;       
        }
    }
    else
    {
        if (in_array($arElement['PROPERTY_INDIKATOR_ENUM_ID'], array(27, 29)) || $arFields["AMOUNT"] > 0)
        {
            //CIBlockElement::SetPropertyValuesEx($arFields["PRODUCT_ID"], false, Array('INDIKATOR' => $arFields["AMOUNT"] > 0 ? 27 : 29));
        }    
    }
}

die;

$basket = Bitrix\Sale\Basket::loadItemsForFUser(Bitrix\Sale\Fuser::getId(), Bitrix\Main\Context::getCurrent()->getSite());
$currencyCode = Bitrix\Main\Config\Option::get('sale', 'default_currency', 'RUB');
$arBasketProductsId = array();
$productsDiscounts = array();

foreach ($basket as $basketItem) 
{
    $basketPropertyCollection = $basketItem->getPropertyCollection();
    $itemsDiscount[$basketItem->getId()] = 0;
    
    $arProductInfo = array();
    
    foreach ($basketPropertyCollection as $propertyItem) 
    {
        $propName = $propertyItem->getField('NAME');
        $code = $propertyItem->getField('CODE');
        $value = $propertyItem->getField('VALUE');
        
        if($propName == 'Комплектация')
        {
            $obItem = CIBlockElement::GetList(
                array(), 
                array(
                    'ID' => $basketItem->getProductId()
                ), 
                false, 
                array('nTopCount' => 1), 
                array(
                    'ID', 
                    'NAME',
                    'IBLOCK_ID',
                    'PROPERTY_SET_BASE_DISCOUNT',
                    'PROPERTY_SET_MASTER_DISCOUNT',
                    'PROPERTY_SET_PROFI_DISCOUNT',
                )
            );
            if($arItem = $obItem->GetNext())
            {
                $arProductInfo = $arItem;    
            }
            
            if(preg_match('/^комплект Мастер/', $value))
            {
                $itemsDiscount[$basketItem->getId()] = intval($arProductInfo['PROPERTY_SET_MASTER_DISCOUNT_VALUE']);   
            }
            elseif(preg_match('/^комплект Профи/', $value))
            {
                $itemsDiscount[$basketItem->getId()] = intval($arProductInfo['PROPERTY_SET_PROFI_DISCOUNT_VALUE']);     
            }
            else
            {
                $itemsDiscount[$basketItem->getId()] = intval($arProductInfo['PROPERTY_SET_BASE_DISCOUNT_VALUE']);   
            }
            
            $propertyItem->delete();    
        }
    }
    foreach ($basketPropertyCollection as $propertyItem) 
    {
        $code = $propertyItem->getField('CODE');
        $value = $propertyItem->getField('VALUE');
        echo '<pre>'; echo '<br>'; var_export($value); echo '</pre>';
        if(preg_match('/^PRODUCT/', $code))
        {
            $obItem = CIBlockElement::GetList(
                array(), 
                array(
                    '=NAME' => str_replace('&quot;', '"', trim($value)),
                    'IBLOCK_ID' => $arProductInfo['IBLOCK_ID']
                ), 
                false, 
                array('nTopCount' => 1), 
                array(
                    'ID', 
                    'NAME',
                    'IBLOCK_ID',
                    'DETAIL_PAGE_URL',
                    'IBLOCK_EXTERNAL_ID',
                    'EXTERNAL_ID',
                )
            );
            if($arItem = $obItem->GetNext())
            {
                if($arItem['ID'] != $basketItem->getProductId())
                {
                    $url = CAllIBlock::ReplaceDetailUrl($arItem['DETAIL_PAGE_URL'], $arItem, false, 'E');
                    $newItem = $basket->createItem("catalog", $arItem['ID']);
                    
                    $dbPrices = CPrice::GetList(
                        array(),
                        array( 
                            "PRODUCT_ID" => $arItem['ID'],
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
                    
                    //$newItem->setFields(array(
//                        'NAME' => $arItem['NAME'], 
//                        'PRODUCT_PRICE_ID' => $OffersCost['ID'], 
//                        'PRICE_TYPE_ID' => $OffersCost['CATALOG_GROUP_ID'], 
//                        'CURRENCY' => $currencyCode,
//                        'QUANTITY' => 1,
//                        'DETAIL_PAGE_URL' => $url,
//                        'CATALOG_XML_ID' => $arItem['CATALOG_XML_ID'],
//                        'PRODUCT_XML_ID' => $arItem['EXTERNAL_ID'],
//                        'PRODUCT_PROVIDER_CLASS' => 'CCatalogProductProvider',
//                        'LID' => SITE_ID,
//                    ));
//                    $newItem->save();
//                    $arBasketProductsId[] = $newItem->getProductId();
//                    $productsDiscounts[$basketItem->getId()][] = $newItem->getId();
                    echo '<pre>'; echo '<br>'; var_export($arItem['NAME']); echo '</pre>';
                }                            
            }
            //$propertyItem->delete();
        }
    }
}

/*foreach ($basket as $basketItem) 
{
    if(!in_array($basketItem->getProductId(),$arBasketProductsId) && isset($itemsDiscount[$basketItem->getId()]))
    {
        $price = $basketItem->getPrice();
        
        $basketItem->setFields(array(
            'CUSTOM_PRICE' => 'N',
            'IGNORE_CALLBACK_FUNC' => 'N'
        ));    
    }
}*/
?>

<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>