<?php

session_start();

if(empty($_SESSION['ID'])){
    header("Location: /index.php");
}else{
    if(isset($_GET['eliminar'])){
        $nombre = $_GET['eliminar'];

        $link = mysqli_connect("127.0.0.1", "root", "", "tpdrive");

        $sql_query = "DELETE FROM `archivos_locales` WHERE Identificador= '".$nombre."'";

        if(mysqli_query($link, $sql_query)){
            header("Location: /principal.php?error_carga=0");
        }

    }else{
        header("Location: /principal.php");
    }
}




?>