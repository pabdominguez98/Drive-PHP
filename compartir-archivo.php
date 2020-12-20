<?php

session_start();
if (empty($_SESSION['ID'])) {
    header("Location: /index.php");
} else {
    $id = $_SESSION['ID'];
    if (isset($_GET['submit_comp'])) {

        $nombre_archivo = $_GET['nombre_archivo_comp'];
        $identificador_archivo = $_GET['identificador_archivo_comp'];
        $usuario = $_GET['usuario_archivo_comp'];
        $peso_archivo = $_GET['peso_archivo_comp'];
        $tipo_archivo = $_GET['tipo_archivo_comp'];
        $fecha_archivo = $_GET['fecha_archivo_comp'];

        if (!empty($usuario)) {
            $link = mysqli_connect("127.0.0.1", "root", "", "tpdrive");

            $sql_query_1 = "SELECT `ID` from `usuarios` WHERE username='" . $usuario . "'";

            $resultado_1 = mysqli_query($link, $sql_query_1);

            if (mysqli_num_rows($resultado_1) > 0) {

                $sql_query_2 = "SELECT `ID` FROM `archivos_compartidos` WHERE Usuario_compartido='" . $usuario . "' AND Identificador='" . $identificador_archivo . "'";

                $resultado_2 = mysqli_query($link, $sql_query_2);

                if (mysqli_num_rows($resultado_2) == 0) {

                    $sql_query_3 = "INSERT INTO `archivos_compartidos` (`Usuario_local`, `Usuario_compartido`, `Nombre`,`Tipo` ,`Tamaño`,`Fecha` , `Identificador`)
               VALUES ('" . $id . "', '" . $usuario . "', '" . $nombre_archivo . "','".$tipo_archivo."' ,'" . $peso_archivo . "','".$fecha_archivo."' , '" . $identificador_archivo . "')";

                    if (mysqli_query($link, $sql_query_3)) {
                        header("Location: /principal.php?error_carga=60"); // archivo compartido con exito
                    } else {
                        header("Location= /principal.php?error_carga=55");  // mismo codigo de error general
                    }
                } else {
                    header("Location: /principal.php?error_carga=58");  //error que devuelve si el usuario ya tiene el archivo
                }
            } else {
                header("Location: /principal.php?error_carga=57");   //error que devuelve si no existe el usuario que se quiere compartir el archivo
            }
        } else {
            header("Location= /principal.php?error_carga=56");    //devuelve error de usuario no ingresado
        }
    } else {
        header("Location= /principal.php?error_carga=55");   //devuelve error de variables (Gral) le metes error de carga
    }
}
