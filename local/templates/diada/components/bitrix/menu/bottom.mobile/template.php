<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>

<?if (!empty($arResult)):?>
<ul class="header_top_menu not_style">
<?
$count = 5;
foreach($arResult as $i=>$arItem):
	if($arParams["MAX_LEVEL"] == 1 && $arItem["DEPTH_LEVEL"] > 1)
		continue;
?>
		<?if ($i <= $count):?>
			<li <?if($arItem["SELECTED"]):?>lass="active"<?endif;?>>
		<?endif;?>
		<?if ($i == $count):?>
			<a class="js_section_other_el_button" href=""><span><img src="/img/section_copu_top_menu.png" alt=""/></span></a>
			<div class="section_other_el_menu js_section_other_el_menu">
		<?endif;?>
			<a href="<?=$arItem["LINK"]?>"><span><?=$arItem["TEXT"]?></span></a>
		<?if ($i < $count):?>
			</li>
		<?endif;?>
<?endforeach?>
		</div>
	</li>
</ul>
<?endif?>