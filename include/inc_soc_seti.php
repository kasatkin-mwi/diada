            <?$prefoxSocSeti = "_pref".rand(100, 1000);?>
			<ul class="tabs not_style">
				<li class="current tabs_vk">VK</li>
				<li class="tabs_ok">OK</li>
				<li class="tabs_fb">FB</li>
				<li class="tabs_tw">TW</li>
			</ul>
			<div class="box" style="display:block;">
				<?/*блок соцсети контакт*/?>
				<script type="text/javascript" src="/js/openapi.js"></script>
				<div id="vk_groups<?=$prefoxSocSeti?>"></div>
				<script type="text/javascript">
					VK.Widgets.Group("vk_groups<?=$prefoxSocSeti?>", {mode: 0, width: "150", height: "263", color1: 'FFFFFF', color2: '2B587A', color3: '5B7FA6'}, 26719804);
				</script>
				<?/*------------------------------*/?>
			</div>
			<div class="box">
				<?/* блок соцсети одногавники */?>
	        	<div id="ok_group_widget<?=$prefoxSocSeti?>"></div>
				<script>
					!function (d, id, did, st) {
					  var js = d.createElement("script");
					  js.src = "//connect.ok.ru/connect.js";
					  js.onload = js.onreadystatechange = function () {
					  if (!this.readyState || this.readyState == "loaded" || this.readyState == "complete") {
						if (!this.executed) {
						  this.executed = true;
						  setTimeout(function () {
							OK.CONNECT.insertGroupWidget(id,did,st);
						  }, 0);
						}
					  }}
					  d.documentElement.appendChild(js);
					}(document,"ok_group_widget<?=$prefoxSocSeti?>","52412778152122","{width:160,height:263}");
				</script>
				<div class="sc_text">
					<a rel="nofollow" class="sc_link" href="http://ok.ru/httpwww.di" target="_blank">Подписаться</a>
				</div>
				<?/*------------------------------*/?>
			</div>
			<div class="box">
				<?/* блок соцсети фейсбук */?>
				<div id="fb-root<?=$prefoxSocSeti?>"></div>
				<script>
					(function(d, s, id) {
					  var js, fjs = d.getElementsByTagName(s)[0];
					  if (d.getElementById(id)) return;
					  js = d.createElement(s);
					  js.id = id;
					  js.src = "//connect.facebook.net/ru_RU/sdk.js#xfbml=1&version=v2.0";
					  fjs.parentNode.insertBefore(js, fjs);
					}(document, 'script', 'facebook-jssdk'));
				</script>
				<div class="fb-like-box"
					data-href="https://www.facebook.com/diadaarms"
					data-width="140" data-height="263"
					data-colorscheme="light"
					data-show-faces="true"
					data-header="true"
					data-stream="false"
					data-show-border="true"
					data-show-header="true">
				</div>
				<div class="sc_text">
					<a class="sc_link" rel="nofollow" href="https://www.facebook.com/diadaarms" target="_blank">Подписаться</a>
				</div>
				<?/*------------------------------*/?>
			</div>
			<div class="box">
				<?/*блок соцсети twitter*/?>
				<a class="twitter-timeline" width="140" height="263" rel="nofollow" href="https://twitter.com/DiadaArms" data-widget-id="565515738673582080">Твиты от @DiadaArms</a>
				<script>
					!function(d,s,id){
						var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';
						if (!d.getElementById(id)){
							js=d.createElement(s);
							js.id=id;
							js.src=p+"://platform.twitter.com/widgets.js";
							fjs.parentNode.insertBefore(js,fjs);
						}
					}(document,"script","twitter-wjs");
				</script>
				<div class="sc_text">
					<a class="sc_link" rel="nofollow" href="https://twitter.com/DiadaArms" target="_blank">Подписаться</a>
				</div>
	  			<?/*---------------------------------------------------------------*/?>
			</div>