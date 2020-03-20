<?php
    if(!isset($_SESSION['loged_admin'])){
        header('Location: index.php');
    }
?>

<form method='POST'>
    <div class="pricing-header px-3 py-3 pt-md-5 pb-md-4 mx-auto text-center">
        <h1 class="display-4">Insertar Aeropuerto</h1>
    </div>
    <div class="row">
        <div class="col-sm-3"></div>
        <div class="col-sm-6">
            
            <div class="form-group">
                <label for="nombre_aeropuerto">Nombre Aeropuerto</label>
                <input  type="text" class="form-control" name='nombre_aeropuerto' id="nombre_aeropuerto" required>
            </div>
            <div class="form-group">
                                                <label for="id_ciudad">ciudad</label>
                                                <select class="form-control" name="id_ciudad" id="id_ciudad">
                                                <option value="">Seleccione un ciudad</option>               
                                                <?php
                                                    $c = oci_connect('trabajo','trabajo','localhost/XE');
                                                    if($c){
                                                    $select = "SELECT ID_CIUDAD FROM CIUDAD";
                                                    $stmt = oci_parse($c,$select);
                                                    oci_execute($stmt);
                                                    oci_fetch_all($stmt,$resultados);
                                                        for ($i=0; $i < count($resultados['ID_CIUDAD']); $i++) { 
                                                            echo '<option value="' .$resultados['ID_CIUDAD'][$i]. '">' .$resultados['ID_CIUDAD'][$i].' </option>';
                                                        }   
                                                    }
                                                                                            
                                                ?>
                                                </select>
                                            </div>
            <div class="form-group">
                <label for="direccion_aeropuerto">Direción Aeropuerto</label>
                <input  type="text" class="form-control" name='direccion_aeropuerto' id="direccion_aeropuerto" required>
            </div>
            <?php
                if(isset($_POST['nombre_aeropuerto'])){
                    $nombre_aeropuerto = $_POST['nombre_aeropuerto'];
                    $id_ciudad = $_POST['id_ciudad'];
                    $direccion_aeropuerto = $_POST['direccion_aeropuerto'];
                    $c = oci_connect('trabajo','trabajo','localhost/XE');
                    if($c){
                        $procedimiento = 'DECLARE BEGIN INSERTAR_AEROPUERTO(:NOMBRE,:CIUDAD,:DIRECCION,:RESULTADO,:MENSAJE); END;';
                        $stmt = oci_parse($c,$procedimiento);
                        oci_bind_by_name($stmt,':NOMBRE',$nombre_aeropuerto);
                        oci_bind_by_name($stmt,':CIUDAD',$id_ciudad);
                        oci_bind_by_name($stmt,':DIRECCION',$direccion_aeropuerto);
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