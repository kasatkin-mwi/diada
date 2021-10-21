<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php")?>
<?
global $USER;
if (CModule::IncludeModule("iblock") &&  CModule::IncludeModule('sale') && CModule::IncludeModule("catalog"))
{
	$locationPriceType = getLocationGroupPriceType();
	$arPrice = CIBlockPriceTools::GetCatalogPrices(1, array($locationPriceType));

	$mainGoodID = intval($_REQUEST['id']);
	$quantity = intval($_REQUEST['quantity']);
	$setID = intval($_REQUEST['set']);
	$arSetsName = array('BASE', 'MASTER', 'PROFI');
	$arSetsNameRu = array('Базовый комплект', 'комплект Мастер', 'комплект Профи');
	$arFilter = array('ID' => $mainGoodID);
	$arSelect = array(
		'ID',
		'NAME',
		$arPrice[$locationPriceType]['SELECT'],
		'DETAIL_PAGE_URL',
		'PROPERTY_SET_' . $arSetsName[$setID],
		'PROPERTY_SET_' . $arSetsName[$setID] . '_DISCOUNT',
		"IBLOCK_ID",
		"XML_ID"
	);

	$rsMainGood = CIBlockElement::GetList(array(), $arFilter, false, false, $arSelect);
	$arSetGoodsID = array();

	$mainProductInfo = $arMainGood = $rsMainGood->GetNext();

	$setDiscountSelf = $arMainGood['PROPERTY_SET_' . $arSetsName[$setID] . '_DISCOUNT_VALUE'];
	$mainGoodName = $arMainGood['NAME'];
	$mainGoodURL = $arMainGood['DETAIL_PAGE_URL'];
	$arSetGoodsID[] = $arMainGood['ID'];
	if ($arMainGood['PROPERTY_SET_' . $arSetsName[$setID] . '_VALUE'] != '') {
        $arSetGoodsID[] = $arMainGood['PROPERTY_SET_' . $arSetsName[$setID] . '_VALUE'];//в комплект первый из набора
    }

	while ($arMainGood = $rsMainGood->GetNext()) {
        $arSetGoodsID[] = $arMainGood['PROPERTY_SET_' . $arSetsName[$setID] . '_VALUE'];
    }
	$arFilter = array('ID' => $arSetGoodsID);
	$arSelect = array('ID', 'NAME', $arPrice[$locationPriceType]['SELECT'], 'DETAIL_PAGE_URL');

	$rsGoodsInSet = CIBlockElement::GetList(array(), $arFilter, false, false, $arSelect);
	$arGoods = array();
	while ($arGoodsInSet = $rsGoodsInSet->GetNext()) {
		$arGoodPrices = CIBlockPriceTools::GetItemPrices(1, $arPrice, $arGoodsInSet);
		$arGoods[] = array
		(
			'NAME' => $arGoodsInSet['NAME'],
			'ID' => $arGoodsInSet['ID'],
			'DETAIL_PAGE_URL' => $arGoodsInSet['DETAIL_PAGE_URL'],
			'PRICES' => $arGoodPrices
		);
	}
	$arProps = array();
	$SET_PRICE_WITHOUT_DISCOUNT = 0;
	$SET_PRICE_WITH_DISCOUNT = 0;
	$SET_DISCOUNT = 0;
	if (!empty($setID) && isset($setID)) $arProps[] = array('NAME' => 'Комплектация', 'VALUE' => $arSetsNameRu[$setID], "SORT" => 1);
	foreach ($arGoods as $index => $good) {
		$arProps[] = array(
			'NAME' => "Товар №" . ($index + 1),
			'CODE' => "PRODUCT №" . ($index + 1),
			'VALUE' => $good['NAME'],
			'SORT' => ($index + 1) * 100
		);
		$SET_PRICE_WITHOUT_DISCOUNT += $good['PRICES'][$locationPriceType]['VALUE_VAT'];
		$SET_PRICE_WITH_DISCOUNT += $good['PRICES'][$locationPriceType]['DISCOUNT_VALUE_VAT'];
		$SET_DISCOUNT += $good['PRICES'][$locationPriceType]['DISCOUNT_DIFF'];
	}
    $arProps[] = array(
        'NAME' => "Старая цена",
        'CODE' => "HIDE_OLD_PRICE",
        'VALUE' => $SET_PRICE_WITHOUT_DISCOUNT,
        'SORT' => 9999
    );
	$SET_DISCOUNT += $setDiscountSelf; //сумма скидок товаров и скидка самого комплекта
	$FINAL_PRICE = $SET_PRICE_WITHOUT_DISCOUNT - $SET_DISCOUNT;
	$customPrice = "Y";
	if (count($arGoods) == 1){
        $customPrice = "N";
        $SET_DISCOUNT = 0;
	}
	$arGoodForBasket = array(
		"PRODUCT_ID" => $mainGoodID,
		"PRICE" => $FINAL_PRICE,
		"CURRENCY" => "RUB",
		"QUANTITY" => $quantity,
		"NAME" => $mainGoodName." (" . $arSetsNameRu[$setID] . ")",
		"DETAIL_PAGE_URL" => $mainGoodURL,
		"NOTES" => $setID . '_'.count($arGoods),
		"LID" => LANG,
		"BASE_PRICE" => $SET_PRICE_WITHOUT_DISCOUNT,
		"DISCOUNT_PRICE" => $SET_DISCOUNT,
		"DISCOUNT_NAME" => "Величина скидки за комплект",
		"CAN_BUY" => "Y",
		"MODULE" => "catalog",
		"IGNORE_CALLBACK_FUNC" => $customPrice,
		"LAST_DISCOUNT" => $customPrice,
		"CUSTOM_PRICE" => $customPrice,
        "PROPS" => $arProps,
		"PRODUCT_PROVIDER_CLASS" => "CCatalogProductProvider"
	);
    $strIBlockXmlID = (string)CIBlock::GetArrayByID($mainProductInfo['IBLOCK_ID'], 'XML_ID');
    $arGoodForBasket["PRODUCT_XML_ID"] = $mainProductInfo['XML_ID'];
    $arGoodForBasket["CATALOG_XML_ID"] = $strIBlockXmlID;
    CSaleBasket::Add($arGoodForBasket);
}
?>
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/epilog_after.php")?>

<?
if($_REQUEST['turbo'] == 'Y'){
	LocalRedirect("/personal/cart/");

}
?>