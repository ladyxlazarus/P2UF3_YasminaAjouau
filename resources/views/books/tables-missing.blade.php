<!DOCTYPE html>
<html>
    <head>
        <title>BAD REQUEST</title>
        <!-- Incluimos los estilos de Bootstrap -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    </head>
    <body class="bg-light">
        <div class="container">
            <div class="row justify-content-center mt-5">
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-header bg-danger text-white">
                            <h1 class="text-center">No hay datos disponibles</h1>
                        </div>
                        <div class="card-body">
                            <p class="lead text-center">La base de datos aún no contiene ninguna tabla ni registro</p>
                            <p class="text-center">Ejecuta en la terminal de tu proyecto <code>php artisan migrate --seed</code> para cargar la información.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Incluimos los scripts de Bootstrap -->
        <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
    </body>
</html>
