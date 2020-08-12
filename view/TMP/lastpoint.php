<?php
if($file = @file('../gps/coordinates.txt')){
$lastPoint = $file[count($file)-1];
echo substr($lastPoint,0,-2);
} else {
echo '[54.195387, 37.618035]';
}
?>
