<?php

session_start();

if (empty($_SESSION['ID'])) {
    header("Location: /index.php");
} else {
    $id = $_SESSION['ID'];
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
            width: 18%;
            height: auto;
            color: white;
            padding: 30px;
            background-color: #0D6EFD;
        }

        .card-img-top {
            width: 150px;
            height: 150px;
        }

        .card {
            position: relative;
            margin: 30px;
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
                                    <a class="nav-link" href="funciones/logout.php">Cerrar sesion</a>
                                </li>
                            </ul>
                            <form class="d-flex">
                                <input class="form-control me-2" type="search" placeholder="Buscar" aria-label="Search">
                                <button class="btn btn-outline-success" type="submit">Buscar</button>
                            </form>
                        </div>
                    </div>
                </nav>
            </div>
        </div>
    </section>
    <section class="contenido">
        <div>
            <div class="row">
                <div class="col-4">
                    <div class="columna-info">
                        <p>Hola</p>
                        <p>hola</p>
                        <p>Hola</p>
                        <p>hola</p>
                        <p>Hola</p>
                        <p>hola</p>
                        <p>Hola</p>
                        <p>hola</p>

                    </div>
                </div>
                <div class="col-3">

                    <div class="card" style="width: 18rem;">
                        <img src="imagenes/icono-archivos.png" class="card-img-top" alt="...">
                        <div class="card-body">
                            <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>

                            <div class="row">
                                <div class="col-4">
                                    <form method="get">
                                        <button type="submit" name="archivo" value="nombre_pdf" class="btn-danger">Eliminar</button>
                                    </form>
                                </div>
                                <div class="col-8">
                                    <!-- Button trigger modal -->
                                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
                                        Compartir
                                    </button>

                                    <!-- Modal -->
                                    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">Compartir con otro usuario</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="row">
                                                        <div class="col-1"></div>
                                                        <div class="col-8">
                                                            <label for="ingreso-usuario">Compartir con:</label>
                                                            <input id="ingreso-usuario" type="text" placeholder="Usuario" class="form-control">
                                                        </div>
                                                        <div class="col-3"></div>
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                                                    <button type="button" class="btn btn-primary">Compartir</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>

                    <div class="card" style="width: 18rem;">
                        <img src="imagenes/icono-archivos.png" class="card-img-top" alt="...">
                        <div class="card-body">
                            <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>

                            <div class="row">
                                <div class="col-4">
                                    <form method="get">
                                        <button type="submit" name="archivo" value="nombre_pdf" class="btn-danger">Eliminar</button>
                                    </form>
                                </div>
                                <div class="col-8">
                                    <!-- Button trigger modal -->
                                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
                                        Compartir
                                    </button>

                                    <!-- Modal -->
                                    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">Compartir con otro usuario</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="row">
                                                        <div class="col-1"></div>
                                                        <div class="col-8">
                                                            <label for="ingreso-usuario">Compartir con:</label>
                                                            <input id="ingreso-usuario" type="text" placeholder="Usuario" class="form-control">
                                                        </div>
                                                        <div class="col-3"></div>
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                                                    <button type="button" class="btn btn-primary">Compartir</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>

                    <div class="card" style="width: 18rem;">
                        <img src="imagenes/icono-archivos.png" class="card-img-top" alt="...">
                        <div class="card-body">
                            <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>

                            <div class="row">
                                <div class="col-4">
                                    <form method="get">
                                        <button type="submit" name="archivo" value="nombre_pdf" class="btn-danger">Eliminar</button>
                                    </form>
                                </div>
                                <div class="col-8">
                                    <!-- Button trigger modal -->
                                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
                                        Compartir
                                    </button>

                                    <!-- Modal -->
                                    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">Compartir con otro usuario</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="row">
                                                        <div class="col-1"></div>
                                                        <div class="col-8">
                                                            <label for="ingreso-usuario">Compartir con:</label>
                                                            <input id="ingreso-usuario" type="text" placeholder="Usuario" class="form-control">
                                                        </div>
                                                        <div class="col-3"></div>
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                                                    <button type="button" class="btn btn-primary">Compartir</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>

                    <div class="card" style="width: 18rem;">
                        <img src="imagenes/icono-archivos.png" class="card-img-top" alt="...">
                        <div class="card-body">
                            <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>

                            <div class="row">
                                <div class="col-4">
                                    <form method="get">
                                        <button type="submit" name="archivo" value="nombre_pdf" class="btn-danger">Eliminar</button>
                                    </form>
                                </div>
                                <div class="col-8">
                                    <!-- Button trigger modal -->
                                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
                                        Compartir
                                    </button>

                                    <!-- Modal -->
                                    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">Compartir con otro usuario</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="row">
                                                        <div class="col-1"></div>
                                                        <div class="col-8">
                                                            <label for="ingreso-usuario">Compartir con:</label>
                                                            <input id="ingreso-usuario" type="text" placeholder="Usuario" class="form-control">
                                                        </div>
                                                        <div class="col-3"></div>
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                                                    <button type="button" class="btn btn-primary">Compartir</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>

                    <div class="card" style="width: 18rem;">
                        <img src="imagenes/icono-archivos.png" class="card-img-top" alt="...">
                        <div class="card-body">
                            <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>

                            <div class="row">
                                <div class="col-4">
                                    <form method="get">
                                        <button type="submit" name="archivo" value="nombre_pdf" class="btn-danger">Eliminar</button>
                                    </form>
                                </div>
                                <div class="col-8">
                                    <!-- Button trigger modal -->
                                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
                                        Compartir
                                    </button>

                                    <!-- Modal -->
                                    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">Compartir con otro usuario</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="row">
                                                        <div class="col-1"></div>
                                                        <div class="col-8">
                                                            <label for="ingreso-usuario">Compartir con:</label>
                                                            <input id="ingreso-usuario" type="text" placeholder="Usuario" class="form-control">
                                                        </div>
                                                        <div class="col-3"></div>
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                                                    <button type="button" class="btn btn-primary">Compartir</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>

                    <div class="card" style="width: 18rem;">
                        <img src="imagenes/icono-archivos.png" class="card-img-top" alt="...">
                        <div class="card-body">
                            <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>

                            <div class="row">
                                <div class="col-4">
                                    <form method="get">
                                        <button type="submit" name="archivo" value="nombre_pdf" class="btn-danger">Eliminar</button>
                                    </form>
                                </div>
                                <div class="col-8">
                                    <!-- Button trigger modal -->
                                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
                                        Compartir
                                    </button>

                                    <!-- Modal -->
                                    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">Compartir con otro usuario</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="row">
                                                        <div class="col-1"></div>
                                                        <div class="col-8">
                                                            <label for="ingreso-usuario">Compartir con:</label>
                                                            <input id="ingreso-usuario" type="text" placeholder="Usuario" class="form-control">
                                                        </div>
                                                        <div class="col-3"></div>
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                                                    <button type="button" class="btn btn-primary">Compartir</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>

                    <div class="card" style="width: 18rem;">
                        <img src="imagenes/icono-archivos.png" class="card-img-top" alt="...">
                        <div class="card-body">
                            <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>

                            <div class="row">
                                <div class="col-4">
                                    <form method="get">
                                        <button type="submit" name="archivo" value="nombre_pdf" class="btn-danger">Eliminar</button>
                                    </form>
                                </div>
                                <div class="col-8">
                                    <!-- Button trigger modal -->
                                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
                                        Compartir
                                    </button>

                                    <!-- Modal -->
                                    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">Compartir con otro usuario</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="row">
                                                        <div class="col-1"></div>
                                                        <div class="col-8">
                                                            <label for="ingreso-usuario">Compartir con:</label>
                                                            <input id="ingreso-usuario" type="text" placeholder="Usuario" class="form-control">
                                                        </div>
                                                        <div class="col-3"></div>
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                                                    <button type="button" class="btn btn-primary">Compartir</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>

                    

    </section>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous"></script>


</body>

</html>