<?$loc = getUserLocation();?>
<div class="mobile_header_geo_block">
	<a class="mobile_header_geo js_mobile_header_geo" href=""><span><?=$loc?></span></a>
	<div class="header_geo_light" <?=defined('LOCATION_IS_FROM_IP') ? ' style="display: block;"' : ''?>>
		<div class="header_geo_light_title">Ваш регион: <span><?=$loc?></span> ?</div>
		<div class="header_geo_light_button">
			<a class="geo_gray_button" href=""><span>Да</span></a>
			<a class="geo_red_button fancy_ajax" href="/include/popup_geo.php"><span>Выбрать<br/>другой город</span></a>
		</div>
	</div>
</div>
<?
if(defined('LOCATION_IS_FROM_IP'))
{
    ?>
    
    <div class="geo_popup" id="geo_popup1" style="display: none;">
        <div class="header_geo_light_title">Ваш регион: <span><?=$loc?></span> ?</div>
        <div class="header_geo_light_button">
            <a class="geo_gray_button" href=""><span>Да</span></a>
            <a class="geo_red_button fancy_ajax" href="/include/popup_geo.php"><span>Выбрать<br>другой город</span></a>
        </div>
    </div>

    <script>
        $(document).ready(function()
        {
            if($('.bx-touch').length)
            {
                $.fancybox.open({
                    href  : '#geo_popup1',
                    padding: 0, 
                    scrolling: "visible"
                });    
            }
            
        });
    </script>
    <?    
}
?>