<?
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();
/** @var CBitrixComponent $this */
/** @var array $arParams */
/** @var array $arResult */
/** @var string $componentPath */
/** @var string $componentName */
/** @var string $componentTemplate */
/** @global CDatabase $DB */
/** @global CUser $USER */
/** @global CMain $APPLICATION */

if(!CModule::IncludeModule("iblock")) return;

//$arResult["IBLOCK_ID"] = false;

$request = \Bitrix\Main\Application::getInstance()->getContext()->getRequest();

if($_POST["IBLOCK_TYPE"])
{
	$_SESSION["SELECTED_TYPE"] = $arResult["SELECTED_TYPE"] = $request->getPost('IBLOCK_TYPE');
}
if($_POST["IBLOCK_ID"])
{
	$_SESSION["SELECTED_IBLOCK_ID"] = $arResult["IBLOCK_ID"] = $request->getPost('IBLOCK_ID');
	unset($_REQUEST["SECTION_ID"]);
	unset($_SESSION["IS_CATALOG_PROP"]);
}

if($_POST["IBLOCK_TYPE"] && !$_POST["IBLOCK_ID"])
{
	unset($_SESSION["SELECTED_IBLOCK_ID"]);
	unset($_SESSION["SELECTED_TYPE"]);
	unset($_REQUEST["SECTION_ID"]);
	unset($_SESSION["IS_CATALOG_PROP"]);
}

//Выбираем типы ИБ
$arIBlockType = CIBlockParameters::GetIBlockTypes();
foreach($arIBlockType as $id => &$val)
{
	if(!in_array($id,$arParams["IBLOCK_TYPES"]))
	{
		unset($arIBlockType[$id]);
	}
}
//echo "<pre>"; print_r($arIBlockType); echo "</pre>";

$arResult["IBLOCK_TYPES"] = $arIBlockType;
 
if(!$arResult["SELECTED_TYPE"] && $_SESSION["SELECTED_TYPE"])
{
	$arResult["SELECTED_TYPE"] = $_SESSION["SELECTED_TYPE"];
}

if(!$arResult["IBLOCK_ID"] && $_SESSION["SELECTED_IBLOCK_ID"])
{
	$arResult["IBLOCK_ID"] = $_SESSION["SELECTED_IBLOCK_ID"];
}
 
if($arResult["SELECTED_TYPE"])
{
	//Выбираем ИБ
	$arIBlock=array();
	$rsIBlock = CIBlock::GetList(Array("SORT" => "ASC"), Array("TYPE" => $arResult["SELECTED_TYPE"], "ACTIVE"=>"Y"));

	while($arr=$rsIBlock->Fetch())
	{
		$arIBlock[$arr["ID"]] = "[".$arr["ID"]."] ".$arr["NAME"];
	}

	$arResult["IBLOCK_LIST"] = $arIBlock;
	
}
$this->includeComponentTemplate();