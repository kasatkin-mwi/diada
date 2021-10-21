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
<div>
    <a class="favor_srav item-<?=$item['ID']?>" href="<?=$item['COMPARE_URL']?>"><i></i></a>
    <a class="srav_favor item-<?=$item['ID']?>" href="javascript:void(0)" data-id="<?=$item['ID']?>"><i></i></a>
</div>
<div class="index_produce_left_col">
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
</div>