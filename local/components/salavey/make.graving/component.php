<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();
if (!$arParams['IBLOCK_ID']) return;
if(!CModule::IncludeModule("iblock")) return;
if(!CModule::IncludeModule("sale")) return;
$arParams['ID'] = intval($arParams['ID']);
$arGoodsForGraving = array();
if($arParams['ID']) //вызов из карточки товара
{
	//получаем первого родителя, чтобы узнать его свойство "Можно ли гравировать"
	$rsParent = CIBlockElement::GetList(array(),array("IBLOCK_ID"=>1,"ID"=>$arParams['ID']),false,false,
		array("ID","IBLOCK_SECTION_ID","DEPTH_LEVEL","DETAIL_PAGE_URL","NAME","PREVIEW_PICTURE"));

	if($arParent = $rsParent->GetNext())
		$arGoodsForGraving[$arParent['ID']] = array(
			"ID" => $arParent['ID'],
			"DETAIL_PAGE_URL" => $arParent['DETAIL_PAGE_URL'],
			"NAME" => $arParent['NAME'],
			"PREVIEW_PICTURE" => $arParent['PREVIEW_PICTURE']
		);

	$rsNearestSectionParent = CIBlockSection::GetList(array(),array("IBLOCK_ID"=>1,"ID"=>$arParent['IBLOCK_SECTION_ID']),false,array("ID","IBLOCK_SECTION_ID","LEFT_MARGIN","RIGHT_MARGIN"));
	$arNearestSectionParents = array();
	while($arNearestSectionParent = $rsNearestSectionParent->GetNext()) {
		$dbSect = CIBlockSection::GetList(Array("LEFT_MARGIN"=>"ASC"),array("IBLOCK_ID"=>1,
		"<=LEFT_BORDER" => $arNearestSectionParent["LEFT_MARGIN"],
		">=RIGHT_BORDER" => $arNearestSectionParent["RIGHT_MARGIN"],
		"DEPTH_LEVEL" => 1),false,array("ID","UF_HAS_ENGRAVING"));
		if($arSect = $dbSect->GetNext())
			$arGoodsForGraving[$arParent['ID']]["HAS_ENGRAVING"] = $arSect["UF_HAS_ENGRAVING"];
	}
	//Проверяем, есть ли товар в корзине
	$rsIsInBasket = CSaleBasket::GetList(
		array("ID" => "ASC"),
		array("FUSER_ID" => CSaleBasket::GetBasketUserID(),
			"LID" => SITE_ID, "PRODUCT_ID" => $arParams['ID'],"ORDER_ID" => "NULL"));
	if($arIsInBasket=$rsIsInBasket->GetNext())
		$arGoodsForGraving[$arParent['ID']]['IS_IN_BASKET'] = 1;
	else
		$arGoodsForGraving[$arParent['ID']]['IS_IN_BASKET'] = 0;
	//$arResult['CALL_FROM_CARD'] = "Y"; //вызов из карточки товара
}
else //бежим по корзине
{
	//получаем все товары из корзины
	$rsBaskets = CSaleBasket::GetList(
		array("ID" => "ASC"),
		array("FUSER_ID" => CSaleBasket::GetBasketUserID(), "LID" => SITE_ID, "ORDER_ID" => "NULL"),
		false,false,array("ID", "NAME", "PRODUCT_ID","DETAIL_PAGE_URL"));
	while ($arItem = $rsBaskets->GetNext())
	{
	//получаем значения свойства раздела гравировка есть/нет
		$arGoodsID = $arItem["PRODUCT_ID"];
		$rsNearestParent = CIBlockElement::GetList(array(),array("IBLOCK_ID"=>1,"ID"=>$arGoodsID),false,false,array("ID","IBLOCK_SECTION_ID","DEPTH_LEVEL","PREVIEW_PICTURE","NAME"));
		$arNearestParentsID = array();
		while($arNearestParent = $rsNearestParent->GetNext())
		{
			$previewPicture = $arNearestParent['PREVIEW_PICTURE'];
			$arNearestParentsID[] = $arNearestParent['IBLOCK_SECTION_ID'];
			$nameProduct = $arNearestParent['NAME'] ;
		}
		$rsNearestSectionParent = CIBlockSection::GetList(array(),array("IBLOCK_ID"=>1,"ID"=>$arNearestParentsID),false,array("ID","IBLOCK_SECTION_ID","LEFT_MARGIN","RIGHT_MARGIN"));
		$arNearestSectionParents = array();
		while($arNearestSectionParent = $rsNearestSectionParent->GetNext())
		{
			$dbSect = CIBlockSection::GetList(Array("SORT"=>"ASC"),array("IBLOCK_ID"=>1, "<=LEFT_BORDER" => $arNearestSectionParent["LEFT_MARGIN"], ">=RIGHT_BORDER" => $arNearestSectionParent["RIGHT_MARGIN"], "DEPTH_LEVEL" => 1),false,array("ID","UF_HAS_ENGRAVING"));
			if($arSect = $dbSect->GetNext())
			{
				if($arSect["UF_HAS_ENGRAVING"]) $arGoodsForGraving[$arItem['PRODUCT_ID']] = array(
					"ID" => $arItem['PRODUCT_ID'],
					"DETAIL_PAGE_URL" => $arItem['DETAIL_PAGE_URL'],
					"PREVIEW_PICTURE" => $previewPicture,
					"NAME" => $nameProduct,
					"IS_IN_BASKET" => 1,
					"HAS_ENGRAVING" => 1
				);
			}
		}
	}
	//$arResult['CALL_FROM_CARD'] = "N"; //вызов из корзины
}

//Получаем ID раздела с кодом gravirovka
$rsGravingSection = CIBlockSection::GetList(array(),array("IBLOCK_ID"=>1,"CODE"=>"gravirovka"),false,"ID");
$arGravingSection = $rsGravingSection->GetNext();
//Получаем размер гравировки
$arGravingSizesID = array();
$arGravingSizes = array();
$rsGravingSizes = CIBlockSection::GetList(array("SORT"=>"ASC"),array("IBLOCK_ID"=>1,"SECTION_ID"=>$arGravingSection['ID'],false,array("ID","NAME")));
while($arGravingSize= $rsGravingSizes->GetNext())
{
	$arGravingSizesID[] = $arGravingSize['ID'];
	$arGravingSizes[$arGravingSize['ID']] = $arGravingSize['NAME'];
}
$arResult["GRAVING_SIZES"] = $arGravingSizes;
//Получаем цвета гравировки для каждого размера гравировки
$arGravingColors = array();
$arFilter = array("IBLOCK_ID"=>1,"SECTION_ID" => $arGravingSizesID);
$arSelect = array("ID","DETAIL_PAGE_URL","PREVIEW_PICTURE","NAME","IBLOCK_SECTION_ID","SECTION_ID","CATALOG_GROUP_1");
$rsGravingColors = CIBlockElement::GetList(array("ID"=>"ASC"),$arFilter,false,false,$arSelect);
while($arGravingColor = $rsGravingColors->GetNext())
{
	$arResult["GRAVING_SIZES_AND_COLORS"][$arGravingColor['IBLOCK_SECTION_ID']]['PRICE'] = $arGravingColor['CATALOG_PRICE_1'];
	$arResult["GRAVING_SIZES_AND_COLORS"][$arGravingColor['IBLOCK_SECTION_ID']]['COLORS'][$arGravingColor['ID']] = array(
		"ID"=>$arGravingColor['ID'],
		"DETAIL_PAGE_URL"=>$arGravingColor['DETAIL_PAGE_URL'],
		"PREVIEW_PICTURE"=>$arGravingColor['PREVIEW_PICTURE'],
		"NAME"=>$arGravingColor['NAME'],
	);

}
$arResult['GOODS_FOR_GRAVING'] = $arGoodsForGraving;
$this->IncludeComponentTemplate();
?>