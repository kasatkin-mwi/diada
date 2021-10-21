<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Просмотр статуса заказа");
$APPLICATION->AddHeadScript('/js/maskedInput.js');?>
<div class="search-page">
    <form action="<?=$APPLICATION->GetCurPage()?>" method="post" name="order_status" id="order_status" enctype="multipart/form-data">
        <input type="text" name="status" id="status" placeholder="Введите номер заказа" size="40">
        &nbsp;<input class="red_button" type="submit" name="check" value="Проверить">
        <!-- <input type="hidden" name="how" value="r"> -->
    </form>
</div>
<br/><br/>
<div class="h3">Статус заказа: </div>

<div class="status-info">
</div>

<script type="text/javascript">
function funcSuccess (data) {
    $(".status-info").html (data);
}

$(document).ready (function () {
    $(function(){
      $("#status").mask("9?99999", {placeholder: "" });
    });

    
    /*$("input[name=check]").click( function () {
        var number = $("#status").val();
        $.ajax ({
            url: "ajax.php",
            type: "POST",
            data: ({status: $("#status").val()}),
            dataType: "html",
            success: funcSuccess
        })
    });*/
})
</script>
<style>
    .status-info{
        position:relative;
    }
    table.status-table {
        width: 100%;
        color: #000;
    }
    table.status-table td.ordertitle {
        height: 42px;
        vertical-align: middle;
        text-align: center;
        text-transform: uppercase;
        color: #000;
        background: #f1f0f3;
        font-size: 12px;
        position: relative;
    }
    table.status-table tr.orderparam td {
        height: 44px;
        vertical-align: middle;
        text-align: center;
        color: #000;
        background: #fff;
        font-size: 12px;
    }
</style>
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>