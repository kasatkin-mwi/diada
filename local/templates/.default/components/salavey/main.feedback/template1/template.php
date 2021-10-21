<?
if(!defined("B_PROLOG_INCLUDED")||B_PROLOG_INCLUDED!==true)die();
/**
 * Bitrix vars
 *
 * @var array $arParams
 * @var array $arResult
 * @var CBitrixComponentTemplate $this
 * @global CMain $APPLICATION
 * @global CUser $USER
 */

?>

<script type="text/javascript">
<!--

function validate_form ( )
{
	valid = true;

        if ( document.contact_form.user_email.value == "" )
        {
                alert ( "Пожалуйста заполните поле 'Ваше имя'." );
                valid = false;
        }

        return valid;
}


</script>
<style>
.red_submit {
    width: 180px;
    height: 35px;
    line-height: 33px;
    background:#c41a1c;
    background: linear-gradient(to bottom,#c41a1c,#c8292b);
    border-radius: 6px;
    padding-left: 45px;
    display: block;
    font-family: latoblack;
    font-size: 15px;
    color: #fff;
    text-decoration: none;
    text-align: left;
}

.red_submit:hover{background:#921316;background:linear-gradient(to bottom,#921316,#bc191b)}
</style>

<div class="mfeedback">
<?if(!empty($arResult["ERROR_MESSAGE"]))
{
	foreach($arResult["ERROR_MESSAGE"] as $v)
		ShowError($v);
}
if(strlen($arResult["OK_MESSAGE"]) > 0)
{
	?><div class="mf-ok-text"><?=$arResult["OK_MESSAGE"]?></div><?
}
?>

<form name="contact_form" action="<?=POST_FORM_ACTION_URI?>" method="POST">
<?=bitrix_sessid_post()?>
	<div class="mf-name">
		<div class="mf-text">
			<?=GetMessage("MFT_NAME")?><?if(empty($arParams["REQUIRED_FIELDS"]) || in_array("NAME", $arParams["REQUIRED_FIELDS"])):?><span class="mf-req">*</span><?endif?>
		</div>
		<input type="text" name="user_name" placeholder="Иванов Иван" value="<?=$arResult["AUTHOR_NAME"]?>">
	</div>
	<div class="mf-email" style="display:none;">
		<div class="mf-text">
			<?=GetMessage("MFT_EMAIL")?><?if(empty($arParams["REQUIRED_FIELDS"]) || in_array("EMAIL", $arParams["REQUIRED_FIELDS"])):?><span class="mf-req">*</span><?endif?>
		</div>
		<input type="text" name="user_email" value="<?=$arResult["AUTHOR_EMAIL"]?>">
	</div>

	<div class="mf-message">
		<div class="mf-text">
			Ваш телефон: <?if(empty($arParams["REQUIRED_FIELDS"]) || in_array("MESSAGE", $arParams["REQUIRED_FIELDS"])):?><span class="mf-req">*</span><?endif?>
		</div>
        <input type="text" name="MESSAGE" value="<?=$arResult["MESSAGE"]?>" style="width: 60%;">
		<?/*<textarea style="height: 30px;" name="MESSAGE" rows="5" cols="40"><?=$arResult["MESSAGE"]?></textarea>*/?>
	</div>

	<?if($arParams["USE_CAPTCHA"] == "Y"):?>
		<?\Bitrix\Main\Page\Asset::getInstance()->addJs('//www.google.com/recaptcha/api.js?render='.RE_SITE_KEY_V3.'');?>
		<style type="text/css">.grecaptcha-badge {display: none;}</style>
		<input type="hidden" id="recaptcha_v3" name="g-recaptcha-response">
		<?/* <div class="mf-captcha">
			<div class="mf-text"><?=GetMessage("MFT_CAPTCHA")?></div>
			<input type="hidden" name="captcha_sid" value="<?=$arResult["capCode"]?>">
			<img src="/bitrix/tools/captcha.php?captcha_sid=<?=$arResult["capCode"]?>" width="180" height="40" alt="CAPTCHA">
			<div class="mf-text"><?=GetMessage("MFT_CAPTCHA_CODE")?><span class="mf-req">*</span></div>
			<input type="text" name="captcha_word" size="30" maxlength="50" value="">
		</div> */?>
	<?endif;?>

	<input type="hidden" name="PARAMS_HASH" value="<?=$arResult["PARAMS_HASH"]?>">
	<input class="red_submit " type="submit" name="submit" value="<?=GetMessage("MFT_SUBMIT")?>">
</form>
</div>
<script>
    maskAktive("",true,'input[name="MESSAGE"]');

    // recaptcha
    grecaptcha.ready(function() {
        grecaptcha.execute('<?=RE_SITE_KEY_V3?>', {action: 'homepage'}).then(function(token) {
            document.getElementById("recaptcha_v3").value=token;
        });
    });
</script>
