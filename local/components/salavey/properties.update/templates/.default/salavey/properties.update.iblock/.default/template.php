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
<div class="iblock_select">
	<form id="iblock_form" action="<?=POST_FORM_ACTION_URI;?>" method="POST">
		<select name="IBLOCK_TYPE">
			<option value="">Выберите тип инфоблока</option>
			<?foreach($arResult["IBLOCK_TYPES"] as $id => $type):?>
			<option value="<?=$id;?>"<?if($arResult["SELECTED_TYPE"] == $id):?> selected<?endif;?>><?=$type;?></option>
			<?endforeach;?>
		</select>
		<?if($arResult["IBLOCK_LIST"]):?>
		<select name="IBLOCK_ID">
			<option value="">Выберите инфоблок</option>
			<?foreach($arResult["IBLOCK_LIST"] as $id => $iblock):?>
			<option value="<?=$id;?>"<?if($arResult["IBLOCK_ID"] == $id):?> selected<?endif;?>><?=$iblock;?></option>
			<?endforeach;?>
		</select>
		<?endif;?>
		<input class="hidden" type="submit" />
	</form>
</div>