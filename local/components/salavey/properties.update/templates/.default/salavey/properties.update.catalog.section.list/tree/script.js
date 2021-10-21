$(document).ready(function(){
	$(document).on("click","a[data-sect_id]",function(){
		var sect_id = $(this).data("sect_id");
		$("#set_filter").before('<input type="hidden" name="SECTION_ID" value="' + sect_id  + '" />');
		$("#set_filter").click();
	});
});