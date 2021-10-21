<?if(!defined("B_PROLOG_INCLUDED")||B_PROLOG_INCLUDED!==true)die();
/**
 * Bitrix vars
 *
 * @var array $arParams
 * @var array $arResult
 * @var CBitrixComponent $this
 * @global CMain $APPLICATION
 * @global CUser $USER
 */
CModule::IncludeModule('iblock');
if(CModule::IncludeModule('subscribe'))
{
	if ($_REQUEST['action']=='add_to_subscribe')
	{
		$APPLICATION->RestartBuffer();
		header('Content-type: application/json');
        
        $email = $_REQUEST['mail'];
		if (trim($email) != '')
        {
			$st = check_email($email) ? 0 : 1;
			$rsAllRubrics = CRubric::GetList(array(),array("LID"=>SITE_ID, "ACTIVE"=>"Y"));
            $arAllRubricsID = array();
            while($arAllRubric = $rsAllRubrics->fetch())
                $arAllRubricsID[] = $arAllRubric['ID'];

            $arSubscriptionFields = array(
                "RUB_ID" => $arAllRubricsID,
                "SEND_CONFIRM" => "N",
                "EMAIL" => $email,
                "CONFIRMED" => "Y",
                "ACTIVE" => "Y"
            );

		    if ($st==1)
            {
                echo(json_encode(array('status'=>'ERROR', 'text'=>'<div style="padding:10px;color:red;text-align: center;
		        font-size: 16px;">'.$arParams['MAIL_STRING'].'</div>')));
			}
			else
            {    
                /*$is_emailExist = false;
                $regular = '/.*@(.*)/';
                preg_match($regular, $email, $match);
                $domain = $match[1];
                if(!empty($domain))
                {
                    $mx_records = dns_get_record($domain, DNS_MX);
                    $allRecords = array();
                    foreach($mx_records as $records)
                    {
                        $allRecords[$records['pri']] = $records;
                    }
                    unset($mx_records);
                    ksort($allRecords);
                    $firstRecord = array_shift($allRecords);
                    
                    unset($allRecords);
                    
                    $mx = $firstRecord['target'];
                    if(!empty($mx))
                    {
                        $socket = fsockopen( $mx, 25, $errno, $errstr, 30 );
                        usleep(10000000);
                        if( !$socket )
                        {
                            $is_emailExist = false;
                        }
                        else
                        {
                            $res = fgets($socket, 256); 
                            if(substr($res,0,3) != "220")
                            {
                                echo '<pre>'; echo '<br>'; var_export($res); echo '</pre>';      
                            }
                            else
                            {
                                $response = sWrite( $socket, "HELO www.diada-arms.ru\r\n" );
                                $responseResult = checkResponse($response);
                                if($responseResult)
                                {
                                    $response = sWrite( $socket, "MAIL FROM:<info@diada-arms.ru>\r\n" );   
                                    $responseResult = checkResponse($response);
                                    if($responseResult)
                                    {
                                        $response = sWrite( $socket, "NOOP\r\n" );
                                        $responseResult = checkResponse($response);   
                                        if($responseResult)
                                        {
                                            $response = sWrite( $socket, "RCPT TO:<$email>\r\n" );
                                            $responseResult = checkResponse($response); 
                                            if($responseResult)
                                            {
                                                $response = sWrite( $socket, "NOOP\r\n" );
                                                $responseResult = checkResponse($response);   
                                                if($responseResult)
                                                {
                                                    $response = sWrite( $socket, "RSET\r\n" );
                                                    $responseResult = checkResponse($response);   
                                                    
                                                    if($responseResult)
                                                    {     
                                                        $is_emailExist = true;     
                                                    }
                                                    else
                                                    {
                                                        $is_emailExist = false;    
                                                    }
                                                }   
                                                else
                                                {
                                                    $is_emailExist = false;   
                                                }
                                            }
                                            else
                                            {
                                                $is_emailExist = false;    
                                            }
                                        }
                                        else
                                        {
                                            $is_emailExist = false;    
                                        }
                                    }
                                    else
                                    {
                                        $is_emailExist = false;    
                                    }    
                                }
                                else
                                {
                                    $is_emailExist = false;    
                                }  
                            } 
                        }
                    }
                    else
                    {
                        $is_emailExist = false;
                    }    
                }
                else
                {
                    $is_emailExist = false;
                } 
                if(!$is_emailExist)
                {
                    echo(json_encode(array('status'=>'ERROR', 'text' => '<div style="padding:10px;color:red;text-align: center;font-size: 16px;">Введите существующий e-mail!</div>', 'request'=>$_REQUEST)));
                }
                else
                {*/
                    $subscr = CSubscription::GetList(
                        array("ID"=>"ASC"),
                        array("EMAIL"=>$email)
                    );
                    if($subscr_ = $subscr->Fetch())
                    {
                        echo(json_encode(array('status'=>'ERROR', 'text'=>'<div style="padding:10px;color:red;text-align: center;font-size: 16px;">'.$arParams['EXISTS_STRING'].'</div>')));
                    }
                    else
                    {
                        $newSubscriber = new CSubscription;
                        $newSubscriber->Add($arSubscriptionFields);
                        $user = 'igor-rk5@mail.ru';
                        $password = 'passworddiada';
                        $create_contact_url = 'https://esputnik.com/api/v1/contact';
                        $contact = new stdClass();
                        /*$contact->firstName = $first_name;
                        $contact->lastName = $last_name;*/
                        $contact->channels = array(array('type'=>'email', 'value' => $email));
                        $contact->groups = array(array('name'=>'Подписчики'));
                        send_request_esputnik($create_contact_url, $contact, $user, $password);
                        CEvent::Send("NEW_SUBSCRIBE_ESPUT", 's1', array('EMAIL'=>$email));
                        echo(json_encode(array('status'=>'OK', 'text'=>'<div style="padding:10px;color:green;text-align: center;font-size: 16px;">'.$arParams['OK_STRING'].'</div>', 'sub_id'=>(int)$ID)));

                    }    
                //}
                
			}
		}
		die();	
	}
	elseif($_REQUEST['action']=='delete_subscribe'){
        $email = $_REQUEST['mail'];
        if (trim($email)!=''){
            $st = check_email($email) ? 0 : 1;
            $rsAllRubrics = CRubric::GetList(array(),array("LID"=>SITE_ID, "ACTIVE"=>"Y"));
            $arAllRubricsID = array();
            while($arAllRubric = $rsAllRubrics->fetch())
                $arAllRubricsID[] = $arAllRubric['ID'];

            if ($st==1){
                echo(json_encode(array('status'=>'ERROR', 'text'=>'<div style="padding:10px;color:red;text-align: center;
		        font-size: 16px;">'.$arParams['MAIL_STRING'].'</div>')));
            }
            else{
                $subscr = CSubscription::GetList(
                    array("ID"=>"ASC"),
                    array("EMAIL"=>$email)
                );
                if($subscr_ = $subscr->Fetch()){
                    CSubscription::Delete($subscr_["ID"]);
                    $user = 'igor-rk5@mail.ru';
                    $password = 'passworddiada';
                    $create_contact_url = 'https://esputnik.com/api/v1/emails/unsubscribed/delete';
                    $contact = new stdClass();
                    $contact->emails = array($email);
                    send_request_esputnik($create_contact_url, $contact, $user, $password);
                    ?>
                    <script>
                        $.fancybox({content: '<div style="padding:10px;color:green;text-align: center;font-size: 16px;">'+'<?=$arParams['OK_DELETE_SUB']?>'+'</div>'})
                    </script>
                    <?
                    //echo(json_encode(array('status'=>'OK', 'text'=>'<div style="padding:10px;color:green;text-align: center;font-size: 16px;">'.$arParams['OK_DELETE_SUB'].'</div>', 'sub_id'=>(int)$ID, 'request'=>$_REQUEST)));
                }
                else{
                }
            }
        }
    }
} 
$this->IncludeComponentTemplate();