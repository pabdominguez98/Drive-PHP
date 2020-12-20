<?php
session_start();

if (empty($_SESSION['ID'])) {
    header("Location: /index.php");
} else {

    $id = $_SESSION['ID'];

    $link = mysqli_connect("127.0.0.1", "root", "", "tpdrive");

    $query = "SELECT `Nombre`, `Apellido`, `username`, `Imagen` FROM `usuarios` WHERE ID='" . $id . "'";

    $resultado = mysqli_query($link, $query);

    if (mysqli_num_rows($resultado) > 0) {
        $result = mysqli_fetch_array($resultado);
        $nombre = $result['Nombre'];
        $apellido = $result['Apellido'];
        $email = $result['username'];
        $imagen = $result['Imagen'];
    }

    $archivos_locales = 0;
    $archivos_compartidos = 0;

    $query_2 = "SELECT `ID` FROM `archivos_locales` WHERE Usuario='" . $id . "'";

    $resultado_1 = mysqli_query($link, $query_2);

    $archivos_locales = mysqli_num_rows($resultado_1);

    $query_3 = "SELECT `ID` FROM `archivos_compartidos` WHERE Usuario_compartido='" . $email . "'";

    $resultado_2 = mysqli_query($link, $query_3);

    $archivos_compartidos = mysqli_num_rows($resultado_2);
}


?>


<!doctype html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">


    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">

    <title>Perfil</title>

    <style type="text/css">
        .container {
            -webkit-box-shadow: 10px 0px 45px -6px rgba(0, 0, 0, 0.75);
            -moz-box-shadow: 10px 0px 45px -6px rgba(0, 0, 0, 0.75);
            box-shadow: 10px 0px 45px -6px rgba(0, 0, 0, 0.75);
        }

        .informacion {
            width: max-content;
            height: auto;
            border: 1.5px solid black;
            border-radius: 20px;
        }

        .informacion-columna{
            position: relative;
            margin-top: 50px;
        }
    </style>
</head>

<body>

    <div class="container">
        <div class="row"  class="informacion">
            <div class="col-2"></div>
            <div class="col-8" class="informacion-columna">
                 <h3><?php echo $nombre." ".$apellido; ?></h3>

            </div>
            <div class="col-2"></div>
        </div>
    </div>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous"></script>


</body>

</html>