<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();

global $USER;

$productsIds = array();
foreach($arResult["ITEMS"] as $key => &$arElement)
{
    $productsIds[] = $arElement['ID'];
}
unset($arElement);

$arAvailableGroups = array(1,12,16,20);
$arGroups = $USER->GetUserGroupArray();
$arResult['SHOW_INFO'] = false;
foreach($arAvailableGroups as $group)
{
    if(in_array($group,$arGroups))
    {
        $arResult['SHOW_INFO'] = true;
    }
}

if(!empty($productsIds) && $arResult['SHOW_INFO'])
{
    $arElementStores = array();
    $rsStore = CCatalogStore::GetList(
        array('SORT' => 'ASC'),
        array(
            'ACTIVE' => 'Y', 
            'PRODUCT_ID' => $productsIds
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
    
    foreach($arResult["ITEMS"] as $key => &$arElement)
    {
        if(!empty($arElementStores[$arElement['ID']]))
        {
           $arElement['STORES'] = $arElementStores[$arElement['ID']];    
        }   
    }
    unset($arElement, $arElementStores);
    
    foreach($arResult["ITEMS"] as $key => &$arElement)
    {
        $arSores = array();
        foreach($arElement["STORES"] as $store)
        { 
            if($store["ID"] == 3)
            {
                $arSores[] = $store;
                break;        
            }
        }

        foreach($arElement["STORES"] as $store)
        {
            if($store["PRODUCT_AMOUNT"] > 0 && $store["ID"] != 3)
            {
                $arSores[] = $store;
            }
        }
        $arElement["STORES"] = $arSores;
    }
    unset($arElement);
}