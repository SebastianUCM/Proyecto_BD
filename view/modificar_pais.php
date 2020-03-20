<?php
    if(!isset($_SESSION['loged_admin'])){
        header('Location: index.php');
    }
?>

<form method="POST" action="?pagina=modificar_pais">
    <div class="pricing-header px-3 py-3 pt-md-5 pb-md-4 mx-auto text-center">
        <h1 class="display-4">Modificar País</h1>
    </div>
    <div class="row">
        <div class="col-sm-3"></div>
        <div class="col-sm-6">
            <hr>
            <div class="form-group">
                <label for="id_pais">Id Pais</label>
                <?php echo '<input  type="text" class="form-control" name="id_pais" id="id_pais" value="'.$_POST['pais'].'" readonly>'; ?>
            </div>
            <hr>
            <div class="form-group">
                <label for="nombre_pais">Nombre Pais</label>
                <input  type="text" class="form-control" name='nombre_pais' id="nombre_pais" required>
            </div>
            <?php
                if(isset($_POST['id_pais'])){
                    $id_pais = $_POST['id_pais'];
                    $nombre_pais = $_POST['nombre_pais'];
                    $c = oci_connect('trabajo','trabajo','localhost/XE');
                    if($c){
                        $procedimiento = 'DECLARE BEGIN ACTUALIZAR_PAIS(:ID_PAIS,:NOMBRE,:RESULTADO,:MENSAJE); END;';
                        $stmt = oci_parse($c,$procedimiento);
                        oci_bind_by_name($stmt,':ID_PAIS',$id_pais);
                        oci_bind_by_name($stmt,':NOMBRE',$nombre_pais);
                        oci_bind_by_name($stmt,':RESULTADO',$r,100);
                        oci_bind_by_name($stmt,':MENSAJE',$m,500);
                        oci_execute($stmt);
                        echo '<div class="alert alert-primary " role="alert">'.$m.'</div>';                     }
                }
            ?>
            <div >
            <?php echo '<input type="hidden" name="pais" id="pais" value="'. $_POST['pais'].'" />'; ?>
              <button type="submit" class="btn btn-primary">MODIFICAR</button>
            </div >
        </div>
    </div>
</form>
