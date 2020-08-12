<?php
if($file = @file('../gps/coordinates.txt')){
$firstPoint = $file[0];
echo substr($firstPoint,0,-2);
} else {
echo '[54.195387, 37.618035]';
}
?>
