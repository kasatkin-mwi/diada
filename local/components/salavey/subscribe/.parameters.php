<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();


$arComponentParameters = array(
"GROUPS" => array(
	),
"PARAMETERS" => array(
	'OK_STRING'=>array(
				"PARENT" => "BASE",
				"NAME" => "Сообщение об успешной подписке",
				"TYPE" => "STRING",
				"DEFAULT" => 'Ваш адрес добавлен в подписку на сайте diada-arms.ru',
				),
	'EXISTS_STRING'=>array(
				"PARENT" => "BASE",
				"NAME" => "Сообщение о существующем пользователе подписки",
				"TYPE" => "STRING",
				"DEFAULT" => 'Такой адрес уже добавлен в подписку',
				),
	'MAIL_STRING'=>array(
				"PARENT" => "BASE",
				"NAME" => "Сообщение о том, что адрес не является E-mail",
				"TYPE" => "STRING",
				"DEFAULT" => 'Указанный адрес не является почтой',
				),
),
);

?>