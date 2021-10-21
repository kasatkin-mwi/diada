<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
/** @var array $arParams */
/** @var array $arResult */
/** @global CMain $APPLICATION */
/** @global CUser $USER */
/** @global CDatabase $DB */
/** @var CBitrixComponentTemplate $this */
/** @var string $templateName */
/** @var string $templateFile */
/** @var string $templateFolder */
/** @var string $componentPath */
/** @var CBitrixComponent $component */
$this->setFrameMode(true);

$strElementEdit = CIBlock::GetArrayByID($arParams["IBLOCK_ID"], "ELEMENT_EDIT");
$strElementDelete = CIBlock::GetArrayByID($arParams["IBLOCK_ID"], "ELEMENT_DELETE");
$arElementDeleteParams = array("CONFIRM" => GetMessage('CT_BCS_TPL_ELEMENT_DELETE_CONFIRM'));
?>
<div class="catalog_list">
<!--RestartBuffer-->
<?
$fileNoImg = CFile::GetList(array(),array("MODULE_ID" => "service_salavey", "ORIGINAL_NAME" => "no_photo_diada.jpg"))->GetNext();
$resizeImgNoPhoto = CFile::ResizeImageGet($fileNoImg['ID'], array("width" => 400, "height" => 800))["src"];
foreach ($arResult['PRICES_WITH_DISCOUNT'] as $key => $discount):
$arItem = $arResult['ITEMS'][$key];
//foreach ($arResult['ITEMS'] as $key => $arItem):
    $templateData["LIST_ITEMS"][] = $arItem['ID'];
	$this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], $strElementEdit);
	$this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], $strElementDelete, $arElementDeleteParams);
	$strMainID = $this->GetEditAreaId($arItem['ID']);
    if ($arItem['~PREVIEW_PICTURE']>0) {
        $resizeImg = CFile::ResizeImageGet($arItem['~PREVIEW_PICTURE'], array("width" => 400, "height" => 500))["src"];
    }
    elseif ($arItem['~DETAIL_PICTURE']>0){
        $resizeImg = CFile::ResizeImageGet($arItem['~DETAIL_PICTURE'], array("width" => 400, "height" => 500))["src"];
    }
    if (strlen($resizeImg) == 0){
        $resizeImg = $resizeImgNoPhoto;
    }
	?>
	<div class="cat_tb_el" id="<?=$strMainID;?>">
		<div class="cat_tb_el_l">
			<div class="cat_status_list">
				<?if (($arItem['PROPERTIES']['BLACK_FRIDAY']['VALUE'] == "Y") && (Salavey::CheckDateBF() == 'Y')):?><div class="cat_status_el black">Black Friday</div><?endif?>
				<?if ($arItem['PROPERTIES']['SALE']['VALUE']=='Y'):?><div class="cat_status_el sale">SALE</div><?endif?>
				<?if ($arItem['PROPERTIES']['HIT']['VALUE']=='Y'):?><div class="cat_status_el hit">ХИТ</div><?endif?>
				<?if ($arItem['PROPERTIES']['NEW']['VALUE']=='Y'):?><div class="cat_status_el new">NEW</div><?endif?>
				<?if ($arItem['PROPERTIES']['SUPER']['VALUE']=='Y'):?><div class="cat_status_el viol">Выгода</div><?endif?>
			</div>
			<div class="cat_tb_ic">
				<a href="<?=$arItem['DETAIL_PAGE_URL']?>">
					<?/*if (strlen($resizeImg)>0):?>
						<span class="one">
							<img src="<?=$resizeImg?>">
						</span>
					<?endif;*/?>
					<?
					if(!empty($arItem['SECOND_PICTURE']))
					{
					    ?>
					    <span class="one">
					        <img src="<?=$resizeImg?>">
					    </span>
					    <span class="two">
					        <img src="<?=$arItem['SECOND_PICTURE']['src']?>">
					    </span>
					    <?    
					}
					else
					{
					    if (strlen($resizeImg) > 0)
					    {
					        ?>
					        <span class="one">
					        	<img src="<?=$resizeImg?>">
					        </span>
					        <?    
					    }    
					}
					?>
					<!-- <span class="one">
						<img src="/upload/resize_cache/iblock/7dc/400_500_1/pnevmaticheskaya-vintovka-edgun-leshiy-5_5-mm.jpg">
					</span>
					<span class="two">
						<img src="/img/help_form_ic.png">
					</span> -->
				</a>
			</div>
		</div>
		<div class="cat_tb_el_c">
			<div class="cat_tb_tit"><a href="<?=$arItem['DETAIL_PAGE_URL']?>"><?=$arItem['NAME']?></a></div>
			<div class="cat_tb_reititng">
				<div class="new_reiting_bl set_reting_product_<?=$arItem["ID"]?> product_reting" data-rating-product="<?=$arItem["ID"]?>">
					<div style="width: 100%; overflow: hidden;" class="new_reiting_cont"></div>
				</div>
			</div>
			<div class="cat_tb_option_bl">
                
				<?foreach( explode("<br>", strip_tags($arItem["PREVIEW_TEXT"], '<br>')) as $str ):
					$str = str_replace("&nbsp;", "", $str);
					$arStr = explode(":", $str);?>
					<?if($arStr[1]):?>
						<div class="cat_tb_option_el">
							<div class="cat_tb_option_l"><?=trim($arStr[0])?></div>
							<div class="cat_tb_option_r"><?=trim($arStr[1])?></div>
						</div>
					<?endif?>
				<?endforeach;?>
			</div>
			<div class="cat_tb_stock_bl">
				<?$arInd = Array("est"=>"Есть в наличии", "net"=>"Нет в наличии", "sklad"=>"Есть в наличии на складе", "snyato"=>"Снято с производства", "zakaz" => "Под заказ");?>
				<?$indikator = strtolower($arItem['PROPERTIES']['INDIKATOR']['VALUE_XML_ID'])?>
				<?if ($indikator):?>
                    <?$alt = $arItem['PROPERTIES']['INDIKATOR']['VALUE'];?>
                    <div class="nal_<?=$indikator?>"><?=$arInd[ $indikator ]?></div>
                <?elseif (in_array($arResult['SECTION']['PATH'][0]['ID'], Array(221,230,187,258,188,197))):?>
                    <div class="nal_est">Есть в наличии на складе</div>
                <?endif;?>
				
				<?
				global $USER;
				if ($USER->IsAdmin()):?>
					<br><br>
					<p>Склад Автозаводcкая - <?=$arItem['CATALOG_QUANTITY']?> шт.</p>
				
				<?endif;?>
				
			</div>
		</div>
		<div class="cat_tb_el_r">
			<div id="money_element_<?=$arItem["ID"]?>" class="cat_tb_price">
				<?$frame = $this->createFrame("money_element_".$arItem["ID"], false)->begin();?>
				    <?
                    if(!empty($arItem['CUSTOM_PRICE']))
                    {
                        if($arItem['CUSTOM_DISCOUNT_PRICE'] < $arItem['CUSTOM_PRICE'])
                        {
                            ?>
                            <div class="new"><?=number_format($arItem["CUSTOM_DISCOUNT_PRICE"], 0, '.', ' ');?> <i class="fa fa-rub" aria-hidden="true"></i></div>
                            <div class="old"><?=number_format($arItem["CUSTOM_PRICE"], 0, '.', ' ')?> <i class="fa fa-rub" aria-hidden="true"></i></div>
                            <?    
                        }
                        else
                        {
                            ?>
                            <div class="new"><?=number_format($arItem["CUSTOM_PRICE"], 0, '.', ' ')?> <i class="fa fa-rub" aria-hidden="true"></i></div>
                            <?
                        }
                    }
                    else
                    {   
                        ?>
						<?/*
                        <?foreach($arItem["PRICES"] as $code=>$arPrice):?>
				            <?if($arPrice["DISCOUNT_VALUE"] < $arPrice["VALUE"]):?>
					            <div class="new"><?=number_format($arPrice["DISCOUNT_VALUE"], 0, '.', ' ');?> <i class="fa fa-rub" aria-hidden="true"></i></div>
					            <div class="old"><?=number_format($arPrice["VALUE"], 0, '.', ' ');?> <i class="fa fa-rub" aria-hidden="true"></i></div>
					            <span style="display: none;" class="price-value-num"><?=$arPrice["DISCOUNT_VALUE"]?></span>
				            <?else:?>
					            <div class="new"><?=number_format($arPrice["VALUE"], 0, '.', ' ');?> <i class="fa fa-rub" aria-hidden="true"></i></div>
					            <span style="display: none;" class="price-value-num"><?=number_format($arPrice["VALUE"], 0, '.', ' ');?></span>
				            <?endif?>
				        <?endforeach;?>
						*/?>
						 <?foreach($arItem["PRICES"] as $code=>$arPrice):?>
                                <?if( $arItem['PROPERTIES']['oldprice']['VALUE'] ):?>
                                    <div class="new"><?=number_format($arPrice["DISCOUNT_VALUE"], 0, '.', ' ');?> <i class="fa fa-rub" aria-hidden="true"></i></div>
                                    <div class="old"><?=number_format($arItem['PROPERTIES']['oldprice']['VALUE'], 0, '.', ' ')?> <i class="fa fa-rub" aria-hidden="true"></i></div>
                                <?else:?>
                                    <div class="new"><?=number_format($arPrice["VALUE"], 0, '.', ' ')?> <i class="fa fa-rub" aria-hidden="true"></i></div>
                                <?endif?>
                            <?endforeach;?>
                    <?
                    }
                    ?>
				<?$frame->beginStub();?>
				    <?
                    if(!empty($arItem['CUSTOM_PRICE']))
                    {
                        if($arItem['CUSTOM_DISCOUNT_PRICE'] < $arItem['CUSTOM_PRICE'])
                        {
                            ?>
                            <div class="new"><?=number_format($arItem["CUSTOM_DISCOUNT_PRICE"], 0, '.', ' ');?> <i class="fa fa-rub" aria-hidden="true"></i></div>
                            <div class="old"><?=number_format($arItem["CUSTOM_PRICE"], 0, '.', ' ')?> <i class="fa fa-rub" aria-hidden="true"></i></div>
                            <?    
                        }
                        else
                        {
                            ?>
                            <div class="new"><?=number_format($arItem["CUSTOM_PRICE"], 0, '.', ' ')?> <i class="fa fa-rub" aria-hidden="true"></i></div>
                            <?
                        }
                    }
                    else
                    {   
                        ?>
                        <?foreach($arItem["PRICES"] as $code=>$arPrice):?>
				            <?if($arPrice["DISCOUNT_VALUE"] < $arPrice["VALUE"]):?>
				                <?=number_format($arPrice["DISCOUNT_VALUE"], 0, '.', ' ');?>
				                <span><?=number_format($arPrice["VALUE"], 0, '.', ' ');?></span>
				                <span style="display: none;" class="price-value-num"><?=number_format($arPrice["DISCOUNT_VALUE"], 0, '.', ' ');?></span>
				            <?else:?>
				                <?=number_format($arPrice["VALUE"], 0, '.', ' ');?>
				                <span style="display: none;" class="price-value-num"><?=number_format($arPrice["VALUE"], 0, '.', ' ');?></span>
				            <?endif?>
				        <?endforeach;?>
                    <?
                    }
                    ?>
				<?$frame->end();?>
			</div>
            <div class="det_status_kol_bl">
				<?$indikator = strtolower($arItem['PROPERTIES']['INDIKATOR']['VALUE_XML_ID'])?>
                <?/*<div class="det_status_kol_l">
                    <?$arInd = Array("est"=>"Есть в наличии", "net"=>"Нет в наличии", "sklad"=>"Есть в наличии на складе", "snyato"=>"Снято с производства", "zakaz" => "Под заказ");?>
                    
                    <?if ($indikator):?>
                        <?$alt = $arItem['PROPERTIES']['INDIKATOR']['VALUE'];?>
                        <div class="nal_<?=$indikator?>"><?=$arInd[ $indikator ]?></div>
                    <?elseif (in_array($arResult['SECTION']['PATH'][0]['ID'], Array(221,230,187,258,188,197))):?>
                        <div class="nal_est">Есть в наличии на складе</div>
                    <?endif;?>
                </div>*/?>
				<?if ( $indikator !== 'net' ):?>	
					<?
					if($arResult['SHOW_INFO'])
					{
						?>
						<div class="det_status_kol_r">                
							<div class="buy_number">
								<a class="js_number_prev product-item-amount-field-btn-disabled" href="javascript:void(0);"><img src="/img/number_prev.png" alt=""></a>
								<input class="number" type="number" value="1">
								<a class="js_number_next" href="javascript:void(0);"><img src="/img/number_next.png" alt=""></a>
							</div>
						</div>
						<?    
					}
					?>
				<?endif;?>
            </div>
			<?if ( $indikator !== 'net' ):?>	
				<div id="buy_element_<?=$arItem['ID']?>" class="cat_tb_buy">
					<a itemscope itemtype="http://schema.org/BuyAction"  class="buy_element_button newcat_buy fancy_pay_war" data-name="<?=$arItem['NAME']?>" data-id="<?=$arItem['ID']?>" data-set="<?=!empty($arItem['CUSTOM_PRICE']) ? 1 : ''?>" href="<?=$arItem['ADD_URL']?>">Купить</a>
				</div>
			<?endif;?>
			<div class="cat_tb_favor_srav">
				<a class="srav_favor item-<?=$arItem["ID"]?>" href="javascript:void(0)" data-id="<?=$arItem["ID"]?>"><i></i></a>
				<a class="favor_srav item-<?=$arItem["ID"]?>" href="/catalog/compare/?action=ADD_TO_COMPARE_LIST&amp;id=<?=$arItem["ID"]?>"><i></i></a>
			</div>
								<!-- <div class="buy_element">
									<div class="buy_number">
										<a class="js_number_prev" href=""><img src="/img/number_prev.png" alt=""/></a>
										<input class="number" type="text" value="1"/>
										<a class="js_number_next" href=""><img src="/img/number_next.png" alt=""/></a>
									</div>
			                        <div id="buy_element_<?=$arItem['ID']?>">
			                            <a itemscope itemtype="http://schema.org/BuyAction"  class="buy_element_button" data-name="<?=$arItem['NAME']?>" data-id="<?=$arItem['ID']?>" href="<?=$arItem['ADD_URL']?>">Купить</a>
			                        </div>
								</div> -->
		</div>
	</div>
	<!-- <div class="list_element_catalog parent_block" id="<?=$strMainID;?>">
		<table>
			<tr>
				<td class="list_element_img" rowspan="2">
				
					<?if($_SERVER['REMOTE_ADDR'] == '80.82.47.126'):?>
						<div class="cat_status_list">
							<div class="cat_status_el black">Black Friday</div>
							<div class="cat_status_el sale">SALE</div>
							<div class="cat_status_el hit">ХИТ</div>
							<div class="cat_status_el new">NEW</div>
							<div class="cat_status_el viol">Выгода</div>
						</div>
					<?endif?>
					<?if (strlen($resizeImg)>0):?>
						<a href="<?=$arItem['DETAIL_PAGE_URL']?>"><img src="<?=$resizeImg?>" /></a>
					<?endif;?>
				</td>
                <td colspan="3" style="position:relative; padding-right:65px; padding-bottom: 25px;">
                    <a class="list_element_title" href="<?=$arItem['DETAIL_PAGE_URL']?>"><?=$arItem['NAME']?></a>
                    <div>
                        <a class="favor_srav item-<?=$arItem['ID']?>" href="<?=$arItem['COMPARE_URL']?>"><i></i></a>
                        <a class="srav_favor item-<?=$arItem['ID']?>" href="javascript:void(0)" data-id="<?=$arItem['ID']?>"><i></i></a>
                    </div>
                </td>
            </tr>
			<tr>
				<td class="list_element_opisanie">
					<?
					foreach( explode("<br>", strip_tags($arItem["PREVIEW_TEXT"], '<br>')) as $str ):
						$str = str_replace("&nbsp;", "", $str);
						$arStr = explode(":", $str);
						?>
						<ul class="opisanie_element_catalog not_style">
							<li><?=trim($arStr[0])?>:</li>
							<li><?=trim($arStr[1])?></li>
						</ul>
						<?
					endforeach;
					?>
				</td>
				<td class="list_element_buy">
                    <ul class="catalog_el_reting">
                        <li class="display_none_m display_none_mp"></li>
                        <li class="set_reting_product_<?=$arItem["ID"]?> product_reting" data-rating-product="<?=$arItem["ID"]?>">
                            <div class="new_reiting_bl"><div style="width:0%;" class="new_reiting_cont"></div></div>
                        </li>
                    </ul>
                    <div id="money_element_<?=$arItem["ID"]?>" class="money_element">
					    <div class="money_element">
						    <?$frame = $this->createFrame("money_element_".$arItem["ID"], false)->begin();?>
                                <?foreach($arItem["PRICES"] as $code=>$arPrice):?>
							        <?if($arPrice["DISCOUNT_VALUE"] < $arPrice["VALUE"]):?>
								        <?=$arPrice["PRINT_DISCOUNT_VALUE"]?><span><?=$arPrice["PRINT_VALUE"]?></span>
								        <span style="display: none;" class="price-value-num"><?=$arPrice["DISCOUNT_VALUE"]?></span>
							        <?else:?>
								        <?=$arPrice["PRINT_VALUE"]?>
								        <span style="display: none;" class="price-value-num"><?=$arPrice["VALUE"]?></span>
							        <?endif?>
						        <?endforeach;?>
                            <?$frame->beginStub();?>
                                <?foreach($arItem["PRICES"] as $code=>$arPrice):?>
                                    <?if($arPrice["DISCOUNT_VALUE"] < $arPrice["VALUE"]):?>
                                        <?=$arPrice["PRINT_DISCOUNT_VALUE"]?><span><?=$arPrice["PRINT_VALUE"]?></span>
                                        <span style="display: none;" class="price-value-num"><?=$arPrice["DISCOUNT_VALUE"]?></span>
                                    <?else:?>
                                        <?=$arPrice["PRINT_VALUE"]?>
                                        <span style="display: none;" class="price-value-num"><?=$arPrice["VALUE"]?></span>
                                    <?endif?>
                                <?endforeach;?>
                            <?$frame->end();?>
					    </div>
                    </div>
				</td>
				<td class="list_element_buy">
					<div class="buy_element">
						<div class="buy_number">
							<a class="js_number_prev" href=""><img src="/img/number_prev.png" alt=""/></a>
							<input class="number" type="text" value="1"/>
							<a class="js_number_next" href=""><img src="/img/number_next.png" alt=""/></a>
						</div>
                        <div id="buy_element_<?=$arItem['ID']?>">
                            <?/*$frame = $this->createFrame("buy_element_".$arItem['ID'], false)->begin("");?>
						        <?if (in_array($arItem['ID'], $arParams['IN_BASKET'])):?>
							        <a itemscope itemtype="http://schema.org/BuyAction"  class="buy_element_button in_basket_button" data-id="<?=$arItem['ID']?>" href="/personal/cart/?>">В корзину</a>
						        <?else:?>
							        <a itemscope itemtype="http://schema.org/BuyAction"  class="buy_element_button" data-id="<?=$arItem['ID']?>" href="<?=$arItem['ADD_URL']?>">Купить</a>
						        <?endif;?>
                            <?$frame->end();*/?>
                            <a itemscope itemtype="http://schema.org/BuyAction"  class="buy_element_button" data-name="<?=$arItem['NAME']?>" data-id="<?=$arItem['ID']?>" href="<?=$arItem['ADD_URL']?>">Купить</a>
                        </div>
					</div>
					<div class="clear"></div>
					<?/*<p class="add_sravnenie"><label><input type="checkbox" data-url="<?=$arItem['COMPARE_URL']?>" />Добавить в сравнение</label></p>*/?>
				</td>
			</tr>
		</table>
	</div> -->
<?
endforeach;
?>

<div class="clear"></div>
<div class="catalog_page_top_all_produce"></div>
<?
$paramName = 'PAGEN_'.$arResult['NAV_RESULT']->NavNum;
$paramValue = $arResult['NAV_RESULT']->NavPageNomer;
$pageCount = $arResult['NAV_RESULT']->NavPageCount;

if ($paramValue < $pageCount) {
    $paramValue = (int) $paramValue + 1;
    $url = htmlspecialcharsbx(
        $APPLICATION->GetCurPageParam(
            sprintf('%s=%s', $paramName, $paramValue),
            array($paramName, 'AJAX_PAGE',),
            false
        )
    );
    echo sprintf('<div class="ajax_pager_wrap_block"><div class="ajax-pager-wrap">
                      <a class="ajax-pager-link index_more_produce" data-wrapper-class="catalog_list" href="%s">показать еще %s</a>
                  </div><div class="catalog_page_navigator_kol">Показано '.$arResult['NAV_RESULT']->NavPageSize*$arResult['NAV_RESULT']->NavPageNomer.' из '.$arResult['NAV_RESULT']->NavRecordCount.'</div></div>',
        $url, $arParams['PAGE_ELEMENT_COUNT']);
}
if ($arParams["DISPLAY_BOTTOM_PAGER"])
{
    echo str_replace("AJAX_PAGE=TEXT", "", $arResult["NAV_STRING"]);
}
?>
</div>
<!--RestartBuffer-->


<!--RestartBuffer--> 
<script>
	$(document).ready(function(){
		window.dataLayer = window.dataLayer || [];	
		$(".buy_element_button").click(function(){
				dataLayer.push({
			    "ecommerce": {
			        "add": {
			            "products": [
						                {
						                    "name": $(this).data('name'),
						                    "price": $(this).parents(".list_element_catalog.parent_block").find(".price-value-num").html(),
						                    "quantity": $(this).parents(".list_element_catalog.parent_block").find(".buy_element input.number").val(),
						                }
			           				]
			        		}
			    			}
				});
		});

	});
</script>

<script>
    //$(".fancy_pay_war").click(function(){
    //    $.fancybox({'type':'ajax', href:'/include/popup_fancy_pay_war.php'});
   // });
</script>