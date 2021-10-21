<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");

error_reporting(E_ALL | E_STRICT) ;
ini_set('display_errors', 'On');

define('DS_FORM_LOAD', true);
define('DS_FORM_ROOT', dirname(__FILE__));

require_once($_SERVER["DOCUMENT_ROOT"].'/ds-comf/ds-form/classes/DSMain.php');
require_once($_SERVER["DOCUMENT_ROOT"].'/ds-comf/ds-form/classes/ConfigForm.php');
require_once($_SERVER["DOCUMENT_ROOT"].'/ds-comf/ds-form/classes/DSConfig.php');
require_once($_SERVER["DOCUMENT_ROOT"].'/ds-comf/ds-form/classes/DSFormSend.php');
require_once($_SERVER["DOCUMENT_ROOT"].'/ds-comf/ds-form/classes/DSFormView.php');
require_once($_SERVER["DOCUMENT_ROOT"].'/ds-comf/ds-form/classes/PHPMailer.php');
require_once($_SERVER["DOCUMENT_ROOT"].'/ds-comf/ds-form/classes/SMTP.php');
require_once($_SERVER["DOCUMENT_ROOT"].'/ds-comf/ds-form/classes/TelphinCall.php');

/*function __autoload($className) {
    include_once 'classes/'.$className .'.php';
}*/

DSMain::routing();

?>