<?
if (preg_match("/^WordPress(.*)/",$_SERVER["HTTP_USER_AGENT"])){
    die();
}
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Diada-arms.ru");
?>
</div></div></section>
<footer>
	<div class="foot_bl standart_width">
		<div class="top_foot_bl">
			<div class="top_foot_logo">
				<div class="top_foot_logo_title">интернет-магазин товаров для охоты</div>
				<a class="foot_logo_el" href="/"><img src="/img/logo_footer.png"></a>
				<a class="call_back fancy_ajax" href="/include/popup_callback.php">Заказать звонок бесплатно</a>
			</div>
			<div class="top_foot_cont">
				<div class="top_foot_time">Ежедневно: 10:00 - 20:00</div>
				<div class="top_foot_tel">
					<div class="foot_tel_el">
						<a href="tel:+74952681372">8 (495) 268-13-72</a>
						<span>(МСК)</span>
					</div>
					<div class="foot_tel_el">
						<a href="tel:+78123098766">8 (812) 309-87-66</a>
						<span>(СПБ)</span>
					</div>
					<div class="foot_tel_el">
						<a href="tel:+78003330742">8 (800) 333-07-42</a>
						<span>(РФ)</span>
					</div>
				</div>
			</div>
			<div class="top_foot_nav">
				<a class="top_foot_geo" href="/contacts/">Как добраться?</a>
				<a class="top_foot_price" href="/oplata/">Способы оплаты</a>
				<a class="top_foot_mail" href="mailto:info@diada-arms.ru">info@diada-arms.ru</a>
			</div>
			<div class="top_foot_soc">
				<div class="foot_new_soc">
					<a class="fb_soc_new" href="https://www.facebook.com/diadaarms" target="_blank"></a>
					<a class="tw_soc_new" href="https://twitter.com/DiadaArms" target="_blank"></a>
					<a class="ok_soc_new" href="https://ok.ru/diadaarms" target="_blank"></a>
					<a class="vk_soc_new" href="http://vk.com/diadaarms" target="_blank"></a>
					<a class="inst_soc_new" href="https://www.instagram.com/diadaarms/" target="_blank"></a>
					<a class="google_soc_new" href="https://plus.google.com/u/0/+diadaarms/posts" target="_blank"></a>
					<a class="you_soc_new" href="https://www.youtube.com/channel/UCpx95geyK5SdesTV82S3ODQ" target="_blank"></a>
				</div>
				<div class="top_foot_mob">
					<a href="https://itunes.apple.com/ru/app/diada-arms/id1317696914?mt=8" target="_blank"><img src="/img/appstory.png" alt=""/></a>
					<a href="https://itunes.apple.com/ru/app/diada-arms/id1317696914?mt=8" target="_blank"><img src="/img/googleplay.png" alt=""/></a>
				</div>
			</div>
		</div>
		<div class="footer_prava">
			<p>© 2010-2018 Интернет-магазин www.diada-arms.ru - товары для охоты, спорта и отдыха. <a href="/sitemap.php">Карта сайта</a></p>
			<p>Обращаем Ваше внимание на то, что данный Интернет-сайт носит исключительно информационный характер и ни при каких условиях не является публичной офертой,
			определяемой положениями Статьи 437 Гражданского кодекса Российской Федерации.</p>
			<p>Для получения подробной информации о стоимости и условий продажи товаров, пожалуйста, обращайтесь к менеджерам по продажам магазинов Diada-arms.ru</p>
		</div>
	</div>
</footer>
<section><div><div>
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>