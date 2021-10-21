<?

if(preg_match('#/{2,}#',$_SERVER['REQUEST_URI'])){
	header("HTTP/1.0 410 Gone");
	exit;
}