<?php require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");
if($_REQUEST["ORDER_ID"]) {
    \Bitrix\Main\Loader::includeModule("sale");

    $OrderId = intval($_REQUEST["ORDER_ID"]);

    $dbRes = \Bitrix\Sale\PropertyValueCollection::getList(array(
        'select' => array("*"),
        'filter' => array(
            '=ORDER_ID' => $OrderId,
            'ORDER_PROPS_ID' => array(3, 5)
        )
    ));
    while ($item = $dbRes->fetch()) {
        switch ($item["CODE"]) {
            case "NAME":
                $arResult["ORDER"]["NAME"] = $item["VALUE"];
                break;
            case "PHONE":
                $arResult["ORDER"]["PHONE"] = $item["VALUE"];
                break;
        }
    }

    $order = \Bitrix\Sale\Order::load($OrderId);
    $arResult["ORDER"]["ID"] = $order->getId();
    $arResult["ORDER"]["PRICE"] = $order->getPrice();

    //echo'<pre>';print_r($arResult["ORDER"]);echo'</pre>';

    $client_login=$arResult["ORDER"]["NAME"];
    $orderid=$arResult["ORDER"]["ID"];
    $order_sum=$arResult["ORDER"]["PRICE"];
    $optional_phone=$arResult["ORDER"]["PHONE"];

    $payment_parameters = http_build_query(array( "clientid"=>$client_login,
        "orderid"=>$orderid,
        "sum"=>$order_sum,
        "phone"=>$optional_phone));
    $options = array("http"=>array(
        "method"=>"POST",
        "header"=>
            "Content-type: application/x-www-form-urlencoded",
        "content"=>$payment_parameters
    ));
    $context = stream_context_create($options);
    echo file_get_contents("https://diada-arms.server.paykeeper.ru/order/inline/",FALSE, $context);
}
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/epilog_after.php");?>