<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php")?>
<?
$location_id = intval($_REQUEST['location_id']);
$element_id = intval($_REQUEST['element_id']);
if ($location_id)
{
	$APPLICATION->IncludeComponent(
		"salavey:detail.delivery",
		"",
		Array(
			"LOCATION_ID"=>$location_id,
            "ELEMENT_ID"=> $element_id,
		)
	);
}
?>
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/epilog_after.php")?>