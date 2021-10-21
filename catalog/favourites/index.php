<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Diada-arms.ru");
\Bitrix\Main\Data\StaticHtmlCache::getInstance()->markNonCacheable();
?>
<?if ($_COOKIE['favourites']):?>
	<?
    if ($_REQUEST['view'])
    {
        setcookie('C_VIEW', $_REQUEST['view'], time()+3600, '/');
        $view = "favourites_".$_REQUEST['view'];
    }
    elseif ($_COOKIE['C_VIEW'])
        $view = "favourites_".$_COOKIE['C_VIEW'];
    else
        $view = "favourites_table";
    ?>
    <div class="favourites_opt_bl">
		<div class="favourites_opt_tit">Избранное</div>
		<div class="sortirovka_block">
			<ul class="vid_tovara not_style display_none_m display_none_mp">
				<li>Показывать:</li>
				<li><a class="table_vid_tovara js_table_vid_tovara <?if ($view=='favourites_table') echo 'active_table_vid_tovara'?>" href="<?=$APPLICATION->GetCurPageParam('view=table', Array('view'))?>">таблицей</a></li>
				<li><a class="list_vid_tovara js_list_vid_tovara <?if ($view=='favourites_list') echo 'active_list_vid_tovara'?>" href="<?=$APPLICATION->GetCurPageParam('view=list', Array('view'))?>">списком</a></li>
			</ul>
			<div class="clear"></div>
		</div>
		<a class="srev_all_del" href="">Очистить весь список</a>
    </div>
    <?
    if($_SERVER["REQUEST_METHOD"] == "GET" && $_REQUEST["action"] == "favouritesDel")
    {
        $APPLICATION->RestartBuffer();    
    }
    ?>
    <div class="favourites_list">
    <?
    $arrFilter = Array("ID"=>json_decode($_COOKIE['favourites']));
    if(empty($arrFilter["ID"]))
    {
        $arrFilter["ID"] = 0;  
    }
    ?>
	<?$APPLICATION->IncludeComponent(
		"salavey:catalog.section.inherited",
		$view,
		Array(
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
			"ELEMENT_SORT_FIELD" => $sortData[1],
            "ELEMENT_SORT_ORDER" => $orderData[1],
            "ELEMENT_SORT_FIELD2" => $sortData[2],
            "ELEMENT_SORT_ORDER2" => $orderData[2],
            "ELEMENT_SORT_FIELD3" => $sortData[3],
            "ELEMENT_SORT_ORDER3" => $orderData[3],
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
			"PAGE_ELEMENT_COUNT" => "20",
			"PARTIAL_PRODUCT_PROPERTIES" => "N",
			"PRICE_CODE" => array("base"),
			"PRICE_VAT_INCLUDE" => "Y",
			"PRODUCT_ID_VARIABLE" => "id",
			"PRODUCT_PROPERTIES" => array(),
			"PRODUCT_PROPS_VARIABLE" => "prop",
			"PRODUCT_QUANTITY_VARIABLE" => "",
			"PRODUCT_SUBSCRIPTION" => "N",
			"PROPERTY_CODE" => array("", ""),
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
			"IN_BASKET" => $arBasketID,
		)
	);?>
	</div>
    <?
    if($_SERVER["REQUEST_METHOD"] == "GET" && $_REQUEST["action"] == "favouritesDel")
    {
        die;
    }
    ?>
<?else:?>
	<p><font style="color: green;">Список избранных элементов пуст.</font></p>
<?endif;?>
<div class="help_form_bl">
    <div class="help_form_l">
        <img data-src="/img/help_form_ic.png"/>
    </div>
    <div class="help_form_r prume_form">
		
    </div>
</div>
<div class="f_advantages_bl">
    <div class="f_advantages_el">
        <div class="f_advantages_ic"><img data-src="/img/f_advantages_ic1.png" alt=""/></div>
        <div class="f_advantages_txt">Качественные <br/>товары</div>
    </div>
    <div class="f_advantages_el">
        <div class="f_advantages_ic"><img data-src="/img/f_advantages_ic2.png" alt=""/></div>
        <div class="f_advantages_txt">Удобство <br/>выбора</div>
    </div>
    <div class="f_advantages_el">
        <div class="f_advantages_ic"><img data-src="/img/f_advantages_ic3.png" alt=""/></div>
        <div class="f_advantages_txt">Широкий <br/>ассортимент</div>
    </div>
    <div class="f_advantages_el">
        <div class="f_advantages_ic"><img data-src="/img/f_advantages_ic4.png" alt=""/></div>
        <div class="f_advantages_txt">Дополнительная <br/>гарантия</div>
    </div>
    <div class="f_advantages_el">
        <div class="f_advantages_ic"><img data-src="/img/f_advantages_ic5.png" alt=""/></div>
        <div class="f_advantages_txt">Доставка по России <br/>и странам ТС</div>
    </div>
</div>
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>