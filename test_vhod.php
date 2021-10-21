<?
if (preg_match("/^WordPress(.*)/",$_SERVER["HTTP_USER_AGENT"])){
    die();
}
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Diada-arms.ru");
?>
</div>
</div>
<style>
	.content {
		display:none;
	}
</style>
<div class="reg_form_gray">

        <div class="reg_form_gray_title">Войти</div>
        <div class="reg_form_white reg_form_top_block">
            <div class="vhod_page_block">
                <div class="vhod_page_left_col">
                    <div>
                    <div class="vhod_page_title">Авторизация на сайте</div>
                    <div class="error_text" id="error_text">
                        
                    </div>
                    <form name="form_auth" class="form-login" method="post" target="_top" action="/auth/index.php?login=yes" data-ajax-href="/include/auth.php">
                                                                            <input type="hidden" name="backurl" value="/auth/index.php">
						<ul class="not_style reg_form_el">
                            <li>
								<div class="mail_tel_switch">
									<div class="">Email</div>
									<div class="switch right"></div>
									<div class="active">Телефон</div>
								</div>
							</li>
                            <li><input class="error phone-mask" type="text" name="USER_LOGIN" maxlength="255"></li>
                        </ul>
						<ul class="not_style reg_form_el">
                            <li>
								<div class="mail_tel_switch">
									<div class="active">Email</div>
									<div class="switch left"></div>
									<div class="">Телефон</div>
								</div>
							</li>
                            <li><input class="error phone-mask" type="text" name="USER_LOGIN" maxlength="255"></li>
                        </ul>
                        <ul class="not_style reg_form_el">
                            <li>Пароль*</li>
                            <li><input type="password" name="USER_PASSWORD" maxlength="255" autocomplete="off"></li>
                        </ul>
                                                <input class="detail_red_button" name="Login" type="submit" value="Войти">
                    </form>
                    <a class="vhod_page_old_password" href="/auth/index.php?forgot_password=yes" rel="nofollow">Забыли свой пароль?</a>

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
<div>
<div>
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>