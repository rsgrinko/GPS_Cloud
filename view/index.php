<?php
session_start();
include 'function.php';

if(!isUser($_SESSION['login'], $_SESSION['pass'])) {
if($_GET['act']!=='errauth'){
header("Location: index.php?act=errauth");
}
}
// Если херовая сессия или нет авторизации то кидаем на страницу авторизации

//Задание начальных переменных для VIEW
$_SYSTEM['title'] = 'Главная страница';
$_SYSTEM['map'] = 'enable'; //disable

include 'header.php';
echo '<div id="map" style="width: 900px; height: 600px"></div>';
