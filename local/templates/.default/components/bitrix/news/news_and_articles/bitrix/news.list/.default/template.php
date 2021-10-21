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
<div class="news-list clear_after news_bl">
<?if($arParams["DISPLAY_TOP_PAGER"]):?>
	<?=$arResult["NAV_STRING"]?><br />
<?endif;?>
<?foreach($arResult["ITEMS"] as $arItem):?>
	<?
	$this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
	$this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
	?>
	<div class="news_el_bl" id="<?=$this->GetEditAreaId($arItem['ID']);?>">
		<div class="news_el">
			<?if($arParams["DISPLAY_PICTURE"]!="N" && is_array($arItem["PREVIEW_PICTURE"])):?>
				<div class="news_el_img">
					<a href="<?=$arItem["DETAIL_PAGE_URL"]?>" style="background-image:url(<?=$arItem["PREVIEW_PICTURE"]["SRC"]?>);"	alt="<?=$arItem["PREVIEW_PICTURE"]["ALT"]?>" title="<?=$arItem["PREVIEW_PICTURE"]["TITLE"]?>"></a>
				</div>
				<?/*<div class="news_el_img">
					<a href="<?=$arItem["DETAIL_PAGE_URL"]?>"><img
							border="0"
							src="<?=$arItem["PREVIEW_PICTURE"]["SRC"]?>"
							alt="<?=$arItem["PREVIEW_PICTURE"]["ALT"]?>"
							title="<?=$arItem["PREVIEW_PICTURE"]["TITLE"]?>"
					/></a>
				</div>*/?>
			<?else:?>
				<div class="news_el_img">
					<a href="<?=$arItem["DETAIL_PAGE_URL"]?>" alt="Нет фото" title="Нет фото" style="background-image:url(/img/no-image.png);"></a>
				</div>
				<?/*<div class="news_el_img">
					<a href="<?=$arItem["DETAIL_PAGE_URL"]?>"><img
							border="0"
							src="/img/no-image.png"
							alt="Нет фото"
							title="Нет фото"
					/></a>
				</div>*/?>
			<?endif?>
			<div class="news_el_txt_bl">
				<?if($arParams["DISPLAY_NAME"]!="N" && $arItem["NAME"]):?>
					<div class="news_list_title">
						<a href="<?echo $arItem["DETAIL_PAGE_URL"]?>"><?echo $arItem["NAME"]?></a>
					</div>
				<?endif;?>
				<?if($arParams["DISPLAY_PREVIEW_TEXT"]!="N" && $arItem["PREVIEW_TEXT"]):?>
					<div class="news_list_text"><?echo $arItem["PREVIEW_TEXT"];?></div>
				<?endif;?>
				<a class="news_el_bt" href="<?echo $arItem["DETAIL_PAGE_URL"]?>">Подробнее</a>
			</div>
		</div>
	</div>
<?endforeach;?>
<?if($arParams["DISPLAY_BOTTOM_PAGER"]):?>
	<?=$arResult["NAV_STRING"]?>
<?endif;?>
</div>
