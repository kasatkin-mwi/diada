<?
if (!empty($arParams['FILTER_NAME']) && isset($arParams['FILTER_NAME'])) {
    $nameFilter = $arParams['FILTER_NAME'];
    global $$nameFilter;
    $arPohog = $$nameFilter;
    $arItemSort = Array();
    foreach ($arResult['ITEMS'] as $arItem):
        $arItemSort[$arItem['ID']] = $arItem;
    endforeach;

    $arItemNew = Array();
    foreach ($arPohog['ID'] as $i => $id):
        if ($i == $arParams['PAGE_ELEMENT_COUNT']) break;
        $arItemNew[] = $arItemSort[$id];
    endforeach;
    $arResult['ITEMS'] = $arItemNew;
}
?>