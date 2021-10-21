<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Возврат товара");
?>
<link href="/css/return_style.css" rel="stylesheet" type="text/css" >
<div class="vozvrat_page_bl">
	<div class="vozvrat_page_gray">Чтобы вернуть товар по браку, оформите заявку на его проверку.</div>
	<div class="vozvrat_form_bl">
		<div class="vozvrat_form_l">
			<a class="red_bt" href="">Создать заявку</a>
		</div>
		<div class="vozvrat_form_r">
			<form>
				<input type="text" placeholder="Поиск заявки"/>
				<input type="submit" value=""/>
			</form>
		</div>
	</div>
	<div class="vozvrat_page_cont">
		<div class="vozvrat_page_t">
			<div class="vozvrat_page_gray">Срок рассмотрения заявки:</div>
			<div class="vozvrat_page_red">От 3х рабочих дней</div>
		</div>
		<div class="vozvrat_page_c">
			<p>Вернуть товар ненадлежащего качества можно быстрее, оформив онлайн-заявку на его проверку:</p>
			<p>— Приложите фотографии товара (ниже приведены требования к фото)</p>
			<p>— опишите в комментарии выявленный дефект</p>
			<p>При одобрении заявки товар можно вернуть в пункте самовывоза, а также через курьера</p>
			<p>Денежные средства будут зачислены на Ваш баланс сразу после того, как статус товара изменится на «Возврат»</p>
			<p>Если брак не подтвердится, Вы получите акт осмотра</p>
			<p class="vozvrat_page_marg"><b>Некорректно заполненная заявка будет отклонена.</b></p>
		</div>
		<div>
			<p>Требования к содержанию фотографий <i class="fa fa-angle-down" aria-hidden="true"></i></p>
			<div class="vozvrat_page_gray">
				<p>— Размер каждого файла не должен превышать 2 МБ</p>
				<p>— Поддерживаемые форматы: JPG, JPEG, PNG</p>
				<p>— Обзорная фотография товара целиком</p>
				<p>— Крупный план вшивной бирки</p>
				<p>— При наличии пакета со штрих-кодом, фото штрих-кода</p>
				<p>— Предполагаемый дефект товара</p>
				<p>— Предмет должен быть в фокусе, не размытым, его маркировка — четкой, хорошо читаемой</p>
			</div>
		</div>
	</div>
</div>
<br/>
<br/>
<br/>
<br/>
<script>
	$(".refund_prava.styler input:checkbox").styler();
	$(".refund_form_el.styler input:file").styler({
		filePlaceholder: 'Прикрепите, пожалуйста, фото или видео дефекта или неисправност',
		fileBrowse: 'Загрузить файлы'
	});
</script>
<div class="refund_bl">
	<form>
		<div class="refund_tit">Обращение по гарантии или возврату</div>
		<div class="refund_cont">
			<div class="refund_step_bl">
				<div class="refund_step_el active"><div class="refund_step_bt">1</div></div>
				<div class="refund_step_el"><div class="refund_step_bt">2</div></div>
				<div class="refund_step_el"><div class="refund_step_bt">3</div></div>
			</div>
			<div class="refund_form_bl">
				<div class="refund_form_el">
					<input type="text" placeholder="*ФИО"/>
				</div>
				<div class="refund_form_el">
					<input type="text" placeholder="*Номер заказа"/>
				</div>
				<div class="refund_form_el">
					<input type="text" placeholder="*Дата заказа"/>
				</div>
				<div class="refund_form_el textarea">
					<textarea placeholder="*Описание неисправности"></textarea>
				</div>
				<div class="refund_form_el textarea">
					<textarea placeholder="*Описание требования"></textarea>
				</div>
				<div class="refund_form_el file styler">
					<input type="file"/>
				</div>
			</div>
			<div class="refund_form_bt">
				<a class="red_bt" href="">Дальше<i class="fa fa-long-arrow-right" aria-hidden="true"></i></a>
			</div>
		</div>
	</form>
</div>
<br/>
<br/>
<br/>
<div class="refund_bl">
	<form>
		<div class="refund_tit">Обращение по гарантии или возврату</div>
		<div class="refund_cont">
			<div class="refund_step_bl">
				<div class="refund_step_el close"><div class="refund_step_bt">1</div></div>
				<div class="refund_step_el active"><div class="refund_step_bt">2</div></div>
				<div class="refund_step_el"><div class="refund_step_bt">3</div></div>
			</div>
			<div class="refund_txt_bl">
				<div class="refund_txt">Краткий текст-инструкция по заполнению заявления и загрузке на сайт. <br/>Для современного мира постоянный количественный рост и сфера нашей активности обеспечивает широкому кругу (специалистов) участие в формировании инновационных методов управления процессами.</div>
				<a class="refund_pdf" href="">Заявление по гарантии.pdf</a>
			</div>
			<div class="refund_form_bl">
				<div class="refund_form_el file styler">
					<input type="file"/>
				</div>
			</div>
			<div class="refund_form_bt">
				<a class="gray_bt" href="">шаг назад</a>
				<a class="red_bt" href="">Дальше<i class="fa fa-long-arrow-right" aria-hidden="true"></i></a>
			</div>
		</div>
	</form>
</div>
<br/>
<br/>
<br/>
<div class="refund_bl">
	<form>
		<div class="refund_tit">Обращение по гарантии или возврату</div>
		<div class="refund_cont">
			<div class="refund_step_bl">
				<div class="refund_step_el close"><div class="refund_step_bt">1</div></div>
				<div class="refund_step_el close"><div class="refund_step_bt">2</div></div>
				<div class="refund_step_el active"><div class="refund_step_bt">3</div></div>
			</div>
			<div class="refund_txt_bl">
				<div class="refund_txt">Для современного мира постоянный количественный рост и сфера нашей активности обеспечивает широкому кругу (специалистов) участие в формировании инновационных методов управления процессами.</div>
				<div class="refund_prava styler">
					<label>
						<input type="checkbox"/>
						Ознакомлен с <a href="">гарантийными условиями</a>
					</label>
				</div>
			</div>
			<div class="refund_form_bt center">
				<a class="gray_bt" href="">шаг назад</a>
				<a class="red_bt big" href="">Отправить заявку</a>
			</div>
		</div>
	</form>
</div>
<br/>
<br/>
<br/>
<div class="refund_bl">
	<form>
		<div class="refund_tit">Обращение по гарантии или возврату</div>
		<div class="refund_cont">
			<div class="refund_cont_ok">
				<div class="refund_number">№ Заявки: <b>2245680999</b></div>
				<div class="refund_ok_bl">
					<i class="fa fa-check" aria-hidden="true"></i>
					<div class="refund_ok_txt">
						<div class="refund_ok_h1">Заявка на возврат товара успешно отправлена!</div>
						<div class="refund_ok_h2">Через некоторое время менеджер свяжется с вами.</div>
						<div class="refund_ok_h3">Срок рассмотрения от 3х рабочих дней</div>
					</div>
				</div>
			</div>
		</div>
	</form>
</div>
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>