<?

require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");
CModule::IncludeModule("iblock");
CModule::IncludeModule("catalog");

header('Content-Type: application/json');

$filePath 	= ($_SERVER['HTTPS']) ? 'https' : 'http';
$IBLOCK_ID 	= '1';
$userGroup 	= [2];
$quantity 	= 1;
$renewal 	= 'N';
$arResult 	= [];

$res = CIBlockElement::GetList (
	Array("ID" => "ASC"),
	Array("IBLOCK_ID" => $IBLOCK_ID, "ACTIVE" => "Y"),
	false,
	false,
	Array('ID', 'NAME', 'DETAIL_PICTURE', 'PREVIEW_TEXT', 'DETAIL_TEXT', 'IBLOCK_SECTION_ID')
);
while ($arItem = $res->GetNext()) {
	// category
	$category = '';
	$resSection = CIBlockSection::GetByID($arItem['IBLOCK_SECTION_ID']);
	if ($ar_res = $resSection->GetNext()) {
		$category = $ar_res['NAME'];
	}

	// price
	$productID = $arItem['ID'];
	$arPrice = CCatalogProduct::GetOptimalPrice(
		$productID,
		$quantity,
		$userGroup,
		$renewal
	);

	$item['id'] 			= $arItem['ID'];
	$item['name'] 			= trim($arItem['NAME']);
	$item['jpg_url'] 		= $filePath.'://'.$_SERVER['SERVER_NAME'].CFile::GetPath($arItem['DETAIL_PICTURE']);
	$item['description'] 		= ($arItem['DETAIL_TEXT']) ? $arItem['DETAIL_TEXT'] : $arItem['PREVIEW_TEXT'];
	//$item['weight'] 		= "200/40ã.";
	$item['categories'] 		= $category;
	$item['categories_id'] 		= $arItem['IBLOCK_SECTION_ID'];
	$item['nominal'] 		= $arPrice['RESULT_PRICE']['DISCOUNT_PRICE'];
	$item['discount'] 		= $arPrice['RESULT_PRICE']['DISCOUNT'];

	$arResult[] = $item;
}

echo '<pre>';
print_r($arResult);
echo '</pre>';

//echo json_encode($arResult);

/*
$arFilter = array('IBLOCK_ID' => $IBLOCK_ID, 'ACTIVE' => 'Y'); 
$arSelect = array('ID', 'NAME');
$rsSection = CIBlockSection::GetTreeList($arFilter, $arSelect); 
while($arSection = $rsSection->Fetch()) {
   echo $arSection['ID'].' - '.$arSection['NAME'].'<br>';
}
*/

/*$tree = CIBlockSection::GetTreeList(
    $arFilter=Array('IBLOCK_ID' => $iblock['ID']),
    $arSelect=Array()
);
while($section = $tree->GetNext()) {
	echo ' - '.$section['NAME'].'<br>';
}*/

/*foreach ($arResult['ITEMS'] as $key => $arItem) {
    $arSectionList = array();
    $rsSections = CIBlockElement::GetElementGroups($arItem['ID']);
    while ($arSection = $rsSections->Fetch())
    {
        $arSectionList[] = array(
                'ID' => $arSection['ID'],
                'NAME' => $arSection['NAME'],
            );
        $arResult['ITEMS_BY_GROUP'][$arSection['ID']][] = $key;
echo $arSection['ID'].' - '.$arSection['NAME'].'<br>';

    }
    $arItem['SECTION_NAME'] = $arSectionList;
    $arResult['ITEMS'][$key] = $arItem;

}
*/
?>