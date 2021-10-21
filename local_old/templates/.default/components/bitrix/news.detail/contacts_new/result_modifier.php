<?
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

$arResult['STORES'] = Array();

$res = CIBlockElement::GetList(
	Array(),
	Array(
		'IBLOCK_ID' => 21,
		'ACTIVE' => 'Y',
		'PROPERTY_CITY' => $arResult['ID'],
	)
);
while ($ob = $res->GetNextElement())
	$arResult['STORES'][] = array_merge($ob->GetFields(), Array('PROPERTIES' => $ob->GetProperties()));
?>