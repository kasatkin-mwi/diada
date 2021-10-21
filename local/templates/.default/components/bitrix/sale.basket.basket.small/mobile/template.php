<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();?>
<?/*echo "<pre>";print_r($arResult);echo "</pre>";*/?>
<?
$allQuantity = 0;
foreach($arResult['ITEMS'] as $arItem)
{
	$allQuantity += $arItem['QUANTITY'];
}
/*
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
<?*/?>
<a class="bx-basket-block mobile_header_top_basket" href="<?= $arParams['PATH_TO_BASKET'] ?>">
    <span class="mobile_header_top_basket_kol"><?=$allQuantity?></span>
</a>