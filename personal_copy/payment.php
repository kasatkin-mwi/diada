<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Оплата онлайн");
global $USER;
CModule::IncludeModule('sale');
CModule::IncludeModule("rficb.payment");
?><?if ($_REQUEST["CHEK_DATA"] == "Y"){
    $APPLICATION->RestartBuffer();
    $ERRORS = false;
    if (!empty($_REQUEST["order"]) && $_REQUEST["order"]>0){
        if ($order = \Bitrix\Sale\Order::load($_REQUEST["order"])){
            $paymentSystem = $order->getPaymentCollection();
            $countCanPay = 0;
            foreach ($paymentSystem as $payment){
                /**
                 * @var $payment \Bitrix\Sale\Payment
                 */
                if (!$payment->isPaid() && $payment->getPaymentSystemId() == 13){
                    $countCanPay++;
                    $SUM = $payment->getSum();
                    break;
                }
                if ($countCanPay == 0){
                    $ERRORS = true;
                    $were[] = 1;
                }
            }
        }
        else{
            $ERRORS = true;
            $were[] = 2;
        }
    }
    else{
        $ERRORS = true;
        $were[] = 3;
    }
    if (!empty($_REQUEST["cost"]) && $_REQUEST["cost"]<=0){
        $ERRORS = true;
        $were[] = 4;
    }
    echo json_encode(array("success" => !$ERRORS, "sum" => $SUM, "line" => $were));
    die();
}?> <style>
    .text{
        margin-bottom: 10px;
    }
    .errors_sh{
        background-color: #fff8df;
        padding: 20px;
        border-radius: 10px;
        color: red;
        text-align: center;
        font-weight: bold;
    }
    .hide{
        display: none;
    }
</style> <script>
    function dataCheck(_this) {
        $doCheck = true;
        $form = $(_this).parents("form");
        $formInput = $form.find("input[type='text']");
        $formInput.each(function (num) {
            if ($($formInput[num]).val() == ""){
                $($formInput[num]).addClass("error");
                $doCheck = false;
            }
            else{
                $($formInput[num]).removeClass("error");
            }
        });
        if ($doCheck){
            $.ajax({
                url: "<?=$APPLICATION->GetCurPage().'?CHEK_DATA=Y'?>",
                data: $form.serialize(),
                dataType: "json",
                success: function (data) {
                    if (data.success == true){
                        var date = new Date();
                        $order = $("[name='order']").val();
                        $("[name='order_id']").attr("value",$order+'_'+date.getHours()+date.getMinutes()+date.getSeconds());
                        $("[name='name']").attr("value","Оплата заказа №"+$order);
                        $("[name='cost']").attr("value",data.sum);
                        $("[name='comment']").attr("value",$("[name='payer_name']").val()+"  "+$("[name='phone_number']").val());
                        $("#form_pay_order").attr("action","https://partner.rficb.ru/a1lite/input").submit();
                    }
                    else{
                        $(".errors_sh").removeClass("hide");
                    }
                }
            })
        }
        return false;
    }
</script>
<div class="card_pay">
	<div class="text">
		 Оплатить банковской картой Вы можете только по предварительно выставленному счету менеджером нашего магазина, согласовав вид оплаты.
	</div>
	<div class="text">
		 Для оплаты заказа заполните форму и нажмите кнопку "Оплата банковской картой".<br>
		 Вы перейдёте на страницу банка, где сможете закончить оплату.
	</div>
	<div class="form">
		<div class="errors_sh hide">
			 Ошибка оплаты online, свяжитесь пожалуйста с менеджером по телефону указанному на сайте
		</div>
		<form method="POST" class="application" accept-charset="UTF-8" action="" id="form_pay_order">
			 <?
            $key = CRficbPayment::GetKey("s1");
            ?> <input name="key" value="<?echo $key?>" type="hidden"> <input name="order_id" value="" type="hidden"> <input name="name" value="" type="hidden"> <input name="comment" value="" type="hidden"> <input name="cost" value="" type="hidden">
			<!--<tr>
				<td>
					 Сумма оплаты*
				</td>
				<td>
 <input name="cost" value="<?/*=$_REQUEST['cost']*/?>" type="text">
				</td>
			</tr>-->
			<table>
			<tbody>
			<tr>
				<td>
					 Номер заказа*
				</td>
				<td>
 <input name="order" value="<?=htmlspecialcharsbx($_REQUEST['order'])?>" type="text">
				</td>
				<td class="display_none_m display_none_mp" style="vertical-align: middle; padding-left: 15px;" rowspan="5">
 <img src="/img/card_pay_img2.png">
				</td>
			</tr>
			<tr>
				<td>
					<div class="totop">
						 Контактное лицо*
					</div>
				</td>
				<td>
 <input name="payer_name" value="<?=htmlspecialcharsbx($_REQUEST['payer_name'])?>" type="text">
					<div class="hint">
						 Пример: Иванов Иван Иванович
					</div>
				</td>
			</tr>
			<tr>
				<td>
					<div class="totop">
						 Телефон*
					</div>
				</td>
				<td>
 <input name="phone_number" value="<?=htmlspecialcharsbx($_REQUEST['phone_number '])?>" type="text">
					<div class="hint">
						 Пример: +7-964-768-86-09
					</div>
				</td>
			</tr>
			<tr>
				<td>
				</td>
				<td>
 <input class="red_button" name="card_pay" onclick="dataCheck(this); return false" value="Оплата банковской картой" type="submit">
				</td>
			</tr>
 <input name="in_page_pay_order" value="Y" type="hidden">
			</tbody>
			</table>
		</form>
		<div class="display_none_p display_none_c payment_page_card">
 <img src="/img/card_pay_img2.png">
		</div>
	</div>
	<div class="text_blue">
		 При оплате заказа банковской картой ввод реквизитов карты происходит в системе электронных платежей, который прошел сертификацию в платежных системах Visa и MasterCard. Представленные Вами данные полностью защищены и никто, включая наш интернет-магазин, не может их получить.
	</div>
</div>
 <br><?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>