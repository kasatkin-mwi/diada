<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<?
global $USER;
?>
<div class="section">
    <?if ($arResult['PROPERTIES']['CONTACTS']['VALUE'] > 0) {?>
        <ul class="tabs dostavka_tabs_block">
            <li class="current"><span class="dostavka_tabs_car">ДОСТАВКА</span></li>
            <li><span class="dostavka_tabs_shop">САМОВЫВОЗ</span></li>
        </ul>
    <?}?>
    <div class="box dostavka_box_block" style="display:block;">
        <?$arResult['PREVIEW_TEXT'] = str_replace("/images/contacts/dostavka_big_img.png", "/img/dostavka_big_img.png", $arResult['PREVIEW_TEXT']);?>
        <?=$arResult['PREVIEW_TEXT']?>
    </div>