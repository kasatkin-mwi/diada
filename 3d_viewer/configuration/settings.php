<?header( "content-type: application/xml; charset=utf-8" );?>
<?
require_once($_SERVER['DOCUMENT_ROOT'].'/bitrix/modules/main/include/prolog_before.php');
if(IntVal($_REQUEST["album_id"])):
CModule::IncludeModule('iblock');
$photo_3d_sec = IntVal($_REQUEST["album_id"]);
$arPhoto3D = array();
$rsEl = CIBlockElement::GetList(array('SORT' => 'ASC'), array('IBLOCK_ID' => 10, 'SECTION_ID' => $photo_3d_sec), false, false, array('ID', 'PREVIEW_PICTURE'));
while($arEl = $rsEl->GetNext()){
	if($arEl["PREVIEW_PICTURE"]):
		$photo["BIG"]["SRC"] = CFile::GetPath($arEl["PREVIEW_PICTURE"]);
		$resizePic = CFile::ResizeImageGet($arEl["PREVIEW_PICTURE"], array('width'=>960, 'height'=>490), BX_RESIZE_IMAGE_EXACT, true);
		$photo["SMALL"]["SRC"] =  $resizePic["src"];
		$arPhoto3D[] = $photo;
	endif; 
}

$xml = new DOMDocument( "1.0", "utf-8" );

// Create some elements.
$ProductViewer = $xml->createElement( "ProductViewer" );
$viewWidth = $xml->createElement( "viewWidth", "960" );
$viewHeight = $xml->createElement( "viewHeight", "490" );

$ease = $xml->createElement( "ease", "15" );
$padding_ease = $xml->createElement( "padding_ease", "2.5" );
$inertia = $xml->createElement( "inertia", "1" );
$grab_hand_cursor = $xml->createElement( "grab_hand_cursor", "true" );
$mouse_wheel_function = $xml->createElement( "mouse_wheel_function" , "zoom" );
$mouse_wheel_speed = $xml->createElement( "mouse_wheel_speed", "0.2" );



$maxZoom = $xml->createElement( "maxZoom", "2.5" );
$zoomSpeed = $xml->createElement( "zoomSpeed", "0.2" );
$zoomEase = $xml->createElement( "zoomEase", "10" );
$autoplay = $xml->createElement( "autoplay", "false" );
$autoplaySpeed = $xml->createElement( "autoplaySpeed", "1.3" );
$reverse = $xml->createElement( "reverse", "true" );
$controls = $xml->createElement( "controls" );

$control = $xml->createElement( "control", "right" );
$controls->appendChild( $control );
$control = $xml->createElement( "control", "autoplay" );
$controls->appendChild( $control );
$control = $xml->createElement( "control", "left" );
$controls->appendChild( $control );
$control = $xml->createElement( "control", "zoom-slider" );
$controls->appendChild( $control );
$control = $xml->createElement( "control", "rotate" );
$controls->appendChild( $control );
$control = $xml->createElement( "control", "pan" );
$controls->appendChild( $control );
$panel = $xml->createElement( "panel" );


$width = $xml->createElement( "width", "600" );
$panel->appendChild( $width );
$height = $xml->createElement( "height", "50" );
$panel->appendChild( $height );
$xOffset = $xml->createElement( "xOffset", "0" );
$panel->appendChild( $xOffset );
$yOffset = $xml->createElement( "yOffset", "0" );
$panel->appendChild( $yOffset );
$show = $xml->createElement( "show", "always" );
$panel->appendChild( $show );
$background_color = $xml->createElement( "background_color", "#2D2D2D" );
$panel->appendChild( $background_color );
$background_alpha = $xml->createElement( "background_alpha", "1" );
$panel->appendChild( $background_alpha );
$background_pattern = $xml->createElement( "background_pattern", "/3d_viewer/ui_images/menu_tile.jpg" );
$panel->appendChild( $background_pattern );
$round_corners = $xml->createElement( "round_corners", "0" );
$panel->appendChild( $round_corners );
$buttons_side_margin = $xml->createElement( "buttons_side_margin", "12" );
$panel->appendChild( $buttons_side_margin );
$buttons_tween_time = $xml->createElement( "buttons_tween_time", "500" );
$panel->appendChild( $buttons_tween_time );
$ui_folder = $xml->createElement( "ui_folder", "/3d_viewer/ui_images/" );
$panel->appendChild( $ui_folder );

$buttons_width = $xml->createElement( "buttons_width", "36" );
$panel->appendChild( $buttons_width );
$buttons_height = $xml->createElement( "buttons_height", "36" );
$panel->appendChild( $buttons_height );
$divider_width = $xml->createElement( "divider_width", "2" );
$panel->appendChild( $divider_width );
$divider_height = $xml->createElement( "divider_height", "30" );
$panel->appendChild( $divider_height );
$slider_width = $xml->createElement( "slider_width", "auto" );
$panel->appendChild( $slider_width );
$slider_height = $xml->createElement( "slider_height", "6" );
$panel->appendChild( $slider_height );

$slider_background_color = $xml->createElement( "slider_background_color", "#000000" );
$panel->appendChild( $slider_background_color );
$slider_background_alpha = $xml->createElement( "slider_background_alpha", "0.3" );
$panel->appendChild( $slider_background_alpha  );
$slider_background_pattern = $xml->createElement( "slider_background_pattern", "none" );
$panel->appendChild( $slider_background_pattern );
$slider_round_corners = $xml->createElement( "slider_round_corners", "2" );
$panel->appendChild( $slider_round_corners );
$zoom_subbuttons_width = $xml->createElement( "zoom_subbuttons_width", "14" );
$panel->appendChild( $zoom_subbuttons_width );
$zoom_subbuttons_height = $xml->createElement( "zoom_subbuttons_height", "14" );
$panel->appendChild( $zoom_subbuttons_height );
$zoom_subbuttons_distance = $xml->createElement( "zoom_subbuttons_distance", "12" );
$panel->appendChild( $zoom_subbuttons_distance );
$dragger_width = $xml->createElement( "dragger_width", "36" );
$panel->appendChild( $dragger_width );
$dragger_height = $xml->createElement( "dragger_height", "36" );
$panel->appendChild( $dragger_height );



$loading = $xml->createElement( "loading" );

$background_color = $xml->createElement( "background_color", "#000000" );
$loading->appendChild( $background_color );

$loading_text = $xml->createElement( "loading_text", "Загрузка #span#loaded_images/total_images#spanEnd#" );
$loading->appendChild( $loading_text );	
$background_color = $xml->createElement( "background_color", "#000000" );
$loading->appendChild( $background_color );
$background_alpha = $xml->createElement( "background_alpha", "0.4" );
$loading->appendChild( $background_alpha );
$background_pattern = $xml->createElement( "background_pattern", "none" );	
$loading->appendChild( $background_pattern );
$text_font = $xml->createElement( "text_font", "AllerRegular" );
$loading->appendChild( $text_font );
$text_size = $xml->createElement( "text_size", "12" );
$loading->appendChild( $text_size );
$text_color = $xml->createElement( "text_color", "#BBBBBB" );
$loading->appendChild( $text_color );
$text_span_color = $xml->createElement( "text_span_color", "#FFFFFF" );
$loading->appendChild( $text_span_color );
$text_background_color = $xml->createElement( "text_background_color", "#000000" );
$loading->appendChild( $text_background_color );
$text_background_alpha = $xml->createElement( "text_background_alpha", "0.8" );
$loading->appendChild( $text_background_alpha );
$text_background_pattern = $xml->createElement( "text_background_pattern", "none" );
$loading->appendChild( $text_background_pattern );
$text_background_round_corner = $xml->createElement( "text_background_round_corner", "5" );
$loading->appendChild( $text_background_round_corner );


$include_zoom_window = $xml->createElement( "include_zoom_window", "true" );

$zoom_window = $xml->createElement( "zoom_window" );

$window_width = $xml->createElement( "window_width", "150" );
$zoom_window->appendChild( $window_width );
$window_height = $xml->createElement( "window_height", "auto" );
$zoom_window->appendChild( $window_height );
/*$background_color = $xml->createElement( "background_color", "#000000" );
$zoom_window->appendChild( $background_color );
$background_alpha = $xml->createElement( "background_alpha", "0.4" );
$zoom_window->appendChild( $background_alpha );
$background_pattern = $xml->createElement( "background_pattern", "none" );
$zoom_window->appendChild( $background_pattern );*/
$border = $xml->createElement( "border", "1px solid #000000" );
$zoom_window->appendChild( $border );
$padding = $xml->createElement( "padding", "1" );
$zoom_window->appendChild( $padding );
$selection_line_color = $xml->createElement( "selection_line_color", "#ff0000" );
$zoom_window->appendChild( $selection_line_color );
$selection_line_alpha = $xml->createElement( "selection_line_alpha", "0.4" );
$zoom_window->appendChild( $selection_line_alpha );
$include_tooltips = $xml->createElement( "include_tooltips", "true" );


$tooltips_texts = $xml->createElement( "tooltips_texts" );
$rotate = $xml->createElement( "rotate", "Вращение объекта в поле окна" );
$tooltips_texts->appendChild( $rotate );
$pan = $xml->createElement( "pan", "Перемещение объекта в поле окна" );
$tooltips_texts->appendChild( $pan );	
$play = $xml->createElement( "play", "Непрерывное вращение" );
$tooltips_texts->appendChild( $play );
$pause = $xml->createElement( "pause", "Прекратить вращение" );
$tooltips_texts->appendChild( $pause );	
$rotate_slider = $xml->createElement( "rotate_slider", "Вращение rotate_number" );
$tooltips_texts->appendChild( $rotate_slider );
$rotate_left = $xml->createElement( "rotate_left", "Вращение вправо" );
$tooltips_texts->appendChild( $rotate_left );

$rotate_right = $xml->createElement( "rotate_right", "Вращение влево" );
$tooltips_texts->appendChild( $rotate_right );
$reset = $xml->createElement( "reset", "Reset" );
$tooltips_texts->appendChild( $reset );
$zoom_slider = $xml->createElement( "zoom_slider", "Увеличение zoom_number%" );
$tooltips_texts->appendChild( $zoom_slider );
$zoom_in = $xml->createElement( "zoom_in", "Увеличить объект" );
$tooltips_texts->appendChild( $zoom_in );
$zoom_out = $xml->createElement( "zoom_out", "Уменьшить объект" );
$tooltips_texts->appendChild( $zoom_out );
$hyperlink = $xml->createElement( "hyperlink", "Ссылка" );
$tooltips_texts->appendChild( $hyperlink );



$tooltips = $xml->createElement( "tooltips");

$text_font = $xml->createElement( "text_font", "AllerRegular");
$tooltips->appendChild( $text_font );
$text_size = $xml->createElement( "text_size", "12");
$tooltips->appendChild( $text_size );
$text_color = $xml->createElement( "text_color", "#ffffff");
$tooltips->appendChild( $text_color );
$left_right_padding = $xml->createElement( "left_right_padding", "10");
$tooltips->appendChild( $left_right_padding );
$top_bottom_padding = $xml->createElement( "top_bottom_padding", "5");
$tooltips->appendChild( $top_bottom_padding );
$background_color = $xml->createElement( "background_color", "#000000");
$tooltips->appendChild( $background_color );
$background_alpha = $xml->createElement( "background_alpha", "1");
$tooltips->appendChild( $background_alpha );
$round_corners = $xml->createElement( "round_corners", "5");
$tooltips->appendChild( $round_corners );
$fadeTime = $xml->createElement( "fadeTime", "200");
$tooltips->appendChild( $fadeTime );

$hotspotsImagesPath = $xml->createElement( "hotspotsImagesPath", "/3d_viewer/ui_images/" );

$hotspotsButtons = $xml->createElement( "hotspotsButtons" );

$button = $xml->createElement( "button" );

$id = $xml->createElement( "id", "1" );
$button->appendChild( $id );
$out = $xml->createElement( "out", "hotspot_out.png" );
$button->appendChild( $out );
$over = $xml->createElement( "over", "hotspot_over.png" );
$button->appendChild( $over );
$width = $xml->createElement( "width", "40" );
$button->appendChild( $width );
$height = $xml->createElement( "height", "40" );
$button->appendChild( $height );
$tweenTime = $xml->createElement( "tweenTime", "300" );
$button->appendChild( $tweenTime );
$hotspotsButtons->appendChild( $button );


$button = $xml->createElement( "button" );

$id = $xml->createElement( "id", "close" );
$button->appendChild( $id );
$out = $xml->createElement( "out", "close_button.png" );
$button->appendChild( $out );
$over = $xml->createElement( "over", "close_button.png" );
$button->appendChild( $over );
$width = $xml->createElement( "width", "36" );
$button->appendChild( $width );
$height = $xml->createElement( "height", "36" );
$button->appendChild( $height );
$tweenTime = $xml->createElement( "tweenTime", "300" );
$button->appendChild( $tweenTime );
$hotspotsButtons->appendChild( $button );

/*
$imagesPath = $xml->createElement( "imagesPath", "images/object/small/" );
$imagesBigPath = $xml->createElement( "imagesBigPath", "images/object/big/" );
*/
$images = $xml->createElement("images");

foreach($arPhoto3D as $photo){
    $image = $xml->createElement( "image" );
	$images->appendChild( $image );
	$image->setAttribute( "src", $photo["SMALL"]["SRC"] );
	$image->setAttribute( "srcBig", $photo["BIG"]["SRC"] );
}

/*
for($i=0;$i<=35;$i++){
    $image = $xml->createElement( "image" );
	$images->appendChild( $image );
	if($i > 0){
	    $name = '_' . $i . '.JPG';
	} else {
		$name = '.JPG';
	}
	$image->setAttribute( "src", '01' . $name);
}
*/
$ProductViewer->appendChild( $viewWidth );
$ProductViewer->appendChild( $viewHeight );
$ProductViewer->appendChild( $ease );
$ProductViewer->appendChild( $padding_ease );
$ProductViewer->appendChild( $inertia );
$ProductViewer->appendChild( $grab_hand_cursor );

$ProductViewer->appendChild( $mouse_wheel_function );

$ProductViewer->appendChild( $mouse_wheel_speed );
$ProductViewer->appendChild( $maxZoom );
$ProductViewer->appendChild( $zoomSpeed );
$ProductViewer->appendChild( $zoomEase );
$ProductViewer->appendChild( $autoplay );
$ProductViewer->appendChild( $autoplaySpeed );
$ProductViewer->appendChild( $reverse );
$ProductViewer->appendChild( $controls );
$ProductViewer->appendChild( $panel );
$ProductViewer->appendChild( $loading );
$ProductViewer->appendChild( $include_zoom_window );
$ProductViewer->appendChild( $zoom_window );
$ProductViewer->appendChild( $include_tooltips );
$ProductViewer->appendChild( $tooltips_texts );
$ProductViewer->appendChild( $tooltips );
$ProductViewer->appendChild( $hotspotsImagesPath );
$ProductViewer->appendChild( $hotspotsButtons );



/*
$ProductViewer->appendChild( $imagesPath );
$ProductViewer->appendChild( $imagesBigPath );
*/
$ProductViewer->appendChild( $images );

$xml->appendChild( $ProductViewer );

// Parse the XML.
print $xml->saveXML();
endif;
