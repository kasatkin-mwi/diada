<!DOCTYPE html>
<html>

<head>
	<title><?$APPLICATION->ShowTitle()?></title>
	<?$APPLICATION->ShowHead()?>
	<meta name="viewport" content="width=device-width, initial-scale=1">

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

	<?$APPLICATION->AddHeadScript('/js/jquery-1.8.3.min.js');?>
	<?$APPLICATION->AddHeadScript('/js/main.js');?>
	<?$APPLICATION->AddHeadScript('/js/tabs.js');?>
	<?$APPLICATION->AddHeadScript('/js/jquery.cookie.js');?>
	<?$APPLICATION->AddHeadScript('/js/jquery.fancybox.pack.js');?>
	<?$APPLICATION->AddHeadScript('/js/jquery.bxslider.min.js');?>
	<?$APPLICATION->AddHeadScript('/js/jquery.formstyler.min.js');?>
	<?$APPLICATION->AddHeadScript('/js/jquery.lwtCountdown-1.0.js');?>
	<?$APPLICATION->AddHeadScript('/js/misc.js');?>
	<?$APPLICATION->AddHeadScript('/js/lazy.loading.js');?>
	<?$APPLICATION->AddHeadScript('/js/maskedInput.js');?>
    <?$APPLICATION->AddHeadScript('/ds-comf/ds-form/js/dsforms.js');?>

    <?$curPage = $APPLICATION->GetCurPage();?>
    <?$isIndex = $curPage == SITE_DIR."index.php";?>
    <?$isBasket = $curPage == SITE_DIR."personal/cart/index.php";?>
    <?$isOrder = $curPage == SITE_DIR."personal/order/index.php";?>
    <?global $USER;?>
</head>
<body>
	<div id="panel"><?$APPLICATION->ShowPanel();?></div>
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
							"MENU_CACHE_GET_VARS" => array(""),
							"MENU_CACHE_TIME" => "3600",
							"MENU_CACHE_TYPE" => "N",
							"MENU_CACHE_USE_GROUPS" => "Y",
							"ROOT_MENU_TYPE" => "top",
							"USE_EXT" => "N"
						)
					);?>
					<div class="basket">
						<?
						if (CModule::IncludeModule('sale'))
						{
							$arBasketID = Array();
							$arFilterBas = Array("FUSER_ID" => CSaleBasket::GetBasketUserID(), "LID" => SITE_ID, "ORDER_ID" => "NULL");
							$dbBas = CSaleBasket::GetList(Array(), $arFilterBas);
							while($resBas = $dbBas->GetNext())
								$arBasketID[] = $resBas['PRODUCT_ID'];
						}
                        ?>
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
					</div>
					<div class="clear"></div>
					<?if (!$USER->IsAuthorized()):?>
					<ul class="header_vhod">
						<li><a href="/auth/">Вход с паролем</a></li>
						<li> | </li>
						<li><a href="/auth/reg/">Регистрация</a></li>
					</ul>
					<?endif;?>
				</div>
			</div>
			<div class="telephone_firearm">
				<div class="telephone_logo">
					<p class="telephone_logo_title">интернет-магазин товаров для охоты</p>
					<a href="/"><img src="/img/logo.png"/></a>
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
					<p><a class="call_back fancy_ajax" href="/include/popup_callback.php">Заказать звонок бесплатно</a></p>
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
					<div class="catalog_produce <?if ($isIndex):?>index_catalog_produce<?endif;?>">
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
								"MENU_CACHE_GET_VARS" => array(""),
								"MENU_CACHE_TIME" => "3600",
								"MENU_CACHE_TYPE" => "N",
								"MENU_CACHE_USE_GROUPS" => "Y",
								"ROOT_MENU_TYPE" => "left",
								"USE_EXT" => "Y"
							)
						);?>
					</div>
					<div class="red_search js_red_search">
						<?$APPLICATION->IncludeComponent(
	"salavey:search.title",
	"",
	array(
		"CATEGORY_0" => array(
			0 => "iblock_ibCatalog",
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
		"CONVERT_CURRENCY" => "N",
		"CATEGORY_0_iblock_ibCatalog" => array(
			0 => "1",
		)
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
			<div class="mobile_left_menu_light js_catalog_mobile_menu_light">
				<div class="mobile_left_menu_light_scroll">
					<ul class="mobile_left_menu_vhod">
						<li><a href="/auth/">Вход с паролем</a></li>
						<li> | </li>
						<li><a href="/auth/reg/">Регистрация</a></li>
					</ul>
					<?$locationUser = getUserLocation();?>
					<div>
						<a class="menu_lvl1_button mobile_menu_geo_button js_menu_lvl1_button" href="javascript:void(0);">
							<span>
								<b>Город</b><span><?=$locationUser?></span>
							</span>
						</a>
						<div class="mobile_menu_geo js_menu_lvl2">
							<div class="mobile_catalog_menu_come_back js_mobile_catalog_menu_come_back"><a href="">Назад</a></div>
							<div class="">
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
							"MENU_CACHE_GET_VARS" => array(""),
							"MENU_CACHE_TIME" => "3600",
							"MENU_CACHE_TYPE" => "N",
							"MENU_CACHE_USE_GROUPS" => "Y",
							"ROOT_MENU_TYPE" => "top_mobile",
							"USE_EXT" => "Y"
						)
					);?>
				</div>
			</div>
			<div class="mobile_header_top_info_bg">
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
			</div>
			<div>
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
                    <li>
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
                    </li>
				</ul>
			</div>
		</div>
	</header>
	<section <?if ($isBasket || $isOrder):?>class="gray_bg"<?endif;?>>
		<?if (!$isIndex && !$isBasket && !$isOrder):?>
			<?$APPLICATION->IncludeComponent(
				"bitrix:breadcrumb",
				"head",
				Array(
					"PATH" => "",
					"SITE_ID" => "s1",
					"START_FROM" => "0"
				)
			);?>
		<?endif;?>
