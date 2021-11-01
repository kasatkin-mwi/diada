<?
if ($_SERVER['DOCUMENT_ROOT'] == "") {
    $_SERVER['DOCUMENT_ROOT'] = dirname(__FILE__).'/..';
}

require_once($_SERVER['DOCUMENT_ROOT'] . "/bitrix/modules/main/include/prolog_before.php");
$IBLOCK_ID = 1;

$Scheme = "<?xml version=\"1.0\" encoding=\"utf-8\"?>" . PHP_EOL;
$Scheme .= "<yml_catalog date='". date('d-m-Y H:i') ."'>".PHP_EOL;
$Scheme .= "\t<shop>" . PHP_EOL;
$Scheme .= "\t\t<offers>" . PHP_EOL;


$arFilter = Array("IBLOCK_ID"=> $IBLOCK_ID, "ACTIVE"=>"Y");
$res = CIBlockSection::GetList(Array("LEFT_MARGIN" => "ASC"), $arFilter, false, Array('ID', 'NAME', 'IBLOCK_SECTION_ID', 'SECTION_PAGE_URL', 'IBLOCK_ID', 'CODE', 'DESCRIPTION'));
while($arSection = $res->GetNext()){
	if ( !$arSection['IBLOCK_SECTION_ID'] ){
		$arSection['IBLOCK_SECTION_ID'] = 0;
	}
	
	$Scheme .= "\t\t\t<offer id=\"" . $arSection['ID'] . "\">". PHP_EOL;
		$Scheme .= "\t\t\t\t<parent>". $arSection['IBLOCK_SECTION_ID'] ."</parent>" . PHP_EOL;      
		$Scheme .= "\t\t\t\t<name>".  htmlspecialchars( $arSection['NAME'] ) ."</name>" . PHP_EOL;      
		$Scheme .= "\t\t\t\t<url>https://www.diada-arms.ru". $arSection['SECTION_PAGE_URL'] ."</url>" . PHP_EOL; 
		//if ( $arSection['DESCRIPTION'] )
		//	$Scheme .= "\t\t\t\t<description>". $arSection['DESCRIPTION'] ."</description>" . PHP_EOL; 
	
	$Scheme .= "\t\t\t</offer>" . PHP_EOL;
	
}
$Scheme .= "\t\t</offers>" . PHP_EOL;
$Scheme .= "\t</shop>" . PHP_EOL;
$Scheme .= "</yml_catalog>" . PHP_EOL;
echo $Scheme;

$file = $_SERVER["DOCUMENT_ROOT"]."/scripts/section_catalog.xml"; 
file_put_contents($file, $Scheme);