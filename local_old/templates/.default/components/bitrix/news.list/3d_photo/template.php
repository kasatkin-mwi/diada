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
//echo "<pre>";print_r($arResult);echo "</pre>";
?>
<div class="spritespin" id="spritespin"></div>
<script type="text/javascript">
	$(document).ready(function() {
		$('.spritespin').spritespin({
			source: [
				<?foreach($arResult["ITEMS"] as $arItem):?>
					"<?=$arItem['PREVIEW_PICTURE']['SRC']?>",
				<?endforeach;?>
			],
			width   : 480,  // width in pixels of the window/frame
			height  : 327,  // height in pixels of the window/frame
		});
	});
</script>