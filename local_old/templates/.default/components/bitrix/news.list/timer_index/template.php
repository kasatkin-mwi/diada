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
<?foreach($arResult["ITEMS"] as $arItem):?>
	<?
	$this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
	$this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
	//echo "<pre>";print_r($arItem);echo "</pre>";
	?>
	<a class="timer_block" href="/catalog/specials/" id="<?=$this->GetEditAreaId($arItem['ID']);?>">
		<span class="timer_button">
			<i class="timer_red_button">Распродажа!</i>
		</span>
		<span class="timer_title">
			До конца акции <i>осталось:</i>
		</span>
		<span class="timer_countdown">
			<div id="countdown_dashboard">
				<?
				$date1 = new DateTime("now");
				$nowTime = time();
				$timeInterval = $arItem['PROPERTIES']['IntervalDate']['VALUE']*86400;
				$count = intval($nowTime/$timeInterval);
				$dateSet = date("Y-m-d H:i:s",($count*$timeInterval+$timeInterval));
                $date2 = new DateTime($dateSet);
				$interval = $date2->diff($date1);
				$d = $interval->format('%d');
				$h = $interval->format('%h');
				$i = $interval->format('%i');
				$s = $interval->format('%s');
				?>
				<div class="dash days_dash">
					<span class="dash_title1 dash_title">Дней</span>
					<div class="digit"><?=(strlen($d)>1)?substr($d, 0, 1):0?></div>
					<div class="digit"><?=(strlen($d)>1)?substr($d, 1, 1):$d?></div>
				</div>
				<div class="dash hours_dash">
					<span class="dash_title2 dash_title">Часов</span>
					<div class="digit"><?=(strlen($h)>1)?substr($h, 0, 1):0?></div>
					<div class="digit"><?=(strlen($h)>1)?substr($h, 1, 1):$h?></div>
				</div>
				<div class="dash minutes_dash">
					<span class="dash_title3 dash_title">Минут</span>
					<div class="digit"><?=(strlen($i)>1)?substr($i, 0, 1):0?></div>
					<div class="digit"><?=(strlen($i)>1)?substr($i, 1, 1):$i?></div>
				</div>
				<div class="dash seconds_dash">
					<span class="dash_title4 dash_title">Секунд</span>
					<div class="digit"><?=(strlen($s)>1)?substr($s, 0, 1):0?></div>
					<div class="digit"><?=(strlen($s)>1)?substr($s, 1, 1):$s?></div>
				</div>
			</div>
		</span>
	</a>
<?endforeach;?>

<script type="text/javascript">
$(document).ready(function() {
	$('#countdown_dashboard').countDown({
		targetOffset: {
			'day': 		<?=$d?>,
			'month': 	0,
			'year': 	0,
			'hour': 	<?=$h?>,
			'min': 		<?=$i?>,
			'sec': 		<?=$s?>
		}
	});
});
</script>