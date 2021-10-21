<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<?

file_put_contents(__DIR__ . '/debug.txt', var_export($arResult["CATEGORIES"], true));

if(!empty($arResult["CATEGORIES"])):?>
	<table class="title-search-result">
        <?if ((count($arResult["LIST_PRODUCT"])>0) && (count(array_diff(explode(" ",$_REQUEST["q"]), array('')))>1)):?>
            <tr><td style="padding: 10px"></td></tr>
            <tr><td><b>Товары</b></td></tr>
            <?$iCuonterBreack = 0;?>
            <?foreach ($arResult["LIST_PRODUCT"] as $infoSection):?>
                <?
                $iCuonterBreack++;
                if ($iCuonterBreack>10) break;
                ?>
                <tr><td><a href="<?=$infoSection["LINK"]?>"><?=$infoSection["NAME"]?></td></tr>
            <?endforeach;?>
        <?endif;?>
        <?if (count($arResult["LIST_CATEGOR"])>0):?>
            <tr><td style="padding: 10px;"></td></tr>
            <tr><td><b>Категории</b></td></tr>
            <?$iCuonterBreack = 0;?>
            <?foreach ($arResult["LIST_CATEGOR"] as $infoSection):?>
                <?
                $iCuonterBreack++;
                if ($iCuonterBreack>10) break;
                ?>
                <tr><td><a href="<?=$infoSection["LINK"]?>"><?=$infoSection["NAME"]?></td></tr>
            <?endforeach;?>
        <?endif;?>
        <tr><td style="padding: 10px;"></td></tr>
	</table>
<?endif;
?>
<script>
    $("[href='/modeli/kompleks-dlya-vneseniya-bezvodnogo-ammiaka-v-grunt/']").parent("li").siblings("li:has('a.sup-menu')")
</script>
