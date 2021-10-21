<?
$_SERVER["DOCUMENT_ROOT"] = realpath(dirname(__FILE__) . '/../');

$DOCUMENT_ROOT = $_SERVER["DOCUMENT_ROOT"];
require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/modules/main/include/prolog_before.php");
define("NOT_CHECK_PERMISSIONS", true);
set_time_limit(0);

global $USER,$DB;

\Bitrix\Main\Loader::includeModule("sale");
\Bitrix\Main\Loader::includeModule("catalog");
\Bitrix\Main\Loader::includeModule("iblock");

$arFilter = array(
    "ACTIVE" => "Y",
    "ACTIVE_DATE" => "Y",
    'IBLOCK_ID' => 1
);

CTimeZone::Disable();
$currentDatetime = new Bitrix\Main\Type\DateTime();
$filterDiscount = array(
    "ACTIVE" => "Y",
    "USE_COUPONS" => "N",
    array(
        'LOGIC' => 'OR', 
        'ACTIVE_FROM' => '', 
        '<=ACTIVE_FROM' => $currentDatetime
    ), 
    array(
        'LOGIC' => 'OR', 
        'ACTIVE_TO' => '', 
        '>=ACTIVE_TO' => $currentDatetime
    )
);
$dbProductDiscounts = Bitrix\Sale\Internals\DiscountTable::getList(array("filter" => $filterDiscount));
$listDiscountProduct["ELEMENT"] = array();
$listDiscountProduct["SECTION"] = array();
function SetDiscountProductList($data,&$listDiscountProduct,$infoDiscount)
{
    if ($data["DATA"]["value"][0] > 0) 
    {
        if ($data["CLASS_ID"] == "CondGroup") 
        {
            $listDiscountProduct["SECTION"][] = $data["DATA"]["value"][0];
        }
        if ($data["CLASS_ID"] == "CondIBElement") 
        {   
            $listDiscountProduct["ELEMENT"][] = $data["DATA"]["value"][0];
        }
    }
}
while ($infoDiscount = $dbProductDiscounts->fetch())
{
    $condition = $infoDiscount["CONDITIONS_LIST"];
    
    while (isset($condition) && count($condition)>0)
    {
        SetDiscountProductList($condition,$listDiscountProduct,$infoDiscount);
        $condition = $condition["CHILDREN"][0];
    }
}
CTimeZone::Enable();

$arFilter = array('ID' => $listDiscountProduct["ELEMENT"]);
if (empty($listDiscountProduct["ELEMENT"]))
{
    $arFilter = array('ID' => 0);
}

ExportYandexYML(
    $arFilter,
    "specials",
    array(
        'PROPERTYSORT_INDIKATOR' => 'asc', 
        'SORT' => 'asc', 
        'SHOWS' => 'desc'
    ),
    array('ID' => 's1'),
    $DOCUMENT_ROOT
);  