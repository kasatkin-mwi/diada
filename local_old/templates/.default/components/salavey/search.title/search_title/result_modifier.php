<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();

//You may customize user card fields to display
$arResult['USER_PROPERTY'] = array(
	"UF_DEPARTMENT",
);

//Code below searches for appropriate icon for search index item.
//All filenames should be lowercase.

//1
//Check if index item is information block element with property DOC_TYPE set.
//This property should be type list and we'll take it's values XML_ID as parameter
//iblock_doc_type_<xml_id>.png

//2
//When no such fle found we'll check for section attributes
//iblock_section_<code>.png
//iblock_section_<id>.png
//iblock_section_<xml_id>.png

//3
//Next we'll try to detect icon by "extention".
//where extension is all a-z between dot and end of title
//iblock_type_<iblock type id>_<extension>.png

//4
//If we still failed. Try to match information block attributes.
//iblock_iblock_<code>.png
//iblock_iblock_<id>.png
//iblock_iblock_<xml_id>.png

//5
//If indexed item is section when checkj for
//iblock_section.png
//If it is an element when chek for
//iblock_element.png

//6
//If item belongs to main module (static file)
//when check is done by it's extention
//main_<extention>.png

//7
//For blog module we'll check if icon for post or user exists
//blog_post.png
//blog_user.png

//8, 9 and 10
//forum_message.png
//intranet_user.png
//socialnetwork_group.png

//11
//In case we still failed to find an icon
//<module_id>_default.png

//12
//default.png
$arResult["LIST_PRODUCT"] = array();
$arResult["LIST_CATEGOR"] = array();
foreach($arResult["CATEGORIES"][0]["ITEMS"] as $i => $arItem)
{
    if (strlen($arItem["ITEM_ID"])>0){
        if (intval($arItem["ITEM_ID"])>0){
            $arResult["LIST_PRODUCT"][$arItem["ITEM_ID"]] = array("NAME" => $arItem["NAME"], "LINK" => $arItem["URL"]);
        }
        elseif(substr($arItem["ITEM_ID"],0,1) == "S"){
            $sectionID = substr($arItem["ITEM_ID"],1);
            $infoThisSection = CIBlockSection::GetByID($sectionID)->GetNext();
            if ($infoThisSection["DEPTH_LEVEL"] > 1){
                $filterFindParent = array(
                    "IBLOCK_ID" => 1,
                    "<=LEFT_BORDER" => $infoThisSection["LEFT_MARGIN"]-1,
                    ">=RIGHT_BORDER" => $infoThisSection["RIGHT_MARGIN"]+1,
                    "DEPTH_LEVEL" => 1
                );
                $getParentSection = CIBlockSection::GetList(array(),$filterFindParent)->GetNext();
                $setName = $arItem["NAME"]." <span>[".$getParentSection["NAME"]."]</span>";
            }
            else{
                $setName = $arItem["NAME"];
            }
            $arResult["LIST_CATEGOR"][$sectionID] = array("NAME" => $setName, "LINK" => $arItem["URL"], "COUNTER" => 0);
        }
    }
}
foreach ($arResult["LIST_PRODUCT"] as $id=>$product){
    $resProductSect = CIBlockElement::GetElementGroups($id);
    while ($arr = $resProductSect->GetNext()){
        $arResult["LIST_SECT"][] = $arr["NAME"];
        if (key_exists($arr["ID"],$arResult["LIST_CATEGOR"])){
            $arResult["LIST_CATEGOR"][$arr["ID"]]["COUNTER"]++;
        }
        else{
            if ($arr["DEPTH_LEVEL"] > 1){
                $filterFindParent = array(
                    "IBLOCK_ID" => 1,
                    "<=LEFT_BORDER" => $arr["LEFT_MARGIN"]-1,
                    ">=RIGHT_BORDER" => $arr["RIGHT_MARGIN"]+1,
                    "DEPTH_LEVEL" => 1
                );
                $getParentSection = CIBlockSection::GetList(array(),$filterFindParent)->GetNext();
                $setName = $arr["NAME"]." <span>[".$getParentSection["NAME"]."]</span>";
            }
            else{
                $setName = $arr["NAME"];
            }
            $arResult["LIST_CATEGOR"][$arr["ID"]] = array("NAME" => $setName, "LINK" => $arr["SECTION_PAGE_URL"], "COUNTER" => 0);
        }
    }
}
foreach ($arResult["LIST_CATEGOR"] as $key => $row) {
    $counter[$key]  = $row['COUNTER'];
}
array_multisort($counter, SORT_DESC, $arResult["LIST_CATEGOR"]);
?>
