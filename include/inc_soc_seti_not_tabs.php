            <?$prefoxSocSeti = "_pref".rand(100, 1000);?>

			<div>
				<script type="text/javascript" src="//vk.com/js/api/openapi.js?152"></script>

				<!-- VK Widget -->
				<div id="vk_groups"></div>
				<script type="text/javascript">
				VK.Widgets.Group("vk_groups", {mode: 3}, 26719804);
				</script>

				<?/*блок соцсети контакт*/?>
				<!-- <script type="text/javascript" src="/js/openapi.js"></script>
				<div id="vk_groups<?=$prefoxSocSeti?>"></div>
				<script type="text/javascript">
					VK.Widgets.Group("vk_groups<?=$prefoxSocSeti?>", {mode: 0, width: "150", height: "263", color1: 'FFFFFF', color2: '2B587A', color3: '5B7FA6'}, 26719804);
				</script> -->
				<?/*------------------------------*/?>
			</div>

			<div>
				<div id="ok_group_widget"></div>
				<script>
				!function (d, id, did, st) {
				  var js = d.createElement("script");
				  js.src = "https://connect.ok.ru/connect.js";
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
				}(document,"ok_group_widget","52412778152122",'{"width":200,"height":160}');
				</script>


				<?/* блок соцсети одногавники */?>
	        	<!-- <div id="ok_group_widget<?=$prefoxSocSeti?>"></div>
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
				</div> -->
				<?/*------------------------------*/?>
			</div>

			<div>
				<div id="fb-root"></div>
				<script>(function(d, s, id) {
				  var js, fjs = d.getElementsByTagName(s)[0];
				  if (d.getElementById(id)) return;
				  js = d.createElement(s); js.id = id;
				  js.src = 'https://connect.facebook.net/ru_RU/sdk.js#xfbml=1&version=v2.12';
				  fjs.parentNode.insertBefore(js, fjs);
				}(document, 'script', 'facebook-jssdk'));</script>
				<div class="fb-page" data-href="https://www.facebook.com/diadaarms/" data-tabs="timeline" data-width="200" data-height="240" data-small-header="false" data-adapt-container-width="true" data-hide-cover="false" data-show-facepile="true"><blockquote cite="https://www.facebook.com/diadaarms/" class="fb-xfbml-parse-ignore"><a href="https://www.facebook.com/diadaarms/">Diada-arms.ru</a></blockquote></div>



				<?/* блок соцсети фейсбук */?>
				<!-- <div id="fb-root<?=$prefoxSocSeti?>"></div>
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
					data-width="200" data-height="160"
					data-colorscheme="light"
					data-show-faces="true"
					data-header="true"
					data-stream="false"
					data-show-border="true"
					data-show-header="true">
				</div> --><!-- 
				<div class="sc_text">
					<a class="sc_link" href="https://www.facebook.com/diadaarms" target="_blank">Подписаться</a>
				</div> -->
				<?/*------------------------------*/?>
			</div>

			<div>
				<a class="twitter-timeline" width="200" height="240" rel="nofollow" href="https://twitter.com/DiadaArms">Твиты от DiadaArms</a> <script async src="https://platform.twitter.com/widgets.js" charset="utf-8"></script>
				<?/*блок соцсети twitter*/?>
				<!-- <a class="twitter-timeline" width="200" height="160" href="https://twitter.com/DiadaArms" data-widget-id="565515738673582080">Твиты от @DiadaArms</a> -->
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
				</script><!-- 
				<div class="sc_text">
					<a class="sc_link" href="https://twitter.com/DiadaArms" target="_blank">Подписаться</a>
				</div> -->
	  			<?/*---------------------------------------------------------------*/?>
			</div>