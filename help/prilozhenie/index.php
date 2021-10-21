<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Скачать приложение");

/* если это мобильное устройство, то редиректим на страницу, которая 
уже перенаправляет на скачивание приложения для необходимой платформы */
$detect = new \Bitrix\Conversion\Internals\MobileDetect;
if ($detect->isMobile()) {
	header('HTTP/1.1 200 OK');
	header('Location: http://mkarta.com/2220');
	exit();
}
?>

<h1>К сожалению, приложение diada-arms временно не работает.</h1>
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>