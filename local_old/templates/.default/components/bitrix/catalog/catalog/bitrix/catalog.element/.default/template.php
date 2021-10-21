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
$arProps = $arResult['PROPERTIES'];
?>
<!-- <div class="detail_page_title"><?=$arResult['NAME']?></div> -->
<?
$fileNoImg = CFile::GetList(array(),array("MODULE_ID" => "service_salavey", "ORIGINAL_NAME" => "no_photo_diada.jpg"))->GetNext();
$resizeImgNoPhoto = CFile::ResizeImageGet($fileNoImg['ID'], array("width" => 1000, "height" => 1000))["src"];
?>	
<link href="/css/detail_style.css" rel="stylesheet" type="text/css" >
<span>
<h1 class="detail_page_title" itemprop="name"><?=$arResult['NAME']?></h1>
<?if ($arResult['DETAIL_PICTURE']):?>
<script type="application/ld+json">
{
	"@context": "https://schema.org",
	"@type": "ImageObject",
	"contentUrl": "<?=$arResult['DETAIL_PICTURE']['SRC']?>",
	"name": "<?=htmlspecialchars($arResult['NAME'])?>"
}
</script>
<?endif?>
<meta itemprop="brand" content="<?php echo $arResult['PROPERTIES']["proizv_vse_f"]["VALUE"];?>">
<meta itemprop="description" content="<?php echo strip_tags($arResult['DETAIL_TEXT']); ?>">
<div class="detail_page_top_info_block">
	<div class="detail_page_top_info_left">
		<!-- <div class="detail_page_top_info_articul">Артикул: <span class="bold"><?=$arProps['CML2_ARTICLE']['VALUE']?></bold></div> -->
		<?$reverse = strrev($arProps['ITEM_CODE']['VALUE']);
		$withSpaces = chunk_split($reverse, 4, ' ');?>
		<div class="detail_page_top_info_articul">Код товара: <span class="bold"><?=strrev($withSpaces);?></span></div>
		<div class="detail_page_top_info_reiting">
			<div class="detail_page_top_info_reiting_star detail-element-raiting">
			    <div class="new_reiting_bl">
                </div>
            </div>
			<a class="add_review" href="javascript:void(0);">Оставить отзыв</a>
		</div>
		<?/*if ($arProps['SUPER']['VALUE']=='Y'):?>
			<div class="detail_page_top_info_button">
				<a class="red_button_volna" href="/catalog/super/">РАСПРОДАЖА</a>
			</div>
		<?endif;?>
		<?if ($arProps['SALE']['VALUE']=='Y'):?>
			<div class="detail_page_top_info_button">
				<a class="red_button_volna" href="/catalog/sale/">ГОРЯЧИЕ СКИДКИ</a>
			</div>
		<?endif;*/?>
		<div class="detail_page_top_info_print small_podskazka_light_block"><a target="_blank" href="?PRINT=Y"><img src="/img/detail_print_button.png" alt=""/><span class="small_podskazka_light_el">Распечатать</span></a></div>
		<div class="detail_page_top_info_3point">
			<span class="js_detail_page_3point_light"><img src="/img/detail_share_button.png" alt=""/></span>
			<ul class="not_style detail_page_3point_light js_detail_page_3point_light">
				<li>
					<div class="detail_share_title">Поделиться в соц.сетях</div>
                    <script src="//yastatic.net/es5-shims/0.0.2/es5-shims.min.js"></script>
                    <script src="//yastatic.net/share2/share.js"></script>
                    <div class="ya-share2" data-title="<?=$arResult['NAME']?>" data-image="<?="https://".$_SERVER["HTTP_HOST"].$arResult['DETAIL_PICTURE']['SRC']?>" data-description="<?=TruncateText(strip_tags($arElement['DETAIL_TEXT']),200)?>" data-services="facebook,twitter,odnoklassniki,vkontakte,gplus"></div>
				</li>
			</ul>
		</div>
	</div>
	<div class="detail_page_top_info_right">
		<?/**/?>
		<?if($USER->IsAdmin()):?>
			<div>
				<input type="button" name="sub" id="qweqweqwe" class="asda" value="подписаться">
			</div>
			<div>
				<?$APPLICATION->IncludeComponent(
				    "bitrix:catalog.product.subscribe",
				    "",
				    Array(
				        "BUTTON_CLASS" => "asda",
				        "BUTTON_ID" => "qweqweqwe",
				        "CACHE_TIME" => "3600",
				        "CACHE_TYPE" => "A",
				        "PRODUCT_ID" => $arResult['ID']
				    )
				);?>
			</div>
		<?endif;?>
	</div>
	<div class="clear"></div>
</div>
<div class="detail_top_big_block">
	<div class="detail_top_big_left_col">
		<div class="detail_top_big_img_block">
			<div class="det_status_list">
				<?if ($arProps['GUARANTEE']['VALUE']):?><div class="det_status_el gar">Гарантия <?=mb_strtolower($arProps['GUARANTEE']['VALUE'])?></div><?endif;?>
				<?if ($arProps['DELIVERY_FREE']['VALUE'] == "да"):?><div class="det_status_el dost">Бесплатная доставка</div><?endif;?>
				<?if (($arProps['BLACK_FRIDAY']['VALUE'] == "Y") && (Salavey::CheckDateBF() == 'Y')):?><div class="det_status_el black">Black Friday</div><?endif?>
				<?if ($arProps['SALE']['VALUE']=='Y'):?><div class="det_status_el sale">SALE</div><?endif?>
				<?if ($arProps['HIT']['VALUE']=='Y'):?><div class="det_status_el hit">ХИТ</div><?endif?>
				<?if ($arProps['NEW']['VALUE']=='Y'):?><div class="det_status_el new">NEW</div><?endif?>
				<?if ($arProps['SUPER']['VALUE']=='Y'):?><div class="det_status_el viol">Выгода</div><?endif?>
			</div>
			<?if ($arResult['DETAIL_PICTURE']):
                $detailResize = CFile::ResizeImageGet($arResult['DETAIL_PICTURE']['ID'], array("width" => 480, "height" => 320))["src"];
            ?>
            	<?php $alt_amg = str_replace('"', '\'', $arResult['NAME']); ?>
                <a style="cursor: pointer" class="fancybox_gal" rel="detail_small_img" href="<?=$arResult['DETAIL_PICTURE']['SRC']?>"><img itemprop="image" src="<?=$detailResize?>" alt="<?=$alt_amg?>" title="<?=$alt_amg?>"/></a>
            <?else:?>
                <img src="<?=$resizeImgNoPhoto?>" alt=""/>
			<?endif;?>
		</div>
		<?if ((is_array($arProps['ADD_PHOTOS']['VALUE']) && count($arProps['ADD_PHOTOS']['VALUE'])) || $arProps['PHOTO_3D']['VALUE'] || $arProps['VIDEO_IFRAME']['VALUE']):?>
            <div class="detail_top_big_small_img_block">
                <div class="new_det_gall_bl">
					<?if ($arProps['ADD_PHOTOS']['VALUE']):?>
						<div class="detail_photo_produce_block">
							<ul class="not_style detail_photo_produce">
								<?php $ii = 0; ?>
								<?foreach($arProps['ADD_PHOTOS']['VALUE'] as $photo):?>
								<?php $ii++; ?>
									<?$arPhoto = CFile::GetFileArray($photo)?>
									<?$arImg = CFile::ResizeImageGet($photo, Array("width"=>77, "height"=>77), BX_RESIZE_IMAGE_EXACT)?>
									<li>
										<script type="application/ld+json">
										{
											"@context": "https://schema.org",
											"@type": "ImageObject",
											"contentUrl": "<?=$arPhoto['SRC']?>",
											"name": "<?=htmlspecialchars($alt_amg)?>"
										}
										</script>
										<a class="detail_small_img_gray_el fancybox_gal" rel="detail_small_img" href="<?=$arPhoto['SRC']?>"><img src="<?=$arImg['src']?>"  alt="<?=$alt_amg?> <?=$ii?>" title="<?=$alt_amg?> <?=$ii?>"/></a>
									</li>
								<?endforeach;?>
							</ul>
						</div>
					<?endif;?>
                    <?/*if ($arProps['PHOTO_3D']['VALUE']):*/?><!--<a class="detail_small_img_3d_el fancybox_gal" href="#spritespin_block"></a>--><?/*endif;*/?>
                    <?if ($arProps['PHOTO_3D']['VALUE']):?><a class="detail_small_img_3d_el fancybox_3d" href="/3d_viewer/viewer.php?album_id=<?=$arProps['PHOTO_3D']['VALUE']?>"></a><?endif;?>
                    <?if ($arProps['VIDEO_IFRAME']['VALUE']):?><a class="detail_small_img_video_el" rel="detail_small_img" href="/img/detail_big_img.png"></a><?endif;?>
                </div>
            </div>
		<?endif;?>
	</div>
	<div class="detail_top_big_right_col">
		<div>
			<div class="detail_complect_left_block" itemprop="offers" itemscope itemtype="http://schema.org/Offer">
				<link itemprop="url" href="https://www.diada-arms.ru<?php echo $_SERVER['REQUEST_URI'] ?>">
				<meta itemprop='price' content="<?php echo $arResult['ITEM_PRICES']['0']['BASE_PRICE']-$arResult['ITEM_PRICES']['0']['DISCOUNT']; ?>">
				<meta itemprop="priceCurrency" content="RUB">
				<?php if($arProps['INDIKATOR']['VALUE_XML_ID']!='net') echo ' <link itemprop="availability" href="http://schema.org/InStock">'; else echo '<link itemprop="availability" href="http://schema.org/OutOfStock">'; ?>
				<div class="detail_complect_red_title">Выберите комплектацию <span class="podskazka_block">?
                        <span class="podskazka_text">
                        <span>
                            <span class="bold">"Базовая"</span> комплектация предусмотренная заводом-изготовителем.<br /><br />
                            <span class="bold">"Мастер"</span> стандартный комплект, подобранный нашими специалистами с учетом особенностей базовой комплектации.<br /><br />
                            <span class="bold">"Профи"</span> оптимальный комплект для опытных пользователей.<br />
                        </span></span></span></div>
				<div><form>
					<label class="detail_complect_el set_base" data-type="base">
						<span class="detail_complect_el_l detail_complect_el_l_radio"><input type="radio" name="detail_complect_radio" value="0"/></span>
						<span class="detail_complect_el_l detail_complect_el_l_title">Базовая</span>
						<span class="detail_complect_el_l detail_complect_el_price">
							<span class="detail_complect_el_new_price"></span>
							<span class="detail_complect_el_old_price"></span>
						</span>
						<span class="detail_complect_el_arrow"><img src="/img/detail_complect_el_active_right.png" alt=""/></span>
					</label>
					<?if ($arProps['SET_MASTER']['VALUE']):?>
					<label class="detail_complect_el set_master" data-type="master">
						<span class="detail_complect_el_l detail_complect_el_l_radio"><input type="radio" name="detail_complect_radio"  value="1"/></span>
						<span class="detail_complect_el_l detail_complect_el_l_title">Мастер</span>
						<span class="detail_complect_el_l detail_complect_el_price">
							<span class="detail_complect_el_new_price"></span>
							<span class="detail_complect_el_old_price"></span>
						</span>
						<span class="detail_complect_el_arrow"><img src="/img/detail_complect_el_active_right.png" alt=""/></span>
					</label>
					<?endif;?>
					<?if ($arProps['SET_PROFI']['VALUE']):?>
					<label class="detail_complect_el set_profi" data-type="profi">
						<span class="detail_complect_el_l detail_complect_el_l_radio"><input type="radio" name="detail_complect_radio" value="2"/></span>
						<span class="detail_complect_el_l detail_complect_el_l_title">Профи</span>
						<span class="detail_complect_el_l detail_complect_el_price">
							<span class="detail_complect_el_new_price"></span>
							<span class="detail_complect_el_old_price"></span>
						</span>
						<span class="detail_complect_el_arrow"><img src="/img/detail_complect_el_active_right.png" alt=""/></span>
					</label>
					<?endif;?>
				</form></div>
				<div class="det_status_kol_bl">
					<div class="det_status_kol_l">
						<?$arInd = Array("est"=>"Есть в наличии", "net"=>"Нет в наличии", "sklad"=>"Есть в наличии на складе", "snyato"=>"Снято с производства", "zakaz" => "Под заказ");?>
						<?$indikator = strtolower($arProps['INDIKATOR']['VALUE_XML_ID'])?>
						<?if ($indikator):?>
							<?$alt = $arProps['INDIKATOR']['VALUE'];?>
							<div class="nal_<?=$indikator?>"><?=$arInd[ $indikator ]?></div>
						<?elseif (in_array($arResult['SECTION']['PATH'][0]['ID'], Array(221,230,187,258,188,197))):?>
							<div class="nal_est">Есть в наличии на складе</div>
						<?endif;?>
					</div>
					<div class="det_status_kol_r">
						<div class="buy_number">
							<a class="js_number_prev" href=""><img src="/img/number_prev.png" alt=""></a>
							<input class="number" type="number" value="1">
							<a class="js_number_next" href=""><img src="/img/number_next.png" alt=""></a>
						</div>
					</div>
				</div>
				<div class="new_det_buy_bl">
					<a id="button_buy_product" class="new_det_buy_bt" data-id="<?=$arResult['ID']?>" href="javascript:void(0);" itemscope itemtype="http://schema.org/BuyAction"><span>Купить</span></a>
				</div>
				<div class="new_det_doubl_bt">
					<a class="new_det_gray_bt green_h fancy_ajax_click_buy" href="/include/popup_oneclick.php?PRODUCT_ID=<?=$arResult['ID']?>"><i class="det_basket"></i>В 1 клик</a>
					<a class="new_det_gray_bt blue_h fancy_ajax_click_buy" href="/include/popup_credit.php?PRODUCT_ID=<?=$arResult['ID']?>"><i class="det_credit">%</i>В кредит</a>
				</div>
				<?/* <div class="det_favor_srav_bl">
					<div class="detail_page_top_info_sravneneie small_podskazka_light_block"><a href="<?=$arResult['COMPARE_URL']?>"><img src="/img/detail_sravnenie.png" alt=""/><span class="small_podskazka_light_el">Добавить в сравнение</span></a></div>
					<div class="detail_page_top_info_love small_podskazka_light_block"><a data-id="<?=$arResult['ID']?>" href=""><img src="/img/detail_love.png" alt=""/><span class="small_podskazka_light_el">Добавить в избранное</span></a></div>
				</div> */?>
				
				<div class="det_favor_srav_bl">
					<a class="det_srav_bt js_det_srav_bt" href="<?=$arResult['COMPARE_URL']?>">В сравнение</a>
					<a class="det_favor_bt js_det_favor_bt" data-id="<?=$arResult['ID']?>" href="">В избранное</a>
				</div>
				<?/*<ul class="not_style detail_complect_buy_block">
					<li>
						
					</li>
					<li>
					</li>*/?>
					<?/*if (in_array($arResult['ID'], $arParams['IN_BASKET'])):?>
						<li><a class="red_buy_detail in_basket_button" data-id="<?=$arResult['ID']?>" href="/personal/cart/">Перейти в корзину</a></li>
					<?else:?>
						<li><a id="button_buy_product" class="red_buy_detail" data-id="<?=$arResult['ID']?>" href="" itemscope itemtype="http://schema.org/BuyAction">Купить</a></li>
					<?endif;*/?><?/*
                    <li></li>
				</ul>*/?>
				<div class="detail_complect_snizim_price_block">
					<a class="detail_complect_snizim_price fancy_ajax" href="/include/popup_deshevle.php?PRODUCT_ID=<?=$arResult['ID']?>">Нашли дешевле? Снизим цену!</a>
					<div class="clear"></div>
				</div>
				<a href="" class="detail_complect_dostavka">
					<span>Доставка / Самовывоз</span>
					<span class="detail_complect_dostavka_blue">варианты и стоимость</span>
				</a>
				<a href="" class="detail_complect_samovivoz">
					<span>Оплата</span>
					<span class="detail_complect_dostavka_blue">варианты и стоимость</span>
				</a>
                <?/*<a href="" class="detail_complect_payment">
                    <span><span class="bold">Оплата</span></span><br>
                    <span class="detail_complect_dostavka_blue">варианты и стоимость</span>
                </a>*/?>
			</div>
			<div class="detail_complect_dop_info_block detail_complect_right_block">
				<?/*<div class="detail_complect_dop_info_black_title">СОДЕРЖАНИЕ:</div>*/?>
				<div class="comp_info_tit_bl">
					<div class="detail_complect_dop_info_red_title">Комплект <span></span></div>
					<div class="detail_complect_dop_info_price"></div>
				</div>
				<p>Состав:</p>
				<ul class="detail_complect_dop_info_list">
				</ul>
				<div class="detail_complect_dop_info_img_block">
				</div>
			</div>
			<div class="clear"></div>
		</div>
	</div>
	<?/*<div class="section social_tabs display_none_p display_none_c display_none_m display_none_mp">
		<?$APPLICATION->IncludeComponent(
			"bitrix:main.include",
			"",
			Array(
				"AREA_FILE_SHOW" => "file",
				"AREA_FILE_SUFFIX" => "inc",
				"EDIT_TEMPLATE" => "",
				"PATH" => "/include/soc_seti.php"
			)
		);?>
	</div>
	<div class="clear"></div>*/?>
</div>
</span>

<script type="text/javascript">
$(document).ready(function() {

	set_handler($('.set_base'));

	$('.detail_complect_el').change(function() {
		set_handler(this);
	});

	//клик по Оставить отзыв
	$('.add_review').click(function() {
        if (window.innerWidth>800) {
            $('li.tab_reviews').click();
        }
        else{
            if (!$(".mobile_tab_revies").hasClass("active_mobile_text_el_button")){$(".mobile_tab_revies ").click();}
        }
		$('html,body').animate({ scrollTop: $('.block_reviews').offset().top }, 1000);
		return false;
	});

	//клик по Видео
	$('.detail_small_img_video_el').click(function() {
        if (window.innerWidth>800) {
            $("#description_product").click();
        }
        else{
            if (!$("#description_product_mobile").hasClass("active_mobile_text_el_button")){$("#description_product_mobile").click();}
        }
		$('html,body').animate({ scrollTop: $('.video').offset().top }, 1000);
		return false;
	});

	//клик по Добавить в избранное
    $('.detail_page_top_info_love a').click(function() {
    	var arrFavour = [];
    	if ($.cookie('favourites')) $.merge(arrFavour, eval($.cookie('favourites')));
    	arrFavour.push( $(this).data("id") );
    	$.cookie('favourites', JSON.stringify(arrFavour), {expires: 7, path: '/'});
		$.fancybox({'type':'ajax', href:'/include/popup_favourites_success.php'});
    	return false;
    });
    $('.js_det_favor_bt').click(function() {
		$(this).addClass("active");
    	var arrFavour = [];
    	if ($.cookie('favourites')) $.merge(arrFavour, eval($.cookie('favourites')));
    	arrFavour.push( $(this).data("id") );
    	$.cookie('favourites', JSON.stringify(arrFavour), {expires: 7, path: '/'});
		$.fancybox({'type':'ajax', href:'/include/popup_favourites_success.php'});
    	return false;
    });
    $(".detail_complect_dostavka").click(function () {
        if (window.innerWidth>800) {
            $("#deliv_and_store").click();
        }
        else{
            if (!$(".zabrat_dostavit").hasClass("active_mobile_text_el_button")){$(".zabrat_dostavit ").click();}
        }
        $("#deliv_list").click();
        $("html,body").animate({ scrollTop: $('.detail_delivery').offset().top }, 1000);
        return false;
    });
    $(".detail_complect_samovivoz").click(function () {
        if (window.innerWidth>800) {
            $("#deliv_and_store").click();
        }
        else{
            if (!$(".zabrat_dostavit").hasClass("active_mobile_text_el_button")){$(".zabrat_dostavit ").click();}
        }
        $("#payment_list").click();
        $("html,body").animate({scrollTop: $('.detail_delivery').offset().top}, 1000);
        return false;
    });
});

function set_handler(elem)
{
	var arBase = [<?=$arResult['ID']?>, <?=implode(',', $arProps['SET_BASE']['VALUE'])?>];
	var arMaster = [<?=$arResult['ID']?>, <?=implode(',', $arProps['SET_MASTER']['VALUE'])?>];
	var arProfi = [<?=$arResult['ID']?>, <?=implode(',', $arProps['SET_PROFI']['VALUE'])?>];
	var baseDiscount = parseInt(<?=intval($arProps['SET_BASE_DISCOUNT']['VALUE'])?>);
	var masterDiscount = parseInt(<?=intval($arProps['SET_MASTER_DISCOUNT']['VALUE'])?>);
	var profiDiscount = parseInt(<?=intval($arProps['SET_PROFI_DISCOUNT']['VALUE'])?>);
	var arSets = arBase.concat(arMaster, arProfi);

	$('.detail_complect_el').removeClass('active');
	$(elem).addClass('active').find('input').attr('checked', true).trigger('refresh');
	var type = $(elem).data('type');

	switch (type) {
		case 'base':
			var arSetCur = arBase;
			var setCurDicount = baseDiscount;
			var title = 'Базовый';
			break;
		case 'master':
			var arSetCur = arMaster;
			var setCurDicount = masterDiscount;
			var title = 'Мастер';
			break;
		case 'profi':
			var arSetCur = arProfi;
			var setCurDicount = profiDiscount;
			var title = 'Профи';
			break;
	}

	$.getJSON('<?=$templateFolder?>/get_set.php', {sets:arSets,unsetProduct:<?=$arResult["ID"]?>}, function(data) {
        $('.detail_complect_dop_info_list').empty();
        $('.detail_complect_dop_info_img_block').empty();
        var priceBase = priceBaseDiscountProduct = 0;
        var priceMaster = priceMasterDiscountProduct = 0;
        var priceProfi = priceProfiDiscountProduct = 0;
        for (var id in data.ITEMS)
        {
            if (data.ITEMS[id].UNSET_LINK) {
                type = '';
                if (arBase.in_array(id)) {
                    priceBase += data.ITEMS[id].PRICE;
                    priceBaseDiscountProduct += data.ITEMS[id].DISCOUNT;
                }
                if (arMaster.in_array(id)) {
                    priceMaster += data.ITEMS[id].PRICE;
                    priceMasterDiscountProduct += data.ITEMS[id].DISCOUNT;
                }
                if (arProfi.in_array(id)) {
                    priceProfi += data.ITEMS[id].PRICE;
                    priceProfiDiscountProduct += data.ITEMS[id].DISCOUNT;
                }
                if (arSetCur.in_array(id)) {
                    $('.detail_complect_dop_info_list').append("<li><span class='bold'>" + data.ITEMS[id].NAME + "</span></li>");
                    $('.detail_complect_dop_info_img_block').append("<div class='detail_complect_dop_info_img_el'><img src='" + data.ITEMS[id].IMG + "' alt=''/></div>");
                }
            }
        }
        for (var id in data.ITEMS)
        {
            if (!data.ITEMS[id].UNSET_LINK) {
                type = '';
                if (arBase.in_array(id)) {
                    priceBase += data.ITEMS[id].PRICE;
                    priceBaseDiscountProduct += data.ITEMS[id].DISCOUNT;
                }
                if (arMaster.in_array(id)) {
                    priceMaster += data.ITEMS[id].PRICE;
                    priceMasterDiscountProduct += data.ITEMS[id].DISCOUNT;
                }
                if (arProfi.in_array(id)) {
                    priceProfi += data.ITEMS[id].PRICE;
                    priceProfiDiscountProduct += data.ITEMS[id].DISCOUNT;
                }
                if (arSetCur.in_array(id)) {
                    $('.detail_complect_dop_info_list').append("<li><a href='" + data.ITEMS[id].URL + "'>" + data.ITEMS[id].NAME + "</a></li>");
                    $('.detail_complect_dop_info_img_block').append("<div class='detail_complect_dop_info_img_el'><img src='" + data.ITEMS[id].IMG + "' alt=''/></div>");
                }
            }
        }
        $('.detail_complect_dop_info_red_title span').html( title );

        baseDiscount = baseDiscount+priceBaseDiscountProduct;
        $('.set_base .detail_complect_el_new_price').html( number_format(priceBase-baseDiscount, 0, '', ' ')+'&nbsp;руб.' );
        if (baseDiscount > 0){
            $('.set_base .detail_complect_el_old_price').html( number_format(priceBase, 0, '', ' ')+'&nbsp;руб.' );
            if ($(".detail_complect_el.set_base").hasClass("active")){
                if (baseDiscount) $('.detail_complect_dop_info_price').show().html("Экономия: <span>"+number_format(baseDiscount, 0, '', ' ')+'&nbsp;руб.</span>' );
            }
        }
        else if ($(".detail_complect_el.set_base").hasClass("active")){
            $('.detail_complect_dop_info_price').hide()
        }
        masterDiscount = masterDiscount+priceMasterDiscountProduct;
        $('.set_master .detail_complect_el_new_price').html( number_format(priceMaster-masterDiscount, 0, '', ' ')+'&nbsp;руб.' );
        if (masterDiscount > 0){
            $('.set_master .detail_complect_el_old_price').html( number_format(priceMaster, 0, '', ' ')+'&nbsp;руб.' );
            if ($(".detail_complect_el.set_master").hasClass("active")) {
                if (masterDiscount) $('.detail_complect_dop_info_price').show().html("Экономия: <span>" + number_format(masterDiscount, 0, '', ' ') + '&nbsp;руб.</span>');
            }
        }
        else if ($(".detail_complect_el.set_master").hasClass("active")){
            $('.detail_complect_dop_info_price').hide()
        }
        profiDiscount = profiDiscount+priceProfiDiscountProduct;
        $('.set_profi .detail_complect_el_new_price').html( number_format(priceProfi-profiDiscount, 0, '', ' ')+'&nbsp;руб.' );
        if (profiDiscount > 0){
            $('.set_profi .detail_complect_el_old_price').html( number_format(priceProfi, 0, '', ' ')+'&nbsp;руб.' );
            if ($(".detail_complect_el.set_profi").hasClass("active")) {
                if (profiDiscount) $('.detail_complect_dop_info_price').show().html("Экономия: <span>" + number_format(profiDiscount, 0, '', ' ') + '&nbsp;руб.</span>');
            }
        }
        else if ($(".detail_complect_el.set_profi").hasClass("active")){
            $('.detail_complect_dop_info_price').hide()
        }
	});
}



window.dataLayer = window.dataLayer || [];	
dataLayer.push({
    "ecommerce": {
        "detail": {
            "products": [
                {
                    "id": "<?=$arProps['ITEM_CODE']['VALUE']?>",
                    "name" : "<?=$arResult['NAME']?>",
                    "price": <?php echo $arResult['ITEM_PRICES']['0']['BASE_PRICE']-$arResult['ITEM_PRICES']['0']['DISCOUNT']; ?>,
                    "category" : '<?php echo $arResult["CATEGORY_PATH"]; ?>',
                },
            ]
        }
    }
});

$("#button_buy_product").click(function(){
	dataLayer.push({
    "ecommerce": {
        "add": {
            "products": [
                {
                    "id": "<?=$arProps['ITEM_CODE']['VALUE']?>",
                    "name": "<?=$arResult['NAME']?>",
                    "price": <?php echo $arResult['ITEM_PRICES']['0']['BASE_PRICE']-$arResult['ITEM_PRICES']['0']['DISCOUNT']; ?>,
                    "quantity": $(".buy_number input.number").val(),
                    "category" : '<?php echo $arResult["CATEGORY_PATH"]; ?>',
                }
            ]
        }
    }
});
});




</script>


<script> var isProductPage = true; </script>
