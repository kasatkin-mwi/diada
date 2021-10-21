<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Регистрация");
Bitrix\Main\Data\StaticHtmlCache::getInstance()->markNonCacheable();
if($_SERVER['REQUEST_METHOD'] == 'POST' && $_REQUEST['register'] == 'Y')
{
    $_REQUEST['REGISTER']['EMAIL'] = $_REQUEST['REGISTER']['LOGIN'];
    
    $APPLICATION->RestartBuffer();
}
?>
<div class="reg_form_gray">
	<div class="reg_form_gray_title">РЕГИСТРАЦИЯ</div>
	<div class="reg_form_white reg_form_top_block">
		<div class="reg_form_white_width" style="position: relative;">

			<div class="reg_form_top_title">Вы регистрируетесь как:</div>
            <script>
                $(document).ready(function ($) {
                    $("[name='REGISTER[PERSONAL_PHONE]']").mask("+7 (999) 999-99-99");
                });
            </script>
			<div class="section">

				<div class="reg_radio_button_block tabs">
                    <form>
                        <label class="type_user_reg current"><input type="radio" name="type" value="1" checked />Частное лицо</label>
                        <label class="type_user_reg"><input type="radio" name="type" value="2" />Юридическое лицо</label>
                    </form>
				</div>

				<div class="box" style="display:block;">
					<?$APPLICATION->IncludeComponent(
	"bitrix:main.register", 
	"fiz", 
	array(
		"AUTH" => "Y",
		"REQUIRED_FIELDS" => array(
		),
		"SET_TITLE" => "Y",
		"SHOW_FIELDS" => array(
			0 => "EMAIL",
            1 => "NAME",
			2 => "PERSONAL_PHONE",
		),
		"SUCCESS_PAGE" => "",
		"USER_PROPERTY_NAME" => "",
		"USE_BACKURL" => "Y",
		"AJAX_MODE" => 'N',
		"COMPONENT_TEMPLATE" => "fiz",
		"USER_PROPERTY" => array(
		),
		"COMPOSITE_FRAME_MODE" => "A",
		"COMPOSITE_FRAME_TYPE" => "AUTO"
	),
	false
);?>
				</div>

				<div class="box">
					<?$APPLICATION->IncludeComponent(
						"bitrix:main.register",
						"yur",
						Array(
							"AUTH" => "Y",
							"REQUIRED_FIELDS" => array(),
							"SET_TITLE" => "Y",
							"SHOW_FIELDS" => array(
								0 => "EMAIL",
								1 => "NAME",
								2 => "PERSONAL_WWW",
								3 => "PERSONAL_PHONE",
							),
							"SUCCESS_PAGE" => "",
							"USER_PROPERTY" => array(
								0 => "UF_NAME",
								1 => "UF_TYPE",
								2 => "UF_CONTACT",
								3 => "UF_YUR_ADDRESS",
								4 => "UF_BANK",
								5 => "UF_BIK",
								6 => "UF_SCHET",
								7 => "UF_KORSCHET",
								8 => "UF_INN",
								9 => "UF_KPP",
								10 => "UF_OKDP",
								11 => "UF_OKPO",
								12 => "UF_OKVED",
							),
							"USER_PROPERTY_NAME" => "",
							"USE_BACKURL" => "Y",
							"AJAX_MODE" => 'N',
						)
					);?>
				</div>

			</div>
		</div>
	</div>
</div>
<?
if($_SERVER['REQUEST_METHOD'] == 'POST' && $_REQUEST['register'] == 'Y')
{
    die;
}
?>
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>
