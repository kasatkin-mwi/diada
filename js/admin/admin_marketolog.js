$(function() {
	$('.adm-submenu-item-link-icon.sale_menu_icon_buyers').parent().parent().hide();
	$('.adm-submenu-item-link-icon.sale_menu_icon_statistic').parent().parent().hide();
	$('.adm-submenu-item-link-icon.sale_menu_icon_store').parent().parent().hide();
	$('.statistic_icon_visitors').parent().parent().next().children('div').eq(0).hide();
	
	$('.sale_menu_icon').parent().parent().next().children('div').hide();
	$('.sale_menu_icon').parent().parent().next().children('div').eq(16).show();
	$('.sale_menu_icon').parent().parent().next().children('div').eq(17).show();
});