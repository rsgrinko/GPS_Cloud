<?php
//что принимаем
//lat, lot, speed
//обрабатываем на всякий случай
$devid = str_replace(':||:', '', $_GET['devid']);
$devid = str_replace("\n", '', $devid);

$lat = str_replace(':||:', '', $_GET['lat']);
$lat = str_replace("\n", '', $lat);

$lot = str_replace(':||:', '', $_GET['lot']);
$lot = str_replace("\n", '', $lot);

$speed = str_replace(':||:', '', $_GET['speed']);
$speed = str_replace("\n", '', $speed);


//-------------------------------//
$fp = fopen('log.txt', 'a+');
fwrite($fp,  date("m.d.Y H:i:s").' '.$lat.' '.$lot."\n");
fclose($fp);


$fp = fopen('coordinates.txt', 'a+');
fwrite($fp,  '['.$lat.', '.$lot.'],'."\n");
fclose($fp);

$fp = fopen('data.txt', 'a+');
fwrite($fp,  $devid.':||:'.date("Y").':||:'.date("m").':||:'.date("d").':||:'.date("H").':||:'.date("i").':||:'.date("s").':||:'.$lat.':||:'.$lot.':||:'.$speed."\n");
fclose($fp);






echo 'Запрос выполнен';
?>
