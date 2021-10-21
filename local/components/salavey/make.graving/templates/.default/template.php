<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die()?>
<div class="detail_services_ligh" id="detail_services_grav_light">
	<div class="detail_services_ligh_title">Сделать гравировку</div>
<?
//Обработка различных ситуаций
//$isBasket1 = $arResult['CALL_FROM_CARD']=='N' && count($arResult["GOODS_FOR_GRAVING"])==1; //из корзины и на гравировку 1 товар
//$isBasket2 = $arResult['CALL_FROM_CARD']=='N' && count($arResult["GOODS_FOR_GRAVING"])>=2; //из корзины и на гравировку >1 товара селект
//$isBasket0 = $arResult['CALL_FROM_CARD']=='N' && count($arResult["GOODS_FOR_GRAVING"])==0; //и нет товаров на гравировку отмена
$arCardGood = $arResult['GOODS_FOR_GRAVING'][$arParams['ID']]; //товар из карточки товара
$isCardGravBasket10 = $arCardGood['HAS_ENGRAVING']==1 && $arCardGood['IS_IN_BASKET']==0; //товар нужно сначала купить отмена
$isCardGravBasket00 = $arCardGood['HAS_ENGRAVING']==0 && $arCardGood['IS_IN_BASKET']==0; //товар нельзя гравировать отмена
$isCardGravBasket01 = $arCardGood['HAS_ENGRAVING']==0 && $arCardGood['IS_IN_BASKET']==1; //товар нельзя гравировать отмена
$isCardGravBasket11 = $arCardGood['HAS_ENGRAVING']==1 && $arCardGood['IS_IN_BASKET']==1; //на гравировку 1 товар
?>
<?if($isCardGravBasket11):?>
	<?if($isBasket2):?>

		<?foreach($arResult["GOODS_FOR_GRAVING"] as $arItem):?>
			<?$img=CFile::ResizeImageGet($arItem["PREVIEW_PICTURE"], array('width'=>100, 'height'=>49), BX_RESIZE_IMAGE_PROPORTIONAL, true);?>
			<div id="goods-grav-<?=$arItem['ID']?>" style="display:none;">
				<img alt="<?=$arItem['NAME']?>" border="0" width="<?=$img['width']?>" height="<?=$img['height']?>" src="<?=$img['src']?>" />
			</div>
		<?endforeach?>
		<table border="0" class="basket_table grave_table" style="border: 1px solid #CCC; margin: 0 0 12px 11px;">
			<thead>
				<tr class="basket_table_head">
					<td width="100">&nbsp;</td>
					<td>Наименование</td>
					<td width="100" class="basket_table_head_border">Гравировка</td>
				</tr>
			</thead>
			<tbody class="basket_table_body_grav">
				<tr style="height: 40px;">
					<td width="100" class="good_image">
					</td>
					<td>
						<select name="GRAV_GOOD" id="grav_good">
							<option value="-1">Выберите товар</option>
							<?foreach($arResult["GOODS_FOR_GRAVING"] as $arItem):?>
								<option value="<?=$arItem['ID']?>"><?=$arItem['NAME']?></option>
							<?endforeach?>
						</select>
					</td>
					<td width="100" class="grav_tabl basket_table_head_border"><img src="/images/grav_table.png" /></td>
				</tr>
			</tbody>
		</table>
	<?else:?> <?/*Товар только один*/?>
		<?
			$arTmp = array_keys($arResult["GOODS_FOR_GRAVING"]); //значение ключа является ID товара
			$chosenID = $arTmp[0];
			$arItem = $arResult["GOODS_FOR_GRAVING"][$chosenID];
			$img=CFile::ResizeImageGet($arItem["PREVIEW_PICTURE"], array('width'=>100, 'height'=>49), BX_RESIZE_IMAGE_PROPORTIONAL, true);
		?>
		<div class="detail_services_ligh_table">
			<table>
				<tr>
					<th></th>
					<th>Наименование</th>
					<th>Гравировка</th>
				</tr>
				<tr>
					<?$img=CFile::ResizeImageGet($arItem["PREVIEW_PICTURE"], array('width'=>100, 'height'=>49), BX_RESIZE_IMAGE_PROPORTIONAL, true);?>
					<td><img src="<?=$img['src']?>" alt=""/></td>
					<td class="tovar_name"><?=$arItem['NAME']?></td>
					<td><img src="/img/grav_table.png" alt=""/></td>
				</tr>
			</table>
		</div>
		<input type="hidden" name="CHOSEN_ID" id="grav_good" value="<?=$chosenID?>" />
	<?endif?>

	<div class="graving_form_el_block">
		<div class="graving_form_el">
			<select name="GRAV_SIZE" id="grav_size">
				<option value="-1">Выберите размер гравировки</option>
				<?foreach($arResult["GRAVING_SIZES"] as $id => $size):?>
					<option value="<?=$id?>"><?=$size?> -
						<?=number_format($arResult['GRAVING_SIZES_AND_COLORS'][$id]['PRICE'],0,".","")?> руб.
					</option>
				<?endforeach?>
			</select>
		</div>
		<div class="graving_form_el">
			<select name="GRAV_COLOR" id="grav_color">
				<option value="-1">Выберите цвет гравировки</option>
			</select>
		</div>
		<div class="graving_form_el">
			<input placeholder="Укажите, пожалуйста, текст гравировки" type="text" name="GRAV_TEXT" id="grav_text" value="" />
		</div>
	</div>
	<?foreach($arResult["GRAVING_SIZES_AND_COLORS"] as $sizeID => $colors):?>
		<div id="grav-size-<?=$sizeID?>" style="display:none;">
			<option value="-1">Выберите цвет гравировки</option>
			<?foreach($colors['COLORS'] as $color):?>
				<option value="<?=$color['ID']?>"><?=$color['NAME']?></option>
			<?endforeach?>
		</div>
	<?endforeach?>
<?else:?>
	<div class="graving-error">
	<?
		if($isCardGravBasket10) ShowError("Чтобы заказать гравировку, нужно сначала положить товар в корзину!");
		if($isCardGravBasket01) ShowError("Данный товар нельзя гравировать!");
		if($isCardGravBasket00) ShowError("Данный товар нельзя гравировать!");
	?>
	</div>
<?endif?>
		<div class="detail_services_ligh_button">
			<a class="gray_button" href="">Отмена</a>
			<?if($isCardGravBasket11):?>
				<a class="detail_red_button" href="">Гравировать</a>
			<?endif;?>
		</div>
		<div class="detail_services_ligh_bottom_text">
			<b>Уважаемые клиенты!</b><br/>
			По Вашему желанию мы можем сделать гравировку Вашего товара.<br/>
			Заказ на гравировку можно оставить на странице оформления заказа или при  разговоре с менеджером<br/>
            8 (800) 333-07-42 (Звонок бесплатный)<br/>
			Размер таблички, букв и текст также обговаривается с менеджером.<br/>
			<b>Спасибо за то, что выбрали наш магазин!</b>
		</div>
</div>

<script type="text/javascript">
$(document).ready(function() {
	$('select').styler();

	$(".detail_services_ligh_button .gray_button").click(function(){
		$.fancybox.close();
		return false;
	});

    $("body").on("keyup", '#grav_text',function()
    {
        if($(this).val() == '' || $(this).val() == undefined)
        {
            $(this).addClass("error");    
        }
        else
        {
            $(this).removeClass("error");
        }
    });
    $("body").on("blur", '#grav_text',function()
    {    
        if($(this).val() == '' || $(this).val() == undefined)
        {
            $(this).addClass("error");    
        }
        else
        {
            $(this).removeClass("error");
        }
    });
    
	$("#grav_size").change(function()
    {
        var id = $(this).val();
        var html;
        if(id == -1) 
            html = "<option value=\"-1\">Выберите цвет гравировки</option>";
        else 
            html = $("#grav-size-"+id).html();
        $("#grav_color").html(html).trigger('refresh');
        console.log(parseInt($('#grav_color').val()));
        if(parseInt(id) > 0)
        {
            $(this).parent().removeClass('error');
        }
        else
        {
            $(this).parent().addClass('error');   
        }
        if(parseInt($('#grav_color').val()) > 0)
        {
            $('#grav_color').parent().removeClass('error');
        }
        else
        {
            $('#grav_color').parent().addClass('error');   
        }
    });
    
    $("#grav_color").change(function()
    {
        if(parseInt($(this).val()) > 0)
        {
            $(this).parent().removeClass('error');
        }
        else
        {
            $(this).parent().addClass('error');   
        }
	});

	$(".detail_services_ligh_button .detail_red_button").click(function()
    {
    	var color = parseInt($('#grav_color').val());
    	var size = parseInt($('#grav_size').val());
    	var txt = $('#grav_text').val();
    	var name = $('.detail_services_ligh_table .tovar_name').text();
    	
        if (color <= 0) 
            $('#grav_color').parent().addClass('error');
    	else  
            $('#grav_color').parent().removeClass('error');
    	if (size <= 0) 
            $('#grav_size').parent().addClass('error');
    	else  
            $('#grav_size').parent().removeClass('error');
    	if (txt.length == 0) 
            $('#grav_text').addClass('error');
    	else  
            $('#grav_text').removeClass('error');
    	
        if (color > 0 && size > 0 && txt.length>0)
        {
            $.get('/include/script_add_to_cart.php?id='+color+'&params[Размер]='+size+'&params[Текст]='+txt+'&params[Товар]='+name+'&is_service=Y', function(data) {
                $.fancybox({content: "<div style='color: green; padding-top: 20px'>Гравировка добавлена в корзину!</div>"});
                $(".loadhead").load("/include/script_cart_update.php");
            });
        }
			
		return false;
	});

});
</script>