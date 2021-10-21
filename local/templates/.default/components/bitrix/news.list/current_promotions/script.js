$(document).ready(function(){
	$(".curprom__item_button").fancybox({
		margin: 0,
		padding: 20,
		maxWidth: 640,
		//autoScale: true,
		autoHeight: true,
		//transitionIn: 'none',
		//transitionOut: 'none',
		type: 'inline',
		helpers: {
			overlay: {
				locked: false
			}
		},
		tpl: {
			wrap : '<div class="fancybox-wrap" tabIndex="-1"><div class="fancybox-skin promotions_modal"><div class="fancybox-outer"><div class="fancybox-inner"></div></div></div></div>',
		}
	});
});