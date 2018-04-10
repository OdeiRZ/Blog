<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\EntradaBlog;
use Sirius\Validation\Validator;

class UsuarioController extends BaseController {

    public function getIndex() {
        $usuario = EntradaBlog::all();
        return $this->render('admin/usuarios.twig', [
            'usuario' => $usuario
        ]);
    }

    public function getCrear() {
        return $this->render('admin/crear.twig');
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
            $entradaBlog->save();
            $result = true;
        } else {
            $errores = $validador->getMessages();
        }
        return $this->render('admin/crear.twig', [
            'result' => $result,
            'errores' => $errores
        ]);
    }
}