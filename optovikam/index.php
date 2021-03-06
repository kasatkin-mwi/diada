<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Информация для оптовиков");
?><p>
	 Сеть магазинов Diada-Arms приглашает к сотрудничеству оптовых покупателей пневматического и страйкбольного оружия, луков, арбалетов и аксессуаров к ним. Мы предлагаем своим партнерам большой выбор продукции крупнейших производителей.
</p>
<p>
 <br>
</p>
<p>
	 У нас можно оптом приобрести пневматические винтовки, пистолеты (в том числе, револьверы), арбалеты, луки, комплектующие и аксессуары к ним, а также пули и шарики.
</p>
<p>
 <br>
</p>
<p>
	 Условия сотрудничества:
</p>
<ul>
	<li>нашим партнером может стать организация, индивидуальный предприниматель или частное лицо;</li>
	<li>оптовые цены на продукцию определяются закупаемыми объемами;</li>
	<li>минимальная сумма заказа существует, но в каждом случае она рассчитывается индивидуально;</li>
	<li>ограничений по количеству заказываемых товаров не существует;</li>
	<li>отгрузка происходит только после полной предоплаты;</li>
	<li>доставка товаров заказчику осуществляется федеральными транспортными компаниями, такими как «Деловые линии», ПЭК и другими;</li>
	<li>заказы принимаются в режиме онлайн, по&nbsp;<a href="mailto:info@diada-arms.ru">info@diada-arms.ru</a>&nbsp;и телефону&nbsp;8 (499) 213-21-02.</li>
</ul>
<p>
	 Для того чтобы узнать о преимуществах сотрудничества с нами, позвоните по номерам: +7 (499) 213-21-02
</p>
<p>
 <br>
</p>
<h2>Почему с нами выгодно работать</h2>
<ul>
	<li>В каталоге представлен полный перечень пневматического оружия, комплектующих и аксессуаров от ведущих мировых производителей. Среди них Gamo, Hatsan, Crosman, Umarex, Gletcher, Cybergun, ASG, Daisy и др.</li>
	<li>Внимательный контроль качества для всей продукции.</li>
	<li>Доставка во все регионы России по почте или через транспортные компании.</li>
	<li>Выгодные условия сотрудничества для оптовиков.</li>
	<li>Разнообразные варианты оплаты.</li>
</ul>
<p>
	 Мы работаем ежедневно (с 09:00 до 18:00).
</p>
 <br>
<p>
	 Наш оптовый отдел, будет рад связаться с Вами:
</p>
 <?
if($_SERVER["REQUEST_METHOD"] == 'POST' && !empty($_POST['MESSAGE']))
{
    $_POST['MESSAGE'] = str_replace(array("+", " ", "(", ")", "-", '_'), '', $_POST['MESSAGE']);
}
?> <?$APPLICATION->IncludeComponent(
	"salavey:main.feedback",
	"template1",
	Array(
		"COMPONENT_TEMPLATE" => "template1",
		"COMPOSITE_FRAME_MODE" => "A",
		"COMPOSITE_FRAME_TYPE" => "AUTO",
		"EMAIL_TO" => "opt@diada-arms.ru",
		"EVENT_MESSAGE_ID" => array(0=>"7",),
		"OK_TEXT" => "Спасибо, ваше сообщение принято.",
		"REQUIRED_FIELDS" => array(0=>"NAME",1=>"MESSAGE",),
		"USE_CAPTCHA" => "Y"
	)
);?><br><?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>