<?php
    if(!isset($_SESSION['loged'])){
        header('Location: index.php');
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
    background:  #f3f3f3;
    width: 900px;
    height: 400px;
    margin: 80px auto;
    position: relative;
    margin-top: 5%;
}
#registration-form .leftbox {
  float: left;
  top: -5%;
  left: 5%;
  position: absolute;
  width: 8%;
  height: 110%;
  background:  #184D94;
}
#registration-form .rightbox {
	float:right;
    background-color:#f3f3f3;
    width: 85%;
    height: 85%;
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
<br>
<div style="margin: 50px 400px;height: 10rem;align-items: center;padding: 30px;display: flex;justify-content: center;">
<img src="nube2.png"  WIDTH="550" HEIGHT="200"/>
<div class="texto-encima"><h2  style="font-family:sans-serif;">Detalle de tu viaje.</h2></div>
</div>
<form method="POST" action="?pagina=cliente_itinerario">
<div class="container  mt-5" >
    <table class="table table-hover">
        <thead>
            <tr>
                <th scope="col">BOLETA</th>
                <th scope="col">ORIGEN</th>
                <th scope="col">DESTINO</th>
                <th scope="col">FECHA SALIDA</th>
                <th scope="col">FECHA LLEGADA</th>
                <th scope="col">PASAJES COMPRADOS</th>
                <th scope="col">ESTADO</th>
                <th scope="col"></th>
            </tr>
        </thead>
        <tbody>
            <?php
                $boleta_seleccionada=$_POST['boleta_escogida'];
                $id_cliente = $_SESSION['rut'];
                $c = oci_connect('trabajo_cliente','trabajo_cliente','localhost/XE');
                if($c){
                    /* SELECT OBTENER DATOS ORIGEN  */
                    $selectx = "SELECT C.PAIS||'-'||C.NOMBRE AS ORIGENX, C.ID_CIUDAD AS ORIGENXX FROM trabajo.BOLETA B JOIN trabajo.DETALLE D ON B.ID_BOLETA=D.ID_BOLETA JOIN trabajo.PASAJE P ON P.ID_PASAJE=D.PASAJE JOIN trabajo.VUELO V ON V.ID_VUELO= P.VUELO JOIN trabajo.ITINERARIO I ON I.ID_ITINERARIO=V.ITINERARIO JOIN trabajo.ORIGEN O ON O.ID_ORIGEN= I.ORIGEN JOIN trabajo.AEROPUERTO A ON A.ID_AEROPUERTO= O.AEROPUERTO JOIN trabajo.CIUDAD C ON C.ID_CIUDAD= A.CIUDAD WHERE B.ID_BOLETA= :ID";
                    $stmtx = oci_parse($c,$selectx);
                    oci_bind_by_name($stmtx,':ID',$boleta_seleccionada);
                    oci_execute($stmtx);
                    oci_fetch_all($stmtx,$resultadosx);
                    /* SELECT OBTENER DATOS DESTINO  */
                    $selectxx = "SELECT C.PAIS||'-'||C.NOMBRE AS DESTINOX, C.ID_CIUDAD AS DESTINOXX FROM trabajo.BOLETA B JOIN trabajo.DETALLE D ON B.ID_BOLETA=D.ID_BOLETA JOIN trabajo.PASAJE P ON P.ID_PASAJE=D.PASAJE JOIN trabajo.VUELO V ON V.ID_VUELO= P.VUELO JOIN trabajo.ITINERARIO I ON I.ID_ITINERARIO=V.ITINERARIO JOIN trabajo.DESTINO D ON D.ID_DESTINO= I.DESTINO JOIN trabajo.AEROPUERTO A ON A.ID_AEROPUERTO= D.AEROPUERTO JOIN trabajo.CIUDAD C ON C.ID_CIUDAD= A.CIUDAD WHERE B.ID_BOLETA= :ID";
                    $stmtxx = oci_parse($c,$selectxx);
                    oci_bind_by_name($stmtxx,':ID',$boleta_seleccionada);
                    oci_execute($stmtxx);
                    oci_fetch_all($stmtxx,$resultadosxx);
                    /* SELECT OBTENER DATOS NUM PASAJES  */
                    $selectc = "SELECT COUNT(D.ID_BOLETA) AS NUM_PASAJ FROM trabajo.BOLETA B JOIN trabajo.DETALLE D ON B.ID_BOLETA=D.ID_BOLETA JOIN trabajo.PASAJE P ON P.ID_PASAJE=D.PASAJE WHERE B.ID_BOLETA= :ID";
                    $stmtc = oci_parse($c,$selectc);
                    oci_bind_by_name($stmtc,':ID',$boleta_seleccionada);
                    oci_execute($stmtc);
                    oci_fetch_all($stmtc,$resultadosc);
                    /* SELECT OBTENER DATOS BOLETA  */
                    $select = "SELECT DISTINCT B.ID_BOLETA,B.FECHA,I.FECHA_SALIDA,I.FECHA_LLEGADA,P.ESTADO FROM trabajo.BOLETA B JOIN trabajo.DETALLE D ON B.ID_BOLETA=D.ID_BOLETA JOIN trabajo.PASAJE P ON P.ID_PASAJE=D.PASAJE JOIN trabajo.VUELO V ON V.ID_VUELO= P.VUELO JOIN trabajo.ITINERARIO I ON I.ID_ITINERARIO=V.ITINERARIO WHERE B.ID_BOLETA= :ID";
                    $stmt = oci_parse($c,$select);
                    oci_bind_by_name($stmt,':ID',$boleta_seleccionada);
                    oci_execute($stmt);
                    oci_fetch_all($stmt,$resultados);
                    for ($i=0; $i < count($resultados['ID_BOLETA']); $i++) { 
                        echo '<tr class="table-secondary">';
                            echo  '<td >'.$resultados['ID_BOLETA'][$i].'</td>';
                            echo  '<td >'.$resultadosx['ORIGENX'][$i].'</td>';
                            echo  '<td >'.$resultadosxx['DESTINOX'][$i].'</td>';
                            echo  '<td >'.$resultados['FECHA_SALIDA'][$i].'</td>';
                            echo  '<td >'.$resultados['FECHA_LLEGADA'][$i].'</td>';
                            echo  '<td >'.$resultadosc['NUM_PASAJ'][$i].'</td>';
                            $caca=$resultados['FECHA_SALIDA'][$i];
                            $fecha_hoy = strtotime('now');
                            $fecha_otra = str_replace('/', '-', $caca);
                            $fecha_otra = strtotime($fecha_otra);
                            $estado = $resultados['ESTADO'][0];
                            if($resultados['ESTADO'][$i]== 'INVALIDO'):
                                echo '<td><span class="label label-success" style="width:380px;background-color:#9b111e;-webkit-border-radius:3px;-moz-border-radius:3px;border-radius:3px;padding:2px 4px;font-size:14.844px;font-weight:bold;line-height:14px;color:#ffffff;">Inválido</span>';
                            else:    
                                if($fecha_otra>$fecha_hoy):
                                    echo '<td><span class="label label-success" style="width:380px;background-color:#c69f05;-webkit-border-radius:3px;-moz-border-radius:3px;border-radius:3px;padding:2px 4px;font-size:14.844px;font-weight:bold;line-height:14px;color:#ffffff;">Pendiente</span>';
                                else:
                                    echo '<td><span class="label label-success" style="width:380px;background-color:#468847;-webkit-border-radius:3px;-moz-border-radius:3px;border-radius:3px;padding:2px 4px;font-size:14.844px;font-weight:bold;line-height:14px;color:#ffffff;">Realizado</span>';
                                endif;
                            endif;
                            echo '<td style=" height:50px;">
                                    <label class="radio-inline"><input type="radio" id="boleta_escogida" name="boleta_escogida" value="'.$resultados['ID_BOLETA'][$i].'" checked></label>
                                </td>';
                        $salida=$resultados['FECHA_SALIDA'][0];
                        $origen=$resultadosx['ORIGENXX'][0];
                        $destino=$resultadosxx['DESTINOXX'][0];
                    }   
                }
                $_SESSION['id_boleta_seleccionada']=$resultados['ID_BOLETA'][0];                                                            
            ?>
        </tbody>
    </table>
    <br><br>
</div><!-- container -->
<?php
            $c = oci_connect('trabajo_cliente','trabajo_cliente','localhost/XE');
            if($c){
            /* SELECT OBTENER DATOS ORIGEN  */
            $selectxx = "SELECT C.PAIS||'-'||C.NOMBRE AS ORIGENN FROM trabajo.BOLETA B JOIN trabajo.DETALLE D ON B.ID_BOLETA=D.ID_BOLETA JOIN trabajo.PASAJE P ON P.ID_PASAJE=D.PASAJE JOIN trabajo.VUELO V ON V.ID_VUELO= P.VUELO JOIN trabajo.ITINERARIO I ON I.ID_ITINERARIO= V.ITINERARIO JOIN trabajo.ORIGEN O ON O.ID_ORIGEN= I.ORIGEN JOIN trabajo.AEROPUERTO A ON A.ID_AEROPUERTO= O.AEROPUERTO JOIN trabajo.CIUDAD C ON C.ID_CIUDAD= A.CIUDAD JOIN trabajo.PAIS PS ON PS.ID_PAIS=C.PAIS WHERE B.ID_BOLETA=:id";
            $stmtxx = oci_parse($c,$selectxx);
            oci_bind_by_name($stmtxx, ':id', $boleta_seleccionada);
            oci_execute($stmtxx);
            oci_fetch_all($stmtxx,$resultadosxx);
            /* SELECT OBTENER DATOS ITINERARIO Y DESTINO  */
            $selectx = "SELECT I.FECHA_SALIDA||' - '||I.HORA_SALIDA AS SALIDA,I.FECHA_LLEGADA||' - '||I.HORA_LLEGADA AS LLEGADA,C.PAIS||'-'||C.NOMBRE AS DESTINOO FROM trabajo.BOLETA B JOIN trabajo.DETALLE D ON B.ID_BOLETA=D.ID_BOLETA JOIN trabajo.PASAJE P ON P.ID_PASAJE=D.PASAJE JOIN trabajo.VUELO V ON V.ID_VUELO= P.VUELO JOIN trabajo.ITINERARIO I ON I.ID_ITINERARIO= V.ITINERARIO JOIN trabajo.DESTINO D ON D.ID_DESTINO= I.DESTINO JOIN trabajo.AEROPUERTO A ON A.ID_AEROPUERTO= D.AEROPUERTO JOIN trabajo.CIUDAD C ON C.ID_CIUDAD= A.CIUDAD JOIN trabajo.PAIS PS ON PS.ID_PAIS=C.PAIS WHERE B.ID_BOLETA=:id";
            $stmtx = oci_parse($c,$selectx);
            oci_bind_by_name($stmtx, ':id', $boleta_seleccionada);
            oci_execute($stmtx);
            oci_fetch_all($stmtx,$resultadosx);
            /* SELECT OBTENER DATOS TARIFA */
            $selectt = "SELECT T.NOMBRE,T.ID_TARIFA FROM trabajo.BOLETA B JOIN trabajo.DETALLE D ON B.ID_BOLETA=D.ID_BOLETA JOIN trabajo.PASAJE P ON P.ID_PASAJE=D.PASAJE JOIN trabajo.TARIFA T ON T.ID_TARIFA= P.TARIFA WHERE B.ID_BOLETA=:id";
            $stmtt = oci_parse($c,$selectt);
            oci_bind_by_name($stmtt, ':id', $boleta_seleccionada);
            oci_execute($stmtt);
            oci_fetch_all($stmtt,$resultadost);
            /* SELECT OBTENER DATOS PASAJERO  */
            $select = "SELECT P.ID_PASAJE, P.ASIENTO,P.VUELO,P.PASAJERO, PA.NOMBRE ||' '||PA.APELLIDO AS NOMBRE_COMPLETO FROM trabajo.BOLETA B JOIN trabajo.DETALLE D ON B.ID_BOLETA=D.ID_BOLETA JOIN trabajo.PASAJE P ON P.ID_PASAJE=D.PASAJE JOIN trabajo.PASAJERO PA ON PA.NUMERO_DOCUMENTO= P.PASAJERO WHERE B.ID_BOLETA=:id";
            $stmt = oci_parse($c,$select);
            oci_bind_by_name($stmt, ':id', $boleta_seleccionada);
            oci_execute($stmt);
            oci_fetch_all($stmt,$resultados);
                for ($j=1; $j <=count($resultados['ID_PASAJE']); $j++){
                    echo'<div class="container" id="registration-form">
                            <div ><h1 style="float: right;margin-right: 12px;margin-top: 12px;color: #184D94;font-weight: 900;font-size: 1.5em;letter-spacing: 1px;">'.$resultados['ID_PASAJE'][$j-1].'</h1>
                            </div>
                            <div class="leftbox">
                                <nav>
                                    <a id="profile" class="active"><i class="fa fa-user"></i></a>
                            
                                </nav>
                            </div>
                            <br><br>
                            <div class="rightbox">';
                                echo'<div class="row">';
                                echo '<h6 style="margin-top: 5px;margin-left: 9px;color: #1e1e1e;transform: scale(1.1);">- <u>Nombre del pasajero</u>:  &nbsp;  ' .$resultados['NOMBRE_COMPLETO'][$j-1].'</h6> ';
                                echo'</div>';
                                echo'<div class="row">';
                                echo '<h6 style="margin-top: 5px;margin-left: 9px;color: #1e1e1e;transform: scale(1.1);">- <u>N° de documento</u>:   &nbsp; ' .$resultados['PASAJERO'][$j-1].'</h6> ';
                                echo'</div>';
                                echo '<div class="row">';
                                echo '<h6 style="margin-top: 5px;margin-left: 9px;color: #1e1e1e;transform: scale(1.1);">- <u>Asiento</u>:    &nbsp;' .$resultados['ASIENTO'][$j-1].'</h6> ';
                                echo'</div>';
                                echo '<div class="row">';
                                echo '<h6 style="margin-top: 5px;margin-left: 9px;color: #1e1e1e;transform: scale(1.1);">- <u>Origen</u>:   &nbsp; ' .$resultadosxx['ORIGENN'][$j-1].'</h6> ';
                                echo'</div>';
                                echo '<div class="row">';
                                echo '<h6 style="margin-top: 5px;margin-left: 9px;color: #1e1e1e;transform: scale(1.1);">- <u>Destino</u>:   &nbsp; ' .$resultadosx['DESTINOO'][$j-1].'</h6> ';
                                echo'</div>';
                                echo '<div class="row">';
                                echo '<h6 style="margin-top: 5px;margin-left: 9px;color: #1e1e1e;transform: scale(1.1);">- <u>Fecha de salida</u>:   &nbsp; ' .$resultadosx['SALIDA'][$j-1].'</h6> ';
                                echo'</div>';
                                echo '<div class="row">';
                                echo '<h6 style="margin-top: 5px;margin-left: 9px;color: #1e1e1e;transform: scale(1.1);">- <u>Fecha de llegada</u>:  &nbsp;  ' .$resultadosx['LLEGADA'][$j-1].'</h6> ';
                                echo'</div>';
                                echo '<div class="row">';
                                echo '<h6 style="margin-top: 5px;margin-left: 9px;color: #1e1e1e;transform: scale(1.1);">- <u>N° de vuelo</u>:   &nbsp; ' .$resultados['VUELO'][$j-1].'</h6> ';
                                echo'</div>';
                                echo '<div class="row">';
                                echo '<h6 style="margin-top: 5px;margin-left: 9px;color: #1e1e1e;transform: scale(1.1);">- <u>Tarifa</u>:   &nbsp; ' .$resultadost['NOMBRE'][$j-1].'</h6> ';
                                echo'</div>
                            </div>
                    </div>';
                }
                /* PARA INSERTARLO EN PASAJE, VISTA CLIENTE ASIENTO  */
                $_SESSION['id_tarifa']=$resultadost['ID_TARIFA'][0];
                $_SESSION['id_vuelo_antiguo']=$resultados['VUELO'][0];
}
?>
<?php
    if ($estado== 'INVALIDO'){
        echo'<div class="container  mt-5">
            <div class="alert alert-danger" role="alert">
            <h4 class="alert-heading">¡ Atención !</h4>
            <p><a  class="alert-link">Los presentes pasajes no se encuentran disponibles ya que fueron cambiados por otros al modificar el itinerario.</a></p>
            
            </div></div >';
    }
    if($fecha_otra>$fecha_hoy && $estado== 'VALIDO'){
        echo'<div class="container  mt-5">
            <div class="alert alert-warning" role="alert">
            <h4 class="alert-heading">¡Aviso!</h4>
            <p>No hay devolución, si desea podrá realizar un cambio en el itinerario pero se le aplicará una multa del <a class="alert-link">20%</a> en el total de su boleta.</p>
            <hr>
            <p class="mb-0">Saludos.</p>
            </div>';
            $_SESSION['aux'] = 1;
            echo '<input type="hidden" name="n_pasajeros" id="n_pasajeros" value="'. $resultadosc['NUM_PASAJ'][0].'" />';
            echo '<input type="hidden" name= "fecha_partida" id="fecha_partida" value="'.$salida.'" />';
            echo '<input type="hidden" name="ciudad_origen" id="ciudad_origen" value="'. $origen.'" />';
            echo '<input type="hidden" name="ciudad_destino" id="ciudad_destino" value="'. $destino.'" />';
            echo' <button type="submit" class="btn btn-success float-right" style="width:200px;background-color: #041673;">Modificar</button><br>
        </div >';
    }
?>
</form>
<br><br>