<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();
/** @var array $arParams */
/** @var array $arResult */
/** @global CMain $APPLICATION */
/** @global CUser $USER */
/** @global CDatabase $DB */
/** @var CBitrixComponentTemplate $this */
/** @var string $templateName */
/** @var string $templateFile */
/** @var string $templateFolder */
/** @var string $componentPath */
/** @var CBitrixComponent $component */
?>
<div class="search-page">
    <form action="" method="get">
    <?if($arParams["USE_SUGGEST"] === "Y"):
	if(strlen($arResult["REQUEST"]["~QUERY"]) && is_object($arResult["NAV_RESULT"]))
	{
		$arResult["FILTER_MD5"] = $arResult["NAV_RESULT"]->GetFilterMD5();
		$obSearchSuggest = new CSearchSuggest($arResult["FILTER_MD5"], $arResult["REQUEST"]["~QUERY"]);
		$obSearchSuggest->SetResultCount($arResult["NAV_RESULT"]->NavRecordCount);
	}
	?>
	<?$APPLICATION->IncludeComponent(
		"bitrix:search.suggest.input",
		"",
		array(
			"NAME" => "q",
			"VALUE" => $arResult["REQUEST"]["~QUERY"],
			"INPUT_SIZE" => 40,
			"DROPDOWN_SIZE" => 10,
			"FILTER_MD5" => $arResult["FILTER_MD5"],
		),
		$component, array("HIDE_ICONS" => "Y")
	);?>
<?else:?>
	<input type="text" name="q" value="<?=$arResult["REQUEST"]["QUERY"]?>" size="40" />
<?endif;?>
    <?if($arParams["SHOW_WHERE"]):?>
        &nbsp;<select name="where">
        <option value=""><?=GetMessage("SEARCH_ALL")?></option>
        <?foreach($arResult["DROPDOWN"] as $key=>$value):?>
        <option value="<?=$key?>"<?if($arResult["REQUEST"]["WHERE"]==$key) echo " selected"?>><?=$value?></option>
        <?endforeach?>
        </select>
    <?endif;?>
	&nbsp;<input class="red_button" type="submit" value="<?=GetMessage("SEARCH_GO")?>" />
	<input type="hidden" name="how" value="<?echo $arResult["REQUEST"]["HOW"]=="d"? "d": "r"?>" />
<?if($arParams["SHOW_WHEN"]):?>
	<script>
	var switch_search_params = function()
	{
		var sp = document.getElementById('search_params');
		var flag;
		var i;

		if(sp.style.display == 'none')
		{
			flag = false;
			sp.style.display = 'block'
		}
		else
		{
			flag = true;
			sp.style.display = 'none';
		}

		var from = document.getElementsByName('from');
		for(i = 0; i < from.length; i++)
			if(from[i].type.toLowerCase() == 'text')
				from[i].disabled = flag;

		var to = document.getElementsByName('to');
		for(i = 0; i < to.length; i++)
			if(to[i].type.toLowerCase() == 'text')
				to[i].disabled = flag;

		return false;
	}
	</script>
	<br /><a class="search-page-params" href="#" onclick="return switch_search_params()"><?echo GetMessage('CT_BSP_ADDITIONAL_PARAMS')?></a>
	<div id="search_params" class="search-page-params" style="display:<?echo $arResult["REQUEST"]["FROM"] || $arResult["REQUEST"]["TO"]? 'block': 'none'?>">
		<?$APPLICATION->IncludeComponent(
			'bitrix:main.calendar',
			'',
			array(
				'SHOW_INPUT' => 'Y',
				'INPUT_NAME' => 'from',
				'INPUT_VALUE' => $arResult["REQUEST"]["~FROM"],
				'INPUT_NAME_FINISH' => 'to',
				'INPUT_VALUE_FINISH' =>$arResult["REQUEST"]["~TO"],
				'INPUT_ADDITIONAL_ATTR' => 'size="10"',
			),
			null,
			array('HIDE_ICONS' => 'Y')
		);?>
	</div>
<?endif?>
</form>
</div>
<?
global $filterProductSearch;
$filterProductSearch["=ID"] = $arResult["LIST_PRODUCT"];
if (is_array($filterProductSearch["=ID"]) && count($filterProductSearch["=ID"])>0) {
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

    <? if ($sort == 'price') $sort = "CATALOG_PRICE_1"; ?>
    <? $intSectionID = $APPLICATION->IncludeComponent(
/*        "bitrix:catalog.section",*/
        "salavey:catalog.section.inherited",
        $view,
        array(
            "IBLOCK_TYPE" => "ibCatalog",
            "IBLOCK_ID" => \FCbit\Conf::FCbit_CATALOG_IBLOCK_ID,
            "ELEMENT_SORT_FIELD2" => $sort,
            "ELEMENT_SORT_ORDER2" => $order,
            "ELEMENT_SORT_FIELD" => "propertysort_INDIKATOR",
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
            "FILTER_NAME" => "filterProductSearch",
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
            "HIDE_NOT_AVAILABLE" => "Y",
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
    );?>
<?
}
elseif ($_REQUEST["q"]){
    echo "<div style='margin-top: 50px'>Отсутствуют результаты поиска</div>";
}?>