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
<div class="lk_gray_bg">
    <div class="lk_title">Список заказов</div>    
    <div class="sale-personal-profile-list-container_bl display_none_p display_none_m display_none_mp">
        <table class="table sale-personal-profile-list-container">
            <tbody>
                <tr>
                    <th>Номер заказа</th>
                    <th>Сумма</th>
                    <th>Статус</th>
                </tr>
                <?
                if(!empty($arResult["ORDERS"]))
                {
                    foreach($arResult["ORDERS"] as $order)
                    {
                        ?>
                        <tr>
                            <td><a href="/bitrix/admin/sale_order_view.php?ID=<?=$order['ID']?>&filter=Y&set_filter=Y&lang=ru" target="_blank"><?=$order['ID']?></a></td>
                            <td><?=$order['PRICE']?></td>
                            <td><?=$order['STATUS']?></td>
                        </tr>
                        <?   
                    }    
                }
                else
                {
                    ?>
                    <tr>
                        <td colspan="3" style="text-align: center;">заказов не найдено</td>
                    </tr>
                    <?
                }
                ?>
            </tbody>
        </table>
    </div>
    <div class="adaptiv_table sale-personal-profile-list-container display_none_c">
        <?
        foreach($arResult["ORDERS"] as $order)
        {
        ?>
            <div class="adaptiv_personal_col">
                <div class="adaptiv_personal_el">
                    <div class="adaptiv_personal_gray">
                        Номер заказа                        
                    </div>
                    <div><a href="/bitrix/admin/sale_order_view.php?ID=<?=$order['ID']?>&filter=Y&set_filter=Y&lang=ru" target="_blank"><?=$order['ID']?></a></div>
                </div>
                <div class="adaptiv_personal_el">
                    <div class="adaptiv_personal_gray">
                        Сумма
                    </div>
                    <div><?=$order['PRICE']?></div>
                </div>
                <div class="adaptiv_personal_el">
                    <div class="adaptiv_personal_gray">
                        Статус
                    </div>
                    <div><?=$order['STATUS']?></div>
                </div>
            </div>
        <?
        }
        ?>
    </div>
    <?
    if(strlen($arResult["NAV_STRING"]) > 0)
    {
        ?>
        <p><?=$arResult["NAV_STRING"]?></p>
        <?
    }
    ?>
</div>