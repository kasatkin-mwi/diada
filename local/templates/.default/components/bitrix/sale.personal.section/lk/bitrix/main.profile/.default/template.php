<?
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true)
	die();

use Bitrix\Main\Localization\Loc;

?>

<div class="bx_profile">
	<?
	ShowError($arResult["strProfileError"]);

	if ($arResult['DATA_SAVED'] == 'Y')
	{
		ShowNote(Loc::getMessage('PROFILE_DATA_SAVED'));
	}

	?>
	<form method="post" name="form1" action="<?=$APPLICATION->GetCurUri()?>" enctype="multipart/form-data" role="form">
		<?=$arResult["BX_SESSION_CHECK"]?>
		<input type="hidden" name="lang" value="<?=LANG?>" />
		<input type="hidden" name="ID" value="<?=$arResult["ID"]?>" />
		<input type="hidden" name="LOGIN" value="<?=$arResult["arUser"]["LOGIN"]?>" />
		<div class="lk_title">Личные данные</div>
		<div class="main-profile-block-shown" id="user_div_reg">
			<div class="lk_content_width">
				<div class="main-profile-block-date-info">
					<?
					if($arResult["ID"]>0)
					{
						if (strlen($arResult["arUser"]["TIMESTAMP_X"])>0)
						{
							?>
							<ul class="not_style reg_form_el">
								<li style="font-family: latoregular;"><?=Loc::getMessage('LAST_UPDATE')?> <?=$arResult["arUser"]["TIMESTAMP_X"]?></li>
							</ul>
							<?
						}

						if (strlen($arResult["arUser"]["LAST_LOGIN"])>0)
						{
							?>
							<ul class="not_style reg_form_el">
								<li style="font-family: latoregular;"><?=Loc::getMessage('LAST_LOGIN')?> <?=$arResult["arUser"]["LAST_LOGIN"]?></li>
							</ul>
							<?
						}
					}
					?>
				</div>
				<?
				if (!in_array(LANGUAGE_ID,array('ru', 'ua')))
				{
					?>
					<ul class="not_style reg_form_el">
						<li>
							<label class="" for="main-profile-title"><?=Loc::getMessage('main_profile_title')?></label>
						</li>
						<li>
							<input class="form-control" type="text" name="TITLE" maxlength="50" id="main-profile-title" value="<?=$arResult["arUser"]["TITLE"]?>" />
						</li>
					</ul>
					<?
				}
				?>
				<ul class="not_style reg_form_el">
					<li>
						<label for="main-profile-name"><?=Loc::getMessage('NAME')?></label>
					</li>
					<li>
						<input class="form-control" type="text" name="NAME" maxlength="50" id="main-profile-name" value="<?=$arResult["arUser"]["NAME"]?>" />
					</li>
				</ul>
				<ul class="not_style reg_form_el">
					<li>
						<label for="main-profile-last-name"><?=Loc::getMessage('LAST_NAME')?></label>
					</li>
					<li>
						<input class="form-control" type="text" name="LAST_NAME" maxlength="50" id="main-profile-last-name" value="<?=$arResult["arUser"]["LAST_NAME"]?>" />
					</li>
				</ul>
				<ul class="not_style reg_form_el">
					<li>
						<label for="main-profile-second-name"><?=Loc::getMessage('SECOND_NAME')?></label>
					</li>
					<li>
						<input class="form-control" type="text" name="SECOND_NAME" maxlength="50" id="main-profile-second-name" value="<?=$arResult["arUser"]["SECOND_NAME"]?>" />
					</li>
				</ul>
				<ul class="not_style reg_form_el">
					<li>
						<label for="main-profile-email"><?=Loc::getMessage('EMAIL')?></label>
					</li>
					<li class="col-sm-12">
						<input class="form-control" type="text" name="EMAIL" maxlength="50" id="main-profile-email" value="<?=$arResult["arUser"]["EMAIL"]?>" />
					</li>
				</ul>
                <ul class="not_style reg_form_el">
                    <li>
                        <label for="main-profile-email"><?=Loc::getMessage('PERSONAL_PHONE')?></label>
                    </li>
                    <li class="col-sm-12">
                        <input class="form-control" type="text" name="PERSONAL_PHONE" maxlength="50" id="main-profile-email" value="<?=$arResult["arUser"]["PERSONAL_PHONE"]?>" />
                    </li>
                </ul>
				<?
				if($arResult["arUser"]["EXTERNAL_AUTH_ID"] == '')
				{
					?>
					<?/*<ul class="not_style reg_form_el">
						<li>
							<?echo $arResult["GROUP_POLICY"]["PASSWORD_REQUIREMENTS"];?>
						</li>
					</ul>*/?>
					<ul class="not_style reg_form_el">
						<li>
							<label for="main-profile-password"><?=Loc::getMessage('NEW_PASSWORD_REQ')?></label>
						</li>
						<li>
							<input size="30" class=" form-control bx-auth-input main-profile-password password" type="password" name="NEW_PASSWORD"  id="main-profile-password" maxlength="50" value="" autocomplete="off"/>
						</li>
					</ul>
					<ul class="not_style reg_form_el">
						<li>
							<label for="main-profile-password-confirm">
								<?=Loc::getMessage('NEW_PASSWORD_CONFIRM')?>
							</label>
						</li>
						<li>
							<input class="form-control" type="password" name="NEW_PASSWORD_CONFIRM" maxlength="50" value="" id="main-profile-password-confirm" autocomplete="off" />
						</li>
					</ul>
					<?
				}
				?>
				<div class="reg_form_test_password_block">
					<ul class="not_style reg_form_test_password_name_status">
						<li>Надежность</li>
						<li>Безопасный</li>
					</ul>
					<ul class="reg_form_test_password_color_status">
						<li></li>
						<li></li>
						<li></li>
						<li></li>
					</ul>
					<div class="reg_form_test_password_trebovanie">
						<p>Требования к паролю:</p>
						<ul class="not_style">
							<li>не менее 8 знаков, включая символы</li>
							<li>минимум 1 цифра, 1 прописная и 1 строчная латинские</li>
						</ul>
					</div>
				</div>
		<p class="main-profile-form-buttons-block col-sm-9 col-md-offset-3" align="center">
			<input type="submit" name="save" class="big_red_button btn btn-themes btn-default btn-md main-profile-submit" value="<?=(($arResult["ID"]>0) ? Loc::getMessage("MAIN_SAVE") : Loc::getMessage("MAIN_ADD"))?>">
			&nbsp;
			<input type="submit" class="big_gray_button btn btn-themes btn-default btn-md"  name="reset" value="<?echo GetMessage("MAIN_RESET")?>">
		</p>
			</div>
		</div>
	</form>

	<div class="lk_title">Связанные соцсети</div>
		<div class="main-profile-block-shown_other" id="user_div_reg">
			<div class="col-sm-12 main-profile-social-block">
				<?
					if ($arResult["SOCSERV_ENABLED"])
					{
						$APPLICATION->IncludeComponent(
							"bitrix:socserv.auth.split",
							"",
							array(
								"SHOW_PROFILES" => "Y",
								"ALLOW_DELETE" => "Y",
								"COMPONENT_TEMPLATE" => "twitpost",
								"COMPOSITE_FRAME_MODE" => "A",
								"COMPOSITE_FRAME_TYPE" => "AUTO"
							),
							false
						);
					}
				?>
			</div>
		</div>
	<div class="clearfix"></div>
</div>