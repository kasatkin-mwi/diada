<?require_once($_SERVER['DOCUMENT_ROOT'] . "/bitrix/modules/main/include/prolog_before.php");

CModule::IncludeModule("sale");

if($_SERVER['REQUEST_METHOD'] == 'POST' && !empty($_POST['status']))
{
    $ORDER_ID = htmlspecialcharsbx($_POST['status']);
    
    if (!($arOrder = CSaleOrder::GetByID($ORDER_ID)))
    {
           echo "Заказ с кодом ".$ORDER_ID." не найден";
    }
    else
    {
        if ($arStatus = CSaleStatus::GetByID($arOrder["STATUS_ID"]))
        {
           echo $arStatus["NAME"];
           if ($arStatus["DESCRIPTION"])
           {
                echo "<br/><div class='h3'>Описание: <span id='description' >".$arStatus["DESCRIPTION"]."</span></div>";

           }
        }
    }    
}
?>
<?require_once($_SERVER['DOCUMENT_ROOT'] . "/bitrix/modules/main/include/epilog_after.php");?>