<?php
    if(!isset($_SESSION['loged'])){
        header('Location: index.php');
    }
?>
<?php
if(isset($_POST['boton_p'])){
    $asientos=$_SESSION['asientos_elegidos'];
    $num=count($asientos);
    for ($k=1; $k <=$num; $k++) { 
        $nombrep= $_POST['nombrep'.$k.''];
        $apellidop=$_POST['apellidop'.$k.''];
        $tipo_doc=$_POST['tipo_doc'.$k.''];
        $num_doc= $_POST['num_doc'.$k.''];
        $vencimiento=$_POST['vencimiento'.$k.''];
        $generop=$_POST['generop'.$k.''];
        $nacimiento=$_POST['nacimiento'.$k.''];
        $telef=$_POST['telef'.$k.''];
        $emailp=$_POST['emailp'.$k.''];
        $nacion=$_POST['nacion'.$k.''];
        $asientop=$asientos[$k-1];
                           
        $conexion = oci_connect('trabajo_cliente','trabajo_cliente','localhost/XE');
        if($conexion){
            $procedimiento = 'DECLARE BEGIN trabajo.INSERTAR_PASAJERO(:id,:nombrep,:apellidop,:nacimiento,:generop,:tipo_doc,:vencim,:telef,:email,:nacion,:asientop,:res,:men); END;';
            $stmt = oci_parse($conexion,$procedimiento);
            oci_bind_by_name($stmt,':id',$num_doc);
            oci_bind_by_name($stmt,':nombrep',$nombrep);
            oci_bind_by_name($stmt,':apellidop',$apellidop);
            oci_bind_by_name($stmt,':nacimiento',$nacimiento);
            oci_bind_by_name($stmt,':generop',$generop);
            oci_bind_by_name($stmt,':tipo_doc',$tipo_doc);
            oci_bind_by_name($stmt,':vencim',$vencimiento);
            oci_bind_by_name($stmt,':telef',$telef);
            oci_bind_by_name($stmt,':email',$emailp);
            oci_bind_by_name($stmt,':nacion',$nacion);
            oci_bind_by_name($stmt,':asientop',$asientop);
            oci_bind_by_name($stmt,':res',$resultado,50);
            oci_bind_by_name($stmt,':men',$mensaje,500);
            oci_execute($stmt);
            if($resultado=='FALSE'){
                    header("Status: 301 Moved Permanently");
                    header("Location: http://localhost/prueba2/?pagina=pasajero");
                    exit;   
            }
        }         
    }
    header("Status: 301 Moved Permanently");
    header("Location: http://localhost/prueba2/?pagina=pasaje");
    exit;
}
?>
<style>
.texto-encima{
    position: absolute;
    top: 28%;
    left: 50%;
    transform: translate(-50%, -50%);
}
#registration-form{
    background: #f3f3f3;
    width: 900px;
    height: 630px;
    margin: 80px auto;
    position: relative;
    margin-top: 6%;
}

#registration-form .leftbox {
  float: left;
  top: -5%;
  left: 5%;
  position: absolute;
  width: 9%;
  height: 110%;
  background:  #184D94;
}
 
#registration-form .rightbox {
	float:right;
    background-color: #f3f3f3;
    width: 85%;
    height: 90%;
    list-style: none;
    padding: 35px;
    display: block;

}
#profile {
  list-style: none;
  padding: 30px;
  color: black;
  font-size: 1.1em;
  display: block;
  
}  
</style>

<div style="margin: 50px 400px;height: 10rem;align-items: center;padding: 30px;display: flex;justify-content: center;">
<img src="nube2.png"  WIDTH="550" HEIGHT="200"/>
<div class="texto-encima"><h2  style="font-family:sans-serif;">Información pasajero/s.</h2></div>
</div>

 <?php
$asientos=$_SESSION['asientos_elegidos'];
$num=count($asientos); 
echo'<form method="POST" action="?pagina=pasajero">';
for ($j=1; $j <=$num; $j++) {
    $nombrep='nombrep'.$j;
    $apellidop='apellidop'.$j;
    $tipo_doc='tipo_doc'.$j;
    $num_doc='num_doc'.$j;
    $vencimiento='vencimiento'.$j;
    $generop='generop'.$j;
    $nacimiento='nacimiento'.$j;
    $telef='telef'.$j;
    $emailp='emailp'.$j;
    $nacion='nacion'.$j;
echo'<div class="container" id="registration-form">
        <div ><h1 style="float: right;margin-right: 12px;margin-top: 12px;color: #184D94;font-weight: 900;font-size: 1.5em;letter-spacing: 1px;">PASAJERO '.$j. '</h1>
        </div>
        <div class="leftbox">
            <nav>
            <a id="profile" class="active"><i class="fa fa-user"></i></a>

            </nav>
        </div>
        <br><br>
        <div class="rightbox">
        <h4 style="margin-top: 10px;margin-left: 9px;color: #3FB6A8;transform: scale(1.1);">Asiento: '.$asientos[$j-1].'</h4>
                <div class="row">
                    <div class="col-md-6 mb-3">
                    <div class="form-group">
                        <label for="'.$nombrep.'">Nombre:</label>
                        <input type="text" class="form-control" id="'.$nombrep.'" name="'.$nombrep.'" placeholder="Ingrese su nombre" required>
                    </div>
                    </div>
                    <div class="col-md-6 mb-3">
                    <div class="form-group">
                        <label for="'.$apellidop.'">Apellido:</label>
                        <input type="text" class="form-control" id="'.$apellidop.'" name="'.$apellidop.'" placeholder="Ingrese su apellido" required>
                    </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="'.$tipo_doc.'">Tipo de documento:</label>
                        <select class="form-control" name="'.$tipo_doc.'" id="'.$tipo_doc.'" required>
                            <option value="">Seleccione...</option>
                            <option value="RUT">RUT</option>
                            <option value="DNI">DNI</option>
                            <option value="PASAPORTE">PASAPORTE</option>
                            <option value="RG">RG</option>
                        </select>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="'.$num_doc.'">Número de documento:</label>
                        <input type="text" class="form-control" name="'.$num_doc.'" id="'.$num_doc.'" placeholder="Ingrese su n° de documento" required>
                    </div>
                </div><!-- 1 row -->
                <div class="row">
                    <div class="col-md-7 mb-3">
                        <label for="'.$vencimiento. '">Fecha vencimiento de documento:</label>
                        <input type="text" class="form-control" name="'.$vencimiento. '" id="'.$vencimiento. '" placeholder="DD/MM/YYYY" required>
                    </div> 
                    <div class="col-md-5 mb-3">
                        <label for="'.$generop. '">Género:</label>
                            <select class="form-control" name="'.$generop. '" id="'.$generop. '" required>
                                <option value="">Seleccione...</option>
                                <option value="FEMENINO">FEMENINO</option>
                                <option value="MASCULINO">MASCULINO</option>
                            </select>
                    </div>
                            
                </div><!-- 3 row -->
                <div class="row">
                    <div class="col-md-7 mb-3">
                        <div class="form-group">
                            <label for="'.$nacimiento. '">Fecha de nacimiento:</label>
                            <input type="text" class="form-control" name="'.$nacimiento. '" id="'.$nacimiento. '" placeholder="DD/MM/YYYY" required>
                        </div>
                    </div>
                    <div class="col-md-5 mb-3">
                        <div class="form-group">
                            <label for="'.$telef. '">Teléfono: </label>
                            <input type="text" class="form-control" name="'.$telef. '" id="'.$telef. '" placeholder="Ingrese su nº de teléfono" required>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-7 mb-3">
                        <div class="form-group">
                            <label for="'.$emailp. '">Correo:</label>
                            <input type="email" class="form-control" id="'.$emailp. '" name="'.$emailp. '" placeholder="ejemplo@ejemplo.com" required>
                        </div>
                    </div>
                    <div class="col-md-5 mb-3">
                        <div class="form-group">
                            <label for="'.$nacion. '">Nacionalidad:</label>
                            <input type="text" class="form-control" id="'.$nacion. '" name="'.$nacion. '" placeholder="Ingrese su nacionalidad" required>
                        </div>
                    </div>
                </div>
        </div>
</div>';}

echo '<div class="container  mt-5">
<button type="submit" class="btn btn-success float-right" name="boton_p" style="width:200px;background-color: #041673;margin-right:80px;">Continuar</button><br>
</div><br><br>';
echo '</form>';
?>

<?php 
/* FUNCION PARA INSERTAR CADA ASIENTO EN UN PASAJE - TABLA PASAJE */  
$asientos=$_SESSION['asientos_elegidos'];
$num=count($asientos);
for($n=0;$n <$num;$n++){
        if(isset($_SESSION['loged'])){            
            $id_asiento= $asientos[$n];
            $id_usuario= $_SESSION['rut'];
            $conexion = oci_connect('trabajo_cliente','trabajo_cliente','localhost/XE');
            if($conexion){
                $procedimiento = 'DECLARE BEGIN trabajo.INSERTAR_ASIENTO_PASAJE(:asiento,:id_cliente); END;';
                $stmt = oci_parse($conexion,$procedimiento);
                oci_bind_by_name($stmt,':asiento',$id_asiento);
                oci_bind_by_name($stmt,':id_cliente',$id_usuario);
                oci_execute($stmt);
            } 
        }      
    
}
?>
