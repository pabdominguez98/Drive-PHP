<?php
 session_start();
 if(!empty($_SESSION['ID'])){
     session_destroy();
     header("Location: /index.php");
 }else{
     header("Location: /index.php");
 }


 ?>
