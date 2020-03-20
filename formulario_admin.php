<?php
session_start();
if(isset($_POST['nombre'])){
    $nombre = $_POST['nombre'];
    $password = $_POST['contrasena_loginn'];
    $c = oci_connect('trabajo','trabajo','localhost/XE');
    if($c){
        $procedimiento = 'DECLARE BEGIN INI_SESION_ADMIN(:nom,:con,:res,:men); END;';
        $stmt = oci_parse($c,$procedimiento);
        oci_bind_by_name($stmt,':nom',$nombre);
        oci_bind_by_name($stmt,':con',$password);
        oci_bind_by_name($stmt,':res',$resultado,50);
        oci_bind_by_name($stmt,':men',$mensaje,500);
        oci_execute($stmt);     
        if($resultado=='TRUE'){
            $_SESSION['loged_admin'] = 'admin';
            print_r($_SESSION);
            echo session_id();
            header('Location: index.php?pagina=inicio_admin');
        }
        else{
            header('Location: index.php?pagina=login_admin');
        }
    }
}
?>