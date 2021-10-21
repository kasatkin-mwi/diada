<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Отчёт №3");
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
		<th>Кол-во</th>
		<th>Закупочная цена 1 шт.</th>
		<th>Цена продажи 1 шт.</th>
		<th>Прибыль 1 шт.</th>
		<th>% маржи</th>
		<th>% наценка</th>
		<th>Закупочная цена сумма</th>
		<th>Цена продажи сумма</th>
		<th>Прибыль сумма</th>
		<th>Сколько времени до конца резерва</th>
	</tr>
	<?
	$QUANTITY = 0;
	$PURCHASING_PRICE = 0;
	$PRICE = 0;
	$DIFF = 0;
	$M = 0;
	$N = 0;
	$Q_PURCHASING_PRICE = 0;
	$Q_PRICE = 0;
	$Q_DIFF = 0;
	?>
	<?foreach ($arOrders as $arOrder) {?>
		<?foreach ($arOrder['ITEMS'] as $arItem) {?>
			<?
			$__DIFF = $arItem['PRICE'] - $purchasingPrices[$arItem['PRODUCT_ID']];
			$__M = 100 * $__DIFF / $arItem['PRICE'];
			$__N = 100 * $__DIFF / $purchasingPrices[$arItem['PRODUCT_ID']];
			
			$QUANTITY += $arItem['QUANTITY'];
			$PURCHASING_PRICE += $purchasingPrices[$arItem['PRODUCT_ID']];
			$PRICE += $arItem['PRICE'];
			$DIFF += $__DIFF;
			$M += $__M;
			$N += $__N;
			$Q_PURCHASING_PRICE += $purchasingPrices[$arItem['PRODUCT_ID']] * $arItem['QUANTITY'];
			$Q_PRICE += $arItem['PRICE'] * $arItem['QUANTITY'];
			$Q_DIFF += $__DIFF * $arItem['QUANTITY'];
			?>
			<tr>
				<td><?=$arOrder['ID']?></td>
				<td><a href="<?=$arItem['DETAIL_PAGE_URL']?>"><?=$arItem['NAME']?></a></td>
				<td><?=intval($arItem['QUANTITY'])?></td>
				<td><?=CurrencyFormat($purchasingPrices[$arItem['PRODUCT_ID']], 'RUB')?></td>
				<td><?=CurrencyFormat($arItem['PRICE'], 'RUB')?></td>
				<td><?=CurrencyFormat($__DIFF, 'RUB')?></td>
				<td><?=str_replace('.', ',', round($__M, 2))?></td>
				<td><?=str_replace('.', ',', round($__N, 2))?></td>
				<td><?=CurrencyFormat($purchasingPrices[$arItem['PRODUCT_ID']] * $arItem['QUANTITY'], 'RUB')?></td>
				<td><?=CurrencyFormat($arItem['PRICE'] * $arItem['QUANTITY'], 'RUB')?></td>
				<td><?=CurrencyFormat($__DIFF * $arItem['QUANTITY'], 'RUB')?></td>
				<td><?=doPlural($arOrder['DIFF']->d, 'день', 'дня', 'дней')?> <?=doPlural($arOrder['DIFF']->h, 'час', 'часа', 'часов')?></td>
			</tr>
		<?}?>
	<?}?>
	<tr>
		<th colspan="2">Итого:</th>
		<th><?=$QUANTITY?></th>
		<th><?=CurrencyFormat($PURCHASING_PRICE, 'RUB')?></th>
		<th><?=CurrencyFormat($PRICE, 'RUB')?></th>
		<th><?=CurrencyFormat($DIFF, 'RUB')?></th>
		<th><?=str_replace('.', ',', round($Q_DIFF / $Q_PRICE * 100, 2))?></th>
		<th><?=str_replace('.', ',', round($Q_DIFF / $Q_PURCHASING_PRICE * 100, 2))?></th>
		<th><?=CurrencyFormat($Q_PURCHASING_PRICE, 'RUB')?></th>
		<th><?=CurrencyFormat($Q_PRICE, 'RUB')?></th>
		<th><?=CurrencyFormat($Q_DIFF, 'RUB')?></th>
		<th></th>
	</tr>
</table>
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>