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

<ul class="index_slider">
<?foreach($arResult["ITEMS"] as $arItem):?>
	<?
	$this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
	$this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
    if ($arItem['~DETAIL_PICTURE']>0) {
        $resizeImg = CFile::ResizeImageGet($arItem['~DETAIL_PICTURE'], array("width" => 910, "height" => 400),BX_RESIZE_IMAGE_PROPORTIONAL,false,false,false,20)["src"];
    }
	?>
	<li id="<?=$this->GetEditAreaId($arItem['ID']);?>">
		<?if(is_array($arItem["DETAIL_PICTURE"])):?>
            <a href="<?=$arItem["DISPLAY_PROPERTIES"]["HYPERLINK_MENU"]["VALUE"]?>">
                <?/*<img  data-src="<?=$resizeImg?>" src="data:image/gif;base64,R0lGODlhAQABAIAAAAAAAP///yH5BAEAAAAALAAAAAABAAEAAAIBRAA7" title="<?=$arItem["DETAIL_PICTURE"]["TITLE"]?>" />*/?>
                <img src="<?=$resizeImg?>" title="<?=$arItem["DETAIL_PICTURE"]["TITLE"]?>" />
            </a>
		<?endif?>
	</li>
<?endforeach;?>
</ul>
