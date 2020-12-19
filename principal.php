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

        if (strcmp($foto_perfil, "123456.jpg") === 0) {
            $direccion_foto_perfil = "directorio/imagenes-perfiles/123456.jpg";
        } else {
            $direccion_foto_perfil = "directorio/imagenes-perfiles/" . $id . "/" . $foto_perfil;
        }
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

        .modificar_datos {
            color: white;
        }

        .alerta-eliminado {
            position: relative;
            top: 30px;
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

        <div class="row">
            <div class="col-4">
                <div class="columna-info">
                    <br><br>
                    <img src=<?php echo $direccion_foto_perfil ?> class="card-img-top" alt="...">
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

                <?php
                if (isset($_GET['error_carga'])) {
                    if ($_GET['error_carga'] == "0") {

                ?>
                        <div class="alert alert-success alerta-eliminado" role="alert">
                            Archivo eliminado correctamente
                        </div>

                <?php
                    }
                }
                ?>

                <?php
                $sql_query_2 = "SELECT `ID`, `Nombre`, `Tipo`, `Tamaño`, `Identificador` FROM `archivos_locales`";
                $resultado_2 = mysqli_query($link, $sql_query_2);
                while ($result = mysqli_fetch_array($resultado_2)) {

                    $nombre_archivo = $result['Nombre'];
                    $tam_archivo = $result['Tamaño'];
                    $tipo_archivo = $result['Tipo'];
                    $id_archivo = $result['ID'];
                    $identificador_archivo = $result['Identificador'];

                    $direccion = "/directorio/locales/" . $id . "/" . $identificador_archivo;
                ?>
                    <div class="card" style="width: 18rem;">

                        <?php if ($tipo_archivo == "doc" || $tipo_archivo == "docx") { ?>
                            <img src="imagenes/imagen-word.png" class="card-img-top" alt="...">
                        <?php
                        } else if ($tipo_archivo == "png" || $tipo_archivo == "jpg" || $tipo_archivo == "jpeg") {
                        ?>
                            <img src="imagenes/imagen-imagen.png" class="card-img-top" alt="...">
                        <?php } else { ?>

                            <img src="imagenes/icono-archivos.png" class="card-img-top" alt="...">
                        <?php } ?>

                        <div class="card-body">
                            <p class="card-text"><?php echo $nombre_archivo; ?></p>
                            <p class="card-text">Tipo: <?php echo $tipo_archivo; ?></p>
                            <p class="card-text">Tamaño: <?php echo $tam_archivo; ?></p>
                            <p><a target="_BLANK" target="_BLANK" href=<?php echo $direccion; ?>>Descargar</a></p>
                            <div class="row">
                                <div class="col-4">
                                    <!-- Button trigger modal -->
                                    <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#exampleModal">
                                        Eliminar
                                    </button>

                                    <!-- Modal -->
                                    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">Confirmacion</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <p>Estas seguro que queres eliminar el archivo <?php echo $nombre_archivo; ?></p>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                                                    <form action="eliminar_archivo.php" method="get">
                                                        <button type="submit" name="eliminar" class="btn btn-primary" value=<?php echo $identificador_archivo ?>>Confirmar</button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-8">

                                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modal-share">
                                        Compartir
                                    </button>


                                    <div class="modal fade" id="modal-share" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">Compartir con otro usuario</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <form action="compartir-archivo.php" method="get">
                                                    <div class="modal-body">

                                                        <div class="row">
                                                            <div class="col-1"></div>
                                                            <div class="col-8">
                                                                <input type="hidden" name="nombre_archivo_comp" value=<?php echo $nombre_archivo; ?>>
                                                                <input type="hidden" name="identificador_archivo_comp" value=<?php echo $identificador_archivo; ?>>
                                                                <input type="hidden" name="peso_archivo_comp" value=<?php echo $tam_archivo; ?>>
                                                                <label for="ingreso-usuario">Compartir con:</label>
                                                                <br>
                                                                <input id="ingreso-usuario" type="text" name="usuario_archivo_comp" placeholder="Usuario" class="form-control">
                                                            </div>
                                                            <div class="col-3"></div>
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                                                        <button type="submit" name="submit_comp" class="btn btn-primary">Compartir</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>



                <?php
                }
                ?>




            </div>

        </div>





    </section>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous"></script>


</body>

</html>