<?php
if(isUser($_SESSION['login'], $_SESSION['pass'])) {
?>
<h2><center>Статистика и отладка</center></h2>
&emsp;<a href="index.php">Обновить страницу</a><br><br>




<center><b>Информация о пользователе</b></center>
&emsp;Логин: <b><?=$_SESSION['login'];?></b><br>
&emsp;E-Mail: <b><?=getProffileValue($_SESSION['login'], $value = 'email');?></b><br>
&emsp;Имя: <b><?=getProffileValue($_SESSION['login'], $value = 'name');?></b><br>
&emsp;Компания: <b><?=getProffileValue($_SESSION['login'], $value = 'company');?></b><br>
&emsp;Устройств: <b><?=getProffileValue($_SESSION['login'], $value = 'devices');?></b><br>
&emsp;<a href="auth.php?act=exit&<?php echo session_name().'='.session_id(); ?>&">Выйти из системы</a></b><br><br>







<center><b>API v1.0.1</b></center>
&emsp;<a href="clean.php">Удалить трек</a><br>
&emsp;Записей в треке: <b><?=getCountCoordinates($_SESSION['devid'], $_SESSION['eptime']);?></b><br>
&emsp;Первая координата: <b><?=getFirstGpsPoint($_SESSION['devid'], $_SESSION['eptime']);?></b><br>
&emsp;Последняя координата: <b><?=getLastGpsPoint($_SESSION['devid'], $_SESSION['eptime']);?></b><br>
&emsp;Дата последней координаты: <b><?=getLastGpsDate($_SESSION['devid'], $_SESSION['eptime']);?></b><br><br>

<center><b>API v1.0.2</b></center>
&emsp;Количество активированных устройств: <b><?=getCountDevices();?></b><br>
&emsp;<a href="log.txt">Загрузить лог системы</a><br><br>

<center><b>Список устройств</b></center>
<?php
$devlist = scandir('../devices/'); //забиваем массив
$countdev = count($devlist); //считаем
//print_r($devlist);
for($i=0; $i < $countdev; $i++){
    if($devlist[$i]!== '.' and $devlist[$i]!== '..'){
    echo '&emsp;<a href="select_device.php?device='.$devlist[$i].'"><img src="img/device.png" alt="->" height="25" wigth="25"> '.$devlist[$i].'</a><br>';
    }
}
 //////   
 if($_SESSION['devid']) {
   echo '<br><center><b>Список треков</b></center>';
$tracklist = scandir('../tracks/'.$_SESSION['devid'].'/'); //забиваем массив
$counttracks = count($tracklist); //считаем
//print_r($devlist);
for($i=0; $i < $counttracks; $i++){
    if($tracklist[$i]!== '.' and $tracklist[$i]!== '..'){
    echo '&emsp;<a href="select_track.php?eptime='.$tracklist[$i].'"><img src="img/gps.png" alt="->" height="25" wigth="25"> '.date("d.m.Y - H:i:s", $tracklist[$i]).'</a><br><br>';
        
    } 
  }   
 }

    
    
 //   
} else {
?>
<h2><center>Авторизация</center></h2>
<center>
<?php if($_GET['act']=='errauth') { echo '<h3><font color="red"><b>* Неверный логин или пароль</b></font></h3>'; } ?>
<form action="auth.php" method="GET">
Логин:<br><input type="text" name="login"><br>
Пароль:<br><input type="password" name="pass"><br>
<input type="submit" value="Вход">
</form>
</center>

<?php
}
?>
