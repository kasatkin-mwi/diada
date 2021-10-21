<?
use Bitrix\Main,
    Bitrix\Main\Context,
    Bitrix\Main\Loader;
    
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();

if(!isset($arParams["CACHE_TIME"]))
    $arParams["CACHE_TIME"] = 36000000;

$arParams["IBLOCK_TYPE"] = trim($arParams["IBLOCK_TYPE"]);
$arParams["IBLOCK_ID"] = (int)$arParams["IBLOCK_ID"];

if(empty($arParams["IBLOCK_TYPE"]))
{
    $arParams["IBLOCK_TYPE"] = 'servis';
}
if(empty($arParams["IBLOCK_ID"]))
{
    $arParams["IBLOCK_ID"] = 28;
}
    
$arParams['CACHE_GROUPS'] = trim($arParams['CACHE_GROUPS']);
if ('N' != $arParams['CACHE_GROUPS'])
    $arParams['CACHE_GROUPS'] = 'Y';
    
if(empty($arParams["FILTER_NAME"]) || !preg_match("/^[A-Za-z_][A-Za-z01-9_]*$/", $arParams["FILTER_NAME"]))
{
    $arrFilter = array();
}
else
{
    global ${$arParams["FILTER_NAME"]};
    $arrFilter = ${$arParams["FILTER_NAME"]};
    if(!is_array($arrFilter))
        $arrFilter = array();
}

$arParams["CACHE_FILTER"]=$arParams["CACHE_FILTER"]=="Y";
if(!$arParams["CACHE_FILTER"] && count($arrFilter)>0)
    $arParams["CACHE_TIME"] = 0;

if($this->startResultCache(false, array($arrFilter, ($arParams["CACHE_GROUPS"]==="N"? false: $USER->GetGroups()))))
{
    if (!Loader::includeModule("iblock"))
    {
        $this->abortResultCache();
        ShowError(GetMessage("IBLOCK_MODULE_NOT_INSTALLED"));
        return;
    }
    $arResult['items'] = array();
    if(!empty($arrFilter['PROPERTY_TOVAR']))
    {
        $arSelect = array(
            "ID",
            "PROPERTY_OCENKA",
            "PROPERTY_TOVAR"
        );
        
        $arFilter = array(
            "IBLOCK_ID" => $arParams["IBLOCK_ID"],
            "IBLOCK_LID" => SITE_ID,
            "ACTIVE_DATE" => "Y",
            "ACTIVE" => "Y",
            "CHECK_PERMISSIONS" => "Y",
            "MIN_PERMISSION" => "R",
        );
        
        $rsElements = CIBlockElement::GetList(array('ID' => 'asc'), array_merge($arrFilter, $arFilter), false, false, $arSelect);    
        $countReviews = $rsElements->SelectedRowsCount();
        $iCounterReviews = 0;
        $sumReiting = 0;
        while($arItem = $rsElements->GetNext())
        {   
            if(!isset($arResult['items'][$arItem['PROPERTY_TOVAR_VALUE']]))
            {
                $arResult['items'][$arItem['PROPERTY_TOVAR_VALUE']]['COUNTER'] = 0;
                $arResult['items'][$arItem['PROPERTY_TOVAR_VALUE']]['SUM'] = 0;
            }
            else
            {
                $arResult['items'][$arItem['PROPERTY_TOVAR_VALUE']]['COUNTER']++;
                $arResult['items'][$arItem['PROPERTY_TOVAR_VALUE']]['SUM'] += $arItem["PROPERTY_OCENKA_VALUE"];
            }
        }
        
        foreach($arResult['items'] as $key => $item)
        {   
            if($item['COUNTER'] && $item['SUM'])
            {
                $arResult['items'][$key]['RATING'] = round($item['SUM'] / $item['COUNTER'], 2);        
            }       
            else
            {
                $arResult['items'][$key]['RATING'] = 0;   
            }
        }
        unset($item);
        
        foreach($arResult['items'] as $key => $item)
        {   
            $arResult['items'][$key]['RATING_PERCENT'] = ($item['RATING'] * 100) / 5;
        }
        unset($item);
    }
    
    $this->setResultCacheKeys(array(
        "items"
    ));

   // $this->includeComponentTemplate();    
}

return $arResult;
?>