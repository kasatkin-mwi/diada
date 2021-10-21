<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("");?>
<?
use \Bitrix\Main\Localization\Loc;
use \Bitrix\Main\Loader;
use \Bitrix\Sale;
use \Bitrix\Sale\Order;
use \Bitrix\Sale\DiscountCouponsManager;

global $USER;
global $APPLICATION;
if($request['cupon']){
	DiscountCouponsManager::init();
	$arCoupons = DiscountCouponsManager::get(true, false, true);
	foreach($arCoupons as $arCoupon)
		DiscountCouponsManager::delete($arCoupon['COUPON']);
	DiscountCouponsManager::add($request['cupon']);
}

?>
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>