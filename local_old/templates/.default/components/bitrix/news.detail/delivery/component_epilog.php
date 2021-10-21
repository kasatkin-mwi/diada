<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>

		<?if ($arResult['CONTACTS_LIST'] > 0) {?>
			<div class="box dostavka_box_block">
				<div class="contacts_city_block">
					<?$APPLICATION->IncludeComponent(
						"bitrix:news.detail",
						"contacts",
						Array(
							"ACTIVE_DATE_FORMAT" => "d.m.Y",
							"ADD_ELEMENT_CHAIN" => "N",
							"ADD_SECTIONS_CHAIN" => "N",
							"AJAX_MODE" => "N",
							"AJAX_OPTION_ADDITIONAL" => "",
							"AJAX_OPTION_HISTORY" => "N",
							"AJAX_OPTION_JUMP" => "N",
							"AJAX_OPTION_STYLE" => "Y",
							"BROWSER_TITLE" => "-",
							"CACHE_GROUPS" => "Y",
							"CACHE_TIME" => "36000000",
							"CACHE_TYPE" => "A",
							"CHECK_DATES" => "Y",
							"DETAIL_URL" => "",
							"DISPLAY_BOTTOM_PAGER" => "N",
							"DISPLAY_DATE" => "Y",
							"DISPLAY_NAME" => "Y",
							"DISPLAY_PICTURE" => "Y",
							"DISPLAY_PREVIEW_TEXT" => "Y",
							"DISPLAY_TOP_PAGER" => "N",
							"ELEMENT_CODE" => "",
							"ELEMENT_ID" => $arResult['CONTACTS_LIST'],
							"FIELD_CODE" => array("",""),
							"IBLOCK_ID" => "20",
							"IBLOCK_TYPE" => "contacts",
							"IBLOCK_URL" => "",
							"INCLUDE_IBLOCK_INTO_CHAIN" => "N",
							"MESSAGE_404" => "",
							"META_DESCRIPTION" => "-",
							"META_KEYWORDS" => "-",
							"PAGER_BASE_LINK_ENABLE" => "N",
							"PAGER_SHOW_ALL" => "N",
							"PAGER_TEMPLATE" => ".default",
							"PAGER_TITLE" => "Страница",
							"PROPERTY_CODE" => array("REGION",""),
							"SET_BROWSER_TITLE" => "N",
							"SET_CANONICAL_URL" => "N",
							"SET_LAST_MODIFIED" => "N",
							"SET_META_DESCRIPTION" => "N",
							"SET_META_KEYWORDS" => "N",
							"SET_STATUS_404" => "N",
							"SET_TITLE" => "N",
							"SHOW_404" => "N",
							"USE_PERMISSIONS" => "N",
							"USE_SHARE" => "N"
						)
					);?>
					<p class="h4">У Вас есть вопрос? Используйте форму обратной связи! Мы обязательно ответим!</p>
					<?$APPLICATION->IncludeComponent(
						"1cbit:form.result.new",
						"feedback",
						Array(
							"AJAX_MODE" => "Y",
							"CACHE_NOTES" => "",
							"CACHE_TIME" => "3600",
							"CACHE_TYPE" => "A",
							"CHAIN_ITEM_LINK" => "",
							"CHAIN_ITEM_TEXT" => "",
							"EDIT_URL" => "",
							"IGNORE_CUSTOM_TEMPLATE" => "N",
							"LIST_URL" => "",
							"SEF_FOLDER" => "/",
							"SEF_MODE" => "Y",
							"SUCCESS_URL" => "",
							"USE_EXTENDED_ERRORS" => "N",
							"VARIABLE_ALIASES" => Array(),
							"WEB_FORM_ID" => "1"
						)
					);?>
				</div>
			</div>
		<?}?>
	</div>