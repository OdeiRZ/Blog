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
                    <h2>Nueva Entrada</h2>
                    <p>
                        <a class="btn btn-default" href="<?php echo BASE_URL; ?>admin/listar-entradas">Volver</a>
                    </p>
                    <?php
                        if (isset($result) && $result) {
                            echo '<div class="alert alert-success">Entrada Guardada</div>';
                        }
                    ?>
                    <form method="post">
                        <div class="form-group">
                            <label for="inputTitulo">Titulo</label>
                            <input class="form-control" type="text" name="titulo" id="inputTitulo">
                        </div>
                        <textarea class="form-control" name="contenido" id="inputContenido" rows="5"></textarea>
                        <br>
                        <input class="btn btn btn-primary" type="submit" value="Guardar">
                    </form>
                </div>
                <div class="col-md-4">
                    Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.                             Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.
                </div>
            </div>
            <div class="row">
                <div class = "col-md-12">
                    <footer>
                        Pie de ejemplo<br>
                        <a href="<?php echo BASE_URL; ?>admin">Panel Admin.</a>
                    </footer>
                </div>
            </div>
        </div>
    </body>
</html>
