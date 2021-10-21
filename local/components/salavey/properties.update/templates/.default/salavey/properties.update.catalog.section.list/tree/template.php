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

$strTitle = "";
?>
<?$this->SetViewTarget("filter_sections");?>
<div class="sections_filter">
	<h3>Разделы</h3>
	<div class="catalog-section-list">
		<form action="<?=POST_FORM_ACTION_URI;?>" method="POST">
		<?
		$TOP_DEPTH = $arResult["SECTION"]["DEPTH_LEVEL"];
		$CURRENT_DEPTH = $TOP_DEPTH;

		foreach($arResult["SECTIONS"] as $arSection)
		{
			$this->AddEditAction($arSection['ID'], $arSection['EDIT_LINK'], CIBlock::GetArrayByID($arSection["IBLOCK_ID"], "SECTION_EDIT"));
			$this->AddDeleteAction($arSection['ID'], $arSection['DELETE_LINK'], CIBlock::GetArrayByID($arSection["IBLOCK_ID"], "SECTION_DELETE"), array("CONFIRM" => GetMessage('CT_BCSL_ELEMENT_DELETE_CONFIRM')));
			if($CURRENT_DEPTH < $arSection["DEPTH_LEVEL"])
			{
				echo "\n",str_repeat("\t", $arSection["DEPTH_LEVEL"]-$TOP_DEPTH),"<ul>";
			}
			elseif($CURRENT_DEPTH == $arSection["DEPTH_LEVEL"])
			{
				echo "</li>";
			}
			else
			{
				while($CURRENT_DEPTH > $arSection["DEPTH_LEVEL"])
				{
					echo "</li>";
					echo "\n",str_repeat("\t", $CURRENT_DEPTH-$TOP_DEPTH),"</ul>","\n",str_repeat("\t", $CURRENT_DEPTH-$TOP_DEPTH-1);
					$CURRENT_DEPTH--;
				}
				echo "\n",str_repeat("\t", $CURRENT_DEPTH-$TOP_DEPTH),"</li>";
			}

			$count = $arParams["COUNT_ELEMENTS"] && $arSection["ELEMENT_CNT"] ? "&nbsp;(".$arSection["ELEMENT_CNT"].")" : "";

			if ($arParams['SECTION_ID']==$arSection['ID'])
			{
				$link = '<b>'.$arSection["NAME"].$count.'</b>';
				$strTitle = $arSection["NAME"];
			}
			else
			{
				$link = '<a href="javascript:void(0);" data-sect_id="'.$arSection["ID"].'">'.$arSection["NAME"].$count.'</a>';
			}

			echo "\n",str_repeat("\t", $arSection["DEPTH_LEVEL"]-$TOP_DEPTH);
			?><li  id="<?=$this->GetEditAreaId($arSection['ID']);?>"><?=$link?><?

			$CURRENT_DEPTH = $arSection["DEPTH_LEVEL"];
		}

		while($CURRENT_DEPTH > $TOP_DEPTH)
		{
			echo "</li>";
			echo "\n",str_repeat("\t", $CURRENT_DEPTH-$TOP_DEPTH),"</ul>","\n",str_repeat("\t", $CURRENT_DEPTH-$TOP_DEPTH-1);
			$CURRENT_DEPTH--;
		}
		?>
		<input type="submit" style="display:none;" name="SECTION_SUBMIT"/>
		</form>
	</div>
</div>
<?$this->EndViewTarget();?>