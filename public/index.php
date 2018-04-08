<?php

ini_set('display_errors', 1);
ini_set('display_startups_erros', 1);
error_reporting(E_ALL);

include_once '../vendor/autoload.php';
include_once '../config.php';

$baseDir = str_replace(basename($_SERVER['SCRIPT_NAME']), '', $_SERVER['SCRIPT_NAME']);
$baseUrl = 'http://' . $_SERVER['HTTP_HOST'] . $baseDir;
define('BASE_URL', $baseUrl);

$route = isset($_GET['route']) ? $_GET['route'] : '/';

function render($fileName, $params = []) {
    ob_start();
    extract($params);
    include $fileName;
    return ob_get_clean();
}

use Phroute\Phroute\RouteCollector;

$router = new RouteCollector();

$router->get('/admin', function() {
    return render('../views/admin/index.php');
});

$router->get('/admin/listar-entradas', function() use ($pdo) {
    $query = $pdo->prepare('SELECT * FROM blog_posts ORDER BY id DESC');
    $query->execute();
    $entradasBlog = $query->fetchAll(PDO::FETCH_ASSOC);
    return render('../views/admin/listar-entradas.php', ['entradasBlog' => $entradasBlog]);
});

$router->get('/admin/entradas/insertar-entrada', function() {
    return render('../views/admin/insertar-entrada.php');
});

$router->post('/admin/entradas/insertar-entrada', function() use ($pdo) {
    $sql = "INSERT INTO blog_posts (titulo, contenido) VALUES (:titulo, :contenido)";
    $query = $pdo->prepare($sql);
    $result = $query->execute([
        'titulo' => $_POST['titulo'],
        'contenido' => $_POST['contenido']
    ]);
    return render('../views/admin/insertar-entrada.php', ['result' => $result]);
});

$router->get('/', function() use ($pdo) {
    $query = $pdo->prepare('SELECT * FROM blog_posts ORDER BY id DESC');
    $query->execute();
    $entradasBlog = $query->fetchAll(PDO::FETCH_ASSOC);
    return render('../views/index.php', ['entradasBlog' => $entradasBlog]);
});

$dispatcher = new Phroute\Phroute\Dispatcher($router->getData());
$response = $dispatcher->dispatch($_SERVER['REQUEST_METHOD'], $route);

echo $response;


