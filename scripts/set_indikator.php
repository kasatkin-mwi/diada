<?
$_SERVER["DOCUMENT_ROOT"] = realpath(dirname(__FILE__) . '/../');
require_once($_SERVER['DOCUMENT_ROOT'] . "/bitrix/modules/main/include/prolog_before.php");
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

/*\Bitrix\Main\Loader::includeModule("iblock");

$obElement = CIBlockElement::GetList(
    array("ID" => "asc"), 
    array(
        "ACTIVE" => "Y",
        "<CATALOG_STORE_AMOUNT_3" => 0,
        "!PROPERTY_INDIKATOR" => 28
    ), 
    false, 
    false, 
    array("ID","IBLOCK_ID")
);
while ($arElement = $obElement->GetNext()) 
{
    CIBlockElement::SetPropertyValues($arElement["ID"], $arElement["IBLOCK_ID"], 28, "INDIKATOR");
}
$obElement = CIBlockElement::GetList(
    array("ID" => "asc"), 
    array(
        "ACTIVE" => "Y",
        ">CATALOG_STORE_AMOUNT_3" => 0,
        "!PROPERTY_INDIKATOR" => 27 
    ), 
    false, 
    false, 
    array("ID","IBLOCK_ID")
);
while ($arElement = $obElement->GetNext()) 
{  
    CIBlockElement::SetPropertyValues($arElement["ID"], $arElement["IBLOCK_ID"], 27, "INDIKATOR");
} */
?>