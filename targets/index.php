<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Мишени");?>
<?$APPLICATION->IncludeComponent("salavey:targets", "", Array(
	"IBLOCK_TYPE" => "ibTargets",	// Тип инфо-блока
		"IBLOCK_ID" => "14",	// Инфо-блок
	),
	false
);?>
<div>
  <br />
</div>
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>