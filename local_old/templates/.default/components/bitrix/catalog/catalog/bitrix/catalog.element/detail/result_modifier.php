<? if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();

/**
 * @var CBitrixComponentTemplate $this
 * @var CatalogElementComponent $component
 */

$component = $this->getComponent();
$arParams = $component->applyTemplateModifications();

$cp = $this->__component;

if(is_object($cp)){
	$cp->arResult['DETAIL_PICTURE'] = $arResult['DETAIL_PICTURE'];
	$cp->SetResultCacheKeys(array('DETAIL_PICTURE'));
	$arResult['DETAIL_PICTURE'] = $cp->arResult['DETAIL_PICTURE'];
}