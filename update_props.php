<?//require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/header.php");
include($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");
global $APPLICATION;
$APPLICATION->ShowHead();
$APPLICATION->AddHeadScript('/js/jquery-1.8.3.min.js');
$APPLICATION->SetTitle("Обновление свойства");
$APPLICATION->SetPageProperty("title","Обновление свойства");
?>
<div id="panel">
<?$APPLICATION->ShowPanel();?>
</div>
<div style="width:90%;margin:0 auto;">
	<?
	$APPLICATION->IncludeComponent(
	"salavey:properties.update", 
	".default", 
	array(
		"AJAX_MODE" => "Y",
		"AJAX_OPTION_JUMP" => "N",
		"AJAX_OPTION_STYLE" => "Y",
		"AJAX_OPTION_HISTORY" => "N",
		"AJAX_OPTION_ADDITIONAL" => "",
		"NEWS_COUNT" => "200",
		"TOP_DEPTH" => "1",
		"COMPONENT_TEMPLATE" => ".default",
		"IBLOCK_TYPES" => array(
			0 => "test",
			1 => "ibCatalog",
			2 => "1c_catalog",
		),
		"COMPOSITE_FRAME_MODE" => "A",
		"COMPOSITE_FRAME_TYPE" => "AUTO",
		"CATALOG_PROPS" => array(
			0 => "WEIGHT",
			1 => "WIDTH",
			2 => "LENGTH",
			3 => "HEIGHT",
		)
	),
	false
);
	 ?>
</div>
<div style="margin-bottom: 200px;height:1px;">
</div>
 <br>
<?//require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/footer.php"); ?>