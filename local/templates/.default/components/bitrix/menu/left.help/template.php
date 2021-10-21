<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>

<?foreach ($arResult as $i=>$arItem):?>
	<?if ($arItem['PARAMS']['TITLE'] == 'Y'):?>
		<?if ($i):?></ul></div><?endif;?>
		<div>
			<p class="dostavka_menu_title"><a href="<?=$arItem['LINK']?>"><?=$arItem['TEXT']?></a></p>
			<ul class="dostavka_menu not_style">
	<?else:?>
		<li <?if ($arItem['SELECTED']) echo 'class="active"';?>><a href="<?=$arItem['LINK']?>" <?=$arItem['PARAMS']['TARGET'] ? ' target="_blank"' : ''?>><?=$arItem['TEXT']?></a></li>
	<?endif;?>
	<?$previousLevel = $arItem["DEPTH_LEVEL"];?>
<?endforeach?>
</ul></div>