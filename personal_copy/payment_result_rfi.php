<?
require_once($_SERVER['DOCUMENT_ROOT'] . "/bitrix/modules/main/include/prolog_before.php");
file_put_contents($_SERVER["DOCUMENT_ROOT"]."/log_pay_result.txt",print_r($_POST,true),FILE_APPEND);
Bitrix\Main\Loader::includeModule("rficb.payment");
$list = array(
    "tid",
    "name",
    "comment",
    "partner_id",
    "service_id",
    "order_id",
    "type",
    "cost",
    "income_total",
    "income",
    "partner_income",
    "system_income",
    "test",
    "command",
    "phone_number",
    "email",
    "resultStr",
    "date_created",
    "version",
    "​card",
    "recurrent_order_id​",
);
$chekString = "";
foreach ($list as $nameProp){
    $chekString .= $_POST[$nameProp];
}
$chekString .= CRficbPayment::GetSecretKey("s1");
if (CRficbPayment::VerifyCheck($_POST,"s1")){
    Bitrix\Main\Loader::includeModule("sale");
    $SUMM = floatval($_POST["system_income"]);
    preg_match("/^(\d+)_(\d+)$/",$_POST["order_id"],$resultDataOrder);
    $ORDER_ID = $resultDataOrder[1];
    $STATUS_MESS = "Номер платежа: ".$_POST["tid"];
    $order = Bitrix\Sale\Order::load($ORDER_ID);
    $paymentCollection = $order->getPaymentCollection();
    foreach ($paymentCollection as $key => $payment) {
        $ListPay[$key]["sum"] = $payment->getSum();
        $ListPay[$key]["psID"] = $payment->getPaymentSystemId();
    }
    if ((count($ListPay) == 1) && ($ListPay[0]["sum"] <= $SUMM) && ($ListPay[0]["psID"] == 13)) {
        $onePayment = $paymentCollection[0];
        $onePayment->setField("PS_STATUS", "Y");
        $onePayment->setField("PS_STATUS_MESSAGE", $STATUS_MESS);
        $onePayment->setPaid("Y");
        $order->save();
    }
    else {
        $paySystem = Bitrix\Sale\PaySystem\Manager::getObjectById(13);
        $onePayment = $paymentCollection->createItem($paySystem);
        $onePayment->setField("PS_STATUS", "Y");
        $onePayment->setField("PS_STATUS_MESSAGE", $STATUS_MESS);
        $onePayment->setField("SUM", $SUMM);
        $onePayment->setPaid("Y");
        $order->save();
    }
    echo "Ok";
}
?>