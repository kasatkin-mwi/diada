<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

use Bitrix\Main\Localization\Loc;
?>

<div class="bx-soa-empty-cart-container">
    <ul class="basket_page_navigation_block not_style">
        <li><div class="basket_page_navigation_el icon1 current">Ваша корзина</div></li>
        <li><div class="basket_page_navigation_el icon2 current">Детали получения</div></li>
        <li><div class="basket_page_navigation_el icon3 active">Покупка завершена!</div></li>
    </ul>
	<div class="bx-soa-empty-cart-image">
		<img src="" alt="">
	</div>
	<div class="bx-soa-empty-cart-text"><?=Loc::getMessage("EMPTY_BASKET_TITLE")?></div>
	<div class="bx-soa-empty-cart-desc"><?=Loc::getMessage(
			'EMPTY_BASKET_HINT',
			array(
				'#A1#' => '<a href="/">',
				'#A2#' => '</a>'
			))?>
	</div>
</div>