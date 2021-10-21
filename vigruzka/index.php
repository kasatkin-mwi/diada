<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");

$yvalue = 1;

$arSelect = Array("ID", "NAME", "DETAIL_PAGE_URL", "DETAIL_TEXT");
$arFilter = Array("IBLOCK_ID"=>IntVal($yvalue), "ACTIVE"=>"Y", "DETAIL_TEXT" => FALSE);

$res = CIBlockElement::GetList(Array(), $arFilter, false, Array("nPageSize"=>1000,"iNumPage"=>$_GET['PAGEN_1']), $arSelect);

?>

<table class="boxer price_table">
	<tr class="thead">
 		<td class="box price_th">Наименование</td>
		<td class="box price_th">URL</td>
		<td class="box price_th">Текст</td>
	</tr>
	
<?

while($ob = $res->GetNextElement())
{
 $arFields = $ob->GetFields();
/* echo '<hr><pre>';
 print_r($arFields);
 echo '</pre>';*/
 ?>
 	<tr class="box-row price_row">
 		<td class="box price_first_col"><?=$arFields['NAME']?></td>
		<td class="box price_secnd_col"><a href="<?=$arFields['DETAIL_PAGE_URL']?>"><?=$arFields['DETAIL_PAGE_URL']?></a></td>
		<td class="box price_secnd1_col"><?=$arFields['DETAIL_TEXT']?></td>
	</tr>
 <?
}
?>

</table>
<br>


<?
//Получаем строку с постраницной навигацией
//$navComponentObject – объект компонента навигации
//Второй параметр (Страницы:) – заголовок навигации
//Третий параметр – шаблон компонента system.pagenavigation
$navStr = $res->GetPageNavStringEx($navComponentObject, "Страницы:", ".default");

echo $navStr;
?>
<style type="text/css">
	.box { display: block; }
td, th {
    display: table-cell !important;
    vertical-align: inherit !important;
    border: 1px solid gray !important;
    border-collapse: separate !important;
    padding: 5px;
}
tr {
    display: table-row !important;
    vertical-align: inherit !important;
    border-color: inherit !important;
}
table {
    display: table !important;
    border-collapse: separate !important;
    border-spacing: 2px !important;
    border-color: grey !important;
}
td.box.price_secnd_col {
    font-size: 12px;
}
.left_column 
{
	display: none;
}
.left_column + .center_column
{
	width: 100%!important;
	float: none !important;
}
</style>





<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>
