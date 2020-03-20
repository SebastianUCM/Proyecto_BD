<?php
    if(!isset($_SESSION['loged'])){
        header('Location: index.php');
    }
?>
<?php
/* FUNCION PARA QUE SI SE ELIGIERON BIEN LOS ASIENTOS, SE VAYA A PASAJEROS */
        if(isset($_POST['enviar'])){
            $pasajeros= $_POST['num_pasajeros'];
            $hola=$_POST['asientos_escogidos'];
            $vuelo= $_POST['id_vuelo'];
            if(!empty($hola)){
                
                $num=count($hola);
                if($num==$pasajeros){                  
                /* FUNCION PARA INSERTAR PASAJES Y PONERLOS EN CARRITO (FALTA ASIENTO Y PASAJEROS- CARRITO LISTO) */
                    $id_usuario= $_SESSION['rut'];
                    $id_tarifa=$_SESSION['id_tarifa'];
                    $id_vuelo_antiguo=$_SESSION['id_vuelo_antiguo'];
                    $conexion = oci_connect('trabajo_cliente','trabajo_cliente','localhost/XE');
                    if($conexion){
                        $procedimiento = 'DECLARE BEGIN trabajo.INSERTAR_PASAJE_DOS(:num_pasajes,:id_usuario,:id_vuelo,:id_tarifa,:id_vuelo_antiguo); END;';
                        $stmt = oci_parse($conexion,$procedimiento);
                        oci_bind_by_name($stmt,':num_pasajes',$pasajeros);
                        oci_bind_by_name($stmt,':id_usuario',$id_usuario);
                        oci_bind_by_name($stmt,':id_vuelo',$vuelo);
                        oci_bind_by_name($stmt,':id_tarifa',$id_tarifa);
                        oci_bind_by_name($stmt,':id_vuelo_antiguo', $id_vuelo_antiguo);
                        oci_execute($stmt);
                    } 
                    $_SESSION['asientos_elegidos'] = $hola;
                    /* variable para mostrar error en pasajero  */
                     $_SESSION['auxx']=0;
                    header("Status: 301 Moved Permanently");
                    header("Location: http://localhost/prueba2/?pagina=cliente_pasajero");
                    exit;
                   
                }
                
            }
        
        }
?>
<?php
    $pasajeros= $_POST['num_pasajeros'];
    $valor= $_POST['precio'];
    $vuelo= $_POST['id_vuelo'];

?>
<style type="text/css">

.texto-encima{
    position: absolute;
    top: 28%;
    left: 52%;
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

<br>
<div style="margin: 50px 280px;height: 10rem;align-items: center;padding: 30px;display: flex;justify-content: center;">
<img src="nube2.png"  WIDTH="550" HEIGHT="250"/>
<div class="texto-encima"><h2  style="font-family:sans-serif;">Selección de asiento.</h2>
    <?php echo'<p class="lead">Seleccione '.$pasajeros. ' asiento/s!</p>';?></div>

</div>

<div class="container">

<?php
    /* FUNCION PARA MOSTRAR ERROR Y VOLVER A ELEGIR BIEN LOS ASIENTOS */    
        if(isset($_POST['enviar'])){
            $pasajeros= $_POST['num_pasajeros'];
            if(!empty($_POST['asientos_escogidos'])){
                $hola=$_POST['asientos_escogidos'];
                $num=count($hola);
                if($num!==$pasajeros){

                    echo '<div class="alert alert-warning alert-dismissible fade show" role="alert">
                            <strong> ¡Atención!</strong> Debes seleccionar '.$pasajeros.' asiento/s.             
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

<form method="POST" action="?pagina=cliente_asiento">
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
                            $c = oci_connect('trabajo_cliente','trabajo_cliente','localhost/XE');
                            if($c){
                                $select = "SELECT ID_ASIENTO, ESTADO FROM trabajo.VUELO_ASIENTO  WHERE ID_VUELO =:id ORDER BY ID_ASIENTO";
                                $stmt = oci_parse($c,$select);
                                oci_bind_by_name($stmt, ':id', $vuelo);
                                oci_execute($stmt);
                                oci_fetch_all($stmt,$resultados);
                                for ($i=0; $i < count($resultados['ID_ASIENTO']); $i++) { 
                                    echo '<tr class="table-secondary">';
                                        echo  '<td style=" height:50px;">'.$resultados['ID_ASIENTO'][$i].'</td>';
                                        echo  '<td style=" height:50px;">'.$resultados['ESTADO'][$i].'</td>';
                                        if ($resultados['ESTADO'][$i] == 'DISPONIBLE'):
                                            echo '<td style=" height:50px;">
                                                <input type="checkbox" name="asientos_escogidos[]" id="asientos_escogidos[]" value="'.$resultados['ID_ASIENTO'][$i].'">
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
    <br>';?>

    <?php echo '<input type="hidden" name="num_pasajeros" id="num_pasajeros" value="'. $pasajeros.'" />'; ?>
    <?php echo '<input type="hidden" name= "precio" id="precio" value="'.$valor.'" />';  ?>
    <?php echo '<input type="hidden" name= "id_vuelo" id="id_vuelo" value="'.$vuelo.'" />';  ?>         
    <button type="submit" class="btn btn-success float-right" style="width:200px;background-color: #041673;" name="enviar">Continuar</button><br>
    </form>
    
</div><!-- conteiner --><br>