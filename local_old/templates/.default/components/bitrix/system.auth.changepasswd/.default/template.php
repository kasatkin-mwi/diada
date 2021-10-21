<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>

<div class="reg_form_gray">

	<div class="reg_form_gray_title"><?=GetMessage("AUTH_CHANGE_PASSWORD")?></div>
	<div class="reg_form_white reg_form_top_block">
		<div class="vhod_page_block">
			<?
			ShowMessage($arParams["~AUTH_RESULT"]);
			?>
			<div class="vhod_page_left_col">
				<div>
				<div class="vhod_page_title"><?=GetMessage("AUTH_CHANGE_PASSWORD")?></div>
				<form method="post" action="<?=$arResult["AUTH_FORM"]?>" name="bform">
					<?if (strlen($arResult["BACKURL"]) > 0): ?>
						<input type="hidden" name="backurl" value="<?=$arResult["BACKURL"]?>" />
					<? endif ?>
					<input type="hidden" name="AUTH_FORM" value="Y">
					<input type="hidden" name="TYPE" value="CHANGE_PWD">

					<ul class="not_style reg_form_el">
						<li><?echo GetMessage("AUTH_LOGIN")?></li>
						<li><input type="text" name="USER_LOGIN" maxlength="50" value="<?=$arResult["LAST_LOGIN"]?>" /></li>
					</ul>
					<ul class="not_style reg_form_el">
						<li><?=GetMessage("AUTH_CHECKWORD")?></li>
						<li><input type="text" name="USER_CHECKWORD" maxlength="50" value="<?=$arResult["USER_CHECKWORD"]?>" /></li>
					</ul>
					<ul class="not_style reg_form_el">
						<li><?=GetMessage("AUTH_NEW_PASSWORD_REQ")?></li>
						<li><input type="password" name="USER_PASSWORD" maxlength="50" value="<?=$arResult["USER_PASSWORD"]?>" autocomplete="off" /></li>
					<ul class="not_style reg_form_el">
						<li><?=GetMessage("AUTH_NEW_PASSWORD_CONFIRM")?></li>
						<li><input type="password" name="USER_CONFIRM_PASSWORD" maxlength="50" value="<?=$arResult["USER_CONFIRM_PASSWORD"]?>" autocomplete="off" /></li>
					</ul>
					<?if($arResult["CAPTCHA_CODE"]):?>
						<ul class="not_style reg_form_el">
							<li><?echo GetMessage("system_auth_captcha")?></li>
							<li>
								<input type="hidden" name="captcha_sid" value="<?echo $arResult["CAPTCHA_CODE"]?>" />
								<img src="/bitrix/tools/captcha.php?captcha_sid=<?echo $arResult["CAPTCHA_CODE"]?>" width="180" height="40" alt="CAPTCHA" />
								<input type="text" name="captcha_word" maxlength="50" value="" size="15" />
							</li>
						</ul>
					<?endif;?>
					<input class="detail_red_button" name="change_pwd" type="submit" value="<?echo GetMessage("CT_BSAC_CONFIRM")?>"/>
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