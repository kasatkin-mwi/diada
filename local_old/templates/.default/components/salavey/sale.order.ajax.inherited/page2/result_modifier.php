<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

/**
 * @var array $arParams
 * @var array $arResult
 * @var SaleOrderAjax $component
 */ 
$component = $this->__component;
$component::scaleImages($arResult['JS_DATA'], $arParams['SERVICES_IMAGES_SCALING']);
$idLocationUser = $GLOBALS["APPLICATION"]->get_cookie('locationId'); 
if ($idLocationUser>0) {
    foreach ($arResult["ORDER_PROP"]["USER_PROPS_N"] as $key => $propUser) {
        if ($propUser["IS_LOCATION"] == "Y") {
            $arResult["ORDER_PROP"]["USER_PROPS_N"][$key]["VALUE"] = $idLocationUser;
            $arResult["ORDER_PROP"]["USER_PROPS_N"][$key]["DEFAULT_VALUE"] = $idLocationUser;
            $arResult["ORDER_PROP"]["USER_PROPS_N"][$key]["~VALUE"] = $idLocationUser;
            $arResult["ORDER_PROP"]["USER_PROPS_N"][$key]["~DEFAULT_VALUE"] = $idLocationUser;
        }
    }
}

$arOldPrice = 0;
$showOldPrice = 0;
foreach($arResult["BASKET_ITEMS"] as $item)
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
    $arResult['JS_DATA']['TOTAL']['PRICE_WITHOUT_DISCOUNT_VALUE'] = $arOldPrice;
    $arResult['JS_DATA']['TOTAL']['PRICE_WITHOUT_DISCOUNT'] = SaleFormatCurrency($arOldPrice, $arResult["BASE_LANG_CURRENCY"]);
    
    $arResult['JS_DATA']['TOTAL']['DISCOUNT_PRICE'] = $arResult['JS_DATA']['TOTAL']['PRICE_WITHOUT_DISCOUNT_VALUE'] - $arResult['JS_DATA']['TOTAL']["ORDER_PRICE"];
    $arResult['JS_DATA']['TOTAL']['DISCOUNT_PRICE_FORMATED'] = SaleFormatCurrency($arResult['JS_DATA']['TOTAL']['DISCOUNT_PRICE'], $arResult["BASE_LANG_CURRENCY"]);
} 
?>