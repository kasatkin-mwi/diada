<?
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true)
	die();
$lisctSoc = array(
    "VKontakte" => "vk",
    "Odnoklassniki" => "ok",
    "Facebook" => "fb",
    "Twitter" => "tw",
    "GoogleOAuth" => "google",
)
?>
<div class="all_social_icon">
    <div class="socila_block">
        <?foreach($arParams["~AUTH_SERVICES"] as $service):?>
            <?if (strlen($lisctSoc[$service["ID"]])>0):?>
                <a class="<?=$lisctSoc[$service["ID"]]?>" title="<?=htmlspecialcharsbx($service["NAME"])?>" href="javascript:void(0)" onclick="BxShowAuthFloat('<?=$service["ID"]?>', '<?=$arParams["SUFFIX"]?>')"><?=htmlspecialcharsbx($service["NAME"])?></a>
            <?endif;?>
        <?endforeach?>
    </div>
</div>
