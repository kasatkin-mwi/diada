<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Отчёт №4");
?>
<?
CModule::IncludeModule('catalog');

$purchasingPrices = Array();
$res = CCatalogProduct::GetList(
	Array(),
	Array('>QUANTITY_RESERVED' => 0),
	false,
	false,
	Array('ID', 'PURCHASING_PRICE')
);
$IDs = Array();
while ($ar_res = $res->GetNext()) {
	$purchasingPrices[$ar_res['ID']] = $ar_res['PURCHASING_PRICE'];
	$IDs[] = $ar_res['ID'];
}

$res = CSaleBasket::GetList(
	Array('ORDER_ID' => 'DESC'),
	Array(
		'!ORDER_ID' => false,
		'@PRODUCT_ID' => $IDs,
		'ORDER_ALLOW_DELIVERY' => 'Y',
	)
);
$IDs = Array();
$arItems = Array();
while ($ar_res = $res->GetNext()) {
	$IDs[] = $ar_res['ORDER_ID'];
	$arItems[] = $ar_res;
}

function doPlural($n, $t1, $t2, $t5) {
	if ($n % 10 === 1 && $n % 100 !== 11)
		return $n.' '.$t1;
	if ($n % 10 < 5 && ($n % 100 < 10 || $n % 100 > 20) )
		return $n.' '.$t2;
	return $n.' '.$t5;
}

$product_reserve_clear_period = COption::GetOptionInt('sale', 'product_reserve_clear_period');
$product_reserve_time = date($DB->DateFormatToPHP(CSite::GetDateFormat('FULL')), time() - 60 * 60 * 24 * $product_reserve_clear_period);
$res = CSaleOrder::GetList(
	Array('ID' => 'DESC'),
	Array(
		'>=DATE_ALLOW_DELIVERY' => $product_reserve_time,
		'@ID' => $IDs,
	)
);
$arOrders = Array();
$d2 = new DateTime($product_reserve_time);
while ($ar_res = $res->GetNext()) {
	$d1 = new DateTime($ar_res['DATE_ALLOW_DELIVERY']);
	$ar_res['DIFF'] = $d1->diff($d2);
	$ar_res['ITEMS'] = Array();
	foreach ($arItems as $k => $arItem)
		if ($arItem['ORDER_ID'] == $ar_res['ID']) {
			$ar_res['ITEMS'][] = $arItem;
			unset($arItems[$k]);
		}
	$arOrders[] = $ar_res;
}
?>

<style>
	.my_report {
		width: 100%;
		border-collapse: collapse;
	}
	.my_report td, .my_report th {
		white-space: nowrap;
		border: 1px solid #000;
	}
	.my_report td:nth-child(2), .my_report tr:first-child th {
		white-space: normal;
	}
	.my_report th[colspan] {
		padding-right: 20px;
		text-align: right;
	}
</style>
<table class="my_report">
	<tr>
		<th>Номер заказа</th>
		<th>Товар</th>
		<th>Сколько времени до конца резерва</th>
	</tr>
	<?foreach ($arOrders as $arOrder) {?>
		<?foreach ($arOrder['ITEMS'] as $arItem) {?>
			<tr>
				<td><?=$arOrder['ID']?></td>
				<td><a href="<?=$arItem['DETAIL_PAGE_URL']?>"><?=$arItem['NAME']?></a></td>
				<td><?=doPlural($arOrder['DIFF']->d, 'день', 'дня', 'дней')?> <?=doPlural($arOrder['DIFF']->h, 'час', 'часа', 'часов')?></td>
			</tr>
		<?}?>
	<?}?>
</table>
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>