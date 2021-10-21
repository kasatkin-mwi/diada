<?require_once($_SERVER['DOCUMENT_ROOT'] . "/bitrix/modules/main/include/prolog_before.php");?>
<?
$arrMessage = Array
(
    "ORDER_ID" => 74245,
    "ORDER_REAL_ID" => 74245,
    "ORDER_ACCOUNT_NUMBER_ENCODE" => 74245,
    "ORDER_DATE" => "02.11.2017 09:51:07",
    "ORDER_USER" => "Семен",
    "PRICE" => "530 р.",
    "BCC" => "info@diada-arms.ru",
    "EMAIL" => "dimon4386@yandex.ru",
    "SALE_EMAIL" => "info@diada-arms.ru",
    "DELIVERY_PRICE" => 300,
);
Bitrix\Main\Loader::includeModule("sale");
Bitrix\Main\Loader::includeModule("catalog");
$order = Bitrix\Sale\Order::load(74244);
$basket = $order->getBasket();
$shipmentCollection = $order->getShipmentCollection();
$paymentCollection = $order->getPaymentCollection();
$arrMessage["PRICE"] = $basket->getPrice()." р.";
$arrMessage["COMMENT"] = $order->getField("USER_DESCRIPTION");
foreach ($shipmentCollection as $shipment) {
    if (!$shipment->isSystem()) {
        $arrMessage["DELIVERY_NAME"] = $shipment->getDeliveryName();
        $arrMessage["DELIVERY_STORE"] = $shipment->getStoreId();
    }
}
if ($arrMessage["DELIVERY_STORE"]>0){
    $infoStore = CCatalogStore::GetList(array(),array("ID" => $arrMessage["DELIVERY_STORE"]))->Fetch();
    if (strlen($infoStore["ADDRESS"])>0) $arrMessage["DELIVERY_STORE"] = " (".$infoStore["ADDRESS"].")";
    else $arrMessage["DELIVERY_STORE"] = "";
}
else{
    $arrMessage["DELIVERY_STORE"] = "";
}
$arrMessage["DELIVERY_VALUE"] = $shipmentCollection->getPriceDelivery()." р.";
foreach ($paymentCollection as $payment) {
    $arrMessage["PAY_METHOD"][] = $payment->getPaymentSystemName();
}
$arrMessage["PAY_METHOD"] = implode(" / ",$arrMessage["PAY_METHOD"]);
$arrMessage["FULL_PRICE"] = $order->getPrice()." р.";
$ar = $order->getPropertyCollection()->getArray();
$propOrderCollection = $order->getPropertyCollection();
$arrMessage["BASCET_ITEMS"] = <<<HTML
<table class="order_table">
    <tr>
        <th>№</th>
        <th>Наименование</th>
        <th>Комплектация</th>
        <th>Количество</th>
        <th>Цена</th>
    </tr>
HTML;
$iCounterBasket = 1;
foreach ($basket as $basketItem) {
    $basketPropertyCollection = $basketItem->getPropertyCollection();
    $propBuscketItem = array();
    foreach ($basketPropertyCollection as $propertyItem) {
        $code = $propertyItem->getField('CODE');
        $value = $propertyItem->getField('VALUE');
        if (!in_array($code,array("CATALOG.XML_ID","PRODUCT.XML_ID")) && ($basketItem->getField('NAME') != $value)) {
            if ($code == "") $value = str_replace("комплект ","",$value);
            $propBuscketItem[$code] = $value;
        };
    }
    $nameComplect = "-";
    if ($propBuscketItem[""]) $nameComplect = $propBuscketItem[""];
    $arrMessage["BASCET_ITEMS"] .= "
<tr>
        <td>".$iCounterBasket++."</td>
        <td>".$basketItem->getField('NAME')."</td>
        <td>".$nameComplect."</td>
        <td>".$basketItem->getQuantity()."</td>
        <td>".$basketItem->getPrice()." р.</td>
    </tr>";
    if (strlen($propBuscketItem[""])>0) {
        unset($propBuscketItem[""]);
        $iCounterComplect = 1;
        $addString = "";
        foreach ($propBuscketItem as $value){
            $addString .= $iCounterComplect++.") ".$value."<br />";
        }
        $arrMessage["BASCET_ITEMS"] .= "<tr><td colspan='5' class='complect'><p>В комплект входят:</p>" .$addString. "</td></tr>";
    }
    //echo $basketItem->getField('NAME') . ' - ' . $basketItem->getQuantity() . '<br />';
}
$arrMessage["BASCET_ITEMS"] .= "</table>";
$propOrder = array();
$location = $propOrderCollection->getDeliveryLocation();
if ($location){
    $idLoc = $location->getValue();
    $infoLoc = CSaleLocation::GetByID($idLoc,"ru");
    $propOrder["Ваше местоположение"] = $infoLoc["COUNTRY_NAME"].", ".$infoLoc["REGION_NAME"].", г. ".$infoLoc["CITY_NAME"];
}
foreach ($propOrderCollection as $property){
    $val = $property->getValue();
    if (empty($val) || !isset($val)) continue;
    $id = $property->getPropertyId();
    if (in_array($id,array(19,20,17,18))) continue;
    $name = $property->getName();
    $name = str_replace(" (Обязательное поле)","",$name);
    $name = str_replace("Выберете дату доставки","Дата и время доставки",$name);
    $propOrder[$name] = $val;
}
$arrMessage["ORDER_CLIENT_INFO"] = "<table class='delivery'>";
foreach($propOrder as $name=>$val){
    $arrMessage["ORDER_CLIENT_INFO"] .= "<tr><td><b>".$name."</b></td><td>".$val."</td></tr>";
}
$arrMessage["ORDER_CLIENT_INFO"] .= "</table>";

?>
<?$message = <<<MESSAGE
<style>
    body
    {
        font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif;
        font-size: 14px;
        color: #000;
    }
    .message_product_list
    {
        text-align:center;border:solid 2px black;
    }
    .order_table{
        width: 100%;
    }
    .order_table th{
        text-align: center;
    }
    .order_table td:nth-child(1){
        width: 5%;
    }
    .order_table td:nth-child(2){
        //max-width: 100%;
    }
    .order_table td:nth-child(3){
        text-align: center;
        width: 15%;
    }
    .order_table td:nth-child(4){
        text-align: center;
        width: 5%;
    }
    .order_table td:nth-child(5){
        text-align: right;
        width: 10%;
    }
    .order_table td{
        border: 1px solid #3f4b54;
    }
    .order_table td.complect{
        background-color: #efefef;
        padding: 0 20px 5px 20px;
    }
    .order_table td.complect p{
        margin: 0;
        padding: 0;
        font-weight: bold;
        text-align: center;
    }
    .delivery{
        width: 100%;
    }
    .delivery td{
        border: 1px solid #3f4b54;
    }
    .delivery td:nth-child(1){
        width: 30%;
    }
</style>
<p>Уважаемый (ая) <b>#ORDER_USER#!</b></p>
<p>Вы оформили заказ в нашем интернет-магазине: <b>#SITE_NAME#</b></p>
<p><b>В ближайшее время с Вами свяжется менеджер для подтверждения заказа!</b></p>
<p>Пожалуйста, проверьте правильность следующей информации:</p>
<h3>Вы заказали:</h3>
#BASCET_ITEMS#
<p>Стоимость товаров: <b>#PRICE#</b></p>
<p>Доставка: <b>#DELIVERY_NAME# #DELIVERY_STORE#</b> - <b>#DELIVERY_VALUE#</b></p>
<p>Всего: <b>#FULL_PRICE#</b></p>
<p>Выбранный способ оплаты: <b>#PAY_METHOD#</b></p>
<br />
<h3>Информация о вас и доставке:</h3>
#ORDER_CLIENT_INFO#
<h3>Ваш комментарий к заказу:</h3>
<p>#COMMENT#</p>
<br />
<br />
<p><b>В случае, если Вы обнаружите ошибку, сделанную при оформлении заказа - сообщите нам об этом как можно скорее в ответном письме.</b></p>
MESSAGE;
$search = array();
$replace = array();
foreach ($arrMessage as $searchVal => $replaceVal){
    $search[] = "#".$searchVal."#";
    $replace[] = $replaceVal;
}
$message = str_replace($search,$replace,$message);
echo $message;?>




<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="ru" lang="ru">
<head>
    <meta http-equiv="Content-Type" content="text/html;charset=UTF-8"/>
    <style>
        body
        {
            font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif;
            font-size: 14px;
            color: #000;
        }
        .message_product_list
        {
            text-align:center;border:solid 2px black;
        }
    </style>
</head>
<body>
<p>Уважаемый (ая) <b>#ORDER_USER#!</b></p>
<p>Вы оформили заказ в нашем интернет-магазине: <b>#SITE_NAME#</b></p>
<p><b>В ближайшее время с Вами свяжется менеджер для подтверждения заказа!</b></p>
<p>Пожалуйста, проверьте правильность следующей информации:</p>
<p>Вы заказали:</p>
<p>#ORDER_LIST#</p>
<p>Стоимость товаров: <b>#PRICE# руб.</b>.</p>
<p>Доставка: <b>#DELIVERY_NAME#</b>: <b>#DELIVERY_VALUE# руб.</b></p>
<p>Всего:  <b>#FULL_PRICE# руб.</b></p>
<p>Выбранный способ оплаты: <b> #PAY_METHOD#</b></p>
<p>Адрес доставки вашего заказа:</p>
<p></p>
<p>Индекс: <b>#INDEX#</b><p>
<p>Регион: <b>#REGION#</b><p>
<p>Город: <b>#CITY#</b><p>
<p>Улица: <b>#STREET#</b><p>
<p>Дом: <b>#HOUSE#</b><p>
<p>Корпус: <b>#CORPS#</b><p>
<p>Строение: <b>#BUILDING#</b><p>
<p>Квартира: <b>#FLAT#</b><p>
<p>Дата доставки: <b>#DELIVERY_DATE#</b><p>
<p></p>
<p>Доп информация: <i>#ADD_INFO#</i></p>
<p>Номер заказа: #ORDER_ID#</p>
<p>Контактное лицо: <b>#CONTACT_USER#</b></p>
<p>Ваш контактный телефон: <b>#CONTACT_PHONE#</b></p>
<p>Электронный адрес: #EMAIL#</p>
<p>Ваши комментарии к заказу: <i>#COMMENT#</i></p>
<p>В случае, если Вы обнаружите ошибку, сделанную при оформлении заказа - сообщите нам об этом как можно скорее в ответном письме.</p>
</body>
</html>
