<?die;
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
set_time_limit(0);

Bitrix\Main\Loader::includeModule("sale");

global $DB, $USER;;

/*function getUserByPhone($phone = false)
{
    if(empty($phone) || !$phone)
    {
        return false;
    }
    $phone = trim($phone);
    $obUsers = CUser::GetList(
        ($by = "id"), 
        ($order = "asc"), 
        array(
            'PERSONAL_PHONE' => $phone
        ), 
        array(
            'FIELDS' => array('ID', 'PERSONAL_PHONE')
        )
    );
    if($arUser = $obUsers->GetNext())
    {
        return array('ID' => $arUser['ID']);
    }
    else
    {
        $telephone = "";
        if(substr($phone, 0,1) == "8")
        {
            $telephone = "7".substr($phone, 1);
        }
        else
        {
            $telephone = "8".substr($phone, 1);    
        }
        if(!empty($telephone))
        {
            $obUsers = CUser::GetList(
                ($by = "id"), 
                ($order = "asc"), 
                array(
                    'PERSONAL_PHONE' => $telephone
                ), 
                array(
                    'FIELDS' => array('ID', 'PERSONAL_PHONE')
                )
            );
            if($arUser = $obUsers->GetNext())
            {                
                return array('ID' => $arUser['ID']);
            }
            else
            {
                $obUsers = CUser::GetList(
                    ($by = "id"), 
                    ($order = "asc"), 
                    array(
                        'PERSONAL_MOBILE' => $phone
                    ), 
                    array(
                        'FIELDS' => array('ID', 'PERSONAL_MOBILE')
                    )
                );
                if($arUser = $obUsers->GetNext())
                {
                    return array('ID' => $arUser['ID']);
                }
                else
                {
                    $obUsers = CUser::GetList(
                        ($by = "id"), 
                        ($order = "asc"), 
                        array(
                            'PERSONAL_MOBILE' => $telephone
                        ), 
                        array(
                            'FIELDS' => array('ID', 'PERSONAL_MOBILE')
                        )
                    );
                    if($arUser = $obUsers->GetNext())
                    {
                        return array('ID' => $arUser['ID']);
                    }
                    else
                    {
                        return false;    
                    }
                }
            }    
        }                
    }
} */

$user = new CUser;
$users = array();
$filter = array(
    "GROUPS_ID" => array(12)
);
$obUsers = CUser::GetList(
    ($by="personal_country"), 
    ($order="desc"), 
    $filter, 
    array(
        'FIELDS' => array('ID')
    )
); 
while($arUser = $obUsers->GetNext())
{
    $users[] = $arUser['ID'];
}

$time = time() - (24*8*60*60);
//$time = 1567336715;

$arFilter = Array(
    "USER_ID" => $users,
    '>=DATE_INSERT' => date($DB->DateFormatToPHP(CSite::GetDateFormat("FULL", SITE_ID)), $time),
    'ID' => 218894
    //'ID' => 218937
);
$rsSales = CSaleOrder::GetList(
    array("DATE_INSERT" => "ASC"),
    $arFilter,
    false,
    //array('nTopCount' => 200),
    false,
    array(
        'ID',
        'USER_ID'
    )
);
while($arSales = $rsSales->Fetch())
{
    /*$obOrder = Bitrix\Sale\Order::load($arSales['ID']);
    $propertyCollection = $obOrder->getPropertyCollection();
    $phonePropValue = $propertyCollection->getPhone();
    $phone = $phonePropValue->getValue();
    $email = $propertyCollection->getUserEmail()->getValue();
    $payerName = $propertyCollection->getPayerName()->getValue();
    if (!empty($payerName))
    {
        $arNames = explode(' ', $payerName);
        $newName = $arNames[1];
        $newLastName = $arNames[0];
    }
    $arPhone = explode(', ',$phone);
    $orderUserId = 0;
    
    if(count($arPhone) > 1)
    {
        foreach($arPhone as $phone_number)
        {    
            $userResult = getUserByPhone($phone_number);
            
            if(isset($userResult['ID']) && intval($userResult['ID']) > 0)
            {
                $orderUserId = $userResult['ID'];
                break;    
            }    
        }    
    }
    else
    {        
        $userResult = getUserByPhone($phone);   
        if(isset($userResult['ID']) && intval($userResult['ID']) > 0)
        {
            $orderUserId = $userResult['ID'];   
        }
    }
    
    if(intval($orderUserId) <= 0)
    {
        $defGroup = Bitrix\Main\Config\Option::get('main', 'new_user_registration_def_group', '');
        if (!empty($defGroup))
        {
            $groupId = explode(',', $defGroup);
            $arPolicy = $USER->GetGroupPolicy($groupId);
        }
        else
        {
            $groupId = false;
            $arPolicy = $USER->GetGroupPolicy(array());
        }

        $passwordMinLength = (int)$arPolicy['PASSWORD_LENGTH'];
        if ($passwordMinLength <= 0)
        {
            $passwordMinLength = 6;
        }

        $passwordChars = array(
            'abcdefghijklnmopqrstuvwxyz',
            'ABCDEFGHIJKLNMOPQRSTUVWXYZ',
            '0123456789',
        );
        if ($arPolicy['PASSWORD_PUNCTUATION'] === 'Y')
        {
            $passwordChars[] = ",.<>/?;:'\"[]{}\|`~!@#\$%^&*()-_+=";
        }

        $newPassword = $newPasswordConfirm = randString($passwordMinLength + 2, $passwordChars);
        
        if(preg_match("/^auto_(\d+)@diada-email.ru/", $email))
        {
            $email = "auto_".time().rand(5)."@diada-email.ru"; 
        }
         
        $arAuthResult = $user->Add(array(
            'LOGIN' => $email,
            'NAME' => $newName,
            'LAST_NAME' => $newLastName,
            'PASSWORD' => $newPassword,
            'CONFIRM_PASSWORD' => $newPasswordConfirm,
            'EMAIL' => $email,
            'GROUP_ID' => $groupId,
            'ACTIVE' => 'Y',
            'LID' => 's1',
            'PERSONAL_PHONE' => $arPhone[0],
        ));
        if(intval($arAuthResult) > 0)
        {
            $orderUserId = intval($arAuthResult);    
        }
        else
        {
            echo '<pre>'; echo '<br>'; var_export($user->LAST_ERROR); echo '</pre>'; die;
        }
    }
    
    if(intval($orderUserId) > 0)
    {
        $obOrder->setFieldNoDemand(
            "USER_ID",
            $orderUserId
        );
        file_put_contents($_SERVER['DOCUMENT_ROOT'].'/bitrix/php_interface/include/order.binding.log', 'В заказе №'.$arSales['ID'].' был сменен пользователь с id '.$arSales['USER_ID'].' на id '.$orderUserId."\r\n", FILE_APPEND);
        $obOrder->save();
    }*/
}