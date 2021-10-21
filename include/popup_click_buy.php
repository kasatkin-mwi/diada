<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php")?>
<div id="for_ajax_click_buy">
    <?
    \Bitrix\Main\Loader::includeModule("sale");
    global $USER;
    $added = false;
    $passStr = '';
    $USER_ID = $USER->GetID();
    $request = \Bitrix\Main\Context::getCurrent()->getRequest();
    if (strlen($request->get("add_click_buy_order"))>0){
        $allRequestParam = $request->toArray();
        if (isset($allRequestParam["PROPERTY"]) && is_array($allRequestParam["PROPERTY"])){
            $error = array();
            /*if (!(strlen($allRequestParam["PROPERTY"]["NAME"])>0)){
                $error["NAME"] = true;
            }*/
            $allRequestParam["PROPERTY"]["PHONE"] = str_replace(array("+", " ", "(", ")", "-", '_'), '', $allRequestParam["PROPERTY"]["PHONE"]); 
            if (!(strlen($allRequestParam["PROPERTY"]["PHONE"]) > 0)){
                $error["PHONE"] = true;
            }
            if (count($error)==0){
                if (!$USER_ID) {
                    $pass = rand(100000, 999999);
                    $pass = 'AA' . $pass . 'zz';
                    $groups = array(5);

                    do {
                        $login = $allRequestParam["PROPERTY"]["PHONE"];//.'_'.randString(3);
                        $login .= '_' . randString(3);
                        $rsUser = CUser::GetByLogin($login);
                    }
                    while ($rsUser->Fetch());
                    $mail = $login . '@fastorderdiada.ru';
                    
                    if(!empty($allRequestParam["PROPERTY"]["PHONE"]))
                    {
                        $res = Bitrix\Main\UserTable::getRow(array(
                            'filter' => array(
                                'ACTIVE' => 'Y',
                                array(
                                    'LOGIC' => 'OR',
                                    '=PERSONAL_PHONE' => $allRequestParam["PROPERTY"]["PHONE"],
                                    '=PERSONAL_MOBILE' => $allRequestParam["PROPERTY"]["PHONE"]
                                )
                            ),
                            'select' => array('ID')
                        ));
                        if (isset($res['ID']))
                        {
                            $USER_ID = (int)$res['ID'];
                        }
                    }
                    if($USER_ID <= 0)
                    {
                        $user_fields = array(
                            "NAME" => $allRequestParam["PROPERTY"]["NAME"],
                            "EMAIL" => $mail,
                            "LOGIN" => $login,
                            "PERSONAL_PHONE" => $allRequestParam["PROPERTY"]["PHONE"],
                            "LID" => "ru",
                            "ACTIVE" => "Y",
                            "GROUP_ID" => $groups,
                            "PASSWORD" => $pass,
                            "CONFIRM_PASSWORD" => $pass,
                        );
                        $addIDuser = $USER->Add($user_fields);
                        $USER->Authorize($addIDuser);
                        $USER_ID = $USER->GetID();
                        $error_text = $USER->LAST_ERROR;
                        if($user_id > 0)
                        {
                            $passStr = " Ваш пароль для авторизации: $pass";
                        }    
                    }
                }
                if ($USER_ID>0) {
                    $order = Bitrix\Sale\Order::create(SITE_ID, IntVal($USER_ID));
                    $order->setPersonTypeId(1);
                    $order->setField('CURRENCY', "RUB");
                    $order->setField('USER_DESCRIPTION', "Быстрый заказ");
                    $basket = Bitrix\Sale\Basket::loadItemsForFUser(Bitrix\Sale\Fuser::getId(), SITE_ID);
                    $order->setBasket($basket);
                    $shipmentCollection = $order->getShipmentCollection();
                    $shipment = $shipmentCollection->createItem();
                    /**
                     * @var Bitrix\Sale\Shipment $payment
                     */
                    $shipment->setFields(array(
                        'DELIVERY_ID' => 23,
                    ));

                    $paymentCollection = $order->getPaymentCollection();
                    $payment = $paymentCollection->createItem();
                    $paySystemService = Bitrix\Sale\PaySystem\Manager::getObjectById(1);
                    /**
                     * @var Bitrix\Sale\Payment $payment
                     */
                    $payment->setFields(array(
                        'PAY_SYSTEM_ID' => $paySystemService->getField("PAY_SYSTEM_ID"),
                        'PAY_SYSTEM_NAME' => $paySystemService->getField("NAME"),
                        'SUM' => $order->getPrice(),
                        'CURRENCY' => $order->getCurrency(),
                    ));

                    $propertyCollection = $order->getPropertyCollection();
                    $listObjProps = array();
                    $property = $propertyCollection->getItemByOrderPropertyId(3)->setValue($allRequestParam["PROPERTY"]["NAME"]);
                    $property = $propertyCollection->getItemByOrderPropertyId(5)->setValue($allRequestParam["PROPERTY"]["PHONE"]);
                    $property = $propertyCollection->getItemByOrderPropertyId(6)->setValue($USER->GetEmail());
                    //$property = $propertyCollection->getItemByOrderPropertyId(17)->setValue(1317);
                    $property = $propertyCollection->getItemByOrderPropertyId(17)->setValue('0000073738');
                    $order->doFinalAction(true);
                    $result = $order->save();
                    $ORDER_ID = $order->getId();
                }
                if ($ORDER_ID>0):
                ?>
                    <div class="new_call_back_light dasket_one_click_popup" id="dasket_one_click_popup">
                        <div class="one_click_form_title">Заказать в 1 клик</div>
                        <div class="one_click_form_block success-block">
                            Заявка на быстрый заказ оформлена! Ваш заказ №<?=$ORDER_ID?><?=!empty($passStr) ? $passStr : ''?><br />Наши менеджеры свяжутся с вами в ближайшее время!
                        </div>
                    </div>
                <?
                endif;
                die();
            }
        }
    }
    ?>
    <div class="new_call_back_light dasket_one_click_popup" id="dasket_one_click_popup">
        <div class="one_click_form_title">Заказать в 1 клик</div>
        <div class="one_click_form_block">
            <form id="test" action="<?=$APPLICATION->GetCurPage()?>" class="one_click_popup">
                <div class="one_click_form_el">
                    <input type="text" <?if ($error["NAME"]):?>class="sal_error"<?endif;?> name="PROPERTY[NAME]" placeholder="Ваше имя" style="font-size: 20px;" value="<?=$allRequestParam["PROPERTY"]["NAME"]?>"/>
                </div>
                <div class="one_click_form_el">
                    <input type="text" class="required<?if ($error["PHONE"]):?> sal_error<?endif;?>" id="one_click_user_phone" name="PROPERTY[PHONE]" placeholder="Ваш телефон" style="font-size: 20px;" value="<?=$allRequestParam["PROPERTY"]["PHONE"]?>"/>
                    <script>
                        $(document).ready(function ($) {
                            //$('[name="PROPERTY[PHONE]"]').mask('+7 (999) 999-99-99');
                            maskAktive("",true,'[name="PROPERTY[PHONE]"]');
                            setTimeout(function(){
                                $('.one_click_popup input[name="PROPERTY[NAME]"]').focus();
                                $('.one_click_popup input[name="PROPERTY[PHONE]"]').after('<div class="sal_error_massage">Пожалуйста, проверьте правильность ввода номера телефона</div>');
                            }, 500);
                        });
                    </script>
                </div>
                <input class="red_button" name="add_click_buy_order" type="submit" value="Заказать"/>
            </form>
        </div>
    </div>
</div>