<? if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();

if(intval($arResult["ITEM"]["ID"]) > 0)
{
    $obReview = CIBlockElement::GetList(
        array(), 
        array(
            "IBLOCK_ID" => 28, 
            "ACTIVE" => "Y", 
            "PROPERTY_TOVAR" => $arResult['ITEM']['ID']
        ),
        false,
        false,
        array("PROPERTY_OCENKA")
    );
    $iCounterReviews = 0;
    $sumReiting = 0;
    while ($arrInfoResponse = $obReview->GetNext())
    {
        $iCounterReviews++;
        $sumReiting += $arrInfoResponse["PROPERTY_OCENKA_VALUE"];
    }
    if ($sumReiting && $iCounterReviews) 
    {
        $setReiting = round($sumReiting / $iCounterReviews, 2);
    }
    else
    {
        $setReiting = 0;
    }

    $arResult['ITEM']["RATING_PERCENT"] = ($setReiting*100)/5;     
}

/*if(!empty($arResult["ITEM"]['PROPERTIES']['ADD_PHOTOS']['VALUE']))
{
    $imgId = current($arResult["ITEM"]['PROPERTIES']['ADD_PHOTOS']['VALUE']);
    $arResult["ITEM"]['SECOND_PICTURE'] = CFile::ResizeImageGet($imgId, array("width" => 250, "height" => 90), BX_RESIZE_IMAGE_PROPORTIONAL, true);
} */
   
?>