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
						<div class="head_white_basket">
							<a href="<?=$arParams['PATH_TO_BASKET']?>" class="head_white_basket_ic <?if ($allSumma>0):?>red<?endif?>">
								<span ><?=$allQuantity?></span>
							</a>
    
						</div>


						<?if ($allSumma>0):?>
							<div class="head_hover_bl">
							<a class="head_white_basket_bt basket-fsr" href="<?=$arParams['PATH_TO_BASKET']?>"><span><?=number_format($allSumma, 0, '', ' ')?></span> руб.</a>
							<a class="head_white_basket_bt basket-vsr" href="<?=$arParams['PATH_TO_BASKET']?>">В корзину</a>
							</div>
	<?else:?>
							<span class="head_white_battle_tit empty-basket" style="margin: 0 0 18px 0;padding: 0;">0 руб</span>
	<?endif?>
