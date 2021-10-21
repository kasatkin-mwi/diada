<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
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

use Bitrix\Main\Loader;
use Bitrix\Main\ModuleManager;
global $USER;
$dontShowAll = false;
$filterElementContent = array();
$filterElementContent["CODE"] = $arResult["VARIABLES"]["ELEMENT_CODE"];
$filterElementContent["IBLOCK_ID"] = $arParams["IBLOCK_ID"];

Loader::includeModule("highloadblock");
$hlblock  = Bitrix\Highloadblock\HighloadBlockTable::getById(4)->fetch();
$entity   = Bitrix\Highloadblock\HighloadBlockTable::compileEntity( $hlblock );
$entity_requests_data_class = $entity->getDataClass();

if (strlen($arResult["VARIABLES"]["SECTION_CODE"])>0){
    $filterElementContent["SECTION_CODE"] = $arResult["VARIABLES"]["SECTION_CODE"];
}
elseif ($arResult["VARIABLES"]["SECTION_ID"]>0){
    $filterElementContent["SECTION_ID"] = $arResult["VARIABLES"]["SECTION_ID"];
}
global $arrFilter;
$arItem = CIBlockElement::GetList(array(),$filterElementContent,false,array("nTopCount" => 1),array("ID"))->GetNext();

if(!empty($arItem["ID"]))
{
    $arrFilter["PROPERTY_PRODUCT"] = $arItem["ID"];
    ?>
    <?$arButtons = $APPLICATION->IncludeComponent(
        "bitrix:news.list",
        "",
        Array(
            "ACTIVE_DATE_FORMAT" => "d.m.Y",
            "ADD_SECTIONS_CHAIN" => "N",
            "AJAX_MODE" => "N",
            "AJAX_OPTION_ADDITIONAL" => "",
            "AJAX_OPTION_HISTORY" => "N",
            "AJAX_OPTION_JUMP" => "N",
            "AJAX_OPTION_STYLE" => "Y",
            "CACHE_FILTER" => "Y",
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
            "FIELD_CODE" => array(),
            "FILTER_NAME" => "arrFilter",
            "HIDE_LINK_WHEN_NO_DETAIL" => "N",
            "IBLOCK_ID" => "33",
            "IBLOCK_TYPE" => "other",
            "INCLUDE_IBLOCK_INTO_CHAIN" => "N",
            "INCLUDE_SUBSECTIONS" => "Y",
            "MESSAGE_404" => "",
            "NEWS_COUNT" => "100",
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
            "PROPERTY_CODE" => array("BTN_NAME","URL",""),
            "SET_BROWSER_TITLE" => "N",
            "SET_LAST_MODIFIED" => "N",
            "SET_META_DESCRIPTION" => "N",
            "SET_META_KEYWORDS" => "N",
            "SET_STATUS_404" => "N",
            "SET_TITLE" => "N",
            "SHOW_404" => "N",
            "SORT_BY1" => "SORT",
            "SORT_BY2" => "SORT",
            "SORT_ORDER1" => "ASC",
            "SORT_ORDER2" => "ASC",
            "STRICT_SECTION_CHECK" => "N"
        ),
        $component
    );?>
    <?
    if(is_array($arButtons) && !empty($arButtons))
    {
        $dontShowAll = true;   
    }    
}

if (count($filterElementContent) == 3){
    if ($res = CIBlockElement::GetList(array(),$filterElementContent)->GetNextElement()) {
        $propElement = $res->GetProperty(4775);//Аналогичный контент
        if (strlen($propElement["VALUE"]["TEXT"]) > 0) {
            echo $propElement["~VALUE"]["TEXT"];
            $dontShowAll = true;
        }
    }
}
if (!$dontShowAll){
    $this->setFrameMode(true);
    //$this->addExternalCss("/bitrix/css/main/bootstrap.css");

    if (isset($arParams['USE_COMMON_SETTINGS_BASKET_POPUP']) && $arParams['USE_COMMON_SETTINGS_BASKET_POPUP'] == 'Y')
    {
        $basketAction = (isset($arParams['COMMON_ADD_TO_BASKET_ACTION']) ? array($arParams['COMMON_ADD_TO_BASKET_ACTION']) : array());
    }
    else
    {
        $basketAction = (isset($arParams['DETAIL_ADD_TO_BASKET_ACTION']) ? $arParams['DETAIL_ADD_TO_BASKET_ACTION'] : array());
    }
    ?>
    <?$APPLICATION->AddHeadScript('https://api-maps.yandex.ru/1.1/index.xml');?>

    <?
    $setTemplate = "";
    //if($USER->IsAdmin())
    //{
        $setTemplate = "detail";
        $arParams['SHOW_OLD_PRICE'] = 'Y';
        $this->addExternalCss("/css/detail_style.css");    
    //}
    $this->addExternalCss("/css/her.css"); 
    $setCache = $arParams["CACHE_TYPE"];
    if ($_REQUEST["PRINT"] == "Y"){
        $APPLICATION->RestartBuffer();
        $setTemplate = "print";
        $setCache = "N";
    }
    ?>
    <?$ElementID = $APPLICATION->IncludeComponent(
        "bitrix:catalog.element",
        $setTemplate,
        array(
            "IBLOCK_TYPE" => $arParams["IBLOCK_TYPE"],
            "IBLOCK_ID" => $arParams["IBLOCK_ID"],
            "PROPERTY_CODE" => $arParams["DETAIL_PROPERTY_CODE"],
            "META_KEYWORDS" => $arParams["DETAIL_META_KEYWORDS"],
            "META_DESCRIPTION" => $arParams["DETAIL_META_DESCRIPTION"],
            "BROWSER_TITLE" => $arParams["DETAIL_BROWSER_TITLE"],
            "SET_CANONICAL_URL" => $arParams["DETAIL_SET_CANONICAL_URL"],
            "BASKET_URL" => $arParams["BASKET_URL"],
            "ACTION_VARIABLE" => $arParams["ACTION_VARIABLE"],
            "PRODUCT_ID_VARIABLE" => $arParams["PRODUCT_ID_VARIABLE"],
            "SECTION_ID_VARIABLE" => $arParams["SECTION_ID_VARIABLE"],
            "CHECK_SECTION_ID_VARIABLE" => (isset($arParams["DETAIL_CHECK_SECTION_ID_VARIABLE"]) ? $arParams["DETAIL_CHECK_SECTION_ID_VARIABLE"] : ''),
            "PRODUCT_QUANTITY_VARIABLE" => $arParams["PRODUCT_QUANTITY_VARIABLE"],
            "PRODUCT_PROPS_VARIABLE" => $arParams["PRODUCT_PROPS_VARIABLE"],
            "CACHE_TYPE" => 'A',
            "CACHE_TIME" => $arParams["CACHE_TIME"],
            "CACHE_GROUPS" => $arParams["CACHE_GROUPS"],
            "SET_TITLE" => $arParams["SET_TITLE"],
            "SET_LAST_MODIFIED" => $arParams["SET_LAST_MODIFIED"],
            "MESSAGE_404" => $arParams["MESSAGE_404"],
            "SET_STATUS_404" => $arParams["SET_STATUS_404"],
            "SHOW_404" => $arParams["SHOW_404"],
            "FILE_404" => $arParams["FILE_404"],
            "PRICE_CODE" => $arParams["PRICE_CODE"],
            "USE_PRICE_COUNT" => $arParams["USE_PRICE_COUNT"],
            "SHOW_PRICE_COUNT" => $arParams["SHOW_PRICE_COUNT"],
            "PRICE_VAT_INCLUDE" => $arParams["PRICE_VAT_INCLUDE"],
            "PRICE_VAT_SHOW_VALUE" => $arParams["PRICE_VAT_SHOW_VALUE"],
            "USE_PRODUCT_QUANTITY" => $arParams['USE_PRODUCT_QUANTITY'],
            "PRODUCT_PROPERTIES" => $arParams["PRODUCT_PROPERTIES"],
            "ADD_PROPERTIES_TO_BASKET" => (isset($arParams["ADD_PROPERTIES_TO_BASKET"]) ? $arParams["ADD_PROPERTIES_TO_BASKET"] : ''),
            "PARTIAL_PRODUCT_PROPERTIES" => (isset($arParams["PARTIAL_PRODUCT_PROPERTIES"]) ? $arParams["PARTIAL_PRODUCT_PROPERTIES"] : ''),
            "LINK_IBLOCK_TYPE" => $arParams["LINK_IBLOCK_TYPE"],
            "LINK_IBLOCK_ID" => $arParams["LINK_IBLOCK_ID"],
            "LINK_PROPERTY_SID" => $arParams["LINK_PROPERTY_SID"],
            "LINK_ELEMENTS_URL" => $arParams["LINK_ELEMENTS_URL"],

            "OFFERS_CART_PROPERTIES" => $arParams["OFFERS_CART_PROPERTIES"],
            "OFFERS_FIELD_CODE" => $arParams["DETAIL_OFFERS_FIELD_CODE"],
            "OFFERS_PROPERTY_CODE" => $arParams["DETAIL_OFFERS_PROPERTY_CODE"],
            "OFFERS_SORT_FIELD" => $arParams["OFFERS_SORT_FIELD"],
            "OFFERS_SORT_ORDER" => $arParams["OFFERS_SORT_ORDER"],
            "OFFERS_SORT_FIELD2" => $arParams["OFFERS_SORT_FIELD2"],
            "OFFERS_SORT_ORDER2" => $arParams["OFFERS_SORT_ORDER2"],

            "ELEMENT_ID" => $arResult["VARIABLES"]["ELEMENT_ID"],
            "ELEMENT_CODE" => $arResult["VARIABLES"]["ELEMENT_CODE"],
            "SECTION_ID" => $arResult["VARIABLES"]["SECTION_ID"],
            "SECTION_CODE" => $arResult["VARIABLES"]["SECTION_CODE"],
            "SECTION_URL" => $arResult["FOLDER"].$arResult["URL_TEMPLATES"]["section"],
            "DETAIL_URL" => $arResult["FOLDER"].$arResult["URL_TEMPLATES"]["element"],
            'CONVERT_CURRENCY' => $arParams['CONVERT_CURRENCY'],
            'CURRENCY_ID' => $arParams['CURRENCY_ID'],
            'HIDE_NOT_AVAILABLE' => $arParams["HIDE_NOT_AVAILABLE"],
            'USE_ELEMENT_COUNTER' => $arParams['USE_ELEMENT_COUNTER'],
            'SHOW_DEACTIVATED' => $arParams['SHOW_DEACTIVATED'],
            "USE_MAIN_ELEMENT_SECTION" => $arParams["USE_MAIN_ELEMENT_SECTION"],

            'ADD_PICT_PROP' => $arParams['ADD_PICT_PROP'],
            'LABEL_PROP' => $arParams['LABEL_PROP'],
            'OFFER_ADD_PICT_PROP' => $arParams['OFFER_ADD_PICT_PROP'],
            'OFFER_TREE_PROPS' => $arParams['OFFER_TREE_PROPS'],
            'PRODUCT_SUBSCRIPTION' => $arParams['PRODUCT_SUBSCRIPTION'],
            'SHOW_DISCOUNT_PERCENT' => $arParams['SHOW_DISCOUNT_PERCENT'],
            'SHOW_OLD_PRICE' => $arParams['SHOW_OLD_PRICE'],
            'SHOW_MAX_QUANTITY' => $arParams['DETAIL_SHOW_MAX_QUANTITY'],
            'MESS_BTN_BUY' => $arParams['MESS_BTN_BUY'],
            'MESS_BTN_ADD_TO_BASKET' => $arParams['MESS_BTN_ADD_TO_BASKET'],
            'MESS_BTN_SUBSCRIBE' => $arParams['MESS_BTN_SUBSCRIBE'],
            'MESS_BTN_COMPARE' => $arParams['MESS_BTN_COMPARE'],
            'MESS_NOT_AVAILABLE' => $arParams['MESS_NOT_AVAILABLE'],
            'USE_VOTE_RATING' => $arParams['DETAIL_USE_VOTE_RATING'],
            'VOTE_DISPLAY_AS_RATING' => (isset($arParams['DETAIL_VOTE_DISPLAY_AS_RATING']) ? $arParams['DETAIL_VOTE_DISPLAY_AS_RATING'] : ''),
            'USE_COMMENTS' => $arParams['DETAIL_USE_COMMENTS'],
            'BLOG_USE' => (isset($arParams['DETAIL_BLOG_USE']) ? $arParams['DETAIL_BLOG_USE'] : ''),
            'BLOG_URL' => (isset($arParams['DETAIL_BLOG_URL']) ? $arParams['DETAIL_BLOG_URL'] : ''),
            'BLOG_EMAIL_NOTIFY' => (isset($arParams['DETAIL_BLOG_EMAIL_NOTIFY']) ? $arParams['DETAIL_BLOG_EMAIL_NOTIFY'] : ''),
            'VK_USE' => (isset($arParams['DETAIL_VK_USE']) ? $arParams['DETAIL_VK_USE'] : ''),
            'VK_API_ID' => (isset($arParams['DETAIL_VK_API_ID']) ? $arParams['DETAIL_VK_API_ID'] : 'API_ID'),
            'FB_USE' => (isset($arParams['DETAIL_FB_USE']) ? $arParams['DETAIL_FB_USE'] : ''),
            'FB_APP_ID' => (isset($arParams['DETAIL_FB_APP_ID']) ? $arParams['DETAIL_FB_APP_ID'] : ''),
            'BRAND_USE' => (isset($arParams['DETAIL_BRAND_USE']) ? $arParams['DETAIL_BRAND_USE'] : 'N'),
            'BRAND_PROP_CODE' => (isset($arParams['DETAIL_BRAND_PROP_CODE']) ? $arParams['DETAIL_BRAND_PROP_CODE'] : ''),
            'DISPLAY_NAME' => (isset($arParams['DETAIL_DISPLAY_NAME']) ? $arParams['DETAIL_DISPLAY_NAME'] : ''),
            'ADD_DETAIL_TO_SLIDER' => (isset($arParams['DETAIL_ADD_DETAIL_TO_SLIDER']) ? $arParams['DETAIL_ADD_DETAIL_TO_SLIDER'] : ''),
            'TEMPLATE_THEME' => (isset($arParams['TEMPLATE_THEME']) ? $arParams['TEMPLATE_THEME'] : ''),
            "ADD_SECTIONS_CHAIN" => (isset($arParams["ADD_SECTIONS_CHAIN"]) ? $arParams["ADD_SECTIONS_CHAIN"] : ''),
            "ADD_ELEMENT_CHAIN" => (isset($arParams["ADD_ELEMENT_CHAIN"]) ? $arParams["ADD_ELEMENT_CHAIN"] : ''),
            "DISPLAY_PREVIEW_TEXT_MODE" => (isset($arParams['DETAIL_DISPLAY_PREVIEW_TEXT_MODE']) ? $arParams['DETAIL_DISPLAY_PREVIEW_TEXT_MODE'] : ''),
            "DETAIL_PICTURE_MODE" => (isset($arParams['DETAIL_DETAIL_PICTURE_MODE']) ? $arParams['DETAIL_DETAIL_PICTURE_MODE'] : ''),
            'ADD_TO_BASKET_ACTION' => $basketAction,
            'SHOW_CLOSE_POPUP' => isset($arParams['COMMON_SHOW_CLOSE_POPUP']) ? $arParams['COMMON_SHOW_CLOSE_POPUP'] : '',
            'DISPLAY_COMPARE' => (isset($arParams['USE_COMPARE']) ? $arParams['USE_COMPARE'] : ''),
            'COMPARE_PATH' => $arResult['FOLDER'].$arResult['URL_TEMPLATES']['compare'],
            'SHOW_BASIS_PRICE' => (isset($arParams['DETAIL_SHOW_BASIS_PRICE']) ? $arParams['DETAIL_SHOW_BASIS_PRICE'] : 'Y'),
            'BACKGROUND_IMAGE' => (isset($arParams['DETAIL_BACKGROUND_IMAGE']) ? $arParams['DETAIL_BACKGROUND_IMAGE'] : ''),
            'DISABLE_INIT_JS_IN_COMPONENT' => (isset($arParams['DISABLE_INIT_JS_IN_COMPONENT']) ? $arParams['DISABLE_INIT_JS_IN_COMPONENT'] : ''),
            'SET_VIEWED_IN_COMPONENT' => (isset($arParams['DETAIL_SET_VIEWED_IN_COMPONENT']) ? $arParams['DETAIL_SET_VIEWED_IN_COMPONENT'] : ''),

            "USE_GIFTS_DETAIL" => $arParams['USE_GIFTS_DETAIL']?: 'Y',
            "USE_GIFTS_MAIN_PR_SECTION_LIST" => $arParams['USE_GIFTS_MAIN_PR_SECTION_LIST']?: 'Y',
            "GIFTS_SHOW_DISCOUNT_PERCENT" => $arParams['GIFTS_SHOW_DISCOUNT_PERCENT'],
            "GIFTS_SHOW_OLD_PRICE" => $arParams['GIFTS_SHOW_OLD_PRICE'],
            "GIFTS_DETAIL_PAGE_ELEMENT_COUNT" => $arParams['GIFTS_DETAIL_PAGE_ELEMENT_COUNT'],
            "GIFTS_DETAIL_HIDE_BLOCK_TITLE" => $arParams['GIFTS_DETAIL_HIDE_BLOCK_TITLE'],
            "GIFTS_DETAIL_TEXT_LABEL_GIFT" => $arParams['GIFTS_DETAIL_TEXT_LABEL_GIFT'],
            "GIFTS_DETAIL_BLOCK_TITLE" => $arParams["GIFTS_DETAIL_BLOCK_TITLE"],
            "GIFTS_SHOW_NAME" => $arParams['GIFTS_SHOW_NAME'],
            "GIFTS_SHOW_IMAGE" => $arParams['GIFTS_SHOW_IMAGE'],
            "GIFTS_MESS_BTN_BUY" => $arParams['GIFTS_MESS_BTN_BUY'],

            "GIFTS_MAIN_PRODUCT_DETAIL_PAGE_ELEMENT_COUNT" => $arParams['GIFTS_MAIN_PRODUCT_DETAIL_PAGE_ELEMENT_COUNT'],
            "GIFTS_MAIN_PRODUCT_DETAIL_BLOCK_TITLE" => $arParams['GIFTS_MAIN_PRODUCT_DETAIL_BLOCK_TITLE'],
            //"IN_BASKET" => $arParams['IN_BASKET'],
        ),
        $component
    );?>
    <?
    //$arAvailableGroups = array(1,12,16,20);
	$arAvailableGroups = array(1);
    $arGroups = $USER->GetUserGroupArray();
    $mayShow = false;
    foreach($arAvailableGroups as $group)
    {
        if(in_array($group,$arGroups))
        {
            $mayShow = true;
        }
    }
    if($mayShow)
    {
        
    ?>
		
    <?
    }
    ?>
    <?if ($_REQUEST["PRINT"] == "Y"){
        die();
    }
    ?>
    <?
    if($USER->IsAdmin() && intval($ElementID) > 0)
    {
        ?>
        <?/*
        $APPLICATION->IncludeComponent(
            'salavey:catalog.section.inherited',
            'big_data',
            array(
                'IBLOCK_TYPE' => $arParams['IBLOCK_TYPE'],
                'IBLOCK_ID' => $arParams['IBLOCK_ID'],
                /*'SECTION_ID' => $arResult['VARIABLES']['SECTION_ID'],
                'SECTION_CODE' => $arResult['VARIABLES']['SECTION_CODE'],*/
        /*        'ELEMENT_SORT_FIELD' => 'shows',
                'ELEMENT_SORT_ORDER' => 'desc',
                'ELEMENT_SORT_FIELD2' => 'sort',
                'ELEMENT_SORT_ORDER2' => 'asc',
                'PROPERTY_CODE' => $arParams['LIST_PROPERTY_CODE'],
                'PROPERTY_CODE_MOBILE' => $arParams['LIST_PROPERTY_CODE_MOBILE'],
                'INCLUDE_SUBSECTIONS' => $arParams['INCLUDE_SUBSECTIONS'],
                'BASKET_URL' => $arParams['BASKET_URL'],
                'ACTION_VARIABLE' => $arParams['ACTION_VARIABLE'],
                'PRODUCT_ID_VARIABLE' => $arParams['PRODUCT_ID_VARIABLE'],
                'SECTION_ID_VARIABLE' => $arParams['SECTION_ID_VARIABLE'],
                'PRODUCT_QUANTITY_VARIABLE' => $arParams['PRODUCT_QUANTITY_VARIABLE'],
                'PRODUCT_PROPS_VARIABLE' => $arParams['PRODUCT_PROPS_VARIABLE'],
                'CACHE_TYPE' => $arParams['CACHE_TYPE'],
                'CACHE_TIME' => $arParams['CACHE_TIME'],
                'CACHE_FILTER' => $arParams['CACHE_FILTER'],
                'CACHE_GROUPS' => $arParams['CACHE_GROUPS'],
                'DISPLAY_COMPARE' => $arParams['USE_COMPARE'],
                'PRICE_CODE' => $arParams['~PRICE_CODE'],
                'USE_PRICE_COUNT' => $arParams['USE_PRICE_COUNT'],
                'SHOW_PRICE_COUNT' => $arParams['SHOW_PRICE_COUNT'],
                'PAGE_ELEMENT_COUNT' => 4,
                'FILTER_IDS' => array($ElementID),

                "SET_TITLE" => "N",
                "SET_BROWSER_TITLE" => "N",
                "SET_META_KEYWORDS" => "N",
                "SET_META_DESCRIPTION" => "N",
                "SET_LAST_MODIFIED" => "N",
                "ADD_SECTIONS_CHAIN" => "N",

                'PRICE_VAT_INCLUDE' => $arParams['PRICE_VAT_INCLUDE'],
                'USE_PRODUCT_QUANTITY' => $arParams['USE_PRODUCT_QUANTITY'],
                'ADD_PROPERTIES_TO_BASKET' => (isset($arParams['ADD_PROPERTIES_TO_BASKET']) ? $arParams['ADD_PROPERTIES_TO_BASKET'] : ''),
                'PARTIAL_PRODUCT_PROPERTIES' => (isset($arParams['PARTIAL_PRODUCT_PROPERTIES']) ? $arParams['PARTIAL_PRODUCT_PROPERTIES'] : ''),
                'PRODUCT_PROPERTIES' => $arParams['PRODUCT_PROPERTIES'],

                'OFFERS_CART_PROPERTIES' => $arParams['OFFERS_CART_PROPERTIES'],
                'OFFERS_FIELD_CODE' => $arParams['LIST_OFFERS_FIELD_CODE'],
                'OFFERS_PROPERTY_CODE' => $arParams['LIST_OFFERS_PROPERTY_CODE'],
                'OFFERS_SORT_FIELD' => $arParams['OFFERS_SORT_FIELD'],
                'OFFERS_SORT_ORDER' => $arParams['OFFERS_SORT_ORDER'],
                'OFFERS_SORT_FIELD2' => $arParams['OFFERS_SORT_FIELD2'],
                'OFFERS_SORT_ORDER2' => $arParams['OFFERS_SORT_ORDER2'],
                'OFFERS_LIMIT' => $arParams['LIST_OFFERS_LIMIT'],

                'SECTION_URL' => $arResult['FOLDER'].$arResult['URL_TEMPLATES']['section'],
                'DETAIL_URL' => $arResult['FOLDER'].$arResult['URL_TEMPLATES']['element'],
                'USE_MAIN_ELEMENT_SECTION' => $arParams['USE_MAIN_ELEMENT_SECTION'],
                'CONVERT_CURRENCY' => $arParams['CONVERT_CURRENCY'],
                'CURRENCY_ID' => $arParams['CURRENCY_ID'],
                'HIDE_NOT_AVAILABLE' => $arParams['HIDE_NOT_AVAILABLE'],
                'HIDE_NOT_AVAILABLE_OFFERS' => $arParams['HIDE_NOT_AVAILABLE_OFFERS'],

                'LABEL_PROP' => $arParams['LABEL_PROP'],
                'LABEL_PROP_MOBILE' => $arParams['LABEL_PROP_MOBILE'],
                'LABEL_PROP_POSITION' => $arParams['LABEL_PROP_POSITION'],
                'ADD_PICT_PROP' => $arParams['ADD_PICT_PROP'],
                'PRODUCT_DISPLAY_MODE' => $arParams['PRODUCT_DISPLAY_MODE'],
                'PRODUCT_BLOCKS_ORDER' => $arParams['LIST_PRODUCT_BLOCKS_ORDER'],
                'PRODUCT_ROW_VARIANTS' => "[{'VARIANT':'3','BIG_DATA':true}]",
                'ENLARGE_PRODUCT' => $arParams['LIST_ENLARGE_PRODUCT'],
                'ENLARGE_PROP' => isset($arParams['LIST_ENLARGE_PROP']) ? $arParams['LIST_ENLARGE_PROP'] : '',
                'SHOW_SLIDER' => $arParams['LIST_SHOW_SLIDER'],
                'SLIDER_INTERVAL' => isset($arParams['LIST_SLIDER_INTERVAL']) ? $arParams['LIST_SLIDER_INTERVAL'] : '',
                'SLIDER_PROGRESS' => isset($arParams['LIST_SLIDER_PROGRESS']) ? $arParams['LIST_SLIDER_PROGRESS'] : '',

                'DISPLAY_TOP_PAGER' => 'N',
                'DISPLAY_BOTTOM_PAGER' => 'N',
                'HIDE_SECTION_DESCRIPTION' => 'Y',

                'RCM_TYPE' => isset($arParams['BIG_DATA_RCM_TYPE']) ? $arParams['BIG_DATA_RCM_TYPE'] : '',
                'RCM_PROD_ID' => $ElementID,
                'SHOW_FROM_SECTION' => 'Y',
                'OFFER_ADD_PICT_PROP' => $arParams['OFFER_ADD_PICT_PROP'],
                'OFFER_TREE_PROPS' => $arParams['OFFER_TREE_PROPS'],
                'PRODUCT_SUBSCRIPTION' => $arParams['PRODUCT_SUBSCRIPTION'],
                'SHOW_DISCOUNT_PERCENT' => $arParams['SHOW_DISCOUNT_PERCENT'],
                'DISCOUNT_PERCENT_POSITION' => $arParams['DISCOUNT_PERCENT_POSITION'],
                'SHOW_OLD_PRICE' => $arParams['SHOW_OLD_PRICE'],
                'SHOW_MAX_QUANTITY' => $arParams['SHOW_MAX_QUANTITY'],
                'MESS_SHOW_MAX_QUANTITY' => (isset($arParams['~MESS_SHOW_MAX_QUANTITY']) ? $arParams['~MESS_SHOW_MAX_QUANTITY'] : ''),
                'RELATIVE_QUANTITY_FACTOR' => (isset($arParams['RELATIVE_QUANTITY_FACTOR']) ? $arParams['RELATIVE_QUANTITY_FACTOR'] : ''),
                'MESS_RELATIVE_QUANTITY_MANY' => (isset($arParams['~MESS_RELATIVE_QUANTITY_MANY']) ? $arParams['~MESS_RELATIVE_QUANTITY_MANY'] : ''),
                'MESS_RELATIVE_QUANTITY_FEW' => (isset($arParams['~MESS_RELATIVE_QUANTITY_FEW']) ? $arParams['~MESS_RELATIVE_QUANTITY_FEW'] : ''),
                'MESS_BTN_BUY' => (isset($arParams['~MESS_BTN_BUY']) ? $arParams['~MESS_BTN_BUY'] : ''),
                'MESS_BTN_ADD_TO_BASKET' => (isset($arParams['~MESS_BTN_ADD_TO_BASKET']) ? $arParams['~MESS_BTN_ADD_TO_BASKET'] : ''),
                'MESS_BTN_SUBSCRIBE' => (isset($arParams['~MESS_BTN_SUBSCRIBE']) ? $arParams['~MESS_BTN_SUBSCRIBE'] : ''),
                'MESS_BTN_DETAIL' => (isset($arParams['~MESS_BTN_DETAIL']) ? $arParams['~MESS_BTN_DETAIL'] : ''),
                'MESS_NOT_AVAILABLE' => (isset($arParams['~MESS_NOT_AVAILABLE']) ? $arParams['~MESS_NOT_AVAILABLE'] : ''),
                'MESS_BTN_COMPARE' => (isset($arParams['~MESS_BTN_COMPARE']) ? $arParams['~MESS_BTN_COMPARE'] : ''),

                'USE_ENHANCED_ECOMMERCE' => (isset($arParams['USE_ENHANCED_ECOMMERCE']) ? $arParams['USE_ENHANCED_ECOMMERCE'] : ''),
                'DATA_LAYER_NAME' => (isset($arParams['DATA_LAYER_NAME']) ? $arParams['DATA_LAYER_NAME'] : ''),
                'BRAND_PROPERTY' => (isset($arParams['BRAND_PROPERTY']) ? $arParams['BRAND_PROPERTY'] : ''),

                'TEMPLATE_THEME' => (isset($arParams['TEMPLATE_THEME']) ? $arParams['TEMPLATE_THEME'] : ''),
                'ADD_TO_BASKET_ACTION' => $basketAction,
                'SHOW_CLOSE_POPUP' => isset($arParams['COMMON_SHOW_CLOSE_POPUP']) ? $arParams['COMMON_SHOW_CLOSE_POPUP'] : '',
                'COMPARE_PATH' => $arResult['FOLDER'].$arResult['URL_TEMPLATES']['compare'],
                'COMPARE_NAME' => $arParams['COMPARE_NAME'],
                'BACKGROUND_IMAGE' => '',
                'DISABLE_INIT_JS_IN_COMPONENT' => (isset($arParams['DISABLE_INIT_JS_IN_COMPONENT']) ? $arParams['DISABLE_INIT_JS_IN_COMPONENT'] : '')
            ),
            $component
        );
        */?>
        <?    
    }
    ?>
    <?
    if (CModule::IncludeModule('iblock'))
    {
        $arElement = getIBlockElement($ElementID);
        $arProps = $arElement['PROPERTIES'];

        $dbReview = CIBlockElement::GetList(Array(), Array("IBLOCK_ID"=>28, "ACTIVE"=>"Y", "PROPERTY_TOVAR"=>$ElementID),false,false,array("PROPERTY_OCENKA"));
        $countReviews = $dbReview->SelectedRowsCount();
        $iCounterReviews = 0;
        $sumReiting = 0;
        while ($arrInfoResponse = $dbReview->GetNext())
        {
            $iCounterReviews++;
            $sumReiting += $arrInfoResponse["PROPERTY_OCENKA_VALUE"];
        }
        if ($sumReiting && $iCounterReviews) 
        {
            $setReiting = $sumReiting / $iCounterReviews;
            $setReitingCSS = ($setReiting * 100) / 5;
            
            $starsPercent = array();
            $difference = number_format($setReiting, 1) - intval($setReiting);
            for($i = 0; intval($setReiting) > $i; $i++)
            {
                $starsPercent[] = 100;
            }

            if($difference > 0)
            {
                $starsPercent[] = 100 * $difference;    
            }
        }
        else
        {
            $setReiting = 0;
        }

        $dbLoc = CIBlockElement::GetList(Array('SORT' => 'ASC'), Array('IBLOCK_ID' => 23, 'ACTIVE' => 'Y'), false, false, Array("ID","NAME","PROPERTY_REGION"));
        while ($resLoc = $dbLoc->GetNext())
        {
            $arLocations[$resLoc["ID"]] = $resLoc;
        }
    }
    ?>
    <?
    $showPropSection = false;
    $resListSectionThisElem = CIBlockElement::GetElementGroups($ElementID);
    $nextSection = true;
    while (($arr = $resListSectionThisElem->GetNext()) && $nextSection) {
        if ($arr["ID"] > 0) {
            $paramProps = CIBlockElement::GetList(array(), array("IBLOCK_ID" => 27, "PROPERTY_4945" => $arr["ID"]))->GetNextElement();
            $listProp = array();
            if ($paramProps) {
                $showListProps = $paramProps->GetProperty(4940);
                $showListPropsForGroup = $paramProps->GetProperty(4942);
                $listProp["START"] = $paramProps->GetProperty(4943)["VALUE"];
                $listProp["STOP"] = $paramProps->GetProperty(4944)["VALUE"];
                $listProp["ADD"] = $paramProps->GetProperty(4947)["VALUE"];
                $listProp["DELETE"] = $paramProps->GetProperty(4946)["VALUE"];
                if (($showListProps["VALUE_XML_ID"] == "Y") && (CSite::InGroup($showListPropsForGroup["VALUE_XML_ID"]))) {
                    $showPropSection = true;
                    $nextSection = false;
                    $setSelectSection = $arr["NAME"];
                }
            }
        }
    }
    // ?GETSECTIONS - показывает разделы элемента, если пользователь принадлежит группам array(1,16,20)
    $listUserGroup = $USER->GetUserGroupArray();
    if ((count(array_intersect($listUserGroup,array(1,16,20)))>0) && isset($_REQUEST["GETSECTIONS"])){
        $APPLICATION->RestartBuffer();
        $resListSectionThisElem = CIBlockElement::GetElementGroups($ElementID);
        while ($arr = $resListSectionThisElem->GetNext()) {
            if ($arElement["IBLOCK_SECTION_ID"] == $arr["ID"]){
                echo "<b>[".$arr["ID"]."] ".$arr["NAME"]."</b><hr />";
            }
            else{
                echo "[".$arr["ID"]."] ".$arr["NAME"]."<hr />";
            }
        }
        die();
    }
    $resListSectionThisElem = CIBlockElement::GetElementGroups($ElementID);


//генерация описания на карточках товара
    if (empty($arElement['DETAIL_TEXT'])) {
        $res = CIBlockSection::GetByID($arElement["IBLOCK_SECTION_ID"]);
        $ar_res = $res->GetNext();
        $arElement['DETAIL_TEXT'] = 'Для успешной охоты, развлекательной и спортивной стрельбы, длительного туристического похода, кратковременной вылазки на природу или просто активного отдыха необходима правильная подготовка — от выбора оружия и сопутствующих аксессуаров до снаряжения, экипировки, специальных приспособлений для приготовления пищи. Мы собрали все необходимое в одном каталоге. '.$arElement['NAME'].' и другие товары из категории «'.$ar_res['NAME'].'» продаются с официальной гарантией и проходят строгую предпродажную проверку. А экспертные советы от сотрудников магазина упростят подбор позиций для конкретной цели.';
    }


    ?>
    <div class="content">
        <div class="center_column">
            <div class="section detail_section">
                <ul class="not_style tabs detail_tabs display_none_m display_none_mp">
                    <?if (!empty($arElement['DETAIL_TEXT']) || $arProps['DOCS_PDF']['VALUE']):?>
                        <li class="current" id="description_product">ОПИСАНИЕ</li>
                    <?endif;?>
                    <?if ($showPropSection):?>
                        <li<?=empty($arElement['DETAIL_TEXT']) && !$arProps['DOCS_PDF']['VALUE'] ? ' class="current"' : ''?>>ХАРАКТЕРИСТИКИ</li>
                    <?endif;?>
                    <li class="tab_reviews<?=empty($arElement['DETAIL_TEXT']) && !$arProps['DOCS_PDF']['VALUE'] && !$showPropSection ? ' current' : ''?>">отзывы о товаре (<?=$countReviews?>)</li>
                    <?if ($arProps['AKSESSUARY']['VALUE']):?><li>аксессуары</li><?endif;?>
                   
                    <li id="deliv_and_store">забрать / доставить</li>
                </ul>
                <?if (!empty($arElement['DETAIL_TEXT']) || $arProps['DOCS_PDF']['VALUE']):?>
                    <div class="box detail_box b1" style="display:block;">
                        <a class="display_none_c display_none_p mobile_text_el_button js_mobile_text_el_button" id="description_product_mobile" href="">ОПИСАНИЕ</a>
                        <div class="js_mobile_text_el_light">
                            <?if ($arProps['DOCS_PDF']['VALUE']):?>
                                <div class="detail_pdf_title">Инструкции и документы</div>
                                <div class="detail_pdf_el_block">
                                    <?foreach($arProps['DOCS_PDF']['VALUE'] as $doc):?>
                                        <?$arFile = CFile::GetFileArray($doc)?>
                                        <a target="_blank" class="detail_pdf_el" href="<?=$arFile['SRC']?>">Скачать <?=$arFile['ORIGINAL_NAME']?> (<?=round($arFile['FILE_SIZE']/1024/1024)?> Мб)</a>
                                    <?endforeach?>
                                </div>
                            <?endif;?>
                            <div><?php
                                $old = array('http://www.diada-arms.ru', 'http://diada-arms.ru','https://diada-arms.ru');
                                $new = array('https://www.diada-arms.ru','https://www.diada-arms.ru','https://www.diada-arms.ru');
                                echo str_replace($old, $new,$arElement['DETAIL_TEXT']);?></div>
                        </div>
                    </div>
                <?endif;?>
                <?if ($showPropSection):?>
                    <div class="box detail_box b2"<?=empty($arElement['DETAIL_TEXT']) && !$arProps['DOCS_PDF']['VALUE'] ? ' style="display:block;"' : ''?>>
                    <a class="display_none_c display_none_p mobile_text_el_button js_mobile_text_el_button" href="">ХАРАКТЕРИСТИКИ</a>
                    <div class="js_mobile_text_el_light">
                        <table class="detail_table_option" data-select-section="<?=$setSelectSection?>">
                            <?
                            
                            if (is_array($listProp)) {
                                if (
                                    ($listProp["START"] > 0)
                                    &&
                                    ($listProp["STOP"] > 0)
                                    &&
                                    ($listProp["START"] < $listProp["STOP"])
                                ) {
                                    ?>
                                    <?
                                    $arPropLink = CIBlockSectionPropertyLink::GetArray(1, 0); ?>
                                    <?
                                    foreach ($arProps as $code => $arP): ?>
                                        <?
                                        if (
                                            (($arP['ID'] >= $listProp["START"] && $arP['ID'] <= $listProp["STOP"]) || (in_array($arP['ID'], $listProp["ADD"])))
                                            &&
                                            ($arP['VALUE'] && !in_array($arP['ID'], $listProp["DELETE"]))
                                        ): ?>
                                            <?
                                            $showHint = "";
                                            if (strlen($arPropLink[$arP['ID']]["FILTER_HINT"]) > 0) {
                                                $showHint = $arPropLink[$arP['ID']]["FILTER_HINT"];
                                            } else {
                                                $showHint = $arP['HINT'];
                                            } ?>
                                            <?if ($arP["ID"] == 5087):?>
                                            <?else:
                                            
                                                $link = "";
                                                $resData = $entity_requests_data_class::getList(array(
                                                     'select' => array("*"),
                                                     'filter' => array(
                                                        "UF_PROPERTY_ID" => $arP["ID"],
                                                        "UF_ENUM_ID" => $arP["VALUE_ENUM_ID"],
                                                        "!UF_LINK" => false
                                                     ),
                                                     'order' => array(),
                                                     'limit' => false,
                                                ));
                                                while ($arHlItem = $resData->Fetch())
                                                {
                                                    if(is_array($arP["VALUE"]))
                                                    {
                                                        $valKey = array_search($arHlItem["UF_ENUM_ID"], $arP["VALUE_ENUM_ID"]);
                                                        if(isset($arP["VALUE"][$valKey]))
                                                        {
                                                            $arP["VALUE"][$valKey] = '<a href="'.$arHlItem["UF_LINK"].'" target="_blank">'.$arP["VALUE"][$valKey].'</a>';    
                                                        }
                                                    }
                                                    else
                                                    {
                                                        $arP["VALUE"] = '<a href="'.$arHlItem["UF_LINK"].'" target="_blank">'.$arP['VALUE'].'</a>';
                                                    }
                                                }
                                            ?>
                                                <tr>
                                                    <td>
                                                        <?= $arP['NAME'] ?>: <?
                                                        if ($showHint): ?><span class="podskazka_block">?<span
                                                                    class="podskazka_text"><span><?= $showHint ?></span></span>
                                                            </span><?endif; ?></td>
                                                    <td>
                                                        <?= (is_array($arP['VALUE'])) ? implode('/', $arP['VALUE']) : $arP['VALUE'] ?>
                                                        
                                                        <?if(!empty($link)):?>
                                                            <a href="<?=$link?>" target="_blank"><?= (is_array($arP['VALUE'])) ? implode('/', $arP['VALUE']) : $arP['VALUE'] ?></a>
                                                        <?else:?>
                                                            
                                                        <?endif;?>
                                                    </td>
                                                </tr>
                                            <?endif;?>
                                        <?endif; ?>
                                    <?endforeach; ?>
                                    <?
                                    if (
                                        ((5087 >= $listProp["START"] && 5087 <= $listProp["STOP"]) || (in_array(5087, $listProp["ADD"])))
                                        &&
                                        (5087 && !in_array(5087, $listProp["DELETE"]))
                                    ){
                                        ?>
                                        <?if (strlen($arProps["SERTIFICATE_PREVIEW"]["VALUE"])>0 && $arProps["SERTIFICATE"]["VALUE"]>0):?>
                                            <tr>
                                                <td style="vertical-align: middle;">Сертификат:</td>
                                                <td><a target="_blank" href="<?=CFile::GetPath($arProps["SERTIFICATE"]["VALUE"])?>"><img style="max-width: 100px; max-height: 200px" src="/img/prop_sertificate/<?=$arProps["SERTIFICATE_PREVIEW"]["VALUE"]?>"></a></td>
                                            </tr>
                                        <?endif;?>
                                        <?
                                    }
                                    ?>
                                    <?
                                }
                            }
                            ?>
                        </table>
                    </div>
                </div>
                <?endif;?>
                <?
                $sort = 'ID';
                $order = 'desc';
                if(!empty($_REQUEST["sort"]))
                {
                    switch ($_REQUEST["sort"])
                    {
                        case "new":
                            $sort = 'ID';
                            $order = 'desc';
                        break;
                        case "old":
                            $sort = 'ID';
                            $order = 'asc';
                        break;    
                    }
                }
                ?>
                <div class="box detail_box b3"<?=empty($arElement['DETAIL_TEXT']) && !$arProps['DOCS_PDF']['VALUE'] && !$showPropSection ? ' style="display:block;"' : ''?>>
                    <a class="display_none_c display_none_p mobile_text_el_button js_mobile_text_el_button mobile_tab_revies" href="">отзывы о товаре (<?=$countReviews?>)</a>
                    <?
                    if($_SERVER['REQUEST_METHOD'] == 'POST' && $_REQUEST['action'] == 'reviewSort')
                    {
                        $APPLICATION->RestartBuffer();
                    }
                    ?>
                    <div class="js_mobile_text_el_light" id="js_mobile_text_el_light">
                        <?if($iCounterReviews > 0):?>
                        <span itemscope itemtype="http://schema.org/AggregateRating" itemprop="aggregateRating">
                            <meta itemprop="itemReviewed" content="<!--h1-->">
                            <meta itemprop="ratingValue" content="<?=$setReiting?>">
                            <meta itemprop="reviewCount" content="<?=$iCounterReviews?>">
                            <meta itemprop="ratingCount" content="<?=$iCounterReviews?>">
                            <meta itemprop="bestRating" content="5" />
                            <meta itemprop="worstRating" content="1" />
                        </span>
                        <?endif;?>

                        <div class="block_reviews" style="margin-bottom: 10px;">
                            <div class="det_comm_star_bl">
                                <?
                                for($i = 0; 5 > $i; $i++)
                                {
                                    if(isset($starsPercent[$i]))
                                    {
                                        ?>
                                        <div class="det_comm_star_el"><i style="width:<?=$starsPercent[$i]?>%;"></i></div>
                                        <?
                                    }
                                    else
                                    {
                                        ?>
                                        <div class="det_comm_star_el"><i></i></div>
                                        <?    
                                    }    
                                }
                                ?>
                            </div>
                            <div style="display: inline-block;margin-left: 10px; position: relative;top: -7px;">
                                <span style="padding: 2px 5px;background: rgba(255, 174, 0, 0.26); font-weight: bold"><?=number_format($setReiting,1);?></span> На основании <?=$iCounterReviews?> оценок
                            </div>
                        </div>
                        <ul class="not_style detail_comment_info_list">
                            <li><a class="detail_red_button fancy_ajax" href="/include/popup_review.php?id=<?=$arElement['ID']?>">Добавить отзыв</a></li>
                            <li><?=$countReviews?> покупателей оставили отзыв</li>
                            <li>
                                Сначала:
                                <select name="SORT" onchange="sort($(this).val()); return false;" class="select-default">
                                    <option value="<?=$APPLICATION->GetCurPageParam("sort=new", array("sort"))?>"<?=$_REQUEST["sort"] == "new" ? " selected" : ""?>>новые</option>
                                    <option value="<?=$APPLICATION->GetCurPageParam("sort=old", array("sort"))?>"<?=$_REQUEST["sort"] == "old" ? " selected" : ""?>>старые</option>
                                </select>
                            </li>
                        </ul>
                        <?global $arrFilterReviews;?>
                        <?$arrFilterReviews = Array("PROPERTY_TOVAR"=>$ElementID);?>
                        <?$APPLICATION->IncludeComponent(
                            "bitrix:news.list",
                            "otzivy_tovar",
                            Array(
                                "ACTIVE_DATE_FORMAT" => "j F Y",
                                "ADD_SECTIONS_CHAIN" => "N",
                                "AJAX_MODE" => "N",
                                "AJAX_OPTION_ADDITIONAL" => "",
                                "AJAX_OPTION_HISTORY" => "N",
                                "AJAX_OPTION_JUMP" => "N",
                                "AJAX_OPTION_STYLE" => "Y",
                                "CACHE_FILTER" => "Y",
                                "CACHE_GROUPS" => "Y",
                                "CACHE_TIME" => "36000000",
                                "CACHE_TYPE" => "A",
                                "CHECK_DATES" => "Y",
                                "DETAIL_URL" => "",
                                "DISPLAY_BOTTOM_PAGER" => "N",
                                "DISPLAY_DATE" => "N",
                                "DISPLAY_NAME" => "N",
                                "DISPLAY_PICTURE" => "N",
                                "DISPLAY_PREVIEW_TEXT" => "Y",
                                "DISPLAY_TOP_PAGER" => "N",
                                "FIELD_CODE" => array("", ""),
                                "FILTER_NAME" => "arrFilterReviews",
                                "HIDE_LINK_WHEN_NO_DETAIL" => "N",
                                "IBLOCK_ID" => "28",
                                "IBLOCK_TYPE" => "servis",
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
                                "PROPERTY_CODE" => array("NAME", ""),
                                "SET_BROWSER_TITLE" => "N",
                                "SET_LAST_MODIFIED" => "N",
                                "SET_META_DESCRIPTION" => "N",
                                "SET_META_KEYWORDS" => "Y",
                                "SET_STATUS_404" => "N",
                                "SET_TITLE" => "N",
                                "SHOW_404" => "N",
                                "SORT_BY1" => $sort,
                                "SORT_BY2" => "SORT",
                                "SORT_ORDER1" => $order,
                                "SORT_ORDER2" => "ASC"
                            )
                        );?>
                    </div>
                    <?
                    if($_SERVER['REQUEST_METHOD'] == 'POST' && $_REQUEST['action'] == 'reviewSort')
                    {
                        die();
                    }
                    ?>
                </div>
                <?if ($arProps['AKSESSUARY']['VALUE']):?>
                <div class="box detail_box b4">
                    <a class="display_none_c display_none_p mobile_text_el_button js_mobile_text_el_button" href="">аксессуары</a>
                    <div class="js_mobile_text_el_light">
                        <div>
                            <div class="detail_top_accessory_left_col">
                                <div class="display_none_p display_none_c detail_accessory_title">Категории</div>
                                <a class="display_none_c display_none_p detail_top_accessory_button js_detail_top_accessory_button" href=""></a>
                                <div class="detail_top_accessory_light js_detail_top_accessory_light">
                                <div class="display_none_m display_none_mp detail_accessory_title">Категории:</div>
                                    <?$APPLICATION->IncludeComponent(
                                        "salavey:catalog.section.list.aksessuary",
                                        "",
                                        Array(
                                            "ADD_SECTIONS_CHAIN" => "N",
                                            "CACHE_GROUPS" => "Y",
                                            "CACHE_TIME" => "36000000",
                                            "CACHE_TYPE" => "A",
                                            "COUNT_ELEMENTS" => "Y",
                                            "IBLOCK_ID" => "1",
                                            "IBLOCK_TYPE" => "ibCatalog",
                                            "SECTION_CODE" => "",
                                            "SECTION_FIELDS" => array("NAME",""),
                                            "SECTION_ID" => $arProps['AKSESSUARY']['VALUE'],
                                            "SECTION_URL" => "",
                                            "SECTION_USER_FIELDS" => array("",""),
                                            "SHOW_PARENT_NAME" => "Y",
                                            "TOP_DEPTH" => "10",
                                            "VIEW_MODE" => "LINE",
                                            "ELEMENT_ID" => $arElement['ID'],
                                        )
                                    );?>
                                </div>
                            </div>
                            <div class="detail_top_accessory_right_col">
                                <?global $arrFilter;?>
                                <?
                                $arrFilter = Array("!ID"=>$arElement['ID']);
                                $sortData = array( 
                                    2 => 'SORT', 
                                    3 => 'SHOWS', 
                                    1 => 'PROPERTYSORT_INDIKATOR', 
                                );
                                $orderData = array( 
                                    2 => 'asc', 
                                    3 => 'desc', 
                                    1 => 'asc', 
                                );
                                ?>
                                <?$APPLICATION->IncludeComponent(
                                    "salavey:catalog.section.inherited",
                                    "detail.aksessuary",
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
                                        "CACHE_FILTER" => "Y",
                                        "CACHE_GROUPS" => "Y",
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
                                        "PAGER_TEMPLATE" => "lazyload",
                                        "PAGER_TITLE" => "Товары",
                                        "PAGE_ELEMENT_COUNT" => "6",
                                        "PARTIAL_PRODUCT_PROPERTIES" => "N",
                                        "PRICE_CODE" => array("base"),
                                        "PRICE_VAT_INCLUDE" => "Y",
                                        "PRODUCT_ID_VARIABLE" => "id",
                                        "PRODUCT_PROPERTIES" => array(),
                                        "PRODUCT_PROPS_VARIABLE" => "prop",
                                        "PRODUCT_QUANTITY_VARIABLE" => "",
                                        "PRODUCT_SUBSCRIPTION" => "N",
                                        "PROPERTY_CODE" => array("INDIKATOR", ""),
                                        "SECTION_CODE" => "",
                                        "SECTION_ID" => $arProps['AKSESSUARY']['VALUE'][0],
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
                                        "AJAX_MODE" => "Y",
                                        'DISPLAY_COMPARE' => (isset($arParams['USE_COMPARE']) ? $arParams['USE_COMPARE'] : ''),
                                        //"IN_BASKET" => $arParams['IN_BASKET'],
                                    )
                                );?>
                            </div>
                            <div class="clear"></div>
                        </div>
                    </div>
                </div>
                <?endif;?>
				<?/*
                <div class="box detail_box b5">
                    <a class="display_none_c display_none_p mobile_text_el_button js_mobile_text_el_button" href="">услуги</a>
                    <div class="js_mobile_text_el_light">
                        <ul class="not_style detail_services_list">
                            <li><a class="detail_services_present fancy_ajax" href="/include/popup_packing.php">Упаковать в подарок?</a></li>
                            <li>300 руб.</li>
                        </ul>
                        <ul class="not_style detail_services_list">
                            <li><a class="detail_services_grav fancy_ajax" href="/include/popup_graving.php?PRODUCT_ID=<?=$arElement['ID']?>">Сделать гравировку?</a></li>
                            <li>900-1500 руб.</li>
                        </ul>
                    </div>
                </div>
				*/?>
                <div class="box detail_box b5" id="dostavka_region_block">
                    <?\Bitrix\Main\Page\Frame::getInstance()->startDynamicWithID("dostavka_region_block");?>
                    <noindex>
                        <?$startRegion = getContactsElementID(23);?>
                        <div class="cont_city_tabs_bl">
                            <div class="cont_city_select_bl">
                                <div class="cont_city_tit">Выберите свой город из списка</div>
                                <div class="cont_city_select">                                        
                                    <a class="cont_city_select_bt" href="javascript:void(0);">Ваш город: <b><?=$arLocations[$startRegion]['NAME']?></b></a>
                                    <div class="cont_city_select_list">
                                        <?foreach($arLocations as $key => $arList):?>
                                            <a href="javascript:void(0);" data-id="<?=$arList['PROPERTY_REGION_VALUE']?>" data-element="<?=$arList['ID']?>"><?=$arList['NAME']?></a>
                                        <?endforeach;?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?/*?>
                        <div class="dostavka_region_title_block js_dostavka_region_title_block">
                            <div><div>Вы можете получить заказ в: <a class="dostavka_region_title js_dostavka_region_title" href=""><?=$arLocations[$startRegion]['NAME']?></a></div></div>
                            <div class="dostavka_region_title_podskazka">
                                Нажмите для выбора региона
                                <img class="dostavka_region_title_podskazka_arrow" src="/img/dostavka_region_title_podskazka_arrow.png">
                            </div>
                            <ul class="not_style dostavka_region_title_list_light js_dostavka_region_title_list_light">
                                <?foreach($arLocations as $key => $arList):?>
                                    <li><a href="" data-id="<?=$arList['PROPERTY_REGION_VALUE']?>" data-element="<?=$arList['ID']?>"><?=$arList['NAME']?></a></li>
                                <?endforeach;?>
                            </ul>
                        </div>
                        <?*/?>
                        <div class="detail_delivery">
                        <script src="//api-maps.yandex.ru/2.0-stable/?load=package.full&lang=ru-RU" type="text/javascript"></script>
                        <?
                        $APPLICATION->IncludeComponent(
                            "salavey:detail.delivery",
                            "",
                            Array(
                                "LOCATION_ID"=> $arLocations[$startRegion]['PROPERTY_REGION_VALUE'],
                                "ELEMENT_ID"=> $arLocations[$startRegion]["ID"],
                            )
                        );
                        ?>
                        </div>
                    </noindex>
                    <?
                    \Bitrix\Main\Page\Frame::getInstance()->finishDynamicWithID("dostavka_region_block", "Загрузка...");
                    ?>
                </div>
            </div>
            <?if ($arProps['VIDEO_IFRAME']['VALUE']):?>
                <div class="video det_double_video" style="text-align: center;">
                    <?foreach($arProps['VIDEO_IFRAME']['~VALUE'] as $video):?>                                                                                                                                  
                        <div class="det_double_video_el"><?=str_replace(array("https://www.youtube.com/v/","<iframe"),array("https://www.youtube.com/embed/", "<iframe style='margin: 0 auto;'"),$video)?></div>
                    <?endforeach;?>
                </div>                
            <?endif;?>
            <?if ($arProps['POHOG']['VALUE']):?>
                <div class="">
					<ul class="category_produce not_style" style="">
						<li class="category_name_block"><p class="category_name gray_hit">Похожие товары</p></li>
						<li class="category_linear"></li>
					</ul>
                    <div class="detail_similar_items_slider_block new_det_other_prod">
                        <?global $arFilterPohog?>
                        <?$arFilterPohog = Array("ID"=>$arProps['POHOG']['VALUE'])?>
                        <?$APPLICATION->IncludeComponent(
                            "salavey:catalog.section.inherited",
                            "detail_pohogie_new",
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
                                "CACHE_FILTER" => "Y",
                                "CACHE_GROUPS" => "Y",
                                "CACHE_TIME" => "360000",
                                "CACHE_TYPE" => "A",
                                "CONVERT_CURRENCY" => "N",
                                "DETAIL_URL" => "",
                                "DISABLE_INIT_JS_IN_COMPONENT" => "N",
                                "DISPLAY_BOTTOM_PAGER" => "N",
                                "DISPLAY_TOP_PAGER" => "N",
                                "ELEMENT_SORT_FIELD" => "PROPERTYSORT_INDIKATOR",
                                "ELEMENT_SORT_ORDER" => "asc",
                                "ELEMENT_SORT_FIELD2" => "SORT",
                                "ELEMENT_SORT_ORDER2" => "asc",
                                "ELEMENT_SORT_FIELD3" => "SHOWS",
                                "ELEMENT_SORT_ORDER3" => "desc",
                                "FILTER_NAME" => "arFilterPohog",
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
                                "PAGE_ELEMENT_COUNT" => "10",
                                "PARTIAL_PRODUCT_PROPERTIES" => "N",
                                "PRICE_CODE" => array("base"),
                                "PRICE_VAT_INCLUDE" => "Y",
                                "PRODUCT_ID_VARIABLE" => "id",
                                "PRODUCT_PROPERTIES" => array(),
                                "PRODUCT_PROPS_VARIABLE" => "prop",
                                "PRODUCT_QUANTITY_VARIABLE" => "",
                                "PRODUCT_SUBSCRIPTION" => "N",
                                "PROPERTY_CODE" => array("INDIKATOR", ""),
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
                                'DISPLAY_COMPARE' => (isset($arParams['USE_COMPARE']) ? $arParams['USE_COMPARE'] : ''),
                                //"IN_BASKET" => $arParams['IN_BASKET'],
                            )
                        );?>
                    </div>
                </div>            
            <?endif;?>
            <div class="display_none_m display_none_mp">
                <div class="detail_big_title_bottom_linear small">Вы смотрели</div>
                <div id="viewed_items">
                    <?\Bitrix\Main\Page\Frame::getInstance()->startDynamicWithID("viewed_items");?>
                    <?
                    global $arFilterView;
                    $dbSaleView = CSaleViewedProduct::GetList(Array("DATE_VISIT"=>"DESC"), Array("FUSER_ID" => CSaleBasket::GetBasketUserID(), "!PRODUCT_ID" => $ElementID), false, Array("nTopCount"=>3));
                    while($resSaleView = $dbSaleView->GetNext())
                    {
                        $arFilterView['ID'][] = $resSaleView['PRODUCT_ID'];
                    }
                    ?>
                    <?$APPLICATION->IncludeComponent(
                        "bitrix:catalog.section",
                        "detail_prosmotrennye_new",
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
                            "CACHE_FILTER" => "Y",
                            "CACHE_GROUPS" => "Y",
                            "CACHE_TIME" => "36000000",
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
                            "FILTER_NAME" => "arFilterView",
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
                            "OFFERS_LIMIT" => "3",
                            "PAGER_BASE_LINK_ENABLE" => "N",
                            "PAGER_DESC_NUMBERING" => "N",
                            "PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
                            "PAGER_SHOW_ALL" => "N",
                            "PAGER_SHOW_ALWAYS" => "N",
                            "PAGER_TEMPLATE" => ".default",
                            "PAGER_TITLE" => "Товары",
                            "PAGE_ELEMENT_COUNT" => "3",
                            "PARTIAL_PRODUCT_PROPERTIES" => "N",
                            "PRICE_CODE" => array("base"),
                            "PRICE_VAT_INCLUDE" => "Y",
                            "PRODUCT_ID_VARIABLE" => "id",
                            "PRODUCT_PROPERTIES" => array(),
                            "PRODUCT_PROPS_VARIABLE" => "prop",
                            "PRODUCT_QUANTITY_VARIABLE" => "",
                            "PRODUCT_SUBSCRIPTION" => "N",
                            "PROPERTY_CODE" => array("INDIKATOR", ""),
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
                            'DISPLAY_COMPARE' => (isset($arParams['USE_COMPARE']) ? $arParams['USE_COMPARE'] : ''),
                            //"IN_BASKET" => $arParams['IN_BASKET'],
                        )
                    );?>
                    <?\Bitrix\Main\Page\Frame::getInstance()->finishDynamicWithID("viewed_items", "Загрузка...");?>
                </div>
            </div>
        </div>
        <div class="right_column display_none_m dispay_none_mp">
            <div class="display_none_m display_none_mp">
                <div class="h2 detail_right_produce_h2">Рекомендуем</div>
                <div class="detail_right_produce_slider_block carousel_slider_brend_block">
                    <?$APPLICATION->IncludeComponent(
                        'salavey:catalog.section.inherited',
                        'big_data_detail_new',
                        array(
                            'IBLOCK_TYPE' => $arParams['IBLOCK_TYPE'],
                            'IBLOCK_ID' => $arParams['IBLOCK_ID'],
                            /*'SECTION_ID' => $arResult['VARIABLES']['SECTION_ID'],
                            'SECTION_CODE' => $arResult['VARIABLES']['SECTION_CODE'],*/
                            'ELEMENT_SORT_FIELD' => 'shows',
                            'ELEMENT_SORT_ORDER' => 'desc',
                            'ELEMENT_SORT_FIELD2' => 'sort',
                            'ELEMENT_SORT_ORDER2' => 'asc',
                            'PROPERTY_CODE' => $arParams['LIST_PROPERTY_CODE'],
                            'PROPERTY_CODE_MOBILE' => $arParams['LIST_PROPERTY_CODE_MOBILE'],
                            'INCLUDE_SUBSECTIONS' => $arParams['INCLUDE_SUBSECTIONS'],
                            'BASKET_URL' => $arParams['BASKET_URL'],
                            'ACTION_VARIABLE' => $arParams['ACTION_VARIABLE'],
                            'PRODUCT_ID_VARIABLE' => $arParams['PRODUCT_ID_VARIABLE'],
                            'SECTION_ID_VARIABLE' => $arParams['SECTION_ID_VARIABLE'],
                            'PRODUCT_QUANTITY_VARIABLE' => $arParams['PRODUCT_QUANTITY_VARIABLE'],
                            'PRODUCT_PROPS_VARIABLE' => $arParams['PRODUCT_PROPS_VARIABLE'],
                            'CACHE_TYPE' => 'N',
                            'CACHE_TIME' => $arParams['CACHE_TIME'],
                            'CACHE_FILTER' => $arParams['CACHE_FILTER'],
                            'CACHE_GROUPS' => $arParams['CACHE_GROUPS'],
                            'DISPLAY_COMPARE' => $arParams['USE_COMPARE'],
                            'PRICE_CODE' => $arParams['~PRICE_CODE'],
                            'USE_PRICE_COUNT' => $arParams['USE_PRICE_COUNT'],
                            'SHOW_PRICE_COUNT' => $arParams['SHOW_PRICE_COUNT'],
                            'PAGE_ELEMENT_COUNT' => 4,
                            'FILTER_IDS' => array($ElementID),

                            "SET_TITLE" => "N",
                            "SET_BROWSER_TITLE" => "N",
                            "SET_META_KEYWORDS" => "N",
                            "SET_META_DESCRIPTION" => "N",
                            "SET_LAST_MODIFIED" => "N",
                            "ADD_SECTIONS_CHAIN" => "N",

                            'PRICE_VAT_INCLUDE' => $arParams['PRICE_VAT_INCLUDE'],
                            'USE_PRODUCT_QUANTITY' => $arParams['USE_PRODUCT_QUANTITY'],
                            'ADD_PROPERTIES_TO_BASKET' => (isset($arParams['ADD_PROPERTIES_TO_BASKET']) ? $arParams['ADD_PROPERTIES_TO_BASKET'] : ''),
                            'PARTIAL_PRODUCT_PROPERTIES' => (isset($arParams['PARTIAL_PRODUCT_PROPERTIES']) ? $arParams['PARTIAL_PRODUCT_PROPERTIES'] : ''),
                            'PRODUCT_PROPERTIES' => $arParams['PRODUCT_PROPERTIES'],

                            'OFFERS_CART_PROPERTIES' => $arParams['OFFERS_CART_PROPERTIES'],
                            'OFFERS_FIELD_CODE' => $arParams['LIST_OFFERS_FIELD_CODE'],
                            'OFFERS_PROPERTY_CODE' => $arParams['LIST_OFFERS_PROPERTY_CODE'],
                            'OFFERS_SORT_FIELD' => $arParams['OFFERS_SORT_FIELD'],
                            'OFFERS_SORT_ORDER' => $arParams['OFFERS_SORT_ORDER'],
                            'OFFERS_SORT_FIELD2' => $arParams['OFFERS_SORT_FIELD2'],
                            'OFFERS_SORT_ORDER2' => $arParams['OFFERS_SORT_ORDER2'],
                            'OFFERS_LIMIT' => $arParams['LIST_OFFERS_LIMIT'],

                            'SECTION_URL' => $arResult['FOLDER'].$arResult['URL_TEMPLATES']['section'],
                            'DETAIL_URL' => $arResult['FOLDER'].$arResult['URL_TEMPLATES']['element'],
                            'USE_MAIN_ELEMENT_SECTION' => $arParams['USE_MAIN_ELEMENT_SECTION'],
                            'CONVERT_CURRENCY' => $arParams['CONVERT_CURRENCY'],
                            'CURRENCY_ID' => $arParams['CURRENCY_ID'],
                            'HIDE_NOT_AVAILABLE' => $arParams['HIDE_NOT_AVAILABLE'],
                            'HIDE_NOT_AVAILABLE_OFFERS' => $arParams['HIDE_NOT_AVAILABLE_OFFERS'],

                            'LABEL_PROP' => $arParams['LABEL_PROP'],
                            'LABEL_PROP_MOBILE' => $arParams['LABEL_PROP_MOBILE'],
                            'LABEL_PROP_POSITION' => $arParams['LABEL_PROP_POSITION'],
                            'ADD_PICT_PROP' => $arParams['ADD_PICT_PROP'],
                            'PRODUCT_DISPLAY_MODE' => $arParams['PRODUCT_DISPLAY_MODE'],
                            'PRODUCT_BLOCKS_ORDER' => $arParams['LIST_PRODUCT_BLOCKS_ORDER'],
                            'PRODUCT_ROW_VARIANTS' => "[{'VARIANT':'3','BIG_DATA':true}]",
                            'ENLARGE_PRODUCT' => $arParams['LIST_ENLARGE_PRODUCT'],
                            'ENLARGE_PROP' => isset($arParams['LIST_ENLARGE_PROP']) ? $arParams['LIST_ENLARGE_PROP'] : '',
                            'SHOW_SLIDER' => $arParams['LIST_SHOW_SLIDER'],
                            'SLIDER_INTERVAL' => isset($arParams['LIST_SLIDER_INTERVAL']) ? $arParams['LIST_SLIDER_INTERVAL'] : '',
                            'SLIDER_PROGRESS' => isset($arParams['LIST_SLIDER_PROGRESS']) ? $arParams['LIST_SLIDER_PROGRESS'] : '',

                            'DISPLAY_TOP_PAGER' => 'N',
                            'DISPLAY_BOTTOM_PAGER' => 'N',
                            'HIDE_SECTION_DESCRIPTION' => 'Y',

                            'RCM_TYPE' => isset($arParams['BIG_DATA_RCM_TYPE']) ? $arParams['BIG_DATA_RCM_TYPE'] : '',
                            'RCM_PROD_ID' => $ElementID,
                            'SHOW_FROM_SECTION' => 'Y',
                            'OFFER_ADD_PICT_PROP' => $arParams['OFFER_ADD_PICT_PROP'],
                            'OFFER_TREE_PROPS' => $arParams['OFFER_TREE_PROPS'],
                            'PRODUCT_SUBSCRIPTION' => $arParams['PRODUCT_SUBSCRIPTION'],
                            'SHOW_DISCOUNT_PERCENT' => $arParams['SHOW_DISCOUNT_PERCENT'],
                            'DISCOUNT_PERCENT_POSITION' => $arParams['DISCOUNT_PERCENT_POSITION'],
                            'SHOW_OLD_PRICE' => $arParams['SHOW_OLD_PRICE'],
                            'SHOW_MAX_QUANTITY' => $arParams['SHOW_MAX_QUANTITY'],
                            'MESS_SHOW_MAX_QUANTITY' => (isset($arParams['~MESS_SHOW_MAX_QUANTITY']) ? $arParams['~MESS_SHOW_MAX_QUANTITY'] : ''),
                            'RELATIVE_QUANTITY_FACTOR' => (isset($arParams['RELATIVE_QUANTITY_FACTOR']) ? $arParams['RELATIVE_QUANTITY_FACTOR'] : ''),
                            'MESS_RELATIVE_QUANTITY_MANY' => (isset($arParams['~MESS_RELATIVE_QUANTITY_MANY']) ? $arParams['~MESS_RELATIVE_QUANTITY_MANY'] : ''),
                            'MESS_RELATIVE_QUANTITY_FEW' => (isset($arParams['~MESS_RELATIVE_QUANTITY_FEW']) ? $arParams['~MESS_RELATIVE_QUANTITY_FEW'] : ''),
                            'MESS_BTN_BUY' => (isset($arParams['~MESS_BTN_BUY']) ? $arParams['~MESS_BTN_BUY'] : ''),
                            'MESS_BTN_ADD_TO_BASKET' => (isset($arParams['~MESS_BTN_ADD_TO_BASKET']) ? $arParams['~MESS_BTN_ADD_TO_BASKET'] : ''),
                            'MESS_BTN_SUBSCRIBE' => (isset($arParams['~MESS_BTN_SUBSCRIBE']) ? $arParams['~MESS_BTN_SUBSCRIBE'] : ''),
                            'MESS_BTN_DETAIL' => (isset($arParams['~MESS_BTN_DETAIL']) ? $arParams['~MESS_BTN_DETAIL'] : ''),
                            'MESS_NOT_AVAILABLE' => (isset($arParams['~MESS_NOT_AVAILABLE']) ? $arParams['~MESS_NOT_AVAILABLE'] : ''),
                            'MESS_BTN_COMPARE' => (isset($arParams['~MESS_BTN_COMPARE']) ? $arParams['~MESS_BTN_COMPARE'] : ''),

                            'USE_ENHANCED_ECOMMERCE' => (isset($arParams['USE_ENHANCED_ECOMMERCE']) ? $arParams['USE_ENHANCED_ECOMMERCE'] : ''),
                            'DATA_LAYER_NAME' => (isset($arParams['DATA_LAYER_NAME']) ? $arParams['DATA_LAYER_NAME'] : ''),
                            'BRAND_PROPERTY' => (isset($arParams['BRAND_PROPERTY']) ? $arParams['BRAND_PROPERTY'] : ''),

                            'TEMPLATE_THEME' => (isset($arParams['TEMPLATE_THEME']) ? $arParams['TEMPLATE_THEME'] : ''),
                            'ADD_TO_BASKET_ACTION' => $basketAction,
                            'SHOW_CLOSE_POPUP' => isset($arParams['COMMON_SHOW_CLOSE_POPUP']) ? $arParams['COMMON_SHOW_CLOSE_POPUP'] : '',
                            'COMPARE_PATH' => $arResult['FOLDER'].$arResult['URL_TEMPLATES']['compare'],
                            'COMPARE_NAME' => $arParams['COMPARE_NAME'],
                            'BACKGROUND_IMAGE' => '',
                            'DISABLE_INIT_JS_IN_COMPONENT' => (isset($arParams['DISABLE_INIT_JS_IN_COMPONENT']) ? $arParams['DISABLE_INIT_JS_IN_COMPONENT'] : ''),
                            "COMPOSITE_FRAME_MODE" => "Y",
                            "COMPOSITE_FRAME_TYPE" => "DYNAMIC_WITH_STUB_LOADING",
                        ),
                        $component
                    );
                    ?>
                </div>
            </div>
        </div>        
        
        <div class="right_column display_none_m dispay_none_mp">
            <?/*
            <?if ($arProps['ALSO_BUY']['VALUE']):?>
            <div class="display_none_m display_none_mp">
                <div class="h2 detail_right_produce_h2">Рекомендуем также добавить</div>
                <div class="detail_right_produce_slider_block carousel_slider_brend_block">
                    <?global $arFilterRecom?>
                    <?$arFilterRecom = Array("ID"=>$arProps['ALSO_BUY']['VALUE'])?>
                    <?$APPLICATION->IncludeComponent(
                        "bitrix:catalog.section",
                        "detail_recomenduem",
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
                            "CACHE_FILTER" => "Y",
                            "CACHE_GROUPS" => "Y",
                            "CACHE_TIME" => "36000000",
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
                            "FILTER_NAME" => "arFilterRecom",
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
                            "PAGE_ELEMENT_COUNT" => "0",
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
                            'DISPLAY_COMPARE' => (isset($arParams['USE_COMPARE']) ? $arParams['USE_COMPARE'] : ''),
                            //"IN_BASKET" => $arParams['IN_BASKET'],
                        )
                    );?>
                </div>
            </div>
            <?endif;?>
            */?>
            <div class="section social_tabs display_none_p dispay_none_mc display_none_m display_none_mp">
                <?$APPLICATION->IncludeComponent(
                    "bitrix:main.include",
                    "",
                    Array(
                        "AREA_FILE_SHOW" => "file",
                        "AREA_FILE_SUFFIX" => "inc",
                        "EDIT_TEMPLATE" => "",
                        "PATH" => "/include/soc_seti.php"
                    )
                );?>
            </div>
        </div>

        <div class="clear"></div>
    </div>
    <?if ($arProps['PHOTO_3D']['VALUE']):?>
    <div id="spritespin_block" style="display:none;">
        <?/*$APPLICATION->AddHeadScript('/js/spritespin.js');*/?><!--
        <div class="spritespin_block">
            <?/*$APPLICATION->IncludeComponent(
                "bitrix:news.list",
                "3d_photo",
                Array(
                    "ACTIVE_DATE_FORMAT" => "d.m.Y",
                    "ADD_SECTIONS_CHAIN" => "N",
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
                    "DETAIL_URL" => "",
                    "DISPLAY_BOTTOM_PAGER" => "Y",
                    "DISPLAY_DATE" => "Y",
                    "DISPLAY_NAME" => "Y",
                    "DISPLAY_PICTURE" => "Y",
                    "DISPLAY_PREVIEW_TEXT" => "Y",
                    "DISPLAY_TOP_PAGER" => "N",
                    "FIELD_CODE" => array("", ""),
                    "FILTER_NAME" => "",
                    "HIDE_LINK_WHEN_NO_DETAIL" => "N",
                    "IBLOCK_ID" => "10",
                    "IBLOCK_TYPE" => "360_animation_photo",
                    "INCLUDE_IBLOCK_INTO_CHAIN" => "N",
                    "INCLUDE_SUBSECTIONS" => "Y",
                    "MESSAGE_404" => "",
                    "NEWS_COUNT" => "50",
                    "PAGER_BASE_LINK_ENABLE" => "N",
                    "PAGER_DESC_NUMBERING" => "N",
                    "PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
                    "PAGER_SHOW_ALL" => "N",
                    "PAGER_SHOW_ALWAYS" => "N",
                    "PAGER_TEMPLATE" => ".default",
                    "PAGER_TITLE" => "Новости",
                    "PARENT_SECTION" => $arProps['PHOTO_3D']['VALUE'],
                    "PARENT_SECTION_CODE" => "",
                    "PREVIEW_TRUNCATE_LEN" => "",
                    "PROPERTY_CODE" => array("", ""),
                    "SET_BROWSER_TITLE" => "N",
                    "SET_LAST_MODIFIED" => "N",
                    "SET_META_DESCRIPTION" => "N",
                    "SET_META_KEYWORDS" => "N",
                    "SET_STATUS_404" => "N",
                    "SET_TITLE" => "N",
                    "SHOW_404" => "N",
                    "SORT_BY1" => "ACTIVE_FROM",
                    "SORT_BY2" => "SORT",
                    "SORT_ORDER1" => "DESC",
                    "SORT_ORDER2" => "ASC"
                )
            );*/?>
        </div>-->
    </div>
    <?endif;?>
<?}?>

<script>$( document ).ready(function() {$(".detail_right_produce_slider_block .bx-viewport").css("height","auto");});</script>