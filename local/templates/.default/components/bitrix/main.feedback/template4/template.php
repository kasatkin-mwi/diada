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
<?
$current_link = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
?>

<?if(!empty($arResult["ERROR_MESSAGE"]))
{
	foreach($arResult["ERROR_MESSAGE"] as $v)
		ShowError($v);
}
if(strlen($arResult["OK_MESSAGE"]) > 0)
{
	?>
	<div class="error_page_help_txt js_error_page_help_txt">
		 Спасибо за помощь! Кодовое слово "<span>404-Арчи</span>", Вы получите подарок от нашего магазина при заказе! Будем рады подобрать для Вас лучший товар и дать подробную консультацию!
	</div>
	<script>
		$(document).ready(function () {

				$(".js_error_page_gray_bt").slideUp(1).parents(".js_error_page_nothelp_bl").siblings(".js_error_page_help_bl").find(".js_error_page_red_bt").slideUp(1);

				$(".js_error_page_red_bt").slideUp(1).parents(".js_error_page_help_bl").siblings(".js_error_page_nothelp_bl").find(".js_error_page_gray_bt").slideUp(1);
				
		});
	</script>
	
	<?
}
?>
<form action="<?=POST_FORM_ACTION_URI?>" method="POST">
<?=bitrix_sessid_post()?>
	<div class="mf-name" style="display:none">
		<div class="mf-text">
			<?if(empty($arParams["REQUIRED_FIELDS"]) || in_array("NAME", $arParams["REQUIRED_FIELDS"])):?><?endif?>
		</div>
		<input type="hidden" name="user_name" value="<? echo $current_link ?>">
	</div>

	<div class="mf-message" style="display:none">
		<div class="mf-text">
<?if(empty($arParams["REQUIRED_FIELDS"]) || in_array("MESSAGE", $arParams["REQUIRED_FIELDS"])):?><?endif?>
		</div>
		<textarea type="hidden" style="display:none" name="MESSAGE" rows="5" cols="40">Помочь Арчи получить подарок!</textarea>
	</div>

	<?if($arParams["USE_CAPTCHA"] == "Y"):?>
	<div class="mf-captcha" style="display:none">
		<div class="mf-text"><?=GetMessage("MFT_CAPTCHA")?></div>
		<input type="hidden" name="captcha_sid" value="<?=$arResult["capCode"]?>">
		<img src="/bitrix/tools/captcha.php?captcha_sid=<?=$arResult["capCode"]?>" width="180" height="40" alt="CAPTCHA">
		<div class="mf-text"><?=GetMessage("MFT_CAPTCHA_CODE")?><span class="mf-req">*</span></div>
		<input type="text" name="captcha_word" size="30" maxlength="50" value="">
	</div>
	<?endif;?>
	<input type="hidden" name="PARAMS_HASH" value="<?=$arResult["PARAMS_HASH"]?>">
 <input class="error_page_red_bt js_error_page_red_bt" type="submit" name="submit" value="<?=GetMessage("MFT_SUBMIT")?>">

</form>