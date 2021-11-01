<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die(); 
$this->setFrameMode(true);

$bx_search_limit = COption::GetOptionString('search','max_result_size',50);
global $arSParams;
$arSParams = Array(
		"RESTART" => $arParams["RESTART"],
		"NO_WORD_LOGIC" => $arParams["NO_WORD_LOGIC"],
		"USE_LANGUAGE_GUESS" => $arParams["USE_LANGUAGE_GUESS"],
		"CHECK_DATES" => $arParams["CHECK_DATES"],
		"arrFILTER" => array("iblock_".$arParams["IBLOCK_TYPE"]),
		"arrFILTER_iblock_".$arParams["IBLOCK_TYPE"] => array($arParams["IBLOCK_ID"]),
		"USE_TITLE_RANK" => "Y",
		"DEFAULT_SORT" => "rank",
		"FILTER_NAME" => "",
		"SHOW_WHERE" => "N",
		"arrWHERE" => array(),
		"SHOW_WHEN" => "N",
		"PAGE_RESULT_COUNT" => $bx_search_limit,
		"DISPLAY_TOP_PAGER" => "N",
		"DISPLAY_BOTTOM_PAGER" => "N",
		"PAGER_TITLE" => "",
		"PAGER_SHOW_ALWAYS" => "N",
		"PAGER_TEMPLATE" => "N",
		"INPUT_PLACEHOLDER" => $arParams["INPUT_PLACEHOLDER"],
);


$arElements = $APPLICATION->IncludeComponent(
	"arturgolubev:search.page",
	"catalog",
	$arSParams,
	$component,
	array('HIDE_ICONS' => 'N')
);


if (!empty($arElements) && is_array($arElements))
{
	
	//if($arParams["ELEMENT_SORT_FIELD"] == 'rank'){
	//	$arParams["ELEMENT_SORT_FIELD"] = "ID";
	//	$arParams["ELEMENT_SORT_ORDER"] = array_values($arElements);
	//}
	
	global $searchFilter;
	$searchFilter = array(
		"=ID" => $arElements,
	);
	
	if ($_REQUEST['view']) {
        setcookie('C_VIEW', $_REQUEST['view'], time() + 3600, '/');
        $view = $_REQUEST['view'];
    } elseif ($_COOKIE['C_VIEW'])
        $view = $_COOKIE['C_VIEW'];
    else
        $view = "table";
	
	?>
	
	<div class="sortirovka_block">
        <ul class="vid_tovara not_style display_none_m display_none_mp">
            <li>Показывать:</li>
            <li>
                <a class="table_vid_tovara js_table_vid_tovara <? if ($view == 'table') echo 'active_table_vid_tovara' ?>"
                   href="<?= $APPLICATION->GetCurPageParam('view=table', Array('view')) ?>">таблицей</a></li>
            <li><a class="list_vid_tovara js_list_vid_tovara <? if ($view == 'list') echo 'active_list_vid_tovara' ?>"
                   href="<?= $APPLICATION->GetCurPageParam('view=list', Array('view')) ?>">списком</a></li>
        </ul>
        <div class="clear"></div>
    </div>
	
	<?
	
	$intSectionID = $APPLICATION->IncludeComponent(
/*        "bitrix:catalog.section",*/
        "salavey:catalog.section.inherited",
        $view,
        array(
            "IBLOCK_TYPE" => "ibCatalog",
            "IBLOCK_ID" => \FCbit\Conf::FCbit_CATALOG_IBLOCK_ID,
			"ELEMENT_SORT_FIELD3" => "ID",
            "ELEMENT_SORT_ORDER3" => 'asc',
            "ELEMENT_SORT_FIELD2" => "PROPERTY_rating",
            "ELEMENT_SORT_ORDER2" => 'desc',
            "ELEMENT_SORT_FIELD" => "PROPERTY_SORTING",
            "ELEMENT_SORT_ORDER" => "asc",
            "PROPERTY_CODE" => array(
                0 => "kalibr_mm",
                1 => "",
            ),
            "META_KEYWORDS" => "-",
            "META_DESCRIPTION" => "-",
            "BROWSER_TITLE" => "-",
            "SET_LAST_MODIFIED" => "N",
            "INCLUDE_SUBSECTIONS" => "Y",
            "BASKET_URL" => "/personal/cart/",
            "ACTION_VARIABLE" => "action",
            "PRODUCT_ID_VARIABLE" => "id",
            "SECTION_ID_VARIABLE" => "SECTION_ID",
            "PRODUCT_QUANTITY_VARIABLE" => "",
            "PRODUCT_PROPS_VARIABLE" => "prop",
            "FILTER_NAME" => "searchFilter",
            "CACHE_TYPE" => "A",
            "CACHE_TIME" => "36000000",
            "CACHE_FILTER" => "Y",
            "CACHE_GROUPS" => "N",
            "SET_TITLE" => "N",
            "MESSAGE_404" => "",
            "SET_STATUS_404" => "N",
            "SHOW_404" => "N",
            "FILE_404" => "",
            "DISPLAY_COMPARE" => "Y",
            "PAGE_ELEMENT_COUNT" => "30",
            "LINE_ELEMENT_COUNT" => "3",
            "PRICE_CODE" => array(
                0 => "base",
            ),
            "USE_PRICE_COUNT" => "N",
            "SHOW_PRICE_COUNT" => "1",
            "PRICE_VAT_INCLUDE" => "N",
            "USE_PRODUCT_QUANTITY" => "N",
            "ADD_PROPERTIES_TO_BASKET" => "N",
            "PARTIAL_PRODUCT_PROPERTIES" => "N",
            "PRODUCT_PROPERTIES" => array(),
            "DISPLAY_TOP_PAGER" => "N",
            "DISPLAY_BOTTOM_PAGER" => "Y",
            "PAGER_TITLE" => "Товары",
            "PAGER_SHOW_ALWAYS" => "N",
            "PAGER_TEMPLATE" => "lazyload",
            "PAGER_DESC_NUMBERING" => "N",
            "PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
            "PAGER_SHOW_ALL" => "N",
            "PAGER_BASE_LINK_ENABLE" => "N",
            "SECTION_ID" => "",
            "SECTION_CODE" => "",
            "USE_MAIN_ELEMENT_SECTION" => "N",
            "CONVERT_CURRENCY" => "N",
            "CURRENCY_ID" => $arParams["CURRENCY_ID"],
            "HIDE_NOT_AVAILABLE" => "L",
            "LABEL_PROP" => "-",
            "ADD_PICT_PROP" => "-",
            "PRODUCT_SUBSCRIPTION" => "N",
            "SHOW_DISCOUNT_PERCENT" => "N",
            "SHOW_OLD_PRICE" => "N",
            "MESS_BTN_BUY" => "Купить",
            "MESS_BTN_ADD_TO_BASKET" => "В корзину",
            "MESS_BTN_DETAIL" => "Подробнее",
            "MESS_NOT_AVAILABLE" => "Нет в наличии",
            "TEMPLATE_THEME" => "",
            "ADD_SECTIONS_CHAIN" => "Y",
            "ADD_TO_BASKET_ACTION" => "ADD",
            "SHOW_CLOSE_POPUP" => "N",
            "BACKGROUND_IMAGE" => "-",
            "DISABLE_INIT_JS_IN_COMPONENT" => "N",
            //"IN_BASKET" => $arBasketID,
            "COMPONENT_TEMPLATE" => "list",
            "SECTION_USER_FIELDS" => array(
                0 => "",
                1 => "",
            ),
            "SHOW_ALL_WO_SECTION" => "Y",
            "MESS_BTN_COMPARE" => "Сравнить",
            "SEF_MODE" => "N",
            "AJAX_MODE" => "N",
            "AJAX_OPTION_JUMP" => "N",
            "AJAX_OPTION_STYLE" => "Y",
            "AJAX_OPTION_HISTORY" => "N",
            "AJAX_OPTION_ADDITIONAL" => "",
            "SET_BROWSER_TITLE" => "Y",
            "SET_META_KEYWORDS" => "Y",
            "SET_META_DESCRIPTION" => "Y",
            "OFFERS_LIMIT" => "5",
            "SECTION_URL" => "",
            "DETAIL_URL" => "",
            "COMPARE_PATH" => ""
        ),
        false
    );
	
	
	
}
elseif (is_array($arElements))
{
	echo GetMessage("CT_BCSE_NOT_FOUND");
}