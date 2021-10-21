<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Diada-arms.ru");
?>
<link href="/css/return_style.css" rel="stylesheet" type="text/css" >
<div class="vozvrat_page_bl">
    <div class="vozvrat_page_gray">Чтобы вернуть товар по браку, оформите заявку на его проверку.</div>
    <div class="vozvrat_form_bl">
        <div class="vozvrat_form_l">
            <a class="red_bt" href="/return/add/">Создать заявку</a>
        </div>
        <div class="vozvrat_form_r">
            <form>
                <input type="text" placeholder="Поиск заявки"/>
                <input type="submit" value=""/>
            </form>
        </div>
    </div>
	<div class="result_cont">
		<div class="result_gray_tit">Результат поиска:</div>
		<div class="result_not_found">
			<p>Извините, по Вашему запросу ничего не найдено.</p>
			<p>Проверьте правильность ввода  № заявки.</p>
		</div>
	</div>
</div>
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>