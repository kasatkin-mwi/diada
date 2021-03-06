<!DOCTYPE html>
<html>

<head>
    <?php  
$noindex = '';
if (file_exists($_SERVER['DOCUMENT_ROOT'] . '/d-robots.php')) {
    include_once ($_SERVER['DOCUMENT_ROOT'] . '/d-robots.php');
    $oRobots = new RobotsTxtParser(file_get_contents($_SERVER['DOCUMENT_ROOT'] . '/robots.txt'));
    $noindex = $oRobots->isDisallowed($_SERVER['REQUEST_URI']) ? '<meta name="googlebot" content="noindex">' . PHP_EOL : '';
}
echo $noindex;

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

/*if ( $_SERVER['REQUEST_URI'] != strtolower( $_SERVER['REQUEST_URI']) ) {
    header('Location: https://'.$_SERVER['HTTP_HOST'] . 
            strtolower($_SERVER['REQUEST_URI']), true, 301);
    exit();
}*/

?>
    <title><?$APPLICATION->ShowTitle()?></title>
    <?//$APPLICATION->ShowHead();
    echo '<meta http-equiv="Content-Type" content="text/html; charset='.LANG_CHARSET.'"'.(true? ' /':'').'>'."\n";
    $APPLICATION->ShowMeta("robots", false, true);
    $APPLICATION->ShowMeta("keywords", false, true);
    $APPLICATION->ShowMeta("description", false, true);
    $APPLICATION->ShowLink("canonical", null, true);

    $APPLICATION->ShowHeadStrings();
    $APPLICATION->ShowHeadScripts();?>
    <?/*<meta name="viewport" content="width=device-width, initial-scale=1">*/?>
    <?/**/?><? if (isset($_COOKIE['mob']) and $_COOKIE['mob']=="no") {?>
        <meta name=viewport content="width=1250, initial-scale=1">
    <? } else { ?>
    <meta name=viewport content="width=device-width, initial-scale=1">
    <? } ?>
    <?/*<link rel="stylesheet" href="/css/reset.css" type="text/css" />*/?>
 
    <?/*<link rel="stylesheet" href="/css/style.min.css?v5" type="text/css" />*/?>
    <?//$APPLICATION->SetAdditionalCSS('/css/reset.css');?>
    <?$APPLICATION->SetAdditionalCSS(SITE_TEMPLATE_PATH.'/styles.css');?>
    <?$APPLICATION->SetAdditionalCSS('/css/style_custom.min.css');?>
<!--    --><?//$APPLICATION->SetAdditionalCSS('/css/style_500_800.min.css');?>
<!--    --><?//$APPLICATION->SetAdditionalCSS('/css/style_799.min.css');?>
<!--    --><?//$APPLICATION->SetAdditionalCSS('/css/style_800.min.css');?>
<!--    --><?//$APPLICATION->SetAdditionalCSS('/css/style_800_1000.min.css');?>
<!--    --><?//$APPLICATION->SetAdditionalCSS('/css/style_1000.min.css');?>
    <?$APPLICATION->SetAdditionalCSS('/css/style_filter.css');?>
    <?$APPLICATION->SetAdditionalCSS('/font/font.css');?>
    <?$APPLICATION->SetAdditionalCSS('/css/jquery.formstyler.css');?>
    <?$APPLICATION->SetAdditionalCSS('/css/jquery.fancybox.css');?>
    <?$APPLICATION->SetAdditionalCSS('/css/jquery.bxslider.css');?>
    <?$APPLICATION->SetAdditionalCSS('/css/main.css');?>

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
    <?$APPLICATION->AddHeadScript('/js/lazy.loading.js');?>
    <?$APPLICATION->AddHeadScript('/js/maskedInput.js');?>
    <?$APPLICATION->AddHeadScript('/ds-comf/ds-form/js/dsforms.js');?>
    <?$APPLICATION->AddHeadScript("//www.google.com/recaptcha/api.js");?>
    <?$APPLICATION->AddHeadScript("/d-goals.js");?>
    <?$APPLICATION->AddHeadScript('/js/ya-params.js');?>
    <?$curPage = $APPLICATION->GetCurPage();?>
    <?$isIndex = $curPage == SITE_DIR."index.php";?>
    <?$isBasket = $curPage == SITE_DIR."personal/cart/index.php";?>
    <?$isOrder = $curPage == SITE_DIR."personal/order/index.php";?>
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
                        webvisor:false,
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
   <meta name="cmsmagazine" content="b6eb33e544106e46a6f19715cd585c8e" />
    <meta name="google-site-verification" content="rrJVvYFVDNV1S7ECaEsSEj-QyJCFzRwMV_ddnxHIPZQ" />
    <meta name="yandex-verification" content="034d75b083d3513f" />
    <meta name="yandex-verification" content="624dbb3906b574d7" />



<?if(!$USER->IsAdmin()):?>
    <script async type="text/javascript">
        var __cs = __cs || [];
        __cs.push(["setAccount", "6egTDId_bNlOKny3R2uZoMHvfnUfqiav"]);
        __cs.push(["setHost", "//server.comagic.ru/comagic"]);
    </script>
    <script type="text/javascript" async src="//app.comagic.ru/static/cs.min.js"></script>

    <?/*
    <!-- BEGIN JIVOSITE CODE -->
    <script async type='text/javascript'>
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
    <script async>
        $( document ).ready(function() 
        {
            $("img[src='/upload/resize_cache/iblock/dc3/910_400_1/diadabanner.png']").parent().addClass("demisale-campaign-banner");
            $("img[src='/upload/resize_cache/iblock/dc3/910_400_1/diadabanner.png']").parent().removeAttr("href");
        });
    </script>

<meta property='og:type' content='website'/>
<meta property='og:url' content='https://www.diada-arms.ru<?=$_SERVER["REQUEST_URI"]?>'/>
<meta property='og:image' content='https://www.diada-arms.ru/upload/resize_cache/iblock/be1/910_400_1/NewYear.png'/>
<meta property='og:src' content='https://www.diada-arms.ru/upload/resize_cache/iblock/be1/910_400_1/NewYear.png'/>
<meta property='og:title' content='<!--title-->'/>
<style>
   html,body,div,span,applet,object,iframe,h1,h2,h3,h4,h5,h6,p,blockquote,pre,a,abbr,acronym,address,big,cite,code,del,dfn,em,img,ins,kbd,q,s,samp,small,strike,strong,tt,var,b,u,i,center,dl,dt,dd,ol,ul,li,fieldset,form,label,legend,table,caption,tbody,tfoot,thead,tr,th,td,article,aside,canvas,details,embed,figure,figcaption,footer,header,hgroup,menu,nav,output,ruby,section,summary,time,mark,audio,video{margin:0;padding:0;border:0;font-size:100%;font:inherit;vertical-align:baseline;box-sizing:border-box}input,textarea{box-sizing:border-box}article,aside,details,figcaption,figure,footer,header,hgroup,menu,nav,section{display:block;box-sizing:border-box}body{line-height:1.2}ol,ul{list-style:none}blockquote,q{quotes:none}blockquote:before,blockquote:after,q:before,q:after{content:'';content:none}table{border-collapse:collapse;border-spacing:0}html body{line-height:1.2}
    :focus{outline:0}.clear{clear:both!important}html{overflow-x:hidden;background:#333}img{max-width:100%}html body{width:100%;font-family:latoregular;font-size:16px;color:#000;margin:0 auto;position:relative;left:0;transition:top 1s ease-in-out 1s;background:#fff}html{height:100%}.body_filter_block_open,.body_mobile_menu_open{overflow:hidden;height:100%}.body_filter_block_open header,.body_filter_block_open section,.body_mobile_menu_open header,.body_mobile_menu_open section{background:#fff;z-index:200}.body_filter_block_open .filter_button_block,.body_mobile_menu_open .filter_button_block,.body_filter_block_open .catalog_menu_mobile_button,.body_mobile_menu_open .catalog_menu_mobile_button{position:relative;z-index:300}.body_filter_block_open header:before,.body_filter_block_open section:before,.body_filter_block_open footer:before,.body_mobile_menu_open header:before,.body_mobile_menu_open section:before,.body_mobile_menu_open footer:before{content:'';position:absolute;display:block;left:0;top:0;right:0;bottom:0;z-index:200}.body_filter_block_open header,.body_filter_block_open section,.body_filter_block_open footer,.body_mobile_menu_open header,.body_mobile_menu_open section,.body_mobile_menu_open footer{left:265px;position:relative}a{color:#000}a:hover,a:focus{/* color:inherit; */text-decoration:none}.detail_box ul,.detail_box p,.center_column ul,.center_column p{margin-bottom:10px}section ol{list-style:decimal outside;margin-bottom:20px;margin-left:20px}section ul{list-style:disc inside}ul.not_style{margin-bottom:0;list-style:none}ul.not_style span{color:#040404!important}.left_img,img[align='left']{float:left;display:block;margin:0 15px 10px 0}.right_img,img[align='right']{float:right;display:block;margin:0 0 10px 15px}.top_header_block{background:#c41a1c;box-shadow:inset 0 -1px 0 0 #cf494a,0 3px 25px 0 rgba(182,182,182,.5);z-index:370;width:100%;position:relative}.top_header{max-width:1200px;width:100%;margin:0 auto;position:relative}ul.header_top_menu{margin:0;}.header_top_menu{display:table;width:100%;padding-right:25%;height:37px}.header_top_menu li{display:table-cell}.header_top_menu a:hover,.header_top_menu a:focus{text-decoration: none;color: #040404;background: #fff;}.header_top_menu a{display:table;height:37px;text-align:center;font-family:latobold;font-size:15px;text-decoration:none;color:#fff;text-transform:uppercase;width:100%}.header_top_menu a span{display:table-cell;width:100%;vertical-align:middle;text-align:center}.header_top_menu li:hover>a,.header_top_menu li.active>a{color:#040404;background:#fff}.basket{position:fixed;top:0;right:0;z-index:300;box-sizing:border-box}.basket>div{border-bottom:1px solid #ababab;border-right:1px solid #ababab;display:table;vertical-align:middle;padding:5px 10px 4px 7px;height:38px;width:405px;box-sizing:border-box;background:#fff;box-shadow:inset 5px 0 3px -2px #ababab;border-radius:0 0 17px 17px}.basket_name{padding-left:35px;background:url(/img/basket.png?v1) 10px center no-repeat;text-transform:uppercase}.red_kol_vo{font-family:latobold;font-size:11px;color:#fff;border-radius:50%;background:#e30613;margin:0 15px 1px 2px;vertical-align:bottom;display:inline-block;width:20px;height:20px;line-height:20px;text-align:center}.basket_name a{font-size:13px;color:#000;text-decoration:none}.basket_name>a{vertical-align:bottom}.basket_money{padding-right:5px;font-size:16px;color:#000;text-decoration:none}.basket_money span{font-family:latoblack}.red_button{background:#c41a1c;background:linear-gradient(to bottom,#c41a1c,#951316);border-radius:4px;font-family:latoblack;font-size:15px;color:#fff;text-decoration:none;cursor:pointer;box-sizing:border-box;display:table;height:30px;line-height:29px;padding:0 10px;min-width:130px;border:0}.red_button:hover{background:#951316;background:linear-gradient(to top,#c41a1c,#951316)}.busket_red_dutton,.basket_name,.basket_money{display:table-cell;vertical-align:middle}.busket_red_dutton{line-height:27px;padding-left:35px;width:165px;height:27px;font-family:latoblack;font-size:15px;color:#fff;background:url(/img/busket_red_dutton_bg.png?v1) 8px center no-repeat #c41a1c;background:url(/img/busket_red_dutton_bg.png?v1) 8px center no-repeat,linear-gradient(to bottom,#c41a1c,#951316)}.busket_red_dutton:hover{background:url(/img/busket_red_dutton_bg.png?v1) 8px center no-repeat #951316;background:url(/img/busket_red_dutton_bg.png?v1) 8px center no-repeat,linear-gradient(to top,#c41a1c,#951316)}.header_vhod{position:absolute;top:100%;right:0;margin-top:2px;border-radius:0 0 20px 20px;background:#bfbfbf;background:linear-gradient(-200deg,#bebebe,#fff 80%);height:30px;box-sizing:border-box;display:table;padding:8px 5px 5px;z-index:150}.header_vhod_n_bg{position:absolute;top:100%;right:0;margin-top:2px;border-radius:0 0 20px 20px;height:30px;box-sizing:border-box;display:table;padding:8px 5px 5px;z-index:150}.header_vhod li{display:table-cell;text-align:center;vertical-align:middle;font-family:latobold;font-size:13px;color:#2f2f2f;padding:0 4px}.header_vhod li:last-child{width:100px}.header_vhod li:first-child{padding-left:0;width:110px}.header_vhod a{text-decoration:none;font-family:latobold;color:#2f2f2f}.header_vhod a:hover{color:#c93133;font-family:latoblack}.telephone_firearm{width:100%;position:relative;padding:0 5px;box-sizing:border-box;max-width:1200px;margin:0 auto}.telephone_logo{padding-top:5px;position:relative;z-index:100;width:400px}.telephone_logo_title{font-family:latobold;font-size:16px!important;color:#000}.telephone_logo img{display:block}.telephone_logo p{font-size:13px;color:#000;margin-bottom:5px}.telephone_logo p span{font-size:22px}.firearm{width:875px;height:auto;background:url(/img/new_firearm_bg_repeat.png?v1) left top repeat-y;background-size:100% auto;position:absolute;right:0;top:-20px;bottom:-10px;z-index:0;box-sizing:border-box;padding:50px 180px 0 80px}.firearm a{display:block;position:relative}.firearm_block1{float:left;width:60%;padding-top:25px;padding-left:12px}.firearm_block1 a{float:left;margin-right:17px}.firearm_block2{width:40%;float:right}.firearm_block3{width:63%;float:left}.firearm_block4{float:left;width:122px;height:67px;padding-left:60px;padding-top:5px}.firearm_hover1,.firearm_hover2,.firearm_hover3,.firearm_hover4,.firearm_hover5{bottom:0;left:0;right:0}.header_red_comment{position:absolute;right:10px;bottom:0}.header_red_comment:hover .header_red_comment_hover{opacity:1}.header_red_comment_hover{position:absolute;top:0;left:0;z-index:100;opacity:0}.bottom_header_menu_block{background:#e6e6e6;width:100%;height:40px;border-bottom:1px solid #ededed;box-shadow:0 3px 6px 0 #e0e0e0;position:relative;/* z-index:350; */clear:both}.bottom_header_menu{display:table;width:100%;margin:0px auto 0;max-width:1200px;height:43px}.red_search{position:relative;z-index:100}.catalog_produce,.bottom_menu,.red_search{display:table-cell;vertical-align:middle;position:relative}.red_search{/* width:290px */}.red_search input[type='text']{height:43px;/* width:273px; */box-sizing:border-box;padding:0 60px 0 10px;border:0;border:1px solid #7c7b7b;font-family:latoitalic;font-size:14px;color:#cccec3;cursor:pointer;border-radius:10px;background:#fff}.red_search:hover input[type='submit']{background:url(/img/new_lupa2.png?v1) left -30px no-repeat}.red_search input[type='submit']{position:absolute;top:50%;right:4px;margin-top:-15px;height:29px;background:url(/img/new_lupa2.png?v1) left top no-repeat;width:35px;border:0;cursor:pointer;text-indent:-99999999px}.red_search_form{position:relative;/* display:table */}.bottom_menu li{font-size:16px;color:#000;line-height:.9}.bottom_menu li a{color:#000;text-decoration:none;display:block;position:relative}.bottom_menu li a:before{position:absolute;left:0;top:50%;margin-top:-17px;width:35px;height:35px;content:'';display:block}.bottom_menu li.bottom_menu3 a:before{width:45px}.bottom_menu li.bottom_menu4 a:before{width:50px}.bottom_menu li a:hover{color:#c41a1c}.bottom_menu1 a:hover:before{background:url(/img/clock_hover.png?v1) left center no-repeat}.bottom_menu1 a{padding-left:40px;min-width:152px!important}.bottom_menu1 a:before{background:url(/img/clock.png?v1) left center no-repeat}.bottom_menu2 a:hover:before{background:url(/img/cursor_hover.png?v1) left center no-repeat}.bottom_menu2 a{padding-left:30px;white-space:nowrap}.bottom_menu2 a:before{background:url(/img/cursor.png?v1) left center no-repeat}.bottom_menu3 a:hover:before{background:url(/img/rub_hover.png?v1) left center no-repeat}.bottom_menu3 a{padding-left:45px}.bottom_menu3 a:before{background:url(/img/rub.png?v1) left center no-repeat}.bottom_menu4 a:hover:before{background:url(/img/email_hover.png?v1) left center no-repeat}.bottom_menu4 a{padding-left:50px;white-space:nowrap}.bottom_menu4 a:before{background:url(/img/email.png?v1) left center no-repeat}.catalog_menu_light,.menu_lvl2{display:none;position:absolute}.catalog_produce{width:270px}.catalog_menu_button{width:270px;display:table;background:url(/img/catalog_menu_button_left.png?v1) 11px center no-repeat #c41a1c;padding:0 15px 0 38px;height:40px;text-decoration:none;border-radius:10px;font-family:latobold;font-size:16px;color:#fff;margin-right:10px}.catalog_menu_button span{display:table-cell;width:100%;padding-right:30px;background:url(/img/catalog_menu_button_right.png?v1) right center no-repeat;vertical-align:middle}.catalog_produce:hover .catalog_menu_light{display:table!important}.catalog_produce:hover .catalog_menu_button{background:url(/img/catalog_menu_button_left.png?v1) 11px center no-repeat #ac090b;background:url(/img/catalog_menu_button_left.png?v1) 11px center no-repeat,linear-gradient(to bottom,#ac090b,#c01719);border-radius:10px 10px 0 0}.catalog_menu_light{top:40px;left:0;width:270px;z-index:400;}.mobile_left_menu_light:after{position:absolute;box-shadow:0 0 10px #000;top:0;bottom:0;right:-.1rem;width:.1rem;content:'';z-index:250}.mobile_left_menu_light{position:absolute;left:0;top:0;width:265px;background:#3c3c3b;overflow-x:hidden}.mobile_catalog_menu_light .menu_lvl2_scroll{z-index:100}.mobile_catalog_menu_light .menu_lvl3_scroll{z-index:200}.mobile_catalog_menu_light .menu_lvl2_scroll,.mobile_catalog_menu_light .menu_lvl3_scroll{position:absolute;left:0;overflow-y:auto;overflow-x:hidden;background:#fff;width:265px;top:0;bottom:0;padding:20px 0 0;-ms-overflow-style:none}.mobile_left_menu_light_scroll{height:100%;background:#333;overflow-y:auto;overflow-x:hidden;position:fixed;width:265px;left:0;-ms-overflow-style:none}.mobile_catalog_menu_light{width:100%;background:#fff;border-bottom:1px solid #686767}.menu_lvl2 li{border-bottom:1px solid #e4e4e4}.mobile_left_menu_light .mobile_menu_geo_button>span>b:before,.mobile_left_menu_light .mobile_menu_geo_button>span>.spanb:before{width:1px;height:31px;display:block;position:absolute;right:19px;background:#e4e4e4;content:'';top:50%;margin-top:-15px}.mobile_left_menu_light .mobile_menu_geo_button>span>b{position:relative;padding-right:40px}.mobile_left_menu_light .mobile_menu_geo_button{padding:10px 25px!important;background:#fff;border-top:1px solid #e4e4e4;font-size:16px!important}.mobile_left_menu_light .menu_lvl1_button:after,.mobile_catalog_menu_light>li>a:after{content:'';display:block;background:url(/img/produce_right_col_arrow.png?v1) left top no-repeat;background-size:10px auto;width:10px;height:18px;top:50%;margin-top:-9px;right:10px;position:absolute;z-index:100}.mobile_left_menu_light .menu_lvl1_button:hover:after,.mobile_catalog_menu_light>li>a:hover:after{background:url(/img/produce_right_col_arrow.png?v1) left bottom no-repeat;background-size:10px auto}.catalog_menu_light{border:1px solid #9a9a9a;background:#e3e3e3;border-right:0}.mobile_left_menu_light .menu_lvl1_button{padding:15px 40px 15px 50px;display:table;width:100%;text-decoration:none;color:#000;font-size:16px;height:66px;position:relative;font-family:latoregular}.mobile_catalog_menu_light>li>a{padding:15px 25px 15px 25px;display:table;width:100%;text-decoration:none;color:#000;font-size:20px;height:68px;position:relative}.catalog_menu_light>li>a{padding:0 20px 0 0;display:table;width:100%;text-decoration:none;background:url(/img/light_menu_arrow.png?v1) 256px center no-repeat;color:#000;font-size:14px;height:36px}.mobile_left_menu_light .menu_lvl1_button i,.catalog_menu_light>li>a i,.mobile_catalog_menu_light>li>a i,.mobile_left_menu_light .menu_lvl1_button .icon,.catalog_menu_light>li>a .icon,.mobile_catalog_menu_light>li>a .icon{display:table-cell;width:40px;text-align:center;display:table-cell;vertical-align:middle}.mobile_left_menu_light .menu_lvl1_button>span,.catalog_menu_light>li>a span,.mobile_catalog_menu_light>li>a span{display:table-cell;vertical-align:middle}.mobile_catalog_menu_light>li>a:hover{color:#c41a1c}.catalog_menu_light>li>a:hover{background:#fff;font-family:latoblack}.catalog_menu_light>li{border-top:1px solid #fff}.mobile_catalog_menu_light>li.menu_dark>a{height:60px}.mobile_catalog_menu_light>li.menu_dark{border-top:1px solid #686767;font-family:latobold}.mobile_catalog_menu_light .menu_lvl1>ul>li,.mobile_catalog_menu_light>li{border-top:1px solid #e6e6e6}.catalog_menu_light>li:first-child{border:0}.catalog_menu_light>li:hover .menu_lvl2{display:block!important}.menu_lvl2{left:100%;background:#fff;top:0;width:920px;min-height:100%;padding:30px 50px;border:1px solid #9a9a9a;border-left:none}.menu_lvl2_column{display:table;float:left}header .telephone_logo .call_back{margin-top:0}.call_back:hover{color:#c41a1c}.call_back{padding:7px 0 6px 44px;background:url(/img/new_call_back_icon.png?v1) left center no-repeat;color:#00b01a}.call_back{font-family:latobold;font-size:16px;line-height:1.4;display:table}.telephone_logo .call_back{margin-top:15px}section{max-width:1200px;width:100%;margin:0 auto;padding:0 5px;text-align:justify}.bread_crumbs{display:table;margin:18px 0;text-align:left}.bread_crumbs li{display:inline-block;padding:0 6px 0 20px;background:url(/img/bread_crumbs_arrow.png?v1) left center no-repeat;font-family:latolight;font-size:13px;color:#000}.bread_crumbs li a{color:#000}.bread_crumbs li:hover a{text-decoration:none}.bread_crumbs li:first-child{padding-left:0;background:0}.shop_contacts_block{width:100%;display:table;padding-bottom:10px;border-bottom:1px solid #686767;font-family:latolight;font-size:17px}h1,.h1{font-family:latolight;font-size:25px;color:#000;margin-bottom:20px}h2,.h2{font-family:latobold;font-size:21px;color:#000;margin-bottom:20px}h3,.h3{font-family:latobold;font-size:17px;color:#000;margin-bottom:20px}h4,.h4{font-family:latoblack;font-size:21px;color:#000;margin-bottom:20px}.telephone_shop_contacts a{font-size:25px}.telephone_shop_contacts{font-family:latolight;font-size:13px!important;padding-left:35px;background:url(/img/telephone_shop_contacts.png?v1) left 6px no-repeat;margin-bottom:5px!important}.telephone_shop_contacts span{font-size:13px}.shop_contacts_block .call_back{font-size:17px;color:#000;text-decoration:none;background:url(/img/call_back_gray.png?v1) left top no-repeat;padding:4px 0 2px 35px}.shop_contacts_block .call_back:hover{color:#c41a1c}.socila_block>div,.socila_block>a{display:inline-block;width:32px;height:31px;margin-right:4px;text-indent:-9999px}.socila_block>div:hover,.socila_block>a:hover{box-shadow:0 0 0 1px #fff,0 0 3px 1px #bbbcbb}.fb{background:url(/img/fb.png?v1) center no-repeat}.tw{background:url(/img/tw.png?v1) center no-repeat}.ok{background:url(/img/ok.png?v1) center no-repeat}.vk{background:url(/img/vk.png?v1) center no-repeat}.google{background:url(/img/g+.png?v1) center no-repeat}.yt{background:url(/img/yt.png?v1) center no-repeat}.inst{background:url(/img/inst_icon_new.jpg?v1) center no-repeat;background-size:32px 31px}.mail_shop_contacts .h2{margin-bottom:0}.skype_mail_block{margin:10px 0 20px;display:table}.skype_mail_block li{display:table-cell;vertical-align:bottom;padding:15px 20px 5px 45px;background:url(/img/gray_skype.png?v1) left bottom no-repeat;font-family:latobold;font-size:17px}.skype_mail_block li:first-child{background:url(/img/gray_mail.png?v1) left bottom no-repeat}.socila{margin-bottom:20px}.socila p{margin-bottom:5px}.priem_zakazov_time p{text-transform:uppercase;margin-bottom:7px}.priem_zakazov_time ul{list-style:none}.priem_zakazov_time li{background:url(/img/li_linear.png?v1) left center no-repeat;padding-left:10px;margin-bottom:5px}.rekvizit_shop_contacts ul{display:table;width:100%;padding:20px 17px;border:1px solid #8e8e8e;box-shadow:inset 0 0 0 1px solid #b6b6b6;border-radius:10px}.rekvizit_shop_contacts ul li{display:table-cell;vertical-align:top;font-size:14px;font-family:latolight}.rekvizit_shop_contacts p{margin-bottom:5px}.rekvizit_shop_contacts ul li:first-child{width:65%}.rekvizit_shop_contacts ul li:last-child{text-align:center}.element_contacts_city_block{display:table;width:100%;margin:30px auto 25px}.map_element_contacts{padding-left:10px}.map_element_contacts img{width:100%;height:450px}.contacts_city_block .h4,.contacts_city_block .h3,.contacts_city_block .red_title{text-align:center;margin-bottom:5px}.red_title{font-family:latobold;font-size:15px;color:#c41a1c}.red_title span{text-transform:uppercase}.metro_title{font-family:latoblack;font-size:17px;padding-left:35px;background:url(/img/metro.png?v1) left top no-repeat;padding-top:2px;margin:0 auto 10px;display:table}.param_element_contacts{display:table;margin-bottom:15px}.param_element_contacts li{display:table-cell;vertical-align:top;font-size:17px;color:#c41a1c}.param_element_contacts li:first-child{padding-right:20px;font-family:latobold;color:#000}.param_element_contacts li p{margin-bottom:0}.param_element_contacts li a{color:#c41a1c}.element_contacts{text-align:left}.element_contacts .red_title{text-align:left;margin-bottom:10px}.red_cursor{padding:7px 0 0 20px;background:url(/img/red_cursor.png?v1) left top no-repeat}.gray_cursor{padding:7px 0 0 20px;background:url(/img/gray_cursor.png?v1) left top no-repeat}.dop_shema_proezda{width:100%;margin:10px auto 0;display:table}.dop_shema_proezda li{display:table-cell;text-align:right}.dop_shema_proezda li:first-child{text-align:left}.dop_shema_proezda li a{font-family:latoblack;font-size:13px;color:#c41a1c}.element_contacts_city .dop_shema_proezda{padding-left:35px;max-width:345px}.min_element_contacts{width:28%;margin:30px 7.6% 0 0;display:inline-block;vertical-align:top}.min_element_contacts .element_contacts{width:325px;margin:0 auto}.min_element_contacts:nth-child(3n){margin-right:0}.min_element_contacts .param_element_contacts li:first-child{max-width:140px}.min_element_contacts .param_element_contacts li{max-width:235px}.gray_days p{color:#686767}.gray_days p span{padding-right:20px}.big_map{width:100%;height:685px;margin:25px auto 35px}.big_map img{width:100%;height:100%}.questions_form p{font-size:13px}input[type='text'],input[type='password']{padding:0 5px;height:30px}textarea{padding:5px;height:100px;resize:vertical}input[type='text'], input[type='password'],textarea{background:#fff;border:1px solid #8e8e8e;box-shadow:inset 0 0 0 1px #e1e1e1;border-radius:4px;resize:vertical;max-width:100%}.questions_form input[type='text']{width:244px;height:40px;line-height:40px}.questions_form textarea{width:746px;height:118px}.questions_form li{font-family:latolight;font-size:13px;margin-bottom:5px}.questions_form ul{margin-bottom:10px!important}.red_submit{height:25px;line-height:26px;font-family:latobold;font-size:13px;color:#fff;text-transform:uppercase;border:0;cursor:pointer;padding:0 15px;border-radius:4px;background:#c41a1c}.red_submit:hover{background:#a7a7a7}.red_button_tabs{display:table;margin:20px auto 25px;text-align:center}.red_button_tabs li{display:inline-block;margin-right:.5%;margin-left:.5%;text-align:center;width:19%;height:45px;line-height:45px;border-radius:4px;background:#a7a7a7;color:#fff;font-family:latolight;font-size:19px;text-transform:uppercase;cursor:pointer;margin-bottom:5px}.red_button_tabs li.current{font-family:latobold;background:#c41a1c}footer{width:100%;margin:30px auto 0;background:url(/img/footer_shadow.png?v1) center top no-repeat #fff;background:url(/img/footer_shadow.png?v1) center top no-repeat,linear-gradient(to bottom,#fff,#dfdfdd);background-size:auto auto;padding-bottom:50px}.footer_block{width:100%;max-width:1200px;padding:0 10px;display:table;margin:0 auto}.footer_prava{margin:30px auto 0;text-align:center;line-height:1.5;font-size:14px}.footer_prava p:first-child{font-size:17px}.footer_info_block .telephone_logo_title{font-size:15px!important}.footer_info_block .bottom_menu ul{padding:0}.footer_info_block .bottom_menu li{padding-right:0;width:25%}.footer_socila_block{float:right;margin-top:40px}.footer_money_block{display:table;float:left;margin-top:37px;height:34px;line-height:34px}.footer_money_block img{max-height:34px;margin-right:10px;vertical-align:middle}footer .call_back{color:#00b01a}.content:after{content:'';display:block;clear:both}.filter_block{width:100%;border-radius:10px;background:#f2f2f2}.element_filter_block{border-bottom:1px solid #fff;padding:10px 23px}.filter_light{font-size:13px}.filter_bottom_light{display:block;padding-left:20px;background:url(/img/filter_bottom_arrow.png?v1) left center no-repeat;font-family:latoblack;font-size:13px;color:#c41a1c;text-decoration:none}.active_filter_bottom_light{background:url(/img/filter_bottom_arrow_active.png?v1) left center no-repeat!important;color:#000!important;margin-bottom:10px}.filter_light label{display:block}.many_checkbox{width:50%;float:left}.filter_block input[type='submit']:hover{text-decoration:none}.money_element{font-family:latoblack;font-size:19px;color:#c41a1c;margin-bottom:10px}.money_element span{font-family:latoregular;font-size:17px;color:#000;text-decoration:line-through;padding-right:10px}.filter_fixed_button.active{padding:5px 0;background:#fff;position:fixed;left:0;bottom:0;width:265px;z-index:100}.buy_number{display:table;float:left;margin:4px 5px 5px 0}.buy_number a img{display:block}.buy_number a,.buy_number input{display:table-cell;padding:0 2px;vertical-align:middle}input[type='text'].number{width:30px;height:30px;background:#fff;text-align:center;padding:0;border:1px solid #a5a5a5;border-radius:6px;box-shadow:inset 0 1px 1px 0 #dbdbdb;color:#605f5f;font-family:Arial;font-size:18px}.list_element_catalog table .money_element span{display:block}.list_element_catalog table{width:100%;text-align:left}.list_element_catalog td{vertical-align:top}.opisanie_element_catalog{display:table;width:100%}.opisanie_element_catalog li{display:table-cell;font-family:latobold;font-size:13px}.opisanie_element_catalog li:first-child{width:140px;font-family:latolight;padding-right:10px}.list_element_img{text-align:center;vertical-align:middle!important}.list_element_opisanie{width:30%}.list_element_buy{width:190px}.buy_element_button{border-radius:6px;padding-left:45px;display:block;float:left;font-family:latoblack;font-size:15px;text-decoration:none;width:108px;height:37px;line-height:37px;background:url(/img/basket_gray.png?v1) 10px center no-repeat #e6e6e6;color:#686767;border:1px solid #686767}.buy_element_button:hover{background:url(/img/basket_white.png?v1) 10px center no-repeat #c41a1c;border:1px solid #c41a1c;color:#fff}.red_buy,.red_buy_detail{width:106px;height:35px;line-height:33px;background:url(/img/basket_white.png?v1) 10px center no-repeat #c41a1c;background:url(/img/basket_white.png?v1) 10px center no-repeat,linear-gradient(to bottom,#c41a1c,#c8292b);border-radius:6px;padding-left:45px;display:block;font-family:latoblack;font-size:15px;color:#fff;text-decoration:none;text-align:left}.red_buy:hover,.red_buy_detail:hover{background:url(/img/basket_white.png?v1) 10px center no-repeat #921316;background:url(/img/basket_white.png?v1) 10px center no-repeat,linear-gradient(to bottom,#921316,#bc191b)}.list_element_title{font-size:13px;text-transform:uppercase;text-decoration:none;display:block;margin-bottom:10px}.list_element_title:hover{color:#c41a1c}.list_element_catalog{padding:21px 1px 11px 26px;border-radius:10px;background:url(/img/shadow_linear1.png?v1) center top no-repeat}.list_element_catalog:first-child{background:none!important}.list_element_catalog:last-child{background:url(/img/shadow_linear1.png?v1) center top no-repeat,url(/img/shadow_linear1.png?v1) center bottom no-repeat}.list_element_catalog:hover{border:1px solid #8e8e8e;padding:20px 0 10px 25px;box-shadow:inset 6px 6px 12px 0 #9e9f9f,6px 6px 12px 0 #9e9f9f;box-sizing:border-box;background:#fff!important;background:linear-gradient(to bottom,#fff 0,#fff 70%,#fafafa 80%,#e5e5e5 100%)!important}.add_sravnenie{margin-top:10px;text-decoration:underline;font-family:latolight;font-size:13px;margin-left:13px}.sortirovka_block{max-width:100%;margin:0 20px 35px 25px}.sortirovka_block ul{display:table;height:25px;font-family:latolight;font-size:13px}.sortirovka_block li{display:table-cell;vertical-align:middle;padding-left:20px}.sortirovka_block li:first-child{padding-left:0}.sortirovka li a{padding-right:15px}.sortirovka{float:left}.vid_tovara{float:right}.table_vid_tovara{padding:4px 0 5px 30px;background:url(/img/table_vid.png?v1) left center no-repeat}.list_vid_tovara{padding:4px 0 5px 30px;background:url(/img/list_vid.png?v1) left center no-repeat}.active_table_vid_tovara{background:url(/img/table_vid_active.png?v1) left center no-repeat!important;text-decoration:none;font-family:latobold}.active_list_vid_tovara{background:url(/img/list_vid_active.png?v1) left center no-repeat!important;text-decoration:none;font-family:latobold}.sort_active_bottom{background:url(/img/linear_bottom.png?v1) right center no-repeat!important;text-decoration:none;font-family:latobold}.sort_active_top{background:url(/img/linear_top.png?v1) right center no-repeat!important;text-decoration:none;font-family:latobold}.table_element_catalog .money_element span{display:block}.table_element_catalog{padding:21px 16px 16px!important}.table_buy_money{display:table;margin:5px auto}.table_element_catalog:hover{padding:20px 15px 15px!important;position:absolute;width:100%;top:0;left:0;z-index:250}.table_element_catalog:hover .table_element_catalog_light{display:table}.table_buy_money li{display:table-cell;vertical-align:middle;padding-top:5px}.table_buy_money li:first-child{padding-top:0}.table_buy_money .buy_number,.table_buy_money .buy_element_button{display:inline-table;float:none}.table_element_catalog .list_element_title{text-align:center;display:block;line-height:1.4}.table_element_catalog .list_element_title span{display:block;font-family:latobold}.table_element_catalog .list_element_img{height:90px;line-height:90px}.table_element_catalog .list_element_img img{vertical-align:middle;max-width:100%;max-height:100%}.table_element_catalog .add_sravnenie{margin:10px auto 0;display:table}p.add_sravnenie label{cursor:pointer;font-size:14px}.table_element_catalog_light{display:none}.left_menu_razdel a{padding:5px 13px 5px 28px;display:block}.left_menu_razdel{border:1px solid #e3e3e3;overflow:hidden}.left_menu_razdel_block{background:url(/img/shadow_linear1.png?v1) left bottom no-repeat;background-size:100% 5px;padding-bottom:5px}.dop_menu_razdel{background:#fff}.dop_menu_razdel li{border-bottom:1px solid #e3e3e3}.dop_menu_razdel li:hover + li{background:url(/img/shadow_linear1.png?v1) left top no-repeat;background-size:100% 7px}.dop_menu_razdel a{font-size:17px;text-decoration:none}.dop_menu_razdel a:hover{font-family:latobold;color:#c41a1c;text-decoration:underline}.dop_menu_razdel_block{background:url(/img/shadow_linear1.png?v1) left bottom no-repeat;background-size:100% 5px;padding-bottom:5px}.left_menu_razdel p{margin-bottom:0}.title_menu_razdel{text-transform:uppercase;padding:10px 0;font-size:17px;font-family:latoblack}.title_menu_razdel a{text-decoration:none}.title_menu_razdel a:hover{color:#c41a1c}.all_dop_razdel{text-align:right}.all_dop_razdel a{text-decoration:underline}.all_dop_razdel a:hover{font-family:latoregular}.dop_menu_razdel_block:last-child{background:0;padding-bottom:0}.razdel_firearm_block{background:url(/img/shadow_block.png?v1) center bottom no-repeat;background-size:100% 12px;padding-bottom:12px;float:left;width:30%;margin:0 3% 30px 0}.razdel_firearm{display:block;background:#fff;border:1px solid #c1c1c1;border-radius:6px;padding:15px 0;height:230px;text-decoration:none;font-family:latoblack;font-size:22px;text-transform:uppercase}.razdel_firearm img{max-height:99%}.razdel_firearm span{display:block;text-align:center;font-family:latoblack}.razdel_firearm:hover{font-family:latoblack;color:#c41a1c;box-shadow:0 0 12px 2px #c1c1c1}.razdel_firearm_img{height:120px;line-height:120px}.razdel_firearm_img img{max-width:98%;vertical-align:middle}.index_catalog_menu_light{display:block!important}.index_slider_block img{display:inline;width:100%}.index_slider_block .bx-controls-auto,.index_slider_block .bx-controls-direction{display:none}.index_slider_block{margin-bottom:5px}.index_slider_block li{width:100%}.timer_red_button{width:244px;height:46px;line-height:42px;margin:0 auto;display:inline-block;border-radius:30px;background:#c41a1c;background:linear-gradient(to bottom,#c41a1c,#941316);border:2px solid #fb0006;border-bottom-color:#5d0102;font-family:latobold;font-size:25px;text-transform:uppercase;color:#fff;text-shadow:0 0 1px #b97173;text-align:center;cursor:pointer}.timer_red_button:hover,.timer_block:hover .timer_red_button{background:#941316;background:linear-gradient(to top,#c41a1c,#941316);border:2px solid #5d0102;border-bottom-color:#fb0006}i{font-family:latoitalic}b{font-family:latobold}.bold{font-family:latobold;font-weight:400}.index_produce:hover .index_produce_title{color:#c41a1c}.index_produce:hover{box-shadow:inset 0 0 0 2px #c41a1c,0 3px 12px 0 #848484}.index_produce{padding:5px 8px 26px;border-radius:10px}.index_produce_img{width:100%;height:120px;line-height:120px;margin:0 auto 8px;text-align:center}.index_produce_img img{vertical-align:middle;text-align:center;max-width:98%;max-height:98%}.index_produce_title{font-family:latomedium;font-size:17px;color:#000;text-align:center;margin-bottom:20px;height:60px;text-decoration:none}.index_produce_title span{display:block}.index_produce ul{display:table;width:100%;margin:10px auto 0}.index_produce ul li{display:table-cell;width:50%;padding-left:15px;vertical-align:middle}.index_produce ul li:first-child{padding-right:15px;padding-left:0;text-align:right}.index_produce li p:first-child{font-size:20px;color:#000;text-decoration:none}.index_produce li p{font-family:latomedium;font-size:17px;color:#686767;text-decoration:line-through;margin-bottom:0}.category_produce{display:table;width:100%;margin-bottom:10px}.category_produce li{display:table-cell;vertical-align:middle}.category_produce p{margin:0}.category_name_block{padding-right:10px}.category_name{height:28px;line-height:28px;min-width:140px;text-align:center;padding:0 8px;border-radius:7px;font-family:latoblack;font-size:13px;color:#fff;text-transform:uppercase}.yellow_hit{background:#fda906}.green_hit{background:#79ca37}.red_hit{background:#f70510}.blue_hit{background:#04a4f7}.category_linear{background:url(/img/category_linear.png?v1) left center repeat-x;width:100%}.category_all{padding-left:10px}.category_all a{color:#356c8f;font-family:latoregular;font-size:14px}.social_right_column{border-left:1px solid #e6e6e6}.all_social_block{padding:8px 0 30px 0;margin:0 0 20px 15px;text-align:center;font-family:latoblack;border-bottom:1px solid #e6e6e6}.all_social_icon{margin-bottom:15px}.all_social_sale{font-size:31px;color:#c41a1c;text-transform:uppercase;margin-bottom:0}.all_social_reg{font-size:24px;color:#000;margin-bottom:15px}.all_social_block .red_button{height:41px;line-height:39px;width:188px;display:block;font-size:20px;color:#fff;margin:0 auto}.social_tabs{padding:0 0 25px 20px}.social_tabs .tabs{height:33px;display:table}.social_tabs .tabs li{font-family:latobold;display:table-cell;font-size:12px;color:#fff;width:32px;vertical-align:middle;border:1px solid #fff;text-align:center;cursor:pointer}.social_tabs .tabs li.current{border-bottom:0}.tabs_vk{background:#5b7fa6}.tabs_ok{background:#f63}.tabs_fb{background:#36c}.tabs_tw{background:#0098ff}.banner_brend_block{width:100%;display:table;border-top:1px solid #e6e6e6;margin-bottom:15px}.index_banner_block a{display:block;margin-bottom:5px;width:100%}.index_banner_block a img{width:100%}.dostavka_menu_title{font-family:latobold;font-size:23px;margin-bottom:15px}.dostavka_menu_title a:hover,.dostavka_menu a:hover{color:#c41a1c;text-decoration:underline}.dostavka_menu_title a,.dostavka_menu a{color:#000;text-decoration:none}.dostavka_menu{padding:15px 0;border:2px solid #e6e6e6;border-radius:10px;width:100%;font-size:15px;font-family:latoregular;margin-bottom:20px!important}.dostavka_menu>li.active{background:#e6e6e6;font-family:latobold}.dostavka_menu>li{padding:3px 20px;margin-bottom:5px}.dostavka_region_title_block{position:relative;display:table;font-size:23px;margin-bottom:15px}.dostavka_region_title{font-family:latobold;text-decoration:underline;padding-right:30px;background:url(/img/dostavka_arrow.png?v1) right center no-repeat}.dostavka_region_title_list_light{width:195px;right:0;top:100%;background:#fff;box-shadow:0 2px 8px 0 #b4b5b4;z-index:300;position:absolute;font-size:13px;display:none;text-align:left}.dostavka_region_title_list_light>li.active{background:#e6e6e6;font-family:latobold}.dostavka_region_title_list_light>li{padding:5px 15px;border-top:1px solid #f3f3f3;box-shadow:inset 0 1px 0 0 #ededd1}.dostavka_region_title_list_light a:hover{text-decoration:underline}.dostavka_region_title_list_light a{text-decoration:none}.dostavka_region_title_podskazka{position:absolute;right:-128px;top:-37px;border:1px solid #e6e6e6;background:#fff;font-size:10px;color:#686767;padding:8px 5px;border-radius:10px;width:160px;text-align:center;box-sizing:border-box;z-index:100}.dostavka_region_title_podskazka_arrow{position:absolute;bottom:-11px;left:15px;z-index:100}.dostavka_tabs_block{display:table;border-radius:8px;border:1px solid #e6e6e6;height:40px;margin-bottom:30px!important}.dostavka_tabs_block>li.current{background:#e6e6e6;cursor:default}.dostavka_tabs_block>li{display:table-cell;vertical-align:middle;text-align:center;font-size:15px;text-transform:uppercase;cursor:pointer;width:185px;border-radius:8px}.dostavka_tabs_car{padding:5px 0 5px 48px;background:url(/img/dostavka_tab1.png?v1) left center no-repeat}.dostavka_tabs_shop{padding:5px 0 5px 42px;background:url(/img/dostavka_tab2.png?v1) left center no-repeat}.dostavka_mo_table sup{font-size:8px;vertical-align:top}.dostavka_mo_table{width:100%;border:0;font-size:13px;color:#000;margin-bottom:15px}.dostavka_mo_table th:first-child{border-radius:8px 0 0 8px}.dostavka_mo_table th:last-child{border-radius:0 8px 8px 0}.dostavka_mo_table th{text-align:center;vertical-align:middle;background:#e6e6e6;padding:10px;text-transform:uppercase}.dostavka_mo_table th span{display:block;text-transform:none}.dostavka_mo_table th:first-child,.dostavka_mo_table td:first-child{text-align:left;width:260px}.dostavka_mo_table td{text-align:center;vertical-align:middle;padding:10px;border-bottom:1px solid #e6e6e6}.dostavka_mo_table_comment{font-size:12px;margin-bottom:25px}.dostavka_mo_table_comment p,.dostavka_small_text p{margin-bottom:0}.dostavka_info_img_block{margin-bottom:10px}.dostavka_small_text{font-size:12px;margin-bottom:30px}.box{display:none}.dostavka_box_block .gray_cursor{background:url(/img/gray_cursor.png?v1) left top no-repeat;background-size:12px auto;padding:0 0 2px 20px}.dostavka_box_block .red_cursor{background:url(/img/red_cursor.png?v1) left top no-repeat;background-size:12px auto;padding:0 0 2px 20px}.dostavka_box_block .metro_title{background:url(/img/metro.png?v1) left top no-repeat;background-size:16px auto}.dostavka_box_block .h4{font-size:16px}.dostavka_box_block .param_element_contacts li,.dostavka_box_block .metro_title,.dostavka_box_block .red_title{font-size:13px}.dostavka_box_block .min_element_contacts .element_contacts{width:auto!important}.dostavka_banner_block{margin:25px auto;text-align:center}.dostavka_mo_table a:hover{text-decoration:underline;color:#c41a1c}.dostavka_mo_table a{text-transform:uppercase;text-decoration:underline;font-family:latobold}.mobile_header_top_info_bg{background:#e6e6e6}.mobile_header_top_info{display:table;width:100%;padding:0 7px;height:53px;font-family:latobold;font-size:16px;color:#000}.mobile_header_top_info>li{display:table-cell;vertical-align:middle;text-align:center}.mobile_header_top_info>li:first-child{text-align:left;width:67px;padding-left:6px}.mobile_header_top_info>li:last-child{width:185px;text-align:right}.mobile_header_top_basket{background:url(/img/mobile_basket.png?v1) 10px center no-repeat #fff;display:inline-block;vertical-align:middle;border:1px solid #d4d4d4;border-radius:10px;width:96px;height:40px;padding:9px 2px 9px 54px;text-decoration:none}.mobile_header_top_basket_kol{display:block;text-align:center;margin:0 auto;width:19px;height:20px;line-height:18px;color:#fff;font-family:latobold;font-size:15px;background:#e30613;border-radius:50%}.mobile_header_top_telephone{background:url(/img/mobile_top_telephone.png?v1) center no-repeat #52ae32;display:inline-block;vertical-align:middle;width:40px;height:40px;border-radius:10px}.mobile_header_top_search{background:url(/img/mobile_top_search.png?v1) center no-repeat #fff;display:inline-block;vertical-align:middle;border:1px solid #d4d4d4;width:40px;height:40px;border-radius:10px}.catalog_menu_mobile_button{background:url(/img/mobile_top_menu.png?v1) center no-repeat #c41a1c;display:block;vertical-align:middle;width:40px;height:40px;border-radius:10px}.razdel_slider>li:nth-child(1n) .razdel_slider_el{background:radial-gradient(circle,#f63232,#b23333)}.razdel_slider>li:nth-child(2n) .razdel_slider_el{background:radial-gradient(circle,#c7c13a,#8b8728)}.razdel_slider>li:nth-child(3n) .razdel_slider_el{background:radial-gradient(circle,#3f71ec,#3c5fb6)}.razdel_slider>li:nth-child(4n) .razdel_slider_el{background:radial-gradient(circle,#eb9115,#a4650f)}.razdel_slider>li:nth-child(5n) .razdel_slider_el{background:radial-gradient(circle,#1bd66f,#128b49)}.razdel_slider>li:nth-child(6n) .razdel_slider_el{background:radial-gradient(circle,#c72ea9,#821e6e)}.razdel_slider_el{display:block;font-family:latoblack;font-size:15px;color:#fff;text-decoration:none;padding:10px 15px 10px}.razdel_slider_el span{display:block}.razdel_slider_el_text{text-transform:uppercase;height:80px;text-align:left}.razdel_slider_el_img{height:120px;line-height:120px;text-align:center;margin-bottom:15px}.razdel_slider_el_img img{vertical-align:middle;max-height:100%;display:inline!important}.razdel_slider_block{padding:0 38px;background:#e3e3e3;border-radius:10px}.razdel_slider_block .bx-wrapper .bx-controls-direction a{top:0;bottom:0;margin-top:0;width:38px;height:100%;text-indent:-9999px;z-index:99}.razdel_slider_block .bx-wrapper .bx-prev{left:-38px;background:url(/img/left_gray_arrow_slider.png?v1) center no-repeat #e3e3e3;border-radius:10px 0 0 10px}.razdel_slider_block .bx-wrapper .bx-next{right:-38px;background:url(/img/right_gray_arrow_slider.png?v1) center no-repeat #e3e3e3;border-radius:0 10px 10px 0}.razdel_slider_block .bx-wrapper .bx-prev:hover{background:url(/img/left_white_arrow_slider.png?v1) center no-repeat #6a6969}.razdel_slider_block .bx-wrapper .bx-next:hover{background:url(/img/right_white_arrow_slider.png?v1) center no-repeat #6a6969}.section_copu_top_menu{position:relative}.section_copu_top_menu .header_vhod{position:absolute;top:0;right:0;height:28px;padding:0 5px}.section_copu_top_menu .header_top_menu a{height:30px}.section_copu_top_menu .header_top_menu{height:30px}.section_copu_top_menu .header_top_menu li{font-size:15px;position:relative}.section_copu_top_menu .header_vhod li{font-size:13px}.section_copu_top_menu .header_vhod li:first-child{width:110px}.section_copu_top_menu .header_vhod li:last-child{width:90px}.razdel_probuce_block{margin-bottom:15px}.section_other_el_menu{display:none;position:absolute;top:28px;left:0;background:rgba(255,255,255,.9);z-index:150;min-width:150px}.section_other_el_menu a.active,.section_other_el_menu a:hover{background:#4e2511;color:#fff;font-family:latoblack}.section_other_el_menu a:first-child{border-top:0}.section_other_el_menu a{display:table;width:100%;font-size:15px;height:27px;border-top:1px solid #e3e3e3;font-family:latoregular}.section_other_el_menu a span{display:table-cell;vertical-align:middle;padding:0 15px;text-align:left}.left_column,.right_column{text-align:left}.index_articles_title{background:url(/img/index_articles_title.png?v1) left bottom no-repeat;padding-left:35px;text-decoration:underline;margin-bottom:17px;font-family:latobold;font-size:20px}.index_articles_el{margin-bottom:25px;font-size:12px}.index_articles_el_name{font-size:14px;margin-bottom:5px}.index_articles_el_name a:hover{text-decoration:none}.index_articles_el_name a{text-decoration:underline;color:#000}.index_articles_block{margin-bottom:10px}.index_video_title>a:first-child img{vertical-align:bottom}.index_video_title>a:first-child{margin-right:5px}.index_video_title{text-decoration:underline;margin-bottom:17px;font-family:latobold;font-size:20px;padding-top:3px}.index_video_el{margin-bottom:23px}.index_video_el_left{float:left;width:40%;padding-top:4px}.index_video_el_right{float:right;width:60%;padding-left:10px}.index_video_el a:hover{text-decoration:none}.index_video_el a{text-decoration:underline;color:#000}.index_more_produce{text-align:center;display:block;margin:0 auto 5px;text-transform:uppercase;color:#c41a1c;font-size:14px;position:relative;padding-bottom:18px;text-decoration:none}.index_more_text_button{display:table;margin:15px auto 25px;color:#c41a1c;font-size:14px;position:relative;padding-bottom:18px;text-decoration:none}.index_more_text_button.show_block:after,.index_more_produce:after{content:"";display:block;position:absolute;left:50%;margin-left:-34px;bottom:0;border-top:14px solid #c41a1c;border-right:34px solid transparent;border-left:34px solid transparent}.index_more_text_button.hide_block:after{content:"";display:block;position:absolute;left:50%;margin-left:-34px;bottom:0;border-bottom:14px solid #c41a1c;border-right:34px solid transparent;border-left:34px solid transparent}.section_copu_top_menu_block{margin-bottom:30px}.index_video_el_left img{width:100%}.section_copu_top_menu_block .header_top_menu>li:last-child img{vertical-align:bottom}.section_copu_top_menu_block .header_top_menu>li:last-child:hover>a{background:0}.podpiska_red_button{display:block;border-radius:4px;font-family:latoblack;font-size:15px;color:#fff;text-decoration:none;cursor:pointer;width:100%;height:37px;line-height:35px;background:#c41a1c;text-align:center}.podpiska_red_button:hover{background:#e43e3e}section input[type="text"]{font-size:15px}.mobile_text_el_block{padding:15px 15px 12px 20px;border-radius:10px;border:1px solid #e6e6e6;margin-bottom:2px;background:#fff}.mobile_text_el_light{display:none}.mobile_text_el_button{display:block;padding:5px 35px 5px 0;color:#000;position:relative;text-decoration:none;font-size:20px;font-family:latobold;text-transform:uppercase}.mobile_text_el_light{padding-top:15px}.mobile_text_el_button.active_mobile_text_el_button:after{background:url(/img/mobile_text_el_button.png?v1) left bottom no-repeat}.mobile_text_el_button:after{content:'';width:28px;height:28px;position:absolute;right:0;top:50%;margin-top:-14px;background:url(/img/mobile_text_el_button.png?v1) left top no-repeat}.mobile_header_telephone_geo{display:table;width:100%;height:54px;padding:0 10px 0 18px}.mobile_header_telephone_geo>li{display:table-cell;vertical-align:middle}.mobile_header_geo:hover span{text-decoration:none}.mobile_header_geo span{padding-left:20px;padding-top:3px;padding-bottom:2px;background:url(/img/mobile_header_geo.png?v1) left bottom no-repeat;text-decoration:underline;display:table;margin:0 auto}.mobile_header_telephone{font-size:21px}.mobile_header_telephone>span{font-size:12px}.gatalog_page_title{font-size:33px;font-family:latolight;padding-bottom:5px;border-bottom:1px solid #e6e6e6;margin-bottom:10px}.detail_page_title{font-size:33px;font-family:latolight;padding-bottom:5px;border-bottom:1px solid #e6e6e6}.filter_button_block{color:#fff;text-decoration:none;width:100%;height:44px;line-height:42px;text-transform:uppercase;text-align:center;font-size:20px;border-radius:10px;cursor:pointer;background:#c41a1c;display:block}.catalog_page_navigator{height:30px;display:table;margin:0 auto;border:1px solid #605f5f}.catalog_page_navigator a:first-child{border-left:none}.catalog_page_navigator a.active{cursor:default}.catalog_page_navigator a.active,.catalog_page_navigator a:hover{background:#e6e6e6}.catalog_page_navigator a{display:table-cell;vertical-align:middle;text-align:center;width:29px;border-left:1px solid #605f5f;text-decoration:none;color:#000;font-size:13px}.catalog_page_navigator_kol{text-align:center;font-size:10px}.catalog_page_navigator_block{margin-bottom:40px}.index_podpiska_form:after{content:'';clear:both;display:block}.geo_light_block{display:none;background:#fff;border-radius:16px;overflow:hidden}.geo_light_block p{margin-bottom:5px}.geo_light_grey_col_list{font-size:18px;padding-left:9px}.geo_light_grey_col_list .active a{font-family:latobold;color:#c41a1c}.geo_light_grey_col_list a,.geo_light_white_col_list a{color:#000;text-decoration:none}.geo_light_block a:hover{color:#c41a1c}.geo_light_white_col_list .active a{color:#c41a1c}.telephone_logo{position:relative}.telephone_logo .mobile_header_geo_block{position:absolute;left:305px;top:-5px;z-index:150;width:auto;max-width:none;display:table;width:200px}.geo_light_white_col_list{height:260px;overflow-y:auto;font-size:18px;padding-left:20px}.geo_light_grey_col_title{margin-bottom:25px;background:#fff;border:1px solid #f2f2f2;border-radius:10px 0 0 10px;border-right:0;padding:6px 8px;text-transform:uppercase;color:#c41a1c;font-size:18px;font-family:latoregular}.geo_light_white_col_title{margin-bottom:25px;background:#fff;border:1px solid #f2f2f2;border-radius:0 10px 10px 0;border-left:none;padding:6px 8px 6px 20px;text-transform:uppercase;color:#c41a1c;font-size:18px;font-family:latoregular;width:109px}.geo_light_search{position:relative;margin-top:10px;margin-bottom:15px}.geo_light_search input[type="text"]{width:100%;padding:0 5px 0 55px;border:1px solid #a7a7a7;background:#fff;border-radius:8px;height:34px;font-size:16px;font-family:latoregular;box-shadow:none}.geo_light_search_button{background:url(/img/geo_search.png?v1) center no-repeat;display:block;width:35px;height:28px;position:absolute;top:50%;margin-top:-14px;left:8px;border:0;cursor:pointer}.geo_light_red_button:hover{background:#c41a1c;color:#fff!important}.geo_light_red_button{display:table;padding:6px 8px 8px;border:1px solid #c41a1c;border-radius:6px;color:#c41a1c;text-decoration:none;background:#fff;margin-bottom:15px;font-family:latoregular;font-size:15px}.geo_light_black_title{font-family:latobold;font-size:18px;margin-bottom:10px!important}.geo_light_red_href{margin-top:12px;color:#c41a1c;font-family:latoregular;font-size:15px;display:block}.catalog_mobile_menu_open{display:block!important;left:0!important;top:0!important;bottom:0!important;width:265px!important}.mobile_left_menu_vhod{display:table;height:52px;background:#fff;padding:0 10px;width:100%}.mobile_left_menu_vhod>li a:hover{color:#c41a1c}.mobile_left_menu_vhod>li a{text-decoration:none}.mobile_left_menu_vhod>li{display:table-cell;vertical-align:middle;padding:0 2px}.open_menu_lvl2{left:0!important;transition:left 1s ease-in-out 1ms;display:block!important}.mobile_menu_geo{position:fixed;top:0;bottom:0;left:100%;display:block;z-index:150;transition:left 1s ease-in-out 1ms;background:#3c3c3b;width:265px;overflow-y:scroll}.mobile_menu_geo .mobile_catalog_menu_come_back{padding:20px 10px 5px 20px;background:#fff}.mobile_catalog_menu_light .menu_lvl3{display:none;position:fixed;top:0;left:100%;z-index:250;transition:left 1s ease-in-out 1ms;padding:0;background:#fff;width:265px;max-width:265px;overflow:hidden;columns:auto!important;min-height:0;border:0}.mobile_catalog_menu_light .menu_lvl2{display:none;position:fixed;top:-1px;left:100%;z-index:150;transition:left 1s ease-in-out 1ms;padding:0;width:265px;max-width:265px;overflow:hidden;columns:auto!important;min-height:0;border:0}.detail_page_top_info_left{display:table;float:left;padding-top:5px}.detail_page_top_info_right{display:table;float:left;padding-top:3px}.detail_page_top_info_articul,.detail_page_top_info_reiting,.detail_page_top_info_button{display:table-cell;vertical-align:middle;padding-right:10px;font-family:latoregular;font-size:13px;position:relative}.detail_page_top_info_reiting,.detail_page_top_info_button{padding-left:10px;border-left:1px solid #e6e6e6}.detail_page_top_info_reiting{width:195px}.detail_page_top_info_reiting a{color:#0260a2}.detail_page_top_info_reiting_star{display:inline-block;vertical-align:middle;padding-right:15px}.red_button_volna{display:table;padding:7px 9px 7px;font-family:latobold;font-size:11px;text-transform:uppercase;color:#fff;text-decoration:none;background:url(/img/red_button_volna.png?v1) left bottom repeat-x #e30613}.detail_page_top_info_button .red_button_volna{display:inline-table;margin-right:7px;vertical-align:middle}.detail_page_top_info_sravneneie img,.detail_page_top_info_print img,.detail_page_top_info_love img,.detail_page_top_info_3point img{vertical-align:middle}.detail_page_top_info_sravneneie,.detail_page_top_info_print,.detail_page_top_info_love,.detail_page_top_info_3point{display:table-cell;vertical-align:middle;padding:0 9px;position:relative}.detail_page_top_info_print,.detail_page_top_info_love,.detail_page_top_info_3point{border-left:1px solid #e6e6e6}.small_podskazka_light_block{position:relative}.small_podskazka_light_block:hover .small_podskazka_light_el{display:block}.small_podskazka_light_el{display:none;position:absolute;top:-100%;left:50%;margin-left:-39px;width:78px;margin-top:-15px;text-align:center;z-index:150;padding:0 5px 2px;border-radius:6px;border:1px solid #686767;background:#fff;font-size:10px;line-height:1}.small_podskazka_light_el:before{border-top:12px solid #686767;border-right:7px solid transparent;border-left:7px solid transparent;content:'';position:absolute;bottom:-12px;left:50%;margin-left:-7px}.small_podskazka_light_el:after{border-top:11px solid #fff;border-right:6px solid transparent;border-left:6px solid transparent;content:'';position:absolute;bottom:-11px;left:50%;margin-left:-6px}.button_red_text_shadow{display:table;padding:0 10px 13px;background:url(/img/detail_button_shadow.png?v1) center bottom no-repeat;background-size:100% 8px;text-transform:uppercase;font-family:latoblack;font-size:10px;color:#e30613;line-height:1}.button_green_text_shadow{display:table;padding:0 10px 13px;background:url(/img/detail_button_shadow.png?v1) center bottom no-repeat;background-size:100% 8px;text-transform:uppercase;font-family:latoblack;font-size:10px;color:#52ae32;line-height:1}.detail_top_big_img_block img{vertical-align:middle;max-height:90%}.detail_top_big_img_block{position:relative;height:280px;text-align:center;line-height:280px}.detail_top_big_img_block .button_red_text_shadow{position:absolute;z-index:100;left:0;top:0}.detail_top_big_img_block .button_green_text_shadow{position:absolute;z-index:100;left:140px;top:0}.detail_top_big_left_col{padding-top:20px}.detail_small_img_gray_el:hover{border-color:#a21617}.detail_small_img_gray_el{display:inline-block;vertical-align:middle;border:1px solid #686767;background:#fff;text-align:center;width:79px;height:79px;line-height:74px;margin-right:10px}.detail_small_img_gray_el img{vertical-align:middle;max-height:98%}.detail_top_big_small_img_title{font-size:13px;margin-bottom:10px}.detail_small_img_3d_el:hover{background:url(/img/detail_3d_sprite.png?v1) left bottom no-repeat #a21617;border-color:#a21617}.detail_small_img_3d_el{display:inline-block;position:relative;vertical-align:middle;border:1px solid #686767;background:url(/img/detail_3d_sprite.png?v1) left top no-repeat #e6e6e6;width:79px;height:79px;margin-right:10px}.detail_small_img_video_el:hover{background:url(/img/detail_black_video.png?v1) left bottom no-repeat}.detail_small_img_video_el{display:inline-block;position:relative;vertical-align:top;background:url(/img/detail_black_video.png?v1) left top no-repeat;width:115px;height:83px}.detail_complect_red_title{text-transform:uppercase;text-align:right;font-family:latoblack;font-size:17px;color:#c41a1c;margin-bottom:15px}.podskazka_block:hover .podskazka_text{display:block}.podskazka_block:hover{background:#c41a1c}.podskazka_block{position:relative;padding:0 7px;background:#e6e6e6;border-radius:50%;font-family:latoregular;font-size:15px;color:#fff;z-index:370}.podskazka_text:before{content:"";background:url(/img/podskazka_text_top_bg_new.png?v1) left top no-repeat;position:absolute;width:200px;height:18px;top:-18px;left:0}.podskazka_text:after{content:"";background:url(/img/podskazka_text_bottom_bg_new.png?v1) left top no-repeat;position:absolute;width:200px;height:70px;bottom:-70px;left:0}.podskazka_text{display:none;position:absolute;bottom:76px;left:50%;margin-left:-113px;width:200px;padding:0 18px 0 15px;background:url(/img/podskazka_text_bg_new.png?v1) repeat-y;text-align:justify;font-family:latoregular;font-size:12px;color:#010101;z-index:200}.detail_complect_el{display:table;width:100%;min-height:30px}.detail_complect_el_l:first-child{width:145px}.detail_complect_el_l:last-child{width:20px}.detail_complect_el_l{display:table-cell;vertical-align:middle;position:relative;z-index:10}.detail_complect_left_block{border:2px solid #686767;border-radius:8px;padding:10px 15px 10px}.status_est{display:block;font-family:latoblack;font-size:10px;color:#52ae32;padding:6px 28px 6px 0;background:url(/img/status_est.png?v1) right center no-repeat;width:100px;text-align:left}.status_zakaz{display:block;font-family:latoblack;font-size:10px;color:#04acfa;padding:6px 28px 6px 0;background:url(/img/status_zakaz.png?v1) right center no-repeat;width:100px;text-align:left}.status_sklad{display:block;font-family:latoblack;font-size:10px;color:#52ae32;padding:6px 28px 6px 0;background:url(/img/status_est.png?v1) right center no-repeat;width:100px;text-align:left}.status_net{display:block;font-family:latoblack;font-size:10px;color:#c41a1c;padding:6px 28px 6px 0;background:url(/img/status_net.png?v1) right center no-repeat;width:100px;text-align:left}.status_snyato{display:block;font-family:latoblack;font-size:10px;color:#605f5f;padding:1px 28px 1px 0;background:url(/img/status_snyato.png?v1) right center no-repeat;width:100px;text-align:left}.detail_complect_buy_block{display:table;width:100%;margin:16px 0 15px!important}.detail_complect_buy_block>li{display:table-cell;vertical-align:middle}.detail_complect_buy_block .red_buy_detail{width:100%}.buy_one_click_button:hover{background:url(/img/buy_one_click_button.png?v1) 23px bottom no-repeat #1e6903;background:url(/img/buy_one_click_button.png?v1) 23px bottom no-repeat,linear-gradient(to bottom,#1e6903,#52ae32);color:#fff;font-family:latoblack}.buy_one_click_button{display:block;width:100%;height:39px;line-height:39px;font-size:17px;color:#000;text-decoration:none;text-align:center;background:url(/img/buy_one_click_button.png?v1) 20px top no-repeat #e6e6e6;border-radius:8px;margin-bottom:7px}.buy_credit_button:hover{background:url(/img/buy_credit_button.png?v1) 23px bottom no-repeat #a6a5a5;background:url(/img/buy_credit_button.png?v1) 23px bottom no-repeat,linear-gradient(to bottom,#a6a5a5,#e6e6e6);color:#c41a1c;font-family:latoblack}.buy_credit_button{display:block;width:100%;height:39px;line-height:39px;font-size:17px;color:#000;text-decoration:none;text-align:center;background:url(/img/buy_credit_button.png?v1) 23px top no-repeat #e6e6e6;border-radius:8px;margin-bottom:7px}.detail_complect_snizim_price{display:block;width:231px;text-decoration:underline;padding:7px 8px 7px 33px;color:#c41a1c;font-size:13px;background:url(/img/detail_complect_snizim_price.png?v1) left center no-repeat;float:right}.detail_complect_snizim_price_block{margin-bottom:6px}.detail_complect_dostavka:hover{background:url(/img/detail_complect_dostavka.png?v1) 22px center no-repeat #e6e6e6}.detail_complect_samovivoz:hover{background:url(/img/detail_complect_samovivoz.png?v1) 22px center no-repeat #e6e6e6}.detail_complect_dostavka{background:url(/img/detail_complect_dostavka.png?v1) 22px center no-repeat}.detail_complect_samovivoz{background:url(/img/detail_complect_samovivoz.png?v1) 22px center no-repeat}.detail_complect_dostavka,.detail_complect_samovivoz{padding:4px 5px 4px 85px;color:#000;font-family:latolight;font-size:13px;margin-bottom:8px;display:block;text-decoration:none}.detail_complect_dostavka>span,.detail_complect_samovivoz>span{display:block}.detail_complect_dostavka_blue{color:#0260a2;font-family:latoregular}.detail_complect_el_new_price{font-family:latobold;font-size:18px;color:#c41a1c;display:block}.detail_complect_el_old_price{font-family:latolight;font-size:18px;color:#686767;display:block;text-decoration:line-through}.detail_complect_el_l_title{font-size:13px;color:#000}.detail_complect_el_price{text-align:right;padding-right:7px}.detail_complect_el.active{background:#686767}.detail_complect_el.active .detail_complect_el_l_title{font-size:15px;color:#fff;font-family:latoblack}.detail_complect_el.active .detail_complect_el_new_price{font-size:21px;color:#fff}.detail_complect_el.active .detail_complect_el_old_price{color:#fff}.detail_complect_el.active{position:relative}.detail_table_option{font-family:latoregular;font-size:16px;margin-bottom:20px;width:100%}.detail_table_option td:first-child{font-family:latobold;width:255px}.detail_table_option td{padding:5px 5px 5px 0}.detail_table_option tr{border-bottom:1px solid #e6e6e6}.detail_box{margin-bottom:25px}.detail_tabs{display:table;width:100%;height:48px;background:#e6e6e6;border-radius:10px;margin-bottom:15px!important}.detail_tabs>li:last-child{width:105px}.detail_tabs>li.current:first-child{border-radius:10px 0 0 10px}.detail_tabs>li.current:last-child{border-radius:0 10px 10px 0}.detail_tabs>li:first-child:before,.detail_tabs>li.current + li:before,.detail_tabs>li.current:before{display:none}.detail_tabs>li.current{background:#c41a1c;color:#fff;font-family:latobold}.detail_tabs>li:before{content:"";width:1px;height:39px;position:absolute;left:0;top:50%;margin-top:-19px;background:#686767}.detail_tabs>li:hover{cursor:pointer;color:#c41a1c}.detail_tabs>li.current:hover{cursor:default;color:#fff}.detail_tabs>li{display:table-cell;vertical-align:middle;text-align:center;text-transform:uppercase;font-size:14px;position:relative;padding:0 10px}.detail_pdf_el_block{margin-bottom:20px}.detail_pdf_el:hover{color:#c41a1c}.detail_pdf_el{background:url(/img/detail_pdf.png?v1) left center no-repeat;color:010101;text-decoration:none;font-size:12px;font-family:latobold;display:inline-block;width:200px;padding-left:65px;min-height:45px;vertical-align:middle;margin-right:15px;text-align:left}.detail_pdf_title{font-size:16px;font-family:latobold;margin-bottom:10px}.detail_complect_el_arrow{position:absolute;z-index:100;width:23px;height:26px;right:-43px;top:50%;margin-top:-13px;display:none}.detail_complect_dop_info_block{border:2px solid #686767;border-radius:8px;text-align:left;padding:10px 15px 10px}.detail_complect_dop_info_list{list-style:none!important;margin-bottom:10px!important;counter-reset:list;font-size:11px}.detail_complect_dop_info_list a:hover{color:#c41a1c;text-decoration:underline}.detail_complect_dop_info_list a{text-decoration:none}.detail_complect_dop_info_list>li:before{content:counters(list,".") ")";counter-increment:list;position:absolute;left:0;width:10px;text-align:right;height:12px;top:0;vertical-align:bottom;display:block}.detail_complect_dop_info_list>li{margin-bottom:0!important;padding-left:15px;position:relative}.detail_complect_dop_info_black_title{font-family:latolight;font-size:17px;color:#686767;text-transform:uppercase;margin-bottom:2px}.detail_complect_dop_info_red_title{font-family:latoblack;font-size:17px;color:#c41a1c;text-transform:uppercase;margin-bottom:10px}.detail_complect_dop_info_price{font-family:latoblack;font-size:17px;color:#c41a1c;margin-bottom:25px}.detail_complect_dop_info_img_el:nth-child(3n){margin-right:0}.detail_complect_dop_info_img_el{display:inline-block;width:57px;height:57px;line-height:57px;vertical-align:middle;text-align:center;margin-right:15px}.detail_complect_dop_info_img_el img{max-height:100%;vertical-align:middle}.detail_navigation_block{display:table;width:100%;font-family:latolight;font-size:12px}.detail_navigation_block>li:last-child{width:170px}.detail_navigation_block>li:first-child{width:130px}.detail_navigation_block>li{display:table-cell;vertical-align:middle}.gray_button:hover{background:#a6a5a5;background:linear-gradient(to bottom,#a6a5a5,#e6e6e6);color:#c41a1c}.gray_button{display:block;border:0;cursor:pointer;width:100%;height:30px;line-height:30px;text-decoration:none;color:#000;font-family:latolight;font-size:14px;border-radius:8px;background:#e6e6e6;text-align:center}.detail_red_button:hover{background:#951316;background:linear-gradient(to bottom,#951316,#c41a1c);color:#fff}.detail_red_button{display:block;border:0;cursor:pointer;width:100%;height:30px;line-height:30px;text-decoration:none;color:#fff;font-family:latolight;font-size:13px;border-radius:8px;background:#c41a1c;text-align:center;text-transform:uppercase}.detail_table_list_shop .detail_red_button,.detail_navigation_block .gray_button{width:116px}.detail_table_list_shop_block{margin-bottom:20px}.detail_table_list_shop{width:100%;font-size:13px}.detail_table_list_shop td:last-child{width:170px}.detail_table_list_shop td{padding:8px 0}.detail_table_list_shop tr{border-bottom:1px solid #e6e6e6}.detail_table_list_shop tr:first-child th{background:#e6e6e6}.detail_table_list_shop th:first-child,.detail_table_list_shop td:first-child{text-align:left;width:265px}.detail_table_list_shop th,.detail_table_list_shop td{text-align:center}.detail_table_list_shop th{padding:18px}.detail_table_list_shop th:first-child{text-transform:uppercase}.detail_table_list_shop_metro{padding-left:18px;background:url(/img/metro.png?v1) left 4px no-repeat;background-size:12px 12px;color:#0260a2}.detail_adres_list:hover,.detail_adres_map:hover,.detail_adres_shema:hover{text-decoration:none}.detail_adres_list,.detail_adres_map,.detail_adres_shema{text-decoration:underline;font-family:latobold;color:#686767;font-size:12px;position:relative;cursor:pointer;display:block}.detail_adres_list{padding-left:29px}.detail_adres_map{padding-left:18px}.detail_adres_shema{padding-left:25px}.detail_adres_list:before{position:absolute;content:"";left:0;top:50%;margin-top:-8px;width:18px;height:15px;background:url(/img/detail_adres_list.png?v1) left top no-repeat}.detail_tabs_adres>li.current .detail_adres_list:before{background:url(/img/detail_adres_list.png?v1) left bottom no-repeat}.detail_adres_map:before{position:absolute;content:"";left:0;top:50%;margin-top:-9px;width:11px;height:17px;background:url(/img/detail_adres_map.png?v1) left top no-repeat}.detail_tabs_adres>li.current .detail_adres_map:before{background:url(/img/detail_adres_map.png?v1) left bottom no-repeat}.detail_adres_shema:before{position:absolute;content:"";left:0;top:50%;margin-top:-10px;width:19px;height:19px;background:url(/img/detail_adres_shema.png?v1) left top no-repeat}.detail_tabs_adres>li.current .detail_adres_shema:before{background:url(/img/detail_adres_shema.png?v1) left bottom no-repeat}.detail_tabs_adres>li.current .detail_adres_list,.detail_tabs_adres>li.current .detail_adres_map,.detail_tabs_adres>li.current .detail_adres_shema{color:#c41a1c;cursor:default;text-decoration:none}.js_detail_double_box,.js_detail_box_adres{display:none}.detail_tabs_adres{display:table;margin-bottom:20px!important}.detail_tabs_adres>li{display:table-cell;vertical-align:middle;padding-right:22px}.detail_double_tabs{display:table;margin-bottom:15px!important;border-radius:10px;background:#e6e6e6;height:39px}.detail_double_tabs>li{display:table-cell;vertical-align:middle;width:185px;text-align:center;border-radius:10px;font-family:latolight;font-size:15px;text-transform:uppercase;color:#010101;cursor:pointer}.detail_double_tabs>li.current{background:#c41a1c;color:#fff;font-family:latobold}.detail_dostavka_info_el_price{display:table;width:100%}.detail_dostavka_info_el_price>li{display:table-cell;vertical-align:middle;text-align:left}.detail_dostavka_info_el_price>li:last-child{width:100px;font-family:latoblack}.detail_dostavka_info_el_price_green{color:#57b138}.detail_dostavka_info_el_text{margin-bottom:15px}.detail_dostavka_info_el_block{width:590px;border:1px solid #ebebeb}.detail_dostavka_info_el:nth-child(odd){background:#fbfbfb}.detail_dostavka_info_el:first-child{border-top:0}.detail_dostavka_info_el{border-top:1px solid #ebebeb;padding:15px 10px 20px}.detail_dostavka_info_title{font-family:latobold;font-size:20px;margin-bottom:5px}.detail_double_box .dostavka_region_title_block{font-size:16px}.detail_double_box .dostavka_region_title{font-size:23px}.detail_right_produce_el{display:table;width:100%;padding:7px 0}.detail_right_produce_left_col{width:100px;text-align:center;padding-left:5px;padding-right:10px}.detail_right_produce_left_col,.detail_right_produce_right_col{display:table-cell;vertical-align:middle}.produce_new_price{font-family:latomedium;font-size:20px}.produce_old_price{font-family:latomedium;font-size:16px;color:#686767;text-decoration:line-through}.detail_right_produce_right_col_price{height:47px}.detail_right_produce_right_col_title a:hover{text-decoration:underline}.detail_right_produce_right_col_title a{color:#c41a1c;text-decoration:none}.detail_right_produce_right_col_title{height:32px;color:#c41a1c;font-size:13px;overflow:hidden}.detail_right_produce_right_col_reiting{margin-bottom:10px}.detail_big_title_bottom_linear{font-family:latobold;font-size:22px;padding-bottom:10px;border-bottom:1px solid #ebebeb;margin-bottom:15px}.detail_similar_items_slider_block{padding:0 25px;margin-bottom:30px}.detail_similar_items_el:hover{box-shadow:inset 0 0 0 1px #c41a1c}.detail_similar_items_el{padding:2px 2px 15px;text-align:center;background:#e6e6e6;background:linear-gradient(to bottom,#fff,#e6e6e6)}.detail_similar_items_el .red_buy{margin:0 auto 0}.detail_similar_items_el_img img{vertical-align:middle;max-height:100%;display:inline!important}.detail_similar_items_el_img{height:80px;line-height:80px}.detail_similar_items_el_title a:hover{color:#c41a1c}.detail_similar_items_el_title a{color:#000;text-decoration:none}.detail_similar_items_el_title{font-family:latomedium;color:#000;height:65px}.detail_similar_items_el_reiting{display:table;margin:0 auto 5px}.detail_similar_items_el_price{height:53px}.content_text_comment{margin-bottom:20px;display:table}.text_message{display:table-cell;vertical-align:top;width:100%}.photo_text_comment{width:110px;display:table-cell;vertical-align:top;text-align:center}.photo_text_comment img{display:block;margin:15px auto 5px}.photo_text_comment p{font-family:latobold;font-size:14px}.text_message ul{display:table;width:100%;margin-bottom:5px;padding-left:43px;box-sizing:border-box}.text_message ul li{display:table-cell;text-align:right;font-family:latolight;font-size:12px}.text_message ul li:first-child{text-align:left}.gray_text_comment{margin-left:25px;background:#f7f7f7;padding:25px 85px 25px 20px;box-sizing:border-box;position:relative;border-radius:25px;font-family:latoitalic;color:#000;font-size:14px;text-align:justify;min-height:80px}.left_arrow_comment{position:absolute;top:25px;left:-25px}.gray_text_comment:hover{border:1px solid #ce4243}.gray_text_comment{border:1px solid #f7f7f7}.gray_text_comment:hover .left_arrow_comment{background:url(/img/left_arrow_comment_active.png?v1) left center no-repeat}.left_arrow_comment{background:url(/img/left_arrow_comment.png?v1) left center no-repeat;display:block;width:26px;height:33px}.green_comment_reiting{position:absolute;right:15px;top:50%;margin-top:-20px;padding:15px 30px 0 0;display:block;background:url(/img/green_comment_reiting.png?v1) bottom right no-repeat;color:#3aaa35;font-size:15px;font-family:latoregular;text-decoration:none}.detail_comment_info_list{display:table;width:100%;margin-bottom:20px!important;height:40px;border-radius:8px;background:#e6e6e6}.detail_comment_info_list>li:first-child{width:193px;padding-right:40px}.detail_comment_info_list>li:last-child{width:193px;padding-right:10px}.detail_comment_info_list>li{display:table-cell;vertical-align:middle;font-family:latolight;font-size:13px}.detail_comment_info_list .detail_red_button{height:40px;line-height:40px}.detail_comment_info_list select{width:120px}.shop_contacts_block{text-align:left}.questions_form p{margin-bottom:10px}.contacts_section_adres{margin-bottom:50px}.contacts_section_adres .detail_table_list_shop td:last-child{width:270px;padding-right:25px}.detail_table_list_shop .dop_shema_proezda{margin-top:0}.reg_form_gray_title{text-transform:uppercase;font-size:32px;margin-bottom:30px}.reg_form_top_block{padding:50px 5px 35px;margin-bottom:20px}.reg_form_soc_block{padding:15px 5px 50px}.reg_form_white{background:#fff;border-radius:15px}.reg_form_top_title{font-family:latobold;font-size:17px;margin-bottom:30px}.reg_form_gray{margin-bottom:25px}.reg_form_el input[type="text"],.reg_form_el input[type="password"]{width:100%;height:57px;padding:0 10px;background:#fff;border-radius:12px;border:2px solid #e6e6e6;box-shadow:inset 2px 2px 7px 1px #f5f5f5}.reg_form_el{font-family:latobold;font-size:17px}.reg_form_el{margin-bottom:15px!important}.reg_form_el>li:last-child{margin-bottom:0}.reg_form_el>li{margin-bottom:10px}.reg_form_white .detail_red_button{height:65px;line-height:65px;border-radius:12px;font-size:21px;font-family:latoregular}.reg_form_white .detail_red_button.disabled{opacity:.2}.reg_form_soc_title{font-family:latobold;font-size:25px;text-align:center;margin-bottom:20px}.reg_form_white .jq-radio{width:38px;height:38px;border:0;background:#e6e6e6;box-shadow:inset 1px 1px 8px 0 #5c5959;margin-right:25px}.reg_form_white .jq-radio.checked .jq-radio__div{width:26px;height:26px;margin:6px 0 0 6px;border-radius:50%;background:#3aaa35}.reg_form_white .jq-checkbox.checked{border:0}.reg_form_white .jq-checkbox{top:-1px;width:28px;height:28px;border:0;border-radius:6px;background:#e6e6e6;box-shadow:inset 1px 1px 8px 0 #5c5959;margin-right:22px}.reg_form_white .jq-checkbox.checked .jq-checkbox__div{width:28px;height:27px;margin:-2px 0 0 2px;background:url(/img/reg_checkbox.png?v1) left top no-repeat}.reg_radio_button_block{margin-bottom:30px}.reg_radio_button_block:after{content:"";clear:both;display:block}.reg_radio_button_block{font-family:latolight;font-size:17px}.reg_form_card_block label{display:block}.reg_form_test_password_name_status{display:table;width:100%;margin-bottom:10px!important;font-size:17px}.reg_form_test_password_name_status>li:first-child{text-align:left}.reg_form_test_password_name_status>li{display:table-cell;vertical-align:middle;text-align:right}.reg_form_test_password_color_status{display:table;width:100%;height:17px;background:#e6e6e6;border-radius:8px;margin-bottom:20px!important;overflow:hidden}.reg_form_test_password_color_status>li:first-child{border-left:none}.reg_form_test_password_color_status>li{display:table-cell;vertical-align:middle;border-left:1px solid #686767;width:25%}.password_lvl1>li:nth-child(1){background:#c41a1c}.password_lvl2>li:nth-child(1),.password_lvl2>li:nth-child(2){background:#f9ee1c}.password_lvl3>li:nth-child(1),.password_lvl3>li:nth-child(2),.password_lvl3>li:nth-child(3){background:#cee234}.password_lvl4>li:nth-child(1),.password_lvl4>li:nth-child(2),.password_lvl4>li:nth-child(3),.password_lvl4>li:nth-child(4){background:#72c507}.reg_form_test_password_trebovanie{background:#e6e6e6;border-radius:12px;padding:15px 30px 20px 55px;font-family:latolight;font-size:14px;margin-bottom:15px;color:#1d1d1b}.reg_form_test_password_trebovanie p{margin-bottom:5px}.reg_form_test_password_trebovanie ul>li:last-child{margin-bottom:0}.reg_form_test_password_trebovanie ul>li{position:relative;padding-left:10px;margin-bottom:5px}.reg_form_test_password_trebovanie ul>li:before{content:'-';position:absolute;left:0;top:0;font-family:latolight;font-size:14px;color:#1d1d1b}.reg_form_prava_block{border-top:1px solid #e6e6e6;padding:15px 33px;margin-bottom:15px;font-family:latolight;font-size:17px}.reg_form_prava_block a{font-family:latoregular}.reg_form_prava_block .jq-checkbox{float:left;top:4px}.reg_form_soc_el img{display:block}.reg_form_soc_el:last-child{margin-right:0}.reg_form_soc_el{display:inline-block;vertical-align:middle;margin-right:7px}.detail_top_accessory_left_col a:hover{color:#c41a1c}.detail_top_accessory_left_col a{color:#000;text-decoration:none}.detail_top_accessory_el.active{font-family:latobold}.detail_top_accessory_el{margin-bottom:10px;line-height:1}.detail_accessory_title{font-family:latobold;font-size:19px;margin-bottom:15px}.menu_lvl0_button:after{display:none!important}.menu_lvl0_button:before,.mobile_catalog_menu_rezdel_name:before{content:'';display:block;border-top:15px solid #e6e6e6;border-right:9px solid transparent;border-left:9px solid transparent;position:absolute;bottom:-14px;left:35px;z-index:100}.menu_lvl0_button,.mobile_catalog_menu_rezdel_name{background:#e6e6e6;font-size:20px;font-family:latobold;position:relative}.mobile_catalog_menu_rezdel_name a span{display:table-cell;vertical-align:middle}.mobile_catalog_menu_rezdel_name a{text-decoration:none;display:table;width:100%;padding:10px 25px;min-height:66px}.mobile_catalog_menu_rezdel_name a:hover,.mobile_catalog_menu_come_back a:hover{color:#c41a1c;text-decoration:none}.mobile_catalog_menu_come_back a:hover:after{background:url(/img/produce_right_col_arrow.png?v1) left bottom no-repeat;background-size:10px auto}.mobile_catalog_menu_come_back a{position:relative;padding-left:25px;margin:0 0 15px 5px;text-decoration:none;display:block;font-size:18px}.mobile_catalog_menu_come_back a:after{content:'';display:block;background:url(/img/produce_right_col_arrow.png?v1) left top no-repeat;background-size:10px auto;-moz-transform:rotate(-180deg);-o-transform:rotate(-180deg);-webkit-transform:rotate(-180deg);transform:rotate(-180deg);width:10px;height:18px;top:50%;margin-top:-9px;left:5px;position:absolute;z-index:100}.menu_lvl2{-webkit-column-width:200px;-moz-column-width:200px;column-width:200px;-webkit-column-count:3;-moz-column-count:3;column-count:3;-webkit-column-gap:75px;-moz-column-gap:75px;column-gap:75px;-webkit-column-rule:none;-moz-column-rule:none;column-rule:none}.menu_lvl2 .item_lvl2 + .item_lvl2,.menu_lvl2 .item_lvl3 + .item_lvl2{padding-top:10px}.menu_lvl2 .item_lvl2{font-family:latobold;font-size:13px;margin-bottom:10px;line-height:1;display:block}.menu_lvl2 a:hover{color:#c41a1c;text-decoration:underline}.menu_lvl2 a{text-decoration:none}.menu_lvl2 .item_lvl3{font-family:latoregular;font-size:12px;padding-left:12px;margin-bottom:10px;line-height:1;display:block}.telephone_firearm:after,.firearm:after{content:'';clear:both;display:block}.firearm a{position:relative}.firearm a:hover img{opacity:0}.firearm a:hover .firearm_hover{opacity:1}.firearm_hover img{opacity:1!important}.firearm_hover{opacity:0;position:absolute;z-index:100;display:block}.new_call_back_light{background:#fff;padding:20px;border-radius:14px;font-size:12px}#call_back_light .new_call_back_light_title{font-size:20px;font-family:latobold;margin-bottom:20px}.new_call_back_light_title{font-size:16px;font-family:latobold}.new_call_back_light_text{margin-bottom:15px}#call_back_light .new_call_back_light_form>li:first-child,#call_back_light .new_call_back_light_form_tel>li:first-child{font-family:latoregular;font-size:16px}.new_call_back_light_form>li:first-child,.new_call_back_light_form_tel>li:first-child{font-family:latobold}.new_call_back_light_form input[type="text"],.new_call_back_light_form input[type="password"],.new_call_back_light_form textarea{width:100%}.new_call_back_light_right_button:after{content:'';display:block;clear:both}.new_call_back_light_right_button input[type="submit"]{float:right}.add_comment_star .jq-radio{width:30px;height:30px;border:0;border-radius:0;box-shadow:none;background:url(/img/gray_star.png?v1) center no-repeat}.add_comment_star .jq-radio.checked,.add_comment_star .jq-radio.checked_hover{background:url(/img/orange_star.png?v1) center no-repeat!important}.add_comment_star .jq-radio.checked .jq-radio__div{display:none}.header_geo_light{display:none;position:absolute;width:265px;left:1px;top:55px;background:#fff;border-radius:10px;padding:15px 25px 25px;border:1px solid #686767;z-index:100;text-align:center}.header_geo_light:before{content:'';display:block;width:28px;height:18px;background:url(/img/header_geo_light_arrow.png?v1) center no-repeat;position:absolute;top:-18px;left:47px;z-index:100}.header_geo_light_title{margin-bottom:13px}.header_geo_light_title span{text-decoration:underline}.header_geo_light_button:after{content:'';display:block;clear:both}.header_geo_light_button .geo_gray_button{float:left}.header_geo_light_button .geo_red_button{float:right}.geo_gray_button:hover{background:#bdbdbd;background:linear-gradient(to top,#e6e6e6,#bdbdbd)}.geo_gray_button{display:table;vertical-align:middle;width:94px;height:36px;text-align:center;border:1px solid #686767;border-radius:6px;background:#e6e6e6;text-transform:uppercase;font-size:16px;color:#000;text-decoration:none}.geo_gray_button>span,.geo_red_button>span{display:table-cell;vertical-align:middle}.geo_red_button:hover{background:#941316;background:linear-gradient(to top,#c41a1c,#941316)}.geo_red_button{display:table;vertical-align:middle;width:115px;height:36px;text-align:center;border-radius:6px;background:#c41a1c;text-transform:uppercase;font-size:12px;color:#fff;text-decoration:none}.new_geo_light_title{line-height:14px;text-align:center;font-size:22px;margin-bottom:20px}.new_geo_light_text{line-height:19px;font-size:14px;margin-bottom:12px}.geo_light_search_list{display:none;background-color:#fff;z-index:100;border:1px solid #87919c;max-height:300px;border-radius:2px;-webkit-box-shadow:0 2px 3px #c7c7c7;box-shadow:0 2px 3px #c7c7c7;-webkit-box-sizing:border-box;-moz-box-sizing:border-box;box-sizing:border-box;overflow-y:auto;left:0;top:35px;padding:5px 5px 3px 5px;position:absolute;width:100%}.geo_light_search_list ul>li.active,.geo_light_search_list ul>li:hover{background-color:#e0e8ea}.geo_light_search_list ul>li{border-radius:2px;padding:10px 10px;margin-bottom:2px;cursor:pointer}.geo_light_search_list ul span{color:#25282c}.geo_light_search_list ul{color:#aba8ac;font-size:14px}.geo_light_search{margin-bottom:10px}.new_geo_light_search_block{display:table;margin:0 auto 20px;width:100%;max-width:400px}.geo_light_search input[type="text"]{background:url(/img/lens.png?v1) 10px center no-repeat #fff}.new_geo_light_search_block a:hover{border-bottom:1px dotted #fff}.new_geo_light_search_block a{color:gray;text-decoration:none;border-bottom:1px dotted gray}.new_geo_light_search_block{color:gray;font-size:14px}#geo_light{max-width:480px}.new_geo_light_search_text:after{content:'';clear:both;display:block}.new_geo_light_search_text_right{padding-top:2px;font-size:13px;line-height:17px}.geo_light_search_title{font-weight:700;font-size:18px;letter-spacing:-.6px;margin-bottom:18px}.new_basket_el{background:#fff;width:100%;margin-bottom:5px;border-radius:8px;display:table}.gray_bg_section{background:#e6e6e6}#basket_form_container,#bx-soa-order{background:#e6e6e6}.current_price_small_title{font-size:12px;color:#a7a7a7}.current_price_black span{font-size:20px}.current_price{font-size:30px;font-family:latobold;margin-bottom:15px}.basket_page_del:hover{text-decoration:underline}.basket_page_del{font-size:12px;color:#82aacc;display:inline-block;vertical-align:middle;margin-left:20px;text-decoration:none}#bx-soa-order .btn.btn-default:hover{background:#c41a1c!important;background:linear-gradient(to top,#c41a1c,#941316)!important}#bx-soa-order .btn.btn-default{width:274px;height:56px;line-height:44px;text-transform:uppercase;color:#fff;text-decoration:none;border:0;cursor:pointer;text-align:center;font-size:20px;background:linear-gradient(to bottom,#c41a1c,#941316)!important;border-radius:12px}.bx-soa-section-content input[type="text"],.bx-soa-section-content input[type="password"],.bx-soa-section-content select{height:57px;padding:0 10px}.bx-soa-section-content textarea{height:120px;padding:5px 10px;resize:vertical}input[type="text"].error:before,input[type="password"].error:before,,select.error:before,textarea.error:before,.bx-soa-section-content input[type="text"].error:before,.bx-soa-section-content input[type="password"].error:before,,.bx-soa-section-content select.error:before,.bx-soa-section-content textarea.error:before{position:absolute;top:50%;margin-top:-17px;right:15px;width:35px;height:35px;content:'';display:block;z-index:100}input[type="text"].error,input[type="password"].error,select.error,textarea.error{box-shadow:none;border-color:#c41a1c;position:relative}.bx-soa-section-content input[type="text"].error,.bx-soa-section-content input[type="password"].error,.bx-soa-section-content select.error,.bx-soa-section-content textarea.error{box-shadow:none;border:2px solid #c41a1c;position:relative}.bx-soa-section-content input[type="text"],.bx-soa-section-content input[type="password"],.bx-soa-section-content select,.bx-soa-section-content textarea{box-shadow:inset 0 0 4px 1px #efeeee;border:2px solid #e6e6e6;border-radius:10px;width:100%;background:#fff}.bx-soa-section-content .dropdown-block input[type="text"]{height:34px}.basket_page_itog_block{background:#fff;padding:20px 15px;border-radius:10px}.basket_page_itog_el{display:table;width:100%;border-bottom:1px solid #686767;margin-bottom:20px;font-family:latobold;font-size:17px;padding-bottom:5px}.basket_page_itog_el_param{text-align:right}.basket_page_itog_el_name,.basket_page_itog_el_param{display:table-cell;vertical-align:bottom}.basket_page_itog_el_param_money{font-family:latoblack;font-size:46px;line-height:39px}.basket_page_itog_block .red_button:hover{background:#951316;background:linear-gradient(to top,#c41a1c,#951316)}.basket_page_itog_block .red_button{width:100%;height:47px;line-height:45px;border-radius:10px;text-transform:uppercase;font-size:18px;font-family:latoregular;text-align:center;background:#c41a1c}.why_trust_us_block{border:1px solid #e6e6e6;width:calc(100% - 14px);margin:0 auto 25px;box-shadow:inset 0 7px 40px 0 #d8d8d8,0 36px 55px -36px #c8c8c8}.right_text_why_trust_us{text-align:right;font-family:latolight;font-size:15px;color:#000;margin:10px 0}.right_text_why_trust_us a{font-family:latobold;color:#b32700}.why_trust_us p{max-width:1160px}.title_why_trust_us{font-family:latolight!important;text-transform:uppercase;font-size:28px!important;color:#000!important;margin:15px auto;text-align:center}.red_circle{display:block;width:8px;height:8px;border-radius:50%;margin:10px auto;background:#b32700}.rating_comment_block{margin:0 auto 20px;max-width:1300px}.rating_comment_text a:first-child{display:block;text-align:center;font-family:latomedium;font-size:14px}.rating_comment_text p{font-family:latolight;font-size:18px;text-align:center}.rating_comment_text p a{display:inline !Important;font-family:latolight!important;font-size:18px!important;color:#b32700}.average_rating p{font-family:latolight;font-size:18px;color:#000}.big_rating{font-size:70px!important;margin:25px 0 20px}.scale_rating li{display:table;height:23px;margin-bottom:2px}.scale_rating p{display:table-cell;vertical-align:middle}.star_rating{width:50px;padding-right:5px}.linear_rating{width:100px}.linear_rating span{display:block;height:23px;background:#bddcf1;box-sizing:border-box;border:1px solid #e7f2fa}.rating5 .linear_rating span{width:98%}.rating4 .linear_rating span{width:45%}.rating3 .linear_rating span{width:20%}.rating2 .linear_rating span{width:10%}.rating1 .linear_rating span{width:3%}.kol_vo_rating{padding-left:5px}.button_text_comment p{text-align:center;font-family:latobold;font-size:20px;color:#000;margin:20px auto 35px}.button_text_comment .red_button{width:150px;display:block;margin:0 auto;padding:10px 0;text-align:center;font-size:15px}.button_text_comment .red_button span{display:block;text-transform:uppercase}.content_text_comment{margin-top:20px;display:table}.text_message{display:table-cell;vertical-align:top}.photo_text_comment{width:110px;display:table-cell;vertical-align:top;text-align:center}.photo_text_comment img{display:block;margin:15px auto 5px}.photo_text_comment p{font-family:latobold;font-size:14px}.text_message ul{display:table;width:100%;margin-bottom:5px;padding-left:43px;box-sizing:border-box}.text_message ul li{display:table-cell;text-align:right;font-family:latolight;font-size:12px}.text_message ul li:first-child{text-align:left}.left_arrow_comment{position:absolute;top:25px;left:-25px}.video_block{margin-bottom:10px}.content_video_comment{margin-top:30px}.content_video_comment p{font-family:latobold;text-transform:uppercase;font-size:12px;text-decoration:underline;margin-bottom:10px}.old_comment{display:block;background:url(/img/old_comment.png?v1) no-repeat;background-size:100% 100%;width:276px;height:62px;line-height:60px;margin:50px auto;text-align:center;font-family:latobold;font-size:20px;color:#b32700}.add_text_comment{padding:0 60px 20px}.add_text_comment p{text-align:center;font-family:latomedium;font-size:15px;color:#000;line-height:1.3}.add_comment_form{display:table;margin:20px auto}.add_comment_form li{display:table-cell;padding-left:30px}.add_comment_form>li:first-child{padding-left:0}.add_comment_name{text-align:center;margin-bottom:20px}.add_text_comment input[type='text']{width:202px;height:34px;box-sizing:border-box;border:1px solid #ababab;box-shadow:inset 0 0 0 1px #818181;border-radius:4px;padding:0 10px;font-family:latomedium;font-size:14px}.add_text_comment textarea{width:266px;height:128px;box-sizing:border-box;border:1px solid #ababab;box-shadow:inset 0 0 0 1px #818181;border-radius:4px;font-family:latomedium;font-size:14px;padding:5px 10px;resize:none}.add_comment_form p{text-transform:uppercase;margin:25px 0 15px;font-size:14px}.add_text_comment .red_button{width:204px;height:44px;margin:0 auto;display:block;box-sizing:border-box;background:url(/img/add_comment_button_text.png?v1) center no-repeat #c41a1c;background:url(/img/add_comment_button_text.png?v1) center no-repeat,linear-gradient(to bottom,#c41a1c,#951316)}.add_text_comment .red_button:hover{background:url(/img/add_comment_button_text.png?v1) center no-repeat #951316;background:url(/img/add_comment_button_text.png?v1) center no-repeat,linear-gradient(to top,#c41a1c,#951316)}.add_text_comment textarea::-webkit-input-placeholder{text-align:center;padding:0 40px;font-size:11px;color:#c5c0c0}.add_text_comment textarea::-moz-placeholder{text-align:center;padding:0 40px;font-size:11px;color:#c5c0c0}.add_text_comment textarea:-moz-placeholder{text-align:center;padding:0 40px;font-size:11px;color:#c5c0c0}.add_text_comment textarea:-ms-input-placeholder{text-align:center;padding:0 40px;font-size:11px;color:#c5c0c0}.add_comment_star{text-align:center}.display_block{display:block}.detail_services_ligh .jq-selectbox,.add_text_comment .jq-selectbox{vertical-align:middle;cursor:pointer}.detail_services_ligh .jq-selectbox__select{height:35px;line-height:33px;box-sizing:border-box;width:202px;padding:0 45px 0 10px;font-family:latomedium;font-size:14px;background:#fff;border:1px solid #8e8e8e;box-shadow:inset 0 0 0 1px #e1e1e1;border-radius:4px}.add_text_comment .jq-selectbox__select{height:35px;line-height:33px;box-sizing:border-box;width:202px;border:1px solid #ababab;box-shadow:inset 0 0 0 1px #818181;padding:0 45px 0 10px;border-radius:4px;font-family:latomedium;font-size:14px;background:#fff}.detail_services_ligh .jq-selectbox__select:hover,.add_text_comment .jq-selectbox__select:hover{background-color:#fff;background-position:0 -10px}.detail_services_ligh .jq-selectbox__select:active,.add_text_comment .jq-selectbox__select:active{background:#fff;box-shadow:none}.detail_services_ligh .jq-selectbox.focused .jq-selectbox__select,.add_text_comment .jq-selectbox.focused .jq-selectbox__select{border:1px solid #5794bf}.detail_services_ligh .jq-selectbox.disabled .jq-selectbox__select,.add_text_comment .jq-selectbox.disabled .jq-selectbox__select{border-color:#CCC;background:#f5f5f5;box-shadow:none;color:#888}.detail_services_ligh .jq-selectbox__select-text,.add_text_comment .jq-selectbox__select-text{display:block;width:100%!important;overflow:hidden;text-overflow:ellipsis;white-space:nowrap}.detail_services_ligh .jq-selectbox__trigger,.add_text_comment .jq-selectbox__trigger{position:absolute;top:0;right:0;width:34px;height:100%;border-left:none}.detail_services_ligh .jq-selectbox__trigger-arrow,.add_text_comment .jq-selectbox__trigger-arrow{position:absolute;top:12px;right:10px;width:15px;height:11px;background:url(/img/select_arrow.png?v1) no-repeat;overflow:hidden;border-top:0;border-right:0;border-left:none;opacity:1;filter:alpha(opacity=100)}.detail_services_ligh .jq-selectbox:hover .jq-selectbox__trigger-arrow,.add_text_comment .jq-selectbox:hover .jq-selectbox__trigger-arrow{opacity:1;filter:alpha(opacity=100)}.detail_services_ligh .jq-selectbox.disabled .jq-selectbox__trigger-arrow,.add_text_comment .jq-selectbox.disabled .jq-selectbox__trigger-arrow{opacity:.3;filter:alpha(opacity=30)}.detail_services_ligh .jq-selectbox__dropdown,.add_text_comment .jq-selectbox__dropdown{top:33px;width:100%;-moz-box-sizing:border-box;box-sizing:border-box;margin:0;padding:0;border:1px solid #CCC;border-radius:4px;background:#FFF;box-shadow:0 2px 10px rgba(0,0,0,.2);font:14px/18px Arial,sans-serif}.detail_services_ligh .jq-selectbox__search,.add_text_comment .jq-selectbox__search{margin:5px}.detail_services_ligh .jq-selectbox__search input,.add_text_comment .jq-selectbox__search input{-moz-box-sizing:border-box;box-sizing:border-box;width:100%;margin:0;padding:5px 27px 6px 8px;outline:0;border:1px solid #CCC;border-radius:3px;background:url(data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABQAAAAMCAYAAABiDJ37AAAAGXRFWHRTb2Z0d2FyZQBBZG9iZSBJbWFnZVJlYWR5ccllPAAAAO1JREFUeNqU078LAXEYx/FzYfNzk5TJaFNKYjFYSQZ/hvwBsvg1UCY2xT9gM8hukQGThWRjkcFw3pdnujhfT736Xn2fPvfc3fd07V0OFDDFAnM0ENYsZRiGLSc9OpqIYIA9fMhhjCrW2h9VlMlcH/aymMGtOqEugX08PwQucUZKdTozMIqdTc9WepQD7wjY9ARx+ydwhfyXfS+S0qMcOEQJGcueB3VccFINdMgal6NzkmPjRwJXxDBB7/2RDdtAp6wb+dpphHDASG5QQ0V6u2aoSqBZD/lDrNWRJynLK2qpBn4rc6K2XB9/Nb8EGABtf1thzY6X2AAAAABJRU5ErkJggg==) no-repeat 100% 50%;box-shadow:inset 1px 1px #f1f1f1;color:#333;-webkit-appearance:textfield}.detail_services_ligh .jq-selectbox__search input::-webkit-search-cancel-button,.detail_services_ligh .jq-selectbox__search input::-webkit-search-decoration,.add_text_comment .jq-selectbox__search input::-webkit-search-cancel-button,.add_text_comment .jq-selectbox__search input::-webkit-search-decoration{-webkit-appearance:none}.detail_services_ligh .jq-selectbox__not-found,.add_text_comment .jq-selectbox__not-found{margin:5px;padding:5px 8px 6px;background:#f0f0f0;font-size:13px}.detail_services_ligh .jq-selectbox ul,.add_text_comment .jq-selectbox ul{margin:0;padding:0}.detail_services_ligh .jq-selectbox li,.add_text_comment .jq-selectbox li{min-height:18px;padding:5px 10px 6px;color:#231f20}.detail_services_ligh .jq-selectbox li.selected,.add_text_comment .jq-selectbox li.selected{background-color:#a3abb1;color:#FFF}.detail_services_ligh .jq-selectbox li:hover,.add_text_comment .jq-selectbox li:hover{background-color:#08C;color:#FFF}.detail_services_ligh .jq-selectbox li.disabled,.add_text_comment .jq-selectbox li.disabled{color:#AAA}.detail_services_ligh .jq-selectbox li.disabled:hover,.add_text_comment .jq-selectbox li.disabled:hover{background:0}.detail_services_ligh .jq-selectbox li.optgroup,.add_text_comment .jq-selectbox li.optgroup{font-weight:700}.detail_services_ligh .jq-selectbox li.optgroup:hover,.add_text_comment .jq-selectbox li.optgroup:hover{background:0;color:#231f20;cursor:default}.detail_services_ligh .jq-selectbox li.option,.add_text_comment .jq-selectbox li.option{padding-left:25px}.add_comment_star .jq-radio{width:30px;height:30px;border:0;border-radius:0;box-shadow:none;background:url(/img/gray_star.png?v1) center no-repeat}.add_comment_star .jq-radio.checked,.add_comment_star .jq-radio.checked_hover{background:url(/img/orange_star.png?v1) center no-repeat!important}.add_comment_star .jq-radio.checked .jq-radio__div{display:none}.page_comment_button .red_button i{display:block;text-transform:uppercase;text-align:center;font-family:latoregular}.page_comment_button .red_button{height:52px;line-height:1.2;font-family:latoregular}.rating_comment_text_list{position:relative;display:inline}.type_comment_light a:hover{color:#b32700!important}.rating_comment_text_list>a{display:inline !Important;font-family:latolight!important;font-size:18px!important;color:#b32700}.red_arrow_comment{padding-right:20px;background:url(/img/red_arrow_comment.png?v1) right 12px no-repeat}.type_comment_light{display:none;position:absolute;top:25px;left:0;border:1px solid #dddcdc;text-align:left;background:#fff;z-index:150}.type_comment_light li:first-child{border-top:0}.type_comment_light li{border-top:1px solid #dddcdc}.type_comment_light a{text-decoration:none;text-align:left!important;color:#000!important;font-size:13px!important;white-space:nowrap;word-wrap:normal;padding:7px 15px;font-family:latolight!important;display:block!important}.header_geo_light_button .red_button:nth-child(2n){float:right;margin-left:10px}.header_geo_light_button .red_button{float:left}.compare_light_text{margin-bottom:15px;padding-top:10px}.vhod_page_block:after{content:'';clear:both;display:block}.vhod_page_block p{margin-bottom:20px}.vhod_page_title{font-family:latobold;font-size:22px;margin-bottom:25px}.vhod_page_right_col ul>li{margin-bottom:5px}.vhod_page_old_password{display:block;margin-top:15px}.vhod_page_other_form_button{margin-bottom:30px;display:block}.bx-wrapper .bx-loading{display:none}.reg_form_el .jq-selectbox{width:100%}.reg_form_el .jq-selectbox__select:hover{background:#f2f3f5;background-position:0 0}.reg_form_el .opened .jq-selectbox__select{background:#e6e6e6;box-shadow:none}.reg_form_el .jq-selectbox__select{width:100%;height:57px;line-height:55px;padding:0 10px;background:#f2f3f5;border-radius:12px;border:2px solid #e6e6e6;box-shadow:inset 2px 2px 7px 1px #f5f5f5;color:#000}.reg_form_el .jq-selectbox__trigger-arrow{border:0}.reg_form_el .opened .jq-selectbox__trigger{transform:rotate(180deg)}.reg_form_el .jq-selectbox__trigger{background:url(/img/dostavka_arrow.png?v1) center no-repeat;border-left:none;bottom:0}.reg_form_el .jq-selectbox__dropdown{top:60px;border-radius:12px;border:2px solid #e6e6e6;box-shadow:none;overflow:hidden}.reg_form_el .jq-selectbox li{padding:10px 10px 11px}.reg_form_el .jq-selectbox li:first-child.sel{border-top:0}.reg_form_el .jq-selectbox li:last-child.sel{border-bottom:0}.reg_form_el .jq-selectbox li.sel{border-top:1px solid #fff;border-bottom:1px solid #fff}.reg_form_el .jq-selectbox li:hover,.reg_form_el .jq-selectbox li.sel,.reg_form_el .jq-selectbox li.selected{background:#c41a1c;color:#fff}.left_column{position:relative;z-index:300}.detail_services_list{display:table;width:100%;max-width:600px;margin:0 0 17px 0!important}.detail_services_list>li:first-child{width:200px;padding-right:10px;border-bottom:0;padding-left:0}.detail_services_list>li{display:table-cell;vertical-align:bottom;width:66%;padding-left:30%;border-bottom:1px solid #e6e6e6;line-height:1;font-size:14px}.detail_services_present:hover,.detail_services_grav:hover{text-decoration:none}.detail_services_present{padding-left:40px;position:relative;font-size:15px;color:#c41a1c;text-decoration:underline}.detail_services_present:before{left:4px;top:50%;position:absolute;display:block;content:'';z-index:10;width:23px;height:25px;margin-top:-13px;background:url(/img/detail_services_present.png?v1) center no-repeat}.detail_services_grav{padding-left:40px;position:relative;font-size:15px;color:#050505;text-decoration:underline}.detail_services_grav:before{left:0;top:50%;position:absolute;display:block;content:'';z-index:10;width:30px;height:30px;margin-top:-15px;background:url(/img/detail_services_grav.png?v1) center no-repeat}.detail_services_ligh{max-width:770px;border-radius:16px;/ / display:none;background:#fff}.detail_services_ligh_title{font-family:latobold;color:#c41a1c;font-size:22px;text-align:center;padding:10px 0}.detail_services_ligh_table{padding:0 25px}.detail_services_ligh_table table{border:1px solid #CCC;margin-bottom:12px;width:100%}.detail_services_ligh_table th{background:#e0e0e0;background:linear-gradient(to bottom,#fafafa 0,#e0e0e0 100%);height:30px}.detail_services_ligh_table th:last-child{background:url(/img/table-line.png?v1) no-repeat #e0e0e0;background:url(/img/table-line.png?v1) no-repeat,linear-gradient(to bottom,#fafafa 0,#e0e0e0 100%)}.detail_services_ligh_table td:last-child{background:url(/img/table-line.png?v1) no-repeat}.detail_services_ligh_table th{text-align:center;font-size:14px;font-family:latobold}.detail_services_ligh_table th,.detail_services_ligh_table td{vertical-align:middle}.detail_services_ligh_table td:first-child{width:100px}.detail_services_ligh_table td{color:#565656;text-decoration:underline;font-size:14px;font-family:latobold;padding:5px}.detail_services_ligh_table td:last-child{color:#c41a1c;text-decoration:none}.detail_services_ligh_table td:first-child,.detail_services_ligh_table td:last-child{text-align:center}.detail_services_ligh_bottom_text{color:#231f20;text-align:center;font-size:14px;padding:10px;line-height:1.4;background:#fafafa;background:linear-gradient(to bottom,#fafafa 0,#e0e0e0 100%);border-radius:0 0 16px 16px}.detail_services_ligh_button{text-align:center;padding-bottom:20px}.detail_services_ligh_button .gray_button,.detail_services_ligh_button .detail_red_button{display:inline-block;vertical-align:middle;margin:0 2px;width:auto;padding:0 10px}.detail_services_ligh_question{padding:0 25px;font-size:16px;text-align:center;margin-bottom:20px}.detail_services_ligh_question_title{font-size:18px;font-family:latobold;color:#c41a1c}.detail_services_ligh_form{padding:0 20px;margin-bottom:25px}.detail_services_ligh_form .new_call_back_podskazka{padding-bottom:15px}.detail_services_ligh_form .new_call_back_light_form{font-size:14px}.detail_services_ligh_form .new_call_back_light_form>li:first-child{width:150px}.detail_services_ligh_form .new_call_back_light_form p{font-size:12px;height:0;font-family:latoitalic}.black_color{color:#050505}.graving_form_el_block{margin-bottom:20px}.graving_form_el{margin:0 auto 10px;display:table}.graving_form_el .jq-selectbox__select{width:100%!important}.graving_form_el textarea,.graving_form_el input[type="text"],.graving_form_el input[type="password"],.graving_form_el .jq-selectbox{width:252px;max-width:100%}.graving_form_el input[type="text"],.graving_form_el input[type="password"]{height:35px}.error textarea,.error input[type="text"],.error input[type="password"],.error .jq-selectbox__select{border:1px solid #c41a1c!important;box-shadow:inset 0 0 0 1px #f2cacb!important}.in_basket_button:hover{background:#231108;background:linear-gradient(to bottom,#231108,#4c2411)}.in_basket_button{width:100%;height:35px;line-height:33px;background:#4e2511;border-radius:6px;padding:0 5px;display:block;font-family:latoblack;font-size:14px;color:#fff;text-decoration:none;text-align:center}.gray_bg{background:#e6e6e6}section.gray_bg{max-width:none;margin-bottom:-30px;padding:0 5px 30px}section.gray_bg #basket_form_container,section.gray_bg .index_podpiska_block,.standart_width{max-width:1200px;margin:0 auto}.bx-wrapper .detail_right_produce_right_col_reiting img{display:inline}.detail_page_top_info_3point:hover{cursor:pointer}.detail_page_top_info_3point:hover .detail_page_3point_light{display:block}.detail_page_3point_light:before{position:absolute;left:0;bottom:0;right:0;display:block;height:5px}.detail_page_3point_light{position:absolute;top:100%;right:0;z-index:150;background:#fff;border:2px solid #d3d3d3;width:214px;margin-top:5px;display:none}.detail_page_3point_light>li:first-child{border-top:0}.detail_page_3point_light>li:hover{background:#f8f7f4}.detail_page_3point_light>li{border-top:1px solid #d3d3d3;padding:13px 15px;font-size:13px;text-align:left;color:#000}.detail_page_3point_light>li a{color:#000;text-decoration:none}.detail_page_3point_light .footer_socila_block{float:none;margin-top:5px}.detail_page_3point_light .socila_block>div{width:20px;height:20px;background-size:100% auto}.reg_form_double_block_border{padding-bottom:10px;border-bottom:1px solid #e6e6e6;margin-bottom:20px}.basket_page_breadcrumbs_prev:hover:before{border-right-color:#c41a1c}.basket_page_breadcrumbs_prev:hover{color:#c41a1c}.basket_page_breadcrumbs_prev{display:table;position:relative;padding-left:30px;font-size:17px;color:#1d1d1b;text-decoration:none}.basket_page_breadcrumbs_prev:before{content:'';display:block;left:0;top:50%;margin-top:-13px;border-top:13px solid transparent;border-right:17px solid #000;border-bottom:13px solid transparent;position:absolute}.basket_page_breadcrumbs_del:hover:before{background:url(/img/basket_page_breadcrumbs_del.png?v1) left bottom no-repeat}.basket_page_breadcrumbs_del:hover{color:#c41a1c}.basket_page_breadcrumbs_del{display:table;position:relative;padding-left:35px;font-size:17px;color:#1d1d1b;text-decoration:none}.basket_page_breadcrumbs_del:before{content:'';display:block;left:0;top:50%;margin-top:-15px;background:url(/img/basket_page_breadcrumbs_del.png?v1) left top no-repeat;position:absolute;width:23px;height:29px}.basket_page_breadcrumbs{display:table;width:100%;border-bottom:1px solid #a7a7a7;margin-bottom:25px!important}.basket_page_breadcrumbs>li:first-child{text-align:left}.basket_page_breadcrumbs>li:after{content:'';clear:both;display:block}.basket_page_breadcrumbs>li{display:table-cell;vertical-align:middle;height:65px;text-align:right}.basket_page_breadcrumbs .basket_page_breadcrumbs_del{float:right}#bx-soa-order .basket_page_navigation_block{margin:0 15px 35px!important}.basket_page_navigation_block{display:table;max-width:755px;width:100%;margin-bottom:35px!important;font-size:16px;color:#a7a7a7;font-family:latobold;position:relative}.basket_page_navigation_block>li:first-child{text-align:left}.basket_page_navigation_block>li:last-child{text-align:right}.basket_page_navigation_block>li{display:table-cell;vertical-align:middle;text-align:center}.basket_page_navigation_el{display:inline-block;vertical-align:middle;padding-left:50px;width:140px;position:relative;z-index:100;background:#e6e6e6;line-height:1.3;text-align:left}.basket_page_navigation_block:before{content:'';display:block;left:0;right:0;top:50%;margin-top:-.5px;height:1px;background:#a7a7a7;position:absolute;z-index:1}.basket_page_navigation_el.current,.basket_page_navigation_el.active{color:#000}.basket_page_navigation_el.icon1{background:url(/img/navigation_el_icon_active.png?v1) left center no-repeat #e6e6e6}.basket_page_navigation_el.icon2{background:url(/img/navigation_el_icon02.png?v1) left center no-repeat #e6e6e6}.basket_page_navigation_el.icon1.current,.basket_page_navigation_el.icon2.current{background:url(/img/navigation_el_icon_current.png?v1) left center no-repeat #e6e6e6}.basket_page_navigation_el.icon1.active,.basket_page_navigation_el.icon2.active{background:url(/img/navigation_el_icon_active.png?v1) left center no-repeat #e6e6e6}.basket_page_navigation_el.icon3{background:url(/img/navigation_el_icon03.png?v1) left center no-repeat #e6e6e6}.basket_page_navigation_el.icon3.current{background:url(/img/navigation_el_icon03_current.png?v1) left center no-repeat #e6e6e6}.sp-stars-off{background-image:url(/img/stars.png?v1);background-position:0 0;width:190px;height:30px;display:inline-block}.sp-stars-on{background-image:url(/img/stars.png?v1);background-position:0 -41px;height:30px;display:inline-block}.YMaps img{max-width:none}.small_razdel_firearm .razdel_firearm_img{height:60px;line-height:60px;margin-bottom:10px}.small_razdel_firearm .razdel_firearm{height:130px;font-size:12px;overflow:hidden}.small_list_razdel_firearm{text-align:left;margin-bottom:20px}.small_list_razdel_firearm a:hover{color:#c41a1c}.small_list_razdel_firearm a{display:inline-block;background:#e6e6e6;vertical-align:middle;padding:5px 5px;margin-right:3px;margin-bottom:5px;text-decoration:none;font-size:12px;border-radius:4px}.table_cart_section_big{padding:4px 0 5px 30px;background:url(/img/big_cart_gray.png?v1) left center no-repeat}.table_cart_section_big.active{background:url(/img/big_cart.png?v1) left center no-repeat!important;text-decoration:none;font-family:latobold}.table_cart_section_small{padding:4px 0 5px 30px;background:url(/img/table_vid.png?v1) left center no-repeat}.table_cart_section_small.active{background:url(/img/table_vid_active.png?v1) left center no-repeat!important;text-decoration:none;font-family:latobold}.telephone_shop_contacts a{text-decoration:none}.red_button_tabs a{text-decoration:none;color:#fff}.element_filter_block.bx-filter-parameters-box:hover{background:#e1e1e1}.bx-filter-param-label:hover{color:#c41a1c;cursor:pointer}.help_horizontal{margin-top:40px;text-align:left}.help_horizontal div{padding-top:147px!important;background-position:0 0;background-repeat:no-repeat}.help_horizontal div:nth-child(1){background-image:url(/img/help/1.png?v1)}.help_horizontal div:nth-child(2){background-image:url(/img/help/2.png?v1)}.help_horizontal div:nth-child(3){background-image:url(/img/help/3.png?v1)}.help_horizontal div:nth-child(4){background-image:url(/img/help/4.png?v1)}.help_horizontal div:nth-child(5){background-image:url(/img/help/5.png?v1)}.help_horizontal ul{list-style:none;margin-top:24px}.help_horizontal .help_horizontal_root{font-size:25px;font-weight:700;color:black}.help_horizontal li{margin-bottom:9px}.help_horizontal li a{font-size:18px}.help_horizontal a:hover{color:#c41a1c;text-decoration:underline}.rating_comment_text>div>div a.red_arrow_comment{background:url(/img/red_arrow_comment.png?v1) right 9px no-repeat}.rating_comment_text>div>div a.red_arrow_comment,.rating_comment_text>div>div{display:inline;position:relative}.type_comment_light{list-style:none}.video_block iframe{max-width:100%}.oplata_page_el:after{content:'';display:block;clear:both}.oplata_page_el{margin-bottom:15px}.oplata_page_el_l_col{float:left;width:80px}.oplata_page_el_r_col{padding-left:100px}.oplata_page_el p{margin-bottom:5px}.oplata_page_el_title{font-family:latobold}.oplata_page_el_text{padding-left:15px;font-size:14px}.oplata_page_el_text_card{text-align:center;color:#c41a1c;padding:10px 0;font-size:14px}.oplata_page_el_text_card p{margin-bottom:15px}.kredit_text_page_bank_block .kredit_text_page_title{text-align:center}.kredit_text_page_bank_el_block{max-width:620px;margin:0 auto}.kredit_text_page_bank_el{text-align:center;margin:20px 0}.kredit_text_page_title{font-family:latobold;font-size:18px;color:#c41a1c;margin:15px 0}.kredit_text_page p>img{display:block}.kredit_text_page p{margin-bottom:5px}.kredit_text_page_bank_el img{margin:0 auto}.margin_master_page{margin:20px 0;padding-left:15px}.garvirovka_text_list img{display:block;margin:10px 0}.red_color{color:#c41a1c}.new_call_back_light div.mf-ok-text{font-weight:400;font-family:latobold}.adaptiv_list_element_img img,.list_element_img img{vertical-align:middle;max-height:100%}.adaptiv_list_element_img{height:100px;line-height:95px}.section_copu_top_menu .header_top_menu{background:#d0d0d0;background:linear-gradient(to bottom,#fff,#d0d0d0)}.index_podpiska_block{margin-top:20px}.red_search_form input[type="text"]{color:#000;font-size:16px;font-family:latoregular}.red_search_form input[type="text"]::-webkit-input-placeholder{font-family:latoitalic;font-size:14px}.red_search_form input[type="text"]::-moz-placeholder{font-family:latoitalic;font-size:14px}.red_search_form input[type="text"]:-moz-placeholder{font-family:latoitalic;font-size:14px}.red_search_form input[type="text"]:-ms-input-placeholder{font-family:latoitalic;font-size:14px}.search-page .red_button{display:inline-block}.filter_block_menu_open .bx-filter{overflow-y:scroll;min-height:110%}.filter_block_menu_open{position:fixed;top:0;bottom:0;overflow-x:hidden;left:0;display:block!important;width:265px;border-radius:0}.filter_block_menu_open .filter_position_block{position:absolute;left:0;top:0;right:0;bottom:0;overflow-y:scroll}.filter_block_menu_open:before{position:absolute;top:0;bottom:0;box-shadow:0 0 10px #000;content:'';display:block;right:-.1rem;width:.1rem;z-index:100}.mobile_left_menu_light{display:none}.detail_page_title{text-align:left}.news-list .index_video_el_list{margin-bottom:25px}.news-list .index_video_el_list a:first-child{margin-bottom:10px}.news-list .index_video_el_list a{display:block;text-align:center}.new_news_item:first-child{border-top:1px solid #e6e6e6}.new_news_item + .catalog_page_navigator_block{margin-top:20px}.new_news_item{display:table;width:100%;padding:10px 0;border-bottom:1px solid #e6e6e6}.news_list_l_col{width:160px;padding-right:20px}.news_list_l_col,.news_list_r_col{display:table-cell;vertical-align:top}.news_list_title a:hover{color:#c41a1c}.news_list_title{margin-bottom:10px}.text_h p{margin-bottom:10px}.text_h h1,.text_h h2,.text_h h3,.text_h h4,.text_h h5,.text_h .h1,.text_h .h2,.text_h .h3,.text_h .h4,.text_h .h5{margin-top:20px}.bx-filter-parameters-box-container .red_button{margin:10px auto}.filter_block .name_filter{text-align:center;padding:10px 5px;font-size:20px;font-family:latobold;border-bottom:1px solid #fff}.catalog_el_reting{list-style:none;margin:20px auto 10px;display:table}.list_element_buy .catalog_el_reting{margin:0 0 10px 0}.detail_page_3point_light:before{height:10px;position:absolute;display:block;top:-10px;left:0;right:0;content:''}.detail_right_produce_slider_block .detail_right_produce_right_col_title a{color:#000}.video iframe{max-width:100%}.mobile_catalog_menu_light .menu_dark>a{color:#fff}.mobile_catalog_menu_light .menu_dark>a:after{background:url(/img/produce_right_col_arrow_new.png?v1) left bottom no-repeat;background-size:10px auto}.mobile_catalog_menu_light .menu_dark{background:#3c3c3b}.index_video_el_list img{margin:0 auto}.uslugi_el_list{float:left}.mobile_find_city{padding:30px 0}.mobile_find_city .input_wrap>p{padding:0 15px;margin:0 0 20px}.find_city.mobile_find_city .input_wrap{padding:0;margin:0}.mobile_find_city .bx-sls{margin-bottom:50px;padding:0 15px}.mobile_find_city span.dropdown-icon{display:none}.mobile_find_city .bx-sls .dropdown-fade2white{top:15px}.mobile_find_city .dropdown-block .bx-ui-sls-container input[type="text"]{height:57px;border-radius:12px!important}.mobile_find_city .dropdown-block{height:57px;box-shadow:inset 0 0 8px 1px rgba(92,89,89,.27)!important;border-radius:12px!important;border:none!important;padding:0 20px!important}.new_call_back_light .bx-sls .bx-ui-sls-pane{top:35px!important;bottom:auto!important}.mobile_find_city .bx-sls .bx-ui-sls-pane{top:-10px!important;left:-5px!important;right:-5px!important;background:0;box-shadow:none;padding:90px 0 0 0;border-radius:12px 12px 0 0;width:auto;bottom:auto!important}.mobile_find_city .bx-sls .bx-ui-sls-pane .bx-ui-sls-variants{background:#3c3c3b}.mobile_find_city .bx-sls .bx-ui-sls-pane .bx-ui-sls-variant:first-child{border-top:0}.mobile_find_city .bx-sls .bx-ui-sls-pane .bx-ui-sls-variant{border-top:1px solid #686767}.mobile_find_city .bx-sls .dropdown-item-text{color:#e6e6e6}.mobile_find_city .bx-sls .dropdown-item-text span{color:#fff;font-family:latobold}.mobile_find_city .bx-sls .bx-ui-sls-variants .bx-ui-sls-variant:hover span,.mobile_find_city .bx-sls .bx-ui-sls-variant-active span,.mobile_find_city .bx-sls .bx-ui-sls-variants .bx-ui-sls-variant:hover,.mobile_find_city .bx-sls .bx-ui-sls-variant-active{background:none!important;color:#c41a1c}.mobile_find_city .mobile_find_city_list a.active,.mobile_find_city .mobile_find_city_list a:hover{color:#c41a1c!important;text-decoration:none}.mobile_find_city .mobile_find_city_list a{color:#e6e6e6!important;font-size:16px!important;margin-top:0!important;border-bottom:none!important}.mobile_find_city .mobile_find_city_list{color:#e6e6e6;font-size:16px}.mobile_find_city .mobile_find_city_list>li:first-child{border-top:1px solid gray}.mobile_find_city .mobile_find_city_list>li a{padding:15px 15px;display:block}.mobile_find_city .mobile_find_city_list>li{border-bottom:1px solid gray}.dostavka_box_block .min_element_contacts:nth-child(3n){margin-right:0}.dostavka_box_block .min_element_contacts{margin:30px 6.6% 0 0}.uslugi_page_el a:hover{color:#c41a1c}.uslugi_page_el a{text-decoration:none}.uslugi_page_el{text-align:center}.uslugi_page_el_img{margin-bottom:10px}.news_detail_firearm_block{width:400px;max-width:100%;margin:0 auto 30px;background:url(/img/shadow_block.png?v1) center bottom no-repeat;background-size:100% 12px;padding-bottom:12px;text-align:center}.news_detail_firearm_block .razdel_firearm_img{height:200px;line-height:190px;margin-bottom:10px}.news_detail_firearm_block .razdel_firearm{height:auto}.news-detail .red_button{margin:10px auto;height:40px;line-height:39px;font-size:18px}.new_basket_el_left_title{text-align:left}.block_props_basket span{color:#7c7c7c}.block_props_basket{font-size:13px;line-height:1.4}.premue_block .premue_item{display:inline-block;text-align:center;width:150px;margin-bottom:20px}.premue_block .premue_img{margin-bottom:10px}.premue_block{text-align:center}.premme{background-image:url(/images/pr/bg.png);margin:1em auto;background-size:100% 100%}.wrap_cont{position:relative}.new_basket_el.order_create_success{padding:20px 15px;font-size:20px;border:2px solid #3aaa35;margin-bottom:15px}.new_basket_el.order_create_success>div:last-child{margin-bottom:0}.new_basket_el.order_create_success>div{margin-bottom:15px}.order_create_success_basket_el{background:#fff;border-radius:8px;margin-bottom:10px;padding:30px 15px 0}.order_create_success_basket_el .new_basket_el{margin-bottom:0;border-top:1px solid #e6e6e6;border-radius:0}.order_create_success_title{font-size:25px;font-family:latobold;color:#c41a1c;margin-bottom:20px}.block_subsection:first-child{border-top:0}.block_subsection{padding:20px 0 20px 28%;border-radius:0;font-size:14px;border-top:1px solid #e6e6e6;position:relative;min-height:100px;text-align:left}.block_subsection_bg{background:#fff;border-radius:8px;margin-bottom:10px;padding:0 15px 0}.block_subsection_title{font-size:18px;font-family:latobold;margin-bottom:15px;display:block}.block_subsection p{margin-bottom:5px}.block_subsection:before{content:'';display:block;width:70px;height:70px;position:absolute;left:16.4%;top:20px}.block_subsection_tel:before{background:url(/img/block_subsection_tel.png?v1) center 5px no-repeat}.block_subsection_money:before{background:url(/img/block_subsection_money.png?v1) center top no-repeat}.block_subsection_basket:before{background:url(/img/block_subsection_basket.png?v1) center top no-repeat}.block_subsection_user:before{background:url(/img/block_subsection_user.png?v1) center top no-repeat}.block_subsection_column{display:table;width:100%}.block_subsection_column .left_block,.block_subsection_column .right_block{display:table-cell;vertical-align:middle}.block_subsection_column .left_block{width:76%;padding-right:33%}.block_subsection_column .right_block{font-family:latobold;font-size:25px}.index_slider_block li>a{display:block}.index_slider_block li{list-style:none}.bx-soa-pp-item-container .bx-pagination .bx-pagination-container ul li.bx-active span{background:#c41a1c}.bx-soa-pickup-l-item-adress{color:#000!important}.bx-soa-pickup-list-item.bx-selected{background:#f6f6f6!important}#bx-soa-order .btn.btn-default{max-width:100%}a.bx-soa-editstep{text-decoration:none}.js_mobile_text_el_light.active{overflow:visible!important}.ajax_pager_wrap_block:hover{background:#fbfbfb}.ajax_pager_wrap_block{padding:10px 10px;border:1px solid #e6e6e6;margin-bottom:15px}.bx-soa-pp-company-graf-container{border:1px solid #a7a7a7!important}.bx-soa-pp-desc-container .bx-soa-pp-company{border:1px solid #a7a7a7!important;background:#fefefe!important}.bx-soa-pp-company.bx-selected .bx-soa-pp-company-graf-container{border:1px solid #c41a1c!important}.bx-soa-pp-delivery-cost{right:-1px!important;bottom:-1px!important}.bx-soa-pp-list-termin,.bx-soa-pp-company-smalltitle{color:#000!important;font-family:latobold}.bx-sls .bx-ui-sls-pane{top:35px!important;bottom:auto!important}.top_row .btn.btn-link{border-radius:10px 10px 0 0}.basket_gray_button:hover{color:#fff;background:#c41a1c;border:1px solid #c41a1c}.basket_gray_button{width:100%;height:46px;line-height:44px;border-radius:10px;text-transform:uppercase;font-size:18px;font-family:latoregular;text-align:center;background:#e6e6e6;margin-top:10px;color:#686767;border:1px solid #686767;display:block;text-decoration:none;cursor:pointer}.one_click_form_el{width:100%;margin-bottom:15px}.one_click_form_el input[type="text"],.one_click_form_el input[type="password"],.one_click_form_el input[type="email"],.one_click_form_el input[type="tel"],.one_click_form_el textarea{border:1px solid #dadada;height:45px;width:100%;display:block;background:none;padding:0 16px;margin:0 0 20px;box-shadow:none}.one_click_form_title{text-align:center;font-size:35px;line-height:37px;margin:0 0 24px}.one_click_form_block .red_button{margin:0 auto}.targets-list a{text-decoration:none}.target-group-title{margin:10px 0 25px;text-align:center;font-family:latobold;font-size:20px}.new_call_back_light.dasket_one_click_popup{width:430px;max-width:100%;padding:20px 20px 28px}.new_call_back_light.dasket_one_click_popup .red_button{height:40px;line-height:39px;font-family:latobold;font-size:18px;width:200px;margin-top:15px}.targets-list{text-align:left}.block_knop{float:left;margin-right:15px;display:inline-block}.button_raskr{width:72px;height:72px;background-image:url(/img/knop_phone.png?v1);background-color:rgba(146,55,55,.901961);background-position:center center;background-repeat:no-repeat;border:3px solid rgb(54,62,67);border-radius:50%;cursor:pointer}.form_zbonok{float:left;height:72px;display:none;position:relative;top:0}.item_zvonok{display:inline-block;vertical-align:middle}.form_zbonok{background-color:rgba(54,62,67,.921569);width:470px;height:52px;top:1.1em;opacity:1;visibility:visible;-webkit-box-shadow:0 0 1.6em rgba(0,0,0,.45);-moz-box-shadow:0 0 1.6em rgba(0,0,0,.45);box-shadow:0 0 1.2em rgba(0,0,0,.4);-webkit-transition:width 0.35s ease,height 0.35s ease,right 0.35s ease,top 0.35s ease;-moz-transition:width 0.35s ease,height 0.35s ease,right 0.35s ease,top 0.35s ease;-ms-transition:width 0.35s ease,height 0.35s ease,right 0.35s ease,top 0.35s ease;-o-transition:width 0.35s ease,height 0.35s ease,right 0.35s ease,top 0.35s ease;transition:width 0.35s ease,height 0.35s ease,right 0.35s ease,top 0.35s ease;-webkit-border-radius:50px;border-radius:50px}.form_script_zvonok{margin-top:5px}.block_close{position:absolute;top:-1px;right:-14px;width:18px;height:18px;background:url(/img/icon_close.png?v1) no-repeat 2px 0;cursor:pointer}.block_close:hover{background:url(/img/icon_close.png?v1) no-repeat -17px 0}.active_button_plus{display:none}.active_button_pluss{display:block}.prume_form{min-height:140px!important}.premue_block .premue_item{display:inline-block;text-align:center;width:150px}.premue_block .premue_img{margin-bottom:10px}.premue_block{text-align:center}.premme{background-image:url(/images/pr/bg.png);min-height:261px;max-width:1093px;margin:1em auto}.buy_now.in_basked{color:#fff;background:#ccc;cursor:default;border:0}.span_perez{color:#FFF;font-size:12px;text-shadow:rgb(54,62,67) 1px 1px 0}.div_one_zv{width:100px;padding-left:10px;vertical-align:middle}.phone_before{background:url(/img/phone_script.png?v1);height:29px;width:29px;vertical-align:middle;display:inline-block;margin-left:20px}.a_galka{width:40px;height:40px;border-radius:50%;background:#923737 url(/img/galka_script.png?v1) no-repeat center center;margin-right:5px;border:none;position:relative}.a_close{width:40px;height:40px;border-radius:50%;background:#747474 url(/img/close_script.png?v1) no-repeat center center;border:1px solid #bbb}.itemCategoriesListing,.itemCategoriesListingNoImage{background:url(/images/podlojka.png) 0 0 no-repeat;padding:10px 17px 0 15px;width:140px;height:130px;background-size:100% 100%}.itemCategoriesListing:hover{background:url(/images/podlojka.png) 0 0 no-repeat;background-size:100% 100%}.itemCategoriesListing.detail_brend_block .categories_img>a img{display:inline;vertical-align:middle}.itemCategoriesListing .categories_img>a img{display:inline;vertical-align:middle;max-width:100%;max-height:99%}.itemCategoriesListing .categories_img>a{height:185px;display:block;line-height:175px}.categories_name{display:table;width:100%;height:65px;text-decoration:none}.categories_name>span{display:table-cell;vertical-align:middle;text-align:center}.categories_name>span a{text-decoration:none}.categories_name a{font-size:24px}.itemCategoriesListingNoImage{margin-bottom:0;width:140px;margin-right:4px;margin-left:4px}.itemCategoriesListingNoImage:hover,.itemCategoriesListingNoImage{border:none;box-shadow:none}.itemCategoriesListingNoImage:after,.itemCategoriesListingNoImage:before{display:none}.itemCategoriesListingNoImage .categories_name{margin-top:72px}.categories_listing{text-align:center}.categories_listing .detail_brend_block:hover{background:url(/images/item_1_hover.png) 0 0 no-repeat!important;background-size:100% auto!important}.categories_listing .detail_brend_block{background:url(/images/item_02.png) 0 0 no-repeat!important;background-size:100% auto!important;width:380px!important;height:290px!important}.itemCategoriesListing:hover .categories_name a,.itemCategoriesListingNoImage:hover{color:#d15700}.categories_name .h1{font-size:24px;margin-bottom:0;text-transform:uppercase;font-family:LiberationSerifBold,sans-serif;background:url(images/line.gif) left bottom repeat-x}.categories_listing .red_button{width:100%;max-width:400px;margin:0 auto}@media all and (min-width:500px){.fancybox-inner{min-width:356px}}.payment_page_card{text-align:center;margin:10px auto 15px}.card_pay table{margin:10px 0}.card_pay td:first-child{padding-right:15px}.card_pay td{padding:5px 0 5px 0;text-align:left}.card_pay td .hint{font-size:12px;padding-top:5px}a.menu_link{text-decoration:none}a.menu_link span{display:block;margin-bottom:10px}a.menu_link:hover span{color:#c41a1c;text-decoration:underline}.sal_error{border-color:red!important}.detail_share_title{padding-bottom:3px}.index_yandex_img{padding:0 0 25px 20px}.demisale-campaign-banner{cursor:pointer}.detail_photo_produce_block{display:inline-block;vertical-align:top;padding:0 30px}.element_contacts iframe{max-width:100%}.min_element_contacts_block{margin-bottom:20px}.dostavka_box_block{overflow-x:auto}#big_map2{height:250px}form[name="SIMPLE_FORM_2"] input[type="text"]:focus,.index_podpiska_form .pole_email:focus,form[name="SIMPLE_FORM_1"] input[type="text"]:focus,form[name="SIMPLE_FORM_1"] .inputtextarea:focus,form#dscallme-form #field-id238580:focus,form#ask_a_question input[type="text"]:focus,form[name="iblock_add"] input[type="text"]:focus,form[name="iblock_add"] textarea:focus{box-shadow:0 0 10px rgba(0,0,0,.5)}.preload_info{color:#fff;font-size:1.2em;border:none;padding:130px 10px;margin:15px 5px;text-align:center;word-wrap:break-word;overflow:hidden}.center_loader_mask{top:0;width:100%;height:100%;z-index:5;text-align:center;position:absolute;background-color:rgba(255,255,255,.68);border-radius:0 0 17px 17px}.img-loader{background-image:url(images/loader.GIF)!important;background-repeat:no-repeat!important;width:24px;height:24px;position:relative;display:inline-block;top:18%;margin-left:5px}.foot_bl{padding:25px 10px 0;font-family:latoregular}.foot_new_soc{margin-bottom:20px}.foot_new_soc a{display:inline-block;vertical-align:middle;width:31px;height:31px;margin-bottom:10px;margin-left:3px}.foot_new_soc a:first-child{margin-left:0}.fb_soc_new{background:url(/img/fb_soc_new.png?v1) left top no-repeat}.tw_soc_new{background:url(/img/tw_soc_new.png?v1) left top no-repeat}.ok_soc_new{background:url(/img/ok_soc_new.png?v1) left top no-repeat}.vk_soc_new{background:url(/img/vk_soc_new.png?v1) left top no-repeat}.inst_soc_new{background:url(/img/inst_soc_new.png?v1) left top no-repeat}.google_soc_new{background:url(/img/googl_soc_new.png?v1) left top no-repeat}.you_soc_new{background:url(/img/you_soc_new.png?v1) left top no-repeat}.fb_soc_new:hover{background:url(/img/fb_soc_new.png?v1) left bottom no-repeat}.tw_soc_new:hover{background:url(/img/tw_soc_new.png?v1) left bottom no-repeat}.ok_soc_new:hover{background:url(/img/ok_soc_new.png?v1) left bottom no-repeat}.vk_soc_new:hover{background:url(/img/vk_soc_new.png?v1) left bottom no-repeat}.inst_soc_new:hover{background:url(/img/inst_soc_new.png?v1) left bottom no-repeat}.google_soc_new:hover{background:url(/img/googl_soc_new.png?v1) left bottom no-repeat}.you_soc_new:hover{background:url(/img/you_soc_new.png?v1) left bottom no-repeat}.top_foot_mob a:first-child{margin-left:0}.top_foot_mob a{display:inline-block;margin-left:15px;vertical-align:middle}.top_foot_mob a img{display:block}.top_foot_logo_title{color:#000;margin-bottom:5px;font-size:15px}.foot_logo_el{display:block;margin-bottom:25px}.top_foot_time{font-size:16px;margin-bottom:20px}.foot_tel_el:last-child{margin-bottom:0}.foot_tel_el{font-size:14px;margin-bottom:15px}.top_foot_geo:hover,.top_foot_price:hover,.top_foot_mail:hover,.foot_tel_el a:hover{color:#c41a1c}.foot_tel_el a{font-size:22px;font-family:latomedium;text-decoration:none}.top_foot_geo,.top_foot_price,.top_foot_mail{padding-left:40px;margin-bottom:15px;font-size:22px;text-decoration:none;display:block}.top_foot_geo{background:url(/img/top_foot_geo.png?v1) left 1px no-repeat}.top_foot_geo:hover{background:url(/img/top_foot_geo.png?v1) left -25px no-repeat}.top_foot_price{background:url(/img/top_foot_price.png?v1) left 1px no-repeat}.top_foot_price:hover{background:url(/img/top_foot_price.png?v1) left -25px no-repeat}.top_foot_mail{background:url(/img/top_foot_mail3.png?v1) left 2px no-repeat}.top_foot_mail:hover{background:url(/img/top_foot_mail3.png?v1) left -25px no-repeat}.header_status_bt{position:absolute;top:100%;right:60px;margin-top:37px;font-size:16px;font-weight:700;text-decoration:none;color:#c41a1c}.header_status_bt:hover{text-decoration:underline}.m_header_status_bt{margin:0 auto;display:block;text-align:center;font-size:16px;font-weight:700;text-decoration:none;color:#c41a1c}.m_header_status_bt:hover{text-decoration:underline}header .foot_tel_el{margin-bottom:5px}.new_banner_page{margin-bottom:15px}.left_column .all_social_block{max-width:200px;margin-left:20px}.left_column .section.social_tabs>div{margin-bottom:20px}.clear_after:after{content:'';display:block;clear:both}.news_bl{display:flex;flex-wrap:wrap;align-items:stretch}.news_el_bl:nth-child(3n){margin-right:0}.news_el_bl{display:inline-block;margin-bottom:22px;width:32%;margin-right:1.5%;vertical-align:top;position:relative;min-height:370px}.news_el{border-radius:10px;background:#fff;border:1px solid #e6e6e6;min-height:100%}.news_el_img{height:200px;line-height:190px;overflow:hidden;text-align:center}.news_el_img>a{display:block;height:100%;width:100%;border-radius:10px 10px 0 0;background-size:auto 100%;background-position:center;background-repeat:no-repeat}.news_el_img img{max-width:none;height:100%;border-radius:10px 10px 0 0;display:inline;margin:0 auto}.news_el_txt_bl{padding:10px 10px 15px}.news_el_txt_bl .news_list_title{font-size:16px;font-weight:700;margin-bottom:10px;text-align:left}.news_el_txt_bl .news_list_text{font-size:14px;text-align:left}.news_el_txt_bl a{text-decoration:none}.news_el_bt:hover{border-color:#c41a1c;color:#fff;background:#c41a1c}.news_el_bt{width:158px;border:1px solid #686767;background:#e6e6e6;text-align:center;padding:7px 3px;line-height:1;font-size:14px;color:#000;display:none;border-radius:4px;position:absolute;left:50%;margin-left:-79px;bottom:15px}.news_el_bl:hover .news_el{position:absolute;left:1px;right:1px;top:1px;z-index:100;border:none;box-shadow:2px 2px 15px 0 rgba(0,0,0,.3)}.news_el_bl:hover .news_el_txt_bl{padding-bottom:60px}.news_el_bl:hover .news_el_bt{display:block}.catalog_page_navigator_block{width:100%}#bx-soa-order .btn.btn-default.pull-left:hover{background:#686767!important;color:#fff}#bx-soa-order .btn.btn-default.pull-left{background:#e6e6e6!important;color:#686767;border:1px solid #686767}.donload_application_bl{padding-top:10px}.donload_application_l_col{margin-bottom:25px}.donload_application_r_col p:last-child{margin-bottom:0}.donload_application_r_col p{margin-bottom:30px}.donload_application_r_col{line-height:1.8}.applic_donload_bt_col:first-child a{display:block;margin-bottom:15px}.applic_donload_bt_col{display:inline-block;vertical-align:middle;margin:0 35px 40px;font-weight:700;font-size:22px;max-width:250px} .vhod_page_left_col .vhod_page_old_password {text-decoration:none;} .vhod_page_left_col .vhod_page_old_password:hover {text-decoration:underline;} .new_basket_el.order_create_success.other_notetext {padding: 20px 15px; font-size: 18px; border: 2px solid #3aaa35; margin:20px 0 15px; border-radius: 8px;} .new_basket_el.order_create_success.other_notetext .notetext {color:#000;} .sale-personal-section-index-block.bx-theme-blue { background:none!important; box-shadow: inset 0 0 0 1px #989797, 0 3px 12px 0 #848484; opacity:1!important;} .sale-personal-section-row-flex>.col-lg-4:nth-child(5n) {margin-right:0;} .sale-personal-section-row-flex>.col-lg-4 {width: 18%; margin-right: 2.5%; margin-bottom: 20px;} .sale-personal-section-index-block-ico .fa:before {color:#696767;}  .sale-personal-section-index-block-link .sale-personal-section-index-block-name {margin-bottom:0px; padding-top:10px;} .sale-personal-section-index-block.bx-theme-blue:hover { box-shadow: inset 0 0 0 2px #c41a1c, 0 3px 12px 0 #848484;} .sale-personal-section-index-block:hover .sale-personal-section-index-block-ico .fa:before {color:#c41a1c;}  .wrap_cont .sale-order-link, .wrap_cont .sale-order-history-link, .wrap_cont .sale-order-list-shipment-button, .wrap_cont .sale-order-list-repeat-link, .wrap_cont .sale-order-list-cancel-link, .wrap_cont .sale-order-list-about-link, .wrap_cont .sale-order-list-change-payment {color:#c41a1c;} .sale-order-list-repeat-link:before {background: url(/img/sale-order-repeat.png) no-repeat!important; background-size:10px 13px!important;} .row .btn.sale-account-pay-button {background: #c41a1c; background: linear-gradient(to bottom,#c41a1c,#951316); border-radius: 4px; font-family: latoblack; font-size: 15px; color: #fff; text-decoration: none; cursor: pointer;box-sizing: border-box; display: table; height: 30px; line-height: 29px; padding: 0 10px; min-width: 130px; border: 0; text-align:center;} .row .btn.sale-account-pay-button:hover { background: #951316; background: linear-gradient(to top,#c41a1c,#951316);} .sale-acountpay-pp:after {content:''; display:block; clear:both;} .sale-acountpay-pp-company {float:left; width:20%;} .sale-acountpay-pp-company.bx-selected .sale-acountpay-pp-company-graf-container { border-color: #c41a1c!important;} .sale-acountpay-fixedpay-list .sale-acountpay-fixedpay-item {background: #e6e6e6!important;} .sale-acountpay-block.form-horizontal .form-group .col-sm-9 {display: inline-block; width: 80%;} .sale-acountpay-pp-company-graf-container .jq-checkbox {position:absolute!important; left:10px; top:10px;} .sale-personal-account-wallet-currency-item {color:#000!important;} .sale-personal-account-wallet-list-container {background-color: #e6e6e6!important; color:#000!important;} .sale-personal-account-wallet-title {background-color: #c41a1c!important;} .sale-profile-detail-form .sale-personal-profile-detail-form-label { width: 250px; padding-right: 30px; text-align: left;} .main-profile-form-label.text-md-right { width: 150px; padding-right: 30px; text-align: left;} .form-group {margin-bottom:10px;} .table.sale-personal-profile-list-container td, .table.sale-personal-profile-list-container th {padding:5px 10px;} .table.sale-personal-profile-list-container {width:100%;} .sale-personal-profile-list-change-button {text-decoration:none; border-bottom:none!important; color:#c41a1c;} .table.sale-personal-profile-list-container a {text-decoration:none;} .sale-personal-profile-list-arrow-up:hover, .sale-personal-profile-list-arrow-down:hover {color: #c41a1c!important;} .profile-table.data-table input[type='password'], .form-group input[type='password'] {width:190px; max-width:100%; padding:0 5px;} .bx-auth-profile .red_button, .main-profile-form-buttons-block .red_button {display:inline-table;} .bx-auth-profile .gray_button, .main-profile-form-buttons-block .gray_button {display:inline-block; width:130px;} .profile-table.data-table td {padding-bottom:10px;} .sale-profile-detail-form small {font-size:11px;}
</style>
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
<?if (!$USER->IsAuthorized()):?>
                    <li><a href="/auth/">???????? ?? ??????????????</a></li>
                    <li> | </li>
                    <li><a href="/auth/reg/">??????????????????????</a></li>
<?else:?>    
                    <li><a href="/lk/">???????????? ??????????????</a></li>
                    <li>|</li>
                    <li><a href="/?logout=yes">??????????</a></li>head_info_logo
<?endif?>
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
                                    <b>??????????</b><span><?=$locationUser?></span>
                                </span>
                            </a>
                            <?
                        $frame->beginStub();
                            ?>
                            <a class="menu_lvl1_button mobile_menu_geo_button js_menu_lvl1_button" href="javascript:void(0);">
                                <span>
                                    <b>??????????</b><span>????????????</span>
                                </span>
                            </a>
                            <?
                        $frame->end();
                        ?>
                        <?/*\Bitrix\Main\Page\Frame::getInstance()->startDynamicWithID("user-location");?>
                            <?$locationUser = getUserLocation();?>
                            <a class="menu_lvl1_button mobile_menu_geo_button js_menu_lvl1_button" href="javascript:void(0);">
                                <span>
                                    <b>??????????</b><span><?=$locationUser?></span>
                                </span>
                            </a>
                        <?
                        \Bitrix\Main\Page\Frame::getInstance()->finishDynamicWithID("user-location", "????????????????...");
                        */?>
                        <div class="mobile_menu_geo js_menu_lvl2">
                            <div class="mobile_catalog_menu_come_back js_mobile_catalog_menu_come_back"><a href="">??????????</a></div>
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
                                    \Bitrix\Main\Page\Frame::getInstance()->finishDynamicWithID("mobile_menu_geo", "????????????????...");
                                    ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>


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
                                    "PAGER_TITLE" => "????????????????",
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
                            <?//\Bitrix\Main\Page\Frame::getInstance()->finishDynamicWithID("telephone_logo_head", "????????????????...");?>
                            <?$frame->beginStub();?>
                                <p><span>8 (495) 268-13-72 </span>(????????????)</p>
                                <p><span>8 (812) 309-87-66 </span>(??????????-??????????????????)</p>
                                <p><span>8 (800) 707-44-15 </span>(?????????????? ????????????)</p>
                            <?$frame->end();?>
                        </div>
                        <div class="head_white_status"><a href="/order-status/">???????????? ????????????</a></div>

                        <?/*\Bitrix\Main\Page\Frame::getInstance()->startDynamicWithID("basket");*/?>
                        <?/*$APPLICATION->IncludeComponent(
                            "bitrix:sale.basket.basket.small",
                            "head_new",
                            Array(
                                "PATH_TO_BASKET" => "/personal/cart/",
                                "PATH_TO_ORDER" => "/personal/order/",
                                "SHOW_DELAY" => "N",
                                "SHOW_NOTAVAIL" => "N",
                                "SHOW_SUBSCRIBE" => "N"
                            )
                        );*/?>
                        <?
                        /*\Bitrix\Main\Page\Frame::getInstance()->finishDynamicWithID("basket", "????????????????...");*/
                        ?>
                        
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
                                    <span class="head_white_favorite_tit">??????????????????</span>
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

    
<?if($_GET["old"]==1): //???????????? ???????????>    
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
                            \Bitrix\Main\Page\Frame::getInstance()->finishDynamicWithID("basket", "????????????????...");
                            ?>
                        </div>
                        <div class="clear"></div>
                        <div id="header_vhod">
                            <?\Bitrix\Main\Page\Frame::getInstance()->startDynamicWithID("header_vhod");?>
                                <?if (!$USER->IsAuthorized()):?>
                                    <ul class="header_vhod">
                                        <li><a href="/auth/">???????? ?? ??????????????</a></li>
                                        <li> | </li>
                                        <li><a href="/auth/reg/">??????????????????????</a></li>
                                    </ul>
                                <?endif;?>
                            <?
                            \Bitrix\Main\Page\Frame::getInstance()->finishDynamicWithID("header_vhod", "");
                            ?>
                            <a class="header_status_bt" href="/status-zakaza/">???????????? ????????????</a>
                        </div>
                    </div>
                </div>
                <div class="telephone_firearm">
                    <div class="telephone_logo">
                        <p class="telephone_logo_title">????????????????-?????????????? ?????????????? ?????? ??????????</p>
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
                                    "PAGER_TITLE" => "????????????????",
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
                            <?//\Bitrix\Main\Page\Frame::getInstance()->finishDynamicWithID("telephone_logo_head", "????????????????...");?>
                            <?$frame->beginStub();?>
                                <p><span>8 (495) 268-13-72 </span>(????????????)</p>
                                <p><span>8 (812) 309-87-66 </span>(??????????-??????????????????)</p>
                                <p><span>8 (800) 707-44-15 </span>(?????????????? ????????????)</p>
                            <?$frame->end();?>
                        </div>
                        <p><a class="call_back fancy_ajax" href="/include/popup_callback.php">???????????????? ???????????? ??????????????????</a></p>
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
                                    <a class="mobile_header_geo js_mobile_header_geo" href=""><span>????????????</span></a>
                                    <div class="header_geo_light" style="display: block;">
                                        <div class="header_geo_light_title">?????? ????????????: <span>????????????</span> ?</div>
                                        <div class="header_geo_light_button">
                                            <a class="geo_gray_button" href=""><span>????</span></a>
                                            <a class="geo_red_button fancy_ajax" href="/include/popup_geo.php"><span>??????????????<br/>???????????? ??????????</span></a>
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
                            <?\Bitrix\Main\Page\Frame::getInstance()->finishDynamicWithID("mobile_header_geo_block", "????????????????...");*/?>
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
                        <div class="catalog_produce <?if ($isIndex):?>index_catalog_produce<?endif;?>"> <!-- ?????????? -->
                            <a href="/catalog/" class="catalog_menu_button">
                                <span>?????????????? ??????????????</span>
                            </a>
                                <?// ???????? ???????? ???? ?????????????????????????????? ??????????????, ???????????????? ??????????????????????. ?????????????? ?????????????? ??????????????????, ???????????? ??? 11969?>
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
                        <li class="display_none_m display_none_mp"><div class="mobile_header_top_slogan">????????????????-?????????????? ?????????????? ?????? ??????????</div></li>
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
                    <?\Bitrix\Main\Page\Frame::getInstance()->finishDynamicWithID("mobile_header_top_info_bg", "????????????????...");?>
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
                                "PAGER_TITLE" => "????????????????",
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
                        <li><a class="m_header_status_bt" href="/status-zakaza/">???????????? ????????????</a></li>
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
                    <?\Bitrix\Main\Page\Frame::getInstance()->finishDynamicWithID("mobile_header_telephone_geo", "????????????????...");?>
                </div>
            </div>

        </header>

<?else: //?????????? ???????????>

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
                                    <div class="header_geo_light_title">?????? ????????????: <span>...</span> ?</div>
                                    <div class="header_geo_light_button">
                                        <a class="geo_gray_button" href=""><span>????</span></a>
                                        <a class="geo_red_button fancy_ajax" href="/include/popup_geo.php"><span>??????????????<br/>???????????? ??????????</span></a>
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
                        <?\Bitrix\Main\Page\Frame::getInstance()->finishDynamicWithID("mobile_header_geo_block", "????????????????...");*/?>
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
                                <a href="/auth/">????????</a>
                                <span>|</span>
                                <a href="/auth/reg/">??????????????????????</a>                                
                            <?else:?>    
                                <a href="/?logout=yes">??????????</a>
                                <span>|</span>
                                <a href="/lk/">???????????? ??????????????</a>                                

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
                        <p class="telephone_logo_title">????????????????-?????????????? ?????????????? ?????? ??????????</p>
                        <a class="head_info_logo" href="/">
                            <img src="/img/2020_Logo_bg.gif"/>
                        </a>
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
                                        "PAGER_TITLE" => "????????????????",
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
                            <?//\Bitrix\Main\Page\Frame::getInstance()->finishDynamicWithID("telephone_logo_head", "????????????????...");?>
                            <?$frame->beginStub();?>
                                <p><span>8 (495) 268-13-72 </span>(????????????)</p>
                                <p><span>8 (800) 707-44-15 </span>(?????????????? ????)</p>
                            <?$frame->end();?>
                        </div>
                        <p><a class="call_back fancy_ajax" href="/include/popup_callback.php">???????????????? ???????????? ??????????????????</a></p>
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
                        <div class="head_white_status "><a href="/order-status/">???????????? ????????????</a></div>

                        <div class="loadhead">    
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
                        \Bitrix\Main\Page\Frame::getInstance()->finishDynamicWithID("basket", "????????????????...");
                        ?>
                        </div>
                        
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
                            </a>
                            
                        </div>
                        <div class="head_white_favorite">
                            <a href="/catalog/favourites/">
                                <?$arrFilter0 = Array("ID"=>json_decode($_COOKIE['favourites']));
                                    $favor_uniq=array_unique($arrFilter0["ID"])
                                ?>                                
                                <span class="head_white_favorite_ic <?if(count($favor_uniq)>0):?>red<?endif?>">
                                    <span><?=count($favor_uniq)?></span>
                                </span>
                                <span class="head_white_favorite_tit">??????????????????</span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="bottom_header_menu_block">
                    <div class="bottom_header_menu">
                        <div class="catalog_produce <?if ($isIndex):?>index_catalog_produce<?endif;?>"> <!-- ?????????? -->
                            <a href="/catalog/" class="catalog_menu_button">
                                <span>?????????????? ??????????????</span>
                            </a>
                                <?// ???????? ???????? ???? ?????????????????????????????? ??????????????, ???????????????? ??????????????????????. ?????????????? ?????????????? ??????????????????, ???????????? ??? 11969?>
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
        "USE_LANGUAGE_GUESS" => "Y",
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
                        <?/*<div class="bottom_menu">
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
                        </div>*/?>
                    </div>
                </div>
                        
        </div>
            <div class="display_none_c">
                <div class="mobile_header_top_info_bg" id="mobile_header_top_info_bg">
                    <?\Bitrix\Main\Page\Frame::getInstance()->startDynamicWithID("mobile_header_top_info_bg");?>
                    <ul class="mobile_header_top_info js_mobile_header_top_info">
                        <li>
                            <!-- <div class="mobile_header_top_menu"> -->
                                <a class="catalog_menu_mobile_button js_catalog_menu_mobile_button" href=""></a>
                            <!-- </div> -->
                        </li>
                        <li><a class="mobile_header_top_logo" href="/"><img src="/img/mobile_top_logo.png" alt=""/></a></li>
                        <li class="display_none_m display_none_mp"><div class="mobile_header_top_slogan">????????????????-?????????????? ?????????????? ?????? ??????????</div></li>
                        <li>
                            <a class="mobile_header_top_search js_mobile_header_top_search" href=""></a>
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
                        <a class="close_mob_search js_close_mob_search" href="">????????????</a>
                    </div>
                    <?\Bitrix\Main\Page\Frame::getInstance()->finishDynamicWithID("mobile_header_top_info_bg", "????????????????...");?>
                </div>
                <?/*
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
                                "PAGER_TITLE" => "????????????????",
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
                        <li><a class="m_header_status_bt" href="/status-zakaza/">???????????? ????????????</a></li>
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
                    <?\Bitrix\Main\Page\Frame::getInstance()->finishDynamicWithID("mobile_header_telephone_geo", "????????????????...");?>
                </div>*/?>
            </div>
        </header>
        
        
<?endif?>    


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
        
