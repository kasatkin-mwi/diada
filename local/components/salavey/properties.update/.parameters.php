<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();

if(!CModule::IncludeModule("iblock"))
	return;

$arIBlockType = CIBlockParameters::GetIBlockTypes();

$rsCatalogProps = \Bitrix\Catalog\ProductTable::getMap();

$arCatalogProps = [];

foreach($rsCatalogProps as $id => $obProp)
{
	if($id == "ID") continue;
	$arCatalogProps[$id] = "[".$id."] ".$obProp->getTitle();
}

$arComponentParameters = array(
	"GROUPS" => array(
	),
	"PARAMETERS" => array(
		"IBLOCK_TYPES" => array(
			"PARENT" => "BASE",
			"NAME" => "Типы Инфоблоков",
			"TYPE" => "LIST",
			"VALUES" => $arIBlockType,
			"MULTIPLE" => "Y",
			"SIZE"  => "10",
		),
		"CATALOG_PROPS" => array(
			"PARENT" => "BASE",
			"NAME" => "Свойства каталога",
			"TYPE" => "LIST",
			"VALUES" => $arCatalogProps,
			"MULTIPLE" => "Y",
			"SIZE"  => "10",
		),
		"NEWS_COUNT" => array(
			"PARENT" => "BASE",
			"NAME" => "Количество элементов на странице",
			"TYPE" => "STRING",
			"DEFAULT" => "200",
		),
		"TOP_DEPTH" => array(
			"PARENT" => "DATA_SOURCE",
			"NAME" => "Максимальная отображаемая глубина разделов",
			"TYPE" => "STRING",
			"DEFAULT" => '2',
		),
	),
);
 
?>
