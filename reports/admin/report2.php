<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
//include($_SERVER['DOCUMENT_ROOT'].'/bitrix/modules/main/include/prolog_before.php');
$APPLICATION->SetTitle("Отчёт №2");
?>

<?
CModule::IncludeModule('catalog');

$date_start = $_REQUEST['date_start'];
$date_end = $_REQUEST['date_end'];
$date_start = $date_start ? $date_start : date($DB->DateFormatToPHP(CSite::GetDateFormat('SHORT'))/*, time() - 60 * 60 * 24 * 30*/);
$date_end = $date_end ? $date_end : date($DB->DateFormatToPHP(CSite::GetDateFormat('SHORT')));

$res = CSaleOrder::GetList(
	Array('DATE_DEDUCTED' => 'DESC'),
	Array(
		'>=DATE_DEDUCTED' => $date_start.' 00:00:01',
		'<=DATE_DEDUCTED' => $date_end.' 23:59:59',
		'DEDUCTED' => 'Y',
		//'EMP_DEDUCTED_ID' => $USER->GetID(),
	)
);
$arOrders = Array();
while ($ar_res = $res->GetNext()) {
	$res2 = CSaleBasket::GetList(
		Array(),
		Array('ORDER_ID' => $ar_res['ID'])
	);
	$IDs = Array();
	$ar_res['ITEMS'] = Array();
	while ($ar_res2 = $res2->GetNext()) {
		if ($ar_res2['SET_PARENT_ID'] > 0 && $ar_res2['SET_PARENT_ID'] != $ar_res2['ID'])
			continue;
		$ar_res['ITEMS'][$ar_res2['PRODUCT_ID']] = $ar_res2;
		$IDs[] = $ar_res2['PRODUCT_ID'];
	}
	if (!empty($ar_res['ITEMS'])) {
		$res2 = CCatalogProduct::GetList(
			Array(),
			Array('ID' => $IDs),
			false,
			false,
			Array('ID', 'PURCHASING_PRICE')
		);
		$PURCHASING_PRICE = 0;
		while ($ar_res2 = $res2->GetNext()) {
			$ar_res['ITEMS'][$ar_res2['ID']]['PURCHASING_PRICE'] = 0;
			if (CCatalogProductSet::isProductInSet($ar_res2['ID'], CCatalogProductSet::TYPE_SET)) {
				$res3 = CCatalogProductSet::getList(
					Array(),
					Array(
						'OWNER_ID' => $ar_res2['ID'],
						'!ITEM_ID' => $ar_res2['ID'],
						'TYPE' => CCatalogProductSet::TYPE_SET,
					)
				);
				if ($ar_res3 = $res3->Fetch()) {
					$res4 = CCatalogProduct::GetList(
						Array(),
						Array('ID' => $ar_res3['ITEM_ID']),
						false,
						false,
						Array('ID', 'PURCHASING_PRICE')
					);
					if ($ar_res4 = $res4->Fetch())
						$ar_res['ITEMS'][$ar_res2['ID']]['PURCHASING_PRICE'] = $ar_res4['PURCHASING_PRICE'] * $ar_res3['QUANTITY'];
					/*echo '<div style="white-space: pre;">'; print_r($ar_res3); echo '</div>';
					if ($ar_res3['QUANTITY'] > 0) {
						$ar_res['ITEMS'][$ar_res2['ID']]['PURCHASING_PRICE'] = $ar_res2['PURCHASING_PRICE'] * $ar_res3['QUANTITY'];
					}*/
				}
			}
			if (!$ar_res['ITEMS'][$ar_res2['ID']]['PURCHASING_PRICE'])
				$ar_res['ITEMS'][$ar_res2['ID']]['PURCHASING_PRICE'] = $ar_res2['PURCHASING_PRICE'];
			$PURCHASING_PRICE += $ar_res['ITEMS'][$ar_res2['ID']]['PURCHASING_PRICE'] * $ar_res['ITEMS'][$ar_res2['ID']]['QUANTITY'];
		}
		$ar_res['PURCHASING_PRICE'] = $PURCHASING_PRICE;
		$arOrders[$ar_res['ID']] = $ar_res;
	}
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
<link rel="stylesheet" href="http://code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
<script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
<script>
	$(function() {
		$('[name="date_start"], [name="date_end"]').datepicker({
			dateFormat: 'dd.mm.yy'
		});
		$('.my_report .more').click(function() {
			var $next = $(this).parents('tr').next();
			if ($next.css('display') == 'none') {
				$(this).text('Скрыть');
				$next.css('display', 'table-row');
			} else {
				$(this).text('Подробнее');
				$next.css('display', 'none');
			}
		});
	});
</script>
<form action="" name="datesform">
	с <input type="text" name="date_start" value="<?=htmlspecialcharsbx($date_start)?>" />
	по <input type="text" name="date_end" value="<?=htmlspecialcharsbx($date_end)?>" />
	<input type="submit" name="load" value="Применить" />
</form>
<br />
<table class="my_report">
	<tr>
		<th>№</th>
		<th>Дата отгрузки заказа</th>
		<th>Номер заказа</th>
		<th>Закупочная за заказ</th>
		<th>Продажная за заказ</th>
		<th>Прибыль за заказ</th>
		<th>Средний % маржи за заказ</th>
		<th>Средний % наценка за заказ</th>
		<th>&nbsp;</th>
	</tr>
	<?
	$i = 0;
	$_PURCHASING_PRICE = 0;
	$_PRICE = 0;
	$_DIFF = 0;
	$_M_M = 0;
	$_M_N = 0;
	?>
	<?foreach ($arOrders as $arOrder) {?>
		<?
		$ORDER_PRICE = $arOrder['PRICE'] - $arOrder['PRICE_DELIVERY'];
		$DIFF = $ORDER_PRICE - $arOrder['PURCHASING_PRICE'];
		$_M = 100 * $DIFF / $ORDER_PRICE;
		$_N = 100 * $DIFF / $arOrder['PURCHASING_PRICE'];
		
		$_PURCHASING_PRICE += $arOrder['PURCHASING_PRICE'];
		$_PRICE += $ORDER_PRICE;
		$_DIFF += $DIFF;
		$_M_M += $_M;
		$_M_N += $_N;
		?>
		<tr>
			<td><?=++$i?></td>
			<td><?=$arOrder['DATE_DEDUCTED']?></td>
			<td><?=$arOrder['ID']?></td>
			<td><?=CurrencyFormat($arOrder['PURCHASING_PRICE'], 'RUB')?></td>
			<td><?=CurrencyFormat($ORDER_PRICE, 'RUB')?></td>
			<td><?=CurrencyFormat($DIFF, 'RUB')?></td>
			<td><?=str_replace('.', ',', round($_M, 2))?></td>
			<td><?=str_replace('.', ',', round($_N, 2))?></td>
			<td><a href="javascript:void(0)" class="more">Подробнее</a></td>
		</tr>
		<tr style="display: none;">
			<td colspan="9">
				<table class="my_report">
					<tr>
						<th>№</th>
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
					</tr>
					<?
					$QUANTITY2 = 0;
					$SUMM2 = 0;
					$i2 = 0;
					
					$_QUANTITY2 = 0;
					$_PURCHASING_PRICE2 = 0;
					$_PRICE2 = 0;
					$_DIFF2 = 0;
					$_Q_PURCHASING_PRICE2 = 0;
					$_Q_PRICE2 = 0;
					$_Q_DIFF2 = 0;
					$_M_M2 = 0;
					$_M_N2 = 0;
					?>
					<?foreach ($arOrder['ITEMS'] as $ar_res) {?>
						<?
						$QUANTITY2 += $ar_res['QUANTITY'];
						$DIFF2 = $ar_res['PRICE'] - $ar_res['PURCHASING_PRICE'];
						$SUMM2 += $DIFF2;
						$_M2 = 100 * $DIFF2 / $ar_res['PRICE'];
						$_N2 = 100 * $DIFF2 / $ar_res['PURCHASING_PRICE'];
						
						$_QUANTITY2 += $ar_res['QUANTITY'];
						$_PURCHASING_PRICE2 += $ar_res['PURCHASING_PRICE'];
						$_PRICE2 += $ar_res['PRICE'];
						$_DIFF2 += $DIFF2;
						$_Q_PURCHASING_PRICE2 += $ar_res['PURCHASING_PRICE'] * $ar_res['QUANTITY'];
						$_Q_PRICE2 += $ar_res['PRICE'] * $ar_res['QUANTITY'];
						$_Q_DIFF2 += $DIFF2 * $ar_res['QUANTITY'];
						$_M_M2 += $_M2;
						$_M_N2 += $_N2;
						?>
						<tr>
							<td><?=++$i2?></td>
							<td><a href="<?=$ar_res['DETAIL_PAGE_URL']?>"><?=$ar_res['NAME']?></a></td>
							<td><?=intval($ar_res['QUANTITY'])?></td>
							<td><?=CurrencyFormat($ar_res['PURCHASING_PRICE'], 'RUB')?></td>
							<td><?=CurrencyFormat($ar_res['PRICE'], 'RUB')?></td>
							<td><?=CurrencyFormat($DIFF2, 'RUB')?></td>
							<td><?=str_replace('.', ',', round($_M2, 2))?></td>
							<td><?=str_replace('.', ',', round($_N2, 2))?></td>
							<td><?=CurrencyFormat($ar_res['PURCHASING_PRICE'] * $ar_res['QUANTITY'], 'RUB')?></td>
							<td><?=CurrencyFormat($ar_res['PRICE'] * $ar_res['QUANTITY'], 'RUB')?></td>
							<td><?=CurrencyFormat($DIFF2 * $ar_res['QUANTITY'], 'RUB')?></td>
						</tr>
					<?}?>
					<tr>
						<th colspan="2">Итого:</th>
						<th><?=$_QUANTITY?></th>
						<th><?=CurrencyFormat($_PURCHASING_PRICE2, 'RUB')?></th>
						<th><?=CurrencyFormat($_PRICE2, 'RUB')?></th>
						<th><?=CurrencyFormat($_DIFF2, 'RUB')?></th>
						<th><?=str_replace('.', ',', round($_Q_DIFF2 / $_Q_PRICE2 * 100, 2))?></th>
						<th><?=str_replace('.', ',', round($_Q_DIFF2 / $_Q_PURCHASING_PRICE2 * 100, 2))?></th>
						<th><?=CurrencyFormat($_Q_PURCHASING_PRICE2, 'RUB')?></th>
						<th><?=CurrencyFormat($_Q_PRICE2, 'RUB')?></th>
						<th><?=CurrencyFormat($_Q_DIFF2, 'RUB')?></th>
					</tr>
				</table>
			</td>
		</tr>
	<?}?>
	<tr>
		<th colspan="3">Итого:</th>
		<th><?=CurrencyFormat($_PURCHASING_PRICE, 'RUB')?></th>
		<th><?=CurrencyFormat($_PRICE, 'RUB')?></th>
		<th><?=CurrencyFormat($_DIFF, 'RUB')?></th>
		<th><?=str_replace('.', ',', round($_DIFF / $_PRICE * 100, 2))?></th>
		<th><?=str_replace('.', ',', round($_DIFF / $_PURCHASING_PRICE * 100, 2))?></th>
		<th>&nbsp;</th>
	</tr>
</table>
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>