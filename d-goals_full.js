jQuery(document).ready(function(){
    console.log('Метричка готова');

    jQuery('#button_buy_product').click(function(){
        yaCounter25448447.reachGoal('kupit');
        ga('send', 'pageview', '/dobavlenie');
        console.log('Для кнопки "Купить" на карточках товаров');
    });

    jQuery('#button_buy_product').click(function(){
        yaCounter25448447.reachGoal('kupit');
        ga('send', 'pageview', '/dobavlenie');
        console.log('Клик по кнопке "В кредит":');
    });

    jQuery('a.new_det_gray_bt.green_h.fancy_ajax_click_buy').click(function(){
        yaCounter25448447.reachGoal('1-klik');
        ga('send', 'pageview', '/1-klik');
        console.log('Нажатие на кнопку "Купить в 1 клик" на карточке');
    });

    jQuery('a.basket_gray_button.fancy_ajax_click_buy_busket').click(function(){
        yaCounter25448447.reachGoal('clickonecart');
        ga('send', 'pageview', '/virtual/clickonecart');
        console.log('Нажатие на кнопку "Купить в 1 клик" на странице корзины');

        setTimeout(`jQuery('#test input.red_button').click(function(){
        yaCounter25448447.reachGoal('sendonecart');
        ga('send', 'pageview', '/virtual/sendonecart');
        console.log('Успешная отправка формы "Купить в 1 клик" В корзине');});`,3000);
    });




    jQuery('.pull-right.btn.btn-default.btn-lg').click(function(){
        yaCounter25448447.reachGoal('zakazat');
        ga('send', 'pageview', '/oformlenie_zakaza');
        console.log('Для кнопки "Отправить заказ" на странице https://www.diada-arms.ru/personal/order/');
    });


    jQuery('.red_button[value="Заказать звонок"]').click(function(){
        yaCounter25448447.reachGoal('pozvonit');
        ga('send', 'pageview', '/zvonok');
        console.log('На отправку формы обратного звонка');
    });

//23.03.19

    jQuery('a.new_det_gray_bt.blue_h.fancy_ajax_click_buy').click(function(){
        yaCounter25448447.reachGoal('clickcredit');
        ga('send', 'pageview', '/virtual/clickcredit');
        console.log('Клик по кнопке "В кредит"');

        setTimeout(`jQuery('#ask_a_question .one_click_form_el input.red_button').click(function(){
        yaCounter25448447.reachGoal('sendcredit');
        ga('send', 'pageview', '/virtual/sendcredit');
        console.log('Успешная отправка формы "В кредит"');});`,3000);
    });


    jQuery('a.detail_red_button.fancy_ajax').click(function(){
        yaCounter25448447.reachGoal('clickreviewcard');
        ga('send', 'pageview', '/virtual/clickreviewcard');
        console.log('Клик по кнопке "Оставить отзыв"');

        setTimeout(`jQuery('form[name="iblock_add"] .new_call_back_light_right_button input.red_button').click(function(){
        yaCounter25448447.reachGoal('sendreviewcard');
        ga('send', 'pageview', '/virtual/sendreviewcard');
        console.log('Успешная отправка формы "Оставить отзыв"');});`,3000);
    });


    jQuery('a.red_button.fancybox[href="#js_add_text_comment"]').click(function(){
        yaCounter25448447.reachGoal('clickreview');
        ga('send', 'pageview', '/virtual/clickreview');
        console.log('Клик по кнопке "Оставить отзыв" (любой)');
    });
    jQuery('div.add_text_comment div form[name="iblock_add"] input.red_button').click(function(){
        yaCounter25448447.reachGoal('sendreviewcard');
        ga('send', 'pageview', '/virtual/sendreviewcard');
        console.log('Успешная отправка формы "Оставить отзыв" (любой)');
    });

});