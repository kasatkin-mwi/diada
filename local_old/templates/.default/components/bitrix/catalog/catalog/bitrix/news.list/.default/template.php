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
<?
$fileNoImg = CFile::GetList(array(),array("MODULE_ID" => "service_salavey", "ORIGINAL_NAME" => "no_photo_diada.jpg"))->GetNext();
$resizeImgNoPhoto = CFile::ResizeImageGet($fileNoImg['ID'], array("width" => 225, "height" => 198))["src"];
?>
<?foreach($arResult["ITEMS"] as $arItem):?>
	<?
	$this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
	$this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
    if ( $arItem['PREVIEW_PICTURE'] > 0 ) 
    {
        $resizeImg = CFile::ResizeImageGet($arItem['PREVIEW_PICTURE'], array("width" => 225, "height" => 198))["src"];
    }
    if (strlen($resizeImg) == 0)
    {
        $resizeImg = $resizeImgNoPhoto;
    }
	?>
	<div class="news-detail text_h" id="<?=$this->GetEditAreaId($arItem['ID']);?>">
        <div class="news_detail_firearm_block">
             &nbsp;&nbsp;
             <a class="razdel_firearm" href="<?=$arItem["PROPERTIES"]["URL"]["VALUE"]?>">
                <span class="razdel_firearm_img">
                    <img title="<?=$arItem["NAME"]?>" src="<?=$resizeImg?>" alt="<?=$arItem["NAME"]?>">
                </span>
                <span class="razdel_firearm_name"><?=$arItem["NAME"]?></span> 
             </a>
        </div>
        <a class="red_button" href="<?=$arItem["PROPERTIES"]["URL"]["VALUE"]?>"><?=$arItem["PROPERTIES"]["BTN_NAME"]["VALUE"]?></a>
    </div>
<?endforeach;?>