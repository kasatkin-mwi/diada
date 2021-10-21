<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php")?>
<?
$id = intval($_REQUEST['id']);
if (CModule::IncludeModule('sale') && CModule::IncludeModule('iblock') && $id)
	$arElement = getIBlockElement($id);
	$user_id = CSaleBasket::GetBasketUserID();
	$arLike = $arElement['PROPERTIES']['LIKE']['VALUE'];
	if (!in_array($user_id, $arLike))
	{
		$arLike[] = $user_id;
		CIBlockElement::SetPropertyValueCode($arElement['ID'], "LIKE", $arLike);
	}
	echo is_array($arLike) ? count($arLike) : 0;
?>
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/epilog_after.php")?>