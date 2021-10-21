<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Diada-arms.ru");
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
    <div class="sortirovka_block">
        <ul class="sortirovka not_style">
            <li>Сортировать по:</li>
            <?
            $arSort = Array("popular"=>"популярности", "price"=>"цене", "name"=>"названию");
            if (empty($_REQUEST["sort_type"]) || !isset($_REQUEST["sort_type"])){
                $_REQUEST["sort_type"] = key($arSort);
                $_REQUEST["arrow"] = "up";
            }
            foreach($arSort as $code=>$name):
                $class = "";
                $setArrow = "up";
                if ($_REQUEST["sort_type"] == $code && $_REQUEST["arrow"] == 'up')
                {
                    $class = "sort_active_top";
                    $setArrow = "down";
                }
                elseif ($_REQUEST["sort_type"] == $code && $_REQUEST["arrow"] == 'down')
                {
                    $class = "sort_active_bottom";
                    $setArrow = "up";
                }
                ?>
                <li><a class="<?=$class?>" href="<?=$APPLICATION->GetCurPageParam('sort_type='.$code.'&arrow='.$setArrow, Array('sort_type', 'arrow'))?>"><?=$name?></a></li>
            <?endforeach;?>
        </ul>
        <ul class="vid_tovara not_style display_none_m display_none_mp">
            <li>Показывать:</li>
            <li><a class="table_vid_tovara js_table_vid_tovara <?if ($view=='favourites_table') echo 'active_table_vid_tovara'?>" href="<?=$APPLICATION->GetCurPageParam('view=table', Array('view'))?>">таблицей</a></li>
            <li><a class="list_vid_tovara js_list_vid_tovara <?if ($view=='favourites_list') echo 'active_list_vid_tovara'?>" href="<?=$APPLICATION->GetCurPageParam('view=list', Array('view'))?>">списком</a></li>
        </ul>
        <div class="clear"></div>
    </div>
    <?$arrFilter = Array("ID"=>json_decode($_COOKIE['favourites']));?>
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
			"CACHE_FILTER" => "N",
			"CACHE_GROUPS" => "Y",
			"CACHE_TIME" => "36000000",
			"CACHE_TYPE" => "A",
			"CONVERT_CURRENCY" => "N",
			"DETAIL_URL" => "",
			"DISABLE_INIT_JS_IN_COMPONENT" => "N",
			"DISPLAY_BOTTOM_PAGER" => "N",
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
			"PAGE_ELEMENT_COUNT" => "4",
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
			"IN_BASKET" => $arBasketID,
		)
	);?>
<?endif;?>
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>