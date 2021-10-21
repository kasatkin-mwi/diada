<?
use Bitrix\Main,
    Bitrix\Main\Context,
    Bitrix\Main\Loader,
    Bitrix\Main\Type\DateTime,
    Bitrix\Currency,
    Bitrix\Catalog,
    Bitrix\Iblock;

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

/** @global CCacheManager $CACHE_MANAGER */
global $CACHE_MANAGER;
/** @global CIntranetToolbar $INTRANET_TOOLBAR */
global $INTRANET_TOOLBAR;

CPageOption::SetOptionString("main", "nav_page_in_session", "N");

/*************************************************************************
    Processing of received parameters
*************************************************************************/
if(!isset($arParams["CACHE_TIME"]))
    $arParams["CACHE_TIME"] = 36000000;

if(empty($arParams["FILTER_NAME"]) || !preg_match("/^[A-Za-z_][A-Za-z01-9_]*$/", $arParams["FILTER_NAME"]))
{
    $arrFilter = array();
}
else
{
    global ${$arParams["FILTER_NAME"]};
    $arrFilter = ${$arParams["FILTER_NAME"]};
    if(!is_array($arrFilter))
        $arrFilter = array();
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

$arParams["PAGE_ELEMENT_COUNT"] = intval($arParams["PAGE_ELEMENT_COUNT"]);
if($arParams["PAGE_ELEMENT_COUNT"]<=0)
    $arParams["PAGE_ELEMENT_COUNT"]=20;

$arParams["DISPLAY_TOP_PAGER"] = $arParams["DISPLAY_TOP_PAGER"]=="Y";
$arParams["DISPLAY_BOTTOM_PAGER"] = $arParams["DISPLAY_BOTTOM_PAGER"]!="N";
$arParams["PAGER_TITLE"] = trim($arParams["PAGER_TITLE"]);
$arParams["PAGER_SHOW_ALWAYS"] = $arParams["PAGER_SHOW_ALWAYS"]=="Y";
$arParams["PAGER_TEMPLATE"] = trim($arParams["PAGER_TEMPLATE"]);
$arParams["PAGER_DESC_NUMBERING"] = $arParams["PAGER_DESC_NUMBERING"]=="Y";
$arParams["PAGER_DESC_NUMBERING_CACHE_TIME"] = intval($arParams["PAGER_DESC_NUMBERING_CACHE_TIME"]);
$arParams["PAGER_SHOW_ALL"] = $arParams["PAGER_SHOW_ALL"]=="Y";

if ($arParams['DISPLAY_TOP_PAGER'] || $arParams['DISPLAY_BOTTOM_PAGER'])
{
    $arNavParams = array(
        "nPageSize" => $arParams["PAGE_ELEMENT_COUNT"],
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
        "nTopCount" => $arParams["PAGE_ELEMENT_COUNT"],
        "bDescPageNumbering" => $arParams["PAGER_DESC_NUMBERING"],
    );
    $arNavigation = false;
}

$arParams['CACHE_GROUPS'] = trim($arParams['CACHE_GROUPS']);
if ('N' != $arParams['CACHE_GROUPS'])
    $arParams['CACHE_GROUPS'] = 'Y';

$arParams["CACHE_FILTER"]=$arParams["CACHE_FILTER"]=="Y";
if(!$arParams["CACHE_FILTER"] && count($arrFilter)>0)
    $arParams["CACHE_TIME"] = 0;

/*************************************************************************
            Work with cache
*************************************************************************/
if($this->startResultCache(false, array($arrFilter, ($arParams["CACHE_GROUPS"]==="N"? false: $USER->GetGroups()), $arNavigation, $pagerParameters)))
{
    Loader::includeModule("sale");

    $ordersList = array();
    
    $arFilter = array(
        'STATUS_ID' => 'N',
        '>DATE_INSERT' => date($DB->DateFormatToPHP(CLang::GetDateFormat("SHORT")), mktime(0,0,0,'1.03.2020')),
    );
    
    $rsSales = CSaleOrder::GetList(
        array("DATE_INSERT" => "DESC"),
        array_merge($arrFilter, $arFilter),
        false,
        $arNavParams,
        array(
            'ID',
            'DATE_INSERT'
        )
    );
    $arResult["ORDERS"] = array();
    while($arOrder = $rsSales->Fetch())
    {
        $order = Bitrix\Sale\Order::load($arOrder['ID']);
        $productsData = array();
        foreach ($order->getBasket()->getBasketItems() as $basketItem)
        {
            $productsData[] = array(
                "NAME" => $basketItem->getField('NAME'),
                "PRODUCT_ID" => $basketItem->getProductId(),
                "QUANTITY" => $basketItem->getQuantity()
            );
        }
        unset($basketItem);
        
        if(!empty($productsData))
        {
            $arStoreData = array();
            foreach($productsData as $key => $data)
            {
                $rsStore = CCatalogStoreProduct::GetList(
                    array(), 
                    array(
                        'PRODUCT_ID' => $data["PRODUCT_ID"],
                        /*'STORE_ID' => 3,
                        '>AMOUNT' => $data["QUANTITY"],*/
                    ), 
                    false, 
                    false, 
                    array('*')
                );
                while ($arStore = $rsStore->Fetch())
                {                    
                    if($arStore["AMOUNT"] > 0)
                    {
                        $data["STORES"][] = $arStore;
                        $arStoreData[$key] = $data;
                    }
                    elseif($arStore["AMOUNT"] <= 0 && $arStore["STORE_ID"] == 3)
                    {
                        $data["STORES"][] = $arStore;
                        $arStoreData[$key] = $data;
                    }
                }
            }
            
            if(!empty($arStoreData))
            {
                $marker = false; 
                $enough = 0; 
                $notenough = 0; 
                $noitem = 0;
                foreach($arStoreData as $key => $data)
                {
                    foreach($data["STORES"] as $store)
                    {
                        if($store["STORE_ID"] == 3)
                        {
                            $marker = true;
                               
                            if(intval($store["AMOUNT"]) > intval($data["QUANTITY"]))
                            {
                                $enough++;
                            }
                            elseif(intval($store["AMOUNT"]) > 0 && intval($data["QUANTITY"]) > intval($store["AMOUNT"]))
                            {
                                $notenough++;
                            }
                            elseif(intval($store["AMOUNT"]) <= 0)
                            {
                                $noitem++;    
                            }
                        }
                    }
                }
                if($marker)
                {
                    if($enough > 0 && $notenough == 0 && $noitem == 0)
                    {
                        $ordersList[$arOrder['ID']] = $arOrder['ID'];
                    }
                }
            }
        }   
    }
    unset($rsSales,$arOrder);
        
    $arFilter = array(
        'STATUS_ID' => 'N',
    );
    if(!empty($ordersList))
    {
        $arFilter['ID'] = $ordersList;
    }
    else
    {
        $arFilter['ID'] = 0;
    }
    unset($ordersList);
    
    $rsSales = CSaleOrder::GetList(
        array("DATE_INSERT" => "DESC"),
        array_merge($arrFilter, $arFilter),
        false,
        $arNavParams,
        array(
            'ID'
        )
    );
    $arResult["ORDERS"] = array();
    while($arOrder = $rsSales->Fetch())
    {
        $order = Bitrix\Sale\Order::load($arOrder['ID']);
        $productsData = array();
        foreach ($order->getBasket()->getBasketItems() as $basketItem)
        {
            $productsData[] = array(
                "NAME" => $basketItem->getField('NAME'),
                "PRODUCT_ID" => $basketItem->getProductId(),
                "QUANTITY" => $basketItem->getQuantity()
            );
        }
        unset($basketItem);
        
        if(!empty($productsData))
        {
            $arStoreData = array();
            foreach($productsData as $key => $data)
            {
                $rsStore = CCatalogStoreProduct::GetList(
                    array(), 
                    array(
                        'PRODUCT_ID' => $data["PRODUCT_ID"],
                    ), 
                    false, 
                    false, 
                    array('*')
                );
                while ($arStore = $rsStore->Fetch())
                {
                    if($arStore["AMOUNT"] > 0)
                    {
                        $data["STORES"][] = $arStore;
                        $arStoreData[$key] = $data;
                    }
                    elseif($arStore["AMOUNT"] <= 0 && $arStore["STORE_ID"] == 3)
                    {
                        $data["STORES"][] = $arStore;
                        $arStoreData[$key] = $data;
                    }
                }
            }
            
            if(!empty($arStoreData))
            {
                $marker = false; 
                $enough = 0; 
                $notenough = 0; 
                $noitem = 0;
                foreach($arStoreData as $key => $data)
                {
                    foreach($data["STORES"] as $store)
                    {
                        if($store["STORE_ID"] == 3)
                        {
                            $marker = true;
                               
                            if(intval($store["AMOUNT"]) > intval($data["QUANTITY"]))
                            {
                                $enough++;
                            }
                            elseif(intval($store["AMOUNT"]) > 0 && intval($data["QUANTITY"]) > intval($store["AMOUNT"]))
                            {
                                $notenough++;
                            }
                            elseif(intval($store["AMOUNT"]) <= 0)
                            {
                                $noitem++;    
                            }
                            $lack = intval($store["AMOUNT"]) - intval($data["QUANTITY"]);
                            if($lack < 0)
                            {
                                $lack = abs($lack);
                            }
                            else
                            {
                                $lack = 0;
                            }
                        }
                    }
                }
                if($marker)
                {
                    if($enough > 0 && $notenough == 0 && $noitem == 0)
                    {
                        $arOrder['STATUS'] = 'Достаточно полностью';    
                    }
                    elseif($noitem > 0 && $notenough == 0 && $enough == 0)
                    {
                        $arOrder['STATUS'] = 'Отсутствует на складе!';    
                    }
                    elseif(($notenough > 0 || $noitem > 0) && $enough > 0)
                    {
                        $arOrder['STATUS'] = 'Частичная нехватка!';    
                    }
                }
            }
        }
        $arOrder['PRICE'] = $order->getPrice();
        
        $arResult['ORDERS'][] = $arOrder;
    }
    unset($arOrder);

    $navComponentParameters = array();

    $arResult["NAV_STRING"] = $rsSales->GetPageNavStringEx(
        $navComponentObject,
        $arParams["PAGER_TITLE"],
        $arParams["PAGER_TEMPLATE"],
        $arParams["PAGER_SHOW_ALWAYS"],
        $this,
        $navComponentParameters
    );
    $arResult["NAV_CACHED_DATA"] = null;
    $arResult["NAV_RESULT"] = $rsSales;
    $arResult["NAV_PARAM"] = $navComponentParameters;
    if (isset($arOrder))
        unset($arOrder);
        
    $this->setResultCacheKeys(array(
        "NAV_CACHED_DATA",
    ));

    $this->includeComponentTemplate();
}

$this->setTemplateCachedData($arResult["NAV_CACHED_DATA"]);