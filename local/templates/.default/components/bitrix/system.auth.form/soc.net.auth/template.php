<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<div class="all_social_block">
<?
    if($arResult["FORM_TYPE"] == "login"):?>
        <form name="system_auth_form<?=$arResult["RND"]?>" method="post" target="_top" action="<?=$arResult["AUTH_URL"]?>">
    <?if($arResult["BACKURL"] <> ''):?>
        <input type="hidden" name="backurl" value="<?=$arResult["BACKURL"]?>" />
    <?endif?>
    <?foreach ($arResult["POST"] as $key => $value):?>
        <input type="hidden" name="<?=$key?>" value="<?=$value?>" />
    <?endforeach?>
        <input type="hidden" name="AUTH_FORM" value="Y" />
        <input type="hidden" name="TYPE" value="AUTH" />

    <?if($arResult["AUTH_SERVICES"]):?>
    <?
    $APPLICATION->IncludeComponent("bitrix:socserv.auth.form", "icons",
        array(
            "AUTH_SERVICES"=>$arResult["AUTH_SERVICES"],
            "SUFFIX"=>"form",
        ),
        $component
    );
    ?>
    <?endif?>
    </form>
    <?if($arResult["AUTH_SERVICES"]):?>
    <?$APPLICATION->IncludeComponent("bitrix:socserv.auth.form", "",
        array(
            "AUTH_SERVICES"=>$arResult["AUTH_SERVICES"],
            "AUTH_URL"=>$arResult["AUTH_URL"],
            "POST"=>$arResult["POST"],
            "POPUP"=>"Y",
            "SUFFIX"=>"form",
        ),
        $component,
        array("HIDE_ICONS"=>"Y")
    );
    ?>
    <?endif?>

    <?
    elseif($arResult["FORM_TYPE"] == "otp"):
    ?>

    <form name="system_auth_form<?=$arResult["RND"]?>" method="post" target="_top" action="<?=$arResult["AUTH_URL"]?>">
    <?if($arResult["BACKURL"] <> ''):?>
        <input type="hidden" name="backurl" value="<?=$arResult["BACKURL"]?>" />
    <?endif?>
        <input type="hidden" name="AUTH_FORM" value="Y" />
        <input type="hidden" name="TYPE" value="OTP" />
        <table width="95%">
            <tr>
                <td colspan="2">
                <?echo GetMessage("auth_form_comp_otp")?><br />
                <input type="text" name="USER_OTP" maxlength="50" value="" size="17" autocomplete="off" /></td>
            </tr>
    <?if ($arResult["CAPTCHA_CODE"]):?>
            <tr>
                <td colspan="2">
                <?echo GetMessage("AUTH_CAPTCHA_PROMT")?>:<br />
                <input type="hidden" name="captcha_sid" value="<?echo $arResult["CAPTCHA_CODE"]?>" />
                <img src="/bitrix/tools/captcha.php?captcha_sid=<?echo $arResult["CAPTCHA_CODE"]?>" width="180" height="40" alt="CAPTCHA" /><br /><br />
                <input type="text" name="captcha_word" maxlength="50" value="" /></td>
            </tr>
    <?endif?>
    <?if ($arResult["REMEMBER_OTP"] == "Y"):?>
            <tr>
                <td valign="top"><input type="checkbox" id="OTP_REMEMBER_frm" name="OTP_REMEMBER" value="Y" /></td>
                <td width="100%"><label for="OTP_REMEMBER_frm" title="<?echo GetMessage("auth_form_comp_otp_remember_title")?>"><?echo GetMessage("auth_form_comp_otp_remember")?></label></td>
            </tr>
    <?endif?>
            <tr>
                <td colspan="2"><input type="submit" name="Login" value="<?=GetMessage("AUTH_LOGIN_BUTTON")?>" /></td>
            </tr>
            <tr>
                <td colspan="2"><noindex><a href="<?=$arResult["AUTH_LOGIN_URL"]?>" rel="nofollow"><?echo GetMessage("auth_form_comp_auth")?></a></noindex><br /></td>
            </tr>
        </table>
    </form>

    <?
    else:
    ?>

    <form action="<?=$arResult["AUTH_URL"]?>">
        <table width="95%">
            <tr>
                <td align="center">
                    <a href="/lk/"><?=$arResult["USER_NAME"]?><br />
                    [<?=$arResult["USER_LOGIN"]?>]<br /></a>
                </td>
            </tr>
            <tr>
                <td align="center">
                <?foreach ($arResult["GET"] as $key => $value):?>
                    <input type="hidden" name="<?=$key?>" value="<?=$value?>" />
                <?endforeach?>
                    <input type="hidden" name="logout" value="yes" />
                    <input style="display: none" type="submit" name="logout_butt" value="<?=GetMessage("AUTH_LOGOUT_BUTTON")?>" />
                    <a style="margin-top: 20px" class="red_button" href="javascript:void(0);" onclick="$(this).siblings('input[type=submit]').click();"><span>??????????</span></a>
                </td>
            </tr>
        </table>
    </form>
    <?endif?>
    <?if(!$USER->IsAuthorized()):?>
        <?/* <p class="all_social_sale">???????????? 1%</p> */?>
        <p class="all_social_sale">????????????</p>
        <p class="all_social_reg">?????? ??????????????????????</p>
        <a class="red_button" href="/auth/reg/"><span>??????????????????????</span></a>
    <?endif?>
</div>