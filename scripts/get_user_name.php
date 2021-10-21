<?require_once($_SERVER['DOCUMENT_ROOT'] . "/bitrix/modules/main/include/prolog_before.php");
$USER_ID = $_REQUEST["USER_ID"];
if ($infoUser = CUser::GetByID($USER_ID)->GetNext()){
    $result["success"] = true;
    $name = array_diff(array($infoUser["SECOND_NAME"],$infoUser["NAME"],$infoUser["LAST_NAME"]),array(""));
    $result["name"] = implode(" ",$name)." [".$infoUser["EMAIL"]."]";
    $result["id"] = $infoUser["ID"];
}
else{
    $result["success"] = false;
}
echo json_encode($result);