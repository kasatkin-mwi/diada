$(function(){
	$(document).on('submit', '.subscribe-form', function(eventz){

		eventz.preventDefault();
		$mail = $(this).find('.pole_email').val();
		$.post('', {'mail':$mail, 'action':'add_to_subscribe'}, function($data){
			if($data==null){

				$.fancybox({'content': "<p style='text-align:center;'>Заполните поле e-mail</p>"});

			}
			if ($data.status=='OK')
			{
				$.fancybox({'content':$data.text});
			}
			else{

				$.fancybox({'content':$data.text});
			}
		});
		return false;
	});
});