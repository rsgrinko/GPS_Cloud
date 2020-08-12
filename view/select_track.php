<?php
session_start();
include 'function.php';
////



if(isUser($_SESSION['login'], $_SESSION['pass'])) { 

if($_GET['eptime'] !=='') {
 $_SESSION['eptime'] = $_GET['eptime'];
 header("Location: index.php");   
 exit();
}
} else {
    header("Location: index.php?act=errauth");
}