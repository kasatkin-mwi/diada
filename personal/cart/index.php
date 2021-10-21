<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Корзина");
?>
<div class="standart_width">
	<ul class="basket_page_breadcrumbs not_style">
		<li><a class="basket_page_breadcrumbs_prev" href="<?=(!preg_match("/\/catalog\//",$_SERVER["HTTP_REFERER"]))?"/catalog/":$_SERVER["HTTP_REFERER"]?>">Вернуться к покупкам</a></li>
		<li><a class="basket_page_breadcrumbs_del" id="js_clear_all_basket" href="javascript:void(0;">Очистить все</a></li>
	</ul>
	<ul class="basket_page_navigation_block not_style">
		<li><div class="basket_page_navigation_el icon1 active">Ваша корзина</div></li>
		<li><div class="basket_page_navigation_el icon2">Детали получения</div></li>
		<li><div class="basket_page_navigation_el icon3">Покупка завершена!</div></li>
	</ul>
</div>
<script>
    $(document).on("click","#js_clear_all_basket", function () {
        $("[name=clear_bascet]").val("Y");
        $("form#hidden_form_basket").submit();
    })
</script>
<?if ($_REQUEST["clear_bascet"] == "Y"){
    CSaleBasket::DeleteAll(CSaleBasket::GetBasketUserID());
}?>
<form method="post" id="hidden_form_basket">
    <input type="hidden" name="clear_bascet" value="" />
</form>
<?if ($_REQUEST["AJAX_PAGE_S"] == "Y") $APPLICATION->RestartBuffer()?>
<div>
    <div id="ajax_data">
        <?/*if($USER->GetID() == USER_SALAVEY_ID):?>
            <?$APPLICATION->IncludeComponent("bitrix:sale.basket.basket", "test", Array(
	"AJAX_MODE" => "Y",
		"AJAX_MODE_CUSTOM" => "Y",
		"ACTION_VARIABLE" => "basketAction",	// Название переменной действия
		"AUTO_CALCULATION" => "Y",	// Автопересчет корзины
		"COLUMNS_LIST" => array(
			0 => "NAME",
			1 => "DISCOUNT",
			2 => "WEIGHT",
			3 => "PROPS",
			4 => "DELETE",
			5 => "DELAY",
			6 => "TYPE",
			7 => "PRICE",
			8 => "QUANTITY",
		),
		"CORRECT_RATIO" => "N",	// Автоматически рассчитывать количество товара кратное коэффициенту
		"COUNT_DISCOUNT_4_ALL_QUANTITY" => "N",
		"GIFTS_BLOCK_TITLE" => "Выберите один из подарков",	// Текст заголовка "Подарки"
		"GIFTS_CONVERT_CURRENCY" => "N",	// Показывать цены в одной валюте
		"GIFTS_HIDE_BLOCK_TITLE" => "N",	// Скрыть заголовок "Подарки"
		"GIFTS_HIDE_NOT_AVAILABLE" => "N",	// Не отображать товары, которых нет на складах
		"GIFTS_MESS_BTN_BUY" => "Выбрать",	// Текст кнопки "Выбрать"
		"GIFTS_MESS_BTN_DETAIL" => "Подробнее",	// Текст кнопки "Подробнее"
		"GIFTS_PAGE_ELEMENT_COUNT" => "4",	// Количество элементов в строке
		"GIFTS_PLACE" => "BOTTOM",	// Вывод блока "Подарки"
		"GIFTS_PRODUCT_PROPS_VARIABLE" => "prop",	// Название переменной, в которой передаются характеристики товара
		"GIFTS_PRODUCT_QUANTITY_VARIABLE" => "",	// Название переменной, в которой передается количество товара
		"GIFTS_SHOW_DISCOUNT_PERCENT" => "Y",	// Показывать процент скидки
		"GIFTS_SHOW_IMAGE" => "Y",	// Показывать изображение
		"GIFTS_SHOW_NAME" => "Y",	// Показывать название
		"GIFTS_SHOW_OLD_PRICE" => "N",	// Показывать старую цену
		"GIFTS_TEXT_LABEL_GIFT" => "Подарок",	// Текст метки "Подарка"
		"HIDE_COUPON" => "N",	// Спрятать поле ввода купона
		"PATH_TO_ORDER" => "/personal/order/",	// Страница оформления заказа
		"PRICE_VAT_SHOW_VALUE" => "N",	// Отображать значение НДС
		"QUANTITY_FLOAT" => "N",	// Использовать дробное значение количества
		"SET_TITLE" => "Y",	// Устанавливать заголовок страницы
		"TEMPLATE_THEME" => "blue",	// Цветовая тема
		"USE_GIFTS" => "Y",	// Показывать блок "Подарки"
		"USE_PREPAYMENT" => "N",	// Использовать предавторизацию для оформления заказа (PayPal Express Checkout)
		"COMPONENT_TEMPLATE" => ".defaultserg",
		"COMPOSITE_FRAME_MODE" => "A",	// Голосование шаблона компонента по умолчанию
		"COMPOSITE_FRAME_TYPE" => "AUTO",	// Содержимое компонента
		"COLUMNS_LIST_EXT" => array(	// Выводимые колонки
			0 => "PREVIEW_PICTURE",
			1 => "DISCOUNT",
			2 => "DELETE",
			3 => "DELAY",
			4 => "TYPE",
			5 => "SUM",
		),
		"COMPATIBLE_MODE" => "Y",	// Включить режим совместимости
		"ADDITIONAL_PICT_PROP_1" => "-",	// Дополнительная картинка [Каталог оружия]
		"ADDITIONAL_PICT_PROP_24" => "-",	// Дополнительная картинка [Каталог товаров]
		"BASKET_IMAGES_SCALING" => "adaptive",	// Режим отображения изображений товаров
	),
	false
);?>
        <?else:*/?>
            <?$APPLICATION->IncludeComponent(
                "bitrix:sale.basket.basket",
                "page",
                array(
                    "AJAX_MODE" => "Y",
                    "AJAX_MODE_CUSTOM" => "Y",
                    "ACTION_VARIABLE" => "basketAction",
                    "AUTO_CALCULATION" => "Y",
                    "COLUMNS_LIST" => array(
                        0 => "NAME",
                        1 => "DISCOUNT",
                        2 => "WEIGHT",
                        3 => "PROPS",
                        4 => "DELETE",
                        5 => "DELAY",
                        6 => "TYPE",
                        7 => "PRICE",
                        8 => "QUANTITY",
                    ),
                    "CORRECT_RATIO" => "N",
                    "COUNT_DISCOUNT_4_ALL_QUANTITY" => "N",
                    "GIFTS_BLOCK_TITLE" => "Выберите один из подарков",
                    "GIFTS_CONVERT_CURRENCY" => "N",
                    "GIFTS_HIDE_BLOCK_TITLE" => "N",
                    "GIFTS_HIDE_NOT_AVAILABLE" => "N",
                    "GIFTS_MESS_BTN_BUY" => "Выбрать",
                    "GIFTS_MESS_BTN_DETAIL" => "Подробнее",
                    "GIFTS_PAGE_ELEMENT_COUNT" => "4",
                    "GIFTS_PLACE" => "BOTTOM",
                    "GIFTS_PRODUCT_PROPS_VARIABLE" => "prop",
                    "GIFTS_PRODUCT_QUANTITY_VARIABLE" => "",
                    "GIFTS_SHOW_DISCOUNT_PERCENT" => "Y",
                    "GIFTS_SHOW_IMAGE" => "Y",
                    "GIFTS_SHOW_NAME" => "Y",
                    "GIFTS_SHOW_OLD_PRICE" => "N",
                    "GIFTS_TEXT_LABEL_GIFT" => "Подарок",
                    "HIDE_COUPON" => "N",
                    "PATH_TO_ORDER" => "/personal/order/",
                    "PRICE_VAT_SHOW_VALUE" => "N",
                    "QUANTITY_FLOAT" => "N",
                    "SET_TITLE" => "Y",
                    "TEMPLATE_THEME" => "blue",
                    "USE_GIFTS" => "Y",
                    "USE_PREPAYMENT" => "N",
                    "COMPONENT_TEMPLATE" => ".defaultserg",
                    "COMPOSITE_FRAME_MODE" => "A",
                    "COMPOSITE_FRAME_TYPE" => "AUTO",
                    "COLUMNS_LIST_EXT" => array(
                        0 => "PREVIEW_PICTURE",
                        1 => "DISCOUNT",
                        2 => "DELETE",
                        3 => "DELAY",
                        4 => "TYPE",
                        5 => "SUM",
                    ),
                    "COMPATIBLE_MODE" => "Y",
                    "ADDITIONAL_PICT_PROP_1" => "-",
                    "ADDITIONAL_PICT_PROP_24" => "-",
                    "BASKET_IMAGES_SCALING" => "adaptive"
                ),
                false
            );?>
        <?/*endif*/?>
    </div>
</div>
<?if ($_REQUEST["AJAX_PAGE_S"] == "Y") die()?>

<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>