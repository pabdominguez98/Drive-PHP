<?php

session_start();

if (empty($_SESSION['ID'])) {
    header("Location: /index.php");
} else {
    if (isset($_GET['boton-editar-archivos'])) {
        $link = mysqli_connect("127.0.0.1", "root", "", "tpdrive");

        $nuevo_nombre = $_GET['modificacion'];

        $extension = $_GET['tipo-archivo'];


        $identificador_actual = $_GET['identificador-actual'];

        $id = $_SESSION['ID'];

        $sql_query_1 = "SELECT `ID` FROM `archivos_locales` WHERE Usuario='" . $id . "' AND Nombre='" . $nuevo_nombre . "'";

        $resultado_1 = mysqli_query($link, $sql_query_1);

        if (mysqli_num_rows($resultado_1) > 0) {
            header("Location: /principal.php?error_carga=444");
        } else {
            $ingreso_validado = str_replace(' ',  '_', $nuevo_nombre);
            $nombre_extension = $nuevo_nombre . "." . $extension;
            $ingreso_validado = $ingreso_validado . "." . $extension;
            $sql_query_2 = "UPDATE `archivos_locales` SET Nombre='" . $nombre_extension . "', Identificador='" . $ingreso_validado . "' WHERE Identificador='" . $identificador_actual . "'";
            if (mysqli_query($link, $sql_query_2)) {
                $ruta_anterior = "directorio/locales/".$id."/".$identificador_actual;
                $ruta_nueva = "directorio/locales/".$id."/".$ingreso_validado;
                rename($ruta_anterior, $ruta_nueva);

                    header("Location: /principal.php?error_carga=482");
            } else {
                header("Location: /principal.php?error_carga=324322");
            }
        }
    }
}
