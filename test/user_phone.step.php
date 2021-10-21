<?
if (isset($_REQUEST['work_start']))
{
    define("NO_AGENT_STATISTIC", true);
    define("NO_KEEP_STATISTIC", true);
}
require_once($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_admin_before.php");
CModule::IncludeModule("iblock");
IncludeModuleLangFile(__FILE__);

$POST_RIGHT = $APPLICATION->GetGroupRight("main");
if ($POST_RIGHT == "D")
    $APPLICATION->AuthForm("Доступ запрещен");

$BID = 56;
$limit = 20;

$user = new CUser;
$isupdate = false;
if($_REQUEST['work_start'] && check_bitrix_sessid())
{
    $count = 0;
    if(intval($_REQUEST["count"]) > 0)
    {
        $count = $_REQUEST["count"];    
    }
    $users = array();
    $obUser = CUser::GetList(($by="ID"), ($order="asc"), array(">ID" => $_REQUEST["lastid"]), array("NAV_PARAMS" => array("nPageSize" => $limit))); 
    while($arUser = $obUser->Fetch())
    {
        $count++;
        $str = 'телефон: '.$arUser["PERSONAL_PHONE"];
        if(!empty($arUser["PERSONAL_PHONE"]) && strlen($arUser["PERSONAL_PHONE"]) < 11)
        {
            $str = 'старый телефон: '.$arUser["PERSONAL_PHONE"];
            $str .= '<br>новый телефон: 7'.$arUser["PERSONAL_PHONE"];
            $user->Update($arUser["ID"], array(
                "PERSONAL_PHONE" => '7'.$arUser["PERSONAL_PHONE"],
            ));
        }
        /*if(is_numeric($arUser['LOGIN']) && empty($arUser['PERSONAL_PHONE']))
        {
            $str = 'Логин: '.$arUser['LOGIN'];
            $user->Update($arUser["ID"], array(
                "PERSONAL_PHONE" => $arUser['LOGIN'],
            ));
        }*/
        /*$phone = str_replace(array('+', ' ', '(' , ')', '-', '_'), '', $arUser["PERSONAL_PHONE"]);
        $mobile = str_replace(array('+', ' ', '(' , ')', '-', '_'), '', $arUser["PERSONAL_MOBILE"]);
        
        if((!empty($arUser["PERSONAL_PHONE"]) || !empty($arUser["PERSONAL_MOBILE"])) && ((substr($phone, 0,1) == "8" && strlen($phone) == 11) || (substr($mobile, 0,1) == "8" && strlen($mobile) == 11))/* && preg_match("/_/",$arUser["PERSONAL_PHONE"])*//*)
        { 
            if(substr($phone, 0,1) == "8" && strlen($phone) == 11)
            {
                $phone = "7".substr($phone, 1);
            }
            if(substr($mobile, 0,1) == "8" && strlen($mobile) == 11)
            {
                $mobile = "7".substr($mobile, 1);
            }
            $str = 'обработан <br>До обработки <br>телефон: '.$arUser["PERSONAL_PHONE"].' мобильный: '.$arUser["PERSONAL_MOBILE"].'<br>После обработкм <br>телефон: '.$phone. ' мобильный: '.$mobile;
            $user->Update($arUser["ID"], array(
                "PERSONAL_PHONE" => $phone,
                "PERSONAL_MOBILE" => $mobile
            ));
            $isupdate = true;
        }
        else
        {
            $str = 'пропущен <br>телефон: '.$phone. ' мобильный: '.$mobile;
        }*/
        
        $lastID = intval($arUser["ID"]);
    }
    
    $leftBorderCnt = $count;
    
    $rsAll = CUser::GetList(($by="ID"), ($order="asc"), array()); 
    $allCnt = $rsAll->SelectedRowsCount();

    $p = round(100*$leftBorderCnt/$allCnt, 2);
                                                       
    $userInfo = 'Пользователь с ID '.$lastID.' - '.$str;
    
    echo 'CurrentStatus = Array('.$p.',"'.($p < 100 ? '&count='.$count.'&lastid='.$lastID : '&count='.$count).'","'.$userInfo.'");';

    die();
}

$clean_test_table = '<table id="result_table" cellpadding="0" cellspacing="0" border="0" width="100%" class="internal">'.
                        '<tr class="heading">'.
                            '<td>Текущее действие</td>'.
                            '<td width="1%">&nbsp;</td>'.
                        '</tr>'.
                    '</table>';

$aTabs = array(array("DIV" => "edit1", "TAB" => "Обработка"));
$tabControl = new CAdminTabControl("tabControl", $aTabs);

$APPLICATION->SetTitle("Обработка элементов инфоблока");

require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_admin_after.php");

?>
<script type="text/javascript">

    var bWorkFinished = false;
    var bSubmit;

    function set_start(val)
    {
        document.getElementById('work_start').disabled = val ? 'disabled' : '';
        document.getElementById('work_stop').disabled = val ? '' : 'disabled';
        document.getElementById('progress').style.display = val ? 'block' : 'none';

        if (val)
        {
            ShowWaitWindow();
            document.getElementById('result').innerHTML = '<?=$clean_test_table?>';
            document.getElementById('status').innerHTML = 'Работаю...';

            document.getElementById('percent').innerHTML = '0%';
            document.getElementById('indicator').style.width = '0%';

            CHttpRequest.Action = work_onload;
            CHttpRequest.Send('<?= $_SERVER["PHP_SELF"]?>?work_start=Y&lang=<?=LANGUAGE_ID?>&<?=bitrix_sessid_get()?>');
        }
        else
            CloseWaitWindow();
    }

    function work_onload(result)
    {
        try
        {
            eval(result);

            iPercent = CurrentStatus[0];
            strNextRequest = CurrentStatus[1];
            strCurrentAction = CurrentStatus[2];

            document.getElementById('percent').innerHTML = iPercent + '%';
            document.getElementById('indicator').style.width = iPercent + '%';

            document.getElementById('status').innerHTML = 'Работаю...';

            if (strCurrentAction != 'null')
            {
                oTable = document.getElementById('result_table');
                oRow = oTable.insertRow(-1);
                oCell = oRow.insertCell(-1);
                oCell.innerHTML = strCurrentAction;
                oCell = oRow.insertCell(-1);
                oCell.innerHTML = '';
            }

            if (strNextRequest && document.getElementById('work_start').disabled)
                CHttpRequest.Send('<?= $_SERVER["PHP_SELF"]?>?work_start=Y&lang=<?=LANGUAGE_ID?>&<?=bitrix_sessid_get()?>' + strNextRequest);
            else
            {
                set_start(0);
                bWorkFinished = true;
            }

        }
        catch(e)
        {
            CloseWaitWindow();
            document.getElementById('work_start').disabled = '';
            alert('Сбой в получении данных');
        }
    }

</script>

<form method="post" action="<?echo $APPLICATION->GetCurPage()?>" enctype="multipart/form-data" name="post_form" id="post_form">
<?
echo bitrix_sessid_post();

$tabControl->Begin();
$tabControl->BeginNextTab();
?>
    <tr>
        <td colspan="2">

            <input type=button value="Старт" id="work_start" onclick="set_start(1)" />
            <input type=button value="Стоп" disabled id="work_stop" onclick="bSubmit=false;set_start(0)" />
            <div id="progress" style="display:none;" width="100%">
            <br />
                <div id="status"></div>
                <table border="0" cellspacing="0" cellpadding="2" width="100%">
                    <tr>
                        <td height="10">
                            <div style="border:1px solid #B9CBDF">
                                <div id="indicator" style="height:10px; width:0%; background-color:#B9CBDF"></div>
                            </div>
                        </td>
                        <td width=30>&nbsp;<span id="percent">0%</span></td>
                    </tr>
                </table>
            </div>
            <div id="result" style="padding-top:10px"></div>

        </td>
    </tr>
<?
$tabControl->End();
?>
</form>
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/epilog_admin.php");?>