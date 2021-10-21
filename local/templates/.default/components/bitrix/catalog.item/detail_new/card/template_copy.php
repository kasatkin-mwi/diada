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

<div class="list_element_catalog table_element_catalog">
    <div>
        <a class="favor_srav item-<?=$item['ID']?>" href="<?=$item['COMPARE_URL']?>"><i></i></a>
        <a class="srav_favor item-<?=$item['ID']?>" href="javascript:void(0)" data-id="<?=$item['ID']?>"><i></i></a>
    </div>
    <a class="list_element_title" href="<?=$item['DETAIL_PAGE_URL']?>"><?=$item['NAME']?></a>
    <p class="list_element_img">
        <?if (strlen($resizeImg)>0):?>
            <a href="<?=$item['DETAIL_PAGE_URL']?>"><img src="<?=$resizeImg?>" id="<?=$itemIds['PICT']?>" /></a>
        <?endif;?>
    </p>
    <div class="display_none_c">
        <ul class="not_style">
            <li class="adaptiv_list_element_img">
                <?if ($item['PREVIEW_PICTURE']):?>
                    <a href="<?=$item['DETAIL_PAGE_URL']?>"><img src="<?=$resizeImg?>" /></a>
                <?endif;?>
            </li>
        </ul>
        <ul class="not_style">
            <li class="money_element">
                <div id="money_element_<?=$item["ID"]?>">
                    <?$frame = $this->createFrame("money_element_".$item["ID"], false)->begin();?>
                        <?foreach($item["PRICES"] as $code=>$arPrice):?>
                            <?if($arPrice["DISCOUNT_VALUE"] < $arPrice["VALUE"]):?>
                                <?=$arPrice["PRINT_DISCOUNT_VALUE"]?><span><?=$arPrice["PRINT_VALUE"]?></span>
                            <?else:?>
                                <?=$arPrice["PRINT_VALUE"]?>
                            <?endif?>
                        <?endforeach;?>
                    <?$frame->beginStub();?>
                        <?foreach($item["PRICES"] as $code=>$arPrice):?>
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
        <li class="set_reting_product_<?=$item["ID"]?>"></li>
    </ul>
    <ul class="table_buy_money">
        <li class="money_element display_none_m display_none_mp display_none_p">
            <div id="table_money_element_<?=$item["ID"]?>">
                <?$frame = $this->createFrame("table_money_element_".$item["ID"], false)->begin();?>
                    <?foreach($item["PRICES"] as $code=>$arPrice):?>
                        <?if($arPrice["DISCOUNT_VALUE"] < $arPrice["VALUE"]):?>
                            <div id="<?=$itemIds['PRICE']?>"><?=$arPrice["PRINT_DISCOUNT_VALUE"]?></div>
                            <span id="<?=$itemIds['PRICE_OLD']?>"><?=$arPrice["PRINT_VALUE"]?></span>
                        <?else:?>
                            <div id="<?=$itemIds['PRICE']?>"><?=$arPrice["PRINT_VALUE"]?></div>
                        <?endif?>
                    <?endforeach;?>
                <?$frame->beginStub();?>
                    <?foreach($item["PRICES"] as $code=>$arPrice):?>
                        <?if($arPrice["DISCOUNT_VALUE"] < $arPrice["VALUE"]):?>
                            <div id="<?=$itemIds['PRICE']?>"><?=$arPrice["PRINT_DISCOUNT_VALUE"]?></div>
                            <span id="<?=$itemIds['PRICE_OLD']?>"><?=$arPrice["PRINT_VALUE"]?></span>
                        <?else:?>
                            <div id="<?=$itemIds['PRICE']?>"><?=$arPrice["PRINT_VALUE"]?></div>
                        <?endif?>
                    <?endforeach;?>
                <?$frame->end();?>
            </div>
        </li>
        <li class="buy_element">
            <div class="buy_number" data-entity="quantity-block">
                <a class="js_number_prev" href=""><img src="/img/number_prev.png" alt=""/></a>
                <input name="count" class="number" id="<?=$itemIds['QUANTITY']?>" type="text" value="1"/>
                <a class="js_number_next" href=""><img src="/img/number_next.png" alt=""/></a>
            </div>
            <div class="clear"></div>
        </li>
        <li class="buy_element_button_block" id="<?=$itemIds['BASKET_ACTIONS']?>">
            <div id="buy_element_button_block_<?=$item["ID"]?>">
                <?/*$frame = $this->createFrame("buy_element_button_block_".$item["ID"], false)->begin("");?>
                    <?if (in_array($item['ID'], $arParams['IN_BASKET'])):?>
                        <a itemscope itemtype="http://schema.org/BuyAction"  class="buy_element_button in_basket_button" data-id="<?=$item['ID']?>" href="/personal/cart/?>">В корзину</a>
                    <?else:?>
                        <a itemscope itemtype="http://schema.org/BuyAction"  class="buy_element_button" data-id="<?=$item['ID']?>" href="<?=$item['ADD_URL']?>">Купить</a>
                    <?endif;?>
                <?$frame->end();*/?>
                <a itemscope itemtype="http://schema.org/BuyAction"  class="buy_element_button big-data"  id="<?=$itemIds['BUY_LINK']?>" data-id="<?=$item['ID']?>" href="javascript:void(0)">Купить</a>
            </div>
            <div class="clear"></div>
        </li>
    </ul>
    <div class="table_element_catalog_light">
        <div class="display_none_m display_none_mp display_none_p">
        <?
        foreach( explode("<br>", strip_tags($item["PREVIEW_TEXT"], '<br>')) as $str ):
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

        <?/*<p class="add_sravnenie"><label><input type="checkbox" data-url="<?=$item['COMPARE_URL']?>" />Добавить в сравнение</label></p>*/?>
    </div>
</div>