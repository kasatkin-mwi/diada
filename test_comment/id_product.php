<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");?>
<?
if(!CModule::IncludeModule("iblock"))
    return;

$result = \CIBlockElement::GetList(
    array("SORT" => "ASC"),
    array("IBLOCK_ID" => 28, /*"PROPERTY_TOVAR" => 14881*/),
    false,
    array(/*"nPageSize" => 20000, "iNumPage" => 1*/),
    array("ID", "PREVIEW_TEXT", "PROPERTY_TOVAR")
);
while($arData = $result->Fetch()) {
    $arResult["ELEMENT"][ $arData["PROPERTY_TOVAR_VALUE"]  ][ $arData["ID"] ] = $arData["PREVIEW_TEXT"];
}

//echo "<pre>"; print_r($arResult["ELEMENT"]); echo "</pre>";

/*echo count($arResult["ELEMENT"]);
foreach ($arResult["ELEMENT"] as $item){
    //echo "<pre>"; print_r($item); echo "</pre>";
    $array = array_diff_key($item, array_unique($item));

        if($array) {

            echo "<pre>"; print_r($array); echo "</pre>";

            foreach (array_keys($array) as $value) {

                //CIBlockElement::Delete($value);

            }
        }
}*/






?>
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/epilog_after.php");?>