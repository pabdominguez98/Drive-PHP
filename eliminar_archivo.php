<?php

session_start();

if(empty($_SESSION['ID'])){
    header("Location: /index.php");
}else{
    $id = $_SESSION['ID'];
    if(isset($_GET['eliminar'])){
        $nombre = $_GET['eliminar'];

        $link = mysqli_connect("127.0.0.1", "root", "", "tpdrive");

        $sql_query = "DELETE FROM `archivos_locales` WHERE Identificador= '".$nombre."' AND Usuario='".$id."'";

        if(mysqli_query($link, $sql_query)){
            unlink("directorio/locales/".$id."/".$nombre);
            $sql_query_2 = "DELETE FROM `archivos_compartidos` WHERE Identificador= '".$nombre."' AND Usuario_local='".$id."'";
             if(mysqli_query($link, $sql_query_2)){
             header("Location: /principal.php?error_carga=0");
             }
        }

    }else{
        header("Location: /principal.php");
    }
}




?>