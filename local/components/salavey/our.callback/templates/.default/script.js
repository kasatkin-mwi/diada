$(function(){
    var im = new Inputmask("+7(999)9999999");
    im.mask('[type=tel]');
    
    $(".js_button_plus").click(function(e){
        e.preventDefault();
        $(this).slideUp(1).siblings(".js_active_block").slideDown(1);
        return false;
    });

    $(".js_close_block").click(function(e){
        e.preventDefault();
        $(this).parents(".js_active_block").slideUp(1).siblings(".js_button_plus").slideDown(1);
        return false;
    });

    $(document).on('click', '.a_galka', function(e)
    {
        e.preventDefault();
        var form = $(this).parents('.form_script_zvonok').serialize();
        var captchaId = $(this).parents('.form_script_zvonok').find('.g-recaptcha').attr('id');
        $all_phone = $('[type=tel]').val();
        $('#phonenumber').val($all_phone);
        $('input[name=call]').trigger('click');
        $all_phone = $all_phone.replace('(', '');
        $all_phone= $all_phone.replace(')', '');
        //$.post('/include/telphin_call.php', {'phonenumber':$all_phone}, function(data){
        $.post('/include/telphin_call.php', form, function(data){
            //$('#status').html(data);
            recaptchaRender(captchaId);
            $data_html = '<div style="padding:20px;min-width: 300px;text-align:center;">'+data+'</div>';
            $.fancybox({'content':$data_html,});
            $('.block_close.js_close_block').trigger('click');
        }); 
    });    
});