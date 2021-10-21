<?
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
global $APPLICATION;
$aMenuLinksExt = $APPLICATION->IncludeComponent(
    "salavey:menu.sections",
    "",
    array(
        "IS_SEF" => "Y",
        "SEF_BASE_URL" => "/catalog/",
        "SECTION_PAGE_URL" => "#SECTION_CODE_PATH#/",
        "DETAIL_PAGE_URL" => "#SECTION_CODE_PATH#/#ELEMENT_CODE#",
        "IBLOCK_ID" => "1",
        "DEPTH_LEVEL" => "3",
        "CACHE_TYPE" => "Y",
        "CACHE_TIME" => "3600",
        "ACTIVE" => "Y"
    ),
    false
);    
$aMenuLinks = array_merge($aMenuLinksExt);



?>
