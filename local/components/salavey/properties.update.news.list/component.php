<?
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();
/** @var CBitrixComponent $this */
/** @var array $arParams */
/** @var array $arResult */
/** @var string $componentPath */
/** @var string $componentName */
/** @var string $componentTemplate */
/** @global CDatabase $DB */
/** @global CUser $USER */
/** @global CMain $APPLICATION */


$IBLOCK_ID = $arParams["IBLOCK_ID"];
$request = \Bitrix\Main\Application::getInstance()->getContext()->getRequest();


use	Bitrix\Main\Loader,
	Bitrix\Iblock;
	
/* 
if(!isset($arParams["CACHE_TIME"]))
	$arParams["CACHE_TIME"] = 36000000;
 */
$arParams["IBLOCK_TYPE"] = trim($arParams["IBLOCK_TYPE"]);
if(strlen($arParams["IBLOCK_TYPE"])<=0)
	$arParams["IBLOCK_TYPE"] = "news";
$arParams["IBLOCK_ID"] = trim($arParams["IBLOCK_ID"]);
$arParams["PARENT_SECTION"] = intval($arParams["PARENT_SECTION"]);
$arParams["INCLUDE_SUBSECTIONS"] = $arParams["INCLUDE_SUBSECTIONS"]!="N";
//$arParams["SET_LAST_MODIFIED"] = $arParams["SET_LAST_MODIFIED"]==="Y";

$arParams["SORT_BY1"] = trim($arParams["SORT_BY1"]);
if(strlen($arParams["SORT_BY1"])<=0)
	$arParams["SORT_BY1"] = "ACTIVE_FROM";
if(!preg_match('/^(asc|desc|nulls)(,asc|,desc|,nulls){0,1}$/i', $arParams["SORT_ORDER1"]))
	$arParams["SORT_ORDER1"]="DESC";

if(strlen($arParams["SORT_BY2"])<=0)
{
	if (strtoupper($arParams["SORT_BY1"]) == 'SORT')
	{
		$arParams["SORT_BY2"] = "ID";
		$arParams["SORT_ORDER2"] = "DESC";
	}
	else
	{
		$arParams["SORT_BY2"] = "SORT";
	}
}
if(!preg_match('/^(asc|desc|nulls)(,asc|,desc|,nulls){0,1}$/i', $arParams["SORT_ORDER2"]))
	$arParams["SORT_ORDER2"]="ASC";

if(strlen($arParams["FILTER_NAME"])<=0 || !preg_match("/^[A-Za-z_][A-Za-z01-9_]*$/", $arParams["FILTER_NAME"]))
{
	$arrFilter = array();
}
else
{
	$arrFilter = $GLOBALS[$arParams["FILTER_NAME"]];
	if(!is_array($arrFilter))
		$arrFilter = array();
}


$arParams["NEWS_COUNT"] = intval($arParams["NEWS_COUNT"]);
if($arParams["NEWS_COUNT"]<=0)
	$arParams["NEWS_COUNT"] = 20;
$arParams["DISPLAY_TOP_PAGER"] = $arParams["DISPLAY_TOP_PAGER"]=="Y";
$arParams["DISPLAY_BOTTOM_PAGER"] = $arParams["DISPLAY_BOTTOM_PAGER"]!="N";
$arParams["PAGER_TITLE"] = trim($arParams["PAGER_TITLE"]);
$arParams["PAGER_SHOW_ALWAYS"] = $arParams["PAGER_SHOW_ALWAYS"]=="Y";
$arParams["PAGER_TEMPLATE"] = trim($arParams["PAGER_TEMPLATE"]);
$arParams["PAGER_DESC_NUMBERING"] = $arParams["PAGER_DESC_NUMBERING"]=="Y";
$arParams["PAGER_DESC_NUMBERING_CACHE_TIME"] = intval($arParams["PAGER_DESC_NUMBERING_CACHE_TIME"]);
$arParams["PAGER_SHOW_ALL"] = $arParams["PAGER_SHOW_ALL"]=="Y";
//$arParams["CHECK_PERMISSIONS"] = $arParams["CHECK_PERMISSIONS"]!="N";

if($arParams["DISPLAY_TOP_PAGER"] || $arParams["DISPLAY_BOTTOM_PAGER"])
{
	$arNavParams = array(
		"nPageSize" => $arParams["NEWS_COUNT"],
		"bDescPageNumbering" => $arParams["PAGER_DESC_NUMBERING"],
		"bShowAll" => $arParams["PAGER_SHOW_ALL"],
	);
	$arNavigation = CDBResult::GetNavParams($arNavParams);
	if($arNavigation["PAGEN"]==0 && $arParams["PAGER_DESC_NUMBERING_CACHE_TIME"]>0)
		$arParams["CACHE_TIME"] = $arParams["PAGER_DESC_NUMBERING_CACHE_TIME"];
}
else
{
	$arNavParams = array(
		"nTopCount" => $arParams["NEWS_COUNT"],
		"bDescPageNumbering" => $arParams["PAGER_DESC_NUMBERING"],
	);
	$arNavigation = false;
}

if (empty($arParams["PAGER_PARAMS_NAME"]) || !preg_match("/^[A-Za-z_][A-Za-z01-9_]*$/", $arParams["PAGER_PARAMS_NAME"]))
{
	$pagerParameters = array();
}
else
{
	$pagerParameters = $GLOBALS[$arParams["PAGER_PARAMS_NAME"]];
	if (!is_array($pagerParameters))
		$pagerParameters = array();
}

	
if(!Loader::includeModule("iblock"))
{
	$this->abortResultCache();
	ShowError(GetMessage("IBLOCK_MODULE_NOT_INSTALLED"));
	return;
}

if(is_numeric($arParams["IBLOCK_ID"]))
{
	$rsIBlock = CIBlock::GetList(array(), array(
		"ACTIVE" => "Y",
		"ID" => $arParams["IBLOCK_ID"],
	));
}
else
{
	$rsIBlock = CIBlock::GetList(array(), array(
		"ACTIVE" => "Y",
		"CODE" => $arParams["IBLOCK_ID"],
		"SITE_ID" => SITE_ID,
	));
}

$arResult = $rsIBlock->GetNext();
if (!$arResult)
{
	$this->abortResultCache();
	Iblock\Component\Tools::process404(
		trim($arParams["MESSAGE_404"]) ?: GetMessage("T_NEWS_NEWS_NA")
		,true
		,$arParams["SET_STATUS_404"] === "Y"
		,$arParams["SHOW_404"] === "Y"
		,$arParams["FILE_404"]
	);
	return;
}

$arSelect = ["ID","NAME"];
$arFilter = array (
	"IBLOCK_ID" => $arResult["ID"],
	"IBLOCK_LID" => SITE_ID,
	"ACTIVE" => "Y",
);
$PARENT_SECTION = CIBlockFindTools::GetSectionID(
	$arParams["PARENT_SECTION"],
	$arParams["PARENT_SECTION_CODE"],
	array(
		"GLOBAL_ACTIVE" => "Y",
		"IBLOCK_ID" => $arResult["ID"],
	)
);
$arParams["PARENT_SECTION"] = $PARENT_SECTION;

if($arParams["PARENT_SECTION"]>0)
{
	$arFilter["SECTION_ID"] = $arParams["PARENT_SECTION"];
	if($arParams["INCLUDE_SUBSECTIONS"])
		$arFilter["INCLUDE_SUBSECTIONS"] = "Y";

	$arResult["SECTION"]= array("PATH" => array());
	$rsPath = CIBlockSection::GetNavChain($arResult["ID"], $arParams["PARENT_SECTION"]);
}
else
{
	$arResult["SECTION"]= false;
}
//ORDER BY
$arSort = array(
	$arParams["SORT_BY1"]=>$arParams["SORT_ORDER1"],
	$arParams["SORT_BY2"]=>$arParams["SORT_ORDER2"],
);
if(!array_key_exists("ID", $arSort))
	$arSort["ID"] = "DESC";

$arResult["ITEMS"] = array();
$arResult["ELEMENTS"] = array();
$arResult["CATALOG_PROPS"] = array();

$rsCatalogProps = \Bitrix\Catalog\ProductTable::getMap();
foreach($rsCatalogProps as $code => $obProp)
{
	//if($code == "ID") continue;
	if(in_array($code,$arParams["CATALOG_PROPS"]))
	{
		$arResult["CATALOG_PROPS"][$code] = $obProp->GetTitle();
	}
}

//echo "<pre>"; print_r($rsCatalogProps); echo "</pre>";

$rsElement = CIBlockElement::GetList($arSort, array_merge($arFilter , $arrFilter), false, $arNavParams, $arSelect);
while($obElement = $rsElement->GetNextElement())
{
	$arItem = $obElement->GetFields();

	$arButtons = CIBlock::GetPanelButtons(
		$arItem["IBLOCK_ID"],
		$arItem["ID"],
		0,
		array("SECTION_BUTTONS"=>false, "SESSID"=>false)
	);
	$arItem["EDIT_LINK"] = $arButtons["edit"]["edit_element"]["ACTION_URL"];
	$arItem["DELETE_LINK"] = $arButtons["edit"]["delete_element"]["ACTION_URL"];
	$arResult["ITEMS"][$arItem["ID"]] = $arItem;
	$arResult["ELEMENTS"][] = $arItem["ID"];
}

unset($arItem);

$navComponentParameters = array();
if ($arParams["PAGER_BASE_LINK_ENABLE"] === "Y")
{
	$pagerBaseLink = trim($arParams["PAGER_BASE_LINK"]);
	if ($pagerBaseLink === "")
	{
		if (
			$arResult["SECTION"]
			&& $arResult["SECTION"]["PATH"]
			&& $arResult["SECTION"]["PATH"][0]
			&& $arResult["SECTION"]["PATH"][0]["~SECTION_PAGE_URL"]
		)
		{
			$pagerBaseLink = $arResult["SECTION"]["PATH"][0]["~SECTION_PAGE_URL"];
		}
		elseif (
			isset($arItem) && isset($arItem["~LIST_PAGE_URL"])
		)
		{
			$pagerBaseLink = $arItem["~LIST_PAGE_URL"];
		}
	}

	if ($pagerParameters && isset($pagerParameters["BASE_LINK"]))
	{
		$pagerBaseLink = $pagerParameters["BASE_LINK"];
		unset($pagerParameters["BASE_LINK"]);
	}

	$navComponentParameters["BASE_LINK"] = CHTTP::urlAddParams($pagerBaseLink, $pagerParameters, array("encode"=>true));
}

$arResult["NAV_STRING"] = $rsElement->GetPageNavStringEx(
	$navComponentObject,
	$arParams["PAGER_TITLE"],
	$arParams["PAGER_TEMPLATE"],
	$arParams["PAGER_SHOW_ALWAYS"],
	$this,
	$navComponentParameters
);
$arResult["NAV_CACHED_DATA"] = null;
$arResult["NAV_RESULT"] = $rsElement;
$arResult["NAV_PARAM"] = $navComponentParameters;


$arProperty = CIBlockProperty::GetList(Array("sort"=>"asc", "name"=>"asc"), Array("ACTIVE"=>"Y", "IBLOCK_ID"=>$IBLOCK_ID));
while ($prop_fields = $arProperty->GetNext())
{
	
	if (!in_array($prop_fields["PROPERTY_TYPE"],["L","S","N"]) || $prop_fields["USER_TYPE"]) continue; //skip not supported property types
	
	//check if property has default value
	$isDefault = false;
	if($prop_fields["DEFAULT_VALUE"])
		$isDefault = true;
	
	// get list of property enum values
	if ($prop_fields["PROPERTY_TYPE"] == "L")
	{
		$rsPropertyEnum = CIBlockProperty::GetPropertyEnum($prop_fields["ID"]);
		$prop_fields["ENUM"] = array();
		while ($arPropertyEnum = $rsPropertyEnum->GetNext())
		{
			if($arPropertyEnum["DEF"] == "Y") $isDefault = true;
			$prop_fields["ENUM"][$arPropertyEnum["ID"]] = $arPropertyEnum;
		}
	}
	
	$arResult["PROPERTIES"][$prop_fields["CODE"]]["ID"] = $prop_fields["ID"];
	$arResult["PROPERTIES"][$prop_fields["CODE"]]["CODE"] = $prop_fields["CODE"];
	$arResult["PROPERTIES"][$prop_fields["CODE"]]["NAME"] = $prop_fields["NAME"];
	$arResult["PROPERTIES"][$prop_fields["CODE"]]["DEFAULT_VALUE"] = $prop_fields["DEFAULT_VALUE"];
	$arResult["PROPERTIES"][$prop_fields["CODE"]]["PROPERTY_TYPE"] = $prop_fields["PROPERTY_TYPE"];
	$arResult["PROPERTIES"][$prop_fields["CODE"]]["LIST_TYPE"] = $prop_fields["LIST_TYPE"];
	$arResult["PROPERTIES"][$prop_fields["CODE"]]["MULTIPLE"] = $prop_fields["MULTIPLE"];
	$arResult["PROPERTIES"][$prop_fields["CODE"]]["MULTIPLE_CNT"] = $prop_fields["MULTIPLE_CNT"];
	$arResult["PROPERTIES"][$prop_fields["CODE"]]["ENUM"] = $prop_fields["ENUM"];
	
	$arResult["PROPERTIES"][$prop_fields["CODE"]]["IS_DEFAULT"] = $isDefault;
	
	//$arResult["PROPERTIES"][$prop_fields["CODE"]]["USER_TYPE"] = $prop_fields["USER_TYPE"];
	//$arResult["PROPERTIES"][$prop_fields["CODE"]]["LINK_IBLOCK_ID"] = $prop_fields["LINK_IBLOCK_ID"];
	//$arResult["PROPERTIES"][$prop_fields["CODE"]]["SORT"] = $prop_fields["SORT"];
}
if($_POST["ELEMENTS"])
{
	$arResult["SELECTED_ELEMENTS"] = $request->getPost('ELEMENTS');
}

if($isCatalog = CCatalog::GetByID($IBLOCK_ID))
{
	
	$arResult["IS_CATALOG"] = "Y";

	$arResult["IS_CATALOG_PROP"] = 0;
	
	if(isset($_POST["IS_CATALOG_PROP"]))
	{
		$arResult["IS_CATALOG_PROP"] = $request->getPost('IS_CATALOG_PROP');
		$_SESSION["IS_CATALOG_PROP"] = $request->getPost('IS_CATALOG_PROP');
		//unset($arResult["SELECTED_PROP"]);
	} elseif(isset($_SESSION["IS_CATALOG_PROP"]))
	{
		$arResult["IS_CATALOG_PROP"] = $_SESSION["IS_CATALOG_PROP"];
	}

}

if($_POST["PROPERTY_CODE"])
{
	$PROPERTY_CODE = $request->getPost('PROPERTY_CODE');
	$arResult["SELECTED_PROP"] = $arResult["PROPERTIES"][$PROPERTY_CODE];
	
	// process POST data
	if(isset($_POST["UPDATE_PROPS"]) && $_POST["PROPERTY"])
	{
		
		if($arResult["SELECTED_ELEMENTS"])
		{

			$arProperty = $request->getPost('PROPERTY');
			
			$arProperty["MODIFIED_BY"] = $USER->GetID();
			
				$oElement = new CIBlockElement();
				
				foreach($arResult["SELECTED_ELEMENTS"] as $ELEMENT_ID)
				{
				
					if($arProperty)
					{
						 
						$res = $oElement->SetPropertyValuesEx($ELEMENT_ID, $IBLOCK_ID, $arProperty);
						$arResult["SUCCESS"] = "Y";
						
					}
			
				}
		} else
			$arResult["ERRORS"][] = "Вы не выбрали ни одного элемента";
			
			unset($arResult["SELECTED_ELEMENTS"]);
			unset($arResult["SELECTED_PROP"]);
			
			//Метод не очищает кеш. Для очистки кеша следует вызвать:
			//CIBlock::clearIblockTagCache($IBLOCK_ID);
			
			//При файсетном индексе необходимо вызвать после вызова CIBlockElement::SetPropertyValuesEx
			//\Bitrix\Iblock\PropertyIndex\Manager::updateElementIndex(инфоблок, элемент);
			
		//}
		
	}
} elseif($_POST["CATALOG_PROPERTY_CODE"]/*  && $arResult["IS_CATALOG"] */)
{
	$PROPERTY_CODE = $request->getPost('CATALOG_PROPERTY_CODE');
	$code = $rsCatalogProps[$PROPERTY_CODE]->getName();
	
	$arResult["SELECTED_CATALOG_PROP"]["TITLE"] = $rsCatalogProps[$PROPERTY_CODE]->getTitle();
	$arResult["SELECTED_CATALOG_PROP"]["CODE"] = $code;
	
	if ($rsCatalogProps[$PROPERTY_CODE] instanceof Bitrix\Main\ORM\Fields\EnumField)
	{
		$arResult["SELECTED_CATALOG_PROP"]["PROPERTY_TYPE"] = "L";
		$arResult["SELECTED_CATALOG_PROP"]["VALUES"] = $rsCatalogProps[$PROPERTY_CODE]->getValues();
	} elseif($rsCatalogProps[$PROPERTY_CODE] instanceof Bitrix\Main\ORM\Fields\IntegerField ||
		$rsCatalogProps[$PROPERTY_CODE] instanceof Bitrix\Main\ORM\Fields\FloatField ||
		$rsCatalogProps[$PROPERTY_CODE] instanceof Bitrix\Main\ORM\Fields\Relations\Reference
		)
	{
		$arResult["SELECTED_CATALOG_PROP"]["PROPERTY_TYPE"] = "N";
	} elseif($rsCatalogProps[$PROPERTY_CODE] instanceof Bitrix\Main\ORM\Fields\ExpressionField ||
		$rsCatalogProps[$PROPERTY_CODE] instanceof Bitrix\Main\ORM\Fields\StringField
		)
	{
		$arResult["SELECTED_CATALOG_PROP"]["PROPERTY_TYPE"] = "S";
	} elseif($rsCatalogProps[$PROPERTY_CODE] instanceof Bitrix\Main\ORM\Fields\DatetimeField)
	{
		$arResult["SELECTED_CATALOG_PROP"]["PROPERTY_TYPE"] = "D";
	} elseif($rsCatalogProps[$PROPERTY_CODE] instanceof Bitrix\Main\ORM\Fields\BooleanField)
	{
		$arResult["SELECTED_CATALOG_PROP"]["PROPERTY_TYPE"] = "R";
		$arResult["SELECTED_CATALOG_PROP"]["VALUES"] = $rsCatalogProps[$PROPERTY_CODE]->getValues();
	}
	
	if(isset($_POST["UPDATE_PROPS"]) && $_POST["CATALOG_PROPERTY"])
	{
		
		if($arResult["SELECTED_ELEMENTS"])
		{
			$arProperty = $request->getPost('CATALOG_PROPERTY');
			
			
			foreach($arResult["SELECTED_ELEMENTS"] as $ELEMENT_ID)
			{
				$existProduct = \Bitrix\Catalog\Model\Product::getCacheItem(intval($ELEMENT_ID),true);
				
				if(!empty($existProduct)){
					$result = \Bitrix\Catalog\Model\Product::update(intval($ELEMENT_ID),$arProperty);
					
					if($result && !$result->isSuccess())
					{
						$arResult["ERRORS"][$ELEMENT_ID] = $result->getErrorMessages();
					}
					
				}
				
				/* 
				else {
				 \Bitrix\Catalog\Model\Product::add($arProperty);
				}
				 */
			}
		}
		
	}
	
}
$this->includeComponentTemplate();
//echo "<pre>"; print_r($arParams); echo "</pre>";