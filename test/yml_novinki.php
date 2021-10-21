<?
$_SERVER["DOCUMENT_ROOT"] = realpath(dirname(__FILE__) . '/../');

$DOCUMENT_ROOT = $_SERVER["DOCUMENT_ROOT"];
require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/modules/main/include/prolog_before.php");
define("NOT_CHECK_PERMISSIONS", true);
set_time_limit(0);

$arFilter = array(
    "ACTIVE" => "Y",
    "ACTIVE_DATE" => "Y",
    'IBLOCK_ID' => 1
);

ExportYandexYML(
    $arFilter,
    "novinki",
    array('date_create' => 'desc', 'id' => 'desc'),
    array('ID' => 's1'),
    $DOCUMENT_ROOT
);  