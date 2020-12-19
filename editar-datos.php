<?php

session_start();

$error_actualizacion = 26;
if (empty($_SESSION['ID'])) {
    header("Location: /index.php");
} else {
    $id = $_SESSION['ID'];
    $foto_perfil = md5($id);
    $nombre = "";
    $apellido = "";
    $clave = "";
    $email = "";

    $error_foto = 50;

    if (isset($_GET['error'])) {
        $error_foto = $_GET['error'];
    }



    $link = mysqli_connect("127.0.0.1", "root", "", "tpdrive");
    $sql_query_1 = "SELECT `Nombre`, `Apellido`, `username`, `Clave`, `Imagen` FROM  `usuarios` WHERE ID='" . $id . "'";

    $resultado = mysqli_query($link, $sql_query_1);

    if (mysqli_num_rows($resultado) > 0) {
        $result = mysqli_fetch_array($resultado);
        $nombre = $result['Nombre'];
        $apellido = $result['Apellido'];
        $clave = $result['Clave'];
        $email = $result['username'];
        $foto_perfil = $result['Imagen'];
        if(strcmp($foto_perfil, "123456.jpg") === 0){
            $direccion_foto_perfil = "directorio/imagenes-perfiles/123456.jpg";
        }else{
            $direccion_foto_perfil = "directorio/imagenes-perfiles/".$id."/". $foto_perfil;
        }
    }

    if (!empty($_POST['submit'])) {

        $email_1 = $_POST['ingreso-email'];
        $nombre_1 = $_POST['ingreso-nombre'];
        $apellido_1 = $_POST['ingreso-apellido'];
        $clave_1 = $_POST['ingreso-clave'];
        $clave_repetida = $_POST['ingreso-repetir-clave'];

        if (strcmp($clave_1, $clave_repetida) === 0) {

            $sql_query_2 = "UPDATE `usuarios` SET Nombre='" . $nombre_1 . "', Apellido= '" . $apellido_1 . "', username= '" . $email_1 . "', Clave='" . $clave_1 . "' WHERE ID='" . $id . "'";

            if (mysqli_query($link, $sql_query_2)) {
                $error_actualizacion = 0;
                $nombre = $nombre_1;
                $apellido = $apellido_1;
                $clave = $clave_1;
                $email = $email_1;
            } else {
                $error_actualizacion = 200; //Error base de datos!
            }
        } else {

            $error_actualizacion = 100; //  error contraseñas no coinciden

        }
    }
}

?>

<!doctype html>

<html>

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">


    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">

    <title>Ingreso</title>


    <style type="text/css">
        .nav_bar {
            position: relative;
            margin-bottom: 30px;
            float: left;
        }

        .formulario-registro {
            position: relative;
            padding: 20px;
            border: 1px solid grey;
            border-radius: 20px;
        }

        .imagen-perfil {
            width: 150px;
            height: 150px;
        }
    </style>
</head>

<body>

    <section>
        <div class="row">
            <nav class="navbar nav_bar navbar-light bg-primary">
                <div class="container-fluid">
                    <a class="navbar-brand" href="/index.php">Regresar al inicio</a>
                </div>
            </nav>
        </div>
    </section>
    <section>
        <div class="container">
            <div class="row">
                <div class="col-3"></div>
                <div class="col-6 formulario-registro">
                    <div class="mb-3">
                        <br>
                        <label for="imagen-perfil">Foto de perfil:</label>
                        <br><br>
                        <img src=<?php echo $direccion_foto_perfil ?> class="card-img-top imagen-perfil" alt="...">
                        <br>
                    </div>
                    <div class="mb-3">

                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
                            Modificar foto de perfil
                        </button>


                        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <form method="post" action="/cambiar-imagen.php" enctype="multipart/form-data">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Modificar foto de perfil</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <input type="file" name="foto">
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                                            <button type="submit" name="boton-perfil" class="btn btn-primary" value="guardar">Guardar</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    <br>
                    <form method="post" enctype="multipart/form-data">

                        <div class="mb-3">
                            <div class="row">
                                <div class="col">
                                    <label for="exampleInputPassword1" class="form-label">Nombre</label>
                                    <input type="text" class="form-control" name="ingreso-nombre" value="<?php echo $nombre; ?>" placeholder="Nombre" aria-label="First name">
                                </div>
                                <div class="col">
                                    <label for="exampleInputPassword1" class="form-label">Apellido</label>
                                    <input type="text" name="ingreso-apellido" value="<?php echo $apellido; ?>" class="form-control" placeholder="Apellido" aria-label="Last name">
                                </div>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="exampleInputPassword1" class="form-label">Email</label>
                            <input type="email" class="form-control" value="<?php echo $email; ?>" name="ingreso-email" id="exampleInputPassword1">
                        </div>
                        <div class="mb-3">
                            <div class="row">
                                <div class="col">
                                    <label for="exampleInputPassword1" class="form-label">Contraseña</label>
                                    <input type="password" value="<?php echo $clave; ?>" class="form-control" name="ingreso-clave" aria-label="First name">
                                </div>
                                <div class="col">
                                    <label for="exampleInputPassword1" class="form-label">Repetir contraseña</label>
                                    <input type="password" class="form-control" name="ingreso-repetir-clave" aria-label="Last name">
                                </div>
                            </div>
                        </div>
                        <div class="mb-3">
                            <?php
                            if ($error_foto == 0 || $error_actualizacion == 0) {
                            ?>
                                <div class="alert alert-success" role="alert">
                                    Informacion actualizada!
                                </div>
                            <?php
                            }
                            ?>
                            <?php
                            if ($error_foto == 100) {
                            ?>
                                <div class="alert alert-danger" role="alert">
                                    Error al cargar el archivo!
                                </div>
                            <?php
                            }
                            ?>
                            <?php
                            if ($error_foto == 200) {
                            ?>
                                <div class="alert alert-danger" role="alert">
                                    Error al al enviar el formulario!
                                </div>
                            <?php
                            }
                            ?>
                            <?php
                            if ($error_foto == 300) {
                            ?>
                                <div class="alert alert-danger" role="alert">
                                    Tipo de archivo no compatible!
                                </div>
                            <?php
                            }
                            ?>

                            <?php
                            if ($error_actualizacion == 100) {
                            ?>
                                <div class="alert alert-danger" role="alert">
                                    Las contraseñas no coinciden!
                                </div>
                            <?php
                            }
                            ?>
                            <?php
                            if ($error_actualizacion == 200) {
                            ?>
                                <div class="alert alert-danger" role="alert">
                                    Error en la base de datos!
                                </div>
                            <?php
                            }
                            ?>


                        </div>

                        <input type="submit" name="submit" class="btn btn-primary" value="Actualizar datos personales"></button>
                    </form>
                </div>
                <div class="col-3"></div>
            </div>
        </div>
    </section>




    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous"></script>

</body>

</html>