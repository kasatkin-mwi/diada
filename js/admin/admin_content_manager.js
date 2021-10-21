$(function() {
	$('.adm-submenu-item-link-icon.sale_menu_icon_statistic').parent().parent().parent().hide();
	$('.adm-submenu-item-link-icon.sale_menu_icon').parent().parent().parent().hide();
	$('.adm-submenu-item-link-icon.sale_menu_icon_buyers_affiliate').parent().parent().parent().hide();
	$('.adm-submenu-item-link-icon.sale_menu_icon_buyers').parent().parent().parent().hide();
	$('.adm-submenu-item-link-icon.sale_menu_icon_crm').parent().parent().hide();
	$('.adm-submenu-item-link-icon.iblock_menu_icon_settings').parent().parent().hide();
	$('#global_menu_services').hide();
	$('#_global_menu_content').find('.adm-sub-submenu-block.adm-submenu-level-2').hide();
	$('#_global_menu_content').find('.adm-sub-submenu-block.adm-submenu-level-2').eq(0).show();
	$('#bx-panel-menu').hide();
});