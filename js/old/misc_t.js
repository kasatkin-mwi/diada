function email_focus() {
	if ($(this).val() == 'http://buy-hit.ru/GRIZZLY-belt/timer/js/your@email.com') {
		$(this).val('')
		$(this).removeClass('faded');
	}
}

function email_blur() {
	if ($(this).val() == '') {
		$(this).val('http://buy-hit.ru/GRIZZLY-belt/timer/js/your@email.com')
		$(this).addClass('faded');
	}	
}

function subscribe_submit() {
	email = $('#email_field').val();

	$.post('http://buy-hit.ru/GRIZZLY-belt/timer/js/subscribe.php?json=1', $('#subscribe_form').serialize(), subscribe_result, 'json');
	$('#subscribe_button').attr("disabled","disabled");
	$('.form_message').fadeOut('fast');
	$('#loading').fadeIn('fast');
	return false;
}

function subscribe_result(data) {
	$('#loading').hide();
	if (data.error) {
		display_message(data.error);
	} else {
		display_message(data.info, 'info')
	}
	$('#subscribe_button').removeAttr("disabled");
}

function display_message(msg, type) {

	if (!type) type = 'error';

	if (type == 'error') {
		$('#error_message').html(msg).fadeIn('slow');
		setTimeout('hide_error()', 4000);
	} else {
		$('#error_message').hide();
		$('#info_message').html(msg).fadeIn('slow');
	}
}

function hide_error() {
	$('#error_message').fadeOut('slow');
}
