<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<?
//*************************************
//show confirmation form
//*************************************
?>
<form action="<?=$arResult["FORM_ACTION"]?>" method="get">
	<div class="lk_form_tit"><?echo GetMessage("subscr_title_confirm")?></div>
	<ul class="not_style reg_form_el form-group">
		<li>
			<?echo GetMessage("subscr_conf_code")?><span class="starrequired req">*</span>
		</li>
		<li>
			<input type="text" name="CONFIRM_CODE" value="<?echo $arResult["REQUEST"]["CONFIRM_CODE"];?>" size="20" />
		</li>
	</ul>
	<div class="show_confirmation_double clear_after">
		<div class="right">
			<p><?echo GetMessage("subscr_conf_date")?></p>
			<p><?echo $arResult["SUBSCRIPTION"]["DATE_CONFIRM"];?></p>
		</div>
		<div class="left"><input class="big_red_button " type="submit" name="confirm" value="<?echo GetMessage("subscr_conf_button")?>" /></div>
	</div>
	<div class="reg_form_test_password_trebovanie">
		<?echo GetMessage("subscr_conf_note1")?> <a title="<?echo GetMessage("adm_send_code")?>" href="<?echo $arResult["FORM_ACTION"]?>?ID=<?echo $arResult["ID"]?>&amp;action=sendcode&amp;<?echo bitrix_sessid_get()?>"><?echo GetMessage("subscr_conf_note2")?></a>.
	</div>
	<input type="hidden" name="ID" value="<?echo $arResult["ID"];?>" />
	<?echo bitrix_sessid_post();?>
</form>
