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
?>
<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <link href="/print_page/css/reset.css" rel="stylesheet" type="text/css" >
    <link href="/print_page/css/style.css" rel="stylesheet" type="text/css" >
    <link href="/font/font.css" rel="stylesheet" type="text/css" >
    <script type="text/javascript" src="/js/jquery-1.8.3.min.js"></script>
    <script type="text/javascript" src="/js/main.js"></script>
</head>
<body>
<script>window.print();</script>
<header>
    <div class="produce_img">
        <img src="<?=$arResult["DETAIL_PICTURE"]["SRC"]?>" alt="">
    </div>
    <div class="header_info">
        <div class="header_logo">
            <img src="/img/logo.png">
        </div>
        <div class="header_info_www">www.diada-arms.ru</div>
        <div class="header_info_tel"><span>8 (800) 333-07-42 </span>(Бесплатный звонок)</div>
    </div>
</header>
<section>
    <div class="detail_page_title"><?=$arResult["NAME"]?></div>
    <?$listComplect = array("SET_BASE" => "Базовый","SET_MASTER" => "Мастер","SET_PROFI" => "Профи");?>
    <div class="produce_complect_block clear_after">
    <?foreach ($listComplect as $complectationProp=>$nameComplect):?>
        <?$productComplectation = array();?>
        <?if ((
                $complectationProp == "SET_BASE")
                ||
                (
                        isset($arResult["PROPERTIES"][$complectationProp]["VALUE"])
                        &&
                        is_array($arResult["PROPERTIES"][$complectationProp]["VALUE"])
                        &&
                        count($arResult["PROPERTIES"][$complectationProp]["VALUE"])>0
                )
            ):?>
            <?
            $resElements = CIBlockElement::GetList(array(),array("IBLOCK_ID" => 1,"ID" => $arResult["ID"]));
            while ($product = $resElements->GetNext()){
                $productComplectation[] = $product;
            }
            if (
                isset($arResult["PROPERTIES"][$complectationProp]["VALUE"])
                &&
                is_array($arResult["PROPERTIES"][$complectationProp]["VALUE"])
                &&
                count($arResult["PROPERTIES"][$complectationProp]["VALUE"])>0
            ){
                $resElements = CIBlockElement::GetList(array(),array("IBLOCK_ID" => 1,"ID" => $arResult["PROPERTIES"][$complectationProp]["VALUE"]));
                while ($product = $resElements->GetNext()){
                    $productComplectation[] = $product;
                }
            }
            $AllPrice = 0;
            $AllPriceFull = 0;
            foreach ($productComplectation as $product){
                $priceProduct = CPrice::GetBasePrice($product["ID"]);
                $AllPriceFull += $priceProduct["PRICE"];
                $priceProductOptimal = CCatalogProduct::GetOptimalPrice($product["ID"],1,CUser::GetUserGroupArray(),"N",array(),"s1");
                $AllPrice += $priceProductOptimal["DISCOUNT_PRICE"];
            }?>
            <div class="produce_complect_el">
                <div class="produce_complect_el_price"><?=$arResult["PROPERTIES"][$complectationProp]["NAME"]?>
                    <?if ($arResult["PROPERTIES"][$complectationProp."_DISCOUNT"]["VALUE"]>0):?>
                        <?$AllPrice = $AllPrice-$arResult["PROPERTIES"][$complectationProp."_DISCOUNT"]["VALUE"];?>
                    <?endif;?>
                    <?if ($AllPrice == $AllPriceFull):?>
                        <span><?=number_format($AllPrice,0,"."," ")?> руб.</span>
                    <?else:?>
                        <span><?=number_format($AllPrice,0,"."," ")?> руб.
                            <span class="detail_complect_el_old_price"><?=$AllPriceFull?> руб.</span>
                        </span>
                    <?endif;?>
                </div>
                <div>
                    <div class="detail_complect_dop_info_black_title">СОДЕРЖАНИЕ:</div>
                    <div class="detail_complect_dop_info_red_title">КОМПЛЕКТ <span><?=$nameComplect?></span></div>
                    <ul class="detail_complect_dop_info_list">
                        <?foreach ($productComplectation as $product):?>
                            <li><b><?=$product["NAME"]?></b></li>
                        <?endforeach;?>
                    </ul>
                </div>
                <?if ($AllPrice != $AllPriceFull):?>
                    <div class="detail_complect_dop_info_price" style="display: block;">Экономия: <span><?=number_format($AllPriceFull-$AllPrice,0,"."," ")?>&nbsp;руб.</span></div>
                <?endif;?>
            </div>
        <?endif;?>
    <?endforeach;?>
    </div>
    <table class="detail_table_option">
        <tbody>
            <tr>
                <?$iCounter = 0;?>
                <?
                $resListSectionThisElem = CIBlockElement::GetElementGroups($arResult["ID"]);
                $nextSection = true;
                while (($arr = $resListSectionThisElem->GetNext()) && $nextSection) {
                    if ($arr["ID"] > 0) {
                        $paramProps = CIBlockElement::GetList(array(), array("IBLOCK_ID" => 27, "PROPERTY_4945" => $arr["ID"]))->GetNextElement();
                        $listProp = array();
                        if ($paramProps) {
                            $showListProps = $paramProps->GetProperty(4940);
                            $showListPropsForGroup = $paramProps->GetProperty(4942);
                            $listProp["START"] = $paramProps->GetProperty(4943)["VALUE"];
                            $listProp["STOP"] = $paramProps->GetProperty(4944)["VALUE"];
                            $listProp["ADD"] = $paramProps->GetProperty(4947)["VALUE"];
                            $listProp["DELETE"] = $paramProps->GetProperty(4946)["VALUE"];
                            if (($showListProps["VALUE_XML_ID"] == "Y") && (CSite::InGroup($showListPropsForGroup["VALUE_XML_ID"]))) {
                                if (
                                    ($listProp["START"] > 0)
                                    &&
                                    ($listProp["STOP"] > 0)
                                    &&
                                    ($listProp["START"] < $listProp["STOP"])
                                ) {
                                    ?>
                                    <?foreach($arResult["PROPERTIES"] as $code=>$arP):?>
                                        <?if (
                                            (($arP['ID'] >= $listProp["START"] && $arP['ID'] <= $listProp["STOP"]) || (in_array($arP['ID'], $listProp["ADD"])))
                                            &&
                                            ($arP['VALUE'] && !in_array($arP['ID'], $listProp["DELETE"]))
                                        ): ?>
                                            <?$iCounter++?>
                                            <td><?=$arP['NAME']?>:</td>
                                            <td><?=(is_array($arP['VALUE']))?implode('/', $arP['VALUE']):$arP['VALUE']?></td>
                                            <?if (!($iCounter&1)) echo "</tr><tr>"?>
                                        <?endif;?>
                                    <?endforeach;?>
                                    <?
                                    $showedOtherTable = true;
                                    $nextSection = false;
                                }
                            }
                        }
                    }
                }
                ?>
            </tr>
        </tbody>
    </table>
</section>
</body>
</html>
