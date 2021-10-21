<? if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();

use \Bitrix\Main\Localization\Loc;

/**
 * @global CMain $APPLICATION
 * @var array $arParams
 * @var array $item
 * @var array $actualItem
 * @var array $minOffer
 * @var array $itemIds
 * @var array $price
 * @var array $measureRatio
 * @var bool $haveOffers
 * @var bool $showSubscribe
 * @var array $morePhoto
 * @var bool $showSlider
 * @var string $imgTitle
 * @var string $productTitle
 * @var string $buttonSizeClass
 * @var CatalogSectionComponent $component
 */
?> 

    <div class="newcat_el">
        <div class="cat_status_list">
            <?if (($item['PROPERTIES']['BLACK_FRIDAY']['VALUE'] == "Y") && (Salavey::CheckDateBF() == 'Y')):?>
                <div class="cat_status_el black">Black Friday</div>
            <?endif?>
            <?if ($item['PROPERTIES']['SALE']['VALUE'] == 'Y'):?>
                <div class="cat_status_el sale">SALE</div>
            <?endif?>
            <?if ($item['PROPERTIES']['HIT']['VALUE'] == 'Y'):?>
                <div class="cat_status_el hit">ХИТ</div>
            <?endif?>
            <?if ($item['PROPERTIES']['NEW']['VALUE'] == 'Y'):?>
                <div class="cat_status_el new">NEW</div>
            <?endif?>
            <?if ($item['PROPERTIES']['SUPER']['VALUE'] == 'Y'):?>
                <div class="cat_status_el viol">Выгода</div>
            <?endif?>
        </div>
        <div class="newcat_tit">
            <a href="<?=$item['DETAIL_PAGE_URL']?>"><?=$item['NAME']?></a>
        </div>
        <div class="newcat_ic_bl">
            <a href="<?=$item['DETAIL_PAGE_URL']?>">
                <?
                if(!empty($item['SECOND_PICTURE']))
                {
                    ?>
                    <span class="one">
                        <img src="<?=$resizeImg?>">
                    </span>
                    <span class="two">
                        <img src="<?=$item['SECOND_PICTURE']['src']?>">
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
                <div class="new_reiting_bl set_reting_product_<?=$item["ID"]?> product_reting" data-rating-product="<?=$item["ID"]?>">
                    <div style="width:<?=$item["RATING_PERCENT"]?>%;" class="new_reiting_cont"></div>
                </div>
            </div>
            <div class="newcat_dop_bt">
                <a class="favor_srav item-<?=$item['ID']?>" href="/catalog/compare/?action=ADD_TO_COMPARE_LIST&id=<?=$item['ID']?>"><i></i></a>
                <a class="srav_favor item-<?=$item['ID']?>" href="javascript:void(0)" data-id="<?=$item['ID']?>"><i></i></a>
            </div>
        </div>
        <div class="det_status_kol_bl">
            <div class="det_status_kol_l">
                <?$arInd = Array("est"=>"Есть в наличии", "net"=>"Нет в наличии", "sklad"=>"Есть в наличии на складе", "snyato"=>"Снято с производства", "zakaz" => "Под заказ");?>
                <?$indikator = strtolower($item['PROPERTIES']['INDIKATOR']['VALUE_XML_ID'])?>
                <?if ($indikator):?>
                    <?$alt = $item['PROPERTIES']['INDIKATOR']['VALUE'];?>
                    <div class="nal_<?=$indikator?>"><?=$arInd[ $indikator ]?></div>
                <?elseif (in_array($arResult['SECTION']['PATH'][0]['ID'], Array(221,230,187,258,188,197))):?>
                    <div class="nal_est">Есть в наличии на складе</div>
                <?endif;?>
            </div>
            <?
            if($item['SHOW_INFO'])
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
        </div>
        <div class="newcat_info_bot">
            <div class="newcat_price_bl" id="money_element_<?=$item["ID"]?>">
                <?$frame = $this->createFrame("money_element_".$item["ID"], false)->begin();?>
                    <?
                    if(!empty($item['CUSTOM_PRICE']))
                    {
                        if($item['CUSTOM_DISCOUNT_PRICE'] < $item['CUSTOM_PRICE'])
                        {
                            ?>
                            <div class="new"><?=number_format($item["CUSTOM_DISCOUNT_PRICE"], 0, '.', ' ');?> <i class="fa fa-rub" aria-hidden="true"></i></div>
                            <div class="old"><?=number_format($item["CUSTOM_PRICE"], 0, '.', ' ')?> <i class="fa fa-rub" aria-hidden="true"></i></div>
                            <?    
                        }
                        else
                        {
                            ?>
                            <div class="new"><?=number_format($item["CUSTOM_PRICE"], 0, '.', ' ')?> <i class="fa fa-rub" aria-hidden="true"></i></div>
                            <?
                        }
                    }
                    else
                    {
                        ?>
                        <?foreach($item["PRICES"] as $code=>$arPrice):?>
                            <?if($arPrice["DISCOUNT_VALUE"] < $arPrice["VALUE"]):?>
                                <div class="new"><?=number_format($arPrice["DISCOUNT_VALUE"], 0, '.', ' ');?> <i class="fa fa-rub" aria-hidden="true"></i></div>
                                <div class="old"><?=number_format($arPrice["VALUE"], 0, '.', ' ')?> <i class="fa fa-rub" aria-hidden="true"></i></div>
                            <?else:?>
                                <div class="new"><?=number_format($arPrice["VALUE"], 0, '.', ' ')?> <i class="fa fa-rub" aria-hidden="true"></i></div>
                            <?endif?>
                        <?endforeach;?>
                        <?
                    }
                    ?>
                <?$frame->beginStub();?>
                    <?
                    if(!empty($item['CUSTOM_PRICE']))
                    {
                        if($item['CUSTOM_DISCOUNT_PRICE'] < $item['CUSTOM_PRICE'])
                        {
                            ?>
                            <div class="new"><?=number_format($item["CUSTOM_DISCOUNT_PRICE"], 0, '.', ' ');?> <i class="fa fa-rub" aria-hidden="true"></i></div>
                            <div class="old"><?=number_format($item["CUSTOM_PRICE"], 0, '.', ' ')?> <i class="fa fa-rub" aria-hidden="true"></i></div>
                            <?    
                        }
                        else
                        {
                            ?>
                            <div class="new"><?=number_format($item["CUSTOM_PRICE"], 0, '.', ' ')?> <i class="fa fa-rub" aria-hidden="true"></i></div>
                            <?
                        }
                    }
                    else
                    {
                        ?>
                        <?foreach($item["PRICES"] as $code=>$arPrice):?>
                            <?if($arPrice["DISCOUNT_VALUE"] < $arPrice["VALUE"]):?>
                                <div class="new"><?=number_format($arPrice["DISCOUNT_VALUE"], 0, '.', ' ')?> <i class="fa fa-rub" aria-hidden="true"></i></div>
                                <div class="old"><?=number_format($arPrice["VALUE"], 0, '.', ' ')?> <i class="fa fa-rub" aria-hidden="true"></i></div>
                            <?else:?>
                                <div class="new"><?=number_format($arPrice["VALUE"], 0, '.', ' ')?> <i class="fa fa-rub" aria-hidden="true"></i></div>
                            <?endif?>
                        <?endforeach;?>
                        <?
                    }
                    ?>
                <?$frame->end();?>
            </div>                
            <div id="buy_element_button_block_<?=$item["ID"]?>">
                <a itemscope itemtype="http://schema.org/BuyAction"  class="buy_element_button newcat_buy fancy_pay_war" data-price="" data-name="<?=$item['NAME']?>" data-id="<?=$item['ID']?>" href="<?=$item['ADD_URL']?>">Купить</a>
            </div>
        </div>
        <?
        if(isset($item['STORES']))
        {
            ?>
            <div class="manager_complect_table">
                <table>
                    <thead>
                        <tr>
                            <th>Склад</th>
                            <th>Остаток</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td class="red_bg"><span><?=$item["STORES"][0]["TITLE"]?></span></td>
                            <td class="red_bg"><span><?=$item["STORES"][0]["PRODUCT_AMOUNT"] > 0 ? $item["STORES"][0]["PRODUCT_AMOUNT"] : "-"?></span></td>
                        </tr>
                        <?foreach($item["STORES"] as $pid => $arProperty):
                            if($pid == 0)
                                continue;
                        ?>
                            <?
                            if($arProperty["PRODUCT_AMOUNT"] <= 0 && $arProperty["ID"] != 3)
                                continue;?>
                            <tr>
                                <td>
                                    <?if (isset($arProperty["TITLE"])):?>
                                        <?=$arProperty["TITLE"]?>
                                    <?endif;?>
                                </td>
                                <td><?=$arProperty["PRODUCT_AMOUNT"] > 0 ? $arProperty["PRODUCT_AMOUNT"] : "-"?></td>
                            </tr>
                        <?endforeach;?>
                        <tr class="linear">
                            <td colspan="3"></td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <?    
        }
        ?>
        <div class="newcat_hidden_bl">
            <?foreach( explode("<br>", strip_tags($item["PREVIEW_TEXT"], '<br>')) as $str ):
                $str = str_replace("&nbsp;", "", $str);
                $arStr = explode(":", $str);
                ?>
                <?if($arStr[1]):?>
                    <div class="newcat_option_el">
                        <div class="newcat_option_l"><?=trim(strip_tags($arStr[0]))?></div>
                        <div class="newcat_option_r"><?=trim(strip_tags($arStr[1]))?></div>
                    </div>
                <?endif?>
            <?endforeach;?>
        </div>
    </div>


<script>
    $(".fancy_pay_war").click(function(){
        $.fancybox({'type':'ajax', href:'/include/popup_fancy_pay_war.php'});
    });
</script>

<?/* <div>
    <a class="favor_srav item-<?=$item['ID']?>" href="<?=$item['COMPARE_URL']?>"><i></i></a>
    <a class="srav_favor item-<?=$item['ID']?>" href="javascript:void(0)" data-id="<?=$item['ID']?>"><i></i></a>
</div>
<div class="index_produce_left_col">
    <div class="cat_status_list">
        <?if (($item['PROPERTIES']['BLACK_FRIDAY']['VALUE'] == "Y") && (Salavey::CheckDateBF() == 'Y')):?><div class="cat_status_el black">Black Friday</div><?endif?>
        <?if ($item['PROPERTIES']['SALE']['VALUE']=='Y'):?><div class="cat_status_el sale">SALE</div><?endif?>
        <?if ($item['PROPERTIES']['HIT']['VALUE']=='Y'):?><div class="cat_status_el hit">ХИТ</div><?endif?>
        <?if ($item['PROPERTIES']['NEW']['VALUE']=='Y'):?><div class="cat_status_el new">NEW</div><?endif?>
        <?if ($item['PROPERTIES']['SUPER']['VALUE']=='Y'):?><div class="cat_status_el viol">Выгода</div><?endif?>
    </div>
    <p class="index_produce_img">
        <?if ($resizeImg):?>
            <a href="<?=$item['DETAIL_PAGE_URL']?>"><img src="<?=$resizeImg?>" id="<?=$itemIds['PICT']?>"  /></a>
        <?endif;?>
    </p>
</div>
<div class="index_produce_right_col">
    <a href="<?=$item['DETAIL_PAGE_URL']?>" class="index_produce_title"><span><?=$item['NAME']?></span></a>
    <ul class="not_style">
        <li></li>
        <li class="set_reting_product_<?=$item['ID']?>">
            <div class="new_reiting_bl"><div style="width:<?=$item["RATING_PERCENT"]?>%;" class="new_reiting_cont"></div></div>
        </li>
    </ul>
    <ul <?if ($is4):?>class="not_style"<?endif;?>>
        <li>
            <div id="index_hit_item_price_<?=$item['ID']?>">
                <?$frame = $this->createFrame("index_hit_item_price_".$item["ID"], false)->begin();?>
                    <?foreach($item["PRICES"] as $code=>$arPrice):?>
                        <?if($arPrice["DISCOUNT_VALUE"] < $arPrice["VALUE"]):?>
                            <p id="<?=$itemIds['PRICE']?>"><?=$arPrice["PRINT_DISCOUNT_VALUE"]?></p>
                            <p id="<?=$itemIds['PRICE_OLD']?>"><?=$arPrice["PRINT_VALUE"]?></p>
                        <?else:?>
                            <p id="<?=$itemIds['PRICE']?>"><?=$arPrice["PRINT_VALUE"]?></p>
                        <?endif?>
                    <?endforeach;?>
                <?$frame->beginStub();?>
                    <?foreach($item["PRICES"] as $code=>$arPrice):?>
                        <?if($arPrice["DISCOUNT_VALUE"] < $arPrice["VALUE"]):?>
                            <p id="<?=$itemIds['PRICE']?>"><?=$arPrice["PRINT_DISCOUNT_VALUE"]?></p>
                            <p id="<?=$itemIds['PRICE_OLD']?>"><?=$arPrice["PRINT_VALUE"]?></p>
                        <?else:?>
                            <p id="<?=$itemIds['PRICE']?>"><?=$arPrice["PRINT_VALUE"]?></p>
                        <?endif?>
                    <?endforeach;?>
                <?$frame->end();?>
            </div>
        </li>
        <li class="display_none_m display_none_mp" id="<?=$itemIds['BASKET_ACTIONS']?>">
            <div id="index_hit_item_btn_<?=$item['ID']?>">
                <a class="red_buy big-data" data-id="<?=$item['ID']?>" href="javascript:void(0)" id="<?=$itemIds['BUY_LINK']?>">Купить</a>
            </div>
        </li>
    </ul>
</div> */?>