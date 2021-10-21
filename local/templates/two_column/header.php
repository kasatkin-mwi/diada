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
	<? if (isset($_COOKIE['mob']) and $_COOKIE['mob']=="no") { ?>
		<meta name=viewport content="width=1250, initial-scale=1">
	<? } else { ?>
	<meta name=viewport content="width=device-width, initial-scale=1">
	<? } ?>

    <link rel="preload" href="/ds-comf/ds-form/css/dsforms.css" as="style">
	<?$APPLICATION->SetAdditionalCSS('/css/reset.css');?>
	<?$APPLICATION->SetAdditionalCSS('/css/style.css');?>
	<?$APPLICATION->SetAdditionalCSS('/css/style_500.css');?>
	<?$APPLICATION->SetAdditionalCSS('/css/style_500_800.css');?>
	<?$APPLICATION->SetAdditionalCSS('/css/style_799.css');?>
	<?$APPLICATION->SetAdditionalCSS('/css/style_800.css');?>
	<?$APPLICATION->SetAdditionalCSS('/css/style_800_1000.css');?>
	<?$APPLICATION->SetAdditionalCSS('/css/style_1000.min.css');?>
	<?$APPLICATION->SetAdditionalCSS('/css/style_filter.css');?>
	<?$APPLICATION->SetAdditionalCSS('/font/font.css');?>
	<?$APPLICATION->SetAdditionalCSS('/css/jquery.formstyler.css');?>
	<?$APPLICATION->SetAdditionalCSS('/css/jquery.fancybox.css');?>
	<?$APPLICATION->SetAdditionalCSS('/css/jquery.bxslider.css');?>
    <?$APPLICATION->SetAdditionalCSS('/css/jquery.lazyloadxt.fadein.css');?>
    <?$APPLICATION->SetAdditionalCSS('/css/footer_style.css');?>
    <?$APPLICATION->SetAdditionalCSS('/css/main.css');?>
	<?$APPLICATION->SetAdditionalCSS('/css/new_catalog.css', true);?>
	

<link href="/font_awesome/css/font-awesome.css" rel="stylesheet" type="text/css" >

	<?$APPLICATION->AddHeadScript('/js/jquery-1.8.3.min.js');?>
    <?$APPLICATION->AddHeadScript('/js/myswipe.js');?>
    <?
    $APPLICATION->AddHeadScript('/js/mask/jquery.inputmask.bundle.min.js');
    $APPLICATION->AddHeadScript('/js/mask/jquery.inputmask-multi.min.js');
    ?>
	<?$APPLICATION->AddHeadScript('/js/jquery.lazyloadxt.min.js');?>
    <?$APPLICATION->AddHeadScript('/js/main.js');?>
	<?$APPLICATION->AddHeadScript('/js/custom.js');?>
	<?$APPLICATION->AddHeadScript('/js/tabs.js');?>
	<?$APPLICATION->AddHeadScript('/js/jquery.cookie.js');?>
	<?$APPLICATION->AddHeadScript('/js/jquery.fancybox.pack.js');?>
	<?$APPLICATION->AddHeadScript('/js/jquery.bxslider.min.js');?>
	<?$APPLICATION->AddHeadScript('/js/jquery.formstyler.min.js');?>
	<?$APPLICATION->AddHeadScript('/js/jquery.lwtCountdown-1.0.js');?>
	<?$APPLICATION->AddHeadScript('/js/misc.js');?>
    <?$APPLICATION->AddHeadScript("//www.google.com/recaptcha/api.js");?>
    <?$APPLICATION->AddHeadScript('/js/jquery.validate.js');?>
    
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
                        ecommerce:"dataLayer",
                        triggerEvent:true
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


    <meta name="google-site-verification" content="rrJVvYFVDNV1S7ECaEsSEj-QyJCFzRwMV_ddnxHIPZQ" />
    <meta name="yandex-verification" content="034d75b083d3513f" />
    <meta name="yandex-verification" content="624dbb3906b574d7" />

<?if(!$USER->IsAdmin()):?>

    <script type="text/javascript">
        var __cs = __cs || [];
        __cs.push(["setAccount", "6egTDId_bNlOKny3R2uZoMHvfnUfqiav"]);
        __cs.push(["setHost", "//server.comagic.ru/comagic"]);
    </script>
    <script type="text/javascript" async src="//app.comagic.ru/static/cs.min.js"></script>

    <?/*
    <!-- BEGIN JIVOSITE CODE -->
    <script type='text/javascript'>
        (function(){ var widget_id = 'QEPLc3GjAx';
            var s = document.createElement('script'); s.type = 'text/javascript'; s.async = true; s.src = '//code.jivosite.com/script/widget/'+widget_id; var ss = document.getElementsByTagName('script')[0]; ss.parentNode.insertBefore(s, ss);})();</script>
    <!-- END JIVOSITE CODE -->
    */?>
    <script>
          (function(w,d,u){
                  var s=d.createElement('script');s.async=true;s.src=u+'?'+(Date.now()/60000|0);
                  var h=d.getElementsByTagName('script')[0];h.parentNode.insertBefore(s,h);
          })(window,document,'https://cdn.bitrix24.ru/b2577509/crm/site_button/loader_3_wspckr.js');
    </script>
<?endif?>

<meta property='og:type' content='website'/>
<meta property='og:url' content='https://www.diada-arms.ru<?=$_SERVER["REQUEST_URI"]?>'/>
<meta property='og:image' content='https://www.diada-arms.ru/img/og/1.jpg'/>
<meta property='og:src' content='https://www.diada-arms.ru/img/og/1.jpg'/>
<meta property='og:title' content='<!--title-->'/>

</head>
<body>
    <?if (!in_array($_REQUEST["hpanel"],array("Y","y","yes"))):?>
	    <div id="panel"><?$APPLICATION->ShowPanel();?></div>
    <?endif;?>

	<div class="wrap_cont">

	<div class="display_none_c">
		<div class="mobile_left_menu_light js_catalog_mobile_menu_light">
			<div class="mobile_left_menu_light_scroll">
				<div id="mobile_vhod">
                    <?
                    $frame = new \Bitrix\Main\Page\FrameBuffered("mobile_vhod");
                    $frame->begin();
                    ?>
                        <ul class="mobile_left_menu_vhod">
                            <?if (!$USER->IsAuthorized()):?>
                                <li><a href="/auth/">Вход с паролем</a></li>
                                <li> | </li>
                                <li><a href="/auth/reg/">Регистрация</a></li>
                            <?else:?>
                                <li><a href="/lk/">Личный кабинет</a></li>
                                <li>|</li>
                                <li><a href="/?logout=yes">Выход</a></li>
                            <?endif?>
                        </ul>
                    <?
                    $frame->beginStub();
                    ?>
                        <ul class="mobile_left_menu_vhod">
                            <li><a href="/lk/">Личный кабинет</a></li>
                            <li>|</li>
                            <li><a href="/?logout=yes">Выход</a></li>
                        </ul>
                    <?
                    $frame->end();
                    ?>
                </div>
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
                <div id="telephone_logo_head">
                    <?\Bitrix\Main\Page\Frame::getInstance()->startDynamicWithID("telephone_logo_head_mobile");?>
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
                            "USE_SHARE" => "N",
                            "COMPOSITE_FRAME_MODE" => "Y",
                            "COMPOSITE_FRAME_TYPE" => "DYNAMIC_WITHOUT_STUB"
                        )
                    );?>
                    <?\Bitrix\Main\Page\Frame::getInstance()->finishDynamicWithID("telephone_logo_head_mobile", "");?>
                </div>
				<div style="display:none;" class="head_white_status"><a href="/order-status/">Статус заказа</a></div>

                        <div class="mobile-extra-nav-pro-container">
                            <a href="/delivery/" class="delivery-button-pro" style="margin-top:0;">Доставка по России</a>
                            <div class="wrapper-pro"></div>
                            <a href="/order-status/" class="order-button-pro">Отследить заказ</a>
                        </div>

						<div class="mobile_head_white_battle">
							<div class="head_white_battle">
								<a href="/catalog/compare/" class="">
								<?$APPLICATION->IncludeComponent(
									"bitrix:catalog.compare.list",
									"comparecount",
									Array(
										"ACTION_VARIABLE" => "action",
										"AJAX_MODE" => "N",
										"AJAX_OPTION_ADDITIONAL" => "",
										"AJAX_OPTION_HISTORY" => "N",
										"AJAX_OPTION_JUMP" => "N",
										"AJAX_OPTION_STYLE" => "Y",
										"COMPARE_URL" => "compare.php",
										"DETAIL_URL" => "",
										"IBLOCK_ID" => "1",
										"IBLOCK_TYPE" => "ibCatalog",
										"NAME" => "CATALOG_COMPARE_LIST",
										"POSITION" => "top left",
										"POSITION_FIXED" => "N",
										"PRODUCT_ID_VARIABLE" => "id"
									)
								);?>
								<span class="head_white_favorite_tit">Сравнение</span></a>

							</div>
						</div>
						<div class="mobile_head_white_favorite">
							<div class="head_white_favorite">
								<a href="/catalog/favourites/">
									<?$arrFilter0 = Array("ID"=>json_decode($_COOKIE['favourites']));
										$favor_uniq=array_unique($arrFilter0["ID"])
									?>
									<span class="head_white_favorite_ic <?if(count($favor_uniq)>0):?>red<?endif?>">
										<span><?=count($favor_uniq)?></span>
									</span>
									<span class="head_white_favorite_tit">Избранное</span>
								</a>
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

	<link href="/css/new_header_style.css" rel="stylesheet" type="text/css" >
	<header>
		<div class="display_none_m display_none_mp display_none_p">

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

					</div>
					<div class="head_red_menu_bl">

						<?$APPLICATION->IncludeComponent(
							"bitrix:menu",
							"top_new",
							Array(
								"ALLOW_MULTI_SELECT" => "N",
								"CHILD_MENU_TYPE" => "top",
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


					</div>
					<div class="head_red_avtoriz">
						<?\Bitrix\Main\Page\Frame::getInstance()->startDynamicWithID("header_vhod");?>
							<?if (!$USER->IsAuthorized()):?>
								<a href="/auth/">Вход</a>
								<span>|</span>
								<a href="/auth/reg/">Регистрация</a>
							<?else:?>
								<a href="/?logout=yes">Выход</a>
								<span>|</span>
								<a href="/lk/">Личный кабинет</a>

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
						<?/**/?><p class="telephone_logo_title">интернет-магазин товаров для охоты</p>
						<?/*<a class="head_info_logo" href="/"><img src="/img/2020_Logo_bg.gif"/></a>*/?>
                        <a class="head_info_logo" href="/"><img src="/img/logo.png"/></a>
						<meta itemprop="name" content="Diada-Arms">
						<meta itemprop="url" content="https://www.diada-arms.ru<?=$_SERVER['REQUEST_URI'];?>">
						<div id="telephone_logo_head">
							<?
							$frame = new \Bitrix\Main\Page\FrameBuffered("telephone_logo_head");
							$frame->begin();
							?>
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
							<?$frame->beginStub();?>
								<p><span>8 (495) 268-13-72 </span>(Москва)</p>
								<p><span>8 (800) 707-44-15 </span>(Регионы РФ)</p>
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

					<div class="head_white_battle" id="head_white_battle">
                        <?\Bitrix\Main\Page\Frame::getInstance()->startDynamicWithID("head_white_battle");?>
							<a href="/catalog/compare/" class="">
							<?$APPLICATION->IncludeComponent(
								"bitrix:catalog.compare.list",
								"comparecount",
								Array(
									"ACTION_VARIABLE" => "action",
									"AJAX_MODE" => "N",
									"AJAX_OPTION_ADDITIONAL" => "",
									"AJAX_OPTION_HISTORY" => "N",
									"AJAX_OPTION_JUMP" => "N",
									"AJAX_OPTION_STYLE" => "Y",
									"COMPARE_URL" => "compare.php",
									"DETAIL_URL" => "",
									"IBLOCK_ID" => "1",
									"IBLOCK_TYPE" => "ibCatalog",
									"NAME" => "CATALOG_COMPARE_LIST",
									"POSITION" => "top left",
									"POSITION_FIXED" => "N",
									"PRODUCT_ID_VARIABLE" => "id"
								)
							);?>
							</a>
                            <?
                            \Bitrix\Main\Page\Frame::getInstance()->finishDynamicWithID("head_white_battle", "");
                            ?>
						</div>

						<div class="head_white_favorite" id="head_white_favorite">
                            <?\Bitrix\Main\Page\Frame::getInstance()->startDynamicWithID("head_white_favorite");?>
							<a href="/catalog/favourites/">
								<?$arrFilter0 = Array("ID"=>json_decode($_COOKIE['favourites']));
									$favor_uniq=array_unique($arrFilter0["ID"])
								?>
								<span class="head_white_favorite_ic <?if(count($favor_uniq)>0):?>red<?endif?>">
									<span><?=count($favor_uniq)?></span>
								</span>
								
							</a>
                            <?
                            \Bitrix\Main\Page\Frame::getInstance()->finishDynamicWithID("head_white_favorite", "");
                            ?>
						</div>
						

						<span class="loadhead" id="basket">
                        <?\Bitrix\Main\Page\Frame::getInstance()->startDynamicWithID("basket");?>
						<?$APPLICATION->IncludeComponent(
							"bitrix:sale.basket.basket.small",
							"head_new",
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
                        </span>

                         <div class="extra-basket-block">
                             
                         <a href="/delivery/" class="delivery-button-pro">Доставка по России</a>

                         <a href="/order-status/" class="order-button-pro">Отследить заказ</a>

                         </div>
						
						
						
					</div>
				</div>
			</div>
			<?/*
			<?\Bitrix\Main\Page\Frame::getInstance()->startDynamicWithID("header_text");?>
            <?$APPLICATION->IncludeComponent(
                "bitrix:news.list",
                "header_text",
                Array(
                    "ACTIVE_DATE_FORMAT" => "d.m.Y",
                    "ADD_SECTIONS_CHAIN" => "N",
                    "AJAX_MODE" => "N",
                    "AJAX_OPTION_ADDITIONAL" => "",
                    "AJAX_OPTION_HISTORY" => "N",
                    "AJAX_OPTION_JUMP" => "N",
                    "AJAX_OPTION_STYLE" => "Y",
                    "CACHE_FILTER" => "N",
                    "CACHE_GROUPS" => "Y",
                    "CACHE_TIME" => "36000000",
                    "CACHE_TYPE" => "A",
                    "CHECK_DATES" => "Y",
                    "COMPOSITE_FRAME_MODE" => "A",
                    "COMPOSITE_FRAME_TYPE" => "AUTO",
                    "DETAIL_URL" => "",
                    "DISPLAY_BOTTOM_PAGER" => "Y",
                    "DISPLAY_DATE" => "Y",
                    "DISPLAY_NAME" => "Y",
                    "DISPLAY_PICTURE" => "Y",
                    "DISPLAY_PREVIEW_TEXT" => "Y",
                    "DISPLAY_TOP_PAGER" => "N",
                    "FIELD_CODE" => array("",""),
                    "FILTER_NAME" => "",
                    "HIDE_LINK_WHEN_NO_DETAIL" => "N",
                    "IBLOCK_ID" => "38",
                    "IBLOCK_TYPE" => "other",
                    "INCLUDE_IBLOCK_INTO_CHAIN" => "N",
                    "INCLUDE_SUBSECTIONS" => "Y",
                    "MESSAGE_404" => "",
                    "NEWS_COUNT" => "1",
                    "PAGER_BASE_LINK_ENABLE" => "N",
                    "PAGER_DESC_NUMBERING" => "N",
                    "PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
                    "PAGER_SHOW_ALL" => "N",
                    "PAGER_SHOW_ALWAYS" => "N",
                    "PAGER_TEMPLATE" => ".default",
                    "PAGER_TITLE" => "Новости",
                    "PARENT_SECTION" => "",
                    "PARENT_SECTION_CODE" => "",
                    "PREVIEW_TRUNCATE_LEN" => "",
                    "PROPERTY_CODE" => array("",""),
                    "SET_BROWSER_TITLE" => "Y",
                    "SET_LAST_MODIFIED" => "N",
                    "SET_META_DESCRIPTION" => "Y",
                    "SET_META_KEYWORDS" => "Y",
                    "SET_STATUS_404" => "N",
                    "SET_TITLE" => "Y",
                    "SHOW_404" => "N",
                    "SORT_BY1" => "ACTIVE_FROM",
                    "SORT_BY2" => "SORT",
                    "SORT_ORDER1" => "DESC",
                    "SORT_ORDER2" => "ASC",
                    "STRICT_SECTION_CHECK" => "N"
                )
            );?>
            <?\Bitrix\Main\Page\Frame::getInstance()->finishDynamicWithID("header_text", "Загрузка...");?>
			*/?>
			<div class="bottom_header_menu_block">
					<div class="bottom_header_menu">
						<div class="catalog_produce <?if ($isIndex):?>index_catalog_produce<?endif;?>" itemscope itemtype="http://schema.org/SiteNavigationElement"> <!-- акции -->
							<a href="/catalog/" class="catalog_menu_button">
								<span>КАТАЛОГ ТОВАРОВ</span>
							</a>

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
	".default", 
	array(
		"CATEGORY_0" => array(
			0 => "no",
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
		"USE_LANGUAGE_GUESS" => "N",
		"COMPONENT_TEMPLATE" => ".default",
		"PRICE_CODE" => "",
		"PRICE_VAT_INCLUDE" => "Y",
		"PREVIEW_TRUNCATE_LEN" => "",
		"SHOW_PREVIEW" => "Y",
		"CONVERT_CURRENCY" => "N"
	),
	false
);?>
						</div>

					</div>
				</div>
		</div>

		<div class="display_none_c">
				<div class="mobile_header_top_info_bg" id="mobile_header_top_info_bg">
                    <?\Bitrix\Main\Page\Frame::getInstance()->startDynamicWithID("mobile_header_top_info_bg");?>
					<!--<div class="mob_NY_bg"></div>-->
					<ul class="mobile_header_top_info">
						<li>
							<!-- <div class="mobile_header_top_menu"> -->
								<a class="catalog_menu_mobile_button js_catalog_menu_mobile_button" href=""></a>
							<!-- </div> -->
						</li>
                        <li><a class="mobile_header_top_logo" href="/"><img src="/img/mobile_top_logo.png" alt=""/></a></li>
						<?/*<li><a class="mobile_header_top_logo" href="/"><img src="/img/LogoNY_mob.png" alt=""/></a></li>*/?>
						<li class="display_none_m display_none_mp"><div class="mobile_header_top_slogan"><?/**/?>интернет-магазин товаров для охоты</div></li>
						<li>
							<a class="mobile_header_top_search js_mobile_header_top_search" href=""></a>
							<a class="mobile_header_top_telephone fancy_ajax" href="/include/popup_callback.php"></a>
							<div id="mobile_basket" style="display: inline-block;">
                                <?\Bitrix\Main\Page\Frame::getInstance()->startDynamicWithID("mobile_basket");?>
                                <?$APPLICATION->IncludeComponent(
                                    "bitrix:sale.basket.basket.small",
                                    "mobile",
                                    Array(
                                        "PATH_TO_BASKET" => "/personal/cart/",
                                        "PATH_TO_ORDER" => "/personal/order/",
                                        "SHOW_DELAY" => "N",
                                        "SHOW_NOTAVAIL" => "N",
                                        "SHOW_SUBSCRIBE" => "N"
                                    )
                                );?>
                                <?
                                \Bitrix\Main\Page\Frame::getInstance()->finishDynamicWithID("mobile_basket", "Загрузка...");
                                ?>
                            </div>
							
						</li>
					</ul>
					<div class="mobile_search_bl js_mobile_search_bl">
						<div class="red_search">
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
						<a class="close_mob_search js_close_mob_search" href="">Отмена</a>
					</div>
				    <?\Bitrix\Main\Page\Frame::getInstance()->finishDynamicWithID("mobile_header_top_info_bg", "Загрузка...");?>
                </div>

			</div>

	</header>


		<section>

				<?$APPLICATION->IncludeComponent(
					"bitrix:breadcrumb",
					"head",
					Array(
						"PATH" => "",
						"SITE_ID" => "s1",
						"START_FROM" => "0"
					)
				);?>

			<div class="content">
<?
if (defined('ERROR_404') && ERROR_404=='Y')
{
?>

<? } else { ?>
				<div class="left_column <?if (Salavey::CheckTemplate(array("/search/","/delivery/","/uslugi/","/optovikam/","/garantii/","/articles/"))):?>display_none_m display_none_mp display_none_p<?endif;?>" id="soc_net_auth">

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
                            <a rel="nofollow" href="https://clck.yandex.ru/redir/dtype=stred/pid=47/cid=2508/*https://market.yandex.ru/shop/306725/reviews"><img src="https://clck.yandex.ru/redir/dtype=stred/pid=47/cid=2507/*https://grade.market.yandex.ru/?id=306725&action=image&size=3" border="0" width="200" alt="Читайте отзывы покупателей и оценивайте качество магазина на Яндекс.Маркете" /></a>
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
				<? } ?>
<?
if (defined('ERROR_404') && ERROR_404=='Y')
{
?>

<? } else { ?>
				<div class="center_column">
					<? } ?>
				<?php if(!strstr($_SERVER['REQUEST_URI'], '/help/')) { ?>	<h1><?$APPLICATION->ShowTitle(false)?></h1> <?php } ?>