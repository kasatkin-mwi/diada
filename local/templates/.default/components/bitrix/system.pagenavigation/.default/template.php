<?
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
if(!$arResult["NavShowAlways"])
{
	if ($arResult["NavRecordCount"] == 0 || ($arResult["NavPageCount"] == 1 && $arResult["NavShowAll"] == false))
		return;
}
$strNavQueryString = ($arResult["NavQueryString"] != "" ? $arResult["NavQueryString"]."&amp;" : "");
$strNavQueryStringFull = ($arResult["NavQueryString"] != "" ? "?".$arResult["NavQueryString"] : "");
?>
<div class="catalog_page_navigator_block">
	<?/*Выводим слово предыдущая, если нужно*/?>
	<div class="catalog_page_navigator">
	<?if ($arResult["NavPageNomer"] > 1):?>
		<?if ($arResult["NavPageNomer"] > 2):?>
			<a href='<?=$arResult["sUrlPath"]?>?<?=$strNavQueryString?>PAGEN_<?=$arResult["NavNum"]?>=<?=($arResult["NavPageNomer"]-1)?>'><span><img src="/img/navigator_left_arrow.png" alt="Предыдущая страница"/><span></a>
		<?else:?>
			<a href='<?=$arResult["sUrlPath"]?><?=$strNavQueryStringFull?>'><span><img src="/img/navigator_left_arrow.png" alt="Предыдущая страница"/><span></a>
		<?endif?>
	<?endif?>
	<?/*Выводим ссылки-цифры*/?>
	<?while($arResult["nStartPage"] <= $arResult["nEndPage"]):?>
		<?if ($arResult["nStartPage"] == $arResult["NavPageNomer"]):?>
			<a href="" class="active"><span><?=$arResult["nStartPage"]?></span></a>
		<?elseif($arResult["nStartPage"] == 1 && $arResult["bSavePage"] == false):?>
			<a href='<?=$arResult["sUrlPath"]?><?=$strNavQueryStringFull?>'><span><?=$arResult["nStartPage"]?></span></a>
		<?else:?>
			<a href='<?=$arResult["sUrlPath"]?>?<?=$strNavQueryString?>PAGEN_<?=$arResult["NavNum"]?>=<?=$arResult["nStartPage"]?>'><span><?=$arResult["nStartPage"]?></span></a>
		<?endif?>
		<?$arResult["nStartPage"]++?>
	<?endwhile?>
	<?/*Выводим слово следующая, если нужно*/?>
	<?if($arResult["NavPageNomer"] < $arResult["NavPageCount"]):?>
		<a href='<?=$arResult["sUrlPath"]?>?<?=$strNavQueryString?>PAGEN_<?=$arResult["NavNum"]?>=<?=($arResult["NavPageNomer"]+1)?>'><span><img src="/img/navigator_right_arrow.png" alt=""/></span></a>
	<?endif?>
	</div>
</div>