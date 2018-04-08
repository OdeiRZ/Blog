<?php

include_once '../config.php';
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
                <h1>Titulo Blog</h1>
            </div>
            <div class="row">
                <div class="col-md-8">
                    <h2>Listado Entradas</h2>
                    <a class="btn btn-primary" href="insertar-entrada.php">Nueva Entrada</a>
                    <table class="table">
                        <tr>
                            <th>Titulo</th>
                            <th>Editar</th>
                            <th>Borrar</th>
                        </tr>
                        <?php
                        foreach($entradasBlog as $entrada) {
                            echo '<tr>';
                            echo '<td>' . $entrada['titulo'] . '</td>';
                            echo '<td>Editar</td>';
                            echo '<td>Borrar</td>';
                            echo '</tr>';
                        }
                        ?>
                    </table>
                </div>
                <div class="col-md-4">
                    Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.                             Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.
                </div>
            </div>
            <div class="row">
                <div class = "col-md-12">
                    <footer>
                        Pie de ejemplo<br>
                        <a href="index.php">Panel Admin.</a>
                    </footer>
                </div>
            </div>
        </div>
    </body>
</html>
