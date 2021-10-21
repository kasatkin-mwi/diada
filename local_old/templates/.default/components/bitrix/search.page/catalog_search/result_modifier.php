<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<?foreach ($arResult["SEARCH"] as $item){
    if (intval($item["ITEM_ID"])>0){
        $arResult["LIST_PRODUCT"][] = $item["ITEM_ID"];
    }
}
unset($arResult["SEARCH"]);?>
