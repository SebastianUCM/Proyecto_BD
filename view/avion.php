<?php
    if(!isset($_SESSION['loged_admin'])){
        header('Location: index.php');
    }
?>
<form method='POST'>
    <div class="pricing-header px-3 py-3 pt-md-5 pb-md-4 mx-auto text-center">
        <h1 class="display-4">Insertar Avión</h1>
    </div>
    <div class="row">
        <div class="col-sm-3"></div>
        <div class="col-sm-6">
            <hr>
            
            <div class="form-group">
                <label for="modelo">Modelo </label>
                <input  type="text" class="form-control" name='modelo' id="modelo" required>
            </div>
            <div class="form-group">
                <label for="anio">AÑO</label>
                <input  type="text" class="form-control" name='anio' id="anio" required>
            </div>
            <hr>
            <?php
                if(isset($_POST['modelo'])){
                    $modelo = $_POST['modelo'];
                    $anio = $_POST['anio'];
                    $c = oci_connect('trabajo','trabajo','localhost/XE');
                    if($c){
                        $procedimiento = 'DECLARE BEGIN INSERTAR_AVION(:MODELO,:ANIO,:RESULTADO,:MENSAJE); END;';
                        $stmt = oci_parse($c,$procedimiento);
                        oci_bind_by_name($stmt,':MODELO',$modelo);
                        oci_bind_by_name($stmt,':ANIO',$anio);
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