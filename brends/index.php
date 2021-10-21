<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Diada-arms.ru");
?>
<?

if(substr_count($_SERVER['REQUEST_URI'], '/')>3)
{
	if (!defined("ERROR_404"))
	   define("ERROR_404", "Y");

	CHTTP::setStatus("404 Not Found");
	   
	if ($APPLICATION->RestartWorkarea()) {
	   require(\Bitrix\Main\Application::getDocumentRoot()."/404.php");
	   die();
	}
}

\Bitrix\Main\Loader::includeModule('iblock');
$obBrend = CIBlockSection::GetList(array(),array("IBLOCK_ID" => "1","CODE"=>htmlspecialchars($_REQUEST['brend'])));
$arBrend = $obBrend->GetNext();
$APPLICATION->SetTitle("Товары производителя ".strtoupper($arBrend['NAME']));
if($_SERVER['REQUEST_URI'] == '/brends/'){
$APPLICATION->AddChainItem("Производители")	;
}else{
$APPLICATION->AddChainItem("Производители ".strtoupper($arBrend['NAME']));
}
?>
<?$arFilter=array("SECTION_CODE"=>htmlspecialchars($_REQUEST['brend']))?>
    <h1>Производители</h1>

<? if($_SERVER['REQUEST_URI'] == '/brends/'): ?>

    <div class="brand-new-container">
    <div class="brand-new-wrapper"><a href="/brends/air_arms/">AIR ARMS</a></div>  
    <div class="brand-new-wrapper"><a href="/brends/ATAMAN/">ATAMAN</a></div> 
    <div class="brand-new-wrapper"><a href="/brends/CROSMAN/">CROSMAN</a></div>
    <div class="brand-new-wrapper"><a href="/brends/DIANA/">DIANA</a></div>
    <div class="brand-new-wrapper"><a href="/brends/EVANIX/">EVANIX</a></div>
    <div class="brand-new-wrapper"><a href="/brends/FX/">FX</a></div>
    <div class="brand-new-wrapper"><a href="/brends/GAMO/">GAMO</a></div>
    <div class="brand-new-wrapper"><a href="/brends/GLETCHER/">GLETCHER</a></div>
    <div class="brand-new-wrapper"><a href="/brends/HATSAN/">HATSAN</a></div>
    <div class="brand-new-wrapper"><a href="/brends/LEAPERS/">LEAPERS</a></div>
    <div class="brand-new-wrapper"><a href="/brends/NORICA/">NORICA</a></div>
    <div class="brand-new-wrapper"><a href="/brends/UMAREX/">UMAREX</a></div>
    <div class="brand-new-wrapper"><a href="/brends/ZOS/">ZOS</a></div>
    <div class="brand-new-wrapper"><a href="/brends/izhevsk/">ИЖ</a></div>


    </div>

    <style>
        section{text-align: inherit !important;}
    </style>
    <? endif; ?>

    <div style="clear:both"></div>


    <div style="margin-bottom: 20px">
        <!--top-cat-description-->
    </div>
    <?$APPLICATION->IncludeComponent(
    "bitrix:catalog.section",
    "index_hit",
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
        "BASKET_URL" => "/personal/cart/",
        "BROWSER_TITLE" => "-",
        "CACHE_FILTER" => "N",
        "CACHE_GROUPS" => "Y",
        "CACHE_TIME" => "36000000",
        "CACHE_TYPE" => "A",
        "CONVERT_CURRENCY" => "N",
        "DETAIL_URL" => "",
        "DISABLE_INIT_JS_IN_COMPONENT" => "N",
        "DISPLAY_BOTTOM_PAGER" => "Y",
        "DISPLAY_TOP_PAGER" => "N",
        "ELEMENT_SORT_FIELD" => "sort",
        "ELEMENT_SORT_FIELD2" => "id",
        "ELEMENT_SORT_ORDER" => "asc",
        "ELEMENT_SORT_ORDER2" => "desc",
        "FILTER_NAME" => "arFilter",
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
        "PAGE_ELEMENT_COUNT" => "32",
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
        "SET_STATUS_404" => "Y",
        "SET_TITLE" => "N",
        "SHOW_404" => "Y",
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
    <div style="margin-top: 20px;margin-bottom: 20px">
    <!--bottom-seo-text-->
    </div>

    <style>
        .brand-new-container{font-size:0;text-align: inherit;}
        .brand-new-wrapper{display:inline-block;width:33%;padding:10px;font-size:14px;}
        .brand-new-container a{display:block;width:100%;color: white;text-decoration: none; text-align: center;background: #c41a1c;height: 45px;line-height: 45px;transition:all 0.4s;}
        .brand-new-wrapper a:hover{background: #404040;}
    </style>


<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>
