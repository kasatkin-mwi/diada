<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");

$request = \Bitrix\Main\Context::getCurrent()->getRequest();
if ($request->isAjaxRequest() && ($request->get('action') === 'getIndex') && !empty($request->get('code')))
{
    \Bitrix\Main\Loader::includeModule("sale");
    
    $result = array(
        'code' => ''
    );
    $code = $request->get('code');
    $res = Bitrix\Sale\Location\Admin\LocationHelper::getZipByLocation($code);

    if ($arZip = $res->fetch())
    {
        if (!empty($arZip['XML_ID']))
        {
            $result['code'] = $arZip['XML_ID'];
        }
    }
    
    echo json_encode($result);
}