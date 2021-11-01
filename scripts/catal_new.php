<?

require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");
/* ================================ */
/* ÏÎËÍÛÉ ÑÏÈÑÎÊ ÏÎÄÐÀÇÄÅËÎÂ ÓÊÀÇÀÍÍÎÃÎ ÐÀÇÄÅËÀ */
/* ================================ */
/* 

IBLOCK_ID - id èíôîáëîêà
SECTION_ID - id ðàçäåëà ðîäèòåëÿ

*/
$rsParentSection = CIBlockSection::GetList(
	Array('name' => 'asc'),
	Array('IBLOCK_ID' => 1, 'SECTION_ID' => 0, 'ACTIVE' => 'Y')
);

while ($arParentSection = $rsParentSection->GetNext()) {

    $arrFullListSection[] = $arParentSection["SECTION_PAGE_URL"];
    echo '<br>'.$arParentSection["ID"].' - '.$arParentSection["NAME"].' - '.$arParentSection["SECTION_PAGE_URL"];

	$arFilter = array(
        'IBLOCK_ID' => $arParentSection['IBLOCK_ID'],
        '>LEFT_MARGIN' => $arParentSection['LEFT_MARGIN'],
        '<RIGHT_MARGIN' => $arParentSection['RIGHT_MARGIN'],
        '>DEPTH_LEVEL' => $arParentSection['DEPTH_LEVEL']
    );

    /* äåëàåì çàïðîñ âíóòðè çàïðîñà ïî id ïîäðàçäåëà */
	$rsSect = CIBlockSection::GetList(array('left_margin' => 'asc'), $arFilter);

	while ($arSect = $rsSect->GetNext()){
        $arrFullListSection[] = $arSect["SECTION_PAGE_URL"];
    echo '<br>'.$arSect["ID"].' - '.$arSect["NAME"].' - '.$arSect["SECTION_PAGE_URL"];
	}
}


foreach($arrFullListSection as $section) {
    $strListSection .= $section."\n";

}

/* ================================ */
/* ================================ */?>