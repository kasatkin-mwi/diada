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
$fileNoImg = CFile::GetList(array(),array("MODULE_ID" => "service_salavey", "ORIGINAL_NAME" => "no_photo_diada.jpg"))->GetNext();
$resizeImgNoPhoto = CFile::ResizeImageGet($fileNoImg['ID'], array("width"=>280, "height"=>135))["src"];
?><div class="detail_aksessuary"><!--RestartBuffer--><?
foreach ($arResult['ITEMS'] as $key => $arItem):
    $templateData["LIST_ITEMS"][] = $arItem['ID'];
	$this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], $strElementEdit);
	$this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], $strElementDelete, $arElementDeleteParams);
	$strMainID = $this->GetEditAreaId($arItem['ID']);
	$arProps = $arItem['PROPERTIES'];
	//echo "<pre>";print_r($arItem);echo "</pre>";
	?>
	<div class="index_produce index_produce_in3" id="<?=$strMainID;?>" style="position: relative;">
        <div>
            <a class="favor_srav item-<?=$arItem['ID']?>" href="<?=$arItem['COMPARE_URL']?>"><i></i></a>
            <a class="srav_favor item-<?=$arItem['ID']?>" href="javascript:void(0)" data-id="<?=$arItem['ID']?>"><i></i></a>
        </div>
		<div class="index_produce_left_col"><p class="index_produce_img">
			<?if ($arItem['PREVIEW_PICTURE']):?>
				<?$arImg = CFile::ResizeImageGet($arItem['PREVIEW_PICTURE'], Array("width"=>280, "height"=>135), BX_RESIZE_IMAGE_PROPORTIONAL)?>
				<a href="<?=$arItem['DETAIL_PAGE_URL']?>"><img src="<?=$arImg['src']?>" /></a>
            <?elseif($arItem['DETAIL_PICTURE']):?>
                <?$arImg = CFile::ResizeImageGet($arItem['PREVIEW_PICTURE'], Array("width"=>280, "height"=>135), BX_RESIZE_IMAGE_PROPORTIONAL)?>
                <a href="<?=$arItem['DETAIL_PAGE_URL']?>"><img src="<?=$arImg['src']?>" /></a>
            <?else:?>
                <a href="<?=$arItem['DETAIL_PAGE_URL']?>"><img src="<?=$resizeImgNoPhoto?>" /></a>
			<?endif;?>
		</p></div>
		<div class="index_produce_right_col">
			<a href="<?=$arItem['DETAIL_PAGE_URL']?>" class="index_produce_title"><span><?=$arItem['NAME']?></span></a>
			<ul>
				<li class="display_none_m display_none_mp"></li>
				<li class="set_reting_product_<?=$arItem['ID']?> product_reting" data-rating-product="<?=$arItem['ID']?>">
                    <div class="new_reiting_bl"><div style="width:0%;" class="new_reiting_cont"></div></div>
                </li>
			</ul>
			<ul>
				<li>
					<?foreach($arItem["PRICES"] as $code=>$arPrice):?>
						<?if($arPrice["DISCOUNT_VALUE"] < $arPrice["VALUE"]):?>
							<p><?=$arPrice["PRINT_DISCOUNT_VALUE"]?></p><p><?=$arPrice["PRINT_VALUE"]?></p>
						<?else:?>
							<p><?=$arPrice["PRINT_VALUE"]?></p>
						<?endif?>
					<?endforeach;?>
				</li>
				<li class="display_none_m display_none_mp">
				<?/*if (in_array($arItem['ID'], $arParams['IN_BASKET'])):?>
					<a class="red_buy in_basket_button" data-id="<?=$arItem['ID']?>" href="/personal/cart/?>">В корзину</a>
				<?else:?>
					<a class="red_buy" data-id="<?=$arItem['ID']?>" href="<?=$arItem['ADD_URL']?>">Купить</a>
				<?endif;*/?>
                <a class="red_buy" data-id="<?=$arItem['ID']?>" href="<?=$arItem['ADD_URL']?>">Купить</a>
				</li>
			</ul>
		</div>
	</div>
<?
endforeach;
?>

<?
	if ($arParams["DISPLAY_BOTTOM_PAGER"])
	{
		echo $arResult["NAV_STRING"];
	}
/*
<div class="catalog_page_navigator">
	<!--<a href=""><span><img src="/img/navigator_left_arrow.png" alt=""/></span></a>-->
	<a class="active" href=""><span>1</span></a>
	<a href=""><span>2</span></a>
	<a href=""><span>3</span></a>
	<a href=""><span><img src="/img/navigator_right_arrow.png" alt=""></span></a>
</div>
*/
?>
<!--RestartBuffer-->
</div>