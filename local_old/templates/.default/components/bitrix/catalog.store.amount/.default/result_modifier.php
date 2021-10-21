<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
?>

<?
if(!empty($arParams["ELEMENT_ID"]))
{
    Bitrix\Main\Loader::includeModule("iblock");
    $arResult["SET_INFO"] = array();
    $arAllSetsProducts = array();
    $rsElement = CIBlockElement::GetList(
        array(), 
        array(
            "IBLOCK_ID" => 1,
            "ID" => $arParams["ELEMENT_ID"]
        ), 
        false, 
        false, 
        array()
    );
    while($obElement = $rsElement->GetNextElement())
    {
        $arElement = $obElement->GetFields();
        $arElement["PROPERTIES"] = $obElement->GetProperties(array(), array("ID" => array(4578,4579,4580)));
        $arResult["PRODUCT_NAME"] = $arElement["NAME"];
        foreach($arElement["PROPERTIES"]["SET_BASE"]["VALUE"] as $val)
        {
            $arResult["SET_INFO"]["SET_BASE"][$val] = array(
                "ID" => $val
            );
            $arAllSetsProducts[$val] = $val;
        }
        foreach($arElement["PROPERTIES"]["SET_MASTER"]["VALUE"] as $val)
        {
            $arResult["SET_INFO"]["SET_MASTER"][$val] = array(
                "ID" => $val
            );
            $arAllSetsProducts[$val] = $val;
        }
        foreach($arElement["PROPERTIES"]["SET_PROFI"]["VALUE"] as $val)
        {
            $arResult["SET_INFO"]["SET_PROFI"][$val] = array(
                "ID" => $val
            );
            $arAllSetsProducts[$val] = $val;
        }
    }
    
    if(!empty($arAllSetsProducts))
    {
        $rsElement = CIBlockElement::GetList(
            array(), 
            array(
                "IBLOCK_ID" => 1,
                "ID" => $arAllSetsProducts
            ), 
            false, 
            false, 
            array("ID","NAME")
        );
        while($obElement = $rsElement->GetNextElement())
        {
            $arElement = $obElement->GetFields();
            $arElement["STORES"] = array();
            $rsStore = CCatalogStoreProduct::GetList(array("SORT" => "asc"), array('PRODUCT_ID' => $arElement["ID"]), false, false, array('*'));
            while ($arStore = $rsStore->Fetch())
            {
                if(intval($arStore["AMOUNT"]) > 0 || $arStore["STORE_ID"] == 3 )
                {
                    $arElement["STORES"][] = $arStore;    
                }   
            }
            if(isset($arResult["SET_INFO"]["SET_BASE"][$arElement["ID"]]))
            {
                $arResult["SET_INFO"]["SET_BASE"][$arElement["ID"]] = $arElement;   
            }
            if(isset($arResult["SET_INFO"]["SET_MASTER"][$arElement["ID"]]))
            {
                $arResult["SET_INFO"]["SET_MASTER"][$arElement["ID"]] = $arElement;   
            }
            if(isset($arResult["SET_INFO"]["SET_PROFI"][$arElement["ID"]]))
            {
                $arResult["SET_INFO"]["SET_PROFI"][$arElement["ID"]] = $arElement;   
            } 
        }    
    }    
}
  
$arSores = array();
foreach($arResult["STORES"] as $store)
{ 
    if($store["ID"] == 3)
    {
        $arSores[] = $store;
        break;        
    }
}

foreach($arResult["STORES"] as $store)
{
    if($store["REAL_AMOUNT"] > 0 && $store["ID"] != 3)
    {
        $arSores[] = $store;
    }
}
$arResult["STORES"] = $arSores;
?>