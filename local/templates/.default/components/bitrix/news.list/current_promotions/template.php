<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
/** @var array $arParams */
/** @var array $arResult */
/** @global CMain $APPLICATION */
/** @global CUser $USER */
/** @global CDatabase $DB */
/** @var CBitrixComponentTemplate $this */
/** @var string $templateName */
/** @var string $templateFile */
/** @var string $templateFolder */
/** @var string $componentPath */
/** @var CBitrixComponent $component */
$this->setFrameMode(true);
?>
<?php if ( !empty($arResult["ITEMS"]) ): ?>
	<?/*<div class="h1">Действующие акции</div>*/?>
	<div class="current_promotions">
		<?foreach($arResult["ITEMS"] as $arItem):?>
			<div class="curprom__item">
				<div class="curprom__item_image">
					<?php if ( !empty($arItem["IMAGE_MIN"]) ): ?>
						<img src="<?=$arItem["IMAGE_MIN"]["src"]?>">
					<?php else: ?>
						<img src="/bitrix/templates/.default/components/bitrix/news.list/current_promotions/noimage_min.jpg">
					<?php endif ?>
					<div class="curprom__item_shadow">
						<a class="curprom__item_button" href="#curprom__item_<?=$arItem['ID']?>">Узнать подробнее</a>
					</div>
				</div>
				<div class="curprom_promotions__item_name"><?echo $arItem["NAME"]?></div>
				<?/* item modal */?>
				<div id="curprom__item_<?=$arItem['ID']?>" class="curprom__modal">
					<div class="curprom__modal_image">
						<?php if ( !empty($arItem["IMAGE_MODAL"]) ): ?>
							<img src="<?=$arItem["IMAGE_MODAL"]["src"]?>">
						<?php else: ?>
							<img src="/bitrix/templates/.default/components/bitrix/news.list/current_promotions/noimage_modal.jpg">
						<?php endif ?>
					</div>
					<div class="curprom__modal_title"><?echo $arItem["NAME"]?></div>
					<?php if ( !empty($arItem["PREVIEW_TEXT"]) ): ?>
						<div class="curprom__modal_text"><?echo $arItem["PREVIEW_TEXT"];?></div>
					<?php endif ?>
					<?php if ( !empty($arItem['DISPLAY_PROPERTIES']['BUTTON_URL']['DISPLAY_VALUE']) && !empty($arItem['DISPLAY_PROPERTIES']['BUTTON_TEXT']['DISPLAY_VALUE']) ): ?>
						<div class="curprom__modal_button">
							<a class="curprom__modal_button_btn" href="<?=$arItem['DISPLAY_PROPERTIES']['BUTTON_URL']['DISPLAY_VALUE']?>"><?=$arItem['DISPLAY_PROPERTIES']['BUTTON_TEXT']['DISPLAY_VALUE']?></a>
						</div>
					<?php endif ?>
				</div>
			</div>
		<?endforeach;?>
	</div>
<?php endif ?>