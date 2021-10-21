<?
require_once($_SERVER['DOCUMENT_ROOT'].'/bitrix/modules/main/include/prolog_before.php');

die;
set_time_limit(0);

global $DB;
global $USER;
$aa=21;
$mm=5;
$bb=2018;
?><?

CModule::IncludeModule('iblock');

/*$element = new CIBlockElement;

$obSection = CIBlockSection::GetList(
    array(), 
    array(
        'IBLOCK_ID' => 1,
        '!UF_SECTION_SLIDER' => false
    ), 
    false,
    array(
        'UF_SECTION_LINK',
        'UF_SECTION_SLIDER'
    ),
    false
);
while($arSection = $obSection->GetNext())
{
    foreach($arSection['UF_SECTION_SLIDER'] as $key => $slider_img)
    {
        $arFields = array(
            'IBLOCK_ID' => 34,
            'NAME' => $arSection['NAME'],
            'PREVIEW_PICTURE' => CFile::MakeFileArray(CFile::GetPath($slider_img)),
            'PROPERTY_VALUES' => array(
                'SECTIONS' => array($arSection['ID']),
                'URL' => $arSection['UF_SECTION_LINK'][$key]
            )
        );
        
        if(!empty($arFields))
        {
            $element->Add($arFields);
        }
    }
    
   // echo "<pre>"; echo '<br>'; var_export($arSection); echo '</pre>';   
}
die;  */
CModule::IncludeModule('sale');
	
	$conts=array();
	
$arFilter = Array(
   ">=DATE_INSERT" => date($DB->DateFormatToPHP(CSite::GetDateFormat("SHORT")), mktime(0, 0, 0, $mm, $aa, $bb))
   );
$i=0;
$db_sales = CSaleOrder::GetList(array("DATE_INSERT" => "DESC"), $arFilter);
while ($ar_sales = $db_sales->Fetch())
{
$i=$i+1;	
	
	
	
	$s1c=0;
	///////////	
$resultsM1=$DB->Query('SELECT STATUS_1C FROM b_sale_order WHERE ID='.$ar_sales['ID']);
while ($row = $resultsM1->Fetch())
{
if ($row['STATUS_1C']>0) $s1c=1;
}

}

echo $i;