<?php


spl_autoload_register(function ($className) {
    $className = str_replace("\\", DIRECTORY_SEPARATOR, $className);
    include_once $_SERVER['DOCUMENT_ROOT'] . '/../private/' . $className . '.class.php';
});


use Core\App;

$app = App::getInstance();

$app->setRoutes([
    '/test' => [
        'method' => 'GET',
        'handler' => 'TestController@test'
    ],
    '/' => [
        'method' => 'GET',
        'handler' => 'TestController@pla'
    ]
]);

$app->run();