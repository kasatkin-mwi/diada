<?
        if ($_SERVER['DOCUMENT_ROOT'] == "") {
               //$_SERVER['DOCUMENT_ROOT'] = '/var/www/sites/diada-arms.ru/public_html';
               $_SERVER['DOCUMENT_ROOT'] = dirname(__FILE__).'/..';
        }

	require_once($_SERVER['DOCUMENT_ROOT'] . "/bitrix/modules/main/include/prolog_before.php");
	$IBLOCK_ID = 1;
	$PRICE_TYPE_ID = 1;
	$url = "https://www.air-gun.ru/yml_diada.xml";
	
	$ch = curl_init($url);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	$string = curl_exec($ch);
	curl_close($ch);

	$xml = new SimpleXMLElement($string);
	
	foreach ($xml->shop->offers->offer as $offer){
		$res = json_encode($offer);
		$array = json_decode($res, TRUE);
		$array['id'] = $array['@attributes']['id'];
		unset($array['@attributes']);
		$arResult[] = $array;
	}
	
	if(Cmodule::IncludeModule('catalog') && Cmodule::IncludeModule('iblock')){
		$arSelect = Array("ID", "NAME", "DETAIL_PAGE_URL");
		$arProducts = Array();
		$arFilter = Array("IBLOCK_ID"=> $IBLOCK_ID, "ACTIVE_DATE"=>"Y");
		$res = CIBlockElement::GetList(Array(), $arFilter, false, false, $arSelect);
		while($ob = $res->GetNextElement())
		{
			$arElement = $ob->GetFields();
//			CIBlockElement::SetPropertyValuesEx($arElement['ID'], $IBLOCK_ID, ["INDIKATOR" => 29]);
//			$arProps = array('QUANTITY' => 0);
//			CCatalogProduct::Update($arElement['ID'], $arProps);
			$arProducts[$arElement['ID']] = $arElement;
		}
		
	
		foreach ($arResult as $element){
			$arFields = array('QUANTITY' => $element['count']);
			CCatalogProduct::Update($element['id'], $arFields);
			
			unset( $arProducts[$element['id']] );
			
			$arFieldsPrice = Array(
				"PRODUCT_ID" => $element['id'],
				"CATALOG_GROUP_ID" => $PRICE_TYPE_ID,
				"PRICE" => (int)$element['price'],
				"CURRENCY" => "RUB",
				"QUANTITY_FROM" => false,
				"QUANTITY_TO" => false
			);
			
			$res = CPrice::GetList(
				array(),
				array(
				 "PRODUCT_ID" => $element['id'],
				 "CATALOG_GROUP_ID" => $PRICE_TYPE_ID,
				)
			);
			
			if ($arr = $res->Fetch())
				CPrice::Update($arr["ID"], $arFieldsPrice);
			if ($element['count'] > 0){
				CIBlockElement::SetPropertyValuesEx($element['id'], $IBLOCK_ID, ["INDIKATOR" => 27]);
			} else {
				CIBlockElement::SetPropertyValuesEx($element['id'], $IBLOCK_ID, ["INDIKATOR" => 29]);
			}
			if ($element['oldprice'] > 0){
				CIBlockElement::SetPropertyValuesEx($element['id'], $IBLOCK_ID, ["oldprice" => $element['oldprice']]);
			} else {
				CIBlockElement::SetPropertyValuesEx($element['id'], $IBLOCK_ID, ["oldprice" => $element['oldprice']]);
			}
		}
		$i = 1;
		$str = '<html>
		 <head>
		  <meta charset="utf-8">
		 </head>';
		$str .= '<table>';
		foreach ($arProducts as $arProduct){
			$str .= '<tr>';
			$str .= '<td>№' . $i . ' </td>';
			$str .= '<td>' . $arProduct['ID'] . '</td>';
			$str .= '<td><a target="_blank" href="' . $arProduct['DETAIL_PAGE_URL'] . '">' . $arProduct['NAME'] . '</td>';
			$str .= '</tr>';
			$i++;
		}
		$str .= '</table></html>';
		$file = $_SERVER["DOCUMENT_ROOT"]."/airgun.htm"; 
		file_put_contents($file, $str);
	}
?>
