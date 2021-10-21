<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();
/** @var CBitrixComponentTemplate $this */
/** @var array $arParams */
/** @var array $arResult */
/** @global CDatabase $DB */
/** @global CMain $APPLICATION */

$frame = $this->createFrame()->begin("");

$templateData = array(
	'TEMPLATE_THEME' => $this->GetFolder().'/themes/'.$arParams['TEMPLATE_THEME'].'/style.css',
	'TEMPLATE_CLASS' => 'bx_'.$arParams['TEMPLATE_THEME']
);

$injectId = $arParams['UNIQ_COMPONENT_ID'];

if (isset($arResult['REQUEST_ITEMS']))
{
	// code to receive recommendations from the cloud
	CJSCore::Init(array('ajax'));

	// component parameters
	$signer = new \Bitrix\Main\Security\Sign\Signer;
	$signedParameters = $signer->sign(
		base64_encode(serialize($arResult['_ORIGINAL_PARAMS'])),
		'bx.bd.products.recommendation'
	);
	$signedTemplate = $signer->sign($arResult['RCM_TEMPLATE'], 'bx.bd.products.recommendation');

	?>

	<span id="<?=$injectId?>"></span>

	<script type="text/javascript">
		BX.ready(function(){
			bx_rcm_get_from_cloud(
				'<?=CUtil::JSEscape($injectId)?>',
				<?=CUtil::PhpToJSObject($arResult['RCM_PARAMS'])?>,
				{
					'parameters':'<?=CUtil::JSEscape($signedParameters)?>',
					'template': '<?=CUtil::JSEscape($signedTemplate)?>',
					'site_id': '<?=CUtil::JSEscape(SITE_ID)?>',
					'rcm': 'yes'
				}
			);
		});
	</script>
	<?
	$frame->end();
	return;

	// \ end of the code to receive recommendations from the cloud
}


// regular template then
// if customized template, for better js performance don't forget to frame content with <span id="{$injectId}_items">...</span> 

if (!empty($arResult['ITEMS']))
{
	?>

	<span id="<?=$injectId?>_items">
	
	<script type="text/javascript">
	BX.message({
		CBD_MESS_BTN_BUY: '<? echo ('' != $arParams['MESS_BTN_BUY'] ? CUtil::JSEscape($arParams['MESS_BTN_BUY']) : GetMessageJS('CVP_TPL_MESS_BTN_BUY')); ?>',
		CBD_MESS_BTN_ADD_TO_BASKET: '<? echo ('' != $arParams['MESS_BTN_ADD_TO_BASKET'] ? CUtil::JSEscape($arParams['MESS_BTN_ADD_TO_BASKET']) : GetMessageJS('CVP_TPL_MESS_BTN_ADD_TO_BASKET')); ?>',
		CBD_MESS_BTN_DETAIL: '<? echo ('' != $arParams['MESS_BTN_DETAIL'] ? CUtil::JSEscape($arParams['MESS_BTN_DETAIL']) : GetMessageJS('CVP_TPL_MESS_BTN_DETAIL')); ?>',
		CBD_MESS_NOT_AVAILABLE: '<? echo ('' != $arParams['MESS_BTN_DETAIL'] ? CUtil::JSEscape($arParams['MESS_BTN_DETAIL']) : GetMessageJS('CVP_TPL_MESS_BTN_DETAIL')); ?>',
		CBD_BTN_MESSAGE_BASKET_REDIRECT: '<? echo GetMessageJS('CVP_CATALOG_BTN_MESSAGE_BASKET_REDIRECT'); ?>',
		CBD_BASKET_URL: '<? echo $arParams["BASKET_URL"]; ?>',
		CBD_ADD_TO_BASKET_OK: '<? echo GetMessageJS('CVP_ADD_TO_BASKET_OK'); ?>',
		CBD_TITLE_ERROR: '<? echo GetMessageJS('CVP_CATALOG_TITLE_ERROR') ?>',
		CBD_TITLE_BASKET_PROPS: '<? echo GetMessageJS('CVP_CATALOG_TITLE_BASKET_PROPS') ?>',
		CBD_TITLE_SUCCESSFUL: '<? echo GetMessageJS('CVP_ADD_TO_BASKET_OK'); ?>',
		CBD_BASKET_UNKNOWN_ERROR: '<? echo GetMessageJS('CVP_CATALOG_BASKET_UNKNOWN_ERROR') ?>',
		CBD_BTN_MESSAGE_SEND_PROPS: '<? echo GetMessageJS('CVP_CATALOG_BTN_MESSAGE_SEND_PROPS'); ?>',
		CBD_BTN_MESSAGE_CLOSE: '<? echo GetMessageJS('CVP_CATALOG_BTN_MESSAGE_CLOSE') ?>'
	});
	</script>
	<?

	$skuTemplate = array();
	if(is_array($arResult['SKU_PROPS']))
	{
		foreach ($arResult['SKU_PROPS'] as $iblockId => $skuProps)
		{
			$skuTemplate[$iblockId] = array();
			foreach ($skuProps as $arProp)
			{
				$propId = $arProp['ID'];
				$skuTemplate[$iblockId][$propId] = array(
					'SCROLL' => array(
						'START' => '',
						'FINISH' => '',
					),
					'FULL' => array(
						'START' => '',
						'FINISH' => '',
					),
					'ITEMS' => array()
				);
				if ('TEXT' == $arProp['SHOW_MODE'])
				{
					$skuTemplate[$iblockId][$propId]['SCROLL']['START'] = '<div class="bx_item_detail_size full" id="#ITEM#_prop_'.$propId.'_cont">'.
						'<span class="bx_item_section_name_gray">'.htmlspecialcharsbx($arProp['NAME']).'</span>'.
						'<div class="bx_size_scroller_container"><div class="bx_size"><ul id="#ITEM#_prop_'.$propId.'_list" style="width: #WIDTH#;">';;
					$skuTemplate[$iblockId][$propId]['SCROLL']['FINISH'] = '</ul></div>'.
						'<div class="bx_slide_left" id="#ITEM#_prop_'.$propId.'_left" data-treevalue="'.$propId.'" style=""></div>'.
						'<div class="bx_slide_right" id="#ITEM#_prop_'.$propId.'_right" data-treevalue="'.$propId.'" style=""></div>'.
						'</div></div>';

					$skuTemplate[$iblockId][$propId]['FULL']['START'] = '<div class="bx_item_detail_size" id="#ITEM#_prop_'.$propId.'_cont">'.
						'<span class="bx_item_section_name_gray">'.htmlspecialcharsbx($arProp['NAME']).'</span>'.
						'<div class="bx_size_scroller_container"><div class="bx_size"><ul id="#ITEM#_prop_'.$propId.'_list" style="width: #WIDTH#;">';;
					$skuTemplate[$iblockId][$propId]['FULL']['FINISH'] = '</ul></div>'.
						'<div class="bx_slide_left" id="#ITEM#_prop_'.$propId.'_left" data-treevalue="'.$propId.'" style="display: none;"></div>'.
						'<div class="bx_slide_right" id="#ITEM#_prop_'.$propId.'_right" data-treevalue="'.$propId.'" style="display: none;"></div>'.
						'</div></div>';
					foreach ($arProp['VALUES'] as $value)
					{
						$value['NAME'] = htmlspecialcharsbx($value['NAME']);
						$skuTemplate[$iblockId][$propId]['ITEMS'][$value['ID']] = '<li data-treevalue="'.$propId.'_'.$value['ID'].
							'" data-onevalue="'.$value['ID'].'" style="width: #WIDTH#;" title="'.$value['NAME'].'"><i></i><span class="cnt">'.$value['NAME'].'</span></li>';
					}
					unset($value);
				}
				elseif ('PICT' == $arProp['SHOW_MODE'])
				{
					$skuTemplate[$iblockId][$propId]['SCROLL']['START'] = '<div class="bx_item_detail_scu full" id="#ITEM#_prop_'.$propId.'_cont">'.
						'<span class="bx_item_section_name_gray">'.htmlspecialcharsbx($arProp['NAME']).'</span>'.
						'<div class="bx_scu_scroller_container"><div class="bx_scu"><ul id="#ITEM#_prop_'.$propId.'_list" style="width: #WIDTH#;">';
					$skuTemplate[$iblockId][$propId]['SCROLL']['FINISH'] = '</ul></div>'.
						'<div class="bx_slide_left" id="#ITEM#_prop_'.$propId.'_left" data-treevalue="'.$propId.'" style=""></div>'.
						'<div class="bx_slide_right" id="#ITEM#_prop_'.$propId.'_right" data-treevalue="'.$propId.'" style=""></div>'.
						'</div></div>';

					$skuTemplate[$iblockId][$propId]['FULL']['START'] = '<div class="bx_item_detail_scu" id="#ITEM#_prop_'.$propId.'_cont">'.
						'<span class="bx_item_section_name_gray">'.htmlspecialcharsbx($arProp['NAME']).'</span>'.
						'<div class="bx_scu_scroller_container"><div class="bx_scu"><ul id="#ITEM#_prop_'.$propId.'_list" style="width: #WIDTH#;">';
					$skuTemplate[$iblockId][$propId]['FULL']['FINISH'] = '</ul></div>'.
						'<div class="bx_slide_left" id="#ITEM#_prop_'.$propId.'_left" data-treevalue="'.$propId.'" style="display: none;"></div>'.
						'<div class="bx_slide_right" id="#ITEM#_prop_'.$propId.'_right" data-treevalue="'.$propId.'" style="display: none;"></div>'.
						'</div></div>';
					foreach ($arProp['VALUES'] as $value)
					{
						$value['NAME'] = htmlspecialcharsbx($value['NAME']);
						$skuTemplate[$iblockId][$propId]['ITEMS'][$value['ID']] = '<li data-treevalue="'.$propId.'_'.$value['ID'].
							'" data-onevalue="'.$value['ID'].'" style="width: #WIDTH#; padding-top: #WIDTH#;"><i title="'.$value['NAME'].'"></i>'.
							'<span class="cnt"><span class="cnt_item" style="background-image:url(\''.$value['PICT']['SRC'].'\');" title="'.$value['NAME'].'"></span></span></li>';
					}
					unset($value);
				}
				unset($arProp);
			}
		}
	}

	?>
	<div class="bx_item_list_you_looked_horizontal col<? echo $arParams['LINE_ELEMENT_COUNT']; ?> <? echo $templateData['TEMPLATE_CLASS']; ?>">
	<div class="bx_item_list_title"><? echo GetMessage('CVP_TPL_MESS_RCM') ?></div>
	    <div class="catalog_list">
	        <?
	        foreach ($arResult['ITEMS'] as $key => $arItem)
	        {
		        $strMainID = $this->GetEditAreaId($arItem['ID'] . $key);
                $templateData["LIST_ITEMS"][] = $arItem['ID'];
		        $arItemIDs = array(
			        'ID' => $strMainID,
			        'PICT' => $strMainID . '_pict',
			        'SECOND_PICT' => $strMainID . '_secondpict',
			        'MAIN_PROPS' => $strMainID . '_main_props',

			        'QUANTITY' => $strMainID . '_quantity',
			        'QUANTITY_DOWN' => $strMainID . '_quant_down',
			        'QUANTITY_UP' => $strMainID . '_quant_up',
			        'QUANTITY_MEASURE' => $strMainID . '_quant_measure',
			        'BUY_LINK' => $strMainID . '_buy_link',
			        'BASKET_ACTIONS' => $strMainID.'_basket_actions',
			        'NOT_AVAILABLE_MESS' => $strMainID.'_not_avail',
			        'SUBSCRIBE_LINK' => $strMainID . '_subscribe',

			        'PRICE' => $strMainID . '_price',
			        'DSC_PERC' => $strMainID . '_dsc_perc',
			        'SECOND_DSC_PERC' => $strMainID . '_second_dsc_perc',

			        'PROP_DIV' => $strMainID . '_sku_tree',
			        'PROP' => $strMainID . '_prop_',
			        'DISPLAY_PROP_DIV' => $strMainID . '_sku_prop',
			        'BASKET_PROP_DIV' => $strMainID . '_basket_prop'
		        );

		        $strObName = 'ob' . preg_replace("/[^a-zA-Z0-9_]/", "x", $strMainID);

		        $strTitle = (
		        isset($arItem["IPROPERTY_VALUES"]["ELEMENT_PREVIEW_PICTURE_FILE_TITLE"]) && '' != isset($arItem["IPROPERTY_VALUES"]["ELEMENT_PREVIEW_PICTURE_FILE_TITLE"])
			        ? $arItem["IPROPERTY_VALUES"]["ELEMENT_PREVIEW_PICTURE_FILE_TITLE"]
			        : $arItem['NAME']
		        );
		        $showImgClass = $arParams['SHOW_IMAGE'] != "Y" ? "no-imgs" : "";

		        $productTitle = (
			        isset($arItem['IPROPERTY_VALUES']['ELEMENT_PAGE_TITLE'])&& $arItem['IPROPERTY_VALUES']['ELEMENT_PAGE_TITLE'] != ''
			        ? $arItem['IPROPERTY_VALUES']['ELEMENT_PAGE_TITLE']
			        : $arItem['NAME']
		        );
                if ($arItem['~PREVIEW_PICTURE']>0) 
                {                
                    $resizeImg = CFile::ResizeImageGet($arItem['~PREVIEW_PICTURE'], array("width" => 250, "height" => 90))["src"];
                }
                elseif ($arItem['~DETAIL_PICTURE']>0)
                {
                    $resizeImg = CFile::ResizeImageGet($arItem['~DETAIL_PICTURE'], array("width" => 250, "height" => 90))["src"];
                }
                if (strlen($resizeImg) == 0)
                {
                    $resizeImg = $resizeImgNoPhoto;
                }
		        ?>
                
                <div class="table_element_catalog_block parent_block" id="<?=$strMainID;?>">
                    <div class="list_element_catalog table_element_catalog">
                        <div>
                            <a class="favor_srav item-<?=$arItem['ID']?>" href="<?=$arItem['COMPARE_URL']?>"><i></i></a>
                            <a class="srav_favor item-<?=$arItem['ID']?>" href="javascript:void(0)" data-id="<?=$arItem['ID']?>"><i></i></a>
                        </div>
                        <a class="list_element_title" href="<?=$arItem['DETAIL_PAGE_URL']?>"><?=$arItem['NAME']?></a>
                        <p class="list_element_img">
                            <?if (strlen($resizeImg)>0):?>
                                <a href="<?=$arItem['DETAIL_PAGE_URL']?>" id="<? echo $arItemIDs['PICT']; ?>"><img src="<?=$resizeImg?>" /></a>
                            <?endif;?>
                        </p>
                        <div class="display_none_c">
                            <ul class="not_style">
                                <li class="adaptiv_list_element_img">
                                    <?if ($arItem['PREVIEW_PICTURE']):?>
                                        <a href="<?=$arItem['DETAIL_PAGE_URL']?>"><img src="<?=$resizeImg?>" /></a>
                                    <?endif;?>
                                </li>
                            </ul>
                            <ul class="not_style">
                                <li class="money_element">
                                    <div id="<? echo $arItemIDs['PRICE']; ?>">
                                        <?foreach($arItem["PRICES"] as $code=>$arPrice):?>
                                            <?if($arPrice["DISCOUNT_VALUE"] < $arPrice["VALUE"]):?>
                                                <?=$arPrice["PRINT_DISCOUNT_VALUE"]?><span><?=$arPrice["PRINT_VALUE"]?></span>
                                            <?else:?>
                                                <?=$arPrice["PRINT_VALUE"]?>
                                            <?endif?>
                                        <?endforeach;?>
                                    </div>
                                </li>
                            </ul>
                        </div>
                        <ul class="catalog_el_reting">
                            <li class="display_none_m display_none_mp"></li>
                            <li class="set_reting_product_<?=$arItem["ID"]?>"></li>
                        </ul>
                        <ul class="table_buy_money">
                            <li class="money_element display_none_m display_none_mp display_none_p">
                                <?foreach($arItem["PRICES"] as $code=>$arPrice):?>
                                    <?if($arPrice["DISCOUNT_VALUE"] < $arPrice["VALUE"]):?>
                                        <?=$arPrice["PRINT_DISCOUNT_VALUE"]?><span><?=$arPrice["PRINT_VALUE"]?></span>
                                    <?else:?>
                                        <?=$arPrice["PRINT_VALUE"]?>
                                    <?endif?>
                                <?endforeach;?>
                            </li>
                            <?
                            if (!isset($arItem['OFFERS']) || empty($arItem['OFFERS'])) // Simple Product
                            {
                                if ($arItem['CAN_BUY'])
                                {
                                    if ('Y' == $arParams['USE_PRODUCT_QUANTITY'])
                                    {
                                        ?>
                                        <li class="buy_element">
                                            <div class="buy_number">
                                                <a class="js_number_prev" id="<? echo $arItemIDs['QUANTITY_DOWN']; ?>" href="javascript:void(0)"><img src="/img/number_prev.png" alt=""/></a>
                                                <input name="<? echo $arParams["PRODUCT_QUANTITY_VARIABLE"]; ?>" id="<? echo $arItemIDs['QUANTITY']; ?>" class="number" type="number" value="<? echo $arItem['CATALOG_MEASURE_RATIO']; ?>"/>
                                                <a class="js_number_next" id="<? echo $arItemIDs['QUANTITY_UP']; ?>" href="javascript:void(0)"><img src="/img/number_next.png" alt=""/></a>
                                            </div>
                                            <div class="clear"></div>
                                        </li>
                                    <?
                                    }
                                    ?>
                                    <li class="buy_element_button_block">
                                        <div id="buy_element_button_block_<?=$arItem["ID"]?>">
                                            <a itemscope itemtype="http://schema.org/BuyAction"  class="buy_element_button big-data" id="<? echo $arItemIDs['BUY_LINK']; ?>" data-id="<?=$arItem['ID']?>" href="javascript:void(0)"><?
                                                echo('' != $arParams['MESS_BTN_BUY'] ? $arParams['MESS_BTN_BUY'] : GetMessage('CT_BCS_TPL_MESS_BTN_BUY'));
                                                ?></a>
                                        </div>
                                        <div class="clear"></div>
                                    </li>
                                <?
                                }
                                /*else
                                {
                                    ?>
                                    <div class="bx_catalog_item_controls_blockone">
                                        <a class="bx_medium bx_bt_button_type_2" href="<? echo $arItem['DETAIL_PAGE_URL']; ?>" rel="nofollow">
                                            <?    echo('' != $arParams['MESS_BTN_DETAIL'] ? $arParams['MESS_BTN_DETAIL'] : GetMessage('CVP_TPL_MESS_BTN_DETAIL')); ?>
                                        </a>
                                    </div><?
                                    if ('Y' == $arParams['PRODUCT_SUBSCRIPTION'] && 'Y' == $arItem['CATALOG_SUBSCRIPTION'])
                                    {
                                        ?>
                                        <div class="bx_catalog_item_controls_blocktwo">
                                        <a id="<? echo $arItemIDs['SUBSCRIBE_LINK']; ?>" class="bx_bt_button_type_2 bx_medium" href="javascript:void(0)"><?
                                            echo('' != $arParams['MESS_BTN_SUBSCRIBE'] ? $arParams['MESS_BTN_SUBSCRIBE'] : GetMessage('CVP_TPL_MESS_BTN_SUBSCRIBE'));
                                            ?>
                                        </a>
                                        </div><?
                                    }
                                }*/
                            
                                $arJSParams = array(
                                    'PRODUCT_TYPE' => $arItem['CATALOG_TYPE'],
                                    'SHOW_QUANTITY' => $arParams['USE_PRODUCT_QUANTITY'],
                                    'SHOW_ADD_BASKET_BTN' => false,
                                    'SHOW_BUY_BTN' => true,
                                    'SHOW_ABSENT' => true,
                                    'PRODUCT' => array(
                                        'ID' => $arItem['ID'],
                                        'NAME' => $arItem['~NAME'],
                                        'PICT' => ('Y' == $arItem['SECOND_PICT'] ? $arItem['PREVIEW_PICTURE_SECOND'] : $arItem['PREVIEW_PICTURE']),
                                        'CAN_BUY' => $arItem["CAN_BUY"],
                                        'SUBSCRIPTION' => ('Y' == $arItem['CATALOG_SUBSCRIPTION']),
                                        'CHECK_QUANTITY' => $arItem['CHECK_QUANTITY'],
                                        'MAX_QUANTITY' => $arItem['CATALOG_QUANTITY'],
                                        'STEP_QUANTITY' => $arItem['CATALOG_MEASURE_RATIO'],
                                        'QUANTITY_FLOAT' => is_double($arItem['CATALOG_MEASURE_RATIO']),
                                        'ADD_URL' => $arItem['~ADD_URL'],
                                        'SUBSCRIBE_URL' => $arItem['~SUBSCRIBE_URL']
                                    ),
                                    'BASKET' => array(
                                        'ADD_PROPS' => ('Y' == $arParams['ADD_PROPERTIES_TO_BASKET']),
                                        'QUANTITY' => $arParams['PRODUCT_QUANTITY_VARIABLE'],
                                        'PROPS' => $arParams['PRODUCT_PROPS_VARIABLE'],
                                        'EMPTY_PROPS' => $emptyProductProperties
                                    ),
                                    'VISUAL' => array(
                                        'ID' => $arItemIDs['ID'],
                                        'PICT_ID' => $arItemIDs['PICT'],
                                        'QUANTITY_ID' => $arItemIDs['QUANTITY'],
                                        'QUANTITY_UP_ID' => $arItemIDs['QUANTITY_UP'],
                                        'QUANTITY_DOWN_ID' => $arItemIDs['QUANTITY_DOWN'],
                                        'PRICE_ID' => $arItemIDs['PRICE'],
                                        'BUY_ID' => $arItemIDs['BUY_LINK'],
                                        'BASKET_PROP_DIV' => $arItemIDs['BASKET_PROP_DIV']
                                    ),
                                    'LAST_ELEMENT' => $arItem['LAST_ELEMENT']
                                );
                                
                                ?>
                                <script type="text/javascript">
                                    var <? echo $strObName; ?> = new JCCatalogBigdataProducts(<? echo CUtil::PhpToJSObject($arJSParams, false, true); ?>);
                                </script><?
                            }
                            ?>
                        </ul>
                        <div class="table_element_catalog_light">
                            <div class="display_none_m display_none_mp display_none_p">
                            <?
                            foreach( explode("<br>", strip_tags($arItem["PREVIEW_TEXT"], '<br>')) as $str ):
                                $str = str_replace("&nbsp;", "", $str);
                                $arStr = explode(":", $str);
                                ?>
                                <ul class="opisanie_element_catalog not_style">
                                    <li><?=trim(strip_tags($arStr[0]))?>:</li>
                                    <li><?=trim(strip_tags($arStr[1]))?></li>
                                </ul>
                                <?
                            endforeach;
                            ?>
                            </div>

                            <?/*<p class="add_sravnenie"><label><input type="checkbox" data-url="<?=$arItem['COMPARE_URL']?>" />Добавить в сравнение</label></p>*/?>
                        </div>
                    </div>
                </div>
	        <?
	        }
	        ?>
	    </div>
	</div>
	</span>
<?
}

$frame->end();