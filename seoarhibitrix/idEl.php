<?
require_once($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");
CModule::IncludeModule("iblock");
$code = array(
	"7-konusov-at44-10-kral-5-5-6-35",
    "bal-seyf-ballistol-400ml",
    "gamo-basik-ear-muff",
    "k-nakladok-weav-pic-12",
    "kopiya-pbs-1-ak-74",
    "kovrik-ak-47",
    "k-rez-nakladok-weav-pic-2",
    "lozhement-benchmaster-cadillac",
    "mag-gamo-p25-i-pt85",
    "mini-ustroystvo-zapuska-signala-okhotnika",
    "jvd-fita-30-sm-model-6",
    "kalabushka-target-shot-t-k-25",
    "imitator-glushitelya-stalker-spm",
    "mod-34-mr-512-60-61-13-mm",
    "mod-t-32-pcp-hat-weih-fx-bsa-evanix",
    "mod-t34-12-1-mr-512-izh-60-mr-60",
    "mod-t-34-16-mm-hat-d",
    "mod-t-34-661-drozd",
    "mod-t-34-ataman",
    "mod-t90-komb-pcp-hat-weih-100-fx-bsa-evanix"
);
$url = array(
    "/catalog/aksessuary/7-konusov-at44-10-kral-5-5-6-35/",
    "/catalog/aksessuary/bal-seyf-ballistol-400ml/",
    "/catalog/aksessuary/gamo-basik-ear-muff/",
    "/catalog/aksessuary/k-nakladok-weav-pic-12/",
    "/catalog/aksessuary/kopiya-pbs-1-ak-74/",
    "/catalog/aksessuary/kovrik-ak-47/",
    "/catalog/aksessuary/k-rez-nakladok-weav-pic-2/",
    "/catalog/aksessuary/lozhement-benchmaster-cadillac/",
    "/catalog/aksessuary/magaziny/mag-gamo-p25-i-pt85/",
    "/catalog/aksessuary/mini-ustroystvo-zapuska-signala-okhotnika/",
    "/catalog/aksessuary/misheni/jvd-fita-30-sm-model-6/",
    "/catalog/aksessuary/misheni/kalabushka-target-shot-t-k-25/",
    "/catalog/aksessuary/moderatory/imitator-glushitelya-stalker-spm/",
    "/catalog/aksessuary/moderatory/mod-34-mr-512-60-61-13-mm/",
    "/catalog/aksessuary/moderatory/mod-t-32-pcp-hat-weih-fx-bsa-evanix/",
    "/catalog/aksessuary/moderatory/mod-t34-12-1-mr-512-izh-60-mr-60/",
    "/catalog/aksessuary/moderatory/mod-t-34-16-mm-hat-d/",
    "/catalog/aksessuary/moderatory/mod-t-34-661-drozd/",
    "/catalog/aksessuary/moderatory/mod-t-34-ataman/",
    "/catalog/aksessuary/moderatory/mod-t90-komb-pcp-hat-weih-100-fx-bsa-evanix/",
);


echo "<pre>";
$idElement = array();
function getArrIDElement($date, $url){
	for ($i=0; $i < count($date); $i++) {
		$ID[] = elementOrSection($date[$i], $url[$i]);
		// if(is_int(elementOrSection($date[$i], $url[$i])))
		// {
		// 	$ID["YES"][] = elementOrSection($date[$i], $url[$i]);
		// }else{
		// 	$ID["NO"][] = elementOrSection($date[$i], $url[$i]);
		// }
	}
	return $ID;
}

$ID = getArrIDElement($code, $url);
// echo gettype($ID[47]);die();
// print_r($ID);die();
// $code = "imitator-glushitelya-stalker-spm"; $url = "/catalog/aksessuary/imitator-glushitelya-stalker-spm/";
// print_r(elementOrSection($code, $url));
// возвращает id элемента по символьному коду сравнивая в url
function elementOrSection($code, $url){	
	// получаем все элементы с текущим символьным кодом
	$element = CIBlockElement::GetList(array(), array('=CODE' => $code), false, array(), array());
	// получаем все разделы с текущем символьным кодом
		while($ob = $element->GetNextElement()){
			// если объект не пустой выполняем услови
			if($ob){
				$arFields = $ob->GetFields();
				if($arFields["DETAIL_PAGE_URL"] == $url){
					return (int)$arFields["ID"];
				}else{
					return "Элемент для страницы {$url} не найден";
				}
			}
		}
}


$title = array(
    "Саунд-модератор цельный (4 камеры) для Hatsan AT44-10, Kral 5,5 мм, 6,35 мм — купить по доступной цене в интернет-магазине Diada-Arms",
    "Баллончик-сейф Ballistol 400 мл — купить по доступной цене в интернет-магазине Diada-Arms",
    "Наушники GAMO Basik Ear Muff — купить по доступной цене в интернет-магазине Diada-Arms",
    "Комплект накладок на Weaver/Picatinny (12 шт) — купить по доступной цене в интернет-магазине Diada-Arms",
    "Упрощенная копия ПБС-1 для АК-74 — купить по доступной цене в интернет-магазине Diada-Arms",
    "Коврик ShotTime для чистки ружей АК-47 — купить по доступной цене в интернет-магазине Diada-Arms",
    "Комплект резиновых накладок для цевья на Weaver/Picatinny (2 шт) — купить по доступной цене в интернет-магазине Diada-Arms",
    "Ложемент для пристрелки Benchmaster (Cadillac) — купить по доступной цене в интернет-магазине Diada-Arms",
    "Запасной магазин для GAMO P25 и PT85 Blowback — купить по доступной цене в интернет-магазине Diada-Arms",
    "Мини устройство запуска сигнала охотника (для перцовых баллонов) — купить по доступной цене в интернет-магазине Diada-Arms",
    "Мишень армированная JVD Fita 30 см, модель 6 — купить по доступной цене в интернет-магазине Diada-Arms",
    "Мишень калабушка Target Shot T-K/25 для винтовок 25 Дж (усиленная) — купить по доступной цене в интернет-магазине Diada-Arms",
    "Имитатор глушителя STALKER для модели SPM 4,5 мм — купить по доступной цене в интернет-магазине Diada-Arms",
    "Саунд-модератор Т 34 для винтовок МР-512/60/61 — купить по доступной цене в интернет-магазине Diada-Arms",
    "Саунд-модератор Т 32 для PCP Kral, Hatsan, Weihfauch 100, FX, BSA, Evanix — купить по доступной цене в интернет-магазине Diada-Arms",
    "Саунд-модератор Т 34 резьба 12*1 пластик+метал для МР-512, ИЖ-60 (МР-60) — купить по доступной цене в интернет-магазине Diada-Arms",
    "Саунд-модератор Т 34 цанговый 16 мм для переломок Hatsan, Diana — купить по доступной цене в интернет-магазине Diada-Arms",
    "Саунд-модератор Т 34 для МР-661 («Дрозд»), резьба 12*1 — купить по доступной цене в интернет-магазине Diada-Arms",
    "Саунд-модератор т 34 на винтовку «Атаман» — купить по доступной цене в интернет-магазине Diada-Arms",
    "Саунд-модератор Т90 модульный комбинированый сталь+дюраль для PCP Hatsan, Weihrauch 100, FX, BSA, Evanix, Kral — купить по доступной цене в интернет-магазине Diada-Arms"
);
$description = array(
    "Саунд-модератор цельный (4 камеры) для Hatsan AT44-10, Kral 5,5 мм, 6,35 мм  по доступной цене. Интернет-магазин Diada-Arms предлагает широкий ассортимент товаров для охоты и активного отдыха.",
   "Баллончик-сейф Ballistol 400 мл  по доступной цене. Интернет-магазин Diada-Arms предлагает широкий ассортимент товаров для охоты и активного отдыха.",
   "Наушники GAMO Basik Ear Muff  по доступной цене. Интернет-магазин Diada-Arms предлагает широкий ассортимент товаров для охоты и активного отдыха.",
   "Комплект накладок на Weaver/Picatinny (12 шт)  по доступной цене. Интернет-магазин Diada-Arms предлагает широкий ассортимент товаров для охоты и активного отдыха.",
   "Упрощенная копия ПБС-1 для АК-74  по доступной цене. Интернет-магазин Diada-Arms предлагает широкий ассортимент товаров для охоты и активного отдыха.",
   "Коврик ShotTime для чистки ружей АК-47  по доступной цене. Интернет-магазин Diada-Arms предлагает широкий ассортимент товаров для охоты и активного отдыха.",
   "Комплект резиновых накладок для цевья на Weaver/Picatinny (2 шт)  по доступной цене. Интернет-магазин Diada-Arms предлагает широкий ассортимент товаров для охоты и активного отдыха.",
   "Ложемент для пристрелки Benchmaster (Cadillac)  по доступной цене. Интернет-магазин Diada-Arms предлагает широкий ассортимент товаров для охоты и активного отдыха.",
   "Запасной магазин для GAMO P25 и PT85 Blowback  по доступной цене. Интернет-магазин Diada-Arms предлагает широкий ассортимент товаров для охоты и активного отдыха.",
   "Мини устройство запуска сигнала охотника (для перцовых баллонов)  по доступной цене. Интернет-магазин Diada-Arms предлагает широкий ассортимент товаров для охоты и активного отдыха.",
   "Мишень армированная JVD Fita 30 см, модель 6  по доступной цене. Интернет-магазин Diada-Arms предлагает широкий ассортимент товаров для охоты и активного отдыха.",
   "Мишень калабушка Target Shot T-K/25 для винтовок 25 Дж (усиленная)  по доступной цене. Интернет-магазин Diada-Arms предлагает широкий ассортимент товаров для охоты и активного отдыха.",
   "Имитатор глушителя STALKER для модели SPM 4,5 мм  по доступной цене. Интернет-магазин Diada-Arms предлагает широкий ассортимент товаров для охоты и активного отдыха.",
   "Саунд-модератор Т 34 для винтовок МР-512/60/61  по доступной цене. Интернет-магазин Diada-Arms предлагает широкий ассортимент товаров для охоты и активного отдыха.",
   "Саунд-модератор Т 32 для PCP Kral, Hatsan, Weihfauch 100, FX, BSA, Evanix  по доступной цене. Интернет-магазин Diada-Arms предлагает широкий ассортимент товаров для охоты и активного отдыха.",
   "Саунд-модератор Т 34 резьба 12*1 пластик+метал для МР-512, ИЖ-60 (МР-60)  по доступной цене. Интернет-магазин Diada-Arms предлагает широкий ассортимент товаров для охоты и активного отдыха.",
   "Саунд-модератор Т 34 цанговый 16 мм для переломок Hatsan, Diana  по доступной цене. Интернет-магазин Diada-Arms предлагает широкий ассортимент товаров для охоты и активного отдыха.",
   "Саунд-модератор Т 34 для МР-661 («Дрозд»), резьба 12*1  по доступной цене. Интернет-магазин Diada-Arms предлагает широкий ассортимент товаров для охоты и активного отдыха.",
   "Саунд-модератор т 34 на винтовку «Атаман»  по доступной цене. Интернет-магазин Diada-Arms предлагает широкий ассортимент товаров для охоты и активного отдыха.",
   "Саунд-модератор Т90 модульный комбинированый сталь+дюраль для PCP Hatsan, Weihrauch 100, FX, BSA, Evanix, Kral  по доступной цене. Интернет-магазин Diada-Arms предлагает широкий ассортимент товаров для охоты и активного отдыха."
);
$name = array(
    'Саунд-модератор цельный (4 камеры) для Hatsan AT44-10, Kral 5,5 мм, 6,35 мм',
    'Баллончик-сейф Ballistol 400 мл',
    'Наушники GAMO Basik Ear Muff',
    'Комплект накладок на Weaver/Picatinny (12 шт)',
    'Упрощенная копия ПБС-1 для АК-74',
    'Коврик ShotTime для чистки ружей АК-47',
    'Комплект резиновых накладок для цевья на Weaver/Picatinny (2 шт)',
    'Ложемент для пристрелки Benchmaster (Cadillac)',
    'Запасной магазин для GAMO P25 и PT85 Blowback',
    'Мини устройство запуска сигнала охотника (для перцовых баллонов)',
    'Мишень армированная JVD Fita 30 см, модель 6',
    'Мишень калабушка Target Shot T-K/25 для винтовок 25 Дж (усиленная)',
    'Имитатор глушителя STALKER для модели SPM 4,5 мм',
    'Саунд-модератор Т 34 для винтовок МР-512/60/61',
    'Саунд-модератор Т 32 для PCP Kral, Hatsan, Weihfauch 100, FX, BSA, Evanix',
    'Саунд-модератор Т 34 резьба 12*1 пластик+метал для МР-512, ИЖ-60 (МР-60)',
    'Саунд-модератор Т 34 цанговый 16 мм для переломок Hatsan, Diana',
    'Саунд-модератор Т 34 для МР-661 («Дрозд»), резьба 12*1',
    'Саунд-модератор т 34 на винтовку «Атаман»',
    'Саунд-модератор Т90 модульный комбинированый сталь+дюраль для PCP Hatsan, Weihrauch 100, FX, BSA, Evanix, Kral'
);

for ($i=0; $i < count($ID); $i++) { 
	if(is_int($ID[$i])){
		echo updateMeta ($ID[$i], $name[$i], $title[$i], $description[$i])."<br>";
	}else{
		$none[] = $ID[$i];
	}
	
}

function updateMeta ($id, $name, $title, $description){

	$el = new CIBlockElement;
	$arFields = array(
		// "NAME" => $name = preg_replace('/\s+/', ' ', $name),
		"NAME" => $name,
		"IPROPERTY_TEMPLATES" => array(
			"ELEMENT_META_TITLE" => $title,
			"ELEMENT_META_DESCRIPTION" => $description
		)
	);

	return $res = $el->Update($id, $arFields);
}
?>