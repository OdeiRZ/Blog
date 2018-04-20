<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\Usuario;
use Sirius\Validation\Validator;

class UsuarioController extends BaseController {

    public function getIndex() {
        $usuarios = Usuario::all()->sortBy("nombre");
        return $this->render('admin/usuarios.twig', [
            'usuarios' => $usuarios
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

    public function getEditar($idUsuario = null) {
        $usuario = Usuario::find($idUsuario);
        return $this->render('admin/editar-usuario.twig', [
            'usuario' => $usuario
        ]);
    }

    public function postEditar($idUsuario = null) {
        $errores = [];
        $result = false;
        $validador = new Validator();
        $validador->add('nombre', 'required');
        $validador->add('email', 'required');
        $validador->add('email', 'email');
        $usuario = Usuario::find($idUsuario);

        if ($validador->validate($_POST)) {
            $usuario->nombre = $_POST['nombre'];
            $usuario->email = $_POST['email'];
            $usuario->save();
            $result = true;
        } else {
            $errores = $validador->getMessages();
        }
        return $this->render('admin/editar-usuario.twig', [
            'result' => $result,
            'errores' => $errores,
            'usuario' => $usuario
        ]);
    }

    public function getBorrar($idUsuario = null) {
        $usuario = Usuario::find($idUsuario);
        if ($usuario) {
            $usuario->delete();
        }
        header('Location: ' . BASE_URL . 'admin/usuarios');
    }
}