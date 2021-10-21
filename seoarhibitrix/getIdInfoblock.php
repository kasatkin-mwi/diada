<?
require_once($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");
//без этих двух строчек не отработает ajax
header('content-type: text/html; charset=utf-8');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Headers: Origin,Content-Type,Accept,X-Requested-With');
// принимаем значение из формы
$IDIfoblock = $_POST['IDIfoblock'];
$code = trim($_POST['codeAB'], " ");
$title = $_POST['titleAB'];
$titleNogen .= "#NOGEN#".$title;
$description = $_POST['descriptionAB'];
$keywords = $_POST['keywordsAB'];

// $arrUrl = explode("\n", $code);

// print_r($arrUrl); die();
CModule::IncludeModule("iblock");

$url = $code;
$url = "https://www.diada-arms.ru/catalog/aksessuary/moderatory/mod-t-34-ataman/";

print_r(elementOrSection("mod-t-34-ataman", "/catalog/aksessuary/moderatory/mod-t-34-ataman/"));

die();

// разбиваем строку по пробелам
$arrUrl = splitLineTransfer($url);
$arrTitle = splitLineTransfer($title);
$arrDescription = splitLineTransfer($description);
//удаляем ключи с пустыми значениями и лишние пробелы
$arrUrl = deleteEmpty($arrUrl);
// url после доменного имени
// $urlAfterDomen = parse_url($url, PHP_URL_PATH);

// формирует массив url после доменного имени
$arrUrlAfterDomen = arrUrlAfterDomen($arrUrl);

// формируем массив символьных кодов
foreach ($arrUrlAfterDomen as $key => $value) {
	$arrCode[] = extractCharacterCode($value);
}

// формируем массив id элементов
for ($i=0; $i < count($arrCode); $i++) {
	// удаляем слеш если есть из url после доменного имени
	$UrlAfterDomen = deleteSlashEndStr($arrUrlAfterDomen[$i]);
	$arId[] = elementOrSection($arrCode[$i], $UrlAfterDomen);
}
echo "<pre>";
print_r($arId);
print_r($arrTitle);
print_r($arrDescription);
print_r($arrUrlAfterDomen);
print_r($arrCode);
die();

exit(elementOrSection($code, $urlAfterDomen));

// извлекаем из URL символьный код
function extractCharacterCode($url){
	// получаем url после домена
	$url = parse_url($url, PHP_URL_PATH);
	// если есть слэш до удаляем его
	if(substr($url, -1)=='/'){
   		$url = substr($url,0,-1);
	}
	// разбиваем строку по "/"
	$smashUrl = explode("/",$url);
	// через цикл удаляем ключи с пустыми значениями
	foreach ($smashUrl as $key => $value) {
		if(!empty($value))
			$result[] = $value;
	}
	// считаем колличество полученных элементов
	$cnt = count($result);
	// вычитаем 1 и получаем последний элемент между слешами из url
	$result = $result[$cnt - 1];
	// если url имеет (.html || .php) то убираем его и оставляем, только символьный код
	if (strpos($result, ".") !== false) {
    	$result = mb_strstr($result,".",true);
	}
	return $result;
}

// по символьному коду получаем все элементы или разделы, или элементы и разделы.
// потом в цикле пробегаемся по всем элементам и разделам, до тех пор пока не найдёт элемент, либо раздел с нужным URL
// функция возвращает id нужного элемента либо раздела
function elementOrSection($code, $url){
	$idElement = array();
	$idSection = array();
	$result = array('element');
	// получаем все элементы с текущим символьным кодом
	$element = CIBlockElement::GetList(array(), array('=CODE' => $code), false, array(), array());
	// получаем все разделы с текущем символьным кодом
	$section = CIBlockSection::GetList(array(), array('=CODE' => $code), false, array(), array());
	if($element->result->num_rows >=1){
		while($ob = $element->GetNextElement()){
			$arFields = $ob->GetFields();
			if($url == $arFields['DETAIL_PAGE_URL'])
				return $arFields['ID'];
		}
	}

	if (!empty($section->arResult)) {
		while($ob = $section->GetNextElement()){
		$arFields = $ob->GetFields();
		if($url == $arFields['SECTION_PAGE_URL'])
			return $arFields['ID'];
		}
	}
}

// разбивает строку по переносу строки
function splitLineTransfer($data){
	return $result = explode("\n", $data);
}

// формирует массив url после доменного имени
function arrUrlAfterDomen($arrUrl){
	foreach ($arrUrl as $key => $value) {
		$arrUrlAfterDomen[] = parse_url($value, PHP_URL_PATH);
	}
	return $arrUrlAfterDomen;
}

// удаляет последний слэш если есть
function deleteSlashEndStr($urlAfterDomen){
	if(substr($urlAfterDomen, -1)=='/'){
	    return $urlAfterDomen = substr($urlAfterDomen,0,-1);
	}else{
		return $urlAfterDomen;
	}
}


//функция удаляет ключи с пустыми значениями и лишние пробелы
function deleteEmpty($data){
	foreach ($data as $key => $value) {
		if(!empty($value))
			$result[] = trim($value);
	}
	return $result;
}