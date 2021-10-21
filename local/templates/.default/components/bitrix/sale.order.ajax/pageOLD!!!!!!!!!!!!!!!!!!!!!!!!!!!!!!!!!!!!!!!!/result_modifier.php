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
?>