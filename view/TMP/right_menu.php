<h2><center>Статистика и отладка</center></h2>
&emsp;<a href="index.php">Обновить страницу</a><br><br>
&emsp;Пользователь: <b><?=$_SESSION['login'];?></b><br>
&emsp;<a href="auth.php?act=exit&<?php echo session_name().'='.session_id(); ?>&">Выйти из системы</a></b><br><br>

<b>API v1.0.1</b><br>
&emsp;<a href="clean.php">Удалить трек</a><br>
&emsp;Записей в базе координат: <b><?=getCountCoordinates();?></b><br>
&emsp;Первая координата: <b><?=getFirstGpsPoint();?></b><br>
&emsp;Последняя координата: <b><?=getLastGpsPoint();?></b><br>
&emsp;Дата последней координаты: <b><?=getLastGpsDate();?></b><br><br>

<b>API v1.0.2</b><br>
&emsp;Количество активированных устройств: <b><?=getCountDevices();?></b><br>
&emsp;<a href="log.txt">Загрузить лог системы</a><br>

&emsp;<textarea rows="17" cols="100" name="text" disabled style="resize: none"><?php echo file_get_contents('log.txt'); ?></textarea>