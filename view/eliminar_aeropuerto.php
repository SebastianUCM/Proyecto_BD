<?php
    if(!isset($_SESSION['loged_admin'])){
        header('Location: index.php');
    }
?>

<form method="POST" action="?pagina=eliminar_aeropuerto">
    <div class="pricing-header px-3 py-3 pt-md-5 pb-md-4 mx-auto text-center">
        <h1 class="display-4">Borrar Aeropuerto</h1>
    </div>
    <div class="row">
        <div class="col-sm-3"></div>
        <div class="col-sm-6">
            <hr>
            <div class="form-group">
                <label for="id_aeropuerto">Id Aeropuerto</label>
                <?php echo '<input  type="text" class="form-control" name="id_aeropuerto" id="id_aeropuerto" value="'.$_POST['aeropuerto'].'" readonly>'; ?>
            </div>
            <hr>
            <?php
                if(isset($_POST['id_aeropuerto'])){
                    $id_aeropuerto= $_POST['id_aeropuerto'];
                    $c = oci_connect('trabajo','trabajo','localhost/XE');
                    if($c){
                        $procedimiento = 'DECLARE BEGIN BORRAR_AEROPUERTO(:ID_AEROPUERTO,:RESULTADO,:MENSAJE); END;';
                        $stmt = oci_parse($c,$procedimiento);
                        oci_bind_by_name($stmt,':ID_AEROPUERTO',$id_aeropuerto);
                        oci_bind_by_name($stmt,':RESULTADO',$r,100);
                        oci_bind_by_name($stmt,':MENSAJE',$m,500);
                        oci_execute($stmt);
                        echo '<div class="alert alert-primary " role="alert">'.$m.'</div>';                     }
                }
            ?>
            <div >
            <?php echo '<input type="hidden" name="aeropuerto" id="aeropuerto" value="'. $_POST['aeropuerto'].'" />'; ?>
              <button type="submit" class="btn btn-primary">BORRAR</button>
            </div >
        </div>
    </div>
</form>