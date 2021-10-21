<?
include($_SERVER['DOCUMENT_ROOT'].'/bitrix/php_interface/include/mail_attach.php');

$page = $_REQUEST['page'];
unset($_REQUEST['page']);
unset($_POST['page']);

include($_SERVER['DOCUMENT_ROOT'].'/bitrix/modules/main/include/prolog_before.php');

CModule::IncludeModule('iblock');

$filename = $_SERVER['DOCUMENT_ROOT'].'/upload/'.time().CUSER::GetID();
file_put_contents($filename, $page);

$filename = Array($filename);
if (file_exists($_REQUEST['filename2']))
    $filename[] = $_REQUEST['filename2'];  

$arEventFields = Array(
    'EMAIL_FROM' => $_REQUEST['email_from'],
    'SUBJECT' => $_REQUEST['subject'],
    'EMAIL' => $_REQUEST['email'],
    'TEXT' => "",
    'HTML' => preg_replace(Array('#.*<body>#', '#</body>.*#'), '', $page),
);
SendAttache('send_invoice_to_client', 's1', $arEventFields, $filename);

unlink($filename[0]);
echo 'Письмо отправлено!';

die();

echo 'Письмо не отправлено!';
?>