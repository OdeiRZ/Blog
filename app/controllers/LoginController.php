<?php

namespace App\Controllers;

use App\Log;
use App\Models\Usuario;
use Sirius\Validation\Validator;

class LoginController extends BaseController {

    public function getLogin() {
        return $this->render('login.twig');
    }

    public function postLogin() {
        $errores = [];
        $result = false;
        $validador = new Validator();
        $validador->add('email', 'required');
        $validador->add('email', 'email');
        $validador->add('password', 'required');

        if ($validador->validate($_POST)) {
            $usuario = Usuario::where('email',$_POST['email'])->first();
            if ($usuario) {
                if (password_verify($_POST['password'], $usuario->password)) {
                    Log::logInfo('Login usuario: ' . $usuario->id);
                    $_SESSION['idUsuario'] = $usuario->id;
                    header('Location:' . BASE_URL . 'admin');
                    return null;
                }
            }
            $validador->addMessage('email', 'Usuario y/o password incorrecto/s');
        }
        $errores = $validador->getMessages();
        return $this->render('login.twig', [
            'errores' => $errores
        ]);
    }

    public function getLogout() {
        Log::logInfo('Logout usuario: ' . $_SESSION['idUsuario');
        unset($_SESSION['idUsuario']);
        header('Location: ' . BASE_URL . 'acceso/login');
    }
}
