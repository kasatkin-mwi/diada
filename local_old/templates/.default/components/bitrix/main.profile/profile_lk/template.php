<div class="lk_gray_bg">
	<div class="lk_title">Контакты</div>
<?
/**
 * @global CMain $APPLICATION
 * @param array $arParams
 * @param array $arResult
 */
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true)
	die();
?>

<div class="bx-auth-profile">

<?ShowError($arResult["strProfileError"]);?>
<?
if ($arResult['DATA_SAVED'] == 'Y')
	ShowNote(GetMessage('PROFILE_DATA_SAVED'));
?>
<script type="text/javascript">
<!--
var opened_sections = [<?
$arResult["opened"] = $_COOKIE[$arResult["COOKIE_PREFIX"]."_user_profile_open"];
$arResult["opened"] = preg_replace("/[^a-z0-9_,]/i", "", $arResult["opened"]);
if (strlen($arResult["opened"]) > 0)
{
	echo "'".implode("', '", explode(",", $arResult["opened"]))."'";
}
else
{
	$arResult["opened"] = "reg";
	echo "'reg'";
}
?>];
//-->

/* $(".profile-link a").click(function() {
console.log("1");
	$(this).parent().toggleClass('open').next().slideToggle(1);
	return false;
}); */
/* $(".profile-block-el:not(:first)").hide(); */

var cookie_prefix = "<?=$arResult['COOKIE_PREFIX']?>";
</script>
<script>
	$(document).ready(function(){
		$(".profile-block-el:not(:first)").hide();
		$(".profile-link a").click(function() {
			$(this).parent().toggleClass('open').next().slideToggle(1);
			return false;
		});
		
	});
</script>
<form method="post" name="form1" action="<?=$arResult["FORM_TARGET"]?>" enctype="multipart/form-data">
<?=$arResult["BX_SESSION_CHECK"]?>
<input type="hidden" name="lang" value="<?=LANG?>" />
<input type="hidden" name="ID" value=<?=$arResult["ID"]?> />

<div class="profile-link profile-user-div-link open"><a title="<?=GetMessage("REG_SHOW_HIDE")?>" href="#"><?=GetMessage("REG_SHOW_HIDE")?></a></div>
<div class="profile-block-el profile-block-<?/*=strpos($arResult["opened"], "reg") === false ? "hidden" : "shown"*/?>" id="user_div_reg">
<div class="profile-table data-table">
	<?
	if($arResult["ID"]>0)
	{
	?>
		<?
		if (strlen($arResult["arUser"]["TIMESTAMP_X"])>0)
		{
		?>
		<ul class="not_style reg_form_el">
			<li style="font-family:latoregular;"><?=GetMessage('LAST_UPDATE')?> <?=$arResult["arUser"]["TIMESTAMP_X"]?></li>
		</ul>
		<?
		}
		?>
		<?
		if (strlen($arResult["arUser"]["LAST_LOGIN"])>0)
		{
		?>
		<ul class="not_style reg_form_el">
			<li style="font-family:latoregular;"><?=GetMessage('LAST_LOGIN')?> <?=$arResult["arUser"]["LAST_LOGIN"]?></li>
		</ul>
		<?
		}
		?>
	<?
	}
	?>
	<ul class="not_style reg_form_el">
		<li><?echo GetMessage("main_profile_title")?></li>
		<li><input type="text" name="TITLE" value="<?=$arResult["arUser"]["TITLE"]?>" /></li>
	</ul>
	<ul class="not_style reg_form_el">
		<li><?=GetMessage('NAME')?></li>
		<li><input type="text" name="NAME" maxlength="50" value="<?=$arResult["arUser"]["NAME"]?>" /></li>
	</ul>
	<ul class="not_style reg_form_el">
		<li><?=GetMessage('LAST_NAME')?></li>
		<li><input type="text" name="LAST_NAME" maxlength="50" value="<?=$arResult["arUser"]["LAST_NAME"]?>" /></li>
	</ul>
	<ul class="not_style reg_form_el">
		<li><?=GetMessage('SECOND_NAME')?></li>
		<li><input type="text" name="SECOND_NAME" maxlength="50" value="<?=$arResult["arUser"]["SECOND_NAME"]?>" /></li>
	</ul>
	<ul class="not_style reg_form_el">
		<li><?=GetMessage('EMAIL')?><?if($arResult["EMAIL_REQUIRED"]):?><span class="starrequired">*</span><?endif?></li>
		<li><input type="text" name="EMAIL" maxlength="50" value="<? echo $arResult["arUser"]["EMAIL"]?>" /></li>
	</ul>
	<ul class="not_style reg_form_el">
		<li><?=GetMessage('LOGIN')?><span class="starrequired">*</span></li>
		<li><input type="text" name="LOGIN" maxlength="50" value="<? echo $arResult["arUser"]["LOGIN"]?>" /></li>
	</ul>
<?if($arResult["arUser"]["EXTERNAL_AUTH_ID"] == ''):?>
	<ul class="not_style reg_form_el">
		<li><?=GetMessage('NEW_PASSWORD_REQ')?></li>
		<li><input type="password" name="NEW_PASSWORD" maxlength="50" value="" autocomplete="off" class="bx-auth-input password" />
<?if($arResult["SECURE_AUTH"]):?>
				<span class="bx-auth-secure" id="bx_auth_secure" title="<?echo GetMessage("AUTH_SECURE_NOTE")?>" style="display:none">
					<div class="bx-auth-secure-icon"></div>
				</span>
				<noscript>
				<span class="bx-auth-secure" title="<?echo GetMessage("AUTH_NONSECURE_NOTE")?>">
					<div class="bx-auth-secure-icon bx-auth-secure-unlock"></div>
				</span>
				</noscript>
<script type="text/javascript">
document.getElementById('bx_auth_secure').style.display = 'inline-block';
</script>
		<?/*</li>
	</ul>*/?>
<?endif?>
		</li>
	</ul>
	<ul class="not_style reg_form_el">
		<li><?=GetMessage('NEW_PASSWORD_CONFIRM')?></li>
		<li><input type="password" name="NEW_PASSWORD_CONFIRM" maxlength="50" value="" autocomplete="off" /></li>
	</ul>

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
<?endif?>
<?if($arResult["TIME_ZONE_ENABLED"] == true):?>
	<ul class="not_style reg_form_el">
		<li class="profile-header"><?echo GetMessage("main_profile_time_zones")?></li>
	</ul>
	<ul class="not_style reg_form_el">
		<li><?echo GetMessage("main_profile_time_zones_auto")?></li>
		<li>
			<select name="AUTO_TIME_ZONE" onchange="this.form.TIME_ZONE.disabled=(this.value != 'N')">
				<option value=""><?echo GetMessage("main_profile_time_zones_auto_def")?></option>
				<option value="Y"<?=($arResult["arUser"]["AUTO_TIME_ZONE"] == "Y"? ' SELECTED="SELECTED"' : '')?>><?echo GetMessage("main_profile_time_zones_auto_yes")?></option>
				<option value="N"<?=($arResult["arUser"]["AUTO_TIME_ZONE"] == "N"? ' SELECTED="SELECTED"' : '')?>><?echo GetMessage("main_profile_time_zones_auto_no")?></option>
			</select>
		</li>
	</ul>
	<ul class="not_style reg_form_el">
		<li><?echo GetMessage("main_profile_time_zones_zones")?></li>
		<li>
			<select name="TIME_ZONE"<?if($arResult["arUser"]["AUTO_TIME_ZONE"] <> "N") echo ' disabled="disabled"'?>>
<?foreach($arResult["TIME_ZONE_LIST"] as $tz=>$tz_name):?>
				<option value="<?=htmlspecialcharsbx($tz)?>"<?=($arResult["arUser"]["TIME_ZONE"] == $tz? ' SELECTED="SELECTED"' : '')?>><?=htmlspecialcharsbx($tz_name)?></option>
<?endforeach?>
			</select>
		</li>
	</ul>
<?endif?>
</div>
</div>
<div class="profile-link profile-user-div-link"><a title="<?=GetMessage("USER_SHOW_HIDE")?>" href="javascript:void(0)" onclick="SectionClick('personal')"><?=GetMessage("USER_PERSONAL_INFO")?></a></div>
<div id="user_div_personal" class="profile-block-el profile-block-<?=strpos($arResult["opened"], "personal") === false ? "hidden" : "shown"?>">
<div class="data-table profile-table">

		<ul class="not_style reg_form_el">
			<li><?=GetMessage('USER_PROFESSION')?></li>
			<li><input type="text" name="PERSONAL_PROFESSION" maxlength="255" value="<?=$arResult["arUser"]["PERSONAL_PROFESSION"]?>" /></li>
		</ul>
		<ul class="not_style reg_form_el">
			<li><?=GetMessage('USER_WWW')?></li>
			<li><input type="text" name="PERSONAL_WWW" maxlength="255" value="<?=$arResult["arUser"]["PERSONAL_WWW"]?>" /></li>
		</ul>
		<ul class="not_style reg_form_el">
			<li><?=GetMessage('USER_ICQ')?></li>
			<li><input type="text" name="PERSONAL_ICQ" maxlength="255" value="<?=$arResult["arUser"]["PERSONAL_ICQ"]?>" /></li>
		</ul>
		<ul class="not_style reg_form_el">
			<li><?=GetMessage('USER_GENDER')?></li>
			<li><select name="PERSONAL_GENDER">
				<option value=""><?=GetMessage("USER_DONT_KNOW")?></option>
				<option value="M"<?=$arResult["arUser"]["PERSONAL_GENDER"] == "M" ? " SELECTED=\"SELECTED\"" : ""?>><?=GetMessage("USER_MALE")?></option>
				<option value="F"<?=$arResult["arUser"]["PERSONAL_GENDER"] == "F" ? " SELECTED=\"SELECTED\"" : ""?>><?=GetMessage("USER_FEMALE")?></option>
			</select></li>
		</ul>
		<ul class="not_style reg_form_el">
			<li><?=GetMessage("USER_BIRTHDAY_DT")?> (<?=$arResult["DATE_FORMAT"]?>):</li>
			<li><?
			$APPLICATION->IncludeComponent(
				'bitrix:main.calendar',
				'',
				array(
					'SHOW_INPUT' => 'Y',
					'FORM_NAME' => 'form1',
					'INPUT_NAME' => 'PERSONAL_BIRTHDAY',
					'INPUT_VALUE' => $arResult["arUser"]["PERSONAL_BIRTHDAY"],
					'SHOW_TIME' => 'N'
				),
				null,
				array('HIDE_ICONS' => 'Y')
			);

			//=CalendarDate("PERSONAL_BIRTHDAY", $arResult["arUser"]["PERSONAL_BIRTHDAY"], "form1", "15")
			?></li>
		</ul>
		<ul class="not_style reg_form_el">
			<li><?=GetMessage("USER_PHOTO")?></li>
			<li>
			<?=$arResult["arUser"]["PERSONAL_PHOTO_INPUT"]?>
			<?
			if (strlen($arResult["arUser"]["PERSONAL_PHOTO"])>0)
			{
			?>
			<br />
				<?=$arResult["arUser"]["PERSONAL_PHOTO_HTML"]?>
			<?
			}
			?></li>
		<ul class="not_style reg_form_el">
			<td colspan="2" class="profile-header"><?=GetMessage("USER_PHONES")?></li>
		</ul>
		<ul class="not_style reg_form_el">
			<li><?=GetMessage('USER_PHONE')?></li>
			<li><input type="text" name="PERSONAL_PHONE" maxlength="255" value="<?=$arResult["arUser"]["PERSONAL_PHONE"]?>" /></li>
		</ul>
		<ul class="not_style reg_form_el">
			<li><?=GetMessage('USER_FAX')?></li>
			<li><input type="text" name="PERSONAL_FAX" maxlength="255" value="<?=$arResult["arUser"]["PERSONAL_FAX"]?>" /></li>
		</ul>
		<ul class="not_style reg_form_el">
			<li><?=GetMessage('USER_MOBILE')?></li>
			<li><input type="text" name="PERSONAL_MOBILE" maxlength="255" value="<?=$arResult["arUser"]["PERSONAL_MOBILE"]?>" /></li>
		</ul>
		<ul class="not_style reg_form_el">
			<li><?=GetMessage('USER_PAGER')?></li>
			<li><input type="text" name="PERSONAL_PAGER" maxlength="255" value="<?=$arResult["arUser"]["PERSONAL_PAGER"]?>" /></li>
		</ul>
		<ul class="not_style reg_form_el">
			<td colspan="2" class="profile-header"><?=GetMessage("USER_POST_ADDRESS")?></li>
		</ul>
		<ul class="not_style reg_form_el">
			<li><?=GetMessage('USER_COUNTRY')?></li>
			<li><?=$arResult["COUNTRY_SELECT"]?></li>
		</ul>
		<ul class="not_style reg_form_el">
			<li><?=GetMessage('USER_STATE')?></li>
			<li><input type="text" name="PERSONAL_STATE" maxlength="255" value="<?=$arResult["arUser"]["PERSONAL_STATE"]?>" /></li>
		</ul>
		<ul class="not_style reg_form_el">
			<li><?=GetMessage('USER_CITY')?></li>
			<li><input type="text" name="PERSONAL_CITY" maxlength="255" value="<?=$arResult["arUser"]["PERSONAL_CITY"]?>" /></li>
		</ul>
		<ul class="not_style reg_form_el">
			<li><?=GetMessage('USER_ZIP')?></li>
			<li><input type="text" name="PERSONAL_ZIP" maxlength="255" value="<?=$arResult["arUser"]["PERSONAL_ZIP"]?>" /></li>
		</ul>
		<ul class="not_style reg_form_el">
			<li><?=GetMessage("USER_STREET")?></li>
			<li><textarea cols="30" rows="5" name="PERSONAL_STREET"><?=$arResult["arUser"]["PERSONAL_STREET"]?></textarea></li>
		</ul>
		<ul class="not_style reg_form_el">
			<li><?=GetMessage('USER_MAILBOX')?></li>
			<li><input type="text" name="PERSONAL_MAILBOX" maxlength="255" value="<?=$arResult["arUser"]["PERSONAL_MAILBOX"]?>" /></li>
		</ul>
		<ul class="not_style reg_form_el">
			<li><?=GetMessage("USER_NOTES")?></li>
			<li><textarea cols="30" rows="5" name="PERSONAL_NOTES"><?=$arResult["arUser"]["PERSONAL_NOTES"]?></textarea></li>
		</ul>
</div>
</div>

<div class="profile-link profile-user-div-link"><a title="<?=GetMessage("USER_SHOW_HIDE")?>" href="javascript:void(0)" onclick="SectionClick('work')"><?=GetMessage("USER_WORK_INFO")?></a></div>
<div id="user_div_work" class="profile-block-el profile-block-<?=strpos($arResult["opened"], "work") === false ? "hidden" : "shown"?>">
<div class="data-table profile-table">
		<ul class="not_style reg_form_el">
			<li><?=GetMessage('USER_COMPANY')?></li>
			<li><input type="text" name="WORK_COMPANY" maxlength="255" value="<?=$arResult["arUser"]["WORK_COMPANY"]?>" /></li>
		</ul>
		<ul class="not_style reg_form_el">
			<li><?=GetMessage('USER_WWW')?></li>
			<li><input type="text" name="WORK_WWW" maxlength="255" value="<?=$arResult["arUser"]["WORK_WWW"]?>" /></li>
		</ul>
		<ul class="not_style reg_form_el">
			<li><?=GetMessage('USER_DEPARTMENT')?></li>
			<li><input type="text" name="WORK_DEPARTMENT" maxlength="255" value="<?=$arResult["arUser"]["WORK_DEPARTMENT"]?>" /></li>
		</ul>
		<ul class="not_style reg_form_el">
			<li><?=GetMessage('USER_POSITION')?></li>
			<li><input type="text" name="WORK_POSITION" maxlength="255" value="<?=$arResult["arUser"]["WORK_POSITION"]?>" /></li>
		</ul>
		<ul class="not_style reg_form_el">
			<li><?=GetMessage("USER_WORK_PROFILE")?></li>
			<li><textarea cols="30" rows="5" name="WORK_PROFILE"><?=$arResult["arUser"]["WORK_PROFILE"]?></textarea></li>
		</ul>
		<ul class="not_style reg_form_el">
			<li><?=GetMessage("USER_LOGO")?></li>
			<li>
			<?=$arResult["arUser"]["WORK_LOGO_INPUT"]?>
			<?
			if (strlen($arResult["arUser"]["WORK_LOGO"])>0)
			{
			?>
				<br /><?=$arResult["arUser"]["WORK_LOGO_HTML"]?>
			<?
			}
			?></li>
		</ul>
		<ul class="not_style reg_form_el">
			<td colspan="2" class="profile-header"><?=GetMessage("USER_PHONES")?></li>
		</ul>
		<ul class="not_style reg_form_el">
			<li><?=GetMessage('USER_PHONE')?></li>
			<li><input type="text" name="WORK_PHONE" maxlength="255" value="<?=$arResult["arUser"]["WORK_PHONE"]?>" /></li>
		</ul>
		<ul class="not_style reg_form_el">
			<li><?=GetMessage('USER_FAX')?></li>
			<li><input type="text" name="WORK_FAX" maxlength="255" value="<?=$arResult["arUser"]["WORK_FAX"]?>" /></li>
		</ul>
		<ul class="not_style reg_form_el">
			<li><?=GetMessage('USER_PAGER')?></li>
			<li><input type="text" name="WORK_PAGER" maxlength="255" value="<?=$arResult["arUser"]["WORK_PAGER"]?>" /></li>
		</ul>
		<ul class="not_style reg_form_el">
			<td colspan="2" class="profile-header"><?=GetMessage("USER_POST_ADDRESS")?></li>
		</ul>
		<ul class="not_style reg_form_el">
			<li><?=GetMessage('USER_COUNTRY')?></li>
			<li><?=$arResult["COUNTRY_SELECT_WORK"]?></li>
		</ul>
		<ul class="not_style reg_form_el">
			<li><?=GetMessage('USER_STATE')?></li>
			<li><input type="text" name="WORK_STATE" maxlength="255" value="<?=$arResult["arUser"]["WORK_STATE"]?>" /></li>
		</ul>
		<ul class="not_style reg_form_el">
			<li><?=GetMessage('USER_CITY')?></li>
			<li><input type="text" name="WORK_CITY" maxlength="255" value="<?=$arResult["arUser"]["WORK_CITY"]?>" /></li>
		</ul>
		<ul class="not_style reg_form_el">
			<li><?=GetMessage('USER_ZIP')?></li>
			<li><input type="text" name="WORK_ZIP" maxlength="255" value="<?=$arResult["arUser"]["WORK_ZIP"]?>" /></li>
		</ul>
		<ul class="not_style reg_form_el">
			<li><?=GetMessage("USER_STREET")?></li>
			<li><textarea cols="30" rows="5" name="WORK_STREET"><?=$arResult["arUser"]["WORK_STREET"]?></textarea></li>
		</ul>
		<ul class="not_style reg_form_el">
			<li><?=GetMessage('USER_MAILBOX')?></li>
			<li><input type="text" name="WORK_MAILBOX" maxlength="255" value="<?=$arResult["arUser"]["WORK_MAILBOX"]?>" /></li>
		</ul>
		<ul class="not_style reg_form_el">
			<li><?=GetMessage("USER_NOTES")?></li>
			<li><textarea cols="30" rows="5" name="WORK_NOTES"><?=$arResult["arUser"]["WORK_NOTES"]?></textarea></li>
		</ul>
</div>
</div>
	<?
	if ($arResult["INCLUDE_FORUM"] == "Y")
	{
	?>

<div class="profile-link profile-user-div-link"><a title="<?=GetMessage("USER_SHOW_HIDE")?>" href="javascript:void(0)" onclick="SectionClick('forum')"><?=GetMessage("forum_INFO")?></a></div>
<div id="user_div_forum" class="profile-block-el profile-block-<?=strpos($arResult["opened"], "forum") === false ? "hidden" : "shown"?>">
<div class="data-table profile-table">
		<ul class="not_style reg_form_el">
			<li><?=GetMessage("forum_SHOW_NAME")?></li>
			<li><input type="checkbox" name="forum_SHOW_NAME" value="Y" <?if ($arResult["arForumUser"]["SHOW_NAME"]=="Y") echo "checked=\"checked\"";?> /></li>
		</ul>
		<ul class="not_style reg_form_el">
			<li><?=GetMessage('forum_DESCRIPTION')?></li>
			<li><input type="text" name="forum_DESCRIPTION" maxlength="255" value="<?=$arResult["arForumUser"]["DESCRIPTION"]?>" /></li>
		</ul>
		<ul class="not_style reg_form_el">
			<li><?=GetMessage('forum_INTERESTS')?></li>
			<li><textarea cols="30" rows="5" name="forum_INTERESTS"><?=$arResult["arForumUser"]["INTERESTS"]; ?></textarea></li>
		</ul>
		<ul class="not_style reg_form_el">
			<li><?=GetMessage("forum_SIGNATURE")?></li>
			<li><textarea cols="30" rows="5" name="forum_SIGNATURE"><?=$arResult["arForumUser"]["SIGNATURE"]; ?></textarea></li>
		</ul>
		<ul class="not_style reg_form_el">
			<li><?=GetMessage("forum_AVATAR")?></li>
			<li><?=$arResult["arForumUser"]["AVATAR_INPUT"]?>
			<?
			if (strlen($arResult["arForumUser"]["AVATAR"])>0)
			{
			?>
				<br /><?=$arResult["arForumUser"]["AVATAR_HTML"]?>
			<?
			}
			?></li>
		</ul>
</div>
</div>

	<?
	}
	?>
	<?
	if ($arResult["INCLUDE_BLOG"] == "Y")
	{
	?>
<div class="profile-link profile-user-div-link"><a title="<?=GetMessage("USER_SHOW_HIDE")?>" href="javascript:void(0)" onclick="SectionClick('blog')"><?=GetMessage("blog_INFO")?></a></div>
<div id="user_div_blog" class="profile-block-el profile-block-<?=strpos($arResult["opened"], "blog") === false ? "hidden" : "shown"?>">
<div class="data-table profile-table">
		<ul class="not_style reg_form_el">
			<li><?=GetMessage('blog_ALIAS')?></li>
			<li><input class="typeinput" type="text" name="blog_ALIAS" maxlength="255" value="<?=$arResult["arBlogUser"]["ALIAS"]?>" /></li>
		</ul>
		<ul class="not_style reg_form_el">
			<li><?=GetMessage('blog_DESCRIPTION')?></li>
			<li><input class="typeinput" type="text" name="blog_DESCRIPTION" maxlength="255" value="<?=$arResult["arBlogUser"]["DESCRIPTION"]?>" /></li>
		</ul>
		<ul class="not_style reg_form_el">
			<li><?=GetMessage('blog_INTERESTS')?></li>
			<li><textarea cols="30" rows="5" class="typearea" name="blog_INTERESTS"><?echo $arResult["arBlogUser"]["INTERESTS"]; ?></textarea></li>
		</ul>
		<ul class="not_style reg_form_el">
			<li><?=GetMessage("blog_AVATAR")?></li>
			<li><?=$arResult["arBlogUser"]["AVATAR_INPUT"]?>
			<?
			if (strlen($arResult["arBlogUser"]["AVATAR"])>0)
			{
			?>
				<br /><?=$arResult["arBlogUser"]["AVATAR_HTML"]?>
			<?
			}
			?></li>
		</ul>
</div>
</div>
	<?
	}
	?>
	<?if ($arResult["INCLUDE_LEARNING"] == "Y"):?>
	<div class="profile-link profile-user-div-link"><a title="<?=GetMessage("USER_SHOW_HIDE")?>" href="javascript:void(0)" onclick="SectionClick('learning')"><?=GetMessage("learning_INFO")?></a></div>
	<div id="user_div_learning" class="profile-block-el profile-block-<?=strpos($arResult["opened"], "learning") === false ? "hidden" : "shown"?>">
	<div class="data-table profile-table">
			<ul class="not_style reg_form_el">
				<li><?=GetMessage("learning_PUBLIC_PROFILE");?>:</li>
				<li><input type="checkbox" name="student_PUBLIC_PROFILE" value="Y" <?if ($arResult["arStudent"]["PUBLIC_PROFILE"]=="Y") echo "checked=\"checked\"";?> /></li>
			</ul>
			<ul class="not_style reg_form_el">
				<li><?=GetMessage("learning_RESUME");?>:</li>
				<li><textarea cols="30" rows="5" name="student_RESUME"><?=$arResult["arStudent"]["RESUME"]; ?></textarea></li>
			</ul>

			<ul class="not_style reg_form_el">
				<li><?=GetMessage("learning_TRANSCRIPT");?>:</li>
				<li><?=$arResult["arStudent"]["TRANSCRIPT"];?>-<?=$arResult["ID"]?></li>
			</ul>
	</div>
	</div>
	<?endif;?>
	<?if($arResult["IS_ADMIN"]):?>
	<div class="profile-link profile-user-div-link"><a title="<?=GetMessage("USER_SHOW_HIDE")?>" href="javascript:void(0)" onclick="SectionClick('admin')"><?=GetMessage("USER_ADMIN_NOTES")?></a></div>
	<div id="user_div_admin" class="profile-block-el profile-block-<?=strpos($arResult["opened"], "admin") === false ? "hidden" : "shown"?>">
	<div class="data-table profile-table">
			<ul class="not_style reg_form_el">
				<li><?=GetMessage("USER_ADMIN_NOTES")?>:</li>
				<li><textarea cols="30" rows="5" name="ADMIN_NOTES"><?=$arResult["arUser"]["ADMIN_NOTES"]?></textarea></li>
			</ul>
	</div>
	</div>
	<?endif;?>
	<?// ********************* User properties ***************************************************?>
	<?if($arResult["USER_PROPERTIES"]["SHOW"] == "Y"):?>
	<div class="profile-link profile-user-div-link"><a title="<?=GetMessage("USER_SHOW_HIDE")?>" href="javascript:void(0)" onclick="SectionClick('user_properties')"><?=strlen(trim($arParams["USER_PROPERTY_NAME"])) > 0 ? $arParams["USER_PROPERTY_NAME"] : GetMessage("USER_TYPE_EDIT_TAB")?></a></div>
	<div id="user_div_user_properties" class="profile-block-el profile-block-<?=strpos($arResult["opened"], "user_properties") === false ? "hidden" : "shown"?>">
	<div class="data-table profile-table">
		<?$first = true;?>
		<?foreach ($arResult["USER_PROPERTIES"]["DATA"] as $FIELD_NAME => $arUserField):?>
		<ul class="not_style reg_form_el"><td class="field-name">
			<?if ($arUserField["MANDATORY"]=="Y"):?>
				<span class="starrequired">*</span>
			<?endif;?>
			<?=$arUserField["EDIT_FORM_LABEL"]?>:</li><td class="field-value">
				<?$APPLICATION->IncludeComponent(
					"bitrix:system.field.edit",
					$arUserField["USER_TYPE"]["USER_TYPE_ID"],
					array("bVarsFromForm" => $arResult["bVarsFromForm"], "arUserField" => $arUserField), null, array("HIDE_ICONS"=>"Y"));?></li></ul>
		<?endforeach;?>
	</div>
	</div>
	<?endif;?>
	<?// ******************** /User properties ***************************************************?>
	<?/*<p><?echo $arResult["GROUP_POLICY"]["PASSWORD_REQUIREMENTS"];?></p><br/>*/?>
	<p align="center"><input class="big_red_button" type="submit" name="save" value="<?=(($arResult["ID"]>0) ? GetMessage("MAIN_SAVE") : GetMessage("MAIN_ADD"))?>">&nbsp;&nbsp;<input class="big_gray_button" type="reset" value="<?=GetMessage('MAIN_RESET');?>"></p><br/><br/>
</form>
<div class="lk_title">СВЯЗАННЫЕ СОЦСЕТИ</div>
<div class="lk_white_bg">
<?
if($arResult["SOCSERV_ENABLED"])
{
	$APPLICATION->IncludeComponent("bitrix:socserv.auth.split", ".default", array(
			"SHOW_PROFILES" => "Y",
			"ALLOW_DELETE" => "Y"
		),
		false
	);
}
?></div>
</div>
</div>