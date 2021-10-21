<? if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();

if(intval($arResult["ITEM"]["ID"]) > 0)
{
    $obReview = CIBlockElement::GetList(
        array(), 
        array(
            "IBLOCK_ID" => FCbit\Conf::FCbit_PRODUCT_REVIEWS_IBLOCK_ID,
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
if(!empty($arResult["ITEM"]['PROPERTIES']['ADD_PHOTOS']['VALUE']))
{
    $imgId = current($arResult["ITEM"]['PROPERTIES']['ADD_PHOTOS']['VALUE']);
    $arResult["ITEM"]['SECOND_PICTURE'] = CFile::ResizeImageGet($imgId, array("width" => 250, "height" => 90), BX_RESIZE_IMAGE_PROPORTIONAL, true);
}

$arAvailableGroups = array(1,12,16);
$arGroups = $USER->GetUserGroupArray();
if(intval($arResult["ITEM"]["ID"]) > 0)
{
    $arResult["ITEM"]['SHOW_INFO'] = false;
    foreach($arAvailableGroups as $group)
    {
        if(in_array($group,$arGroups))
        {
            $arResult["ITEM"]['SHOW_INFO'] = true;
        }
    }

    if($arResult["ITEM"]['SHOW_INFO'])
    {
        $arElementStores = array();
        $rsStore = CCatalogStore::GetList(
            array('SORT' => 'ASC'),
            array(
                'ACTIVE' => 'Y', 
                'PRODUCT_ID' => array($arResult["ITEM"]['ID'])
            ),
            false,
            false,
            array("ID","TITLE","ACTIVE","PRODUCT_AMOUNT","ELEMENT_ID")
        );
        while ($arStore = $rsStore->Fetch())
        {
            if(intval($arStore['ELEMENT_ID']) > 0)
            {
                $arElementStores[$arStore['ELEMENT_ID']][] = $arStore;
            }
        }
        unset($arStore, $rsStore);    
        
        if(!empty($arElementStores[$arResult["ITEM"]['ID']]))
        {
           $arResult["ITEM"]['STORES'] = $arElementStores[$arResult["ITEM"]['ID']];    
        }   
        unset($arElementStores);

        $arSores = array();
        foreach($arResult["ITEM"]["STORES"] as $store)
        { 
            if($store["ID"] == 3)
            {
                $arSores[] = $store;
                break;        
            }
        }

        foreach($arResult["ITEM"]["STORES"] as $store)
        {
            if($store["PRODUCT_AMOUNT"] > 0 && $store["ID"] != 3)
            {
                $arSores[] = $store;
            }
        }
        $arResult["ITEM"]["STORES"] = $arSores;
    }
}    
?>