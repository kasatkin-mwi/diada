<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<?$this->setFrameMode(true);?>
<?foreach ($arResult['PROPERTIES']['PHONES']['~VALUE'] as $val) {?>
    <?preg_match("#([\d-\(\)\s]*)\s(.*)#i", $val, $arPhone)?>
    <div class="foot_tel_el">
    	<i class="fa fa-phone" aria-hidden="true"></i>
        <a href="tel:<?=$arPhone[1]?>"><?=$arPhone[1]?></a>
    	<span><?=$arPhone[2]?></span>
    </div>
<?}?>