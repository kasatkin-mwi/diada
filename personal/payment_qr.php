<?require($_SERVER['DOCUMENT_ROOT'] . '/bitrix/modules/main/include/prolog_before.php');?>
<?php

class AvangardQR {
    var $orderID;
    var $payerName;
    var $phoneNumber;

    function __construct($order, $payer_name='', $phone_number='') {
        $this->orderID = $order;
        $this->payerName = $payer_name;
        $this->phoneNumber = $phone_number;
    }

    //send request for reg
    function sendReg() {
        if (!CModule::IncludeModule('sale')) return false;

        if (!empty($this->orderID) && $this->orderID>0) {
            if ($order = \Bitrix\Sale\Order::load($this->orderID)) {
                $dbOrderProps = \Bitrix\Sale\PropertyValueCollection::getList([
                    'select' => ['*'],
                    'filter' => [
                        'ORDER_ID' => $this->orderID,
                        'CODE' => ['NAME', 'LOCATION', 'street', 'house_number', 'EMAIL', 'PHONE'],
                    ]
                ]);
                while ($resOrderProps = $dbOrderProps->fetch()) {
                    $arOrderProps[$resOrderProps['CODE']] = $resOrderProps['VALUE'];
                }

                if ($arOrderProps['LOCATION']) {
                    $arLocation = \Bitrix\Sale\Location\LocationTable::getByCode($arOrderProps['LOCATION'])->fetch();
                    $strLocation = '';
                    if ($arLocation) {
                        $res = \Bitrix\Sale\Location\LocationTable::getList(array(
                            'filter' => array(
                                '=ID' => $arLocation['ID'],
                                '=PARENTS.NAME.LANGUAGE_ID' => LANGUAGE_ID,
                                '=PARENTS.TYPE.NAME.LANGUAGE_ID' => LANGUAGE_ID,
                            ),
                            'select' => array(
                                'I_NAME_RU' => 'PARENTS.NAME.NAME',
                            ),
                            'order' => array(
                                'PARENTS.DEPTH_LEVEL' => 'asc'
                            )
                        ));
                        while ($item = $res->fetch()) {
                            $strLocation .= $item['I_NAME_RU'] . ", ";
                        }
                    }
                }

                $payerName = ($this->payerName) ? $this->payerName : $arOrderProps['NAME'];
                $phoneNumber = ($this->phoneNumber) ? $this->phoneNumber : $arOrderProps['PHONE'];

				$SUM = 0;
				$paymentSystem = $order->getPaymentCollection();
				foreach ($paymentSystem as $payment) {
					if (!$payment->isPaid()) {
						$SUM += $payment->getSum();
					}
				}

                //make xml
				$price = str_replace(",", ".", $SUM*100);
                $strXml = "xml=";
                $strXml .= "<?xml version='1.0' encoding='utf-8'?>";
                $strXml .= "<NEW_ORDER>";
                $strXml .= "<SHOP_ID>36472</SHOP_ID>";
                $strXml .= "<SHOP_PASSWD>wnxYdZeBRk</SHOP_PASSWD>";
                $strXml .= "<AMOUNT>{$price}</AMOUNT>";
                $strXml .= "<ORDER_NUMBER>{$order->getId()}</ORDER_NUMBER>";
                $strXml .= "<ORDER_DESCRIPTION>{$order->getId()} ({$order->getDateInsert()->toString()})</ORDER_DESCRIPTION>";
                $strXml .= "<LANGUAGE>".strtoupper(LANGUAGE_ID)."</LANGUAGE>";
                $strXml .= "<BACK_URL>https://{$_SERVER['SERVER_NAME']}</BACK_URL>";
				//$strXml .= "<BACK_URL_OK>https://{$_SERVER['SERVER_NAME']}/personal/payment_qr.php</BACK_URL_OK>";
				//$strXml .= "<BACK_URL_FAIL>https://{$_SERVER['SERVER_NAME']}/personal/payment_qr.php</BACK_URL_FAIL>";
                $strXml .= "<CLIENT_NAME>{$payerName}</CLIENT_NAME>";
                $strXml .= "<CLIENT_ADDRESS>{$strLocation} {$arOrderProps['street']} д.{$arOrderProps['house_number']} кв.{$arOrderProps['apartment']}</CLIENT_ADDRESS>";
                $strXml .= "<CLIENT_EMAIL>{$arOrderProps['EMAIL']}</CLIENT_EMAIL>";
                $strXml .= "<CLIENT_PHONE>{$phoneNumber}</CLIENT_PHONE>";
                $strXml .= "<CLIENT_IP>{$_SERVER['REMOTE_ADDR']}</CLIENT_IP>";
                $strXml .= "<IS_QR>1</IS_QR>";
                $strXml .= "</NEW_ORDER>";
				
				file_put_contents($_SERVER['DOCUMENT_ROOT']."/personal/log_qr.txt", $strXml."\n", FILE_APPEND | LOCK_EX);

                $url = "https://www.avangard.ru/qr_test_iacq/h2h/reg";
                $headers = [
                    'Content-type: application/x-www-form-urlencoded;charset=utf-8',
                    'Expect:'
                ];
                $curl_options = array (
                    CURLOPT_URL => $url,
                    CURLOPT_POST => true,
                    CURLOPT_RETURNTRANSFER => true,
                    CURLOPT_HTTPHEADER => $headers,
                    CURLOPT_POSTFIELDS => $strXml
                );
                $curl = curl_init() or die("cURL init error");
                curl_setopt_array($curl, $curl_options) or die("cURL set options error".curl_error($curl));
                $response = curl_exec($curl) or die ("cURL execute error ".curl_error($curl));
                curl_close($curl);

				file_put_contents($_SERVER['DOCUMENT_ROOT']."/personal/log_qr.txt", date('d.m.Y H:i'), FILE_APPEND | LOCK_EX);
				file_put_contents($_SERVER['DOCUMENT_ROOT']."/personal/log_qr.txt", $response, FILE_APPEND | LOCK_EX);

                return simplexml_load_string($response);
            } else {
                return "not order on site";
            }
        } else {
            return "not order id";
        }
    }

	public static function setPayOrder($order_id, $payment_id, $sum) {
		Bitrix\Main\Loader::includeModule("sale");
		$STATUS_MESS = "Номер платежа: ".$payment_id;
		$order = Bitrix\Sale\Order::load($order_id);
		$order_sum = 0;
		$paymentCollection = $order->getPaymentCollection();
		foreach ($paymentCollection as $key => $payment) {
			if (!$payment->isPaid()) {
				$order_sum += $payment->getSum();
			}
		}
		if ($order_sum <= $sum) {
			foreach ($paymentCollection as $key => $payment) {
				if (!$payment->isPaid()) {
					$payment->setField("PS_STATUS", "Y");
					$payment->setField("PS_STATUS_MESSAGE", $STATUS_MESS);
					$payment->setField("SUM", $payment->getSum());
					$payment->setPaid("Y");
				}
			}
			$order->save();
		}
	}

}

$order = intval($_REQUEST['order']);
$order_id_bank = intval($_REQUEST['order_number']);
if ($order) {
	$payer_name = trim($_REQUEST['payer_name']);
	$phone_number = trim($_REQUEST['phone_number']);
	$pay = new AvangardQR($order, $payer_name, $phone_number);
	$objAnswerReg = $pay->sendReg();
	if ($objAnswerReg->response_code == 0 && $objAnswerReg->ticket) {
		echo 'https://www.avangard.ru/qr_test_iacq/pay?ticket='.$objAnswerReg->ticket;
	} else {
		echo "error: ".$objAnswerReg;
	}
} elseif ($order_id_bank && $_REQUEST['status_code'] == 3) {
	AvangardQR::setPayOrder($order_id_bank, $_REQUEST['id'], $_REQUEST['amount']);
	file_put_contents($_SERVER['DOCUMENT_ROOT']."/personal/log_from_bank.txt", date('d.m.Y H:i'), FILE_APPEND | LOCK_EX);
	file_put_contents($_SERVER['DOCUMENT_ROOT']."/personal/log_from_bank.txt", print_r($_REQUEST, true), FILE_APPEND | LOCK_EX);
}

file_put_contents($_SERVER['DOCUMENT_ROOT']."/personal/log_request.txt", date('d.m.Y H:i'), FILE_APPEND | LOCK_EX);
file_put_contents($_SERVER['DOCUMENT_ROOT']."/personal/log_request.txt", print_r($_REQUEST, true), FILE_APPEND | LOCK_EX);
?>