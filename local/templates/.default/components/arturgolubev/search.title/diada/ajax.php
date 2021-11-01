<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

if (empty($arResult["CATEGORIES"]) && $arResult["DEBUG"]["SHOW"] != 'Y') return;

IncludeTemplateLangFile(__FILE__);

$arParams["SHOW_PREVIEW_TEXT"] = ($arParams["SHOW_PREVIEW_TEXT"]) ? $arParams["SHOW_PREVIEW_TEXT"] : 'Y';
$obParser = new CTextParser;
$preview = ($arParams["SHOW_PREVIEW"] != 'N');

$image_style = '';
$info_style = '';
if($preview){
	if($arParams["PREVIEW_WIDTH_NEW"]){
		$image_style .= 'width: '.$arParams["PREVIEW_WIDTH_NEW"].'px;';
		$info_style .= 'padding-left: '.($arParams["PREVIEW_WIDTH_NEW"]+5).'px;';
	}
	if($arParams["PREVIEW_HEIGHT_NEW"]){
		$image_style .= 'height: '.$arParams["PREVIEW_HEIGHT_NEW"].'px;';
	}
	if($info_style) $info_style = 'style="'.$info_style.'"';
}
$USE_LANGUAGE_GUESS = 'Y';


////////////////////////////////
$bx_search_limit = COption::GetOptionString('search','max_result_size',50);
global $arSParams;
$arSParams = Array(
		"RESTART" => $arParams["RESTART"],
		"NO_WORD_LOGIC" => $arParams["NO_WORD_LOGIC"],
		"USE_LANGUAGE_GUESS" => $USE_LANGUAGE_GUESS,
		"CHECK_DATES" => $arParams["CHECK_DATES"],
		"arrFILTER" => array("iblock_ibCatalog"),
		"arrFILTER_iblock_ibCatalog" => array(1),
		"USE_TITLE_RANK" => "Y",
		"DEFAULT_SORT" => "rank",
		"FILTER_NAME" => "",
		"SHOW_WHERE" => "N",
		"arrWHERE" => array(),
		"SHOW_WHEN" => "N",
		"PAGE_RESULT_COUNT" => $bx_search_limit,
		"DISPLAY_TOP_PAGER" => "N",
		"DISPLAY_BOTTOM_PAGER" => "N",
		"PAGER_TITLE" => "",
		"PAGER_SHOW_ALWAYS" => "N",
		"PAGER_TEMPLATE" => "N",
);


$arElements = $APPLICATION->IncludeComponent(
	"arturgolubev:search.page",
	"catalog",
	$arSParams,
	$component,
	array('HIDE_ICONS' => 'N')
);

/////////////////////////////////////////
$arSelect = Array("ID", "NAME", "PREVIEW_PICTURE", "PREVIEW_TEXT", "PROPERTY_rating", "IBLOCK_ID", "DETAIL_PAGE_URL", "CATALOG_GROUP_1");
$arFilter = Array("IBLOCK_ID"=>1, "ACTIVE"=>"Y", "ID" => $arElements);
$res = CIBlockElement::GetList(Array("CATALOG_AVAILABLE" => "desc,nulls", "PROPERTY_SORTING" => "ASC", "PROPERTY_rating" => "DESC", "ID" => "ASC"), $arFilter, false, Array("nPageSize"=>$arParams["TOP_COUNT_ITOG"]), $arSelect);
while($ob = $res->GetNextElement())
{
	
	$arFields = $ob->GetFields();
	if ( $arFields['PROPERTY_RATING_VALUE'] ){
		$arFields['RATING'] = $arFields['PROPERTY_RATING_VALUE']/0.05;
	}
	$arFields["PREVIEW_TEXT"] = $obParser->html_cut($arFields["PREVIEW_TEXT"], 200);
	$arFields['PRICE'] = number_format($arFields['CATALOG_PRICE_1'], 0, ' ', ' ') . ' р.';
	$arFields["PICTURE"] = CFile::ResizeImageGet($arFields["PREVIEW_PICTURE"], array("width"=>60, "height"=>60), BX_RESIZE_IMAGE_PROPORTIONAL, true);
	$arFields['URL'] = $arFields['DETAIL_PAGE_URL'];
	$arNewElements[] = $arFields;

}

?>

<div class="bx_smart_searche bx_searche <?=$arResult["VISUAL_PARAMS"]["THEME_CLASS"]?>">
	<?
	if($arResult["DEBUG"]["SHOW"] == 'Y')
	{
		echo '<pre>';
			echo 'Query: '; print_r($arResult["DEBUG"]["QUERY"]); echo "\r\n";
			echo 'Type: '; print_r($arResult["DEBUG"]["TYPE"]); echo "\r\n";
			echo 'Mode: '; print_r($arResult["DEBUG"]["SMARTMODE"]); echo "\r\n";
			echo 'Max count: '; print_r($arResult["DEBUG"]["TOP_COUNT"] . ' / ' . $arParams["NUM_CATEGORIES"]); echo "\r\n";
			echo 'Q List: '; print_r($arResult["DEBUG"]["Q"]); echo "\r\n";
			echo 'Times: '; print_r($arResult["DEBUG"]["TIMES"]); echo "\r\n";
		echo '</pre>';
		
		if($arResult["DEBUG"]["OTHER"])
		{
			echo '<pre>'; print_r($arResult["DEBUG"]["OTHER"]); echo '</pre>';
		}
		
	}
	
	?>
	
	<?$countS = 0;?>
	<?if(!empty($arResult["CATEGORIES"])):?>
		
			<?foreach($arResult["CATEGORIES"] as $category_id => $arCategory):?>
				<?foreach($arCategory["ITEMS"] as $i => $arItem):?>
					<?if ( $countS < 3):?>
					<?if(isset($arResult["SECTIONS"][$arItem["ITEM_ID"]])):
					
						$countS++;
						$arElement = $arResult["SECTIONS"][$arItem["ITEM_ID"]];
						
						if(is_array($arElement["PICTURE"]))
							$image_url = $arElement["PICTURE"]["src"];
						else
							$image_url = '/bitrix/components/arturgolubev/search.title/templates/.default/images/noimg.png';
						?>
						<a class="js_search_href bx_item_block_href" href="<?echo $arItem["URL"]?>">
							<?if($preview):?>
								<span class="bx_item_block_item_image" style="background-image: url(<?=$image_url?>); <?=$image_style?>"></span>
							<?endif;?>
							
							<span class="bx_item_block_href_category_title"><?=($arElement["PATH"]) ? $arElement["PATH"] : GetMessage("AG_SMARTIK_SECTION_TITLE");?></span><br>
							<span class="bx_item_block_href_category_name"><?echo strip_tags($arItem["NAME"])?></span>
							<span class="bx_item_block_item_clear"></span>
						</a>
						<div class="bx_item_block_hrline"></div>
					<?endif;?>
					<?endif;?>
				<?endforeach;?>
			<?endforeach;?>
			
			
			<?/*
			<?$arNewElements = Array();?>
			<?foreach($arResult["CATEGORIES"] as $category_id => $arCategory):?>
				<?foreach($arCategory["ITEMS"] as $i => $arItem):?>
					<?if(isset($arResult["ELEMENTS"][$arItem["ITEM_ID"]])):
						$arElement = $arResult["ELEMENTS"][$arItem["ITEM_ID"]];
						$db_props = CIBlockElement::GetProperty(1, $arElement["ID"], array("sort" => "asc"), Array("CODE"=>"rating"));
						if($ar_props = $db_props->Fetch()){
							$ratingK = $ar_props["VALUE"];
							if ( $ratingK ){
								$rating = $ratingK /0.05;
							}
						}
						$db_props = CIBlockElement::GetProperty(1, $arElement["ID"], array("sort" => "asc"), Array("CODE"=>"SORTING"));
						if($ar_props = $db_props->Fetch()){
							$SORTING = $ar_props["VALUE"];
							
						}
						$index = $SORTING - $ratingK;
						$arItem["RATING"] = $rating;
						$arItem["SORT"] = $index;
						$arNewElements[] = $arItem;
						$arResult["ELEMENTS"][$arItem["ITEM_ID"]]["rating"] = $rating;
						?>		
					<?endif;?>
				<?endforeach;?>
			<?endforeach;?>
			*/?>
	
	<?/*
	<?if ( count($arElements) > 0 ):?>		
		<?		
		
		global $searchFilter;
		$searchFilter = array(
			"=ID" => $arElements,
		);
		
		$intSectionID = $APPLICATION->IncludeComponent(
			"salavey:catalog.section.inherited",
			"fast_search",
			array(
				"IBLOCK_TYPE" => "ibCatalog",
				"IBLOCK_ID" => \FCbit\Conf::FCbit_CATALOG_IBLOCK_ID,
				"ELEMENT_SORT_FIELD2" => "PROPERTY_rating",
				"ELEMENT_SORT_ORDER2" => 'desc',
				"ELEMENT_SORT_FIELD" => "PROPERTY_SORTING",
				"ELEMENT_SORT_ORDER" => "asc",
				"PROPERTY_CODE" => array(
					0 => "kalibr_mm",
					1 => "",
				),
				"META_KEYWORDS" => "-",
				"META_DESCRIPTION" => "-",
				"BROWSER_TITLE" => "-",
				"SET_LAST_MODIFIED" => "N",
				"INCLUDE_SUBSECTIONS" => "Y",
				"BASKET_URL" => "/personal/cart/",
				"ACTION_VARIABLE" => "action",
				"PRODUCT_ID_VARIABLE" => "id",
				"SECTION_ID_VARIABLE" => "SECTION_ID",
				"PRODUCT_QUANTITY_VARIABLE" => "",
				"PRODUCT_PROPS_VARIABLE" => "prop",
				"FILTER_NAME" => "searchFilter",
				"CACHE_TYPE" => "A",
				"CACHE_TIME" => "36000000",
				"CACHE_FILTER" => "Y",
				"CACHE_GROUPS" => "N",
				"SET_TITLE" => "N",
				"MESSAGE_404" => "",
				"SET_STATUS_404" => "N",
				"SHOW_404" => "N",
				"FILE_404" => "",
				"DISPLAY_COMPARE" => "Y",
				"PAGE_ELEMENT_COUNT" => "8",
				"LINE_ELEMENT_COUNT" => "3",
				"PRICE_CODE" => array(
					0 => "base",
				),
				"USE_PRICE_COUNT" => "N",
				"SHOW_PRICE_COUNT" => "1",
				"PRICE_VAT_INCLUDE" => "N",
				"USE_PRODUCT_QUANTITY" => "N",
				"ADD_PROPERTIES_TO_BASKET" => "N",
				"PARTIAL_PRODUCT_PROPERTIES" => "N",
				"PRODUCT_PROPERTIES" => array(),
				"DISPLAY_TOP_PAGER" => "N",
				"DISPLAY_BOTTOM_PAGER" => "Y",
				"PAGER_TITLE" => "Товары",
				"PAGER_SHOW_ALWAYS" => "N",
				"PAGER_TEMPLATE" => "lazyload",
				"PAGER_DESC_NUMBERING" => "N",
				"PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
				"PAGER_SHOW_ALL" => "N",
				"PAGER_BASE_LINK_ENABLE" => "N",
				"SECTION_ID" => "",
				"SECTION_CODE" => "",
				"USE_MAIN_ELEMENT_SECTION" => "N",
				"CONVERT_CURRENCY" => "N",
				"CURRENCY_ID" => $arParams["CURRENCY_ID"],
				"HIDE_NOT_AVAILABLE" => "L",
				"LABEL_PROP" => "-",
				"ADD_PICT_PROP" => "-",
				"PRODUCT_SUBSCRIPTION" => "N",
				"SHOW_DISCOUNT_PERCENT" => "N",
				"SHOW_OLD_PRICE" => "N",
				"MESS_BTN_BUY" => "Купить",
				"MESS_BTN_ADD_TO_BASKET" => "В корзину",
				"MESS_BTN_DETAIL" => "Подробнее",
				"MESS_NOT_AVAILABLE" => "Нет в наличии",
				"TEMPLATE_THEME" => "",
				"ADD_SECTIONS_CHAIN" => "Y",
				"ADD_TO_BASKET_ACTION" => "ADD",
				"SHOW_CLOSE_POPUP" => "N",
				"BACKGROUND_IMAGE" => "-",
				"DISABLE_INIT_JS_IN_COMPONENT" => "N",
				//"IN_BASKET" => $arBasketID,
				"COMPONENT_TEMPLATE" => "list",
				"SECTION_USER_FIELDS" => array(
					0 => "",
					1 => "",
				),
				"SHOW_ALL_WO_SECTION" => "Y",
				"MESS_BTN_COMPARE" => "Сравнить",
				"SEF_MODE" => "N",
				"AJAX_MODE" => "N",
				"AJAX_OPTION_JUMP" => "N",
				"AJAX_OPTION_STYLE" => "Y",
				"AJAX_OPTION_HISTORY" => "N",
				"AJAX_OPTION_ADDITIONAL" => "",
				"SET_BROWSER_TITLE" => "Y",
				"SET_META_KEYWORDS" => "Y",
				"SET_META_DESCRIPTION" => "Y",
				"OFFERS_LIMIT" => "1",
				"SECTION_URL" => "",
				"DETAIL_URL" => "",
				"COMPARE_PATH" => ""
			),
			false
		);?>		
	<?endif;?>		
	*/?>	
			
			
			<?$count = 0;?>
			<?//array_multisort($price, SORT_DESC, $inventory);?>
			<?//$arNewElements2 = array_msort($arNewElements, array('SORT'=>SORT_ASC));?>
			<?$i = 0;?>
			<?foreach($arNewElements as $arItem):?>
				<?if ( $i < $arParams["TOP_COUNT_ITOG"] ):?>
					<?
						$arElement = $arItem;
						
						$count++;
						$i++;
					
						$arElement["PREVIEW_TEXT"] = strip_tags($arElement["PREVIEW_TEXT"]);
					
						if(is_array($arElement["PICTURE"]))
							$image_url = $arElement["PICTURE"]["src"];
						else
							$image_url = '/bitrix/components/arturgolubev/search.title/templates/.default/images/noimg.png';
					?>
						
						<a class="js_search_href bx_item_block_href" href="<?echo $arItem["URL"]?>">
							<span class="bx_item_block_item_info">
								<?if($preview):?>
									<span class="bx_item_block_item_image" style="background-image: url(<?=$image_url?>); <?=$image_style?>"></span>
								<?endif;?>
								
								<span class="bx_item_block_item_info_wrap <?if($preview) echo 'wpic';?>"<?=$info_style?>>
									<?
									$oldPrice = 0;
									$db_props = CIBlockElement::GetProperty(1, $arElement["ID"], array("sort" => "asc"), Array("CODE"=>"oldprice"));
									if($ar_props = $db_props->Fetch()){
										$oldPrice = $ar_props["VALUE"];
									}

											if( $oldPrice > $arPrice["VALUE"]):?>
												<span class="bx_item_block_item_price">
													<span class="bx_price_new">
														<?=$arElement["PRICE"]?>
													</span>
													<span class="bx_price_old"><?=$oldPrice?> р.</span>
												</span>
											<?else:?>
												<span class="bx_item_block_item_price bx_item_block_item_price_only_one">
													<span class="bx_price_new"><?=$arElement["PRICE"]?></span>
												</span>
											<?endif;?>
										
									
									<span class="bx_item_block_item_name">
										<span class="bx_item_block_item_name_flex_align">
											<?echo $arItem["NAME"]?>
										</span>
										

									</span>
									<?if ( $arElement["RATING"] ):?>
										<span class="bx_item_block_item_props">
											<div class="newcat_reititng">
												<div class="new_reiting_bl set_reting_product_139229 product_reting" data-rating-product="139229">
													<div style="width: <?=$arElement["RATING"]?>%; overflow: hidden;" class="new_reiting_cont"></div>
												</div>
											</div>
										</span>
									<?endif;?>
									
									<?if(!empty($arElement["PROPS"])):?>
										<span class="bx_item_block_item_props">
											<?foreach($arElement["PROPS"] as $prop):
											if(empty($prop["VALUE"])) continue;
											?>
												<span class="bx_item_block_item_prop_item"><span class="bx_item_block_item_prop_item_name"><?=$prop["NAME"]?>:</span> <span class="bx_item_block_item_prop_item_value"><?=implode(', ', $prop["VALUE"])?></span></span>
											<?endforeach;?>
										</span>
									<?endif;?>
									
									<?if($arParams["SHOW_PREVIEW_TEXT"] == 'Y' && $arElement["PREVIEW_TEXT"]):?>
										<span class="bx_item_block_item_text"><?=$arElement["PREVIEW_TEXT"]?></span>
									<?endif;?>
								</span>
								<span class="bx_item_block_item_clear"></span>
							</span>
						</a>
						<div class="bx_item_block_hrline"></div>
				<?endif;?>
				
			<?endforeach;?>
			
			
			
			<?/*
			<?foreach($arResult["CATEGORIES"] as $category_id => $arCategory):?>
				<?foreach($arCategory["ITEMS"] as $i => $arItem):?>
					<?if(isset($arResult["ELEMENTS"][$arItem["ITEM_ID"]])):
						$arElement = $arResult["ELEMENTS"][$arItem["ITEM_ID"]];
						
						$count++;
					
					
						$arElement["PREVIEW_TEXT"] = strip_tags($arElement["PREVIEW_TEXT"]);
					
						if(is_array($arElement["PICTURE"]))
							$image_url = $arElement["PICTURE"]["src"];
						else
							$image_url = '/bitrix/components/arturgolubev/search.title/templates/.default/images/noimg.png';
					?>
						
						<a class="js_search_href bx_item_block_href" href="<?echo $arItem["URL"]?>">
							<span class="bx_item_block_item_info">
								<?if($preview):?>
									<span class="bx_item_block_item_image" style="background-image: url(<?=$image_url?>); <?=$image_style?>"></span>
								<?endif;?>
								
								<span class="bx_item_block_item_info_wrap <?if($preview) echo 'wpic';?>"<?=$info_style?>>
									<?
									$oldPrice = 0;
									$db_props = CIBlockElement::GetProperty(1, $arElement["ID"], array("sort" => "asc"), Array("CODE"=>"oldprice"));
									if($ar_props = $db_props->Fetch()){
										$oldPrice = $ar_props["VALUE"];
									}
									
									foreach($arElement["PRICES"] as $code=>$arPrice)
									{
										
										if ($arPrice["MIN_PRICE"] != "Y")
											continue;

										if($arPrice["CAN_ACCESS"])
										{
											if( $oldPrice > $arPrice["VALUE"]):?>
												<span class="bx_item_block_item_price">
													<span class="bx_price_new">
														<?=$arPrice["PRINT_VALUE"]?>
													</span>
													<span class="bx_price_old"><?=$oldPrice?> р.</span>
												</span>
											<?else:?>
												<span class="bx_item_block_item_price bx_item_block_item_price_only_one">
													<span class="bx_price_new"><?=$arPrice["PRINT_VALUE"]?></span>
												</span>
											<?endif;
										}
										if ($arPrice["MIN_PRICE"] == "Y")
											break;
									}
									?>
									
									<span class="bx_item_block_item_name">
										<span class="bx_item_block_item_name_flex_align">
											<?echo $arItem["NAME"]?>
										</span>
										

									</span>
									<?if ( $arElement["rating"] ):?>
										<span class="bx_item_block_item_props">
											<div class="newcat_reititng">
												<div class="new_reiting_bl set_reting_product_139229 product_reting" data-rating-product="139229">
													<div style="width: <?=$rating?>%; overflow: hidden;" class="new_reiting_cont"></div>
												</div>
											</div>
										</span>
									<?endif;?>
									
									<?if(!empty($arElement["PROPS"])):?>
										<span class="bx_item_block_item_props">
											<?foreach($arElement["PROPS"] as $prop):
											if(empty($prop["VALUE"])) continue;
											?>
												<span class="bx_item_block_item_prop_item"><span class="bx_item_block_item_prop_item_name"><?=$prop["NAME"]?>:</span> <span class="bx_item_block_item_prop_item_value"><?=implode(', ', $prop["VALUE"])?></span></span>
											<?endforeach;?>
										</span>
									<?endif;?>
									
									<?if($arParams["SHOW_PREVIEW_TEXT"] == 'Y' && $arElement["PREVIEW_TEXT"]):?>
										<span class="bx_item_block_item_text"><?=$arElement["PREVIEW_TEXT"]?></span>
									<?endif;?>
								</span>
								<span class="bx_item_block_item_clear"></span>
							</span>
						</a>
						<div class="bx_item_block_hrline"></div>
					<?endif;?>
				<?endforeach;?>
			<?endforeach;?>
			*/?>
			
			
			
			
			<?foreach($arResult["CATEGORIES"] as $category_id => $arCategory):?>
				<?foreach($arCategory["ITEMS"] as $i => $arItem):?>
					<?if($category_id === "all"):?>
						
					<?
					elseif(isset($arResult["ELEMENTS"][$arItem["ITEM_ID"]]) || isset($arResult["SECTIONS"][$arItem["ITEM_ID"]])):
						continue;
					else:?>
						<a class="js_search_href bx_item_block_href" href="<?echo $arItem["URL"]?>">
							<span class="bx_item_block_item_simple_name"><?echo $arItem["NAME"]?></span>
						</a>
					<?endif;?>
				<?endforeach;?>
			<?endforeach;?>
			<?if ( count($arElements) > 7 ):?>
				<div class="bx_item_block all_result js_search_href">
					<div class="bx_item_element bx_item_element_all_result js_search_href">
						<a class="js_search_href all_result_button" href="<?echo $arItem["URL"]?>">Все результаты</a>
					</div>
					<div style="clear:both;"></div>
				</div>
			<?endif;?>
			
			
	<?else:?>
		<div class="bx_smart_no_result_find">
			<?=GetMessage("AG_SMARTIK_NO_RESULT");?>
		</div>
	<?endif;?>
</div>

<?
function array_msort($array, $cols)
{
    $colarr = array();
    foreach ($cols as $col => $order) {
        $colarr[$col] = array();
        foreach ($array as $k => $row) { $colarr[$col]['_'.$k] = strtolower($row[$col]); }
    }
    $eval = 'array_multisort(';
    foreach ($cols as $col => $order) {
        $eval .= '$colarr[\''.$col.'\'],'.$order.',';
    }
    $eval = substr($eval,0,-1).');';
    eval($eval);
    $ret = array();
    foreach ($colarr as $col => $arr) {
        foreach ($arr as $k => $v) {
            $k = substr($k,1);
            if (!isset($ret[$k])) $ret[$k] = $array[$k];
            $ret[$k][$col] = $array[$k][$col];
        }
    }
    return $ret;

}
?>