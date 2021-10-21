<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
    <?
    $cp = $this->__component; // объект компонента

    if (is_object($cp)){
        $cp->arResult['CONTACTS_LIST'] = $arResult['PROPERTIES']['CONTACTS']['VALUE'];
        $cp->SetResultCacheKeys(array('CONTACTS_LIST'));
    }
    ?>
	<div class="dostavka_region_title_block js_dostavka_region_title_block">
		<div><a class="dostavka_region_title js_dostavka_region_title" href=""><?=$arResult['NAME']?></a></div>
		<div class="dostavka_region_title_podskazka">
			Нажмите для выбора региона
			<img class="dostavka_region_title_podskazka_arrow" src="/img/dostavka_region_title_podskazka_arrow.png"/>
		</div>
		<ul class="dostavka_region_title_list_light not_style js_dostavka_region_title_list_light">
			<?foreach ($arResult['LIST'] as $arElem) {?>
				<li <?=$arElem['ID'] == $arResult['ID'] ? 'class="active"': ''?>><a class="not_js" href="<?=$arElem['DETAIL_PAGE_URL']?>"><?=$arElem['NAME']?></a></li>
			<?}?>
		</ul>
	</div>
	<div class="section">
		<?if ($arResult['PROPERTIES']['CONTACTS']['VALUE'] > 0) {?>
			<ul class="tabs dostavka_tabs_block">
				<li class="current"><span class="dostavka_tabs_car">ДОСТАВКА</span></li>
				<li><span class="dostavka_tabs_shop">САМОВЫВОЗ</span></li>
			</ul>
		<?}?>
		<div class="box dostavka_box_block" style="display:block;">
			<?$arResult['PREVIEW_TEXT'] = str_replace("/images/contacts/dostavka_big_img.png", "/img/dostavka_big_img.png", $arResult['PREVIEW_TEXT']);?>
			<?=$arResult['PREVIEW_TEXT']?>
		</div>