<?if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED!==true) die();
$compositeStub = (isset($arResult['COMPOSITE_STUB']) && $arResult['COMPOSITE_STUB'] == 'Y');
?>
<a class="bx-basket-block mobile_header_top_basket"	href="<?= $arParams['PATH_TO_BASKET'] ?>">
    <span class="mobile_header_top_basket_kol"><?=$arResult['NUM_PRODUCTS']?></span>
</a>