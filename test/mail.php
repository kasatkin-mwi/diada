<?
// mail("ser.sanamjantz@yandex.ru", "Diada-Arms.ru", "message test");
$to = 'ser.sanamjantz@yandex.ru';
$subject = 'Diada-Arms.ru';
$message = 'message test';
$headers = 'From: info@'. $_SERVER['HTTP_HOST'] . "\r\n" .
    'Reply-To: info@'. $_SERVER['HTTP_HOST'] . "\r\n" .
    'X-Mailer: PHP/' . phpversion();
if( mail($to,$subject,$message,$headers) ){
    echo 'Успешно отправлено!';
}else{
    echo 'отправка не удалась!';
}
?>