<?php

session_start();

if (empty($_SESSION['ID'])) {
  header("Location: /index.php");
} else {
  $id = $_SESSION['ID'];
  $nombre = "";
  $apellido = "";
  $foto_perfil = md5($id);
  $email = "";

  $link = mysqli_connect("127.0.0.1", "root", "", "tpdrive");

  $sql_query_1 = "SELECT `Nombre`, `Apellido`, `username`, `Rol`, `Imagen` FROM `usuarios` WHERE ID='" . $id . "' ";

  $resultado = mysqli_query($link, $sql_query_1);

  if (mysqli_num_rows($resultado) > 0) {
    $result = mysqli_fetch_array($resultado);
    $nombre = $result['Nombre'];
    $apellido = $result['Apellido'];
    $email = $result['username'];
    $foto_perfil = $result['Imagen'];
    $rol_usuario = $result['Rol'];
    if ($rol_usuario != "Admin") {
      header("Location: /principal.php");
    }
    if (strcmp($foto_perfil, "123456.jpg") === 0) {
      $direccion_foto_perfil = "directorio/imagenes-perfiles/123456.jpg";
    } else {
      $direccion_foto_perfil = "directorio/imagenes-perfiles/" . $id . "/" . $foto_perfil;
    }
  }
}

?>

<!doctype html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">

  <title>Drive-Inicio</title>

  <style type="text/css">
    .navbar {
      position: fixed;
      width: 100%;
      z-index: 1;
    }

    .contenido {
      position: relative;
      top: 55px;
    }

    .columna-info {
      position: fixed;
      width: 25%;
      height: 2000px;
      color: white;
      padding: 30px;
      background-color: #0D6EFD;
    }

    .card-img-top {
      width: 150px;
      height: 150px;
    }

    .card-img-top-col {
      margin-left: 45px;
      position: relative;
      border: 2px solid grey;
      border-radius: 25%;
    }

    .card {
      position: relative;
      margin: 30px;
      width: 320px;
    }

    .informacion {
      font-size: 18px;
    }

    .modificar_datos {
      color: white;
    }

    .alerta-eliminado {
      position: relative;
      top: 30px;
    }

    .nombre-columna {
      position: relative;
      margin-left: 20px;
      font-size: 30px;
      top: 25px;
    }

    .nombre-columna a {
      color: white;
    }
  </style>
</head>

<body>
  <section>
    <div class="row">

      <div class="col-12">
        <nav class="navbar navbar-expand-lg navbar-light bg-primary">
          <div class="container-fluid">
            <a class="navbar-brand" href="#">Drive</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
              <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
              <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                  <a class="nav-link active" aria-current="page" href="#">Home</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link active" aria-current="page" href="/cargar_archivo.php">Subir archivo</a>
                </li>
                <li class="nav-item dropdown">
                  <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                    Dropdown
                  </a>
                  <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                    <li><a class="dropdown-item" href="principal.php">Archivos locales</a></li>
                    <li><a class="dropdown-item" href="principal-compartidos.php">Archivos Compartidos</a></li>

                    <?php
                    if ($rol_usuario == "Admin") {
                    ?>
                      <li><a class="dropdown-item" href="principal.php">Mis archivos</a></li>
                    <?php
                    }
                    ?>

                    <li>
                      <hr class="dropdown-divider">
                    </li>
                    <li><a class="dropdown-item" href="funciones/logout.php">Cerrar sesion</a></li>
                  </ul>
                </li>

              </ul>
              <form class="d-flex">
                <h3>Archivos locales</h3>
              </form>
            </div>
          </div>
        </nav>
      </div>
    </div>
  </section>
  <section class="contenido">

    <div class="row">
      <div class="col-4">
        <div class="columna-info">
          <br><br>
          <img src=<?php echo $direccion_foto_perfil ?> class="card-img-top card-img-top-col" alt="...">
          <br><br>
          <p class="informacion nombre-columna"><a href="/perfil.php"><?php echo $nombre . " " . $apellido ?></a></p>
          <br>
        </div>
      </div>
      <div class="col-4">

        <?php
        if (isset($_GET['error_carga'])) {
          if ($_GET['error_carga'] == "0") {

        ?>
            <div class="alert alert-success alerta-eliminado" role="alert">
              Archivo eliminado correctamente
            </div>

        <?php
          }
        }
        ?>
        <?php
        if (isset($_GET['error_carga'])) {
          if ($_GET['error_carga'] == "57") {

        ?>
            <div class="alert alert-danger alerta-eliminado" role="alert">
              El usuario con el que queres compartir no existe!
            </div>

        <?php
          }
        }
        ?>

        <?php
        if (isset($_GET['error_carga'])) {
          if ($_GET['error_carga'] == "60") {

        ?>
            <div class="alert alert-success alerta-eliminado" role="alert">
              Archivo compartido correctamente
            </div>

        <?php
          }
        }
        ?>



        <?php
        $sql_query_2 = "SELECT `ID`, `Usuario`, `Nombre`, `Tipo`, `Tamaño`,`Fecha` ,`Identificador` FROM `archivos_locales`";
        $resultado_2 = mysqli_query($link, $sql_query_2);
        while ($result = mysqli_fetch_array($resultado_2)) {

          $nombre_archivo = $result['Nombre'];
          $tam_archivo = $result['Tamaño'];
          $tipo_archivo = $result['Tipo'];
          $id_archivo = $result['ID'];
          $fecha_archivo = $result['Fecha'];
          $identificador_archivo = $result['Identificador'];
          $id_identificador_usuario = $result['Usuario'];
          $identificador_modal = str_replace('.', '', $identificador_archivo);

          $sql_query_mil = "SELECT `Username` FROM `usuarios` WHERE ID='".$id_identificador_usuario."'";

          $resultado_mil = mysqli_query($link, $sql_query_mil);

          if(mysqli_num_rows($resultado_mil)>0){
            $result_mil = mysqli_fetch_array($resultado_mil);
            $nombre_dueño_archivo = $result_mil['Username'];
          }

          $direccion = "/directorio/locales/" . $id . "/" . $identificador_archivo;
        ?>
          <div class="card">

            <?php if ($tipo_archivo == "doc" || $tipo_archivo == "docx") { ?>
              <img src="imagenes/imagen-word.png" class="card-img-top" alt="...">
            <?php
            } else if ($tipo_archivo == "png" || $tipo_archivo == "jpg" || $tipo_archivo == "jpeg") {
            ?>
              <img src="imagenes/imagen-imagen.png" class="card-img-top" alt="...">
            <?php } else { ?>

              <img src="imagenes/icono-archivos.png" class="card-img-top" alt="...">
            <?php } ?>

            <div class="card-body">
              <p class="card-text"><?php echo $nombre_archivo; ?></p>
              <p class="card-text">Tipo: <?php echo $tipo_archivo; ?></p>
              <p class="card-text">Tamaño: <?php echo $tam_archivo; ?></p>


              <span>Fecha: <?php echo $fecha_archivo; ?></span>
              <br>
             
              <span>Usuario: <?php echo $nombre_dueño_archivo; ?></span>
              <br>
              <p><a target="_BLANK" target="_BLANK" href=<?php echo $direccion; ?>>Descargar</a></p>
              <div class="row">
                <div class="col-4">



                  <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#modal-eliminar-<?php echo $identificador_modal; ?>">
                    Eliminar
                  </button>


                  <div class="modal fade" id="modal-eliminar-<?php echo $identificador_modal; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h5 class="modal-title" id="exampleModalLabel">Eliminar (<?php echo $nombre_archivo; ?>)</h5>
                          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                          <p>Estas seguro que queres eliminar el archivo <?php echo $nombre_archivo; ?></p>
                        </div>
                        <div class="modal-footer">
                          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                          <form action="eliminar_archivo.php" method="get">
                            <button type="submit" name="eliminar" class="btn btn-primary" value=<?php echo $identificador_archivo ?>>Confirmar</button>
                          </form>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="col-8">

                  <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modal_editar-<?php echo $identificador_modal; ?>">
                    Editar
                  </button>


                  <div class="modal fade" id="modal_editar-<?php echo $identificador_modal; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h5 class="modal-title" id="exampleModalLabel">Editar archivo (<?php echo $nombre_archivo; ?>)</h5>
                          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <form action="editar_archivo.php" method="get">
                          <div class="modal-body">

                            <div class="col">
                              <input type="hidden" name="identificador-actual" value="<?php echo $identificador_archivo ?>">
                              <input type="hidden" name="tipo-archivo" value="<?php echo $tipo_archivo; ?>">
                              <label for="exampleInputPassword1" class="form-label">Nuevo nombre:</label>
                              <input type="text" class="form-control" name="modificacion" placeholder="Nombre" aria-label="First name">
                            </div>

                          </div>
                          <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                            <button type="submit" name="boton-editar-archivos" class="btn btn-primary">Guardar</button>
                          </div>
                        </form>
                      </div>
                    </div>
                  </div>

                  <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modal-compartir-<?php echo $identificador_modal; ?>">
                    Compartir
                  </button>


                  <div class="modal fade" id="modal-compartir-<?php echo $identificador_modal; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h5 class="modal-title" id="exampleModalLabel">Compartir (<?php echo $nombre_archivo; ?>)</h5>
                          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <form action="compartir-archivo.php" method="get">
                          <div class="modal-body">

                            <div class="row">
                              <div class="col-1"></div>
                              <div class="col-8">
                                <input type="hidden" name="fecha_archivo_comp" value="<?php echo $fecha_archivo; ?>">
                                <input type="hidden" name="tipo_archivo_comp" value=<?php echo $tipo_archivo; ?>>
                                <input type="hidden" name="identificador_archivo_comp" value=<?php echo $identificador_archivo; ?>>
                                <input type="hidden" name="peso_archivo_comp" value=<?php echo $tam_archivo; ?>>
                                <label for="ingreso-usuario">Compartir con:</label>
                                <br>
                                <input id="ingreso-usuario" type="text" name="usuario_archivo_comp" placeholder="Usuario" class="form-control">
                              </div>
                              <div class="col-3"></div>
                            </div>
                          </div>
                          <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                            <button type="submit" name="submit_comp" class="btn btn-primary">Compartir</button>
                          </div>
                        </form>
                      </div>
                    </div>
                  </div>
                </div>
              </div>

            </div>
          </div>



        <?php
        }
        ?>




      </div>

    </div>





  </section>


  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous"></script>


</body>

</html>