<?php
/* FUNCION PARA QUE SI SE ELIGIERON BIEN LOS ASIENTOS, SE VAYA A PASAJEROS */
        if(isset($_POST['enviar'])){
            $pasajeros= $_POST['num_pasajeros'];
            $hola=$_POST['caca'];
            if(!empty($hola)){
                
                $num=count($hola);
                if($num==$pasajeros){
                    $_SESSION['asientos_elegidos'] = $hola;
                    header("Status: 301 Moved Permanently");
                    header("Location: http://localhost/prueba2/?pagina=pasajero");
                    exit;
                   
                }
                
            }
        
        }
?>


<style type="text/css">
.texto-encima{
    position: absolute;
    top: 45%;
    left: 50%;
    transform: translate(-50%, -50%);
}
.texto-encima2{
    position: absolute;
    top: 55%;
    left: 50%;
    transform: translate(-50%, -50%);
}
.my-custom-scrollbar {
position: relative;
height: 500px;
overflow: auto;
}
.table-wrapper-scroll-y {
display: block;
}        
</style>


<?php
    $pasajeros= $_POST['num_pasajeros'];
    $valor= $_POST['precio'];
    $id_tarifa=$_POST['tarifa'];
    $total_pasaje= $valor*$pasajeros;
    $precio_tarifa;
    if($id_tarifa==1){
        $precio_tarifa=0;
    }elseif($id_tarifa==2){
        $precio_tarifa=10000;
    }else{
        $precio_tarifa=25000;
    }
    $total_tarifa= $pasajeros*$precio_tarifa;
    $total= $total_pasaje+$total_tarifa;

    /* FUNCION PARA INSERTAR PASAJES Y PONERLOS EN CARRITO (FALTA ASIENTO Y PASAJEROS- CARRITO LISTO) */
if(isset($_SESSION['loged'])){
    if(isset($_POST['enviar_tarifa'])){
        if(isset($_SESSION['loged'])){
            $id_usuario= $_SESSION['rut'];
            $id_vu=$_SESSION['id_v'];
                                
            $conexion = oci_connect('trabajo_cliente','trabajo_cliente','localhost/XE');
            if($conexion){
                $procedimiento = 'DECLARE BEGIN trabajo.INSERTAR_PASAJE(:num_pasajes,:id_usuario,:id_vuelo,:id_tarifa); END;';
                $stmt = oci_parse($conexion,$procedimiento);
                oci_bind_by_name($stmt,':num_pasajes',$pasajeros);
                oci_bind_by_name($stmt,':id_usuario',$id_usuario);
                oci_bind_by_name($stmt,':id_vuelo',$id_vu);
                oci_bind_by_name($stmt,':id_tarifa',$id_tarifa);
                oci_execute($stmt);
            } 
        }      
    }
}   

?>
<hr/>
<nav class="navbar navbar-dark bg-dark justify-content-between">
<a class="navbar-brand"></a>
    <div class="dropdown">
        <button type="button" class="btn btn-success dropdown-toggle"  id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="width:300px;">
            Tu carrito &nbsp;&nbsp; <i class="fas fa-shopping-cart"></i>
        </button>
        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
            <div class="card" >
                <div class="card-body">
                    <h5 class="card-title">Carro</h5>
                    <?php echo '<li class="list-group-item d-flex justify-content-between lh-condensed">
                        <div>
                            <h6 class="my-0">Pasaje</h6>
                        </div>
                    <span class="text-muted">'.$pasajeros.'</span>
                    </li>';?>

                    <?php echo '<li class="list-group-item d-flex justify-content-between lh-condensed">
                        <div>
                            <h6 class="my-0">Total Pasaje</h6>
                        </div>
                    <span class="text-muted">'.$total_pasaje.'</span>
                    </li>';?>
                    <?php echo '<li class="list-group-item d-flex justify-content-between lh-condensed">
                        <div>
                            <h6 class="my-0">Valor tarifa</h6>
                        </div>
                    <span class="text-muted">'.$precio_tarifa.'</span>
                    </li>';?>

                    <?php echo '<li class="list-group-item d-flex justify-content-between lh-condensed">
                        <div>
                            <h6 class="my-0">Total tarifa</h6>
                        </div>
                    <span class="text-muted">'.$total_tarifa.'</span>
                    </li>';?>

                    <?php echo '<li class="list-group-item d-flex justify-content-between">
                            <span>Total (CLP)</span>
                            <strong>'.$total.'</strong> 
                            </li>';?>
                    <p class="card-text"> ¡Aprovecha y compra! Viaja cómodo y con más espacio con Aero Sky.</p>


                </div>
            </div>
        </div>
    </div>
  
</nav>

<hr/>
<div style="margin: 50px 280px;height: 10rem;align-items: center;padding: 30px;display: flex;justify-content: center;">
<img src="nube2.png"  WIDTH="550" HEIGHT="250"/>
<div class="texto-encima"><h2  style="font-family:sans-serif;">Selección de asiento.</h2></div>
    <?php echo'<p class="lead texto-encima2">Seleccione '.$pasajeros. ' asiento/s!</p>';?>
</div>
<div class="container">

<?php
    /* FUNCION PARA MOSTRAR ERROR Y VOLVER A ELEGIR BIEN LOS ASIENTOS */    
        if(isset($_POST['enviar'])){
            $pasajeros= $_POST['num_pasajeros'];
            if(!empty($_POST['caca'])){
                $hola=$_POST['caca'];
                $num=count($hola);
                if($num!==$pasajeros){

                    echo '<div class="alert alert-warning alert-dismissible fade show" role="alert">
                            <strong> ¡Atención!</strong> Debes seleccionar '.$pasajeros.' asientos.             
                        </div>';
                }
            }
            else{
            echo '<div class="alert alert-warning alert-dismissible fade show" role="alert">
                    <strong> ¡Atención!</strong> No has seleccionado ningún asiento.             
                </div>';
            }
        }
?>
<form method="POST" action="?pagina=asiento">
            <div class="row">
                <div class="col-sm">
                    <img src="avion.png"  WIDTH="500" HEIGHT="500">
                </div>  
                <div class="col-sm">
                    <div class="table-wrapper-scroll-y my-custom-scrollbar">
                        <table class="table table-bordered table-striped mb-0">
                            <thead>
                                <tr>
                                    <th scope="col">Asiento</th>
                                    <th scope="col">Disponibilidad</th>
                                    <th scope="col"></th>
                                </tr>
                            </thead>
                            <tbody>
                        <?php
                            if(isset($_SESSION['loged'])){ 
                                $c = oci_connect('trabajo_cliente','trabajo_cliente','localhost/XE');
                            }else{
                                $c = oci_connect('trabajo_visitante','trabajo_visitante','localhost/XE'); 
                            }
                            if($c){
                                $select = "SELECT ID_ASIENTO, ESTADO FROM trabajo.VUELO_ASIENTO  WHERE ID_VUELO =:id ORDER BY ID_ASIENTO";
                                $stmt = oci_parse($c,$select);
                                $v= $_SESSION['id_v'];
                                oci_bind_by_name($stmt, ':id', $v);
                                oci_execute($stmt);
                                oci_fetch_all($stmt,$resultados);
                                for ($i=0; $i < count($resultados['ID_ASIENTO']); $i++) { 
                                    echo '<tr class="table-secondary">';
                                        echo  '<td style=" height:50px;">'.$resultados['ID_ASIENTO'][$i].'</td>';
                                        echo  '<td style=" height:50px;">'.$resultados['ESTADO'][$i].'</td>';
                                        if ($resultados['ESTADO'][$i] == 'DISPONIBLE'):
                                            echo '<td style=" height:50px;">
                                                <input type="checkbox" name="caca[]" id="caca[]" value="'.$resultados['ID_ASIENTO'][$i].'">
                                                </td>'; 
                                        else:
                                            echo '<td></td>';
                                        endif;
                                    echo '</tr>';
                                }
                            }                                                                                           
                                                
                    echo '</tbody>     
                </table>
            </div><!--scroll -->   
        </div><!-- col2 -->
    </div><!-- row -->
    <br><br>';
    ?>
    <?php if(isset($_SESSION['loged'])): ?> 
    <?php echo '<input type="hidden" name="num_pasajeros" id="num_pasajeros" value="'. $pasajeros.'" />'; ?>
    <?php echo '<input type="hidden" name= "precio" id="precio" value="'.$valor.'" />';  ?>
    <?php echo '<input type="hidden" name= "tarifa" id="tarifa" value="'.$precio_tarifa.'" />';  ?>              
        <button type="submit" class="btn btn-success float-right" style="width:200px;background-color: #041673;" name="enviar">Continuar</button><br>
    <?php else:?>
        <button type="submit" class="btn btn-success float-right" style="width:200px;background-color: #041673;" disabled>Continuar</button><br><br>              
        <div class="alert alert-warning alert-dismissible fade show" role="alert">
            <strong> ¡Atención!</strong> Para continuar debes iniciar sesión.             
        </div>
    <?php endif;?>

    </form>
    
</div><!-- conteiner --><br><br><br>