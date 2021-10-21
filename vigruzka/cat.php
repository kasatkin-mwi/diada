<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");

$yvalue = 1;

$arFilter = array(
    "IBLOCK_ID" => 1,
    "ACTIVE" => "Y",
);

$arSelect = array(
    'SECTION_PAGE_URL',
    'NAME',
    'DESCRIPTION'
);

$db_list = CIBlockSection::GetList($arOrder, $arFilter, false, $arSelect, false);

?>

<table class="boxer price_table">
	<tr class="thead">
 		<td class="box price_th">Наименование</td>
		<td class="box price_th">URL</td>
		<td class="box price_th">Текст</td>
	</tr>
	
<?

while($db_section = $db_list->GetNext()){

 ?>
    <?if($db_section['DESCRIPTION'] == ''):?>
 	<tr class="box-row price_row">
 		<td class="box price_first_col"><?=$db_section['NAME']?></td>
		<td class="box price_secnd_col"><a href="<?=$db_section['SECTION_PAGE_URL']?>"><?=$db_section['SECTION_PAGE_URL']?></a></td>
		<td class="box price_secnd1_col"><?=$db_section['DESCRIPTION']?></td>
	</tr>
    <?endif;?>
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
//$navStr = $res->GetPageNavStringEx($navComponentObject, "Страницы:", ".default");

//echo $navStr;
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
