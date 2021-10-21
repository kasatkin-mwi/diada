<? if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();


if(!isset($arParams["CACHE_TIME"])) {
	$arParams["CACHE_TIME"] = 3600;
}

CPageOption::SetOptionString("main", "nav_page_in_session", "N");

if($arParams["IBLOCK_ID"] < 1) {
	ShowError("IBLOCK_ID IS NOT DEFINED");
	return false;
}

if(!isset($arParams["ITEMS_LIMIT"])) {
	$arParams["ITEMS_LIMIT"] = 10;
}

$arNavParams = array();

if ($arParams["ITEMS_LIMIT"] > 0) {
	$arNavParams = array(
		"nPageSize" => $arParams["ITEMS_LIMIT"],
	);
}

if ($arParams["ITEMS_LIMIT_ELEMENTS"] > 0) {
	$arElemParams = array(
		"nTopCount" => $arParams["ITEMS_LIMIT_ELEMENTS"],
	);
}

$arNavigation = CDBResult::GetNavParams($arNavParams);

if($this->StartResultCache(false, array($arNavigation)))
{

	if(!CModule::IncludeModule("iblock")) {
		$this->AbortResultCache();
		ShowError("IBLOCK_MODULE_NOT_INSTALLED");
		return false;
	}

	$arSort= array("DATE_CREATE" => "DESK");
	$arFilter = array("IBLOCK_ID" => $arParams["IBLOCK_ID"], "ACTIVE" => "Y", "GLOBAL_ACTIVE" => "Y", "ELEMENT_SUBSECTIONS" => "N");
	if ($arParams['SECTION_ID']) $arFilter['ID'] = $arParams['SECTION_ID'];

	$rsSection = CIBlockSection::GetList(Array("left_margin" => "asc"), $arFilter, true, array("UF_*"));

	while($obSection = $rsSection->GetNext()) {

    	if ($obSection['ELEMENT_CNT'] > 0) {
			$arFilterElements = Array(
				"IBLOCK_ID" => $arParams['IBLOCK_ID'],
				"ACTIVE" => "Y",
				"ACTIVE_DATE" => "Y",
				"SECTION_ID" => $obSection['ID'],
			);
			$rsElement = CIBlockElement::GetList($arSort, $arFilterElements, false, $arElemParams);

			while($obElement = $rsElement->GetNextElement()) {

				$arElement = $obElement->GetFields();
				$arElement["PROPERTIES"] = $obElement->GetProperties();

				if ($arElement['PREVIEW_PICTURE']) $arElement['PREVIEW_PICTURE'] = CFile::GetFileArray($arElement['PREVIEW_PICTURE']);

				$arButtons = CIBlock::GetPanelButtons(
					$arElement["IBLOCK_ID"],
					$arElement["ID"],
					$arElement["IBLOCK_SECTION_ID"],
					array("SECTION_BUTTONS"=>false, "SESSID"=>false, "CATALOG"=>true)
				);
				$arElement["EDIT_LINK"] = $arButtons["edit"]["edit_element"]["ACTION_URL"];
				$arElement["DELETE_LINK"] = $arButtons["edit"]["delete_element"]["ACTION_URL"];

				$obSection['ELEMENTS'][] = $arElement;
			}

    	}

    	$arResult["ITEMS"][] = $obSection;

	}

	$arResult["NAV_STRING"] = $rsElement->GetPageNavStringEx($navComponentObject, "Страницы", "", "");

	$this->SetResultCacheKeys(array(
		"ID",
		"IBLOCK_ID",
		"NAV_CACHED_DATA",
		"NAME",
		"IBLOCK_SECTION_ID",
		"IBLOCK",
		"LIST_PAGE_URL",
		"~LIST_PAGE_URL",
		"SECTION",
		"PROPERTIES",
	));

	$this->IncludeComponentTemplate();

	if (empty($arResult["ITEMS"])) {
		$this->AbortResultCache();
		ShowError("404 Not Found");
		@define("ERROR_404", "Y");
		CHTTP::SetStatus("404 Not Found");
	}

}

?>