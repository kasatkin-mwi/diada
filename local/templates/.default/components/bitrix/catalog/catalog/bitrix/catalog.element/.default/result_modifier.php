<?php                                     
$arElement = CIblockElement::GetById($arResult["ID"])->GetNext();
$arResult['DETAIL_PAGE_URL'] = $arElement['DETAIL_PAGE_URL'];
$cp = $this->__component; 
if (is_object($cp))
$cp->SetResultCacheKeys(array('DETAIL_PAGE_URL'));