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
    $direccion_foto_perfil = "directorio/imagenes-perfiles/123456.jpg";
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
            height: 2000px;
            color: white;
            padding: 30px;
            background-color: #0D6EFD;
            
        }

        .card-img-top {
            width: 150px;
            height: 150px;
            position: relative;
            
        }
        .card-img-top-col {
            margin-left:45px;
            position: relative;
            border: 2px solid grey;
            border-radius: 25%;
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
        .nombre-columna{
            position: relative;
            margin-left: 20px;
            font-size: 30px;
            top: 25px;
        }
        .nombre-columna a{
            color:white;
        }
    </style>
</head>

<body>
    <section>
        <div class="row">

            <div class="col-12">
                <nav class="navbar navbar-expand-lg navbar-light bg-primary">
                    <div class="container-fluid">
                        <a class="navbar-brand" href="/principal.php">Inicio</a>
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
                                <li class="nav-item dropdown">
                                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                        Dropdown
                                    </a>
                                    <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                                        <li><a class="dropdown-item" href="principal.php">Archivos locales</a></li>
                                        <li><a class="dropdown-item" href="principal-compartidos.php">Archivos Compartidos</a></li>
                                        <li>
                                            <hr class="dropdown-divider">
                                        </li>
                                        <li><a class="dropdown-item" href="funciones/logout.php">Cerrar sesion</a></li>
                                    </ul>
                                </li>
                            </ul>
                            <form class="d-flex">
                                <h3>Archivos Compartidos</h3>
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
                    <img src=<?php echo $direccion_foto_perfil ?> class="card-img-top card-img-top-col" alt="...">
                    <br><br>
                    <p class="informacion nombre-columna"><a href="/perfil.php"><?php echo $nombre . " " . $apellido ?></a></p>
                    <br>
                    
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
                $sql_query_2 = "SELECT `Usuario_local`, `Nombre`,`Tipo` , `Tamaño`,`Fecha`, `Identificador` FROM `archivos_compartidos` WHERE Usuario_compartido= '" . $email . "'";
                $resultado_2 = mysqli_query($link, $sql_query_2);
                while ($result = mysqli_fetch_array($resultado_2)) {

                    $nombre_archivo = $result['Nombre'];
                    $tam_archivo = $result['Tamaño'];
                    $usuario_local = $result['Usuario_local'];
                    $tipo_archivo = $result['Tipo'];
                    $identificador_archivo = $result['Identificador'];
                    $fecha_archivo = $result['Fecha'];


                    $sql_query_4 = "SELECT `Nombre`, `Apellido` FROM `usuarios` WHERE ID='" . $usuario_local . "'";

                    $resultado_4 = mysqli_query($link, $sql_query_4);

                    if (mysqli_num_rows($resultado_4) > 0) {
                        $result_4 = mysqli_fetch_array($resultado_4);
                        $nombre_usuario_titular = $result_4['Nombre'];
                        $apellido_usuario_titular = $result_4['Apellido'];
                        $nombre_completo_titular = $nombre_usuario_titular . " " . $apellido_usuario_titular;
                    }

                    $direccion = "/directorio/locales/" . $usuario_local . "/" . $identificador_archivo;
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
                            <h5 class="card-text"><?php echo $nombre_archivo; ?></h5>
                            <span class="card-text">Tipo: <?php echo $tipo_archivo; ?></span>
                            <br>
                            <span class="card-text">Tamaño: <?php echo $tam_archivo; ?></span>
                            <br>
                            <span class="card-text">Titular: <?php echo $nombre_completo_titular; ?></span>
                            <br>
                            <span>Fecha: <?php echo $fecha_archivo; ?></span>
                            <br>
                            <br>

                                <div class="col-4">
                                    <form action="<?php echo $direccion; ?>" target="_blank">
                                        <button type="submit" class="btn btn-primary">
                                            Descargar
                                        </button>

                                    </form>
                                    <div class="col-8">


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