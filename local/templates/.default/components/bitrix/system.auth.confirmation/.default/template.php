<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>

<p><?echo $arResult["MESSAGE_TEXT"]?></p>
<?//here you can place your own messages
	switch($arResult["MESSAGE_CODE"])
	{
	case "E01":
		?><? //When user not found
		break;
	case "E02":
		?><? //User was successfully authorized after confirmation
		break;
	case "E03":
		?><? //User already confirm his registration
		break;
	case "E04":
		?><? //Missed confirmation code
		break;
	case "E05":
		?><? //Confirmation code provided does not match stored one
		break;
	case "E06":
		?><? //Confirmation was successfull
		break;
	case "E07":
		?><? //Some error occured during confirmation
		break;
	}
?>
<?if($arResult["SHOW_FORM"]):?>

<div class="reg_form_gray">

	<div class="reg_form_gray_title">Подтверждение пароля</div>
	<div class="reg_form_white reg_form_top_block">
		<div class="vhod_page_block">
			<div class="vhod_page_left_col">
				<div>
				<div class="vhod_page_title">Подтверждение пароля</div>
				<form method="post" action="<?echo $arResult["FORM_ACTION"]?>">

					<ul class="not_style reg_form_el">
						<li><?echo GetMessage("CT_BSAC_LOGIN")?></li>
						<li><input type="text" name="<?echo $arParams["LOGIN"]?>" maxlength="50" value="<?echo $arResult["LOGIN"]?>" size="17" /></li>
					</ul>
					<ul class="not_style reg_form_el">
						<li><?echo GetMessage("CT_BSAC_CONFIRM_CODE")?></li>
						<li><input type="text" name="<?echo $arParams["CONFIRM_CODE"]?>" maxlength="50" value="<?echo $arResult["CONFIRM_CODE"]?>" size="17" /></li>
					</ul>
					<input class="detail_red_button" type="submit" value="<?echo GetMessage("CT_BSAC_CONFIRM")?>"/>

					<input type="hidden" name="<?echo $arParams["USER_ID"]?>" value="<?echo $arResult["USER_ID"]?>" />
				</form>
				<a class="vhod_page_old_password" href="/auth/" rel="nofollow"><?=GetMessage("AUTH_AUTH")?></a>

				</div>
			</div>
			<div class="vhod_page_right_col">
				<div class="vhod_page_title">Регистрация нового пользователя</div>
				<p>Быстро, удобно, легко!</p>
				<ul>
					<li>Используйте введённые ранее данные</li>
					<li>Отслеживайте статус заказа</li>
					<li>Получайте персонализированные предложения</li>
					<li>Накапливайте и тратьте бонусные рубли</li>
					<li>Сохраняйте историю заказов</li>
				</ul>
				<a class="detail_red_button" href="/auth/reg/">Зарегистрироваться</a>
			</div>
		</div>
	</div>

</div>
<?elseif(!$USER->IsAuthorized()):?>
	<?$APPLICATION->IncludeComponent("bitrix:system.auth.authorize", "", array());?>
<?endif?>