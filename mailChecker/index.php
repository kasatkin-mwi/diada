<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require_once(dirname(__FILE__).'/config.php');
if(!$_REQUEST['key'] || $_REQUEST['key']!=$config['key']) die();

require_once(dirname(__FILE__).'/phpmailer/Exception.php');
require_once(dirname(__FILE__).'/phpmailer/PHPMailer.php');
require_once(dirname(__FILE__).'/phpmailer/SMTP.php');

$result = ['success' => false, 'message' => '', 'code' => ''];

if(!isset($config['from']) && isset($_REQUEST['from'])) $config['from'] = $_REQUEST['from'];
if(!isset($config['to']) && isset($_REQUEST['to'])) $config['to'] = $_REQUEST['to'];
if(!isset($config['type']) && isset($_REQUEST['type'])) $config['type'] = $_REQUEST['type'];
if(!isset($config['host']) && isset($_REQUEST['host'])) $config['host'] = $_REQUEST['host'];
if(!isset($config['port']) && isset($_REQUEST['port'])) $config['port'] = $_REQUEST['port'];
if(!isset($config['login']) && isset($_REQUEST['login'])) $config['login'] = $_REQUEST['login'];
if(!isset($config['password']) && isset($_REQUEST['password'])) $config['password'] = $_REQUEST['password'];
if(!isset($config['timeout']) && isset($_REQUEST['timeout'])) $config['timeout'] = $_REQUEST['timeout'];

$config['secure_url_prefix'] = '';
$config['secure_type'] = '';
if(!isset($config['secure']) && isset($_REQUEST['secure'])){
    $config['secure'] = $_REQUEST['secure'];
    switch ($config['secure']) {
        case '1':
                $config['secure_url_prefix'] = 'ssl://'; $config['secure_type'] = 'ssl';
            break;
        case '2':
                $config['secure_url_prefix'] = 'tls://'; $config['secure_type'] = 'tls';
            break;
    }
}

if (!isset($config['type'])) $config['type'] = 0;

switch($config['type']){
    case 0:

        $headers = 'From: ' . $config['from'] . "\r\n" .
        'Date: '.date('r') . "\r\n" .
        'Content-Type: text/plain; charset=utf-8' . "\r\n" .
        'MIME-Version: 1.0' . "\r\n";

        if(mail($config['to'], $config['key'], $config['key'], $headers)){
            $result = ['success' => true, 'message' => 'Успешная отправтка', 'code' => '200'];
        }else $result = ['success' => false, 'message' => 'Ошибка отправки', 'code' => '221'];
    break;
    case 1:
        $mail = new PHPMailer(true);
        $mail->isSMTP();
        $mail->Host       = $config['host'];
        $mail->SMTPAuth   = true;
        $mail->Username   = $config['login'];
        $mail->Password   = $config['password'];
        if(isset($config['secure_type']) && !empty($config['secure_type'])) $mail->SMTPSecure = $config['secure_type'];
        $mail->Port       = $config['port'];

        $mail->setFrom($config['from']);
        $mail->addAddress($config['to']);
        $mail->Subject = $config['key'];
        $mail->Body    = $config['key'];

        if($mail->send()){
            $result = ['success' => true, 'message' => 'Успешная отправтка', 'code' => '200'];
        }else $result = ['success' => false, 'message' => 'Ошибка отправки', 'code' => '221'];
    break;
    case 2:
        $smtp_socket = fsockopen($config['secure_url_prefix'].$config['host'], $config['port']);
        $smtp_msg = '';
        while ($line = fgets($smtp_socket, 515)) {
            $smtp_msg .= $line;
            if (substr($line, 3, 1) == " ") break;
        }
        $answer = substr($smtp_msg, 0, 3);
        if($answer != '220'){ $result = ['success' => false, 'message' => 'Ошибка соединения', 'code' => '220']; break; }
        $answer = smtp_send_cmd($smtp_socket, 'HELO '.$_SERVER['SERVER_NAME']);  
        if($answer != '250'){ $result = ['success' => false, 'message' => 'Сервер не ответил на приветствие', 'code' => '250']; break; }

        $answer = smtp_send_cmd($smtp_socket, 'AUTH LOGIN'); 
        if($answer != '334'){ $result = ['success' => false, 'message' => 'Ошибка авторизации', 'code' => '334']; break; }

        $answer = smtp_send_cmd($smtp_socket, base64_encode($config['login'])); 
        if($answer != '334'){ $result = ['success' => false, 'message' => 'Ошибка авторизации', 'code' => '334']; break; }

        $answer = smtp_send_cmd($smtp_socket, base64_encode($config['password'])); 
        if($answer != '235'){ $result = ['success' => false, 'message' => 'Ошибка авторизации', 'code' => '334']; break; }

        $answer = smtp_send_cmd($smtp_socket, 'MAIL FROM:'.$config['from']); 
        if($answer != '250'){ $result = ['success' => false, 'message' => 'Ошибка передачи параметров', 'code' => '250']; break; }

        $answer = smtp_send_cmd($smtp_socket, 'RCPT TO:'.$config['to']); 
        if($answer != '250'){ $result = ['success' => false, 'message' => 'Ошибка передачи параметров', 'code' => '250']; break; }

        $answer = smtp_send_cmd($smtp_socket, "DATA");
        if($answer != '354'){ $result = ['success' => false, 'message' => 'Ошибка ввода сообщения', 'code' => '354']; break; }

        $msg = "Content-Type: text/html; charset=\"utf-8\"\r\n";
        $msg .= 'Subject: =?utf-8?B?'.base64_encode($config['key'])."=?=\r\n";

        fputs($smtp_socket, $msg.$config['key']."\r\n");
        $answer = smtp_send_cmd($smtp_socket, ".");
        $answer = smtp_send_cmd($smtp_socket, "QUIT");
        if($answer != '221'){ $result = ['success' => false, 'message' => 'Ошибка отправки', 'code' => '221']; break; }
        fclose($smtp_socket);
        $result = ['success' => true, 'message' => 'Успешная отправтка', 'code' => '200'];
    break;
}

function smtp_send_cmd($smtp_socket, $cmd) {
    $smtp_msg  = "";
    $smtp_code = "";
    fputs( $smtp_socket, $cmd."\r\n" ); 
    while ($line = fgets($smtp_socket, 515)) {
        $smtp_msg .= $line;
        if (substr($line, 3, 1) == " ") break;
    }
    $smtp_code = substr( $smtp_msg, 0, 3 ); 
    return $smtp_code=="" ? false : $smtp_code;
} 

echo json_encode($result);