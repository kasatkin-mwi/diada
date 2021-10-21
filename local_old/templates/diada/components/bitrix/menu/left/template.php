<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<?$this->setFrameMode(true);?>
<?if (!empty($arResult)):?>

<ul class="catalog_menu_light">
<?
$previousLevel = 0;
$i=0;
$iCounter = 0;
$closeHide = false;
$hideChildre = false; 
    foreach($arResult["DESCTOP_ITEMS"] as $arItem):?>
        <?if ($arItem["PARAMS"]["HIDE_DESCTOP"] == "Y"){
            $hideChildre = true;
            continue;
        }
        if ($hideChildre && $arItem["DEPTH_LEVEL"]>1){
            continue;
        }
        else{
            $hideChildre = false;
        }
        ?>
        <?/*if ($arItem["DEPTH_LEVEL"]==1){
            $iCounter++;
            if ($iCounter == 12){
                echo '<li class="show_other"><a href="javascript:void(0);"><i></i><span>Еще...</span></a></li>';
            }
        }*/?>
        <?if ($previousLevel && $arItem["DEPTH_LEVEL"] < $previousLevel):
            if ($arItem["DEPTH_LEVEL"]==1) echo "</div></li>";
        endif;?>
        <?/*$arItem["TEXT"] .= " -- ".$count_depth_2*/?>
        <?if ($arItem["IS_PARENT"] && ($arItem["DEPTH_LEVEL"] == 1)):?>
            <li class="<?if ($iCounter >= 12):?>hide_section<?endif;?>"><a href="<?=$arItem["LINK"]?>">
                    <span class="icon"><img src="<?=$arItem['PARAMS']['PICTURE']?>"/></span>
                    <span><?=$arItem["TEXT"]?></span>
                </a>
                <div class="menu_lvl2">
        <?else:?>
            <?if ($arItem["DEPTH_LEVEL"] == 1):?>
                <li class="<?if ($iCounter >= 12):?>hide_section<?endif;?>"><a href="<?=$arItem["LINK"]?>">
                    <span class="icon"><img src="<?=$arItem['PARAMS']['PICTURE']?>"/></span>
                    <span><?=$arItem["TEXT"]?></span>
                </a></li>
            <?elseif ($arItem["DEPTH_LEVEL"] == 2):?>
                <a class="item_lvl2" href="<?=$arItem["LINK"]?>"><?=$arItem["TEXT"]?></a>
            <?elseif ($arItem["DEPTH_LEVEL"] == 3):?>
                <a class="item_lvl3" href="<?=$arItem["LINK"]?>"><?=$arItem["TEXT"]?></a>
            <?endif?>
        <?endif?>
        <?$previousLevel = $arItem["DEPTH_LEVEL"];?>
        <?if ($arItem["DEPTH_LEVEL"] == 1) $i++;?>
    <?endforeach?>
    <?if ($arItem["DEPTH_LEVEL"]>1):
        if ($arItem["DEPTH_LEVEL"]==1) echo "</div></li>";
    endif;?>
</ul>
<?endif?>