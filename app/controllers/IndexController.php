<?php

namespace App\Controllers;

use App\Models\EntradaBlog;

class IndexController extends BaseController {
    const entradasPorPagina = 3;

    public function getIndex($pagina = 1) {
        $totalEntradas = EntradaBlog::count();
        $siguiente = $anterior = null;
        if ($pagina > 1) {
            $anterior = $pagina - 1;
        }
        if ($pagina * self::entradasPorPagina < $totalEntradas) {
            $siguiente = $pagina + 1;
        }
        $entradasBlog = EntradaBlog::query()->orderBy('titulo', 'asc')->skip(
            self::entradasPorPagina * ($pagina - 1))->take(self::entradasPorPagina)->get();
        return $this->render('index.twig', [
            'entradasBlog' => $entradasBlog,
            'paginador' => [
                'siguiente' => $siguiente,
                'anterior' =>  $anterior
            ]
        ]);
    }
}
