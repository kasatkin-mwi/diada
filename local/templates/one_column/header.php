<!DOCTYPE html>
<html>

<head>
    <?use Bitrix\Main\Page\Asset;?>
    <?php
    //if (file_exists($_SERVER['DOCUMENT_ROOT'] . '/redir.php')) include_once ($_SERVER['DOCUMENT_ROOT'] . '/redir.php');


    if(strstr($_SERVER['REQUEST_URI'], 'PAGEN_1')
        || strstr($_SERVER['REQUEST_URI'], 'PAGEN_2')
        || strstr($_SERVER['REQUEST_URI'], 'PAGEN_4'))
    {
        $ur = explode('?PAGEN', $_SERVER['REQUEST_URI']);
        echo '<link rel="canonical" href="https://www.diada-arms.ru'.$ur[0].'" />'.PHP_EOL;
    }
    if(strstr($_SERVER['REQUEST_URI'], 'pagen_1')
        || strstr($_SERVER['REQUEST_URI'], 'pagen_2')
        || strstr($_SERVER['REQUEST_URI'], 'pagen_3')
        || strstr($_SERVER['REQUEST_URI'], 'pagen_4'))
    {
        $ur = explode('?pagen', $_SERVER['REQUEST_URI']);
        echo '<link rel="canonical" href="https://www.diada-arms.ru'.$ur[0].'" />'.PHP_EOL;
    }


    if(strstr($_SERVER["REQUEST_URI"],'?PAGEN_3=') && strstr($_SERVER["REQUEST_URI"],'/catalog/'))
    {
        $uri = explode('?PAGEN_3=', $_SERVER["REQUEST_URI"]);
        echo '<link rel="canonical" href="https://www.diada-arms.ru'.$uri[0].'" />'.PHP_EOL;
    }

    /*if ( $_SERVER['REQUEST_URI'] != strtolower( $_SERVER['REQUEST_URI']) ) {
        header('Location: https://'.$_SERVER['HTTP_HOST'] .
                strtolower($_SERVER['REQUEST_URI']), true, 301);
        exit();
    }*/
    ?>
    <title><?$APPLICATION->ShowTitle()?></title>
    <?$APPLICATION->ShowHead();?>

    <meta name=viewport content="width=device-width, initial-scale=1">
    <meta name="cmsmagazine" content="b6eb33e544106e46a6f19715cd585c8e" />
    <link rel="preload" href="/ds-comf/ds-form/index.php?m=getcss" as="style">
    <?$asset= Asset::getInstance();?>
    <?$asset->addCss(SITE_TEMPLATE_PATH.'/styles.css');
    $asset->addCss('/css/style_custom.min.css');
    $asset->addCss('/css/style_filter.css');
    $asset->addCss('/font/font.css');
    $asset->addCss('/css/jquery.formstyler.css');
    $asset->addCss('/css/jquery.fancybox.css');
    $asset->addCss('/css/jquery.bxslider.css');
    $asset->addCss('/css/jquery.lazyloadxt.fadein.css');
    $asset->addCss('/css/footer_style.css');
    $asset->addCss('/css/main.css');
    $asset->addCss('/css/new_catalog.css', true);?>


	
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
    <?$asset->addJs('/js/jquery-1.8.3.min.js');
    $asset->addJs('/js/myswipe.js');
    $asset->addJs('/js/mask/jquery.inputmask.bundle.min.js');
    $asset->addJs('/js/mask/jquery.inputmask-multi.min.js');
    $asset->addJs('/js/jquery.lazyloadxt.min.js');
    $asset->addJs('/js/main.js');
    $asset->addJs('/js/tabs.js');
    $asset->addJs('/js/jquery.cookie.js');
    $asset->addJs('/js/jquery.fancybox.pack.js');
    $asset->addJs('/js/jquery.bxslider.min.js');
    $asset->addJs('/js/jquery.formstyler.min.js');
    $asset->addJs('/js/jquery.lwtCountdown-1.0.js');
    $asset->addJs('/js/misc.js');
    $asset->addJs('/js/lazy.loading.js');
    $asset->addJs('/js/maskedInput.js');
    $asset->addJs('/ds-comf/ds-form/js/dsforms.js');
    $asset->addJs("/d-goals.js");
    $asset->addJs('/js/ya-params.js');
    $asset->addJs('/js/jquery.validate.js');
    $asset->addJs('/js/custom.js');
    $curPage = $APPLICATION->GetCurPage();?>
    <?$isIndex = $curPage == SITE_DIR;?>
    <?$isBasket = $curPage == SITE_DIR."personal/cart/";?>
    <?$isOrder = $curPage == SITE_DIR."personal/order/";?>
    <?global $USER;?>
    <script async>
        (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
            (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
            m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
        })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

        ga('create', 'UA-54963341-1', 'auto');
        ga('send', 'pageview');
    </script>
    <!--LiveInternet counter--><script async type="text/javascript">
        document.write("<a href='//www.liveinternet.ru/click' "+
            "target=_blank><img src='//counter.yadro.ru/hit?t44.6;r"+
            escape(document.referrer)+((typeof(screen)=="undefined")?"":
                ";s"+screen.width+"*"+screen.height+"*"+(screen.colorDepth?
                screen.colorDepth:screen.pixelDepth))+";u"+escape(document.URL)+
            ";"+Math.random()+
            "' alt='' title='LiveInternet' "+
            "border='0' width='0' height='0' style='display:none;'><\/a>")
    </script><!--/LiveInternet-->

    <!-- Yandex.Metrika informer -->
    <a style="display: none;" href="https://metrika.yandex.ru/stat/?id=85480690&amp;from=informer"
       target="_blank" rel="nofollow"><img src="https://informer.yandex.ru/informer/85480690/3_1_FFFFFFFF_EFEFEFFF_0_pageviews"
                                           style="width:88px; height:31px; border:0;" alt="Яндекс.Метрика" title="Яндекс.Метрика: данные за сегодня (просмотры, визиты и уникальные посетители)" class="ym-advanced-informer" data-cid="85480690" data-lang="ru" /></a>
    <!-- /Yandex.Metrika informer -->

    <!-- Yandex.Metrika counter -->
    <script type="text/javascript" >
        (function(m,e,t,r,i,k,a){m[i]=m[i]||function(){(m[i].a=m[i].a||[]).push(arguments)};
            m[i].l=1*new Date();k=e.createElement(t),a=e.getElementsByTagName(t)[0],k.async=1,k.src=r,a.parentNode.insertBefore(k,a)})
        (window, document, "script", "https://mc.yandex.ru/metrika/tag.js", "ym");

        ym(85480690, "init", {
            clickmap:true,
            trackLinks:true,
            accurateTrackBounce:true,
            ecommerce:"dataLayer"
        });
    </script>
    <noscript><div><img src="https://mc.yandex.ru/watch/85480690" style="position:absolute; left:-9999px;" alt="" /></div></noscript>
    <!-- /Yandex.Metrika counter -->

    <meta name="google-site-verification" content="rrJVvYFVDNV1S7ECaEsSEj-QyJCFzRwMV_ddnxHIPZQ" />
    <meta name="yandex-verification" content="034d75b083d3513f" />
    <meta name="yandex-verification" content="624dbb3906b574d7" />
    <meta name="yandex-verification" content="10d78104a8e9bf00" />

    <meta name="google-site-verification" content="VlIlpQBPIFUU1uCs5lgfepaPL0UFMO3WWbCG-HSQeaE" />
    <!-- Global site tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-164249488-1"></script>
    <script>
        window.dataLayer = window.dataLayer || [];
        function gtag(){dataLayer.push(arguments);}
        gtag('js', new Date());

        gtag('config', 'UA-164249488-1');
    </script>


    <?if(!$USER->IsAdmin()):?>
       <?/* <script async type="text/javascript">
            var __cs = __cs || [];
            __cs.push(["setAccount", "6egTDId_bNlOKny3R2uZoMHvfnUfqiav"]);
            __cs.push(["setHost", "//server.comagic.ru/comagic"]);
        </script>
        <script type="text/javascript" async src="//app.comagic.ru/static/cs.min.js"></script>

    
        <!-- BEGIN JIVOSITE CODE -->
        <script async type='text/javascript'>
            (function(){ var widget_id = 'QEPLc3GjAx';
                var s = document.createElement('script'); s.type = 'text/javascript'; s.async = true; s.src = '//code.jivosite.com/script/widget/'+widget_id; var ss = document.getElementsByTagName('script')[0]; ss.parentNode.insertBefore(s, ss);})();</script>
        <!-- END JIVOSITE CODE -->
        
        <script>
            (function(w,d,u){
                var s=d.createElement('script');s.async=true;s.src=u+'?'+(Date.now()/60000|0);
                var h=d.getElementsByTagName('script')[0];h.parentNode.insertBefore(s,h);
            })(window,document,'https://cdn.bitrix24.ru/b2577509/crm/site_button/loader_3_wspckr.js');
        </script>*/?>
    <?endif?>

    <script async>
        $( document ).ready(function()
        {
            $("img[src='/upload/resize_cache/iblock/dc3/910_400_1/diadabanner.png']").parent().addClass("demisale-campaign-banner");
            $("img[src='/upload/resize_cache/iblock/dc3/910_400_1/diadabanner.png']").parent().removeAttr("href");
        });
    </script>

    <meta property='og:type' content='website'/>
    <meta property='og:url' content='https://www.diada-arms.ru<?=$_SERVER["REQUEST_URI"]?>'/>
    <meta property='og:image' content='https://www.diada-arms.ru/img/og/1.jpg'/>
    <meta property='og:src' content='https://www.diada-arms.ru/img/og/1.jpg'/>
    <meta property='og:title' content='<!--title-->'/>
    <style>
	
    </style>
	<?CJSCore::Init(array('ajax', 'window'));?>
	
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
                                    \Bitrix\Main\Page\Frame::getInstance()->finishDynamicWithID("mobile_menu_geo", "");
                                    ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div id="telephone_logo_head">
                    <?\Bitrix\Main\Page\Frame::getInstance()->startDynamicWithID("telephone_logo_head_mobile");?>
                    <?
                    $curRegionNumbers = Bitrix\Iblock\ElementPropertyTable::query()
                        ->addSelect('IBLOCK_ELEMENT_ID')
                        ->addSelect('IBLOCK_PROPERTY_ID')
                        ->addSelect('VALUE')
                        ->where('IBLOCK_ELEMENT_ID', getContactsElementID(\FCbit\Conf::FCbit_HEADER_PHONES_IBLOCK_ID))
                        ->where('IBLOCK_PROPERTY_ID', \FCbit\Conf::FCbit_CONTACT_PHONES_PROPERTY_ID)
                        ->exec()
                        ->fetchAll();
                    foreach ($curRegionNumbers as $val) {
                        preg_match("#([\d-\(\)\s]*)\s(.*)#i", $val['VALUE'], $arPhone)?>
                        <div class="foot_tel_el">
                            <i class="fa fa-phone" aria-hidden="true"></i>
                            <a href="tel:<?=$arPhone[1]?>"><?=$arPhone[1]?></a>
                            <span><?=$arPhone[2]?></span>
                        </div>
                    <?}
//                    $APPLICATION->IncludeComponent(
//                        "bitrix:news.detail",
//                        "contacts_phones_head",
//                        Array(
//                            "ACTIVE_DATE_FORMAT" => "d.m.Y",
//                            "ADD_ELEMENT_CHAIN" => "N",
//                            "ADD_SECTIONS_CHAIN" => "N",
//                            "AJAX_MODE" => "N",
//                            "AJAX_OPTION_ADDITIONAL" => "",
//                            "AJAX_OPTION_HISTORY" => "N",
//                            "AJAX_OPTION_JUMP" => "N",
//                            "AJAX_OPTION_STYLE" => "Y",
//                            "BROWSER_TITLE" => "-",
//                            "CACHE_GROUPS" => "Y",
//                            "CACHE_TIME" => "36000000",
//                            "CACHE_TYPE" => "N",
//                            "CHECK_DATES" => "Y",
//                            "DETAIL_URL" => "",
//                            "DISPLAY_BOTTOM_PAGER" => "N",
//                            "DISPLAY_DATE" => "Y",
//                            "DISPLAY_NAME" => "Y",
//                            "DISPLAY_PICTURE" => "Y",
//                            "DISPLAY_PREVIEW_TEXT" => "Y",
//                            "DISPLAY_TOP_PAGER" => "N",
//                            "ELEMENT_CODE" => "",
//                            "ELEMENT_ID" => getContactsElementID(22),
//                            "FIELD_CODE" => array("",""),
//                            "IBLOCK_ID" => "22",
//                            "IBLOCK_TYPE" => "contacts",
//                            "IBLOCK_URL" => "",
//                            "INCLUDE_IBLOCK_INTO_CHAIN" => "N",
//                            "MESSAGE_404" => "",
//                            "META_DESCRIPTION" => "-",
//                            "META_KEYWORDS" => "-",
//                            "PAGER_BASE_LINK_ENABLE" => "N",
//                            "PAGER_SHOW_ALL" => "N",
//                            "PAGER_TEMPLATE" => ".default",
//                            "PAGER_TITLE" => "Страница",
//                            "PROPERTY_CODE" => array("REGION",""),
//                            "SET_BROWSER_TITLE" => "N",
//                            "SET_CANONICAL_URL" => "N",
//                            "SET_LAST_MODIFIED" => "N",
//                            "SET_META_DESCRIPTION" => "N",
//                            "SET_META_KEYWORDS" => "N",
//                            "SET_STATUS_404" => "N",
//                            "SET_TITLE" => "N",
//                            "SHOW_404" => "N",
//                            "USE_PERMISSIONS" => "N",
//                            "USE_SHARE" => "N",
//                            "COMPOSITE_FRAME_MODE" => "Y",
//                            "COMPOSITE_FRAME_TYPE" => "DYNAMIC_WITHOUT_STUB"
//                        )
//                    );?>
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
                                    "IBLOCK_ID" => FCbit\Conf::FCbit_CATALOG_IBLOCK_ID,
                                    "IBLOCK_TYPE" => "ibCatalog",
                                    "NAME" => "CATALOG_COMPARE_LIST",
                                    "POSITION" => "top left",
                                    "POSITION_FIXED" => "N",
                                    "PRODUCT_ID_VARIABLE" => "id"
                                )
                            );?>
                            <span class="head_white_favorite_tit">Сравнение</span>
                        </a>
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

    <link href="/css/new_header_style.css?i=<?=rand(0,1000)?>" rel="stylesheet" type="text/css" >
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
<!--                        <div class="mobile_header_geo_block">-->
<!--                            <a class="mobile_header_geo js_mobile_header_geo" href=""><span>...</span></a>-->
<!--                            <div class="header_geo_light" style="display: block;">-->
<!--                                <div class="header_geo_light_title">Ваш регион: <span>...</span> ?</div>-->
<!--                                <div class="header_geo_light_button">-->
<!--                                    <a class="geo_gray_button" href=""><span>Да</span></a>-->
<!--                                    <a class="geo_red_button fancy_ajax" href="/include/popup_geo.php"><span>Выбрать<br/>другой город</span></a>-->
<!--                                </div>-->
<!--                            </div>-->
<!--                        </div>-->
                        <?
                        $frame->end();
                        ?>

                    </div>
                    <div class="head_red_menu_bl">

                        <?$APPLICATION->IncludeComponent(
                            "bitrix:menu",
                            "top_new",
                            array(
                                "ALLOW_MULTI_SELECT" => "N",
                                "CHILD_MENU_TYPE" => "top_about",
                                "DELAY" => "N",
                                "MAX_LEVEL" => "2",
                                "MENU_CACHE_TIME" => "3600",
                                "MENU_CACHE_TYPE" => "A",
                                "MENU_CACHE_USE_GROUPS" => "N",
                                "ROOT_MENU_TYPE" => "top",
                                "USE_EXT" => "N",
                                "CACHE_SELECTED_ITEMS" => "N",
                                "COMPONENT_TEMPLATE" => "top_new",
                                "MENU_CACHE_GET_VARS" => array(
                                ),
                                "COMPOSITE_FRAME_MODE" => "A",
                                "COMPOSITE_FRAME_TYPE" => "AUTO"
                            ),
                            false
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

                        <div id="telephone_logo_head">
                            <?
                            $frame = new \Bitrix\Main\Page\FrameBuffered("telephone_logo_head");
                            $frame->begin();
                            ?>
                            <?
                            foreach ($curRegionNumbers as $val) {
                                preg_match("#([\d-\(\)\s]*)\s(.*)#i", $val['VALUE'], $arPhone)?>
                                <div class="foot_tel_el">
                                    <i class="fa fa-phone" aria-hidden="true"></i>
                                    <a href="tel:<?=$arPhone[1]?>"><?=$arPhone[1]?></a>
                                    <span><?=$arPhone[2]?></span>
                                </div>
                            <?}
//                            $APPLICATION->IncludeComponent(
//                                "bitrix:news.detail",
//                                "contacts_phones_head",
//                                array(
//                                    "ACTIVE_DATE_FORMAT" => "d.m.Y",
//                                    "ADD_ELEMENT_CHAIN" => "N",
//                                    "ADD_SECTIONS_CHAIN" => "N",
//                                    "AJAX_MODE" => "N",
//                                    "AJAX_OPTION_ADDITIONAL" => "",
//                                    "AJAX_OPTION_HISTORY" => "N",
//                                    "AJAX_OPTION_JUMP" => "N",
//                                    "AJAX_OPTION_STYLE" => "Y",
//                                    "BROWSER_TITLE" => "-",
//                                    "CACHE_GROUPS" => "Y",
//                                    "CACHE_TIME" => "36000000",
//                                    "CACHE_TYPE" => "A",
//                                    "CHECK_DATES" => "Y",
//                                    "DETAIL_URL" => "",
//                                    "DISPLAY_BOTTOM_PAGER" => "N",
//                                    "DISPLAY_DATE" => "Y",
//                                    "DISPLAY_NAME" => "Y",
//                                    "DISPLAY_PICTURE" => "Y",
//                                    "DISPLAY_PREVIEW_TEXT" => "Y",
//                                    "DISPLAY_TOP_PAGER" => "N",
//                                    "ELEMENT_CODE" => "",
//                                    "ELEMENT_ID" => getContactsElementID(22),
//                                    "FIELD_CODE" => array(
//                                        0 => "",
//                                        1 => "",
//                                    ),
//                                    "IBLOCK_ID" => "22",
//                                    "IBLOCK_TYPE" => "contacts",
//                                    "IBLOCK_URL" => "",
//                                    "INCLUDE_IBLOCK_INTO_CHAIN" => "N",
//                                    "MESSAGE_404" => "",
//                                    "META_DESCRIPTION" => "-",
//                                    "META_KEYWORDS" => "-",
//                                    "PAGER_BASE_LINK_ENABLE" => "N",
//                                    "PAGER_SHOW_ALL" => "N",
//                                    "PAGER_TEMPLATE" => ".default",
//                                    "PAGER_TITLE" => "Страница",
//                                    "PROPERTY_CODE" => array(
//                                        0 => "REGION",
//                                        1 => "",
//                                    ),
//                                    "SET_BROWSER_TITLE" => "N",
//                                    "SET_CANONICAL_URL" => "N",
//                                    "SET_LAST_MODIFIED" => "N",
//                                    "SET_META_DESCRIPTION" => "N",
//                                    "SET_META_KEYWORDS" => "N",
//                                    "SET_STATUS_404" => "N",
//                                    "SET_TITLE" => "N",
//                                    "SHOW_404" => "N",
//                                    "USE_PERMISSIONS" => "N",
//                                    "USE_SHARE" => "N",
//                                    "COMPONENT_TEMPLATE" => "contacts_phones_head",
//                                    "STRICT_SECTION_CHECK" => "N",
//                                    "COMPOSITE_FRAME_MODE" => "A",
//                                    "COMPOSITE_FRAME_TYPE" => "AUTO"
//                                ),
//                                false
//                            );?>
                            <?$frame->beginStub();?>
                            <p><span>8 (495) 268-13-72 </span>(Москва)</p>
                            <p><span>8 (800) 707-44-15 </span>(Регионы РФ)</p>
                            <?$frame->end();?>
                        </div>
                        <?php /*<p class="head_info_time">Звоните с 9:00 до 21:00 по Мск</p> getUserLocation() */?>
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
                                        "IBLOCK_ID" => \FCbit\Conf::FCbit_CATALOG_IBLOCK_ID,
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

                            <a href="/order-status/" class="order-button-pro">Отследить/Оплатить заказ</a>

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
                    "IBLOCK_ID" => FCbit\Conf::FCbit_DISPLAY_TEXT_IBLOCK_ID,
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
							"arturgolubev:search.title", 
							"diada", 
							array(
								"CATEGORY_0" => array(
									0 => "iblock_ibCatalog",
								),
								"CATEGORY_0_TITLE" => "",
								"CATEGORY_0_iblock_ibCatalog" => array(
									0 => "1",
								),
								"CHECK_DATES" => "N",
								"CONTAINER_ID" => "smart-title-search",
								"CONVERT_CURRENCY" => "N",
								"FILTER_NAME" => "",
								"INPUT_ID" => "smart-title-search-input",
								"INPUT_PLACEHOLDER" => "",
								"NUM_CATEGORIES" => "1",
								"ORDER" => "rank",
								"PAGE" => "#SITE_DIR#search/index.php",
								"PREVIEW_HEIGHT_NEW" => "60",
								"PREVIEW_TRUNCATE_LEN" => "",
								"PREVIEW_WIDTH_NEW" => "60",
								"PRICE_CODE" => array(
									0 => "base",
								),
								"PRICE_VAT_INCLUDE" => "Y",
								"SHOW_INPUT" => "Y",
								"SHOW_LOADING_ANIMATE" => "N",
								"SHOW_PREVIEW" => "Y",
								"SHOW_PREVIEW_TEXT" => "Y",
								"SHOW_PROPS" => array(
								),
								"TOP_COUNT" => "3",
								"USE_LANGUAGE_GUESS" => "Y",
								"COMPONENT_TEMPLATE" => "diada"
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
                <ul class="mobile_header_top_info js_mobile_header_top_info">
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
                                    0 => "no",
                                ),
                                "CATEGORY_0_TITLE" => "",
                                "CHECK_DATES" => "N",
                                "CONTAINER_ID" => "title-search-mobile",
                                "INPUT_ID" => "title-search-input--mobile",
                                "NUM_CATEGORIES" => "1",
                                "ORDER" => "date",
                                "PAGE" => "#SITE_DIR#search/",
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
			<?/*
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
                    "IBLOCK_ID" => FCbit\Conf::FCbit_DISPLAY_TEXT_IBLOCK_ID,
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
                    "STRICT_SECTION_CHECK" => "N",
                    "SHOW_MORE_LINK" => "Y"
                )
            );?>
			*/?>
        </div>
    </header>
    <style>.basket-vsr{display:none;}</style>

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
        <!--else_product-->




