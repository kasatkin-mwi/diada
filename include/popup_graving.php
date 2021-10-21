<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");?>

<div class="detail_services_ligh" id="detail_services_grav_light">

</div>

<?
$APPLICATION->IncludeComponent("salavey:make.graving","",array(
	"IBLOCK_ID" => 1,
    "ID" => $_REQUEST['PRODUCT_ID'],
));
?>
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/epilog_after.php");?>