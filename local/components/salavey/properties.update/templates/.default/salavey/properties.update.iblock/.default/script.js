$(document).ready(function(){
	$(document).on("change",".iblock_select select", function() {
		
		if($(this).attr("name") == "IBLOCK_TYPE")
		{
			if($(this).parents("form").find("select[name='IBLOCK_ID']").length > 0)
			{
				$(this).parents("form").find("select[name='IBLOCK_ID']").val("");
			}
		};
		$(this).parents("form").find("input[type='submit']").click();
		
	});
});