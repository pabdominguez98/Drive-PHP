<?php
session_start();

if (empty($_SESSION['ID'])) {
    header("Location: /principal.php");
} else {
    $id = $_SESSION['ID'];
    $archivo_cargado = 0;
    if (isset($_POST['submit'])) {

        $error = 0;
        $file = $_FILES['file'];
        $file_name = $_FILES['file']['name'];
        $file_size = $_FILES['file']['size'];
        $file_type = $_FILES['file']['type'];
        $fileTmpName = $_FILES['file']['tmp_name'];

        $fileExt = explode('.', $file_name);
        $file_size = $file_size / 1000;
        $file_size = $file_size . ".KB";
        $file_ext_actual = strtolower(end($fileExt));
        $identificador = str_replace(' ', '_', $file_name);

        $path = "directorio/locales/" . $id;
        if (!is_dir($path)) {
            mkdir($path, 0777, true);
        }

        if (!$link = mysqli_connect("127.0.0.1", "root", "", "tpdrive")) { // proximo a actualizar para poder agragar un include
            $archivo_cargado = 100;
        } else {
            $sql_query_2 = "SELECT `ID` FROM `archivos_locales` WHERE Usuario ='" . $id . "' AND Identificador='" . $identificador . "'";

            $resultado_1 = mysqli_query($link, $sql_query_2);

            $datos_fecha = getdate();

            $dia_actual = $datos_fecha['mday'];
            $mes_actual = $datos_fecha['mon'];
            $año_actual = $datos_fecha['year'];

            $fecha_actual = $dia_actual."/".$mes_actual."/".$año_actual;

            if (mysqli_num_rows($resultado_1) == 0) {

                $sql_query_1 = "INSERT INTO `archivos_locales` (`Usuario`, `Nombre`, `Tamaño`, `Tipo`, `Fecha`, `Identificador`) 
        VALUES ('" . $id . "', '" . $file_name . "', '" . $file_size . "', '" . $file_ext_actual . "','".$fecha_actual."', '" . $identificador . "')";

                if (mysqli_query($link, $sql_query_1)) {
                    $carpeta_destino = "directorio/locales/" . $id . "/" . $identificador;
                    move_uploaded_file($fileTmpName, $carpeta_destino);
                    $archivo_cargado = 20; // codigo que indica que el archivo se cargo bien
                } else {
                    $archivo_cargado = 100; //error que indica problemas en la conexion a la base de datos
                }
            }else{
                $archivo_cargado = 505;  //error que indica que ya existe el archivo cargado
            }
        }
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
                    <a class="navbar-brand" href="/principal.php">Regresar a la pagina principal</a>
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
                            <input type="file" name="file">
                        </div>
                        <div class="mb-3"></div>
                        <div class="mb-3">
                            <label for="exampleFormControlInput1" class="form-label">Descripcion:</label>
                            <input type="text" class="form-control" id="exampleFormControlInput1" placeholder="Descripcion">
                        </div>
                        <div class="mb-3">
                            <?php
                            if ($archivo_cargado == 20) {
                            ?>
                                <div class="alert alert-success" role="alert">
                                    Archivo cargado correctamente!
                                </div>
                            <?php
                            }
                            ?>
                            <?php
                            if ($archivo_cargado == 100) {
                            ?>
                                <div class="alert alert-danger" role="alert">
                                    Error al cargar archivo!
                                </div>
                            <?php
                            }
                            ?>
                            <?php
                            if ($archivo_cargado == 505) {
                            ?>
                                <div class="alert alert-danger" role="alert">
                                    Ya existe el archivo que intentas cargar!
                                </div>
                            <?php
                            }
                            ?>
                        </div>
                        <button type="submit" name="submit" class="btn btn-primary">Subir</button>
                    </form>
                </div>
                <div class="col-3"></div>
            </div>
        </div>
    </section>




    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous"></script>


</body>

</html>