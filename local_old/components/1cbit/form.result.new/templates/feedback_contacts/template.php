<?
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
$this->setFrameMode(false);
?>
<?if ($arResult["isFormErrors"] == "Y"):?><?=$arResult["FORM_ERRORS_TEXT"];?><?endif;?>

<?
if ($arResult["isFormNote"] == "Y")
{
    ?>
    <?=$APPLICATION->RestartBuffer();?>
    <?=$arResult["FORM_NOTE"]?>
    <?die();?>
    <?
}
?>


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
}?>

    <div class="cont_form_list clear_after">
	    <?
        //echo '<pre>'; echo '<br>'; var_export($arResult); echo '</pre>';
	    foreach ($arResult["QUESTIONS"] as $FIELD_SID => $arQuestion)
        {
	    
		    if ($arQuestion['STRUCTURE'][0]['FIELD_TYPE'] == 'hidden')
		    {
			    echo $arQuestion["HTML_CODE"];
		    }
	    }
	    ?>    
        <?if (is_array($arResult["FORM_ERRORS"]) && array_key_exists('SIMPLE_QUESTION_230', $arResult['FORM_ERRORS'])):?>
            <span class="error-fld" title="<?=$arResult["FORM_ERRORS"]['SIMPLE_QUESTION_230']?>"></span>
        <?endif;?>
        <div class="cont_form_el <?=$arResult["QUESTIONS"]['SIMPLE_QUESTION_230']['STRUCTURE'][0]["FIELD_TYPE"]?>">
            <?=$arResult["QUESTIONS"]['SIMPLE_QUESTION_230']["HTML_CODE"]?>
        </div>
        
        <?if (is_array($arResult["FORM_ERRORS"]) && array_key_exists('SIMPLE_QUESTION_719', $arResult['FORM_ERRORS'])):?>
            <span class="error-fld" title="<?=$arResult["FORM_ERRORS"]['SIMPLE_QUESTION_719']?>"></span>
        <?endif;?>
        <div class="cont_form_el <?=$arResult["QUESTIONS"]['SIMPLE_QUESTION_719']['STRUCTURE'][0]["FIELD_TYPE"]?>">
            <?=$arResult["QUESTIONS"]['SIMPLE_QUESTION_719']["HTML_CODE"]?>
        </div>
        
        <?if (is_array($arResult["FORM_ERRORS"]) && array_key_exists('SIMPLE_QUESTION_632', $arResult['FORM_ERRORS'])):?>
            <span class="error-fld" title="<?=$arResult["FORM_ERRORS"]['SIMPLE_QUESTION_632']?>"></span>
        <?endif;?>
        <div class="cont_form_el <?=$arResult["QUESTIONS"]['SIMPLE_QUESTION_632']['STRUCTURE'][0]["FIELD_TYPE"]?>">
            <?=$arResult["QUESTIONS"]['SIMPLE_QUESTION_632']["HTML_CODE"]?>
        </div>  
    </div>
    <div class="cont_form_bot">
        <?
        if($arResult["isUseCaptcha"] == "Y")
        {
        ?>
            
            <div class="cont_form_captcha">
                <input type="hidden" name="captcha_sid" value="<?=htmlspecialcharsbx($arResult["CAPTCHACode"]);?>" />
                <img src="/bitrix/tools/captcha.php?captcha_sid=<?=htmlspecialcharsbx($arResult["CAPTCHACode"]);?>" width="180" height="40" />
                <input type="text" name="captcha_word" size="30" maxlength="50" value="" class="inputtext" />
            </div>
            <label class="ind_subs_prava styler">
                <input type="checkbox" name="accept"<?=$_REQUEST['accept'] == 'Y' ? ' checked' : ''?> value="Y">
                <span>Я согласен с условиями обработки <a href="/konfidentsialnost/" target="_blank">персональных данных</a></span>
            </label>
        <?
        } // isUseCaptcha
        ?>
        <input class="red_bt" disabled  type="submit" name="web_form_submit" value="<?=htmlspecialcharsbx(strlen(trim($arResult["arForm"]["BUTTON"])) <= 0 ? GetMessage("FORM_ADD") : $arResult["arForm"]["BUTTON"]);?>">
    </div>
<?=$arResult["FORM_FOOTER"]?>
<?
} //endif (isFormNote)
?>