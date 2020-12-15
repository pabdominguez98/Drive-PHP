<?php

session_start();

if (!empty($_SESSION['ID'])) {
    header("Location: /principal.php");
}
$estado_login = 0;
if (!empty($_GET['username'])) {
    $username = $_GET['username'];
    $clave = $_GET['password'];


    $link = mysqli_connect("127.0.0.1", "root", "", "tpdrive");

    $sql_query = "SELECT `ID` from `usuarios` WHERE Username='" . $username . "' AND Clave='" . $clave . "'";

    $resultado = mysqli_query($link, $sql_query);

    if (mysqli_num_rows($resultado) > 0) {
        $result = mysqli_fetch_array($resultado);
        $id = $result['ID'];
        $nombre = $result['ID'];
        $_SESSION['ID'] = $id;
        header("Location: /principal.php");
    } else {
        $estado_login++;
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

        .formulario-login {
            position: relative;
            padding: 30px;
            margin-top: 30px;
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
                    <a class="navbar-brand" href="#">Desarrollo de aplicaciones</a>
                </div>
            </nav>
        </div>
    </section>
    <section>
        <div class="container">
            <div class="row">
                <div class="col-4 formulario-login">
                    <form method="get">
                        <div class="row">
                            <div class="mb-3">
                                <label for="formGroupExampleInput" class="form-label">Usuario: </label>
                                <input type="email" class="form-control" id="username" name="username" placeholder="Email">
                            </div>
                            <div class="mb-3">
                                <label for="formGroupExampleInput2" class="form-label">Clave: </label>
                                <input type="password" class="form-control" name="password" id="password" placeholder="Clave">

                            </div>
                            <div class="mb-3">
                                <input type="submit" class="btn-primary" name="submit" value="Ingresar">
                            </div>
                            <?php
                            if ($estado_login != 0) {
                            ?>
                                <div class="mb-3">
                                    <div class="alert alert-danger" role="alert">
                                        Datos incorrectos!
                                    </div>
                                </div>
                            <?php
                            }
                            ?>

                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>




    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous"></script>


</body>

</html>