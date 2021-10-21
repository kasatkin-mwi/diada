<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die()?>

<div class="detail_services_ligh" id="detail_services_present_light">
	<div class="detail_services_ligh_title">Упаковать в подарок?</div>
	<div class="detail_services_ligh_table">
		<table>
			<tr>
				<th></th>
				<th>Наименование</th>
				<th>Цена</th>
			</tr>
			<tr>
				<?$img=CFile::ResizeImageGet($arResult['PACKING']["PICTURE"]["ID"], array('width'=>100, 'height'=>70), BX_RESIZE_IMAGE_PROPORTIONAL, true);?>
				<td><img src="/img/detail_services_ligh_present.png" alt=""/></td>
				<td class="good-name-pack" pack-id="<?=$arResult['PACKING']['ID']?>"><?=$arResult['PACKING']['NAME']?></td>
				<td><?=number_format($arResult['PACKING']['PRICE'],0)?> руб.</td>
			</tr>
		</table>
	</div>
	<div class="detail_services_ligh_button">
		<a class="gray_button" href="">Не упаковывать</a>
		<a class="detail_red_button" href="" id="make-packing" title="Красиво упаковать заказ">Упаковать</a>
	</div>
	<div class="detail_services_ligh_bottom_text">
		<b>Уважаемые клиенты!</b><br/>
		По Вашему желанию мы можем запаковать Ваши товары в специальную подарочную упаковку.<br/>
		Заказ на подарочную упаковку можно оставить на странице оформления заказа или при разговоре с менеджером<br/>
        8 (800) 333-07-42 (Звонок бесплатный)<br/>
		<b>Спасибо за то, что выбрали наш магазин!</b>
	</div>
</div>

<script type="text/javascript">
$(".gray_button").click(function(){
	$.fancybox.close();
	return false;
});

$('#make-packing').click(function(){
	var id = $(".good-name-pack").attr("pack-id");
	$.get('/include/script_add_to_cart.php', {id:id,is_service:"Y"}, function(status) {
		$.fancybox.close();
		//$.fancybox({'type':'ajax', href:'/include/popup_cart_success.php'});
		$(".loadhead").load("/include/script_cart_update.php");
        //$('.top_header .basket').load('/include/script_cart_update.php');
	});
	return false;
})
</script>