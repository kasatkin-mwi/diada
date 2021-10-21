<?
include_once($_SERVER['DOCUMENT_ROOT'].'/bitrix/modules/main/include/urlrewrite.php');

CHTTP::SetStatus("404 Not Found");
@define("ERROR_404","Y");

require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("");

$APPLICATION->SetPageProperty("title","404 Not Found");
$APPLICATION->AddChainItem("404 Not Found");
?>
<script type="text/javascript">
	jQuery(document).on('yacounter25448447inited', function () {
	    var a = document.createElement('a');
	    a.href = document.referrer;
	    var yaParams = [];
	    yaParams.push({'404?': a.href+'; '+document.location.href});
	    yaCounter25448447.params(yaParams);
		yaCounter25448447.reachGoal('checknotfound');
		console.log('Ты попал... на 404');
	});
</script>

<div class="error_page_bl clear_after">
	
		<div class="error_page_cont">
			<div class="error_page_404">
				 404
			</div>
			<div class="error_page_txt">
				 Вы видите ошибку 404, потому что Арчи не смог найти нужную Вам страничку, помогите ему найти её и получите подарок!
			</div>
			<div>
				<?$APPLICATION->IncludeComponent(
	"bitrix:main.feedback", 
	"template6", 
	array(
		"AJAX_MODE" => "Y",
		"AJAX_OPTION_HISTORY" => "N",
		"AJAX_OPTION_JUMP" => "N",
		"AJAX_OPTION_SHADOW" => "N",
		"AJAX_OPTION_STYLE" => "Y",
		"COMPONENT_TEMPLATE" => "template6",
		"USE_CAPTCHA" => "N",
		"OK_TEXT" => "Спасибо, ваше сообщение принято.",
		"EMAIL_TO" => "director@diada-arms.ru",
		"REQUIRED_FIELDS" => array(
			0 => "NAME",
			1 => "MESSAGE",
		),
		"EVENT_MESSAGE_ID" => array(
			0 => "117",
		)
	),
	false
);?>
<br>
<?$APPLICATION->IncludeComponent(
	"bitrix:main.feedback", 
	"template5", 
	array(
		"AJAX_MODE" => "Y",
		"AJAX_OPTION_HISTORY" => "N",
		"AJAX_OPTION_JUMP" => "N",
		"AJAX_OPTION_SHADOW" => "N",
		"AJAX_OPTION_STYLE" => "Y",
		"COMPONENT_TEMPLATE" => "template5",
		"USE_CAPTCHA" => "N",
		"OK_TEXT" => "Спасибо, ваше сообщение принято.",
		"EMAIL_TO" => "director@diada-arms.ru",
		"REQUIRED_FIELDS" => array(
			0 => "NAME",
			1 => "MESSAGE",
		),
		"EVENT_MESSAGE_ID" => array(
			0 => "117",
		)
	),
	false
);?>

			</div>
		</div>
		<div class="error_page_img">
 <img src="/img/Archi_Dog.jpg" alt="">
		</div>
	
</div>
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>