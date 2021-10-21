<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");

Bitrix\Main\Loader::includeModule("iblock");
Bitrix\Main\Loader::includeModule("sale");
global $DB;


$file = file_get_contents($_SERVER['DOCUMENT_ROOT'].'/test/1c_new.xml');
$xml = simplexml_load_string($file);

foreach($xml->Заказ as $order)
{
    $SQL = "SELECT ID, XML_ID, DATE_INSERT, PAYED, DATE_PAYED, PAY_SYSTEM_ID, USER_ID, STATUS_1C FROM b_sale_order WHERE ID = '".current($order->ЗаказНомер)."' ORDER BY DATE_UPDATE ASC LIMIT 0,1;";

    $db_sales = $DB->Query($SQL);
    if($ar_sales = $db_sales->Fetch())
    {
        if($ar_sales['STATUS_1C'] == 1)
        {
            //$DB->Query('UPDATE b_sale_order SET STATUS_1C=0 WHERE ID='.$ar_sales['ID']);
        }
    }
    
}

/*
$file = file_get_contents($_SERVER['DOCUMENT_ROOT'].'/test/1c.xml');
$xml = simplexml_load_string($file);

foreach($xml->Товар as $product)
{
    $rsElement = CIBlockElement::GetList(
        array(), 
        array(
            'ID' => current($product->IDТовараНаСайте)
        ), 
        false, 
        array("nTopCount" => 1), 
        array(
            'ID',
            'IBLOCK_ID',
            'ACTIVE'
        )
    );
    if($arElement = $rsElement->GetNext())
    {
        if(current($product->Удаление) == 'D' && $arElement['ACTIVE'] == 'Y')
        {
//            CIBlockElement::SetPropertyValues($arElement['ID'], $arElement['IBLOCK_ID'], 'D', 'ACTIVE');
            echo '<pre>'; echo '<br>'; var_export('ACTIVE: D'); echo '</pre>';  
        } 
        echo '<pre>'; echo '<br>'; var_export('STATUS_1C: N'); echo '</pre>';  
        //CIBlockElement::SetPropertyValues($arElement['ID'], $arElement['IBLOCK_ID'], 'N', 'STATUS_1C');
    }
}*/
?>