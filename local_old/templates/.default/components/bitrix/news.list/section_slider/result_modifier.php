<?
$res = CIBlockSection::GetByID($arParams["SECTION_ID"]);

// условие для того, чтобы слайдер заданный в родительском разделе так же мог выводиться и в дочерних
/*if($ar_res = $res->GetNext())
  //echo $ar_res['IBLOCK_SECTION_ID'];

if ($ar_res['IBLOCK_SECTION_ID']) {
		$arSect = CIBlockSection::GetList(array("SORT"=>"ASC"), array("IBLOCK_ID"=>1, "ID"=>$ar_res['IBLOCK_SECTION_ID']), false, array("ID", "CODE", "UF_SECTION_SLIDER"));
	}
else {
		
		$arSect = CIBlockSection::GetList(array("SORT"=>"ASC"), array("IBLOCK_ID"=>1, "ID"=>$arParams["SECTION_ID"]), false, array("ID", "CODE", "UF_SECTION_SLIDER"));
	}*/

$arSect = CIBlockSection::GetList(array("SORT"=>"ASC"), array("IBLOCK_ID"=>1, "ID"=>$arParams["SECTION_ID"]), false, array("ID", "CODE", "UF_SECTION_SLIDER", "UF_SECTION_LINK"));
while($arRes = $arSect->GetNext()) 
	{ 
		foreach ($arRes["UF_SECTION_SLIDER"] as $key => $pic) {
			$arResult["UF_SECTION_SLIDER"][] = CFile::GetPath($pic);
		}
		foreach ($arRes["UF_SECTION_LINK"] as $key => $sec) {
			$arResult["UF_SECTION_LINK"][] = $sec;
		}
	}
?>