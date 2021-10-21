<?$_SERVER['DOCUMENT_ROOT'] = '/home/c/cw05889/testdiada.webtm.ru/public_html';?>
<?require_once($_SERVER['DOCUMENT_ROOT'] . "/bitrix/modules/main/include/prolog_before.php");?>
<?
use Bitrix\Main\Type\DateTime;
// $orders_id = file("orders.csv");
$order = 94329;

// foreach ($orders_id as $ORDER_ID) {
	if (!($arOrder = CSaleOrder::GetByID(intval($order))))
	{
		$error = "Заказ с кодом ".$order." не найден\n";
		file_put_contents($_SERVER['DOCUMENT_ROOT'].'/phone/logOrderStatusUpdate_new.txt', $error, FILE_APPEND);
	}
	else
	{
		$objDateTime = new DateTime("20.05.2018 12:00:00");			
		echo '<pre data>'; print_r($objDateTime); echo '</pre>';
		$date = $objDateTime['value:protected']['date'];
		$arFields = array(
			"DATE_UPDATE" => $date,
		);	   
		echo '<pre data>'; print_r($arFields); echo '</pre>';
		CSaleOrder::Update($order, $arFields, false);
	}
// }

?>
<?require_once($_SERVER['DOCUMENT_ROOT'] . "/bitrix/modules/main/include/epilog_after.php");?>