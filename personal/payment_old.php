<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Оплата онлайн");
global $USER;
CModule::IncludeModule('sale');
unset($_SESSION["TICKET"]);
$ERROR = $err = false;
if ($_REQUEST['card_pay']) {
    $err = true;
    if ($_REQUEST['ORDER_ID']>0 && strlen($_REQUEST['SUMM'])>0 && strlen($_REQUEST['NAME'])>0 && strlen($_REQUEST['PHONE'])>0){
        if ($_REQUEST['SUMM'] && $_REQUEST['NAME'] && $_REQUEST['PHONE']) {
            $arOrder = CSaleOrder::GetByID($_REQUEST['ORDER_ID']);
            if ($arOrder && ($arOrder["PAYED"] == "N")) {
                $arFields = Array('USER_DESCRIPTION' => $arOrder['USER_DESCRIPTION'] . "\r\nОплата картой:\r\nФИО: " . $_REQUEST['NAME'] . ";\r\nНомер телефона: " . $_REQUEST['PHONE'],);
                CSaleOrder::Update($arOrder['ID'], $arFields);
                $_SESSION["PAY_SUMM"] = $_REQUEST['SUMM'];
                $USER->Authorize($arOrder['USER_ID']);
                $APPLICATION->IncludeComponent(
                    "bitrix:sale.order.payment",
                    "",
                    Array()
                );
            }
            else{
                $ERROR = true;
            }
        }
    }
}
else{
?>
    <style>
        .text{
            margin-bottom: 10px;
        }
        .errors{
            background-color: #fff8df;
            padding: 20px;
            border-radius: 10px;
            color: red;
            text-align: center;
            font-weight: bold;
        }
    </style>
    <div class="card_pay">
        <div class="text">
            Оплатить банковской картой Вы можете только по предварительно выставленному счету менеджером нашего магазина, согласовав вид оплаты.
        </div>
        <div class="text">
            Для оплаты заказа заполните форму и нажмите кнопку "Оплата банковской картой".<br />
            Вы перейдёте на страницу нашего банка ОАО АКБ "Авангард", где сможете закончить оплату.
        </div>
        <div class="form">
            <?if ($ERROR):?>
                <div class="errors">Ошибка оплаты online, свяжитесь пожалуйста с менеджером по телефону указанному на сайте</div>
            <?endif;?>
            <form action="" method="GET">
                <table>
                    <tr>
                        <td>Номер счёта*</td>
                        <td><input type="text" name="ORDER_ID" value="<?=htmlspecialcharsbx($_REQUEST['ORDER_ID'])?>"<?=$err&&!$_REQUEST['ORDER_ID']?' class="error"':''?> /></td>
                        <td class="display_none_m display_none_mp" rowspan="5" style="vertical-align: middle; padding-left: 15px;"><img src="/img/card_pay_img2.png" /></td>
                    </tr>
                    <tr>
                        <td>Сумма оплаты*</td>
                        <td><input type="text" name="SUMM" value="<?=htmlspecialcharsbx($_REQUEST['SUMM'])?>"<?=$err&&!$_REQUEST['SUMM']?' class="error"':''?> /></td>
                    </tr>
                    <tr>
                        <td><div class="totop">Контактное лицо*</div></td>
                        <td>
                            <input type="text" name="NAME" value="<?=htmlspecialcharsbx($_REQUEST['NAME'])?>"<?=$err&&!$_REQUEST['NAME']?' class="error"':''?> />
                            <div class="hint">Пример: Иванов Иван Иванович</div>
                        </td>
                    </tr>
                    <tr>
                        <td><div class="totop">Телефон*</div></td>
                        <td>
                            <input type="text" name="PHONE" value="<?=htmlspecialcharsbx($_REQUEST['PHONE'])?>"<?=$err&&!$_REQUEST['PHONE']?' class="error"':''?> />
                            <div class="hint">Пример: +7-964-768-86-09</div>
                        </td>
                    </tr>
                    <tr>
                        <td></td>
                        <td><input class="red_button" type="submit" name="card_pay" value="Оплата банковской картой" /></td>
                    </tr>
                    <input name="in_page_pay_order" value="Y" type="hidden" />
                </table>
            </form>
            <div class="display_none_p display_none_c payment_page_card"><img src="/img/card_pay_img2.png" /></div>
        </div>
        <div class="text_blue">При оплате заказа банковской картой ввод реквизитов карты происходит в системе электронных платежей ОАО АКБ «Авангард», который прошел сертификацию в платежных системах Visa и MasterCard. Представленные Вами данные полностью защищены и никто, включая наш интернет-магазин, не может их получить.</div>
    </div>
<?}?>
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>