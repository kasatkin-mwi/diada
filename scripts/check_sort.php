<?require_once($_SERVER['DOCUMENT_ROOT'] . "/bitrix/modules/main/include/prolog_before.php");
\Bitrix\Main\Loader::includeModule("iblock");
$idList = array();
if (strlen($_REQUEST["ID"])>0) {
    $idList = explode(",",$_REQUEST["ID"]);
    foreach ($idList as $key => &$val){
        $val = trim($val);
        if (!($val>0)) unset($idList[$key]);
    }
    if (is_array($idList) && count($idList)>0) {
        $res = CIBlockElement::GetList(array("PROPERTYSORT_INDIKATOR" => "asc", "SORT" => "asc", "SHOWS" => "desc"), array("ID" => $idList), false, false, array("ID", "NAME", "IBLOCK_ID"));
        while ($data = $res->GetNext()) {
            $time = time() - strtotime($data["SHOW_COUNTER_START_X"]);
            $data["TIME_UNIX"] = $time;
            $data["SHOWS_ONE_DAY"] = $data["SHOW_COUNTER"] / $data["TIME_UNIX"] * 86400;
            $unsetList = array(
                "~ID",
                "~NAME",
                "IBLOCK_ID",
                "~IBLOCK_ID",
                "~PROPERTY_INDIKATOR_SORT",
                "~PROPERTY_INDIKATOR_VALUE",
                "PROPERTY_INDIKATOR_ENUM_ID",
                "~PROPERTY_INDIKATOR_ENUM_ID",
                "PROPERTY_INDIKATOR_VALUE_ID",
                "~PROPERTY_INDIKATOR_VALUE_ID",
                "~SORT",
                "SHOW_COUNTER",
                "~SHOW_COUNTER",
                "SHOW_COUNTER_START_X",
                "~SHOW_COUNTER_START_X",
                "TIME_UNIX"
            );
            foreach ($unsetList as $key) {
                unset($data[$key]);
            }
            echo "<pre class>";
            print_r($data);
            echo "</pre>";
        }
    }
}
?>
