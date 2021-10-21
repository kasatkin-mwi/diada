<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<div class="lk_gray_bg">
	<div class="lk_double_col">
		<div class="lk_title">Отмена заказа</div>
		<a class="lk_callback_bt" href="<?=$arResult["URL_TO_LIST"]?>"><?=GetMessage("SALE_RECORDS_LIST")?></a>
	</div>

	<div class="lk_white_bg">
		<div class="bx_my_order_cancel">
			<?if(strlen($arResult["ERROR_MESSAGE"])<=0):?>
				<form method="post" action="<?=POST_FORM_ACTION_URI?>">

					<ul class="not_style reg_form_el" style="font-family:latoregular;">
						<li><input type="hidden" name="CANCEL" value="Y"></li>
						<li><?=bitrix_sessid_post()?>
							<input type="hidden" name="ID" value="<?=$arResult["ID"]?>">

							<?=GetMessage("SALE_CANCEL_ORDER1") ?>

							<a href="<?=$arResult["URL_TO_DETAIL"]?>"><?=GetMessage("SALE_CANCEL_ORDER2")?> #<?=$arResult["ACCOUNT_NUMBER"]?></a>?
							<b><?= GetMessage("SALE_CANCEL_ORDER3") ?></b>
						</li>
					</ul>
					<ul class="not_style reg_form_el">
						<li><?= GetMessage("SALE_CANCEL_ORDER4") ?>:</li>
						<li><textarea name="REASON_CANCELED"></textarea></li>
					</ul>
					<div class="bt_red_bl"><input class="big_red_button" type="submit" name="action" value="<?=GetMessage("SALE_CANCEL_ORDER_BTN") ?>"></div>

				</form>
			<?else:?>
				<?=ShowError($arResult["ERROR_MESSAGE"]);?>
			<?endif;?>

		</div>
	</div>
</div>