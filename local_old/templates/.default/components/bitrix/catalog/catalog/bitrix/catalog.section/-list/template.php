<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
/** @var array $arParams */
/** @var array $arResult */
/** @global CMain $APPLICATION */
/** @global CUser $USER */
/** @global CDatabase $DB */
/** @var CBitrixComponentTemplate $this */
/** @var string $templateName */
/** @var string $templateFile */
/** @var string $templateFolder */
/** @var string $componentPath */
/** @var CBitrixComponent $component */
$this->setFrameMode(true);

$strElementEdit = CIBlock::GetArrayByID($arParams["IBLOCK_ID"], "ELEMENT_EDIT");
$strElementDelete = CIBlock::GetArrayByID($arParams["IBLOCK_ID"], "ELEMENT_DELETE");
$arElementDeleteParams = array("CONFIRM" => GetMessage('CT_BCS_TPL_ELEMENT_DELETE_CONFIRM'));
?>
<div class="catalog_list">
<!--RestartBuffer123-->
<?
foreach ($arResult['ITEMS'] as $key => $arItem):

	$this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], $strElementEdit);
	$this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], $strElementDelete, $arElementDeleteParams);
	$strMainID = $this->GetEditAreaId($arItem['ID']);
	?>
	<div class="list_element_catalog parent_block" id="<?=$strMainID;?>">
		<table>
			<tr><td colspan="3"><a class="list_element_title" href="<?=$arItem['DETAIL_PAGE_URL']?>"><?=$arItem['NAME']?></a></td></tr>
			<tr>
				<td class="list_element_img">
					<?if ($arItem['PREVIEW_PICTURE']):?>
						<a href="<?=$arItem['DETAIL_PAGE_URL']?>"><img src="<?=$arItem['PREVIEW_PICTURE']['SRC']?>" /></a>
					<?endif;?>
				</td>
				<td class="list_element_opisanie">
					<?
					foreach( explode("<br>", strip_tags($arItem["PREVIEW_TEXT"], '<br>')) as $str ):
						$str = str_replace("&nbsp;", "", $str);
						$arStr = explode(":", $str);
						?>
						<ul class="opisanie_element_catalog not_style">
							<li><?=trim($arStr[0])?>:</li>
							<li><?=trim($arStr[1])?></li>
						</ul>
						<?
					endforeach;
					?>
				</td>
				<td class="list_element_buy">
					<p class="money_element">
						<?foreach($arItem["PRICES"] as $code=>$arPrice):?>
							<?if($arPrice["DISCOUNT_VALUE"] < $arPrice["VALUE"]):?>
								<span><?=$arPrice["PRINT_VALUE"]?></span><?=$arPrice["PRINT_DISCOUNT_VALUE"]?>
							<?else:?>
								<?=$arPrice["PRINT_VALUE"]?>
							<?endif?>
						<?endforeach;?>
					</p>
					<div class="buy_element">
						<div class="buy_number">
							<a class="js_number_prev" href=""><img src="/img/number_prev.png" alt=""/></a>
							<input class="number" type="number" value="1"/>
							<a class="js_number_next" href=""><img src="/img/number_next.png" alt=""/></a>
						</div>
						<?if (in_array($arItem['ID'], $arParams['IN_BASKET'])):?>
							<a itemscope itemtype="http://schema.org/BuyAction" class="buy_element_button in_basket_button" data-id="<?=$arItem['ID']?>" href="/personal/cart/?>">В корзину</a>
						<?else:?>
							<a itemscope itemtype="http://schema.org/BuyAction" class="buy_element_button" data-id="<?=$arItem['ID']?>" href="<?=$arItem['ADD_URL']?>">Купить</a>
						<?endif;?>
					</div>
					<div class="clear"></div>
					<p class="add_sravnenie"><label><input type="checkbox" data-url="<?=$arItem['COMPARE_URL']?>" />Добавить в сравнение</label></p>
				</td>
			</tr>
		</table>
	</div>
<?
endforeach;
?>

<div class="clear"></div>
<div class="catalog_page_top_all_produce"></div>
<?
$paramName = 'PAGEN_'.$arResult['NAV_RESULT']->NavNum;
$paramValue = $arResult['NAV_RESULT']->NavPageNomer;
$pageCount = $arResult['NAV_RESULT']->NavPageCount;

if ($paramValue < $pageCount) {
    $paramValue = (int) $paramValue + 1;
    $url = htmlspecialcharsbx(
        $APPLICATION->GetCurPageParam(
            sprintf('%s=%s', $paramName, $paramValue),
            array($paramName, 'AJAX_PAGE',)
        )
    );
    echo sprintf('<div class="ajax-pager-wrap">
                      <a class="ajax-pager-link index_more_produce" data-wrapper-class="catalog_list" href="%s">показать еще %s</a>
                  </div>',
        $url, $arParams['PAGE_ELEMENT_COUNT']);

	if ($arParams["DISPLAY_BOTTOM_PAGER"])
	{
		echo str_replace("AJAX_PAGE=TEXT", "", $arResult["NAV_STRING"]);
	}
}
?>
</div>
<!--RestartBuffer-->