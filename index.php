<?
if (preg_match("/^WordPress(.*)/",$_SERVER["HTTP_USER_AGENT"])){
    die();
}
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Diada-arms.ru");
?>
<?if (preg_match("#logout=yes#i", $APPLICATION->GetCurPageParam())):?><?LocalRedirect("https://www.diada-arms.ru/");?><?endif;?>
<div>
	<div class="right_slider_block">
		<div class="index_slider_block">
			
			<?$APPLICATION->IncludeComponent(
				"bitrix:news.list",
				"slider_index",
				Array(
					"ACTIVE_DATE_FORMAT" => "d.m.Y",
					"ADD_SECTIONS_CHAIN" => "N",
					"AJAX_MODE" => "N",
					"AJAX_OPTION_ADDITIONAL" => "",
					"AJAX_OPTION_HISTORY" => "N",
					"AJAX_OPTION_JUMP" => "N",
					"AJAX_OPTION_STYLE" => "Y",
					"CACHE_FILTER" => "Y",
					"CACHE_GROUPS" => "N",
					"CACHE_TIME" => "36000",
					"CACHE_TYPE" => "A",
					"CHECK_DATES" => "Y",
					"DETAIL_URL" => "",
					"DISPLAY_BOTTOM_PAGER" => "N",
					"DISPLAY_DATE" => "N",
					"DISPLAY_NAME" => "Y",
					"DISPLAY_PICTURE" => "Y",
					"DISPLAY_PREVIEW_TEXT" => "N",
					"DISPLAY_TOP_PAGER" => "N",
					"FIELD_CODE" => array("DETAIL_PICTURE", ""),
					"FILTER_NAME" => "",
					"HIDE_LINK_WHEN_NO_DETAIL" => "N",
					"IBLOCK_ID" => FCbit\Conf::FCbit_CENTER_SLIDER_IBLOCK_ID,
					"IBLOCK_TYPE" => "ibSlider",
					"INCLUDE_IBLOCK_INTO_CHAIN" => "N",
					"INCLUDE_SUBSECTIONS" => "Y",
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
					"PROPERTY_CODE" => array("HYPERLINK_MENU", ""),
					"SET_BROWSER_TITLE" => "N",
					"SET_LAST_MODIFIED" => "N",
					"SET_META_DESCRIPTION" => "N",
					"SET_META_KEYWORDS" => "N",
					"SET_STATUS_404" => "N",
					"SET_TITLE" => "N",
					"SHOW_404" => "N",
					"SORT_BY1" => "SORT",
					"SORT_BY2" => "ID",
					"SORT_ORDER1" => "ASC",
					"SORT_ORDER2" => "DESC"
				)
			);?>
		</div>
		<div>
			<?$APPLICATION->IncludeComponent(
				"bitrix:news.list",
				"timer_index",
				array(
					"ACTIVE_DATE_FORMAT" => "d.m.Y",
					"ADD_SECTIONS_CHAIN" => "N",
					"AJAX_MODE" => "N",
					"AJAX_OPTION_ADDITIONAL" => "",
					"AJAX_OPTION_HISTORY" => "N",
					"AJAX_OPTION_JUMP" => "N",
					"AJAX_OPTION_STYLE" => "Y",
					"CACHE_FILTER" => "N",
					"CACHE_GROUPS" => "Y",
					"CACHE_TIME" => "3600000",
					"CACHE_TYPE" => "A",
					"CHECK_DATES" => "Y",
					"DETAIL_URL" => "",
					"DISPLAY_BOTTOM_PAGER" => "N",
					"DISPLAY_DATE" => "N",
					"DISPLAY_NAME" => "Y",
					"DISPLAY_PICTURE" => "Y",
					"DISPLAY_PREVIEW_TEXT" => "N",
					"DISPLAY_TOP_PAGER" => "N",
					"FIELD_CODE" => array(
						0 => "",
						1 => "",
					),
					"FILTER_NAME" => "",
					"HIDE_LINK_WHEN_NO_DETAIL" => "N",
					"IBLOCK_ID" => FCbit\Conf::FCbit_TIMER_IBLOCK_ID,
					"IBLOCK_TYPE" => "ibCountdownTimer",
					"INCLUDE_IBLOCK_INTO_CHAIN" => "N",
					"INCLUDE_SUBSECTIONS" => "Y",
					"MESSAGE_404" => "",
					"NEWS_COUNT" => "1",
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
					"PROPERTY_CODE" => array(
						0 => "",
						1 => "STOP_DATE",
						2 => "",
					),
					"SET_BROWSER_TITLE" => "N",
					"SET_LAST_MODIFIED" => "N",
					"SET_META_DESCRIPTION" => "N",
					"SET_META_KEYWORDS" => "N",
					"SET_STATUS_404" => "N",
					"SET_TITLE" => "N",
					"SHOW_404" => "N",
					"SORT_BY1" => "SORT",
					"SORT_BY2" => "ID",
					"SORT_ORDER1" => "ASC",
					"SORT_ORDER2" => "DESC",
					"COMPONENT_TEMPLATE" => "timer_index"
				),
				false
			);?>
		</div>
	</div>
	<div class="clear"></div>
</div>
<?$sectorHide = "hide_if_not_section_new";?>
<ul class="category_produce not_style display_none_m display_none_mp " style="<?$APPLICATION->ShowViewContent($sectorHide)?>">
	<li class="category_name_block"><p class="category_name orange_hit">Рекомендуем</p></li>
	<li class="category_linear"></li>
</ul>
<div class=" display_none_m display_none_mp ">

	<?
	global $arrFilterDop;
	//$arrFilterDop = Array("CATALOG_QUANTITY" => 0);
	?>
	<?
	$APPLICATION->IncludeComponent(
        "bitrix:catalog.section",
		"index_hit",
        array(
	        "IBLOCK_TYPE" => "ibCatalog",
	        "IBLOCK_ID" => \FCbit\Conf::FCbit_CATALOG_IBLOCK_ID,
	        "SECTION_ID" => "",
	        "SECTION_CODE" => "",
	        "ELEMENT_SORT_FIELD" => "shows",
	        "ELEMENT_SORT_ORDER" => "desc",
	        "ELEMENT_SORT_FIELD2" => "sort",
	        "ELEMENT_SORT_ORDER2" => "asc",
	        "PROPERTY_CODE" => array(
		        0 => "kalibr_mm",
	        ),
	        "PROPERTY_CODE_MOBILE" => array(
	        ),
	        "INCLUDE_SUBSECTIONS" => "Y",
	        "BASKET_URL" => "/personal/cart/",
	        "ACTION_VARIABLE" => "action",
	        "PRODUCT_ID_VARIABLE" => "id",
	        "SECTION_ID_VARIABLE" => "SECTION_ID",
	        "PRODUCT_QUANTITY_VARIABLE" => "",
	        "PRODUCT_PROPS_VARIABLE" => "prop",
	        "CACHE_TYPE" => "N",
	        "CACHE_TIME" => "3600",
	        "CACHE_FILTER" => "N",
	        "CACHE_GROUPS" => "N",
	        "DISPLAY_COMPARE" => "N",
	        "PRICE_CODE" => array("base"),
	        "USE_PRICE_COUNT" => "N",
	        "SHOW_PRICE_COUNT" => "1",
	        "PAGE_ELEMENT_COUNT" => "4",
	        "SET_TITLE" => "N",
	        "SET_BROWSER_TITLE" => "N",
	        "SET_META_KEYWORDS" => "N",
	        "SET_META_DESCRIPTION" => "N",
	        "SET_LAST_MODIFIED" => "N",
	        "ADD_SECTIONS_CHAIN" => "N",
	        "PRICE_VAT_INCLUDE" => "N",
	        "USE_PRODUCT_QUANTITY" => "N",
	        "ADD_PROPERTIES_TO_BASKET" => "N",
	        "PARTIAL_PRODUCT_PROPERTIES" => "N",
	        "PRODUCT_PROPERTIES" => array(
	        ),
	        "SECTION_URL" => "",
	        "DETAIL_URL" => "",
	        "USE_MAIN_ELEMENT_SECTION" => "N",
	        "CONVERT_CURRENCY" => "N",
	        "HIDE_NOT_AVAILABLE" => "Y",
	        "HIDE_NOT_AVAILABLE_OFFERS" => "Y",
	        "LABEL_PROP" => array(
	        ),
	        "LABEL_PROP_MOBILE" => array(
	        ),
	        "ADD_PICT_PROP" => "-",
	        "PRODUCT_ROW_VARIANTS" => "[{'VARIANT':'3','BIG_DATA':true}]",
	        "ENLARGE_PRODUCT" => "STRICT",		        
	        "SHOW_SLIDER" => "N",		        
	        "DISPLAY_TOP_PAGER" => "N",
	        "DISPLAY_BOTTOM_PAGER" => "N",
	        "HIDE_SECTION_DESCRIPTION" => "Y",
	        
            "RCM_TYPE" => "any",
            
	        "SHOW_FROM_SECTION" => "Y",
	        "PRODUCT_SUBSCRIPTION" => "N",
	        "SHOW_DISCOUNT_PERCENT" => "N",
	        "SHOW_OLD_PRICE" => "N",
	        "SHOW_MAX_QUANTITY" => "N",
	        "ADD_TO_BASKET_ACTION" => "ADD",
	        "SHOW_CLOSE_POPUP" => "N",
	        "COMPARE_PATH" => "/catalog/compare/",
	        "COMPARE_NAME" => "CATALOG_COMPARE_LIST",
	        "BACKGROUND_IMAGE" => "",
	        "DISABLE_INIT_JS_IN_COMPONENT" => "N",
	        "COMPONENT_TEMPLATE" => ".default",
	        "SECTION_USER_FIELDS" => array(
		        0 => "",
		        1 => "",
	        ),
	        "FILTER_NAME" => "arrFilterDop",
	        "SHOW_ALL_WO_SECTION" => "Y",
	        "CUSTOM_FILTER" => "",
	        "LINE_ELEMENT_COUNT" => "3",
	        "SEF_MODE" => "N",
	        "AJAX_MODE" => "N",
	        "AJAX_OPTION_JUMP" => "N",
	        "AJAX_OPTION_STYLE" => "Y",
	        "AJAX_OPTION_HISTORY" => "N",
	        "AJAX_OPTION_ADDITIONAL" => "",
	        "BROWSER_TITLE" => "-",
	        "META_KEYWORDS" => "-",
	        "META_DESCRIPTION" => "-",
	        "COMPOSITE_FRAME_MODE" => "Y",
	        "COMPOSITE_FRAME_TYPE" => "DYNAMIC_WITH_STUB_LOADING",
	        "PAGER_TEMPLATE" => ".default",
	        "PAGER_TITLE" => "Товары",
	        "PAGER_SHOW_ALWAYS" => "N",
	        "PAGER_DESC_NUMBERING" => "N",
	        "PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
	        "PAGER_SHOW_ALL" => "N",
	        "PAGER_BASE_LINK_ENABLE" => "N",
	        "LAZY_LOAD" => "N",
	        "LOAD_ON_SCROLL" => "N",
	        "SET_STATUS_404" => "N",
	        "SHOW_404" => "N",
	        "MESSAGE_404" => "",
	        "COMPATIBLE_MODE" => "Y",
        ),
        $component
    );
	?>
</div>
<?$sectorHide = "hide_if_not_section_new";?>
<ul class="category_produce not_style display_none_m display_none_mp " style="<?$APPLICATION->ShowViewContent($sectorHide)?>">
	<li class="category_name_block"><p class="category_name blue_hit">Новинки</p></li>
	<li class="category_linear"></li>
	<li class="category_all"><a href="/catalog/novinki/">Показать&nbsp;все&nbsp;></a></li>
</ul>
<div class=" display_none_m display_none_mp ">
    <?
    global $arrFilterNovelties;
    $arrFilterNovelties[] = array(
        "LOGIC" => "OR",
        array("!PREVIEW_PICTURE" => false),
        array("!DETAIL_PICTURE" => false),
    );
    ?>
	<?$APPLICATION->IncludeComponent(
		"bitrix:catalog.section",
		"index_hit",
		Array(
            "HIDE_SECTION" => $sectorHide,
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
			"BASKET_URL" => "/personal/cart/",
			"BROWSER_TITLE" => "-",
			"PROPERTY_CODE" => array(
		        0 => "kalibr_mm",
	        ),
			"CACHE_FILTER" => "Y",
			"CACHE_GROUPS" => "N",
			"CACHE_TIME" => "36000",
			"CACHE_TYPE" => "N",
			"CONVERT_CURRENCY" => "N",
			"DETAIL_URL" => "",
			"DISABLE_INIT_JS_IN_COMPONENT" => "N",
			"DISPLAY_BOTTOM_PAGER" => "N",
			"DISPLAY_TOP_PAGER" => "N",
			"ELEMENT_SORT_FIELD" => "date_create",
			"ELEMENT_SORT_FIELD2" => "id",
			"ELEMENT_SORT_ORDER" => "desc",
			"ELEMENT_SORT_ORDER2" => "desc",
			"FILTER_NAME" => "arrFilterNovelties",
			"HIDE_NOT_AVAILABLE" => "Y",
			"HIDE_NOT_AVAILABLE_OFFERS" => "Y",
			"IBLOCK_ID" => \FCbit\Conf::FCbit_CATALOG_IBLOCK_ID,
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
			"PAGE_ELEMENT_COUNT" => "4",
			"PARTIAL_PRODUCT_PROPERTIES" => "N",
			"PRICE_CODE" => array("base"),
			"PRICE_VAT_INCLUDE" => "Y",
			"PRODUCT_ID_VARIABLE" => "id",
			"PRODUCT_PROPERTIES" => array(),
			"PRODUCT_PROPS_VARIABLE" => "prop",
			"PRODUCT_QUANTITY_VARIABLE" => "",
			"PRODUCT_SUBSCRIPTION" => "N",
			"SECTION_CODE" => "",
			"SECTION_ID" => "",
			"SECTION_ID_VARIABLE" => "SECTION_ID",
			"SECTION_URL" => "",
			"SECTION_USER_FIELDS" => array("", ""),
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
            "DISPLAY_COMPARE" => "Y",
			//"IN_BASKET" => $arBasketID,
		)
	);?>
</div>

<?$sectorHide = "hide_if_not_section_sale";?>
<ul class="category_produce not_style" style="<?$APPLICATION->ShowViewContent($sectorHide)?>">
	<li class="category_name_block"><p class="category_name green_hit">Распродажа</p></li>
	<li class="category_linear"></li>
	<li class="category_all"><a href="/catalog/specials/">Показать&nbsp;все&nbsp;></a></li>
</ul>
<div class=" ">
    <?
    \Bitrix\Main\Loader::includeModule("sale");
    \Bitrix\Main\Loader::includeModule("catalog");
    \Bitrix\Main\Loader::includeModule("iblock");
    $filterDiscount = array(
        "ACTIVE" => "Y",
        "USE_COUPONS" => "N"
    );
    $dbProductDiscounts = Bitrix\Sale\Internals\DiscountTable::getList(array("filter" => $filterDiscount));
    $listDiscountProduct["ELEMENT"] = array();
    $listDiscountProduct["SECTION"] = array();
    function SetDiscountProductList($data,&$listDiscountProduct){
        if ($data["DATA"]["value"][0]>0) {
            if ($data["CLASS_ID"] == "CondGroup") {
                $listDiscountProduct["SECTION"][] = $data["DATA"]["value"][0];
            }
            if ($data["CLASS_ID"] == "CondIBElement") {
                $listDiscountProduct["ELEMENT"][] = $data["DATA"]["value"][0];
            }
        }
    }
    while ($infoDiscount = $dbProductDiscounts->fetch()){
        $condition = $infoDiscount["CONDITIONS_LIST"];
        while (isset($condition) && count($condition)>0){
            SetDiscountProductList($condition,$listDiscountProduct);
            $condition = $condition["CHILDREN"][0];
        }
    }
    $arrFilterSale = array('ID'=>$listDiscountProduct["ELEMENT"]);
    ?>
	<?$APPLICATION->IncludeComponent(
		"bitrix:catalog.section",
		"index_hit",
		Array(
            "HIDE_SECTION" => $sectorHide,
			"ACTION_VARIABLE" => "action",
			"ADD_PICT_PROP" => "-",
			"ADD_PROPERTIES_TO_BASKET" => "Y",
			"ADD_SECTIONS_CHAIN" => "N",
			"PROPERTY_CODE" => array(
		        0 => "kalibr_mm",
	        ),
			"ADD_TO_BASKET_ACTION" => "ADD",
			"AJAX_MODE" => "N",
			"AJAX_OPTION_ADDITIONAL" => "",
			"AJAX_OPTION_HISTORY" => "N",
			"AJAX_OPTION_JUMP" => "N",
			"AJAX_OPTION_STYLE" => "Y",
			"BACKGROUND_IMAGE" => "-",
			"BASKET_URL" => "/personal/cart/",
			"BROWSER_TITLE" => "-",
			"CACHE_FILTER" => "Y",
			"CACHE_GROUPS" => "Y",
			"CACHE_TIME" => "700",
			"CACHE_TYPE" => "A",
			"CONVERT_CURRENCY" => "N",
			"DETAIL_URL" => "",
			"DISABLE_INIT_JS_IN_COMPONENT" => "N",
			"DISPLAY_BOTTOM_PAGER" => "N",
			"DISPLAY_TOP_PAGER" => "N",
			"ELEMENT_SORT_FIELD" => "sort",
			"ELEMENT_SORT_FIELD2" => "id",
			"ELEMENT_SORT_ORDER" => "asc",
			"ELEMENT_SORT_ORDER2" => "desc",
			"FILTER_NAME" => "arrFilterSale",
			"HIDE_NOT_AVAILABLE" => "Y",
			"IBLOCK_ID" => \FCbit\Conf::FCbit_CATALOG_IBLOCK_ID,
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
			"PAGE_ELEMENT_COUNT" => "4",
			"PARTIAL_PRODUCT_PROPERTIES" => "N",
			"PRICE_CODE" => array("base"),
			"PRICE_VAT_INCLUDE" => "Y",
			"PRODUCT_ID_VARIABLE" => "id",
			"PRODUCT_PROPERTIES" => array(),
			"PRODUCT_PROPS_VARIABLE" => "prop",
			"PRODUCT_QUANTITY_VARIABLE" => "",
			"PRODUCT_SUBSCRIPTION" => "N",
			"SECTION_CODE" => "",
			"SECTION_ID" => "",
			"SECTION_ID_VARIABLE" => "SECTION_ID",
			"SECTION_URL" => "",
			"SECTION_USER_FIELDS" => array("", ""),
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
            "DISPLAY_COMPARE" => "Y",
			//"IN_BASKET" => $arBasketID,
		)
	);?>
</div>
<div class="razdel_probuce_block">
	<h2>Категории товаров</h2>
	<div class="razdel_slider_block">
		<?
		$razdel_slider_filter = array(
			"!ID" => array(3623, 913, 1217, 1336, 1224, 1218, 2582, 1700, 1893),
		);
		$APPLICATION->IncludeComponent(
			"bitrix:catalog.section.list",
			"index_slider",
			Array(
				"ADD_SECTIONS_CHAIN" => "N",
				"CACHE_GROUPS" => "Y",
				"CACHE_TIME" => "3600000",
				"CACHE_TYPE" => "A",
				"COUNT_ELEMENTS" => "N",
				"IBLOCK_ID" => \FCbit\Conf::FCbit_CATALOG_IBLOCK_ID,
				"IBLOCK_TYPE" => "ibCatalog",
				"SECTION_CODE" => "",
				"SECTION_FIELDS" => array("", ""),
				"SECTION_ID" => "",
				"SECTION_URL" => "",
				"SECTION_USER_FIELDS" => array("", ""),
				"SHOW_PARENT_NAME" => "Y",
				"TOP_DEPTH" => "1",
				"VIEW_MODE" => "LINE",
				"USE_FILTER" => "Y",
				"FILTER_NAME" => "razdel_slider_filter",
			)
		);?>
	</div>
	<div class="razdel_slider_button">Показать все категории</div>
</div>

<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>