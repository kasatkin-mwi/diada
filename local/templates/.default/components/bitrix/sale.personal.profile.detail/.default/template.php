<div class="lk_gray_bg">
	
<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

use Bitrix\Main\Localization\Loc;

?>
<div class="lk_double_col">
	<div class="lk_title">Редактирование профиля</div>
	<div class="sale-profile-detail-link-list">
		<a href="<?=$arParams["PATH_TO_LIST"]?>"><?=GetMessage("SPPD_RECORDS_LIST")?></a>
	</div>
</div>
<div class="lk_white_bg">
<div class="lk_small_width_bl">
<?
if(strlen($arResult["ID"])>0)
{
	ShowError($arResult["ERROR_MESSAGE"]);
	?>
	<form method="post"  class="col-md-12 sale-profile-detail-form" action="<?=POST_FORM_ACTION_URI?>" enctype="multipart/form-data">
		<?=bitrix_sessid_post()?>
		<input type="hidden" name="ID" value="<?=$arResult["ID"]?>">
		<div class="first sale-personal-profile-detail-form-title-row col-md-offset-3 col-md-9">
			<h4>
				<b><?= Loc::getMessage('SPPD_PROFILE_NO', array("#ID#" => $arResult["ID"]))?></b>
			</h4>
		</div>
		<ul class="not_style reg_form_el form-group">
			<li><?=Loc::getMessage('SALE_PERS_TYPE')?> <span style="font-family:latoregular;"><?=$arResult["PERSON_TYPE"]["NAME"]?></span></li>
		</ul>
		<ul class="not_style reg_form_el form-group">
			<li>
				<?=Loc::getMessage('SALE_PNAME')?>:<span class="req">*</span>
			</li>
			<li>
				<input class="form-control" type="text" name="NAME" maxlength="50" id="sale-personal-profile-detail-name" value="<?=htmlspecialcharsbx($arResult["NAME"])?>" />
			</li>
		</ul>
		<?
		foreach($arResult["ORDER_PROPS"] as $block)
		{                           
			if (!empty($block["PROPS"]) && $block["ID"] == 1)
			{
				?>
				<div class="sale-personal-profile-detail-form-title-row col-md-offset-3 col-md-9">
					<h4>
						<b><?= $block["NAME"]?></b>
					</h4>
				</div>
				<?
				foreach($block["PROPS"] as $key => $property)
				{
					if($property['ID'] != 22){ // поле 'Выбирете дату доставки' с ID=22 почему-то не работает, отключил его вывод таким образом
						$name = "ORDER_PROP_".$property["ID"];
						$currentValue = $arResult["ORDER_PROPS_VALUES"][$name];
						$alignTop = ($property["TYPE"] === "LOCATION" && $arParams['USE_AJAX_LOCATIONS'] === 'Y') ? "vertical-align-top" : "";
						?>
						<ul class="not_style reg_form_el sale-personal-profile-detail-property-<?=strtolower($property["TYPE"])?>">
							<li><label class="<?=$alignTop?>" for="sppd-property-<?=$key?>">
								<?= $property["NAME"]?>:
								<?
								if ($property["REQUIED"] == "Y")
								{
									?>
									<span class="req">*</span>
									<?
								}
								?>
							</label></li>
							<li>
								<?
								if ($property["TYPE"] == "CHECKBOX")
								{
									?>
									<input
										class="sale-personal-profile-detail-form-checkbox"
										id="sppd-property-<?=$key?>"
										type="checkbox"
										name="<?=$name?>"
										value="Y"
										<?if ($currentValue == "Y" || !isset($currentValue) && $property["DEFAULT_VALUE"] == "Y") echo " checked";?>/>
									<?
								}
								elseif ($property["TYPE"] == "TEXT")
								{
									if ($property["MULTIPLE"] === 'Y')
									{
										if (empty($currentValue))
											$currentValue = array('');
										foreach ($currentValue as $elementValue)
										{
											?>
											<input
													class="form-control"
													type="text" name="<?=$name?>[]"
													maxlength="50"
													id="sppd-property-<?=$key?>"
													value="<?=$elementValue?>"/>
											<?
										}
										?>
										<span class="btn-themes btn-default btn-md btn input-add-multiple"
											  data-add-type=<?=$property["TYPE"]?>
											  data-add-name="<?=$name?>[]"><?=Loc::getMessage('SPPD_ADD')?></span>
										<?
									}
									else
									{
										?>
										<input
												class="form-control"
												type="text" name="<?=$name?>"
												maxlength="50"
												id="sppd-property-<?=$key?>"
												value="<?=$currentValue?>"/>
										<?
									}
								}
								elseif ($property["TYPE"] == "SELECT")
								{
									?>
									<select
										class="form-control"
										name="<?=$name?>"
										id="sppd-property-<?=$key?>"
										size="<?echo (intval($property["SIZE1"])>0)?$property["SIZE1"]:1; ?>">
											<?
											foreach ($property["VALUES"] as $value)
											{
												?>
												<option value="<?= $value["VALUE"]?>" <?if ($value["VALUE"] == $currentValue || !isset($currentValue) && $value["VALUE"]==$property["DEFAULT_VALUE"]) echo " selected"?>>
													<?= $value["NAME"]?>
												</option>
												<?
											}
											?>
									</select>
									<?
								}
								elseif ($property["TYPE"] == "MULTISELECT")
								{
									?>
									<select
										class="form-control"
										id="sppd-property-<?=$key?>"
										multiple name="<?=$name?>[]"
										size="<?echo (intval($property["SIZE1"])>0)?$property["SIZE1"]:5; ?>">
											<?
											$arCurVal = array();
											$arCurVal = explode(",", $currentValue);
											for ($i = 0, $cnt = count($arCurVal); $i < $cnt; $i++)
												$arCurVal[$i] = trim($arCurVal[$i]);
											$arDefVal = explode(",", $property["DEFAULT_VALUE"]);
											for ($i = 0, $cnt = count($arDefVal); $i < $cnt; $i++)
												$arDefVal[$i] = trim($arDefVal[$i]);
											foreach($property["VALUES"] as $value)
											{
												?>
												<option value="<?= $value["VALUE"]?>"<?if (in_array($value["VALUE"], $arCurVal) || !isset($currentValue) && in_array($value["VALUE"], $arDefVal)) echo" selected"?>><?echo $value["NAME"]?></option>
												<?
											}
											?>
									</select>
									<?
								}
								elseif ($property["TYPE"] == "TEXTAREA")
								{
									?>
									<textarea
										class="form-control"
										id="sppd-property-<?=$key?>"
										rows="<?echo ((int)($property["SIZE2"])>0)?$property["SIZE2"]:4; ?>"
										cols="<?echo ((int)($property["SIZE1"])>0)?$property["SIZE1"]:40; ?>"
										name="<?=$name?>"><?= (isset($currentValue)) ? $currentValue : $property["DEFAULT_VALUE"];?>
									</textarea>
									<?
								}
								elseif ($property["TYPE"] == "LOCATION")
								{
									$locationTemplate = ($arParams['USE_AJAX_LOCATIONS'] !== 'Y') ? "popup" : "";
									$locationClassName = 'location-block-wrapper';
									if ($arParams['USE_AJAX_LOCATIONS'] === 'Y')
									{
										$locationClassName .= ' location-block-wrapper-delimeter';
									}
									if ($property["MULTIPLE"] === 'Y')
									{
										if (empty($currentValue))
											$currentValue = array($property["DEFAULT_VALUE"]);

										foreach ($currentValue as $key => $elementValue)
										{
											$locationValue = intval($elementValue) ? $elementValue : $property["DEFAULT_VALUE"];
											CSaleLocation::proxySaleAjaxLocationsComponent(
												array(
													"ID" => "propertyLocation".$name."[$key]",
													"AJAX_CALL" => "N",
													'CITY_OUT_LOCATION' => 'Y',
													'COUNTRY_INPUT_NAME' => $name.'_COUNTRY',
													'CITY_INPUT_NAME' => $name."[$key]",
													'LOCATION_VALUE' => $locationValue,
												),
												array(
												),
												$locationTemplate,
												true,
												$locationClassName
											);
										}
										?>
										<span class="btn-themes btn-default btn-md btn input-add-multiple"
											  data-add-type=<?=$property["TYPE"]?>
											  data-add-name="<?=$name?>"
											  data-add-last-key="<?=$key?>"
											  data-add-template="<?=$locationTemplate?>"><?=Loc::getMessage('SPPD_ADD')?></span>
										<?
									}
									else
									{
										$locationValue = (int)($currentValue) ? (int)$currentValue : $property["DEFAULT_VALUE"];

										CSaleLocation::proxySaleAjaxLocationsComponent(
											array(
												"AJAX_CALL" => "N",
												'CITY_OUT_LOCATION' => 'Y',
												'COUNTRY_INPUT_NAME' => $name.'_COUNTRY',
												'CITY_INPUT_NAME' => $name,
												'LOCATION_VALUE' => $locationValue,
											),
											array(
											),
											$locationTemplate,
											true,
											'location-block-wrapper'
										);
									}
								}
								elseif ($property["TYPE"] == "RADIO")
								{
									foreach($property["VALUES"] as $value)
									{
										?>
										<input
											class="form-control"
											type="radio"
											id="sppd-property-<?=$key?>"
											name="<?=$name?>"
											value="<?echo $value["VALUE"]?>"
											<?if ($value["VALUE"] == $currentValue || !isset($currentValue) && $value["VALUE"] == $property["DEFAULT_VALUE"]) echo " checked"?>>
										<?= $value["NAME"]?><br />
										<?
									}
								}
								elseif ($property["TYPE"] == "FILE")
								{
									$multiple = ($property["MULTIPLE"] === "Y") ? "multiple" : '';
									$profileFiles = is_array($currentValue) ? $currentValue : array($currentValue);
									if (count($currentValue) > 0)
									{
										?>
										<input type="hidden" name="<?=$name?>_del" class="profile-property-input-delete-file">
										<?
										foreach ($profileFiles as $file)
										{
											?>
											<div class="sale-personal-profile-detail-form-file">
												<?
												$fileId = $file['ID'];
												if (CFile::IsImage($file['FILE_NAME']))
												{
													?>
													<div class="sale-personal-profile-detail-prop-img">
														<?=CFile::ShowImage($fileId, 150, 150, "border=0", "", true)?>
													</div>
													<?
												}
												else
												{
													?>
													<a download="<?=$file["ORIGINAL_NAME"]?>" href="<?=CFile::GetFileSRC($file)?>">
														<?=Loc::getMessage('SPPD_DOWNLOAD_FILE', array("#FILE_NAME#" => $file["ORIGINAL_NAME"]))?>
													</a>
													<?
												}
												?>
												<input type="checkbox" value="<?=$fileId?>" class="profile-property-check-file" id="profile-property-check-file-<?=$fileId?>">
												<label for="profile-property-check-file-<?=$fileId?>"><?=Loc::getMessage('SPPD_DELETE_FILE')?></label>
											</div>
											<?
										}
									}
									?>
									<label>
										<span class="btn-themes btn-default btn-md btn">
											<?=Loc::getMessage('SPPD_SELECT')?>
										</span>
										<span class="sale-personal-profile-detail-load-file-info">
											<?=Loc::getMessage('SPPD_FILE_NOT_SELECTED')?>
										</span>
										<?=CFile::InputFile($name."[]", 20, null, false, 0, "IMAGE", "class='btn sale-personal-profile-detail-input-file' ".$multiple)?>
									</label>
									<span class="sale-personal-profile-detail-load-file-cancel sale-personal-profile-hide"></span>
									<?
								}

								if (strlen($property["DESCRIPTION"]) > 0)
								{
									?>
									<br /><small><?= $property["DESCRIPTION"] ?></small>
									<?
								}
								?>
							</li>
						</ul>
						<?
					}
				}
			}
		}
		?>
		<div class="sale-personal-profile-btn-block" align="center">
			<input type="submit" class="big_red_button btn btn-themes btn-default btn-md" name="save" value="<?echo GetMessage("SALE_SAVE") ?>">
			&nbsp;
			<input type="submit" class="big_gray_button btn btn-themes btn-default btn-md"  name="apply" value="<?=GetMessage("SALE_APPLY")?>">
			&nbsp;
			<input type="submit" class="big_gray_button btn btn-themes btn-default btn-md"  name="reset" value="<?echo GetMessage("SALE_RESET")?>">
		</div>
	</form>
	<div class="clearfix"></div>
	<?
	$javascriptParams = array(
		"ajaxUrl" => CUtil::JSEscape($this->__component->GetPath().'/ajax.php'),
	);
	$javascriptParams = CUtil::PhpToJSObject($javascriptParams);
	?>
	<script>
		BX.message({
			SPPD_FILE_COUNT: '<?=Loc::getMessage('SPPD_FILE_COUNT')?>',
			SPPD_FILE_NOT_SELECTED: '<?=Loc::getMessage('SPPD_FILE_NOT_SELECTED')?>'
		});
		BX.Sale.PersonalProfileComponent.PersonalProfileDetail.init(<?=$javascriptParams?>);
	</script>
	<?
}
else
{
	ShowError($arResult["ERROR_MESSAGE"]);
}
?>
</div>
</div>
</div>
