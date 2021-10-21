<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");

if($_SERVER["REQUEST_METHOD"] == "POST" && $_REQUEST["action"] == "getProp" && intval($_REQUEST["ID"]) > 0 && intval($_REQUEST["IBLOCK_ID"]) > 0)
{
    $result = array(
        "links" => array()
    );
    
    \Bitrix\Main\Loader::includeModule("iblock");
    \Bitrix\Main\Loader::includeModule("highloadblock");
    
    $hlblock  = Bitrix\Highloadblock\HighloadBlockTable::getById(4)->fetch();
    $entity   = Bitrix\Highloadblock\HighloadBlockTable::compileEntity( $hlblock );
    $entity_requests_data_class = $entity->getDataClass();
    
    $resData = $entity_requests_data_class::getList(array(
         'select' => array("*"),
         'filter' => array(
            "UF_PROPERTY_ID" => $_REQUEST["ID"],
            "!UF_LINK" => false
         ),
         'order' => array(),
         'limit' => false,
    ));
    while ($arHlItem = $resData->Fetch())
    {
        $result["links"][$arHlItem["UF_ENUM_ID"]] = $arHlItem["UF_LINK"];  
    }
    
    exit(json_encode($result));
}