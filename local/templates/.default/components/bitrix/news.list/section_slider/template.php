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
/* http://mkarta.com/2220 */
/* $arResult['UF_SECTION_LINK'][0] == '/help/prilozhenie/' */
$this->setFrameMode(true);
?>
<?
use \Bitrix\Conversion\Internals\MobileDetect;
$detect = new MobileDetect;
?>
<?if($arResult["UF_SECTION_LINK"]):?>
<div class="new_banner_page">
	<div class="index_slider_block">
		<?if(count($arResult["UF_SECTION_LINK"]) > 1):?>
			<ul class="index_slider">
				<?foreach($arResult["UF_SECTION_SLIDER"] as $n => $arPicture):?>				
					<li id="<?=$this->GetEditAreaId($arItem['ID']);?>"><a href="<?if( ($detect->isMobile()) && ($arResult['UF_SECTION_LINK'][$n] == '/help/prilozhenie/')):?>http://mkarta.com/2220<?else:?><?=$arResult['UF_SECTION_LINK'][$n]?><?endif;?>"><img src="<?=$arPicture?>"></a></li>
				<?endforeach;?>
			</ul>
		<?else:?>
			<?//if ($detect->isMobile()){	echo "Mobile";}else{echo "Desktop";}?>
			<a href="<?if( ($detect->isMobile()) && ($arResult['UF_SECTION_LINK'][0] == '/help/prilozhenie/')):?>http://mkarta.com/2220<?else:?><?=$arResult['UF_SECTION_LINK'][0]?><?endif;?>"><img src="<?=$arResult["UF_SECTION_SLIDER"][0]?>"></a>			
		<?endif;?>
	</div>
</div>
<?endif;?>