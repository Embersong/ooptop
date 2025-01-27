<?php

session_start();


use Ember\Oop\core\Render;

include __DIR__ . "/../vendor/autoload.php";

//роутинг
//localhost/?c=post&a=update&id=2



$controllerName = $_GET['c'] ?? 'posts';
$actionName = $_GET['a'] ?? 'index';

$controllerClass = "Ember\\Oop\\controllers\\" . ucfirst($controllerName) . "Controller";

try {
    if (class_exists($controllerClass)) {
        $controller = new $controllerClass(new Render());
        $controller->runAction($actionName);
    } else {
        throw new Exception("Нет такого контроллера");
    }
} catch (Exception $e) {
    echo $e->getMessage();
}


