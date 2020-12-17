<?php

session_start();

if (empty($_SESSION['ID'])) {
    header("Location: /index.php");
} else {
    $id = $_SESSION['ID'];
    $nombre = "";
    $apellido = "";
    $foto_perfil = md5($id);
    $email = "";

    $link = mysqli_connect("127.0.0.1", "root", "", "tpdrive");

    $sql_query_1 = "SELECT `Nombre`, `Apellido`, `username`, `Imagen` FROM `usuarios` WHERE ID='" . $id . "' ";

    $resultado = mysqli_query($link, $sql_query_1);

    if (mysqli_num_rows($resultado) > 0) {
        $result = mysqli_fetch_array($resultado);
        $nombre = $result['Nombre'];
        $apellido = $result['Apellido'];
        $email = $result['username'];
        $foto_perfil = $result['Imagen'];
    }
}

?>

<!doctype html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">

    <title>Drive-Inicio</title>

    <style type="text/css">
        .navbar {
            position: fixed;
            width: 100%;
            z-index: 1;
        }

        .contenido {
            position: relative;
            top: 55px;
        }

        .columna-info {
            position: fixed;
            width: 25%;
            height: auto;
            color: white;
            padding: 30px;
            background-color: #0D6EFD;
        }

        .card-img-top {
            width: 150px;
            height: 150px;
        }

        .card {
            position: relative;
            margin: 30px;
        }

        .informacion {
            font-size: 18px;
        }

        .modificar_datos{
            color: white;
        }
    </style>
</head>

<body>
    <section>
        <div class="row">

            <div class="col-12">
                <nav class="navbar navbar-expand-lg navbar-light bg-primary">
                    <div class="container-fluid">
                        <a class="navbar-brand" href="#">Drive</a>
                        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                            <span class="navbar-toggler-icon"></span>
                        </button>
                        <div class="collapse navbar-collapse" id="navbarSupportedContent">
                            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                                <li class="nav-item">
                                    <a class="nav-link active" aria-current="page" href="#">Home</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link active" aria-current="page" href="/cargar_archivo.php">Subir archivo</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="funciones/logout.php">Cerrar sesion</a>
                                </li>
                            </ul>
                            <form class="d-flex">
                                <input class="form-control me-2" type="search" placeholder="Buscar" aria-label="Search">
                                <button class="btn btn-outline-success" type="submit">Buscar</button>
                            </form>
                        </div>
                    </div>
                </nav>
            </div>
        </div>
    </section>
    <section class="contenido">
        <div>
            <div class="row">
                <div class="col-4">
                    <div class="columna-info">
                        <br><br>
                        <img src="directorio/imagenes-perfiles/<?php echo $foto_perfil ?>" class="card-img-top" alt="...">
                        <br><br>
                        <p class="informacion">Nombre: <?php echo $nombre . " " . $apellido ?></p>
                        <br>
                        <p class="informacion">Email: <?php echo $email ?></p>
                        <br>
                        <p class="informacion">ID: <?php echo $id ?></p>
                        <br>
                        <a class="modificar_datos" href="/editar-datos.php">Modificar datos personales</a>
                    </div>
                </div>
                <div class="col-3">





    </section>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous"></script>


</body>

</html>