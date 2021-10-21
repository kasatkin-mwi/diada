<?
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
?>
<?
if(intval($arParams['PRODUCT_ID']) > 0)
{
    if ($arResult["isFormNote"] != "Y")
    {
    
        $arElement = getIBlockElement($arParams['PRODUCT_ID']);
        $arPrice = CCatalogProduct::GetOptimalPrice($arElement['ID'],1,CUser::GetUserGroupArray(),"N",array(),"s1");
        
        ?>
        <div class="detail_services_ligh_title">Вы выбрали</div>
        <div class="detail_services_ligh_table">
            <table>
                <tr>
                    <?$arFile = CFile::GetFileArray($arElement['DETAIL_PICTURE'])?>
                    <td><img src="<?=$arFile['SRC']?>" alt=""/></td>
                    <td>
                        <div class="black_color"><?=$arElement['NAME']?></div>
                        <div><span class="black_color">Цена</span> <?=number_format($arPrice['DISCOUNT_PRICE'],0,"."," ")?> рублей.</div>
                    </td>
                </tr>
            </table>
        </div>
        <div class="detail_services_ligh_question">
            <div class="detail_services_ligh_question_title">Нашли этот товар дешевле?</div>
            <div><b>Зачем рисковать?</b></div>
            <div><b>Закажите его в надежном интернет-магазине по выгодной цене!</b></div>
            <div>Заполните заявку на лучшую цену и мы продадим товар по этой цене!</div>
            <div><a href="/seen_cheaper/">Полные условия акции</a></div>
        </div>
    <?
    }
    ?>
    <div class="detail_services_ligh_form">

    <?if ($arResult["isFormErrors"] == "Y"):?><?=$arResult["FORM_ERRORS_TEXT"];?><?endif;?>

    <?
    if ($arResult["isFormNote"] == "Y")
    {
        ?>
        <div class="form_success_block">     
            <?=$arResult["FORM_NOTE"]?>
        </div>
        <?
    }?>
        
    <?/*echo "<pre>";print_r($arResult);echo "</pre>";*/?>

    <?
    if ($arResult["isFormNote"] != "Y")
    {
    ?>
    <?=$arResult["FORM_HEADER"]?>

    <?
    /***********************************************************************************
                        form header
    ***********************************************************************************/
        //echo "<pre>";print_r($arResult["QUESTIONS"]);echo "</pre>";
        foreach ($arResult["QUESTIONS"] as $FIELD_SID => $arQuestion)
        {
            if ($arResult['arQuestions'][ $FIELD_SID ]['ID'] == 14) //ID = 14, Товар, должен быть hidden
            {
                $input = str_replace('type="text"', 'type="hidden"', $arQuestion["HTML_CODE"]);
                echo str_replace('value=""', 'value="'.$arParams['PRODUCT_NAME'].'"', $input);
            }
            else
            {
        ?>
            <?$arField = explode('#', $arResult['arQuestions'][ $FIELD_SID ]['COMMENTS']);?>
            <ul class="new_call_back_light_form new_call_back_podskazka">
                <li>
                    <?if (is_array($arResult["FORM_ERRORS"]) && array_key_exists($FIELD_SID, $arResult['FORM_ERRORS'])):?>
                    <span class="error-fld" title="<?=$arResult["FORM_ERRORS"][$FIELD_SID]?>"></span>
                    <?endif;?>
                    <?=$arQuestion["CAPTION"]?><?if ($arQuestion["REQUIRED"] == "Y"):?><?=$arResult["REQUIRED_SIGN"];?><?endif;?>
                    <?=$arQuestion["IS_INPUT_CAPTION_IMAGE"] == "Y" ? "<br />".$arQuestion["IMAGE"]["HTML_CODE"] : ""?>
                </li>
                <li>
                    <?echo str_replace("type", "placeholder='".$arField[0]."' type", $arQuestion["HTML_CODE"])?>
                    <p><?=$arField[1]?></p>
                </li>
            </ul>
        <?
            }
        } //endwhile
        ?>
            <div class="detail_services_ligh_button">
                <input class="detail_red_button" <?=(intval($arResult["F_RIGHT"]) < 10 ? "disabled=\"disabled\"" : "");?> type="submit" name="web_form_submit" value="<?=htmlspecialcharsbx(strlen(trim($arResult["arForm"]["BUTTON"])) <= 0 ? GetMessage("FORM_ADD") : $arResult["arForm"]["BUTTON"]);?>" />
            </div>

    <?=$arResult["FORM_FOOTER"]?>
    <?
    } //endif (isFormNote)
    ?>
    </div>
    <?    
}
?>