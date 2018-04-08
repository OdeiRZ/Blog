<?php

ini_set('display_errors', 1);
ini_set('display_startups_erros', 1);
error_reporting(E_ALL);

include_once '../config.php';

$route = isset($_GET['route']) ? $_GET['route'] : '/';

switch($route) {
    case '/':
        require '../index.php';
        break;
    case '/admin':
        require '../admin/index.php';
        break;
    case '/admin/listar-entradas':
        require '../admin/listar-entradas.php';
        break;
}