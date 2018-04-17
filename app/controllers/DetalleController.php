<?php

namespace App\Controllers;

use App\Models\EntradaBlog;

class DetalleController extends BaseController {

    public function getIndex($idEntrada = null) {
        $entradaBlog = EntradaBlog::find($idEntrada);
        return $this->render('detalle.twig', [
            'entradaBlog' => $entradaBlog
        ]);
    }
}