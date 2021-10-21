<?require ($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");
$content = file_get_contents('https://www.diada-arms.ru/otziv/');

preg_match('|<section.*?>(.*)</section>|sei', $content, $matches);
 echo '<pre>'; var_export($matches[0]); echo '</pre>'; die;