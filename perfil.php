<?php
session_start();

if (empty($_SESSION['ID'])) {
    header("Location: /index.php");
} else {

    $id = $_SESSION['ID'];
    $pagina_actual = "Perfil";
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

    $direccion_imagen = "directorio/imagenes-perfiles/123456.jpg";

    if (strcmp($imagen, "123456.jpg") !== 0) {
        $direccion_imagen = "directorio/imagenes-perfiles/" . $id . "/" . $imagen;
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

        .formulario {
            width: 100%;
            height: 1000px;
            border: 1.5px solid grey;
            position: relative;
            margin-top: 40px;
            border-radius: 30px;
        }

        .informacion-usuario {
            position: relative;
            margin-top: 70px;
        }

        .informacion-usuario p {
            font-size: 25px;
        }

        .imagen-de-perfil {
            width: 150px;
            height: 150px;
            border: 2px solid black;
            position: relative;
            border-radius: 18%;
            margin-top: 40px;
            margin-left: 40px;
        }
    </style>
</head>

<body>

    
        <section>
            <?php include 'navbar.php'; ?>
        </section>
        <section>
            <div class="row">
                <div class="col-2"></div>
                <div class="col-8">
                    <div class="formulario">
                        <div class="row">
                            <div class="col-4"></div>
                            <div class="col-4">
                                <div class="foto-perfil">
                                    <img src="<?php echo $direccion_imagen; ?>" class="imagen-de-perfil">
                                </div>
                            </div>
                            <div class="col-4"></div>
                        </div>
                        <div class="row">
                            <div class="col-2"></div>
                            <div class="col-6 informacion-usuario">
                                <p>Nombre: <?php echo $nombre . " " . $apellido; ?></p>
                                <p>Email: <?php echo $email; ?></p>
                                <p>Archivos cargados: <?php echo $archivos_locales ?></p>
                                <p>Archivos compartidos: <?php echo $archivos_compartidos; ?></p>
                                 <form action="editar-datos.php">
                                     <button type="submit" class="btn-primary">Editar datos</button>
                                 </form>
                            </div>
                            <div class="col-4"></div>
                        </div>
                    </div>
                </div>
                <div class="col-2"></div>
            </div>
        </section>
  


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous"></script>


</body>

</html>