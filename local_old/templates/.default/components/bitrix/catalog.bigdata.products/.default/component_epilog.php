<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();
/** @var array $templateData */
/** @var @global CMain $APPLICATION */
global $APPLICATION;

foreach ($templateData["LIST_ITEMS"] as $id)
{
        $dbReview = CIBlockElement::GetList(Array(), Array("IBLOCK_ID"=>28, "ACTIVE"=>"Y", "PROPERTY_TOVAR"=>$id),false,false,array("PROPERTY_OCENKA"));
        $countReviews = $dbReview->SelectedRowsCount();
        $iCounterReviews = 0;
        $sumReiting = 0;
        while ($arrInfoResponse = $dbReview->GetNext()){
            $iCounterReviews++;
            $sumReiting += $arrInfoResponse["PROPERTY_OCENKA_VALUE"];
        }
        if ($sumReiting && $iCounterReviews) {
            $setReiting = round($sumReiting / $iCounterReviews);
        }
        else{
            $setReiting = 0;
        }
        $addData= "";
        for($i=0; $i<$setReiting; $i++)
            $addData .= "<img src='/img/min_orange_star.png'/>";

        for($j=$setReiting; $j<5; $j++)
            $addData .= "<img src='/img/min_gray_star.png'/>";
        ?>
        <?
        $addScript .='<script>$(document).ready(function ($) {$(".set_reting_product_'.$id.'").html("'.$addData.'");})</script>';
        echo $addScript;
    ?>
<?}
if (isset($templateData['TEMPLATE_THEME']))
{
	$APPLICATION->SetAdditionalCSS($templateData['TEMPLATE_THEME']);
}
CJSCore::Init(array("popup"));
?>