<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

use Bitrix\Main\Loader,
	Bitrix\Main\ModuleManager;
?>
<div class="content">
	<div class="left_column">
        <?
        if ($arResult["VARIABLES"]["SECTION_ID"]>0) 
        {
            $arFilter = array(
                "IBLOCK_ID" => \FCbit\Conf::FCbit_DISPLAY_FILTER_IBLOCK_ID,
                "PROPERTY_4953" => $arResult["VARIABLES"]["SECTION_ID"]
            );

            $obCache = new CPHPCache();
            if ($obCache->InitCache(36000, serialize($arFilter), "/iblock/catalog/settings"))
            {
                $arSettings = $obCache->GetVars();
            }
            elseif ($obCache->StartDataCache())
            {
                $arSettings = array();
                if (Loader::includeModule("iblock"))
                {                    
                    $dbRes = CIBlockElement::GetList(array("ID" => "asc"), $arFilter, false, array("nTopCount" => 1), array("ID","IBLOCK_ID"));
                    if(defined("BX_COMP_MANAGED_CACHE"))
                    {
                        global $CACHE_MANAGER;
                        $CACHE_MANAGER->StartTagCache("/iblock/catalog/settings");

                        if ($arRes = $dbRes->GetNextElement())
                        {   
                            $arSettings = array(
                                "MY_PARAM_SHOW_FILTER" => "N",
                                "SHOW_FILTER" => $arRes->GetProperty(4954),
                                "SHOW_FILTER_FOR_GROUP" => $arRes->GetProperty(4955),
                                "LIST_PROP" => array(
                                    "START" => $arRes->GetProperty(4956)["VALUE"], 
                                    "STOP" => $arRes->GetProperty(4957)["VALUE"], 
                                    "ADD" => !empty($arRes->GetProperty(4959)["VALUE"]) ? $arRes->GetProperty(4959)["VALUE"] : array(), 
                                    "DELETE" => !empty($arRes->GetProperty(4958)["VALUE"]) ? $arRes->GetProperty(4958)["VALUE"] : array(), 
                                ),
                                "LIST_ALL" => array()
                            );
                            
                            if ($arSettings["LIST_PROP"]["START"] > 0 && $arSettings["LIST_PROP"]["STOP"] > 0 && $arSettings["LIST_PROP"]["START"] < $arSettings["LIST_PROP"]["STOP"])
                            {
                                for($i = $arSettings["LIST_PROP"]["START"]; $i <= $arSettings["LIST_PROP"]["STOP"]; $i++)
                                {
                                    $arSettings["LIST_ALL"][] = $i;
                                }
                            }
                            if (isset($arSettings["LIST_PROP"]["DELETE"]) && is_array($arSettings["LIST_PROP"]["DELETE"])) 
                            {
                                foreach ($arSettings["LIST_PROP"]["DELETE"] as $val) 
                                {
                                    unset($arSettings["LIST_ALL"][array_search($val, $arSettings["LIST_ALL"])]);
                                }
                            }
                            if (isset($arSettings["LIST_PROP"]["ADD"]) && is_array($arSettings["LIST_PROP"]["ADD"])) 
                            {                                
                                $arSettings["LIST_ALL"] = array_merge($arSettings["LIST_ALL"], $arSettings["LIST_PROP"]["ADD"]);                                
                            }
                            if (($arSettings["SHOW_FILTER"]["VALUE_XML_ID"] == "Y") && (CSite::InGroup($arSettings["SHOW_FILTER_FOR_GROUP"]["VALUE_XML_ID"]))) 
                            {
                                $arSettings["MY_PARAM_SHOW_FILTER"] = "Y";
                            }
                            $CACHE_MANAGER->RegisterTag("iblock_settings_id_".$arParams["IBLOCK_ID"]);
                        }

                        $CACHE_MANAGER->EndTagCache();
                    }
                    else
                    {
                        if(!$arRes = $dbRes->GetNextElement())
                        {
                            $arSettings = array();
                        }
                        else
                        {
                            $arSettings = array(
                                "MY_PARAM_SHOW_FILTER" => $arRes->GetProperty(4954),
                                "SHOW_FILTER" => $arRes->GetProperty(4954),
                                "SHOW_FILTER_FOR_GROUP" => $arRes->GetProperty(4955),
                                "LIST_PROP" => array(
                                    "START" => $arRes->GetProperty(4956)["VALUE"], 
                                    "STOP" => $arRes->GetProperty(4957)["VALUE"], 
                                    "ADD" => !empty($arRes->GetProperty(4959)["VALUE"]) ? $arRes->GetProperty(4959)["VALUE"] : array(), 
                                    "DELETE" => !empty($arRes->GetProperty(4958)["VALUE"]) ? $arRes->GetProperty(4958)["VALUE"] : array(), 
                                ),
                                "LIST_ALL" => array()
                            );
                            
                            if ($arSettings["LIST_PROP"]["START"] > 0 && $arSettings["LIST_PROP"]["STOP"] > 0 && $arSettings["LIST_PROP"]["START"] < $arSettings["LIST_PROP"]["STOP"])
                            {
                                for($i = $arSettings["LIST_PROP"]["START"]; $i <= $arSettings["LIST_PROP"]["STOP"]; $i++)
                                {
                                    $arSettings["LIST_ALL"][] = $i;
                                }
                            }
                            if (isset($arSettings["LIST_PROP"]["DELETE"]) && is_array($arSettings["LIST_PROP"]["DELETE"])) 
                            {
                                foreach ($arSettings["LIST_PROP"]["DELETE"] as $val)
                                {
                                    unset($arSettings["LIST_ALL"][array_search($val, $arSettings["LIST_ALL"])]);
                                }
                            }
                            if (isset($arSettings["LIST_PROP"]["ADD"]) && is_array($arSettings["LIST_PROP"]["ADD"])) 
                            {
                                $arSettings["LIST_ALL"] = array_merge($arSettings["LIST_ALL"], $arSettings["LIST_PROP"]["ADD"]);
                            }
                            if (($arSettings["SHOW_FILTER"]["VALUE_XML_ID"] == "Y") && (CSite::InGroup($arSettings["SHOW_FILTER_FOR_GROUP"]["VALUE_XML_ID"]))) 
                            {
                                $arSettings["MY_PARAM_SHOW_FILTER"] = "Y";
                            }   
                        }
                            
                    }
                }
                $obCache->EndDataCache($arSettings);
            }
            if (!isset($arSettings))
                $arSettings = array();
        }           
        /*if ($arResult["VARIABLES"]["SECTION_ID"]>0) {
            $MY_PARAM_SHOW_FILTER = "N";
            $paramFilter = CIBlockElement::GetList(array(), array("IBLOCK_ID" => 29, "PROPERTY_4953" => $arResult["VARIABLES"]["SECTION_ID"]))->GetNextElement();
            if ($paramFilter) {
                $paramShowFilter = $paramFilter->GetProperty(4954);
                $paramShowFilterForGroup = $paramFilter->GetProperty(4955);
                $listProp["START"] = $paramFilter->GetProperty(4956)["VALUE"];
                $listProp["STOP"] = $paramFilter->GetProperty(4957)["VALUE"];
                $listProp["ADD"] = $paramFilter->GetProperty(4959)["VALUE"];
                $listProp["DELETE"] = $paramFilter->GetProperty(4958)["VALUE"];
                $listAll = array();
                if ($listProp["START"]>0 && $listProp["STOP"]>0 && $listProp["START"]<$listProp["STOP"]){
                    for($i=$listProp["START"];$i<=$listProp["STOP"];$i++){
                        $listAll[] = $i;
                    }
                }
                if (isset($listProp["DELETE"]) && is_array($listProp["DELETE"])) {
                    foreach ($listProp["DELETE"] as $val) {
                        unset($listAll[array_search($val, $listAll)]);
                    }
                }
                if (isset($listProp["ADD"]) && is_array($listProp["ADD"])) {
                    $listAll = array_merge($listAll, $listProp["ADD"]);
                }
                if (($paramShowFilter["VALUE_XML_ID"] == "Y") && (CSite::InGroup($paramShowFilterForGroup["VALUE_XML_ID"]))) {
                    $MY_PARAM_SHOW_FILTER = "Y";
                }
            }
        }*/    
        ?>
       <?
       

        echo $arResult["SECTION_ID"]; ?>
        <?if ($arSettings["MY_PARAM_SHOW_FILTER"] == "Y"):
                     
        ?>
        <?
        /*if($USER->GetID() == USER_SALAVEY_ID):?>
            <?echo '<pre qew>'; print_r($arParams); echo '</pre>';?>
        <?endif*/?>



            <a class="filter_button_block js_filter_button_block display_none_c" href="">????????????</a>
            <div class="filter_block js_filter_block">
                <div class="filter_position_block">
                    <?
                    $APPLICATION->IncludeComponent(
                        "bitrix:catalog.smart.filter",
                        "",
                        array(
                            "SHOW_THIS_LIST" => $arSettings["LIST_ALL"],
                            "IBLOCK_TYPE" => $arParams["IBLOCK_TYPE"],
                            "IBLOCK_ID" => $arParams["IBLOCK_ID"],
                            "SECTION_ID" => $arCurSection['ID'],
                            "FILTER_NAME" => $arParams["FILTER_NAME"],
                            "PRICE_CODE" => $arParams["PRICE_CODE"],
                            "CACHE_TYPE" => $arParams["CACHE_TYPE"],
                            "CACHE_TIME" => $arParams["CACHE_TIME"],
                            "CACHE_GROUPS" => $arParams["CACHE_GROUPS"],
                            "SAVE_IN_SESSION" => "N",
                            "FILTER_VIEW_MODE" => $arParams["FILTER_VIEW_MODE"],
                            "XML_EXPORT" => "Y",
                            "SECTION_TITLE" => "NAME",
                            "SECTION_DESCRIPTION" => "DESCRIPTION",
                            'HIDE_NOT_AVAILABLE' => $arParams["HIDE_NOT_AVAILABLE"],
                            "TEMPLATE_THEME" => $arParams["TEMPLATE_THEME"],
                            'CONVERT_CURRENCY' => $arParams['CONVERT_CURRENCY'],
                            'CURRENCY_ID' => $arParams['CURRENCY_ID'],
                            "SEF_MODE" => $arParams["SEF_MODE"],
                            "SEF_RULE" => $arResult["FOLDER"] . $arResult["URL_TEMPLATES"]["smart_filter"],
                            "SMART_FILTER_PATH" => $arResult["VARIABLES"]["SMART_FILTER_PATH"],
                            "PAGER_PARAMS_NAME" => $arParams["PAGER_PARAMS_NAME"],
                            "INSTANT_RELOAD" => $arParams["INSTANT_RELOAD"],
                            "POPUP_POSITION" => "right",
                        ),
                        $component,
                        array('HIDE_ICONS' => 'Y')
                    );
                    ?>
                </div>
            </div>
        <?endif;?>
	</div>
	<?
	//echo "<pre>";print_r($_COOKIE);echo "</pre>";
	if ($_REQUEST['sort'])
	{
		setcookie('C_SORT', $_REQUEST['sort'], time()+3600, '/');
		$sort = $_REQUEST['sort'];
	}
	elseif ($_COOKIE['C_SORT'])
		$sort = $_COOKIE['C_SORT'];
	else {
        //$sort = "price";
        $sort = "propertysort_INDIKATOR";
    }

	if ($_REQUEST['order'])
	{
		setcookie('C_ORDER', $_REQUEST['order'], time()+3600, '/');
		$order = $_REQUEST['order'];
	}
	elseif ($_COOKIE['C_ORDER'])
		$order = $_COOKIE['C_ORDER'];
	else
		$order = "asc";

	if ($_REQUEST['view'])
	{
		setcookie('C_VIEW', $_REQUEST['view'], time()+3600, '/');
		$view = $_REQUEST['view'];
	}
	elseif ($_COOKIE['C_VIEW'])
		$view = $_COOKIE['C_VIEW'];
	else
		$view = "table";

	//echo $sort." -- ".$order." -- ".$view;
	?>
	<div class="center_column" <?if ($arSettings["MY_PARAM_SHOW_FILTER"] != "Y"):?>style="width: 100%" <?endif;?>>
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
        <?//$APPLICATION->ShowViewContent('show_section_name');///bitrix/templates/.default/components/bitrix/catalog/catalog/bitrix/catalog.section.list/.default/template.php?>
        <div class="sortirovka_block" style="<?$APPLICATION->ShowViewContent('set_display_sortirovka_block');?>">
            <ul class="vid_tovara not_style display_none_m display_none_mp sortirovka_block_cart_section">
                <li>????????????????????:</li>
                <li><a class="table_cart_section_small <?if ($_SESSION["CART_SECTION_VIEW"] == "small"):?>active<?endif;?>" href="javascript:void(0);" data-view="small" onclick="setViewCartSection(this);">???????????? ????????????</a></li>
                <li><a class="table_cart_section_big <?if ($_SESSION["CART_SECTION_VIEW"] == "big"):?>active<?endif;?>" href="javascript:void(0);" data-view="big" onclick="setViewCartSection(this);">?????????????? ????????????</a></li>
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
				"COUNT_ELEMENTS" => "N",
				//"TOP_DEPTH" => 1,
				"SECTION_URL" => $arResult["FOLDER"].$arResult["URL_TEMPLATES"]["section"],
				"VIEW_MODE" => $arParams["SECTIONS_VIEW_MODE"],
				"SHOW_PARENT_NAME" => $arParams["SECTIONS_SHOW_PARENT_NAME"],
				"HIDE_SECTION_NAME" => (isset($arParams["SECTIONS_HIDE_SECTION_NAME"]) ? $arParams["SECTIONS_HIDE_SECTION_NAME"] : "N"),
				"ADD_SECTIONS_CHAIN" => "N",
                "SECTION_USER_FIELDS" => array('UF_WHERE_VIEW'),
			),
			$component,
			array("HIDE_ICONS" => "Y")
		);
		?>
        <?if (true):?>
		    <div class="sortirovka_block">
                <ul class="sortirovka not_style">
                    <li>?????????????????????? ????:</li>
                    <?
                    $arSort = Array("popular"=>"????????????????????????", "price"=>"????????", "name"=>"????????????????");
                    if (empty($_REQUEST["sort_type"]) || !isset($_REQUEST["sort_type"])){
                        $_REQUEST["sort_type"] = key($arSort);
                        $_REQUEST["arrow"] = "up";
                    }
                    foreach($arSort as $code=>$name):
                        $class = "";
                        $setArrow = "up";
                        if ($_REQUEST["sort_type"] == $code && $_REQUEST["arrow"] == 'up')
                        {
                            $class = "sort_active_top";
                            $setArrow = "down";
                        }
                        elseif ($_REQUEST["sort_type"] == $code && $_REQUEST["arrow"] == 'down')
                        {
                            $class = "sort_active_bottom";
                            $setArrow = "up";
                        }
                        ?>
                        <li><a class="<?=$class?>" href="<?=$APPLICATION->GetCurPageParam('sort_type='.$code.'&arrow='.$setArrow, Array('sort_type', 'arrow'))?>"><?=$name?></a></li>
                    <?endforeach;?>
                </ul>
                <ul class="vid_tovara not_style display_none_m display_none_mp">
                    <li>????????????????????:</li>
                    <li><a class="table_vid_tovara js_table_vid_tovara <?if ($view=='table') echo 'active_table_vid_tovara'?>" href="<?=$APPLICATION->GetCurPageParam('view=table', Array('view'))?>">????????????????</a></li>
                    <li><a class="list_vid_tovara js_list_vid_tovara <?if ($view=='list') echo 'active_list_vid_tovara'?>" href="<?=$APPLICATION->GetCurPageParam('view=list', Array('view'))?>">??????????????</a></li>
                </ul>
                <div class="clear"></div>
            </div>
            <?
            if ($_REQUEST["arrow"] == "up"){
                $sortData[2] = "SORT";
                $orderData[2] = "asc";
                $sortData[3] = "SHOWS";
                $orderData[3] = "desc";
            }
            else{
                $sortData[2] = "SORT";
                $orderData[2] = "desc";
                $sortData[3] = "SHOWS";
                $orderData[3] = "asc";
            }
            switch ($_REQUEST["sort_type"]){
                case "popular":
                    if ($_REQUEST["arrow"] == "up"){
                        $sortData[1] = "PROPERTYSORT_INDIKATOR";
                        $orderData[1] = "asc";
                    }
                    else{
                        $sortData[1] = "PROPERTYSORT_INDIKATOR";
                        $orderData[1] = "desc";
                    }
                    break;
                case "price":
                    if ($_REQUEST["arrow"] == "up"){
                        $sortData[1] = "CATALOG_PRICE_1";
                        $orderData[1] = "asc";
                    }
                    else{
                        $sortData[1] = "CATALOG_PRICE_1";
                        $orderData[1] = "desc";
                    }
                    break;
                case "name":
                    if ($_REQUEST["arrow"] == "up"){
                        $sortData[1] = "NAME";
                        $orderData[1] = "asc";
                    }
                    else{
                        $sortData[1] = "NAME";
                        $orderData[1] = "desc";
                    }
                    break;
            }
            ?>
        <?else:?>
            <div class="sortirovka_block">
                <ul class="sortirovka not_style">
                    <li>?????????????????????? ????:</li>
                    <?
                    $arSort = Array("price"=>"????????", "show_counter"=>"????????????????????????", "name"=>"????????????????");
                    foreach($arSort as $code=>$name):
                        $class = "";
                        $orderUrl = "asc";
                        if ($sort == $code && $order == 'asc')
                        {
                            $class = "sort_active_bottom";
                            $orderUrl = "desc";
                        }
                        elseif ($sort == $code && $order == 'desc')
                        {
                            $class = "sort_active_top";
                            $orderUrl = "asc";
                        }
                        ?>
                        <li><a class="<?=$class?>" href="<?=$APPLICATION->GetCurPageParam('sort='.$code.'&order='.$orderUrl, Array('sort', 'order'))?>"><?=$name?></a></li>
                    <?endforeach;?>
                </ul>
                <ul class="vid_tovara not_style display_none_m display_none_mp">
                    <li>????????????????????:</li>
                    <li><a class="table_vid_tovara js_table_vid_tovara <?if ($view=='table') echo 'active_table_vid_tovara'?>" href="<?=$APPLICATION->GetCurPageParam('view=table', Array('view'))?>">????????????????</a></li>
                    <li><a class="list_vid_tovara js_list_vid_tovara <?if ($view=='list') echo 'active_list_vid_tovara'?>" href="<?=$APPLICATION->GetCurPageParam('view=list', Array('view'))?>">??????????????</a></li>
                </ul>
                <div class="clear"></div>
            </div>
            <?if ($sort == 'price') $sort = "CATALOG_PRICE_1";?>
        <?endif;?>
        <?
        if($_REQUEST['new_catalog'] == 'Y')
        {
            if($view == 'table')
            {
                $view = 'new_table';   
            }    
        }
        ?>
        <?$intSectionID = $APPLICATION->IncludeComponent(
            'salavey:catalog.section.inherited',
			$view,
			array(
				"IBLOCK_TYPE" => $arParams["IBLOCK_TYPE"],
				"IBLOCK_ID" => $arParams["IBLOCK_ID"],
                "ELEMENT_SORT_FIELD" => $sortData[1],
                "ELEMENT_SORT_ORDER" => $orderData[1],
				"ELEMENT_SORT_FIELD2" => $sortData[2],
				"ELEMENT_SORT_ORDER2" => $orderData[2],
				"ELEMENT_SORT_FIELD3" => $sortData[3],
				"ELEMENT_SORT_ORDER3" => $orderData[3],
				"USE_DISCOUNT_SORT" => 'Y',
				"PROPERTY_CODE" => $arParams["LIST_PROPERTY_CODE"],
				"META_KEYWORDS" => $arParams["LIST_META_KEYWORDS"],
				"META_DESCRIPTION" => $arParams["LIST_META_DESCRIPTION"],
				"BROWSER_TITLE" => $arParams["LIST_BROWSER_TITLE"],
				"SET_LAST_MODIFIED" => $arParams["SET_LAST_MODIFIED"],
				"INCLUDE_SUBSECTIONS" => $arParams["INCLUDE_SUBSECTIONS"],
				"BASKET_URL" => $arParams["BASKET_URL"],
				"ACTION_VARIABLE" => $arParams["ACTION_VARIABLE"],
				"PRODUCT_ID_VARIABLE" => $arParams["PRODUCT_ID_VARIABLE"],
				"SECTION_ID_VARIABLE" => $arParams["SECTION_ID_VARIABLE"],
				"PRODUCT_QUANTITY_VARIABLE" => $arParams["PRODUCT_QUANTITY_VARIABLE"],
				"PRODUCT_PROPS_VARIABLE" => $arParams["PRODUCT_PROPS_VARIABLE"],
				"FILTER_NAME" => $arParams["FILTER_NAME"],
				"CACHE_TYPE" => $arParams["CACHE_TYPE"],
				"CACHE_TIME" => $arParams["CACHE_TIME"],
				"CACHE_FILTER" => $arParams["CACHE_FILTER"],
				"CACHE_GROUPS" => $arParams["CACHE_GROUPS"],
				"SET_TITLE" => $arParams["SET_TITLE"],
				"MESSAGE_404" => $arParams["MESSAGE_404"],
				"SET_STATUS_404" => $arParams["SET_STATUS_404"],
				"SHOW_404" => $arParams["SHOW_404"],
				"FILE_404" => $arParams["FILE_404"],
				"DISPLAY_COMPARE" => $arParams["USE_COMPARE"],
				"PAGE_ELEMENT_COUNT" => $arParams["PAGE_ELEMENT_COUNT"],
				"LINE_ELEMENT_COUNT" => $arParams["LINE_ELEMENT_COUNT"],
				"PRICE_CODE" => $arParams["PRICE_CODE"],
				"USE_PRICE_COUNT" => $arParams["USE_PRICE_COUNT"],
				"SHOW_PRICE_COUNT" => $arParams["SHOW_PRICE_COUNT"],

				"PRICE_VAT_INCLUDE" => $arParams["PRICE_VAT_INCLUDE"],
				"USE_PRODUCT_QUANTITY" => $arParams['USE_PRODUCT_QUANTITY'],
				"ADD_PROPERTIES_TO_BASKET" => (isset($arParams["ADD_PROPERTIES_TO_BASKET"]) ? $arParams["ADD_PROPERTIES_TO_BASKET"] : ''),
				"PARTIAL_PRODUCT_PROPERTIES" => (isset($arParams["PARTIAL_PRODUCT_PROPERTIES"]) ? $arParams["PARTIAL_PRODUCT_PROPERTIES"] : ''),
				"PRODUCT_PROPERTIES" => $arParams["PRODUCT_PROPERTIES"],

				"DISPLAY_TOP_PAGER" => $arParams["DISPLAY_TOP_PAGER"],
				"DISPLAY_BOTTOM_PAGER" => $arParams["DISPLAY_BOTTOM_PAGER"],
				"PAGER_TITLE" => $arParams["PAGER_TITLE"],
				"PAGER_SHOW_ALWAYS" => $arParams["PAGER_SHOW_ALWAYS"],
				"PAGER_TEMPLATE" => $arParams["PAGER_TEMPLATE"],
				"PAGER_DESC_NUMBERING" => $arParams["PAGER_DESC_NUMBERING"],
				"PAGER_DESC_NUMBERING_CACHE_TIME" => $arParams["PAGER_DESC_NUMBERING_CACHE_TIME"],
				"PAGER_SHOW_ALL" => $arParams["PAGER_SHOW_ALL"],
				"PAGER_BASE_LINK_ENABLE" => $arParams["PAGER_BASE_LINK_ENABLE"],
				"PAGER_BASE_LINK" => $arParams["PAGER_BASE_LINK"],
				"PAGER_PARAMS_NAME" => $arParams["PAGER_PARAMS_NAME"],

				"OFFERS_CART_PROPERTIES" => $arParams["OFFERS_CART_PROPERTIES"],
				"OFFERS_FIELD_CODE" => $arParams["LIST_OFFERS_FIELD_CODE"],
				"OFFERS_PROPERTY_CODE" => $arParams["LIST_OFFERS_PROPERTY_CODE"],
				"OFFERS_SORT_FIELD" => $arParams["OFFERS_SORT_FIELD"],
				"OFFERS_SORT_ORDER" => $arParams["OFFERS_SORT_ORDER"],
				"OFFERS_SORT_FIELD2" => $arParams["OFFERS_SORT_FIELD2"],
				"OFFERS_SORT_ORDER2" => $arParams["OFFERS_SORT_ORDER2"],
				"OFFERS_LIMIT" => $arParams["LIST_OFFERS_LIMIT"],

				"SECTION_ID" => $arResult["VARIABLES"]["SECTION_ID"],
				"SECTION_CODE" => $arResult["VARIABLES"]["SECTION_CODE"],
				"SECTION_URL" => $arResult["FOLDER"].$arResult["URL_TEMPLATES"]["section"],
				"DETAIL_URL" => $arResult["FOLDER"].$arResult["URL_TEMPLATES"]["element"],
				"USE_MAIN_ELEMENT_SECTION" => $arParams["USE_MAIN_ELEMENT_SECTION"],
				'CONVERT_CURRENCY' => $arParams['CONVERT_CURRENCY'],
				'CURRENCY_ID' => $arParams['CURRENCY_ID'],
				'HIDE_NOT_AVAILABLE' => $arParams["HIDE_NOT_AVAILABLE"],

				'LABEL_PROP' => $arParams['LABEL_PROP'],
				'ADD_PICT_PROP' => $arParams['ADD_PICT_PROP'],
				'PRODUCT_DISPLAY_MODE' => $arParams['PRODUCT_DISPLAY_MODE'],

				'OFFER_ADD_PICT_PROP' => $arParams['OFFER_ADD_PICT_PROP'],
				'OFFER_TREE_PROPS' => $arParams['OFFER_TREE_PROPS'],
				'PRODUCT_SUBSCRIPTION' => $arParams['PRODUCT_SUBSCRIPTION'],
				'SHOW_DISCOUNT_PERCENT' => $arParams['SHOW_DISCOUNT_PERCENT'],
				'SHOW_OLD_PRICE' => $arParams['SHOW_OLD_PRICE'],
				'MESS_BTN_BUY' => $arParams['MESS_BTN_BUY'],
				'MESS_BTN_ADD_TO_BASKET' => $arParams['MESS_BTN_ADD_TO_BASKET'],
				'MESS_BTN_SUBSCRIBE' => $arParams['MESS_BTN_SUBSCRIBE'],
				'MESS_BTN_DETAIL' => $arParams['MESS_BTN_DETAIL'],
				'MESS_NOT_AVAILABLE' => $arParams['MESS_NOT_AVAILABLE'],

				'TEMPLATE_THEME' => (isset($arParams['TEMPLATE_THEME']) ? $arParams['TEMPLATE_THEME'] : ''),
				"ADD_SECTIONS_CHAIN" => "Y",
				'ADD_TO_BASKET_ACTION' => $basketAction,
				'SHOW_CLOSE_POPUP' => isset($arParams['COMMON_SHOW_CLOSE_POPUP']) ? $arParams['COMMON_SHOW_CLOSE_POPUP'] : '',
				'COMPARE_PATH' => $arResult['FOLDER'].$arResult['URL_TEMPLATES']['compare'],
				'BACKGROUND_IMAGE' => (isset($arParams['SECTION_BACKGROUND_IMAGE']) ? $arParams['SECTION_BACKGROUND_IMAGE'] : ''),
				'DISABLE_INIT_JS_IN_COMPONENT' => (isset($arParams['DISABLE_INIT_JS_IN_COMPONENT']) ? $arParams['DISABLE_INIT_JS_IN_COMPONENT'] : ''),
				//"IN_BASKET" => $arParams['IN_BASKET'],
			),
			$component
		);?>
        
        <?
        /*$infoThisSection = CIBlockSection::GetByID($arResult["VARIABLES"]["SECTION_ID"])->GetNext();
        if ($infoThisSection["DEPTH_LEVEL"]>1){
            $filter = array(
                "IBLOCK_ID" => 1,
                "<=LEFT_BORDER" => $infoThisSection["LEFT_MARGIN"]-1,
                ">=RIGHT_BORDER" => $infoThisSection["RIGHT_MARGIN"]+1,
                "DEPTH_LEVEL" => 1
            );
            $description = CIBlockSection::GetList(array(),$filter)->GetNext()["~DESCRIPTION"];
        }*/
        ?>
        <?$APPLICATION->ShowViewContent("catalog_menu_mini");///testdiada.webtm.ru/public_html/bitrix/templates/.default/components/bitrix/catalog/catalog/bitrix/catalog.section.list/.default/component_epilog.php?>
        <?/*$APPLICATION->IncludeComponent(
            "bitrix:catalog.section.list",
            "mini",
            array(
                "IBLOCK_TYPE" => $arParams["IBLOCK_TYPE"],
                "IBLOCK_ID" => $arParams["IBLOCK_ID"],
                "SECTION_ID" => $arResult["VARIABLES"]["SECTION_ID"],
                "SECTION_CODE" => $arResult["VARIABLES"]["SECTION_CODE"],
                "CACHE_TYPE" => $arParams["CACHE_TYPE"],
                "CACHE_TIME" => $arParams["CACHE_TIME"],
                "CACHE_GROUPS" => $arParams["CACHE_GROUPS"],
                //"COUNT_ELEMENTS" => $arParams["SECTION_COUNT_ELEMENTS"],
                "COUNT_ELEMENTS" => "N",
                "SECTION_URL" => $arResult["FOLDER"].$arResult["URL_TEMPLATES"]["section"],
                "VIEW_MODE" => $arParams["SECTIONS_VIEW_MODE"],
                "SHOW_PARENT_NAME" => $arParams["SECTIONS_SHOW_PARENT_NAME"],
                "HIDE_SECTION_NAME" => (isset($arParams["SECTIONS_HIDE_SECTION_NAME"]) ? $arParams["SECTIONS_HIDE_SECTION_NAME"] : "N"),
                "ADD_SECTIONS_CHAIN" => "N",
                "SECTION_USER_FIELDS" => array('UF_WHERE_VIEW'),
            ),
            $component,
            array("HIDE_ICONS" => "Y")
        );*/
        ?>
        
		<div class="bottom_descr">
        <?php if(!strstr($_SERVER['REQUEST_URI'],'?')) 
        {
        	$old = array('http://www.diada-arms.ru', 'http://diada-arms.ru','https://diada-arms.ru');
        	$new = array('https://www.diada-arms.ru','https://www.diada-arms.ru','https://www.diada-arms.ru');
            echo "<!--bottom_descr-->";
        	echo str_replace($old, $new, $arCurSection["~DESCRIPTION"]);
        }
        ?>
    	</div>

        <?
        $APPLICATION->IncludeComponent(
            "salavey:catalog.section.inherited",
            "big_data",
            array(
                "IBLOCK_TYPE" => $arParams["IBLOCK_TYPE"],
                "IBLOCK_ID" => $arParams["IBLOCK_ID"],
                "ELEMENT_SORT_FIELD" => $arParams["ELEMENT_SORT_FIELD"],
                "ELEMENT_SORT_ORDER" => $arParams["ELEMENT_SORT_ORDER"],
                "ELEMENT_SORT_FIELD2" => $arParams["ELEMENT_SORT_FIELD2"],
                "ELEMENT_SORT_ORDER2" => $arParams["ELEMENT_SORT_ORDER2"],
                "PROPERTY_CODE" => $arParams["LIST_PROPERTY_CODE"],
                "PROPERTY_CODE_MOBILE" => $arParams["LIST_PROPERTY_CODE_MOBILE"],
                "INCLUDE_SUBSECTIONS" => $arParams["INCLUDE_SUBSECTIONS"],
                "BASKET_URL" => $arParams["BASKET_URL"],
                "ACTION_VARIABLE" => $arParams["ACTION_VARIABLE"],
                "PRODUCT_ID_VARIABLE" => $arParams["PRODUCT_ID_VARIABLE"],
                "SECTION_ID_VARIABLE" => $arParams["SECTION_ID_VARIABLE"],
                "PRODUCT_QUANTITY_VARIABLE" => $arParams["PRODUCT_QUANTITY_VARIABLE"],
                "PRODUCT_PROPS_VARIABLE" => $arParams["PRODUCT_PROPS_VARIABLE"],
                "CACHE_TYPE" => $arParams["CACHE_TYPE"],
                "CACHE_TIME" => $arParams["CACHE_TIME"],
                "CACHE_FILTER" => $arParams["CACHE_FILTER"],
                "CACHE_GROUPS" => $arParams["CACHE_GROUPS"],
                "DISPLAY_COMPARE" => $arParams["USE_COMPARE"],
                "PAGE_ELEMENT_COUNT" => 0,
                "PRICE_CODE" => $arParams["~PRICE_CODE"],
                "USE_PRICE_COUNT" => $arParams["USE_PRICE_COUNT"],
                "SHOW_PRICE_COUNT" => $arParams["SHOW_PRICE_COUNT"],

                "SET_BROWSER_TITLE" => "N",
                "SET_META_KEYWORDS" => "N",
                "SET_META_DESCRIPTION" => "N",
                "SET_LAST_MODIFIED" => "N",
                "ADD_SECTIONS_CHAIN" => "N",

                "PRICE_VAT_INCLUDE" => $arParams["PRICE_VAT_INCLUDE"],
                "USE_PRODUCT_QUANTITY" => $arParams['USE_PRODUCT_QUANTITY'],
                "ADD_PROPERTIES_TO_BASKET" => (isset($arParams["ADD_PROPERTIES_TO_BASKET"]) ? $arParams["ADD_PROPERTIES_TO_BASKET"] : ''),
                "PARTIAL_PRODUCT_PROPERTIES" => (isset($arParams["PARTIAL_PRODUCT_PROPERTIES"]) ? $arParams["PARTIAL_PRODUCT_PROPERTIES"] : ''),
                "PRODUCT_PROPERTIES" => $arParams["PRODUCT_PROPERTIES"],

                "OFFERS_CART_PROPERTIES" => $arParams["OFFERS_CART_PROPERTIES"],
                "OFFERS_FIELD_CODE" => $arParams["LIST_OFFERS_FIELD_CODE"],
                "OFFERS_PROPERTY_CODE" => $arParams["LIST_OFFERS_PROPERTY_CODE"],
                "OFFERS_SORT_FIELD" => $arParams["OFFERS_SORT_FIELD"],
                "OFFERS_SORT_ORDER" => $arParams["OFFERS_SORT_ORDER"],
                "OFFERS_SORT_FIELD2" => $arParams["OFFERS_SORT_FIELD2"],
                "OFFERS_SORT_ORDER2" => $arParams["OFFERS_SORT_ORDER2"],
                "OFFERS_LIMIT" => $arParams["LIST_OFFERS_LIMIT"],

                "SECTION_ID" => $intSectionID,
                "SECTION_CODE" => "",
                "SECTION_URL" => $arResult["FOLDER"].$arResult["URL_TEMPLATES"]["section"],
                "DETAIL_URL" => $arResult["FOLDER"].$arResult["URL_TEMPLATES"]["element"],
                "USE_MAIN_ELEMENT_SECTION" => $arParams["USE_MAIN_ELEMENT_SECTION"],
                'CONVERT_CURRENCY' => $arParams['CONVERT_CURRENCY'],
                'CURRENCY_ID' => $arParams['CURRENCY_ID'],
                'HIDE_NOT_AVAILABLE' => $arParams["HIDE_NOT_AVAILABLE"],
                'HIDE_NOT_AVAILABLE_OFFERS' => $arParams["HIDE_NOT_AVAILABLE_OFFERS"],

                'LABEL_PROP' => $arParams['LABEL_PROP'],
                'LABEL_PROP_MOBILE' => $arParams['LABEL_PROP_MOBILE'],
                'LABEL_PROP_POSITION' => $arParams['LABEL_PROP_POSITION'],
                'ADD_PICT_PROP' => $arParams['ADD_PICT_PROP'],
                'PRODUCT_DISPLAY_MODE' => $arParams['PRODUCT_DISPLAY_MODE'],
                'PRODUCT_BLOCKS_ORDER' => $arParams['LIST_PRODUCT_BLOCKS_ORDER'],
                'PRODUCT_ROW_VARIANTS' => "[{'VARIANT':'3','BIG_DATA':true}]",
                'ENLARGE_PRODUCT' => $arParams['LIST_ENLARGE_PRODUCT'],
                'ENLARGE_PROP' => isset($arParams['LIST_ENLARGE_PROP']) ? $arParams['LIST_ENLARGE_PROP'] : '',
                'SHOW_SLIDER' => $arParams['LIST_SHOW_SLIDER'],
                'SLIDER_INTERVAL' => isset($arParams['LIST_SLIDER_INTERVAL']) ? $arParams['LIST_SLIDER_INTERVAL'] : '',
                'SLIDER_PROGRESS' => isset($arParams['LIST_SLIDER_PROGRESS']) ? $arParams['LIST_SLIDER_PROGRESS'] : '',

                "DISPLAY_TOP_PAGER" => 'N',
                "DISPLAY_BOTTOM_PAGER" => 'N',
                "HIDE_SECTION_DESCRIPTION" => "Y",

                "RCM_TYPE" => isset($arParams['BIG_DATA_RCM_TYPE']) ? $arParams['BIG_DATA_RCM_TYPE'] : '',
                "SHOW_FROM_SECTION" => 'Y',

                'OFFER_ADD_PICT_PROP' => $arParams['OFFER_ADD_PICT_PROP'],
                'OFFER_TREE_PROPS' => $arParams['OFFER_TREE_PROPS'],
                'PRODUCT_SUBSCRIPTION' => $arParams['PRODUCT_SUBSCRIPTION'],
                'SHOW_DISCOUNT_PERCENT' => $arParams['SHOW_DISCOUNT_PERCENT'],
                'DISCOUNT_PERCENT_POSITION' => $arParams['DISCOUNT_PERCENT_POSITION'],
                'SHOW_OLD_PRICE' => $arParams['SHOW_OLD_PRICE'],
                'SHOW_MAX_QUANTITY' => $arParams['SHOW_MAX_QUANTITY'],
                'MESS_SHOW_MAX_QUANTITY' => (isset($arParams['~MESS_SHOW_MAX_QUANTITY']) ? $arParams['~MESS_SHOW_MAX_QUANTITY'] : ''),
                'RELATIVE_QUANTITY_FACTOR' => (isset($arParams['RELATIVE_QUANTITY_FACTOR']) ? $arParams['RELATIVE_QUANTITY_FACTOR'] : ''),
                'MESS_RELATIVE_QUANTITY_MANY' => (isset($arParams['~MESS_RELATIVE_QUANTITY_MANY']) ? $arParams['~MESS_RELATIVE_QUANTITY_MANY'] : ''),
                'MESS_RELATIVE_QUANTITY_FEW' => (isset($arParams['~MESS_RELATIVE_QUANTITY_FEW']) ? $arParams['~MESS_RELATIVE_QUANTITY_FEW'] : ''),
                'MESS_BTN_BUY' => (isset($arParams['~MESS_BTN_BUY']) ? $arParams['~MESS_BTN_BUY'] : ''),
                'MESS_BTN_ADD_TO_BASKET' => (isset($arParams['~MESS_BTN_ADD_TO_BASKET']) ? $arParams['~MESS_BTN_ADD_TO_BASKET'] : ''),
                'MESS_BTN_SUBSCRIBE' => (isset($arParams['~MESS_BTN_SUBSCRIBE']) ? $arParams['~MESS_BTN_SUBSCRIBE'] : ''),
                'MESS_BTN_DETAIL' => (isset($arParams['~MESS_BTN_DETAIL']) ? $arParams['~MESS_BTN_DETAIL'] : ''),
                'MESS_NOT_AVAILABLE' => (isset($arParams['~MESS_NOT_AVAILABLE']) ? $arParams['~MESS_NOT_AVAILABLE'] : ''),
                'MESS_BTN_COMPARE' => (isset($arParams['~MESS_BTN_COMPARE']) ? $arParams['~MESS_BTN_COMPARE'] : ''),

                'USE_ENHANCED_ECOMMERCE' => (isset($arParams['USE_ENHANCED_ECOMMERCE']) ? $arParams['USE_ENHANCED_ECOMMERCE'] : ''),
                'DATA_LAYER_NAME' => (isset($arParams['DATA_LAYER_NAME']) ? $arParams['DATA_LAYER_NAME'] : ''),
                'BRAND_PROPERTY' => (isset($arParams['BRAND_PROPERTY']) ? $arParams['BRAND_PROPERTY'] : ''),

                'TEMPLATE_THEME' => (isset($arParams['TEMPLATE_THEME']) ? $arParams['TEMPLATE_THEME'] : ''),
                'ADD_TO_BASKET_ACTION' => $basketAction,
                'SHOW_CLOSE_POPUP' => isset($arParams['COMMON_SHOW_CLOSE_POPUP']) ? $arParams['COMMON_SHOW_CLOSE_POPUP'] : '',
                'COMPARE_PATH' => $arResult['FOLDER'].$arResult['URL_TEMPLATES']['compare'],
                'COMPARE_NAME' => $arParams['COMPARE_NAME'],
                'USE_COMPARE_LIST' => 'Y',
                'BACKGROUND_IMAGE' => '',
                'DISABLE_INIT_JS_IN_COMPONENT' => (isset($arParams['DISABLE_INIT_JS_IN_COMPONENT']) ? $arParams['DISABLE_INIT_JS_IN_COMPONENT'] : ''),
                "COMPOSITE_FRAME_MODE" => "Y",
                "COMPOSITE_FRAME_TYPE" => "DYNAMIC_WITH_STUB_LOADING",
            ),
            $component
        );
        ?>
	</div>
</div>