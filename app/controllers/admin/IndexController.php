<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\Usuario;

class IndexController extends BaseController {

    public function getIndex() {
        if (isset($_SESSION['idUsuario'])) {
            $idUsuario = $_SESSION['idUsuario'];
            $usuario = Usuario::find($idUsuario);
            if ($usuario) {
                return $this->render('admin/index.twig', [
                    'usuario' => $usuario
                ]);
            }
        }
        header('Location: ' . BASE_URL . 'acceso/login');
    }
}