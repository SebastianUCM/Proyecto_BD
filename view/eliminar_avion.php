<?php
    if(!isset($_SESSION['loged_admin'])){
        header('Location: index.php');
    }
?>

<form method="POST" action="?pagina=eliminar_avion">
    <div class="pricing-header px-3 py-3 pt-md-5 pb-md-4 mx-auto text-center">
        <h1 class="display-4">Borrar Avión</h1>
    </div>
    <div class="row">
        <div class="col-sm-3"></div>
        <div class="col-sm-6">
            <hr>
            <div class="form-group">
                <label for="id_avion">Id Avion</label>
                <?php echo '<input  type="text" class="form-control" name="id_avion" id="id_avion" value="'.$_POST['avion'].'" readonly>'; ?>
            </div>
            <hr>
            <?php
                if(isset($_POST['id_avion'])){
                    $id_avion = $_POST['id_avion'];
                    $c = oci_connect('trabajo','trabajo','localhost/XE');
                    if($c){
                        $procedimiento = 'DECLARE BEGIN BORRAR_AVION(:ID_AVION,:RESULTADO,:MENSAJE); END;';
                        $stmt = oci_parse($c,$procedimiento);
                        oci_bind_by_name($stmt,':ID_AVION',$id_avion);
                        oci_bind_by_name($stmt,':RESULTADO',$r,100);
                        oci_bind_by_name($stmt,':MENSAJE',$m,500);
                        oci_execute($stmt);
                        echo '<div class="alert alert-primary " role="alert">'.$m.'</div>';                     }
                }
            ?>
            <div >
            <?php echo '<input type="hidden" name="avion" id="avion" value="'. $_POST['avion'].'" />'; ?>
              <button type="submit" class="btn btn-primary">BORRAR</button>
            </div >
        </div>
    </div>
</form>