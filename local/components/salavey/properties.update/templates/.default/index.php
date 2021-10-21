<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
/** @var array $arParams */
/** @var array $arResult */
/** @global CMain $APPLICATION */
/** @global CUser $USER */
/** @global CDatabase $DB */
/** @var CBitrixComponentTemplate $this */
/** @var string $templateName */
/** @var string $templateFile */
/** @var string $templateFolder */
/** @var string $componentPath */
/** @var CBitrixComponent $component */
$this->setFrameMode(true);
?>
<?
$APPLICATION->IncludeComponent(
	"salavey:properties.update.iblock",
	"",
	Array(
		"IBLOCK_TYPES" => $arParams["IBLOCK_TYPES"]
	),
	$component
);
if($_REQUEST["IBLOCK_TYPE"] && !$_REQUEST["IBLOCK_ID"])
{
	unset($arParams["IBLOCK_TYPE"]);
	unset($arParams["IBLOCK_ID"]);
}
$_SESSION["SELECTED_TYPE"]?$IBLOCK_TYPE = $_SESSION["SELECTED_TYPE"]:$IBLOCK_TYPE = $arParams["IBLOCK_TYPE"];
$_SESSION["SELECTED_IBLOCK_ID"]?$IBLOCK_ID = $_SESSION["SELECTED_IBLOCK_ID"]:$IBLOCK_ID = $arParams["IBLOCK_ID"];
?>
<?if($IBLOCK_ID):?>
<div style="display:flex">
	<div class="smart_filter" style="width:25%;">
	 <?$APPLICATION->IncludeComponent(
		"bitrix:catalog.smart.filter",
		"visual_vertical",
		Array(
			"CACHE_GROUPS" => "Y",
			"CACHE_TIME" => "36000000",
			"CACHE_TYPE" => "N",
			"COMPONENT_TEMPLATE" => "visual_vertical",
			"DISPLAY_ELEMENT_COUNT" => "Y",
			"FILTER_NAME" => "arrFilter",
			"FILTER_VIEW_MODE" => "vertical",
			"IBLOCK_ID" => $IBLOCK_ID,
			"IBLOCK_TYPE" => $IBLOCK_TYPE,
			"PAGER_PARAMS_NAME" => "arrPager",
			"POPUP_POSITION" => "left",
			"PREFILTER_NAME" => "smartPreFilter",
			"SAVE_IN_SESSION" => "N",
			"SECTION_CODE" => "",
			"SECTION_DESCRIPTION" => "-",
			"SECTION_ID" => $_REQUEST["SECTION_ID"],
			"SECTION_TITLE" => "-",
			"SEF_MODE" => "N",
			"SHOW_ALL_WO_SECTION" => "Y",
			"TEMPLATE_THEME" => "blue",
			"INSTANT_RELOAD" => "Y",
			"XML_EXPORT" => "N"
		),
		$component
	);?>
	<?$APPLICATION->IncludeComponent(
		"salavey:properties.update.catalog.section.list",
		"tree",
		Array(
			"ADD_SECTIONS_CHAIN" => "N",
			"CACHE_GROUPS" => "N",
			"CACHE_TIME" => "36000000",
			"CACHE_TYPE" => "A",
			"COUNT_ELEMENTS" => "N",
			"IBLOCK_ID" => $IBLOCK_ID,
			"IBLOCK_TYPE" => $IBLOCK_TYPE,
			"SECTION_ID" => $_REQUEST["SECTION_ID"],
			"TOP_DEPTH" => $arParams["TOP_DEPTH"],
			"VIEW_MODE" => "LINE",
		),
		$component
	);?>
	</div>
	<?
	global $arrFilter;
	if($_REQUEST["SECTION_ID"])
	{
		$arrFilter["SECTION_ID"] = intval($_REQUEST["SECTION_ID"]);
		$arrFilter["INCLUDE_SUBSECTIONS"] = "Y";
	}
	$APPLICATION->IncludeComponent(
	"salavey:properties.update.news.list",
	"",
	Array(
		"CACHE_FILTER" => "N",
		"CACHE_GROUPS" => "Y",
		"CACHE_TIME" => "36000000",
		"CACHE_TYPE" => "A",
		"IBLOCK_ID" => $IBLOCK_ID,
		"IBLOCK_TYPE" => $IBLOCK_TYPE,
		"CATALOG_PROPS" => $arParams["CATALOG_PROPS"],
		"FILTER_NAME" => "arrFilter",
		"NEWS_COUNT" => $arParams["NEWS_COUNT"],
		"SORT_BY1" => "ACTIVE_FROM",
		"SORT_BY2" => "SORT",
		"SORT_ORDER1" => "DESC",
		"SORT_ORDER2" => "ASC"
	),
	$component
	);?>
	<?$APPLICATION->ShowViewContent("filter_sections");?>
</div>
<?endif;?>