<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Diada-arms.ru");
?>
<?$APPLICATION->IncludeComponent(
    "salavey:subscribe",
    ".default",
    Array(
        "COMPONENT_TEMPLATE" => ".default",
        "EXISTS_STRING" => "Такой адрес уже добавлен в подписку",
        "MAIL_STRING" => "Указанный адрес не является почтой",
        "OK_STRING" => "Ваш адрес добавлен в подписку на сайте diada-arms.ru",
        "OK_DELETE_SUB" => "Ваш адрес добавлен в подписку на сайте diada-arms.ru"
    )
);?>
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>