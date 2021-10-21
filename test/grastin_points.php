<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
set_time_limit(0);
global $api_key;

Bitrix\Main\Loader::includeModule("sale");
Bitrix\Main\Loader::includeModule("highloadblock");

$hlblock  = Bitrix\Highloadblock\HighloadBlockTable::getById(2)->fetch();
$entity   = Bitrix\Highloadblock\HighloadBlockTable::compileEntity( $hlblock );
$entity_requests_data_class = $entity->getDataClass();

$pickpoints_request = '<File><API>'.$api_key.'</API><Method>selfpickup</Method></File>';

$url = 'http://api.grastin.ru/api.php';
$ch = curl_init();
curl_setopt($ch,CURLOPT_URL, $url);
curl_setopt($ch,CURLOPT_POST, 1);
curl_setopt($ch,CURLOPT_POSTFIELDS, 'XMLPackage='.urlencode($pickpoints_request));
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_HEADER, 0);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
$result = curl_exec($ch);
curl_close($ch);

$pickpoints = simplexml_load_string($result);
 
foreach($pickpoints->Selfpickup as $pickup)
{   
    $name = current($pickup->Name);
    $drivingdescription = current($pickup->drivingdescription);
    $linkdrivingdescription = current($pickup->linkdrivingdescription);
    $id = current($pickup->id);
    $city = current($pickup->city);
    $latitude = current($pickup->latitude);
    $longitude = current($pickup->longitude);
    $timetable = current($pickup->timetable);
    $title = current($pickup->title);
    $phone = current($pickup->phone);
    $email = current($pickup->email);
    $metrostation = current($pickup->metrostation);
    $paymentcard = current($pickup->paymentcard) == true ? array(6) : array(false);
    $regional = current($pickup->regional) == true ? array(7) : array(false);
    $largesize = current($pickup->largesize) == true ? array(8) : array(false);
    $onlylargesize = current($pickup->onlylargesize) == true ? array(9) : array(false);
    $dressingroom = current($pickup->dressingroom) == true ? array(12) : array(false);
    $Exchange = current($pickup->Exchange) == true ? array(13) : array(false);
    $TakeAway = current($pickup->TakeAway) == true ? array(14) : array(false);
    
    $arFields = array(
        "UF_NAME" => $name,
        "UF_DRIVING_DESCR" => $drivingdescription,
        "UF_TRIP_DESCR_PHOTO" => $linkdrivingdescription,
        "UF_ID" => $id,
        "UF_CITY" => $city,
        "UF_LATITUDE" => $latitude,
        "UF_LONGITUDE" => $longitude,
        "UF_TIME" => $timetable,
        "UF_TITLE" => $title,
        "UF_PHONE" => $phone,
        "UF_EMAIL" => $email,
        "UF_METROSTATION" => $metrostation,
        "UF_CARD" => $paymentcard,
        "UF_REGIONAL" => $regional,
        "UF_LARGESIZE" => $largesize,
        "UF_ONLY_LARGESIZE" => $onlylargesize,
        "UF_DRESSING_ROOM" => $dressingroom,
        "UF_EXCHANGE" => $Exchange,
        "UF_TAKEAWAY" => $TakeAway,
    );
    
    $resData = $entity_requests_data_class::getList(array(
         'select' => array("*"),
         'filter' => array(
            "UF_ID" => $id,
         ),
         'order' => array(),
         'limit' => false,
    ));
    if (!$arHlItem = $resData->Fetch())
    {
        $entity_requests_data_class::add($arFields);
        $result = CSaleOrderPropsVariant::GetList(($b='SORT'), ($o='ASC'), Array('ORDER_PROPS_ID' => 44, "VALUE" => $id));
        if (!$row = $result->Fetch())
        {
            CSaleOrderPropsVariant::Add(
                array(
                    "ORDER_PROPS_ID" => 44,
                    "NAME" => $title." ".$name,
                    "VALUE" => $id,
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
            $result = CSaleOrderPropsVariant::GetList(($b='SORT'), ($o='ASC'), Array('ORDER_PROPS_ID' => 44, "VALUE" => $id));
            if ($row = $result->Fetch())
            {
                CSaleOrderPropsVariant::Update($row["ID"],
                    array(
                        "ORDER_PROPS_ID" => 44,
                        "NAME" => $title." ".$name,
                        "VALUE" => $id,
                    )
                );    
            }    
        }
    }        
}
$office_request = '<File><API>'.$api_key.'</API><Method>tcofficelist</Method></File>';

$url = 'http://api.grastin.ru/api.php';
$ch = curl_init();
curl_setopt($ch,CURLOPT_URL, $url);
curl_setopt($ch,CURLOPT_POST, 1);
curl_setopt($ch,CURLOPT_POSTFIELDS, 'XMLPackage='.urlencode($office_request));
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_HEADER, 0);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
$result = curl_exec($ch);
curl_close($ch);

$offices = simplexml_load_string($result);
foreach($offices as $office)
{
    $result = CSaleOrderPropsVariant::GetList(($b='SORT'), ($o='ASC'), Array('ORDER_PROPS_ID' => 38, "VALUE" => current($office->Id)));
    if (!$row = $result->Fetch())
    {
        CSaleOrderPropsVariant::Add(
            array(
                "ORDER_PROPS_ID" => 38,
                "NAME" => current($office->title),
                "VALUE" => current($office->Id),
            )
        );    
    }
    else
    {
        CSaleOrderPropsVariant::Update($row["ID"],
            array(
                "ORDER_PROPS_ID" => 25,
                "NAME" => current($office->title).($pickpoint["isTerminal"] ? " (Терминал)" : ""),
                "VALUE" => $pickpoint["guid"],
            )
        );
    }
}

?>