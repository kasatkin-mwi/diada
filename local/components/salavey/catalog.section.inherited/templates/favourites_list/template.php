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
$this->setFrameMode(false);

$strElementEdit = CIBlock::GetArrayByID($arParams["IBLOCK_ID"], "ELEMENT_EDIT");
$strElementDelete = CIBlock::GetArrayByID($arParams["IBLOCK_ID"], "ELEMENT_DELETE");
$arElementDeleteParams = array("CONFIRM" => GetMessage('CT_BCS_TPL_ELEMENT_DELETE_CONFIRM'));
?>
<div class="catalog_list">
<!--RestartBuffer-->
<?
$fileNoImg = CFile::GetList(array(),array("MODULE_ID" => "service_salavey", "ORIGINAL_NAME" => "no_photo_diada.jpg"))->GetNext();
$resizeImgNoPhoto = CFile::ResizeImageGet($fileNoImg['ID'], array("width" => 400, "height" => 800))["src"];
foreach ($arResult['ITEMS'] as $key => $arItem):
    $templateData["LIST_ITEMS"][] = $arItem['ID'];
	$this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], $strElementEdit);
	$this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], $strElementDelete, $arElementDeleteParams);
	$strMainID = $this->GetEditAreaId($arItem['ID']);
    if ($arItem['~PREVIEW_PICTURE']>0) {
        $resizeImg = CFile::ResizeImageGet($arItem['~PREVIEW_PICTURE'], array("width" => 400, "height" => 500))["src"];
    }
    elseif ($arItem['~DETAIL_PICTURE']>0){
        $resizeImg = CFile::ResizeImageGet($arItem['~DETAIL_PICTURE'], array("width" => 400, "height" => 500))["src"];
    }
    if (strlen($resizeImg) == 0){
        $resizeImg = $resizeImgNoPhoto;
    }
	?>
	<div class="cat_tb_el" id="<?=$strMainID;?>">
		<div class="cat_tb_el_l">
			<div class="cat_status_list">
				<?if (($arItem['PROPERTIES']['BLACK_FRIDAY']['VALUE'] == "Y") && (Salavey::CheckDateBF() == 'Y')):?><div class="cat_status_el black">Black Friday</div><?endif?>
				<?if ($arItem['PROPERTIES']['SALE']['VALUE']=='Y'):?><div class="cat_status_el sale">SALE</div><?endif?>
				<?if ($arItem['PROPERTIES']['HIT']['VALUE']=='Y'):?><div class="cat_status_el hit">??????</div><?endif?>
				<?if ($arItem['PROPERTIES']['NEW']['VALUE']=='Y'):?><div class="cat_status_el new">NEW</div><?endif?>
				<?if ($arItem['PROPERTIES']['SUPER']['VALUE']=='Y'):?><div class="cat_status_el viol">????????????</div><?endif?>
			</div>
			<div class="cat_tb_ic">
				<a href="<?=$arItem['DETAIL_PAGE_URL']?>">
					<?
					if(!empty($arItem['SECOND_PICTURE']))
					{
					    ?>
					    <span class="one">
					        <img src="<?=$resizeImg?>">
					    </span>
					    <span class="two">
					        <img src="<?=$arItem['SECOND_PICTURE']['src']?>">
					    </span>
					    <?    
					}
					else
					{
					    if (strlen($resizeImg) > 0)
					    {
					        ?>
					        <span class="one">
					        	<img src="<?=$resizeImg?>">
					        </span>
					        <?    
					    }    
					}
					?>
				</a>
			</div>
		</div>
		<div class="cat_tb_el_c">
			<div class="cat_tb_tit"><a href="<?=$arItem['DETAIL_PAGE_URL']?>"><?=$arItem['NAME']?></a></div>
			<div class="cat_tb_reititng">
				<div class="new_reiting_bl set_reting_product_<?=$arItem["ID"]?> product_reting" data-rating-product="<?=$arItem["ID"]?>">
					<div style="width:<?=$item["RATING_PERCENT"]?>%; overflow: hidden;" class="new_reiting_cont"></div>
				</div>
			</div>
			<div class="cat_tb_option_bl">
				<?foreach( explode("<br>", strip_tags($arItem["PREVIEW_TEXT"], '<br>')) as $str ):
					$str = str_replace("&nbsp;", "", $str);
					$arStr = explode(":", $str);?>
					<?if($arStr[1]):?>
						<div class="cat_tb_option_el">
							<div class="cat_tb_option_l"><?=trim($arStr[0])?></div>
							<div class="cat_tb_option_r"><?=trim($arStr[1])?></div>
						</div>
					<?endif?>
				<?endforeach;?>
			</div>
		</div>
		<div class="cat_tb_el_r">
			<div id="money_element_<?=$arItem["ID"]?>" class="cat_tb_price">
				<?$frame = $this->createFrame("money_element_".$arItem["ID"], false)->begin();?>
				    <?foreach($arItem["PRICES"] as $code=>$arPrice):?>
				        <?if($arPrice["DISCOUNT_VALUE"] < $arPrice["VALUE"]):?>
					        <div class="new"><?=number_format($arPrice["DISCOUNT_VALUE"], 0, '.', ' ');?> <i class="fa fa-rub" aria-hidden="true"></i></div>
					        <div class="old"><?=number_format($arPrice["VALUE"], 0, '.', ' ');?> <i class="fa fa-rub" aria-hidden="true"></i></div>
					        <span style="display: none;" class="price-value-num"><?=$arPrice["DISCOUNT_VALUE"]?></span>
				        <?else:?>
					        <div class="new"><?=number_format($arPrice["VALUE"], 0, '.', ' ');?> <i class="fa fa-rub" aria-hidden="true"></i></div>
					        <span style="display: none;" class="price-value-num"><?=number_format($arPrice["VALUE"], 0, '.', ' ');?></span>
				        <?endif?>
				    <?endforeach;?>
				<?$frame->beginStub();?>
				    <?foreach($arItem["PRICES"] as $code=>$arPrice):?>
				        <?if($arPrice["DISCOUNT_VALUE"] < $arPrice["VALUE"]):?>
				            <?=number_format($arPrice["DISCOUNT_VALUE"], 0, '.', ' ');?>
				            <span><?=number_format($arPrice["VALUE"], 0, '.', ' ');?></span>
				            <span style="display: none;" class="price-value-num"><?=number_format($arPrice["DISCOUNT_VALUE"], 0, '.', ' ');?></span>
				        <?else:?>
				            <?=number_format($arPrice["VALUE"], 0, '.', ' ');?>
				            <span style="display: none;" class="price-value-num"><?=number_format($arPrice["VALUE"], 0, '.', ' ');?></span>
				        <?endif?>
				    <?endforeach;?>
				<?$frame->end();?>
			</div>
			<div class="cat_tb_favor_srav">
				<a class="srav_favor item-<?=$arItem["ID"]?>" href="javascript:void(0)" data-id="<?=$arItem["ID"]?>"><i></i></a>
				<a class="favor_srav item-<?=$arItem["ID"]?>" href="/catalog/compare/?action=ADD_TO_COMPARE_LIST&amp;id=<?=$arItem["ID"]?>"><i></i></a>
			</div>
			<?if ( $arItem['CATALOG_AVAILABLE'] !== 'N' ):?>	
				<div id="buy_element_<?=$arItem['ID']?>" class="cat_tb_buy">
					<a itemscope itemtype="http://schema.org/BuyAction"  class="buy_element_button newcat_buy fancy_pay_war" data-name="<?=$arItem['NAME']?>" data-id="<?=$arItem['ID']?>" href="<?=$arItem['ADD_URL']?>">????????????</a>
				</div>
			<?endif;?>
		</div>
	</div>
	
<?endforeach;?>

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
            array($paramName, 'AJAX_PAGE',),
            false
        )
    );
    echo sprintf('<div class="ajax_pager_wrap_block"><div class="ajax-pager-wrap">
                      <a class="ajax-pager-link index_more_produce" data-wrapper-class="catalog_list" href="%s">???????????????? ?????? %s</a>
                  </div><div class="catalog_page_navigator_kol">???????????????? '.$arResult['NAV_RESULT']->NavPageSize*$arResult['NAV_RESULT']->NavPageNomer.' ???? '.$arResult['NAV_RESULT']->NavRecordCount.'</div></div>',
        $url, $arParams['PAGE_ELEMENT_COUNT']);
}
if ($arParams["DISPLAY_BOTTOM_PAGER"])
{
    echo str_replace("AJAX_PAGE=TEXT", "", $arResult["NAV_STRING"]);
}
?>
</div>
<!--RestartBuffer-->