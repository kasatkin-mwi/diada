<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();

if(!isset($arParams["CACHE_TIME"]))
	$arParams["CACHE_TIME"] = 36000000;

$arParams['IBLOCK_ID'] = intval($arParams['IBLOCK_ID']);
if (!$arParams['IBLOCK_ID']) return;

if ($this->StartResultCache(false, ($arParams["CACHE_GROUPS"]==="N"? false: $USER->GetGroups())))
{
	if(!CModule::IncludeModule("iblock"))
	{
		$this->AbortResultCache();
		return;
	}
	
	//Выбираем секции(типы мишеней)
	$arResult["SECTIONS"] = array();
	$arFilter = array('ACTIVE' => 'Y', 'IBLOCK_ID' => $arParams['IBLOCK_ID'], 'DEPTH_LEVEL' => 1);
	$dbRes = CIBlockSection::GetList(array('SORT' => 'ASC'), $arFilter);
	$dbRes->SetUrlTemplates();
	
	while ($arRes = $dbRes->GetNext())
	{
		$arResult['SECTIONS'][$arRes['ID']] = array(
			'NAME' => $arRes['NAME'],
			'ID'=>$arRes['ID']
		);
	}
		
	//Выбираем элементы(мишени)
	$arSelect = array("ID","NAME","CODE","PROPERTY_TARGET_IMAGE_FILE","IBLOCK_SECTION_ID","PREVIEW_PICTURE");

	$arFilter = array('ACTIVE' => 'Y', 'IBLOCK_ID' => $arParams['IBLOCK_ID']);
	$dbRes = CIBlockElement::GetList(array('SORT' => 'ASC'), $arFilter,false,false,$arSelect);
	
	while ($arRes = $dbRes->GetNext())
	{
		//echo "<pre>";print_r($arRes);echo "</pre>";
		$arResult['ITEMS'][$arRes['IBLOCK_SECTION_ID']][] = array(
			'NAME' => $arRes['NAME'],
			'PREVIEW_PICTURE' => $arRes['PREVIEW_PICTURE'],
			'DOWNLOAD_LINK' => CFile::GetFileArray($arRes["PROPERTY_TARGET_IMAGE_FILE_VALUE"])
		);
	}
	
	//echo "<pre>";print_r($arResult);echo "</pre>";
	
	$this->IncludeComponentTemplate();
}

?>