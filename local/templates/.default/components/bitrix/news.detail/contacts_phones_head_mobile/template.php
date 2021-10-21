<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<?$this->setFrameMode(true);?>
<?preg_match("#([\d-\(\)\s]*)\s(.*)#i", $arResult['PROPERTIES']['PHONES']['~VALUE'][0], $arPhone)?>
<li><div class="mobile_header_telephone"><a  style="text-decoration: none" href="tel:<?=$arPhone[1]?>"><?=$arPhone[1]?></a><span class="display_none_m"><?=$arPhone[2]?></span></div></li>