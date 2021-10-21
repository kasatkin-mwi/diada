<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>

		<?if ($arResult['CONTACTS_LIST'] > 0) {?>
			<div class="box dostavka_box_block">
				<div class="contacts_city_block">
					<div class="section">
                        <?
                        if ($arResult['PROPERTIES']['CONTACTS']['VALUE'] > 0) 
                        {
                            ?>
                            <div class="cont_tabs_bl" style="padding-top: 0;">
                                <ul class="tabs1">
                                    <li class="list current"><i class="fa fa-list-ul" aria-hidden="true"></i>Показать список</li>
                                    <li class="map"><i class="fa fa-map-marker" aria-hidden="true"></i>Показать на карте</li>
                                </ul>
                            </div>
                        <?
                        }
                        ?>
                        <?$APPLICATION->IncludeComponent(
						    "bitrix:news.detail",
						    "contacts_new",
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
							    "IBLOCK_ID" => \FCbit\Conf::FCbit_CONTACTS_IBLOCK_ID,
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
                        <div class="store_address_tit_bl">
                            <div class="store_addr_tit">У Вас есть вопрос? Используйте форму обратной связи! Мы обязательно ответим!</div>
                        </div>
                        <div class="cont_form_bl">
                            <div class="cont_form_tit">Отправьте нам запрос по электронной почте</div>
                            <div class="cont_form">
                                <?$APPLICATION->IncludeComponent(
                                    "1cbit:form.result.new",
                                    "feedback_contacts",
                                    Array(
                                        "AJAX_MODE" => "Y",
                                        "AJAX_OPTION_ADDITIONAL" => "",
                                        "AJAX_OPTION_HISTORY" => "N",
                                        "AJAX_OPTION_JUMP" => "N",
                                        "AJAX_OPTION_STYLE" => "Y",
                                        "CACHE_NOTES" => "",
                                        "CACHE_TIME" => "3602",
                                        "CACHE_TYPE" => "A",
                                        "CHAIN_ITEM_LINK" => "",
                                        "CHAIN_ITEM_TEXT" => "",
                                        "EDIT_URL" => "",
                                        "IGNORE_CUSTOM_TEMPLATE" => "N",
                                        "LIST_URL" => "",
                                        "SEF_FOLDER" => "",
                                        "SEF_MODE" => "N",
                                        "SUCCESS_URL" => "",
                                        "USE_EXTENDED_ERRORS" => "N",
                                        "VARIABLE_ALIASES" => Array(
                                            "RESULT_ID" => "RESULT_ID",
                                            "WEB_FORM_ID" => "WEB_FORM_ID"
                                        ),
                                        "WEB_FORM_ID" => "1"
                                    )
                                );?>
                            </div>
                        </div>
					    <?/*<p class="h4">У Вас есть вопрос? Используйте форму обратной связи! Мы обязательно ответим!</p>
					    <?$APPLICATION->IncludeComponent(
						    "bitrix:form.result.new",
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
					    );*/?>
				    </div>
                </div>
			</div>
		<?}?>
    </div>
    <?
    $APPLICATION->SetPageProperty('title','Доставка: г. '.$arResult['NAME'].' | Интернет-магазин Diada-Arms');
    $APPLICATION->SetPageProperty('description','Доставка: '.$arResult['NAME'].'. Интернет-магазин Diada-Arms предлагает большой ассортимент качественных товаров для активного отдыха и охоты.');
    $APPLICATION->SetTitle('Доставка: г. '.$arResult['NAME']);
    ?>