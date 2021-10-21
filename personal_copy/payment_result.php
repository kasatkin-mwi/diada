<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php"); ?>
<?
file_put_contents($_SERVER["DOCUMENT_ROOT"]."/upload/log_pay_system.txt",print_r($_REQUEST,true),FILE_APPEND);
?>
<?include($_SERVER["DOCUMENT_ROOT"]."/bitrix/php_interface/include/sale_payment/avangard/payment.php")?>
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>