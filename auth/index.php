<?
define("NEED_AUTH", true);
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
if (isset($_GET['forgot_password']))
{
	$APPLICATION->SetPageProperty("title", "Восстановление пароля");
	$APPLICATION->SetTitle("Восстановление пароля");
}
else
{
	$APPLICATION->SetPageProperty("title", "Авторизация");
	$APPLICATION->SetTitle("Авторизация");
}
?>
<? if ($USER->IsAuthorized())	header('Location: /lk/'); 
Bitrix\Main\Data\StaticHtmlCache::getInstance()->markNonCacheable();
?>
<p>
	 Вы зарегистрированы и успешно авторизовались.
</p><?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>