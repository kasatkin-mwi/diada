<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php")?>
<?$PRODUCT_ID = intval($_REQUEST['PRODUCT_ID']);?>
<?if ($PRODUCT_ID && CModule::IncludeModule('iblock')):?>
	<?$arElement = getIBlockElement($PRODUCT_ID);?>
	<div class="detail_services_ligh">
		<?$APPLICATION->IncludeComponent(
			"1cbit:form.result.new",
			"deshevle",
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
				"USE_EXTENDED_ERRORS" => "N",
				"VARIABLE_ALIASES" => Array(
					"RESULT_ID" => "RESULT_ID",
					"WEB_FORM_ID" => "WEB_FORM_ID"
				),
				"WEB_FORM_ID" => 3,
				"PRODUCT_NAME" => $arElement['NAME'],
                "AJAX_MODE" => "N",
				"PRODUCT_ID" => $PRODUCT_ID,
			)
		);?>
        <script>
            $(document).ready(function ($) {
                $.validator.addMethod("checkMask", function(value, element) {
                    return value.replace( /[^0-9#]/g, "" ).length == $(element).data('num');
                });
                maskAktive("",true,'[name="form_text_8"]');
                $('form[name="SIMPLE_FORM_3"]').validate({
                    submitHandler: function (form) {
                        $(form).parents('.detail_services_ligh').prepend('<div class="center_loader_mask"><div class="img-loader" style="top: 45%;"></div></div>');
                        BX.ajax({   
                            url: '<?=$APPLICATION->GetCurPage()?>?PRODUCT_ID=<?=$PRODUCT_ID?>',
                            data: $(form).serialize(),
                            method: 'POST',
                            timeout: 30,
                            cache: false,
                            onsuccess: function(data)
                            {
                                $('.detail_services_ligh').html($(data).html());
                            }
                        });
                    },
                    rules: {
                        form_text_6: "required",
                        form_text_7: "required",
                        form_text_8: {
                          required: true,
                          checkMask: true
                        },
                        form_text_9: {
                            required: true,
                            email: true
                        },
                        form_text_10: "required",
                        form_text_11: "required",

                    },
                    messages: {
                        form_text_6: "Заполните поле \"Товар\"",
                        form_text_7: "Заполните поле \"Контактное лицо\"",
                        form_text_8: {
                            required: "Заполните поле \"Телефон\"",
                            checkMask: "Поле \"Телефон\" заполнено не полностью",
                        },
                        form_text_9: "Заполните поле \"E-mail\"",
                        form_text_10: "Поле обязательно для заполнения",
                        form_text_11: "Поле обязательно для заполнения",
                    }
                });
            })
            $(document).ready(function ($) {
                $("[name=form_text_6]").val("[ID: <?=$arElement['ID']?>] <?=$arElement['NAME']?>").prop("readonly",true);
            })
        </script>
	</div>
<?endif;?>

<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/epilog_after.php")?>