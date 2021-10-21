<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>





<div class="cont_city_tabs_bl">

    <div class="cont_city_select_bl">

        <div class="cont_city_tit">Выберите свой город из списка</div>

        <div class="cont_city_select">

            <?

            $currentLocation = '';

            foreach ($arResult['ITEMS'] as $arItem) 

            {

      



                if($arItem['ID'] == $arParams['ELEMENT_ID'])

                {

                    $currentLocation = $arItem['NAME'];

                    break;

                }

            }?>

            

            <a class="cont_city_select_bt" href="javascript:void(0);">Ваш город: <span class="b"><?=$currentLocation?></span></a>

            <div class="cont_city_select_list">

                <?

                foreach ($arResult['ITEMS'] as $arItem) 

                {

                    ?>

                    <a href="/contacts/<?=$arItem["PROPERTIES"]["CHPUFOR"]["VALUE"]?>/"><?=$arItem['NAME']?></a>

                    <?

                }

                ?>

            </div>

        </div>

    </div>

    <div class="cont_tabs_bl">

        <ul class="tabs">

            <li class="list current"><i class="fa fa-list-ul" aria-hidden="true"></i>Показать список</li>

            <li class="map"><i class="fa fa-map-marker" aria-hidden="true"></i>Показать на карте</li>

        </ul>

    </div>

</div>

<?/*

<ul class="red_button_tabs">

	<?foreach ($arResult['ITEMS'] as $arItem) {?>

		<li <?=$arItem['ID'] == $arParams['ELEMENT_ID'] ? 'class="current"' : ''?> onclick="location.href=$(this).find('a').attr('href');"><a onclick="return false;" href="<?=$arItem['DETAIL_PAGE_URL']?>"><?=$arItem['NAME']?></a></li>

	<?}?>

</ul>*/?>