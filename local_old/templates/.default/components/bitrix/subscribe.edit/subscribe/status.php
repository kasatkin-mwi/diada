<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<?
//***********************************
//status and unsubscription/activation section
//***********************************
?>
<form action="<?=$arResult["FORM_ACTION"]?>" method="get">
		<div class="lk_form_tit"><?echo GetMessage("subscr_title_status")?></div>
		<div class="show_confirmation_status"><b><?echo GetMessage("subscr_conf")?></b><span class="<?echo ($arResult["SUBSCRIPTION"]["CONFIRMED"] == "Y"? "notetext":"errortext")?>"><?echo ($arResult["SUBSCRIPTION"]["CONFIRMED"] == "Y"? GetMessage("subscr_yes"):GetMessage("subscr_no"));?></span></div>
		<div class="reg_form_test_password_trebovanie">
			<?if($arResult["SUBSCRIPTION"]["CONFIRMED"] <> "Y"):?>
				<p><?echo GetMessage("subscr_title_status_note1")?></p>
			<?elseif($arResult["SUBSCRIPTION"]["ACTIVE"] == "Y"):?>
				<p><?echo GetMessage("subscr_title_status_note2")?></p>
				<p><?echo GetMessage("subscr_status_note3")?></p>
			<?else:?>
				<p><?echo GetMessage("subscr_status_note4")?></p>
				<p><?echo GetMessage("subscr_status_note5")?></p>
			<?endif;?>
		</div>
		<div class="show_confirmation_status"><b><?echo GetMessage("subscr_act")?></b><span class="<?echo ($arResult["SUBSCRIPTION"]["ACTIVE"] == "Y"? "notetext":"errortext")?>"><?echo ($arResult["SUBSCRIPTION"]["ACTIVE"] == "Y"? GetMessage("subscr_yes"):GetMessage("subscr_no"));?></span></div>
		<div class="show_confirmation_status"><b><?echo GetMessage("adm_id")?></b><span><?echo $arResult["SUBSCRIPTION"]["ID"];?></span></div>
		<div class="show_confirmation_status"><b><?echo GetMessage("subscr_date_add")?></b><span><?echo $arResult["SUBSCRIPTION"]["DATE_INSERT"];?></span></div>
		<div class="show_confirmation_status"><b><?echo GetMessage("subscr_date_upd")?></b><span><?echo $arResult["SUBSCRIPTION"]["DATE_UPDATE"];?></span></div>
		
		<?if($arResult["SUBSCRIPTION"]["CONFIRMED"] == "Y"):?>
			<div style="padding-top:30px;">
			<?if($arResult["SUBSCRIPTION"]["ACTIVE"] == "Y"):?>
				<input class="big_red_button" type="submit" name="unsubscribe" value="<?echo GetMessage("subscr_unsubscr")?>" />
				<input type="hidden" name="action" value="unsubscribe" />
			<?else:?>
				<input class="big_red_button" type="submit" name="activate" value="<?echo GetMessage("subscr_activate")?>" />
				<input type="hidden" name="action" value="activate" />
			<?endif;?>
			</div>
		<?endif;?>
		<input type="hidden" name="ID" value="<?echo $arResult["SUBSCRIPTION"]["ID"];?>" />
		<div><?echo bitrix_sessid_post();?></div>
</form>