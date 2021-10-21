<?php require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("");?>


 <div class="red_search">
<?$APPLICATION->IncludeComponent("arturgolubev:search.title", "diada", Array(
	"CATEGORY_0" => array(	// Ограничение области поиска
			0 => "iblock_ibCatalog",
		),
		"CATEGORY_0_TITLE" => "",	// Название категории
		"CATEGORY_0_iblock_ibCatalog" => array(	// Искать в информационных блоках типа "iblock_ibCatalog"
			0 => "1",
		),
		"CHECK_DATES" => "N",	// Искать только в активных по дате документах
		"CONTAINER_ID" => "smart-title-search",	// ID контейнера, по ширине которого будут выводиться результаты (ID должен быть уникальным)
		"CONVERT_CURRENCY" => "N",	// Показывать цены в одной валюте
		"FILTER_NAME" => "",	// Дополнительный фильтр
		"INPUT_ID" => "smart-title-search-input",	// ID поля ввода поискового запроса (ID должен быть уникальным)
		"INPUT_PLACEHOLDER" => "",	// Текст в поле ввода поискового запроса (placeholder)
		"NUM_CATEGORIES" => "1",	// Количество категорий поиска (Использование более одной категории замедлит работу компонента, рекомендуемое значение - 1)
		"ORDER" => "rank",	// Сортировка результатов
		"PAGE" => "#SITE_DIR#search/index.php",	// Страница выдачи результатов поиска (доступен макрос #SITE_DIR#)
		"PREVIEW_HEIGHT_NEW" => "34",	// Высота картинки
		"PREVIEW_TRUNCATE_LEN" => "",	// Максимальная длина анонса для вывода
		"PREVIEW_WIDTH_NEW" => "34",	// Ширина картинки
		"PRICE_CODE" => array(	// Тип цены
			0 => "base",
		),
		"PRICE_VAT_INCLUDE" => "Y",	// Включать НДС в цену
		"SHOW_INPUT" => "Y",	// Показывать форму ввода поискового запроса
		"SHOW_LOADING_ANIMATE" => "Y",	// Показывать анимацию загрузки
		"SHOW_PREVIEW" => "Y",	// Показать картинку
		"SHOW_PREVIEW_TEXT" => "Y",	// Показывать в результатах текст анонса
		"SHOW_PROPS" => array(	// Отображать свойства товара (укажите id необходимых свойств)
			0 => "",
		),
		"TOP_COUNT" => "5",	// Количество результатов в категории
		"USE_LANGUAGE_GUESS" => "Y",	// Включить автоопределение раскладки клавиатуры
	),
	false
);?>
</div>

<?php require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>