<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php")?>

<div class="new_call_back_light add_comment_detail" id="add_comment_detail">
	<?$APPLICATION->IncludeComponent(
		"bitrix:iblock.element.add.form",
		"otziv_tovar",
		Array(
			"SEF_MODE" => "N",
			"IBLOCK_TYPE" => "servis",
			"IBLOCK_ID" => "28",
			"PROPERTY_CODES" => array("NAME", "PREVIEW_TEXT", "4950", "4951", "4952"),
			"PROPERTY_CODES_REQUIRED" => array("NAME", "PREVIEW_TEXT", "4951"),
			"GROUPS" => array("2"),
			"STATUS_NEW" => "NEW",
			"STATUS" => "ANY",
			"LIST_URL" => "",
			"ELEMENT_ASSOC" => "CREATED_BY",
			"MAX_USER_ENTRIES" => "100000",
			"MAX_LEVELS" => "100000",
			"LEVEL_LAST" => "Y",
			"USE_CAPTCHA" => "N",
			"USER_MESSAGE_EDIT" => "",
			"USER_MESSAGE_ADD" => "Спасибо! Ваш отзыв добавлен и будет опубликован, после его проверки модераторами!",
			"DEFAULT_INPUT_SIZE" => "30",
			"RESIZE_IMAGES" => "N",
			"MAX_FILE_SIZE" => "0",
			"PREVIEW_TEXT_USE_HTML_EDITOR" => "N",
			"DETAIL_TEXT_USE_HTML_EDITOR" => "N",
			"CUSTOM_TITLE_NAME" => "Ваше имя",
			"CUSTOM_TITLE_TAGS" => "",
			"CUSTOM_TITLE_DATE_ACTIVE_FROM" => "",
			"CUSTOM_TITLE_DATE_ACTIVE_TO" => "",
			"CUSTOM_TITLE_IBLOCK_SECTION" => "",
			"CUSTOM_TITLE_PREVIEW_TEXT" => "Ваше сообщение",
			"CUSTOM_TITLE_PREVIEW_PICTURE" => "",
			"CUSTOM_TITLE_DETAIL_TEXT" => "",
			"CUSTOM_TITLE_DETAIL_PICTURE" => "",
			"AJAX_MODE" => "Y",
			"PRODUCT_ID" => intval($_REQUEST['id']),
		),
	false
	);?>
</div>
	<script type="text/javascript">
$(document).ready(function() {
	$('input[name="PROPERTY[NAME][0]"]').attr('placeholder','Иванов Иван');
	$('input[name="PROPERTY[4950][0]"]').attr('placeholder','mail@mail.ru');
});
</script>
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/epilog_after.php")?>