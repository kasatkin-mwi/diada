<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<?
//***********************************
//setting section
//***********************************
?>
<form action="<?=$arResult["FORM_ACTION"]?>" method="post">
	<?echo bitrix_sessid_post();?>
	<div class="lk_form_tit"><?echo GetMessage("subscr_title_settings")?></div>

	<ul class="not_style reg_form_el form-group">
		<li>
			<?echo GetMessage("subscr_email")?><span class="starrequired req">*</span>
		</li>
		<li>
			<input type="text" name="EMAIL" value="<?=$arResult["SUBSCRIPTION"]["EMAIL"]!=""?$arResult["SUBSCRIPTION"]["EMAIL"]:$arResult["REQUEST"]["EMAIL"];?>" size="30" maxlength="255" />
		</li>
	</ul>
	<div class="reg_form_test_password_trebovanie">
		<?echo GetMessage("subscr_settings_note1")?> <?echo GetMessage("subscr_settings_note2")?>
	</div>
	<ul class="not_style reg_form_el form-group">
		<li>
			<?echo GetMessage("subscr_rub")?><span class="starrequired req">*</span>
		</li>
		<li>
			<?foreach($arResult["RUBRICS"] as $itemID => $itemValue):?>
			<label><input type="checkbox" name="RUB_ID[]" value="<?=$itemValue["ID"]?>"<?if($itemValue["CHECKED"]) echo " checked"?> /><?=$itemValue["NAME"]?></label><br />
		<?endforeach;?>
		</li>
	</ul>
	<ul class="not_style reg_form_el form-group">
		<li>
			<?echo GetMessage("subscr_fmt")?>
		</li>
		<li>
			<div class="reg_radio_button_block tabs">
				<label class="type_user_reg current">
					<input type="radio" name="FORMAT" value="text"<?if($arResult["SUBSCRIPTION"]["FORMAT"] == "text") echo " checked"?> /><?echo GetMessage("subscr_text")?>
				</label>
				<label class="type_user_reg"><input type="radio" name="FORMAT" value="html"<?if($arResult["SUBSCRIPTION"]["FORMAT"] == "html") echo " checked"?> />HTML</label>
			</div>
		</li>
	</ul>

	<input class="big_red_button" id="mtp" type="submit" name="Save" value="<?echo ($arResult["ID"] > 0? GetMessage("subscr_upd"):GetMessage("subscr_add"))?>" />
	<input class="big_gray_button" type="reset" value="<?echo GetMessage("subscr_reset")?>" name="reset" />

	<input type="hidden" name="PostAction" value="<?echo ($arResult["ID"]>0? "Update":"Add")?>" />
	<input type="hidden" name="ID" value="<?echo $arResult["SUBSCRIPTION"]["ID"];?>" />
	<?if($_REQUEST["register"] == "YES"):?>
		<input type="hidden" name="register" value="YES" />
	<?endif;?>
	<?if($_REQUEST["authorize"]=="YES"):?>
		<input type="hidden" name="authorize" value="YES" />
	<?endif;?>
</form>