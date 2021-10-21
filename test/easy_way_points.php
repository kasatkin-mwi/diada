<?
$_SERVER["DOCUMENT_ROOT"] = realpath(dirname(__FILE__) . '/../../');

$DOCUMENT_ROOT = $_SERVER["DOCUMENT_ROOT"];

require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
set_time_limit(0);
Bitrix\Main\Loader::includeModule("sale");
Bitrix\Main\Loader::includeModule("highloadblock");

$hlblock  = Bitrix\Highloadblock\HighloadBlockTable::getById(1)->fetch();
$entity   = Bitrix\Highloadblock\HighloadBlockTable::compileEntity( $hlblock );
$entity_requests_data_class = $entity->getDataClass();
$config = array(
    "url" => "https://lk.easyway.ru/EasyWay/hs/EWA_API/v2/",
    "user" => "CCYSS",
    "pass" => "khcNt6zN"
);
include_once($_SERVER["DOCUMENT_ROOT"]."/bitrix/php_interface/include/easyway.php");
            
$ew = new EWConnector($config["url"], $config["user"], $config["pass"]);
$result = $ew->getPickupPoints();
foreach($result as $pickpoint)
{
    $arFields = array(
        "UF_CITY" => $pickpoint["city"],
        "UF_ADDRESS" => $pickpoint["address"],
        "UF_LAT" => $pickpoint["lat"],
        "UF_LNG" => $pickpoint["lng"],
        "UF_OFFICE" => $pickpoint["office"],
        "UF_GUID" => $pickpoint["guid"],
        "UF_PARTNER" => $pickpoint["partner"],
        "UF_SHEDULE" => $pickpoint["schedule"],
        "UF_PHONE" => $pickpoint["phone"],
        "UF_TRIPDESCRIPTION" => $pickpoint["tripDescription"],
        "UF_IS_TERMINAL" => ($pickpoint["isTerminal"] ? array(5) : array(false)),
        "UF_FIAS" => $pickpoint["fiasRegionId"],
    );
    $resData = $entity_requests_data_class::getList(array(
         'select' => array("*"),
         'filter' => array(
            "UF_GUID" => $pickpoint["guid"],
         ),
         'order' => array(),
         'limit' => false,
    ));

    if (!$arHlItem = $resData->Fetch())
    {
        $entity_requests_data_class::add($arFields);
        $result = CSaleOrderPropsVariant::GetList(($b='SORT'), ($o='ASC'), Array('ORDER_PROPS_ID' => 25, "VALUE" => $pickpoint["guid"]));
        if (!$row = $result->Fetch())
        {
            CSaleOrderPropsVariant::Add(
                array(
                    "ORDER_PROPS_ID" => 25,
                    "NAME" => $pickpoint["address"].($pickpoint["isTerminal"] ? " (Терминал)" : ""),
                    "VALUE" => $pickpoint["guid"],
                )
            );    
        }   
    }
    else
    {
        $needUpdate = false;
        foreach($arFields as $code => $val)
        {
            if($val != $arHlItem[$code])
            {
                $needUpdate = true;
                break;
            }    
        }
        
        if($needUpdate)
        {
            $entity_requests_data_class::update($arHlItem["ID"],$arFields);
            $result = CSaleOrderPropsVariant::GetList(($b='SORT'), ($o='ASC'), Array('ORDER_PROPS_ID' => 25, "VALUE" => $pickpoint["guid"]));
            if ($row = $result->Fetch())
            {
                CSaleOrderPropsVariant::Update($row["ID"],
                    array(
                        "ORDER_PROPS_ID" => 25,
                        "NAME" => $pickpoint["address"].($pickpoint["isTerminal"] ? " (Терминал)" : ""),
                        "VALUE" => $pickpoint["guid"],
                    )
                );    
            }    
        }   
    }      
}