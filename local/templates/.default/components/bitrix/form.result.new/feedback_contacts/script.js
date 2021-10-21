BX.addCustomEvent('onAjaxSuccess', function()
{    
    if($('.cont_form form .styler input').length)
    {
       $('.cont_form form .styler input').styler(); 
    }
    $('.cont_form form').find('.g-recaptcha').each(function()
    {
        if($(this).attr('id').length)
        {
            renderRecaptcha($(this).attr('id'));    
        }
    });
    
    if($('.ind_subs_prava input[type="checkbox"]').prop('checked'))
    {
        $('.ind_subs_prava input[type="checkbox"]').parents('.cont_form_bot').find('.red_bt').prop('disabled', false);
    }
    else
    {
        $('.ind_subs_prava input[type="checkbox"]').parents('.cont_form_bot').find('.red_bt').prop('disabled', true);
    }
});    
$(document).ready(function()
{
   $('body').on('change', '.ind_subs_prava input[type="checkbox"]', function()
   {
       if($(this).prop('checked'))
       {
           $(this).parents('.cont_form_bot').find('.red_bt').prop('disabled', false);
       }
       else
       {
           $(this).parents('.cont_form_bot').find('.red_bt').prop('disabled', true);
       }
   }); 
});