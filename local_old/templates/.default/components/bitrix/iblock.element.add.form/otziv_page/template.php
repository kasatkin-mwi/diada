<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();
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
$this->setFrameMode(false);
?>
	<form name="iblock_add" action="" method="post">
	<?=bitrix_sessid_post()?>

	<?if (!empty($arResult["ERRORS"])):?>
		<div class="msg"><?ShowError(implode("<br />", $arResult["ERRORS"]))?></div>
	<?endif;
	if (strlen($arResult["MESSAGE"]) > 0):?>
		<div class="msg"><?ShowNote($arResult["MESSAGE"])?></div>
	<?endif?>

	<?$value = intval($propertyID) > 0 ? $arResult["ELEMENT_PROPERTIES"][$propertyID][$i]["~VALUE"] : $arResult["ELEMENT"][$propertyID];?>

	<ul class="add_comment_form">
		<li>
			<div>
				<p>ТИП СООБЩЕНИЯ</p>
				<?$propertyID = 4588?>
				<select name="PROPERTY[<?=$propertyID?>]">
					<option value=""><?echo GetMessage("CT_BIEAF_PROPERTY_VALUE_NA")?></option>
						<?
							if (intval($propertyID) > 0) $sKey = "ELEMENT_PROPERTIES";
							else $sKey = "ELEMENT";

							foreach ($arResult["PROPERTY_LIST_FULL"][$propertyID]["ENUM"] as $key => $arEnum)
							{
								$checked = false;
								if ($arParams["ID"] > 0 || count($arResult["ERRORS"]) > 0)
								{
									foreach ($arResult[$sKey][$propertyID] as $elKey => $arElEnum)
									{
										if ($key == $arElEnum["VALUE"])
										{
											$checked = true;
											break;
										}
									}
								}
								else
								{
									if ($arEnum["DEF"] == "Y") $checked = true;
								}
								?>
					<option value="<?=$key?>" <?=$checked ? " selected=\"selected\"" : ""?>><?=$arEnum["VALUE"]?></option>
								<?
							}
						?>
				</select>
			</div>
			<div>
				<p>КОМУ</p>
				<?$propertyID = 4589?>
				<select name="PROPERTY[<?=$propertyID?>]">
					<option value=""><?echo GetMessage("CT_BIEAF_PROPERTY_VALUE_NA")?></option>
						<?
							if (intval($propertyID) > 0) $sKey = "ELEMENT_PROPERTIES";
							else $sKey = "ELEMENT";

							foreach ($arResult["PROPERTY_LIST_FULL"][$propertyID]["ENUM"] as $key => $arEnum)
							{
								$checked = false;
								if ($arParams["ID"] > 0 || count($arResult["ERRORS"]) > 0)
								{
									foreach ($arResult[$sKey][$propertyID] as $elKey => $arElEnum)
									{
										if ($key == $arElEnum["VALUE"])
										{
											$checked = true;
											break;
										}
									}
								}
								else
								{
									if ($arEnum["DEF"] == "Y") $checked = true;
								}
								?>
					<option value="<?=$key?>" <?=$checked ? " selected=\"selected\"" : ""?>><?=$arEnum["VALUE"]?></option>
								<?
							}
						?>
				</select>
			</div>
			<div>
				<p>НОМЕР ЗАКАЗА</p>
				<input type="text" name="PROPERTY[4590][0]" value="<?=$arResult["ELEMENT_PROPERTIES"][4590][0]["~VALUE"]?>"  placeholder='XXXXXX' />
			</div>
			<?if($arParams["USE_CAPTCHA"] == "Y" && $arParams["ID"] <= 0):?>
				<div>
					<p>ПРОВЕРОЧНЫЙ КОД</p>
					<input type="hidden" name="captcha_sid" value="<?=$arResult["CAPTCHA_CODE"]?>" />
					<img src="/bitrix/tools/captcha.php?captcha_sid=<?=$arResult["CAPTCHA_CODE"]?>" width="202" height="33" alt="CAPTCHA" />
				</div>
			<?endif?>
		</li>
		<li>
			<div>
				<p>ВАШЕ СООБЩЕНИЕ</p>
				<textarea name="PROPERTY[PREVIEW_TEXT][0]" placeholder="Укажите максимально подробную информацию"><?=$arResult["ELEMENT"]["PREVIEW_TEXT"]?></textarea>
			</div>
			<div>
				<p>ВАША ОЦЕНКА</p>
				<div class="add_comment_star">

                <?$propertyID = 4593?>
				<?
					if (intval($propertyID) > 0) $sKey = "ELEMENT_PROPERTIES";
					else $sKey = "ELEMENT";

					foreach ($arResult["PROPERTY_LIST_FULL"][$propertyID]["ENUM"] as $key => $arEnum)
					{
						$checked = false;
						if ($arParams["ID"] > 0 || count($arResult["ERRORS"]) > 0)
						{
							foreach ($arResult[$sKey][$propertyID] as $elKey => $arElEnum)
							{
								if ($key == $arElEnum["VALUE"])
								{
									$checked = true;
									break;
								}
							}
						}
						else
						{
							if ($arEnum["DEF"] == "Y") $checked = true;
						}
						?>
						<input <?=$checked ? " checked=\"checked\"" : ""?> name="PROPERTY[<?=$propertyID?>][0]" type="radio" value="<?=$key?>" />
						<?
					}
				?>
				</div>
			</div>
		</li>
		<li>
			<div>
				<p>ВАШЕ ИМЯ</p>
				<input type="text" name="PROPERTY[NAME][0]" value="<?=$arResult["ELEMENT"]["NAME"]?>" placeholder='Иван Иванов'/>
			</div>
			<div>
				<p>ЭЛЕКТРОННАЯ ПОЧТА</p>
				<input type="text" name="PROPERTY[4591][0]" value="<?=$arResult["ELEMENT_PROPERTIES"][4591][0]["~VALUE"]?>" placeholder='mail@mail.ru' />
			</div>
			<div>
				<p>МОБИЛЬНЫЙ ТЕЛЕФОН</p>
				<input class="phone" type="text" name="PROPERTY[4592][0]" value="<?=$arResult["ELEMENT_PROPERTIES"][4592][0]["~VALUE"]?>"  placeholder='+7 (XXX) XXX-XX-XX' />
			</div>
			<?if($arParams["USE_CAPTCHA"] == "Y" && $arParams["ID"] <= 0):?>
				<div>
					<p>ВВЕДИТЕ КОД</p>
					<input type="text" name="captcha_word" maxlength="50" value="">
				</div>
			<?endif?>
		</li>
	</ul>
	<input type="submit" class="red_button" name="iblock_submit" value="&nbsp;" />
	</form>

<script type="text/javascript">
	$(document).ready(function(){
		$('.add_text_comment select').styler();
		$('.add_comment_star input:radio').styler();
		//$(".phone").mask("+7 (999) 999-99-99");
        maskAktive("",true,'.phone');

		$('.add_comment_star .jq-radio').click(function() {
			$(this).prevAll().addClass('checked');
		});
		$('.add_comment_star .checked').prevAll().addClass('checked');
		$('.add_comment_star .jq-radio').mouseover(function() {
			$(this).addClass('checked_hover').prevAll().addClass('checked_hover');
		});
		$('.add_comment_star .jq-radio').mouseout(function() {
			$('.add_comment_star .jq-radio').removeClass('checked_hover');
		});
	});
</script>