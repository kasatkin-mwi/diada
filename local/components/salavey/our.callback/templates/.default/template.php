<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
/** @var array $arParams */
/** @var array $arResult */
/** @global CMain $APPLICATION */
/** @global CUser $USER */
/** @global CDatabase $DB */
/** @var CBitrixComponentTemplate $this */
/** @var string $templateName */
/** @var string $templateFile */
/** @var string $templateFolder */
/** @var string $componentPath */
/** @var CBitrixComponent $component */
$this->setFrameMode(true);
//$APPLICATION->AddHeadScript("/jscript/jquery.inputmask.js"); 
use Bitrix\Main\Page\Asset; 
Asset::getInstance()->addJs("/js/inputmask.js");
?>
<script>
	function tim_ch(){
		$('#wrap_raskr').animate({
			width: "0px",
			height: "0px",
			margin: "48%"
		  }, 1000 ).animate({
			width: "66px",
			height: "66px",
			margin: "4%"
		  }, 1000 );
	}
	$(function(){
		setInterval(tim_ch, 4000);
	});
</script>
<script>
recaptchaRender = function(elementId) 
{
    if (typeof (grecaptcha) != "undefined") 
    {
        var element = document.getElementById(elementId);

        if(element != undefined && element.childNodes.length == 0) 
        {
            grecaptcha.render(element, {
              'sitekey': '<?=RE_SITE_KEY?>'
           });
        }
     }
}
</script>
<div class="block_all_script" style="position:fixed;top:220px;right:25px;z-index:600;">

<div class="block_knop js_button_plus">
	
	<div id="wrap_raskr" style="width: 0px;height:0px;background-color: rgba(255, 253, 253, 1);
    border-radius: 50%;opacity: 0.2;position:absolute;margin:40%;cursor:pointer;"></div>
	
	<button class="button_raskr"></button>
	
</div>

<div class="form_zbonok js_active_block" style="height: auto;">
	<form class="form_script_zvonok" action="">
		<div class="phone_before"></div>
		<div class="item_zvonok div_one_zv"><span class="span_perez">Мы перезвоним через 28 секунд</span></div>
		<div class="item_zvonok div_two_zv" style="max-width: 177px;">
            <input type="tel" name="phonenumber" placeholder="Введите ваш телефон">
            <div class="g-recaptcha" style="transform:scale(0.59); transform-origin:0;" data-sitekey="<?=RE_SITE_KEY?>" id="<?=uniqid ('r_')?>"></div>
        </div>
        <div class="item_zvonok div_three_zv">
			<button class="a_galka"><span class="span_anim"></span></button>
			<button class="a_close" onClick="$(this).parents('.js_active_block').slideUp(1).siblings('.js_button_plus').slideDown(1);return false;"
			></button>
		</div>

	</form>
	<div class="block_close js_close_block" style="display:none;"></div>
</div>

<div class="clr"></div>

</div>