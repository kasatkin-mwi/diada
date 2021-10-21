$(document).on("click",".js_btn",function(){
	if($(".js_elements").find("input:checked").length > 0){
		confirm("Вы уверены, что хотите обновить свойство выбранных элементов?");
	}
	else {
		alert("Вы не выбрали ни одного элемента");
		return false;
	}
});
$(document).on("click","input[name='IS_CATALOG_PROP']",function(){
	$("select[name='PROPERTY_CODE']").val("");
	$("#submit_btn").click();
});
$(document).on("change","select[name='PROPERTY_CODE']",function(){
	$("#submit_btn").click();
});
$(document).on("change","select[name='CATALOG_PROPERTY_CODE']",function(){
	$("#submit_btn").click();
});
BX.addCustomEvent('onAjaxSuccess', function(){
	BX.closeWait();
});

//check list inputs
$(document).on("click",".check_circle_bt", function() {
	$(this).parents(".js_elements").find("input").prop("checked", true).trigger('refresh');
	return false;
});
//reset list inputs
$(document).on("click",".clear_all_bt", function() {
	$(this).parents(".js_elements").find("input").prop("checked", false).trigger('refresh');
	return false;
});