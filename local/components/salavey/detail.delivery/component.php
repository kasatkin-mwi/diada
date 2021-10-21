<?php
if(!defined("B_PROLOG_INCLUDED")||B_PROLOG_INCLUDED!==true)die();

Bitrix\Main\Loader::includeModule('sale');
Bitrix\Main\Loader::includeModule('catalog');
Bitrix\Main\Loader::includeModule("iblock");

$arParams['LOCATION_ID'] = intval($arParams['LOCATION_ID']);
$arParams['ELEMENT_ID'] = intval($arParams['ELEMENT_ID']);
/*if ($arParams['LOCATION_ID']) {
    $arStore = Array();
    $dbD = CSaleDelivery::GetList(Array("SORT" => "ASC"), Array("ACTIVE" => "Y", "LOCATION" => $arParams['LOCATION_ID']));
    while ($resD = $dbD->fetch()) {
        if ($resD['STORE']) {
            $arStore = array_unique(array_merge($arStore, unserialize($resD['STORE'])));
            foreach (unserialize($resD['STORE']) as $store)
                $arStorePrice[$store] = $resD['PRICE'];
        }
        if (preg_match("#Дост#i", $resD['NAME']))
            $arResult['DELIVERY']['DOST'][] = $resD;
        else
            $arResult['DELIVERY']['ZABR'][] = $resD;
    }
};*/
if ($arParams['ELEMENT_ID']){
	$dbStore = CCatalogStore::GetList(Array("SORT"=>"ASC"), Array("UF_LOCATION"=>$arParams['ELEMENT_ID'], "ISSUING_CENTER"=>"Y"),false,false,array("*","UF_*"));
	while($resStore = $dbStore->GetNext())
	{
		$resStore['PRICE'] = $arStorePrice[ $resStore['ID'] ];
		$arResult['STORE'][] = $resStore;
	}
	$objDeliv = CIBlockElement::GetByID($arParams['ELEMENT_ID'])->GetNextElement();
	$arResult["DELIVERY"] = array_merge($objDeliv->GetFields(),array("PROPS" => $objDeliv->GetProperties()));
}
$this->IncludeComponentTemplate();
?>