<?php

namespace App\Controllers;

class IndexController {

    public function getIndex() {
        global $pdo;
        $query = $pdo->prepare('SELECT * FROM blog_posts ORDER BY id DESC');
        $query->execute();
        $entradasBlog = $query->fetchAll(\PDO::FETCH_ASSOC);
        return render('../views/index.php', ['entradasBlog' => $entradasBlog]);
    }
}