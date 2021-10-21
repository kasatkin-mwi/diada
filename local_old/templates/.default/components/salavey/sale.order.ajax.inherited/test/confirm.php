<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

use Bitrix\Main\Localization\Loc;

/**
 * @var array $arParams
 * @var array $arResult
 * @var $APPLICATION CMain
 */

if ($arParams["SET_TITLE"] == "Y")
	$APPLICATION->SetTitle(Loc::getMessage("SOA_ORDER_COMPLETE"));
?>

<? if (!empty($arResult["ORDER"])): ?>
    <div class="standart_width" style="padding: 40px 0;margin-bottom: 20px;">
        <ul class="basket_page_breadcrumbs not_style">
            <li><a class="basket_page_breadcrumbs_prev" href="<?=(preg_match("/personal\/order/",$_SERVER["HTTP_REFERER"]))?"/catalog/":$_SERVER["HTTP_REFERER"]?>">Вернуться к покупкам</a></li>
        </ul>
        <ul class="basket_page_navigation_block not_style">
            <li><div class="basket_page_navigation_el icon1 current">Ваша корзина</div></li>
            <li><div class="basket_page_navigation_el icon2 current">Детали получения</div></li>
            <li><div class="basket_page_navigation_el icon3 current">Покупка завершена!</div></li>
        </ul>
        <?
        $order = Bitrix\Sale\Order::load($arResult["ORDER"]["ID"]);
        $propertyCollection = $order->getPropertyCollection();
        $shipmentCollection = $order->getShipmentCollection();
        foreach ($propertyCollection as $properties){
            if ($properties->getPropertyId() == 17){
                $locRes = Bitrix\Sale\Location\LocationTable::getList(array('select' => array('NAME'),"filter" => array("CODE" => $properties->getValue())));
                while ($loc_name = $locRes->fetch()) {
                    if ($loc_name["SALE_LOCATION_LOCATION_NAME_LANGUAGE_ID"] == "ru") {
                        $listProps[17] = $loc_name["SALE_LOCATION_LOCATION_NAME_NAME"];
                    }
                }
            }
            else {
                if($properties->getPropertyId() == 46)
                {
                    if(!empty($properties->getValue()))
                    {
                        $listProps[17] = $listProps[17]." ".$properties->getValue();
                    }    
                }
                
                $listProps[$properties->getPropertyId()] = $properties->getValue();
            }
        }
        $basket = $order->getBasket();
        ?>
        <div>
            <div class="basket_page_left_col">
                <div class="new_basket_el order_create_success">
                    <div>Ваш заказ №<?=$arResult["ORDER"]["ID"]?> оформлен!</div>
                    <?
                    if(!preg_match("/^auto_[\d]+@diada-email.ru/",$listProps[6]))
                    {
                        ?>
                        <div>Письмо с подтверждением заказа отправлено на <?=$listProps[6]?></div>
                        <?    
                    }
                    ?>
                </div>
				<div class="order_create_success_basket_el">
                <div class="order_create_success_title">Номер заказа <?=$arResult["ORDER"]["ID"]?></div>
                <?foreach ($basket as $item):?>
                    <div class="new_basket_el">
                        <div class="new_basket_el_left">
                            <div class="new_basket_el_left_img">
                                <?$product = $item->getProductId();?>
                                <?
                                Bitrix\Main\Loader::includeModule("iblock");
                                $infoProduct = CIBlockElement::GetByID($product)->GetNext();
                                if ($infoProduct["DETAIL_PICTURE"]>0){
                                    $pathImg = CFile::GetPath($infoProduct["DETAIL_PICTURE"]);
                                }
                                elseif($infoProduct["PREVIEW_PICTURE"]>0){
                                    $pathImg = CFile::GetPath($infoProduct["PREVIEW_PICTURE"]);
                                }
                                ?>
                                <img class="bx_ordercart_photo" src="<?=$pathImg?>" alt=""/>
                            </div>
                            <div class="new_basket_el_left_title">
                                <h2 class="bx_ordercart_itemtitle"><a href="<?=$item->getField("DETAIL_PAGE_URL")?>"><?=$item->getField("NAME");?></a></h2>
                                <?
                                $basketPropRes = Bitrix\Sale\Internals\BasketPropertyTable::getList(array(
                                    'filter' => array(
                                        "BASKET_ID" => $item->getId(),
                                    ),
                                ));
                                ?>
                                <div class="block_props_basket">
                                    <?while ($prop = $basketPropRes->fetch()):?>
                                        <?if (in_array($prop["CODE"],array("CATALOG.XML_ID", "PRODUCT.XML_ID", "SERVICE"))) continue;?>
                                        <span><?=$prop["NAME"]?>:</span> <?=$prop["VALUE"]?><br />
                                    <?endwhile;?>
                                </div>
                            </div>
                        </div>
                        <div class="new_basket_el_right">
                            <div class="current_price">
                                <div class="current_price_small_title">Цена</div>
                                <div class="current_price_black">
                                    <?=number_format(floatval($item->getPrice()),0,"."," ");?> р.
                                </div>
                                <?if ($item->getPrice()<$item->getField("BASE_PRICE")):?>
                                    <div class="current_price_black" style="font-size: 24px; text-decoration: line-through">
                                        <?=number_format(floatval($item->getField("BASE_PRICE")),0,"."," ");?> р.
                                    </div>
                                <?endif;?>
                            </div>
                            <div class="basket_quantity_control_block"><?=$item->getQuantity()?> шт.</div>
                        </div>
                    </div>
                <?endforeach;?>

                    <script>
                    window.dataLayer = window.dataLayer || [];
                    dataLayer.push({
                        "ecommerce": {
                            "purchase": {
                                "actionField": {
                                    "id" : "<?=$arResult["ORDER"]["ID"]?>",
                                },
                                "products": [
                                <?foreach ($basket as $item):?>   

                                    {
                                        "name": "<?=$item->getField("NAME");?>",
                                        "price": <?=$item->getPrice();?>,
                                        "quantity": <?=$item->getQuantity();?>,
                                    },
                                <?endforeach;?>

                                ]
                            }
                        }
                    });

                    </script>
                    <!--<?php var_dump($basket); ?>-->


				</div>
				<div class="block_subsection_bg">
					<div class="new_basket_el order_info_success">
						<div class="block_subsection block_subsection_user">
							<span class="block_subsection_title">Получатель</span>
							<p><?=implode(" ",array_diff(array($listProps[3],$listProps[1]),array("")))?></p>
							<?if ($listProps[5]):?>
							<p>Телефон: <?=$listProps[5]?></p>
							<?endif;?>
							<?if ($listProps[6] && !preg_match("/^auto_[\d]+@diada-email.ru/",$listProps[6])):?>
							<p>Email: <?=$listProps[6]?></p>
							<?endif;?>
						</div>
						<div class="block_subsection block_subsection_dost">
							<span class="block_subsection_title">Информация о доставке</span>
							<?
							foreach ($shipmentCollection as $shipment):?>
								<?if (!$shipment->isSystem()):?>
									<div class="block_subsection_column">
										<div class="left_block">
											<?=$shipment->GetField("DELIVERY_NAME");?>
											<?if (preg_match("/Доставка|доставка/",$shipment->GetField("DELIVERY_NAME"))):?>
												<p>
													По адресу: <?=implode(", ",array_diff(array($listProps[17],$listProps[21],$listProps[9]),array("")))?>
													<?if ($listProps[10]):?>
														корп. <?=$listProps[10]?>
													<?endif;?>
													<?if ($listProps[11]):?>
														кв. <?=$listProps[11]?>
													<?endif;?>
												</p>
												<p>
													<?=$listProps[22]?>
												</p>
												<p>Оператор свяжется с вами для уточнения времени доставки</p>

											<?endif;?>
										</div>
										<div class="right_block">
											<?=number_format(floatval($shipment->GetField("PRICE_DELIVERY")),0,"."," ");?> р.
										</div>
									</div>
								<?endif;?>
							<?endforeach;?>
						</div>
						<div class="block_subsection block_subsection_money">
							<?$paymentCollection = $order->getPaymentCollection();?>
							<span class="block_subsection_title">Способ оплаты</span>
							<?foreach ($paymentCollection as $payment):?>
								<p><?=$payment->getPaymentSystemName()?></p>
							<?endforeach;?>
						</div>
						<div class="block_subsection block_subsection_tel">
							<span class="block_subsection_title">SMS-уведомление</span>
							<p>Вы будете получать уведомление об изменении статуса Вашего заказа</br>по номеру <?=$listProps[5]?></p>
						</div>
					</div>
				</div>
            </div>
            <div class="basket_page_right_col">
                <div class="basket_page_itog_block js_new_form_lk_gray_bg default">
                    <div class="basket_page_itog_el">
                        <div class="basket_page_itog_el_name">Товары(<?=$basket->count()?>)</div>
                        <div class="basket_page_itog_el_param"><?=number_format(floatval($basket->getPrice()),0,".","&nbsp;");?> р.</div>
                    </div>
                    <div class="basket_page_itog_el">
                        <div class="basket_page_itog_el_name">Доставка</div>
                        <div class="basket_page_itog_el_param">
                            <?
                            foreach ($shipmentCollection as $shipment):?>
                                <?if (!$shipment->isSystem()):?>
                                    <?=number_format(floatval($shipment->GetField("PRICE_DELIVERY")),0,".","&nbsp;");?> р.
                                <?endif;?>
                            <?endforeach;?>
                        </div>
                    </div>
                    <div class="basket_page_itog_el">
                        <div class="basket_page_itog_el_name">Сумма заказа</div>
                        <div class="basket_page_itog_el_param" id="allSum_FORMATED"><?=number_format(floatval($order->GetField("PRICE")),0,".","&nbsp;");?> р.</div>
                    </div>
                    <a href="<?=(preg_match("/personal\/order/",$_SERVER["HTTP_REFERER"]))?"/catalog/":$_SERVER["HTTP_REFERER"]?>" class="checkout red_button">Продолжить покупки</a>
                </div>
            </div>
            <div class="clear"></div>

        </div>
    </div>
<? endif ?>