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
$this->addExternalCss("/bitrix/css/main/bootstrap.css");

$action = (!empty($arParams["ACTION_VARIABLE"]) ? $arParams["ACTION_VARIABLE"] : "action");
if(isset($_REQUEST[$action]) && $_REQUEST[$action] == "DELETE_FROM_COMPARE_RESULT")
{
    $arID = array();
    if (isset($_REQUEST["ID"]))
    {
        $arID = $_REQUEST["ID"];
        if(!is_array($arID))
            $arID = array($arID);
    }
    if (!empty($arID))
    {
        foreach($arID as $ID)
        {
            if (isset($_SESSION[$arParams["COMPARE_NAME"]][$arParams["IBLOCK_ID"]]["ITEMS"][$ID]))
                unset($_SESSION[$arParams["COMPARE_NAME"]][$arParams["IBLOCK_ID"]]["ITEMS"][$ID]);
        }
        unset($ID);
    }
    unset($arID);
    
}
?>
<?

$arItemIDS = array();
if(!empty($_SESSION[$arParams["COMPARE_NAME"]][$arParams["IBLOCK_ID"]]["ITEMS"]))
{
    foreach($_SESSION[$arParams["COMPARE_NAME"]][$arParams["IBLOCK_ID"]]["ITEMS"] as $item)
    {
        $arItemIDS[] = $item["ID"];     
    }
}

$obCache = new CPHPCache();
if ($obCache->InitCache(36000, serialize($arItemIDS), "/iblock/catalog/compare"))
{
    $arComparePropsCode = $obCache->GetVars();
}
elseif ($obCache->StartDataCache())
{
    foreach($arItemIDS as $itemId)
    {
        $showPropSection = false;
        $resListSectionThisElem = CIBlockElement::GetElementGroups($itemId);
        $nextSection = true;
        $listProp[$itemId] = array();
        while (($arr = $resListSectionThisElem->GetNext()) && $nextSection) 
        {
            if ($arr["ID"] > 0) 
            {
                $paramProps = CIBlockElement::GetList(array(), array("IBLOCK_ID" => 27, "PROPERTY_4945" => $arr["ID"]))->GetNextElement();
                if ($paramProps && empty($listProp[$itemId])) 
                {
                    $showListProps = $paramProps->GetProperty(4940);
                    $showListPropsForGroup = $paramProps->GetProperty(4942);
                    $listProp[$itemId]["START"] = $paramProps->GetProperty(4943)["VALUE"];
                    $listProp[$itemId]["STOP"] = $paramProps->GetProperty(4944)["VALUE"];
                    $listProp[$itemId]["ADD"] = $paramProps->GetProperty(4947)["VALUE"];
                    $listProp[$itemId]["DELETE"] = $paramProps->GetProperty(4946)["VALUE"];
                    
                }
            }
        } 
    }
    
    $arPropLink = CIBlockSectionPropertyLink::GetArray($arParams["IBLOCK_ID"], 0);
    $arCompareProps = array();
    $arComparePropsCode = array();
    foreach($listProp as $key => $prop)
    {
        foreach($arPropLink as $PID => $property)
        {
            if (
                (
                    ($property['PROPERTY_ID'] >= $prop["START"] && $property['PROPERTY_ID'] <= $prop["STOP"]) 
                    || 
                    (in_array($property['PROPERTY_ID'], $prop["ADD"]))
                    &&
                    $property['PROPERTY_ID'] != 5087
                )
                &&
                (!in_array($property['PROPERTY_ID'], $prop["DELETE"]))
            )
            {
                if(!in_array($property["PROPERTY_ID"],$arCompareProps))
                {
                    $arCompareProps[] = $property["PROPERTY_ID"];    
                }   
            }    
        }     
    }
    if(!empty($arCompareProps))
    {
        foreach($arCompareProps as $propId)
        {
            $obProps = CIBlockProperty::GetList(
                array("sort"=>"asc", "name"=>"asc"), 
                array("IBLOCK_ID" => $arParams["IBLOCK_ID"],"ID" => $propId)
            );
            while ($arProps = $obProps->GetNext())
            {
                if(!in_array($arProps["CODE"],$arComparePropsCode))
                {
                    $arComparePropsCode[] = $arProps["CODE"];    
                }    
            }    
        }
        
    }    
    $obCache->EndDataCache($arComparePropsCode);    
}
if (!isset($arComparePropsCode))
    $arComparePropsCode = array();  
    
$arParams["COMPARE_PROPERTY_CODE"] = $arComparePropsCode;     

?>
<?$APPLICATION->IncludeComponent(
	"bitrix:catalog.compare.result",
	"",
	array(
		"IBLOCK_TYPE" => $arParams["IBLOCK_TYPE"],
		"IBLOCK_ID" => $arParams["IBLOCK_ID"],
		"BASKET_URL" => $arParams["BASKET_URL"],
		"ACTION_VARIABLE" => (!empty($arParams["ACTION_VARIABLE"]) ? $arParams["ACTION_VARIABLE"] : "action"),
		"PRODUCT_ID_VARIABLE" => $arParams["PRODUCT_ID_VARIABLE"],
		"SECTION_ID_VARIABLE" => $arParams["SECTION_ID_VARIABLE"],
		"FIELD_CODE" => $arParams["COMPARE_FIELD_CODE"],
		"PROPERTY_CODE" => $arParams["COMPARE_PROPERTY_CODE"],
		"NAME" => $arParams["COMPARE_NAME"],
		"CACHE_TYPE" => $arParams["CACHE_TYPE"],
		"CACHE_TIME" => $arParams["CACHE_TIME"],
		"PRICE_CODE" => $arParams["PRICE_CODE"],
		"USE_PRICE_COUNT" => $arParams["USE_PRICE_COUNT"],
		"SHOW_PRICE_COUNT" => $arParams["SHOW_PRICE_COUNT"],
		"PRICE_VAT_INCLUDE" => $arParams["PRICE_VAT_INCLUDE"],
		"PRICE_VAT_SHOW_VALUE" => $arParams["PRICE_VAT_SHOW_VALUE"],
		"DISPLAY_ELEMENT_SELECT_BOX" => $arParams["DISPLAY_ELEMENT_SELECT_BOX"],
		"ELEMENT_SORT_FIELD_BOX" => $arParams["ELEMENT_SORT_FIELD_BOX"],
		"ELEMENT_SORT_ORDER_BOX" => $arParams["ELEMENT_SORT_ORDER_BOX"],
		"ELEMENT_SORT_FIELD_BOX2" => $arParams["ELEMENT_SORT_FIELD_BOX2"],
		"ELEMENT_SORT_ORDER_BOX2" => $arParams["ELEMENT_SORT_ORDER_BOX2"],
		"ELEMENT_SORT_FIELD" => $arParams["COMPARE_ELEMENT_SORT_FIELD"],
		"ELEMENT_SORT_ORDER" => $arParams["COMPARE_ELEMENT_SORT_ORDER"],
		"DETAIL_URL" => $arResult["FOLDER"].$arResult["URL_TEMPLATES"]["element"],
		"OFFERS_FIELD_CODE" => $arParams["COMPARE_OFFERS_FIELD_CODE"],
		"OFFERS_PROPERTY_CODE" => $arParams["COMPARE_OFFERS_PROPERTY_CODE"],
		"OFFERS_CART_PROPERTIES" => $arParams["OFFERS_CART_PROPERTIES"],
		'CONVERT_CURRENCY' => $arParams['CONVERT_CURRENCY'],
		'CURRENCY_ID' => $arParams['CURRENCY_ID'],
		'HIDE_NOT_AVAILABLE' => $arParams['HIDE_NOT_AVAILABLE'],
		'TEMPLATE_THEME' => (isset($arParams['TEMPLATE_THEME']) ? $arParams['TEMPLATE_THEME'] : '')
	),
	$component,
	array("HIDE_ICONS" => "Y")
);?>