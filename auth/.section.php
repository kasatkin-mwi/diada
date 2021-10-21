<?
// $sSectionName = "Авторизация";
// $arDirProperties = Array(
//    "title" => "Авторизация"
// );
if (isset($_GET['forgot_password']))
{
	$sSectionName = "Восстановление пароля";
	$arDirProperties = Array(
	   "title" => "Восстановление пароля"
	);
}
else
{
	$sSectionName = "Авторизация";
	$arDirProperties = Array(
	   "title" => "Авторизация"
	);
}
?>