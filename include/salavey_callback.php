<?/*
CModule::IncludeModule('iblock');
$ib_els_db = CIBlockElement::GetList(array('ID'=>'ASC'), array('IBLOCK_ID'=>25, 'ACTIVE'=>'Y'));
$show 		= 415;
$not_show 	= 416;
$black_list = array();
$white_list = array();
$current_addr = $_SERVER["REQUEST_URI"];
while ($ib_els = $ib_els_db->GetNextElement())
{
	$els = $ib_els->GetProperties();
	if ($els['SHOW']["VALUE_ENUM_ID"] == $show){
		$white_list[] = $els['ADDRESS']['VALUE'];
	}
	if ($els['SHOW']["VALUE_ENUM_ID"] == $not_show){
		$black_list[] = $els['ADDRESS']['VALUE'];
	}
}
$stop = false;
foreach ($black_list as $addr){
	if ($addr == $current_addr){
		$stop = true;
	}
}
foreach ($white_list as $addr){
	if ($addr == $current_addr){
		$stop = false;
	}
}
if ($stop==false){

	$APPLICATION->IncludeComponent('salavey:our.callback', '', array());
}*/
?>