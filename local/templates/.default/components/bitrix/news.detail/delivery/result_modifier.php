<?
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

$arResult['LIST'] = Array();
$res = CIBlockElement::GetList(
	Array(
		'SORT' => 'ASC',
		'NAME' => 'ASC',
	),
	Array(
		'IBLOCK_ID' => $arParams['IBLOCK_ID'],
		'ACTIVE' => 'Y',
	),
	false,
	false,
	Array('ID', 'NAME', 'DETAIL_PAGE_URL')
);
while ($ar_res = $res->GetNext())
	$arResult['LIST'][] = $ar_res;
?>