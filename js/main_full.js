$(document).on("click",".showuserconset", function () {
    $.fancybox({
        href: "/doc/personal_information.php?AJAX=yes",
        type: "ajax",
        maxWidth: 800,
        padding: 30
    })
})
//полная версия сайта в адаптиве
/* $(document).ready(function () {
    $(".js_foot_versiya_site").click(function(){
        console.log("1");var VersiyaSite;
        if($(this).hasClass("active")){
            $(this).removeClass("active").text("Полная версия сайта").parents("body").removeClass("width_1200");
        } else {
            $(this).addClass("active").text("Мобильная версия сайта").parents("body").addClass("width_1200");
        };
        return false;
    });
}); */
$(document).ready(function () {
    
    $('body').on('click', '.det_size_select .det_size_sel_bt', function()
    {
        $(this).parents('.det_size_select').find('.det_size_sel_list').toggleClass('open');
        return false;
    });
    
    if($('.product_reting').length)
    {
        var productsIds = new Array();
        $('.product_reting').each(function()
        {
            productsIds[productsIds.length] = $(this).data('rating-product');
        });
        
        if(productsIds.length > 0)
        {
            BX.ajax({   
                url: '/include/rating.php',
                data: {action: 'getRating', products: productsIds},
                method: 'POST',
                dataType: 'json',
                timeout: 30,
                cache: false,
                onsuccess: function(data)
                {
                    $.each(data.items, function(index, val)
                    {
                        if($('.set_reting_product_'+index).length)
                        {
                            $('.set_reting_product_'+index+' .new_reiting_cont').animate({width: val.RATING_PERCENT+'%'}, 800);
                        }
                    });  
                }
            });    
        }    
    }    
    
    $.validator.addMethod("lettersonly", function(value, element) 
    { 
        return this.optional(element) || /^[а-яА-Яa-zA-Z\s]*$/.test(value);
    },"Пожалуйста, введите только буквы");
    
    $('form#register-fiz').validate({
        submitHandler: function (form) {
            $(form).parents('.reg_form_white_width').prepend('<div class="center_loader_mask"><div class="img-loader" style="top: 45%;"></div></div>');
            BX.ajax({   
                url: location.pathname,
                data: $(form).serialize(),
                method: 'POST',
                timeout: 30,
                cache: false,
                onsuccess: function(data)
                {
                    if($(data).find('.reg_form_white_width .success-register').length)
                    {
                        location.href = '/lk/';
                    }
                    else
                    {
                        $(form).parent().html($(data).find('#register-fiz').parent().html());
                        $("[name='REGISTER[PERSONAL_PHONE]']").mask("+7 (999) 999-99-99");
                    }
                    
                }
            });
        },
        rules: {
            'REGISTER[NAME]': {
                required: true,
                lettersonly: true
            },
            'REGISTER[LOGIN]': {
                required: true,
                email: true,
                remote: {
                    url: "/include/check_email.php",
                    type: "post",
                    dataType: 'json',
                    beforeSend: function() 
                    {
                        $('#register-fiz input[name="REGISTER[LOGIN]"]').parent().css('position', 'relative');
                        $('#register-fiz input[name="REGISTER[LOGIN]"]').parent().prepend('<div class="center_loader_mask"><div class="img-loader"></div></div>');
                    },
                    dataFilter: function(response) 
                    {
                        $('#register-fiz input[name="REGISTER[LOGIN]"]').parent().find('.center_loader_mask').remove();
                        var data = JSON.parse(response);
                        if (data.success == "Y") 
                        {
                            return 'true';
                        }
                        else
                        {
                            return "\"" + data.message + "\""; 
                        } 
                    }
                }
            },
            'REGISTER[PASSWORD]': {
                required: true,
                minlength: 6
            },
            'REGISTER[CONFIRM_PASSWORD]': {
                required: true,
                minlength: 6,
                equalTo: "#password"
            }
        },
        messages: {
            'REGISTER[NAME]': {
                required: "Поле \"Имя\" обязательно для заполнения"
            },
            'REGISTER[LOGIN]': {
                required: "Поле \"e-mail\" обязательно для заполнения"
                //remote: "Введенный вами e-mail зарегистрирован, не существует или не верный",
            },
            'REGISTER[PASSWORD]': {
                required: "Пожалуйста введите пароль",
                minlength: "Пароль должен быть не менее 6 знаков, включая символы"
            },
            'REGISTER[CONFIRM_PASSWORD]': {
                required: "Пожалуйста введите пароль",
                minlength: "Пароль должен быть не менее 6 знаков, включая символы",
                equalTo: "Пожалуйста, введите тот же пароль, что и выше"
            }
        }
    });
    $('form#register-yur').validate({
        submitHandler: function (form) {
            $(form).parents('.reg_form_white_width').prepend('<div class="center_loader_mask"><div class="img-loader" style="top: 45%;"></div></div>');
            BX.ajax({   
                url: location.pathname,
                data: $(form).serialize(),
                method: 'POST',
                timeout: 30,
                cache: false,
                onsuccess: function(data)
                {
                    if($(data).find('.reg_form_white_width .success-register').length)
                    {
                        location.href = '/lk/';
                    }
                    else
                    {
                        $(form).parent().html($(data).find('#register-yur').parent().html());
                        $("[name='REGISTER[PERSONAL_PHONE]']").mask("+7 (999) 999-99-99");
                    }
                }
            });
        },
        rules: {
            'UF_NAME': {
                required: true,
            },
            'UF_YUR_ADDRESS': "required",
            'UF_BANK': "required",
            'UF_SCHET': {
                required: true,
                number: true,
                rangelength: [20, 20]
            },
            'UF_KORSCHET': {
                required: true,
                number: true,
                rangelength: [20, 20]
            },
            'UF_INN': {
                required: true,
                number: true,
                rangelength: [10, 12]
            },
            'UF_KPP': {
                required: true,
                number: true,
                rangelength: [9, 9]
            },
            'UF_BIK': {
                required: true,
                number: true,
                rangelength: [9, 9]
            },
            'REGISTER[LOGIN]': {
                required: true,
                email: true,
                remote: {
                    url: "/include/check_email.php",
                    type: "post",
                    dataType: 'json',
                    beforeSend: function() 
                    {
                        $('#register-yur input[name="REGISTER[LOGIN]"]').parent().css('position', 'relative');
                        $('#register-yur input[name="REGISTER[LOGIN]"]').parent().prepend('<div class="center_loader_mask"><div class="img-loader"></div></div>');
                    },
                    dataFilter: function(response) 
                    {
                        $('#register-yur input[name="REGISTER[LOGIN]"]').parent().find('.center_loader_mask').remove();
                        var data = JSON.parse(response);
                        if (data.success == "Y") 
                        {
                            return 'true';
                        }
                        else
                        {
                            return "\"" + data.message + "\""; 
                        } 
                    }
                }
            },
            'REGISTER[PASSWORD]': {
                required: true,
                minlength: 6
            },
            'REGISTER[CONFIRM_PASSWORD]': {
                required: true,
                minlength: 6,
                equalTo: "#pass"
            }
        },
        messages: {
            'UF_NAME': {
                required: "Поле обязательно для заполнения"
            },
            'UF_YUR_ADDRESS': "Поле обязательно для заполнения",
            'UF_BANK': "Поле обязательно для заполнения",
            'UF_SCHET': {
                required : "Поле обязательно для заполнения",
                number : "Поле должно содержать только цифры",
                rangelength : "Поле должно быть длиной в 20 цифр",
            },
            'UF_KORSCHET': {
                required : "Поле обязательно для заполнения",
                number : "Поле должно содержать только цифры",
                rangelength : "Поле должно быть длиной в 20 цифр",
            },
            'UF_INN': {
                required : "Поле обязательно для заполнения",
                number : "Поле должно содержать только цифры",
                rangelength : "Поле должно быть длиной от 10 до 12 цифр",
            },
            'UF_KPP': {
                required : "Поле обязательно для заполнения",
                number : "Поле должно содержать только цифры",
                rangelength : "Поле должно быть длиной в 9 цифр",
            },
            'UF_BIK': {
                required : "Поле обязательно для заполнения",
                number : "Поле должно содержать только цифры",
                rangelength : "Поле должно быть длиной в 9 цифр",
            },
            'REGISTER[LOGIN]': {
                required: "Поле обязательно для заполнения"
            },
            'REGISTER[PASSWORD]': {
                required: "Пожалуйста введите пароль",
                minlength: "Пароль должен быть не менее 6 знаков, включая символы"
            },
            'REGISTER[CONFIRM_PASSWORD]': {
                required: "Пожалуйста введите пароль",
                minlength: "Пароль должен быть не менее 6 знаков, включая символы",
                equalTo: "Пожалуйста, введите тот же пароль, что и выше"
            }
        }
    });

/*
    $("body").on("click", ".detail_page_top_info_sravneneie.small_podskazka_light_block a, .add_sravnenie label",function(){
        var kol = $(".head_white_battle_ic span").html()*1;
        if(kol==0) $(".head_white_battle_ic").addClass("red");
         kol++;
        $(".head_white_battle_ic span").html(kol);
    })
*/
    $(".detail_page_top_info_love a").click(function(){
        var kol = $(".head_white_favorite_ic span").html()*1;
        if(kol==0) $(".head_white_favorite_ic").removeClass("red");
         kol++;
        $(".head_white_favorite_ic span").html(kol);
    });
    $(".js_det_favor_bt ").click(function(){
        $(this).addClass("active");
        var kol = $(".head_white_favorite_ic span").html()*1;
        if(kol==0) $(".head_white_favorite_ic").removeClass("red");
         kol++;
        $(".head_white_favorite_ic span").html(kol);
    });

    var idTimerInterval;
    if ($("#bx-soa-region").length > 0) {
        $("#bx-soa-region .bx-soa-section-title-container").click();
        if ($("#bx-soa-region .bx-ui-sls-clear").click().length == 0) {
            idTimerInterval = setInterval(function () {
                if ($("#bx-soa-region .bx-ui-sls-clear").length > 0) {
                    $("#bx-soa-region .bx-ui-sls-clear").click();
                    clearInterval(idTimerInterval);
                }
            }, 10);
        }
    }
    var idInterval, breackInterval = 0;
    idInterval = setInterval(function () {
        if ($("#bx-panel").length > 0) {
            $(".top_header .basket").css("top", $("#bx-panel").height() + "px");
            clearInterval(idInterval);
        } else {
            breackInterval++;
            if (breackInterval > 500) {
                clearInterval(idInterval);
            }
        }
    }, 10);
    $(".fancybox").fancybox({padding: 0, scrolling: "visible"});
    $(".fancybox_gal").fancybox({openEffect: "none", closeEffect: "none"});
    if ($(window).width() > 999) {
        $(document).on("click", ".fancybox_3d", function () {
            $.ajax({
                url: $(this).attr("href"), dataType: "html", success: function (data) {
                    $.fancybox({
                        content: data,
                        openEffect: "none",
                        closeEffect: "none",
                        width: 980,
                        height: 540,
                        autoSize: false
                    });
                }
            });
            return false;
        });
    }
    if (($(window).width() > 799) && ($(window).width() < 1000)) {
        $(document).on("click", ".fancybox_3d", function () {
            $.ajax({
                url: $(this).attr("href"), dataType: "html", success: function (data) {
                    $.fancybox({
                        content: data,
                        openEffect: "none",
                        closeEffect: "none",
                        width: 780,
                        height: 398,
                        autoSize: false
                    });
                }
            });
            return false;
        });
    }
    if (($(window).width() > 649) && ($(window).width() < 800)) {
        $(document).on("click", ".fancybox_3d", function () {
            $.ajax({
                url: $(this).attr("href"), dataType: "html", success: function (data) {
                    $.fancybox({
                        content: data,
                        openEffect: "none",
                        closeEffect: "none",
                        width: 640,
                        height: 327,
                        autoSize: false
                    });
                }
            });
            return false;
        });
    }
    if (($(window).width() > 499) && ($(window).width() < 650)) {
        $(document).on("click", ".fancybox_3d", function () {
            $.ajax({
                url: $(this).attr("href"), dataType: "html", success: function (data) {
                    $.fancybox({
                        content: data,
                        openEffect: "none",
                        closeEffect: "none",
                        width: 480,
                        height: 245,
                        autoSize: false
                    });
                }
            });
            return false;
        });
    }
    if (($(window).width() > 399) && ($(window).width() < 500)) {
        $(document).on("click", ".fancybox_3d", function () {
            $.ajax({
                url: $(this).attr("href"), dataType: "html", success: function (data) {
                    $.fancybox({
                        content: data,
                        openEffect: "none",
                        closeEffect: "none",
                        width: 400,
                        height: 189,
                        autoSize: false
                    });
                }
            });
            return false;
        });
    }
    if (($(window).width() < 400)) {
        $(document).on("click", ".fancybox_3d", function () {
            $.ajax({
                url: $(this).attr("href"), dataType: "html", success: function (data) {
                    $.fancybox({
                        content: data,
                        openEffect: "none",
                        closeEffect: "none",
                        width: 250,
                        height: 112,
                        autoSize: false
                    });
                }
            });
            return false;
        });
    }
    $(document).on("click", ".open_img_fancybox", function () {
        $src = $(this).attr("src");
        console.log($src);
        $.fancybox({href: $src,});
    });
    $("body").on("click", ".js_mobile_text_el_button", function () {
        $(this).toggleClass("active_mobile_text_el_button").siblings(".js_mobile_text_el_light").slideToggle().toggleClass("active");
        return false;
    });
    $("body").on("click", "ul.tabs li:not(.current)", function () {
        $(this).addClass("current").siblings().removeClass("current").parents("div.section").find("div.box").eq($(this).index()).fadeIn(150).siblings("div.box").hide();
    });
    $(document).on("change", "div.tabs .jq-radio", function () {
        $_this = $(this).parent("label");
        $($_this).addClass("current").siblings().removeClass("current").parents("div.section").find("div.box").eq($($_this).index()).fadeIn(150).siblings("div.box").hide();
        console.log($($_this));
    });
    $("body").on("click", "ul.js_detail_tabs_adres li:not(.current)", function () {
        $(this).addClass("current").siblings().removeClass("current").parents("div.js_detail_section_adres").find("div.js_detail_box_adres").eq($(this).index()).fadeIn(150).siblings("div.js_detail_box_adres").hide();
    });
    $("body").on("click", "ul.js_detail_double_tabs li:not(.current)", function () {
        $(this).addClass("current").siblings().removeClass("current").parents("div.js_detail_double_section").find("div.js_detail_double_box").eq($(this).index()).fadeIn(150).siblings("div.js_detail_double_box").hide();
    });
    $("body").on("click",".js_filter_bottom_light",function () {
        $(this).toggleClass("active_filter_bottom_light").siblings(".js_filter_light").slideToggle();
        return false;
    });
    if (location.href.indexOf("/personal/order/") < 0) {
        $("input:checkbox , input:radio, .add_text_comment select, .reg_form_el select").styler();
    }
    $("body").on("click", ".js_number_next",function () {
        var numberNext = $(this).siblings("input").attr("value");
        numberNext++;
        $(this).siblings("input").val(numberNext++);
        return false;
    });
    $("body").on("click", ".js_number_prev",function () {
        var numberPrev = $(this).siblings("input").attr("value");
        numberPrev--;
        if (numberPrev <= 1) {
            numberPrev = 1;
        }
        $(this).siblings("input").val(numberPrev);
        return false;
    });
    $(document).on("keypress", ".gotelephone", function (e) {
        if (e.charCode < 48 || e.charCode > 57) {
            return false;
        }
    });
    $(document).on("keyup", ".gotelephone", function (e) {
        if ($(this).val().length >= $(this).attr("maxlength")) {
            $num = parseInt($(this).attr("name").replace("phone", ""));
            $next = $num + 1;
            $(".gotelephone[name='phone" + $next + "']").focus();
        }
    });
    $(".index_slider").bxSlider({
        mode: "fade", 
        auto: true, 
        autoControls: true, 
        pause: 2000, 
        autoHover: true,
        touchEnabled:false,
        onSlideBefore: function($slideElement, oldIndex, newIndex){
            if($(".index_slider li").eq(newIndex).find('img').attr('data-src') != undefined){
                $(".index_slider li").eq(newIndex).find('img').lazyLoadXT({show:true});    
            }
        },
 
    });
         
    if ($(window).width() >= 1200) {
        $(".carousel_slider_brend").bxSlider({
            mode: "vertical",
            slideWidth: 280,
            minSlides: 4,
            moveSlides: 1,
            pager: false,
            infiniteLoop: false,
            slideMargin: 40,
            touchEnabled:false,
        });
        $(".detail_right_produce_slider").bxSlider({
            mode: "vertical",
            slideWidth: 240,
            minSlides: 5,
            moveSlides: 1,
            pager: false,
            infiniteLoop: false,
            slideMargin: 0,
            touchEnabled:false,
        });
    }
    if ($(window).width() < 1199) {
        $(".carousel_slider_brend").bxSlider({
            slideWidth: 220,
            minSlides: 2,
            maxSlides: 4,
            moveSlides: 1,
            pager: false,
            infiniteLoop: false,
            slideMargin: 10,
            touchEnabled:false,
        });
        $(".detail_right_produce_slider").bxSlider({
            slideWidth: 230,
            minSlides: 2,
            maxSlides: 5,
            moveSlides: 1,
            pager: false,
            infiniteLoop: false,
            slideMargin: 5,
            touchEnabled:false,
        });
    }
    $(".razdel_slider").bxSlider({
        slideWidth: 180,
        minSlides: 1,
        maxSlides: 8,
        moveSlides: 1,
        slideMargin: 2,
        pager: false,
        infiniteLoop: false,
        touchEnabled:false,
    });
    if ($(window).width() > 500) {
        $(".detail_similar_items_slider").bxSlider({
            /* slideWidth: 215, */
            slideWidth: 280,
            minSlides: 2,
            /* slideHeight: 290, */
            maxSlides: 3,
            moveSlides: 1,
            pager: false,
            infiniteLoop: false,
            slideMargin: 5,
            shrinkItems:true,
            touchEnabled:false
        });
    } else {
        $(".detail_similar_items_slider").bxSlider({
            slideWidth: 500,
            minSlides: 1,
            /* slideHeight: 290, */
            maxSlides: 1,
            moveSlides: 1,
            pager: false,
            infiniteLoop: false,
            slideMargin: 5,
            shrinkItems:true,
            touchEnabled:false
        });
    }; 
    $("body").on("click", ".js_section_other_el_button",function () {
        $(this).siblings(".js_section_other_el_menu").slideToggle();
        return false;
    });
    $("body").on("click", ".js_index_more_text_button",function () {
        if ($(this).hasClass("show_block")) {
            $(this).removeClass("show_block").addClass("hide_block");
        } else {
            $(this).removeClass("hide_block").addClass("show_block");
        }
        $(this).siblings(".js_index_more_text").slideToggle();
        return false;
    });
    $(document).on("click",".js_detail_top_accessory_button",function () {
        $(this).toggleClass("detail_top_accessory_button_active").siblings(".js_detail_top_accessory_light").slideToggle("slow", function() {
            if ($(this).css("display") == "none" && window.innerWidth<=800) {
                $(this).css("display", "").removeClass("display_none_m");
                $(this).css("display", "").removeClass("display_none_mp");
            }
        });
        return false;
    });
    var timerSectorOne;
    if ($(window).width() < 1199) {
        $("body").on("click", ".js_filter_button_block",function () {
            if ($("body").hasClass("body_filter_block_open")) {
                clearInterval(timerSectorOne);
                $(this).parents("body").removeClass("body_filter_block_open").find(".js_filter_block").removeClass("filter_block_menu_open").parents("body").removeClass("body_mobile_menu_open").find(".js_catalog_mobile_menu_light").removeClass("catalog_mobile_menu_open");
            } else {
                timerSectorOne = setInterval(function(){
                    if ($(".js_filter_block .top_row").position().top < -70 && !$(".js_filter_block .filter_fixed_button").hasClass("active") && !($(".js_filter_block .top_row").height()+$(".js_filter_block .name_filter").height()+$(".js_filter_block .bx-filter").height()-$(".js_filter_block").height() < (50-$(".js_filter_block .top_row").position().top))){
                        $(".js_filter_block .filter_fixed_button").addClass("active");
                        console.log($(".js_filter_block .bx-filter").height());
                    }
                    else if(($(".js_filter_block .top_row").position().top > -70 && $(".js_filter_block .filter_fixed_button").hasClass("active"))
                            ||
                            ($(".js_filter_block .top_row").height()+$(".js_filter_block .name_filter").height()+$(".js_filter_block .bx-filter").height()-$(".js_filter_block").height() < (0-$(".js_filter_block .top_row").position().top))
                    ){
                        $(".js_filter_block .filter_fixed_button").removeClass("active");
                        console.log($(".js_filter_block .bx-filter").height());
                    }
                },10);
                $(this).parents("body").addClass("body_filter_block_open").find(".js_filter_block").addClass("filter_block_menu_open").parents("body").removeClass("body_mobile_menu_open").find(".js_catalog_mobile_menu_light").removeClass("catalog_mobile_menu_open");
            }
            return false;
        });
    };
    $("body").on("click", ".js_catalog_menu_mobile_button",function () {
        if ($("body").hasClass("body_mobile_menu_open")) {
            $(this).parents("body").removeClass("body_mobile_menu_open").removeClass("body_filter_block_open").find(".js_catalog_mobile_menu_light").removeClass("catalog_mobile_menu_open").parents("body").find(".js_filter_block").removeClass("filter_block_menu_open");
        } else {
            if ($("body").hasClass("body_filter_block_open")) {
                $(this).parents("body").removeClass("body_filter_block_open").find(".js_filter_block").removeClass("filter_block_menu_open").parents("body").removeClass("body_mobile_menu_open").find(".js_catalog_mobile_menu_light").removeClass("catalog_mobile_menu_open");
            } else {
                $(this).parents("body").addClass("body_mobile_menu_open").removeClass("body_filter_block_open").find(".js_catalog_mobile_menu_light").addClass("catalog_mobile_menu_open").parents("body").find(".js_filter_block").removeClass("filter_block_menu_open");
            }
        }
        return false;
    });
    $("body").on("click", ".js_menu_lvl1_button", function () {
        $(this).siblings(".js_menu_lvl2").addClass("open_menu_lvl2");
        return false;
    });
    $("body").on("click",".js_menu_lvl2_button",function () {
        $(this).siblings(".js_menu_lvl3").addClass("open_menu_lvl2");
        return false;
    });
    $("body").on("click", ".js_mobile_catalog_menu_come_back a", function () {
        $(this).parents(".js_menu_lvl2").removeClass("open_menu_lvl2");
        return false;
    });
    $("body").on("click", ".js_mobile_catalog_menu_come_back2 a", function () {
        $(this).parents(".js_menu_lvl2").removeClass("open_menu_lvl2");
        return false;
    });
    $("body").on("click", ".js_mobile_catalog_menu_come_back3 a", function () {
        $(this).parents(".js_menu_lvl3").removeClass("open_menu_lvl2");
        return false;
    });
    $(".js_red_search_form").mouseover(function () {
        $(this).addClass("active_red_search_form");
    });
    $(".js_red_search_form").mouseout(function () {
        $(this).removeClass("active_red_search_form");
    });

    $('body').on('click', '#dostavka_region_block .cont_city_select_bt', function()
    {
        $(this).parent().find('.cont_city_select_list').toggleClass('active');
        
        return false;   
    });

    $("body").on("click", ".js_dostavka_region_title", function () {
        /*   $(this).parents(".js_dostavka_region_title_block").find(".js_dostavka_region_title_list_light").slideToggle(); */
        if($(this).hasClass("active"))
        {
            $(this).removeClass("active").parents(".js_dostavka_region_title_block").find(".js_dostavka_region_title_list_light").slideUp();
        }
        else
        {
            $(this).addClass("active").parents(".js_dostavka_region_title_block").find(".js_dostavka_region_title_list_light").slideDown();
        };
        return false;
    });
    $(document).click(function() {
        $('.js_dostavka_region_title_list_light').slideUp();
        $("#dostavka_region_block .js_dostavka_region_title.active").removeClass("active");
    });
    $("body").on("click", ".red_buy, .buy_element_button, .newcat_buy", function () 
    {
        var elem = $(this);
        if (elem.hasClass("in_basket_button") || elem.hasClass("big-data")) 
        {
            return true;
        }
        var strID = $(this).data("id");
        var strQuantity = 1;
        
        var set = $(this).data("set");
        var path = "/include/script_add_to_cart.php";
        var setPath = "/include/script_add_set_to_cart.php";
        
        if(set){
            path = setPath;
            set = set-1;
            set = '&set='+set;
        }
        
        if ($(this).attr("class") == "buy_element_button") {
            strQuantity = $(this).parents(".parent_block").find("input.number").val();
        }
        else if($(this).parents('.newcat_el').find('.det_status_kol_bl .det_status_kol_r input.number').length)
        {
            strQuantity = $(this).parents('.newcat_el').find('.det_status_kol_bl .det_status_kol_r input.number').val();    
        }
        else if($(this).parents('.index_produce').find('.det_status_kol_bl .det_status_kol_r input.number').length)
        {
            strQuantity = $(this).parents('.index_produce').find('.det_status_kol_bl .det_status_kol_r input.number').val();    
        }
        else if($(this).parents('.big_data_el_bl').find('.det_status_kol_bl .det_status_kol_r input.number').length)
        {
            strQuantity = $(this).parents('.big_data_el_bl').find('.det_status_kol_bl .det_status_kol_r input.number').val();    
        }
        $.get(path+"?id=" + strID + "&quantity=" + strQuantity+set, function (data) 
        {       
//Для старой шапки
//            $(".top_header .basket").load("/include/script_cart_update.php");
//Для новой шапки
            $(".loadhead").load("/include/script_cart_update.php");
            
            $.get("/include/script_cart_update_mobile.php", function (data) 
            {
                $(".mobile_header_top_basket_kol").text($(".mobile_header_top_basket_kol",data).text());
                console.log($(".mobile_header_top_basket_kol",data).text());
            });
            $(elem).addClass("in_basket_button").text("В корзину").attr("href", "/personal/cart/");
        });
        return false;
    });
    $("body").on("click", ".red_buy_detail", function () {
        var elem = $(this);
        if (elem.hasClass("in_basket_button")) {
            return true;
        }
        var strQuantity = $(this).parents("ul").find("input.number").val();
        var strID = $(this).data("id");
        var set = $("input[name=detail_complect_radio]:checked").val();
        $.get("/include/script_add_set_to_cart.php?id=" + strID + "&quantity=" + strQuantity + "&set=" + set, function (data) {
            $(".loadhead").load("/include/script_cart_update.php");
            $.get("/include/script_cart_update_mobile.php", function (data) 
            {
                $(".mobile_header_top_basket_kol").text($(".mobile_header_top_basket_kol",data).text());
            });
            $(elem).addClass("in_basket_button").text("Перейти в корзину").attr("href", "/personal/cart/");
        });
        return false;
    });
    $("body").on("click", ".new_det_buy_bt", function () {
        var elem = $(this);
        if (elem.hasClass("in_basket_button")) {
            return true;
        }
        var strQuantity = $(this).parents(".new_det_buy_bl").siblings(".det_status_kol_bl").find("input.number").val();
        var strID = $(this).data("id");
        var set = $("input[name=detail_complect_radio]:checked").val();
        $.get("/include/script_add_set_to_cart.php?id=" + strID + "&quantity=" + strQuantity + "&set=" + set, function (data) {
            $(".loadhead").load("/include/script_cart_update.php");
            $.get("/include/script_cart_update_mobile.php", function (data) 
            {
                $(".mobile_header_top_basket_kol").text($(".mobile_header_top_basket_kol",data).text());
            });
            $(elem).addClass("in_basket_button").attr("href", "/personal/cart/").text("Перейти в корзину");
        });
        return false;
    });
    $("body").on("change", ".add_sravnenie input", function () {
        $.get($(this).data("url"), function (data) {
            $.fancybox({type: "ajax", href: "/include/popup_compare_success.php"});
            var kol = $(".head_white_battle_ic span").html()*1;
            if(kol==0) $(".head_white_battle_ic").removeClass("red");
             kol++;
            $(".head_white_battle_ic span").html(kol);
        });
    });
    $("body").on("click", ".detail_page_top_info_sravneneie a", function () {
        $.get($(this).attr("href"), function (data) {
            $.fancybox({type: "ajax", href: "/include/popup_compare_success.php"});
            var kol = $(".head_white_battle_ic span").html()*1;
            if(kol==0) $(".head_white_battle_ic").removeClass("red");
             kol++;
            $(".head_white_battle_ic span").html(kol);
        });
        return false;
    });
    $("body").on("click", ".js_det_srav_bt", function () {
        var _this = $(this);
        $.get($(this).attr("href"), function (data) {
            $.fancybox({type: "ajax", href: "/include/popup_compare_success.php"});
            var kol = $(".head_white_battle_ic span").html()*1;
            if(kol==0) $(".head_white_battle_ic").removeClass("red");
             kol++;
            $(".head_white_battle_ic span").html(kol);
            _this.addClass("active");
        });
        return false;
    });
    $("body").on("click", ".favor_srav", function () {
        var _this = $(this);
        $.get($(this).attr("href"), function (data) {
            $.fancybox({type: "ajax", href: "/include/popup_compare_success.php"});
            var kol = $(".head_white_battle_ic span").html()*1;
            if(kol==0) $(".head_white_battle_ic").removeClass("red");
             kol++;
            $(".head_white_battle_ic span").html(kol);
            _this.addClass("active");
        });
        return false;
    });
    $("body").on("click", ".favourites_opt_bl .srev_all_del", function ()
    {
        var arrFavour = [];
        $.cookie('favourites', JSON.stringify(arrFavour), {expires: 7, path: '/'});
        $.get(location.pathname+"?action=favouritesDel", function (data)
        {
            $(".favourites_list").html($(data).html());
            $(".head_white_favorite_ic span").html(0);
            $(".head_white_favorite_ic").removeClass("red");
        });
        return false;
    });
    $("body").on("click", ".srev_all_del_bl .srev_all_del", function ()
    {
        $(".head_white_battle_ic").removeClass("red");
        $(".head_white_battle_ic span").html(0);
        return false;
    });
    $("body").on("click", ".srav_del_bt", function ()
    {
        var kol = $(".head_white_battle_ic span").html()*1;
        kol--;
        if(kol==0)
            $(".head_white_battle_ic").removeClass("red");
        $(".head_white_battle_ic span").html(kol);     
    })
    $("body").on("click", ".srav_close", function ()
    {
        if($(this).hasClass('compare'))
        {
            var kol = $(".head_white_battle_ic span").html()*1;
            kol--;
            if(kol==0)
                $(".head_white_battle_ic").removeClass("red");
            $(".head_white_battle_ic span").html(kol);    
        }
        else
        {
            var arrFavour = [];
            var arrNewFavour = [];
            var id = $(this).data("id");
            if ($.cookie('favourites'))
                $.merge(arrFavour, eval($.cookie('favourites')));
            $.each(arrFavour, function(index,val)
            {
                if(id != val)
                {
                    arrNewFavour.push( val );
                }
            });
            
            $.cookie('favourites', JSON.stringify(arrNewFavour), {expires: 7, path: '/'});

            $.get(location.pathname+"?action=favouritesDel", function (data)
            {
                $(".favourites_list").html($(data).html());
                var kol = $(".head_white_favorite_ic span").html()*1;
                if(kol==0)
                    $(".head_white_favorite_ic").removeClass("red");
                 kol--;
                $(".head_white_favorite_ic span").html(kol);
            });
            return false;    
        }
        
    });
    $("body").on("click", '.srav_favor', function()
    {
        var kol = $(".head_white_favorite_ic span").html()*1;
        var arrFavour = [];
        if ($.cookie('favourites'))
            $.merge(arrFavour, eval($.cookie('favourites')));

        arrFavour.push( $(this).data("id") );
        $.cookie('favourites', JSON.stringify(arrFavour), {expires: 7, path: '/'});

        $.fancybox({
            'type':'ajax',
            href:'/include/popup_favourites_success.php'
        });

        if(kol==0)
            $(".head_white_favorite_ic").removeClass("red");
        kol++;
        $(this).addClass("active");
        $(".head_white_favorite_ic span").html(kol);

        return false;
    });
    var favorites = eval($.cookie('favourites'));
    if(favorites != null && favorites != "" && favorites != undefined)
    {
        $.each(favorites,function(index, val)
        {
            if($(".srav_favor.item-"+val).length)
            {
                $(".srav_favor.item-"+val).addClass("active");
            }
        });
    }

    $.ajax({
        url: "/include/getcompare.php",
        data:{action:"getCompare"},
        type: "post",
        dataType: "json",
        success: function (data)
        {
            var compareItems = eval(data.items);
            if(compareItems.length)
            {
                $.each(compareItems,function(index, val)
                {
                    if($(".favor_srav.item-"+val).length)
                    {
                        $(".favor_srav.item-"+val).addClass("active");
                    }
                });
            }
        }
    });


    if($("a.fancy_ajax").length)
    {    
        $("a.fancy_ajax").fancybox({'type': 'ajax', 'href': $(this).attr('href'), 'padding': 0, 'scrolling': 'visible', minWidth: 300, autoSize: true,afterShow: function(instance, current)
        {     
            setTimeout(function() { 
                $('.fancybox-inner').css({height:'auto', width: 'auto'});
            });
        }});
    }
    /*$("body").on("click",".fancy_ajax",function () {
        $.get($(this).attr("href"), function (data) {
            $.fancybox({content: data, padding: 0, scrolling: "visible", minWidth: 300});
        });
        return false;
    });*/
    $("body").on("click",".fancy_ajax_cheaper",function () {
        $("a.fancy_ajax_cheaper").fancybox({'type': 'ajax', 'href': $(this).attr('href'), 'padding': 0, 'scrolling': 'visible', minWidth: 300, autoSize: true});
        $('.fancybox-inner').css({height:'auto', width: 'auto'});
        return false;
    });
    $("body").on("click",".fancy_ajax_click_buy",function () {
        $.get($(this).attr("href")+"&type="+$("label.detail_complect_el.active").data("type"), function (data) {
            $.fancybox({content: data,padding: 0, scrolling: "visible"});
        });
        return false;
    });
    $("body").on("click",".fancy_ajax_click_buy_busket",function () {
        $.get($(this).attr("href"), function (data) { 
            $.fancybox({content: data,padding: 0, scrolling: "visible"});
        });
        return false;
    });
    $("body").on("click", ".fancy_ajax_video",function () {
        $link = $(this).attr("href");
        $.fancybox({href: $link, type: "iframe", padding: -2, margin: 0, closeBtn: false});
        return false;
    });
    $("body").on("click", ".js_type_comment",function () {
        $(this).siblings(".js_type_comment_light").slideToggle();
        return false;
    });
    $("body").on("click",".mobile_header_geo",function () {
        $(".header_geo_light").slideToggle();
        return false;
    });
    $('body').on("click", '.mobile_header_geo_block .geo_gray_button:contains("Да")', function () {
        selectCity(false);
        $(".header_geo_light").slideUp();
        return false;
    });
    $('body').on("click", '#geo_popup1 .geo_gray_button:contains("Да")', function () {
        selectCity(false);
        $.fancybox.close();
        return false;
    });
    if ($("#basket_form_container").length > 0) {
        tableTop = $("#basket_form_container").offset().top - 10;
        var fixedButton = $(".js_new_form_lk_gray_bg"), pos = fixedButton.offset();
        $(window).scroll(function () {
            if ($(this).scrollTop() > tableTop && fixedButton.hasClass("default")) {
                fixedButton.removeClass("default").addClass("active").fadeIn("fast");
            } else {
                if ($(this).scrollTop() <= tableTop && fixedButton.hasClass("active")) {
                    fixedButton.removeClass("active").addClass("default").fadeIn("fast");
                }
            }
        });
    };
    $("body").on("click", '.dostavka_region_title_block ul a:not(".not_js"), #dostavka_region_block .cont_city_select_list a', function () {
        var location_id = $(this).data("id");
        var element_id = $(this).data("element");
        var _this = this;
        $(this).parents(".js_dostavka_region_title_block").find(".dostavka_region_title").html($(this).html());
        $.get("/include/script_detail_delivery.php?location_id=" + location_id + "&element_id=" + element_id, function (data) {
            $(".js_dostavka_region_title_list_light").slideToggle();
            $(".detail_delivery").html(data);
            $("#dostavka_region_block .js_dostavka_region_title.active").removeClass("active");
            if($(_this).parents('.cont_city_select_list').length)
            {
                $("#dostavka_region_block .cont_city_select_list.active").removeClass("active");
                $(_this).parents('.cont_city_select').find('.cont_city_select_bt b').html($(_this).text());    
            }
            
        });
        return false;
    });
    $("body").on("keyup", "form[name=regform] input.password, form[name=form1] input.password", function () {
        var txt = checkPassword($(this).val(), $(this).parents("form").find(".reg_form_test_password_block"));
    });
    $("body").on("keyup", "input[name*=LOGIN]", function () {
        $(this).next().val($(this).val());
    });
    $("body").on("change", ".reg_form_prava_block input:checkbox", function () {
        var check = $(this).attr("checked") == "checked";
        var subm = $(this).parents("form").find("input[name=register_submit_button]");
        if (check) {
            subm.removeClass("disabled").attr("disabled", false);
        } else {
            subm.addClass("disabled").attr("disabled", "disabled");
        }
    });

    //Дополнительные фотографии товара в детальной

    $(".detail_photo_produce").bxSlider({
        slideWidth: 70,
        minSlides: 2,
        maxSlides: 3,
        moveSlides: 1,
        pager: false,/*
        infiniteLoop: false, */
        slideMargin: 15,
        shrinkItems:true,
        touchEnabled:false,
    });


    // фиксированная кнопка в фильтре

    /* if ($(window).width() < 1000) {
        if ($("#js_filter_button_bottom").length > 0) {
            tableTop = $("#js_filter_button_top").offset().top - 10;
            tableBottom = $("#js_filter_button_bottom").offset().top - 10;
            var fixedButton = $(".js_filter_button"), pos = fixedButton.offset();
            $(window).scroll(function () {
                if (($(this).scrollTop() > tableTop) && ($(this).scrollTop() < tableBottom) && (fixedButton.hasClass("default"))) { console.log("1");
                    fixedButton.removeClass("default").addClass("active").fadeIn("fast");
                } else { console.log("2");
                    if (($(this).scrollTop() <= tableTop) && ($(this).scrollTop() >= tableBottom) && fixedButton.hasClass("active")) { console.log("3");
                        fixedButton.removeClass("active").addClass("default").fadeIn("fast");
                    }
                };
            });
        };
    }; */

    //поиск для адаптивной шапки
    $("body").on("click", ".js_mobile_header_top_search",function(){
        $(this).addClass("active").parents(".js_mobile_header_top_info").siblings(".js_mobile_search_bl").slideDown(1);
        return false;
    });
    $("body").on("click", ".js_close_mob_search",function(){
        $(this).parents(".js_mobile_search_bl").slideUp(1).siblings(".js_mobile_header_top_info").find(".js_mobile_header_top_search").removeClass("active");
        return false;
    });

    //стилизация для личного кабинета
    /* $(".show_confirmation_el .reg_form_el input:radio, .show_confirmation_el .reg_form_el input:checkbox").styler(); */


    //скрипт для 404
    /* $(".js_error_page_red_bt").click(function(){
        $(this).slideUp(1).siblings(".js_error_page_help_txt").slideDown(1).parents(".js_error_page_help_bl").siblings(".js_error_page_nothelp_bl").find(".js_error_page_gray_bt").slideUp(1).siblings(".js_error_page_nothelp_txt").slideUp(1);
        return false;
    });
    $(".js_error_page_gray_bt").click(function(){
        $(this).slideUp(1).siblings(".js_error_page_nothelp_txt").slideDown(1).parents(".js_error_page_nothelp_bl").siblings(".js_error_page_help_bl").find(".js_error_page_red_bt").slideUp(1).siblings(".js_error_page_help_txt").slideUp(1);
        return false;
    }); */

    $("body").on("click", ".js_error_page_gray_bt",function(){
        console.log("1");
        $(this).slideUp(1).parents(".js_error_page_nothelp_bl").siblings(".js_error_page_help_bl").find(".js_error_page_red_bt").slideUp(1);
        console.log("4");
    });
    $("body").on("click", ".js_error_page_red_bt",function(){
        console.log("2");
        $(this).slideUp(1).parents(".js_error_page_help_bl").siblings(".js_error_page_nothelp_bl").find(".js_error_page_gray_bt").slideUp(1);
        console.log("3");
    });
    
    $("body").on("keyup", '.new_call_back_light_form input[name="form_text_5"]',function()
    {
        clearTimeout(window.timeout);
        window.timeout = setTimeout(checkPhone, 1500, this, true);
        $(this).removeClass("sal_error");
        checkPhone(this);
    });
    
    $("body").on("keyup", '.required',function()
    {
        clearTimeout(window.timeout);
        window.timeout = setTimeout(checkForm, 1500, this, true);
        $(this).removeClass("sal_error");
        checkForm(this);
    });
    $("body").on("blur", '.required',function()
    {    
        checkForm(this, true);
    });
    $("body").on("blur", '.new_call_back_light_form input[name="form_text_5"]',function()
    {    
        checkPhone(this, true);
    });
    
});
$(function () {
    $(window).scroll(function () {
        if (document.body.scrollHeight>$(window).innerHeight() && $(this).scrollTop()+($(window).innerHeight()/2) > document.body.scrollHeight/2) {
            $("#back_top").fadeIn();
        } else {
            $("#back_top").fadeOut();
        }
    });
    $("body").on("click", "#back_top", function () {
        $("body,html").animate({scrollTop: 0}, 800);
    });
});

function sort(val)
{
    if(val == "" || val == undefined)
    {
        return false;
    }
    $('#js_mobile_text_el_light').prepend('<div class="center_loader_mask"><div class="img-loader" style="top: 45%;"></div></div>');
    BX.ajax({   
        url: val,
        data: {action:'reviewSort'},
        method: 'POST',
        timeout: 30,
        cache: false,
        onsuccess: function(data)
        {
            BX('js_mobile_text_el_light').innerHTML = $(data).html();
        }
    });
}

function checkForm(_this, add_class)
{   
    if(_this == "" || _this == undefined)
    {
        return false;
    }
    
    var form = document.querySelector('.one_click_popup');
    var fields = form.querySelectorAll('.required');
    var errors = 0;
    
    for (var i = 0; i < fields.length; i++) 
    {
        if(fields[i].name == 'user_phone')
        {
            var num = $(fields[i]).attr("data-num");
            
            if(fields[i].value.replace( /[^0-9]/g, "").length != num)
            {    
                $(form).find('input[type="submit"]').prop("disabled", true);
               
                if(!!add_class)
                {
                    $(fields[i]).addClass("sal_error");    
                }
                errors++;
            }
            else
            {
                if(!!add_class)
                {
                    $(fields[i]).removeClass("sal_error");    
                }
            }
        }
        else if(fields[i].name == 'user_email')
        {
            var pattern = /^([a-z0-9_\.-])+@[a-z0-9-]+\.([a-z]{2,4}\.)?[a-z]{2,4}$/i;
            if (!pattern.test(fields[i].value)) 
            {
                $(form).find('input[type="submit"]').prop("disabled", true);
               
                if(!!add_class)
                {
                    $(fields[i]).addClass("sal_error");    
                }
                errors++;
            }
            else
            {
                if(!!add_class)
                {
                    $(fields[i]).removeClass("sal_error");    
                }
            }    
        }
        
    }
    
    if(errors > 0)
    {
        $(form).find('input[type="submit"]').prop("disabled", true);
    }
    else
    {
        $(form).find('input[type="submit"]').prop("disabled", false);    
    }

    /*if($(_this).val().replace( /[^0-9]/g, "").length != num)
    {    
        $(_this).parents("form").find('input[type="submit"]').prop("disabled", true);
       
        if(!!add_class)
        {
            $(_this).addClass("sal_error");    
        }
    }
    else
    {
        $(_this).removeClass("sal_error");
        $(_this).parents("form").find('input[type="submit"]').prop("disabled", false);
    }*/
}

function checkPhone(_this, add_class)
{    
    if(_this == "" || _this == undefined)
    {
        return false;
    }
    
    var num = $(_this).attr("data-num");

    if($(_this).val().replace( /[^0-9]/g, "").length != num)
    {    
        $(_this).parents("form").find('input[type="submit"]').prop("disabled", true);
       
        if(!!add_class)
        {
            $(_this).addClass("sal_error");    
        }
    }
    else
    {
        $(_this).removeClass("sal_error");
        $(_this).parents("form").find('input[type="submit"]').prop("disabled", false);
    }
}

function maskAktive(node, init, mask_input_class)
{   
    if(init == undefined || init == "")
    {
        init = false;
    }
    
    var listCountries = $.masksSort($.masksLoad("https://www.diada-arms.ru/js/data/phone-codes.json"), ['#'], /[0-9]|#/, "mask");
    var maskOpts = {
        inputmask: {
            definitions: {
                '#': {
                    validator: "[0-9]",
                    cardinality: 1
                }
            },
            showMaskOnHover: false,
            autoUnmask: false,
            clearMaskOnLostFocus: false
        },
        match: /[0-9]/,
        replace: '#',
        listKey: "mask"
    };
 
    var maskChangeWorld = function(maskObj, determined)
    {
        if (determined)
        {
            var hint = maskObj.name_ru;
            if (maskObj.desc_ru && maskObj.desc_ru != "")
            {
                hint += " (" + maskObj.desc_ru + ")";
            }
            
            if($(this).attr("id") == "one_click_user_phone" || $(this).hasClass("inputtext"))
            {
                $(this).attr("data-num", maskObj.mask.replace( /[^0-9#]/g, "" ).length);
                
                if(maskObj.mask.replace( /[^0-9#]/g, "" ).length != $(this).val().replace( /[^0-9_]/g, "" ).length)
                {
                    if($(this).parents("form").prop('name') != 'SIMPLE_FORM_3')
                    {
                        $(this).parents("form").find('input[type="submit"]').prop("disabled", true);    
                    }
                }
                /*else{
                    $(this).parents("form").find('input[type="submit"]').prop("disabled", false);
                } */
            }
        }
        else
        {
            if($(this).attr("id") == "one_click_user_phone" || $(this).hasClass("inputtext"))
            {
                $(this).attr("data-num", maskObj.mask.replace( /[^0-9#]/g, "" ).length);
                if(maskObj.mask.replace( /[^0-9#]/g, "" ).length != $(this).val().replace( /[^0-9_]/g, "" ).length)
                {
                    if($(this).parents("form").prop('name') != 'SIMPLE_FORM_3')
                    {
                        $(this).parents("form").find('input[type="submit"]').prop("disabled", true);
                    }
                }
                /*else{
                    $(this).parents("form").find('input[type="submit"]').prop("disabled", false);
                }*/
            }
            //$("#descr").html("Маска ввода");
        }
    }
 
    if(init)
    {
        if(mask_input_class != undefined && mask_input_class != "")
        {
            $(mask_input_class).inputmask("remove");
            $(mask_input_class).inputmasks($.extend(true, {}, maskOpts, {
                list: listCountries,
                onMaskChange: maskChangeWorld
            }));    
        }
        else if(node != undefined && node != "")
        {
            if(node.hasClass("left"))
            {
                node.addClass("left");
                node.removeClass("right");
                node.parents(".mail_tel_switch").find(".phone").removeClass("active");
                node.parents(".mail_tel_switch").find(".email").addClass("active");
                $('.phone-mask').inputmasks("remove");
                $('.phone-mask').val("");
                //$('.phone-mask').inputmask("#{*}", maskOpts.inputmask);
            }
            else
            {
                node.addClass("right");
                node.removeClass("left");
                node.parents(".mail_tel_switch").find(".email").removeClass("active");
                node.parents(".mail_tel_switch").find(".phone").addClass("active");
                $('.phone-mask').inputmask("remove");
                $('.phone-mask').inputmasks($.extend(true, {}, maskOpts, {
                    list: listCountries,
                    onMaskChange: maskChangeWorld
                }));
            }
        }
    }
    else
    {    
        if(node != undefined && node != "")
        {
            if(node.hasClass("left"))
            {
                node.addClass("right");
                node.removeClass("left");
                node.parents(".mail_tel_switch").find(".email").removeClass("active");
                node.parents(".mail_tel_switch").find(".phone").addClass("active");
                $('.phone-mask').inputmask("remove");
                $('.phone-mask').inputmasks($.extend(true, {}, maskOpts, {
                    list: listCountries,
                    onMaskChange: maskChangeWorld
                }));
            }
            else
            {
                node.addClass("left");
                node.removeClass("right");
                node.parents(".mail_tel_switch").find(".phone").removeClass("active");
                node.parents(".mail_tel_switch").find(".email").addClass("active");
                $('.phone-mask').inputmasks("remove");
                $('.phone-mask').val("");
                //$('.phone-mask').inputmask("#{*}", maskOpts.inputmask);
            }    
        }   
    }
}
function selectCity(cityId) {
    $.ajax({
        url: "/include/script_set_location.php", data: cityId ? "cityId=" + cityId : "", success: function () {
            if (cityId) {
                location.reload();
            }
        }
    });
}
function number_format(number, decimals, dec_point, separator) {
    number = (number + "").replace(/[^0-9+\-Ee.]/g, "");
    var n = !isFinite(+number) ? 0 : +number, prec = !isFinite(+decimals) ? 0 : Math.abs(decimals),
        sep = (typeof separator === "undefined") ? "," : separator,
        dec = (typeof dec_point === "undefined") ? "." : dec_point, s = "", toFixedFix = function (n, prec) {
            var k = Math.pow(10, prec);
            return "" + (Math.round(n * k) / k).toFixed(prec);
        };
    s = (prec ? toFixedFix(n, prec) : "" + Math.round(n)).split(".");
    if (s[0].length > 3) {
        s[0] = s[0].replace(/\B(?=(?:\d{3})+(?!\d))/g, sep);
    }
    if ((s[1] || "").length < prec) {
        s[1] = s[1] || "";
        s[1] += new Array(prec - s[1].length + 1).join("0");
    }
    return s.join(dec);
}
Array.prototype.in_array = function (p_val) {
    for (var i = 0, l = this.length; i < l; i++) {
        if (this[i] == p_val) {
            return true;
        }
    }
    return false;
};
function checkPassword(password, block_status) {
    var s_letters = "qwertyuiopasdfghjklzxcvbnm";
    var b_letters = "QWERTYUIOPLKJHGFDSAZXCVBNM";
    var digits = "0123456789";
    var specials = "!@#$%^&*()_-+=|/.,:;[]{}";
    var is_s = false;
    var is_b = false;
    var is_d = false;
    var is_sp = false;
    for (var i = 0; i < password.length; i++) {
        if (!is_s && s_letters.indexOf(password[i]) != -1) {
            is_s = true;
        } else {
            if (!is_b && b_letters.indexOf(password[i]) != -1) {
                is_b = true;
            } else {
                if (!is_d && digits.indexOf(password[i]) != -1) {
                    is_d = true;
                } else {
                    if (!is_sp && specials.indexOf(password[i]) != -1) {
                        is_sp = true;
                    }
                }
            }
        }
    }
    var rating = 0;
    var text = "";
    if (is_s) {
        rating++;
    }
    if (is_b) {
        rating++;
    }
    if (is_d) {
        rating++;
    }
    if (is_sp) {
        rating++;
    }
    if (password.length < 8 && rating >= 2) {
        text = "Средний";
        status = 2;
    } else {
        if (password.length >= 8 && rating == 2) {
            text = "Средний";
            status = 2;
        } else {
            if (password.length >= 8 && rating == 3) {
                text = "Сложный";
                status = 3;
            } else {
                if (password.length >= 8 && rating == 4) {
                    text = "Безопасный";
                    status = 4;
                } else {
                    text = "Простой";
                    status = 1;
                }
            }
        }
    }
    block_status.find(".reg_form_test_password_name_status li:eq(1)").text(text);
    block_status.find(".reg_form_test_password_color_status").attr("class", "reg_form_test_password_color_status").addClass("password_lvl" + status);
}
/*$("*").swipe({
    swipe: function (event, direction) {
        if (window.innerWidth < 1000) {
            if (direction == "left") {
                if ($(".js_catalog_mobile_menu_light").hasClass("catalog_mobile_menu_open")) {
                    $(".js_catalog_menu_mobile_button").click();
                }
                if ($(".js_filter_block").hasClass("filter_block_menu_open")) {
                    $(".js_filter_button_block").click();
                }
            } else {
                if (direction == "right") {
                    if (!$(".js_catalog_mobile_menu_light").hasClass("catalog_mobile_menu_open")) {
                        $(".js_catalog_menu_mobile_button").click();
                    }
                }
            }
        }
    }
});*/
$(document).on("click","input[name=add_click_buy_order]",function () {
    $url = $(this).parents("form").attr('action');
    $data = $(this).parents("form").serialize();
    $data += "&add_click_buy_order=ok";
    $.ajax({
        url: $url,
        data: $data,
        success: function (result) {
            $("#dasket_one_click_popup").html($("#dasket_one_click_popup",result).html());
            maskAktive("",true,'[name="PROPERTY[PHONE]"]');
            if($(result).find('.success-block').length)
            {
                setTimeout(function(){
                    location.reload();
                }, 1000);   
            }
        }
    });
    return false;
})

//Ставим Куки
function setCookie(name, value, time, path, domain, secure) {
    var date = new Date();
    date.setTime(date.getTime() + (time * 1000));

    document.cookie = name + '=' + value +
    '; path=' + path +
    '; expires=' + date.toUTCString() +
    '; domain=' + ((domain) ? domain : '') +
    '; secure=' + ((secure) ? secure : '');
}

/*$(document).ready(function(){
    setTimeout(function() {              
        //слайдер рекомендуемые товары
        if (($(window).width() > 1000)) {
            $(".rekom_slider").bxSlider({
                slideWidth: 268,
                slideMargin: 5,
                minSlides: 4,
                maxSlides: 4,
                moveSlides: 1,
                pager: false
            });
        };
        if (($(window).width() > 800) && ($(window).width() <= 1000)) {
            $(".rekom_slider").bxSlider({
                slideWidth: 250,
                slideMargin: 0,
                minSlides: 3,
                maxSlides: 3,
                moveSlides: 1,
                pager: false
            });
        };
        if (($(window).width() > 500) && ($(window).width() <= 800)) {
            $(".rekom_slider").bxSlider({
                slideWidth: 225,
                slideMargin: 0,
                minSlides: 2,
                maxSlides: 2,
                moveSlides: 1,
                pager: false
            });
        };
        if (($(window).width() <= 500)) {
            $(".rekom_slider").bxSlider({
                slideWidth: 500,
                slideMargin: 0,
                minSlides: 1,
                maxSlides: 1,
                moveSlides: 1,
                pager: false
            });
        };
    }, 5000);


});*/