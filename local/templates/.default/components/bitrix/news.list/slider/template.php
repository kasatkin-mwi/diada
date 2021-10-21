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
/* http://mkarta.com/2220 */
/* $arResult['UF_SECTION_LINK'][0] == '/help/prilozhenie/' */
$this->setFrameMode(true);


//$detect = new \Bitrix\Conversion\Internals\MobileDetect;	// для определения мобильного устройства
?>
<?if(!empty($arResult["ITEMS"])):?>
    <div class="new_banner_page">
	    <div class="index_slider_block">
		    <?if(count($arResult["ITEMS"]) > 1):?>
			    <ul class="index_slider">
				    <?foreach($arResult["ITEMS"] as $item):
                        
                        $this->AddEditAction($item['ID'], $item['EDIT_LINK'], CIBlock::GetArrayByID($item["IBLOCK_ID"], "ELEMENT_EDIT"));
                        $this->AddDeleteAction($item['ID'], $item['DELETE_LINK'], CIBlock::GetArrayByID($item["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
                    ?>				
					    <li id="<?=$this->GetEditAreaId($item['ID']);?>">
                            <a href="<?/*if( ($detect->isMobile()) && ($item['PROPERTIES']['URL']['VALUE'] == '/help/prilozhenie/')):?>http://mkarta.com/2220<?else:*/?><?=$item['PROPERTIES']['URL']['VALUE']?><?//endif;?>" target="_blank">
                                <img src="<?=$item['PREVIEW_PICTURE']['SRC']?>">
                            </a>
                        </li>
				    <?endforeach;?>
			    </ul>
		    <?else:?>
			    <a href="<?/*if( ($detect->isMobile()) && ($arResult["ITEMS"][0]['PROPERTIES']['URL']['VALUE'] == '/help/prilozhenie/')):?>http://mkarta.com/2220<?else:*/?><?=$arResult["ITEMS"][0]['PROPERTIES']['URL']['VALUE']?><?//endif;?>" target="_blank">
                    <img src="<?=$arResult["ITEMS"][0]['PREVIEW_PICTURE']['SRC']?>">
                </a>			
		    <?endif;?>
	    </div>
    </div>
<?endif;?>