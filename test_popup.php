<?
if (preg_match("/^WordPress(.*)/",$_SERVER["HTTP_USER_AGENT"])){
    die();
}
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Diada-arms.ru");
?>
<a class="fancy fancybox" href="#geo_popup1">Ваш город</a>

<div class="geo_popup" id="geo_popup1">
	<div class="header_geo_light_title">Ваш регион: <span>Воронеж</span> ?</div>
	<div class="header_geo_light_button">
		<a class="geo_gray_button" href=""><span>Да</span></a>
		<a class="geo_red_button fancy_ajax" href="/include/popup_geo.php"><span>Выбрать<br>другой город</span></a>
	</div>
</div>
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>