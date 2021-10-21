<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");?>
<?
$coupon = trim((string)$_GET['coupon']);
if($coupon && CModule::IncludeModule("sale") && CModule::IncludeModule("catalog")){
    \Bitrix\Sale\DiscountCouponsManager::init();
    \Bitrix\Sale\DiscountCouponsManager::add($coupon);
	\Bitrix\Sale\DiscountCouponsManager::setApply($coupon);
}

if(($_GET['coupon_clear'] == 1) && CModule::IncludeModule("sale") && CModule::IncludeModule("catalog")){
	\Bitrix\Sale\DiscountCouponsManager::init();
    \Bitrix\Sale\DiscountCouponsManager::clear(true);
}
?>
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/epilog_after.php");?>