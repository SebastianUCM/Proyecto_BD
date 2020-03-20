<?php
    if(!isset($_SESSION['loged_admin'])){
        header('Location: index.php');
    }
?>
<form method='POST'>
    <div class="pricing-header px-3 py-3 pt-md-5 pb-md-4 mx-auto text-center">
        <h1 class="display-4">Insertar Itinerario</h1>
    </div>
    <div class="row">
        <div class="col-sm-3"></div>
        <div class="col-sm-6">
            
            <div class="form-group">
                <label for="fecha_salida">Fecha Salida</label>
                <input  type="text" class="form-control" name='fecha_salida' id="fecha_salida" required>
            </div>
            <div class="form-group">
                <label for="hora_salida">Hora Salida</label>
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
            <div class="form-group">
                                                <label for="id_origen">Origen</label>
                                                <select class="form-control" name="id_origen" id="id_origen">
                                                <option value="">Seleccione un origen</option>               
                                                <?php
                                                    $c = oci_connect('trabajo','trabajo','localhost/XE');
                                                    if($c){
                                                    $select = "SELECT O.ID_ORIGEN,O.ID_ORIGEN || '-' || A.NOMBRE AS ORIGENES FROM ORIGEN O JOIN AEROPUERTO A ON A.ID_AEROPUERTO= O.AEROPUERTO ";
                                                    $stmt = oci_parse($c,$select);
                                                    oci_execute($stmt);
                                                    oci_fetch_all($stmt,$resultados);
                                                    print_r($resultados);
                                                        for ($i=0; $i < count($resultados['ID_ORIGEN']); $i++){ 
                                                            echo '<option value="' .$resultados['ID_ORIGEN'][$i]. '">' .$resultados['ORIGENES'][$i].' </option>';
                                                        }
                                                       
                                                    }                                           
                                                ?>
                                                </select>
                                            </div>
            <div class="form-group">
                                                <label for="id_destino">Destino</label>
                                                <select class="form-control" name="id_destino" id="id_destino">
                                                <option value="">Seleccione un Destino</option>               
                                                <?php
                                                    $c = oci_connect('trabajo','trabajo','localhost/XE');
                                                    if($c){
                                                    $select =  "SELECT O.ID_DESTINO,O.ID_DESTINO || '-' || A.NOMBRE AS DESTINOS FROM DESTINO O JOIN AEROPUERTO A ON A.ID_AEROPUERTO= O.AEROPUERTO ";
                                                    $stmt = oci_parse($c,$select);
                                                    oci_execute($stmt);
                                                    oci_fetch_all($stmt,$resultados);
                                                        for ($i=0; $i < count($resultados['ID_DESTINO']); $i++) { 
                                                            echo '<option value="' .$resultados['ID_DESTINO'][$i]. '">' .$resultados['DESTINOS'][$i].' </option>';
                                                        }   
                                                    }                                           
                                                ?>
                                                </select>
                                            </div>
            <?php
                if(isset($_POST['fecha_salida'])){
                    $fecha_salida = $_POST['fecha_salida'];
                    $hora_salida = $_POST['hora_salida'];
                    $fecha_llegada = $_POST['fecha_llegada'];
                    $hora_llegada = $_POST['hora_llegada'];
                    $origen = $_POST['id_origen'];
                    $destino = $_POST['id_destino'];
                    
                    $c = oci_connect('trabajo','trabajo','localhost/XE');
                    if($c){
                        $procedimiento = 'DECLARE BEGIN INSERTAR_ITINERARIO(:FECHA_SALIDA,:HORA_SALIDA,:FECHA_LLEGADA,:HORA_LLEGADA,:ORIGEN,:DESTINO,:RESULTADO,:MENSAJE); END;';
                        $stmt = oci_parse($c,$procedimiento);
                        oci_bind_by_name($stmt,'FECHA_SALIDA',$fecha_salida);
                        oci_bind_by_name($stmt,'HORA_SALIDA',$hora_salida);
                        oci_bind_by_name($stmt,'FECHA_LLEGADA',$fecha_llegada);
                        oci_bind_by_name($stmt,'HORA_LLEGADA',$hora_llegada);
                        oci_bind_by_name($stmt,':ORIGEN',$origen);
                        oci_bind_by_name($stmt,':DESTINO',$destino);
                        oci_bind_by_name($stmt,':RESULTADO',$r,100);
                        oci_bind_by_name($stmt,':MENSAJE',$m,100);
                        oci_execute($stmt);
                        echo '<div class="alert alert-primary " role="alert">'.$m.'</div>';  
                    }
                }
            ?>
            
            <div >
              <button type="submit" class="btn btn-primary">Ingresar</button>
            </div >
        </div>
    </div>
</form>