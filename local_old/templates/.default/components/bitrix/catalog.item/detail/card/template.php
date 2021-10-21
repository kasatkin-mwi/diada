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
<li>
    <div class="detail_right_produce_el" style="position: relative;">
        <div>
            <a class="favor_srav item-<?=$item['ID']?>" href="<?=$item['COMPARE_URL']?>"><i></i></a>
            <a class="srav_favor item-<?=$item['ID']?>" href="javascript:void(0)" data-id="<?=$item['ID']?>"><i></i></a>
        </div>
        <div class="detail_right_produce_left_col">
            <?if ($item['PREVIEW_PICTURE']):?>
                <?$arImg = CFile::ResizeImageGet($item['PREVIEW_PICTURE'], Array("width"=>75, "height"=>75), BX_RESIZE_IMAGE_PROPORTIONAL)?>
                <a href="<?=$item['DETAIL_PAGE_URL']?>"><img src="<?=$resizeImg?>" /></a>
            <?elseif($item['DETAIL_PICTURE']):?>
                <?$arImg = CFile::ResizeImageGet($item['PREVIEW_PICTURE'], Array("width"=>75, "height"=>75), BX_RESIZE_IMAGE_PROPORTIONAL)?>
                <a href="<?=$item['DETAIL_PAGE_URL']?>"><img src="<?=$resizeImg?>" /></a>
            <?else:?>
                <a href="<?=$item['DETAIL_PAGE_URL']?>"><img src="<?=$resizeImgNoPhoto?>" /></a>
            <?endif;?>
        </div>
        <div class="detail_right_produce_right_col">
            <div class="detail_right_produce_right_col_title">
                <a href="<?=$item['DETAIL_PAGE_URL']?>"><?=$item['NAME']?></a>
            </div>
            <div class="detail_right_produce_right_col_reiting set_reting_product_<?=$item['ID']?>">
            </div>
            <div class="detail_right_produce_right_col_price">
            <?
            if(!empty($item['CUSTOM_PRICE']))
            {
                if($item['CUSTOM_DISCOUNT_PRICE'] < $item['CUSTOM_PRICE'])
                {
                    ?>
                    <p><?=number_format($item["CUSTOM_DISCOUNT_PRICE"], 0, '.', ' ');?> <i class="fa fa-rub" aria-hidden="true"></i></p>
                    <p><?=number_format($item["CUSTOM_PRICE"], 0, '.', ' ')?> <i class="fa fa-rub" aria-hidden="true"></i></p>
                    <?    
                }
                else
                {
                    ?>
                    <p><?=number_format($item["CUSTOM_PRICE"], 0, '.', ' ')?> <i class="fa fa-rub" aria-hidden="true"></i></p>
                    <?
                }
            }
            else
            {
                ?>
                <?foreach($item["PRICES"] as $code=>$arPrice):?>
                    <?if($arPrice["DISCOUNT_VALUE"] < $arPrice["VALUE"]):?>
                        <p class="produce_new_price"><?=$arPrice["PRINT_DISCOUNT_VALUE"]?></p><p class="produce_old_price"><?=$arPrice["PRINT_VALUE"]?></p>
                    <?else:?>
                        <p class="produce_new_price"><?=$arPrice["PRINT_VALUE"]?></p>
                    <?endif?>
                <?endforeach;?>
            <?
            }
            ?>
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
            <?/*if (in_array($item['ID'], $arParams['IN_BASKET'])):?>
                <a class="red_buy in_basket_button" data-id="<?=$item['ID']?>" href="/personal/cart/?>">В корзину</a>
            <?else:?>
                <a class="red_buy" data-id="<?=$item['ID']?>" href="<?=$item['ADD_URL']?>">Купить</a>
            <?endif;*/?>
            <a class="red_buy" data-id="<?=$item['ID']?>" href="<?=$item['ADD_URL']?>">Купить</a>
        </div>
    </div>
</li>