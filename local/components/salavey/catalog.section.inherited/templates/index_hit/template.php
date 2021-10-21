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
<div class="newcat_list">
	<!--RestartBuffer-->
	<?
    if (count($arResult['ITEMS'])<=0){
        $this->SetViewTarget($arParams["HIDE_SECTION"]);echo "display: none";$this->EndViewTarget();
    }
    $fileNoImg = CFile::GetList(array(),array("MODULE_ID" => "service_salavey", "ORIGINAL_NAME" => "no_photo_diada.jpg"))->GetNext();
    $resizeImgNoPhoto = CFile::ResizeImageGet($fileNoImg['ID'], array("width" => 250, "height" => 90))["src"];
    $templateData["LIST_ITEMS"] = array();
	foreach ($arResult['ITEMS'] as $key => $arItem):
	    if ($arItem['~PREVIEW_PICTURE']>0) {
	        $resizeImg = CFile::ResizeImageGet($arItem['~PREVIEW_PICTURE'], array("width"=>362, "height"=>120))["src"];
	    }
	    elseif ($arItem['~DETAIL_PICTURE']>0){
	        $resizeImg = CFile::ResizeImageGet($arItem['~DETAIL_PICTURE'], array("width"=>362, "height"=>120))["src"];
	    }
	    if (strlen($resizeImg) == 0)
	    	$resizeImg = $resizeImgNoPhoto;
	    $templateData["LIST_ITEMS"][] = $arItem['ID'];
		$this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], $strElementEdit);
		$this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], $strElementDelete, $arElementDeleteParams);
		$strMainID = $this->GetEditAreaId($arItem['ID']);
		$arProps = $arItem['PROPERTIES'];
		?>
		<?if($_SERVER['REMOTE_ADDR'] == '80.82.47.126'):?><?//echo '<pre asd>'; print_r($arItem); echo '</pre>';?><?endif?>
		<?//break;?>
		<div class="newcat_el_bl" id="<?=$strMainID;?>">
			<div class="newcat_el">
				<div class="cat_status_list">
					<?if (($arItem['PROPERTIES']['BLACK_FRIDAY']['VALUE'] == "Y") && (Salavey::CheckDateBF() == 'Y')):?>
						<div class="cat_status_el black">Black Friday</div>
					<?endif?>
					<?if ($arItem['PROPERTIES']['SALE']['VALUE'] == 'Y'):?>
						<div class="cat_status_el sale">SALE</div>
					<?endif?>
					<?if ($arItem['PROPERTIES']['HIT']['VALUE'] == 'Y'):?>
						<div class="cat_status_el hit">ХИТ</div>
					<?endif?>
					<?if ($arItem['PROPERTIES']['NEW']['VALUE'] == 'Y'):?>
						<div class="cat_status_el new">NEW</div>
					<?endif?>
					<?if ($arItem['PROPERTIES']['SUPER']['VALUE'] == 'Y'):?>
						<div class="cat_status_el viol">Выгода</div>
					<?endif?>
				</div>
				<div class="newcat_tit">
					<a href="<?=$arItem['DETAIL_PAGE_URL']?>"><?=$arItem['NAME']?></a>
				</div>
				<div class="newcat_ic_bl">
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
								<img src="<?=$resizeImg?>">
								<?    
							}    
						}
						?>
					</a>
				</div>
				<div class="newcat_info_top">
					<div class="newcat_reititng">
						<div class="new_reiting_bl set_reting_product_<?=$arItem["ID"]?> product_reting" data-rating-product="<?=$arItem["ID"]?>">
							<div style="width:<?=$item["RATING_PERCENT"]?>%;" class="new_reiting_cont"></div>
						</div>
					</div>
					<div class="newcat_dop_bt">
						<a class="favor_srav item-<?=$arItem['ID']?>" href="/catalog/compare/?action=ADD_TO_COMPARE_LIST&id=<?=$arItem['ID']?>"><i></i></a>
						<a class="srav_favor item-<?=$arItem['ID']?>" href="javascript:void(0)" data-id="<?=$arItem['ID']?>"><i></i></a>
					</div>
				</div>
				<div class="newcat_info_bot">
					<div class="newcat_price_bl" id="money_element_<?=$arItem["ID"]?>">
						<?$frame = $this->createFrame("money_element_".$arItem["ID"], false)->begin();?>
							 <?foreach($arItem["PRICES"] as $code=>$arPrice):?>
                                <?if( $arItem['PROPERTIES']['oldprice']['VALUE'] ):?>
                                    <div class="new"><?=number_format($arPrice["DISCOUNT_VALUE"], 0, '.', ' ');?> <i class="fa fa-rub" aria-hidden="true"></i></div>
                                    <div class="old"><?=number_format($arItem['PROPERTIES']['oldprice']['VALUE'], 0, '.', ' ')?> <i class="fa fa-rub" aria-hidden="true"></i></div>
                                <?else:?>
                                    <div class="new"><?=number_format($arPrice["VALUE"], 0, '.', ' ')?> <i class="fa fa-rub" aria-hidden="true"></i></div>
                                <?endif?>
                            <?endforeach;?>
						<?$frame->beginStub();?>
							 <?foreach($arItem["PRICES"] as $code=>$arPrice):?>
                                <?if( $arItem['PROPERTIES']['oldprice']['VALUE'] ):?>
                                    <div class="new"><?=number_format($arPrice["DISCOUNT_VALUE"], 0, '.', ' ');?> <i class="fa fa-rub" aria-hidden="true"></i></div>
                                    <div class="old"><?=number_format($arItem['PROPERTIES']['oldprice']['VALUE'], 0, '.', ' ')?> <i class="fa fa-rub" aria-hidden="true"></i></div>
                                <?else:?>
                                    <div class="new"><?=number_format($arPrice["VALUE"], 0, '.', ' ')?> <i class="fa fa-rub" aria-hidden="true"></i></div>
                                <?endif?>
                            <?endforeach;?>
						<?$frame->end();?>
					</div>                
					<div id="buy_element_button_block_<?=$arItem["ID"]?>">
						<a itemscope itemtype="http://schema.org/BuyAction"  class="buy_element_button newcat_buy" data-price="" data-name="<?=$arItem['NAME']?>" data-id="<?=$arItem['ID']?>" href="<?=$arItem['ADD_URL']?>">Купить</a>
					</div>
				</div>
				<div class="newcat_hidden_bl">
					<?foreach( explode("<br>", strip_tags($arItem["PREVIEW_TEXT"], '<br>')) as $str ):
						$str = str_replace("&nbsp;", "", $str);
						$arStr = explode(":", $str);
						?>
						<?if($arStr[1]):?>
							<div class="newcat_option_el">
								<div class="newcat_option_l"><?=trim(strip_tags($arStr[0]))?></div>
								<div class="newcat_option_r"><?=trim(strip_tags($arStr[1]))?></div>
							</div>
						<?endif?>
					<?endforeach;?>
				</div>
			</div>
		</div>
	<?endforeach;?>
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

	    echo sprintf('<div class="ajax_pager_wrap_block"><div class="ajax-pager-wrap">
	                      <a class="ajax-pager-link index_more_produce %s" data-wrapper-class="newcat_list" href="%s">Больше</a>
	                  </div><div class="catalog_page_navigator_kol">Показано '.$arResult['NAV_RESULT']->NavPageSize*$arResult['NAV_RESULT']->NavPageNomer.' из '.$arResult['NAV_RESULT']->NavRecordCount.'</div></div>',
	        $class, $url);
	}
	?>
	<!--RestartBuffer-->
</div>