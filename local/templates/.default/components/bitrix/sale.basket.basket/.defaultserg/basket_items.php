<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
/** @var array $arParams */
use Bitrix\Sale\DiscountCouponsManager;

//echo "<pre>";print_r($arResult);echo "</pre>";

if (!empty($arResult["ERROR_MESSAGE"]))
	ShowError($arResult["ERROR_MESSAGE"]);

$bDelayColumn  = false;
$bDeleteColumn = false;
$bWeightColumn = false;
$bPropsColumn  = false;
$bPriceType    = false;

if ($normalCount > 0):
?>
		<div>
			<div class="basket_page_left_col" id="basket_items">

				<?
				foreach ($arResult["GRID"]["ROWS"] as $k => $arItem):
                    $dataProp = array();
					if ($arItem["DELAY"] == "N" && $arItem["CAN_BUY"] == "Y"):
				    ?>

					<div class="new_basket_el" id="<?=$arItem["ID"]?>">

						<?
						foreach ($arResult["GRID"]["HEADERS"] as $id => $arHeader):

							if (in_array($arHeader["id"], array("PROPS", "DELAY", "DELETE", "TYPE"))) // some values are not shown in the columns in this template
								continue;

							if ($arHeader["name"] == '')
								$arHeader["name"] = GetMessage("SALE_".$arHeader["id"]);

							if ($arHeader["id"] == "NAME"):
							?>
								<div class="new_basket_el_left">
									<div class="new_basket_el_left_img">
										<div class="bx_ordercart_photo_container">
											<?
											if (strlen($arItem["PREVIEW_PICTURE_SRC"]) > 0):
												$url = $arItem["PREVIEW_PICTURE_SRC"];
											elseif (strlen($arItem["DETAIL_PICTURE_SRC"]) > 0):
												$url = $arItem["DETAIL_PICTURE_SRC"];
											else:
												$url = $templateFolder."/images/no_photo.png";
											endif;
											?>

											<?if (strlen($arItem["DETAIL_PAGE_URL"]) > 0):?><a href="<?=$arItem["DETAIL_PAGE_URL"] ?>"><?endif;?>
												<img class="bx_ordercart_photo" src="<?=$url?>" alt=""/>
											<?if (strlen($arItem["DETAIL_PAGE_URL"]) > 0):?></a><?endif;?>
										</div>
										<?
										if (!empty($arItem["BRAND"])):
										?>
										<div class="bx_ordercart_brand">
											<img alt="" src="<?=$arItem["BRAND"]?>" />
										</div>
										<?
										endif;
										?>
									</div>
									<div class="new_basket_el_left_title">
										<h2 class="bx_ordercart_itemtitle">
											<?if (strlen($arItem["DETAIL_PAGE_URL"]) > 0):?><a href="<?=$arItem["DETAIL_PAGE_URL"] ?>"><?endif;?>
												<?=$arItem["NAME"]?>
											<?if (strlen($arItem["DETAIL_PAGE_URL"]) > 0):?></a><?endif;?>
										</h2>
                                        <div class="block_props_basket">
                                            <?foreach ($arItem["PROPS"] as $infoProp):?>
                                                <?if (!preg_match("/^HIDE_/i",$infoProp["CODE"])):?>
                                                    <span><?=$infoProp["NAME"]?>:</span> <?=$infoProp["VALUE"]?><br />
                                                <?else:?>
                                                    <?$dataProp[$infoProp["CODE"]] = $infoProp?>
                                                <?endif;?>
                                            <?endforeach;?>
                                        </div>
									</div>
								</div>
								<div class="new_basket_el_right">
									<div class="bx_ordercart_itemart">
										<?
										if ($bPropsColumn):
											foreach ($arItem["PROPS"] as $val):

												if (is_array($arItem["SKU_DATA"]))
												{
													$bSkip = false;
													foreach ($arItem["SKU_DATA"] as $propId => $arProp)
													{
														if ($arProp["CODE"] == $val["CODE"])
														{
															$bSkip = true;
															break;
														}
													}
													if ($bSkip)
														continue;
												}

												echo $val["NAME"].":&nbsp;<span>".$val["VALUE"]."<span><br/>";
											endforeach;
										endif;
										?>
									</div>
									<?
									if (is_array($arItem["SKU_DATA"]) && !empty($arItem["SKU_DATA"])):
										foreach ($arItem["SKU_DATA"] as $propId => $arProp):

											// if property contains images or values
											$isImgProperty = false;
											if (!empty($arProp["VALUES"]) && is_array($arProp["VALUES"]))
											{
												foreach ($arProp["VALUES"] as $id => $arVal)
												{
													if (!empty($arVal["PICT"]) && is_array($arVal["PICT"])
														&& !empty($arVal["PICT"]['SRC']))
													{
														$isImgProperty = true;
														break;
													}
												}
											}
											$countValues = count($arProp["VALUES"]);
											$full = ($countValues > 5) ? "full" : "";

											if ($isImgProperty): // iblock element relation property
											?>
												<div class="bx_item_detail_scu_small_noadaptive <?=$full?>">

													<span class="bx_item_section_name_gray">
														<?=$arProp["NAME"]?>:
													</span>

													<div class="bx_scu_scroller_container">

														<div class="bx_scu">
															<ul id="prop_<?=$arProp["CODE"]?>_<?=$arItem["ID"]?>"
																style="width: 200%; margin-left:0;"
																class="sku_prop_list"
																>
																<?
																foreach ($arProp["VALUES"] as $valueId => $arSkuValue):

																	$selected = "";
																	foreach ($arItem["PROPS"] as $arItemProp):
																		if ($arItemProp["CODE"] == $arItem["SKU_DATA"][$propId]["CODE"])
																		{
																			if ($arItemProp["VALUE"] == $arSkuValue["NAME"] || $arItemProp["VALUE"] == $arSkuValue["XML_ID"])
																				$selected = " bx_active";
																		}
																	endforeach;
																?>
																	<li style="width:10%;"
																		class="sku_prop<?=$selected?>"
																		data-value-id="<?=$arSkuValue["XML_ID"]?>"
																		data-element="<?=$arItem["ID"]?>"
																		data-property="<?=$arProp["CODE"]?>"
																		>
																		<a href="javascript:void(0)" class="cnt"><span class="cnt_item" style="background-image:url(<?=$arSkuValue["PICT"]["SRC"];?>)"></span></a>
																	</li>
																<?
																endforeach;
																?>
															</ul>
														</div>

														<div class="bx_slide_left" onclick="leftScroll('<?=$arProp["CODE"]?>', <?=$arItem["ID"]?>, <?=$countValues?>);"></div>
														<div class="bx_slide_right" onclick="rightScroll('<?=$arProp["CODE"]?>', <?=$arItem["ID"]?>, <?=$countValues?>);"></div>
													</div>

												</div>
											<?
											else:
											?>
												<div class="bx_item_detail_size_small_noadaptive <?=$full?>">

													<span class="bx_item_section_name_gray">
														<?=$arProp["NAME"]?>:
													</span>

													<div class="bx_size_scroller_container">
														<div class="bx_size">
															<ul id="prop_<?=$arProp["CODE"]?>_<?=$arItem["ID"]?>"
																style="width: 200%; margin-left:0;"
																class="sku_prop_list"
																>
																<?
																foreach ($arProp["VALUES"] as $valueId => $arSkuValue):

																	$selected = "";
																	foreach ($arItem["PROPS"] as $arItemProp):
																		if ($arItemProp["CODE"] == $arItem["SKU_DATA"][$propId]["CODE"])
																		{
																			if ($arItemProp["VALUE"] == $arSkuValue["NAME"])
																				$selected = " bx_active";
																		}
																	endforeach;
																?>
																	<li style="width:10%;"
																		class="sku_prop<?=$selected?>"
																		data-value-id="<?=($arProp['TYPE'] == 'S' && $arProp['USER_TYPE'] == 'directory' ? $arSkuValue['XML_ID'] : $arSkuValue['NAME']); ?>"
																		data-element="<?=$arItem["ID"]?>"
																		data-property="<?=$arProp["CODE"]?>"
																		>
																		<a href="javascript:void(0)" class="cnt"><?=$arSkuValue["NAME"]?></a>
																	</li>
																<?
																endforeach;
																?>
															</ul>
														</div>
														<div class="bx_slide_left" onclick="leftScroll('<?=$arProp["CODE"]?>', <?=$arItem["ID"]?>, <?=$countValues?>);"></div>
														<div class="bx_slide_right" onclick="rightScroll('<?=$arProp["CODE"]?>', <?=$arItem["ID"]?>, <?=$countValues?>);"></div>
													</div>

												</div>
											<?
											endif;
										endforeach;
									endif;
									?>

							<?
							elseif ($arHeader["id"] == "QUANTITY"):
							?>

									<?/*<span><?=$arHeader["name"]; ?>:</span>*/?>
									<?/*<div class="centered counter">*/?>


												<div class="basket_quantity_control_block">
													<?
													$ratio = isset($arItem["MEASURE_RATIO"]) ? $arItem["MEASURE_RATIO"] : 0;
													$max = isset($arItem["AVAILABLE_QUANTITY"]) ? "max=\"".$arItem["AVAILABLE_QUANTITY"]."\"" : "";
													$useFloatQuantity = ($arParams["QUANTITY_FLOAT"] == "Y") ? true : false;
													$useFloatQuantityJS = ($useFloatQuantity ? "true" : "false");
													?>
													<input
														type="text"
														size="3"
														id="QUANTITY_INPUT_<?=$arItem["ID"]?>"
														name="QUANTITY_INPUT_<?=$arItem["ID"]?>"
														size="2"
														maxlength="18"
														min="0"
														<?=$max?>
														step="<?=$ratio?>"
														data-id="<?=$arItem["ID"]?>"
														data-quantity="<?=$arItem["QUANTITY"]?>"
														style="max-width: 50px"
														value="<?=$arItem["QUANTITY"]?>"
													>
												<?
												if (!isset($arItem["MEASURE_RATIO"]))
												{
													$arItem["MEASURE_RATIO"] = 1;
												}

												if (
													floatval($arItem["MEASURE_RATIO"]) != 0
												):
												?>


													<div id="basket_quantity_control">
														<div class="basket_quantity_control">
															<a href="javascript:void(0);" class="plus" data-id="<?=$arItem["ID"]?>" data-quantity="<?=$arItem["QUANTITY"]?>"></a>
															<a href="javascript:void(0);" class="minus" data-id="<?=$arItem["ID"]?>" data-quantity="<?=$arItem["QUANTITY"]?>"></a>
														</div>
													</div>
												<?
												endif;?>
												</div>
												<a class="basket_page_del" href="<?=str_replace("#ID#", $arItem["ID"], $arUrls["delete"])?>">Удалить</a>
												<?if (isset($arItem["MEASURE_TEXT"]))
												{
													?>
														<?/*<div style="text-align: left"><?=$arItem["MEASURE_TEXT"]?></div>*/?>
													<?
												}
												?>

									<?/*</div>*/?>
									<input type="hidden" id="QUANTITY_<?=$arItem['ID']?>" name="QUANTITY_<?=$arItem['ID']?>" value="<?=$arItem["QUANTITY"]?>" />

							<?
							elseif ($arHeader["id"] == "PRICE"):
							?>

										<div class="current_price" id="current_price_<?=$arItem["ID"]?>">
											<div class="current_price_small_title">Цена</div>
											<div class="current_price_black"><?=$arItem["PRICE_FORMATED"]?></div>
										</div>
										<div class="old_price" id="old_price_<?=$arItem["ID"]?>">
                                            <?if (!empty($dataProp["HIDE_OLD_PRICE"]) && (floatval($dataProp["HIDE_OLD_PRICE"]["VALUE"]) > floatval($arItem["PRICE"]))):?>
                                                <s><?=$dataProp["HIDE_OLD_PRICE"]["VALUE"]?> р.</s>
                                            <?else:?>
                                                <?if (floatval($arItem["BASE_PRICE"]) > floatval($arItem["PRICE"])):?>
                                                    <s><?=$arItem["FULL_PRICE_FORMATED"]?></s>
                                                <?endif;?>
                                            <?endif;?>
										</div>

									<?if ($bPriceType && strlen($arItem["NOTES"]) > 0):?>
										<div class="type_price"><?=GetMessage("SALE_TYPE")?></div>
										<div class="type_price_value"><?=$arItem["NOTES"]?></div>
									<?endif;?>

							<?
							elseif ($arHeader["id"] == "DISCOUNT"):
							?>

									<?/*<span><?=$arHeader["name"]; ?>:</span>
									<div id="discount_value_<?=$arItem["ID"]?>"><?=$arItem["DISCOUNT_PRICE_PERCENT_FORMATED"]?></div>*/?>

							<?
							elseif ($arHeader["id"] == "WEIGHT"):
							?>

									<?/*<span><?=$arHeader["name"]; ?>:</span>
									<?=$arItem["WEIGHT_FORMATED"]?>*/?>

							<?
							else:
							?>

									<?/*<span><?=$arHeader["name"]; ?>:</span>*/?>
									<?
									if ($arHeader["id"] == "SUM"):
									?>
										<div id="sum_<?=$arItem["ID"]?>">
									<?
									endif;

									//echo $arItem[$arHeader["id"]];

									if ($arHeader["id"] == "SUM"):
									?>
										</div>
									<?
									endif;
									?>

							<?
							endif;
						endforeach;

						if ($bDelayColumn || $bDeleteColumn):
						?>

								<?
								if ($bDeleteColumn):
								?>
									<a href="<?=str_replace("#ID#", $arItem["ID"], $arUrls["delete"])?>"><?=GetMessage("SALE_DELETE")?></a><br />
								<?
								endif;
								if ($bDelayColumn):
								?>
									<a href="<?=str_replace("#ID#", $arItem["ID"], $arUrls["delay"])?>"><?=GetMessage("SALE_DELAY")?></a>
								<?endif;?>
						<?endif;?>
					</div></div>
					<?endif;?>
				<?endforeach;?>

				<input type="hidden" id="column_headers" value="<?=CUtil::JSEscape(implode($arHeaders, ","))?>" />
				<input type="hidden" id="offers_props" value="<?=CUtil::JSEscape(implode($arParams["OFFERS_PROPS"], ","))?>" />
				<input type="hidden" id="action_var" value="<?=CUtil::JSEscape($arParams["ACTION_VARIABLE"])?>" />
				<input type="hidden" id="quantity_float" value="<?=$arParams["QUANTITY_FLOAT"]?>" />
				<input type="hidden" id="count_discount_4_all_quantity" value="<?=($arParams["COUNT_DISCOUNT_4_ALL_QUANTITY"] == "Y") ? "Y" : "N"?>" />
				<input type="hidden" id="price_vat_show_value" value="<?=($arParams["PRICE_VAT_SHOW_VALUE"] == "Y") ? "Y" : "N"?>" />
				<input type="hidden" id="hide_coupon" value="<?=($arParams["HIDE_COUPON"] == "Y") ? "Y" : "N"?>" />
				<input type="hidden" id="use_prepayment" value="<?=($arParams["USE_PREPAYMENT"] == "Y") ? "Y" : "N"?>" />
				<input type="hidden" id="auto_calculation" value="<?=($arParams["AUTO_CALCULATION"] == "N") ? "N" : "Y"?>" />
                <div class="bx_ordercart_order_pay_left" id="coupons_block">
                    <?
                    if ($arParams["HIDE_COUPON"] != "Y")
                    {
                        ?>
                        <div class="bx_ordercart_coupon">
                        <span style="color: black"><?=GetMessage("STB_COUPON_PROMT")?></span><input type="text" id="coupon" name="COUPON" value="" />&nbsp;<a style="min-width: auto" class="bx_bt_button red_button" id="coupon_button" <?/*href="javascript:void(0)" onclick="enterCoupon();"*/?> title="<?=GetMessage('SALE_COUPON_APPLY_TITLE'); ?>"><?=GetMessage('SALE_COUPON_APPLY'); ?></a>
                        </div><?
                        if (!empty($arResult['COUPON_LIST']))
                        {
                            foreach ($arResult['COUPON_LIST'] as $oneCoupon)
                            {
                                $couponClass = 'disabled';
                                switch ($oneCoupon['STATUS'])
                                {
                                    case DiscountCouponsManager::STATUS_NOT_FOUND:
                                    case DiscountCouponsManager::STATUS_FREEZE:
                                        $couponClass = 'bad';
                                        break;
                                    case DiscountCouponsManager::STATUS_APPLYED:
                                        $couponClass = 'good';
                                        break;
                                }
                                ?><div class="bx_ordercart_coupon hidecoupon"><input disabled readonly type="text" name="OLD_COUPON[]" value="<?=htmlspecialcharsbx($oneCoupon['COUPON']);?>" class="<? echo $couponClass; ?>"><span id="close_coupon" class="<? echo $couponClass; ?>" data-coupon="<? echo htmlspecialcharsbx($oneCoupon['COUPON']); ?>"></span><div class="bx_ordercart_coupon_notes"><?
                                    if (isset($oneCoupon['CHECK_CODE_TEXT']))
                                    {
                                        echo (is_array($oneCoupon['CHECK_CODE_TEXT']) ? implode('<br>', $oneCoupon['CHECK_CODE_TEXT']) : $oneCoupon['CHECK_CODE_TEXT']);
                                    }
                                    ?></div></div><?
                            }
                            unset($couponClass, $oneCoupon);
                        }
                    }
                    else
                    {
                        ?>&nbsp;<?
                    }
                    ?>
                </div>
			</div>
			<div class="basket_page_right_col">
				<div class="basket_page_itog_block js_new_form_lk_gray_bg default">
					<?if ($bWeightColumn && floatval($arResult['allWeight']) > 0):?>
						<div class="basket_page_itog_el">
							<div class="basket_page_itog_el_name"><?=GetMessage("SALE_TOTAL_WEIGHT")?></div>
							<div class="basket_page_itog_el_param"><?=$arResult["allWeight_FORMATED"]?></div>
						</div>
					<?endif;?>
					<?if ($arParams["PRICE_VAT_SHOW_VALUE"] == "Y"):?>
						<div class="basket_page_itog_el">
							<div class="basket_page_itog_el_name"><?=GetMessage("SALE_VAT_EXCLUDED")?></div>
							<div class="basket_page_itog_el_param" id="allSum_wVAT_FORMATED"><?=$arResult["allSum_wVAT_FORMATED"]?></div>
						</div>
						<?if (floatval($arResult["DISCOUNT_PRICE_ALL"]) > 0):?>
							<div class="basket_page_itog_el">
								<div class="basket_page_itog_el_name"></div>
								<div class="basket_page_itog_el_param"><?=$arResult["PRICE_WITHOUT_DISCOUNT"]?></div>
							</div>
						<?endif;?>
						<?if (floatval($arResult['allVATSum']) > 0):?>
							<div class="basket_page_itog_el">
								<div class="basket_page_itog_el_name"><?echo GetMessage('SALE_VAT')?></div>
								<div class="basket_page_itog_el_param"><?=$arResult["allVATSum_FORMATED"]?></div>
							</div>
						<?endif;?>
					<?endif;?>
					<div class="basket_page_itog_el">
						<div class="basket_page_itog_el_name"><?echo GetMessage('SALE_TOTAL')?></div>
						<div class="basket_page_itog_el_param" id="allSum_FORMATED"><?=str_replace(" ", "&nbsp;", $arResult["allSum_FORMATED"])?></div>
					</div>
					<a href="/personal/order/" <?/*onclick="checkOut();"*/?> class="checkout red_button"><?=GetMessage("SALE_ORDER")?></a>
					<a class="basket_gray_button fancy_ajax_click_buy_busket" href="/include/popup_click_buy.php">Оформить в 1 клик</a>
				</div>
			</div>
			<div class="clear"></div>
		</div>
<?else:?>
<div id="basket_items_list">
	<table>
		<tbody>
			<tr>
				<td style="text-align:center">
					<div class=""><?=GetMessage("SALE_NO_ITEMS");?></div>
				</td>
			</tr>
		</tbody>
	</table>
</div>
<?endif;?>
<script type="text/javascript">
	$(document).ready(function() {
		$("body").on("click", "#coupon_button", function() {
			if ($("#coupon").val().length > 0) {
				var coupon = $("#coupon").val();
				window.location.replace("/personal/cart/?cupon="+coupon+"");
			}
		});

		$("body").on("click", "#close_coupon", function() {		
			$(".hidecoupon").hide();
		});
	});
</script>