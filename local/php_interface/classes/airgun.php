<?
use Bitrix\Sale;

class Airgun {

	private $airBDUser;
	private $airBDBaza;
	private $airBDPassword;
	public $mysqli;
	public $DOCUMENT_ROOT;
	public $LOG_FILE;
	
	public $IBLOCK_ID;
	public $arAirSections;
	public $arAirElements;
	public $arBitrixElements;
	public $arBitrixSections;
	public $arBitrixUsers;
	public $arAirUsers;
	
	private $airHost;

	public function init()
	{
		CModule::IncludeModule("iblock");
		CModule::IncludeModule("catalog");
		CModule::IncludeModule("sale");
	
		$this -> airBDUser 		= 'airgun_prim';
		$this -> airBDBaza 		= 'airgun_prim';
		$this -> airBDPassword  = 'JoH%9yWi';
		$this -> DOCUMENT_ROOT 	= '/var/www/air-gun.mwi.me/data/www/air-gun.mwi.me';
		$this -> LOG_FILE 		= $this -> DOCUMENT_ROOT . '/upload/log_up.txt';
		$this -> airHost 		= 'https://www.air-gun.ru/bx_order.php';
		$this -> airOrderInfo 	= 'https://www.air-gun.ru/bx_payorder.php';
		$this -> airCheckPay 	= 'https://www.air-gun.ru/bx_checkpay.php';
		$this -> airInfoOrderInfo 	= 'https://www.air-gun.ru/bx_diadaorder.php';
		$this -> airSearch 		= 'https://www.air-gun.ru/bx_search.php';
		$this -> airData		= 'https://www.air-gun.ru/bx_data.php';
		$this -> airPrint		= 'https://www.air-gun.ru/prints/print_kwi';
		
		$this -> SECTION_FILE 	= $this -> DOCUMENT_ROOT . '/local/tmp/sections.txt';
		$this -> SECTION_FILE_GOOD 	= $this -> DOCUMENT_ROOT . '/local/tmp/sections_good.txt';
		$this -> UP_GOODS 		= $this -> DOCUMENT_ROOT . '/local/tmp/up_goods.txt';
		
		$this -> IBLOCK_ID  	= 1;
		
		//$this -> addToLog( 'start' );
		
	}
	
	public function setConnectionBD(){
		$this -> mysqli = new mysqli('airgun.beget.tech', $this -> airBDUser, $this -> airBDPassword, $this -> airBDBaza);
		if ($this -> mysqli->connect_error) 
			die("Ошибка: " . $link->connect_error);
	}
	
	public function closeConnectionBD(){
		$this -> mysqli -> close();
	}
	
	public function addToLog( $str ){
		$fileLog = $this -> LOG_FILE;
		$fp = fopen($fileLog, 'a');
		fwrite($fp, $str . PHP_EOL);
		fclose($fp);	
	}
	
		
	public function getOrderFromAir( $orderID ){ 
		if( $curl = curl_init() ) {
			$bank = file_get_contents( $_SERVER["DOCUMENT_ROOT"]."/include/bank.php");
			curl_setopt($curl, CURLOPT_URL, $this -> airOrderInfo);
			curl_setopt($curl, CURLOPT_RETURNTRANSFER,true);
			curl_setopt($curl, CURLOPT_POST, true);
			curl_setopt($curl, CURLOPT_POSTFIELDS, http_build_query( Array('info_order' => $orderID, 'bank' => $bank) ) );
			$out = curl_exec($curl);
			curl_close($curl);
			echo $out;
		}
	}
	
	public function getInfoOrderFromAir( $orderID ){ 
		if( $curl = curl_init() ) {
			curl_setopt($curl, CURLOPT_URL, $this -> airInfoOrderInfo);
			curl_setopt($curl, CURLOPT_RETURNTRANSFER,true);
			curl_setopt($curl, CURLOPT_POST, true);
			curl_setopt($curl, CURLOPT_POSTFIELDS, http_build_query( Array('info_order' => $orderID) ) );
			$out = curl_exec($curl);
			curl_close($curl);
			echo $out;
		}
	}
	
	public function sendOrderToAir( $orderID ){
	
		
	
		$arOrder = Array();
		$order = Sale\Order::load($orderID);
		$arOrder['ID'] = $order->getId();
		$arOrder['SUM'] = $order->getPrice();
		$arOrder['COMMENT'] = $order->getField('USER_DESCRIPTION');
		$arOrder['DELIVERY_PRICE'] = $order->getDeliveryPrice();
		$paymentIds = $order->getPaymentSystemId();
		$this -> setConnectionBD();
		
		$arOrder['PAYMENT_ID'] = 4;
		$arOrder['id_user'] = 1;
		$arOrder['id_org'] = 14;
		$arOrder['id_type_pay'] = 4;

		
		
		$propertyCollection = $order->getPropertyCollection();
		$arFields = $propertyCollection->getArray();
		$arProps = array();
		
		foreach ( $arFields['properties'] as $arField){
			if ( $arField['VALUE'][0] ){
				$arProps[$arField['CODE']] =  $arField['VALUE'][0];
			}
		}
		$arOrder['PROP'] = $arProps;
		
		$deliveryIds = $order->getDeliverySystemId();
		$deliveryAr = \Bitrix\Sale\Delivery\Services\Manager::getById($deliveryIds[0]);
		$arOrder['DELIVERY_ID'] = $deliveryAr['XML_ID'];
		
		if ( $deliveryAr['PARENT_ID'] !== 44 ){
			$arOrder['TK'] = $deliveryAr['XML_ID'];
			$arOrder['PROP']['street'] = $arOrder['PROP']['PVZ_ADR'];
		}	
		
		
		
		
		$res = \Bitrix\Sale\Location\LocationTable::getList(array(
			'filter' => array('=CODE' => $arOrder['PROP']['LOCATION'], '=NAME.LANGUAGE_ID' => 'ru', '=PARENT.NAME.LANGUAGE_ID' => 'ru'),
			'select' => array(
				'NAME_RU' => 'NAME.NAME',
				'PARENT.*',
				'REGION_RU' => 'PARENT.NAME.NAME',
			)
		));
		if ($item = $res->fetch()) {
			$arOrder['PROP']['city'] = $item['NAME_RU']; 
			$arOrder['PROP']['region'] = 'Регион:' . $item['REGION_RU'] . ' г.:' . $item['NAME_RU']; 

		} 
		$arOrder['PROP']['email'] = $arOrder['PROP']['EMAIL']; 
		$arOrder['PROP']['street'] = $arOrder['PROP']['ADDRESS'];  
		
		$arBasket = Array();
		$basket = $order->getBasket();
		$basketItems = $basket->getBasketItems();
		foreach ($basket as $basketItem) {
			
			$this -> setConnectionBD();
			$my_data = $this -> mysqli -> query("SELECT * FROM `tovars` WHERE `diada_id` = {$basketItem->getProductId()} LIMIT 1");
			foreach ($my_data as $key => $row) {
				$item = (array)$row;
				$arBasket[$item['id']] = $basketItem->getQuantity();
			}
			$this -> closeConnectionBD();
			
		}
		$arOrder['BASKET'] = $arBasket;
		$arOrder['refid'] = 'diada';
		$arOrder['new_order'] = 'Y';
		
		
		$air_number = $this -> sendDataToAir( $arOrder );
		$order->setField('ACCOUNT_NUMBER', $air_number);
		
		/*
		$propertyCollection = $order->getPropertyCollection();
		$namePropValue = $propertyCollection->getItemByOrderPropertyId(1);
		if ( $namePropValue->getValue() == '' ){
			$namePropValue->setValue('Не определен')->save();
		}
		$namePropValue = $propertyCollection->getItemByOrderPropertyId(8);
		if ( $namePropValue->getValue() == '' ){
			$namePropValue->setValue('no-reply@air-gun.ru')->save();
		}
		*/
		
		$order->save();

	}
	
	
	
	public function sendPaymentToAir( $orderID, $summ = '' ){
	
		$arFields['info_order'] = $orderID;
		
		if( $curl = curl_init() ) {
			curl_setopt($curl, CURLOPT_URL, $this -> airCheckPay);
			curl_setopt($curl, CURLOPT_RETURNTRANSFER,true);
			curl_setopt($curl, CURLOPT_POST, true);
			curl_setopt($curl, CURLOPT_POSTFIELDS, http_build_query( $arFields ) );
			$out = curl_exec($curl);
			curl_close($curl);
			$arElements = Array();
			$arEls = json_decode($out);
			return $arEls;
		}
	

	
	}
	
	
	public function sendDataToAir( $arFields ){
		if( $curl = curl_init() ) {
			curl_setopt($curl, CURLOPT_URL, $this -> airHost);
			curl_setopt($curl, CURLOPT_RETURNTRANSFER,true);
			curl_setopt($curl, CURLOPT_POST, true);
			curl_setopt($curl, CURLOPT_POSTFIELDS, http_build_query( $arFields ) );
			$out = curl_exec($curl);
			curl_close($curl);
			return $out;
		}
	} 
	
	
	public function GetDataAir( $id, $action ){
		$arFields['id'] = $id;
		$arFields['action'] = $action;
		
		if( $curl = curl_init() ) {
			curl_setopt($curl, CURLOPT_URL, $this -> airData);
			curl_setopt($curl, CURLOPT_RETURNTRANSFER,true);
			curl_setopt($curl, CURLOPT_POST, true);
			curl_setopt($curl, CURLOPT_POSTFIELDS, http_build_query( $arFields ) );
			$out = curl_exec($curl);
			curl_close($curl);
			$arElements = Array();
			$arEls = json_decode($out);
			//foreach ( $arEls as $xml_id ){
			//	$arElements[] = $this -> getElementID($xml_id);
			//}
			
			return $arEls;
		}
	} 
	
	public function GetPrintAir( $hash ){
		$arFields['hash'] = $hash;
		$arFields['diada'] = "Y";
		//return file_get_contents( $this -> airPrint . '?hash='.$hash);
		
		if( $curl = curl_init() ) {
			curl_setopt($curl, CURLOPT_URL, $this -> airPrint);
			curl_setopt($curl, CURLOPT_RETURNTRANSFER,true);
			curl_setopt($curl, CURLOPT_POST, true);
			curl_setopt($curl, CURLOPT_POSTFIELDS, http_build_query( $arFields ) );
			$out = curl_exec($curl);
			curl_close($curl);
			return $out;
		}
		
	} 
	
	public function sendJalobaToAir( $arFields ){
		$this -> setConnectionBD();
		$this -> mysqli -> query("INSERT INTO `jaloba` (`name`, `email`, `phone`, `text`) VALUES ('{$arFields['name']}', '{$arFields["mail"]}', '{$arFields["telefon"]}', '{$arFields["text"]}')");
		$this -> closeConnectionBD();
	}

	
	

	
}?>