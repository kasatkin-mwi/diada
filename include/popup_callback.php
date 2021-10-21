<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php")?>
<?
if($_SERVER["REQUEST_METHOD"] == "POST" && !empty($_REQUEST["form_text_5"]) && intval(preg_replace("/[^0-9]/","",$_REQUEST["form_text_5"])) <= 0)
{
    $_REQUEST["form_text_5"] = preg_replace("/[^0-9]/","",$_REQUEST["form_text_5"]);
}
?>
<div class="new_call_back_light" id="call_back_light">
	<?$APPLICATION->IncludeComponent(
		"1cbit:form.result.new",
		"callback",
		Array(
			"CACHE_TIME" => "3600",
			"CACHE_TYPE" => "A",
			"CHAIN_ITEM_LINK" => "",
			"CHAIN_ITEM_TEXT" => "",
			"EDIT_URL" => "",
			"IGNORE_CUSTOM_TEMPLATE" => "N",
			"LIST_URL" => "",
			"SEF_MODE" => "N",
			"SUCCESS_URL" => "",
			"USE_EXTENDED_ERRORS" => "Y",
			"VARIABLE_ALIASES" => Array(
				"RESULT_ID" => "RESULT_ID",
				"WEB_FORM_ID" => "WEB_FORM_ID"
			),
			"WEB_FORM_ID" => 2,
			"AJAX_MODE" => "Y",
		)
	);?>
	<script type="text/javascript">
        $(document).ready(function() {
	        $('input[name="form_text_4"]').attr('placeholder','Иванов Иван');
	        maskAktive("",true,'input[name="form_text_5"]');// - закомментил в связи с задачей № 14781
            //$('input[name="form_text_5"]').mask("+7 (999) 999-9999");
	        //$('input[name="form_text_5"]').attr('placeholder','+7 (XXX) XXX-XXXX');
			setTimeout(function(){
				$('input[name="form_text_4"]').focus();
				$('input[name="form_text_5"]').after('<div class="sal_error_massage">Пожалуйста, проверьте правильность ввода номера телефона</div>');
			}, 500);
        });
    </script>
</div>
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/epilog_after.php")?>