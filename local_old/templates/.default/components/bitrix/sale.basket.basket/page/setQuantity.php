<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");?>

<?
if ($_REQUEST['AJAX_PAGE_QUANTITY'] && CModule::IncludeModule('sale'))
{
	$ID = intval($_REQUEST['id']);
	$quantity = intval($_REQUEST['quantity']);
	if ($ID)
	{
		if (!$quantity) $quantity = 1;
		CSaleBasket::Update($ID, Array("QUANTITY"=>$quantity));
	}
}
?>

<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/epilog_after.php");?>