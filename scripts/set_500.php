<?require_once($_SERVER['DOCUMENT_ROOT'] . "/bitrix/modules/main/include/prolog_before.php");
\Bitrix\Main\Loader::includeModule("sale");
//$data = CIBlockElement::GetList(array("ID" => "ASC"),array("IBLOCK_ID" => 1, "!SORT" => 500));
global $DB;
$dbProductDiscounts = Bitrix\Sale\Internals\DiscountTable::getList(array("order" => array("ID" => "asc")));
while ($data = $dbProductDiscounts->fetch()){
    $DB->Query("UPDATE b_sale_discount SET LAST_DISCOUNT='N' WHERE ID=".$data["ID"]	, false, $err_mess . __LINE__);
}
?>
