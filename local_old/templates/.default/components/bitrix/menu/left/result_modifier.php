<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<?if($USER->GetID() == 8):?>
    <?//echo '<pre data>'; print_r($arResult); echo '</pre>';?>
<?endif?>
<?
$arNewResult = array();
$arNewResult['MOBILE_ITEMS'] = $arResult;
$arNewResult['DESCTOP_ITEMS'] = array();
foreach($arResult as $arItem)
{
    if($arItem["LINK"] == "/catalog/")
    {
        continue;
    }
    
    $arItem["DEPTH_LEVEL"] = intval($arItem["DEPTH_LEVEL"]) - 1;
    $arNewResult['DESCTOP_ITEMS'][] = $arItem;    
}
$arResult = $arNewResult;

foreach($arResult["MOBILE_ITEMS"] as $i=>$arItem)
{
    if ($arItem['DEPTH_LEVEL'] == 1)
    {
        if (isset($prevDepth1)) 
            $arResult["MOBILE_ITEMS"][$prevDepth1]['COUNT_DEPTH_2'] = ceil($count/3);
        $prevDepth1 = $i;
        $count = 0;
    }
    elseif ($arItem['DEPTH_LEVEL'] == 2)
    {
        $count++;
    }
}

foreach($arResult["DESCTOP_ITEMS"] as $i => $arItem)
{
    if ($arItem['DEPTH_LEVEL'] == 1)
    {
        if (isset($prevDepth1)) 
            $arResult["DESCTOP_ITEMS"][$prevDepth1]['COUNT_DEPTH_2'] = ceil($count/3);
        $prevDepth1 = $i;
        $count = 0;
    }
    elseif ($arItem['DEPTH_LEVEL'] == 2)
    {
        $count++;
    }
}     
    /*foreach($arResult as $i=>$arItem):
        if ($arItem['DEPTH_LEVEL'] == 1):
            if (isset($prevDepth1)) $arResult[$prevDepth1]['COUNT_DEPTH_2'] = ceil($count/3);
            $prevDepth1 = $i;
            $count = 0;
        elseif ($arItem['DEPTH_LEVEL'] == 2):
            $count++;
        endif;
    endforeach;*/
    ?>