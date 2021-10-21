<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>

<?foreach($arResult as $i=>$arItem):
	if ($arItem['DEPTH_LEVEL'] == 1):
		if (isset($prevDepth1)) $arResult[$prevDepth1]['COUNT_DEPTH_2'] = ceil($count/3);
		$prevDepth1 = $i;
		$count = 0;
	elseif ($arItem['DEPTH_LEVEL'] == 2):
		$count++;
	endif;
endforeach;?>