<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Diada-arms.ru");
?><div class="why_trust_us_shadow">
	<div class="why_trust_us_block">
		<div class="why_trust_us">
			<p class="title_why_trust_us">
				 ПОЧЕМУ НАМ ДОВЕРЯЮТ?
			</p>
			<ul>
				<li class="why_trust_us1">Мы являемся официальными дилерами!<span class="red_circle"></span></li>
				<li class="why_trust_us2">Гарантия магазина на всю продукцию!<span class="red_circle"></span></li>
				<li class="why_trust_us3">Более 10 лет успешной работы!<span class="red_circle"></span></li>
				<li class="why_trust_us4">Только проверенные бренды! Только оригинальный товар!<span class="red_circle"></span></li>
				<li class="why_trust_us5">Предлагаем честные цены без скрытых накруток!<span class="red_circle"></span></li>
			</ul>
			<p class="right_text_why_trust_us">
				 Хотите узнать о нас больше? Более подробная информация здесь: <a href="/about/">Подробнее</a>
			</p>
		</div>
	</div>
</div>
 <?/*<div class="rating_comment_text_list">
	<a class="red_arrow_comment js_type_comment" href="">Самые свежие</a>
	<ul class="js_type_comment_light type_comment_light not_style">
	    <li><a class="age_desc  active" href="/otziv/?sort=age_desc" title="Самые свежие">Самые свежие</a></li>
	    <li><a class="age_asc  " href="/otziv/?sort=age_asc" title="Самые давние">Самые давние</a></li>
	    <li><a class="ocenka_asc  " href="/otziv/?sort=ocenka_asc" title="Самые критичные">Самые критичные</a></li>
	    <li><a class="ocenka_desc  " href="/otziv/?sort=ocenka_desc" title="Самые позитивные">Самые позитивные</a></li>
    </ul>
</div>*/?> <?
            $arSort = Array("age_desc"=>"Самые свежие", "age_asc"=>"Самые давние", "ocenka_asc"=>"Самые критичные", "ocenka_desc"=>"Самые позитивные");
            
            if ($_REQUEST["sort"])
            {
            	$sort = $_REQUEST["sort"];
            }
            else
            {
            	$sort = "age_desc";
            }
		?>
<div class="rating_comment_block">
	<div class="rating_comment_text">
 <a href="/">Главная страница</a>
		<h1 class="title_why_trust_us" style="background:none">ВАШИ ОТЗЫВЫ</h1>
		<div>
			 показывать сначала
			<div>
 <a class="red_arrow_comment js_type_comment" href=""><?=$arSort[$sort]?></a>
				<ul class="js_type_comment_light type_comment_light">
					 <?foreach($arSort as $k=>$v):?>
					<li><a class="<?=$k?> <?if ($sort == $k) echo 'active'?>
					 " href="<?=$APPLICATION->
					 GetCurPageParam('sort='.$k, array('sort'))?>" title="&lt;span id="><?=$v?><span class="bxhtmled-surrogate-inner"><span class="bxhtmled-right-side-item-icon"></span><span class="bxhtmled-comp-lable" unselectable="on" spellcheck="false">Код PHP</span></span>"&gt;<?=$v?></a></li>
					 <?endforeach;?>
				</ul>
			</div>
			 отзывы
		</div>
	</div>
	<div class="rating_comment">
		 <?
				CModule::IncludeModule('iblock');
				$arRating = Array();
				$arRating['SUMMA'] = 0;
				$dbElem = CIBLockElement::GetList(Array(), Array("IBLOCK_ID"=>17, "ACTIVE"=>"Y"), false, false, Array("PROPERTY_OCENKA"));
				$count = $dbElem->SelectedRowsCount();
				while($resElem = $dbElem->GetNext())
				{
					if ($resElem['PROPERTY_OCENKA_VALUE'])
					{
						$arRating['OCENKA'][$resElem['PROPERTY_OCENKA_VALUE']]++;
                        $arRating['SUMMA'] += $resElem['PROPERTY_OCENKA_VALUE'];
					}
				}
				?>
		<div class="average_rating">
			<p class="big_rating">
				 <?=number_format($arRating['SUMMA'] / $count, "2", ".", "")?>
			</p>
			<p>
				 средняя оценка
			</p>
		</div>
		<div class="scale_rating">
			<ul>
				<li class="rating5">
				<p class="star_rating">
 <img src="/img/star5.png">
				</p>
				<p class="linear_rating">
				</p>
				<p class="kol_vo_rating">
					 <?=intval($arRating['OCENKA'][5])?>
				</p>
 </li>
				<li class="rating4">
				<p class="star_rating">
 <img src="/img/rating4.png">
				</p>
				<p class="linear_rating">
				</p>
				<p class="kol_vo_rating">
					 <?=intval($arRating['OCENKA'][4])?>
				</p>
 </li>
				<li class="rating3">
				<p class="star_rating">
 <img src="/img/star3.png">
				</p>
				<p class="linear_rating">
				</p>
				<p class="kol_vo_rating">
					 <?=intval($arRating['OCENKA'][3])?>
				</p>
 </li>
				<li class="rating2">
				<p class="star_rating">
 <img src="/img/star2.png">
				</p>
				<p class="linear_rating">
				</p>
				<p class="kol_vo_rating">
					 <?=intval($arRating['OCENKA'][2])?>
				</p>
 </li>
				<li class="rating1">
				<p class="star_rating">
 <img src="/img/star1.png">
				</p>
				<p class="linear_rating">
				</p>
				<p class="kol_vo_rating">
					 <?=intval($arRating['OCENKA'][1])?>
				</p>
 </li>
			</ul>
		</div>
		<div class="clear">
		</div>
	</div>
	<div class="clear">
	</div>
</div>
<div class="clear">
</div>
<div class="all_comment">
	<div class="text_comment_block">
		<div class="button_text_comment page_comment_button">
 <a class="red_button fancybox" href="#js_add_text_comment" onclick="$('.ot').show(); $('.ov').hide();"><i>ОСТАВИТЬ</i> текстовый отзыв</a>
			<p>
				 Отзывы наших клиентов
			</p>
		</div>
		 <?
				
                $order = "desc";
				switch ($sort)
				{
					case "age_desc":
					    $sort = "ID";
					    break;
					case "age_asc":
					    $sort = "ID";
						$order = "asc";
					    break;
					case "ocenka_desc":
					    $sort = "PROPERTY_OCENKA_VALUE";
					    break;
					case "ocenka_asc":
					    $sort = "PROPERTY_OCENKA_VALUE";
						$order = "asc";
					    break;
					default:
					    $sort = $sort;
				}
				?> <?$arOtzText = Array("!PROPERTY_VIDEO_VALUE" => "Y")?> <?$APPLICATION->IncludeComponent(
	"bitrix:news.list",
	"otziv_text",
	Array(
		"ACTIVE_DATE_FORMAT" => "j F H:i",
		"ADD_SECTIONS_CHAIN" => "N",
		"AJAX_MODE" => "N",
		"AJAX_OPTION_HISTORY" => "N",
		"AJAX_OPTION_JUMP" => "N",
		"AJAX_OPTION_STYLE" => "Y",
		"CACHE_FILTER" => "N",
		"CACHE_GROUPS" => "Y",
		"CACHE_TIME" => "36000000",
		"CACHE_TYPE" => "A",
		"CHECK_DATES" => "Y",
		"DETAIL_URL" => "",
		"DISPLAY_BOTTOM_PAGER" => "Y",
		"DISPLAY_DATE" => "Y",
		"DISPLAY_NAME" => "Y",
		"DISPLAY_PICTURE" => "Y",
		"DISPLAY_PREVIEW_TEXT" => "Y",
		"DISPLAY_TOP_PAGER" => "N",
		"FIELD_CODE" => array(),
		"FILTER_NAME" => "arOtzText",
		"HIDE_LINK_WHEN_NO_DETAIL" => "N",
		"IBLOCK_ID" => "17",
		"IBLOCK_TYPE" => "servis",
		"INCLUDE_IBLOCK_INTO_CHAIN" => "N",
		"INCLUDE_SUBSECTIONS" => "Y",
		"NEWS_COUNT" => "10",
		"PAGER_DESC_NUMBERING" => "N",
		"PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
		"PAGER_SHOW_ALL" => "N",
		"PAGER_SHOW_ALWAYS" => "N",
		"PAGER_TEMPLATE" => "arrows_adm",
		"PAGER_TITLE" => "Отзывы",
		"PARENT_SECTION" => "",
		"PARENT_SECTION_CODE" => "",
		"PREVIEW_TRUNCATE_LEN" => "",
		"PROPERTY_CODE" => array("VIDEO","TYPE","KOMU","NOMER_ZAKAZA","EMAIL","TELEPHON","OCENKA"),
		"SET_BROWSER_TITLE" => "N",
		"SET_META_DESCRIPTION" => "N",
		"SET_META_KEYWORDS" => "N",
		"SET_STATUS_404" => "N",
		"SET_TITLE" => "N",
		"SORT_BY1" => $sort,
		"SORT_BY2" => "SORT",
		"SORT_ORDER1" => $order,
		"SORT_ORDER2" => "ASC"
	)
);?>
	</div>
	<div class="video_comment_block">
		<div class="button_text_comment page_comment_button">
 <a class="red_button fancybox" href="#js_add_text_comment" onclick="$('.ov').show(); $('.ot').hide();"><i>ПРИСЛАТЬ</i>видео отзыв</a>
			<p>
				 Видео отзывы наших клиентов
			</p>
		</div>
		 <?$arOtzVideo = Array("PROPERTY_VIDEO_VALUE" => "Y")?> <?$APPLICATION->IncludeComponent(
	"bitrix:news.list",
	"otziv_video",
	Array(
		"ACTIVE_DATE_FORMAT" => "j F H:i",
		"ADD_SECTIONS_CHAIN" => "N",
		"AJAX_MODE" => "N",
		"AJAX_OPTION_HISTORY" => "N",
		"AJAX_OPTION_JUMP" => "N",
		"AJAX_OPTION_STYLE" => "Y",
		"CACHE_FILTER" => "N",
		"CACHE_GROUPS" => "Y",
		"CACHE_TIME" => "36000000",
		"CACHE_TYPE" => "A",
		"CHECK_DATES" => "Y",
		"DETAIL_URL" => "",
		"DISPLAY_BOTTOM_PAGER" => "Y",
		"DISPLAY_DATE" => "Y",
		"DISPLAY_NAME" => "Y",
		"DISPLAY_PICTURE" => "Y",
		"DISPLAY_PREVIEW_TEXT" => "Y",
		"DISPLAY_TOP_PAGER" => "N",
		"FIELD_CODE" => array(),
		"FILTER_NAME" => "arOtzVideo",
		"HIDE_LINK_WHEN_NO_DETAIL" => "N",
		"IBLOCK_ID" => "17",
		"IBLOCK_TYPE" => "servis",
		"INCLUDE_IBLOCK_INTO_CHAIN" => "N",
		"INCLUDE_SUBSECTIONS" => "Y",
		"NEWS_COUNT" => "5",
		"PAGER_DESC_NUMBERING" => "N",
		"PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
		"PAGER_SHOW_ALL" => "N",
		"PAGER_SHOW_ALWAYS" => "N",
		"PAGER_TEMPLATE" => "featured_paginator",
		"PAGER_TITLE" => "Отзывы",
		"PARENT_SECTION" => "",
		"PARENT_SECTION_CODE" => "",
		"PREVIEW_TRUNCATE_LEN" => "",
		"PROPERTY_CODE" => array("VIDEO","TYPE","KOMU","NOMER_ZAKAZA","EMAIL","TELEPHON","OCENKA"),
		"SET_BROWSER_TITLE" => "N",
		"SET_META_DESCRIPTION" => "N",
		"SET_META_KEYWORDS" => "N",
		"SET_STATUS_404" => "N",
		"SET_TITLE" => "N",
		"SORT_BY1" => $sort,
		"SORT_BY2" => "SORT",
		"SORT_ORDER1" => $order,
		"SORT_ORDER2" => "ASC"
	)
);?>
	</div>
	<div class="clear">
	</div>
</div>
<div class="add_text_comment" id="js_add_text_comment" style="display:none;">
	<div class="ov">
		<div class="add_comment_name">
 <img src="/img/add_comment_name.png">
		</div>
		<p>
 <span class="display_block">Пришлите, пожалуйста, ссылку на снятое Вами видео</span> (видео можно загрузить <a target="_blank" rel="nofollow" href="https://www.youtube.com/">www.youtube.com).</a>
		</p>
		<p>
			 Также видео-файл можно прислать на e-mail: <a href="mailto:info@diada-arms.ru">info@diada-arms.ru</a>
		</p>
	</div>
	<div class="ot">
		<div class="add_comment_name">
 <img src="/img/add_comment_name.png">
		</div>
		<p>
			 Мы очень дорожим Вашим мнением.
		</p>
		<p>
			 Оставьте свое сообщение, мы ответим в течение 12 часов
		</p>
	</div>
	 <?$APPLICATION->IncludeComponent(
	"bitrix:iblock.element.add.form",
	"otziv_page",
	Array(
		"AJAX_MODE" => "Y",
		"CUSTOM_TITLE_DATE_ACTIVE_FROM" => "",
		"CUSTOM_TITLE_DATE_ACTIVE_TO" => "",
		"CUSTOM_TITLE_DETAIL_PICTURE" => "",
		"CUSTOM_TITLE_DETAIL_TEXT" => "",
		"CUSTOM_TITLE_IBLOCK_SECTION" => "",
		"CUSTOM_TITLE_NAME" => "Ваше имя",
		"CUSTOM_TITLE_PREVIEW_PICTURE" => "",
		"CUSTOM_TITLE_PREVIEW_TEXT" => "Ваше сообщение",
		"CUSTOM_TITLE_TAGS" => "",
		"DEFAULT_INPUT_SIZE" => "30",
		"DETAIL_TEXT_USE_HTML_EDITOR" => "N",
		"ELEMENT_ASSOC" => "CREATED_BY",
		"GROUPS" => array("2"),
		"IBLOCK_ID" => "17",
		"IBLOCK_TYPE" => "servis",
		"LEVEL_LAST" => "Y",
		"LIST_URL" => "",
		"MAX_FILE_SIZE" => "0",
		"MAX_LEVELS" => "100000",
		"MAX_USER_ENTRIES" => "100000",
		"PREVIEW_TEXT_USE_HTML_EDITOR" => "N",
		"PROPERTY_CODES" => array("NAME","PREVIEW_TEXT","4588","4589","4590","4591","4592","4593"),
		"PROPERTY_CODES_REQUIRED" => array("NAME","PREVIEW_TEXT","4588","4589","4593"),
		"RESIZE_IMAGES" => "N",
		"SEF_MODE" => "N",
		"STATUS" => "ANY",
		"STATUS_NEW" => "NEW",
		"USER_MESSAGE_ADD" => "Спасибо! Ваш отзыв добавлен и будет опубликован, после его проверки модераторами!",
		"USER_MESSAGE_EDIT" => "",
		"USE_CAPTCHA" => "N"
	)
);?>
</div>
<?/*
		<div class="why_trust_us_block">
			<div class="why_trust_us">
				<p class="title_why_trust_us">ПОЧЕМУ НАМ ДОВЕРЯЮТ?</p>
				<ul>
					<li class="why_trust_us1">Мы являемся официальными дилерами!<span class="red_circle"></span></li>
					<li class="why_trust_us2">Гарантия магазина на всю продукцию!<span class="red_circle"></span></li>
					<li class="why_trust_us3">Более 10 лет успешной работы!<span class="red_circle"></span></li>
					<li class="why_trust_us4">Только проверенные бренды! Только оригинальный товар!<span class="red_circle"></span></li>
					<li class="why_trust_us5">Предлагаем честные цены без скрытых накруток!<span class="red_circle"></span></li>
				</ul>
				<p class="right_text_why_trust_us">Хотите узнать о нас больше? Более подробная информация здесь: <a href="">Подробнее</a></p>
			</div>
		</div>
		<div class="rating_comment_block">
			<div class="rating_comment_text">
				<a href="">Главная страница</a>
				<p class="title_why_trust_us">ВАШИ ОТЗЫВЫ</p>
				<p>показывать сначала <a href="">самые свежие</a> отзывы</p>
			</div>
			<div class="rating_comment">
				<div class="average_rating">
					<p class="big_rating">4.92</p>
					<p>средняя оценка</p>
				</div>
				<div class="scale_rating">
					<ul>
						<li class="rating5">
							<p class="star_rating"><img src="/img/star5.png"/></p>
							<p class="linear_rating"><span></span></p>
							<p class="kol_vo_rating">1902</p>
						</li>
						<li class="rating4">
							<p class="star_rating"><img src="/img/rating4.png"/></p>
							<p class="linear_rating"><span></span></p>
							<p class="kol_vo_rating">75</p>
						</li>
						<li class="rating3">
							<p class="star_rating"><img src="/img/star3.png"/></p>
							<p class="linear_rating"><span></span></p>
							<p class="kol_vo_rating">14</p>
						</li>
						<li class="rating2">
							<p class="star_rating"><img src="/img/star2.png"/></p>
							<p class="linear_rating"><span></span></p>
							<p class="kol_vo_rating">5</p>
						</li>
						<li class="rating1">
							<p class="star_rating"><img src="/img/star1.png"/></p>
							<p class="linear_rating"><span></span></p>
							<p class="kol_vo_rating">1</p>
						</li>
					</ul>
				</div>
			</div>
		</div>
		<div class="clear"></div>
		<div class="all_comment">
			<div class="text_comment_block">
				<div class="button_text_comment page_comment_button">
					<a class="red_button fancybox" href="#js_add_text_comment"><i>ОСТАВИТЬ</i> текстовый отзыв</a>
					<p>Отзывы наших клиентов</p>
				</div>
				<div class="content_text_comment">
					<div class="photo_text_comment">
						<img src="/img/users_photo.png"/>
						<p>Фернандо</p>
					</div>
					<div class="text_message">
						<ul>
							<li><img src="/img/star5.png"/> Отличный магазин</li>
							<li>19 апреля 01:02</li>
						</ul>
						<div class="gray_text_comment">
							<span class="left_arrow_comment"></span>
							<p>Огромное вам спасибо ребята, у Вас отличный магазин, особенно спасибо менеджеру, они у вас супер,всё доставили, всё отлично, в ШЕДЕВРАЛЬНОМ качестве! В дальнейшем буду работать только с вами! Удачи.</p>
						</div>
					</div>
				</div>
				<div class="content_text_comment">
					<div class="photo_text_comment">
						<img src="/img/users_photo.png"/>
						<p>Фернандо</p>
					</div>
					<div class="text_message">
						<ul>
							<li><img src="/img/star5.png"/> Отличный магазин</li>
							<li>19 апреля 01:02</li>
						</ul>
						<div class="gray_text_comment">
							<span class="left_arrow_comment"></span>
							<p>Огромное вам спасибо ребята, у Вас отличный магазин.</p>
						</div>
					</div>
				</div>
				<div class="content_text_comment">
					<div class="photo_text_comment">
						<img src="/img/users_photo.png"/>
						<p>Фернандо</p>
					</div>
					<div class="text_message">
						<ul>
							<li><img src="/img/star5.png"/> Отличный магазин</li>
							<li>19 апреля 01:02</li>
						</ul>
						<div class="gray_text_comment">
							<span class="left_arrow_comment"></span>
							<p>Огромное вам спасибо ребята, у Вас отличный магазин, особенно спасибо менеджеру, они у вас супер,всё доставили, всё отлично, в ШЕДЕВРАЛЬНОМ качестве! В дальнейшем буду работать только с вами! Удачи.</p>
						</div>
					</div>
				</div>
				<div class="content_text_comment">
					<div class="photo_text_comment">
						<img src="/img/users_photo.png"/>
						<p>Фернандо</p>
					</div>
					<div class="text_message">
						<ul>
							<li><img src="/img/star5.png"/> Отличный магазин</li>
							<li>19 апреля 01:02</li>
						</ul>
						<div class="gray_text_comment">
							<span class="left_arrow_comment"></span>
							<p>Огромное вам спасибо ребята, у Вас отличный магазин, особенно спасибо менеджеру, они у вас супер,всё доставили, всё отлично, в ШЕДЕВРАЛЬНОМ качестве! В дальнейшем буду работать только с вами! Удачи.</p>
						</div>
					</div>
				</div>
				<a class="old_comment" href="">Предыдущие видео-отзывы</a>
			</div>
			<div class="video_comment_block">
				<div class="button_text_comment page_comment_button">
					<a class="red_button fancybox" href="#js_add_video_comment"><i>ПРИСЛАТЬ</i>видео отзыв</a>
					<p>Видео отзывы наших клиентов</p>
				</div>
				<div class="content_video_comment">
					<div class="video_block">
						<img src="/img/video.png"/>
					</div>
					<p>НАЗВАНИЕ ВИДЕО</p>
				</div>
				<div class="content_video_comment">
					<div class="video_block">
						<img src="/img/video.png"/>
					</div>
					<p>НАЗВАНИЕ ВИДЕО</p>
				</div>
			<a class="old_comment" href="">Предыдущие видео-отзывы</a>
			</div>
			<div class="clear"></div>
		</div>
<div class="add_text_comment" id="js_add_text_comment">
	<div class="add_comment_name"><img src="/img/add_comment_name.png"/></div>
	<p>Мы очень дорожим Вашим мнением.</p>
	<p>Оставьте свое сообщение, мы ответим в течение 12 часов</p>
	<form>
	<ul class="add_comment_form">
		<li>
			<div>
				<p>ТИП СООБЩЕНИЯ</p>
				<select>
					<option>Поблагодарить</option>
					<option>Поблагодарить2</option>
					<option>Поблагодарить3</option>
				</select>
			</div>
			<div>
				<p>КОМУ БЛАГОДАРНОСТЬ</p>
				<select>
					<option>Курьеру</option>
					<option>Курьеру2</option>
					<option>Курьеру3</option>
				</select>
			</div>
			<div>
				<p>НОМЕР ЗАКАЗА</p>
				<input type="text" />
			</div>
		</li>
		<li>
			<div>
				<p>ВАШЕ СООБЩЕНИЕ</p>
				<textarea placeholder="Укажите максимально подробную информацию"></textarea>
			</div>
			<div>
				<p>ВАША ОЦЕНКА</p>
				<div class="add_comment_star">
					<input name="star_radio" type="radio"/>
					<input name="star_radio" type="radio"/>
					<input name="star_radio" type="radio"/>
					<input name="star_radio" type="radio"/>
					<input name="star_radio" type="radio"/>
				</div>
			</div>
		</li>
		<li>
			<div>
				<p>ВАШЕ ИМЯ</p>
				<input type="text" />
			</div>
			<div>
				<p>ЭЛЕКТРОННАЯ ПОЧТА</p>
				<input type="text" />
			</div>
			<div>
				<p>МОБИЛЬНЫЙ ТЕЛЕФОН</p>
				<input type="text" />
			</div>
		</li>
	</ul>
	<input type="submit" class="red_button" value="" />
	</form>
</div>
<div class="add_text_comment" id="js_add_video_comment">
	<div class="add_comment_name"><img src="/img/add_comment_name.png"/></div>
	<p><span class="display_block">Пришлите, пожалуйста, ссылку на снятое Вами видео</span> (видео можно загрузить <a href="">http://www.youtube.com/).</a></p>
	<p>Также видео-файл можно прислать на e-mail: <a href="">info@diada-arms.ru</a></p>
	<form>
	<ul class="add_comment_form">
		<li>
			<div>
				<p>ТИП СООБЩЕНИЯ</p>
				<select>
					<option>Поблагодарить</option>
					<option>Поблагодарить2</option>
					<option>Поблагодарить3</option>
				</select>
			</div>
			<div>
				<p>КОМУ БЛАГОДАРНОСТЬ</p>
				<select>
					<option>Курьеру</option>
					<option>Курьеру2</option>
					<option>Курьеру3</option>
				</select>
			</div>
			<div>
				<p>НОМЕР ЗАКАЗА</p>
				<input type="text" />
			</div>
		</li>
		<li>
			<div>
				<p>ВАШЕ СООБЩЕНИЕ</p>
				<textarea placeholder="Укажите максимально подробную информацию"></textarea>
			</div>
			<div>
				<p>ВАША ОЦЕНКА</p>
				<div class="add_comment_star"><img src="/img/add_comment_star.png"/></div>
			</div>
		</li>
		<li>
			<div>
				<p>ВАШЕ ИМЯ</p>
				<input type="text" />
			</div>
			<div>
				<p>ЭЛЕКТРОННАЯ ПОЧТА</p>
				<input type="text" />
			</div>
			<div>
				<p>МОБИЛЬНЫЙ ТЕЛЕФОН</p>
				<input type="text" />
			</div>
		</li>
	</ul>
	<input type="submit" class="red_button" value="" />
	</form>
</div>*/?><?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>