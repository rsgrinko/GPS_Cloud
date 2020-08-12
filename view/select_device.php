<?php
session_start();
include 'function.php';






////



if(isUser($_SESSION['login'], $_SESSION['pass'])) { 

if($_GET['device'] !=='') {
 $_SESSION['devid'] = $_GET['device'];
 header("Location: index.php");   
 exit();
}

} else {
    header("Location: index.php?act=errauth");
}