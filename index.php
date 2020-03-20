<?php
    session_start();
?>
<!doctype html>
<html lang="es">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css"
        integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

    <style>
        hr{
            visibility:hidden
        }
    </style>
      <!-- Bootstrap core CSS -->
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <  !-- Custom styles for this template -->
    <link href="css/scrolling-nav.css" rel="stylesheet">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">

    <title>AeroSky!</title>
</head>

<body class=''>
    <nav class="navbar navbar-expand-lg navbar-light fixed-top" style="background-color: #e3f2fd;">
<?php    
    if(isset($_SESSION['loged_admin'])){ 
        echo '<a class="navbar-brand js-scroll-trigger" href="?pagina=inicio_admin">AERO SKY</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
            </button>';
    }else{ 
        echo '<a class="navbar-brand js-scroll-trigger" href="?pagina=inicio">AERO SKY</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
            </button>';
    }
?>  

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav ml-auto">
                <?php
                if(!isset($_SESSION['loged_admin'])){  
                echo'<li class="nav-item">
                    <a class="nav-link" href="?pagina=descubre" >Descubre nuestros destinos</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="?pagina=informacion">Información</a>
                </li>';
                }
                ?> 
                <?php
                if(isset($_SESSION['loged_admin'])=='admin'){  
                echo '
                
                <li class="nav-item active">
                    <a class="nav-link" href="?pagina=ver_pais" >País <span class="sr-only"></span></a>
                </li>
                <li class="nav-item active">
                    <a class="nav-link" href="?pagina=ver_ciudad" >Ciudad <span class="sr-only"></span></a>
                </li>
                <li class="nav-item active">
                    <a class="nav-link" href="?pagina=ver_aeropuerto" >Aeropuerto <span class="sr-only"></span></a>
                </li>
                <li class="nav-item active">
                    <a class="nav-link" href="?pagina=ver_destino" >Destino <span class="sr-only"></span></a>
                </li>
                <li class="nav-item active">
                    <a class="nav-link" href="?pagina=ver_origen" >Origen <span class="sr-only"></span></a>
                </li>
                <li class="nav-item active">
                    <a class="nav-link" href="?pagina=ver_avion" >Avión <span class="sr-only"></span></a>
                </li>
                <li class="nav-item active">
                    <a class="nav-link" href="?pagina=ver_itinerario1" >Itinerario <span class="sr-only"></span></a>
                </li>
                <li class="nav-item active">
                    <a class="nav-link" href="?pagina=ver_vuelo" >Vuelo <span class="sr-only"></span></a>
                </li>
                <li class="nav-item">
                </li>
                ';
                }
                ?> 
                <?php
                    if(isset($_SESSION['loged'])){                     
                        echo '<li class="nav-item">
                            <a class="nav-link" href="?pagina=cliente_boletas">Tus vuelos!</a>
                        </li>';  
                    }
                ?>
                <?php
                    if(!isset($_SESSION['loged']) and (!isset($_SESSION['loged_admin']))){
                      
                        echo '<li class="nav-item">
                            <a class="nav-link" href="?pagina=registro">Registrar</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="?pagina=login">Iniciar sesión</a>
                        </li>';  
                    }else{
                        echo '<li class="nav-item">
                            <a class="nav-link" href="?pagina=logout">Cerrar Sesión</a>
                        </li>';
                    }
                ?>
            </ul>
            
        </div>
    </nav>
    



        <?php
            if(isset($_GET['pagina'])){
                if($_GET['pagina'] == 'inicio'){
                    include 'view/inicio.php';
                }elseif($_GET['pagina'] == 'registro'){
                    include 'view/registro.php';
                }elseif($_GET['pagina'] == 'login'){
                    include 'view/login.php';
                }elseif($_GET['pagina'] == 'informacion'){
                    include 'view/informacion.php';
                }elseif($_GET['pagina'] == 'descubre'){
                    include 'view/descubre.php';
                }elseif($_GET['pagina'] == 'logout'){
                    include 'view/logout.php';
                }elseif($_GET['pagina'] == 'itinerario'){
                    include 'view/itinerario.php';
                }elseif($_GET['pagina'] == 'tarifa'){
                    include 'view/tarifa.php';
                }elseif($_GET['pagina'] == 'asiento'){
                    include 'view/asiento.php';
                }elseif($_GET['pagina'] == 'pasajero'){
                    include 'view/pasajero.php';
                }elseif($_GET['pagina'] == 'pasaje'){
                    include 'view/pasaje.php';
                }elseif($_GET['pagina'] == 'inicio_admin'){
                    include 'view/inicio_admin.php';
                }elseif($_GET['pagina'] == 'login_admin'){
                    include 'view/login_admin.php';
                }elseif($_GET['pagina'] == 'ver_pais'){
                    include 'view/ver_pais.php';
                }elseif($_GET['pagina'] == 'pais'){
                    include 'view/pais.php';
                }elseif($_GET['pagina'] == 'modificar_pais'){
                    include 'view/modificar_pais.php';
                }elseif($_GET['pagina'] == 'eliminar_pais'){
                    include 'view/eliminar_pais.php';
                }elseif($_GET['pagina'] == 'ver_ciudad'){
                    include 'view/ver_ciudad.php';
                }elseif($_GET['pagina'] == 'ciudad'){
                    include 'view/ciudad.php';
                }elseif($_GET['pagina'] == 'eliminar_ciudad'){
                    include 'view/eliminar_ciudad.php';
                }elseif($_GET['pagina'] == 'ver_aeropuerto'){
                    include 'view/ver_aeropuerto.php';
                }elseif($_GET['pagina'] == 'aeropuerto'){
                    include 'view/aeropuerto.php';
                }elseif($_GET['pagina'] == 'eliminar_aeropuerto'){
                    include 'view/eliminar_aeropuerto.php';
                }elseif($_GET['pagina'] == 'ver_destino'){
                    include 'view/ver_destino.php';
                }elseif($_GET['pagina'] == 'destino'){
                    include 'view/destino.php';
                }elseif($_GET['pagina'] == 'eliminar_destino'){
                    include 'view/eliminar_destino.php';
                }elseif($_GET['pagina'] == 'ver_origen'){
                    include 'view/ver_origen.php';
                }elseif($_GET['pagina'] == 'origen'){
                    include 'view/origen.php';
                }elseif($_GET['pagina'] == 'eliminar_origen'){
                    include 'view/eliminar_origen.php';
                }elseif($_GET['pagina'] == 'ver_avion'){
                    include 'view/ver_avion.php';
                }elseif($_GET['pagina'] == 'avion'){
                    include 'view/avion.php';
                }elseif($_GET['pagina'] == 'eliminar_avion'){
                    include 'view/eliminar_avion.php';
                }elseif($_GET['pagina'] == 'ver_itinerario1'){
                    include 'view/ver_itinerario1.php';
                }elseif($_GET['pagina'] == 'itinerario1'){
                    include 'view/itinerario1.php';
                }elseif($_GET['pagina'] == 'eliminar_itinerario1'){
                    include 'view/eliminar_itinerario1.php';
                }elseif($_GET['pagina'] == 'modificar_itinerario'){
                    include 'view/modificar_itinerario.php';
                }elseif($_GET['pagina'] == 'ver_vuelo'){
                    include 'view/ver_vuelo.php';
                }elseif($_GET['pagina'] == 'vuelo'){
                    include 'view/vuelo.php';
                }elseif($_GET['pagina'] == 'modificar_vuelo'){
                    include 'view/modificar_vuelo.php';
                }elseif($_GET['pagina'] == 'eliminar_vuelo'){
                    include 'view/eliminar_vuelo.php';
                }elseif($_GET['pagina'] == 'cliente_boletas'){
                    include 'view/cliente_boletas.php';
                }elseif($_GET['pagina'] == 'cliente_boleta_seleccionada'){
                    include 'view/cliente_boleta_seleccionada.php';
                }elseif($_GET['pagina'] == 'cliente_itinerario'){
                    include 'view/cliente_itinerario.php';
                }elseif($_GET['pagina'] == 'cliente_asiento'){
                    include 'view/cliente_asiento.php';
                }elseif($_GET['pagina'] == 'cliente_pasajero'){
                    include 'view/cliente_pasajero.php';
                }elseif($_GET['pagina'] == 'cliente_pasaje'){
                    include 'view/cliente_pasaje.php';
                }else{
                    include 'view/inicio.php';
                }
            }else{
                include 'view/inicio.php';
            }
        ?>

    <footer class="py-5 bg-dark">
        <div class="container">
            <p class="m-0 text-center text-white">UCM &copy; Base de datos 2020</p>
        </div>
    <!-- /.container -->
    </footer>
    
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js"
        integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n"
        crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"
        integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo"
        crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"
        integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6"
        crossorigin="anonymous"></script>
</body>

</html>