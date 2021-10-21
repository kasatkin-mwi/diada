<?php
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");

BXClearCache(true);
$GLOBALS['CACHE_MANAGER']->CleanAll();
$GLOBALS['stackCacheManager']->CleanAll();
$staticHtmlCache = \Bitrix\Main\Data\StaticHtmlCache::getInstance();
$staticHtmlCache->deleteAll();
?>