<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<?
$APPLICATION->SetPageProperty('title','Контакты: г. '.$arResult['NAME'].' | Интернет-магазин Diada-Arms');
$APPLICATION->SetPageProperty('description','Контакты: '.$arResult['NAME'].'. Интернет-магазин Diada-Arms предлагает большой ассортимент качественных товаров для активного отдыха и охоты.');
$APPLICATION->SetTitle('Контакты: г. '.$arResult['NAME']);
?>
<?=$arResult['PREVIEW_TEXT']?>
<div itemscope itemtype="http://schema.org/Organization">
	<meta itemprop="name" content="Diada-Arms">
	<meta itemprop="email" content="info@diada-arms.ru"> 
<div class="element_contacts_city_block">
	<div class="element_contacts_city">
		<div class="element_contacts">
			<?if ($arResult['PROPERTIES']['SUBWAY']['VALUE']) {?>
				<?
				$file = false;
				if ($arResult['PROPERTIES']['SUBWAY_ICON']['VALUE'])
					$file = CFile::GetFileArray($arResult['PROPERTIES']['SUBWAY_ICON']['VALUE']);
				?>
				<p class="metro_title"<?=$file ? ' style="background: url('.$file['SRC'].') left top no-repeat;"' : ''?>>
					<?=$arResult['PROPERTIES']['SUBWAY']['VALUE']?>
				</p>
			<?}?>
			<ul class="param_element_contacts"  itemprop="address" itemscope itemtype="http://schema.org/PostalAddress">
				<meta itemprop="addressLocality" content="<?=$arResult['NAME']?>">
				<li>Адрес:</li>
				<li class="red_cursor" itemprop="streetAddress"><?=$arResult['PROPERTIES']['ADDRESS']['VALUE']?></li>
			</ul>
			<ul class="param_element_contacts">
				<li>Время работы:</li>
				<li>
					<?foreach ($arResult['PROPERTIES']['WORK_TIME']['VALUE'] as $val) {?>
						<?php if($val[0]=='8' || $val[0]=='+' || $val[0]=='7') echo '<p itemprop="telephone">'; else echo '<p class="not_phone">'; ?>
						<?=$val?></p>
					<?}?>
				</li>
			</ul>
			<?if ($arResult['PROPERTIES']['VIDEO']['VALUE']) {?>
				<p class="red_title"><span>Как нас найти?</span> Очень просто! Посмотрите видео!</p>
				<div>
					<iframe width="453" height="251" src="https://www.youtube.com/embed/<?=$arResult['PROPERTIES']['VIDEO']['VALUE']?>?showinfo=0" frameborder="0" allowfullscreen></iframe>
				</div>
			<?}?>
			<ul class="dop_shema_proezda">
				<?if ($arResult['PROPERTIES']['HOW_TO_FIND_TEXT']['VALUE']['TEXT']) {?>
					<li><a href="#HOW_TO_FIND_TEXT" class="fancy">Как найти на словах</a></li>
					<div style="display: none;" id="HOW_TO_FIND_TEXT"><?=$arResult['PROPERTIES']['HOW_TO_FIND_TEXT']['~VALUE']['TEXT']?></div>
				<?}?>
				<?if ($arResult['PROPERTIES']['HOW_TO_FIND_PICT']['VALUE']) {?>
					<?$file = CFile::GetFileArray($arResult['PROPERTIES']['HOW_TO_FIND_PICT']['VALUE']);?>
					<li><a href="<?=$file['SRC']?>" class="fancy">Схема проезда</a></li>
				<?}?>
			</ul>
		</div>
	</div>
	<div class="map_element_contacts">
		<div id="store_map" class="display_none_m display_none_mp" style="height: 450px;"></div>
		<script>
			ymaps.ready(function() {
				var map = new ymaps.Map('store_map', {
					center: [<?=$arResult['PROPERTIES']['MAP']['VALUE']?>],
					zoom: 13
				});
				map.controls.add('mapTools', {left: 35, top: 5});
				map.controls.add('zoomControl', {left: 5, top: 5});
				
				var str = '<?=$arResult['PROPERTIES']['ADDRESS']['VALUE']?>';
				
				var placemark = new ymaps.Placemark(
					[<?=$arResult['PROPERTIES']['MAP']['VALUE']?>],
					{
						iconContent: '',
						balloonContent: str,
						hintContent: str
					}
				);
				map.geoObjects.add(placemark);
			});
		</script>
	</div>
</div>

<?if (!empty($arResult['STORES'])) {?>
	<p class="h4">Адреса пунктов выдачи г. <?=$arResult['NAME']?></p>
	<div class="big_map display_none_m display_none_mp" id="big_map"></div>
	<div class="big_map display_none_p display_none_c" id="big_map2"></div>
	<div class="min_element_contacts_block">
		<?foreach ($arResult['STORES'] as $arStore) {?>
			<div class="min_element_contacts">
				<div class="element_contacts">
					<?if ($arStore['PROPERTIES']['SUBWAY']['VALUE']) {?>
						<?
						$file = false;
						if ($arStore['PROPERTIES']['SUBWAY_ICON']['VALUE'])
							$file = CFile::GetFileArray($arStore['PROPERTIES']['SUBWAY_ICON']['VALUE']);
						?>
						<p class="metro_title"<?=$file ? ' style="background: url('.$file['SRC'].') left top no-repeat;"' : ''?>>
							<?=$arStore['PROPERTIES']['SUBWAY']['VALUE']?>
						</p>
					<?}?>
					<ul class="param_element_contacts" itemprop="address" itemscope itemtype="http://schema.org/PostalAddress">
						<meta itemprop="addressLocality" content="<?=$arResult['NAME']?>">
						<li>Адрес:</li>
						<li class="gray_cursor" itemprop="streetAddress"><a href="#" data-id="<?=$arStore['ID']?>"><?=$arStore['PROPERTIES']['ADDRESS']['VALUE']?></a></li>
					</ul>
					<ul class="param_element_contacts gray_days">
						<li>Время работы:</li>
						<li>
							<?foreach ($arStore['PROPERTIES']['WORK_TIME']['VALUE'] as $val) {?>
								<?php if($val[0]=='8' || $val[0]=='+' || $val[0]=='7') echo '<p itemprop="telephone">'; else echo '<p class="not_phone">'; ?>
								<?=$val?></p>
							<?}?>
						</li>
					</ul>
					<ul class="dop_shema_proezda">
						<?if ($arStore['PROPERTIES']['HOW_TO_FIND_TEXT']['VALUE']['TEXT']) {?>
							<li><a href="#HOW_TO_FIND_TEXT<?=$arStore['ID']?>" class="fancy">Как найти на словах</a></li>
							<div style="display: none;" id="HOW_TO_FIND_TEXT<?=$arStore['ID']?>"><?=$arStore['PROPERTIES']['HOW_TO_FIND_TEXT']['~VALUE']['TEXT']?></div>
						<?}?>
						<?if ($arStore['PROPERTIES']['HOW_TO_FIND_PICT']['VALUE']) {?>
							<?$file = CFile::GetFileArray($arStore['PROPERTIES']['HOW_TO_FIND_PICT']['VALUE']);?>
							<li><a href="<?=$file['SRC']?>" class="fancy">Схема проезда</a></li>
						<?}?>
					</ul>
				</div>
			</div>
		<?}?>
		<div class="clear"></div>
	</div>
	<script>
			ymaps.ready(function() {
				var map = new ymaps.Map('big_map', {
					center: [55.733835, 37.588227],
					zoom: 13
				});
				map.controls.add('mapTools', {left: 35, top: 5});
				map.controls.add('zoomControl', {left: 5, top: 5});
				
				var clusterer = new ymaps.Clusterer();
				
				var placemarks = {};
				
				<?foreach ($arResult['STORES'] as $arStore) {?>
					placemarks['<?=$arStore['ID']?>'] = new ymaps.Placemark(
						[<?=$arStore['PROPERTIES']['MAP']['VALUE']?>],
						{
							iconContent: '',
							balloonContent: '<?=$arStore['PROPERTIES']['ADDRESS']['VALUE']?>',
							hintContent: '<?=$arStore['PROPERTIES']['ADDRESS']['VALUE']?>'
						}
					);
					clusterer.add(placemarks[<?=$arStore['ID']?>]);
				<?}?>
				
				map.geoObjects.add(clusterer);
				
				map.setBounds(clusterer.getBounds());
				map.setZoom(map.getZoom(), {checkZoomRange: true});
				
				map.events.add('sizechange', function () {
					map.setBounds(clusterer.getBounds());
					map.setZoom(map.getZoom(), {checkZoomRange: true});
				});
			
				$('.gray_cursor a').click(function() {
					$('html, body').animate({
						scrollTop: $('#big_map').offset().top
					}, 200);
					map.setCenter(placemarks[$(this).attr('data-id')].geometry.getCoordinates(), 16);
					placemarks[$(this).attr('data-id')].events.fire('click');
					return false;
				});
			});
			ymaps.ready(function() {
				var map = new ymaps.Map('big_map2', {
					center: [55.733835, 37.588227],
					zoom: 13
				});
				map.controls.add('mapTools', {left: 35, top: 5});
				map.controls.add('zoomControl', {left: 5, top: 5});
				
				var clusterer = new ymaps.Clusterer();
				
				var placemarks = {};
				
				<?foreach ($arResult['STORES'] as $arStore) {?>
					placemarks['<?=$arStore['ID']?>'] = new ymaps.Placemark(
						[<?=$arStore['PROPERTIES']['MAP']['VALUE']?>],
						{
							iconContent: '',
							balloonContent: '<?=$arStore['PROPERTIES']['ADDRESS']['VALUE']?>',
							hintContent: '<?=$arStore['PROPERTIES']['ADDRESS']['VALUE']?>'
						}
					);
					clusterer.add(placemarks[<?=$arStore['ID']?>]);
				<?}?>
				
				map.geoObjects.add(clusterer);
				
				map.setBounds(clusterer.getBounds());
				map.setZoom(map.getZoom(), {checkZoomRange: true});
				
				map.events.add('sizechange', function () {
					map.setBounds(clusterer.getBounds());
					map.setZoom(map.getZoom(), {checkZoomRange: true});
				});
			
				$('.gray_cursor a').click(function() {
					$('html, body').animate({
						scrollTop: $('#big_map').offset().top
					}, 200);
					map.setCenter(placemarks[$(this).attr('data-id')].geometry.getCoordinates(), 16);
					placemarks[$(this).attr('data-id')].events.fire('click');
					return false;
				});
			});
	</script>
<?}?>

</div>