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

$is6 = $arParams['PAGE_ELEMENT_COUNT'] == 6;
$is4 = $arParams['PAGE_ELEMENT_COUNT'] == 4;
?>

<?if (preg_match("#/brends/([a-zA-Z_-]+)/#i", $APPLICATION->GetCurPage())): // проверяем, что находимся на детальной странце бренда?>
	<?echo $arResult['BUTTON']; // кнопки для брендов?>
<?endif;?>

<div class="index_hit"><!--RestartBuffer--><?
    if (count($arResult['ITEMS'])<=0){
        $this->SetViewTarget($arParams["HIDE_SECTION"]);echo "display: none";$this->EndViewTarget();
    }
    $templateData["LIST_ITEMS"] = array();
foreach ($arResult['ITEMS'] as $key => $arItem):
    if ($arItem['~PREVIEW_PICTURE']>0) {
        $resizeImg = CFile::ResizeImageGet($arItem['~PREVIEW_PICTURE'], array("width"=>362, "height"=>120))["src"];
    }
    elseif ($arItem['~DETAIL_PICTURE']>0){
        $resizeImg = CFile::ResizeImageGet($arItem['~DETAIL_PICTURE'], array("width"=>362, "height"=>120))["src"];
    }
    $templateData["LIST_ITEMS"][] = $arItem['ID'];
	$this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], $strElementEdit);
	$this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], $strElementDelete, $arElementDeleteParams);
	$strMainID = $this->GetEditAreaId($arItem['ID']);
	$arProps = $arItem['PROPERTIES'];
	//echo "<pre>";print_r($arItem);echo "</pre>";
	?>
	<?if ($is6):?>
	<div class="index_produce index_produce_in3" id="<?=$strMainID;?>" style="position: relative;">
	<?else:?>
	<div class="index_produce index_produce_in4" id="<?=$strMainID;?>" style="position: relative;">
	<?endif;?>
        <div>
            <a class="favor_srav item-<?=$arItem['ID']?>" href="<?=$arItem['COMPARE_URL']?>"><i></i></a>
            <a class="srav_favor item-<?=$arItem['ID']?>" href="javascript:void(0)" data-id="<?=$arItem['ID']?>"><i></i></a>
        </div>
		<div class="index_produce_left_col">
			<div class="cat_status_list">
				<?if (($arProps['BLACK_FRIDAY']['VALUE'] == "Y") && (Salavey::CheckDateBF() == 'Y')):?><div class="cat_status_el black">Black Friday</div><?endif?>
				<?if ($arProps['SALE']['VALUE']=='Y'):?><div class="cat_status_el sale">SALE</div><?endif?>
				<?if ($arProps['HIT']['VALUE']=='Y'):?><div class="cat_status_el hit">ХИТ</div><?endif?>
				<?if ($arProps['NEW']['VALUE']=='Y'):?><div class="cat_status_el new">NEW</div><?endif?>
				<?if ($arProps['SUPER']['VALUE']=='Y'):?><div class="cat_status_el viol">Выгода</div><?endif?>
			</div>
			<p class="index_produce_img">
				<?if ($resizeImg):?>
					<a href="<?=$arItem['DETAIL_PAGE_URL']?>"><img data-src="<?=$resizeImg?>" /></a>
				<?endif;?>
			</p>
		</div>
		<div class="index_produce_right_col">
			<a href="<?=$arItem['DETAIL_PAGE_URL']?>" class="index_produce_title"><span><?=$arItem['NAME']?></span></a>
			<ul <?if ($is4):?>class="not_style"<?endif;?>>
				<li <?if ($is6):?>class="display_none_m display_none_mp"<?endif;?>></li>
				<li class="set_reting_product_<?=$arItem['ID']?> product_reting" data-rating-product="<?=$arItem['ID']?>">
                    <div class="new_reiting_bl"><div style="width:0%;" class="new_reiting_cont"></div></div>
                </li>
			</ul>
			<ul <?if ($is4):?>class="not_style"<?endif;?>>
				<li>
                    <div id="index_hit_item_price_<?=$arItem['ID']?>">
                        <?$frame = $this->createFrame("index_hit_item_price_".$arItem["ID"], false)->begin();?>
					        <?foreach($arItem["PRICES"] as $code=>$arPrice):?>
						        <?if($arPrice["DISCOUNT_VALUE"] < $arPrice["VALUE"]):?>
							        <p><?=$arPrice["PRINT_DISCOUNT_VALUE"]?></p><p><?=$arPrice["PRINT_VALUE"]?></p>
						        <?else:?>
							        <p><?=$arPrice["PRINT_VALUE"]?></p>
						        <?endif?>
					        <?endforeach;?>
                        <?$frame->beginStub();?>
                            <?foreach($arItem["PRICES"] as $code=>$arPrice):?>
                                <?if($arPrice["DISCOUNT_VALUE"] < $arPrice["VALUE"]):?>
                                    <p><?=$arPrice["PRINT_DISCOUNT_VALUE"]?></p><p><?=$arPrice["PRINT_VALUE"]?></p>
                                <?else:?>
                                    <p><?=$arPrice["PRINT_VALUE"]?></p>
                                <?endif?>
                            <?endforeach;?>
                        <?$frame->end();?>
                    </div>
				</li>
				<li class="">
                    <div id="index_hit_item_btn_<?=$arItem['ID']?>">
                        <a class="red_buy" data-id="<?=$arItem['ID']?>" href="<?=$arItem['ADD_URL']?>">Купить</a>
                        <?/*$frame = $this->createFrame("index_hit_item_btn_".$arItem["ID"], false)->begin("");?>
				            <?if (in_array($arItem['ID'], $arParams['IN_BASKET'])):?>
					            <a class="red_buy in_basket_button" data-id="<?=$arItem['ID']?>" href="/personal/cart/?>">В корзину</a>
				            <?else:?>
					            <a class="red_buy" data-id="<?=$arItem['ID']?>" href="<?=$arItem['ADD_URL']?>">Купить</a>
				            <?endif;?>
                        <?$frame->end();*/?>
                    </div>
				</li>
			</ul>
		</div>
	</div>
<?
endforeach;
?>
<div class="clear"></div>

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
	if ($is6)
		$class = "display_none_m display_none_mp";
	else
		$class = "";

    echo sprintf('<div class="ajax_pager_wrap_block"><div class="ajax-pager-wrap">
                      <a class="ajax-pager-link index_more_produce %s" data-wrapper-class="index_hit" href="%s">Больше</a>
                  </div><div class="catalog_page_navigator_kol">Показано '.$arResult['NAV_RESULT']->NavPageSize*$arResult['NAV_RESULT']->NavPageNomer.' из '.$arResult['NAV_RESULT']->NavRecordCount.'</div></div>',
        $class, $url);
}
?>
<!--RestartBuffer -->
</div>
<style type="text/css">
	.bottom_cat_descr.categories_description ul, .bottom_cat_descr.categories_description p {
    margin-bottom: 10px;
}
</style>