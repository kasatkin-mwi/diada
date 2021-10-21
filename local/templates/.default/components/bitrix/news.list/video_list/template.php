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
<div class="news-list">
<?if($arParams["DISPLAY_TOP_PAGER"]):?>
	<?=$arResult["NAV_STRING"]?><br />
<?endif;?>
<?foreach($arResult["ITEMS"] as $arItem):?>
    <?
    $this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
    $this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
    $video = $arItem['PROPERTIES']['VIDEO']['VALUE']['path'];
    if (preg_match('/[http|https]+:\/\/(?:www\.|)youtube\.com\/watch\?(?:.*)?v=([a-zA-Z0-9_\-]+)/i', $video, $matches) || preg_match('/(?:www\.|)youtube\.com\/embed\/([a-zA-Z0-9_\-]+)/i', $video, $matches)) {
        //$img = 'http://img.youtube.com/vi/'.$matches[1].'/0.jpg';
        $img = 'https://i.ytimg.com/vi/'.$matches[1].'/hqdefault.jpg';
    }else{
        $img = false;
    }
    ?>
    <div class="index_video_el_list" id="<?=$this->GetEditAreaId($arItem['ID']);?>">
        <?if ($img):?><a rel="nofollow" class="fancy_ajax_video" href="https://www.youtube.com/embed/<?=$matches[1]?>?autoplay=1"><img src="<?=$img?>" alt=""/></a><?endif;?>
        <a rel="nofollow" class="fancy_ajax_video" href="https://www.youtube.com/embed/<?=$matches[1]?>?autoplay=1"><?=$arItem['NAME']?></a>
        <div class="clear"></div>
    </div>
<?endforeach;?>
<?if($arParams["DISPLAY_BOTTOM_PAGER"]):?>
	<?=$arResult["NAV_STRING"]?>
<?endif;?>
</div>
