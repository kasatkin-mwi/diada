<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php")?>
<?$APPLICATION->ShowHead();?>
<div class="new_call_back_light" id="geo_light">
	<?$APPLICATION->IncludeComponent(
		"bitrix:sale.location.selector.search",
		"select_city_top",
		Array(
			"CACHE_TIME" => "36000000",
			"CACHE_TYPE" => "A",
			"CODE" => "",
			"FILTER_BY_SITE" => "Y",
			"ID" => "",
			"INITIALIZE_BY_GLOBAL_EVENT" => "",
			"INPUT_NAME" => "LOCATION",
			"JS_CALLBACK" => "selectCity",
			"JS_CONTROL_GLOBAL_ID" => "",
			"PROVIDE_LINK_BY" => "id",
			"SHOW_DEFAULT_LOCATIONS" => "N",
			"SUPPRESS_ERRORS" => "N"
		)
	);?>
</div>
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/epilog_after.php")?>