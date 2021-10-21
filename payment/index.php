<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetPageProperty("title", "Оплата банковской картой");
$APPLICATION->SetTitle("Оплата банковской картой");
?>

<iframe src="https://uaz-motors.ru/print/gun_pay.php?order_id=<?=$_GET['order_id']?>&amount=<?=$_GET['amount']?>;" style="-moz-box-shadow: 0 2px 3px rgba(0, 0, 0, 0); -webkit-box-shadow: 0 2px 3px rgba(0, 0, 0, 0); box-shadow: 0 2px 3px rgba(0, 0, 0, 0); border: 0; width: 100%; height: 800px;" frameborder="0">
	Ваш браузер не поддерживает встроенные фреймы!
</iframe>


<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");
?>