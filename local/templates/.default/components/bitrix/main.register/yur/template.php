<?
/**
 * Bitrix Framework
 * @package bitrix
 * @subpackage main
 * @copyright 2001-2014 Bitrix
 */

/**
 * Bitrix vars
 * @global CMain $APPLICATION
 * @global CUser $USER
 * @param array $arParams
 * @param array $arResult
 * @param CBitrixComponentTemplate $this
 */

if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)
	die();

//echo "<pre>";print_r($arResult['VALUES']);echo "</pre>";
?>

<form method="post" action="<?=POST_FORM_ACTION_URI?>" name="regform" id="register-yur" enctype="multipart/form-data">
	<input type="hidden" name="register" value="Y" />
    <?
	if($arResult["BACKURL"] <> ''):
	?>
		<input type="hidden" name="backurl" value="<?=$arResult["BACKURL"]?>" />
	<?
	endif;
	?>

	<?if($USER->IsAuthorized()):?>
		<?
        if($_SERVER['REQUEST_METHOD'] == 'POST' && $_REQUEST['register'] == 'Y')
        {
            ?>
            <div class="success-register">
                <?=ShowNote(GetMessage('MAIN_REGISTER_AUTH'))?>    
            </div>
            <?
            return;
        }
        else
        {
            LocalRedirect('/lk/');    
        }
        ?>
	<?else:?>
		<?
		if (count($arResult["ERRORS"]) > 0):
			foreach ($arResult["ERRORS"] as $key => $error)
				if (intval($key) == 0 && $key !== 0)
					$arResult["ERRORS"][$key] = str_replace("#FIELD_NAME#", "&quot;".GetMessage("REGISTER_FIELD_".$key)."&quot;", $error);

			ShowError(implode("<br />", $arResult["ERRORS"]));

		elseif($arResult["USE_EMAIL_CONFIRMATION"] === "Y"):
		?>
		<p><?echo GetMessage("REGISTER_EMAIL_WILL_BE_SENT")?></p>
		<?endif;?>
	<?endif?>

	<ul class="not_style reg_form_el">
		<li>Название организации или ИП:*</li>
		<?$FIELD = "UF_NAME"?>
		<li><input size="255" type="text" name="<?=$FIELD?>" value="<?=$arResult["VALUES"][$FIELD]?>" /></li>
	</ul>
	<div class="reg_radio_button_block">
		<?$FIELD = "UF_TYPE"?>
		<label><input type="radio" name="UF_TYPE" value="1" <?if ($arResult["VALUES"][$FIELD]==1 || !$arResult["VALUES"][$FIELD]):?>checked<?endif;?> /> Организация</label>
		<label><input type="radio" name="UF_TYPE" value="2" <?if ($arResult["VALUES"][$FIELD]==2):?>checked<?endif;?> />ИП</label>
	</div>
	<ul class="not_style reg_form_el">
		<?$FIELD = "UF_CONTACT"?>
		<li>Контактное лицо:</li>
		<li><input size="255" type="text" name="<?=$FIELD?>" value="<?=$arResult["VALUES"][$FIELD]?>" /></li>
	</ul>
	<ul class="not_style reg_form_el">
		<li>@ e-mail:*</li>
		<?$FIELD = "LOGIN"?>
		<li>
			<input size="30" type="text" name="REGISTER[<?=$FIELD?>]" value="<?=$arResult["VALUES"][$FIELD]?>" />
			<input type="hidden" name="REGISTER[EMAIL]" value="<?=$arResult["VALUES"][$FIELD]?>" />
		</li>
	</ul>
	<ul class="not_style reg_form_el">
		<li>Номер телефона:</li>
		<?$FIELD = "PERSONAL_PHONE"?>
		<li><input size="30" type="text" name="REGISTER[<?=$FIELD?>]" value="<?=$arResult["VALUES"][$FIELD]?>" /></li>
	</ul>
	<ul class="not_style reg_form_el">
		<li>Юридический адрес:* <span class="podskazka_block">?<span class="podskazka_text">Укажите индекс, город, улицу, дом, офис.</span></span></li>
		<?$FIELD = "UF_YUR_ADDRESS"?>
		<li><input size="255" type="text" name="<?=$FIELD?>" value="<?=$arResult["VALUES"][$FIELD]?>" /></li>
	</ul>
	<div class="reg_form_double_block reg_form_double_block_border">
		<ul class="not_style reg_form_el">
			<li>Банк:*</li>
			<?$FIELD = "UF_BANK"?>
			<li><input size="255" type="text" name="<?=$FIELD?>" value="<?=$arResult["VALUES"][$FIELD]?>" /></li>
		</ul>
		<ul class="not_style reg_form_el">
			<li>Расчетный счет:* <span class="podskazka_block">?<span class="podskazka_text">Расчетный счет должен состоять из 20 цифр.</span></span></li>
			<?$FIELD = "UF_SCHET"?>
			<li><input size="20" type="text" name="<?=$FIELD?>" value="<?=$arResult["VALUES"][$FIELD]?>" /></li>
		</ul>
		<ul class="not_style reg_form_el">
			<li>Кор. счет:* <span class="podskazka_block">?<span class="podskazka_text">Номер счета должен состоять не более чем из 20 цифр.</span></span></li>
			<?$FIELD = "UF_KORSCHET"?>
			<li><input size="20" type="text" name="<?=$FIELD?>" value="<?=$arResult["VALUES"][$FIELD]?>" /></li>
		</ul>
		<ul class="not_style reg_form_el">
			<li>ИНН:* <span class="podskazka_block">?<span class="podskazka_text">ИНН должен состоять из 10 цифр. Для индивидуальных предпринимателей из 12 цифр.</span></span></li>
			<?$FIELD = "UF_INN"?>
			<li><input size="12" type="text" name="<?=$FIELD?>" value="<?=$arResult["VALUES"][$FIELD]?>" /></li>
		</ul>
		<ul class="not_style reg_form_el">
			<li>КПП:* <span class="podskazka_block">?<span class="podskazka_text">КПП должен состоять из 9 цифр.</span></span></li>
			<?$FIELD = "UF_KPP"?>
			<li><input size="9" type="text" name="<?=$FIELD?>" value="<?=$arResult["VALUES"][$FIELD]?>" /></li>
		</ul>
		<ul class="not_style reg_form_el">
			<li>БИК банка:* <span class="podskazka_block">?<span class="podskazka_text">БИК банка должен состоять из 9 цифр.</span></span></li>
			<?$FIELD = "UF_BIK"?>
			<li><input size="9" type="text" name="<?=$FIELD?>" value="<?=$arResult["VALUES"][$FIELD]?>" /></li>
		</ul>
		<ul class="not_style reg_form_el">
			<li>ОКДП:</li>
			<?$FIELD = "UF_OKDP"?>
			<li><input size="30" type="text" name="<?=$FIELD?>" value="<?=$arResult["VALUES"][$FIELD]?>" /></li>
		</ul>
		<ul class="not_style reg_form_el">
			<li>ОКПО:</li>
			<?$FIELD = "UF_OKPO"?>
			<li><input size="30" type="text" name="<?=$FIELD?>" value="<?=$arResult["VALUES"][$FIELD]?>" /></li>
		</ul>
		<ul class="not_style reg_form_el">
			<li>ОКОНХ/ОКВЭД:</li>
			<?$FIELD = "UF_OKVED"?>
			<li><input size="30" type="text" name="<?=$FIELD?>" value="<?=$arResult["VALUES"][$FIELD]?>" /></li>
		</ul>
		<ul class="not_style reg_form_el">
			<li>Сайт компании:</li>
			<?$FIELD = "PERSONAL_WWW"?>
			<li><input size="30" type="text" name="REGISTER[<?=$FIELD?>]" value="<?=$arResult["VALUES"][$FIELD]?>" /></li>
		</ul>
	</div>
	<ul class="not_style reg_form_el">
		<li>Создайте пароль:*</li>
		<?$FIELD = "PASSWORD"?>
		<li><input size="30" class="password" type="password" name="REGISTER[<?=$FIELD?>]" value="<?=$arResult["VALUES"][$FIELD]?>" autocomplete="off" /></li>
	</ul>
	<ul class="not_style reg_form_el">
		<li>Подтверждение пароля:*</li>
		<?$FIELD = "CONFIRM_PASSWORD"?>
		<li><input size="30" id="pass" type="password" name="REGISTER[<?=$FIELD?>]" value="<?=$arResult["VALUES"][$FIELD]?>" autocomplete="off" /></li>
	</ul>
	<div class="reg_form_test_password_block">
		<ul class="not_style reg_form_test_password_name_status">
			<li>Надежность</li>
			<li></li>
		</ul>
		<ul class="not_style reg_form_test_password_color_status">
			<li></li>
			<li></li>
			<li></li>
			<li></li>
		</ul>
		<?/*<ul class="not_style reg_form_test_password_name_status">
			<li>Надежность</li>
			<li>Средний</li>
		</ul>
		<ul class="not_style reg_form_test_password_color_status password_lvl2">
			<li></li>
			<li></li>
			<li></li>
			<li></li>
		</ul>
		<ul class="not_style reg_form_test_password_name_status">
			<li>Надежность</li>
			<li>Хороший</li>
		</ul>
		<ul class="not_style reg_form_test_password_color_status password_lvl3">
			<li></li>
			<li></li>
			<li></li>
			<li></li>
		</ul>
		<ul class="not_style reg_form_test_password_name_status">
			<li>Надежность</li>
			<li>Безопасный</li>
		</ul>
		<ul class="not_style reg_form_test_password_color_status password_lvl4">
			<li></li>
			<li></li>
			<li></li>
			<li></li>
		</ul>*/?>
		<div class="reg_form_test_password_trebovanie">
			<p>Требования к паролю:</p>
			<ul class="not_style">
				<li>не менее 6 знаков, включая символы</li>
			</ul>
		</div>
		<div class="reg_form_prava_block">
            <label>
                <input type="checkbox"/>
                <span>Настоящим я подтверждаю, что я ознакомлен и согласен с </span>
            </label><a target="_blank" href="/konfidentsialnost/">условиями политики конфиденциальности</a>
		</div>
		<input name="register_submit_button" class="detail_red_button disabled" disabled type="submit" value="ЗАРЕГИСТРИРОВАТЬСЯ"/>
	</div>

</form>

<script type="text/javascript">
$(document).ready(function() {
	$('input:radio, input:checkbox').styler();
});
</script>