<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("");?><script type="text/javascript" src="jquery.inputmask.bundle.js"></script>

<input type="text" name="phone" placeholder="+_(___) ___ __-__"><br>

<script type="text/javascript" src="/popup.js"></script>
<script type="text/javascript">
	$("document").ready(function(){
		// $("input[name=phone]").inputmask("+?9{1,3}(999) 999 99-99",{
		//     "onincomplete": function(){ $("input[name=phone]").val(""); }
		// });
		$("input[name=phone]").inputmask({
			mask: "+*{0,1}9{1,3}(999) 999 99-99",
			definitions: {
			  '*': {
			    validator: "[+]",
			    cardinality: 1,
			    casing: "lower"
			  }
			},
		    "onincomplete": function(){ $("input[name=phone]").val(""); }
		});
		// $("input[name=phone]").inputmask({
		//     mask: "*{1,10}",
		//     definitions: {
		//       '*': {
		//         validator: "[0-9+]",
		//         cardinality: 1,
		//         casing: "lower"
		//       }
		//     },
		//     "onincomplete": function(){  }
		// });
	});
</script>




<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>