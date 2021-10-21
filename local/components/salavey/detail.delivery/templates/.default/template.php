<?
if(!defined("B_PROLOG_INCLUDED")||B_PROLOG_INCLUDED!==true)die();
/**
 * Bitrix vars
 *
 * @var array $arParams
 * @var array $arResult
 * @var CBitrixComponentTemplate $this
 * @global CMain $APPLICATION
 * @global CUser $USER
 */
?>
<?
/*foreach($arResult['STORE'] as $arDelivery):
	echo "<pre>";print_r($arDelivery);echo "</pre>";
endforeach;*/
$arPayment = !empty($arResult["DELIVERY"]["PROPS"]["PAYMENT"]["~VALUE"]["TEXT"]) ? $arResult["DELIVERY"]["PROPS"]["PAYMENT"]["~VALUE"]["TEXT"] : $arResult["DELIVERY"]["PROPS"]["PAYMENT"]["~DEFAULT_VALUE"]["TEXT"];
?>
<a class="display_none_c display_none_p mobile_text_el_button js_mobile_text_el_button zabrat_dostavit" href="">забрать / доставить</a>
<div class="js_mobile_text_el_light">
	<div class="js_detail_double_section detail_double_section">
		<ul class="not_style js_detail_double_tabs detail_double_tabs">
			<li class="current" id="store_list">ЗАБРАТЬ</li>
            <li id="deliv_list">ДОСТАВИТЬ</li>
            <?if(!empty($arPayment)):?>
			    <li id="payment_list">ОПЛАТИТЬ</li>
            <?endif;?>
		</ul>
		<div class="detail_double_box js_detail_double_box" style="display:block;">
			<div>
				<div class="js_detail_section_adres detail_section_adres">
					<ul class="not_style detail_tabs_adres js_detail_tabs_adres display_none_m">
						<li class="current"><span class="detail_adres_list">Показать списком</span></li>
                        <?$iCount = 0;
                        $S_Center = 0;
                        $N_Center = 0;
                        ?>
                        <?foreach($arResult['STORE'] as $arStore):?>
                            <?
                            if ($arStore['GPS_S']>0 && $arStore['GPS_N']>0) {
                                $iCount++;
                                $S_Center += $arStore['GPS_S'];
                                $N_Center += $arStore['GPS_N'];
                            }
                            ?>
                        <?endforeach;?>
                        <?if ($S_Center*$N_Center):?>
						    <li><span class="detail_adres_map" onclick="setTimeout(showMap, 500);">Показать на карте</span></li>
                        <?endif;?>
					</ul>
					<div class="js_detail_box_adres detail_box_adres" style="display:block;">
						<div class="detail_table_list_shop_block">
                            <style>
                                .hide{
                                    display: none;
                                }
                            </style>
                            <script>
                                function showIndergraudStorege($id,$_this) {
                                    $(".map_undergraund").addClass("hide");
                                    $($_this).attr("onclick",'hideIndergraudStorege('+$id+',this)');
                                    $($_this).text("Скрыть карту метро");
                                    $(".map_undergraund[data-storage="+$id+"]").removeClass("hide");
                                }
                                function hideIndergraudStorege($id,$_this) {
                                    $(".map_undergraund").addClass("hide");
                                    $($_this).attr("onclick",'showIndergraudStorege('+$id+',this)');
                                    $($_this).text("Показать карту метро");
                                    $(".map_undergraund[data-storage="+$id+"]").addClass("hide");
                                }
                                function selectPunctVidachi($id,$loc) {
                                    $("#button_buy_product").click();
                                    setTimeout(function(){window.location.href = "http://test.diada-arms.ru/personal/order/"},300);
                                }
                            </script>
							<table class="detail_table_list_shop">
								<tr class="display_none_m">
									<th>Магазин</th>
									<th>Стоимость услуги</th>
									<th>Режим работы</th>
									<th></th>
								</tr>
								<?foreach($arResult['STORE'] as $arStore):?>
                                    <tr>
                                        <td>
                                            <span <?if ($arStore["UF_IMG_UNDERGRAUND"]):?>style='background: url("<?=CFile::GetPath($arStore["UF_IMG_UNDERGRAUND"])?>") left 4px no-repeat; background-size: 13px;' class="detail_table_list_shop_metro"<?endif;?>></span>
                                            <?=trim($arStore['ADDRESS'])?>
                                        </td>
                                        <td><span class="display_none_c display_none_p display_none_mp">
                                            <span class="bold">Стоимость услуги:</span> </span>
                                            <?echo ($arStore['UF_PRICE']) ? $arStore['UF_PRICE']." руб." : "Бесплатно" ?>
                                        </td>
                                        <td><span class="display_none_c display_none_p display_none_mp"> <span class="bold">Режим работы:</span> </span><?=$arStore['SCHEDULE']?></td>
                                        <td><?/*<a class="detail_red_button" href="javascript:void(0);" onclick="selectPunctVidachi(<?=$arStore["ID"]?>,<?=$arParams['LOCATION_ID']?>)">ВЫБРАТЬ</a>*/?></td>
                                    </tr>
								<?endforeach;?>
							</table>
						</div>
					</div>
					<div class="js_detail_box_adres detail_box_adres">
						<div id="YMapsID" style="width:925px;height:650px"></div>
                        <?if ($S_Center*$N_Center):?>
						<script type="text/javascript">
						    // Создает обработчик события window.onLoad
						    function showMap()
						    {
						        // Создает экземпляр карты и привязывает его к созданному контейнеру
						        var map = new YMaps.Map($("#YMapsID")[0],{controls: ["zoomControl"]});
                                map.addControl(new YMaps.Zoom());
						        // Устанавливает начальные параметры отображения карты: центр карты и коэффициент масштабирования
                                <?$mapSize = 10;
                                if ($arResult["DELIVERY"]["PROPS"]["SIZE_MAP"]["VALUE"]>0 && $arResult["DELIVERY"]["PROPS"]["SIZE_MAP"]["VALUE"]<=16){
                                    $mapSize = round($arResult["DELIVERY"]["PROPS"]["SIZE_MAP"]["VALUE"]);
                                }?>
						        map.setCenter(new YMaps.GeoPoint(<?=$S_Center/$iCount?>,<?=$N_Center/$iCount?>), <?=$mapSize?>);

								<?foreach($arResult['STORE'] as $arStore):?>
                                    <?if (($arStore['GPS_S']>0 && $arStore['GPS_N']>0) == FALSE) continue;?>
                                    <?if ($arStore['GPS_S'] && $arStore['GPS_N']):?>
                                        var placemark = new YMaps.Placemark(new YMaps.GeoPoint(<?=$arStore['GPS_S']?>,<?=$arStore['GPS_N']?>));
                                        placemark.name = '<?=$arStore['TITLE']?>';
                                        placemark.description = '<?=trim($arStore['ADDRESS'])?>';
                                        map.addOverlay(placemark);
									<?endif;?>
								<?endforeach;?>
						    }
						</script>
                        <?endif;?>
					</div>
				</div>
			</div>
		</div>
		<div class="detail_double_box js_detail_double_box">
            <div class="box dostavka_box_block" style="display:block;">
                <?$arResult["DELIVERY"]['PREVIEW_TEXT'] = str_replace("/images/contacts/dostavka_big_img.png", "/img/dostavka_big_img.png", $arResult["DELIVERY"]['PREVIEW_TEXT']);?>
                <?$arResult["DELIVERY"]['PREVIEW_TEXT'] = str_replace('src="/img/dostavka_big_img.png"', 'data-src="/img/dostavka_big_img.png"', $arResult["DELIVERY"]['PREVIEW_TEXT']);?>
                <?=$arResult["DELIVERY"]['PREVIEW_TEXT']?>
            </div>
		</div>
        <?if(!empty($arPayment)):?>
            <div class="detail_double_box js_detail_double_box" style="display: block;">
				 <?$APPLICATION->IncludeComponent(
                        "bitrix:main.include",
                         "",
                        Array(
                            "AREA_FILE_SHOW" => "file",
                            "AREA_FILE_SUFFIX" => "inc",
                            "EDIT_TEMPLATE" => "",
                            "PATH" => "/include/inc_delivery_detail.php"
                        )
                );?>
				
                <?//=$arPayment?>
            </div>
        <?endif;?>
	</div>
</div>