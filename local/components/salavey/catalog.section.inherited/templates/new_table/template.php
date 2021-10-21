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
?>
<div itemscope itemtype="http://schema.org/Product">
    <meta itemprop="name" content="<?echo (
            isset($arResult["IPROPERTY_VALUES"]["SECTION_PAGE_TITLE"]) && $arResult["IPROPERTY_VALUES"]["SECTION_PAGE_TITLE"] != ""
            ? $arResult["IPROPERTY_VALUES"]["SECTION_PAGE_TITLE"]
            : $arResult['NAME']
        );?>">
        <div itemprop="aggregateRating" itemscope itemtype="http://schema.org/AggregateRating">
            <meta itemprop="worstRating" content="1">
            <meta itemprop="ratingValue" content="<?=$arResult['ratingValue']?>">
            <meta itemprop="bestRating" content="5">
            <meta itemprop="reviewCount" content="<?=$arResult['reviewCount']?>">
        </div>
    <div itemprop="offers" itemscope itemtype="http://schema.org/AggregateOffer">
        <meta itemprop="lowPrice" content="<?=$arResult['lowPrice']?>">
        <meta itemprop="highPrice" content="<?=$arResult['highPrice']?>">
        <meta itemprop="priceCurrency" content="RUB">
    </div>
</div>
<?

$strElementEdit = CIBlock::GetArrayByID($arParams["IBLOCK_ID"], "ELEMENT_EDIT");
$strElementDelete = CIBlock::GetArrayByID($arParams["IBLOCK_ID"], "ELEMENT_DELETE");
$arElementDeleteParams = array("CONFIRM" => GetMessage('CT_BCS_TPL_ELEMENT_DELETE_CONFIRM'));
?>
<div class="newcat_list">
<!--RestartBuffer-->
<?
$fileNoImg = CFile::GetList(array(),array("MODULE_ID" => "service_salavey", "ORIGINAL_NAME" => "no_photo_diada.jpg"))->GetNext();
$resizeImgNoPhoto = CFile::ResizeImageGet($fileNoImg['ID'], array("width" => 250, "height" => 90))["src"];
foreach ($arResult['PRICES_WITH_DISCOUNT'] as $key => $discount):
    
    $arItem = $arResult['ITEMS'][$key];
    $templateData["LIST_ITEMS"][] = $arItem['ID'];
	$this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], $strElementEdit);
	$this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], $strElementDelete, $arElementDeleteParams);
	$strMainID = $this->GetEditAreaId($arItem['ID']);
	if ($arItem['~PREVIEW_PICTURE'] > 0) 
    {
        $resizeImg = CFile::ResizeImageGet($arItem['~PREVIEW_PICTURE'], array("width" => 250, "height" => 90))["src"];
    }
    elseif ($arItem['~DETAIL_PICTURE'] > 0)
    {
        $resizeImg = CFile::ResizeImageGet($arItem['~DETAIL_PICTURE'], array("width" => 250, "height" => 90))["src"];
    }
    if (strlen($resizeImg) == 0)
    {
        $resizeImg = $resizeImgNoPhoto;
    }
//    echo '<pre>'; echo '<br>'; var_export($arItem); echo '</pre>';
	?>
    <div class="newcat_el_bl" id="<?=$strMainID;?>">
        <div class="newcat_el">
            <div class="cat_status_list">
                
                <?if (($arItem['PROPERTIES']['BLACK_FRIDAY']['VALUE'] == "Y") && (Salavey::CheckDateBF() == 'Y')):?>
                    <div class="cat_status_el black">Black Friday</div>
                <?endif?>
                <?if ($arItem['PROPERTIES']['SALE']['VALUE'] == 'Y'):?>
                    <div class="cat_status_el sale">SALE</div>
                <?endif?>
                <?if ($arItem['PROPERTIES']['HIT']['VALUE'] == 'Y'):?>
                    <div class="cat_status_el hit">ХИТ</div>
                <?endif?>
                <?if ($arItem['PROPERTIES']['NEW']['VALUE'] == 'Y'):?>
                    <div class="cat_status_el new">NEW</div>
                <?endif?>
                <?if ($arItem['PROPERTIES']['SUPER']['VALUE'] == 'Y'):?>
                    <div class="cat_status_el viol">Выгода</div>
                <?endif?>
            </div>
            <div class="newcat_tit">
                <a href="<?=$arItem['DETAIL_PAGE_URL']?>"><?=$arItem['NAME']?></a>
            </div>
            <div class="newcat_ic_bl">
                <a href="<?=$arItem['DETAIL_PAGE_URL']?>">
                    
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
                            <img src="<?=$resizeImg?>">
                            <?    
                        }    
                    }
                    ?>
                </a>
            </div>
            <div class="newcat_info_top">
                <div class="newcat_reititng">
                    <div class="new_reiting_bl set_reting_product_<?=$arItem["ID"]?> product_reting" data-rating-product="<?=$arItem["ID"]?>">
                        <div style="width:0%;" class="new_reiting_cont"></div>
                    </div>
                </div>
                <div class="newcat_dop_bt">
                    <a class="favor_srav item-<?=$arItem['ID']?>" href="<?=$arItem['COMPARE_URL']?>"><i></i></a>
                    <a class="srav_favor item-<?=$arItem['ID']?>" href="javascript:void(0)" data-id="<?=$arItem['ID']?>"><i></i></a>
                </div>
            </div>
            <div class="newcat_info_bot">
                <div class="newcat_price_bl" id="money_element_<?=$arItem["ID"]?>">
                    <?$frame = $this->createFrame("money_element_".$arItem["ID"], false)->begin();?>
                        <?foreach($arItem["PRICES"] as $code=>$arPrice):?>
                            <?if($arPrice["DISCOUNT_VALUE"] < $arPrice["VALUE"]):?>
                                <div class="new"><?=number_format($arPrice["DISCOUNT_VALUE"], 0, '.', ' ');?> <i class="fa fa-rub" aria-hidden="true"></i></div>
                                <div class="old"><?=number_format($arPrice["VALUE"], 0, '.', ' ')?> <i class="fa fa-rub" aria-hidden="true"></i></div>
                            <?else:?>
                                <div class="new"><?=number_format($arPrice["VALUE"], 0, '.', ' ')?> <i class="fa fa-rub" aria-hidden="true"></i></div>
                            <?endif?>
                        <?endforeach;?>
                    <?$frame->beginStub();?>
                        <?foreach($arItem["PRICES"] as $code=>$arPrice):?>
                            <?if($arPrice["DISCOUNT_VALUE"] < $arPrice["VALUE"]):?>
                                <div class="new"><?=number_format($arPrice["DISCOUNT_VALUE"], 0, '.', ' ')?> <i class="fa fa-rub" aria-hidden="true"></i></div>
                                <div class="old"><?=number_format($arPrice["VALUE"], 0, '.', ' ')?> <i class="fa fa-rub" aria-hidden="true"></i></div>
                            <?else:?>
                                <div class="new"><?=number_format($arPrice["VALUE"], 0, '.', ' ')?> <i class="fa fa-rub" aria-hidden="true"></i></div>
                            <?endif?>
                        <?endforeach;?>
                    <?$frame->end();?>
                </div>                
                <div id="buy_element_button_block_<?=$arItem["ID"]?>">
                    <a itemscope itemtype="http://schema.org/BuyAction"  class="newcat_buy fancy_pay_war" data-price="" data-name="<?=$arItem['NAME']?>" data-id="<?=$arItem['ID']?>" href="<?=$arItem['ADD_URL']?>">Купить</a>
                </div>
            </div>
            <div class="newcat_hidden_bl">
                <?
                foreach( explode("<br>", strip_tags($arItem["PREVIEW_TEXT"], '<br>')) as $str ):
                    $str = str_replace("&nbsp;", "", $str);
                    $arStr = explode(":", $str);
                    ?>
                    <div class="newcat_option_el">
                        <div class="newcat_option_l"><?=trim(strip_tags($arStr[0]))?>:</div>
                        <div class="newcat_option_r"><?=trim(strip_tags($arStr[1]))?></div>
                    </div>
                    <?
                endforeach;
                ?>
            </div>
        </div>
    </div>
    <?/*
	<div class="table_element_catalog_block parent_block" id="<?=$strMainID;?>">
		<div class="list_element_catalog table_element_catalog">
			<div class="cat_status_list">
				<?if (($arItem['PROPERTIES']['BLACK_FRIDAY']['VALUE'] == "Y") && (Salavey::CheckDateBF() == 'Y')):?><div class="cat_status_el black">Black Friday</div><?endif?>
				<?if ($arItem['PROPERTIES']['SALE']['VALUE']=='Y'):?><div class="cat_status_el sale">SALE</div><?endif?>
				<?if ($arItem['PROPERTIES']['HIT']['VALUE']=='Y'):?><div class="cat_status_el hit">ХИТ</div><?endif?>
				<?if ($arItem['PROPERTIES']['NEW']['VALUE']=='Y'):?><div class="cat_status_el new">NEW</div><?endif?>
				<?if ($arItem['PROPERTIES']['SUPER']['VALUE']=='Y'):?><div class="cat_status_el viol">Выгода</div><?endif?>
			</div>
            <a class="list_element_title" href="<?=$arItem['DETAIL_PAGE_URL']?>"><?=$arItem['NAME']?></a>
			<div class="list_element_img">
				<div>
					<a class="favor_srav item-<?=$arItem['ID']?>" href="<?=$arItem['COMPARE_URL']?>"><i></i></a>
					<a class="srav_favor item-<?=$arItem['ID']?>" href="javascript:void(0)" data-id="<?=$arItem['ID']?>"><i></i></a>
				</div>
				<?if (strlen($resizeImg)>0):?>
					<a href="<?=$arItem['DETAIL_PAGE_URL']?>"><img src="<?=$resizeImg?>" /></a>
                <?endif;?>
			</div>
			<div class="display_none_c">
				<ul class="not_style">
					<li class="adaptiv_list_element_img">
						<?if ($arItem['PREVIEW_PICTURE']):?>
                            <a href="<?=$arItem['DETAIL_PAGE_URL']?>"><img src="<?=$resizeImg?>" /></a>
						<?endif;?>
					</li>
				</ul>
				<ul class="not_style">
					<li class="money_element">
						<div id="money_element_<?=$arItem["ID"]?>">
                            <?$frame = $this->createFrame("money_element_".$arItem["ID"], false)->begin();?>
                                <?foreach($arItem["PRICES"] as $code=>$arPrice):?>
							        <?if($arPrice["DISCOUNT_VALUE"] < $arPrice["VALUE"]):?>
								        <?=$arPrice["PRINT_DISCOUNT_VALUE"]?><span><?=$arPrice["PRINT_VALUE"]?></span>
							        <?else:?>
								        <?=$arPrice["PRINT_VALUE"]?>
							        <?endif?>
						        <?endforeach;?>
                            <?$frame->beginStub();?>
                                <?foreach($arItem["PRICES"] as $code=>$arPrice):?>
                                    <?if($arPrice["DISCOUNT_VALUE"] < $arPrice["VALUE"]):?>
                                        <?=$arPrice["PRINT_DISCOUNT_VALUE"]?><span><?=$arPrice["PRINT_VALUE"]?></span>
                                    <?else:?>
                                        <?=$arPrice["PRINT_VALUE"]?>
                                    <?endif?>
                                <?endforeach;?>
                            <?$frame->end();?>
                        </div>
					</li>
				</ul>
			</div>
            <ul class="catalog_el_reting">
                <li class="display_none_m display_none_mp"></li>
                <li class="set_reting_product_<?=$arItem["ID"]?> product_reting" data-rating-product="<?=$arItem["ID"]?>">
                    <div class="new_reiting_bl"><div style="width:0%;" class="new_reiting_cont"></div></div>
                </li>
            </ul>
			<ul class="table_buy_money">
				<li class="money_element display_none_m display_none_mp display_none_p">
					<div id="table_money_element_<?=$arItem["ID"]?>">
                        <?$frame = $this->createFrame("table_money_element_".$arItem["ID"], false)->begin();?>
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
				</li>
				<li class="buy_element">
					<div class="buy_number">
						<a class="js_number_prev" href=""><img src="/img/number_prev.png" alt=""/></a>
						<input name="count" class="number" type="text" value="1"/>
						<a class="js_number_next" href=""><img src="/img/number_next.png" alt=""/></a>
					</div>
					<div class="clear"></div>
				</li>
				<li class="buy_element_button_block">
                    <div id="buy_element_button_block_<?=$arItem["ID"]?>">
                        <a itemscope itemtype="http://schema.org/BuyAction"  class="buy_element_button" data-price="" data-name="<?=$arItem['NAME']?>" data-id="<?=$arItem['ID']?>" href="<?=$arItem['ADD_URL']?>">Купить</a>
                    </div>
					<div class="clear"></div>
				</li>
			</ul>
			<div class="table_element_catalog_light">
				<div class="display_none_m display_none_mp display_none_p">
				<?
				foreach( explode("<br>", strip_tags($arItem["PREVIEW_TEXT"], '<br>')) as $str ):
					$str = str_replace("&nbsp;", "", $str);
					$arStr = explode(":", $str);
					?>
					<ul class="opisanie_element_catalog not_style">
						<li><?=trim(strip_tags($arStr[0]))?>:</li>
						<li><?=trim(strip_tags($arStr[1]))?></li>
					</ul>
					<?
				endforeach;
				?>
				</div>
			</div>
		</div>
	</div>*/?>
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
            array($paramName, 'AJAX_PAGE',)
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
						                    "price": $(this).parents(".table_element_catalog_block.parent_block").find(".price-value-num").html(),
						                    "quantity": $(this).parents(".table_element_catalog_block.parent_block").find(".buy_element input.number").val(),
						                }
			           				]
			        		}
			    			}
				});
		});

	});
</script>


<script>
    $(".fancy_pay_war").click(function(){
        $.fancybox({'type':'ajax', href:'/include/popup_fancy_pay_war.php'});
    });
</script>