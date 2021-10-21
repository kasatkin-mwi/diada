<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();
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
$this->setFrameMode(false);

if (!empty($arResult["ERRORS"])):?>
	<?ShowError(implode("<br />", $arResult["ERRORS"]))?>
<?endif;
if (strlen($arResult["MESSAGE"]) > 0):?>
	<?ShowNote($arResult["MESSAGE"])?>
<?endif?>
<?
$arPropertyList = array(
    'NAME',
    5944,
    5901,
    5902,
    'PREVIEW_TEXT',
    'DETAIL_TEXT',
    5904
);
foreach ($arResult["PROPERTY_LIST"] as $key => $propertyID)
{
    if(!in_array($propertyID, $arPropertyList))
    {
        $arPropertyList[] = $propertyID;   
    }    
}

$arResult["PROPERTY_LIST"] = $arPropertyList;
?>
<div class="refund_bl">
    <form name="iblock_add" id="return_form" action="<?=POST_FORM_ACTION_URI?>" method="post" enctype="multipart/form-data">
        <?=bitrix_sessid_post()?>
        <input type="hidden" name="return_send" value="Y" />
        <div class="refund_tit">Обращение по гарантии или возврату</div>
        <div class="refund_cont" id="step_1">
            <?
            if (is_array($arResult["PROPERTY_LIST"]) && !empty($arResult["PROPERTY_LIST"]))
            {
                ?>
                <div class="refund_step_bl">
                    <div class="refund_step_el active"><div class="refund_step_bt">1</div></div>
                    <div class="refund_step_el"><div class="refund_step_bt">2</div></div>
                    <div class="refund_step_el"><div class="refund_step_bt">3</div></div>
                </div>
                <div class="refund_form_bl">
                    <?                    
                    foreach ($arResult["PROPERTY_LIST"] as $propertyID)
                    {
                        
                        if(intval($propertyID) == 5904)
                            continue;
                        ?>
                        <?
                        if (intval($propertyID) > 0)
                        {
                            if (
                                $arResult["PROPERTY_LIST_FULL"][$propertyID]["PROPERTY_TYPE"] == "T"
                                &&
                                $arResult["PROPERTY_LIST_FULL"][$propertyID]["ROW_COUNT"] == "1"
                            )
                                $arResult["PROPERTY_LIST_FULL"][$propertyID]["PROPERTY_TYPE"] = "S";
                            elseif (
                                (
                                    $arResult["PROPERTY_LIST_FULL"][$propertyID]["PROPERTY_TYPE"] == "S"
                                    ||
                                    $arResult["PROPERTY_LIST_FULL"][$propertyID]["PROPERTY_TYPE"] == "N"
                                )
                                &&
                                $arResult["PROPERTY_LIST_FULL"][$propertyID]["ROW_COUNT"] > "1"
                            )
                                $arResult["PROPERTY_LIST_FULL"][$propertyID]["PROPERTY_TYPE"] = "T";
                        }
                        elseif (($propertyID == "TAGS") && CModule::IncludeModule('search'))
                            $arResult["PROPERTY_LIST_FULL"][$propertyID]["PROPERTY_TYPE"] = "TAGS";

                        if ($arResult["PROPERTY_LIST_FULL"][$propertyID]["MULTIPLE"] == "Y")
                        {
                            $inputNum = ($arParams["ID"] > 0 || count($arResult["ERRORS"]) > 0) ? count($arResult["ELEMENT_PROPERTIES"][$propertyID]) : 0;
                            $inputNum += $arResult["PROPERTY_LIST_FULL"][$propertyID]["MULTIPLE_CNT"];
                        }
                        else
                        {
                            $inputNum = 1;
                        }

                        if($arResult["PROPERTY_LIST_FULL"][$propertyID]["GetPublicEditHTML"])
                            $INPUT_TYPE = "USER_TYPE";
                        else
                            $INPUT_TYPE = $arResult["PROPERTY_LIST_FULL"][$propertyID]["PROPERTY_TYPE"];
                         
                        switch ($INPUT_TYPE):
                            case "T":
                                for ($i = 0; $i<$inputNum; $i++)
                                {

                                    if ($arParams["ID"] > 0 || count($arResult["ERRORS"]) > 0)
                                    {
                                        $value = intval($propertyID) > 0 ? $arResult["ELEMENT_PROPERTIES"][$propertyID][$i]["VALUE"] : $arResult["ELEMENT"][$propertyID];
                                    }
                                    elseif ($i == 0)
                                    {
                                        $value = intval($propertyID) > 0 ? "" : $arResult["PROPERTY_LIST_FULL"][$propertyID]["DEFAULT_VALUE"];
                                    }
                                    else
                                    {
                                        $value = "";
                                    }
                                ?>
                                <div class="refund_form_el textarea">
                                    <textarea cols="<?=$arResult["PROPERTY_LIST_FULL"][$propertyID]["COL_COUNT"]?>" rows="<?=$arResult["PROPERTY_LIST_FULL"][$propertyID]["ROW_COUNT"]?>" name="PROPERTY[<?=$propertyID?>][<?=$i?>]" placeholder="<?if(in_array($propertyID, $arResult["PROPERTY_REQUIRED"])):?>*<?endif?><?if (intval($propertyID) > 0):?><?=$arResult["PROPERTY_LIST_FULL"][$propertyID]["NAME"]?><?else:?><?=!empty($arParams["CUSTOM_TITLE_".$propertyID]) ? $arParams["CUSTOM_TITLE_".$propertyID] : GetMessage("IBLOCK_FIELD_".$propertyID)?><?endif?>"><?=$value?></textarea>
                                </div>
                                <?
                                }
                            break;

                            case "S":
                            case "N":
                                for ($i = 0; $i<$inputNum; $i++)
                                {
                                    if ($arParams["ID"] > 0 || count($arResult["ERRORS"]) > 0)
                                    {
                                        $value = intval($propertyID) > 0 ? $arResult["ELEMENT_PROPERTIES"][$propertyID][$i]["VALUE"] : $arResult["ELEMENT"][$propertyID];
                                    }
                                    elseif ($i == 0)
                                    {
                                        $value = intval($propertyID) <= 0 ? "" : $arResult["PROPERTY_LIST_FULL"][$propertyID]["DEFAULT_VALUE"];

                                    }
                                    else
                                    {
                                        $value = "";
                                    }
                                $type = 'text';
                                if($propertyID == 5901)
                                {
                                    $type = 'number';
                                }
                                ?>
                                <div class="refund_form_el">
                                    <input type="<?=$type?>" name="PROPERTY[<?=$propertyID?>][<?=$i?>]" size="<?=$arResult["PROPERTY_LIST_FULL"][$propertyID]["COL_COUNT"]; ?>" value="<?=$value?>" placeholder="<?if(in_array($propertyID, $arResult["PROPERTY_REQUIRED"])):?>*<?endif?><?if (intval($propertyID) > 0):?><?=$arResult["PROPERTY_LIST_FULL"][$propertyID]["NAME"]?><?else:?><?=!empty($arParams["CUSTOM_TITLE_".$propertyID]) ? $arParams["CUSTOM_TITLE_".$propertyID] : GetMessage("IBLOCK_FIELD_".$propertyID)?><?endif?>" /><br /><?
                                    if($arResult["PROPERTY_LIST_FULL"][$propertyID]["USER_TYPE"] == "DateTime"):?><?
                                        $APPLICATION->IncludeComponent(
                                            'bitrix:main.calendar',
                                            '',
                                            array(
                                                'FORM_NAME' => 'iblock_add',
                                                'INPUT_NAME' => "PROPERTY[".$propertyID."][".$i."]",
                                                'INPUT_VALUE' => $value,
                                            ),
                                            null,
                                            array('HIDE_ICONS' => 'Y')
                                        );
                                        ?><br /><small><?=GetMessage("IBLOCK_FORM_DATE_FORMAT")?><?=FORMAT_DATETIME?></small><?
                                    endif
                                    ?>
                                </div>    
                                <?
                                }
                            break;

                            case "F":
                                ?>
                                <div class="refund_form_el file styler defect">
                                    <input type="hidden" name="PROPERTY[<?=$propertyID?>][0]" value="<?=$value?>" />
                                    <input multiple type="file" size="<?=$arResult["PROPERTY_LIST_FULL"][$propertyID]["COL_COUNT"]?>"  name="PROPERTY_FILE_<?=$propertyID?>_0[]" accept="image/*,video/*" />
                                </div>
                                <?
                            break;
                        endswitch;?>
                        <?    
                    }
                    ?>
                </div>
                <div class="refund_form_bt">
                    <button type="button" class="red_bt open1 nextbutton">Дальше<i class="fa fa-long-arrow-right" aria-hidden="true"></i></button>
                </div>
            <?
            }
            ?>
        </div>
        <div class="refund_cont" id="step_2" style="display: none;">
            <div class="refund_step_bl">
                <div class="refund_step_el close"><div class="refund_step_bt">1</div></div>
                <div class="refund_step_el active"><div class="refund_step_bt">2</div></div>
                <div class="refund_step_el"><div class="refund_step_bt">3</div></div>
            </div>
            <div class="refund_txt_bl">
                <div class="refund_txt">
                    <?$APPLICATION->IncludeComponent(
                        "bitrix:main.include",
                        "",
                        Array(
                            "AREA_FILE_SHOW" => "file",
                            "AREA_FILE_SUFFIX" => "inc",
                            "EDIT_TEMPLATE" => "",
                            "PATH" => "/include/return_third_step.php"
                        )
                    );?>
                </div>
                <div class="refund_prava styler">
                    <label>
                        <input type="checkbox" name="check"/>
                        Ознакомлен с <a href="/garantii/" target="_blank">гарантийными условиями</a>
                    </label>
                </div>
            </div>
            <div class="refund_form_bt">
                <a class="gray_bt prevbutton" href="javascript:void(0);">шаг назад</a>
                <button type="button" class="red_bt open2 nextbutton">Дальше<i class="fa fa-long-arrow-right" aria-hidden="true"></i></button>
            </div>
        </div>
        <div class="refund_cont" id="step_3" style="display: none;">
            <?
            if (is_array($arResult["PROPERTY_LIST"]) && !empty($arResult["PROPERTY_LIST"]))
            {
                ?>
                <div class="refund_step_bl">
                    <div class="refund_step_el close"><div class="refund_step_bt">1</div></div>
                    <div class="refund_step_el close"><div class="refund_step_bt">2</div></div>
                    <div class="refund_step_el active"><div class="refund_step_bt">3</div></div>
                </div>
                <div class="refund_txt_bl">
                    <div class="refund_txt">
                        <?$APPLICATION->IncludeComponent(
                            "bitrix:main.include",
                            "",
                            Array(
                                "AREA_FILE_SHOW" => "file",
                                "AREA_FILE_SUFFIX" => "inc",
                                "EDIT_TEMPLATE" => "",
                                "PATH" => "/include/return_second_step.php"
                            )
                        );?>
                    </div>
                    <a class="refund_pdf" href="/upload/Заявление по гарантии.pdf" target="_blank">Заявление по гарантии.pdf</a>
                </div>
                <div class="refund_form_bl">
                    <?                    
                    foreach ($arResult["PROPERTY_LIST"] as $propertyID)
                    {
                        
                        if(intval($propertyID) != 5904)
                            continue;
                        ?>
                        <?
                        if (intval($propertyID) > 0)
                        {
                            if (
                                $arResult["PROPERTY_LIST_FULL"][$propertyID]["PROPERTY_TYPE"] == "T"
                                &&
                                $arResult["PROPERTY_LIST_FULL"][$propertyID]["ROW_COUNT"] == "1"
                            )
                                $arResult["PROPERTY_LIST_FULL"][$propertyID]["PROPERTY_TYPE"] = "S";
                            elseif (
                                (
                                    $arResult["PROPERTY_LIST_FULL"][$propertyID]["PROPERTY_TYPE"] == "S"
                                    ||
                                    $arResult["PROPERTY_LIST_FULL"][$propertyID]["PROPERTY_TYPE"] == "N"
                                )
                                &&
                                $arResult["PROPERTY_LIST_FULL"][$propertyID]["ROW_COUNT"] > "1"
                            )
                                $arResult["PROPERTY_LIST_FULL"][$propertyID]["PROPERTY_TYPE"] = "T";
                        }
                        elseif (($propertyID == "TAGS") && CModule::IncludeModule('search'))
                            $arResult["PROPERTY_LIST_FULL"][$propertyID]["PROPERTY_TYPE"] = "TAGS";

                        if ($arResult["PROPERTY_LIST_FULL"][$propertyID]["MULTIPLE"] == "Y")
                        {
                            $inputNum = ($arParams["ID"] > 0 || count($arResult["ERRORS"]) > 0) ? count($arResult["ELEMENT_PROPERTIES"][$propertyID]) : 0;
                            $inputNum += $arResult["PROPERTY_LIST_FULL"][$propertyID]["MULTIPLE_CNT"];
                        }
                        else
                        {
                            $inputNum = 1;
                        }

                        if($arResult["PROPERTY_LIST_FULL"][$propertyID]["GetPublicEditHTML"])
                            $INPUT_TYPE = "USER_TYPE";
                        else
                            $INPUT_TYPE = $arResult["PROPERTY_LIST_FULL"][$propertyID]["PROPERTY_TYPE"];
                         
                        switch ($INPUT_TYPE):
                            case "T":
                                for ($i = 0; $i<$inputNum; $i++)
                                {

                                    if ($arParams["ID"] > 0 || count($arResult["ERRORS"]) > 0)
                                    {
                                        $value = intval($propertyID) > 0 ? $arResult["ELEMENT_PROPERTIES"][$propertyID][$i]["VALUE"] : $arResult["ELEMENT"][$propertyID];
                                    }
                                    elseif ($i == 0)
                                    {
                                        $value = intval($propertyID) > 0 ? "" : $arResult["PROPERTY_LIST_FULL"][$propertyID]["DEFAULT_VALUE"];
                                    }
                                    else
                                    {
                                        $value = "";
                                    }
                                ?>
                                <div class="refund_form_el textarea">
                                    <textarea cols="<?=$arResult["PROPERTY_LIST_FULL"][$propertyID]["COL_COUNT"]?>" rows="<?=$arResult["PROPERTY_LIST_FULL"][$propertyID]["ROW_COUNT"]?>" name="PROPERTY[<?=$propertyID?>][<?=$i?>]" placeholder="<?if(in_array($propertyID, $arResult["PROPERTY_REQUIRED"])):?>*<?endif?><?if (intval($propertyID) > 0):?><?=$arResult["PROPERTY_LIST_FULL"][$propertyID]["NAME"]?><?else:?><?=!empty($arParams["CUSTOM_TITLE_".$propertyID]) ? $arParams["CUSTOM_TITLE_".$propertyID] : GetMessage("IBLOCK_FIELD_".$propertyID)?><?endif?>"><?=$value?></textarea>
                                </div>
                                <?
                                }
                            break;

                            case "S":
                            case "N":
                                for ($i = 0; $i<$inputNum; $i++)
                                {
                                    if ($arParams["ID"] > 0 || count($arResult["ERRORS"]) > 0)
                                    {
                                        $value = intval($propertyID) > 0 ? $arResult["ELEMENT_PROPERTIES"][$propertyID][$i]["VALUE"] : $arResult["ELEMENT"][$propertyID];
                                    }
                                    elseif ($i == 0)
                                    {
                                        $value = intval($propertyID) <= 0 ? "" : $arResult["PROPERTY_LIST_FULL"][$propertyID]["DEFAULT_VALUE"];

                                    }
                                    else
                                    {
                                        $value = "";
                                    }
                                 
                                ?>
                                <div class="refund_form_el">
                                    <input type="text" name="PROPERTY[<?=$propertyID?>][<?=$i?>]" size="<?=$arResult["PROPERTY_LIST_FULL"][$propertyID]["COL_COUNT"]; ?>" value="<?=$value?>" placeholder="<?if(in_array($propertyID, $arResult["PROPERTY_REQUIRED"])):?>*<?endif?><?if (intval($propertyID) > 0):?><?=$arResult["PROPERTY_LIST_FULL"][$propertyID]["NAME"]?><?else:?><?=!empty($arParams["CUSTOM_TITLE_".$propertyID]) ? $arParams["CUSTOM_TITLE_".$propertyID] : GetMessage("IBLOCK_FIELD_".$propertyID)?><?endif?>" /><br /><?
                                    if($arResult["PROPERTY_LIST_FULL"][$propertyID]["USER_TYPE"] == "DateTime"):?><?
                                        $APPLICATION->IncludeComponent(
                                            'bitrix:main.calendar',
                                            '',
                                            array(
                                                'FORM_NAME' => 'iblock_add',
                                                'INPUT_NAME' => "PROPERTY[".$propertyID."][".$i."]",
                                                'INPUT_VALUE' => $value,
                                            ),
                                            null,
                                            array('HIDE_ICONS' => 'Y')
                                        );
                                        ?><br /><small><?=GetMessage("IBLOCK_FORM_DATE_FORMAT")?><?=FORMAT_DATETIME?></small><?
                                    endif
                                    ?>
                                </div>    
                                <?
                                }
                            break;

                            case "F":
                                for ($i = 0; $i<$inputNum; $i++)
                                {
                                    $value = intval($propertyID) > 0 ? $arResult["ELEMENT_PROPERTIES"][$propertyID][$i]["VALUE"] : $arResult["ELEMENT"][$propertyID];
                                    ?>
                                    <div class="refund_form_el file styler guarantee">
                                        <input type="hidden" name="PROPERTY[<?=$propertyID?>][<?=$arResult["ELEMENT_PROPERTIES"][$propertyID][$i]["VALUE_ID"] ? $arResult["ELEMENT_PROPERTIES"][$propertyID][$i]["VALUE_ID"] : $i?>]" value="<?=$value?>" />
                                        <input type="file" size="<?=$arResult["PROPERTY_LIST_FULL"][$propertyID]["COL_COUNT"]?>"  name="PROPERTY_FILE_<?=$propertyID?>_<?=$arResult["ELEMENT_PROPERTIES"][$propertyID][$i]["VALUE_ID"] ? $arResult["ELEMENT_PROPERTIES"][$propertyID][$i]["VALUE_ID"] : $i?>" accept="application/pdf, image/*" />
                                    </div>
                                    <?

                                    if (!empty($value) && is_array($arResult["ELEMENT_FILES"][$value]))
                                    {
                                        ?>
                                        <input type="checkbox" name="DELETE_FILE[<?=$propertyID?>][<?=$arResult["ELEMENT_PROPERTIES"][$propertyID][$i]["VALUE_ID"] ? $arResult["ELEMENT_PROPERTIES"][$propertyID][$i]["VALUE_ID"] : $i?>]" id="file_delete_<?=$propertyID?>_<?=$i?>" value="Y" /><label for="file_delete_<?=$propertyID?>_<?=$i?>"><?=GetMessage("IBLOCK_FORM_FILE_DELETE")?></label><br />
                                        <?

                                        if ($arResult["ELEMENT_FILES"][$value]["IS_IMAGE"])
                                        {
                                            ?>
                                            <img src="<?=$arResult["ELEMENT_FILES"][$value]["SRC"]?>" height="<?=$arResult["ELEMENT_FILES"][$value]["HEIGHT"]?>" width="<?=$arResult["ELEMENT_FILES"][$value]["WIDTH"]?>" border="0" /><br />
                                            <?
                                        }
                                        else
                                        {
                                            ?>
                                            <?=GetMessage("IBLOCK_FORM_FILE_NAME")?>: <?=$arResult["ELEMENT_FILES"][$value]["ORIGINAL_NAME"]?><br />
                                            <?=GetMessage("IBLOCK_FORM_FILE_SIZE")?>: <?=$arResult["ELEMENT_FILES"][$value]["FILE_SIZE"]?> b<br />
                                            [<a href="<?=$arResult["ELEMENT_FILES"][$value]["SRC"]?>"><?=GetMessage("IBLOCK_FORM_FILE_DOWNLOAD")?></a>]<br />
                                            <?
                                        }
                                    }
                                }

                            break;
                        endswitch;?>
                        <?    
                    }
                    ?>
                </div>
                <div class="refund_form_bt center">
                    <a class="gray_bt prevbutton" href="javascript:void(0);">шаг назад</a>
                    <input type="hidden" name="iblock_submit" value="<?=GetMessage("IBLOCK_FORM_SUBMIT")?>" />
                    <a class="red_bt big" href="javascript:void(0);" onclick="$(this).parents('form#return_form').submit();">Отправить заявку</a>
                </div>
            <?
            }
            ?>
        </div>
        <div class="refund_cont" id="step_4" style="display: none;">
            <div class="refund_cont_ok">
                <div class="refund_number">№ Заявки: <b class="request_num"></b></div>
                <div class="refund_ok_bl">
                    <i class="fa fa-check" aria-hidden="true"></i>
                    <div class="refund_ok_txt">
                        <div class="refund_ok_h1">Заявка на возврат товара успешно отправлена!</div>
                        <div class="refund_ok_h2">Через некоторое время менеджер свяжется с вами.</div>
                        <div class="refund_ok_h3">Срок рассмотрения до 3х рабочих дней</div>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>