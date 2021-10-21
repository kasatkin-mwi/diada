<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Diada-arms.ru");

if ($_REQUEST['city'])
	$ELEMENT_ID = $_REQUEST['city'];
else
	$ELEMENT_ID = getContactsElementID();
?>
<link href="contact.css" rel="stylesheet" type="text/css" >
<?/*<link href="font_awesome/css/font-awesome.css" rel="stylesheet" type="text/css" >*/?>
<h1>Контакты</h1>
<div class="cont_top_bl">
	<div class="cont_top_tel_bl">
		<div class="cont_top_tit">Наши телефоны</div>
		<div class="cont_top_tel_list">
			<div class="cont_top_tel_el">
				<a href="tel:+74952681372">+7 (495) 268-13-72</a><span>(Москва)</span>
			</div>
			<div class="cont_top_tel_el">
				<a href="tel:+78123098766">+7 (812) 309-87-66</a><span>(Санкт-Петербург)</span>
			</div>
			<div class="cont_top_tel_el">
				<a href="tel:+77273493214">+7 (727) 349-32-14</a><span>(Алма-Ата)</span>
			</div>
			<div class="cont_top_tel_el">
				<a href="tel:88003330742">8 (800) 333-07-42</a><span>(Регионы России)</span>
			</div>
		</div>
		<a class="cont_top_tel_bt fancy_ajax" href="/include/popup_callback.php">Заказать звонок бесплатно</a>
	</div>
	<div class="cont_top_mail_bl">
		<div class="cont_top_tit">Пишите нам!</div>
		<p>Мы с радостью ответим на Ваши вопросы!</p>
		<div class="cont_mail_skype">
			<a class="mail" href="mailto:info@diada-arms.ru">info@diada-arms.ru</a>
			<a class="skype" href="skype:diada-arms">diada-arms</a>
		</div>
		<div class="foot_new_soc">
			<a class="fb_soc_new" href="https://www.facebook.com/diadaarms" target="_blank"></a>
			<a class="tw_soc_new" href="https://twitter.com/DiadaArms" target="_blank"></a>
			<a class="ok_soc_new" href="https://ok.ru/diadaarms" target="_blank"></a>
			<a class="vk_soc_new" href="http://vk.com/diadaarms" target="_blank"></a>
			<a class="inst_soc_new" href="https://www.instagram.com/diadaarms.ru/" target="_blank"></a>
			<a class="google_soc_new" href="https://plus.google.com/u/0/+diadaarms/posts" target="_blank"></a>
			<a class="you_soc_new" href="https://www.youtube.com/channel/UCpx95geyK5SdesTV82S3ODQ" target="_blank"></a>
		</div>
		<div class="cont_top_mail_txt">
			<p>Прием заказов:</p>
			<ul>
				<li>по телефону: 10.00-20.00 Ежедневно</li>
				<li>через интернет Круглосуточно</li>
			</ul>
		</div>
	</div>
	<div class="cont_top_rek_bl">
		<div class="cont_top_tit">Наши реквизиты</div>
		<div class="cont_top_rek">
			<p>ООО "Эверест"</p>
			<p>ОГРН: 1177746707522</p>
			<p>ИНН: 9701082230</p>
			<p>КПП: 770101001</p>
			<p>Наименование банка: ПАО &nbsp;АКБ «АВАНГАРД»</p>
			<p>Р/С: 40702810000120033929</p>
			<p>Кор. счет: 30101810000000000201</p>
			<p>БИК 044525201</p>
		</div>
	</div>
</div>
<div class="section cont_sect_bl">
	<div class="cont_city_tabs_bl">
		<div class="cont_city_select_bl">
			<div class="cont_city_tit">Выберите свой город из списка</div>
			<div class="cont_city_select">
				<a class="cont_city_select_bt" href="">Ваш город: <b>Москва</b></a>
				<div class="cont_city_select_list">
					<a href="">Москва</a>
					<a href="">Нижний Новгород</a>
					<a href="">Санкт-Петербург</a>
				</div>
			</div>
		</div>
		<div class="cont_tabs_bl">
			<ul class="tabs">
				<li class="list current"><i class="fa fa-list-ul" aria-hidden="true"></i>Показать список</li>
				<li class="map"><i class="fa fa-map-marker" aria-hidden="true"></i>Показать на карте</li>
			</ul>
		</div>
	</div>
	<div class="store_address_bl">
		<div class="store_address_tit_bl">
			<div class="store_addr_tit">Адрес магазина г. Москва</div>
			<div class="store_addr_comm">Уточняйте наличие товара у наших менеджеров <i class="fa fa-exclamation" aria-hidden="true"></i></div>
		</div>
		<div class="store_address_cont">
			<div class="store_address_info">
				<div class="store_address_list">
					<div class="store_address_col">
						<div class="cont_metro_ic" style="background-image:url(/img/cont_metro_ic.png)">м. “Бауманская” (Москва)</div>
						<div class="cont_map_ic"><i class="fa fa-map-marker" aria-hidden="true"></i>г. Москва, ул. Бауманская, д.4</div>
					</div>
					<div class="store_address_col">
						<div class="cont_tel_ic"><i class="fa fa-phone" aria-hidden="true"></i><a href="tel:84952681372">8 (495) 268-13-72</a> (Москва)</div>
						<div class="cont_tel_ic"><i class="fa fa-phone" aria-hidden="true"></i><a href="tel:88003330742">8 (800) 333-07-42</a> (Регионы России)</div>
					</div>
					<div class="store_address_col">
						<div class="cont_clock_ic"><i class="fa fa-clock-o" aria-hidden="true"></i>пн-пт, 09.00-20.00</div>
						<div class="cont_clock_ic"><i class="fa fa-clock-o" aria-hidden="true"></i>сб-вс, 10.00-20.00</div>
					</div>
				</div>
				<div class="store_addr_video_map">
					<div class="store_addr_video"><iframe width="100%" height="245" src="https://www.youtube.com/embed/TYQEX_X4Slk?showinfo=0" frameborder="0" allowfullscreen=""></iframe></div>
					<div class="store_addr_map"><img src="/img/store_addr_map.png" alt=""/></div>
				</div>
			</div>
			<div class="store_address_bt_bl">
				<a href="#HOW_TO_FIND_TEXT" class="fancy">Как найти на словах</a>
				<a href="/upload/iblock/d73/map1.png" class="fancy">Схема проезда</a>
			</div>
		</div>
	</div>
	<div class="box" style="display:block;">
		<div class="store_address_bl">
			<div class="store_address_tit_bl">
				<div class="store_addr_tit">Адрес офиса г. Нижний Новгород</div>
				<div class="store_addr_comm">Уточняйте наличие товара у наших менеджеров <i class="fa fa-exclamation" aria-hidden="true"></i></div>
			</div>
			<div class="store_address_cont">
				<div class="store_address_info">
					<div class="store_addr_video_map">
						<div class="store_addr_video">
							<div class="store_address_gr">
								<div class="cont_metro_ic" style="background-image:url(/img/cont_metro_ic2.png)">м. Московские ворота</div>
								<div class="cont_map_ic"><i class="fa fa-map-marker" aria-hidden="true"></i>Нижний Новгород, Московский район, ул.Чаадаева, д.5д, помещение 44, офис 9</div>
							</div>
							<div class="store_address_gr">
								<div class="cont_tel_ic"><i class="fa fa-phone" aria-hidden="true"></i><a href="tel:88314290570">8 (831) 429-05-70</a> (Нижний Новгород)</div>
								<div class="cont_tel_ic"><i class="fa fa-phone" aria-hidden="true"></i><a href="tel:88003330742">8 (800) 333-07-42</a> (Регионы России)</div>
							</div>
							<div class="store_address_gr">
								<div class="cont_clock_ic"><i class="fa fa-clock-o" aria-hidden="true"></i>10.00-20.00, ежедневно</div>
							</div>
						</div>
						<div class="store_addr_map"><img src="/img/store_addr_map.png" alt=""/></div>
					</div>
				</div>
				<div class="store_address_bt_bl">
					<a href="#HOW_TO_FIND_TEXT" class="fancy">Как найти на словах</a>
					<a href="/upload/iblock/d73/map1.png" class="fancy">Схема проезда</a>
				</div>
			</div>
		</div>
		<div class="store_address_bl">
			<div class="store_address_tit_bl">
				<div class="store_addr_tit">Адреса пунктов выдачи г. Москва</div>
			</div>
			<div class="store_address_cont">
				<div class="store_address_info">
					<div class="store_address_list">
						<div class="store_address_col">
							<div class="cont_map_ic"><i class="fa fa-map-marker" aria-hidden="true"></i>г. Москва, ул. Старокачаловская, д. 1Б, цокольный этаж</div>
						</div>
						<div class="store_address_col">
							<div class="cont_metro_ic" style="background-image:url(/img/cont_metro_ic.png)">м. “Бульвар Дмитрия Донского”</div>
						</div>
						<div class="store_address_col">
							<div class="cont_clock_ic"><i class="fa fa-clock-o" aria-hidden="true"></i>10.00-20.00, ежедневно</div>
						</div>
					</div>
				</div>
				<div class="store_address_bt_bl">
					<a href="#HOW_TO_FIND_TEXT" class="fancy">Как найти на словах</a>
					<a href="/upload/iblock/d73/map1.png" class="fancy">Схема проезда</a>
				</div>
			</div>
			<div class="store_address_cont">
				<div class="store_address_info">
					<div class="store_address_list">
						<div class="store_address_col">
							<div class="cont_map_ic"><i class="fa fa-map-marker" aria-hidden="true"></i>г. Москва, ТЦ «ТЕХНОХОЛЛ Волгоградский», ул. Волгоградский проспект, д. 32 корп. 8, 2 этаж, павильон D54</div>
						</div>
						<div class="store_address_col">
							<div class="cont_metro_ic" style="background-image:url(/img/cont_metro_ic.png)">м. “Волгоградский проспект”</div>
						</div>
						<div class="store_address_col">
							<div class="cont_clock_ic"><i class="fa fa-clock-o" aria-hidden="true"></i>10.00-20.00, ежедневно</div>
						</div>
					</div>
				</div>
				<div class="store_address_bt_bl">
					<a href="#HOW_TO_FIND_TEXT" class="fancy">Как найти на словах</a>
					<a href="/upload/iblock/d73/map1.png" class="fancy">Схема проезда</a>
				</div>
			</div>
			<div class="store_address_cont">
				<div class="store_address_info">
					<div class="store_address_list">
						<div class="store_address_col">
							<div class="cont_map_ic"><i class="fa fa-map-marker" aria-hidden="true"></i>г. Москва, ТЦ «ТЕХНОХОЛЛ Волгоградский», ул. Волгоградский проспект, д. 32 корп. 8, 2 этаж, павильон D54</div>
						</div>
						<div class="store_address_col">
							<div class="cont_metro_ic" style="background-image:url(/img/cont_metro_ic.png)">м. “Волгоградский проспект”</div>
						</div>
						<div class="store_address_col">
							<div class="cont_clock_ic"><i class="fa fa-clock-o" aria-hidden="true"></i>10.00-20.00, ежедневно</div>
						</div>
					</div>
				</div>
				<div class="store_address_bt_bl">
					<a href="#HOW_TO_FIND_TEXT" class="fancy">Как найти на словах</a>
					<a href="/upload/iblock/d73/map1.png" class="fancy">Схема проезда</a>
				</div>
			</div>
		</div>
	</div>
	<div class="box">
		<div class="store_address_bl">
			<div class="store_address_tit_bl">
				<div class="store_addr_tit">Адреса пунктов выдачи г. Москва</div>
			</div>
			<div>
				<img src="/img/store_addr_map_big.png" alt=""/>
			</div>
		</div>
	</div>
	<div class="store_address_tit_bl">
		<div class="store_addr_tit">У Вас есть вопрос? Используйте форму обратной связи! Мы обязательно ответим!</div>
	</div>
	<div class="cont_form_bl">
		<div class="cont_form_tit">Отправьте нам запрос по электронной почте</div>
		<div class="cont_form">
			<form>
				<div class="cont_form_list clear_after">
					<div class="cont_form_el textarea">
						<textarea placeholder="Ваше сообщение"></textarea>
					</div>
					<div class="cont_form_el">
						<input type="text" placeholder="*Имя">
					</div>
					<div class="cont_form_el">
						<input type="email" placeholder="*E-mail">
					</div>
				</div>
				<div class="cont_form_bot">
					<div class="cont_form_captcha">
						<img src="/img/googl_captcha_cont.png" alt=""/>
					</div>
					<label class="ind_subs_prava styler">
						<input type="checkbox">
						<span>Я согласен с условиями обработки <a href="">персональных данных</a></span>
					</label>
					<input class="red_bt" type="submit" value="Отправить">
				</div>
			</form>
		</div>
	</div>
</div>

<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>