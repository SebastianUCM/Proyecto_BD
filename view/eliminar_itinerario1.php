<?php
    if(!isset($_SESSION['loged_admin'])){
        header('Location: index.php');
    }
?>

<form method="POST" action="?pagina=eliminar_itinerario1">
    <div class="pricing-header px-3 py-3 pt-md-5 pb-md-4 mx-auto text-center">
        <h1 class="display-4">Borrar Itinerario</h1>
    </div>
    <div class="row">
        <div class="col-sm-3"></div>
        <div class="col-sm-6">
            <hr>
            <div class="form-group">
                <label for="id_itinerario">Id Itinerario</label>
                <?php echo '<input  type="text" class="form-control" name="itinerario" id="itinerario" value="'.$_POST['itinerario'].'" readonly>'; ?>
            </div>
            <hr>
            <?php
                if(isset($_POST['itinerario'])){
                    $id_itinerario= $_POST['itinerario'];
                    $c = oci_connect('trabajo','trabajo','localhost/XE');
                    if($c){
                        $procedimiento = 'DECLARE BEGIN BORRAR_ITINERARIO(:ID_ITINERARIO,:RESULTADO,:MENSAJE); END;';
                        $stmt = oci_parse($c,$procedimiento);
                        oci_bind_by_name($stmt,':ID_ITINERARIO',$id_itinerario);
                        oci_bind_by_name($stmt,':RESULTADO',$r,100);
                        oci_bind_by_name($stmt,':MENSAJE',$m,500);
                        oci_execute($stmt);
                        echo '<div class="alert alert-primary " role="alert">'.$m.'</div>';                     }
                }
            ?>
            <div >
            <?php echo '<input type="hidden" name="itinerario" id="itinerario" value="'. $_POST['itinerario'].'" />'; ?>
            </div >
        </div>
    </div>
</form>