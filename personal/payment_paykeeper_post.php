<?php require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");
    $secret_seed = "J2Cq_8BFYL-GqGMqmK"; //Секретное слово
    $id = $_POST['id'];
    $sum = $_POST['sum'];
    $clientid = $_POST['clientid'];
    $orderid = $_POST['orderid'];
    $key = $_POST['key'];

    if ($key != md5 ($id.number_format($sum, 2, ".", "")
            .$clientid.$orderid.$secret_seed))
    {
        echo "Error! Hash mismatch";
        exit;
    }

    if($orderid) {
        \Bitrix\Main\Loader::includeModule("sale");
        $arOrder = \CSaleOrder::GetByID($orderid);
        if ($arOrder) {
            $arFields = array("PAYED" => "Y");
            CSaleOrder::Update($orderid, $arFields);
        }
    }
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/epilog_after.php");?>