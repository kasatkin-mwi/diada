<?
require_once($_SERVER['DOCUMENT_ROOT'].'/bitrix/modules/main/include/prolog_before.php');

$_REQUEST['type'] = 'orders';
//if (($_REQUEST['login']=='admin') && ($_REQUEST['passw']=='12345') ) {

//header("Content-type: text/xml; charset=utf-8");

//set_time_limit(0);

global $DB;
global $USER;
$aa=05;
$mm=3;
$bb=2018;

echo '<?xml version="1.0"?>';
?><?

if ($_REQUEST['type']=='contacts')
{

CModule::IncludeModule('sale');

	$conts=array();

$SQL="SELECT * FROM b_sale_order WHERE DATE_INSERT >= '2017-11-01' ORDER BY DATE_INSERT ASC LIMIT 0,10000;";
$results=$DB->Query($SQL);
while ($row = $results->Fetch())
{

$ar_sales=CSaleOrder::GetByID($row['ID']);




	$conts[$ar_sales[USER_ID]]=array();
	// Свойства контрагента

	$db_props = CSaleOrderPropsValue::GetOrderProps($ar_sales['ID']);
while ($arProps = $db_props->Fetch())
{
	if ($arProps[CODE]=='MyPhone') $conts[$ar_sales[USER_ID]]['PHONE']=$arProps[VALUE];
	if ($arProps[CODE]=='MyMail') $conts[$ar_sales[USER_ID]]['EMAIL']=$arProps[VALUE];
	$conts[$ar_sales[USER_ID]]['ORDER_ID']=$ar_sales[ID];

}


	$s1c=0;

}




?>



<Контрагенты>
<?

foreach ($conts as $key=>$cont) {

$rsUser = CUser::GetByID($key);
$arUser = $rsUser->Fetch();

if ($arUser[XML_ID]=='') {
	$arUser[XML_ID]=md5('Пользователь '.$arUser['ID']);

$arFieldsU = array(
      "XML_ID" => md5('Пользователь '.$arUser['ID']),
   );
  //CSaleOrder::Update($arUser['ID'], $arFieldsU);

}




echo "
<Контрагент>
<КонтрагентXMLID>".$arUser[XML_ID]."</КонтрагентXMLID>
<Вид>Физическое лицо</Вид>
<Телефон>".$cont[PHONE]."</Телефон>
<Email>".$cont[EMAIL]."</Email>
<Наименование>".$arUser[LAST_NAME]." ".$arUser[NAME]." ".$arUser[SECOND_NAME]." ".$cont['ORDER_ID']."</Наименование>
<ПолноеНаименование>".$arUser[LAST_NAME]." ".$arUser[NAME]." ".$arUser[SECOND_NAME]."</ПолноеНаименование>
</Контрагент>
";



} ?></Контрагенты>


<? } ?>


<?

if ($_REQUEST['type']=='orders')
{

	?>

<Заказы><?


// Выведем даты всех заказов за текущий месяц, отсортированные по дате заказа

$SQL="SELECT * FROM b_sale_order WHERE ID = 119829 ORDER BY DATE_INSERT ASC LIMIT 0,10000;";
$results0=$DB->Query($SQL);
while ($row0 = $results0->Fetch())
{

$ar_sales=CSaleOrder::GetByID($row0['ID']);



$s1c=0;



	// Смотрим чему равен статус, если 0 или пробелу то показываем данные, если же 1 то нет
if ($s1c<1)	{

// 	
if ($ar_sales[XML_ID]=='')
{
	// Обновить XML_ID

	$ar_sales[XML_ID]=md5('Заказ №'.$ar_sales['ID']);

	 $arFieldsU = array(
      "XML_ID" => md5('Заказ №'.$ar_sales['ID']),
   );
  // CSaleOrder::Update($ar_sales['ID'], $arFieldsU);

}

// Обновить статус выгрузки до 1 
   //$DB->Query('UPDATE b_sale_order SET STATUS_1C=1 WHERE ID='.$ar_sales['ID']);


$rsUser = CUser::GetByID($ar_sales[USER_ID]);
$arUser = $rsUser->Fetch();

if ($arUser[XML_ID]=='') {
	$arUser[XML_ID]=md5('Пользователь '.$ar_sales[USER_ID]);

$arFieldsU = array(
      "XML_ID" => md5('Пользователь '.$ar_sales[USER_ID]),
   );
  // CSaleOrder::Update($ar_sales[USER_ID], $arFieldsU);

}

$ch=explode(' ',$ar_sales[DATE_INSERT]);

echo "
	<Заказ> \r
	<ЗаказXMLID>".$ar_sales[XML_ID]."</ЗаказXMLID> \r
	<ЗаказНомер>".$ar_sales[ID]."</ЗаказНомер> \r
	
	<ЗаказДата>".$ar_sales[DATE_INSERT_FORMAT]." ".$ch[1]."</ЗаказДата> \r
	<Контрагент>".$arUser[XML_ID]."</Контрагент> \r
	</Заказ> \r\n ";



 }


}

 ?></Заказы>
 <?


}


if (($_REQUEST['type']=='orderbyid') && ($_REQUEST['xml_id']!='') )
{

$fi=fopen($_SERVER['DOCUMENT_ROOT'].'/bitrix/catalog_export/logGet.txt','a');
fwrite($fi,print_r($_SERVER,true));
fclose($fi);

?>
<Товары>
<?
// Запросить состав заказа
$ORDER_ID='';
// Запросить ORDER_ID по order_XML
$arFilter = Array(
   "XML_ID" => $_REQUEST['xml_id']
   );

$PRICE_DELIVERY=0;
$db_sales = CSaleOrder::GetList(array("DATE_INSERT" => "DESC"), $arFilter);
while ($ar_sales = $db_sales->Fetch())
{
	$ORDER_ID=$ar_sales[ID];
$PRICE_DELIVERY=$ar_sales[PRICE_DELIVERY];
}
//

if ($ORDER_ID>0) {

CModule::IncludeModule('catalog');
CModule::IncludeModule('iblock');


$dbBasketItems = CSaleBasket::GetList(
        array(
                "NAME" => "ASC",
                "ID" => "ASC"
            ),
        array(
                "LID" => SITE_ID,
                "ORDER_ID" => $ORDER_ID
            ),
        false,
        false,
        array("ID", "CALLBACK_FUNC", "MODULE",
              "PRODUCT_ID", "QUANTITY", "DELAY",
              "CAN_BUY", "PRICE", "WEIGHT")
    );
while ($arItems = $dbBasketItems->Fetch())
{

	/// Данные по товару

	$rpro=CIBlockElement::GetByID($arItems['PRODUCT_ID']);
	$arItem=$rpro->Fetch();

	/// NAME_PRODUCT_FOR_BOOKKEEPING Определяем свойство для товара

$arFilter=array('ID'=>$arItem['ID'],'IBLOCK_ID'=>$arItem['IBLOCK_ID']);

	$res = CIBlockElement::GetList(Array(), $arFilter, false, Array("nPageSize"=>1), $arSelect);
while($ob = $res->GetNextElement())
{
 $arFields = $ob->GetFields();



 // Обновляем
 // CIBlockElement::SetPropertyValues($arFields['ID'], $arFields['IBLOCK_ID'], 'Y', 'STATUS_1C');  // Меняю статус на выгружен

 ///




	$article="0000-0000"; // Пустой если не задан

	$resP = CIBlockElement::GetProperty( $arFields['IBLOCK_ID'],  $arFields['ID'], "sort", "asc", array("CODE" => "CML2_ARTICLE"));
    if ($obP = $resP->GetNext())
    {
		if ($obP['VALUE']!='') $article=$obP['VALUE'];
    }

		$resP = CIBlockElement::GetProperty( $arFields['IBLOCK_ID'],  $arFields['ID'], "sort", "asc", array("CODE" => "ARTICLE"));
    if ($obP = $resP->GetNext())
    {
		if ($obP['VALUE']!='') $article=$obP['VALUE'];
    }



	$resP = CIBlockElement::GetProperty( $arFields['IBLOCK_ID'],  $arFields['ID'], "sort", "asc", array("CODE" => "ITEM_CODE"));
    if ($obP = $resP->GetNext())
    {
		if ($obP['VALUE']!='') $codt=$obP['VALUE'];
		if ($obP['VALUE']=='') $codt=$arFields['ID'];
    }


$arFields['NAME']=$codt;

 $resP = CIBlockElement::GetProperty( $arFields['IBLOCK_ID'],  $arFields['ID'], "sort", "asc", array("CODE" => "NAME_PRODUCT_FOR_BOOKKEEPING"));
    if ($ob = $resP->GetNext())
    {
		if ($ob['VALUE']!='')  $arFields['NAME']=$ob['VALUE'];
    }


$ar_res = CPrice::GetBasePrice($arFields[ID], 1, 10);


$si=$arFields['IBLOCK_SECTION_ID'];
$paths=array();
$tpaths="";
$res2 = CIBlockSection::GetByID($si);
$ar_res2 = $res2->GetNext();
$paths[]=$ar_res2[NAME];

// Поиск разделов полный путь
while ($si>0) {

	$arFilter = Array('IBLOCK_ID'=>1, "ID"=>$si);
  $db_list = CIBlockSection::GetList(Array($by=>$order), $arFilter, true);
  while($ar_result = $db_list->GetNext())
  {
$si=$ar_result['IBLOCK_SECTION_ID'];

if ($si>0)
{
$res2 = CIBlockSection::GetByID($si);
$ar_res2 = $res2->GetNext();
$paths[]=$ar_res2[NAME];
} // условие si>-
  } // Перебор массивов
	$tpaths=implode('|',array_reverse($paths)); // Вывернуть на изнанку
} // $si>02




} //












	if ($article=='') $article='0000-0000';





$dd="<Товар>
<ТоварXMLID>".$arItem[XML_ID]."</ТоварXMLID>
<Наименование>".trim($arFields[NAME])."</Наименование>
<Родитель>".$tpaths."</Родитель>
<УникальныйКодТовар>".$codt."</УникальныйКодТовар>
<IDТовараНаСайте>".$arFields[ID]."</IDТовараНаСайте>
<Артикул>".$article."</Артикул>

<Цена>".$arItems[PRICE]."</Цена>
<Количество>".$arItems["QUANTITY"]."</Количество>
</Товар>";


$dd=str_replace('&','&amp;',$dd);

echo $dd;



}
?>


<? } ?>

<?
	if ($PRICE_DELIVERY>0) {


$dd="<Товар>
<Наименование>"."Доставка"."</Наименование>
<IDТовараНаСайте>"."DELIVERY"."</IDТовараНаСайте>
<Цена>".$PRICE_DELIVERY."</Цена>
<Количество>"."1"."</Количество>
</Товар>";

$dd=str_replace('&','&amp;',$dd);

echo $dd;

?>





	<? }




?>

</Товары>
<?
}








if (($_REQUEST['type']=='alls'))
{
?>
<Товары>
<?
// Запросить состав заказа
//

CModule::IncludeModule('catalog');
CModule::IncludeModule('sale');
CModule::IncludeModule('iblock');

$arSelect = Array("ID", "NAME", "DATE_ACTIVE_FROM","CATALOG_GROUP_1",'IBLOCK_SECTION_ID',"IBLOCK_ID","PROPERTY_ACTIVE","ACTIVE");
$arFilter = Array("IBLOCK_ID"=>1);

$dlogic=array(
        "LOGIC" => "OR",
        array("!PROPERTY_STATUS_1C" => "Y","!PROPERTY_NAME_PRODUCT_FOR_BOOKKEEPING"=>false),
        array("=PROPERTY_ACTIVE"=>'N'),
    );

$arFilter[]=$dlogic;   // Только товары со статус не выгружен
$active='N';
$res = CIBlockElement::GetList(Array(), $arFilter, false, Array("nPageSize"=>30000), $arSelect);
while($ob = $res->GetNextElement())
{
$active='N';
 $arFields = $ob->GetFields();

if ($arFields[ACTIVE]!='Y') $active='D';


if ($arFields['PROPERTY_ACTIVE_VALUE']=='N')
{
$active='D';
}



 // Обновляем
CIBlockElement::SetPropertyValues($arFields['ID'], $arFields['IBLOCK_ID'], 'Y', 'STATUS_1C');  // Меняю статус на выгружен

 ///

$nm=0;


 $resP = CIBlockElement::GetProperty( $arFields['IBLOCK_ID'],  $arFields['ID'], "sort", "asc", array("CODE" => "NAME_PRODUCT_FOR_BOOKKEEPING"));
    if ($ob = $resP->GetNext())
    {
		if ($ob['VALUE']!='')  {
 $arFields['NAME']=$ob['VALUE'];
$nm=10;
}
    }


	$article="0000-0000"; // Артикул пустой

	$resP = CIBlockElement::GetProperty( $arFields['IBLOCK_ID'],  $arFields['ID'], "sort", "asc", array("CODE" => "CML2_ARTICLE"));
    if ($obP = $resP->GetNext())
    {
		if ($obP['VALUE']!='') $article=$obP['VALUE'];
    }

		$resP = CIBlockElement::GetProperty( $arFields['IBLOCK_ID'],  $arFields['ID'], "sort", "asc", array("CODE" => "ARTICLE"));
    if ($obP = $resP->GetNext())
    {
		if ($obP['VALUE']!='') $article=$obP['VALUE'];
    }



	$resP = CIBlockElement::GetProperty( $arFields['IBLOCK_ID'],  $arFields['ID'], "sort", "asc", array("CODE" => "ITEM_CODE"));
    if ($obP = $resP->GetNext())
    {
		if ($obP['VALUE']!='') $codt=$obP['VALUE'];
    }

if ($nm==0)
{
// 
if ($codt!='') $arFields['NAME']=$codt;
if ($codt=='') $codt='0000-0000';
}

if ($active=='D')
{
if ($codt!='')  $arFields['NAME']=$codt;
if ($codt=='')  $arFields['NAME']=$arFields['ID'];
}


$ar_res = CPrice::GetBasePrice($arFields[ID], 1, 10);


$si=$arFields['IBLOCK_SECTION_ID'];
$paths=array();
$tpaths="";
$res2 = CIBlockSection::GetByID($si);
$ar_res2 = $res2->GetNext();
$paths[]=$ar_res2[NAME];

// Поиск разделов полный путь
while ($si>0) {

	$arFilter = Array('IBLOCK_ID'=>1, "ID"=>$si);
  $db_list = CIBlockSection::GetList(Array($by=>$order), $arFilter, true);
  while($ar_result = $db_list->GetNext())
  {
$si=$ar_result['IBLOCK_SECTION_ID'];

if ($si>0) {
	$res2 = CIBlockSection::GetByID($si);
$ar_res2 = $res2->GetNext();
$paths[]=$ar_res2[NAME];
}
  }
	$tpaths=implode('|',array_reverse($paths)); // Вывернуть на изнанку
}

if ($article=='') $article='0000-0000';

CIBlockElement::SetPropertyValues($arFields['ID'], $arFields['IBLOCK_ID'], '', 'ACTIVE');


$dd="<Товар>
<ТоварXMLID>".$arFields[XML_ID]."</ТоварXMLID>
<Наименование>".trim($arFields[NAME])."</Наименование>
<Родитель>".$tpaths."</Родитель>
<УникальныйКодТовар>".$codt."</УникальныйКодТовар>
<IDТовараНаСайте>".$arFields[ID]."</IDТовараНаСайте>
<Удаление>".$active."</Удаление>
<Цена>".$arFields[CATALOG_PRICE_1]."</Цена>
<Артикул>".$article."</Артикул>
<Количество>".$arFields["CATALOG_QUANTITY"]."</Количество>
</Товар>";

$dd=str_replace('&','&amp;',$dd);

echo $dd;

}
?>


</Товары>
<?
}











//} else { echo 'Не верный логин или пароль'; }

?>
