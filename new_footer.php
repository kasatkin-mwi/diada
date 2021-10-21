<?
if (preg_match("/^WordPress(.*)/",$_SERVER["HTTP_USER_AGENT"])){
    die();
}
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Diada-arms.ru");
?>
<style>
	.content {
		display:none;
	}
</style>
</div>
</div>

<!-- начало -->
	<div class="help_form_bl">
		<div class="help_form_l">
			<img src="/img/help_form_ic.png" alt=""/>
		</div>
		<div class="help_form_r">
			<form>
				<div class="help_form_tit">Нужна помощь?</div>
				<div class="help_form_txt">Оставьте свой телефон и мы перезвоним Вам за 27 секунд!</div>
				<div class="help_form">
					<input type="text" placeholder="+7 (___) ___-__-__"/>
					<input type="submit" value="Жду звонка"/>
				</div>
			</form>
		</div>
	</div>
	<div class="f_advantages_bl">
		<div class="f_advantages_el">
			<div class="f_advantages_ic"><img src="/img/f_advantages_ic1.png" alt=""/></div>
			<div class="f_advantages_txt">Качественные <br/>товары</div>
		</div>
		<div class="f_advantages_el">
			<div class="f_advantages_ic"><img src="/img/f_advantages_ic2.png" alt=""/></div>
			<div class="f_advantages_txt">Удобство <br/>выбора</div>
		</div>
		<div class="f_advantages_el">
			<div class="f_advantages_ic"><img src="/img/f_advantages_ic3.png" alt=""/></div>
			<div class="f_advantages_txt">Широкий <br/>ассортимент</div>
		</div>
		<div class="f_advantages_el">
			<div class="f_advantages_ic"><img src="/img/f_advantages_ic4.png" alt=""/></div>
			<div class="f_advantages_txt">Дополнительная <br/>гарантия</div>
		</div>
		<div class="f_advantages_el">
			<div class="f_advantages_ic"><img src="/img/f_advantages_ic5.png" alt=""/></div>
			<div class="f_advantages_txt">Доставка по России <br/>и странам ТС</div>
		</div>
	</div>
</section>

<link href="/css/footer_style.css" rel="stylesheet" type="text/css" >

<footer class="gray_bg">
	<div class="standart_width">
		<div class="gr_foot_top_bl">
			<div class="gr_foot_top_l">
				<div class="gr_foot_logo">
					<a href="/"><img src="/img/logo_footer.png"></a>
				</div>
				<p>© 2010-2019 Интернет-магазин www.diada-arms.ru - товары для охоты, спорта и отдыха</p>
				<p><a href="">Карта сайта</a></p>
			</div>
			<div class="gr_foot_top_c">
				<div class="gr_foot_podpiska_bl">
					<div class="gr_foot_podpiska_tit">Подпишись на рассылку и плати меньше!</div>
					<div class="gr_foot_podpiska">
						<form>
							<input type="text" placeholder="Ваша электронная почта"/>
							<input type="submit" value=""/>
						</form>
					</div>
				</div>
				<div class="gr_foot_soc_bl">
					<div class="gr_foot_soc_tit">Мы в социальных сетях:</div>
					<div class="foot_new_soc">
						<a class="fb_soc_new" href="https://www.facebook.com/diadaarms" target="_blank"></a>
						<a class="tw_soc_new" href="https://twitter.com/DiadaArms" target="_blank"></a>
						<a class="ok_soc_new" href="https://ok.ru/diadaarms" target="_blank"></a>
						<a class="vk_soc_new" href="http://vk.com/diadaarms" target="_blank"></a>
						<a class="inst_soc_new" href="https://www.instagram.com/diadaarms.ru/" target="_blank"></a>
						<a class="google_soc_new" href="https://plus.google.com/u/0/+diadaarms/posts" target="_blank"></a>
						<a class="you_soc_new" href="https://www.youtube.com/channel/UCpx95geyK5SdesTV82S3ODQ" target="_blank"></a>
					</div>
				</div>
				<div class="gr_foot_app_gplay">
					<div class="gr_foot_soc_tit">Наше приложение:</div>
					<div class="top_foot_mob">
						<a href="https://itunes.apple.com/ru/app/diada-arms/id1317696914?mt=8" target="_blank"><img src="/img/appstory.png" alt=""></a>
						<a href="https://play.google.com/store/apps/details?id=com.loyaltyplant.partner.diadaarms" target="_blank"><img src="/img/googleplay.png" alt=""></a>
					</div>
				</div>
			</div>
			<div class="gr_foot_top_r">
				<a class="gr_foot_call fancy_ajax" href="/include/popup_callback.php"><i class="fa fa-phone" aria-hidden="true"></i>Заказать звонок</a>
				<div class="top_foot_tel" id="telephone_logo">
					<div class="foot_tel_el">
						<i class="fa fa-phone" aria-hidden="true"></i>
						<a href="tel:84952681372">8 (495) 268-13-72</a>
						<span>(Москва)</span>
					</div>
					<div class="foot_tel_el">
						<i class="fa fa-phone" aria-hidden="true"></i>
						<a href="tel:88003330742">8 (800) 333-07-42</a>
						<span>(Регионы России)</span>
					</div>
				</div>
				<div class="gr_foot_info">
					<a class="mail" href="mailto:info@diada-arms.ru">info@diada-arms.ru</a>
					<a class="map" href="">Как добраться?</a>
					<a class="money" href="">Способы оплаты</a>
				</div>
			</div>
		</div>
		<div class="gr_foot_prava_bl">
			<div class="gr_foot_prava_txt">
				<p>Обращаем Ваше внимание на то, что данный Интернет-сайт носит исключительно информационный характер и ни при каких условиях не является публичной офертой, определяемой положениями Статьи 437 Гражданского кодекса Российской Федерации.</p>
				<p>Для получения подробной информации о стоимости и условий продажи товаров, пожалуйста, обращайтесь к менеджерам по продажам магазинов Diada-arms.ru</p>
			</div>
		</div>
	</div>
</footer>


<!-- конец -->

<section>

<div>
<div>

<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>