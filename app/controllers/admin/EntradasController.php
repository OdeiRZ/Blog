<?php

namespace App\Controllers\Admin;

class EntradasController {

    public function getIndex() {
        global $pdo;
        $query = $pdo->prepare('SELECT * FROM blog_posts ORDER BY id DESC');
        $query->execute();
        $entradasBlog = $query->fetchAll(\PDO::FETCH_ASSOC);
        return render('../views/admin/listar.php', ['entradasBlog' => $entradasBlog]);
    }

    public function getCrear() {
        return render('../views/admin/crear.php');
    }

    public function postCrear() {
        global $pdo;
        $sql = "INSERT INTO blog_posts (titulo, contenido) VALUES (:titulo, :contenido)";
        $query = $pdo->prepare($sql);
        $result = $query->execute([
            'titulo' => $_POST['titulo'],
            'contenido' => $_POST['contenido']
        ]);
        return render('../views/admin/crear.php', ['result' => $result]);
    }
}