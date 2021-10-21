<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>

<div class="subscribe-edit lk_gray_bg">
<div class="lk_title">Подписки</div>
<div class="lk_white_bg">
<div class="show_confirmation_el">
<ul class="not_style reg_form_el form-group">
	<li></li>
	<li>
<?

foreach($arResult["MESSAGE"] as $itemID=>$itemValue)
	echo ShowMessage(array("MESSAGE"=>$itemValue, "TYPE"=>"OK"));
foreach($arResult["ERROR"] as $itemID=>$itemValue)
	echo ShowMessage(array("MESSAGE"=>$itemValue, "TYPE"=>"ERROR"));
?>
</li>
</ul>
<?//whether to show the forms
if($arResult["ID"] == 0 && empty($_REQUEST["action"]) || CSubscription::IsAuthorized($arResult["ID"]))
{
	//show confirmation form
	if($arResult["ID"]>0 && $arResult["SUBSCRIPTION"]["CONFIRMED"] <> "Y")
	{
		include("confirmation.php");
	}
	//show current authorization section
	if($USER->IsAuthorized() && ($arResult["ID"] == 0 || $arResult["SUBSCRIPTION"]["USER_ID"] == 0))
	{
		include("authorization.php");
	}
	//show authorization section for new subscription
	if($arResult["ID"]==0 && !$USER->IsAuthorized())
	{
		if($arResult["ALLOW_ANONYMOUS"]=="N" || ($arResult["ALLOW_ANONYMOUS"]=="Y" && $arResult["SHOW_AUTH_LINKS"]=="Y"))
		{
			include("authorization_new.php");
		}
	}
	//setting section
	include("setting.php");
	//status and unsubscription/activation section
	if($arResult["ID"]>0)
	{
		include("status.php");
	}
	?>

<div class="show_confirmation_el">
	<div class="small_text"><span class="starrequired">*</span><?echo GetMessage("subscr_req")?></div>
</div>
	<?
}
else
{
	//subscription authorization form
	include("authorization_full.php");
}
?>
</div>
</div>
</div>

<script>
$(document).ready(function() {
	$('input[name=reset]').click(function() {
		elem = $(this);
		setTimeout(function() {
			form = elem.parents('form:first');
			form.find(':radio').trigger('refresh');
			form.find(':checkbox').trigger('refresh');
		}, 100);
	});

	$('input:checkbox, input:radio').styler();
});
</script>