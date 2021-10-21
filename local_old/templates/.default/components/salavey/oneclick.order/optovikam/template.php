<?
if(!defined("B_PROLOG_INCLUDED")||B_PROLOG_INCLUDED!==true)die();
/**
 * Bitrix vars
 *
 * @var array $arParams
 * @var array $arResult
 * @var CBitrixComponentTemplate $this
 * @global CMain $APPLICATION
 * @global CUser $USER
 */
?>
<?if($arResult["OK_MESSAGE"] && $arResult['ORDER_ID']):?>

	<div class="mf-ok-text" style="margin-top: 10px;">Ваш заказ №<?=$arResult['ORDER_ID']?> офомлен!<br />Наши менеджеры свяжутся с вами в ближайшее время!</div>

	<?
	CModule::IncludeModule('sale');
	CModule::IncludeModule('iblock');

	$arr = Array();
	$dbBas = CSaleBasket::GetList(Array(), Array('ORDER_ID' => $arResult['ORDER_ID']));
	//echo $dbBas->SelectedRowsCount();
	while ($ar_res = $dbBas->Fetch()) {
		if ($ar_res['SET_PARENT_ID'] > 0 && $ar_res['SET_PARENT_ID'] != $ar_res['ID'])
			continue;
		$arr[] = Array(
			'id' => $ar_res['PRODUCT_ID'],
			'name' => $ar_res['NAME'],
			'price' => floatval($ar_res['PRICE']),
			'quantity' => intval($ar_res['QUANTITY']),
		);
	}
	$arrOut = Array(
		'ecommerce' => Array(
			'purchase' => Array(
				'actionField' => Array(
					'id' => $arResult['ORDER_ID'],
					//'goal_id' => '13739290',
				),
				'products' => $arr
			)
		)
	);
	?>
	<script type="text/javascript">
		window.dataLayer = window.dataLayer || [];
		dataLayer.push(<?=json_encode($arrOut)?>);
	</script>

	<script type="text/javascript">
	    (function (d, w) {
	        w._admitadPixel = {
	            response_type: 'img',
	            action_code: '1',
	            campaign_code: '78f9a29420'
	        };
	        w._admitadPositions = w._admitadPositions || [];
	        <?foreach($arr as $i=>$arBasket):?>
	        <?$arElement = getIBlockElement($arBasket['id']);?>
	        w._admitadPositions.push({
	            uid: '<?=htmlspecialcharsbx($_COOKIE["admitad_uid"])?>',
	            order_id: '<?=$arResult['ORDER_ID']?>',
	            position_id: '<?=($i+1)?>',
	            client_id: '',
	            tariff_code: '<?=$arElement['PROPERTIES']['TARIFF_CODE']['VALUE']?>',
	            currency_code: 'RUB',
	            position_count: '<?=count($arr)?>',
	            price: '<?=$arBasket['price']?>',
	            quantity: '<?=$arBasket['quantity']?>',
	            product_id: '<?=$arBasket['id']?>',
	            screen: '1920x1080',
	            tracking: '',
	            old_customer: '',
	            coupon: '',
	            promocode: '',
	            payment_type: 'sale'
	        });
	        <?endforeach;?>
	        var id = '_admitad-pixel';
	        if (d.getElementById(id)) { return; }
	        var s = d.createElement('script');
	        s.id = id;
	        var r = (new Date).getTime();
	        var protocol = (d.location.protocol === 'https:' ? 'https:' : 'http:');
	        s.src = protocol + '//cdn.asbmit.com/static/js/pixel.min.js?r=' + r;
	        d.head.appendChild(s);
	    })(document, window)
	</script>
	<noscript>
		<?foreach($arr as $i=>$arBasket):?>
	    <img src="//ad.admitad.com/r?
	campaign_code=78f9a29420&action_code=1&response_type=img&uid=<?=htmlspecialcharsbx($_COOKIE['admitad_uid'])?>&order_id=<?=$arResult['ORDER_ID']?>&position_id=<?=($i+1)?>&tariff_code=<?=$arElement['PROPERTIES']['TARIFF_CODE']['VALUE']?>&currency_code=RUB&position_count=<?=count($arr)?>&price=<?=$arBasket['price']?>&quantity=<?=$arBasket['quantity']?>&product_id=<?=$arBasket['id']?>&coupon=&promocode =&payment_type=sale" width="1" height="1" alt="">
		<?endforeach;?>
	</noscript>

	<script type="text/javascript">
	    window.ad_order = "<?=htmlspecialcharsbx($_REQUEST['order_id'])?>";    // required
	    window.ad_amount = "<?=$arResult['NEW_ORDER_PRICE']?>";
	    window.ad_products = [
	    <?foreach($arr as $i=>$arBasket):?>
	    {
	        "id": "<?=$arBasket['id']?>",
	        "number": "<?=$arBasket['quantity']?>"
	    }
	    <?endforeach;?>
	    ];

	    window._retag = window._retag || [];
	    window._retag.push({code: "9ce8887639", level: 4});
	    (function () {
	        var id = "admitad-retag";
	        if (document.getElementById(id)) {return;}
	        var s = document.createElement("script");
	        s.async = true; s.id = id;
	        var r = (new Date).getDate();
	        s.src = (document.location.protocol == "https:" ? "https:" : "http:") + "//cdn.lenmit.com/static/js/retag.min.js?r="+r;
	        var a = document.getElementsByTagName("script")[0]
	        a.parentNode.insertBefore(s, a);
	    })()
	</script>

	<script type="text/javascript">
	var google_conversion_id = 880904289;
	var google_conversion_label = "tWFdCMvahmcQ4ZCGpAM";
	</script>
	<script type="text/javascript" src="//autocontext.begun.ru/conversion.js"></script>
	<!-- Conversion tracking code: purchases. Step 3: Order complete -->
	<script type="text/javascript">
	(function(w, p) {
	var a, s;
	(w[p] = w[p] || []).push({
	counter_id: 423876153,
	tag: 'd48b4d71cf0f2b0f1d0b723349e8846c'
	});
	a = document.createElement('script'); a.type = 'text/javascript'; a.async = true;
	a.src = ('https:' == document.location.protocol ? 'https://' : 'http://') + 'autocontext.begun.ru/analytics.js';
	s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(a, s);
	})(window, 'begun_analytics_params');
	</script>
<?else:?>
    <form action="<?=POST_FORM_ACTION_URI?>" method="POST" id="ask_a_question" class="new_call_back_light dasket_one_click_popup one_click_form_block" style="padding: 0">
    <input type="hidden" name="PRODUCT_ID" value="<?=$arResult['PRODUCT_ID']?>">
    <input type="hidden" name="QUANTITY" value="<?=$arResult['QUANTITY']?>">
    <?=bitrix_sessid_post()?>


        <div class="new_call_back_light_text"><?=$arResult['PRODUCT_NAME']?></div>
        <div class="one_click_form_el">
            <input type="text" <?if(in_array('NAME',$arResult['ERROR_MESSAGE'])):?>class="sal_error"<?endif?> name="user_name" style="font-size: 20px;" placeholder="Имя" value="<?=$arResult["AUTHOR_NAME"]?>"/>
        </div>
        <div class="one_click_form_el">
            <input type="text" <?if(in_array('PHONE',$arResult['ERROR_MESSAGE'])):?>class="sal_error"<?endif?> name="user_phone" style="font-size: 20px;" placeholder="Телефон" value="<?=$arResult["PHONE"]?>"/>
            <script>
                $(document).ready(function ($) {
                    $('[name="user_phone"]').mask('+7 (999) 999-99-99');
                });
            </script>
        </div>
        <?
        $arSetsName = array('base', 'master', 'profi');
        $setID = array_search($_REQUEST['type'],$arSetsName);
        ?>
        <input type="hidden" name="SET" value="<?=htmlspecialcharsbx($setID)?>" />
        <input type="hidden" name="PARAMS_HASH" value="<?=$arResult["PARAMS_HASH"]?>" />
        <input class="red_button" name="submit" type="submit" value="Отправить"/>
    </form>
<?endif;?>