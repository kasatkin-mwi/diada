<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>

<?
$summa = 0;
$arReturn = Array();
$arReturn["ITEMS"][$arParams["UNSET_PRODUCT"]] = NULL;
$discountProduct = 0;
foreach($arResult['ITEMS'] as $arItem):
	//echo "<pre>";print_r($arItem);echo "</pre>";
	$arPrice = $arItem['PRICES'][ $arParams['PRICE_CODE'][0] ];
	$price = $arPrice['VALUE'];
    $discount = $arPrice['VALUE']-$arPrice['DISCOUNT_VALUE'];
	//$arReturn['SUMMA'] += $price;

    if(!empty($arItem['PREVIEW_PICTURE']["ID"]) && intval($arItem['PREVIEW_PICTURE']["ID"]) > 0)
    {
        $img = CFile::ResizeImageGet($arItem['PREVIEW_PICTURE']["ID"], array('width' => 57, 'height' => 53), BX_RESIZE_IMAGE_PROPORTIONAL, true);    
    }
    elseif(intval($arItem['PREVIEW_PICTURE']) > 0)
    {
        $img = CFile::ResizeImageGet($arItem['PREVIEW_PICTURE']["ID"], array('width' => 57, 'height' => 53), BX_RESIZE_IMAGE_PROPORTIONAL, true);   
    }
    
	$arReturn["ITEMS"][ $arItem['ID'] ] = Array(
		"ID" => $arItem['ID'],
		"NAME" => $arItem['NAME'],
		"URL" => $arItem['DETAIL_PAGE_URL'],
		"IMG" => !empty($img["src"]) ? $img["src"] : $arItem['PREVIEW_PICTURE']['SRC'],
		"PRICE" => $price,
        "DISCOUNT" => $discount
	);
    
	if ($arParams["UNSET_PRODUCT"] == $arItem['ID']){
        $arReturn["ITEMS"][ $arItem['ID'] ]["UNSET_LINK"] = true;
    }

endforeach;
echo json_encode($arReturn);
?>