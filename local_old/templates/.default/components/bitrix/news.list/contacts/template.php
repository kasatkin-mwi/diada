<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>

<ul class="red_button_tabs">
	<?foreach ($arResult['ITEMS'] as $arItem) {?>
		<li <?=$arItem['ID'] == $arParams['ELEMENT_ID'] ? 'class="current"' : ''?> onclick="location.href=$(this).find('a').attr('href');"><a onclick="return false;" href="<?=$arItem['DETAIL_PAGE_URL']?>"><?=$arItem['NAME']?></a></li>
	<?}?>
</ul>