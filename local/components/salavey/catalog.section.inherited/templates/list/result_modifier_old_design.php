<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
//Make all properties present in order
//to prevent html table corruption

//массив для сортировки по скидкам - задача №18238 пункт №6
$arResult['PRICES_WITH_DISCOUNT'] = array();

foreach($arResult["ITEMS"] as $key => $arElement)
{
	$arRes = array();
	foreach($arParams["PROPERTY_CODE"] as $pid)
	{
		$arRes[$pid] = CIBlockFormatProperties::GetDisplayValue($arElement, $arElement["PROPERTIES"][$pid], "catalog_out");
	}
	$arResult["ITEMS"][$key]["DISPLAY_PROPERTIES"] = $arRes;
	
	$arResult['PRICES_WITH_DISCOUNT'][$key] = $arElement['PRICES']['base']['DISCOUNT_VALUE'];
}

//Выбрана сортировка по цене и в параметрах USE_DISCOUNT_SORT='Y', делаем сортировку по скидкам
if(strpos($arParams['ELEMENT_SORT_FIELD'],'CATALOG_PRICE')!==false && $arParams['USE_DISCOUNT_SORT']=='Y')
{
	if($arParams['ELEMENT_SORT_ORDER']=='asc')
		asort($arResult['PRICES_WITH_DISCOUNT']);
	else
		arsort($arResult['PRICES_WITH_DISCOUNT']);
}	
?>