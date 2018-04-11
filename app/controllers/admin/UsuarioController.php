<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\EntradaBlog;
use App\Models\Usuario;
use Sirius\Validation\Validator;

class UsuarioController extends BaseController {

    public function getIndex() {
        $usuario = EntradaBlog::all();
        return $this->render('admin/usuarios.twig', [
            'usuario' => $usuario
        ]);
    }

    public function getCrear() {
        return $this->render('admin/crear-usuario.twig');
    }

    public function postCrear() {
        $errores = [];
        $result = false;
        $validador = new Validator();
        $validador->add('nombre', 'required');
        $validador->add('email', 'required');
        $validador->add('email', 'email');
        $validador->add('password', 'required');

        if ($validador->validate($_POST)) {
            $usuario = new Usuario();
            $usuario->nombre = $_POST['nombre'];
            $usuario->email = $_POST['email'];
            $usuario->password = password_hash($_POST['password'], PASSWORD_DEFAULT);
            $usuario->save();
            $result = true;
        } else {
            $errores = $validador->getMessages();
        }
        return $this->render('admin/crear-usuario.twig', [
            'result' => $result,
            'errores' => $errores
        ]);
    }
}