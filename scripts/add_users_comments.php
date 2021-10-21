<?require_once($_SERVER['DOCUMENT_ROOT'] . "/bitrix/modules/main/include/prolog_before.php");
\Bitrix\Main\Loader::includeModule("iblock");
$fileResponseProduct = file_get_contents("files/about_product.xml");
$fileResponseSite = file_get_contents("files/about_site.xml");
$xmlProduct = new SimpleXMLElement($fileResponseProduct);
$xmlSite = new SimpleXMLElement($fileResponseSite);
$listCommentProduct = $listCommentSite = $listUsersProduct = array();
foreach ($xmlProduct->Worksheet[0]->Table->Row as $valRow){
    $listCommentProduct[] = (string)$valRow->Cell[0]->Data;
}
foreach ($xmlSite->Worksheet[0]->Table->Row as $valRow){
    $listCommentSite[] = (string)$valRow->Cell[0]->Data;
}
foreach ($xmlProduct->Worksheet[1]->Table->Row as $valRow){
    $listUsersProduct[] = (string)$valRow->Cell[0]->Data;
}
foreach ($xmlSite->Worksheet[1]->Table->Row as $valRow){
    $listUsersProduct[] = (string)$valRow->Cell[0]->Data;
}
$listUsersTable =  array_unique($listUsersProduct);
$listCommentProduct = array_values(array_diff($listCommentProduct,array("")));
$listCommentSite = array_values(array_diff($listCommentSite,array("")));
$listUsersTable = array_values(array_diff($listUsersTable,array("")));
function GetCommentUsers($count,$listComments, $existComments = array()){
    $listComment = $returnListComments = array();
    while ((count($listComment)<$count) && count($listComments)>$count){
        $randomNumber = mt_rand(0,count($listComments)-1);
        if (!in_array($randomNumber,$listComment) && !in_array($randomNumber,$existComments)){
            $listComment[] = $randomNumber;
        }
    }
    foreach ($listComment as $number){
        $returnListComments[] = $listComments[$number];
    }
    return $returnListComments;
}

$arAllComments = array();
$arAllCommentsInfo = array();
$objElement = new CIBlockElement;
$resProductDiada = CIBlockElement::GetList(array("ID" => "ASC"),array("IBLOCK_ID" => 1, /*"SECTION_ID" => 1061,*/ "INCLUDE_SUBSECTIONS" => "Y", "ACTIVE" => "Y"),false,false,array("ID"));
$obComments = CIBlockElement::GetList(
    array("ID" => "ASC"),
    array(
        "IBLOCK_ID" => 28, 
        "!PROPERTY_TOVAR" => false, 
        "ACTIVE" => "Y"
    ),
    false,
    false,
    array("ID", "NAME", "PREVIEW_TEXT", "IBLOCK_ID", "DATE_CREATE")
);
while($rsComments = $obComments -> GetNextElement())
{
    $arComments = $rsComments->GetFields();
    $arComments["PROPERTIES"] = $rsComments->GetProperties();
    
    $arAllCommentsInfo[$arComments["PROPERTIES"]["TOVAR"]["VALUE"]][] = array(
        "NAME" => $arComments["NAME"],
        "PREVIEW_TEXT" => $arComments["PREVIEW_TEXT"],
        "DATE_CREATE" => $arComments["DATE_CREATE"],
    );
    $arAllComments[$arComments["PROPERTIES"]["TOVAR"]["VALUE"]][] = $arComments["PREVIEW_TEXT"];
    unset($arComments);
}
unset($obComments,$rsComments);
//echo "<pre>";echo "<br>"; var_export($arAllComments); echo "</pre>"; die;
$listErrors = array();
while ($product = $resProductDiada->GetNext()){
    $listBal = array(4,5,5,5,5,4,5,5,5,5);
    //$countComment = mt_rand(3,6);
    $countComment = mt_rand(5,8);
    $countCommentSite = round($countComment*0.33);
    $countCommentProduct = $countComment-$countCommentSite;
    $listTextCommentSite = GetCommentUsers($countCommentSite,$listCommentSite,$arAllComments[$product["ID"]]); 
	$listTextCommentProduct = GetCommentUsers($countCommentProduct,$listCommentProduct,$arAllComments[$product["ID"]]);
	$listTextUsers = GetCommentUsers($countComment,$listUsersTable);
    for ($comment=0; $comment<$countComment; $comment++){
        if ($countCommentSite && $countCommentProduct){
            $boolSiteOrProduct = mt_rand(0,1);
            if ($boolSiteOrProduct){
                $setTextComment = array_pop($listTextCommentSite);
                $setUser = array_pop($listTextUsers);
                $countCommentSite--;
            }
            else{
                $setTextComment = array_pop($listTextCommentProduct);
                $setUser = array_pop($listTextUsers);
                $countCommentProduct--;
            }
        }
        else{
            if ($countCommentSite>0){
                $setTextComment = array_pop($listTextCommentSite);
                $setUser = array_pop($listTextUsers);
                $countCommentSite--;
            }
            if ($countCommentProduct>0){
                $setTextComment = array_pop($listTextCommentProduct);
                $setUser = array_pop($listTextUsers);
                $countCommentProduct--;
            }
        }
        if ($listBal[mt_rand(0,9)] == 4){
            $setBal = 907;
        }
        else{
            $setBal = 908;
        }

        $arFilds = array(
            "NAME" => $setUser,
            "IBLOCK_ID" => 28,
            "ACTIVE" => "Y",
            "PREVIEW_TEXT" => $setTextComment,
            "PROPERTY_VALUES" => array(
                4951 => $setBal,
                4952 => $product["ID"],
            )

        );
        if (!$objElement->Add($arFilds)){
            $listErrors[] = $objElement->LAST_ERROR;
        }
    }
}
?>