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
if(!empty($arResult["ITEMS"]))
{
    ?>
    <div class="important_bl">
        <div class="standart_width">
            <div class="important_fl">
                <div class="important_ic">!</div>
                <?foreach($arResult["ITEMS"] as $arItem):?>
                    <?
                    $this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
                    $this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
                    ?>
                    <div class="important_txt" id="<?=$this->GetEditAreaId($arItem['ID']);?>">
                        <?=$arItem["PREVIEW_TEXT"]?>
                    </div>
                <?endforeach;?>
                <?
                if($arParams['SHOW_MORE_LINK'] == 'Y')
                {
                    ?>
                    <a class="important_more" href="">Подробнее</a>
                    <?    
                }
                ?>
                </div>
            </div>
        </div>
    <?    
}
?>