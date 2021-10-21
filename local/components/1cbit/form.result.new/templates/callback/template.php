<?
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
?>
<?if ($arResult["isFormErrors"] == "Y"):?><?=$arResult["FORM_ERRORS_TEXT"];?><?endif;?>

<?=$arResult["FORM_NOTE"]?>

<?if ($arResult["isFormNote"] != "Y")
{
?>
<?=$arResult["FORM_HEADER"]?>

<?
if ($arResult["isFormDescription"] == "Y" || $arResult["isFormTitle"] == "Y" || $arResult["isFormImage"] == "Y")
{
/***********************************************************************************
					form header
***********************************************************************************/
if ($arResult["isFormTitle"]):
?>
	<div class="new_call_back_light_title"><?=$arResult["FORM_TITLE"]?></div>
	<div class="new_call_back_light_text"></div>
<?endif;
}?>

	<?
	foreach ($arResult["QUESTIONS"] as $FIELD_SID => $arQuestion)
	{
		if ($arQuestion['STRUCTURE'][0]['FIELD_TYPE'] == 'hidden')
		{
			echo $arQuestion["HTML_CODE"];
		}
		else
		{
			$is_phone = $FIELD_SID == 'SIMPLE_QUESTION_784';
	?>
		<ul class="<?echo ($is_phone) ? 'new_call_back_light_form_tel' : 'new_call_back_light_form';?>">
			<li>
				<?if (is_array($arResult["FORM_ERRORS"]) && array_key_exists($FIELD_SID, $arResult['FORM_ERRORS'])):?>
				<span class="error-fld" title="<?=$arResult["FORM_ERRORS"][$FIELD_SID]?>"></span>
				<?endif;?>
				<?=$arQuestion["CAPTION"]?><?if ($arQuestion["REQUIRED"] == "Y"):?><?=$arResult["REQUIRED_SIGN"];?><?endif;?>
				<?=$arQuestion["IS_INPUT_CAPTION_IMAGE"] == "Y" ? "<br />".$arQuestion["IMAGE"]["HTML_CODE"] : ""?>
			</li>
			<?if ($is_phone):?>
				<?preg_match("#\(([\d]*)\)\s([\d]*)-([\d]*)-([\d]*)#i", $arResult['arrVALUES']['form_text_5'], $arPhone);?>
				<li>
					+7( <input maxlength="3" value="<?=$arPhone[1]?>" type="text"/> )
					<input maxlength="3" value="<?=$arPhone[2]?>" type="text"/> -
					<input maxlength="2" value="<?=$arPhone[3]?>" type="text"/> -
					<input maxlength="2" value="<?=$arPhone[4]?>" type="text"/>
					<?echo str_replace('type="text"', 'type="hidden"', $arQuestion["HTML_CODE"])?>
				</li>
			<?else:?>
				<li><?=$arQuestion["HTML_CODE"]?></li>
			<?endif;?>
		</ul>
	<?
		}
	} //endwhile
	?>
	<div class="new_call_back_light_right_button">
		<input class="red_button" <?=(intval($arResult["F_RIGHT"]) < 10 ? "disabled=\"disabled\"" : "");?> type="submit" name="web_form_submit" value="<?=htmlspecialcharsbx(strlen(trim($arResult["arForm"]["BUTTON"])) <= 0 ? GetMessage("FORM_ADD") : $arResult["arForm"]["BUTTON"]);?>" onclick="yaCounter25448447.reachGoal('pozvonit'); ga('send', 'pageview', '/zvonok'); console.log('На отправку формы обратного звонка');" />
	</div>

<p>
<?=$arResult["REQUIRED_SIGN"];?> - <?=GetMessage("FORM_REQUIRED_FIELDS")?>
</p>
<?=$arResult["FORM_FOOTER"]?>
<?
} //endif (isFormNote)
?>