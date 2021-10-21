<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php")?>
<?
CModule::IncludeModule('sale');

$LOCATION_ID = $_REQUEST['cityId'];
if (!$LOCATION_ID)
	$LOCATION_ID = $APPLICATION->get_cookie('locationId');
if (!$LOCATION_ID)
	$LOCATION_ID = getIpUserlocation();

$APPLICATION->set_cookie('locationId', $LOCATION_ID);
?>
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/epilog_after.php")?>