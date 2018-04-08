<?php

include_once 'config.php';
$query = $pdo->prepare('SELECT * FROM blog_posts ORDER BY id DESC');
$query->execute();
$entradasBlog = $query->fetchAll(PDO::FETCH_ASSOC);

?>

<html>
    <head>
        <title>Blog</title>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    </head>
    <body>
        <div class="container">
            <div class="row">
                <h1>Titulo</h1>
            </div>
            <div class="row">
                <div class="col-md-8">
                    <?php
                    foreach($entradasBlog as $entrada) {
                        echo '<div class="blog-post">';
                        echo '<h2>' . $entrada['titulo'] . '</h2>';
                        echo '<p>08/04/2018 por<a href="">Odei</a> </p>';
                        echo '<div class="blog-post-image">';
                        echo '<img src="imagenes/teclado.jpg" alt="Teclado">';
                        echo '</div>';
                        echo '<div class="blog-post-content">';
                        echo  $entrada['contenido'];
                        echo '</div>';
                        echo '</div>';
                    }
                ?>
                </div>
                <div class="col-md-4">
                    Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.                             Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.
                </div>
            </div>
            <div class="row">
                <footer>
                    Pie de ejemplo
                </footer>
            </div>
        </div>
    </body>
</html>
