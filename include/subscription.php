<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Diada-arms.ru");
?>
<?$APPLICATION->IncludeComponent(
    "salavey:subscribe",
    ".default",
    Array(
        "COMPONENT_TEMPLATE" => ".default",
        "EXISTS_STRING" => "����� ����� ��� �������� � ��������",
        "MAIL_STRING" => "��������� ����� �� �������� ������",
        "OK_STRING" => "��� ����� �������� � �������� �� ����� diada-arms.ru",
        "OK_DELETE_SUB" => "��� ����� �������� � �������� �� ����� diada-arms.ru"
    )
);?>
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>