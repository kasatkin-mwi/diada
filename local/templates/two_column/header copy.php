<!DOCTYPE html>
<html>

<head>
		<?php
if (file_exists($_SERVER['DOCUMENT_ROOT'] . '/d-robots.php')) {
    include_once ($_SERVER['DOCUMENT_ROOT'] . '/d-robots.php');
	$oRobots = new RobotsTxtParser(file_get_contents($_SERVER['DOCUMENT_ROOT'] . '/robots.txt'));
	$noindex = $oRobots->isDisallowed($_SERVER['REQUEST_URI']) ? '<meta name="googlebot" content="noindex">' . PHP_EOL : '';
}
echo $noindex;
?>
	<title><?$APPLICATION->ShowTitle()?></title>
	<?$APPLICATION->ShowHead()?>
	<?/* <meta name="viewport" content="width=device-width, initial-scale=1"> */?>
	<?/**/?><? if (isset($_COOKIE['mob']) and $_COOKIE['mob']=="no") { ?>
		<meta name=viewport content="width=1250, initial-scale=1">
	<? } else { ?>
	<meta name=viewport content="width=device-width, initial-scale=1">
	<? } ?>


	<?$APPLICATION->SetAdditionalCSS('/css/reset.css');?>
	<?$APPLICATION->SetAdditionalCSS('/css/style.css');?>
	<?$APPLICATION->SetAdditionalCSS('/css/style_500.css');?>
	<?$APPLICATION->SetAdditionalCSS('/css/style_500_800.css');?>
	<?$APPLICATION->SetAdditionalCSS('/css/style_799.css');?>
	<?$APPLICATION->SetAdditionalCSS('/css/style_800.css');?>
	<?$APPLICATION->SetAdditionalCSS('/css/style_800_1000.css');?>
	<?$APPLICATION->SetAdditionalCSS('/css/style_1000.css');?>
	<?$APPLICATION->SetAdditionalCSS('/css/style_filter.css');?>
	<?$APPLICATION->SetAdditionalCSS('/font/font.css');?>
	<?$APPLICATION->SetAdditionalCSS('/css/jquery.formstyler.css');?>
	<?$APPLICATION->SetAdditionalCSS('/css/jquery.fancybox.css');?>
	<?$APPLICATION->SetAdditionalCSS('/css/jquery.bxslider.css');?>
	<?$APPLICATION->SetAdditionalCSS('/css/main.css');?>
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.13/css/all.css" integrity="sha384-DNOHZ68U8hZfKXOrtjWvjxusGo9WQnrNx2sqG0tfsghAvtVlRW3tvkXWZh58N9jp" crossorigin="anonymous">

	<?$APPLICATION->AddHeadScript('/js/jquery-1.8.3.min.js');?>
    <?$APPLICATION->AddHeadScript('/js/myswipe.js');?>
	<?$APPLICATION->AddHeadScript('/js/main.js');?>
	<?$APPLICATION->AddHeadScript('/js/tabs.js');?>
	<?$APPLICATION->AddHeadScript('/js/jquery.cookie.js');?>
	<?$APPLICATION->AddHeadScript('/js/jquery.fancybox.pack.js');?>
	<?$APPLICATION->AddHeadScript('/js/jquery.bxslider.min.js');?>
	<?$APPLICATION->AddHeadScript('/js/jquery.formstyler.min.js');?>
	<?$APPLICATION->AddHeadScript('/js/jquery.lwtCountdown-1.0.js');?>
	<?$APPLICATION->AddHeadScript('/js/misc.js');?>
    <?$APPLICATION->AddHeadScript("//www.google.com/recaptcha/api.js");?>

    <?$curPage = $APPLICATION->GetCurPage();?>
    <?$isIndex = $curPage == "/index.php";?>
    <?global $USER;?>
    <script>
        (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
            (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
            m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
        })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

        ga('create', 'UA-54963341-1', 'auto');
        ga('send', 'pageview');
    </script>

    <!-- Yandex.Metrika counter -->
    <script type="text/javascript">
        (function (d, w, c) {
            (w[c] = w[c] || []).push(function() {
                try {
                    w.yaCounter25448447 = new Ya.Metrika({
                        id:25448447,
                        clickmap:true,
                        trackLinks:true,
                        accurateTrackBounce:true,
                        webvisor:true,
                        ecommerce:"dataLayer"
                    });
                } catch(e) { }
            });

            var n = d.getElementsByTagName("script")[0],
                s = d.createElement("script"),
                f = function () { n.parentNode.insertBefore(s, n); };
            s.type = "text/javascript";
            s.async = true;
            s.src = "https://mc.yandex.ru/metrika/watch.js";

            if (w.opera == "[object Opera]") {
                d.addEventListener("DOMContentLoaded", f, false);
            } else { f(); }
        })(document, window, "yandex_metrika_callbacks");
    </script>
    <noscript><div><img src="https://mc.yandex.ru/watch/25448447" style="position:absolute; left:-9999px;" alt="" /></div></noscript>
    <!-- /Yandex.Metrika counter -->

    <script type="text/javascript">
        var __cs = __cs || [];
        __cs.push(["setAccount", "6egTDId_bNlOKny3R2uZoMHvfnUfqiav"]);
        __cs.push(["setHost", "//server.comagic.ru/comagic"]);
    </script>
    <script type="text/javascript" async src="//app.comagic.ru/static/cs.min.js"></script>

    <meta name="google-site-verification" content="rrJVvYFVDNV1S7ECaEsSEj-QyJCFzRwMV_ddnxHIPZQ" />
    <meta name="yandex-verification" content="034d75b083d3513f" />
    <meta name="yandex-verification" content="624dbb3906b574d7" />
    <!-- BEGIN JIVOSITE CODE -->
    <script type='text/javascript'>
        (function(){ var widget_id = 'QEPLc3GjAx';
            var s = document.createElement('script'); s.type = 'text/javascript'; s.async = true; s.src = '//code.jivosite.com/script/widget/'+widget_id; var ss = document.getElementsByTagName('script')[0]; ss.parentNode.insertBefore(s, ss);})();</script>
    <!-- END JIVOSITE CODE -->
</head>
<body>
    <?if (!in_array($_REQUEST["hpanel"],array("Y","y","yes"))):?>
	    <div id="panel"><?$APPLICATION->ShowPanel();?></div>
    <?endif;?>       
    
	<div class="wrap_cont">
	<div class="display_none_c">
		<div class="mobile_left_menu_light js_catalog_mobile_menu_light">
			<div class="mobile_left_menu_light_scroll">
				<ul class="mobile_left_menu_vhod">
					<li><a href="/auth/">Вход с паролем</a></li>
					<li> | </li>
					<li><a href="/auth/reg/">Регистрация</a></li>
				</ul>
				<div>
                    <div id="user-location">
                        <?
                        $frame = new \Bitrix\Main\Page\FrameBuffered("user-location");
                        $frame->begin();
                            ?>
                            <?$locationUser = getUserLocation();?>
                            <a class="menu_lvl1_button mobile_menu_geo_button js_menu_lvl1_button" href="javascript:void(0);">
                                <span>
                                    <b>Город</b><span><?=$locationUser?></span>
                                </span>
                            </a>
                            <?
                        $frame->beginStub();
                            ?>
                            <a class="menu_lvl1_button mobile_menu_geo_button js_menu_lvl1_button" href="javascript:void(0);">
                                <span>
                                    <b>Город</b><span>Москва</span>
                                </span>
                            </a>
                            <?
                        $frame->end();
                        ?>
                        <?/*\Bitrix\Main\Page\Frame::getInstance()->startDynamicWithID("user-location");?>
                            <?$locationUser = getUserLocation();?>
					        <a class="menu_lvl1_button mobile_menu_geo_button js_menu_lvl1_button" href="javascript:void(0);">
						        <span>
							        <b>Город</b><span><?=$locationUser?></span>
						        </span>
					        </a>
                        <?
                        \Bitrix\Main\Page\Frame::getInstance()->finishDynamicWithID("user-location", "Загрузка...");
                        */?>
                        <div class="mobile_menu_geo js_menu_lvl2">
                            <div class="mobile_catalog_menu_come_back js_mobile_catalog_menu_come_back"><a href="">Назад</a></div>
                            <div class="">
                                <div id="mobile_menu_geo">
                                    <?\Bitrix\Main\Page\Frame::getInstance()->startDynamicWithID("mobile_menu_geo");?>
                                    <?$APPLICATION->IncludeComponent(
                                        "bitrix:sale.location.selector.search",
                                        "select_city_menu",
                                        Array(
                                            "CACHE_TIME" => "36000000",
                                            "CACHE_TYPE" => "A",
                                            "CODE" => "",
                                            "FILTER_BY_SITE" => "N",
                                            "ID" => "",
                                            "INITIALIZE_BY_GLOBAL_EVENT" => "",
                                            "INPUT_NAME" => "LOCATION",
                                            "JS_CALLBACK" => "selectCity",
                                            "JS_CONTROL_GLOBAL_ID" => "",
                                            "PROVIDE_LINK_BY" => "id",
                                            "SHOW_DEFAULT_LOCATIONS" => "N",
                                            "SUPPRESS_ERRORS" => "N"
                                        )
                                    );?>
                                    <?
                                    \Bitrix\Main\Page\Frame::getInstance()->finishDynamicWithID("mobile_menu_geo", "Загрузка...");
                                    ?>
                                </div>
                            </div>
                        </div>
                    </div>
				</div>
				<?$APPLICATION->IncludeComponent(
					"bitrix:menu",
					"left.mobile",
					Array(
						"ALLOW_MULTI_SELECT" => "N",
						"CHILD_MENU_TYPE" => "left_mobile",
						"DELAY" => "N",
						"MAX_LEVEL" => "4",
						"MENU_CACHE_TIME" => "3600",
                        "MENU_CACHE_TYPE" => "A",
						"MENU_CACHE_USE_GROUPS" => "N",
						"ROOT_MENU_TYPE" => "top_mobile",
						"USE_EXT" => "Y",
                        "CACHE_SELECTED_ITEMS" => "N"
					)
				);?>
			</div>
		</div>
	</div>
		<header>
			<div class="display_none_p display_none_mp display_none_m">
				<div class="top_header_block">
					<div class="top_header">
						<?$APPLICATION->IncludeComponent(
							"bitrix:menu",
							"top",
							Array(
								"ALLOW_MULTI_SELECT" => "N",
								"CHILD_MENU_TYPE" => "left",
								"DELAY" => "N",
								"MAX_LEVEL" => "1",
								"MENU_CACHE_TIME" => "3600",
                                "MENU_CACHE_TYPE" => "A",
								"MENU_CACHE_USE_GROUPS" => "N",
								"ROOT_MENU_TYPE" => "top",
								"USE_EXT" => "N",
                                "CACHE_SELECTED_ITEMS" => "N"
							)
						);?>
						<div class="basket" id="basket">
                            <?\Bitrix\Main\Page\Frame::getInstance()->startDynamicWithID("basket");?>
							<?$APPLICATION->IncludeComponent(
								"bitrix:sale.basket.basket.small",
								"head",
								Array(
									"PATH_TO_BASKET" => "/personal/cart/",
									"PATH_TO_ORDER" => "/personal/order/",
									"SHOW_DELAY" => "N",
									"SHOW_NOTAVAIL" => "N",
									"SHOW_SUBSCRIBE" => "N"
								)
							);?>
                            <?
                            \Bitrix\Main\Page\Frame::getInstance()->finishDynamicWithID("basket", "Загрузка...");
                            ?>
						</div>
						<div class="clear"></div>
						<div id="header_vhod">
                            <?\Bitrix\Main\Page\Frame::getInstance()->startDynamicWithID("header_vhod");?>
                                <?if (!$USER->IsAuthorized()):?>
							        <ul class="header_vhod">
								        <li><a href="/auth/">Вход с паролем</a></li>
								        <li> | </li>
								        <li><a href="/auth/reg/">Регистрация</a></li>
							        </ul>
						        <?endif;?>
                            <?
                            \Bitrix\Main\Page\Frame::getInstance()->finishDynamicWithID("header_vhod", "");
                            ?>
							<a class="header_status_bt" href="/status-zakaza/">Статус заказа</a>
                        </div>
					</div>
				</div>
				<div class="telephone_firearm">
					<div class="telephone_logo">
						<p class="telephone_logo_title">интернет-магазин товаров для охоты</p>
						<a href="/"><img src="/img/logo.png"/></a>
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
                                <p><span>8 (812) 309-87-66 </span>(Санкт-Петербург)</p>
                                <p><span>8 (800) 333-07-42 </span>(Регионы России)</p>
                            <?$frame->end();?>
                        </div>
						<p><a class="call_back fancy_ajax" href="/include/popup_callback.php">Заказать звонок бесплатно</a></p>
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
                                    <a class="mobile_header_geo js_mobile_header_geo" href=""><span>Москва</span></a>
                                    <div class="header_geo_light" style="display: block;">
                                        <div class="header_geo_light_title">Ваш регион: <span>Москва</span> ?</div>
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
					</div>
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
					<a class="header_red_comment" href="/otziv/"><img src="/img/header_red_comment.png"/><img class="header_red_comment_hover" src="/img/header_red_comment_hover.png"/></a>
				</div>
				<div class="bottom_header_menu_block">
					<div class="bottom_header_menu">
						<div class="catalog_produce <?if ($isIndex):?>index_catalog_produce<?endif;?>"> <!-- акции -->
							<a href="/catalog/" class="catalog_menu_button">
								<span>КАТАЛОГ ТОВАРОВ</span>
							</a>
                                <?// Взял меню из одноколоночного шаблона, исходную закомментил. Просили сделать выпадайку, Задача № 11969?>
    							<?/*$APPLICATION->IncludeComponent(
    								"bitrix:menu",
    								"left",
    								Array(
    									"ALLOW_MULTI_SELECT" => "N",
    									"CHILD_MENU_TYPE" => "left",
    									"DELAY" => "N",
    									"MAX_LEVEL" => "3",
    									"MENU_CACHE_TIME" => 360000,
                                        "MENU_CACHE_TYPE" => "A",
    									"MENU_CACHE_USE_GROUPS" => "N",
    									"ROOT_MENU_TYPE" => "left",
    									"USE_EXT" => "Y",
                                        "CACHE_SELECTED_ITEMS" => "N"
    								)
    							);*/?>
                                <?$APPLICATION->IncludeComponent(
                                    "bitrix:menu",
                                    "left",
                                    Array(
                                        "ALLOW_MULTI_SELECT" => "N",
                                        "CHILD_MENU_TYPE" => "left",
                                        "DELAY" => "N",
                                        "MAX_LEVEL" => "3",
                                        "MENU_CACHE_TIME" => 360000,
                                        "MENU_CACHE_TYPE" => "Y",
                                        "MENU_CACHE_USE_GROUPS" => "N",
                                        //"ROOT_MENU_TYPE" => "left",
                                        "ROOT_MENU_TYPE" => "top_mobile",
                                        "USE_EXT" => "Y",
                                        "CACHE_SELECTED_ITEMS" => "N"
                                    )
                                );?>
						</div>
						<div class="red_search js_red_search">
							<?$APPLICATION->IncludeComponent(
								"salavey:search.title",
								"",
								array(
									"CATEGORY_0" => array(
									),
									"CATEGORY_0_TITLE" => "",
									"CHECK_DATES" => "N",
									"CONTAINER_ID" => "title-search",
									"INPUT_ID" => "title-search-input",
									"NUM_CATEGORIES" => "1",
									"ORDER" => "date",
									"PAGE" => "#SITE_DIR#search/index.php",
									"SHOW_INPUT" => "Y",
									"SHOW_OTHERS" => "N",
									"TOP_COUNT" => "5",
									"USE_LANGUAGE_GUESS" => "Y",
									"COMPONENT_TEMPLATE" => "head",
									"PRICE_CODE" => "",
									"PRICE_VAT_INCLUDE" => "Y",
									"PREVIEW_TRUNCATE_LEN" => "",
									"SHOW_PREVIEW" => "Y",
									"CONVERT_CURRENCY" => "N"
								),
								false
							);?>
						</div>
						<div class="bottom_menu">
							<ul>
								<li class="bottom_menu1">
									<?$APPLICATION->IncludeComponent(
										"bitrix:main.include",
										"",
										Array(
											"AREA_FILE_SHOW" => "file",
											"AREA_FILE_SUFFIX" => "inc",
											"EDIT_TEMPLATE" => "",
											"PATH" => "/include/inc_grafik.php"
										)
									);?>
								</li>
								<li class="bottom_menu2">
									<?$APPLICATION->IncludeComponent(
										"bitrix:main.include",
										"",
										Array(
											"AREA_FILE_SHOW" => "file",
											"AREA_FILE_SUFFIX" => "inc",
											"EDIT_TEMPLATE" => "",
											"PATH" => "/include/inc_dobratsa.php"
										)
									);?>
								</li>
								<li class="bottom_menu3">
									<?$APPLICATION->IncludeComponent(
										"bitrix:main.include",
										"",
										Array(
											"AREA_FILE_SHOW" => "file",
											"AREA_FILE_SUFFIX" => "inc",
											"EDIT_TEMPLATE" => "",
											"PATH" => "/include/inc_oplaty.php"
										)
									);?>
								</li>
								<li class="bottom_menu4">
									<?$APPLICATION->IncludeComponent(
										"bitrix:main.include",
										"",
										Array(
											"AREA_FILE_SHOW" => "file",
											"AREA_FILE_SUFFIX" => "inc",
											"EDIT_TEMPLATE" => "",
											"PATH" => "/include/inc_email.php"
										)
									);?>
								</li>
							</ul>
						</div>
					</div>
				</div>
			</div>
			<div class="display_none_c">
				<div class="mobile_header_top_info_bg" id="mobile_header_top_info_bg">
                    <?\Bitrix\Main\Page\Frame::getInstance()->startDynamicWithID("mobile_header_top_info_bg");?>
					<ul class="mobile_header_top_info">
						<li>
							<!-- <div class="mobile_header_top_menu"> -->
								<a class="catalog_menu_mobile_button js_catalog_menu_mobile_button" href=""></a>
							<!-- </div> -->
						</li>
						<li><a class="mobile_header_top_logo" href="/"><img src="/img/mobile_top_logo.png" alt=""/></a></li>
						<li class="display_none_m display_none_mp"><div class="mobile_header_top_slogan">интернет-магазин товаров для охоты</div></li>
						<li>
							<a class="mobile_header_top_search" href="/search/"></a>
							<a class="mobile_header_top_telephone fancy_ajax" href="/include/popup_callback.php"></a>
							<?$APPLICATION->IncludeComponent(
								"bitrix:sale.basket.basket.line",
								"main",
								Array(
									"HIDE_ON_BASKET_PAGES" => "Y",
									"PATH_TO_BASKET" => SITE_DIR."personal/cart/",
									"PATH_TO_ORDER" => SITE_DIR."personal/order/make/",
									"PATH_TO_PERSONAL" => SITE_DIR."personal/",
									"PATH_TO_PROFILE" => SITE_DIR."personal/",
									"PATH_TO_REGISTER" => SITE_DIR."login/",
									"POSITION_FIXED" => "N",
									"SHOW_AUTHOR" => "N",
									"SHOW_EMPTY_VALUES" => "Y",
									"SHOW_NUM_PRODUCTS" => "Y",
									"SHOW_PERSONAL_LINK" => "N",
									"SHOW_PRODUCTS" => "N",
									"SHOW_TOTAL_PRICE" => "N"
								)
							);?>
						</li>
					</ul>
				    <?\Bitrix\Main\Page\Frame::getInstance()->finishDynamicWithID("mobile_header_top_info_bg", "Загрузка...");?>
                </div>
				<div id="mobile_header_telephone_geo">
                    <?\Bitrix\Main\Page\Frame::getInstance()->startDynamicWithID("mobile_header_telephone_geo");?>
					<ul class="mobile_header_telephone_geo">
						<?$APPLICATION->IncludeComponent(
							"bitrix:news.detail",
							"contacts_phones_head_mobile",
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
						<li><a class="m_header_status_bt" href="/status-zakaza/">Статус заказа</a></li>
						<li><?$APPLICATION->IncludeComponent(
								"bitrix:main.include",
								"",
								Array(
									"AREA_FILE_SHOW" => "file",
									"AREA_FILE_SUFFIX" => "inc",
									"EDIT_TEMPLATE" => "",
									"PATH" => "/include/inc_geo_head.php"
								)
							);?>
						</li>
					</ul>
				    <?\Bitrix\Main\Page\Frame::getInstance()->finishDynamicWithID("mobile_header_telephone_geo", "Загрузка...");?>
                </div>
			</div>
		</header>
		<section>
			<?//if(!preg_match("#/auth/#i", $APPLICATION->GetCurPage())):?>
				<?$APPLICATION->IncludeComponent(
					"bitrix:breadcrumb",
					"head",
					Array(
						"PATH" => "",
						"SITE_ID" => "s1",
						"START_FROM" => "0"
					)
				);?>
			<?//endif;?>

			<div class="content">
				<div class="left_column <?if (Salavey::CheckTemplate(array("/search/","/delivery/","/uslugi/","/optovikam/","/garantii/"))):?>display_none_m display_none_mp display_none_p<?endif;?>" id="soc_net_auth">

					<?if (!Salavey::CheckTemplate(array("/search/","/delivery/","/uslugi/","/optovikam/","/garantii/"))):?>
						<script>
							$(document).ready(function() {
								if (window.innerWidth<1000) {
									$('html,body').animate({ scrollTop: $('.center_column').offset().top }, 1000);
								}
							});
						</script>
					<?endif;?>

                    <?if (preg_match("#/articles/#i", $APPLICATION->GetCurPage())):?>
                        <?\Bitrix\Main\Page\Frame::getInstance()->startDynamicWithID("soc_net_auth");?>
                        <?$APPLICATION->IncludeComponent("bitrix:system.auth.form", "soc.net.auth", Array(
                                "REGISTER_URL" => "",   // Страница регистрации
                                "FORGOT_PASSWORD_URL" => "",    // Страница забытого пароля
                                "PROFILE_URL" => "",    // Страница профиля
                                "SHOW_ERRORS" => "N",   // Показывать ошибки
                            ),
                            false
                        );?>
                        <?\Bitrix\Main\Page\Frame::getInstance()->finishDynamicWithID("soc_net_auth", "Загрузка...");?>
                        <div class="index_yandex_img">
                            <a href="https://clck.yandex.ru/redir/dtype=stred/pid=47/cid=2508/*https://market.yandex.ru/shop/306725/reviews"><img src="https://clck.yandex.ru/redir/dtype=stred/pid=47/cid=2507/*https://grade.market.yandex.ru/?id=306725&action=image&size=3" border="0" width="200" alt="Читайте отзывы покупателей и оценивайте качество магазина на Яндекс.Маркете" /></a>
                        </div>
                        <div class="section social_tabs" id="social_tabs">
                            <?\Bitrix\Main\Page\Frame::getInstance()->startDynamicWithID("social_tabs");?>
                                <?$APPLICATION->IncludeComponent(
                                    "bitrix:main.include",
                                    "",
                                    Array(
                                        "AREA_FILE_SHOW" => "file",
                                        "AREA_FILE_SUFFIX" => "inc",
                                        "EDIT_TEMPLATE" => "",
                                        "PATH" => "/include/inc_soc_seti_not_tabs.php"
                                    )
                                );?>
                            <?\Bitrix\Main\Page\Frame::getInstance()->finishDynamicWithID("social_tabs", "Загрузка...");?>
                        </div>                        
                    <?endif;?>

                    <?if (!preg_match("#/articles/#i", $APPLICATION->GetCurPage())):?>
                        <?$APPLICATION->IncludeComponent(
                            "bitrix:menu",
                            "left.help",
                            Array(
                                "ALLOW_MULTI_SELECT" => "N",
                                "CHILD_MENU_TYPE" => "left_help",
                                "DELAY" => "N",
                                "MAX_LEVEL" => "1",
                                "MENU_CACHE_TIME" => "3600",
                                "MENU_CACHE_TYPE" => "A",
                                "MENU_CACHE_USE_GROUPS" => "N",
                                "ROOT_MENU_TYPE" => "left_help",
                                "USE_EXT" => "N",
                                "CACHE_SELECTED_ITEMS" => "N"
                            )
                        );?>
                    <?endif;?>

				</div> 
				<div class="center_column">
				<?php if(!strstr($_SERVER['REQUEST_URI'], '/help/')) { ?>	<h1><?$APPLICATION->ShowTitle(false)?></h1> <?php } ?>