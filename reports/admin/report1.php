<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Отчёт №1");
?>

<?
CModule::IncludeModule('catalog');

$arProducts = Array();
$res = CCatalogStoreProduct::GetList(
	Array(),
	Array('STORE_ID' => 3, '>AMOUNT' => 0),
	false,
	false,
	Array('PRODUCT_ID', 'AMOUNT')
);
while ($ar_res = $res->GetNext()) {
	$arProducts[$ar_res['PRODUCT_ID']] = $ar_res;
}

$res = CCatalogProduct::GetList(
	Array(),
	Array('ID' => array_keys($arProducts)),
	false,
	false,
	//Array('nTopCount' => 10),
	Array('ID', 'PURCHASING_PRICE', 'PURCHASING_CURRENCY')
);
while ($ar_res = $res->GetNext()) {
	$arPrice = CCatalogProduct::GetOptimalPrice($ar_res['ID']);
	$ar_res['PRICE'] = $arPrice['DISCOUNT_PRICE'];
	$ar_res['QUANTITY'] = $arProducts[$ar_res['ID']]['AMOUNT'];
	$arProducts[$ar_res['ID']] = $ar_res;
}

$res = CIBlockElement::GetList(
	Array('NAME' => 'ASC'),
	Array(
		'ID' => array_keys($arProducts),
	),
	false,
	false,
	Array('ID', 'NAME', 'DETAIL_PAGE_URL')
);
?>
<style>
	.my_report {
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
	$QUANTITY = 0;
	$SUMM = 0;
	$i = 0;
	
	$_QUANTITY = 0;
	$_PURCHASING_PRICE = 0;
	$_PRICE = 0;
	$_DIFF = 0;
	$_Q_PURCHASING_PRICE = 0;
	$_Q_PRICE = 0;
	$_Q_DIFF = 0;
	$_M_M = 0;
	$_M_N = 0;
	?>
	<?while ($ar_res = $res->GetNext()) {?>
		<?
		$arProduct = $arProducts[$ar_res['ID']];
		$QUANTITY += $arProduct['QUANTITY'];
		$DIFF = $arProduct['PRICE'] - $arProduct['PURCHASING_PRICE'];
		$SUMM += $DIFF;
		$_M = 100 * $DIFF / $arProduct['PRICE'];
		$_N = 100 * $DIFF / $arProduct['PURCHASING_PRICE'];
		
		$_QUANTITY += $arProduct['QUANTITY'];
		$_PURCHASING_PRICE += $arProduct['PURCHASING_PRICE'];
		$_PRICE += $arProduct['PRICE'];
		$_DIFF += $DIFF;
		$_Q_PURCHASING_PRICE += $arProduct['PURCHASING_PRICE'] * $arProduct['QUANTITY'];
		$_Q_PRICE += $arProduct['PRICE'] * $arProduct['QUANTITY'];
		$_Q_DIFF += $DIFF * $arProduct['QUANTITY'];
		$_M_M += $_M;
		$_M_N += $_N;
		?>
		<tr>
			<td><?=++$i?></td>
			<td><a href="<?=$ar_res['DETAIL_PAGE_URL']?>"><?=$ar_res['NAME']?></a></td>
			<td><?=$arProduct['QUANTITY']?></td>
			<td><?=CurrencyFormat($arProduct['PURCHASING_PRICE'], $arProduct['PURCHASING_CURRENCY'])?></td>
			<td><?=CurrencyFormat($arProduct['PRICE'], $arProduct['PURCHASING_CURRENCY'])?></td>
			<td><?=CurrencyFormat($DIFF, $arProduct['PURCHASING_CURRENCY'])?></td>
			<td><?=str_replace('.', ',', round($_M, 2))?></td>
			<td><?=str_replace('.', ',', round($_N, 2))?></td>
			<td><?=CurrencyFormat($arProduct['PURCHASING_PRICE'] * $arProduct['QUANTITY'], $arProduct['PURCHASING_CURRENCY'])?></td>
			<td><?=CurrencyFormat($arProduct['PRICE'] * $arProduct['QUANTITY'], $arProduct['PURCHASING_CURRENCY'])?></td>
			<td><?=CurrencyFormat($DIFF * $arProduct['QUANTITY'], $arProduct['PURCHASING_CURRENCY'])?></td>
		</tr>
	<?}?>
	<tr>
		<th colspan="2">Итого:</th>
		<th><?=$_QUANTITY?></th>
		<th><?=CurrencyFormat($_PURCHASING_PRICE, 'RUB')?></th>
		<th><?=CurrencyFormat($_PRICE, 'RUB')?></th>
		<th><?=CurrencyFormat($_DIFF, 'RUB')?></th>
		<th><?=str_replace('.', ',', round($_Q_DIFF / $_Q_PRICE * 100, 2))?></th>
		<th><?=str_replace('.', ',', round($_Q_DIFF / $_Q_PURCHASING_PRICE * 100, 2))?></th>
		<th><?=CurrencyFormat($_Q_PURCHASING_PRICE, 'RUB')?></th>
		<th><?=CurrencyFormat($_Q_PRICE, 'RUB')?></th>
		<th><?=CurrencyFormat($_Q_DIFF, 'RUB')?></th>
	</tr>
</table>


<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>