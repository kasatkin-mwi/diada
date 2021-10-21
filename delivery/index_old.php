<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Diada-arms.ru");
$APPLICATION->SetAdditionalCSS('/contacts/contact.css');
?>
<script src="//api-maps.yandex.ru/2.0-stable/?load=package.full&lang=ru-RU" type="text/javascript"></script>
<script>
renderRecaptcha = function(elementId) 
{
    if (typeof (grecaptcha) != "undefined") 
    {
        var element = document.getElementById(elementId);

        if(element != undefined && element.childNodes.length == 0) 
        {
            grecaptcha.render(element, {
              'sitekey': '<?=RE_SITE_KEY?>'
           });
        }
     }
}
</script>
<div id="delivery_city">
    <?\Bitrix\Main\Page\Frame::getInstance()->startDynamicWithID("delivery_city");?>
    <?
    if ($_REQUEST['city'])
	    $ELEMENT_ID = $_REQUEST['city'];
    else
	    $ELEMENT_ID = getContactsElementID(23);

    $APPLICATION->IncludeComponent(
	    "bitrix:news.detail",
	    "delivery_new",
	    array(
		    "ACTIVE_DATE_FORMAT" => "d.m.Y",
		    "ADD_ELEMENT_CHAIN" => "N",
		    "ADD_SECTIONS_CHAIN" => "N",
		    "AJAX_MODE" => "N",
		    "AJAX_OPTION_ADDITIONAL" => "",
		    "AJAX_OPTION_HISTORY" => "N",
		    "AJAX_OPTION_JUMP" => "N",
		    "AJAX_OPTION_STYLE" => "Y",
		    "BROWSER_TITLE" => "-",
		    "CACHE_GROUPS" => "N",
		    "CACHE_TIME" => "0",
		    "CACHE_TYPE" => "N",
		    "CHECK_DATES" => "Y",
		    "DETAIL_URL" => "",
		    "DISPLAY_BOTTOM_PAGER" => "N",
		    "DISPLAY_DATE" => "Y",
		    "DISPLAY_NAME" => "Y",
		    "DISPLAY_PICTURE" => "Y",
		    "DISPLAY_PREVIEW_TEXT" => "Y",
		    "DISPLAY_TOP_PAGER" => "N",
		    "ELEMENT_CODE" => "",
		    "ELEMENT_ID" => $ELEMENT_ID,
		    "FIELD_CODE" => array(
			    0 => "",
			    1 => "",
		    ),
		    "IBLOCK_ID" => "23",
		    "IBLOCK_TYPE" => "contacts",
		    "IBLOCK_URL" => "",
		    "INCLUDE_IBLOCK_INTO_CHAIN" => "N",
		    "MESSAGE_404" => "",
		    "META_DESCRIPTION" => "-",
		    "META_KEYWORDS" => "-",
		    "PAGER_BASE_LINK_ENABLE" => "N",
		    "PAGER_SHOW_ALL" => "N",
		    "PAGER_TEMPLATE" => ".default",
		    "PAGER_TITLE" => "Страница",
		    "PROPERTY_CODE" => array(
			    0 => "REGION",
			    1 => "",
		    ),
		    "SET_BROWSER_TITLE" => "N",
		    "SET_CANONICAL_URL" => "N",
		    "SET_LAST_MODIFIED" => "N",
		    "SET_META_DESCRIPTION" => "N",
		    "SET_META_KEYWORDS" => "N",
		    "SET_STATUS_404" => "N",
		    "SET_TITLE" => "N",
		    "SHOW_404" => "N",
		    "USE_PERMISSIONS" => "N",
		    "USE_SHARE" => "N",
		    "COMPONENT_TEMPLATE" => "delivery"
	    ),
	    false
    );
    ?>
    <?
    \Bitrix\Main\Page\Frame::getInstance()->finishDynamicWithID("delivery_city", "Загрузка...");
    ?>
</div>
<?/*
<div class="clear"></div>

			<div class="dostavka_region_title_block js_dostavka_region_title_block">
				<div><a class="dostavka_region_title js_dostavka_region_title" href="">г. Москва и МО</a></div>
				<div class="dostavka_region_title_podskazka">
					Нажмите для выбора региона
					<img class="dostavka_region_title_podskazka_arrow" src="/img/dostavka_region_title_podskazka_arrow.png"/>
				</div>
				<ul class="dostavka_region_title_list_light not_style js_dostavka_region_title_list_light">
					<li><a href="">Москва</a></li>
					<li><a href="">Химки</a></li>
					<li><a href="">Бутово</a></li>
					<li><a href="">Москва</a></li>
					<li><a href="">Химки</a></li>
					<li><a href="">Бутово</a></li>
					<li class="active"><a href="">Москва</a></li>
					<li><a href="">Химки</a></li>
					<li><a href="">Бутово</a></li>
					<li><a href="">Москва</a></li>
					<li><a href="">Химки</a></li>
				</ul>
			</div>
			<div class="section">
				<ul class="tabs dostavka_tabs_block not_style">
					<li class="current"><span class="dostavka_tabs_car">ДОСТАВКА</span></li>
					<li><span class="dostavka_tabs_shop">САМОВЫВОЗ</span></li>
				</ul>
				<div class="box dostavka_box_block" style="display:block;">
					<div class="table_scroll">
						<table class="dostavka_mo_table">
							<tr>
								<th>Зона доставкИ</th>
								<th>ИНТЕРВАЛЫ ДОСТАВКИ</th>
								<th>ТАРИФ НА ДОСТАВКУ <span>мелкогабаритного товара<sup>1</sup></span></th>
								<th>ТАРИФ НА ДОСТАВКУ <span>крупногабаритного товара<sup>2</sup></span></th>
							</tr>
							<tr>
								<td>Доставка в пределах МКАД</td>
								<td>Любой интервал 4 часа <br/>с 10-21 ч. Пн-Сб</td>
								<td>250 руб.</td>
								<td>350 руб.</td>
							</tr>
							<tr>
								<td>Доставка за пределами МКАД</td>
								<td>10-18 ч. Пн-Сб</td>
								<td>250 руб. + 50 руб. за каждые 5 км</td>
								<td>350 руб. + 50 руб. за каждые 5 км</td>
							</tr>
							<tr>
								<td>Доставка в города МО</td>
								<td>10-18 ч. Пн-Сб</td>
								<td>250 руб. + 50 руб. за каждые 5 км</td>
								<td>350 руб. + 50 руб. за каждые 5 км</td>
							</tr>
							<tr>
								<td>Срочная доставка день в день</td>
								<td style="text-align:left;" colspan="3">Возможность выполнения и цену доставки уточняйте у менеджеров по тел. +7(495)268-13-72</td>
							</tr>
						</table>
					</div>
					<div class="dostavka_mo_table_comment">
						<p>1. Мелкогабаритные товары  –  товары весом до 1 кг например: манжеты, банка пуль и т.п.</p>
						<p>2. Крупногабаритные товары  –  например: винтовки, пистолеты, арбалеты, луки, насосы и т.п.</p>
						<p>Доставка осуществляется на следующий день после оформления заказа, при условии, что он был подтвержден операторами интернет-магазина до 20-00 текущего дня.</p>
					</div>
					<div class="dostavka_info_img_block">
						<img src="/img/dostavka_big_img.png" alt=""/>
					</div>
					<div class="dostavka_small_text">
						<p>Если у Вас возникнут вопросы по оформлению заявки, Вы можете обратиться сотрудинку магазина или позвонить по телефону +7  (499) 213-21-02 </p>
						<p>Мы открыты для любых вопросов и предложений по нашему сервису.</p>
					</div>
				</div>
				<div class="box dostavka_box_block">
					<div class="contacts_city_block">
						<p class="h4">Адрес магазина г. Москва</p>
				<p class="red_title"><span>ВНИМАНИЕ!</span> Уточняйте наличие товара у наших менеджеров.</p>
				<div class="element_contacts_city_block">
					<div class="element_contacts_city">
						<div class="element_contacts">
							<p class="metro_title">м. “Красносельская” (Москва)</p>
							<ul class="param_element_contacts">
								<li>Адрес:</li>
								<li class="red_cursor"><a href="">г. Москва, ул. Ольховская, д.22 (вход со двора)</a></li>
							</ul>
							<ul class="param_element_contacts">
								<li>Время работы магазина:</li>
								<li>
									<p>Пн-Пт  10.00-20.00 ч.</p>
									<p>Сб-Вс  11.00-19.00 ч.</p>
								</li>
							</ul>
							<p class="red_title"><span>Как нас найти?</span> Очень просто! Посмотрите видео!</p>
							<div><img src="/img/video1.png"/></div>
							<ul class="dop_shema_proezda">
								<li><a href="">Как найти на словах</a></li>
								<li><a href="">Схема проезда</a></li>
							</ul>
						</div>
					</div>
					<div class="map_element_contacts"><img src="/img/map1.png"/></div>
				</div>
				<p class="h4">Адреса пунктов выдачи г. Москва</p>
				<div class="min_element_contacts_block display_none_m display_none_mp display_none_p">
					<div class="min_element_contacts">
						<div class="element_contacts">
							<p class="metro_title">м. “Красносельская” (Москва)</p>
							<ul class="param_element_contacts">
								<li>Адрес:</li>
								<li class="gray_cursor"><a href="">г. Москва, ул. Ольховская, д.22 (вход со двора)</a></li>
							</ul>
							<ul class="param_element_contacts gray_days">
								<li>Время работы магазина:</li>
								<li>
									<p><span>Пн-Пт</span>  10.00-20.00 ч.</p>
									<p><span>Сб-Вс</span>  11.00-19.00 ч.</p>
								</li>
							</ul>
							<ul class="dop_shema_proezda">
								<li><a href="">Как найти на словах</a></li>
								<li><a href="">Схема проезда</a></li>
							</ul>
						</div>
					</div>
					<div class="min_element_contacts">
						<div class="element_contacts">
							<p class="metro_title">м. “Красносельская” (Москва)</p>
							<ul class="param_element_contacts">
								<li>Адрес:</li>
								<li class="gray_cursor"><a href="">г. Москва, ул. Ольховская, д.22 (вход со двора)</a></li>
							</ul>
							<ul class="param_element_contacts gray_days">
								<li>Время работы магазина:</li>
								<li>
									<p><span>Пн-Пт</span>  10.00-20.00 ч.</p>
									<p><span>Сб-Вс</span>  11.00-19.00 ч.</p>
								</li>
							</ul>
							<ul class="dop_shema_proezda">
								<li><a href="">Как найти на словах</a></li>
								<li><a href="">Схема проезда</a></li>
							</ul>
						</div>
					</div>
					<div class="min_element_contacts">
						<div class="element_contacts">
							<p class="metro_title">м. “Красносельская” (Москва)</p>
							<ul class="param_element_contacts">
								<li>Адрес:</li>
								<li class="gray_cursor"><a href="">г. Москва, ул. Ольховская, д.22 (вход со двора)</a></li>
							</ul>
							<ul class="param_element_contacts gray_days">
								<li>Время работы магазина:</li>
								<li>
									<p><span>Пн-Пт</span>  10.00-20.00 ч.</p>
									<p><span>Сб-Вс</span>  11.00-19.00 ч.</p>
								</li>
							</ul>
							<ul class="dop_shema_proezda">
								<li><a href="">Как найти на словах</a></li>
								<li><a href="">Схема проезда</a></li>
							</ul>
						</div>
					</div>
					<div class="min_element_contacts">
						<div class="element_contacts">
							<p class="metro_title">м. “Красносельская” (Москва)</p>
							<ul class="param_element_contacts">
								<li>Адрес:</li>
								<li class="gray_cursor"><a href="">г. Москва, ул. Ольховская, д.22 (вход со двора)</a></li>
							</ul>
							<ul class="param_element_contacts gray_days">
								<li>Время работы магазина:</li>
								<li>
									<p><span>Пн-Пт</span>  10.00-20.00 ч.</p>
									<p><span>Сб-Вс</span>  11.00-19.00 ч.</p>
								</li>
							</ul>
							<ul class="dop_shema_proezda">
								<li><a href="">Как найти на словах</a></li>
								<li><a href="">Схема проезда</a></li>
							</ul>
						</div>
					</div>
					<div class="min_element_contacts">
						<div class="element_contacts">
							<p class="metro_title">м. “Красносельская” (Москва)</p>
							<ul class="param_element_contacts">
								<li>Адрес:</li>
								<li class="gray_cursor"><a href="">г. Москва, ул. Ольховская, д.22 (вход со двора)</a></li>
							</ul>
							<ul class="param_element_contacts gray_days">
								<li>Время работы магазина:</li>
								<li>
									<p><span>Пн-Пт</span>  10.00-20.00 ч.</p>
									<p><span>Сб-Вс</span>  11.00-19.00 ч.</p>
								</li>
							</ul>
							<ul class="dop_shema_proezda">
								<li><a href="">Как найти на словах</a></li>
								<li><a href="">Схема проезда</a></li>
							</ul>
						</div>
					</div>
					<div class="min_element_contacts">
						<div class="element_contacts">
							<p class="metro_title">м. “Красносельская” (Москва)</p>
							<ul class="param_element_contacts">
								<li>Адрес:</li>
								<li class="gray_cursor"><a href="">г. Москва, ул. Ольховская, д.22 (вход со двора)</a></li>
							</ul>
							<ul class="param_element_contacts gray_days">
								<li>Время работы магазина:</li>
								<li>
									<p><span>Пн-Пт</span>  10.00-20.00 ч.</p>
									<p><span>Сб-Вс</span>  11.00-19.00 ч.</p>
								</li>
							</ul>
							<ul class="dop_shema_proezda">
								<li><a href="">Как найти на словах</a></li>
								<li><a href="">Схема проезда</a></li>
							</ul>
						</div>
					</div>
					<div class="clear"></div>
				</div>
				<div class="big_map display_none_m display_none_mp display_none_p"><img src="/img/map2.png"/></div>
				<div class="js_detail_section_adres contacts_section_adres detail_section_adres display_none_c">
					<ul class="not_style detail_tabs_adres js_detail_tabs_adres">
						<li class="current"><span class="detail_adres_list">Показать списком</span></li>
						<li><span class="detail_adres_map">Показать на карте</span></li>
						<li><span class="detail_adres_shema">Показать на схеме</span></li>
					</ul>
					<div class="js_detail_box_adres detail_box_adres" style="display:block;">
						<div class="detail_table_list_shop_block">
							<table class="detail_table_list_shop">
								<tr class="display_none_m">
									<th>АДРЕС</th>
									<th>Режим работы</th>
									<th></th>
								</tr>
								<tr class="display_none_mp display_none_p display_none_c">
									<th>АДРЕС:</th>
								</tr>
								<tr>
									<td><span class="detail_table_list_shop_metro">Бауманская</span> ул. Бакунинская, д. 69</td>
									<td><span class="display_none_c display_none_p display_none_mp"><b>Режим работы:</b> </span>10:00 - 21:00</td>
									<td><ul class="dop_shema_proezda"><li><a href="">Как найти на словах</a></li><li><a href="">Схема проезда</a></li></ul></td>
								</tr>
								<tr>
									<td><span class="detail_table_list_shop_metro">Войковская</span> Ленинградское ш. д. 25</td>
									<td><span class="display_none_c display_none_p display_none_mp"><b>Режим работы:</b> </span>10:00 - 21:00</td>
									<td><ul class="dop_shema_proezda"><li><a href="">Как найти на словах</a></li><li><a href="">Схема проезда</a></li></ul></td>
								</tr>
								<tr>
									<td><span class="detail_table_list_shop_metro">Бауманская</span> ул. Бакунинская, д. 69</td>
									<td><span class="display_none_c display_none_p display_none_mp"><b>Режим работы:</b> </span>10:00 - 21:00</td>
									<td><ul class="dop_shema_proezda"><li><a href="">Как найти на словах</a></li><li><a href="">Схема проезда</a></li></ul></td>
								</tr>
								<tr>
									<td><span class="detail_table_list_shop_metro">Войковская</span> Ленинградское ш. д. 25</td>
									<td><span class="display_none_c display_none_p display_none_mp"><b>Режим работы:</b> </span>10:00 - 21:00</td>
									<td><ul class="dop_shema_proezda"><li><a href="">Как найти на словах</a></li><li><a href="">Схема проезда</a></li></ul></td>
								</tr>
								<tr>
									<td><span class="detail_table_list_shop_metro">Бауманская</span> ул. Бакунинская, д. 69</td>
									<td><span class="display_none_c display_none_p display_none_mp"><b>Режим работы:</b> </span>10:00 - 21:00</td>
									<td><ul class="dop_shema_proezda"><li><a href="">Как найти на словах</a></li><li><a href="">Схема проезда</a></li></ul></td>
								</tr>
								<tr>
									<td><span class="detail_table_list_shop_metro">Войковская</span> Ленинградское ш. д. 25</td>
									<td><span class="display_none_c display_none_p display_none_mp"><b>Режим работы:</b> </span>10:00 - 21:00</td>
									<td><ul class="dop_shema_proezda"><li><a href="">Как найти на словах</a></li><li><a href="">Схема проезда</a></li></ul></td>
								</tr>
								<tr>
									<td><span class="detail_table_list_shop_metro">Бауманская</span> ул. Бакунинская, д. 69</td>
									<td><span class="display_none_c display_none_p display_none_mp"><b>Режим работы:</b> </span>10:00 - 21:00</td>
									<td><ul class="dop_shema_proezda"><li><a href="">Как найти на словах</a></li><li><a href="">Схема проезда</a></li></ul></td>
								</tr>
								<tr>
									<td><span class="detail_table_list_shop_metro">Войковская</span> Ленинградское ш. д. 25</td>
									<td><span class="display_none_c display_none_p display_none_mp"><b>Режим работы:</b> </span>10:00 - 21:00</td>
									<td><ul class="dop_shema_proezda"><li><a href="">Как найти на словах</a></li><li><a href="">Схема проезда</a></li></ul></td>
								</tr>
								<tr>
									<td><span class="detail_table_list_shop_metro">Бауманская</span> ул. Бакунинская, д. 69</td>
									<td><span class="display_none_c display_none_p display_none_mp"><b>Режим работы:</b> </span>10:00 - 21:00</td>
									<td><ul class="dop_shema_proezda"><li><a href="">Как найти на словах</a></li><li><a href="">Схема проезда</a></li></ul></td>
								</tr>
								<tr>
									<td><span class="detail_table_list_shop_metro">Войковская</span> Ленинградское ш. д. 25</td>
									<td><span class="display_none_c display_none_p display_none_mp"><b>Режим работы:</b> </span>10:00 - 21:00</td>
									<td><ul class="dop_shema_proezda"><li><a href="">Как найти на словах</a></li><li><a href="">Схема проезда</a></li></ul></td>
								</tr>
								<tr>
									<td><span class="detail_table_list_shop_metro">Бауманская</span> ул. Бакунинская, д. 69</td>
									<td><span class="display_none_c display_none_p display_none_mp"><b>Режим работы:</b> </span>10:00 - 21:00</td>
									<td><ul class="dop_shema_proezda"><li><a href="">Как найти на словах</a></li><li><a href="">Схема проезда</a></li></ul></td>
								</tr>
								<tr>
									<td><span class="detail_table_list_shop_metro">Войковская</span> Ленинградское ш. д. 25</td>
									<td><span class="display_none_c display_none_p display_none_mp"><b>Режим работы:</b> </span>10:00 - 21:00</td>
									<td><ul class="dop_shema_proezda"><li><a href="">Как найти на словах</a></li><li><a href="">Схема проезда</a></li></ul></td>
								</tr>
								<tr>
									<td><span class="detail_table_list_shop_metro">Бауманская</span> ул. Бакунинская, д. 69</td>
									<td><span class="display_none_c display_none_p display_none_mp"><b>Режим работы:</b> </span>10:00 - 21:00</td>
									<td><ul class="dop_shema_proezda"><li><a href="">Как найти на словах</a></li><li><a href="">Схема проезда</a></li></ul></td>
								</tr>
								<tr>
									<td><span class="detail_table_list_shop_metro">Войковская</span> Ленинградское ш. д. 25</td>
									<td><span class="display_none_c display_none_p display_none_mp"><b>Режим работы:</b> </span>10:00 - 21:00</td>
									<td><ul class="dop_shema_proezda"><li><a href="">Как найти на словах</a></li><li><a href="">Схема проезда</a></li></ul></td>
								</tr>
							</table>
						</div>
						<ul class="not_style detail_navigation_block">
							<li>Показано: 15 из 34</li>
							<li>
								<div class="catalog_page_navigator">
									<!--<a href=""><span><img src="/img/navigator_left_arrow.png" alt=""/></span></a>-->
									<a class="active" href=""><span>1</span></a>
									<a href=""><span>2</span></a>
									<a href=""><span>3</span></a>
									<a href=""><span><img src="/img/navigator_right_arrow.png" alt=""></span></a>
								</div>
							</li>
							<li><a class="gray_button" href="">Показать все</a></li>
						</ul>
					</div>
					<div class="js_detail_box_adres detail_box_adres">
						<img width="100%" src="/img/detail_map.png" alt=""/>
					</div>
					<div class="js_detail_box_adres detail_box_adres">
						<img width="100%" src="/img/detail_map.png" alt=""/>
					</div>
				</div>
				<p class="h4">У Вас есть вопрос? Используйте форму обратной связи! Мы обязательно ответим!</p>
				<div class="questions_form">
					<form>
						<p>Вы можете отправить нам запрос по электронной почте</p>
						<ul class="not_style">
							<li>Ваше имя:</li>
							<li><input type="text"/></li>
						</ul>
						<ul class="not_style">
							<li>Ваш e-mail:</li>
							<li><input type="text"/></li>
						</ul>
						<ul class="not_style">
							<li>Вашe сообщение:</li>
							<li><textarea></textarea></li>
						</ul>
						<input class="red_submit" type="submit" value="Отправить"/>
					</form>
				</div>
					</div>
				</div>
			</div>*/?>

<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>