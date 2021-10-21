<?
$productsIds = array();
$productBaseSet = array();
$setProducts = array();
$arSetProducts = array();

foreach($arResult["ITEMS"] as $key => &$arElement)
{
    $productsIds[] = $arElement['ID'];
    
    if(!empty($arElement['PROPERTIES']['SET_BASE']['VALUE']))
    {       
        $productBaseSet[$arElement['ID']] = $arElement['PROPERTIES']['SET_BASE']['VALUE'];
        foreach($arElement['PROPERTIES']['SET_BASE']['VALUE'] as $baseSet)
        {    
            if(!in_array($baseSet, $setProducts))
            {
                $setProducts[] = $baseSet;    
            }
        }
    }
}
unset($arElement);

if(!empty($setProducts))
{    
    $arFilter = array(
        'IBLOCK_ID' => $arParams['IBLOCK_ID'],
        'ID' => $setProducts
    );
    $arSelect = array(
        'ID',
        'IBLOCK_ID',
        'NAME'
    );
    
    foreach($arResult["PRICES"] as &$value)
    {
        if (!$value['CAN_VIEW'] && !$value['CAN_BUY'])
            continue;
        $arSelect[] = $value["SELECT"];
        $arFilter["CATALOG_SHOP_QUANTITY_".$value["ID"]] = $arParams["SHOW_PRICE_COUNT"];
    }
    if (isset($value))
        unset($value);
    
    $obElement = CIBlockElement::GetList(
        array(), 
        $arFilter, 
        false, 
        false, 
        $arSelect
    );
    while($arElement = $obElement->GetNext())
    {
        $arElement["PRICES"] = CIBlockPriceTools::GetItemPrices($arParams["IBLOCK_ID"], $arResult["PRICES"], $arElement, $arParams['PRICE_VAT_INCLUDE'], array());
        if (!empty($arElement['PRICES']))
            $arElement['MIN_PRICE'] = CIBlockPriceTools::getMinPriceFromList($arElement['PRICES']);
        
        $arSetProducts[$arElement['ID']] = $arElement;
    }
    unset($arElement, $obElement, $setProducts);
}

foreach($arResult["ITEMS"] as $key => &$arElement)
{   
    if(!empty($productBaseSet[$arElement['ID']]))
    {   
        $arElement['CUSTOM_PRICE'] = 0;
        $arElement['CUSTOM_DISCOUNT_PRICE'] = 0;
        foreach($productBaseSet[$arElement['ID']] as $productId)
        {
            if(!empty($arSetProducts[$productId]))
            {
                $arElement['CUSTOM_PRICE'] += $arSetProducts[$productId]['MIN_PRICE']['VALUE'];
                $arElement['CUSTOM_DISCOUNT_PRICE'] += $arSetProducts[$productId]['MIN_PRICE']['DISCOUNT_VALUE'];
            }
        }
        
        if($arElement['CUSTOM_PRICE'] > 0)
        {
            $arElement['CUSTOM_PRICE'] += $arElement['MIN_PRICE']['VALUE'];
            $arElement['CUSTOM_DISCOUNT_PRICE'] += $arElement['MIN_PRICE']['DISCOUNT_VALUE'];
            $arElement['PRINT_CUSTOM_PRICE'] = CurrencyFormat($arElement['CUSTOM_PRICE'], Bitrix\Main\Config\Option::get('sale', 'default_currency', 'RUB'));
            $arElement['PRINT_CUSTOM_DISCOUNT_PRICE'] = CurrencyFormat($arElement['CUSTOM_DISCOUNT_PRICE'], Bitrix\Main\Config\Option::get('sale', 'default_currency', 'RUB'));
        }
    }
}
unset($arElement, $arSetProducts, $productBaseSet);

$arAvailableGroups = array(1,12,16,20);
$arGroups = $USER->GetUserGroupArray();
$arResult['SHOW_INFO'] = false;
foreach($arAvailableGroups as $group)
{
    if(in_array($group,$arGroups))
    {
        $arResult['SHOW_INFO'] = true;
    }
}
?>