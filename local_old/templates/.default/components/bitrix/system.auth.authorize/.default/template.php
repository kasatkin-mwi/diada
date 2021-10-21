<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
$this->setFrameMode(false);
?>
    <?
    ShowMessage($arParams["~AUTH_RESULT"]);
    ShowMessage($arResult['ERROR_MESSAGE']);
    ?>
    <div class="reg_form_gray">

        <div class="reg_form_gray_title">Войти</div>
        <div class="reg_form_white reg_form_top_block">
            <div class="vhod_page_block">
                <div class="vhod_page_left_col">
                    <div>
                    <div class="vhod_page_title">Авторизация на сайте</div>
                    <div class="error_text" id="error_text">
                        
                    </div>
                    <form name="form_auth" class="form-login" method="post" target="_top" action="<?=$arResult["AUTH_URL"]?>" data-ajax-href="/include/auth.php">
                        <?/*<input type="hidden" name="AUTH_FORM" value="Y" />
                        <input type="hidden" name="TYPE" value="AUTH" />*/?>
                        <?if (strlen($arResult["BACKURL"]) > 0):?>
                            <input type="hidden" name="backurl" value="<?=$arResult["BACKURL"]?>" />
                        <?endif?>
                        <?foreach ($arResult["POST"] as $key => $value):?>
                            <input type="hidden" name="<?=$key?>" value="<?=$value?>" />
                        <?endforeach?>
                        <ul class="not_style reg_form_el">
                            <li>
                                <div class="mail_tel_switch">
                                    <div class="email active">Email</div>
                                    <div class="switch left"></div>
                                    <div class="phone">Телефон</div>
                                </div>
                            </li>
                            <li><input class="error phone-mask" type="text" name="USER_LOGIN" maxlength="255" value="<?=$arResult["LAST_LOGIN"]?>" /></li>
                        </ul>
                        <ul class="not_style reg_form_el">
                            <li>Пароль*</li>
                            <li><input type="password" name="USER_PASSWORD" maxlength="255" autocomplete="off" /></li>
                        </ul>
                        <?if($arResult["CAPTCHA_CODE"]):?>
                        <div class="capcha_word">
                            <ul class="not_style reg_form_el">
                                <li><?echo GetMessage("AUTH_CAPTCHA_PROMT")?></li>
                                <li>
                                    <input type="hidden" name="captcha_sid" value="<?echo $arResult["CAPTCHA_CODE"]?>" />
                                    <img src="/bitrix/tools/captcha.php?captcha_sid=<?echo $arResult["CAPTCHA_CODE"]?>" width="180" height="40" alt="CAPTCHA" />
                                    <input type="text" name="captcha_word" maxlength="50" value="" size="15" />
                                </li>
                            </ul>
                        </div>
                        <?endif;?>
                        <input class="detail_red_button" name="Login" type="submit" value="Войти"/>
                    </form>
                    <a class="vhod_page_old_password" href="<?=$arResult["AUTH_FORGOT_PASSWORD_URL"]?>" rel="nofollow"><?=GetMessage("AUTH_FORGOT_PASSWORD_2")?></a>

                    </div>
                </div>
                <div class="vhod_page_right_col">
                    <div class="vhod_page_title">Регистрация нового пользователя</div>
                    <p>Быстро, удобно, легко!</p>
                    <ul>
                        <li>Используйте введённые ранее данные</li>
                        <li>Отслеживайте статус заказа</li>
                        <li>Получайте персонализированные предложения</li>
                        <li>Накапливайте и тратьте бонусные рубли</li>
                        <li>Сохраняйте историю заказов</li>
                    </ul>
                    <?/*<a class="detail_red_button" href="<?=$arResult["AUTH_REGISTER_URL"]?>">Зарегистрироваться</a>*/?>
                    <a class="detail_red_button" href="/auth/reg/">Зарегистрироваться</a>
                </div>
            </div>
        </div>

        <?if($arResult["AUTH_SERVICES"]):?>
        <div class="reg_form_white reg_form_soc_block">
            <div class="reg_form_white_width">
                <div class="reg_form_soc_title">Войти, используя аккаунт соцсети</div>
                <div class="reg_form_soc">
                <?
                $APPLICATION->IncludeComponent("bitrix:socserv.auth.form", "",
                    array(
                        "AUTH_SERVICES" => $arResult["AUTH_SERVICES"],
                        "CURRENT_SERVICE" => $arResult["CURRENT_SERVICE"],
                        "AUTH_URL" => $arResult["AUTH_URL"],
                        "POST" => $arResult["POST"],
                        "SHOW_TITLES" => $arResult["FOR_INTRANET"]?'N':'Y',
                        "FOR_SPLIT" => $arResult["FOR_INTRANET"]?'Y':'N',
                        "AUTH_LINE" => $arResult["FOR_INTRANET"]?'N':'Y',
                    ),
                    $component,
                    array("HIDE_ICONS"=>"Y")
                );
                ?>
                </div>
            </div>
        </div>
        <?endif?>

    </div>
    <script>
        
        /*function maskAktive(node, init, mask_input_class)
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
                    autoUnmask: true,
                    clearMaskOnLostFocus: false
                },
                match: /[0-9]/,
                replace: '#',
                listKey: "mask"
            };
         
            if(init)
            {
                if(mask_input_class != undefined && mask_input_class != "")
                {
                    $(mask_input_class).inputmask("remove");
                    $(mask_input_class).inputmasks($.extend(true, {}, maskOpts, {
                        list: listCountries
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
                        $('.phone-mask').inputmask("#{*}", maskOpts.inputmask);
                    }
                    else
                    {
                        node.addClass("right");
                        node.removeClass("left");
                        node.parents(".mail_tel_switch").find(".email").removeClass("active");
                        node.parents(".mail_tel_switch").find(".phone").addClass("active");
                        $('.phone-mask').inputmask("remove");
                        $('.phone-mask').inputmasks($.extend(true, {}, maskOpts, {
                            list: listCountries
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
                            list: listCountries
                        }));
                    }
                    else
                    {
                        node.addClass("left");
                        node.removeClass("right");
                        node.parents(".mail_tel_switch").find(".phone").removeClass("active");
                        node.parents(".mail_tel_switch").find(".email").addClass("active");
                        $('.phone-mask').inputmasks("remove");
                        $('.phone-mask').inputmask("#{*}", maskOpts.inputmask);
                    }    
                }   
            }
        }*/
        
        maskAktive($(".mail_tel_switch .switch"),true);
        $("body").on("click", ".mail_tel_switch .switch", function()
        {
            maskAktive($(this));
            return false;
        });
    </script>
    <?
    /*?>
    <?
    ShowMessage($arParams["~AUTH_RESULT"]);
    ShowMessage($arResult['ERROR_MESSAGE']);
    ?>
    <div class="reg_form_gray">

        <div class="reg_form_gray_title">Войти</div>
        <div class="reg_form_white reg_form_top_block">
            <div class="vhod_page_block">
                <div class="vhod_page_left_col">
                    <div>
                    <div class="vhod_page_title">Авторизация на сайте</div>
                    <form name="form_auth" method="post" target="_top" action="<?=$arResult["AUTH_URL"]?>">
                        <input type="hidden" name="AUTH_FORM" value="Y" />
                        <input type="hidden" name="TYPE" value="AUTH" />
                        <?if (strlen($arResult["BACKURL"]) > 0):?>
                            <input type="hidden" name="backurl" value="<?=$arResult["BACKURL"]?>" />
                        <?endif?>
                        <?foreach ($arResult["POST"] as $key => $value):?>
                            <input type="hidden" name="<?=$key?>" value="<?=$value?>" />
                        <?endforeach?>
                        <ul class="not_style reg_form_el">
                            <li>Логин или Email*</li>
                            <li><input class="error phone-mask" type="text" name="USER_LOGIN" maxlength="255" value="<?=$arResult["LAST_LOGIN"]?>" /></li>
                        </ul>
                        <p>Для авторизации по номеру телефона введите его в формате: 7XXXXXXXXXX</p>
                        <ul class="not_style reg_form_el">
                            <li>Пароль*</li>
                            <li><input type="password" name="USER_PASSWORD" maxlength="255" autocomplete="off" /></li>
                        </ul>
                        <?if($arResult["CAPTCHA_CODE"]):?>
                            <ul class="not_style reg_form_el">
                                <li><?echo GetMessage("AUTH_CAPTCHA_PROMT")?></li>
                                <li>
                                    <input type="hidden" name="captcha_sid" value="<?echo $arResult["CAPTCHA_CODE"]?>" />
                                    <img src="/bitrix/tools/captcha.php?captcha_sid=<?echo $arResult["CAPTCHA_CODE"]?>" width="180" height="40" alt="CAPTCHA" />
                                    <input type="text" name="captcha_word" maxlength="50" value="" size="15" />
                                </li>
                            </ul>
                        <?endif;?>
                        <input class="detail_red_button" name="Login" type="submit" value="Войти"/>
                    </form>
                    <a class="vhod_page_old_password" href="<?=$arResult["AUTH_FORGOT_PASSWORD_URL"]?>" rel="nofollow"><?=GetMessage("AUTH_FORGOT_PASSWORD_2")?></a>

                    </div>
                </div>
                <div class="vhod_page_right_col">
                    <div class="vhod_page_title">Регистрация нового пользователя</div>
                    <p>Быстро, удобно, легко!</p>
                    <ul>
                        <li>Используйте введённые ранее данные</li>
                        <li>Отслеживайте статус заказа</li>
                        <li>Получайте персонализированные предложения</li>
                        <li>Накапливайте и тратьте бонусные рубли</li>
                        <li>Сохраняйте историю заказов</li>
                    </ul>
                    <?/*<a class="detail_red_button" href="<?=$arResult["AUTH_REGISTER_URL"]?>">Зарегистрироваться</a>*//*?>
                    <a class="detail_red_button" href="/auth/reg/">Зарегистрироваться</a>
                </div>
            </div>
        </div>

        <?if($arResult["AUTH_SERVICES"]):?>
        <div class="reg_form_white reg_form_soc_block">
            <div class="reg_form_white_width">
                <div class="reg_form_soc_title">Войти, используя аккаунт соцсети</div>
                <div class="reg_form_soc">
                <?
                $APPLICATION->IncludeComponent("bitrix:socserv.auth.form", "",
                    array(
                        "AUTH_SERVICES" => $arResult["AUTH_SERVICES"],
                        "CURRENT_SERVICE" => $arResult["CURRENT_SERVICE"],
                        "AUTH_URL" => $arResult["AUTH_URL"],
                        "POST" => $arResult["POST"],
                        "SHOW_TITLES" => $arResult["FOR_INTRANET"]?'N':'Y',
                        "FOR_SPLIT" => $arResult["FOR_INTRANET"]?'Y':'N',
                        "AUTH_LINE" => $arResult["FOR_INTRANET"]?'N':'Y',
                    ),
                    $component,
                    array("HIDE_ICONS"=>"Y")
                );
                ?>
                </div>
            </div>
        </div>
        <?endif?>

    </div>
    <script type="text/javascript">
        $(document).ready(function()
        {
    //        $(".phone-mask").mask("+9(999) 999-9999");    
        });
    </script>
    <?*/