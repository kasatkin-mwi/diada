jQuery(document).ready(function() {
    console.log("Метричка готова"), jQuery("#button_buy_product").click(function() {
        yaCounter25448447.reachGoal("kupit"), ga("send", "pageview", "/dobavlenie"), console.log('Для кнопки "Купить" на карточках товаров')
    }), jQuery("#button_buy_product").click(function() {
        yaCounter25448447.reachGoal("kupit"), ga("send", "pageview", "/dobavlenie"), console.log('Клик по кнопке "В кредит":')
    }), jQuery("a.new_det_gray_bt.green_h.fancy_ajax_click_buy").click(function() {
        yaCounter25448447.reachGoal("1-klik"), ga("send", "pageview", "/1-klik"), console.log('Нажатие на кнопку "Купить в 1 клик" на карточке')
    }), jQuery("a.basket_gray_button.fancy_ajax_click_buy_busket").click(function() {
        yaCounter25448447.reachGoal("clickonecart"), ga("send", "pageview", "/virtual/clickonecart"), console.log('Нажатие на кнопку "Купить в 1 клик" на странице корзины'), setTimeout("jQuery('#test input.red_button').click(function(){\n\t\tyaCounter25448447.reachGoal('sendonecart');\n\t\tga('send', 'pageview', '/virtual/sendonecart');\n\t\tconsole.log('Успешная отправка формы \"Купить в 1 клик\" В корзине');});", 3e3)
    }), jQuery(".pull-right.btn.btn-default.btn-lg").click(function() {
        yaCounter25448447.reachGoal("zakazat"), ga("send", "pageview", "/oformlenie_zakaza"), console.log('Для кнопки "Отправить заказ" на странице https://www.diada-arms.ru/personal/order/')
    }), jQuery('.red_button[value="Заказать звонок"]').click(function() {
        yaCounter25448447.reachGoal("pozvonit"), ga("send", "pageview", "/zvonok"), console.log("На отправку формы обратного звонка")
    }), jQuery("a.new_det_gray_bt.blue_h.fancy_ajax_click_buy").click(function() {
        yaCounter25448447.reachGoal("clickcredit"), ga("send", "pageview", "/virtual/clickcredit"), console.log('Клик по кнопке "В кредит"'), setTimeout("jQuery('#ask_a_question .one_click_form_el input.red_button').click(function(){\n\t\tyaCounter25448447.reachGoal('sendcredit');\n\t\tga('send', 'pageview', '/virtual/sendcredit');\n\t\tconsole.log('Успешная отправка формы \"В кредит\"');});", 3e3)
    }), jQuery("a.detail_red_button.fancy_ajax").click(function() {
        yaCounter25448447.reachGoal("clickreviewcard"), ga("send", "pageview", "/virtual/clickreviewcard"), console.log('Клик по кнопке "Оставить отзыв"'), setTimeout("jQuery('form[name=\"iblock_add\"] .new_call_back_light_right_button input.red_button').click(function(){\n\t\tyaCounter25448447.reachGoal('sendreviewcard');\n\t\tga('send', 'pageview', '/virtual/sendreviewcard');\n\t\tconsole.log('Успешная отправка формы \"Оставить отзыв\"');});", 3e3)
    }), jQuery('a.red_button.fancybox[href="#js_add_text_comment"]').click(function() {
        yaCounter25448447.reachGoal("clickreview"), ga("send", "pageview", "/virtual/clickreview"), console.log('Клик по кнопке "Оставить отзыв" (любой)')
    }), jQuery('div.add_text_comment div form[name="iblock_add"] input.red_button').click(function() {
        yaCounter25448447.reachGoal("sendreviewcard"), ga("send", "pageview", "/virtual/sendreviewcard"), console.log('Успешная отправка формы "Оставить отзыв" (любой)')
    })
});

jQuery( document ).ready(function() {

    setTimeout(function(){

        jQuery( document ).on( "click", 'a[href^="tel:"]', function() {
          yaCounter25448447.reachGoal("telefon");
        });
        
    },1000);




        jQuery( document ).on( "click", '.index_slider_block a[href="https://www.diada-arms.ru/catalog/specials/"]', function() {
          yaCounter25448447.reachGoal("winter_sale_click", {'DMS - Баннер winter sale': document.location.href});
        });
        jQuery( document ).on( "click", '.index_slider_block a[href="/articles/novosti_magazina/pnevmatika_s_sergeem_badyukom/"]', function() {
          yaCounter25448447.reachGoal("badyuk_click", {'DMS - Баннер Бадюк Мужские игрушки': document.location.href});
        });
        jQuery( document ).on( "click", '.index_slider_block a[href="https://www.diada-arms.ru/catalog/pnevmaticheskie_pistolety/izhevsk/bkl-mr-658-k-blowback-pm/"]', function() {
          yaCounter25448447.reachGoal("mp-658k_click", {'DMS - Баннер mp-658k': document.location.href});
        });
        jQuery( document ).on( "click", '.index_slider_block a[href="https://www.diada-arms.ru/catalog/pnevmaticheskie_vintovki/crosman/new/"]', function() {
          yaCounter25448447.reachGoal("сrosman_click", {'DMS - Баннер Crosman с пружиной': document.location.href});
        });
        jQuery( document ).on( "click", '.index_slider_block a[href="https://www.diada-arms.ru/catalog/pnevmaticheskie_vintovki/izhevsk/mr-555k/"]', function() {
          yaCounter25448447.reachGoal("mp-555_click", {'DMS - Баннер mp-555': document.location.href});
        });
        jQuery( document ).on( "click", '.index_slider_block a[href="https://www.diada-arms.ru/catalog/pnevmaticheskie_pistolety/izhevsk/pnevmaticheskiy_pistolet_makarova_mr_654k_32_300_seriya/"]', function() {
          yaCounter25448447.reachGoal("mp-654k-22_click", {'DMS - Баннер mp-654k-22': document.location.href});
        });
        jQuery( document ).on( "click", '.index_slider_block a[href="https://www.diada-arms.ru/delivery/?city=25128"]', function() {
          yaCounter25448447.reachGoal("dostavka_click", {'DMS - Баннер Доставка по России': document.location.href});
        });
        jQuery( document ).on( "click", '.index_slider_block a[href="https://www.diada-arms.ru/uslugi/kredit-po-vsey-rossii/"]', function() {
          yaCounter25448447.reachGoal("credit_click", {'DMS - Баннер Кредит по России': document.location.href});
        });
        jQuery( document ).on( "click", '.index_slider_block a[href="https://www.diada-arms.ru/catalog/fonari/fonari-fitorch/?clear_cache=Y"]', function() {
          yaCounter25448447.reachGoal("fitorch_click", {'DMS - Баннер FiTorch': document.location.href});
        });
        jQuery( document ).on( "click", '.index_slider_block a[href="/articles/novosti_magazina/fotokonkurs/"]', function() {
          yaCounter25448447.reachGoal("foto_click", {'DMS - Баннер Фотоконкурс': document.location.href});
        });
        jQuery( document ).on( "click", '.index_slider_block a[href="/help/prilozhenie/"]', function() {
          yaCounter25448447.reachGoal("appl_click", {'DMS - Баннер Скачать приложение': document.location.href});
        });        
});