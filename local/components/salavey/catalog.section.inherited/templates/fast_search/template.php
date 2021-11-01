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
?>

<?
	$fileNoImg = CFile::GetList(array(),array("MODULE_ID" => "service_salavey", "ORIGINAL_NAME" => "no_photo_diada.jpg"))->GetNext();
	$resizeImgNoPhoto = CFile::ResizeImageGet($fileNoImg['ID'], array("width" => 250, "height" => 90))["src"];
	foreach ($arResult['PRICES_WITH_DISCOUNT'] as $key => $discount):
    
		$arItem = $arResult['ITEMS'][$key];
		$arElement = $arItem;		
		$arElement["PREVIEW_TEXT"] = strip_tags($arItem["PREVIEW_TEXT"]);
		
		if ($arItem['~PREVIEW_PICTURE'] > 0) 
		{
			$image_url = CFile::ResizeImageGet($arItem['~PREVIEW_PICTURE'], array("width" => 60, "height" => 60))["src"];
		}
		elseif ($arItem['~DETAIL_PICTURE'] > 0)
		{
			$image_url = CFile::ResizeImageGet($arItem['~DETAIL_PICTURE'], array("width" => 60, "height" => 60))["src"];
		}
		else {
			$image_url = '/bitrix/components/arturgolubev/search.title/templates/.default/images/noimg.png';
		}
		$preview = true;
		$image_style = '';
		$info_style = '';
		$arParams["PREVIEW_WIDTH_NEW"] = 60;
		$arParams["PREVIEW_HEIGHT_NEW"] = 60;
		if($preview){
			if($arParams["PREVIEW_WIDTH_NEW"]){
				$image_style .= 'width: '.$arParams["PREVIEW_WIDTH_NEW"].'px;';
				$info_style .= 'padding-left: '.($arParams["PREVIEW_WIDTH_NEW"]+5).'px;';
			}
			if($arParams["PREVIEW_HEIGHT_NEW"]){
				$image_style .= 'height: '.$arParams["PREVIEW_HEIGHT_NEW"].'px;';
			}
			if($info_style) $info_style = 'style="'.$info_style.'"';
		}

			
		?>
						
						<a class="js_search_href bx_item_block_href" href="<?echo $arItem["DETAIL_PAGE_URL"]?>">
							<span class="bx_item_block_item_info">
								<?if($preview):?>
									<span class="bx_item_block_item_image" style="background-image: url(<?=$image_url?>); <?=$image_style?>"></span>
								<?endif;?>
								
								<span class="bx_item_block_item_info_wrap <?if($preview) echo 'wpic';?>"<?=$info_style?>>
									<?
									$oldPrice = 0;
									$db_props = CIBlockElement::GetProperty(1, $arElement["ID"], array("sort" => "asc"), Array("CODE"=>"oldprice"));
									if($ar_props = $db_props->Fetch()){
										$oldPrice = $ar_props["VALUE"];
									}
									$db_props = CIBlockElement::GetProperty(1, $arElement["ID"], array("sort" => "asc"), Array("CODE"=>"rating"));
									if($ar_props = $db_props->Fetch()){
										$rating = $ar_props["VALUE"]/0.05;
									}
									foreach($arElement["PRICES"] as $code=>$arPrice)
									{
										
										if ($arPrice["MIN_PRICE"] != "Y")
											continue;

										if($arPrice["CAN_ACCESS"])
										{
											if( $oldPrice > $arPrice["VALUE"]):?>
												<span class="bx_item_block_item_price">
													<span class="bx_price_new">
														<?=$arPrice["PRINT_VALUE"]?>
													</span>
													<span class="bx_price_old"><?=$oldPrice?> р.</span>
												</span>
											<?else:?>
												<span class="bx_item_block_item_price bx_item_block_item_price_only_one">
													<span class="bx_price_new"><?=$arPrice["PRINT_VALUE"]?></span>
												</span>
											<?endif;
										}
										if ($arPrice["MIN_PRICE"] == "Y")
											break;
									}
									?>
									
									<span class="bx_item_block_item_name">
										<span class="bx_item_block_item_name_flex_align">
											<?echo $arItem["NAME"]?>
										</span>
										

									</span>
									<?if ( $rating ):?>
										<span class="bx_item_block_item_props">
											<div class="newcat_reititng">
												<div class="new_reiting_bl set_reting_product_139229 product_reting" data-rating-product="139229">
													<div style="width: <?=$rating?>%; overflow: hidden;" class="new_reiting_cont"></div>
												</div>
											</div>
										</span>
									<?endif;?>
									
									
									<?if($arParams["SHOW_PREVIEW_TEXT"] == 'Y' && $arElement["PREVIEW_TEXT"]):?>
										<span class="bx_item_block_item_text"><?=$arElement["PREVIEW_TEXT"]?></span>
									<?endif;?>
								</span>
								<span class="bx_item_block_item_clear"></span>
							</span>
						</a>
						<div class="bx_item_block_hrline"></div>
				
	<?endforeach;?>



