<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();

$arParams['IBLOCK_ID'] = intval($arParams['IBLOCK_ID']);
if (!$arParams['IBLOCK_ID']) return;
if(!CModule::IncludeModule("iblock")) return;

$arFilter = array(
	'ACTIVE' => 'Y',
	'IBLOCK_ID' => $arParams['IBLOCK_ID'],
	'SECTION_CODE' => $arParams['SERVICE_SECTION_CODE'],
	'INCLUDE_SUBSECTIONS' => "Y"
	);

$arSelect = array('ID','NAME','DETAIL_URL','PICTURE','PREVIEW_PICTURE','CATALOG_GROUP_1');
$rsPackingGood = CIBlockElement::GetList(array(), $arFilter,false,false,$arSelect);

if ($arPackingGood = $rsPackingGood->GetNext())
{
	$arResult['PACKING'] = array(
		'ID' => $arPackingGood['ID'],
		'NAME' => $arPackingGood['NAME'],
		'DETAIL_URL' => $arPackingGood['DETAIL_PAGE_URL'],
		'PRICE' => $arPackingGood['CATALOG_PRICE_1'],
		'PICTURE' => $arPackingGood['DETAIL_PICTURE'] ? CFile::GetFileArray($arPackingGood["DETAIL_PICTURE"]) : ($arPackingGood['PREVIEW_PICTURE'] ? CFile::GetFileArray($arPackingGood["PREVIEW_PICTURE"]) : array())
	);
}
$this->IncludeComponentTemplate();
?>