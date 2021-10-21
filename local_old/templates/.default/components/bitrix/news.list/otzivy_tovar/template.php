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
	$arProps = $arItem['PROPERTIES'];
	?>
	<div class="content_text_comment" id="<?=$this->GetEditAreaId($arItem['ID']);?>" itemprop="review" itemscope itemtype="http://schema.org/Review">
		<meta itemprop="itemReviewed" content="Diada-arms">
		<div class="photo_text_comment">
			<img src="/img/users_photo.png">
			<p itemprop="author"><?=$arItem['NAME']?></p>
		</div>
		<div class="text_message">
			<span itemprop="reviewRating" itemscope itemtype="http://schema.org/Rating"><meta itemprop="ratingValue" content="<?=$arItem['PROPERTIES']["OCENKA"]['VALUE'];?>">
                        <meta itemprop="bestRating" content="5" />
                        <meta itemprop="worstRating" content="1" /></span>
			<ul>
                <li>
                    <?for($i=1;$i<=5;$i++):?>
                        <?if ($arItem['PROPERTIES']["OCENKA"]['VALUE']>=$i):?>
                            <img src="/img/min_orange_star.png">
                        <?else:?>
                            <img src="/img/min_gray_star.png">
                        <?endif;?>
                    <?endfor;?>
                </li>
				<li><?=$arItem['DISPLAY_ACTIVE_FROM']?></li>
			</ul>
			<div class="gray_text_comment">
				<span class="left_arrow_comment"></span>
				<p itemprop="description"><?=$arItem['PREVIEW_TEXT']?></p>
				<div class="open_otvet_commnet js_open_otvet_commnet">
					<div class="open_commnet_block"></div>
				</div>
				<?$count = is_array($arProps['LIKE']['VALUE']) ? count($arProps['LIKE']['VALUE']) : 0;?>
				<a class="green_comment_reiting" data-id="<?=$arItem['ID']?>" href="">(<span><?=$count?></span>)</a>
			</div>
		</div>
	</div>
<?endforeach;?>

<script type="text/javascript">
	$(document).ready(function() {
		$('body').on('click', '.green_comment_reiting', function() {
			var elem = $(this);
			var id = $(this).data('id');
			$.get('<?=$templateFolder?>/upd_count.php?id='+id, function(data) {
				console.log(data);
				elem.find('span').text(data);
			});
			return false;
		});
	});
</script>