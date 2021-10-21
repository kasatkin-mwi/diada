<?
function getmicrotime()
{
        list($usec, $sec) = explode(" ", microtime());
        return ((float)$usec + (float)$sec);
}

$s2 = getmicrotime();
$k = 0;
for ($i = 0; $i < 1000000; $i++)
{
  //This is one op
  $k=$k+1;
  $k=$k-1;
  $k=$k+1;
  $k=$k-1;
  $k=$k+1;
  $k=$k-1;
}
$e2 = getmicrotime();
$N2 = $e2 - $s2;
echo $N2;
?>

