<?if ( !$_GET["header_send"] && !empty($_GET["result_code"]) ){

	header("HTTP/1.1 202 Accepted", true, 202);
	$url = $_SERVER['REQUEST_URI'] . '&header_send=Y';
	?>
	<script>
		setTimeout(function(){location.href="<?=$url?>", 2000} ); 	
	</script>
<?
}
else {
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php"); 
//use Bitrix\Sale;
include_once($_SERVER['DOCUMENT_ROOT']."/bitrix/php_interface/include/sale_payment/avangard/helper.php");
	//echo $orderID = $_GET['ORDER_ID'];
	//$order = \Bitrix\Sale\Order::loadByAccountNumber($orderID);
	//CPSAvangard::isCorrectHash($orderID, $order->getPrice());

	if ( !empty($_GET["result_code"]) && $_GET["back"] == 'good' ) {
		$orderID = $_GET['ORDER_ID'];
		$order = \Bitrix\Sale\Order::loadByAccountNumber($orderID);
		if ( !$order->isPaid() ){
			if ( CPSAvangard::is_payed( $orderID ) ){
				$paymentCollection = $order->getPaymentCollection();
				$paySystem = \Bitrix\Sale\PaySystem\Manager::getObjectById(10);
				$onePayment = $paymentCollection->createItem($paySystem);
				$onePayment->setField("SUM", (int)$order->getPrice());
				$onePayment->setField("PAID", "Y");
				$order->save();
			}
		}
		echo 'Заказ '.$orderID. ' оплачен<br/>';
	}
	if ( !empty($_GET["result_code"]) && $_GET["back"] == 'bad' ) { 
		$orderID = $_GET['ORDER_ID'];
		echo 'Заказ №'.$orderID. '.<br> Оплата не произведена.<br/>';
	}
	
	require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");
}

?>
