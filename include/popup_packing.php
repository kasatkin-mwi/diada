<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");?>
<noindex>
<?
$APPLICATION->IncludeComponent("salavey:make.packing","",array(
	"IBLOCK_ID" => 1,
	"SERVICE_SECTION_CODE" => "upakovka"
));
?>
</noindex>
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/epilog_after.php");?>