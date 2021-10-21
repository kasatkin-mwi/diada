<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");

if($_SERVER['REQUEST_METHOD'] == 'POST' && $_REQUEST['action'] == 'getRating' && !empty($_REQUEST['products']))
{
    global $arrFilter;
    
    $arrFilter['PROPERTY_TOVAR'] = $_REQUEST['products'];
    
    ?>
    <?$result = $APPLICATION->IncludeComponent(
        "salavey:product.raiting",
        "",
        Array(
            "IBLOCK_TYPE" => 'servis',
            "IBLOCK_ID" => 28,
            "FILTER_NAME" => 'arrFilter',
            "CACHE_TIME" => '3600',
            "CACHE_TYPE" => 'A',
            "COMPOSITE_FRAME_MODE" => "A",
            "COMPOSITE_FRAME_TYPE" => "AUTO"
        )
    );?>
    <?
    
    exit(json_encode($result));   
}
?>