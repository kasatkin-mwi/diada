<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");
 
global $USER;
global $APPLICATION;
if(!is_object($USER))
  $USER = new CUser;

$mode = $_POST["mode"];
$result = array();
$result['status'] = false;
$result['message'] = '';

if(filter_var($_POST['USER_LOGIN'], FILTER_VALIDATE_EMAIL))
{
    $filter = Array("=EMAIL" => $_POST['USER_LOGIN']);
    
    $obUser = CUser::GetList(($by="ID"), ($order="asc"), $filter); 
    if($arUser = $obUser->Fetch())
    {
        $UserLogin = $arUser["LOGIN"];
    }
    else
    {
        $UserLogin = $_POST['USER_LOGIN'];    
    }   
}
else
{
    $user_tel = htmlspecialcharsbx($_POST['USER_LOGIN']);
    $user_tel = preg_replace("/[^0-9]/","",$user_tel);
    if(!empty($user_tel))
    {
        $filter = Array("PERSONAL_PHONE" => $user_tel);
        $obUser = CUser::GetList(($by = "id"), ($order = "asc"), $filter);
        if($arUser = $obUser->Fetch())
        {
            $UserLogin = $arUser["LOGIN"];
        }
        else
        {
            $phone = "";
            if(substr($user_tel, 0,1) == "8")
            {
                $phone = "7".substr($user_tel, 1);
            }
            else
            {
                $phone = "8".substr($user_tel, 1);    
            }
            
            if(!empty($phone))
            {   
                $filter = Array("PERSONAL_PHONE" => $phone);
                $obUser = CUser::GetList(($by = "id"), ($order = "desc"), $filter);
                if($arUser = $obUser->Fetch())
                {
                    $UserLogin = $arUser["LOGIN"];
                }
                else
                {
                    $UserLogin = $_POST['USER_LOGIN'];    
                }
            }
            else
            {
                $UserLogin = $_POST['USER_LOGIN'];    
            }
        }
    }   
}

if(!$USER->IsAuthorized())
{ 
    $res = $USER->Login(htmlspecialcharsbx($UserLogin), $_POST['USER_PASSWORD'],"Y");
    $APPLICATION->arAuthResult = $res;

    if(empty($res['MESSAGE']))
    {
        $result['status'] = true;  
    }
    else
    { 
        $result['message'] = strip_tags($res['MESSAGE']);  

        $result['message'] = $result['message'];  
    }
}                                   

if($APPLICATION->NeedCAPTHAForLogin($UserLogin))
    $result["CAPTCHA_CODE"] = $APPLICATION->CaptchaGetCode();
else
    $result["CAPTCHA_CODE"] = false;

exit(json_encode($result));
?>

<?
/*require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");

global $USER;

if(!is_object($USER)) $USER = new CUser;
$result = array();
$result['status'] = false;
$result['message'] = '';
$result["TYPE"] = '';
$result["MESSAGE"] = '';

if (isset($_POST['TYPE']))
{
    $mode = htmlspecialcharsbx($_POST['TYPE']);
    
    switch($mode)
    {
        case 'AUTH':

        if(!$USER->IsAuthorized())
        {
            $user_tel = htmlspecialcharsbx($_POST['USER_LOGIN']);
            $user_tel = preg_replace("/[^0-9]/","",$user_tel);
            if(!empty($user_tel))
            {
                $filter = Array("PERSONAL_PHONE" => $user_tel);
                $obUser = CUser::GetList(($by = "id"), ($order = "desc"), $filter);
                if($arUser = $obUser->Fetch())
                {
                    if($_POST['USER_REMEMBER'] == "on") 
                        $rem = "Y"; 
                    else 
                        $rem = "N";
                    
                    $arAuthResult = $USER->Login($arUser["LOGIN"], $_POST['USER_PASSWORD'], $rem);
                    //$result['status'] = true;
                    $result['message'] = $arUser["NAME"];
                    $result['backurl'] = $_POST['backurl'];
                    $result["TYPE"] = $arAuthResult["TYPE"];
                    $result["MESSAGE"] = $arAuthResult["MESSAGE"];
                    $APPLICATION->arAuthResult = $arAuthResult;
                }
            }
            else
            {
                $arAuthResult = $USER->Login($_POST['USER_LOGIN'], $_POST['USER_PASSWORD'], $rem);
                //$result['status'] = true;
                $result['message'] = $USER->GetFirstName();
                $result['backurl'] = $_POST['backurl'];
                $result["TYPE"] = $arAuthResult["TYPE"];
                $result["MESSAGE"] = $arAuthResult["MESSAGE"];
                $APPLICATION->arAuthResult = $arAuthResult;   
            }
            
        }
        break;
    }
}

exit(json_encode($result));
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/epilog_after.php");
*/