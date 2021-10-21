<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
set_time_limit(0);
?>
<?
Bitrix\Main\Loader::includeModule("sale");

//var_export(date($DB->DateFormatToPHP(CSite::GetDateFormat("SHORT")), strtotime("2017-01-01 00:00:00")));

$arFilter = Array(
   ">=DATE_INSERT" => date($DB->DateFormatToPHP(CSite::GetDateFormat("SHORT")), strtotime("2017-01-01 00:00:00"))
);
$arOrders = array();
$dbOrder = CSaleOrder::GetList(array("DATE_INSERT" => "ASC"), $arFilter,false,false,array("ID","USER_EMAIL"));
$count = 0;
while ($arOrder = $dbOrder->Fetch())
{
    if($count == 500)
    {
        usleep(10000000);
        $count = 0;   
    }
    $arOrders[] = $arOrder["ID"];
    $order = Bitrix\Sale\Order::load($arOrder["ID"]);
    $propertyCollection = $order->getPropertyCollection();
    esputnikGroupSubscribe($arOrder["USER_EMAIL"], $propertyCollection->getPayerName()->getValue());
    $count++;
}
var_export(count($arOrders));
//49301
//array("nPageSize" => )
?>