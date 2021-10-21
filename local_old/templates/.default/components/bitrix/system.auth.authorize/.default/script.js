$(document).ready( function()
{
    $('body').on("submit", ".form-login",function()
    {
        $.ajax({
            type: 'POST',
            url: '/include/auth.php',
            data: $(".form-login").serialize(),
            dataType: 'json',
            success: function(result)
            {
                if(result.CAPTCHA_CODE)
                {
                    $(".capcha_word").html('<ul class="not_style reg_form_el"><li>Введите слово на картинке</li><li><input type="hidden" name="captcha_sid" value="'+result.CAPTCHA_CODE+'" /><img src="/bitrix/tools/captcha.php?captcha_sid='+result.CAPTCHA_CODE+'" width="180" height="40" alt="CAPTCHA" /><input type="text" name="captcha_word" maxlength="50" value="" size="15" /></li></ul>');
                }
                if(result.status)
                {
                    location.href = ""+location.protocol+"//"+location.hostname+""+location.pathname;
                }
                else
                { 
                    $('.error_text').text(result.message);
                    BX.scrollToNode(top.BX("error_text"));
                }
            }
        });
        return false;
    });
});