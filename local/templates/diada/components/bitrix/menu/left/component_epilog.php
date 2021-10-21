<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<?
global $USER,$APPLICATION;
ob_start();
?>
<?if (!empty($arResult["MOBILE_ITEMS"])):?>
<ul class="mobile_catalog_menu_light">
    <?
    $previousLevel = 0;
    $lastNameSection = array();
    foreach($arResult["MOBILE_ITEMS"] as $arItem):?>
        <?if ($arItem["DEPTH_LEVEL"]>4) continue;?>
        <?$lastNameSection[$arItem["DEPTH_LEVEL"]] = $arItem["TEXT"]?>
        <?if ($previousLevel && $arItem["DEPTH_LEVEL"] < $previousLevel):
            if ($arItem["DEPTH_LEVEL"]==1 && ($previousLevel == 4)) echo "</ul></div></div></li> </ul></div></div></li> </ul></div></li>";
            if ($arItem["DEPTH_LEVEL"]==1 && ($previousLevel == 3)) echo "</ul></div></div></li> </ul></div></li>";
            if ($arItem["DEPTH_LEVEL"]==1 && $previousLevel == 2) echo "</ul></div></li>";
            if ($arItem["DEPTH_LEVEL"]==2 && ($previousLevel == 4)) echo "</ul></div></div></li> </ul></div></li>";
            if ($arItem["DEPTH_LEVEL"]==2 && ($previousLevel == 3)) echo "</ul></div></div></li>";
            if ($arItem["DEPTH_LEVEL"]==3 && ($previousLevel == 4)) echo "</ul></div></div></li>";
        endif;?>
        <?if ($arItem["IS_PARENT"] && $arItem["DEPTH_LEVEL"]<4):?>
            <?if ($arItem["DEPTH_LEVEL"] == 1):?>
                <li data-lvl="<?=$arItem["DEPTH_LEVEL"]?>" class="<?=$arItem["PARAMS"]["CLASS"]?>">
                    <a class="menu_lvl0_button <?if ($arItem["PARAMS"]["HIDE_BUTTON"] != "Y"):?>js_menu_lvl0_button<?endif;?>" href="<?=$arItem["LINK"]?>"><span><?=$arItem["TEXT"]?></span></a>
                    <div class="menu_lvl1 js_menu_lvl1">
                    <ul>
            <?elseif(($arItem["DEPTH_LEVEL"] == 2) || ($arItem["DEPTH_LEVEL"] == 3)):?>
                <li data-lvl="<?=$arItem["DEPTH_LEVEL"]?>"><a class="menu_lvl1_button <?if ($arItem["PARAMS"]["HIDE_BUTTON"] != "Y"):?>js_menu_lvl<?=$arItem["DEPTH_LEVEL"]-1?>_button<?endif;?>" href="<?=$arItem["LINK"]?>"><span><?=$arItem["TEXT"]?></span></a>
                    <div class="menu_lvl<?=$arItem["DEPTH_LEVEL"]?> js_menu_lvl<?=$arItem["DEPTH_LEVEL"]?>">
                        <div class="menu_lvl<?=$arItem["DEPTH_LEVEL"]?>_scroll ">
                            <div class="mobile_catalog_menu_come_back js_mobile_catalog_menu_come_back<?=$arItem["DEPTH_LEVEL"]?>"><a href="">Назад</a></div>
                            <div class="mobile_catalog_menu_rezdel_name"><a href="<?=$arItem["LINK"]?>"><span><?=$lastNameSection[$arItem["DEPTH_LEVEL"]]?></span></a></div>
                                <ul>
            <?else:?>
                <li data-lvl="<?=$arItem["DEPTH_LEVEL"]?>"><a href="<?=$arItem["LINK"]?>"><span><?=$arItem["TEXT"]?></span></a></li>
            <?endif?>
        <?else:?>
            <?if ($arItem["DEPTH_LEVEL"] == 1):?>
                <li data-lvl="n-<?=$arItem["DEPTH_LEVEL"]?>" class="<?=$arItem["PARAMS"]["CLASS"]?>">
                <a class="<?/*if ($arItem["PARAMS"]["HIDE_BUTTON"] != "Y"):?>js_menu_lvl0_button<?endif;*/?>" href="<?=$arItem["LINK"]?>">
                    <span><?=$arItem["TEXT"]?></span></a></li>
            <?elseif (($arItem["DEPTH_LEVEL"] == 2)):?>
                <li data-lvl="n-<?=$arItem["DEPTH_LEVEL"]?>" class="<?=$arItem["PARAMS"]["CLASS"]?>">
                     <a href="<?=$arItem["LINK"]?>" class="menu_lvl1_button  <?/*if ($arItem["PARAMS"]["HIDE_BUTTON"] != "Y"):?>js_menu_lvl1_button<?endif;*/?>" href="<?=$arItem["LINK"]?>">
                    <span><?=$arItem["TEXT"]?></span></a>
                </li>
            <?elseif (($arItem["DEPTH_LEVEL"] == 3)):?>
                <li data-lvl="n-<?=$arItem["DEPTH_LEVEL"]?>" class="<?=$arItem["PARAMS"]["CLASS"]?>">
                     <a href="<?=$arItem["LINK"]?>" class="menu_lvl1_button <?/*if ($arItem["PARAMS"]["HIDE_BUTTON"] != "Y"):?>js_menu_lvl1_button<?endif;?>" href="<?=$arItem["LINK"]*/?>">
                    <span><?=$arItem["TEXT"]?></span></a>
                </li>
            <?elseif ($arItem["DEPTH_LEVEL"] == 4):?>
                <li data-lvl="n-<?=$arItem["DEPTH_LEVEL"]?>"><a class="menu_lvl1_button" href="<?=$arItem["LINK"]?>"><span><?=$arItem["TEXT"]?></span></a></li>
            <?endif?>
        <?endif?>
        <?$previousLevel = $arItem["DEPTH_LEVEL"];?>
    <?endforeach?>
    <?if ($arItem["DEPTH_LEVEL"] && $arItem["IS_PARENT"]):
        if ($previousLevel == 4) echo "</ul></div></div></li></ul></div></div></li></ul></div></li>";
        if ($previousLevel == 3) echo "</ul></div></div></li></ul></div></li>";
        if ($arItem["DEPTH_LEVEL"]==2) echo "</ul></div></div></li>";
    endif;?>
</ul>
<?endif?>
<?
$catalog_mobile_left_menu = ob_get_contents();
ob_end_clean();
$APPLICATION->AddViewContent('catalog_mobile_left_menu', $catalog_mobile_left_menu, 1);
?>