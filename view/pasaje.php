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
    background: #f3f3f3;
    width: 900px;
    height: 420px;
    margin: 80px auto;
    position: relative;
    margin-top: 5%;
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
    height: 85%;
    list-style: none;
    padding: 35px;
    display: block;

}
#profile {
  list-style: none;
  padding: 35px;
  color: black;
  font-size: 1.1em;
  display: block;
  
}  
</style>

<div style="margin: 50px 400px;height: 10rem;align-items: center;padding: 30px;display: flex;justify-content: center;">
<img src="nube2.png"  WIDTH="550" HEIGHT="200"/>
<div class="texto-encima"><h2  style="font-family:sans-serif;">Tus pasajes.</h2></div>
</div>
<?php
$rut=$_SESSION['rut'];
$asientos=$_SESSION['asientos_elegidos'];
$num=count($asientos); 

            $c = oci_connect('trabajo_cliente','trabajo_cliente','localhost/XE');
            if($c){
            /* SELECT OBTENER DATOS ORIGEN  */
            $selectxx = "SELECT C.PAIS||'-'||C.NOMBRE AS ORIGENN FROM trabajo.CARRITO C JOIN trabajo.PASAJE P ON C.ID_PASAJE=P.ID_PASAJE JOIN trabajo.VUELO V ON V.ID_VUELO= P.VUELO JOIN trabajo.ITINERARIO I ON I.ID_ITINERARIO= V.ITINERARIO JOIN trabajo.ORIGEN O ON O.ID_ORIGEN= I.ORIGEN JOIN trabajo.AEROPUERTO A ON A.ID_AEROPUERTO= O.AEROPUERTO JOIN trabajo.CIUDAD C ON C.ID_CIUDAD= A.CIUDAD JOIN trabajo.PAIS PS ON PS.ID_PAIS=C.PAIS WHERE C.ID_CLIENTE=:id";
            $stmtxx = oci_parse($c,$selectxx);
            oci_bind_by_name($stmtxx, ':id', $rut);
            oci_execute($stmtxx);
            oci_fetch_all($stmtxx,$resultadosxx);
            /* SELECT OBTENER DATOS ITINERARIO Y DESTINO  */
            $selectx = "SELECT I.FECHA_SALIDA||' - '||I.HORA_SALIDA AS SALIDA,I.FECHA_LLEGADA||' - '||I.HORA_LLEGADA AS LLEGADA,C.PAIS||'-'||C.NOMBRE AS DESTINOO FROM trabajo.CARRITO C JOIN trabajo.PASAJE P ON C.ID_PASAJE=P.ID_PASAJE JOIN trabajo.VUELO V ON V.ID_VUELO= P.VUELO JOIN trabajo.ITINERARIO I ON I.ID_ITINERARIO= V.ITINERARIO JOIN trabajo.DESTINO D ON D.ID_DESTINO= I.DESTINO JOIN trabajo.AEROPUERTO A ON A.ID_AEROPUERTO= D.AEROPUERTO JOIN trabajo.CIUDAD C ON C.ID_CIUDAD= A.CIUDAD JOIN trabajo.PAIS PS ON PS.ID_PAIS=C.PAIS WHERE C.ID_CLIENTE=:id";
            $stmtx = oci_parse($c,$selectx);
            oci_bind_by_name($stmtx, ':id', $rut);
            oci_execute($stmtx);
            oci_fetch_all($stmtx,$resultadosx);
            /* SELECT OBTENER DATOS TARIFA */
            $selectt = "SELECT T.NOMBRE,T.ID_TARIFA FROM trabajo.CARRITO C JOIN trabajo.PASAJE P ON C.ID_PASAJE=P.ID_PASAJE JOIN trabajo.TARIFA T ON T.ID_TARIFA= P.TARIFA WHERE C.ID_CLIENTE=:id";
            $stmtt = oci_parse($c,$selectt);
            oci_bind_by_name($stmtt, ':id', $rut);
            oci_execute($stmtt);
            oci_fetch_all($stmtt,$resultadost);
            /* SELECT OBTENER DATOS PASAJERO  */
            $select = "SELECT P.ID_PASAJE, P.ASIENTO,P.VUELO,P.PASAJERO, PA.NOMBRE ||' '||PA.APELLIDO AS NOMBRE_COMPLETO FROM trabajo.CARRITO C JOIN trabajo.PASAJE P ON C.ID_PASAJE=P.ID_PASAJE JOIN trabajo.PASAJERO PA ON PA.NUMERO_DOCUMENTO= P.PASAJERO WHERE C.ID_CLIENTE=:id";
            $stmt = oci_parse($c,$select);
            oci_bind_by_name($stmt, ':id', $rut);
            oci_execute($stmt);
            oci_fetch_all($stmt,$resultados);
            $datos_pasajes = array();
                for ($j=1; $j <=$num; $j++){
                    $aux = array();
                    array_push($aux,$resultados['ID_PASAJE'][$j-1]);
                    array_push($aux,$resultados['NOMBRE_COMPLETO'][$j-1]);
                    array_push($aux,$resultados['PASAJERO'][$j-1]);
                    array_push($aux,$resultados['ASIENTO'][$j-1]);
                    array_push($aux,$resultadosxx['ORIGENN'][$j-1]);
                    array_push($aux,$resultadosx['DESTINOO'][$j-1]);
                    array_push($aux,$resultadosx['SALIDA'][$j-1]);
                    array_push($aux,$resultadosx['LLEGADA'][$j-1]);
                    array_push($aux,$resultados['VUELO'][$j-1]);
                    array_push($aux,$resultadost['NOMBRE'][$j-1]);
                    array_push($datos_pasajes,$aux);
                    unset($aux);
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
                /* variable para que entre una vez a boleta  */
                $_SESSION['aux']=0;
                $_SESSION['datos_pasajes'] = $datos_pasajes;

                                           
}?>

<div class="container  mt-5">
<button type="submit" class="btn btn-success float-right" onclick="location.href='pago.php'" style="width:200px;background-color: #041673;margin-right:80px;">Continuar</button><br>
</div><br><br>