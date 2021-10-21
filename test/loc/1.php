<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");

CModule::IncludeModule('sale');

$rs = \Bitrix\Sale\Location\LocationTable::getByCode(
 '0000073738',
 $parameters
);
while($ar = $rs->Fetch())
{
	echo "<pre>"; print_r($ar); echo "</pre>";
	$locID = $ar['ID'];
}

$rs = \Bitrix\Sale\Location\ExternalTable::getList(
	array(
		'filter' => array(
			'LOCATION_ID' => $locID,
			'SERVICE_ID' => 1
		)
	)
);

while($ar = $rs->Fetch())
{
	echo "<pre>"; print_r($ar); echo "</pre>";
}

$str = "https://mc.yandex.ru/clmap/25448447?page-url=https%3A%2F%2Fwww.diada-arms.ru%2Fpersonal%2Forder%2F&pointer-click=rn%3A714526767%3Ax%3A14744%3Ay%3A25057%3At%3A485%3Ap%3AP1AAAAAA1A1A4AAF%C2%84A1%3AX%3A285%3AY%3A629&browser-info=ti%3A4%3Arqnl%3A1%3Ast%3A1576156925%3Au%3A15689019311038340106%3App%3A3629563401";


$str = urldecode($str);
echo "<pre>"; print_r($str); echo "</pre>";

require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/epilog_after.php");
?>