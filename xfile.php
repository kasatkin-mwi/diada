<?require_once($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");

BXClearCache(true);
$GLOBALS['CACHE_MANAGER']->CleanAll();
$GLOBALS['stackCacheManager']->CleanAll();
$staticHtmlCache = \Bitrix\Main\Data\StaticHtmlCache::getInstance();
$staticHtmlCache->deleteAll();