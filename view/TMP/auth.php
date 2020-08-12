<?php
session_start();

include 'function.php';
$adm_login = 'admin';
$adm_pass = 'admin';


if($_GET['act']=='exit') {
addLog('Пользователь '.$_SESSION['login'].' вышел из системы');
session_unset();
header('Location: auth.php?');
}


if(isset($_SESSION['login']) and isset($_SESSION['pass'])){
if($_SESSION['login']==$adm_login and $_SESSION['pass']==$adm_pass){
    header('Location: index.php?'.session_name().'='.session_id());
} else { $auth = 'error'; }
}




if(isset($_GET['login']) and isset($_GET['pass'])){
if($_GET['login']==$adm_login and $_GET['pass']==$adm_pass){
$_SESSION['login'] = $_GET['login'];
$_SESSION['pass'] = $_GET['pass'];
$auth = '';
 addLog('Пользователь '.$_SESSION['login'].' успешно залогинился в системе');
    header('Location: index.php?'.session_name().'='.session_id());
} else {$auth = 'error';}
}


$loginform ='<form action="auth.php?'.session_name().'='.session_id().'" method="GET">
Логин:<br><input type="text" name="login"><br>
Пароль:<br><input type="password" name="pass"><br>
<input type="submit" value="Вход">
</form>';

?>
<html>
    <head><title>Авторизация</title></head>
    <body>
        <h1>Авторизация</h1>
<?php
switch($_GET['act']) {
    default:
    if($auth == 'error') {
    addLog('Неудачная попытка входа в систему');
    echo '<h2><h2>Неверный логин или пароль.</h2> ';
    }
    echo $loginform;  
    break;
    
    case 'errauth':
    addLog('Неудачная попытка входа, истек срок действия сессии');
    echo '<h2>Неудачная попытка входа, истек срок действия сессии.</h2>';
    echo $loginform;
    break;
    
    case 'authfail':
    addLog('Неудачная попытка входа, истек срок действия сессии');
    echo '<h2>Неудачная попытка входа, истек срок действия сессии.</h2>';
    echo $loginform;
    break;
    
}




?>
        
    </body>
</html>