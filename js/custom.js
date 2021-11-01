$(document).ready(function(){$(".detail_complect_left_block .red_buy_detail, .table_buy_money .buy_element_button, .index_hit .red_buy").click(function(){var e=$(".head_white_basket_ic span").text();e=parseInt(e),e++,$(".head_white_basket_ic span").text(e),$(".head_white_basket_ic span").css("background","#c41a1c")})
		setTimeout(function() {
            $(".cookies-info").hide();
            BX.setCookie("cookies-info", true, {
                expires: 86400 * 365,
                path: "/"
            })
        }, 1e4);
        $(".cookies-info .close").on("click", function() {
            $(".cookies-info").hide();
            BX.setCookie("cookies-info", true, {
                expires: 86400 * 365,
                path: "/"
            })
        });

	$("body").on("submit", "#order_status", function()
    {
        $(".status-info").prepend('<div class="center_loader_mask"><div class="img-loader" style="top: 45%;"></div></div>');
        var number = $("#status").val();
        $.ajax ({
            url: "ajax.php",
            type: "POST",
            data: ({status: $("#status").val()}),
            dataType: "html",
            success: funcSuccess
        });
        return false;
    });
	
	$("body").on("keyup", "#soa-property-5", function()
    {
		var str = $("#soa-property-5").val();
		str = str.replace('_', '');
		str = str.replace('(', '');
		str = str.replace(')', '');
		str = str.replace('-', '');
        var len = str.length;
		if ( len > 11 ){
			$(this).parent().prev().hide();
		}
		else {
			$(this).parent().prev().show();
		}
    });
	
	$("body").on("submit", "[name=SIMPLE_FORM_2]", function()
    {
		$('#addok').show();
	
	});

	function funcSuccess (data) {
		$(".status-info").html (data);
	}	

		

});