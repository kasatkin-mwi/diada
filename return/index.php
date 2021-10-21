<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetPageproperty("title", "Возврат товара");
$APPLICATION->SetPageproperty("description", "Возврат товара. Интернет-магазин Diada-Arms предлагает широкий ассортимент пневматики, а также товаров для охоты и активного отдыха.");
$APPLICATION->SetTitle("Возврат товара");
?>
<link href="/css/return_style.css" rel="stylesheet" type="text/css" >
<script type="text/javascript" src="/js/return_script.js"></script>
<div class="vozvrat_page_bl">
    <div class="vozvrat_page_gray">Чтобы вернуть товар по браку, оформите заявку на его проверку.</div>
    <div class="vozvrat_form_bl">
        <div class="vozvrat_form_l">
            <a class="red_bt" href="/return/add/">Создать заявку</a>
        </div>
        <div class="vozvrat_form_r">
            <form>
                <input type="text" name="number" placeholder="Поиск заявки"/>
                <input type="submit" value=""/>
            </form>
        </div>
    </div>
    <div class="vozvrat_page_cont">
        <?$APPLICATION->IncludeComponent(
            "bitrix:main.include",
            "",
            Array(
                "AREA_FILE_SHOW" => "file",
                "AREA_FILE_SUFFIX" => "inc",
                "EDIT_TEMPLATE" => "",
                "PATH" => "/include/return_info.php"
            )
        );?>
    </div>
    <div class="result_cont" style="position: relative;">

    </div>
</div>
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>