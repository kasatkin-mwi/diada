<?
require_once($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");
// без этих двух строчек не отработает ajax
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Headers: Origin,Content-Type,Accept,X-Requested-With');
// принимаем значение из формы
$IDIfoblock = $_GET['IDIfoblock'];
$code = $_GET['codeAB'];
$title = $_GET['titleAB'];
$titleNogen .= "#NOGEN#".$title;
$description = $_GET['descriptionAB'];
$keywords = $_GET['keywordsAB'];

CModule::IncludeModule("iblock");
$bs = new CIBlockSection;

$arSelect = Array("ID", "IBLOCK_ID", "NAME", "DATE_ACTIVE_FROM", "IBLOCK_SECTION_ID", "CODE", "PROPERTY_*");
$arFilter = array("IBLOCK_ID"=>$IDIfoblock, "CODE" => $code);

$res = CIBlockSection::GetList(array(), $arFilter, false, array("nPageSize"=>1), $arSelect);
$section = $res->Fetch();
if($code){
	$sectionId = $section['ID'];
	$sectionName = $section['NAME'];
}
$arFields = array(
	"NAME" => $sectionName,
	"IPROPERTY_TEMPLATES" => array(
		"SECTION_META_TITLE" => $titleNogen,
		"SECTION_META_DESCRIPTION" => $description,
		"SECTION_META_KEYWORDS" => $keywords,
	)
);

echo $res = $bs->Update($sectionId, $arFields);
?>