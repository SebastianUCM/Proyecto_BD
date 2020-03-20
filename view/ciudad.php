<?php
    if(!isset($_SESSION['loged_admin'])){
        header('Location: index.php');
    }
?>

<form method='POST'>
    <div class="pricing-header px-3 py-3 pt-md-5 pb-md-4 mx-auto text-center">
        <h1 class="display-4">Insertar Ciudad</h1>
    </div>
    <div class="row">
        <div class="col-sm-3"></div>
        <div class="col-sm-6">
            <hr>
            <div class="form-group">
                <label for="id_ciudad">ID Ciudad</label>
                <input  type="text" class="form-control" name='id_ciudad' id="id_ciudad" required>
            </div>
            <hr>
            <div class="form-group">
                <label for="nombre_pais">Nombre Ciudad</label>
                <input  type="text" class="form-control" name='nombre_pais' id="nombre_pais" required>
            </div>
            <div class="form-group">
                                                <label for="id_pais">Pais</label>
                                                <select class="form-control" name="id_pais" id="id_pais">
                                                <option value="">Seleccione un pais</option>               
                                                <?php
                                                    $c = oci_connect('trabajo','trabajo','localhost/XE');
                                                    if($c){
                                                    $select = "SELECT ID_PAIS FROM PAIS";
                                                    $stmt = oci_parse($c,$select);
                                                    oci_execute($stmt);
                                                    oci_fetch_all($stmt,$resultados);
                                                        for ($i=0; $i < count($resultados['ID_PAIS']); $i++) { 
                                                            echo '<option value="' .$resultados['ID_PAIS'][$i]. '">' .$resultados['ID_PAIS'][$i].' </option>';
                                                        }   
                                                    }
                                                                                            
                                                ?>
                                                </select>
                                            </div>
            <?php
                if(isset($_POST['id_ciudad'])){
                    $id_ciudad = $_POST['id_ciudad'];
                    $nombre_pais = $_POST['nombre_pais'];
                    $id_pais = $_POST['id_pais'];
                    $c = oci_connect('trabajo','trabajo','localhost/XE');
                    if($c){
                        $procedimiento = 'DECLARE BEGIN INSERTAR_CIUDAD(:ID_CIUDAD,:NOMBRE,:ID_PAIS,:RESULTADO,:MENSAJE); END;';
                        $stmt = oci_parse($c,$procedimiento);
                        oci_bind_by_name($stmt,':ID_CIUDAD',$id_ciudad);
                        oci_bind_by_name($stmt,':NOMBRE',$nombre_pais);
                        oci_bind_by_name($stmt,':ID_PAIS',$id_pais);
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