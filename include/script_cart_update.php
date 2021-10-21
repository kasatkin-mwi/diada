<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php")?>

<?if($_GET["old"]==1): //Старая шапка?>	
<?	
	$APPLICATION->IncludeComponent(
	"bitrix:sale.basket.basket.small",
	"head",
	Array(
		"PATH_TO_BASKET" => "/personal/cart/",
		"PATH_TO_ORDER" => "/personal/order/",
		"SHOW_DELAY" => "N",
		"SHOW_NOTAVAIL" => "N",
		"SHOW_SUBSCRIBE" => "N"
	)
);?>
<?else:?>
<?	
	$APPLICATION->IncludeComponent(
	"bitrix:sale.basket.basket.small",
	"head_new",
	Array(
		"PATH_TO_BASKET" => "/personal/cart/",
		"PATH_TO_ORDER" => "/personal/order/",
		"SHOW_DELAY" => "N",
		"SHOW_NOTAVAIL" => "N",
		"SHOW_SUBSCRIBE" => "N"
	)
);?>

<?endif?>
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/epilog_after.php")?>