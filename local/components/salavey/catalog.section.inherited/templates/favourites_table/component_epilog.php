<?
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();
/*foreach ($templateData["LIST_ITEMS"] as $id){
        $dbReview = CIBlockElement::GetList(Array(), Array("IBLOCK_ID"=>28, "ACTIVE"=>"Y", "PROPERTY_TOVAR"=>$id),false,false,array("PROPERTY_OCENKA"));
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
        /*$addData= "";
        for($i=0; $i<$setReiting; $i++)
            $addData .= "<img src='/img/min_orange_star.png'/>";

        for($j=$setReiting; $j<5; $j++)
            $addData .= "<img src='/img/min_gray_star.png'/>";*//*
        
        $reitingPercent = ($setReiting*100)/5;
        $addData= '<div class="new_reiting_bl"><div style="width:'.$reitingPercent.'%;" class="new_reiting_cont"></div></div>';
        ?>
        <script>
            $(document).ready(function ($) {
                $(".set_reting_product_<?=$id?>").html('<?=$addData?>');
            })
        </script>
<?}*/

if (isset($_GET['AJAX_PAGE'])) {

    $content = ob_get_contents();
    ob_end_clean();

    $APPLICATION->RestartBuffer();

    list(, $content_html) = explode('<!--RestartBuffer-->', $content);

    echo $content_html;
    echo $addScript;
    die();
}
?>
