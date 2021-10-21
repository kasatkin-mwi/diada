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
                    <?
                    if(!empty($item['CUSTOM_PRICE']))
                    {
                        if($item['CUSTOM_DISCOUNT_PRICE'] < $item['CUSTOM_PRICE'])
                        {
                            ?>
                            <p id="<?=$itemIds['PRICE']?>"><?=number_format($item["CUSTOM_DISCOUNT_PRICE"], 0, '.', ' ');?> <i class="fa fa-rub" aria-hidden="true"></i></p>
                            <p id="<?=$itemIds['PRICE_OLD']?>"><?=number_format($item["CUSTOM_PRICE"], 0, '.', ' ')?> <i class="fa fa-rub" aria-hidden="true"></i></p>
                            <?    
                        }
                        else
                        {
                            ?>
                            <p id="<?=$itemIds['PRICE']?>"><?=number_format($item["CUSTOM_PRICE"], 0, '.', ' ')?> <i class="fa fa-rub" aria-hidden="true"></i></p>
                            <?
                        }
                    }
                    else
                    {
                        ?>
                        <?foreach($item["PRICES"] as $code=>$arPrice):?>
                            <?if($arPrice["DISCOUNT_VALUE"] < $arPrice["VALUE"]):?>
                                <p id="<?=$itemIds['PRICE']?>"><?=$arPrice["PRINT_DISCOUNT_VALUE"]?></p>
                                <p id="<?=$itemIds['PRICE_OLD']?>"><?=$arPrice["PRINT_VALUE"]?></p>
                            <?else:?>
                                <p id="<?=$itemIds['PRICE']?>"><?=$arPrice["PRINT_VALUE"]?></p>
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
                            <p id="<?=$itemIds['PRICE']?>"><?=number_format($item["CUSTOM_DISCOUNT_PRICE"], 0, '.', ' ');?> <i class="fa fa-rub" aria-hidden="true"></i></p>
                            <p id="<?=$itemIds['PRICE_OLD']?>"><?=number_format($item["CUSTOM_PRICE"], 0, '.', ' ')?> <i class="fa fa-rub" aria-hidden="true"></i></p>
                            <?    
                        }
                        else
                        {
                            ?>
                            <p id="<?=$itemIds['PRICE']?>"><?=number_format($item["CUSTOM_PRICE"], 0, '.', ' ')?> <i class="fa fa-rub" aria-hidden="true"></i></p>
                            <?
                        }
                    }
                    else
                    {
                        ?>
                        <?foreach($item["PRICES"] as $code=>$arPrice):?>
                            <?if($arPrice["DISCOUNT_VALUE"] < $arPrice["VALUE"]):?>
                                <p id="<?=$itemIds['PRICE']?>"><?=$arPrice["PRINT_DISCOUNT_VALUE"]?></p>
                                <p id="<?=$itemIds['PRICE_OLD']?>"><?=$arPrice["PRINT_VALUE"]?></p>
                            <?else:?>
                                <p id="<?=$itemIds['PRICE']?>"><?=$arPrice["PRINT_VALUE"]?></p>
                            <?endif?>
                        <?endforeach;?>
                        <?
                    }
                    ?>
                <?$frame->end();?>
            </div>
        </li>
        <?/*<li class="" id="<?=$itemIds['BASKET_ACTIONS']?>">
            <div id="buy_element_button_block_<?=$item["ID"]?>">
                <a class="red_buy big-data"  id="<?=$itemIds['BUY_LINK']?>" data-id="<?=$item['ID']?>" href="javascript:void(0)">Купить</a>
            </div>
        </li>*/?>
        <li class="buy_element_button_block" id="<?=$itemIds['BASKET_ACTIONS']?>">
            <div id="buy_element_button_block_<?=$item["ID"]?>">
                <?$frame = $this->createFrame("buy_element_button_block_".$item["ID"], false)->begin("");?>
                    <?if (in_array($item['ID'], $arParams['IN_BASKET'])):?>
                        <a itemscope itemtype="http://schema.org/BuyAction"  class="buy_element_button in_basket_button" data-id="<?=$item['ID']?>" href="/personal/cart/?>">В корзину</a>
                    <?else:?>
                        <a itemscope itemtype="http://schema.org/BuyAction"  class="buy_element_button" data-id="<?=$item['ID']?>" href="<?=$item['ADD_URL']?>">Купить</a>
                    <?endif;?>
                <?$frame->end();?>
               <!--  <a itemscope itemtype="http://schema.org/BuyAction"  class="buy_element_button big-data"  id="<?=$itemIds['BUY_LINK']?>" data-id="<?=$item['ID']?>" href="javascript:void(0)">Купить</a> -->
            </div>
            <div class="clear"></div>
        </li>
    </ul>
</div>