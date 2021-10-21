<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

if($_SERVER["REQUEST_METHOD"] == "POST" && $_REQUEST["action"] == "getCompare")
{
    $arItems = array();
    if(!empty($_SESSION["CATALOG_COMPARE_LIST"][1]["ITEMS"]))
    {
        foreach($_SESSION["CATALOG_COMPARE_LIST"][1]["ITEMS"] as $item)
        {
            $arItems[] = $item["ID"];            
        }
    }
    echo json_encode(array("items" => $arItems));
}
?>