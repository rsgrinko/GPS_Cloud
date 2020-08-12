<?php
include 'function.php';
@unlink('../gps/log.txt');
@unlink('../gps/coordinates.txt');
addLog('Трек удален');
header("Location: index.php");
exit();
?>
