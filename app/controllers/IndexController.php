<?php

namespace App\Controllers;

use App\Models\EntradaBlog;

class IndexController extends BaseController {
    const maxEntradas = 3;

    public function getIndex($pagina = 1) {
        $totalEntradas = EntradaBlog::count();
        $siguiente = $anterior = null;
        if ($pagina > 1) {
            $anterior = $pagina - 1;
        }
        if ($pagina * self::maxEntradas < $totalEntradas) {
            $siguiente = $pagina + 1;
        }
        $entradasBlog = EntradaBlog::query()->orderBy('id', 'desc')->skip(self::maxEntradas * ($pagina - 1))->take(self::maxEntradas)->get();
        return $this->render('index.twig', [
            'entradasBlog' => $entradasBlog,
            'paginador' => [
                'siguiente' => $siguiente,
                'anterior' =>  $anterior
            ]
        ]);
    }
}
