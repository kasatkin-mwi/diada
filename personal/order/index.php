<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("");
?>

<?/*if($USER->GetID() == USER_SALAVEY_ID):?>
	<?$APPLICATION->IncludeComponent(
		"salavey:sale.order.ajax.inherited",
		".default",
		array(
			"USER_CONSENT" => "N",
			"USER_CONSENT_ID" => "1",
			"USER_CONSENT_IS_CHECKED" => "N",
			"USER_CONSENT_IS_LOADED" => "N",
			"ADDITIONAL_PICT_PROP_1" => "-",
			"ADDITIONAL_PICT_PROP_24" => "-",
			"ALLOW_AUTO_REGISTER" => "Y",
			"ALLOW_NEW_PROFILE" => "N",
			"ALLOW_USER_PROFILES" => "N",
			"BASKET_IMAGES_SCALING" => "standard",
			"BASKET_POSITION" => "before",
			"COMPATIBLE_MODE" => "Y",
			"DELIVERIES_PER_PAGE" => "8",
			"DELIVERY_FADE_EXTRA_SERVICES" => "N",
			"DELIVERY_NO_AJAX" => "Y",
			"DELIVERY_NO_SESSION" => "Y",
			"DELIVERY_TO_PAYSYSTEM" => "d2p",
			"DISABLE_BASKET_REDIRECT" => "N",
			"ONLY_FULL_PAY_FROM_ACCOUNT" => "N",
			"PATH_TO_AUTH" => "/auth/",
			"PATH_TO_BASKET" => "/personal/cart/",
			"PATH_TO_PAYMENT" => "",
			"PATH_TO_PERSONAL" => "",
			"PAY_FROM_ACCOUNT" => "N",
			"PAY_SYSTEMS_PER_PAGE" => "8",
			"PICKUPS_PER_PAGE" => "5",
			"PRODUCT_COLUMNS_HIDDEN" => array(
			),
			"PRODUCT_COLUMNS_VISIBLE" => array(
				0 => "PREVIEW_PICTURE",
				1 => "PROPS",
			),
			"PROPS_FADE_LIST_1" => array(
				0 => "1",
				1 => "2",
				2 => "3",
				3 => "4",
				4 => "5",
				5 => "6",
				6 => "7",
				7 => "9",
				8 => "10",
				9 => "11",
				10 => "12",
				11 => "13",
				12 => "14",
				13 => "15",
				14 => "16",
				15 => "21",
				16 => "22",
				17 => "23",
			),
			"SEND_NEW_USER_NOTIFY" => "Y",
			"SERVICES_IMAGES_SCALING" => "standard",
			"SET_TITLE" => "Y",
			"SHOW_BASKET_HEADERS" => "N",
			"SHOW_COUPONS_BASKET" => "Y",
			"SHOW_COUPONS_DELIVERY" => "Y",
			"SHOW_COUPONS_PAY_SYSTEM" => "Y",
			"SHOW_DELIVERY_INFO_NAME" => "Y",
			"SHOW_DELIVERY_LIST_NAMES" => "Y",
			"SHOW_DELIVERY_PARENT_NAMES" => "Y",
			"SHOW_MAP_IN_PROPS" => "N",
			"SHOW_NEAREST_PICKUP" => "Y",
			"SHOW_NOT_CALCULATED_DELIVERIES" => "L",
			"SHOW_ORDER_BUTTON" => "final_step",
			"SHOW_PAY_SYSTEM_INFO_NAME" => "Y",
			"SHOW_PAY_SYSTEM_LIST_NAMES" => "Y",
			"SHOW_STORES_IMAGES" => "Y",
			"SHOW_TOTAL_ORDER_BUTTON" => "N",
			"SKIP_USELESS_BLOCK" => "Y",
			"TEMPLATE_LOCATION" => "popup",
			"TEMPLATE_THEME" => "blue",
			"USE_CUSTOM_ADDITIONAL_MESSAGES" => "N",
			"USE_CUSTOM_ERROR_MESSAGES" => "N",
			"USE_CUSTOM_MAIN_MESSAGES" => "Y",
			"USE_PRELOAD" => "Y",
			"USE_PREPAYMENT" => "N",
			"USE_YM_GOALS" => "N",
			"COMPONENT_TEMPLATE" => "page",
			"ACTION_VARIABLE" => "action",
			"SHOW_MAP_FOR_DELIVERIES" => array(
				0 => "8",
				1 => "9",
				2 => "13",
				3 => "16",
				4 => "31",
				5 => "32",
				6 => "33",
				7 => "34",
				8 => "35",
				9 => "36",
				10 => "37",
				11 => "38",
				12 => "39",
				13 => "40",
				14 => "41",
				15 => "42",
				16 => "43",
			),
			"MESS_AUTH_BLOCK_NAME" => "Авторизация",
			"MESS_REG_BLOCK_NAME" => "Регистрация",
			"MESS_BASKET_BLOCK_NAME" => "Товары в заказе",
			"MESS_REGION_BLOCK_NAME" => "Регион доставки",
			"MESS_PAYMENT_BLOCK_NAME" => "Оплата",
			"MESS_DELIVERY_BLOCK_NAME" => "Доставка",
			"MESS_BUYER_BLOCK_NAME" => "Покупатель",
			"MESS_BACK" => "Назад",
			"MESS_FURTHER" => "Далее",
			"MESS_EDIT" => "Посмотреть",
			"MESS_ORDER" => "Оформить заказ",
			"MESS_PRICE" => "Стоимость",
			"MESS_PERIOD" => "Срок доставки",
			"MESS_NAV_BACK" => "Назад",
			"MESS_NAV_FORWARD" => "Вперед",
			"COMPOSITE_FRAME_MODE" => "A",
			"COMPOSITE_FRAME_TYPE" => "AUTO"
		),
		false
	);?>
<?else:*/?>
    <?
    $prarmeters = Array(
    "USER_CONSENT" => "N",
        "USER_CONSENT_ID" => "1",
        "USER_CONSENT_IS_CHECKED" => "N",
        "USER_CONSENT_IS_LOADED" => "N",
        "ADDITIONAL_PICT_PROP_1" => "-",    // Дополнительная картинка [Каталог оружия]
        "ADDITIONAL_PICT_PROP_24" => "-",    // Дополнительная картинка [Каталог товаров]
        "ALLOW_AUTO_REGISTER" => "Y",    // Оформлять заказ с автоматической регистрацией пользователя
        "ALLOW_APPEND_ORDER" => "Y",    
        "ALLOW_NEW_PROFILE" => "N",    // Разрешить множество профилей покупателей
        "ALLOW_USER_PROFILES" => "N",    // Разрешить использование профилей покупателей
        "BASKET_IMAGES_SCALING" => "standard",    // Режим отображения изображений товаров
        "BASKET_POSITION" => "before",    // Расположение списка товаров
        "COMPATIBLE_MODE" => "Y",    // Режим совместимости для предыдущего шаблона
        "DELIVERIES_PER_PAGE" => "8",    // Количество доставок на странице
        "DELIVERY_FADE_EXTRA_SERVICES" => "N",    // Дополнительные услуги, которые будут показаны в пройденном (свернутом) блоке
        "DELIVERY_NO_AJAX" => "N",    // Рассчитывать сразу доставки с внешним доступом к сервисам
        "DELIVERY_NO_SESSION" => "Y",    // Проверять сессию при оформлении заказа
        "DELIVERY_TO_PAYSYSTEM" => "d2p",    // Последовательность оформления
        "DISABLE_BASKET_REDIRECT" => "N",    // Оставаться на странице оформления заказа, если список товаров пуст
        "ONLY_FULL_PAY_FROM_ACCOUNT" => "N",    // Разрешить оплату с внутреннего счета только в полном объеме
        "PATH_TO_AUTH" => "/auth/",    // Путь к странице авторизации
        "PATH_TO_BASKET" => "/personal/cart/",    // Путь к странице корзины
        "PATH_TO_PAYMENT" => "",    // Страница подключения платежной системы
        "PATH_TO_PERSONAL" => "",    // Путь к странице персонального раздела
        "PAY_FROM_ACCOUNT" => "N",    // Разрешить оплату с внутреннего счета
        "PAY_SYSTEMS_PER_PAGE" => "8",    // Количество платежных систем на странице
        "PICKUPS_PER_PAGE" => "5",    // Количество пунктов самовывоза на странице
        "PRODUCT_COLUMNS_HIDDEN" => "",    // Свойства товаров отображаемые в свернутом виде в списке товаров
        "PRODUCT_COLUMNS_VISIBLE" => array(    // Выбранные колонки таблицы списка товаров
            0 => "PREVIEW_PICTURE",
            1 => "PROPS",
        ),
        "PROPS_FADE_LIST_1" => array(    // Свойства заказа, которые будут показаны в пройденном (свернутом) блоке (Покупатель)[s1]
            0 => "1",
            1 => "2",
            2 => "3",
            3 => "4",
            4 => "5",
            5 => "6",
            6 => "7",
            7 => "9",
            8 => "10",
            9 => "11",
            10 => "12",
            11 => "13",
            12 => "14",
            13 => "15",
            14 => "16",
            15 => "21",
            16 => "22",
            17 => "23",
            18 => "68",
            19 => "69",
        ),
        //"PROPS_FADE_LIST_2" => array(
//            0 => "47",
//            1 => "49",
//            2 => "50",
//            3 => "51",
//            4 => "52",
//            5 => "53",
//            6 => "54",
//            7 => "55",
//            8 => "56",
//            9 => "57",
//            10 => "58",
//            11 => "59",
//            12 => "60",
//            13 => "61",
//            14 => "62",
//            15 => "63",
//            16 => "64",
//        ),
        "SEND_NEW_USER_NOTIFY" => "Y",    // Отправлять пользователю письмо, что он зарегистрирован на сайте
        "SERVICES_IMAGES_SCALING" => "standard",    // Режим отображения вспомагательных изображений
        "SET_TITLE" => "Y",    // Устанавливать заголовок страницы
        "SHOW_BASKET_HEADERS" => "N",    // Показывать заголовки колонок списка товаров
        "SHOW_COUPONS_BASKET" => "Y",    // Показывать поле ввода купонов в блоке списка товаров
        "SHOW_COUPONS_DELIVERY" => "Y",    // Показывать поле ввода купонов в блоке доставки
        "SHOW_COUPONS_PAY_SYSTEM" => "Y",    // Показывать поле ввода купонов в блоке оплаты
        "SHOW_DELIVERY_INFO_NAME" => "Y",    // Отображать название в блоке информации по доставке
        "SHOW_DELIVERY_LIST_NAMES" => "Y",    // Отображать названия в списке доставок
        "SHOW_DELIVERY_PARENT_NAMES" => "Y",    // Показывать название родительской доставки
        "SHOW_MAP_IN_PROPS" => "N",    // Показывать карту в блоке свойств заказа
        "SHOW_NEAREST_PICKUP" => "Y",    // Показывать ближайшие пункты самовывоза
        "SHOW_NOT_CALCULATED_DELIVERIES" => "L",    // Отображение доставок с ошибками расчета
        "SHOW_ORDER_BUTTON" => "final_step",    // Отображать кнопку оформления заказа (для неавторизованных пользователей)
        "SHOW_PAY_SYSTEM_INFO_NAME" => "Y",    // Отображать название в блоке информации по платежной системе
        "SHOW_PAY_SYSTEM_LIST_NAMES" => "Y",    // Отображать названия в списке платежных систем
        "PAY_KEEPER_UNSET" => "Y", //Отключить PayKeeper в оформлении заказа
        "SHOW_STORES_IMAGES" => "Y",    // Показывать изображения складов в окне выбора пункта выдачи
        "SHOW_TOTAL_ORDER_BUTTON" => "N",    // Отображать дополнительную кнопку оформления заказа
        "SKIP_USELESS_BLOCK" => "Y",    // Пропускать шаги, в которых один элемент для выбора
        "TEMPLATE_LOCATION" => "popup",    // Визуальный вид контрола выбора метоположений
        "TEMPLATE_THEME" => "blue",    // Цветовая тема
        "USE_CUSTOM_ADDITIONAL_MESSAGES" => "N",    // Заменить стандартные фразы на свои
        "USE_CUSTOM_ERROR_MESSAGES" => "N",    // Заменить стандартные фразы на свои
        "USE_CUSTOM_MAIN_MESSAGES" => "Y",    // Заменить стандартные фразы на свои
        "USE_PRELOAD" => "Y",    // Автозаполнение оплаты и доставки по предыдущему заказу
        "USE_PREPAYMENT" => "N",    // Использовать предавторизацию для оформления заказа (PayPal Express Checkout)
        "USE_YM_GOALS" => "N",    // Использовать цели счетчика Яндекс.Метрики
        "COMPONENT_TEMPLATE" => "page",
        "ACTION_VARIABLE" => "action",
        "SHOW_MAP_FOR_DELIVERIES" => array(
            0 => "8",
            1 => "9",
            2 => "13",
            3 => "16",
            4 => "31",
            5 => "32",
            6 => "33",
            7 => "34",
            8 => "35",
            9 => "36",
            10 => "37",
            11 => "38",
            12 => "39",
            13 => "40",
            14 => "41",
            15 => "42",
            16 => "43",
        ),
        "MESS_AUTH_BLOCK_NAME" => "Авторизация",    // Название блока авторизации
        "MESS_REG_BLOCK_NAME" => "Регистрация",    // Название блока регистрации
        "MESS_BASKET_BLOCK_NAME" => "Товары в заказе",    // Название блока списка товаров
        "MESS_REGION_BLOCK_NAME" => "Регион доставки",    // Название блока региона доставки
        "MESS_PAYMENT_BLOCK_NAME" => "Оплата",    // Название блока оплаты
        "MESS_DELIVERY_BLOCK_NAME" => "Доставка",    // Название блока доставки
        "MESS_BUYER_BLOCK_NAME" => "Покупатель",    // Название блока свойств заказа
        "MESS_BACK" => "Назад",    // Кнопка возврата к предыдущему блоку
        "MESS_FURTHER" => "Далее",    // Кнопка перехода к следующему блоку
        "MESS_EDIT" => "Посмотреть",    // Кнопка редактирования блока
        "MESS_ORDER" => "Оформить заказ",    // Кнопка оформления заказа
        "MESS_PRICE" => "Стоимость",    // Заголовок для цены
        "MESS_PERIOD" => "Срок доставки",    // Заголовок для срока доставки
        "MESS_NAV_BACK" => "Назад",    // Кнопка перехода к предыдущей странице
        "MESS_NAV_FORWARD" => "Вперед",    // Кнопка перехода к следующей странице
        "COMPOSITE_FRAME_MODE" => "A",    // Голосование шаблона компонента по умолчанию
        "COMPOSITE_FRAME_TYPE" => "AUTO",    // Содержимое компонента
    );
    if($USER->IsAdmin())
    {
        $prarmeters["PROPS_FADE_LIST_2"] = array(
            0 => "47",
            1 => "49",
            2 => "50",
            3 => "51",
            4 => "52",
            5 => "53",
            6 => "54",
            7 => "55",
            8 => "56",
            9 => "57",
            10 => "58",
            11 => "59",
            12 => "60",
            13 => "61",
            14 => "62",
            15 => "63",
            16 => "64",
        );
    }
    ?>
    <?$APPLICATION->IncludeComponent("salavey:sale.order.ajax.inherited", "page2", $prarmeters,
        false
    );?>
<?/*endif*/?>
<input id="set_city" type="hidden" value="0">
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>