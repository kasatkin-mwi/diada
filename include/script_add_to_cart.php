<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php")?>
<?
//print_r($_REQUEST);
$quantity = intval($_REQUEST['quantity']);
$id = intval($_REQUEST['id']);
if (CModule::IncludeModule("catalog") && $id)
{
	if (!$quantity) $quantity = 1;
	if ($_REQUEST['params'])
	{
		foreach($_REQUEST['params'] as $code=>$val)
			$arProps[] = Array(
				"NAME" => $code,
				"VALUE" => $val,
			);
	}
    if($_REQUEST["is_service"] == "Y")
    {
        $arProps[] = Array(
            "NAME" => "Услуга",
            "CODE" => "SERVICE",
            "VALUE" => "да",
        );
    }
	//print_r($arProps);
	Add2BasketByProductID($id, $quantity, Array(), $arProps);
}
?>
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/epilog_after.php")?>