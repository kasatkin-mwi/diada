<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

foreach($arResult["ITEMS"] as $key => &$arElement)
{
    
    $arElement['SECOND_PICTURE'] = array();
    if(!empty($arElement['PROPERTIES']['ADD_PHOTOS']['VALUE']))
    {
        $img = current($arElement['PROPERTIES']['ADD_PHOTOS']['VALUE']);
        $arElement['SECOND_PICTURE'] = CFile::ResizeImageGet($img, array("width" => 250, "height" => 135), BX_RESIZE_IMAGE_PROPORTIONAL, true);
    }
}
unset($arElement);

//Make all properties present in order
//to prevent html table corruption
foreach($arResult["ITEMS"] as $key => $arElement)
{
	$arRes = array();
	foreach($arParams["PROPERTY_CODE"] as $pid)
	{
		$arRes[$pid] = CIBlockFormatProperties::GetDisplayValue($arElement, $arElement["PROPERTIES"][$pid], "catalog_out");
	}
	$arResult["ITEMS"][$key]["DISPLAY_PROPERTIES"] = $arRes;
}
?>