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
            <a class="favor_srav item-<?=$arItem['ID']?>" href="<?=$arItem['COMPARE_URL']?>"><i></i></a>
            <a class="srav_favor item-<?=$arItem['ID']?>" href="javascript:void(0)" data-id="<?=$arItem['ID']?>"><i></i></a>
        </div>
        <div class="detail_right_produce_left_col">
            <?if ($arItem['PREVIEW_PICTURE']):?>
                <?$arImg = CFile::ResizeImageGet($arItem['PREVIEW_PICTURE'], Array("width"=>75, "height"=>75), BX_RESIZE_IMAGE_PROPORTIONAL)?>
                <a href="<?=$arItem['DETAIL_PAGE_URL']?>"><img src="<?=$arImg['src']?>" /></a>
            <?elseif($arItem['DETAIL_PICTURE']):?>
                <?$arImg = CFile::ResizeImageGet($arItem['PREVIEW_PICTURE'], Array("width"=>75, "height"=>75), BX_RESIZE_IMAGE_PROPORTIONAL)?>
                <a href="<?=$arItem['DETAIL_PAGE_URL']?>"><img src="<?=$arImg['src']?>" /></a>
            <?else:?>
                <a href="<?=$arItem['DETAIL_PAGE_URL']?>"><img src="<?=$resizeImgNoPhoto?>" /></a>
            <?endif;?>
        </div>
        <div class="detail_right_produce_right_col">
            <div class="detail_right_produce_right_col_title">
                <a href="<?=$arItem['DETAIL_PAGE_URL']?>"><?=$arItem['NAME']?></a>
            </div>
            <div class="detail_right_produce_right_col_reiting set_reting_product_<?=$arItem['ID']?>">
            </div>
            <div class="detail_right_produce_right_col_price">
            <?foreach($arItem["PRICES"] as $code=>$arPrice):?>
                <?if($arPrice["DISCOUNT_VALUE"] < $arPrice["VALUE"]):?>
                    <p class="produce_new_price"><?=$arPrice["PRINT_DISCOUNT_VALUE"]?></p><p class="produce_old_price"><?=$arPrice["PRINT_VALUE"]?></p>
                <?else:?>
                    <p class="produce_new_price"><?=$arPrice["PRINT_VALUE"]?></p>
                <?endif?>
            <?endforeach;?>
            </div>
            <?/*if (in_array($arItem['ID'], $arParams['IN_BASKET'])):?>
                <a class="red_buy in_basket_button" data-id="<?=$arItem['ID']?>" href="/personal/cart/?>">В корзину</a>
            <?else:?>
                <a class="red_buy" data-id="<?=$arItem['ID']?>" href="<?=$arItem['ADD_URL']?>">Купить</a>
            <?endif;*/?>
            <a class="red_buy" data-id="<?=$arItem['ID']?>" href="<?=$arItem['ADD_URL']?>">Купить</a>
        </div>
    </div>
</li>

<div class="slider_produce_el">
    <div>
        <a class="favor_srav item-<?=$item['ID']?>" href="<?=$item['COMPARE_URL']?>"><i></i></a>
        <a class="srav_favor item-<?=$item['ID']?>" href="javascript:void(0)" data-id="<?=$item['ID']?>"><i></i></a>
    </div>
    <div class="slider_produce_img">
        <?if (strlen($resizeImg)>0):?>
            <a href="<?=$item['DETAIL_PAGE_URL']?>"><img src="<?=$resizeImg?>" id="<?=$itemIds['PICT']?>" /></a>
        <?endif;?>
    </div>
    <div class="slider_produce_title"><a class="list_element_title" href="<?=$item['DETAIL_PAGE_URL']?>"><span><?=$item['NAME']?></span></a></div>

    <ul class="">
        <li class=""></li>
        <li class="set_reting_product_<?=$item["ID"]?>"></li>
    </ul>
    <ul class="not_style">
        <li class="">
            <div id="table_money_element_<?=$item["ID"]?>">
                <?$frame = $this->createFrame("table_money_element_".$item["ID"], false)->begin();?>
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
        <li class="" id="<?=$itemIds['BASKET_ACTIONS']?>">
            <div id="buy_element_button_block_<?=$item["ID"]?>">
                
                <a itemscope itemtype="http://schema.org/BuyAction"  class="red_buy big-data"  id="<?=$itemIds['BUY_LINK']?>" data-id="<?=$item['ID']?>" href="javascript:void(0)">Купить</a>
            </div>
        </li>
    </ul>
</div>