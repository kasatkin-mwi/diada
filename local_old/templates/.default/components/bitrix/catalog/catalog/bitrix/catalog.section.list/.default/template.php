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

$arViewModeList = $arResult['VIEW_MODE_LIST'];

$arViewStyles = array(
	'LIST' => array(
		'CONT' => 'bx_sitemap',
		'TITLE' => 'bx_sitemap_title',
		'LIST' => 'bx_sitemap_ul',
	),
	'LINE' => array(
		'CONT' => 'bx_catalog_line',
		'TITLE' => 'bx_catalog_line_category_title',
		'LIST' => 'bx_catalog_line_ul',
		'EMPTY_IMG' => $this->GetFolder().'/images/line-empty.png'
	),
	'TEXT' => array(
		'CONT' => 'bx_catalog_text',
		'TITLE' => 'bx_catalog_text_category_title',
		'LIST' => 'bx_catalog_text_ul'
	),
	'TILE' => array(
		'CONT' => 'bx_catalog_tile',
		'TITLE' => 'bx_catalog_tile_category_title',
		'LIST' => 'bx_catalog_tile_ul',
		'EMPTY_IMG' => $this->GetFolder().'/images/tile-empty.png'
	)
);
$arCurView = $arViewStyles[$arParams['VIEW_MODE']];

$strSectionEdit = CIBlock::GetArrayByID($arParams["IBLOCK_ID"], "SECTION_EDIT");
$strSectionDelete = CIBlock::GetArrayByID($arParams["IBLOCK_ID"], "SECTION_DELETE");
$arSectionDeleteParams = array("CONFIRM" => GetMessage('CT_BCSL_ELEMENT_DELETE_CONFIRM'));
$this->SetViewTarget('show_section_name');
if ('Y' == $arParams['SHOW_PARENT_NAME'] && 0 < $arResult['SECTION']['ID'])
{
	$this->AddEditAction($arResult['SECTION']['ID'], $arResult['SECTION']['EDIT_LINK'], $strSectionEdit);
	$this->AddDeleteAction($arResult['SECTION']['ID'], $arResult['SECTION']['DELETE_LINK'], $strSectionDelete, $arSectionDeleteParams);
	?>
		<h1 id="<? echo $this->GetEditAreaId($arResult['SECTION']['ID']); ?>">
			<?echo (
				isset($arResult['SECTION']["IPROPERTY_VALUES"]["SECTION_PAGE_TITLE"]) && $arResult['SECTION']["IPROPERTY_VALUES"]["SECTION_PAGE_TITLE"] != ""
				? $arResult['SECTION']["IPROPERTY_VALUES"]["SECTION_PAGE_TITLE"]
				: $arResult['SECTION']['NAME']
			);?>
		</h1>
	<?
}
$this->EndViewTarget();
if ($arResult["SECTIONS_COUNT"]>0){
    $this->SetViewTarget('set_display_sortirovka_block');  $this->EndViewTarget();
}
else{
    $this->SetViewTarget('set_display_sortirovka_block'); echo "display:none"; $this->EndViewTarget();
}
if (0 < $arResult["SECTIONS_COUNT"])
{
?>
<div id="block_icon" <?if ($_SESSION["CART_SECTION_VIEW"] == "small"):?>class="small_razdel_firearm"<?endif;?>>
<?
	switch ($arParams['VIEW_MODE'])
	{
		case 'LIST':
			foreach ($arResult['SECTIONS'] as &$arSection)
			{   
                if(intval($arResult['SECTION']["DEPTH_LEVEL"]) + 1 != $arSection["DEPTH_LEVEL"])
                {
                    continue;   
                }
                if ($arSection['~PICTURE']>0) {
                    $resizeImg = CFile::ResizeImageGet($arSection['~PICTURE'], array("width" => 256, "height" => 118))["src"];
                }
				$this->AddEditAction($arSection['ID'], $arSection['EDIT_LINK'], $strSectionEdit);
				$this->AddDeleteAction($arSection['ID'], $arSection['DELETE_LINK'], $strSectionDelete, $arSectionDeleteParams);
				?>
				<div class="razdel_firearm_block" id="<?=$this->GetEditAreaId($arSection['ID']);?>">
					<a class="razdel_firearm" href="<? echo $arSection["SECTION_PAGE_URL"]; ?>">
						<?/*$arImg = CFile::ResizeImageGet($arSection['PICTURE'], Array("width"=>260, "height"=>140), BX_RESIZE_IMAGE_PROPORTIONAL);*/?>
						<?/*<span><img src="/img/razdel_logo.png"/></span>*/?>
						<span class="razdel_firearm_img"><img src="<?=$resizeImg?>"/></span>
						<span class="razdel_firearm_name"><?=$arSection['NAME']?></span>
					</a>
				</div>
			<?
			}
			break;
	}
?>
<div class="clear"></div>
</div>
<?
}
?>