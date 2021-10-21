<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Diada-arms.ru");
$APPLICATION->SetAdditionalCSS('/contacts/contact.css');
?>
<script src="//api-maps.yandex.ru/2.0-stable/?load=package.full&lang=ru-RU" type="text/javascript"></script>
<script>
renderRecaptcha = function(elementId) 
{
    if (typeof (grecaptcha) != "undefined") 
    {
        var element = document.getElementById(elementId);

        if(element != undefined && element.childNodes.length == 0) 
        {
            grecaptcha.render(element, {
              'sitekey': '<?=RE_SITE_KEY?>'
           });
        }
     }
}
</script>
<div id="delivery_city">
    <?\Bitrix\Main\Page\Frame::getInstance()->startDynamicWithID("delivery_city");?>
    <?
    if ($_REQUEST['city'])
	    $ELEMENT_ID = $_REQUEST['city'];
    else
	    $ELEMENT_ID = getContactsElementID(23);

    $APPLICATION->IncludeComponent(
	    "bitrix:news.detail",
	    "delivery_new",
	    array(
		    "ACTIVE_DATE_FORMAT" => "d.m.Y",
		    "ADD_ELEMENT_CHAIN" => "N",
		    "ADD_SECTIONS_CHAIN" => "N",
		    "AJAX_MODE" => "N",
		    "AJAX_OPTION_ADDITIONAL" => "",
		    "AJAX_OPTION_HISTORY" => "N",
		    "AJAX_OPTION_JUMP" => "N",
		    "AJAX_OPTION_STYLE" => "Y",
		    "BROWSER_TITLE" => "-",
		    "CACHE_GROUPS" => "N",
		    "CACHE_TIME" => "0",
		    "CACHE_TYPE" => "N",
		    "CHECK_DATES" => "Y",
		    "DETAIL_URL" => "",
		    "DISPLAY_BOTTOM_PAGER" => "N",
		    "DISPLAY_DATE" => "Y",
		    "DISPLAY_NAME" => "Y",
		    "DISPLAY_PICTURE" => "Y",
		    "DISPLAY_PREVIEW_TEXT" => "Y",
		    "DISPLAY_TOP_PAGER" => "N",
		    "ELEMENT_CODE" => "",
		    "ELEMENT_ID" => $ELEMENT_ID,
		    "FIELD_CODE" => array(
			    0 => "",
			    1 => "",
		    ),
		    "IBLOCK_ID" => \FCbit\Conf::FCbit_DELIVERY_IBLOCK_ID,
		    "IBLOCK_TYPE" => "contacts",
		    "IBLOCK_URL" => "",
		    "INCLUDE_IBLOCK_INTO_CHAIN" => "N",
		    "MESSAGE_404" => "",
		    "META_DESCRIPTION" => "-",
		    "META_KEYWORDS" => "-",
		    "PAGER_BASE_LINK_ENABLE" => "N",
		    "PAGER_SHOW_ALL" => "N",
		    "PAGER_TEMPLATE" => ".default",
		    "PAGER_TITLE" => "Страница",
		    "PROPERTY_CODE" => array(
			    0 => "REGION",
			    1 => "",
		    ),
		    "SET_BROWSER_TITLE" => "N",
		    "SET_CANONICAL_URL" => "N",
		    "SET_LAST_MODIFIED" => "N",
		    "SET_META_DESCRIPTION" => "N",
		    "SET_META_KEYWORDS" => "N",
		    "SET_STATUS_404" => "N",
		    "SET_TITLE" => "N",
		    "SHOW_404" => "N",
		    "USE_PERMISSIONS" => "N",
		    "USE_SHARE" => "N",
		    "COMPONENT_TEMPLATE" => "delivery"
	    ),
	    false
    );
    ?>
    <?
    \Bitrix\Main\Page\Frame::getInstance()->finishDynamicWithID("delivery_city", "Загрузка...");
    ?>
</div>
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>