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
if(!isset($arParams["CACHE_TIME"])) $arParams["CACHE_TIME"] = 36000000;
$arParams["IBLOCK_ID"] = intval($arParams["IBLOCK_ID"]);
$arParams["DEPTH_LEVEL"] = intval($arParams["DEPTH_LEVEL"]);
if($arParams["DEPTH_LEVEL"]<=0) $arParams["DEPTH_LEVEL"]=1;
$arResult["SECTIONS"] = array();
$arResult["ELEMENT_LINKS"] = array();
if($this->StartResultCache())
{
	if(!CModule::IncludeModule("iblock"))
	{
		$this->AbortResultCache();
	}
	else
	{
		$arFilter = array(
			"IBLOCK_ID"=>$arParams["IBLOCK_ID"],
			"GLOBAL_ACTIVE"=>"Y",
			"IBLOCK_ACTIVE"=>"Y",
			"UF_HIDE_SECTION_MENU" => array(null,false)
		);
		if ($arParams["GET_LIST"]>0){
            $arFilter["UF_MENU_LEFT"] = $arParams["GET_LIST"];
        }

        $arAllSectionMap = array();
        $arHideSection = array();
        $hideMenuSection = CIBlockSection::GetList(
            array("left_margin" => "asc"),
            array(
                "IBLOCK_ID" => $arParams["IBLOCK_ID"],
                /*"ACTIVE" => "Y",
                "GLOBAL_ACTIVE"=>"Y",
                "IBLOCK_ACTIVE"=>"Y",*/
                ///"<=DEPTH_LEVEL" => $arParams["DEPTH_LEVEL"]
            ),
            false,
            array(
                "ID",
                "IBLOCK_SECTION_ID",
                "UF_HIDE_SECTION_MENU",
            )
        );
        while ($infoMainSection = $hideMenuSection->GetNext())
        {
            if(!empty($infoMainSection["IBLOCK_SECTION_ID"]))
            {
                $arAllSectionMap[$infoMainSection["IBLOCK_SECTION_ID"]][] = $infoMainSection["ID"];
            }
            if($infoMainSection["UF_HIDE_SECTION_MENU"])
            {
                $arHideSection[] = $infoMainSection["ID"];
            }
        }
        foreach($arAllSectionMap as $key => $sections)
        {
            if(in_array($key,$arHideSection))
            {
                $arHideSection = array_merge($arHideSection,$sections);
            }
        }

        $arFilter["!ID"] = $arHideSection;

        /*$HideSection = array();
        $hideMenuSection = CIBlockSection::GetList(array(),array("IBLOCK_ID"=>$arParams["IBLOCK_ID"],"UF_HIDE_SECTION_MENU" => true),false,array("ID","LEFT_MARGIN","RIGHT_MARGIN"));
        while ($infoMainSection = $hideMenuSection->GetNext()){
            $GetAll = CIBlockSection::GetList(array(),array("IBLOCK_ID"=>$arParams["IBLOCK_ID"],">=LEFT_BORDER" => $infoMainSection["LEFT_MARGIN"],"<=RIGHT_BORDER" => $infoMainSection["RIGHT_MARGIN"]),false,array("ID"));
            while ($hideSection = $GetAll->GetNext()){
                $HideSection[] = $hideSection["ID"];
            }
        }


        $arFilter["!ID"] = $HideSection; */

		$arOrder = array(
			"left_margin"=>"asc",
		);

		$rsSections = CIBlockSection::GetList($arOrder, $arFilter, false, array(
			"ID",
			"DEPTH_LEVEL",
			"NAME",
			"SECTION_PAGE_URL",
			"UF_*"
		));
		if($arParams["IS_SEF"] !== "Y")
			$rsSections->SetUrlTemplates("", $arParams["SECTION_URL"]);
		else
			$rsSections->SetUrlTemplates("", $arParams["SEF_BASE_URL"].$arParams["SECTION_PAGE_URL"]);

		while($arSection = $rsSections->GetNext())
		{
			$arResult["SECTIONS"][] = array(
				"ID" => $arSection["ID"],
				"DEPTH_LEVEL" => $arSection["DEPTH_LEVEL"],
				"~NAME" => $arSection["~NAME"],
				"~SECTION_PAGE_URL" => $arSection["~SECTION_PAGE_URL"],
				"PICTURE" => CFile::GetPath($arSection["UF_MENU_LEFT_IMG"]),
			);
			$arResult["ELEMENT_LINKS"][$arSection["ID"]] = array();
		}

        if($arParams["IS_SEF"] === "Y")
        {
            $engine = new CComponentEngine($this);
            if (CModule::IncludeModule('iblock'))
            {
                $engine->addGreedyPart("#SECTION_CODE_PATH#");
                $engine->setResolveCallback(array("CIBlockFindTools", "resolveComponentEngine"));
            }
            $componentPage = $engine->guessComponentPath(
                $arParams["SEF_BASE_URL"],
                array(
                    "section" => $arParams["SECTION_PAGE_URL"],
                    "detail" => $arParams["DETAIL_PAGE_URL"],
                ),
                $arVariables
            );
            if($componentPage === "detail")
            {
                CComponentEngine::InitComponentVariables(
                    $componentPage,
                    array("SECTION_ID", "ELEMENT_ID"),
                    array(
                        "section" => array("SECTION_ID" => "SECTION_ID"),
                        "detail" => array("SECTION_ID" => "SECTION_ID", "ELEMENT_ID" => "ELEMENT_ID"),
                    ),
                    $arVariables
                );
                $varId = intval($arVariables["ELEMENT_ID"]);
            }
        }

        if(($varId > 0) && (intval($arVariables["SECTION_ID"]) <= 0) && CModule::IncludeModule("iblock"))
        {
            $arSelect = array("ID", "IBLOCK_ID", "DETAIL_PAGE_URL", "IBLOCK_SECTION_ID");
            $arFilter = array(
                "ID" => $varId,
                "ACTIVE" => "Y",
                "IBLOCK_ID" => $arParams["IBLOCK_ID"],
            );
            $rsElements = CIBlockElement::GetList(array(), $arFilter, false, false, $arSelect);
            if(($arParams["IS_SEF"] === "Y") && (strlen($arParams["DETAIL_PAGE_URL"]) > 0)) {
                $rsElements->SetUrlTemplates($arParams["SEF_BASE_URL"] . $arParams["DETAIL_PAGE_URL"]);
            }
            while($arElement = $rsElements->GetNext())
            {
                $arResult["ELEMENT_LINKS"][$arElement["IBLOCK_SECTION_ID"]][] = $arElement["~DETAIL_PAGE_URL"];
            }
        }

		$this->EndResultCache();
	}
}

$aMenuLinksNew = array();
$menuIndex = 0;
$previousDepthLevel = 1;
foreach($arResult["SECTIONS"] as $arSection)
{
	if ($menuIndex > 0)
		$aMenuLinksNew[$menuIndex - 1][3]["IS_PARENT"] = $arSection["DEPTH_LEVEL"] > $previousDepthLevel;
	$previousDepthLevel = $arSection["DEPTH_LEVEL"];

	$arResult["ELEMENT_LINKS"][$arSection["ID"]][] = urldecode($arSection["~SECTION_PAGE_URL"]);
	$aMenuLinksNew[$menuIndex++] = array(
		htmlspecialcharsbx($arSection["~NAME"]),
		$arSection["~SECTION_PAGE_URL"],
		$arResult["ELEMENT_LINKS"][$arSection["ID"]],
		array(
			"FROM_IBLOCK" => true,
			"IS_PARENT" => false,
			"DEPTH_LEVEL" => $arSection["DEPTH_LEVEL"],
			"PICTURE" => $arSection["PICTURE"],
		),
	);
}


$newLinks = [
    Array(
        "Хит продаж",
        "/catalog/hit/",
        Array(),
        Array("PICTURE"=>"/img/new_icon_menu/4924378_1_4514636.png"),
        ""
    ),
    Array(
        "Распродажа",
        "/catalog/specials/",
        Array(),
        Array("PICTURE"=>"/img/new_icon_menu/4924377_2_4514636.png"),
        ""
    ),
    Array(
        "Суперпредложение",
        "/catalog/super/",
        Array(),
        Array("PICTURE"=>"/img/new_icon_menu/4924379_3_4514636.png"),
        ""
    ),
    Array(
        "Новинки",
        "/catalog/novinki/",
        Array(),
        Array("PICTURE"=>"/img/new_icon_menu/4924380_4_4514636.png"),
        ""
    ),
];

$aMenuLinksNew = array_merge($aMenuLinksNew, $newLinks);
return $aMenuLinksNew;
?>