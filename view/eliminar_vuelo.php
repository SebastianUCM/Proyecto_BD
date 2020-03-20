<?php
    if(!isset($_SESSION['loged_admin'])){
        header('Location: index.php');
    }
?>

<form method="POST" action="?pagina=eliminar_vuelo">
    <div class="pricing-header px-3 py-3 pt-md-5 pb-md-4 mx-auto text-center">
        <h1 class="display-4">Borrar Vuelo </h1>
    </div>
    <div class="row">
        <div class="col-sm-3"></div>
        <div class="col-sm-6">
            <hr>
            <div class="form-group">
                <label for="id_vuelo ">Id Vuelo</label>
                <?php echo '<input  type="text" class="form-control" name="vuelo" id="vuelo" value="'.$_POST['vuelo'].'" readonly>'; ?>
            </div>
            <hr>
            <?php
                if(isset($_POST['vuelo'])){
                    $id_vuelo= $_POST['vuelo'];
                    $c = oci_connect('trabajo','trabajo','localhost/XE');
                    if($c){
                        $procedimiento = 'DECLARE BEGIN BORRAR_VUELO(:ID_VUELO,:RESULTADO,:MENSAJE); END;';
                        $stmt = oci_parse($c,$procedimiento);
                        oci_bind_by_name($stmt,':ID_VUELO',$id_vuelo);
                        oci_bind_by_name($stmt,':RESULTADO',$r,100);
                        oci_bind_by_name($stmt,':MENSAJE',$m,500);
                        oci_execute($stmt);
                        echo '<div class="alert alert-primary " role="alert">'.$m.'</div>';                     }
                }
            ?>
            <div >
            <?php echo '<input type="hidden" name="vuelo" id="vuelo" value="'. $_POST['vuelo'].'" />'; ?>
            </div >
        </div>
    </div>
</form>