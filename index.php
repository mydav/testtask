<?php

require_once('includes/bootstrap.php');
spl_autoload_register(function ($className) {
    include_once ROOT_DIR . str_replace('\\', '/', '/' . $className . '.php');
});

$helper = \includes\Helper::Instance();
//разделения controller и action в ардресной строке
$params = $helper->parseUri();

// определяем контроллер
$ctrlName = isset($params[0]) ? $params[0] : 'tasks';
switch ($ctrlName) {
    case 'tasks':
        $controller = new \controllers\Task($params);
        break;
    case 'user':
        $controller = new \controllers\User($params);
        break;
    default:
        $controller = new \controllers\Errors();
        @$action .= 'error404';
        break;
}

// определение action
if(!isset($action) && empty($action)){
    $action = 'action_';
    $action .= isset($params[1]) ? $params[1] : 'index';
}
// запускаем приложение

$controller->$action();
$controller->render();
