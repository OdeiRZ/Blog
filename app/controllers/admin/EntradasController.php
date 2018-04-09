<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;

class EntradasController extends BaseController{

    public function getIndex() {
        global $pdo;
        $query = $pdo->prepare('SELECT * FROM blog_posts ORDER BY id DESC');
        $query->execute();
        $entradasBlog = $query->fetchAll(\PDO::FETCH_ASSOC);
        return $this->render('admin/entradas.twig', ['entradasBlog' => $entradasBlog]);
    }

    public function getCrear() {
        return $this->render('admin/crear.twig');
    }

    public function postCrear() {
        global $pdo;
        $sql = "INSERT INTO blog_posts (titulo, contenido) VALUES (:titulo, :contenido)";
        $query = $pdo->prepare($sql);
        $result = $query->execute([
            'titulo' => $_POST['titulo'],
            'contenido' => $_POST['contenido']
        ]);
        return $this->render('admin/crear.twig', ['result' => $result]);
    }
}