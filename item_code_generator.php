<?//$_SERVER["DOCUMENT_ROOT"] = '/home/c/cw05889/testdiada.webtm.ru/public_html';		// для запуска через ssh
/*
require_once($_SERVER['DOCUMENT_ROOT'] . "/bitrix/modules/main/include/prolog_before.php");

CModule::IncludeModule("iblock");

// $itemCode = 10011111;
$IBLOCK_ID = 1;

$arSelect = Array();
$arFilter = Array("IBLOCK_ID"=>$IBLOCK_ID, "ACTIVE_DATE"=>"Y", "ACTIVE"=>"Y", "PROPERTY_item_code"=>false);
$res = CIBlockElement::GetList(Array(), $arFilter, false, Array("nPageSize"=>1), $arSelect);
while($ob = $res->GetNextElement())
{
 $arProps = $ob->GetProperties();
 $arFields = $ob->GetFields();
 $ELEMENT_ID = $arFields['ID'];

 //для генерации кода товара
 // $PROPERTY_VALUE = $itemCode;	
 // $PROPERTY_CODE = 'item_code';

 //для добавления кода товара с пробелом
 $PROPERTY_VALUE = chunk_split($arProps['ITEM_CODE']['VALUE'], 4, ' ');
 $PROPERTY_CODE = 'ITEM_CODE_SPACE';


 // CIBlockElement::SetPropertyValues($ELEMENT_ID, $IBLOCK_ID, $PROPERTY_VALUE, $PROPERTY_CODE);
 // $itemCode++;
}
*/
require_once($_SERVER['DOCUMENT_ROOT'] . "/bitrix/modules/main/include/epilog_after.php");?>