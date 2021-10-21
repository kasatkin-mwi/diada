<?require_once($_SERVER['DOCUMENT_ROOT'] . "/bitrix/modules/main/include/prolog_before.php");

if($_SERVER["REQUEST_METHOD"] == 'POST' && !empty($_REQUEST['number']))
{
    Bitrix\Main\Loader::includeModule("sale");
    Bitrix\Main\Loader::includeModule("iblock");
    
    $arResult = array();
    $obElement = CIBlockElement::GetList(
        array(), 
        array(
            'IBLOCK_ID' => 36,
            'ACTIVE' => 'Y',
            'ID' => $_REQUEST['number'],
            //'PROPERTY_ORDER_ID' => $_REQUEST['number'],
        ), 
        false, 
        false, 
        array(
            'ID',
            'NAME',
            'IBLOCK_ID'
        )
    );
    while($rsElement = $obElement->GetNextElement())
    {
        $arElement = $rsElement->GetFields();    
        $arElement['PROPERTIES'] = $rsElement->GetProperties();
        
        if(!empty($arElement['PROPERTIES']['ORDER_ID']['VALUE']))
        {
            $order = Bitrix\Sale\Order::load($arElement['PROPERTIES']['ORDER_ID']['VALUE']);    
            if(!empty($order))
            {
                $basket = $order->getBasket();
                foreach($basket as $basketItem)
                {
                    if(intval($basketItem->getProductId()) > 0)
                    {
                        $obItem = CIBlockElement::GetList(
                            array(), 
                            array(
                                'ID' => $basketItem->getProductId(),
                            ), 
                            false, 
                            false, 
                            array(
                                'ID',
                                'NAME',
                                'IBLOCK_ID',
                                'DETAIL_PICTURE',
                                'DETAIL_PAGE_URL',
                                'PROPERTY_ITEM_CODE'
                            )
                        );
                        if($arItem = $obItem->GetNext())
                        {
                            if(intval($arItem['DETAIL_PICTURE']) > 0)
                            {
                                $image = CFile::ResizeImageGet($arItem['DETAIL_PICTURE'], array('width' => 60, 'height' => 60), BX_RESIZE_IMAGE_PROPORTIONAL, true); 
                            }
                            
                            $serialNumber = '';
                            if(!empty($arItem['PROPERTY_ITEM_CODE_VALUE']))
                            {
                                $reverse = strrev($arItem['PROPERTY_ITEM_CODE_VALUE']);
                                $serialNumber = chunk_split($reverse, 4, ' ');   
                                $serialNumber = strrev($serialNumber); 
                            }
                            
                            $arElement['ITEMS'][] = array(
                                'NAME' => $arItem['NAME'], 
                                'DETAIL_PAGE_URL' => $arItem['DETAIL_PAGE_URL'], 
                                'DETAIL_PICTURE' => !empty($image) ? $image : array(), 
                                'SERIAL_NUMBER' => $serialNumber, 
                            );   
                        }
                    }     
                }    
            }
        }
        
        $arResult[] = $arElement;
    }
    
    //echo '<pre>';echo '<br>'; var_export($arResult); echo '</pre>';
    if(!empty($arResult))
    {
        ?>
        <div>
            <div class="result_cont" style="position: relative;">
                <div class="result_gray_tit">Результат поиска:</div>
                <?foreach($arResult as $item):?>
                    <div class="result_table_bl">
                        <div class="result_table_tit">Заявка №<?=$item['ID']?></div>
                        <div class="result_table_cont">
                            <div class="result_table_head">
                                <?/*<div>Товар</div>*/?>
                                <div>Заказ</div>
                                <div>Статус заявки</div>
                            </div>
                            <?
                            /*$count = 0;
                            foreach($item['ITEMS'] as $key => $product)
                            {
                                $count++;
                                ?>
                                <div class="result_table_el">
                                    <div class="result_table_ic">
                                        <?
                                        if(!empty($product['DETAIL_PICTURE']))
                                        {
                                            ?>
                                            <img src="<?=$product['DETAIL_PICTURE']['src']?>"/>
                                            <?    
                                        }
                                        ?>
                                    </div>
                                    <div class="result_table_info">
                                        <div class="result_table_name">
                                            <a href="<?=$product['DETAIL_PAGE_URL']?>" target="_blank">
                                                <?=$product['NAME']?>
                                            </a>
                                        </div>
                                        <div class="result_table_grp">Серийный номер: <?=$product['SERIAL_NUMBER']?></div>
                                        <div class="result_table_grp">Номер заказа: <?=$item['PROPERTIES']['ORDER_ID']['VALUE']?></div>
                                    </div>
                                    <?
                                    if($count == 1)
                                    {
                                        ?>
                                        <div class="result_table_stat">
                                            <?
                                            if(!empty($item['PROPERTIES']['STATUS']['VALUE']))
                                            {
                                                ?>
                                                <div class="<?=$item['PROPERTIES']['STATUS']['VALUE_XML_ID']?>"><?=$item['PROPERTIES']['STATUS']['VALUE']?></div>
                                                <?
                                            }
                                            else
                                            {
                                                ?>
                                                <div class="gray">Ожидает проверки</div>
                                                <?    
                                            }
                                            ?>
                                        </div>
                                        <?    
                                    }
                                    ?>
                                </div>
                                <?     
                            }*/
                            ?>
                            <div class="result_table_el">
                                <div class="result_table_info">
                                    <div class="result_table_name">
                                        № <?=$item['PROPERTIES']['ORDER_ID']['VALUE']?>
                                    </div>    
                                </div>
                                <div class="result_table_stat">
                                    <?
                                    if(!empty($item['PROPERTIES']['STATUS']['VALUE']))
                                    {
                                        ?>
                                        <div class="<?=$item['PROPERTIES']['STATUS']['VALUE_XML_ID']?>"><?=$item['PROPERTIES']['STATUS']['VALUE']?></div>
                                        <?
                                    }
                                    else
                                    {
                                        ?>
                                        <div class="gray">Ожидает проверки</div>
                                        <?    
                                    }
                                    ?>
                                </div>    
                            </div>
                        </div>
                    </div>
                <?endforeach;?>
            </div>
        </div>
        <?    
    }
    else
    {
        ?>
        <div>
            <div class="result_cont">
                <div class="result_gray_tit">Результат поиска:</div>
                <div class="result_not_found">
                    <p>Извините, по Вашему запросу ничего не найдено.</p>
                    <p>Проверьте правильность ввода  № заявки.</p>
                </div>
            </div>
        </div>
        <?    
    }
}
else
{
    ?>
    <div>
        <div class="result_cont">
            <div class="result_gray_tit">Результат поиска:</div>
            <div class="result_not_found">
                <p>Извините, по Вашему запросу ничего не найдено.</p>
                <p>Проверьте правильность ввода  № заявки.</p>
            </div>
        </div>
    </div>
    <?
}