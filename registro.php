<?php
session_start();
$error = 0;
if (!empty($_SESSION['ID'])) {
    header("Location: /principal.php");
} else {
    if (!empty($_POST['ingreso-nombre'])) {
        $nombre = $_POST['ingreso-nombre'];
        $apellido = $_POST['ingreso-apellido'];
        $email = $_POST['ingreso-email'];
        $contraseña = $_POST['ingreso-clave'];
        $contraseña_repetida = $_POST['ingreso-repetir-clave'];
        $validador = 0;
        $error = 0;
        if (empty($nombre)) {
            $validador++;
        }
        if (empty($apellido)) {
            $validador++;
        }
        if (empty($email)) {
            $validador++;
        }
        if (empty($contraseña)) {
            $validador++;
        }
        if (empty($contraseña_repetida)) {
            $validador++;
        }
        if ($validador == 0) {
            if (strcmp($contraseña, $contraseña_repetida) === 0) {


                $link = mysqli_connect("127.0.0.1", "root", "", "tpdrive");



                $nombre_val = mysqli_real_escape_string($link, $nombre);
                $apellido_val = mysqli_real_escape_string($link, $apellido);
                $email_val = mysqli_real_escape_string($link, $email);
                $clave_val = mysqli_real_escape_string($link, $contraseña);
                $imagen_random = "123456.jpg";
                $sql_query_1 = "SELECT `ID` FROM `usuarios` WHERE Username='" . $email_val . "'";

                $resultado = mysqli_query($link, $sql_query_1);

                if (mysqli_num_rows($resultado) > 0) {
                    $error = 400;   //codigo de error de usuario existente
                } else {

                  $sql_query = "INSERT INTO `usuarios` (`username`, `Nombre`, `Apellido`, `Clave`, `Imagen`) 
                   VALUES ('" . $email_val . "', '" . $nombre_val . "', '" . $apellido_val . "', '" . $clave_val . "', '".$imagen_random."')";


                    if (!mysqli_query($link, $sql_query)) {
                        $error = 300;   //error si falla la carga a base de datos

                    } else {
                        $error = 0;
                        header("Location: /index.php");
                    }
                }
            } else {
                $error = 200;   //codigo de error de contraseñas no coinciden

            }
        } else {
            $error = 100;   // codigo de error de datos incompletos

        }
    } else {
        $error = 50; // codigo de error de datos incompletos
    }
}

?>
<html lang="en">

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
                    <form method="post" enctype="multipart/form-data">
                        <div class="mb-3">
                            <div class="row">
                                <div class="col">
                                    <label for="exampleInputPassword1" class="form-label">Nombre</label>
                                    <input type="text" class="form-control" name="ingreso-nombre" placeholder="Nombre" aria-label="First name">
                                </div>
                                <div class="col">
                                    <label for="exampleInputPassword1" class="form-label">Apellido</label>
                                    <input type="text" name="ingreso-apellido" class="form-control" placeholder="Apellido" aria-label="Last name">
                                </div>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="exampleInputPassword1" class="form-label">Email</label>
                            <input type="email" class="form-control" name="ingreso-email" id="exampleInputPassword1">
                        </div>
                        <div class="mb-3">
                            <div class="row">
                                <div class="col">
                                    <label for="exampleInputPassword1" class="form-label">Contraseña</label>
                                    <input type="password" class="form-control" name="ingreso-clave" aria-label="First name">
                                </div>
                                <div class="col">
                                    <label for="exampleInputPassword1" class="form-label">Repetir contraseña</label>
                                    <input type="password" class="form-control" name="ingreso-repetir-clave" aria-label="Last name">
                                </div>
                            </div>
                        </div>
                        <div class="mb-3">

                            <?php
                            if ($error == 100) {
                            ?>

                                <div class="alert alert-danger" role="alert">
                                    Datos incompletos!
                                </div>

                            <?php
                            }
                            ?>

                            <?php
                            if ($error == 200) {
                            ?>

                                <div class="alert alert-danger" role="alert">
                                    Las contraseñas no coinciden!
                                </div>

                            <?php
                            }
                            ?>
                            
                            <?php
                            if ($error == 300) {
                            ?>
                                <div class="alert alert-danger" role="alert">
                                    Error de conexion!
                                </div>
                            <?php
                            }
                            ?>
                            <?php
                            if ($error == 400) {
                            ?>
                                <div class="alert alert-danger" role="alert">
                                    El usuario ya existe!
                                </div>
                            <?php
                            }
                            ?>
                        </div>
                        <button type="submit" class="btn btn-primary">Registrarse</button>
                    </form>
                </div>
                <div class="col-3"></div>
            </div>
        </div>
    </section>




    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous"></script>


</body>

</html>