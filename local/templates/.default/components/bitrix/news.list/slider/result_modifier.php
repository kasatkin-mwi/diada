<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

foreach($arResult["ITEMS"] as $key => $item)
{
    $obProps = CIBlockElement::GetProperty(
        $item['IBLOCK_ID'], 
        $item['ID'], 
        array("sort" => "asc"), 
        array('ID' => array(5791))
    );
    if($arProp = $obProps->Fetch())
    {
        $arResult["ITEMS"][$key]['PROPERTIES'][$arProp['CODE']] = $arProp;   
    }
}
unset($item);
?>