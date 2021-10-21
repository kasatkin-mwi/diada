<?
if(strstr($_SERVER['REQUEST_URI'], 'PAGEN_3='))
$APPLICATION->AddHeadString('<link href="https://www.'.SITE_SERVER_NAME.$arResult['DETAIL_PAGE_URL'].'" rel="canonical" />',true);

elseif($arResult['DETAIL_PAGE_URL']!=$_SERVER['REQUEST_URI'])
$APPLICATION->AddHeadString('<link href="https://www.'.SITE_SERVER_NAME.$arResult['DETAIL_PAGE_URL'].'" rel="canonical" />',true);


$dbReview = CIBlockElement::GetList(Array(), Array("IBLOCK_ID"=>28, "ACTIVE"=>"Y", "PROPERTY_TOVAR"=>$arResult["ID"]),false,false,array("PROPERTY_OCENKA"));
$countReviews = $dbReview->SelectedRowsCount();
$iCounterReviews = 0;
$sumReiting = 0;
while ($arrInfoResponse = $dbReview->GetNext()){
    $iCounterReviews++;
    $sumReiting += $arrInfoResponse["PROPERTY_OCENKA_VALUE"];
}
if ($sumReiting && $iCounterReviews) {
    $setReiting = round($sumReiting / $iCounterReviews,2);
}
else{
    $setReiting = 0;
}
$reitingPercent = ($setReiting*100)/5;
$addData= '<div style="width:'.$reitingPercent.'%;" class="new_reiting_cont"></div>';

//for($i=0; $i<$setReiting; $i++)
//    $addData .= "<img src='/img/min_orange_star.png'/>";

//for($j=$setReiting; $j<5; $j++)
//    $addData .= "<img src='/img/min_gray_star.png'/>";
?>
<script>
    console.log("count","<?=$templateData["RATING"]?>");
    $(document).ready(function ($) {
        $(".detail-element-raiting .new_reiting_bl").html('<?=$addData?>');
    })
</script>

