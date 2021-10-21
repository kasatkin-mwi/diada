<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Распродажа");
global $DB;
global $USER;
\Bitrix\Main\Loader::includeModule("sale");
\Bitrix\Main\Loader::includeModule("catalog");
\Bitrix\Main\Loader::includeModule("iblock");
CTimeZone::Disable();
$currentDatetime = new Bitrix\Main\Type\DateTime();
$filterDiscount = array(
    "ACTIVE" => "Y",
	"USE_COUPONS" => "N",
    array(
        'LOGIC' => 'OR', 
        'ACTIVE_FROM' => '', 
        '<=ACTIVE_FROM' => $currentDatetime
    ), 
    array(
        'LOGIC' => 'OR', 
        'ACTIVE_TO' => '', 
        '>=ACTIVE_TO' => $currentDatetime
    )
);
$dbProductDiscounts = Bitrix\Sale\Internals\DiscountTable::getList(array("filter" => $filterDiscount));
$listDiscountProduct["ELEMENT"] = array();
$listDiscountProduct["SECTION"] = array();
function SetDiscountProductList($data,&$listDiscountProduct,$infoDiscount){
    if ($data["DATA"]["value"][0]>0) {
        if ($data["CLASS_ID"] == "CondGroup") {
            $listDiscountProduct["SECTION"][] = $data["DATA"]["value"][0];
        }
        if ($data["CLASS_ID"] == "CondIBElement") 
        {   
            $listDiscountProduct["ELEMENT"][] = $data["DATA"]["value"][0];
        }
    }
}
while ($infoDiscount = $dbProductDiscounts->fetch()){
	$condition = $infoDiscount["CONDITIONS_LIST"];
    
	while (isset($condition) && count($condition)>0){
        SetDiscountProductList($condition,$listDiscountProduct,$infoDiscount);
        $condition = $condition["CHILDREN"][0];
	}
}
CTimeZone::Enable();
$GLOBALS['arFilt'] = array('ID'=>$listDiscountProduct["ELEMENT"]);
$GLOBALS['arrFilter'] = array('ID'=>$listDiscountProduct["ELEMENT"]);
if (empty($listDiscountProduct["ELEMENT"]))
{
    $GLOBALS['arFilt'] = array('ID'=>0);
    $GLOBALS['arrFilter'] = array('ID'=>0);
}
$GLOBALS['arrFilter'] = array('!PROPERTY_oldprice'=>false);

?>
<div class="content">
	<div class="left_column">
		<a class="filter_button_block js_filter_button_block display_none_c" href="">ФИЛЬТР</a>
		<div class="filter_block js_filter_block">
			<div class="filter_position_block">
				<?$APPLICATION->IncludeComponent(
					"bitrix:catalog.smart.filter",
					"",
					Array(
						"CACHE_GROUPS" => "N",
						"CACHE_TIME" => 3600000,
						"CACHE_TYPE" => "A",
						"CONVERT_CURRENCY" => "N",
						"CURRENCY_ID" => $arParams['CURRENCY_ID'],
						"DISPLAY_ELEMENT_COUNT" => "Y",
						"FILTER_NAME" => "arrFilter",
						"FILTER_VIEW_MODE" => "VERTICAL",
						"HIDE_NOT_AVAILABLE" => "N",
						"IBLOCK_ID" => "1",
						"IBLOCK_TYPE" => "ibCatalog",
						"INSTANT_RELOAD" => "N",
						"PAGER_PARAMS_NAME" => $arParams["PAGER_PARAMS_NAME"],
						"POPUP_POSITION" => "right",
						"PRICE_CODE" => array("base"),
						"SAVE_IN_SESSION" => "N",
						"SECTION_CODE" => "",
						"SECTION_DESCRIPTION" => "DESCRIPTION",
						"SECTION_ID" => "",
						"SECTION_TITLE" => "NAME",
						"SEF_MODE" => "N",
						"SEF_RULE" => $arResult["FOLDER"].$arResult["URL_TEMPLATES"]["smart_filter"],
						"SHOW_THIS_LIST" => array(
							0 => 5184, // свойство "тип товара"
						),
						"SMART_FILTER_PATH" => $arResult["VARIABLES"]["SMART_FILTER_PATH"],
						"TEMPLATE_THEME" => $arParams["TEMPLATE_THEME"],
						"XML_EXPORT" => "Y"
					),
					$component,
					Array(
						'HIDE_ICONS' => 'Y'
					)
				);?>
			</div>
		</div>
	</div>
	<div class="center_column">
		<?/*$APPLICATION->IncludeComponent(
			"bitrix:news.list",
			"current_promotions",
			Array(
				"ACTIVE_DATE_FORMAT" => "d.m.Y",
				"ADD_SECTIONS_CHAIN" => "Y",
				"AJAX_MODE" => "N",
				"AJAX_OPTION_ADDITIONAL" => "",
				"AJAX_OPTION_HISTORY" => "N",
				"AJAX_OPTION_JUMP" => "N",
				"AJAX_OPTION_STYLE" => "Y",
				"CACHE_FILTER" => "N",
				"CACHE_GROUPS" => "Y",
				"CACHE_TIME" => "36000000",
				"CACHE_TYPE" => "A",
				"CHECK_DATES" => "Y",
				"COMPOSITE_FRAME_MODE" => "A",
				"COMPOSITE_FRAME_TYPE" => "AUTO",
				"DETAIL_URL" => "",
				"DISPLAY_BOTTOM_PAGER" => "N",
				"DISPLAY_DATE" => "Y",
				"DISPLAY_NAME" => "Y",
				"DISPLAY_PICTURE" => "Y",
				"DISPLAY_PREVIEW_TEXT" => "Y",
				"DISPLAY_TOP_PAGER" => "N",
				"FIELD_CODE" => array("",""),
				"FILTER_NAME" => "",
				"HIDE_LINK_WHEN_NO_DETAIL" => "N",
				"IBLOCK_ID" => "39",
				"IBLOCK_TYPE" => "akcii",
				"INCLUDE_IBLOCK_INTO_CHAIN" => "N",
				"INCLUDE_SUBSECTIONS" => "N",
				"MESSAGE_404" => "",
				"NEWS_COUNT" => "20",
				"PAGER_BASE_LINK_ENABLE" => "N",
				"PAGER_DESC_NUMBERING" => "N",
				"PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
				"PAGER_SHOW_ALL" => "N",
				"PAGER_SHOW_ALWAYS" => "N",
				"PAGER_TEMPLATE" => ".default",
				"PAGER_TITLE" => "Новости",
				"PARENT_SECTION" => "",
				"PARENT_SECTION_CODE" => "",
				"PREVIEW_TRUNCATE_LEN" => "",
				"PROPERTY_CODE" => array("BUTTON_URL","BUTTON_TEXT",""),
				"SET_BROWSER_TITLE" => "N",
				"SET_LAST_MODIFIED" => "N",
				"SET_META_DESCRIPTION" => "N",
				"SET_META_KEYWORDS" => "N",
				"SET_STATUS_404" => "N",
				"SET_TITLE" => "N",
				"SHOW_404" => "N",
				"SORT_BY1" => "SORT",
				"SORT_BY2" => "ACTIVE_FROM",
				"SORT_ORDER1" => "ASC",
				"SORT_ORDER2" => "ASC",
				"STRICT_SECTION_CHECK" => "N"
			)
		);*/?>
		<h1>Распродажа</h1>
		<?$APPLICATION->IncludeComponent(
			"salavey:catalog.section.inherited", 
			"index_hit", 
			array(
				"ACTION_VARIABLE" => "action",
				"ADD_PICT_PROP" => "-",
				"ADD_PROPERTIES_TO_BASKET" => "Y",
				"ADD_SECTIONS_CHAIN" => "N",
				"ADD_TO_BASKET_ACTION" => "ADD",
				"AJAX_MODE" => "N",
				"AJAX_OPTION_ADDITIONAL" => "",
				"AJAX_OPTION_HISTORY" => "N",
				"AJAX_OPTION_JUMP" => "N",
				"AJAX_OPTION_STYLE" => "Y",
				"BACKGROUND_IMAGE" => "-",
				"BASKET_URL" => "/personal/basket.php",
				"BROWSER_TITLE" => "-",
				"CACHE_FILTER" => "Y",
				"CACHE_GROUPS" => "N",
				"CACHE_TIME" => "36000000",
				"CACHE_TYPE" => "A",
				"CONVERT_CURRENCY" => "N",
				"DETAIL_URL" => "",
				"DISABLE_INIT_JS_IN_COMPONENT" => "N",
				"DISPLAY_BOTTOM_PAGER" => "Y",
				"DISPLAY_TOP_PAGER" => "N",
				"ELEMENT_SORT_FIELD" => "PROPERTYSORT_INDIKATOR",
				"ELEMENT_SORT_FIELD2" => "SORT",
				"ELEMENT_SORT_FIELD3" => "SHOWS",
				"ELEMENT_SORT_ORDER" => "asc",
				"ELEMENT_SORT_ORDER2" => "asc",
				"ELEMENT_SORT_ORDER3" => "desc",
				"FILTER_NAME" => "arrFilter",
				"HIDE_NOT_AVAILABLE" => "N",
				"IBLOCK_ID" => "1",
				"IBLOCK_TYPE" => "ibCatalog",
				"INCLUDE_SUBSECTIONS" => "Y",
				"LABEL_PROP" => "-",
				"LINE_ELEMENT_COUNT" => "3",
				"MESSAGE_404" => "",
				"MESS_BTN_ADD_TO_BASKET" => "В корзину",
				"MESS_BTN_BUY" => "Купить",
				"MESS_BTN_DETAIL" => "Подробнее",
				"MESS_BTN_SUBSCRIBE" => "Подписаться",
				"MESS_NOT_AVAILABLE" => "Нет в наличии",
				"META_DESCRIPTION" => "-",
				"META_KEYWORDS" => "-",
				"OFFERS_LIMIT" => "5",
				"PAGER_BASE_LINK_ENABLE" => "N",
				"PAGER_DESC_NUMBERING" => "N",
				"PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
				"PAGER_SHOW_ALL" => "N",
				"PAGER_SHOW_ALWAYS" => "N",
				"PAGER_TEMPLATE" => ".default",
				"PAGER_TITLE" => "Товары",
				"PAGE_ELEMENT_COUNT" => "33",
				"PARTIAL_PRODUCT_PROPERTIES" => "N",
				"PRICE_CODE" => array(
					0 => "base",
				),
				"PRICE_VAT_INCLUDE" => "Y",
				"PRODUCT_ID_VARIABLE" => "id",
				"PRODUCT_PROPERTIES" => array(
				),
				"PRODUCT_PROPS_VARIABLE" => "prop",
				"PRODUCT_QUANTITY_VARIABLE" => "",
				"PRODUCT_SUBSCRIPTION" => "N",
				"PROPERTY_CODE" => array(
					0 => "oldprice",
					1 => "",
				),
				"SECTION_CODE" => "",
				"SECTION_ID" => "",
				"SECTION_ID_VARIABLE" => "SECTION_ID",
				"SECTION_URL" => "",
				"SECTION_USER_FIELDS" => array(
					0 => "",
					1 => "",
				),
				"SEF_MODE" => "N",
				"SET_BROWSER_TITLE" => "N",
				"SET_LAST_MODIFIED" => "N",
				"SET_META_DESCRIPTION" => "N",
				"SET_META_KEYWORDS" => "N",
				"SET_STATUS_404" => "N",
				"SET_TITLE" => "N",
				"SHOW_404" => "N",
				"SHOW_ALL_WO_SECTION" => "Y",
				"SHOW_CLOSE_POPUP" => "N",
				"SHOW_DISCOUNT_PERCENT" => "N",
				"SHOW_OLD_PRICE" => "N",
				"SHOW_PRICE_COUNT" => "1",
				"TEMPLATE_THEME" => "blue",
				"USE_MAIN_ELEMENT_SECTION" => "N",
				"USE_PRICE_COUNT" => "N",
				"USE_PRODUCT_QUANTITY" => "N",
				"COMPONENT_TEMPLATE" => "index_hit",
				"CUSTOM_FILTER" => "",
				"HIDE_NOT_AVAILABLE_OFFERS" => "N",
				"COMPOSITE_FRAME_MODE" => "A",
				"COMPOSITE_FRAME_TYPE" => "AUTO",
				"DISPLAY_COMPARE" => "N",
				"COMPATIBLE_MODE" => "Y"
			),
			false
		);?> 
	</div>
</div>
<br>
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>