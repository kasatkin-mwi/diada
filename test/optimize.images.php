<?
if (isset($_REQUEST['work_start']))
{
    define("NO_AGENT_STATISTIC", true);
    define("NO_KEEP_STATISTIC", true);
}
require_once($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_admin_before.php");
CModule::IncludeModule("iblock");
IncludeModuleLangFile(__FILE__);
 //283241
$POST_RIGHT = $APPLICATION->GetGroupRight("main");
if ($POST_RIGHT == "D")
    $APPLICATION->AuthForm("Доступ запрещен");
global $count, $images;
$count = 0;
$images = array();
function getImages($directory = '')
{
    global $count, $images;
    $allowed_types = array("jpg", "jpeg", "png", "gif"); 
    $file_parts = array();
    $ext = "";

    $dir_handle = @opendir($directory) or die("Ошибка при открытии папки !!!");
    while ($file = readdir($dir_handle))
    {
        if(file_exists($_SERVER['DOCUMENT_ROOT']."/test/stop.opt.images.log"))
        {
            die;
        }
        if($file == "." || $file == "..") 
            continue;
        
        if(is_dir($directory."/".$file) && !rmdir($directory."/".$file))
        {
            getImages($directory."/".$file);
        }
        else
        {
            $file_parts = explode(".", $file);
            $ext = strtolower(array_pop($file_parts));

            if(in_array($ext, $allowed_types))
            {
                //echo '<a href="'.str_replace($_SERVER['DOCUMENT_ROOT'], '', $directory).'/'.$file.'">'.$file.'</a><br/>'; 
                $images[] = $directory.'/'.$file;
                $count++;
            }
            if(file_exists($_SERVER['DOCUMENT_ROOT']."/test/stop.opt.images.log"))
            {
                die;
            }    
        }
    }
    closedir($dir_handle);    
}    

$BID = 24;
$limit = 1;
$element = new CIBlockElement;
//327953
if($_REQUEST['work_start'] && check_bitrix_sessid())
{
    $directory = $_SERVER["DOCUMENT_ROOT"]."/upload/resize_cache";
        
    getImages($directory); 
    echo '<pre>'; echo '<br>'; var_export($count); echo '<pre>';
    
    echo '<pre>'; echo '<br>'; var_export($images); echo '<pre>';     
    
    \Bitrix\Main\Loader::includeModule('main');
    \Bitrix\Main\Loader::includeModule('iblock');
    \Bitrix\Main\Loader::includeModule('dev2fun.imagecompress');
    
    $optimizedImages = array();
    $countImages = 0;
    foreach($images as $img)
    {
        //if($img == '/var/www/vhosts/hyundai-akros.ru/httpdocs/media/banners_big_image/0aa8c046449492ba9954700b2b122a8f_20b6af15b5ab9cfe1288341eefb783e2_#U0431#U0430#U043d#U043d#U0435#U0440-#U0431#U043e#U043b#U044c#U0448#U043e#U0439-#U043d#U0430-#U0441#U0430#U0439#U0442-500#U043a.jpg')
//        {

        if(file_exists($_SERVER['DOCUMENT_ROOT']."/test/stop.opt.images.log"))
        {
            die;
        } 
        
        $arFile  = \CFile::MakeFileArray($img);
        $oldSize = $arFile['size'];
        
        $optimizedImages = file_get_contents($_SERVER['DOCUMENT_ROOT'].'/test/optimized_images.log');
        $optimizedImages = unserialize($optimizedImages);
        
        echo '<pre>'; var_export($optimizedImages); echo '<pre>';
        if(!isset($optimizedImages[md5($img)]))
        {
            switch ($arFile['type']) 
            {
                case 'image/jpeg' :
                    $isCompress = \Dev2fun\ImageCompress\Compress::getInstance()->compressJPG($img);
                    break;
                case 'image/png' :
                    $isCompress = \Dev2fun\ImageCompress\Compress::getInstance()->compressPNG($img);
                    break;
                default :
                    echo Bitrix\Main\Localization\Loc::getMessage('DEV2FUN_IMAGECOMPRESS_CONTENT_TYPE',array('#TYPE#' => $arFile['type']));
                    return null;
            }
            
            echo '<pre>'; var_export($isCompress); echo '<pre>';
            
            if($isCompress) 
            {
                clearstatcache(true,$img);
                $newSize = filesize($img);
                
                $optimizedImages[md5($img)] = array(
                    'path' => $img,
                    'old_size' => $oldSize,
                    'new_size' => $newSize,
                );
                
                file_put_contents($_SERVER['DOCUMENT_ROOT'].'/test/optimized_images.log', serialize($optimizedImages), FILE_APPEND);
            }    
            
            if($countImages == 500)
                break;
                
            $countImages++;
        }
        //}
    }
    echo 'CurrentStatus = Array('.$p.',"'.($p < 100 ? '&lastid='.$lastID : '').'","Обрабатываю запись с ID #'.$lastID.',<br>картинки до изменения: '.$imagesBefore.';<br> картинки после изменения: '.$imagesAfter.'");';

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