<?
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();

file_put_contents($_SERVER['DOCUMENT_ROOT'] . "/log.txt", print_r($_REQUEST, true));

if ($_GET['AJAX_PAGE'] == 'VIDEO') {

    $content = ob_get_contents();
    ob_end_clean();

    $APPLICATION->RestartBuffer();

    list(, $content_html) = explode('<!--RestartBufferVideo-->', $content);

    echo $content_html;

    die();
}
?>