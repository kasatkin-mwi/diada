<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");

CModule::IncludeModule('sale');

$orderID = 171526;
/* $propValueID = 3560818;

CSaleOrderPropsValue::Update(3560818, array(
	"ORDER_ID"=>$orderID,
	"ORDER_PROPS_ID"=>9,
	"VALUE" => 434243
	)
);
 */

$arFields = array(
	'ORDER_ID' => 171526,
	'ORDER_PROPS_ID' => 68,
	'NAME' => 'Адрес доставки',
	'VALUE' => 'афыафыаыфаф',
	'CODE' => 'ADDRESS',
); 
 
$int = CSaleOrderPropsValue::Add($arFields);
echo "<pre>"; print_r($int) ; echo "</pre>";

require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/epilog_after.php");
?>