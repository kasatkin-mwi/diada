        <?if (!CSite::InDir("/search/")):?>
            <div class="index_podpiska_block">
                <?$APPLICATION->IncludeComponent(
                    "salavey:subscribe",
                    ".default",
                    Array(
                        "COMPONENT_TEMPLATE" => ".default",
                        "EXISTS_STRING" => "Такой адрес уже добавлен в подписку",
                        "MAIL_STRING" => "Указанный адрес не является почтой",
                        "OK_STRING" => "Ваш адрес добавлен в подписку на сайте diada-arms.ru",
                        "OK_DELETE_SUB" => "Ваш адрес был удален из подписки на сайте diada-arms.ru"
                    )
                );?>
            </div>
        <?endif;?>
		<div class="section_copu_top_menu_block display_none_c display_none_m display_none_mp">
			<div class="section_copu_top_menu">
				<?$APPLICATION->IncludeComponent(
					"bitrix:menu",
					"bottom.mobile",
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
				<ul class="header_vhod">
                    <li><a href="/auth/">Вход с паролем</a></li>
                    <li> | </li>
                    <li><a href="/auth/reg/">Регистрация</a></li>
				</ul>
				<div class="clear"></div>
			</div>
		</div>

		<?if ($isIndex):?>
		<div class="content display_none_m display_none_mp">
			<div class="right_column">
                    <div class="index_articles_block">
                        <div class="index_articles_title"><a href="/news_and_articles/stati/">Статьи</a></div>
                        <?$APPLICATION->IncludeComponent(
                            "bitrix:news.list",
                            "stati_index",
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
                                "DISPLAY_BOTTOM_PAGER" => "N",
                                "DISPLAY_DATE" => "Y",
                                "DISPLAY_NAME" => "Y",
                                "DISPLAY_PICTURE" => "Y",
                                "DISPLAY_PREVIEW_TEXT" => "Y",
                                "DISPLAY_TOP_PAGER" => "N",
                                "FIELD_CODE" => array("", ""),
                                "FILTER_NAME" => "",
                                "HIDE_LINK_WHEN_NO_DETAIL" => "N",
                                "IBLOCK_ID" => "4",
                                "IBLOCK_TYPE" => "ibArticles",
                                "INCLUDE_IBLOCK_INTO_CHAIN" => "N",
                                "INCLUDE_SUBSECTIONS" => "Y",
                                "MESSAGE_404" => "",
                                "NEWS_COUNT" => "3",
                                "PAGER_BASE_LINK_ENABLE" => "N",
                                "PAGER_DESC_NUMBERING" => "N",
                                "PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
                                "PAGER_SHOW_ALL" => "N",
                                "PAGER_SHOW_ALWAYS" => "N",
                                "PAGER_TEMPLATE" => ".default",
                                "PAGER_TITLE" => "Новости",
                                "PARENT_SECTION" => 184,
                                "PARENT_SECTION_CODE" => "",
                                "PREVIEW_TRUNCATE_LEN" => "",
                                "PROPERTY_CODE" => array("", ""),
                                "SET_BROWSER_TITLE" => "N",
                                "SET_LAST_MODIFIED" => "N",
                                "SET_META_DESCRIPTION" => "N",
                                "SET_META_KEYWORDS" => "N",
                                "SET_STATUS_404" => "N",
                                "SET_TITLE" => "N",
                                "SHOW_404" => "N",
                                "SORT_BY1" => "ACTIVE_FROM",
                                "SORT_BY2" => "SORT",
                                "SORT_ORDER1" => "DESC",
                                "SORT_ORDER2" => "ASC",
                                "DETAIL_URL" => "/articles/#SECTION_CODE#/#ELEMENT_CODE#/"
                            )
                        );?>
                    </div>
                    <div class="index_video_block">
                        <div class="index_video_title"><a href="https://www.youtube.com/channel/UCpx95geyK5SdesTV82S3ODQ"><img src="/img/yt.png" alt=""/></a><a href="/video-obzory/">Наши видеообзоры</a></div>
                        <?$APPLICATION->IncludeComponent(
                            "bitrix:news.list",
                            "video_index",
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
                                "DETAIL_URL" => "",
                                "DISPLAY_BOTTOM_PAGER" => "N",
                                "DISPLAY_DATE" => "Y",
                                "DISPLAY_NAME" => "Y",
                                "DISPLAY_PICTURE" => "Y",
                                "DISPLAY_PREVIEW_TEXT" => "Y",
                                "DISPLAY_TOP_PAGER" => "N",
                                "FIELD_CODE" => array("", ""),
                                "FILTER_NAME" => "",
                                "HIDE_LINK_WHEN_NO_DETAIL" => "N",
                                "IBLOCK_ID" => "7",
                                "IBLOCK_TYPE" => "ibVideo",
                                "INCLUDE_IBLOCK_INTO_CHAIN" => "N",
                                "INCLUDE_SUBSECTIONS" => "Y",
                                "MESSAGE_404" => "",
                                "NEWS_COUNT" => "3",
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
                                "PROPERTY_CODE" => array("VIDEO", ""),
                                "SET_BROWSER_TITLE" => "N",
                                "SET_LAST_MODIFIED" => "N",
                                "SET_META_DESCRIPTION" => "N",
                                "SET_META_KEYWORDS" => "N",
                                "SET_STATUS_404" => "N",
                                "SET_TITLE" => "N",
                                "SHOW_404" => "N",
                                "SORT_BY1" => "ACTIVE_FROM",
                                "SORT_BY2" => "SORT",
                                "SORT_ORDER1" => "DESC",
                                "SORT_ORDER2" => "ASC"
                            )
                        );?>
                    </div>
				<div class="section social_tabs bottom_social_tabs display_none_c">
					<?$APPLICATION->IncludeComponent(
						"bitrix:main.include",
						"",
						Array(
							"AREA_FILE_SHOW" => "file",
							"AREA_FILE_SUFFIX" => "inc",
							"EDIT_TEMPLATE" => "",
							"PATH" => "/include/inc_soc_seti.php"
						)
					);?>
				</div>
				<div class="clear"></div>
			</div>
			<div class="center_column">
				<?$APPLICATION->IncludeComponent(
					"bitrix:main.include",
					"",
					Array(
						"AREA_FILE_SHOW" => "file",
						"AREA_FILE_SUFFIX" => "inc",
						"EDIT_TEMPLATE" => "",
						"PATH" => "/include/text_index.php"
					)
				);?>
			</div>
			<div class="clear"></div>
		</div>
		<?endif;?>

		<div class="display_none_c display_none_p">
			<?$APPLICATION->IncludeComponent(
				"bitrix:main.include",
				"",
				Array(
					"AREA_FILE_SHOW" => "file",
					"AREA_FILE_SUFFIX" => "inc",
					"EDIT_TEMPLATE" => "",
					"PATH" => "/include/text_mobile_index.php"
				)
			);?>
		</div>

	</section>
	<footer>
		<div class="footer_block">
			<ul class="footer_info_block">
				<li class="telephone_logo">
					<p class="telephone_logo_title">интернет-магазин товаров для охоты</p>
					<a href="/"><img src="/img/logo_footer.png"/></a>
				</li>
				<li class="telephone_logo">
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
				</li>
				<li class="bottom_menu">
					<div class="bottom_menu_button">
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
					<div class="clear display_none_p display_none_m display_none_mp"></div>
					<div class="footer_money_social_block">
						<div class="footer_money_block">
							<img src="/img/visa.png"/>
							<img src="/img/visa_el.png"/>
							<img src="/img/yandex.png"/>
							<img src="/img/web_money.png"/>
						</div>
						<div class="socila_block footer_socila_block">
                            <a href="https://www.facebook.com/diadaarms" class="fb">fb</a>
                            <a href="https://twitter.com/DiadaArms" class="tw">tw</a>
                            <a href="https://ok.ru/diadaarms" class="ok">ok</a>
                            <a href="https://vk.com/diadaarms" class="vk">vk</a>
                            <a href="https://plus.google.com/u/0/+diadaarms/posts" class="google">g+</a>
                            <a href="https://www.youtube.com/channel/UCpx95geyK5SdesTV82S3ODQ" class="yt">yt</a>
						</div>
					</div>
					<div class="clear"></div>
				</li>
			</ul>
			<div class="footer_prava">
				<p>© 2010-2014 Интернет-магазин www.diada-arms.ru - товары для охоты, спорта и отдыха. <a href="/sitemap.php">Карта сайта</a></p>
				<p>Обращаем Ваше внимание на то, что данный Интернет-сайт носит исключительно информационный характер и ни при каких условиях не является публичной офертой,
				определяемой положениями Статьи 437 Гражданского кодекса Российской Федерации.</p>
				<p>Для получения подробной информации о стоимости и условий продажи товаров, пожалуйста, обращайтесь к менеджерам по продажам магазинов Diada-arms.ru</p>
			</div>
		</div>
	</footer>
	<div id="back_top" style="display: block;"><span></span></div>
</body>
</html>