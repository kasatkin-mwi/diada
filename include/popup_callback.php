<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php")?>
<?
if($_SERVER["REQUEST_METHOD"] == "POST" && !empty($_REQUEST["form_text_5"]) && intval(preg_replace("/[^0-9]/","",$_REQUEST["form_text_5"])) <= 0)
{
    $_REQUEST["form_text_5"] = preg_replace("/[^0-9]/","",$_REQUEST["form_text_5"]);
}
?>
<div class="new_call_back_light" id="call_back_light">

	<p id="addok" style="display: none;">Спасибо!<br><br>Ваша заявка принята к рассмотрению.</p>
	
	<?$APPLICATION->IncludeComponent(
		"1cbit:form.result.new",
		"callback",
		Array(
                    "AJAX_MODE" => "Y",
                    "AJAX_OPTION_ADDITIONAL" => "",
                    "AJAX_OPTION_HISTORY" => "N",
                    "AJAX_OPTION_JUMP" => "N",
                    "AJAX_OPTION_STYLE" => "Y",
                    "CACHE_NOTES" => "",
                    "CACHE_TIME" => "3602",
                    "CACHE_TYPE" => "A",
                    "CHAIN_ITEM_LINK" => "",
                    "CHAIN_ITEM_TEXT" => "",
                    "EDIT_URL" => "",
                    "IGNORE_CUSTOM_TEMPLATE" => "N",
                    "LIST_URL" => "",
                    "SEF_FOLDER" => "",
                    "SEF_MODE" => "N",
                    "SUCCESS_URL" => "",
                    "USE_EXTENDED_ERRORS" => "N",
                    "VARIABLE_ALIASES" => Array(
                        "RESULT_ID" => "RESULT_ID",
                        "WEB_FORM_ID" => "WEB_FORM_ID"
                    ),
                    "WEB_FORM_ID" => "2"
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