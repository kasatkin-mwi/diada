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
$strSectionEdit = CIBlock::GetArrayByID($arParams["IBLOCK_ID"], "SECTION_EDIT");
$strSectionDelete = CIBlock::GetArrayByID($arParams["IBLOCK_ID"], "SECTION_DELETE");
$arSectionDeleteParams = array("CONFIRM" => GetMessage('CT_BCSL_ELEMENT_DELETE_CONFIRM'));
if (0 < $arResult["SECTIONS_COUNT"])
{
	switch ($arParams['VIEW_MODE'])
	{
		case 'LINE':
		    $setFirst = true;
		    $i=0;
			foreach ($arResult['SECTIONS'] as &$arSection)
			{
				$this->AddEditAction($arSection['ID'], $arSection['EDIT_LINK'], $strSectionEdit);
				$this->AddDeleteAction($arSection['ID'], $arSection['DELETE_LINK'], $strSectionDelete, $arSectionDeleteParams);
				?>
                <?if ($setFirst):?>
                    <script>
                        $(".js_detail_top_accessory_button").text("<?=$arSection['NAME'];?>");
                    </script>
                    <?$setFirst = false;?>
                <?endif;?>
				<div id="<? echo $this->GetEditAreaId($arSection['ID']); ?>" class="detail_top_accessory_el <?if ($i==0) echo 'active'?>"><a data-id="<?=$arSection['ID'];?>" href="<?=$arSection['SECTION_PAGE_URL'];?>"><?=$arSection['NAME'];?> (<?=$arSection['ELEMENT_CNT'];?>)</a></div>
				<?
				$i++;
			}
			unset($arSection);
			break;
	}
}
?>

<script type="text/javascript">
$(document).ready(function() {
	$('.detail_top_accessory_el a').click(function() {
		$('.detail_top_accessory_el').removeClass('active');
		$(this).parent().addClass('active');
		if (window.innerWidth<800) {
            $(".js_detail_top_accessory_button").text($(this).text()).click();
        }
		$('.detail_top_accessory_right_col').load('<?=$templateFolder?>/get_aksessuary.php?section='+$(this).data('id')+'&element_id=<?=$arParams['ELEMENT_ID']?>');
		return false;
	});
});
</script>