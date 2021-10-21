<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();
global $USER, $APPLICATION;
ob_start();
?><?
$strSectionEdit = CIBlock::GetArrayByID($arParams["IBLOCK_ID"], "SECTION_EDIT");
$strSectionDelete = CIBlock::GetArrayByID($arParams["IBLOCK_ID"], "SECTION_DELETE");
$arSectionDeleteParams = array("CONFIRM" => GetMessage('CT_BCSL_ELEMENT_DELETE_CONFIRM'));
if (0 < $arResult["SECTIONS_MINI_COUNT"])
{
?>
    <div class="small_list_razdel_firearm">
        <?
            switch ($arParams['VIEW_MODE'])
            {
                case 'LIST':
                    foreach ($arResult['SECTIONS_MINI'] as &$arSection)
                    {
                        $this->AddEditAction($arSection['ID'], $arSection['EDIT_LINK'], $strSectionEdit);
                        $this->AddDeleteAction($arSection['ID'], $arSection['DELETE_LINK'], $strSectionDelete, $arSectionDeleteParams);
                        ?>
                        <a id="<?=$this->GetEditAreaId($arSection['ID']);?>" href="<? echo $arSection["SECTION_PAGE_URL"]; ?>">
                            <?=$arSection['NAME']?>
                        </a>
                    <?
                    }
                    break;
            }
        ?>
    </div>
<?
}
?>
<?
$catalog_menu_mini = ob_get_contents();
ob_end_clean();
$APPLICATION->AddViewContent('catalog_menu_mini', $catalog_menu_mini, 1);

#$res = CIBlockElement::GetList(Array(), Array('SECTION_ID' => $arResult["SECTION"]["ID"], 'IBLOCK_ID' => $arResult["SECTION"]["IBLOCK_ID"]), false, Array())->GetNext();

#var_dump($res);

#echo "#MIN_PRICE#";

#var_dump($arResult);
?>