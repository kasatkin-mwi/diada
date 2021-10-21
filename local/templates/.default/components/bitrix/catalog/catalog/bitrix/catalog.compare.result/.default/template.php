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

$isAjax = ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST["ajax_action"]) && $_POST["ajax_action"] == "Y");

$templateData = array(
	'TEMPLATE_THEME' => $this->GetFolder().'/themes/'.$arParams['TEMPLATE_THEME'].'/style.css',
	'TEMPLATE_CLASS' => 'bx_'.$arParams['TEMPLATE_THEME']
);

?><div class="bx_compare <? echo $templateData['TEMPLATE_CLASS']; ?>" id="bx_catalog_compare_block">
	<div class="new_sravnenie_tit">Сравнение</div>
<?
if ($isAjax)
{
	$APPLICATION->RestartBuffer();
}
?>
    <div class="bx_sort_container">
	<div class="sorttext"><?=GetMessage("CATALOG_SHOWN_CHARACTERISTICS")?>:</div>
	<a class="sortbutton<? echo (!$arResult["DIFFERENT"] ? ' current' : ''); ?>" href="<? echo $arResult['COMPARE_URL_TEMPLATE'].'DIFFERENT=N'; ?>" rel="nofollow"><?=GetMessage("CATALOG_ALL_CHARACTERISTICS")?></a>
	<a class="sortbutton<? echo ($arResult["DIFFERENT"] ? ' current' : ''); ?>" href="<? echo $arResult['COMPARE_URL_TEMPLATE'].'DIFFERENT=Y'; ?>" rel="nofollow"><?=GetMessage("CATALOG_ONLY_DIFFERENT")?></a>
</div>
	<?
    $arElDelete = array();
    $arElDeleteParams = array();
    foreach($arResult["ITEMS"] as $arElement)
    {
        $arElDelete[] = $arElement["ID"];
    }
    if(!empty($arElDelete))
        $arElDeleteParams = implode("&ID[]=",$arElDelete);
    ?>
	<div class="srev_all_del_bl">
		<a class="srev_all_del" onclick="CatalogCompareObj.MakeAjaxAction('<?=CUtil::JSEscape('/catalog/compare/?action=DELETE_FROM_COMPARE_RESULT&ID[]='.$arElDeleteParams)?>');" href="javascript:void(0);">Очистить весь список</a>
	</div>
<div class="table_compare new_sravnenie_bl">
<table class="data-table">
<?
if (!empty($arResult["SHOW_FIELDS"]))
{
	foreach ($arResult["SHOW_FIELDS"] as $code => $arProp)
	{
        if($code != "NAME")
            continue;
		$showRow = true;
		if ((!isset($arResult['FIELDS_REQUIRED'][$code]) || $arResult['DIFFERENT']) && count($arResult["ITEMS"]) > 1)
		{
			$arCompare = array();
			foreach($arResult["ITEMS"] as $arElement)
			{
				$arPropertyValue = $arElement["FIELDS"][$code];
				if (is_array($arPropertyValue))
				{
					sort($arPropertyValue);
					$arPropertyValue = implode(" / ", $arPropertyValue);
				}
				$arCompare[] = $arPropertyValue;
			}
			unset($arElement);
			$showRow = (count(array_unique($arCompare)) > 1);
		}
		if ($showRow)
		{
            
			?><tr class="not_border not_hover"><td><?/*=GetMessage("IBLOCK_FIELD_".$code)*/?></td><?
			foreach($arResult["ITEMS"] as $arElement)
			{
				switch($code)
				{
					case "NAME": 
						?>
                        <td valign="top">
                            <a class="srav_close compare" onclick="CatalogCompareObj.MakeAjaxAction('<?=CUtil::JSEscape($arElement['~DELETE_URL'])?>');" href="javascript:void(0)"><i></i></a>
                            <a class="srav_favor item-<?=$arElement['ID']?>" href="javascript:void(0)" data-id="<?=$arElement["ID"]?>"><i></i></a>
                            <?
                            if(is_array($arElement["FIELDS"]["DETAIL_PICTURE"])):?>
                                <a href="<?=$arElement["DETAIL_PAGE_URL"]?>"><img
                                            border="0"
                                            src="<?=$arElement["FIELDS"]["DETAIL_PICTURE"]["SRC"]?>"
                                            style="max-height: 200px; max-width: 200px"
                                            alt="<?=$arElement["FIELDS"]["DETAIL_PICTURE"]["ALT"]?>"
                                            title="<?=$arElement["FIELDS"]["DETAIL_PICTURE"]["TITLE"]?>"
                                    /></a><br />
                            <?elseif(is_array($arElement["FIELDS"]["PREVIEW_PICTURE"])):?>
                                <a href="<?=$arElement["DETAIL_PAGE_URL"]?>"><img
                                            border="0"
                                            src="<?=$arElement["FIELDS"]["PREVIEW_PICTURE"]["SRC"]?>"
                                            style="max-height: 200px; max-width: 200px"
                                            alt="<?=$arElement["FIELDS"]["PREVIEW_PICTURE"]["ALT"]?>"
                                            title="<?=$arElement["FIELDS"]["PREVIEW_PICTURE"]["TITLE"]?>"
                                    /></a><br />
						    <?endif;
						    ?>
                            <a href="<?=$arElement["DETAIL_PAGE_URL"]?>"><?=$arElement[$code]?></a>
						    <?/*if($arElement["CAN_BUY"]):?>
						<noindex><br /><a class="bx_bt_button bx_small" href="<?=$arElement["ADD_URL"]?>" rel="nofollow"><?=GetMessage("CATALOG_COMPARE_BUY"); ?></a></noindex>
						<?elseif(!empty($arResult["PRICES"]) || is_array($arElement["PRICE_MATRIX"])):?>
						<br /><?=GetMessage("CATALOG_NOT_AVAILABLE")?>
						<?endif;*/?>
                        </td>
						<?break;
					case "PREVIEW_PICTURE":
					case "DETAIL_PICTURE":
						break;
					default:
						echo $arElement["FIELDS"][$code];
						break;
				} 
			?>
				
			<?
			}
			unset($arElement);
            ?>
            </tr>
            <?
		}
	
	}
}?>
<?if ($showRow)
		{
			?><tr class="not_hover"><td></td><?
			foreach($arResult["ITEMS"] as $arElement)
			{
		?>
				<td valign="top">
					<?if($arElement["CAN_BUY"]):?>
						<noindex><a class="bx_bt_button bx_small" href="<?=$arElement["ADD_URL"]?>" rel="nofollow"><?=GetMessage("CATALOG_COMPARE_BUY"); ?></a></noindex>
						<?elseif(!empty($arResult["PRICES"]) || is_array($arElement["PRICE_MATRIX"])):?>
						<?=GetMessage("CATALOG_NOT_AVAILABLE")?>
						<?endif;?>
				</td><?
			}
		}
	?>
	</tr>
<?

if (!empty($arResult["SHOW_OFFER_FIELDS"]))
{
	foreach ($arResult["SHOW_OFFER_FIELDS"] as $code => $arProp)
	{
		$showRow = true;
		if ($arResult['DIFFERENT'])
		{
			$arCompare = array();
			foreach($arResult["ITEMS"] as $arElement)
			{
				$Value = $arElement["OFFER_FIELDS"][$code];
				if(is_array($Value))
				{
					sort($Value);
					$Value = implode(" / ", $Value);
				}
				$arCompare[] = $Value;
			}
			unset($arElement);
			$showRow = (count(array_unique($arCompare)) > 1);
		}
		if ($showRow)
		{
		?>
		<tr>
			<td><?=GetMessage("IBLOCK_OFFER_FIELD_".$code)?></td>
			<?foreach($arResult["ITEMS"] as $arElement)
			{
			?>
			<td>
				<?=(is_array($arElement["OFFER_FIELDS"][$code])? implode("/ ", $arElement["OFFER_FIELDS"][$code]): $arElement["OFFER_FIELDS"][$code])?>
			</td>
			<?
			}
			unset($arElement);
			?>
		</tr>
		<?
		}
	}
}
?>
<tr>
	<td><?=GetMessage('CATALOG_COMPARE_PRICE');?>
		<?/*if($USER->GetID() == USER_SALAVEY_ID):?>
            <span class="podskazka_block">?<span class="podskazka_text"><span>Текст для подсказки</span></span></span>
        <?endif*/?>
	</td>
	<?
	foreach ($arResult["ITEMS"] as $arElement)
	{
		if (isset($arElement['MIN_PRICE']) && is_array($arElement['MIN_PRICE']))
		{
			?><td><? echo $arElement['MIN_PRICE']['PRINT_DISCOUNT_VALUE']; ?></td><?
		}
		else
		{
			?><td>&nbsp;</td><?
		}
	}
	unset($arElement);
	?>
</tr>
<?
if (!empty($arResult["SHOW_PROPERTIES"]))
{
	foreach ($arResult["SHOW_PROPERTIES"] as $code => $arProperty)
	{        
		$showRow = true;
		if ($arResult['DIFFERENT'])
		{
			$arCompare = array();
			foreach($arResult["ITEMS"] as $arElement)
			{
				$arPropertyValue = $arElement["DISPLAY_PROPERTIES"][$code]["VALUE"];
				if (is_array($arPropertyValue))
				{
					sort($arPropertyValue);
					$arPropertyValue = implode(" / ", $arPropertyValue);
				}
				$arCompare[] = $arPropertyValue;
			}
			unset($arElement);
			$showRow = (count(array_unique($arCompare)) > 1);
		}

		if ($showRow)
		{
			?>
			<tr>
				<td><?=$arProperty["NAME"]?>
		            <?if(!empty($arProperty["HINT"])):?>
                        <span class="podskazka_block">?<span class="podskazka_text"><span><?=$arProperty["HINT"]?></span></span></span>
                    <?endif?>
                </td>
				<?foreach($arResult["ITEMS"] as $arElement)
				{
					?>
					<td>
						<?=(is_array($arElement["DISPLAY_PROPERTIES"][$code]["DISPLAY_VALUE"])? implode("/ ", $arElement["DISPLAY_PROPERTIES"][$code]["DISPLAY_VALUE"]): $arElement["DISPLAY_PROPERTIES"][$code]["DISPLAY_VALUE"])?>
					</td>
				<?
				}
				unset($arElement);
				?>
			</tr>
		<?
		}
	}
}

if (!empty($arResult["SHOW_OFFER_PROPERTIES"]))
{
	foreach($arResult["SHOW_OFFER_PROPERTIES"] as $code=>$arProperty)
	{
		$showRow = true;
		if ($arResult['DIFFERENT'])
		{
			$arCompare = array();
			foreach($arResult["ITEMS"] as $arElement)
			{
				$arPropertyValue = $arElement["OFFER_DISPLAY_PROPERTIES"][$code]["VALUE"];
				if(is_array($arPropertyValue))
				{
					sort($arPropertyValue);
					$arPropertyValue = implode(" / ", $arPropertyValue);
				}
				$arCompare[] = $arPropertyValue;
			}
			unset($arElement);
			$showRow = (count(array_unique($arCompare)) > 1);
		}
		if ($showRow)
		{
		?>
		<tr>
			<td><?=$arProperty["NAME"]?>
		        <?if(!empty($arProperty["HINT"])):?>
                    <span class="podskazka_block">?<span class="podskazka_text"><span><?=$arProperty["HINT"]?></span></span></span>
                <?endif?>
            </td>
			<?foreach($arResult["ITEMS"] as $arElement)
			{
			?>
			<td>
				<?=(is_array($arElement["OFFER_DISPLAY_PROPERTIES"][$code]["DISPLAY_VALUE"])? implode("/ ", $arElement["OFFER_DISPLAY_PROPERTIES"][$code]["DISPLAY_VALUE"]): $arElement["OFFER_DISPLAY_PROPERTIES"][$code]["DISPLAY_VALUE"])?>
			</td>
			<?
			}
			unset($arElement);
			?>
		</tr>
		<?
		}
	}
}
	?>
	<tr>
		<td></td>
		<?foreach($arResult["ITEMS"] as $arElement)
		{
		?>
		<td>
			<a class="srav_del_bt" onclick="CatalogCompareObj.MakeAjaxAction('<?=CUtil::JSEscape($arElement['~DELETE_URL'])?>');" href="javascript:void(0)"><?=GetMessage("CATALOG_REMOVE_PRODUCT")?></a>
		</td>
		<?
		}
		unset($arElement);
		?>
	</tr>
</table>
</div>
<?
if (!empty($arResult["ALL_FIELDS"]) || !empty($arResult["ALL_PROPERTIES"]) || !empty($arResult["ALL_OFFER_FIELDS"]) || !empty($arResult["ALL_OFFER_PROPERTIES"]))
{
    ?>
    <div class="bx_filtren_container">
        <h5><?=GetMessage("CATALOG_COMPARE_PARAMS")?></h5>
        <ul><?
            if (!empty($arResult["ALL_FIELDS"]))
            {
                foreach ($arResult["ALL_FIELDS"] as $propCode => $arProp)
                {
					if ($propCode == "PREVIEW_PICTURE" || $propCode =="DETAIL_PICTURE") continue;
                    if (!isset($arResult['FIELDS_REQUIRED'][$propCode]))
                    {
                        ?>
                        <li><span class="new_srav_form_el js_function<? echo ($arProp["IS_DELETED"] == "N" ? ' active' : ''); ?>">
        <span><input onchange="CatalogCompareObj.MakeAjaxAction('<?=CUtil::JSEscape($arProp["ACTION_LINK"])?>')" type="checkbox" id="PF_<?=$propCode?>"<? echo ($arProp["IS_DELETED"] == "N" ? ' checked="checked"' : ''); ?>></span>
        <label for="PF_<?=$propCode?>"><?=GetMessage("IBLOCK_FIELD_".$propCode)?></label>
    </span></li>
                        <?
                    }
                }
            }
            if (!empty($arResult["ALL_OFFER_FIELDS"]))
            {
                foreach($arResult["ALL_OFFER_FIELDS"] as $propCode => $arProp)
                {
                    ?>
                    <li><span class="new_srav_form_el<? echo ($arProp["IS_DELETED"] == "N" ? ' active' : ''); ?>">
    <span><input onchange="CatalogCompareObj.MakeAjaxAction('<?=CUtil::JSEscape($arProp["ACTION_LINK"])?>')" type="checkbox" id="OF_<?=$propCode?>"<? echo ($arProp["IS_DELETED"] == "N" ? ' checked="checked"' : ''); ?>></span>
    <label for="OF_<?=$propCode?>"><?=GetMessage("IBLOCK_OFFER_FIELD_".$propCode)?></label>
</span></li>
                    <?
                }
            }
            if (!empty($arResult["ALL_PROPERTIES"]))
            {
                foreach($arResult["ALL_PROPERTIES"] as $propCode => $arProp)
                {
                    ?>
                    <li><span class="new_srav_form_el<? echo ($arProp["IS_DELETED"] == "N" ? ' active' : ''); ?>">
        <span><input onchange="CatalogCompareObj.MakeAjaxAction('<?=CUtil::JSEscape($arProp["ACTION_LINK"])?>')" type="checkbox" id="PP_<?=$propCode?>"<?echo ($arProp["IS_DELETED"] == "N" ? ' checked="checked"' : '');?>></span>
        <label for="PP_<?=$propCode?>"><?=$arProp["NAME"]?></label>
    </span></li>
                    <?
                }
            }
            if (!empty($arResult["ALL_OFFER_PROPERTIES"]))
            {
                foreach($arResult["ALL_OFFER_PROPERTIES"] as $propCode => $arProp)
                {
                    ?>
                    <li><span class="new_srav_form_el<? echo ($arProp["IS_DELETED"] == "N" ? ' active' : ''); ?>">
        <span><input onchange="CatalogCompareObj.MakeAjaxAction('<?=CUtil::JSEscape($arProp["ACTION_LINK"])?>')" type="checkbox" id="OP_<?=$propCode?>"<? echo ($arProp["IS_DELETED"] == "N" ? ' checked="checked"' : ''); ?>></span>
        <label for="OP_<?=$propCode?>"><?=$arProp["NAME"]?></label>
    </span></li>
                    <?
                }
            }
            ?>
        </ul>
    </div>
    <?
}
?>
<?
if ($isAjax)
{
	die();
}
?>
</div>
<script type="text/javascript">
	var CatalogCompareObj = new BX.Iblock.Catalog.CompareClass("bx_catalog_compare_block");
</script>