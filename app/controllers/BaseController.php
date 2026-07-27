<?php

namespace App\Controllers;

class BaseController {

    protected $templateEngine;

    public function __construct() {
        $loader = new \Twig_Loader_Filesystem('../views');
        $this->templateEngine = new \Twig_Environment($loader, [
            'debug' => filter_var(getenv('APP_DEBUG'), FILTER_VALIDATE_BOOLEAN),
            'cache' => false
        ]);
        $this->templateEngine->addFilter(new \Twig_SimpleFilter('url', function ($ruta) {
            return BASE_URL . $ruta;
        }));
    }

    public function render($fileName, $data = []) {
        return $this->templateEngine->render($fileName, $data);
    }
}
