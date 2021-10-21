<?require_once($_SERVER['DOCUMENT_ROOT'] . "/bitrix/modules/main/include/prolog_before.php");
use Bitrix\Sale;
CModule::IncludeModule("sale");

global $config;
include_once $_SERVER["DOCUMENT_ROOT"]."/bitrix/php_interface/include/easyway.php";

if(!empty($_POST['status']))
{   
    $ORDER_ID = $_POST['status']; 
    $result = array();
    $statusesList = array();
    $obOrderChange = \Bitrix\Sale\Internals\OrderChangeTable::getList(array(
        'order' => array(
            'DATE_CREATE' => 'DESC',
            'ID' => 'DESC'
        ),
        'filter' => array(
            'ORDER_ID' => $ORDER_ID, 
            'TYPE' => 'ORDER_STATUS_CHANGED'
        )
    ));
    while($historyItem = $obOrderChange->fetch())
    {
        $statusData = unserialize($historyItem['DATA']);
        $statusesList[] = $statusData['STATUS_ID'];
    }
	if ( empty( $statusesList ) ){
		$airgun = new Airgun();
		$airgun -> init();
		$airgun -> getInfoOrderFromAir( $_POST['status'] );
		$order = Sale\Order::loadByAccountNumber( $_POST['status'] );
		if ( $order)
		if ( !$order->isPaid() ){
			echo '<br><h3>Оплата заказа:</h3>';
			$airgun -> getOrderFromAir( $_POST['status'] );
		}
	
	}
	else {

		
		
		/*if($_SERVER['REMOTE_ADDR'] == '134.249.183.232')
		{
			echo '<pre>'; var_export($statusesList); echo '</pre>'; die;
		} */
		/*if(!empty($statusesList))
		{*/
			if(in_array('EW', $statusesList))
			{
				$ew = new EWConnector($config["url"], $config["user"], $config["pass"]);
			
				$result = $ew->getOrderInfo(array($ORDER_ID));
				if(!empty($result[0]))
				{
					$result = $ew->getStatus(array($result[0]['clientId']));
					if($result[0]['clientId'] == $ORDER_ID)
					{
						$newResult = array();
						$newResult[] = $result[0];
						$result = $newResult;
						unset($newResult); 
					}
					//echo '<pre>'; echo '<br>'; var_export($result); echo '</pre>'; die;
				}
				
				if(!empty($result))
				{
					?>
					
					<div>
						<div class="zak_status_list">
							<?
							foreach($result as $res)
							{
								?>
								<div class="zak_status_el">
									<div>Дата</div>
									<div><?=$res["date"]?></div>
								</div>
								<div class="zak_status_el">
									<div>Статус</div>
									<div><?=$res["status"]?></div>
								</div>
								<div class="zak_status_el">
									<div>Дата доставки</div>
									<div><?=$res["arrivalPlanDateTime"]?></div>
								</div>
								<div class="zak_status_el">
									<div>Дата заказа</div>
									<div><?=$res["dateOrder"]?></div>
								</div>
								<div class="zak_status_el">
									<div>Город отправления</div>
									<div><?=$res["sender"]?></div>
								</div>
								<div class="zak_status_el">
									<div>Город получения</div>
									<div><?=$res["receiver"]?></div>
								</div>
								<div class="zak_status_el">
									<div>Трек номер</div>
									<div><?=$res["carrierTrackNumber"]?></div>
								</div>
								<div class="zak_status_el">
									<div>Адрес</div>
									<div><?=$res["address"]?></div>
								</div>
								<div class="zak_status_el">
									<div>Тип доставки</div>
									<div><?=$res["deliveryType"]?></div>
								</div>
								<div class="zak_status_el">
									<div>Телефон</div>
									<div><?=$res["phone"]?></div>
								</div>
								<?       
							}
							?>
						</div>
					</div>
					<?
				}    
			}
			if(in_array('GR', $statusesList))
			{
				global $api_key;

				$check_order = "<File>
					<API>".$api_key."</API>
					<Method>orderinformation</Method>
					<Orders>
					<Order>".$ORDER_ID.'ЭВР'."</Order>
					</Orders>
				</File>";
				$url = 'http://api.grastin.ru/api.php';
				$ch = curl_init();
				curl_setopt($ch,CURLOPT_URL, $url);
				curl_setopt($ch,CURLOPT_POST, 1);
				curl_setopt($ch,CURLOPT_POSTFIELDS, 'XMLPackage='.urlencode($check_order));
				curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
				curl_setopt($ch, CURLOPT_HEADER, 0);
				curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
				$arCheckResult = curl_exec($ch);
				curl_close($ch);

				$orderResult = simplexml_load_string($arCheckResult);

				if(!empty($orderResult))
				{
					$order = Bitrix\Sale\Order::load($ORDER_ID);
					$propertyCollection = $order->getPropertyCollection();
					
					$postService = $propertyCollection->getItemByOrderPropertyId(36)->getValue();
					$service = $propertyCollection->getItemByOrderPropertyId(31)->getValue();
					
					$office = "";
					$trackingUrl = "";
					$office = $propertyCollection->getItemByOrderPropertyId(38)->getViewHtml();

					if(!empty($postService))
					{
						$office = "Почта России";     
					}
					
					if(empty($office))
					{
						if($orderResult->Order->DeliveryRegion == "Почта")
						{
							$office = "Почта России";    
						}    
						elseif(preg_match("/РАТЭК|СДЭК|Деловые Линии|ЖелДор|ПЭК|КИТ|Энергия|МАС-Хэндлинг/", $orderResult->Order->GeographicArea,$matches))
						{
							$office = $matches[0];    
						}
					}
					$track_number = "";
					if(!empty(current($orderResult->Order->TrackingNumber)))
					{
						$track_number = current($orderResult->Order->TrackingNumber);        
					}
					
					if(!empty($office))
					{
						switch ($office) 
						{
							case "РАТЭК":
								$trackingUrl = 'http://www.rateksib.ru/';
								break;
							case "СДЭК":
								$trackingUrl = 'https://www.cdek.ru/track.htm?order_id='.$track_number;
								break;
							case "Деловые Линии":
								$trackingUrl = 'https://www.dellin.ru/tracker/?rwID='.$track_number;
								break;
							case "ЖелДор":
								$trackingUrl = 'https://i.jde.ru/track/?ttn='.$track_number;
								break;
							case "ПЭК":
								$trackingUrl = 'https://kabinet.pecom.ru/status';
								break;
							case "КИТ":
								$trackingUrl = 'https://moscow.tk-kit.ru/';
								break;
							case "Энергия":
								$trackingUrl = 'https://nrg-tk.ru/client/tracking/';
								break;
							case "МАС-Хэндлинг":
								$trackingUrl = 'http://www.mashandling.ru/services/';
								break;
							case "Почта России":
								$trackingUrl = 'https://www.pochta.ru/TRACKING#'.$track_number;
								break;
						}
					}
					?>
					<div>
						<div class="zak_status_list">
							<?
							foreach($orderResult as $res)
							{   
								?>
								<div class="zak_status_el">
									<div>Дата статуса</div>
									<div><?=current($res->StatusDateTime)?></div>
								</div>
								<div class="zak_status_el">
									<div>Статус</div>
									<div><?=current($res->Status)?></div>
								</div>
								<div class="zak_status_el">
									<div>Дата доставки</div>
									<div><?=current($res->DateDelivery)?></div>
								</div>
								<div class="zak_status_el">
									<div>Регион доставки</div>
									<div><?=current($res->DeliveryRegion)?></div>
								</div>
								<div class="zak_status_el">
									<div>Трек номер</div>
									<div><?=current($res->TrackingNumber)?></div>
								</div>
								<?
								if(!empty($office))
								{
									?>
									<div class="zak_status_el">
										<div>Служба доставки</div>
										<div>
											<?=$office?>
											<?
											if(!empty($trackingUrl))
											{
												?>
												<div><a href="<?=$trackingUrl?>" target="_blank">Отследить посылку</a></div>
												<?
											}
											?>
										</div>
									</div>
									<?    
									
								}
								if($res->IsSelfPickup == "true")
								{
									?>
									<div class="zak_status_el">
										<div>Тип доставки</div>
										<div>Самовывоз</div>
									</div>
									<?    
								}
								else
								{
									?>
									<div class="zak_status_el">
										<div>Тип доставки</div>
										<div>Доставка</div>
									</div>
									<?    
								}       
							}
							?>
						</div>
					</div>
					<?   
				}    
			}
			else
			{
				$api_token = trim(COption::GetOptionString('up.boxberrydelivery', 'API_TOKEN'));
				$api_url = trim(COption::GetOptionString('up.boxberrydelivery', 'API_URL'));
			
				$url = $api_url.'?token='.$api_token.'&method=ListStatuses&ImId='.$ORDER_ID;
				$handle = fopen($url, "rb");
				$contents = stream_get_contents($handle);
				fclose($handle);
				$data = json_decode($contents,true);
				if(count($data) <= 0 || $data['err'])
				{
					//echo $data[0]['err'];
				}
				else
				{
					$result = $data[count($data)-1];
				}   
				
				if(!empty($result))
				{
					?>
					<div>
						<div class="zak_status_list">
							<div class="zak_status_el">
								<div>Дата</div>
								<div><?=htmlspecialcharsbx(date("d.m.Y H:i:s", strtotime($result["Date"])))?></div>
							</div>
							<div class="zak_status_el">
								<div>Статус</div>
								<div><?=htmlspecialcharsbx($result["Name"])?></div>
							</div>
							<div class="zak_status_el">
								<div>Комментарий</div>
								<div><?=htmlspecialcharsbx($result["Comment"])?></div>
							</div>
						</div>
					</div>
					<?   
				}        
			}
			if(empty($result) && empty($orderResult))
			{
				if (!($arOrder = CSaleOrder::GetByID($ORDER_ID)))
				{
					?>
					<div>
						<div class="zak_status_list">
							Заказ с кодом <?=htmlspecialcharsbx($ORDER_ID)?> не найден
						</div>
					</div>
					<?
				}
				else
				{
					if ($arStatus = CSaleStatus::GetByID($arOrder["STATUS_ID"]))
					{
						?>
						<div>
							<div class="zak_status_list">
								<div class="zak_status_el">
									<div>Статус</div>
									<div><?=$arStatus["NAME"]?></div>
								</div>   
							<?
							if ($arStatus["DESCRIPTION"])
							{
							?>
								<div class="zak_status_el">
									<div>Описание</div>
									<div><?=$arStatus["DESCRIPTION"]?></div>
								</div>   
							<?
							}
						   ?>
					   </div>
					</div><?
					}
				}
			}    
		/*}
		else
		{
			?>
			<div>
				<div class="zak_status_list">
					Заказ с кодом <?=$ORDER_ID?> не найден
				</div>
			</div>
			<?    
		}*/
		//echo '<pre>'; echo '<br>'; var_export($statusesList); echo '</pre>'; 
		/*else
		{
			$api_token = trim(COption::GetOptionString('up.boxberrydelivery', 'API_TOKEN'));
			$api_url = trim(COption::GetOptionString('up.boxberrydelivery', 'API_URL'));
		
			$url = $api_url.'?token='.$api_token.'&method=ListStatuses&ImId='.$ORDER_ID;
			$handle = fopen($url, "rb");
			$contents = stream_get_contents($handle);
			fclose($handle);
			$data = json_decode($contents,true);
			if(count($data) <= 0 || $data['err'])
			{
				//echo $data[0]['err'];
			}
			else
			{
				$result = $data[count($data)-1];
			}   
			
			if(!empty($result))
			{
				?>
				<div>
					<div class="zak_status_list">
						<div class="zak_status_el">
							<div>Дата</div>
							<div><?=date("d.m.Y H:i:s", strtotime($result["Date"]))?></div>
						</div>
						<div class="zak_status_el">
							<div>Статус</div>
							<div><?=$result["Name"]?></div>
						</div>
						<div class="zak_status_el">
							<div>Комментарий</div>
							<div><?=$result["Comment"]?></div>
						</div>
					</div>
				</div>
				<?   
			}
			else
			{
				$ew = new EWConnector($config["url"], $config["user"], $config["pass"]);
				
				$result = $ew->getOrderInfo(array($ORDER_ID));
				if(!empty($result[0]))
				{
					$result = $ew->getStatus(array($result[0]['clientId']));
				}
				
				if(!empty($result))
				{
					?>
					
					<div>
						<div class="zak_status_list">
							<?
							foreach($result as $res)
							{
								?>
								<div class="zak_status_el">
									<div>Дата</div>
									<div><?=$res["date"]?></div>
								</div>
								<div class="zak_status_el">
									<div>Статус</div>
									<div><?=$res["status"]?></div>
								</div>
								<div class="zak_status_el">
									<div>Дата доставки</div>
									<div><?=$res["arrivalPlanDateTime"]?></div>
								</div>
								<div class="zak_status_el">
									<div>Дата заказа</div>
									<div><?=$res["dateOrder"]?></div>
								</div>
								<div class="zak_status_el">
									<div>Город отправления</div>
									<div><?=$res["sender"]?></div>
								</div>
								<div class="zak_status_el">
									<div>Город получения</div>
									<div><?=$res["receiver"]?></div>
								</div>
								<div class="zak_status_el">
									<div>Трек номер</div>
									<div><?=$res["carrierTrackNumber"]?></div>
								</div>
								<div class="zak_status_el">
									<div>Адрес</div>
									<div><?=$res["address"]?></div>
								</div>
								<div class="zak_status_el">
									<div>Тип доставки</div>
									<div><?=$res["deliveryType"]?></div>
								</div>
								<div class="zak_status_el">
									<div>Телефон</div>
									<div><?=$res["phone"]?></div>
								</div>
								<?       
							}
							?>
						</div>
					</div>
					<?
				}
				else
				{
					global $api_key;

					$check_order = "<File>
						<API>".$api_key."</API>
						<Method>orderinformation</Method>
						<Orders>
						<Order>".$ORDER_ID.'ЭВР'."</Order>
						</Orders>
					</File>";
					$url = 'http://api.grastin.ru/api.php';
					$ch = curl_init();
					curl_setopt($ch,CURLOPT_URL, $url);
					curl_setopt($ch,CURLOPT_POST, 1);
					curl_setopt($ch,CURLOPT_POSTFIELDS, 'XMLPackage='.urlencode($check_order));
					curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
					curl_setopt($ch, CURLOPT_HEADER, 0);
					curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
					$arCheckResult = curl_exec($ch);
					curl_close($ch);

					$orderResult = simplexml_load_string($arCheckResult);

					if(!empty($orderResult))
					{
						$order = Bitrix\Sale\Order::load($ORDER_ID);
						$propertyCollection = $order->getPropertyCollection();
						
						$postService = $propertyCollection->getItemByOrderPropertyId(36)->getValue();
						$service = $propertyCollection->getItemByOrderPropertyId(31)->getValue();
						
						$office = "";
						$trackingUrl = "";
						$office = $propertyCollection->getItemByOrderPropertyId(38)->getViewHtml();

						if(!empty($postService))
						{
							$office = "Почта России";     
						}
						
						if(empty($office))
						{
							if($orderResult->Order->DeliveryRegion == "Почта")
							{
								$office = "Почта России";    
							}    
							elseif(preg_match("/РАТЭК|СДЭК|Деловые Линии|ЖелДор|ПЭК|КИТ|Энергия|МАС-Хэндлинг/", $orderResult->Order->GeographicArea,$matches))
							{
								$office = $matches[0];    
							}
						}
						$track_number = "";
						if(!empty(current($orderResult->Order->TrackingNumber)))
						{
							$track_number = current($orderResult->Order->TrackingNumber);        
						}
						
						if(!empty($office))
						{
							switch ($office) 
							{
								case "РАТЭК":
									$trackingUrl = 'http://www.rateksib.ru/';
									break;
								case "СДЭК":
									$trackingUrl = 'https://www.cdek.ru/track.htm?order_id='.$track_number;
									break;
								case "Деловые Линии":
									$trackingUrl = 'https://www.dellin.ru/tracker/?rwID='.$track_number;
									break;
								case "ЖелДор":
									$trackingUrl = 'https://i.jde.ru/track/?ttn='.$track_number;
									break;
								case "ПЭК":
									$trackingUrl = 'https://kabinet.pecom.ru/status';
									break;
								case "КИТ":
									$trackingUrl = 'https://moscow.tk-kit.ru/';
									break;
								case "Энергия":
									$trackingUrl = 'https://nrg-tk.ru/client/tracking/';
									break;
								case "МАС-Хэндлинг":
									$trackingUrl = 'http://www.mashandling.ru/services/';
									break;
								case "Почта России":
									$trackingUrl = 'https://www.pochta.ru/TRACKING#'.$track_number;
									break;
							}
						}
						?>
						<div>
							<div class="zak_status_list">
								<?
								foreach($orderResult as $res)
								{   
									?>
									<div class="zak_status_el">
										<div>Дата статуса</div>
										<div><?=current($res->StatusDateTime)?></div>
									</div>
									<div class="zak_status_el">
										<div>Статус</div>
										<div><?=current($res->Status)?></div>
									</div>
									<div class="zak_status_el">
										<div>Дата доставки</div>
										<div><?=current($res->DateDelivery)?></div>
									</div>
									<div class="zak_status_el">
										<div>Регион доставки</div>
										<div><?=current($res->DeliveryRegion)?></div>
									</div>
									<div class="zak_status_el">
										<div>Трек номер</div>
										<div><?=current($res->TrackingNumber)?></div>
									</div>
									<?
									if(!empty($office))
									{
										?>
										<div class="zak_status_el">
											<div>Служба доставки</div>
											<div>
												<?=$office?>
												<?
												if(!empty($trackingUrl))
												{
													?>
													<div><a href="<?=$trackingUrl?>" target="_blank">Отследить посылку</a></div>
													<?
												}
												?>
											</div>
										</div>
										<?    
										
									}
									if($res->IsSelfPickup == "true")
									{
										?>
										<div class="zak_status_el">
											<div>Тип доставки</div>
											<div>Самовывоз</div>
										</div>
										<?    
									}
									else
									{
										?>
										<div class="zak_status_el">
											<div>Тип доставки</div>
											<div>Доставка</div>
										</div>
										<?    
									}       
								}
								?>
							</div>
						</div>
						<?   
					}
					else
					{
						if (!($arOrder = CSaleOrder::GetByID($ORDER_ID)))
						{
							?>
							<div>
								<div class="zak_status_list">
									Заказ с кодом <?=$ORDER_ID?> не найден
								</div>
							</div>
							<?
						}
						else
						{
							if ($arStatus = CSaleStatus::GetByID($arOrder["STATUS_ID"]))
							{
								?>
								<div>
									<div class="zak_status_list">
										<div class="zak_status_el">
											<div>Статус</div>
											<div><?=$arStatus["NAME"]?></div>
										</div>   
									<?
									if ($arStatus["DESCRIPTION"])
									{
									?>
										<div class="zak_status_el">
											<div>Описание</div>
											<div><?=$arStatus["DESCRIPTION"]?></div>
										</div>   
									<?
									}
								   ?>
							   </div>
							</div><?
							}
						}    
					}
				}    
			}    
		}*/
	}
}
?>
<style>
	.cart-wrap .row {
		display: flex;
	}
	.cart-wrap .row div{
		text-align: center;
	}
</style>
<?require_once($_SERVER['DOCUMENT_ROOT'] . "/bitrix/modules/main/include/epilog_after.php");?>