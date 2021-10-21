<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");

$result = array(
    'success' => 'N',
    'not_email' => 'N',
    'email_exist' => 'N',
    'email_invalid' => 'N',
    'message' => 'Этот e-mail уже зарегистрирован или не существует',
);

if($_SERVER['REQUEST_METHOD'] == 'POST' && !empty($_REQUEST['email']))
{
    $result['message'] = 'Этот e-mail не существует';   
}

if($_SERVER['REQUEST_METHOD'] == 'POST' && (!empty($_REQUEST['REGISTER']['LOGIN']) || !empty($_REQUEST['email'])))
{
    if(!empty($_REQUEST['REGISTER']['LOGIN']))
    {
        $email = $_REQUEST['REGISTER']['LOGIN'];    
    }
    if(!empty($_REQUEST['email']))
    {
        $email = $_REQUEST['email'];    
    }
    if(check_email($email))
    {
        $filter = Array("=EMAIL" => $email);
        $obUser = CUser::GetList(($by="ID"), ($order="asc"), $filter); 
        if($arUser = $obUser->Fetch())
        {   
            $result['success'] = 'N';
            $result['email_exist'] = 'Y';
            $result['message'] = 'Этот e-mail уже зарегистрирован';
        }
        else
        {
            $is_emailExist = isExistEmail($email);
            
            if($is_emailExist)
            {
                $result['success'] = 'Y';
            }
            else
            {
                $result['success'] = 'N';
                $result['email_invalid'] = 'Y';
                $result['message'] = 'Введенный вами e-mail не существует';
            }
        }  
    }
    else
    {   
        $result['not_email'] = 'Y';
        $result['message'] = 'Неверный e-mail.';
    } 
}

exit(json_encode($result));
