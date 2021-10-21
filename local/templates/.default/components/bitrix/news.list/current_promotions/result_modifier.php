<?php 

foreach ($arResult["ITEMS"] as $key => $arItem) {
	if ( is_array($arItem["PREVIEW_PICTURE"]) ) {
		$image_min = CFile::ResizeImageGet(
			$arItem["PREVIEW_PICTURE"],
			array("width" => 281, "height" => 187),
			BX_RESIZE_IMAGE_EXACT,
			true,
			false,
			false,
			80
		);
		$arResult["ITEMS"][$key]['IMAGE_MIN'] = $image_min;

		$image_modal = CFile::ResizeImageGet(
			$arItem["PREVIEW_PICTURE"],
			array("width" => 634, "height" => 419),
			BX_RESIZE_IMAGE_EXACT,
			true,
			false,
			false,
			85
		);
		$arResult["ITEMS"][$key]['IMAGE_MODAL'] = $image_modal;
	}
}


?>