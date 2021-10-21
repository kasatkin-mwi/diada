<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
//Make all properties present in order
//to prevent html table corruption

foreach($arResult["ITEMS"] as $key => &$arElement)
{
    $arElement['SECOND_PICTURE'] = array();
    if(!empty($arElement['PROPERTIES']['ADD_PHOTOS']['VALUE']))
    {
        $img = current($arElement['PROPERTIES']['ADD_PHOTOS']['VALUE']);
        $arElement['SECOND_PICTURE'] = CFile::ResizeImageGet($img, array("width" => 250, "height" => 135), BX_RESIZE_IMAGE_PROPORTIONAL, true);
    }
    
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

//массив для сортировки по скидкам - задача №18238 пункт №6
$arResult['PRICES_WITH_DISCOUNT'] = array();

$productsIds = array();
foreach($arResult["ITEMS"] as $key => $arElement)
{
	$arRes = array();
    $productsIds[] = $arElement['ID'];
	foreach($arParams["PROPERTY_CODE"] as $pid)
	{
		$arRes[$pid] = CIBlockFormatProperties::GetDisplayValue($arElement, $arElement["PROPERTIES"][$pid], "catalog_out");
	}
	$arResult["ITEMS"][$key]["DISPLAY_PROPERTIES"] = $arRes;
	
	$arResult['PRICES_WITH_DISCOUNT'][$key] = $arElement['PRICES']['base']['DISCOUNT_VALUE'];
}

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
/*
if(!empty($productsIds) && $arResult['SHOW_INFO'])
{
    $arElementStores = array();
    $rsStore = CCatalogStore::GetList(
        array('SORT' => 'ASC'),
        array(
            'ACTIVE' => 'Y', 
            'PRODUCT_ID' => $productsIds
        ),
        false,
        false,
        array("ID","TITLE","ACTIVE","PRODUCT_AMOUNT","ELEMENT_ID")
    );
    while ($arStore = $rsStore->Fetch())
    {
        if(intval($arStore['ELEMENT_ID']) > 0)
        {
            $arElementStores[$arStore['ELEMENT_ID']][] = $arStore;
        }
    }
    unset($arStore, $rsStore);    
    
    foreach($arResult["ITEMS"] as $key => &$arElement)
    {
        if(!empty($arElementStores[$arElement['ID']]))
        {
           $arElement['STORES'] = $arElementStores[$arElement['ID']];    
        }   
    }
    unset($arElement, $arElementStores);
    
    foreach($arResult["ITEMS"] as $key => &$arElement)
    {
        $arSores = array();
        foreach($arElement["STORES"] as $store)
        { 
            if($store["ID"] == 3)
            {
                $arSores[] = $store;
                break;        
            }
        }

        foreach($arElement["STORES"] as $store)
        {
            if($store["PRODUCT_AMOUNT"] > 0 && $store["ID"] != 3)
            {
                $arSores[] = $store;
            }
        }
        $arElement["STORES"] = $arSores;
    }
    unset($arElement);
}
*/

//Выбрана сортировка по цене и в параметрах USE_DISCOUNT_SORT='Y', делаем сортировку по скидкам
if(strpos($arParams['ELEMENT_SORT_FIELD'],'CATALOG_PRICE')!==false && $arParams['USE_DISCOUNT_SORT']=='Y')
{
	if($arParams['ELEMENT_SORT_ORDER']=='asc')
		asort($arResult['PRICES_WITH_DISCOUNT']);
	else
		arsort($arResult['PRICES_WITH_DISCOUNT']);
}	
?>