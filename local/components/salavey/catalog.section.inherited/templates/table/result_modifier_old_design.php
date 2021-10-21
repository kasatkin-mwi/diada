<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();

$arFilter = array(
    "IBLOCK_ID" => $arParams["IBLOCK_ID"],
    "IBLOCK_LID" => SITE_ID,
    "ACTIVE_DATE" => "Y",
    "ACTIVE" => "Y",
    "CHECK_PERMISSIONS" => "Y",
    "MIN_PERMISSION" => "R",
    "INCLUDE_SUBSECTIONS" => ($arParams["INCLUDE_SUBSECTIONS"] == 'N' ? 'N' : 'Y'),
    "SECTION_ID" => $arResult["ID"]
);
if ($arParams['HIDE_NOT_AVAILABLE'] == 'Y')
    $arFilter['CATALOG_AVAILABLE'] = 'Y';

$obElement = CIBlockElement::GetList(
    array('CATALOG_PRICE_1' => 'asc'), 
    $arFilter,
    false,
    array('nTopCount' => 1),
    array('ID', 'IBLOCK_ID', 'NAME')
);
if($arElement = $obElement->GetNext())
{
    $arElement["PRICES"] = CIBlockPriceTools::GetItemPrices($arParams["IBLOCK_ID"], $arResult["PRICES"], $arElement, $arParams['PRICE_VAT_INCLUDE'], array());
    if (!empty($arElement['PRICES']))
        $arElement['MIN_PRICE'] = CIBlockPriceTools::getMinPriceFromList($arElement['PRICES']);
    
    if($arElement['MIN_PRICE']["DISCOUNT_VALUE"] < $arElement['MIN_PRICE']["VALUE"])
    {
        $arResult['lowPrice'] = $arElement['MIN_PRICE']['DISCOUNT_VALUE'];
    }
    else
    {
        $arResult['lowPrice'] = $arElement['MIN_PRICE']['VALUE'];
    }
}
unset($obElement,$arElement);
    
$obElement = CIBlockElement::GetList(
    array('CATALOG_PRICE_1' => 'desc'), 
    $arFilter,
    false,
    array('nTopCount' => 1),
    array('ID', 'IBLOCK_ID', 'NAME')
);
if($arElement = $obElement->GetNext())
{
    $arElement["PRICES"] = CIBlockPriceTools::GetItemPrices($arParams["IBLOCK_ID"], $arResult["PRICES"], $arElement, $arParams['PRICE_VAT_INCLUDE'], array());
    if (!empty($arElement['PRICES']))
        $arElement['MIN_PRICE'] = CIBlockPriceTools::getMinPriceFromList($arElement['PRICES']);
    
    if($arElement['MIN_PRICE']["DISCOUNT_VALUE"] < $arElement['MIN_PRICE']["VALUE"])
    {
        $arResult['highPrice'] = $arElement['MIN_PRICE']['DISCOUNT_VALUE'];
    }
    else
    {
        $arResult['highPrice'] = $arElement['MIN_PRICE']['VALUE'];
    }
}
unset($obElement,$arElement);

$itemsIds = array(); 
$obElement = CIBlockElement::GetList(
    array(), 
    $arFilter,
    false,
    false,
    array('ID')
);
while($arElement = $obElement->GetNext())
{
    $itemsIds[] = $arElement['ID'];    
}
unset($obElement,$arElement);

$iCounterReviews = 0;
$sumReiting = 0;
if(!empty($itemsIds))
{
    $obReview = CIBlockElement::GetList(
        array(), 
        array(
            "IBLOCK_ID" => 28, 
            "ACTIVE" => "Y", 
            "PROPERTY_TOVAR" => $itemsIds
        ),
        array('PROPERTY_OCENKA'),
        false,
        array(
            'ID',
            "PROPERTY_OCENKA"
        )
    );
    while($arReview = $obReview->GetNext())
    {     
        $iCounterReviews += $arReview['CNT'];
        $sumReiting += $arReview['PROPERTY_OCENKA_VALUE'];      
    }
    unset($obReview, $arReview);    
}


if ($sumReiting && $iCounterReviews) 
{
    $setReiting = round($sumReiting / $iCounterReviews,2);
}
else
{
    $setReiting = 0;
}
if($setReiting < 1)
{
    $setReiting = 1;
}
$arResult['ratingValue'] = $setReiting;
$arResult['reviewCount'] = $iCounterReviews;

//массив для сортировки по скидкам - задача №18238 пункт №6
$arResult['PRICES_WITH_DISCOUNT'] = array();

foreach($arResult["ITEMS"] as $key => $arElement)	
	$arResult['PRICES_WITH_DISCOUNT'][$key] = $arElement['PRICES']['base']['DISCOUNT_VALUE'];

//Выбрана сортировка по цене и в параметрах USE_DISCOUNT_SORT='Y', делаем сортировку по скидкам
if(strpos($arParams['ELEMENT_SORT_FIELD'],'CATALOG_PRICE')!==false && $arParams['USE_DISCOUNT_SORT']=='Y')
{
	if($arParams['ELEMENT_SORT_ORDER']=='asc')
		asort($arResult['PRICES_WITH_DISCOUNT']);
	else
		arsort($arResult['PRICES_WITH_DISCOUNT']);
}	
?>