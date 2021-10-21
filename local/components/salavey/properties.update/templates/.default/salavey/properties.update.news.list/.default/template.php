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
<div class="elem_update_wrapper">
	<?if(!$arResult["IS_CATALOG"]):?>
	<p>Не является торговым каталогом</p>
	<?endif;?>
	<?if($arResult["SUCCESS"]):?>
	<p class="success">Свойства обновлены</p>
	<?elseif($arResult["ERRORS"]):?>
	<?foreach($arResult["ERRORS"] as $error):?>
	<p class="error"><?=$error?></p>
	<?endforeach;?>
	<?endif;?> 
	<form id="update_form" action="<?=POST_FORM_ACTION_URI;?>" method="POST">
		<div class="props_block">
			<div class="prop_select">
				<?if($arResult["ITEMS"]):?>
					<?if($arResult["IS_CATALOG"]):?>
				<div class="radio">
					<p><label><input name="IS_CATALOG_PROP"<?if(!$arResult["IS_CATALOG_PROP"]):?> checked<?endif;?> type="radio" value="0"> Обычные свойства</label></p>
					<p><label><input name="IS_CATALOG_PROP"<?if($arResult["IS_CATALOG_PROP"]):?> checked<?endif;?> type="radio" value="1"> Свойства торгового каталога</label></p>
				</div>
					<?endif;?>
				<?if(!$arResult["IS_CATALOG_PROP"]):?>
				<select name="PROPERTY_CODE">
					<option value="">Выберите свойство:</option>
					<?foreach($arResult["PROPERTIES"] as $code => $arProp):?>
					<?
					//if($arResult["DEFAULT_VALUE_PROP"] && !$arProp["IS_DEFAULT"]) continue;
					//elseif(!$arResult["DEFAULT_VALUE_PROP"] && $arProp["IS_DEFAULT"]) continue;
					?>
					<option value="<?=$code;?>"<?if($arResult["SELECTED_PROP"]["CODE"] && $arResult["SELECTED_PROP"]["CODE"] == $code):?> selected<?endif;?>><?=$arProp["NAME"];?> (<?=$code?>)</option>
					<?endforeach;?>
				</select>
				<?else:?>
					<?if($arResult["CATALOG_PROPS"]):?>
				<select name="CATALOG_PROPERTY_CODE">
					<option value="">Выберите свойство каталога:</option>
					<?foreach($arResult["CATALOG_PROPS"] as $code => $title):?>
					<option value="<?=$code;?>"<?if($arResult["SELECTED_CATALOG_PROP"] && $arResult["SELECTED_CATALOG_PROP"]["CODE"] == $code):?> selected<?endif;?>><?=$title;?> (<?=$code?>)</option>
					<?endforeach;?>
				</select>
					<?endif;?>
				<?endif;?>
				<?endif;?>
			</div>
			<?//echo "<pre>"; print_r($_POST); echo "</pre>";?>
			<div class="prop_submit">
				<?if(isset($arResult["SELECTED_PROP"])|| isset($arResult["SELECTED_CATALOG_PROP"])):?>
				<?if($arResult["SELECTED_PROP"]["PROPERTY_TYPE"] == "L" || $arResult["SELECTED_CATALOG_PROP"]["PROPERTY_TYPE"] == "L" || $arResult["SELECTED_CATALOG_PROP"]["PROPERTY_TYPE"] == "R"):?>
				<p>Выберите новое значение:</p>
				<?else:?>
				<p>Введите новое значение:</p>
				<?endif;?>
				<?if(isset($arResult["SELECTED_PROP"])):?>
					<?
					$propertyID = $arResult["SELECTED_PROP"]["ID"];
					
					if ($arResult["SELECTED_PROP"]["MULTIPLE"] == "Y")
					{
						$inputNum = $arResult["SELECTED_PROP"]["MULTIPLE_CNT"];
					}
					else
					{
						$inputNum = 1;
					}
					
					switch ($arResult["SELECTED_PROP"]["PROPERTY_TYPE"]):
					
						case "S":
							for ($i = 0; $i<$inputNum; $i++)
							{
								if ($i == 0)
								{
									$value = $arResult["SELECTED_PROP"]["DEFAULT_VALUE"];

								}
								else
								{
									$value = "";
								}
							?>
							<input type="text" name="PROPERTY[<?=$propertyID?>][<?=$i?>]" value="<?=$value?>" /><br /><?
							?><br /><?
							}
							break;
						case "N":
							for ($i = 0; $i<$inputNum; $i++)
							{
								if ($i == 0)
								{
									$value = $arResult["SELECTED_PROP"]["DEFAULT_VALUE"];

								}
								else
								{
									$value = "";
								}
							?>
							<input type="number" name="PROPERTY[<?=$propertyID?>][<?=$i?>]" value="<?=$value?>" /><br /><?
							?><br /><?
							}
						break;
					
						case "L":
						
							?>
							<p></p>
							<?

							if ($arResult["SELECTED_PROP"]["LIST_TYPE"] == "C")
								$type = $arResult["SELECTED_PROP"]["MULTIPLE"] == "Y" ? "checkbox" : "radio";
							else
								$type = $arResult["SELECTED_PROP"]["MULTIPLE"] == "Y" ? "multiselect" : "dropdown";
							

							switch ($type):
								case "checkbox":
								case "radio":
									foreach ($arResult["SELECTED_PROP"]["ENUM"] as $key => $arEnum)
									{
										$checked = false;
										if ($arEnum["DEF"] == "Y") $checked = true;

										?>
						<input type="<?=$type?>" name="PROPERTY[<?=$propertyID?>]<?=$type == "checkbox" ? "[".$key."]" : ""?>" value="<?=$key?>" id="property_<?=$key?>"<?=$checked ? " checked=\"checked\"" : ""?> /><label for="property_<?=$key?>"><?=$arEnum["VALUE"]?></label><br />
										<?
									}
								break;

								case "dropdown":
								case "multiselect":
								?>
						<select name="PROPERTY[<?=$propertyID?>]<?=$type=="multiselect" ? "[]\" size=\"".$arResult["PROPERTY_LIST_FULL"][$propertyID]["ROW_COUNT"]."\" multiple=\"multiple" : ""?>">
							<option value="">Выберите вариант</option>
								<?
									if (intval($propertyID) > 0) $sKey = "ELEMENT_PROPERTIES";
									else $sKey = "ELEMENT";

									foreach ($arResult["SELECTED_PROP"]["ENUM"] as $key => $arEnum)
									{
										$checked = false;
										if ($arEnum["DEF"] == "Y") $checked = true;
										?>
							<option value="<?=$key?>" <?=$checked ? " selected=\"selected\"" : ""?>><?=$arEnum["VALUE"]?></option>
										<?
									}
								?>
						</select>
								<?
								break;

							endswitch;
						break;
					endswitch;?>
					
				<?elseif(isset($arResult["SELECTED_CATALOG_PROP"])):?>
				<?
					$propertyID = $arResult["SELECTED_CATALOG_PROP"]["CODE"];
					switch ($arResult["SELECTED_CATALOG_PROP"]["PROPERTY_TYPE"]):
						
					
						case "S":
							?>
							<input type="text" name="CATALOG_PROPERTY[<?=$propertyID?>]" value="" /><br />
							<?
							break;
						case "N":
							?>
							<input type="number" name="CATALOG_PROPERTY[<?=$propertyID?>]" value="" /><br />
							<?
							break;
						case "D":
						?>
							<input type="text" name="CATALOG_PROPERTY[<?=$propertyID?>]" value="" /><br />
							<?
							$APPLICATION->IncludeComponent(
								'bitrix:main.calendar',
								'',
								array(
									'FORM_NAME' => 'iblock_add',
									'INPUT_NAME' => "PROPERTY[".$propertyID."][".$i."]",
									'INPUT_VALUE' => $value,
								),
								null,
								array('HIDE_ICONS' => 'Y')
							);
							?>
							<br /><small>Формат: <?=FORMAT_DATETIME?>
							</small><br />
							<?
							break;
						case "R":
						case "L":
						?>
						<select name="CATALOG_PROPERTY[<?=$propertyID?>]">
							<option value="">Выберите вариант</option>
						<?
							foreach($arResult["SELECTED_CATALOG_PROP"]["VALUES"] as $val)
							{
							?>
								<option value="<?=$val?>"><?=$val?></option>
							<?
							}
							
						?></select><?
							break;
						//default:
					endswitch;
				?>
				<?endif;?>
				<?endif;?>
				<?if($arResult["SELECTED_PROP"] || $arResult["SELECTED_CATALOG_PROP"]):?>
					<div class="submit_btns">
						<input class="btn js_btn" name="UPDATE_PROPS" type="submit"/>
					</div>
				<?endif;?>
			</div>
		</div>
		<div class="elements js_elements">
			<?if($arResult["ITEMS"]):?>
				<span>Выберите элементы:</span>
				<a class="check_circle_bt" href="javascript:void(0);"><i class="fa fa-check-circle-o" aria-hidden="true"></i> Отметить все</a>
				<a class="clear_all_bt" href="javascript:void(0);"><i class="fa fa-ban" aria-hidden="true"></i> Очистить все</a>
				<?foreach($arResult["ITEMS"] as $arItem):?>
				<?if(in_array($arItem["ID"],$arResult["SELECTED_ELEMENTS"])) $checked = true; else $checked = false;?>
				<div>
					<label><input type="checkbox" <?if($checked):?>checked <?endif;?>value="<?=$arItem["ID"];?>" name="ELEMENTS[]"/><?=$arItem["NAME"];?></label>
				</div>
				<?endforeach;?>
			<?endif;?>
		</div>
		<input id="submit_btn" type="submit" style="display:none" />
	</form>
	<?if($arParams["DISPLAY_BOTTOM_PAGER"]):?>
		<br /><?=$arResult["NAV_STRING"]?>
	<?endif;?>
</div>