<?php
######################################################
#            [        R&G Technology      ]          #
#            [   Роман Сергеевич Гринько  ]          #
#            [ E-Mail: rsgrinko@gmail.com ]          #
######################################################
//что принимаем
//обрабатываем на всякий случай
$devid = str_replace(':||:', '', $_GET['devid']);
$devid = str_replace("\n", '', $devid);

$lat = str_replace(':||:', '', $_GET['lat']);
$lat = str_replace("\n", '', $lat);

$lot = str_replace(':||:', '', $_GET['lot']);
$lot = str_replace("\n", '', $lot);

$speed = str_replace(':||:', '', $_GET['speed']);
$speed = str_replace("\n", '', $speed);

$eptime = str_replace(':||:', '', $_GET['eptime']);
$eptime = str_replace("\n", '', $eptime);


//-------------------------------//
//Пишем данные трека в массив
if(!file_exists('tracks/'.$devid)){
mkdir('tracks/'.$devid);
}

if(!file_exists('tracks/'.$devid.'/'.$eptime)){
mkdir('tracks/'.$devid.'/'.$eptime);
}

$fp = fopen('tracks/'.$devid.'/'.$eptime.'/log.txt', 'a+');
fwrite($fp,  date("m.d.Y H:i:s").' '.$lat.' '.$lot."\n");
fclose($fp);


$fp = fopen('tracks/'.$devid.'/'.$eptime.'/coordinates.txt', 'a+');
fwrite($fp,  '['.$lat.', '.$lot.'],'."\n");
fclose($fp);

$fp = fopen('tracks/'.$devid.'/'.$eptime.'/data.txt', 'a+');
fwrite($fp,  $devid.':||:'.date("Y").':||:'.date("m").':||:'.date("d").':||:'.date("H").':||:'.date("i").':||:'.date("s").':||:'.$lat.':||:'.$lot.':||:'.$speed."\n");
fclose($fp);

echo 'Запрос выполнен';

if (!empty($_GET)) {
    $fw = fopen('systemlog.txt', "a+");
    fwrite($fw, "GET " . var_export($_GET, true));
    fclose($fw);
}
?>
