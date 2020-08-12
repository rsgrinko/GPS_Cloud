<?php
######################################################
#            [        R&G Technology      ]          #
#            [   Роман Сергеевич Гринько  ]          #
#            [ E-Mail: rsgrinko@gmail.com ]          #
######################################################
// Внутренние функции
function addLog($msg, $type = 'Information'){ // Системная функция для добавления в лог события
$fp = fopen('log.txt', 'a+');
fwrite($fp,  date("m.d.Y H:i:s").' - '.$type.' - '.$msg."\n");
fclose($fp);
}
//------------------------------------------------------//

function clearLog(){ // Системная функция для полной очистки лога событий. ИСПОЛЬЗОВАТЬ ТОЛЬКО КОГДА ПОНИМАЕШЬ ДЛЯ ЧЕГО ЭТО!
unlink('log.txt');
$fp = fopen('log.txt', 'a+');
fwrite($fp,  date("m.d.Y H:i:s").' - System - Log been cleaned.'."\n");
fclose($fp);
}
//------------------------------------------------------//



// Функции облака


function checkDevice($devid){ // Функция проверки устройства на активацию (было ли активировано на какую либо учетную запись. по сути проверка привязки к аккаунту)
if(file_exists('../devices/'.$devid)) {
return file_get_contents('../devices/'.$devid); // Если девайс существует, возвращаем логиин владельца девайса
} else { return 0; } //Устройство не существует и не активировано
}
//------------------------------------------------------//
function getCountCoordinates($devid, $eptime){ //Функция подсчета общего количества координат в треке
if(file_exists('../devices/'.$devid.'/'.$eptime.'/coordinates.txt')){
return count(file('../devices/'.$devid.'/'.$eptime.'/coordinates.txt'));
} else {
return '0';
}  
}
//------------------------------------------------------//

//------------------------------------------------------//

function getFirstGpsPoint($devid, $eptime) { // Функция получения первой точки координат из файла базы данных
if($file = @file('../tracks/'.$devid.'/'.$eptime.'/coordinates.txt')){
return substr($file[0],0,-2);
} else {
return 'undefined';
}
}
//------------------------------------------------------//

function getLastGpsDate($devid, $eptime) { // Функция получения даты/времени последней координаты из файла базы данных
if(file_exists('../tracks/'.$devid.'/'.$eptime.'/log.txt')){
$file = file('../tracks/'.$devid.'/'.$eptime.'/log.txt');
$file = $file[count($file)-1];
$file = explode(' ', $file);
return $file[0].' '.$file[1];
} else {
return 'undefined';
}  
}
//------------------------------------------------------//

function getCountDevices() { // Функция возвращает количество активированных устройств (API v.1.0.2)
$tmp = count(scandir('../tracks/')) - 2;
if($tmp>0){
return $tmp;
} else {
return 0;
}    
}
//------------------------------------------------------//

function addUser($login, $password, $email, $name, $company, $devices = 0){ // Функция создания профиля пользователя системы
if(file_exists('../users/'.$login.'.prof')) { return 0; } // Если профиль пользователя уже существует, возвращаем ошибку
$str = $login.':||:'.$password.':||:'.$email.':||:'.$name.':||:'.$company.':||:'.$devices;
$fp = fopen('../users/'.$login.'.prof', 'a+');
fwrite($fp,  $str);
fclose($fp);
}
//------------------------------------------------------//

function addDevice($login, $devid){ // Функция привязки девайса к учетной записи
$fp = fopen('../devices/'.$devid, 'a+');
fwrite($fp,  $login);
fclose($fp);
/////////Создали привязку девайса к учетной записи, теперь прибавляем количество устройств в профиле пользователя
$profile = file_get_contents('../users/'.$login.'.prof');
$profile = explode(':||:', $profile); //Разбиваем профиль на массив данных
$count = $profile['5'] + 1; //увеличили количество устройств на 1
$str = $profile['0'].':||:'.$profile['1'].':||:'.$profile['2'].':||:'.$profile['3'].':||:'.$profile['5'].':||:'.$count; // Формируем данные для записи в профайл пользователя
$fp = fopen('../users/'.$login.'.prof', 'a+');
fwrite($fp,  $str);
fclose($fp);
}
//------------------------------------------------------//

function changeOwnerDevice($devid, $login){ // Функция ПЕРЕпривязки девайса к ДРУГОЙ учетной записи (в случае когда устройство передается другому пользователю во владение)
$oldOwner = file_get_contents('../devices/'.$devid); //запоминаем старого владельца
unlink('../devices/'.$devid); //чтоб наверняка, стираем файл привязки устройства
$fp = fopen('../devices/'.$devid, 'a+');
fwrite($fp,  $login);
fclose($fp);
/////////Создали привязку девайса к учетной записи, теперь прибавляем количество устройств в профиле пользователя
$profile = file_get_contents('../users/'.$login.'.prof');
$profile = explode(':||:', $profile); //Разбиваем профиль на массив данных
$count = $profile['5'] + 1; //увеличили количество устройств на 1
$str = $profile['0'].':||:'.$profile['1'].':||:'.$profile['2'].':||:'.$profile['3'].':||:'.$profile['5'].':||:'.$count; // Формируем данные для записи в профайл пользователя
$fp = fopen('../users/'.$login.'.prof', 'a+');
fwrite($fp,  $str);
fclose($fp);
/////////Для нового пользователя все посчитали и записали. Теперь вычитаем это устройство у старого владельца
$profile2 = file_get_contents('../users/'.$oldOwner.'.prof');
$profile2 = explode(':||:', $profile2); //Разбиваем профиль на массив данных
$count2 = $profile2['5'] - 1; //уменьшаем количество устройств на 1
$str2 = $profile2['0'].':||:'.$profile2['1'].':||:'.$profile2['2'].':||:'.$profile2['3'].':||:'.$profile2['5'].':||:'.$count2; // Формируем данные для записи в профайл пользователя
$fp2 = fopen('../users/'.$oldOwner.'.prof', 'a+');
fwrite($fp2,  $str2);
fclose($fp2);
}


//------------------------------------------------------//

function checkDeviceData($devid){ // Функция проверки девайса на наличие принятых данных. передавались ли данные с устройства в принципе
if(file_exists('../tracks/'.$devid)) {
$tmp = count(scandir('../tracks/')) - 2; //Получаем количество треков
 if($tmp>0) {return $tmp; } else { return 0; }//Если треков большое 0, то возвращаем это количество. если нет - возвращаем ошибку
} else {
    return 0; //Устройство не существует и не активировано
}
}
//------------------------------------------------------//

function isUser($login, $password){ // Функция проверки пользователя. возвращает истину при прохождении проверки, 0 в противном случае
if(file_exists('../users/'.$login.'.prof')) {
$profile = file_get_contents('../users/'.$login.'.prof');
$profile = explode(':||:', $profile); //Заполняем массив данными из профиля
if($profile['1'] == $password){ return 1; } //Все проверки пройдены, юзер подтвержден
} else {
    return 0; //Пользователь не существует
}
}
//------------------------------------------------------//

function startUserSession($login, $password){ // Функция старта сессии для пользователя после авторизации
$_SESSION['login'] = $login;
$_SESSION['pass'] = $password;
}
//------------------------------------------------------//

function stopUserSession($login){ // Функция убития сессии пользователя. для выхода из системы например
unset($_SESSION['login']);
unset($_SESSION['pass']);
}
//------------------------------------------------------//

function getLastGpsPoint($devid, $eptime){ //получить последнюю координату для трека
if($file = @file('../tracks/'.$devid.'/'.$eptime.'/coordinates.txt')){
$lastPoint = $file[count($file)-1];
return substr($lastPoint,0,-2);
} else {
return '[54.195387, 37.618035]';
}
}
//------------------------------------------------------//
function prepareTrack($devid, $eptime, $polygone = '') { //функция подготовки координат для построение трека
$coordinates = file_get_contents('../tracks/'.$devid.'/'.$eptime.'/coordinates.txt');
$coordinates = substr($coordinates,0,-2);
return $coordinates;
}
//------------------------------------------------------//
function getProffileValue($login, $value = 'email') {
$profile = file_get_contents('../users/'.$login.'.prof');
$profile = explode(':||:', $profile); //Заполняем массив данными из профиля
switch($value){
default:
return $profile['2']; //email
break;

case 'email':
return $profile['2']; //email
break;

case 'name':
return $profile['3']; //полное имя
break;

case 'company':
return $profile['4']; //Компания
break;

case 'devices':
return $profile['5']; //Количество привязанных девайсов
break;

}
}
