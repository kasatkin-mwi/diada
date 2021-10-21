<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");

CModule::IncludeModule('sale');

$db_props = CSaleOrderProps::GetList(
        array("SORT" => "ASC"),
        array(
                "PERSON_TYPE_ID" => 1,
                "ID" => 69
            ),
        false,
        false,
        array()
    );
while ($props = $db_props->Fetch())
{
	echo "<pre>"; print_r($props) ; echo "</pre>";
}


$arFilter = array("PROPERTY_ID" => 69);
$db_props = CSaleOrderProps::GetOrderPropsRelations($arFilter);
while ($props = $db_props->Fetch())
{
	echo "<pre>"; print_r($props) ; echo "</pre>";
}


$rs = CSaleLocation::GetLocationZIP(2625); //CODE=0000103664
echo "<pre>"; print_r($rs->getSelectedRowsCount()) ; echo "</pre>";
while ($ar = $rs->Fetch())
{
	echo "<pre>"; print_r($ar) ; echo "</pre>";
}

/* $allDeliverys = \Bitrix\Sale\Delivery\Services\Manager::getActiveList();
echo "<pre>"; print_r($allDeliverys) ; echo "</pre>"; */
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/epilog_after.php");
?>