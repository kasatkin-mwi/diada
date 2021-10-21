$(document).ready(function () {
	$("#buttonAB").click(function(){
		event.preventDefault();

		var IDIfoblock = $("#IdInfoblockAB").val();
		var codeAB = $("#codeAB").val();
		var titleAB = $("#titleAB").val();
		var descriptionAB = $("#descriptionAB").val();
		var keywordsAB = $("#keywordsAB").val();
		$.ajax(
                {
                    url:'getIdInfoblock.php',
                    type:'post',//get
                    // dataType: 'json',
                    data:{
                        "IDIfoblock":IDIfoblock,
                        "codeAB":codeAB,
                        "titleAB":titleAB,
                        "descriptionAB":descriptionAB,
                        "keywordsAB":keywordsAB,
                    },
                    success:function (d_data,s) {
                    	// var result = $.parseJSON(d_data);
                        alert(d_data);
                        $(".modal-body").text(d_data);
                        $('.btn-primary').trigger('click');
                    },

                }
            );
	});
});