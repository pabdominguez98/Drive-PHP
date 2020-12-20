<?php

   session_start();

   if(empty($_SESSION['ID'])){
       header("Location: /index.php");
       
   }else{
       if(isset($_GET['boton-editar-archivos'])){
         $link = mysqli_connect("127.0.0.1", "root", "", "tpdrive");
         
         $nuevo_nombre = $_GET['modificacion'];

         $id= $_SESSION['ID'];

         $sql_query_1 = "SELECT `ID` FROM `archivos_locales` WHERE Usuario='".$id."' AND Nombre='".$nuevo_nombre."'";

         $resultado_1 = mysqli_query($link, $sql_query_1);

         if(mysqli_num_rows($resultado_1) > 0){
             header("Location: /principal.php?error_carga=444");
         }else{
             $ingreso_validado = str_replace(' ',  '_', $nuevo_nombre);
             $sql_query_2 = "UPDATE `archivos_locales` SET Nombre='".$nuevo_nombre."', Identificador='".$ingreso_validado."'";
             if(mysqli_query($link, $sql_query_2)){
                 header("Location: /principal.php?error_carga=482");
             }else{
                header("Location: /principal.php?error_carga=324322");
             }
         }

       }
   }
