<?php

namespace App\Controllers;

use App\Models\EntradaBlog;

class IndexController extends BaseController {

    public function getIndex() {
        $entradasBlog = EntradaBlog::query()->orderBy('id', 'desc')->get();
        return $this->render('index.twig', ['entradasBlog' => $entradasBlog]);
    }
}
