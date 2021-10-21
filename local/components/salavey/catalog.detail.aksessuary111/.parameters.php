<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();

if(!CModule::IncludeModule("iblock"))
	return;

$arTypesEx = CIBlockParameters::GetIBlockTypes(Array("-"=>" "));

$arIBlocks=Array();
$db_iblock = CIBlock::GetList(Array("SORT"=>"ASC"), Array("SITE_ID"=>$_REQUEST["site"], "TYPE" => ($arCurrentValues["IBLOCK_TYPE"]!="-"?$arCurrentValues["IBLOCK_TYPE"]:"")));
while($arRes = $db_iblock->Fetch()) {
	$arIBlocks[$arRes["ID"]] = $arRes["NAME"];
}

$arComponentParameters = array(
	"GROUPS" => array(
	),
	"PARAMETERS" => array(

		"IBLOCK_TYPE" => Array(
			"PARENT" => "BASE",
			"NAME" => "IBLOCK_TYPE",
			"TYPE" => "LIST",
			"VALUES" => $arTypesEx,
			"DEFAULT" => "news",
			"REFRESH" => "Y",
		),
		"IBLOCK_ID" => Array(
			"PARENT" => "BASE",
			"NAME" => "IBLOCK_ID",
			"TYPE" => "LIST",
			"VALUES" => $arIBlocks,
			"DEFAULT" => '={$_REQUEST["IBLOCK_ID"]}',
			"ADDITIONAL_VALUES" => "Y",
			"REFRESH" => "Y",
		),
		"SECTION_ID" => Array(
			"PARENT" => "BASE",
			"NAME" => "SECTION_ID",
			"TYPE" => "STRING",
			"DEFAULT" => '={$_REQUEST["SECTION_ID"]}',
		),
		"DETAIL_PAGE" => Array(
			"PARENT" => "BASE",
			"NAME" => "DETAIL_PAGE",
			"TYPE" => "STRING",
			"DEFAULT" => '/models/offers/',
		),
		"ITEMS_LIMIT_SECTIONS" => Array(
			"PARENT" => "BASE",
			"NAME" => "ITEMS_LIMIT_SECTIONS",
			"TYPE" => "STRING",
			"DEFAULT" => "10",
		),
		"ITEMS_LIMIT_ELEMENTS" => Array(
			"PARENT" => "BASE",
			"NAME" => "ITEMS_LIMIT_ELEMENTS",
			"TYPE" => "STRING",
			"DEFAULT" => "10",
		),
		

		"CACHE_TIME"  =>  Array("DEFAULT"=>3600),

	),
);
?>