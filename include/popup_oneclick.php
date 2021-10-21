<?require_once($_SERVER['DOCUMENT_ROOT'] . '/bitrix/modules/main/include/prolog_before.php');?>
<div class="new_call_back_light" id="buy_one_click">
	<?
	//var_dump($_REQUEST);
	 $APPLICATION->IncludeComponent(
		"salavey:oneclick.order",
		"",
		Array(
			"USE_CAPTCHA" => "N",
			"OK_TEXT" => "Ваш заказ №#ORDER_ID# офомлен! Наши менеджеры свяжутся с вами в ближайшее время!",
			"EMAIL_TO" => "diada_arms@mail.ru",
			"REQUIRED_FIELDS" => array("NAME","PHONE"),
			"EVENT_MESSAGE_ID" => array("7"),
			"PRODUCT_ID"=>$_REQUEST['PRODUCT_ID'],
            "AJAX_MODE" => "Y",
			"SHOW_EMAIL" => "N",
		),
	false
	);
	?>
	<script type="text/javascript">
	var google_conversion_id = 880904289;
	var google_conversion_label = "tWFdCMvahmcQ4ZCGpAM";
	</script>
	<script type="text/javascript" src="//autocontext.begun.ru/conversion.js"></script>
	<!-- Conversion tracking code: purchases. Step 2: Order started -->
	<script type="text/javascript">
	(function(w, p) {
	var a, s;
	(w[p] = w[p] || []).push({
	counter_id: 423876153,
	tag: '596d153bca1e260cd4e9bafb8e39aae2'
	});
	a = document.createElement('script'); a.type = 'text/javascript'; a.async = true;
	a.src = ('https:' == document.location.protocol ? 'https://' : 'http://') + 'autocontext.begun.ru/analytics.js';
	s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(a, s);
	})(window, 'begun_analytics_params');
	</script>
	<script type="text/javascript">
		$(document).ready(function() {
			setTimeout(function(){
				$('.one_click_popup input[name="user_name"]').focus();
				$('.one_click_popup input[name="user_phone"]').after('<div class="sal_error_massage">Пожалуйста, проверьте правильность ввода номера телефона</div>');
			}, 500);
		});
	</script>
</div>
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/epilog_after.php");?>