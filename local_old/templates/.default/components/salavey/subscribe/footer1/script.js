$(function(){
    
    $('form.subscribe-form').validate({
        submitHandler: function (form) {
            $mail = $(form).find('.pole_email').val();
            $('.subscribe-form').css('position', 'relative');
            $('.subscribe-form').prepend('<div class="center_loader_mask"><div class="img-loader"></div></div>');
            $.post('', {'mail':$mail, 'action':'add_to_subscribe'}, function($data){
                if($data == null){

                    $.fancybox({'content': "<p style='text-align:center;'>Заполните поле e-mail</p>"});

                }
                if ($data.status=='OK')
                {
                    try {
                       yaCounter25448447.reachGoal("emailsend");
                    }
                    catch (e) 
                    {
                    
                    }                
                    $.fancybox({'content':$data.text});
                }
                else
                {

                    $.fancybox({'content':$data.text});
                }
                 $('.subscribe-form').find('.center_loader_mask').remove();
            });
        },
        rules: {
            'email': {
                required: true,
                email: true,
                remote: {
                    url: "/include/check_email_subscribe.php",
                    type: "post",
                    dataType: 'json',
                    beforeSend: function() 
                    {
                        $('.subscribe-form').css('position', 'relative');
                        $('.subscribe-form').prepend('<div class="center_loader_mask"><div class="img-loader"></div></div>');
                    },
                    error: function()
                    {
                        $('.subscribe-form').find('.center_loader_mask').remove();
                    },
                    dataFilter: function(response) 
                    {
                        $('.subscribe-form').find('.center_loader_mask').remove();
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
        },
        messages: {
            'email': {
                required: "Поле \"e-mail\" обязательно для заполнения"                
            },
        }
    });
    
	/*$(document).on('submit', '.subscribe-form', function(eventz){

		eventz.preventDefault();
		$mail = $(this).find('.pole_email').val();
		$.post('', {'mail':$mail, 'action':'add_to_subscribe'}, function($data){
			if($data == null){

				$.fancybox({'content': "<p style='text-align:center;'>Заполните поле e-mail</p>"});

			}
			if ($data.status=='OK')
			{
				try {
				   yaCounter25448447.reachGoal("emailsend");
				}
				catch (e) 
                {
				
                }				
				$.fancybox({'content':$data.text});
			}
			else
            {

				$.fancybox({'content':$data.text});
			}
		});
		return false;
	});*/
});