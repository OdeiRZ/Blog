<?php

ini_set('display_errors', 1);
ini_set('display_startups_erros', 1);
error_reporting(E_ALL);

include_once '../vendor/autoload.php';

include_once '../config.php';

$route = isset($_GET['route']) ? $_GET['route'] : '/';

use Phroute\Phroute\RouteCollector;

$router = new RouteCollector();
$router->get('', function() use ($pdo) {
    $query = $pdo->prepare('SELECT * FROM blog_posts ORDER BY id DESC');
    $query->execute();
    $entradasBlog = $query->fetchAll(PDO::FETCH_ASSOC);
    include '../views/index.php';
});

$dispatcher = new Phroute\Phroute\Dispatcher($router->getData());
$response = $dispatcher->dispatch($_SERVER['REQUEST_METHOD'], $route);

echo $response;


