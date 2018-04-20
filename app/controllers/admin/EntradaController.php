<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\EntradaBlog;
use Sirius\Validation\Validator;

class EntradaController extends BaseController {

    public function getIndex(/*$result = null, $errores = null*/) {
        $entradasBlog = EntradaBlog::all()->sortBy("titulo");
        return $this->render('admin/entradas.twig', [
            'entradasBlog' => $entradasBlog
        ]);
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

    public function getEditar($idEntrada = null) {
        $entradaBlog = EntradaBlog::find($idEntrada);
        return $this->render('admin/editar-entrada.twig', [
            'entradaBlog' => $entradaBlog
        ]);
    }

    public function postEditar($idEntrada = null) {
        $errores = [];
        $result = false;
        $validador = new Validator();
        $validador->add('titulo', 'required');
        $validador->add('contenido', 'required');
        $entradaBlog = EntradaBlog::find($idEntrada);

        if ($validador->validate($_POST)) {
            $entradaBlog->titulo = $_POST['titulo'];
            $entradaBlog->contenido = $_POST['contenido'];
            if ($_POST['imagen']) {
                $entradaBlog->imagen = $_POST['imagen'];
            }
            $entradaBlog->save();
            $result = true;
        } else {
            $errores = $validador->getMessages();
        }
        return $this->render('admin/editar-entrada.twig', [
            'result' => $result,
            'errores' => $errores,
            'entradaBlog' => $entradaBlog
        ]);
    }

    public function getBorrar($idEntrada = null) {
        $entradaBlog = EntradaBlog::find($idEntrada);
        if ($entradaBlog) {
            $entradaBlog->delete();
        }
        header('Location: ' . BASE_URL . 'admin/entradas');
    }
}
