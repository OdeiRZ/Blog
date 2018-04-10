<?php

ini_set('display_errors', 1);
ini_set('display_startups_erros', 1);
error_reporting(E_ALL);

include_once '../vendor/autoload.php';

$baseDir = str_replace(basename($_SERVER['SCRIPT_NAME']), '', $_SERVER['SCRIPT_NAME']);
$baseUrl = 'http://' . $_SERVER['HTTP_HOST'] . $baseDir;
define('BASE_URL', $baseUrl);

use Illuminate\Database\Capsule\Manager as Capsule;

$capsule = new Capsule;

$capsule->addConnection([
    'driver'    => 'mysql',
    'host'      => 'localhost',
    'database'  => 'blog',
    'username'  => 'root',
    'password'  => '',
    'charset'   => 'utf8',
    'collation' => 'utf8_unicode_ci',
    'prefix'    => '',
]);

$capsule->setAsGlobal();
$capsule->bootEloquent();

$route = isset($_GET['route']) ? $_GET['route'] : '/';

use Phroute\Phroute\RouteCollector;

$router = new RouteCollector();

$router->controller('/admin', App\Controllers\Admin\IndexController::class);
$router->controller('/admin/entradas', App\Controllers\Admin\EntradaController::class);
$router->controller('/', App\Controllers\IndexController::class);

$dispatcher = new Phroute\Phroute\Dispatcher($router->getData());
$response = $dispatcher->dispatch($_SERVER['REQUEST_METHOD'], $route);

echo $response;
