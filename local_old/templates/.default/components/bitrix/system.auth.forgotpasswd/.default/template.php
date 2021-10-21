<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<?if($arParams["~AUTH_RESULT"]):?>
	<div class="new_basket_el order_create_success other_notetext">
		<?ShowMessage($arParams["~AUTH_RESULT"]);?>
	</div>
<?endif;?>	
<div class="reg_form_gray">

	<div class="reg_form_gray_title">Восстановление пароля</div>
	<div class="reg_form_white reg_form_top_block">
		<div class="vhod_page_block">
			<div class="vhod_page_left_col">
				<div>
				<div class="vhod_page_title">Восстановление пароля</div>
				<form name="bform" method="post" target="_top" action="<?=$arResult["AUTH_URL"]?>">
					<?
					if (strlen($arResult["BACKURL"]) > 0)
					{
					?>
						<input type="hidden" name="backurl" value="<?=$arResult["BACKURL"]?>" />
					<?
					}
					?>
					<input type="hidden" name="AUTH_FORM" value="Y">
					<input type="hidden" name="TYPE" value="SEND_PWD">

					<ul class="not_style reg_form_el">
						<li><?=GetMessage("AUTH_LOGIN")?></li>
						<li><input type="text" name="USER_LOGIN" maxlength="50" value="<?=$arResult["LAST_LOGIN"]?>" /></li>
					</ul>
					<p><?=GetMessage("AUTH_OR")?></p>
					<ul class="not_style reg_form_el">
						<li><?=GetMessage("AUTH_EMAIL")?></li>
						<li><input type="text" name="USER_EMAIL" maxlength="255" /></li>
					</ul>
					<?if($arResult["CAPTCHA_CODE"]):?>
						<ul class="not_style reg_form_el">
							<li><?echo GetMessage("AUTH_CAPTCHA_PROMT")?></li>
							<li>
								<input type="hidden" name="captcha_sid" value="<?echo $arResult["CAPTCHA_CODE"]?>" />
								<img src="/bitrix/tools/captcha.php?captcha_sid=<?echo $arResult["CAPTCHA_CODE"]?>" width="180" height="40" alt="CAPTCHA" />
								<input type="text" name="captcha_word" maxlength="50" value="" size="15" />
							</li>
						</ul>
					<?endif;?>
					<input class="detail_red_button" name="send_account_info" type="submit" value="Восстановить"/>
				</form>
				<a class="vhod_page_old_password" href="<?=$arResult["AUTH_AUTH_URL"]?>" rel="nofollow"><?=GetMessage("AUTH_AUTH")?></a>

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
