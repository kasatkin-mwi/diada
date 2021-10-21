<?php
/**
 * Оптимизаторский файл. Подключать только include_once!!! Не забываем global $aSEOData, где нужно.
 * НЕ УДАЛЯТЬ! К этому файлу идёт обращение в d-seo.php, в случае удаления - ложится сайт.
 */
define('D_BREADS_PATTERN', '{<!--bc-->(.*)<!--/bc-->}siU');
define('D_BREADS_DELIMITER', '//');
define('D_PRODUCT_PAGE', '<!--d_product_page-->');

class dBreadcrumbs{
	private $breads;
	public function __construct($sContent){
		$breads = array();
		if(preg_match(D_BREADS_PATTERN, $sContent, $breads)){
			$breads = explode(D_BREADS_DELIMITER, str_replace('&nbsp;', ' ', strip_tags($breads[1])));
			foreach($breads as &$v) $v = trim($v);
		} else $breads = array('');
		$this->breads = $breads;
	}

	public function get($n){
		$index = $this->getAbsoluteIndex($n);
		return isset($this->breads[$index]) ? $this->breads[$index] : false;

	}

	public function getAbsoluteIndex($n){
		if($n < 0) return count($this->breads) + $n;
		else return $n;
	}

	public function getString($delimiter = '/', $first = 0, $last = -1){
		$first = $this->getAbsoluteIndex($first);
		$last = $this->getAbsoluteIndex($last) - $first;
		return implode($delimiter, array_slice($this->breads, $first, $last+1));
	}

	public function hasParent($name){
		return in_array($name, $this->breads);
	}
}
class dSEOHelper{
	public $aSEOData, $sContent, $breads = NULL;

	public function __construct(&$aSEOData, &$sContent){
		$this->aSEOData = &$aSEOData;
		$this->sContent = &$sContent;
	}


	public function getBreads(){
		if($this->breads == NULL) {
			$this->breads = new dBreadcrumbs($this->sContent);
		}
		return $this->breads;
	}
	/**
	 *@var array $vars 0 - шаблон
	**/
	public function textGen($vars, $pattern = ''){
		if($pattern == ''){ 
			$pattern = $vars[0];
			unset($vars[0]);
		}
		foreach ($vars as $key => $value) {
			$pattern = str_replace('<'.$key.'>', $value, $pattern);
		}
		return $pattern;
	}

	public function genMeta($name, $vars, $pattern = ''){
		$this->aSEOData[$name] = $this->textGen($vars, $pattern);
	}

	public function genTitle($vars, $pattern = ''){
		$this->genMeta('title', $vars, $pattern);
	}
	public function genDescr($vars, $pattern = ''){
		$this->genMeta('descr', $vars, $pattern);
	}
	public function genKeywr($vars, $pattern = ''){
		$this->genMeta('keywr', $vars, $pattern);
	}
	public function genH1($vars, $pattern = ''){
		$this->genMeta('h1', $vars, $pattern);
	}
	public function isProductPage(){
		return strpos($this->sContent, D_PRODUCT_PAGE) !== false;
	}
	public function getH1(){
		if(isset($this->aSEOData['h1']) && !empty($this->aSEOData['h1'])) return $this->aSEOData['h1'];
		else {
			$match = array();
			return preg_match('{<h1.*>(.*)</h1>}siU', $this->sContent, $match) ? trim($match[1]) : $this->getBreads()->get(-1);
		}
	}
	public function parse($pattern){
		$match = array();
		return preg_match($pattern, $this->sContent, $match) ? trim($match[1]) : '';
	}
	public function filter($text){
		$text = strip_tags($text);
		$search = array( '&amp;','&nbsp;',	'&#40;','&#41;','&quote;');
		$replace = array('&',	 ' ',		'(',	')',	'"');
		return trim(str_replace($search, $replace, $text));
	}

	public function dump($var){
		$this->sContent .= '<!--dump '.var_export($var, true).' -->';
	}
}

/*
if (file_exists($_SERVER['DOCUMENT_ROOT'] . '/d-seoh.php')) {
	include_once($_SERVER['DOCUMENT_ROOT'] . '/d-seoh.php');
}
$dHelper = new dSEOHelper($aSEOData, $sContent);
$dBreads = $dHelper->getBreads();
//$dHelper->dump($dBreads->getString('>'));
*/