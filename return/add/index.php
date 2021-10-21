<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetPageproperty("title", "Создание заявки");
$APPLICATION->SetPageproperty("description", "Создание заявки. Интернет-магазин Diada-Arms предлагает широкий ассортимент пневматики, а также товаров для охоты и активного отдыха.");
$APPLICATION->SetTitle("Создание заявки");
?>
<link href="/css/return_style.css" rel="stylesheet" type="text/css" >
<?
if($_SERVER['REQUEST_METHOD'] == 'POST' && $_REQUEST['return_send'] == 'Y')
{
    $APPLICATION->RestartBuffer();
}
?>
<?$APPLICATION->IncludeComponent(
	"salavey:iblock.element.add.form", 
	"return", 
	array(
		"COMPOSITE_FRAME_MODE" => "A",
		"COMPOSITE_FRAME_TYPE" => "AUTO",
		"CUSTOM_TITLE_DATE_ACTIVE_FROM" => "",
		"CUSTOM_TITLE_DATE_ACTIVE_TO" => "",
		"CUSTOM_TITLE_DETAIL_PICTURE" => "",
		"CUSTOM_TITLE_DETAIL_TEXT" => "Описание требования",
		"CUSTOM_TITLE_IBLOCK_SECTION" => "",
		"CUSTOM_TITLE_NAME" => "ФИО",
		"CUSTOM_TITLE_PREVIEW_PICTURE" => "",
		"CUSTOM_TITLE_PREVIEW_TEXT" => "Описание неисправности",
		"CUSTOM_TITLE_TAGS" => "",
		"DEFAULT_INPUT_SIZE" => "30",
		"DETAIL_TEXT_USE_HTML_EDITOR" => "N",
		"ELEMENT_ASSOC" => "CREATED_BY",
		"GROUPS" => array(
			0 => "2",
		),
		"IBLOCK_ID" => "36",
		"IBLOCK_TYPE" => "other",
		"LEVEL_LAST" => "Y",
		"LIST_URL" => "",
		"MAX_FILE_SIZE" => "0",
		"MAX_LEVELS" => "100000",
		"MAX_USER_ENTRIES" => "100000",
		"PREVIEW_TEXT_USE_HTML_EDITOR" => "N",
		"PROPERTY_CODES" => array(
			0 => "5901",
			1 => "5902",
            2 => "5903",
            3 => "5904",
			3 => "5944",
			4 => "NAME",
			5 => "PREVIEW_TEXT",
			6 => "DETAIL_TEXT",
		),
		"PROPERTY_CODES_REQUIRED" => array(
			0 => "5901",
			1 => "5902",
            2 => "5903",
            3 => "5904",
			3 => "5944",
			4 => "NAME",
			5 => "PREVIEW_TEXT",
			6 => "DETAIL_TEXT",
		),
		"RESIZE_IMAGES" => "N",
		"SEF_MODE" => "N",
		"STATUS" => "ANY",
		"STATUS_NEW" => "N",
		"USER_MESSAGE_ADD" => "",
		"USER_MESSAGE_EDIT" => "",
		"USE_CAPTCHA" => "N",
		"COMPONENT_TEMPLATE" => "return"
	),
	false
);?>
<?
if($_SERVER['REQUEST_METHOD'] == 'POST' && $_REQUEST['return_send'] == 'Y')
{
    die();
}
?>
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>