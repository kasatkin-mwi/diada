<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");?>

 
<?
	$airgun = new Airgun();
	$airgun -> init();
	echo $airgun -> GetPrintAir( $_REQUEST['hash'] );
	
?>