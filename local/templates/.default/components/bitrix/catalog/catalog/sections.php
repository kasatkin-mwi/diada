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
?>

<div class="content">
	<div class="left_column">
		<div class="left_menu_razdel_block">
            <?/*$APPLICATION->IncludeComponent(
				"bitrix:catalog.section.list",
				"catalog_left_column",
				array(
					"IBLOCK_TYPE" => $arParams["IBLOCK_TYPE"],
					"IBLOCK_ID" => $arParams["IBLOCK_ID"],
					"CACHE_TYPE" => "A",
					"CACHE_TIME" => "36000",
					"CACHE_GROUPS" => "N",
					"COUNT_ELEMENTS" => $arParams["SECTION_COUNT_ELEMENTS"],
					"TOP_DEPTH" => 2,
					"SECTION_URL" => $arResult["FOLDER"].$arResult["URL_TEMPLATES"]["section"],
					"VIEW_MODE" => $arParams["SECTIONS_VIEW_MODE"],
					"SHOW_PARENT_NAME" => $arParams["SECTIONS_SHOW_PARENT_NAME"],
					"HIDE_SECTION_NAME" => (isset($arParams["SECTIONS_HIDE_SECTION_NAME"]) ? $arParams["SECTIONS_HIDE_SECTION_NAME"] : "N"),
					"ADD_SECTIONS_CHAIN" => "N",
                    "GET_LIST_SHOW" => array("",1,4,FALSE,NULL),
                    "SECTION_USER_FIELDS" => array('UF_*'),

				),
				$component,
				array("HIDE_ICONS" => "Y")
			);*/
			?>
            <?$APPLICATION->IncludeComponent(
                "salavey:catalog.section.list",
                "catalog_left_column",
                array(
                    "IBLOCK_TYPE" => $arParams["IBLOCK_TYPE"],
                    "IBLOCK_ID" => $arParams["IBLOCK_ID"],
                    "CACHE_TYPE" => "Y",
                    "CACHE_TIME" => "36000",
                    "CACHE_GROUPS" => "N",
                    "COUNT_ELEMENTS" => "N",
                    "TOP_DEPTH" => 2,
                    "SECTION_URL" => $arResult["FOLDER"].$arResult["URL_TEMPLATES"]["section"],
                    "VIEW_MODE" => $arParams["SECTIONS_VIEW_MODE"],
                    "SHOW_PARENT_NAME" => $arParams["SECTIONS_SHOW_PARENT_NAME"],
                    "HIDE_SECTION_NAME" => (isset($arParams["SECTIONS_HIDE_SECTION_NAME"]) ? $arParams["SECTIONS_HIDE_SECTION_NAME"] : "N"),
                    "ADD_SECTIONS_CHAIN" => "N",
                    "GET_LIST_SHOW" => array("",1,4,FALSE,NULL),
                    "SECTION_USER_FIELDS" => array('UF_WHERE_VIEW'),

                ),
                $component,
                array("HIDE_ICONS" => "Y")
            );
            ?>
		</div>
	</div>
	<div class="center_column">
		<h1><?$APPLICATION->ShowTitle(false);?></h1>
		<?if (strlen($_SESSION["CART_SECTION_VIEW"]) == 0){
			$_SESSION["CART_SECTION_VIEW"] = "small";
		}?>
        <script>
            function setViewCartSection($_this) {
                $view = $($_this).data("view");
                $.ajax({
                    url: '<?=$APPLICATION->GetCurPage()?>',
                    async: false,
                    data: "SET_VIEW_CART_SECTION="+$view,
                    success: function (data) {
                        console.log(data);
                        $(".sortirovka_block_cart_section a").removeClass("active");
                        $($_this).addClass("active");
                        if ($view == "small"){
                            $("#block_icon").addClass("small_razdel_firearm");
                        }
                        else{
                            $("#block_icon").removeClass("small_razdel_firearm");
                        }
                    }
                })
            }
        </script>
		<?if (strlen($_REQUEST["SET_VIEW_CART_SECTION"])>0){
			switch ($_REQUEST["SET_VIEW_CART_SECTION"]){
				case "small":
					$_SESSION["CART_SECTION_VIEW"] = "small";
					break;
				case "big":
					$_SESSION["CART_SECTION_VIEW"] = "big";
					break;
			}
		}?>
		<?$APPLICATION->ShowViewContent('show_section_name');///bitrix/templates/.default/components/bitrix/catalog/catalog/bitrix/catalog.section.list/.default/template.php?>
        <div class="sortirovka_block" style="<?$APPLICATION->ShowViewContent('set_display_sortirovka_block');?>">
            <ul class="vid_tovara not_style display_none_m display_none_mp sortirovka_block_cart_section">
                <li>Показывать:</li>
                <li><a class="table_cart_section_small <?if ($_SESSION["CART_SECTION_VIEW"] == "small"):?>active<?endif;?>" href="javascript:void(0);" data-view="small" onclick="setViewCartSection(this);">мелкие значки</a></li>
                <li><a class="table_cart_section_big <?if ($_SESSION["CART_SECTION_VIEW"] == "big"):?>active<?endif;?>" href="javascript:void(0);" data-view="big" onclick="setViewCartSection(this);">крупные значки</a></li>
            </ul>
            <div class="clear"></div>
        </div>
		<?$APPLICATION->IncludeComponent(
			"bitrix:catalog.section.list",
			"",
			array(
				"IBLOCK_TYPE" => $arParams["IBLOCK_TYPE"],
				"IBLOCK_ID" => $arParams["IBLOCK_ID"],
				"SECTION_ID" => $arResult["VARIABLES"]["SECTION_ID"],
				"SECTION_CODE" => $arResult["VARIABLES"]["SECTION_CODE"],
				"CACHE_TYPE" => $arParams["CACHE_TYPE"],
				"CACHE_TIME" => $arParams["CACHE_TIME"],
				"CACHE_GROUPS" => $arParams["CACHE_GROUPS"],
				"COUNT_ELEMENTS" => $arParams["SECTION_COUNT_ELEMENTS"],
				"TOP_DEPTH" => 1,
				"SECTION_URL" => $arResult["FOLDER"].$arResult["URL_TEMPLATES"]["section"],
				"VIEW_MODE" => $arParams["SECTIONS_VIEW_MODE"],
				"SHOW_PARENT_NAME" => $arParams["SECTIONS_SHOW_PARENT_NAME"],
				"HIDE_SECTION_NAME" => (isset($arParams["SECTIONS_HIDE_SECTION_NAME"]) ? $arParams["SECTIONS_HIDE_SECTION_NAME"] : "N"),
				"ADD_SECTIONS_CHAIN" => "N",
				"SECTION_USER_FIELDS" => array('UF_*'),
			),
			$component,
			array("HIDE_ICONS" => "Y")
		);
		?>
	</div>
</div>