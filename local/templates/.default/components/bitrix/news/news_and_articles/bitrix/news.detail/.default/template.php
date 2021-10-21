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
<?

$arFilter = array(
    "IBLOCK_ID" => $arResult['IBLOCK_ID'],
    "ID" => $arResult['ID'],
);

$arSelect = array(
    'PREVIEW_PICTURE',
);

$db_list = CIBlockElement::GetList($arOrder, $arFilter, false, $arSelect, false);

while($db_section = $db_list->GetNext()){
         //var_dump($db_section);
      $detaiPicture = CFile::GetPath($db_section["PREVIEW_PICTURE"]);
      $timer = $db_section["TIMESTAMP_X"];
}

$timer = date('Y-m-d',strtotime($timer));

?>

<div class="news-detail text_h"  itemscope itemtype="http://schema.org/ScholarlyArticle">
	 <span style="display: none;" itemprop="headline" class="razdel_firearm_name"><?=$arResult["NAME"]?></span>
	<img
                            class=""
                            border="0"
                            src="<?=$detaiPicture?>"
                            alt="<?=$arResult["PREVIEW_PICTURE"]["ALT"]?>"
                            title="<?=$arResult["PREVIEW_PICTURE"]["TITLE"]?>"
                            style="display: none;"
                            itemprop="image"
                    />
<span style="display: none;" itemprop="author">diada-arms.ru</span>




<div style="display: none;" itemprop="publisher" itemscope itemtype="http://schema.org/Organization" >
  <span itemprop="name">diada-arms.ru</span>
<div itemprop="logo" itemscope itemtype="https://schema.org/ImageObject">
      <img itemprop="url" src="https://www.diada-arms.ru/img/2020_Logo_bg.gif" />
      <img itemprop="contentUrl" src="https://www.diada-arms.ru/img/2020_Logo_bg.gif" />
</div>

  Контакты:
  <div itemprop="address" itemscope itemtype="http://schema.org/PostalAddress">
    Адрес:
    <span itemprop="streetAddress">ул. Бауманская</span>
    <span itemprop="addressLocality">Москва</span>,
  </div>
  Телефон:<span itemprop="telephone">+7 (495) 268-13-72</span>,
  Электронная почта: <span itemprop="email">info@diada-arms.ru</span>    
</div>

<span style="display: none;" >diada-arms.ru</span>
<time style="display: none;" datetime="<?=$timer?>" itemprop="datePublished"><?=$timer?></time>
<div itemprop="articleBody">


    <?if ($arResult["PROPERTIES"]["TYPE_VIEW"]["VALUE_ENUM_ID"] == 996):?>
        <div class="news_detail_firearm_block">
            <a class="razdel_firearm" href="<?=$arResult["PROPERTIES"]["URL_BRAND"]["VALUE"]?>">
                <span class="razdel_firearm_img">
                    <img
                            class=""
                            border="0"
                            src="<?=$arResult["DETAIL_PICTURE"]["SRC"]?>"
                            alt="<?=$arResult["DETAIL_PICTURE"]["ALT"]?>"
                            title="<?=$arResult["DETAIL_PICTURE"]["TITLE"]?>"
                    />
                </span>
                <span itemprop="name" class="razdel_firearm_name"><?=$arResult["NAME"]?></span>
            </a>
        </div>
        <a class="red_button" href="<?=$arResult["PROPERTIES"]["URL_BRAND"]["VALUE"]?>">Посмотреть все модели <?=$arResult["NAME"]?></a>
    <?else:?>
        <?if($arParams["DISPLAY_PICTURE"]!="N" && is_array($arResult["DETAIL_PICTURE"])):?>
            <img
                class=""
                border="0"
                src="<?=$arResult["DETAIL_PICTURE"]["SRC"]?>"
                alt="<?=$arResult["DETAIL_PICTURE"]["ALT"]?>"
                title="<?=$arResult["DETAIL_PICTURE"]["TITLE"]?>"
            />
        <?endif?>


        <?if($arParams["DISPLAY_PREVIEW_TEXT"]!="N" && $arResult["FIELDS"]["PREVIEW_TEXT"]):?>
            <div><?=$arResult["FIELDS"]["PREVIEW_TEXT"];unset($arResult["FIELDS"]["PREVIEW_TEXT"]);?></div>
        <?endif;?>
        <?if(strlen($arResult["DETAIL_TEXT"])>0):?>
            <?echo $arResult["DETAIL_TEXT"];?>
        <?else:?>
            <?echo $arResult["PREVIEW_TEXT"];?>
        <?endif?>
        <div style="clear:both"></div>
        <br />
        <?
        if(array_key_exists("USE_SHARE", $arParams) && $arParams["USE_SHARE"] == "Y")
        {
            ?>
            <div class="news-detail-share">
                <noindex>
                <?
                $APPLICATION->IncludeComponent("bitrix:main.share", "", array(
                        "HANDLERS" => $arParams["SHARE_HANDLERS"],
                        "PAGE_URL" => $arResult["~DETAIL_PAGE_URL"],
                        "PAGE_TITLE" => $arResult["~NAME"],
                        "SHORTEN_URL_LOGIN" => $arParams["SHARE_SHORTEN_URL_LOGIN"],
                        "SHORTEN_URL_KEY" => $arParams["SHARE_SHORTEN_URL_KEY"],
                        "HIDE" => $arParams["SHARE_HIDE"],
                    ),
                    $component,
                    array("HIDE_ICONS" => "Y")
                );
                ?>
                </noindex>
            </div>
            <?
        }
        ?>
    <?endif;?>
	</div>
</div>