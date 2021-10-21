<?php
echo '<pre>';
$last_line = system('find ./ -type f -name "*.php*" -exec grep -i -H "new_det_doubl_bt"  {} \;', $retval);
echo '</pre>';
echo '<hr/>Последняя строка вывода: '.$last_line;
echo '<hr/>Код возврата: '.$retval;