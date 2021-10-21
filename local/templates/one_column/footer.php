<?/*if (!Salavey::CheckTemplate(array("/search/","/personal/cart/","/personal/order/"))):?>
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
            <?endif;*/?>
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
        <div class="clear">
        </div>
    </div>
</div>
 <?if ($isIndex):?>
<div class="content display_none_m display_none_mp">
    <div class="right_column">
        <div class="index_articles_block">
             <!-- <div class="index_articles_title"><a href="/articles/stati/">Статьи</a></div> --> <? /*
                            $APPLICATION->IncludeComponent(
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
                            );
                            */?>
        </div>
        <div class="index_video_block">
            <div class="index_video_title">
 <a href="https://www.youtube.com/channel/UCpx95geyK5SdesTV82S3ODQ"><img src="null" data-src="/img/yt.png" alt=""></a><a href="/video-obzory/">Наши видеообзоры</a>
            </div>
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
        "CACHE_TIME" => "3600000",
        "CACHE_TYPE" => "A",
        "CHECK_DATES" => "Y",
        "DETAIL_URL" => "",
        "DISPLAY_BOTTOM_PAGER" => "N",
        "DISPLAY_DATE" => "Y",
        "DISPLAY_NAME" => "Y",
        "DISPLAY_PICTURE" => "Y",
        "DISPLAY_PREVIEW_TEXT" => "Y",
        "DISPLAY_TOP_PAGER" => "N",
        "FIELD_CODE" => array("",""),
        "FILTER_NAME" => "",
        "HIDE_LINK_WHEN_NO_DETAIL" => "N",
        "IBLOCK_ID" => FCbit\Conf::FCbit_VIDEO_IBLOCK_ID,
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
        "PROPERTY_CODE" => array("VIDEO",""),
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
         <?/*<div class="section social_tabs bottom_social_tabs display_none_c" id="social_tabs_bottom">
                        <?\Bitrix\Main\Page\Frame::getInstance()->startDynamicWithID("social_tabs_bottom");?>
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
                        <?\Bitrix\Main\Page\Frame::getInstance()->finishDynamicWithID("social_tabs_bottom", "Загрузка...");?>
                    </div>*/?>
        <div class="clear">
        </div>
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
    <div class="clear">
    </div>
</div>
 <?endif;?> <!--/else_product--> <footer class="test gray_bg">
<div class="standart_width">
    <div class="gr_foot_top_bl">
        <div class="gr_foot_top_l">
            <div class="gr_foot_logo">
 <a href="/"><img src="null" data-src="/img/logo_footer.png"></a>
                <?/*<a href="/"><img data-src="/img/2020_Logo_bg.gif"></a>*/?>
            </div>
            <p>
                 © 2010-<?=date('Y')?> Интернет-магазин <a href="http://www.diada-arms.ru">www.diada-arms.ru</a> - товары для охоты, спорта и отдыха
            </p>
            <p>
 <a href="/sitemap.php">Карта сайта</a>
            </p>


<p class="foter_text">
    Обращаем ваше внимание на то, что данный Интернет-сайт, носит исключительно информационный характер, и не является публичной офертой, определяемой положениями Статьи 437 Гражданского кодекса Российской Федерации.
    Для получения подробной информации о стоимости и условий продажи товаров, пожалуйста, обращайтесь к менеджерам по продажам магазинов DIADA-ARMS.RU.
    При оплате заказа онлайн покупатель соглашается с <a href="/public_offer_for_sale_of_goods" class="phone_free" target="_blank">публичной офертой</a>.<br>
    Вся лицензионная продукция на сайте diada-arms.ru представлена в ознакомительных целях, и не может быть оплачена и приобретена дистанционым способом.
</p>

             <?/*<p><img src="https://ak-api.kalashnikovgroup.ru/upload/medialibrary/c9a/c9ae20befcc1b150a39aa5d6d3ef9883.png" /></p>*/?>
        </div>
        <div class="gr_foot_top_c">
            <div class="gr_foot_podpiska_bl">
                 <?$APPLICATION->IncludeComponent(
    "salavey:subscribe",
    "footer1",
    Array(
        "COMPONENT_TEMPLATE" => ".default",
        "EXISTS_STRING" => "Такой адрес уже добавлен в подписку",
        "MAIL_STRING" => "Указанный адрес не является почтой",
        "OK_DELETE_SUB" => "Ваш адрес был удален из подписки на сайте diada-arms.ru",
        "OK_STRING" => "Ваш адрес добавлен в подписку на сайте diada-arms.ru"
    )
);?>
            </div>
            <div class="gr_foot_soc_bl">
                <div class="gr_foot_soc_tit">
                     Мы в социальных сетях:
                </div>
                <div class="foot_new_soc">
                     <?$APPLICATION->IncludeComponent(
    "bitrix:main.include",
    "",
    Array(
        "AREA_FILE_SHOW" => "file",
        "AREA_FILE_SUFFIX" => "inc",
        "EDIT_TEMPLATE" => "",
        "PATH" => "/include/inc_soc.php"
    )
);?>
                </div>
            </div>
            <div class="gr_foot_app_gplay">
                <!-- <div class="top_foot_mob">
                     <?$APPLICATION->IncludeComponent(
    "bitrix:main.include",
    "",
    Array(
        "AREA_FILE_SHOW" => "file",
        "AREA_FILE_SUFFIX" => "inc",
        "EDIT_TEMPLATE" => "",
        "PATH" => "/include/inc_mob.php"
    )
);?>
                </div>-->
            </div>
			<div><p class="foot-partner-logo">
 <img src="https://ak-api.kalashnikovgroup.ru/upload/medialibrary/c9a/c9ae20befcc1b150a39aa5d6d3ef9883.png">
            </p></div>
			
        </div>
        <div class="gr_foot_top_r">
 <a class="gr_foot_call fancy_ajax" href="/include/popup_callback.php"><i class="fa fa-phone" aria-hidden="true"></i>Заказать звонок</a>
            <div class="top_foot_tel" id="telephone_logo">
                 <?\Bitrix\Main\Page\Frame::getInstance()->startDynamicWithID("telephone_logo");?> <?
                                foreach ($curRegionNumbers as $val) {
                                    preg_match("#([\d-\(\)\s]*)\s(.*)#i", $val['VALUE'], $arPhone)?>
                <div class="foot_tel_el">
 <i class="fa fa-phone" aria-hidden="true"></i> <a href="tel:<?=$arPhone[1]?>"><?=$arPhone[1]?></a>
                    <?=$arPhone[2]?>
                </div>
                 <?}?> <!--                                --><?//$APPLICATION->IncludeComponent(
//                                    "bitrix:news.detail",
//                                    "contacts_phones_head",
//                                    Array(
//                                        "ACTIVE_DATE_FORMAT" => "d.m.Y",
//                                        "ADD_ELEMENT_CHAIN" => "N",
//                                        "ADD_SECTIONS_CHAIN" => "N",
//                                        "AJAX_MODE" => "N",
//                                        "AJAX_OPTION_ADDITIONAL" => "",
//                                        "AJAX_OPTION_HISTORY" => "N",
//                                        "AJAX_OPTION_JUMP" => "N",
//                                        "AJAX_OPTION_STYLE" => "Y",
//                                        "BROWSER_TITLE" => "-",
//                                        "CACHE_GROUPS" => "Y",
//                                        "CACHE_TIME" => "36000000",
//                                        "CACHE_TYPE" => "A",
//                                        "CHECK_DATES" => "Y",
//                                        "DETAIL_URL" => "",
//                                        "DISPLAY_BOTTOM_PAGER" => "N",
//                                        "DISPLAY_DATE" => "Y",
//                                        "DISPLAY_NAME" => "Y",
//                                        "DISPLAY_PICTURE" => "Y",
//                                        "DISPLAY_PREVIEW_TEXT" => "Y",
//                                        "DISPLAY_TOP_PAGER" => "N",
//                                        "ELEMENT_CODE" => "",
//                                        "ELEMENT_ID" => getContactsElementID(22),
//                                        "FIELD_CODE" => array("",""),
//                                        "IBLOCK_ID" => "22",
//                                        "IBLOCK_TYPE" => "contacts",
//                                        "IBLOCK_URL" => "",
//                                        "INCLUDE_IBLOCK_INTO_CHAIN" => "N",
//                                        "MESSAGE_404" => "",
//                                        "META_DESCRIPTION" => "-",
//                                        "META_KEYWORDS" => "-",
//                                        "PAGER_BASE_LINK_ENABLE" => "N",
//                                        "PAGER_SHOW_ALL" => "N",
//                                        "PAGER_TEMPLATE" => ".default",
//                                        "PAGER_TITLE" => "Страница",
//                                        "PROPERTY_CODE" => array("REGION",""),
//                                        "SET_BROWSER_TITLE" => "N",
//                                        "SET_CANONICAL_URL" => "N",
//                                        "SET_LAST_MODIFIED" => "N",
//                                        "SET_META_DESCRIPTION" => "N",
//                                        "SET_META_KEYWORDS" => "N",
//                                        "SET_STATUS_404" => "N",
//                                        "SET_TITLE" => "N",
//                                        "SHOW_404" => "N",
//                                        "USE_PERMISSIONS" => "N",
//                                        "USE_SHARE" => "N"
//                                    )
//                                );?> <?\Bitrix\Main\Page\Frame::getInstance()->finishDynamicWithID("telephone_logo", "Загрузка...");?>
            </div>
            <div class="gr_foot_info">
                 <?$APPLICATION->IncludeComponent(
                    "bitrix:main.include",
                    "",
                    Array(
                        "AREA_FILE_SHOW" => "file",
                        "AREA_FILE_SUFFIX" => "inc",
                        "EDIT_TEMPLATE" => "",
                        "PATH" => "/include/inc_fot_email.php"
                    )
                );?> 

                <?$APPLICATION->IncludeComponent(
                    "bitrix:main.include",
                    "",
                    Array(
                        "AREA_FILE_SHOW" => "file",
                        "AREA_FILE_SUFFIX" => "inc",
                        "EDIT_TEMPLATE" => "",
                        "PATH" => "/include/inc_fot_dobratsa.php"
                    )
                );?> 

                <?$APPLICATION->IncludeComponent(
                    "bitrix:main.include",
                    "",
                    Array(
                        "AREA_FILE_SHOW" => "file",
                        "AREA_FILE_SUFFIX" => "inc",
                        "EDIT_TEMPLATE" => "",
                        "PATH" => "/include/inc_fot_oplaty.php"
                    )
                );?>

                <div><a class="agreement" href="/public_offer_for_sale_of_goods">Договор оферты продажи товаров</a></div>
            </div>
             
             <?$APPLICATION->IncludeComponent(
                "bitrix:main.include",
                "",
                Array(
                    "AREA_FILE_SHOW" => "file",
                    "AREA_FILE_SUFFIX" => "inc",
                    "EDIT_TEMPLATE" => "",
                    "PATH" => "/include/foot_paykeeper.php"
                )
            );?>
        </div>
    </div>
    <div class="gr_foot_prava_bl">
        <div class="gr_foot_prava_txt">
             <?/*<p>Обращаем Ваше внимание на то, что данный Интернет-сайт носит исключительно информационный характер и ни при каких условиях не является публичной офертой, определяемой положениями Статьи 437 Гражданского кодекса Российской Федерации.</p>
                        <p>Для получения подробной информации о стоимости и условий продажи товаров, пожалуйста, обращайтесь к менеджерам по продажам магазинов Diada-arms.ru</p>*/?> <a style="display: none; width: 100%;" href="javascript:void(0);" class="foot_versiya_site" id="mob" onclick=""></a>
            <script>
                        function getCookie(name) 
                        {
                            var matches = document.cookie.match(new RegExp(
                                "(?:^|; )" + name.replace(/([\.$?*|{}\(\)\[\]\\\/\+^])/g, '\\$1') + "=([^;]*)"
                            ));
                          
                            return matches ? decodeURIComponent(matches[1]) : undefined;
                        }
                        
                        function setMetaContent(name,content)
                        {
                            if(name == "" || name == undefined || content == "" || content == undefined)
                                return false;
                            meta_tags = document.getElementsByTagName("meta");
                            for (var i = 0; i < meta_tags.length; i++) 
                            { 
                                var attrName = meta_tags[i].getAttribute("name"); 
                                if ( attrName == name ) 
                                { 
                                    meta_tags[i].content = content; 
                                }
                            }
                        }
                        
                        if ((document.cookie.indexOf("mob=no") != -1 || document.getElementsByTagName("body")[0].offsetWidth<=999) && getCookie("mob") != "no") 
                        {
                            element = document.getElementById("mob");
                            element.setAttribute("onclick","setCookie('mob', 'no', 86400, '/');location.reload();");
                            element.innerHTML = "Полная версия сайта";
                            document.getElementById("mob").style.display='block';
                        }
                        else if(getCookie("mob") == "no")
                        {
                            element = document.getElementById("mob");
                            element.setAttribute("onclick","setCookie('mob', 'yes', 86400, '/');location.reload();");
                            element.innerHTML = "Мобильная версия сайта";
                            document.getElementById("mob").style.display='block';    
                        }
                        
                        if(getCookie("mob") != undefined && getCookie("mob") == "no")
                        {
                            setMetaContent("viewport", "width=1250, initial-scale=1");        
                        }
                        else
                        {
                            setMetaContent("viewport", "width=device-width, initial-scale=1");    
                        }
                        
                        </script>
        </div>
    </div>
</div>
 </footer>
<div id="back_top" style="display: none;">
</div>
 <?include_once($_SERVER['DOCUMENT_ROOT'].'/include/salavey_callback.php');?> <script type='text/javascript'>
var _ds = _ds || [];
_ds['campaingid'] = '313';
_ds['banner'] = '1';
_ds['pageviews'] = true;
(function() {
var ds = document.createElement('script');
ds.type = 'text/javascript';
ds.async = true;
ds.src = ('https:' == document.location.protocol? 'https://': 'http://') + 'socadviser.ru/v2/demisale.js';
var s = document.getElementsByTagName('script')[0];
s.parentNode.insertBefore(ds, s);
})();
</script> <?/*<script type="text/javascript" src="/js/custom.js"></script>*/?> <script>


setTimeout(function() { 


$(".head_white_basket_bt").mouseover(function(){
    $(".basket-fsr").hide();$(".basket-vsr").css('display','block');
});
$(".head_white_basket_bt").mouseout(function(){
    $(".basket-fsr").css('display','block');$(".basket-vsr").hide();
});



 }, 1400);


</script> <style>
    @media screen and (min-width: 1366px) {
      .new_banner_page {height: 159px;}
    }
</style> <?/*<iframe src='/title.php' style="display:none;"></iframe>*/?> <?/*  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.13/css/all.css" integrity="sha384-DNOHZ68U8hZfKXOrtjWvjxusGo9WQnrNx2sqG0tfsghAvtVlRW3tvkXWZh58N9jp" crossorigin="anonymous">*/?> <?/*<link href="/font_awesome/css/font-awesome.css" rel="stylesheet" type="text/css" >*/?> <?$APPLICATION->SetAdditionalCSS('/font_awesome/css/font-awesome.css', true);?> <?//$APPLICATION->ShowCSS(true, true);?> <?if (!isset($_COOKIE["cookies-info"])):?>
<div class="cookies-info">
 <button data-dismiss="modal" aria-label="Close" class="close"> <span aria-hidden="true">×</span> </button>
    <div>
         Продолжая работу с сайтом Вы даете согласие на использование cookies Вашего браузера с целью улучшения качества обслуживания на основе Ваших предпочтений и интересов.
    </div>
</div>

<?endif;?>