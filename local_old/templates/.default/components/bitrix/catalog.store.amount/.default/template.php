<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
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
$this->setFrameMode(true);?>
<?
if(!empty($arResult["STORES"])):?>
    <div class="manager_complect_table">
        <table>
            <thead>
                <tr>
                    <th>Название</th>
                    <th>Склад</th>
                    <th>Остаток</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td rowspan="<?=count($arResult["STORES"])?>"><?=$arResult["PRODUCT_NAME"]?></td>
                    <td class="red_bg"><span><?=$arResult["STORES"][0]["TITLE"]?></span></td>
                    <td class="red_bg"><span><?=$arResult["STORES"][0]["REAL_AMOUNT"] > 0 ? $arResult["STORES"][0]["REAL_AMOUNT"] : "-"?></span></td>
                </tr>
                <?foreach($arResult["STORES"] as $pid => $arProperty):
                    if($pid == 0)
                        continue;
                ?>
                    <?
                    if($arProperty["REAL_AMOUNT"] <= 0 && $arProperty["ID"] != 3)
                        continue;?>
                    <tr>
                        <td>
                            <?if (isset($arProperty["TITLE"])):?>
                                <?=$arProperty["TITLE"]?>
                            <?endif;?>
                        </td>
                        <td><?=$arProperty["REAL_AMOUNT"] > 0 ? $arProperty["REAL_AMOUNT"] : "-"?></td>
                    </tr>
                <?endforeach;?>
                <tr class="linear">
                    <td colspan="3"></td>
                </tr>
            </tbody>
        </table>
    </div>
<?endif;?>
<?if(!empty($arResult["SET_INFO"]["SET_BASE"])):?>
    <div class="manager_complect_table">
        <table>
            <thead>
                <tr class="title">
                    <td colspan="3">Комплект Базовый</td>
                </tr>
                <tr>
                    <th>Название</th>
                    <th>Склад</th>
                    <th>Остаток</th>
                </tr>
            </thead>
            <tbody>
                <?foreach($arResult["SET_INFO"]["SET_BASE"] as $arProperty):?>
                <tr>
                    <td rowspan="<?=count($arProperty["STORES"])?>"><?=$arProperty["NAME"]?></td>
                    <td class="red_bg"><span><?=$arProperty["STORES"][0]["STORE_NAME"]?></span></td>
                    <td class="red_bg"><span><?=$arProperty["STORES"][0]["AMOUNT"] > 0 ? $arProperty["STORES"][0]["AMOUNT"] : "-"?></span></td>
                </tr>
                    <?
                    foreach($arProperty["STORES"] as $key => $store)
                    {   
                        if($key == 0)
                            continue;
                        ?>
                        <tr>
                            <td><?=$store["STORE_NAME"]?></td>
                            <td><?=$store["AMOUNT"] > 0 ? $store["AMOUNT"] : "-"?></td>
                        </tr>
                        <?
                    }
                ?>
                    <tr class="linear">
                        <td colspan="3"></td>
                    </tr>
                <?endforeach;?>
            </tbody>
        </table>
    </div>
<?endif;?>
<?if(!empty($arResult["SET_INFO"]["SET_MASTER"])):?>
    <div class="manager_complect_table">
        <table>
            <thead>
                <tr class="title">
                    <td colspan="3">Комплект Мастер</td>
                </tr>
                <tr>
                    <th>Название</th>
                    <th>Склад</th>
                    <th>Остаток</th>
                </tr>
            </thead>
            <tbody>
                <?foreach($arResult["SET_INFO"]["SET_MASTER"] as $arProperty):?>
                <tr>
                    <td rowspan="<?=count($arProperty["STORES"])?>"><?=$arProperty["NAME"]?></td>
                    <td class="red_bg"><span><?=$arProperty["STORES"][0]["STORE_NAME"]?></span></td>
                    <td class="red_bg"><span><?=$arProperty["STORES"][0]["AMOUNT"] > 0 ? $arProperty["STORES"][0]["AMOUNT"] : "-"?></span></td>
                </tr>
                    <?
                    foreach($arProperty["STORES"] as $key => $store)
                    {  
                        if($key == 0)
                            continue;
                        ?>
                        <tr>
                            <td><?=$store["STORE_NAME"]?></td>
                            <td><?=$store["AMOUNT"] > 0 ? $store["AMOUNT"] : "-"?></td>
                        </tr>
                        <?
                    }
                ?>
                    <tr class="linear">
                        <td colspan="3"></td>
                    </tr>
                <?endforeach;?>
            </tbody>
        </table>
    </div>
<?endif;?>
<?if(!empty($arResult["SET_INFO"]["SET_PROFI"])):?>
    <div class="manager_complect_table">
        <table>
            <thead>
                <tr class="title">
                    <td colspan="3">Комплект Профи</td>
                </tr>
                <tr>
                    <th>Название</th>
                    <th>Склад</th>
                    <th>Остаток</th>
                </tr>
            </thead>
            <tbody>
                <?foreach($arResult["SET_INFO"]["SET_PROFI"] as $arProperty):?>
                <tr>
                    <td rowspan="<?=count($arProperty["STORES"])?>"><?=$arProperty["NAME"]?></td>
                    <td class="red_bg"><span><?=$arProperty["STORES"][0]["STORE_NAME"]?></span></td>
                    <td class="red_bg"><span><?=$arProperty["STORES"][0]["AMOUNT"] > 0 ? $arProperty["STORES"][0]["AMOUNT"] : "-"?></span></td>
                </tr>
                    <?
                    foreach($arProperty["STORES"] as $key => $store)
                    {
                        if($key == 0)
                            continue;
                        ?>
                        <tr>
                            <td><?=$store["STORE_NAME"]?></td>
                            <td><?=$store["AMOUNT"] > 0 ? $store["AMOUNT"] : "-"?></td>
                        </tr>
                        <?
                    }
                ?>
                    <tr class="linear">
                        <td colspan="3"></td>
                    </tr>
                <?endforeach;?>
            </tbody>
        </table>
    </div>
<?endif;?> 

<?if (isset($arResult["IS_SKU"]) && $arResult["IS_SKU"] == 1):?>
	<script type="text/javascript">
		var obStoreAmount = new JCCatalogStoreSKU(<? echo CUtil::PhpToJSObject($arResult['JS'], false, true, true); ?>);
	</script>
	<?
endif;?>