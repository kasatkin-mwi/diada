<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();?>
<?if (is_array($arResult['SECTIONS']) && count($arResult['SECTIONS']) > 0):?>
<div class="targets-list">
<?foreach ($arResult['SECTIONS'] as $arSection):?>
	<p class="target-group-title"><?=$arSection['NAME']?></p>
	<?if (is_array($arResult['ITEMS'][$arSection['ID']]) && count($arResult['ITEMS'][$arSection['ID']]) > 0):?>
		<?foreach ($arResult['ITEMS'][$arSection['ID']] as $arTarget):?>
			<?$preview =  CFile::ResizeImageGet($arTarget['PREVIEW_PICTURE'], array('width'=>350, 'height'=>250), BX_RESIZE_IMAGE_PROPORTIONAL_ALT, true);?>
			<a href="<?=$arTarget['DOWNLOAD_LINK']['SRC']?>" target="_blank">
				<img src="<?=$preview['src']?>" />
			</a>
		<?endforeach?>
	<?endif?>
<?endforeach?>
</div>
<?endif;?>
