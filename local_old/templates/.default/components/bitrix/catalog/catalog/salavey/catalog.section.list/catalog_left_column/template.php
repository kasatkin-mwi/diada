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
if (0 < $arResult["SECTIONS_COUNT"])
{
?>
<div class="filter_block left_menu_razdel">
<?
	switch ($arParams['VIEW_MODE'])
	{
		case 'LIST':
			$count = 0;
			foreach ($arResult['SECTIONS'] as &$arSection)
			{
                if ($arSection['DEPTH_LEVEL'] == 1) $hideSubsection = 0;
                if (($arSection['DEPTH_LEVEL'] == 1) && !in_array($arSection["UF_WHERE_VIEW"],$arParams["GET_LIST_SHOW"])){
                    $hideSubsection = $arSection["ID"];
                    continue;
                }
			    if (($arSection['DEPTH_LEVEL'] == 2) && !in_array($arSection["UF_WHERE_VIEW"],$arParams["GET_LIST_SHOW"])) continue;
				$this->AddEditAction($arSection['ID'], $arSection['EDIT_LINK'], $strSectionEdit);
                if ($arSection['DEPTH_LEVEL'] == 2){
                    if ($arSection["IBLOCK_SECTION_ID"] == $hideSubsection) continue;
                }
				$this->AddDeleteAction($arSection['ID'], $arSection['DELETE_LINK'], $strSectionDelete, $arSectionDeleteParams);
				?>
				<?if ($arSection['DEPTH_LEVEL'] == 1):?>
					<?if ($prevDepth):?>
								<?if ($prevDepth == 2 && $count>5):?><li class="all_dop_razdel"><a href="">+ Показать все</a></li><?endif;?>
							</ul>
						</div>
					</div>
					<?endif;?>
					<p class="title_menu_razdel" id="<?=$this->GetEditAreaId($arSection['ID']);?>"><a href="<?=$arSection['SECTION_PAGE_URL']?>"><?=$arSection['NAME']?></a></p>
					<div class="dop_menu_razdel_block">
						<div class="dop_menu_razdel">
							<ul class="not_style">
				<?elseif ($arSection['DEPTH_LEVEL'] == 2):?>
					<li id="<?=$this->GetEditAreaId($arSection['ID']);?>"><a href="<?=$arSection['SECTION_PAGE_URL']?>"><?=$arSection['NAME']?></a></li>
				<?endif;?>
				<?
				$prevDepth = $arSection['DEPTH_LEVEL'];
				if ($arSection['DEPTH_LEVEL'] == 1) $count = 0;
				else $count++;
			}
			?>
                    <?if ($prevDepth == 2 && $count>5):?><li class="all_dop_razdel"><a href="">+ Показать все</a></li><?endif;?>
					</ul>
				</div>
			</div>
			<?
			break;
	}
?>
<div class="clear"></div>
</div>
<?
}
?>

<script type="text/javascript">
	$(document).ready(function() {
		//Скрыть по умолчанию
		$('.dop_menu_razdel_block').each(function() {
			$(this).find('li:not(".all_dop_razdel"):gt(5)').hide();
		});

		//Развернуть
		$('.all_dop_razdel').click(function() {
			if ($(this).hasClass('full'))
				$(this).removeClass('full').find('a').text('+ Показать все');
			else
				$(this).addClass('full').find('a').text('- Свернуть');
			$(this).parents('ul').find('li:not(".all_dop_razdel"):gt(5)').slideToggle();
			return false;
		});
	});
</script>