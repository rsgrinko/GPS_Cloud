<?php
session_start();
include 'function.php';

if($_GET['act'] =='exit') {
 stopUserSession($_SESSION['login']); 
 header("Location: index.php?act=errauth");   
 exit();
}

if(isUser($_GET['login'], $_GET['pass'])) { 
startUserSession($_GET['login'], $_GET['pass']);
header("Location: index.php");
} else {
    header("Location: index.php?act=errauth");
}