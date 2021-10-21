<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<?
$APPLICATION->SetPageProperty('title','Контакты: г. '.$arResult['NAME'].' | Интернет-магазин Diada-Arms');
$APPLICATION->SetPageProperty('description','Контакты: '.$arResult['NAME'].'. Интернет-магазин Diada-Arms предлагает большой ассортимент качественных товаров для активного отдыха и охоты.');
$APPLICATION->SetTitle('Контакты: г. '.$arResult['NAME']);
?>
<div class="box box1" style="display:block;">
    <div class="store_address_bl">
        <div class="store_address_tit_bl">
            <?=$arResult['PREVIEW_TEXT']?>
            <?/*<div class="store_addr_tit">Адрес магазина г. Москва</div>
            <div class="store_addr_comm">Уточняйте наличие товара у наших менеджеров <i class="fa fa-exclamation" aria-hidden="true"></i></div>*/?>
        </div>
        <div class="store_address_cont" itemscope itemtype="http://schema.org/Organization">
            <meta itemprop="name" content="Diada-Arms">
            <meta itemprop="email" content="info@diada-arms.ru"> 
            <div class="store_address_info">
                <div class="store_address_list">
                    <div class="store_address_col">
                        <?
                        if ($arResult['PROPERTIES']['SUBWAY']['VALUE']) 
                        {
                            $file = false;
                            if ($arResult['PROPERTIES']['SUBWAY_ICON']['VALUE'])
                                $file = CFile::GetFileArray($arResult['PROPERTIES']['SUBWAY_ICON']['VALUE']);
                            ?>
                            <div class="cont_metro_ic"<?=$file ? ' style="background-image:url('.$file['SRC'].')"' : ''?>><?=$arResult['PROPERTIES']['SUBWAY']['VALUE']?></div>
                        <?
                        }
                        ?>
                        <div class="cont_map_ic" itemprop="address" itemscope itemtype="http://schema.org/PostalAddress"><i class="fa fa-map-marker" aria-hidden="true"></i>
                            <meta itemprop="addressLocality" content="<?=$arResult['NAME']?>">
                            <meta itemprop="streetAddress" content="<?=$arResult['PROPERTIES']['ADDRESS']['VALUE']?>">
                            <?=$arResult['PROPERTIES']['ADDRESS']['VALUE']?>
                        </div>
                    </div>
                    <div class="store_address_col">
                        <?
                        foreach ($arResult['PROPERTIES']['WORK_TIME']['VALUE'] as $val) 
                        {
                            if($val[0] == '8' || $val[0]=='+' || $val[0] == '7')
                            {
                                ?>
                                <div class="cont_tel_ic"><i class="fa fa-phone" aria-hidden="true"></i><a href="tel:<?=$val?>" itemprop="telephone"><?=$val?></a></div>
                                <?        
                            }    
                        }
                        ?>
                    </div>
                    <div class="store_address_col">
                        <?
                        foreach ($arResult['PROPERTIES']['WORK_TIME']['VALUE'] as $val) 
                        {
                            if($val[0] != '8' && $val[0] != '+' && $val[0] != '7')
                            {
                                ?>
                                <div class="cont_clock_ic"><i class="fa fa-clock-o" aria-hidden="true"></i><?=$val?></div>
                                <?        
                            }    
                        }
                        ?>
                    </div>
                </div>
                <div class="store_addr_video_map">
                    <?
                    if ($arResult['PROPERTIES']['VIDEO']['VALUE']) 
                    {
                        ?>
                        <div class="store_addr_video">
                            <iframe width="100%" height="245" src="https://www.youtube.com/embed/<?=$arResult['PROPERTIES']['VIDEO']['VALUE']?>?showinfo=0" frameborder="0" allowfullscreen=""></iframe>
                        </div>
                    <?
                    }
                    ?>
                    <div class="store_addr_map">
                        <div id="store_map" style="height: 237px;"></div>
                        <script>
                            ymaps.ready(function() {
                                var map = new ymaps.Map('store_map', {
                                    center: [<?=$arResult['PROPERTIES']['MAP']['VALUE']?>],
                                    zoom: 13
                                });
                                map.controls.add('mapTools', {left: 35, top: 5});
                                map.controls.add('zoomControl', {left: 5, top: 5});
                                
                                var str = '<?=$arResult['PROPERTIES']['ADDRESS']['VALUE']?>';
                                
                                var placemark = new ymaps.Placemark(
                                    [<?=$arResult['PROPERTIES']['MAP']['VALUE']?>],
                                    {
                                        iconContent: '',
                                        balloonContent: str,
                                        hintContent: str
                                    }
                                );
                                map.geoObjects.add(placemark);
                            });
                        </script>
                    </div>
                </div>
            </div>
            <div class="store_address_bt_bl">
                <?
                if ($arResult['PROPERTIES']['HOW_TO_FIND_TEXT']['VALUE']['TEXT']) 
                {
                    ?>
                    <a href="#HOW_TO_FIND_TEXT" class="fancy">Как найти на словах</a>
                    <div style="display: none;" id="HOW_TO_FIND_TEXT"><?=$arResult['PROPERTIES']['HOW_TO_FIND_TEXT']['~VALUE']['TEXT']?></div>
                <?
                }
                if ($arResult['PROPERTIES']['HOW_TO_FIND_PICT']['VALUE']) 
                {
                    ?>
                    <?$file = CFile::GetFileArray($arResult['PROPERTIES']['HOW_TO_FIND_PICT']['VALUE']);?>
                    <a href="<?=$file['SRC']?>" class="fancy">Схема проезда</a>
                <?
                }
                ?>
            </div>
        </div>
    </div>
    <?
    if (!empty($arResult['STORES'])) 
    {
        ?>
        <div class="store_address_bl">
            <div class="store_address_tit_bl">
                <div class="store_addr_tit">Адреса пунктов выдачи г. <?=$arResult['NAME']?></div>
            </div>
            <?
            foreach ($arResult['STORES'] as $arStore) 
            {
                ?>
                <div class="store_address_cont">
                    <div class="store_address_info">
                        <div class="store_address_list">
                            <div class="store_address_col">
                                <div class="cont_map_ic" itemprop="address" itemscope itemtype="http://schema.org/PostalAddress">
                                    <?php 
                                        preg_match('#г. (.*?), (.*?)$#', trim($arStore['PROPERTIES']['ADDRESS']['VALUE']), $mtchs);
                                        if ( !empty($mtchs[1]) && !empty($mtchs[2]) ){
                                            ?>
                                            <meta itemprop="addressLocality" content="г. <?=$mtchs[1]?>">
                                            <meta itemprop="streetAddress" content="<?=$mtchs[2]?>">
                                            <?
                                        }else{
                                            ?>
                                            <meta itemprop="addressLocality" content="<?=$arResult['NAME']?>">
                                            <meta itemprop="streetAddress" content="<?=$arStore['PROPERTIES']['ADDRESS']['VALUE']?>">
                                            <?
                                        }
                                    ?>
                                    <i class="fa fa-map-marker" aria-hidden="true"></i>
                                    <?=$arStore['PROPERTIES']['ADDRESS']['VALUE']?>
                                </div>
                            </div>
                            <?
                            if ($arStore['PROPERTIES']['SUBWAY']['VALUE']) 
                            {
                                $file = false;
                                if ($arStore['PROPERTIES']['SUBWAY_ICON']['VALUE'])
                                    $file = CFile::GetFileArray($arStore['PROPERTIES']['SUBWAY_ICON']['VALUE']);
                                ?>
                                <div class="store_address_col">
                                    <div class="cont_metro_ic"<?=$file ? ' style="background-image:url('.$file['SRC'].')"' : ''?>>
                                        <?=$arStore['PROPERTIES']['SUBWAY']['VALUE']?>
                                    </div>
                                </div>
                            <?
                            }
                            ?>
                            
                            <div class="store_address_col">
                                <?
                                foreach ($arStore['PROPERTIES']['WORK_TIME']['VALUE'] as $val) 
                                {
                                    if($val[0] != '8' && $val[0] != '+' && $val[0] != '7')
                                    {
                                        ?>
                                        <div class="cont_clock_ic">
                                            <i class="fa fa-clock-o" aria-hidden="true"></i><?=$val?>
                                        </div>
                                        <?    
                                    }
                                }
                                ?>
                            </div>
                        </div>
                    </div>
                    <div class="store_address_bt_bl">
                        <?
                        if ($arStore['PROPERTIES']['HOW_TO_FIND_TEXT']['VALUE']['TEXT']) 
                        {
                            ?>
                            <a href="#HOW_TO_FIND_TEXT<?=$arStore['ID']?>" class="fancy">Как найти на словах</a>
                            <div style="display: none;" class="cont_popup_shema" id="HOW_TO_FIND_TEXT<?=$arStore['ID']?>"><?=$arStore['PROPERTIES']['HOW_TO_FIND_TEXT']['~VALUE']['TEXT']?></div>
                        <?
                        }
                        ?>
                        <?
                        if ($arStore['PROPERTIES']['HOW_TO_FIND_PICT']['VALUE']) 
                        {
                            $file = CFile::GetFileArray($arStore['PROPERTIES']['HOW_TO_FIND_PICT']['VALUE']);?>
                            <a href="<?=$file['SRC']?>" class="fancy">Схема проезда</a>
                            <?
                        }
                        ?>
                    </div>
                </div>
                <?
            }
            ?>
        </div>
        <?    
    }
    ?>
</div>

<?
if (!empty($arResult['STORES'])) 
{
    ?>
    <div class="box box1">
        <div class="store_address_bl">
            <div class="store_address_tit_bl">
                <div class="store_addr_tit">Адреса пунктов выдачи г. <?=$arResult['NAME']?></div>
            </div>
            <div>
                <div class="big_map display_none_m display_none_mp" id="big_map"></div>
                <div class="big_map display_none_p display_none_c" id="big_map2"></div>
            </div>
        </div>
    </div>
    <script>
        ymaps.ready(function() {
            var map = new ymaps.Map('big_map', {
                center: [55.733835, 37.588227],
                zoom: 13
            });
            map.controls.add('mapTools', {left: 35, top: 5});
            map.controls.add('zoomControl', {left: 5, top: 5});
            
            var clusterer = new ymaps.Clusterer();
            
            var placemarks = {};
            
            <?foreach ($arResult['STORES'] as $arStore) {?>
                placemarks['<?=$arStore['ID']?>'] = new ymaps.Placemark(
                    [<?=$arStore['PROPERTIES']['MAP']['VALUE']?>],
                    {
                        iconContent: '',
                        balloonContent: '<?=$arStore['PROPERTIES']['ADDRESS']['VALUE']?>',
                        hintContent: '<?=$arStore['PROPERTIES']['ADDRESS']['VALUE']?>'
                    }
                );
                clusterer.add(placemarks[<?=$arStore['ID']?>]);
            <?}?>
            
            map.geoObjects.add(clusterer);
            
            map.setBounds(clusterer.getBounds());
            map.setZoom(map.getZoom(), {checkZoomRange: true});
            
            map.events.add('sizechange', function () {
                map.setBounds(clusterer.getBounds());
                map.setZoom(map.getZoom(), {checkZoomRange: true});
            });
        
            $('.gray_cursor a').click(function() {
                $('html, body').animate({
                    scrollTop: $('#big_map').offset().top
                }, 200);
                map.setCenter(placemarks[$(this).attr('data-id')].geometry.getCoordinates(), 16);
                placemarks[$(this).attr('data-id')].events.fire('click');
                return false;
            });
        });
        ymaps.ready(function() {
            var map = new ymaps.Map('big_map2', {
                center: [55.733835, 37.588227],
                zoom: 13
            });
            map.controls.add('mapTools', {left: 35, top: 5});
            map.controls.add('zoomControl', {left: 5, top: 5});
            
            var clusterer = new ymaps.Clusterer();
            
            var placemarks = {};
            
            <?foreach ($arResult['STORES'] as $arStore) {?>
                placemarks['<?=$arStore['ID']?>'] = new ymaps.Placemark(
                    [<?=$arStore['PROPERTIES']['MAP']['VALUE']?>],
                    {
                        iconContent: '',
                        balloonContent: '<?=$arStore['PROPERTIES']['ADDRESS']['VALUE']?>',
                        hintContent: '<?=$arStore['PROPERTIES']['ADDRESS']['VALUE']?>'
                    }
                );
                clusterer.add(placemarks[<?=$arStore['ID']?>]);
            <?}?>
            
            map.geoObjects.add(clusterer);
            
            map.setBounds(clusterer.getBounds());
            map.setZoom(map.getZoom(), {checkZoomRange: true});
            
            map.events.add('sizechange', function () {
                map.setBounds(clusterer.getBounds());
                map.setZoom(map.getZoom(), {checkZoomRange: true});
            });
        
            $('.gray_cursor a').click(function() {
                $('html, body').animate({
                    scrollTop: $('#big_map').offset().top
                }, 200);
                map.setCenter(placemarks[$(this).attr('data-id')].geometry.getCoordinates(), 16);
                placemarks[$(this).attr('data-id')].events.fire('click');
                return false;
            });
        });
    </script>
<?
}
?>