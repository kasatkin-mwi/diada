<?require_once($_SERVER['DOCUMENT_ROOT'] . "/bitrix/modules/main/include/prolog_before.php");
\Bitrix\Main\Loader::includeModule("catalog");
$request = \Bitrix\Main\Context::getCurrent()->getRequest();
$idStore = $request->get("STORE_ID");
$result = array();
if ($idStore>0){
    if ($dbStore = CCatalogStore::GetList(Array("SORT"=>"ASC"), Array("ID" => $idStore),false,false,array("*","UF_*"))->GetNext()) {
        if ($dbStore["UF_IMG_UNDERGRAUND"]>0) $result["LOGOTIP_METRO"] = CFile::GetPath($dbStore["UF_IMG_UNDERGRAUND"]);
    }
    else{
        $result["LOGOTIP_METRO"] = "";
    }
}
echo json_encode($result);