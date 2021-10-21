<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Просмотр статуса заказа");
$APPLICATION->AddHeadScript('/js/maskedInput.js');?>

<div class="search-page">
    <input type="text" name="status" id="status" placeholder="Введите номер заказа" size="40">
    &nbsp;<input class="red_button" type="submit" name="check" value="Проверить">
	<!-- <input type="hidden" name="how" value="r"> -->
</div>
<br/><br/><div class="h3">Статус заказа: <span id="stat" ></span></div>


<script type="text/javascript">
function funcSuccess (data) {
	$("#stat").html (data);
	
}

$(document).ready (function () {
	$(function(){
	  $("#status").mask("9?99999", {placeholder: "" });
	});

	$("input[name=check]").click( function () {
		var number = $("#status").val();
		$.ajax ({
			url: "ajax.php",
			type: "POST",
			data: ({status: $("#status").val()}),
			dataType: "html",
			success: funcSuccess
		})
	});
})
</script>

<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>