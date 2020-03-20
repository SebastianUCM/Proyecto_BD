<?php
    if(!isset($_SESSION['loged'])){
        header('Location: index.php');
    }
?>
<?php
/* FUNCION PARA INSERTAR PASAJEROS EN SU TABLA  E INSERTARLOS EN PASAJE CON SU ASIENTO */  
if(isset($_POST['botonpp'])){
    $asientos=$_SESSION['asientos_elegidos'];
    $id_boleta=$_SESSION['id_boleta_seleccionada'];
    $num=count($asientos);
    for ($k=1; $k <=$num; $k++) { 
        $num_doc= $_POST['num_doc'.$k.''];
        $asientop=$asientos[$k-1];                          
        $conexion = oci_connect('trabajo_cliente','trabajo_cliente','localhost/XE');
        if($conexion){
            $procedimiento = 'DECLARE BEGIN trabajo.INSERTAR_PASAJERO_DOS(:id,:asientop,:id_boleta,:res,:men); END;';
            $stmt = oci_parse($conexion,$procedimiento);
            oci_bind_by_name($stmt,':id',$num_doc);
            oci_bind_by_name($stmt,':asientop',$asientop);
            oci_bind_by_name($stmt,':id_boleta',$id_boleta);
            oci_bind_by_name($stmt,':res',$resultado,50);
            oci_bind_by_name($stmt,':men',$mensaje,500);
            oci_execute($stmt);
            if($resultado=='FALSE'){
                    /* variable para mostrar error en pasajero  */
                    $_SESSION['auxx']=1;
                    $_SESSION['mensaje']=$mensaje;
                    $procedimientoo = 'DECLARE BEGIN trabajo.QUITAR_PASAJERO(:id); END;';
                    $stmto = oci_parse($conexion,$procedimientoo);
                    oci_bind_by_name($stmto,':id',$num_doc);
                    oci_execute($stmto);
                    header("Status: 301 Moved Permanently");
                    header("Location: http://localhost/prueba2/?pagina=cliente_pasajero");
                    exit;   
            }
        }         
    }
    header("Status: 301 Moved Permanently");
    header("Location: http://localhost/prueba2/?pagina=cliente_pasaje");
    exit;
    
}
?>
<style>
#registration-form{
    background: #f3f3f3;
    width: 900px;
    height: 230px;
    margin: 80px auto;
    position: relative;
    margin-top: 6%;
}

#registration-form .leftbox {
  float: left;
  top: -5%;
  left: 5%;
  position: absolute;
  width: 7%;
  height: 110%;
  background:#184D94;
}
 
#registration-form .rightbox {
	float:right;
    background-color:#f3f3f3;
    width: 85%;
    height: 80%;
    list-style: none;
    padding: 35px;
    display: block;

}
#profile {
  list-style: none;
  padding: 23px;
  color: black;
  font-size: 1.1em;
  display: block; 
}  
</style>
<br><br><br><br><br><br>

<div class="container" style="display: flex; justify-content: center;align-items: center;">
    <div class="card text-white bg-dark mb-3" style="border-width:2px; border-radius:10px;width:900px;">
        <div class="card-header" style="font-size: 20px;background:  #f29175;"><i class="far fa-clipboard"></i> Información pasajeros</div>
        <div class="card-body" style="background:#feebed;">
        <table class="table table-borderless">
			<thead >
				<tr>
					<th>#</th>
					<th>N° documento</th>
                    <th>Tipo documento</th>
					<th>Nombre</th>
                    <th>Fecha nacimiento</th>
                    <th>Teléfono</th>
				</tr>
			</thead>
			<tbody>
            <?php
                $id_boleta=$_SESSION['id_boleta_seleccionada'];
                $c = oci_connect('trabajo_cliente','trabajo_cliente','localhost/XE');
                if($c){
                    $select = "SELECT PA.NUMERO_DOCUMENTO,PA.TIPO_DOCUMENTO, PA.NOMBRE ||' '||PA.APELLIDO AS NOMBRE_COMPLETO,PA.FECHA_NACIMIENTO, PA.TELEFONO FROM trabajo.BOLETA B JOIN trabajo.DETALLE D ON B.ID_BOLETA=D.ID_BOLETA JOIN trabajo.PASAJE P ON P.ID_PASAJE=D.PASAJE JOIN trabajo.PASAJERO PA ON PA.NUMERO_DOCUMENTO= P.PASAJERO WHERE B.ID_BOLETA=:id";
                    $stmt = oci_parse($c,$select);
                    oci_bind_by_name($stmt,':id',$id_boleta);
                    oci_execute($stmt);
                    oci_fetch_all($stmt,$resultados);
                    $k=1;
                    for ($i=0; $i < count($resultados['NUMERO_DOCUMENTO']); $i++) {            
                        echo '<tr>';
                            echo  '<td >'.$k.'</td>';
                            echo  '<td >'.$resultados['NUMERO_DOCUMENTO'][$i].'</td>';
                            echo  '<td >'.$resultados['TIPO_DOCUMENTO'][$i].'</td>';
                            echo  '<td >'.$resultados['NOMBRE_COMPLETO'][$i].'</td>';
                            echo  '<td >'.$resultados['FECHA_NACIMIENTO'][$i].'</td>';
                            echo  '<td >'.$resultados['TELEFONO'][$i].'</td>';                               
                        echo'</tr>';
                        $k=$k+1;
                    }   
                }
            ?>							
			</tbody>
		</table>
        </div>
    </div>
</div>
<br><br><br>
<div class="container" style="display: flex; justify-content: left;align-items: center;margin-left:170px;">
<div class="alert alert-info" role="alert"><strong>¡Atención!</strong> A continuación ingrese cada n° de documento en el asiento correspodiente a elegir.</div>
</div>
<?php
if($_SESSION['auxx']==1){
    $mensaje=$_SESSION['mensaje'];
    echo'<div class="container" style="display: flex; justify-content: left;align-items: center;margin-left:170px;">
    <div class="alert alert-danger" role="alert"><i class="fas fa-exclamation-circle"></i></i><strong> Ha ocurrido un problema: </strong><hr style="border: 1px;">'.$mensaje.'</div>
    </div> ';   
}
?>
<?php
$asientos=$_SESSION['asientos_elegidos'];
$num=count($asientos); 
echo'<form method="POST" action="?pagina=cliente_pasajero">';
for ($j=1; $j <=$num; $j++) {

    $num_doc='num_doc'.$j;
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
                <div class="row">
                    <div class="col-md-4 mb-3">
                    <h5 style="margin-top: 30px;margin-left: 9px;transform: scale(1.1);">Asiento: &nbsp;&nbsp;'.$asientos[$j-1].'</h5>  
                    </div>
                    <div class="col-md-2 mb-3">
                    <h5 style="margin-top: 30px;transform: scale(1.5);"><i class="fas fa-arrow-right"></i></h5>
                    
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="'.$num_doc.'">Número de documento:</label>
                        <input type="text" class="form-control" name="'.$num_doc.'" id="'.$num_doc.'" placeholder="Ingrese su n° de documento" required>
                    </div>
                </div><!-- 1 row -->
                
                
                
        </div>
</div>';}
echo '<div class="container  mt-5">
<button type="submit" class="btn btn-success float-right" name="botonpp" style="width:200px;background-color: #041673;margin-right: 100px">Continuar</button>
</div><br><br><br><br>';
echo '</form>';

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