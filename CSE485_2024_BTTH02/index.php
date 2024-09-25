<?php
require_once('config/database.php');

$controller = ucfirst(isset($_GET['controller'])? $_GET['controller']:'home').'Controller';
$action = isset($_GET['action'])? $_GET['action']:'index';

$controllerPath = 'controllers/'.$controller.'.php';

if(!file_exists($controllerPath)){
    die('Tệp tin không tồn tại');
}


require_once($controllerPath);

$myObj = new $controller();
$myObj->$action();
?>