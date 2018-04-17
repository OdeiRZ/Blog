<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\EntradaBlog;
use Sirius\Validation\Validator;

class EntradaController extends BaseController {

    public function getIndex() {
        $entradasBlog = EntradaBlog::all();
        return $this->render('admin/entradas.twig', ['entradasBlog' => $entradasBlog]);
    }

    public function getCrear() {
        return $this->render('admin/crear-entrada.twig');
    }

    public function postCrear() {
        $errores = [];
        $result = false;
        $validador = new Validator();
        $validador->add('titulo', 'required');
        $validador->add('contenido', 'required');

        if ($validador->validate($_POST)) {
            $entradaBlog = new EntradaBlog([
                'titulo' => $_POST['titulo'],
                'contenido' => $_POST['contenido']
            ]);
            if ($_POST['imagen']) {
                $entradaBlog->imagen = $_POST['imagen'];
            }
            $entradaBlog->save();
            $result = true;
        } else {
            $errores = $validador->getMessages();
        }
        return $this->render('admin/crear-entrada.twig', [
            'result' => $result,
            'errores' => $errores
        ]);
    }
}