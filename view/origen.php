<?php
    if(!isset($_SESSION['loged_admin'])){
        header('Location: index.php');
    }
?>

<form method='POST'>
    <div class="pricing-header px-3 py-3 pt-md-5 pb-md-4 mx-auto text-center">
        <h1 class="display-4">Insertar Origen</h1>
    </div>
    <div class="row">
        <div class="col-sm-3"></div>
        <div class="col-sm-6">
            
            <div class="form-group">
                                                <label for="id_aeropuerto">Aeropuerto</label>
                                                <select class="form-control" name="id_aeropuerto" id="id_aeropuerto">
                                                <option value="">Seleccione un aeropuerto</option>               
                                                <?php
                                                    $c = oci_connect('trabajo','trabajo','localhost/XE');
                                                    if($c){
                                                    $select = "SELECT ID_AEROPUERTO,NOMBRE FROM AEROPUERTO";
                                                    $stmt = oci_parse($c,$select);
                                                    oci_execute($stmt);
                                                    oci_fetch_all($stmt,$resultados);
                                                        for ($i=0; $i < count($resultados['NOMBRE']); $i++) { 
                                                            echo '<option value="' .$resultados['ID_AEROPUERTO'][$i]. '">' .$resultados['NOMBRE'][$i].' </option>';
                                                        }   
                                                    }
                                                                                            
                                                ?>
                                                </select>
                                            </div>
            
            <?php
                if(isset($_POST['id_aeropuerto'])){
                    $id_aeropuerto = $_POST['id_aeropuerto'];
                    $c = oci_connect('trabajo','trabajo','localhost/XE');
                    if($c){
                        $procedimiento = 'DECLARE BEGIN INSERTAR_ORIGEN(:AEROPUERTO,:RESULTADO,:MENSAJE); END;';
                        $stmt = oci_parse($c,$procedimiento);
                        oci_bind_by_name($stmt,':AEROPUERTO',$id_aeropuerto);
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