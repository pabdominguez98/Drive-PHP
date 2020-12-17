<?php

session_start();

if (empty($_SESSION['ID'])) {

    header("Location: /index.php");
} else {
    $id = $_SESSION['ID'];
    if (!empty($_POST['boton-perfil'])) {
        if (!empty($_FILES['foto'])) {
            $file = $_FILES['foto'];
            $file_type = $_FILES['foto']['type'];
            $fileTmpName = $_FILES['foto']['tmp_name'];


            $link = mysqli_connect("127.0.0.1", "root", "", "tpdrive");

            $sql_query_1 = "SELECT `Imagen` FROM `usuarios` WHERE ID='" . $id . "'";

            $resultado = mysqli_query($link, $sql_query_1);

            if (mysqli_num_rows($resultado) > 0) {
                $result = mysqli_fetch_array($resultado);
                $imagen_actual = $result['Imagen'];
            }

            if (strlen($imagen_actual) > 8) {   //strlen mide la cantidad de caracteres
                try {
                    unlink("directorio/imagenes-perfiles/" . md5($id));
                } catch (Exception $e) {
                }
            }

            $codigo_foto = md5($id);
            $random_name = $codigo_foto;
            $nombre_foto = "";
            $validador = 0;
            

            $foto = $_FILES['foto'];

            if ($foto['type'] == 'image/jpg') {
                $nombre_foto = $random_name . '.jpg';
                $validador++;
            } else if ($foto['type'] == 'image/png') {
                $nombre_foto = $random_name . '.png';
                $validador++;
            } else if ($foto['type'] == 'image/PNG') {
                $nombre_foto = $random_name . '.PNG';
                $validador++;
            } else if ($foto['type'] == 'image/JPG') {
                $nombre_foto = $random_name . '.JPG';
                $validador++;
            } else if ($foto['type'] == 'image/jpeg') {
                $nombre_foto = $random_name . '.jpeg';
                $validador++;
            } else if ($foto['type'] == 'image/gif') {
                $nombre_foto = $random_name . '.gif';
                $validador++;
            } else if ($foto['type'] == 'image/GIF') {
                $nombre_foto = $random_name . '.GIF';
                $validador++;
            }

            if ($validador != 0) {
                $sql_query_2 = "UPDATE `usuarios` SET Imagen='" . $nombre_foto . "' WHERE ID='" . $id . "'";

                if (mysqli_query($link, $sql_query_2)) {
                    $cartel = "Cargando cambios";
                    $ruta = "directorio/imagenes-perfiles/$nombre_foto";
                    move_uploaded_file($fileTmpName, $ruta);
                    header("Location: /editar-datos.php?error=0");
                }
            }else{
                header("Location: /editar-datos.php?error=300");  //error que indica que el tipo de archov no es compatible
            }
        } else {
            header("Location: /editar-datos.php?error=100"); //error que indica que no se cargo bien el archivo temporal de la foto de perfil
        }
    } else {
        header("Location: /editar-datos.php?error=200"); // error que indica que no se envio bien el formulario

    }
}

?>

<html>

<body>
    <h1><?php echo $cartel ?></h1>
</body>

</html>