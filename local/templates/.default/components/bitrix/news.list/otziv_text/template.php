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
<div class="news-list-text">
<?if($arParams["DISPLAY_TOP_PAGER"]):?>
	<?=$arResult["NAV_STRING"]?><br />
<?endif;?>
<!--RestartBuffer-->
<?foreach($arResult["ITEMS"] as $arItem):?>
	<?
	$this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
	$this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
	?>
	<div class="content_text_comment" id="<?=$this->GetEditAreaId($arItem['ID']);?>">
		<div class="photo_text_comment">
			<img src="/img/users_photo.png"/>
			<p><?echo $arItem["NAME"]?></p>
		</div>
		<div class="text_message">
			<ul>
				<li>
					<?
					for($i=1; $i<=5; $i++):
						if ($i <= $arItem['PROPERTIES']['OCENKA']['VALUE'])
                        {
                            ?>
                            <img src="/img/min_orange_star.png"/>
                            <?
                        }
						else
                        {
                            ?>
                            <img src="/img/min_gray_star.png"/>
                            <?
                        }
					endfor;
					switch($arItem['PROPERTIES']['OCENKA']['VALUE']):
						case 1: echo "Ужасный магазин"; break;
						case 2: echo "Плохой магазин"; break;
						case 3: echo "Обычный магазин"; break;
						case 4: echo "Хороший магазин"; break;
						case 5: echo "Отличный магазин"; break;
					endswitch;
					?>
				</li>
				<li><?echo $arItem["DISPLAY_ACTIVE_FROM"]?></li>
			</ul>
			<div class="gray_text_comment">
				<span class="left_arrow_comment"></span>
				<p><?=$arItem['PREVIEW_TEXT']?></p>
				<?/*<div class="open_otvet_commnet js_open_otvet_commnet">
					<div class="open_commnet_block">
						<?if ($arItem['DETAIL_TEXT']):?><p class="display_block" onclick="openComment(this);"><span>Показать ответ</span> Diada-arms.ru ></p><?endif;?>
						<?if ($arItem['DETAIL_TEXT']):?><p class="close_otvet_arrow" onclick="openComment(this);"><span>СКРЫТЬ ответ</span> Diada-arms.ru</p><?endif;?>
					</div>
				</div>*/?>
			</div>
			<?if ($arItem['DETAIL_TEXT']):?>
			<div class="otvet_text_cooment_block js_otvet_text_cooment">
				<div class="photo_text_comment">
					<img src="/img/diada_photo.png"/>
					<p>Diada Arms</p>
				</div>
				<div class="text_message otvet_text_comment">
					<div class="gray_text_comment">
						<span class="left_arrow_comment"></span>
						<?=$arItem['DETAIL_TEXT']?>
					</div>
				</div>
			</div>
			<?endif;?>
		</div>
	</div>
	<script type="application/ld+json">
	{
		"@context": "https://schema.org/",
		"@type": "Review",
		"itemReviewed": {
			"@type": "Organization",
			"name": "Diada-Arms",
			"email": "info@diada-arms.ru",
			"telephone": "84952681372",
			"address": {
				"@type": "PostalAddress",
				"addressLocality": "Москва",
				"streetAddress": "ул. Бауманская"
			}
		},
		"author": "<?=htmlspecialchars($arItem["NAME"], ENT_QUOTES)?>",
		"reviewBody": "<?=htmlspecialchars($arItem['PREVIEW_TEXT'], ENT_QUOTES)?>"
	}
	</script>
<?endforeach;?>

<?/*if($arParams["DISPLAY_BOTTOM_PAGER"]):?>
	<br /><?=$arResult["NAV_STRING"]?>
<?endif;*/?>

<?
$paramName = 'PAGEN_'.$arResult['NAV_RESULT']->NavNum;
$paramValue = $arResult['NAV_RESULT']->NavPageNomer;
$pageCount = $arResult['NAV_RESULT']->NavPageCount;

if ($paramValue < $pageCount) {
    $paramValue = (int) $paramValue + 1;
    $url = htmlspecialcharsbx(
        $APPLICATION->GetCurPageParam(
            sprintf('%s=%s', $paramName, $paramValue),
            array($paramName, 'AJAX_PAGE',)
        )
    );
    echo sprintf('<div class="ajax-pager-wrap">
                      <a class="ajax-pager-link old_comment" data-wrapper-class="news-list-text" href="%s">Ещё больше отзывов здесь</a>
                  </div>',
        $url);
}
?>
<!--RestartBuffer-->
</div>