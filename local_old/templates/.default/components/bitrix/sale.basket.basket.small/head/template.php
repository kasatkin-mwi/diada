<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();?>
<?/*echo "<pre>";print_r($arResult);echo "</pre>";*/?>
<?
$allQuantity = 0;
$allSumma = 0;
foreach($arResult['ITEMS'] as $arItem)
{
	$allQuantity += $arItem['QUANTITY'];
	$allSumma += $arItem['QUANTITY'] * $arItem['PRICE'];
}
?>
<div>
    <?if ($allSumma>0):?>
        <a class="basket_name" href="<?=$arParams['PATH_TO_BASKET']?>"><span class="red_kol_vo"><?=$allQuantity?></span></a>
        <a class="basket_money" href="<?=$arParams['PATH_TO_BASKET']?>"><span><?=number_format($allSumma, 0, '', ' ')?> </span>руб.</a>
        <a class="red_button busket_red_dutton" href="<?=$arParams['PATH_TO_BASKET']?>">Оформить заказ</a>
    <?else:?>
        <a class="basket_name" href="<?=$arParams['PATH_TO_BASKET']?>"><span class="red_kol_vo"><?=$allQuantity?></span></a>
        <p class="basket_money">Удачных покупок!</p>
    <?endif;?>
</div>