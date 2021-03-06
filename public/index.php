<?php

ini_set('display_errors', 1);
ini_set('display_startups_erros', 1);
error_reporting(E_ALL);

require_once '../vendor/autoload.php';

session_start();

$dotEnv = new \Dotenv\Dotenv(__DIR__ . '/..');
$dotEnv->load();

$baseDir = str_replace(basename($_SERVER['SCRIPT_NAME']), '', $_SERVER['SCRIPT_NAME']);
$baseUrl = 'http://' . $_SERVER['HTTP_HOST'] . $baseDir;
define('BASE_URL', $baseUrl);

use Illuminate\Database\Capsule\Manager as Capsule;

$capsule = new Capsule;
$capsule->addConnection([
    'driver'    => 'mysql',
    'host'      => getenv('DB_HOST'),
    'database'  => getenv('DB_NAME'),
    'username'  => getenv('DB_USER'),
    'password'  => getenv('DB_PASS'),
    'charset'   => 'utf8',
    'collation' => 'utf8_unicode_ci',
    'prefix'    => '',
]);

$capsule->setAsGlobal();
$capsule->bootEloquent();

use Phroute\Phroute\RouteCollector;
$route = isset($_GET['route']) ? $_GET['route'] : '/';
$router = new RouteCollector();

$router->filter('acceso', function() {
    if (!isset($_SESSION['idUsuario'])) {
        header('Location: ' . BASE_URL . 'acceso/login');
        return false;
    }
});

$router->controller('/acceso', App\Controllers\LoginController::class);
$router->group(['before' => 'acceso'], function($router) {
    $router->controller('/admin', App\Controllers\Admin\IndexController::class);
    $router->controller('/admin/entradas', App\Controllers\Admin\EntradaController::class);
    $router->controller('/admin/usuarios', App\Controllers\Admin\UsuarioController::class);
});
$router->controller('/', App\Controllers\IndexController::class);
$router->controller('/detalle', App\Controllers\DetalleController::class);

$dispatcher = new Phroute\Phroute\Dispatcher($router->getData());
$response = $dispatcher->dispatch($_SERVER['REQUEST_METHOD'], $route);
echo $response;
