<?
if (preg_match("/^WordPress(.*)/",$_SERVER["HTTP_USER_AGENT"])){
    die();
}
//require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
//global $APPLICATION;

//$APPLICATION->RestartBuffer();
header("HTTP/1.1 202 Accepted");


exit();
?>
<link href="/css/new_header_style.css" rel="stylesheet" type="text/css" >
<style>
	.content {display:none;}
</style>
</div>
</div>
</section>

<header>
	<div class="head_red_bl">
		<div class="standart_width clear_after">
			<div id="mobile_header_geo_block">
				<?
				$frame = new \Bitrix\Main\Page\FrameBuffered("mobile_header_geo_block");
				$frame->begin();
					?>
					<?$APPLICATION->IncludeComponent(
						"bitrix:main.include",
						"",
						Array(
							"AREA_FILE_SHOW" => "file",
							"AREA_FILE_SUFFIX" => "inc",
							"EDIT_TEMPLATE" => "",
							"PATH" => "/include/inc_geo_head.php"
						)
					);?>
					<?
				$frame->beginStub();
					?>
					<div class="mobile_header_geo_block">
						<a class="mobile_header_geo js_mobile_header_geo" href=""><span>...</span></a>
						<div class="header_geo_light" style="display: block;">
							<div class="header_geo_light_title">Ваш регион: <span>...</span> ?</div>
							<div class="header_geo_light_button">
								<a class="geo_gray_button" href=""><span>Да</span></a>
								<a class="geo_red_button fancy_ajax" href="/include/popup_geo.php"><span>Выбрать<br/>другой город</span></a>
							</div>
						</div>
					</div>
					<?
				$frame->end();
				?>
				
				<?/*\Bitrix\Main\Page\Frame::getInstance()->startDynamicWithID("mobile_header_geo_block");?>
				<?$APPLICATION->IncludeComponent(
					"bitrix:main.include",
					"",
					Array(
						"AREA_FILE_SHOW" => "file",
						"AREA_FILE_SUFFIX" => "inc",
						"EDIT_TEMPLATE" => "",
						"PATH" => "/include/inc_geo_head.php"
					)
				);?>
				<?\Bitrix\Main\Page\Frame::getInstance()->finishDynamicWithID("mobile_header_geo_block", "Загрузка...");*/?>
			</div>
			<div class="head_red_menu_bl">
				<ul class="head_red_menu">
					<li>
						<a class="head_red_menu_lvl1_bt" href=""><span>Покупателям</span></a>
						<div class="head_red_menu_lvl2">
							<a href="">О магазине</a>
							<a href="">Доставка</a>
							<a href="">Услуги</a>
							<a href="">Кредит</a>
							<a href="">Помощь</a>
							<a href="">Гарантия</a>
						</div>
					</li>
					<li><a href=""><span>Контакты</span></a></li>
					<li><a href=""><span>Отзывы</span></a></li>
					<li><a href=""><span>Опт</span></a></li>
					<li><a href=""><span>Новости и статьи</span></a></li>
				</ul>
			</div>
			<div class="head_red_avtoriz">
						<a href="/auth/">Вход</a>
						<span>|</span>
						<a href="/auth/reg/">Регистрация</a>
				<?\Bitrix\Main\Page\Frame::getInstance()->startDynamicWithID("header_vhod");?>
					<?if (!$USER->IsAuthorized()):?>
						<a href="/auth/">Вход</a>
						<span>|</span>
						<a href="/auth/reg/">Регистрация</a>
					<?endif;?>
				<?
				\Bitrix\Main\Page\Frame::getInstance()->finishDynamicWithID("header_vhod", "");
				?>
			</div>
		</div>
	</div>
	<div class="head_white_bl">
		<div class="standart_width clear_after">
			<div class="head_info_bl">
				<p class="telephone_logo_title">интернет-магазин товаров для охоты</p>
				<a class="head_info_logo" href="/"><img src="/img/logo.png"/></a>
				<meta itemprop="name" content="Diada-Arms">
				<meta itemprop="url" content="https://www.diada-arms.ru<?=$_SERVER['REQUEST_URI'];?>">
				<div id="telephone_logo_head">
					<?
					$frame = new \Bitrix\Main\Page\FrameBuffered("telephone_logo_head");
					$frame->begin();
					?>
					<?//\Bitrix\Main\Page\Frame::getInstance()->startDynamicWithID("telephone_logo_head");?>
						<?$APPLICATION->IncludeComponent(
							"bitrix:news.detail",
							"contacts_phones_head",
							Array(
								"ACTIVE_DATE_FORMAT" => "d.m.Y",
								"ADD_ELEMENT_CHAIN" => "N",
								"ADD_SECTIONS_CHAIN" => "N",
								"AJAX_MODE" => "N",
								"AJAX_OPTION_ADDITIONAL" => "",
								"AJAX_OPTION_HISTORY" => "N",
								"AJAX_OPTION_JUMP" => "N",
								"AJAX_OPTION_STYLE" => "Y",
								"BROWSER_TITLE" => "-",
								"CACHE_GROUPS" => "Y",
								"CACHE_TIME" => "36000000",
								"CACHE_TYPE" => "A",
								"CHECK_DATES" => "Y",
								"DETAIL_URL" => "",
								"DISPLAY_BOTTOM_PAGER" => "N",
								"DISPLAY_DATE" => "Y",
								"DISPLAY_NAME" => "Y",
								"DISPLAY_PICTURE" => "Y",
								"DISPLAY_PREVIEW_TEXT" => "Y",
								"DISPLAY_TOP_PAGER" => "N",
								"ELEMENT_CODE" => "",
								"ELEMENT_ID" => getContactsElementID(22),
								"FIELD_CODE" => array("",""),
								"IBLOCK_ID" => "22",
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
								"PROPERTY_CODE" => array("REGION",""),
								"SET_BROWSER_TITLE" => "N",
								"SET_CANONICAL_URL" => "N",
								"SET_LAST_MODIFIED" => "N",
								"SET_META_DESCRIPTION" => "N",
								"SET_META_KEYWORDS" => "N",
								"SET_STATUS_404" => "N",
								"SET_TITLE" => "N",
								"SHOW_404" => "N",
								"USE_PERMISSIONS" => "N",
								"USE_SHARE" => "N"
							)
						);?>
					<?//\Bitrix\Main\Page\Frame::getInstance()->finishDynamicWithID("telephone_logo_head", "Загрузка...");?>
					<?$frame->beginStub();?>
						<p><span>8 (495) 268-13-72 </span>(Москва)</p>
						<p><span>8 (800) 333-07-42 </span>(Регионы РФ)</p>
					<?$frame->end();?>
				</div>
				<p><a class="call_back fancy_ajax" href="/include/popup_callback.php">Заказать звонок бесплатно</a></p>
			</div>
			<div class="firearm_bl">
				<div class="firearm">
					<?$APPLICATION->IncludeComponent(
						"bitrix:main.include",
						"",
						Array(
							"AREA_FILE_SHOW" => "file",
							"AREA_FILE_SUFFIX" => "inc",
							"EDIT_TEMPLATE" => "",
							"PATH" => "/include/inc_firearm.php"
						)
					);?>
				</div>
			</div>
			<div class="head_white_bt_bl">
				<div class="head_white_status"><a href="/status-zakaza/">Статус заказа</a></div>
				<div class="head_white_basket">
					<a href="" class="head_white_basket_ic red">
						<span>87</span>
					</a>
					<div class="head_white_basket_price"><span>337 894</span> руб.</div>
					<a class="head_white_basket_bt" href="">Оформить заказ</a>
				</div>
				<div class="head_white_battle">
					<a href="">
						<span class="head_white_battle_ic">
							<span>0</span>
						</span>
						<span class="head_white_battle_tit">Сраванение</span>
					</a>
				</div>
				<div class="head_white_favorite">
					<a href="">
						<span class="head_white_favorite_ic">
							<span>0</span>
						</span>
						<span class="head_white_favorite_tit">Избранное</span>
					</a>
				</div>
			</div>
		</div>
	</div>
</header>
<section>

<div>
<div>

<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>