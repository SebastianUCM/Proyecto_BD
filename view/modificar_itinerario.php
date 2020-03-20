<?php
    if(!isset($_SESSION['loged_admin'])){
        header('Location: index.php');
    }
?>

<form method="POST" action="?pagina=modificar_itinerario">
    <div class="pricing-header px-3 py-3 pt-md-5 pb-md-4 mx-auto text-center">
        <h1 class="display-4">Modificar Itinerario</h1>
    </div>
    <div class="row">
        <div class="col-sm-3"></div>
        <div class="col-sm-6">
            <hr>
            <div class="form-group">
                <label for="itinerario">Id itinerario</label>
                <?php echo '<input  type="text" class="form-control" name="itinerario" id="itinerario" value="'.$_POST['itinerario'].'" readonly>'; ?>
            </div>
            <hr>
            <div class="form-group">
                <label for="fecha_salida">Fecha Salida</label>
                <input  type="text" class="form-control" name='fecha_salida' id="fecha_salida" required>
            </div>
             <div class="form-group">
                <label for="hora_salida">Hora Salida </label>
                <input  type="text" class="form-control" name='hora_salida' id="hora_salida" required>
            </div> 
            <div class="form-group">
                <label for="fecha_llegada">Fecha Llegada</label>
                <input  type="text" class="form-control" name='fecha_llegada' id="fecha_llegada" required>
            </div>
            <div class="form-group">
                <label for="hora_llegada">Hora Llegada</label>
                <input  type="text" class="form-control" name='hora_llegada' id="hora_llegada" required>
            </div>
            
            <?php
                if(isset($_POST['fecha_salida'])){
                    $itinerario = $_POST['itinerario'];
                    $fecha_salida = $_POST['fecha_salida'];
                    $hora_salida = $_POST['hora_salida'];
                    $fecha_llegada = $_POST['fecha_llegada'];
                    $hora_llegada = $_POST['hora_llegada'];
                    $c = oci_connect('trabajo','trabajo','localhost/XE');
                     if($c){
                        $procedimiento = 'DECLARE BEGIN ACTUALIZAR_ITINERARIO(:ID_ITINERARIO,:FECHA_SALIDA,:HORA_SALIDA,:FECHA_LLEGADA,:HORA_LLEGADA,:RESULTADO,:MENSAJE); END;';
                        $stmt = oci_parse($c,$procedimiento);
                        oci_bind_by_name($stmt,':ID_ITINERARIO',$itinerario);
                        oci_bind_by_name($stmt,':FECHA_SALIDA',$fecha_salida);
                        oci_bind_by_name($stmt,':HORA_SALIDA',$hora_salida);
                        oci_bind_by_name($stmt,':FECHA_LLEGADA',$fecha_llegada);
                        oci_bind_by_name($stmt,':HORA_LLEGADA',$hora_llegada);
                        oci_bind_by_name($stmt,':RESULTADO',$r,100);
                        oci_bind_by_name($stmt,':MENSAJE',$m,500);
                        oci_execute($stmt);
                        echo '<div class="alert alert-primary " role="alert">'.$m.'</div>';  
                    }
                }
            ?>
            <?php echo '<input type="hidden" name="itinerario" id="itinerario" value="'. $_POST['itinerario'].'" />'; ?>
              <button type="submit" class="btn btn-primary">MODIFICAR</button>
            </div >
        </div>
    </div>
</form>
