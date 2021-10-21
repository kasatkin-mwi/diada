<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

Bitrix\Main\Loader::includeModule("sale");

$arTrackNumbers = array();
$obSale = CSaleOrder::GetList(
    array(
        'DATE_INSERT' => 'DESC'
    ),
    array(
        '!PROPERTY_VAL_BY_CODE_TRACKING_NUMBER' => false,
        '!PROPERTY_VAL_BY_CODE_STATUS' => 'Вручение адресату',
    ),
    false,
    false,
    array(
        'ID', 
        'DATE_STATUS'
    )
);

while ($arOrder = $obSale->GetNext()) 
{   
    $arTrackNumbers[] = $arOrder['ID'];
}

$arOrdersStr = '';
foreach($arTrackNumbers as $orderId)
{
    $arOrdersStr .= "<Order>".$orderId.'ЭВР'."</Order>";
}
unset($orderId);

if(!empty($arOrdersStr))
{
    global $api_key;
    
    $check_order = "<File>
        <API>".$api_key."</API>
        <Method>trackingpost</Method>
        <Orders>
        ".$arOrdersStr."
        </Orders>
    </File>";
    $url = 'http://api.grastin.ru/api.php';
    $ch = curl_init();
    curl_setopt($ch,CURLOPT_URL, $url);
    curl_setopt($ch,CURLOPT_POST, 1);
    curl_setopt($ch,CURLOPT_POSTFIELDS, 'XMLPackage='.urlencode($check_order));
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_HEADER, 0);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
    $arCheckResult = curl_exec($ch);
    curl_close($ch);

    $orderResult = simplexml_load_string($arCheckResult);
    $arLastOperations = array();
    
    foreach($orderResult as $order)
    {
        $arLastOperations[str_replace('ЭВР', '', current($order->Number))] = current(current($order->Operations)[count(current($order->Operations)) - 1])['OperAttr'];
    }
    
    foreach($arTrackNumbers as $orderId)
    {
        $arOrdersStr .= "<Order>".$orderId.'ЭВР'."</Order>";
        $order = Bitrix\Sale\Order::load($orderId);            
        $propertyCollection = $order->getPropertyCollection();
        $trackingStatus = $propertyCollection->getItemByOrderPropertyId(67);
        if($trackingStatus->getValue() != $arLastOperations[$orderId] && !empty($arLastOperations[$orderId]))
        {
            $trackingStatus->setValue($arLastOperations[$orderId]);
            $propertyCollection->save();    
        }
    }    
}