<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\EntradaBlog;

class EntradaController extends BaseController{

    public function getIndex() {
        $entradasBlog = EntradaBlog::all();
        return $this->render('admin/entradas.twig', ['entradasBlog' => $entradasBlog]);
    }

    public function getCrear() {
        return $this->render('admin/crear.twig');
    }

    public function postCrear() {
        $entradaBlog = new EntradaBlog([
            'titulo' => $_POST['titulo'],
            'contenido' => $_POST['contenido']
        ]);
        $entradaBlog->save();
        $result = true;
        return $this->render('admin/crear.twig', ['result' => $result]);
    }
}