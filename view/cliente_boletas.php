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
</style>
<br>
<div style="margin: 50px 400px;height: 10rem;align-items: center;padding: 30px;display: flex;justify-content: center;">
<img src="nube2.png"  WIDTH="550" HEIGHT="200"/>
<div class="texto-encima"><h2  style="font-family:sans-serif;">Revisa aquí tus compras.</h2></div>
</div>
<?php
  // Obteniendo la fecha actual del sistema con PHP
  $fechaActual = date('d/m/Y');
?>
<form method="POST" action="?pagina=cliente_boleta_seleccionada">
<div class="container  mt-5" >
    <table class="table table-hover">
        <thead >
            <tr>
                <th scope="col">BOLETA</th>
                <th scope="col">FECHA PAGO</th>
                <th scope="col">ORIGEN</th>
                <th scope="col">DESTINO</th>
                <th scope="col">FECHA DE PARTIDA</th>
                <th scope="col">PASAJES COMPRADOS</th>
                <th scope="col">ESTADO</th>
                <th scope="col"></th>
            </tr>
        </thead>
        <tbody>
            <?php
                $id_cliente = $_SESSION['rut'];
                $c = oci_connect('trabajo_cliente','trabajo_cliente','localhost/XE');
                if($c){
                    /* SELECT OBTENER DATOS ORIGEN  */
                    $selectx = "SELECT C.PAIS||'-'||C.NOMBRE AS ORIGENX FROM trabajo.BOLETA B JOIN trabajo.DETALLE D ON B.ID_BOLETA=D.ID_BOLETA JOIN trabajo.PASAJE P ON P.ID_PASAJE=D.PASAJE JOIN trabajo.VUELO V ON V.ID_VUELO= P.VUELO JOIN trabajo.ITINERARIO I ON I.ID_ITINERARIO=V.ITINERARIO JOIN trabajo.ORIGEN O ON O.ID_ORIGEN= I.ORIGEN JOIN trabajo.AEROPUERTO A ON A.ID_AEROPUERTO= O.AEROPUERTO JOIN trabajo.CIUDAD C ON C.ID_CIUDAD= A.CIUDAD WHERE B.CLIENTE= :ID";
                    $stmtx = oci_parse($c,$selectx);
                    oci_bind_by_name($stmtx,':ID',$id_cliente);
                    oci_execute($stmtx);
                    oci_fetch_all($stmtx,$resultadosx);
                    /* SELECT OBTENER DATOS DESTINO  */
                    $selectxx = "SELECT C.PAIS||'-'||C.NOMBRE AS DESTINOX FROM trabajo.BOLETA B JOIN trabajo.DETALLE D ON B.ID_BOLETA=D.ID_BOLETA JOIN trabajo.PASAJE P ON P.ID_PASAJE=D.PASAJE JOIN trabajo.VUELO V ON V.ID_VUELO= P.VUELO JOIN trabajo.ITINERARIO I ON I.ID_ITINERARIO=V.ITINERARIO JOIN trabajo.DESTINO D ON D.ID_DESTINO= I.DESTINO JOIN trabajo.AEROPUERTO A ON A.ID_AEROPUERTO= D.AEROPUERTO JOIN trabajo.CIUDAD C ON C.ID_CIUDAD= A.CIUDAD WHERE B.CLIENTE= :ID";
                    $stmtxx = oci_parse($c,$selectxx);
                    oci_bind_by_name($stmtxx,':ID',$id_cliente);
                    oci_execute($stmtxx);
                    oci_fetch_all($stmtxx,$resultadosxx);
                    /* SELECT OBTENER DATOS NUM PASAJES  */
                    $selectc = "SELECT COUNT(D.PASAJE) AS NUM_PASAJ FROM trabajo.BOLETA B JOIN trabajo.DETALLE D ON B.ID_BOLETA=D.ID_BOLETA JOIN trabajo.PASAJE P ON P.ID_PASAJE=D.PASAJE WHERE B.CLIENTE= :ID GROUP BY B.ID_BOLETA";
                    $stmtc = oci_parse($c,$selectc);
                    oci_bind_by_name($stmtc,':ID',$id_cliente);
                    oci_execute($stmtc);
                    oci_fetch_all($stmtc,$resultadosc);
                    /* SELECT OBTENER DATOS BOLETA  */
                    $select = "SELECT DISTINCT B.ID_BOLETA,B.FECHA,I.FECHA_SALIDA,P.ESTADO FROM trabajo.BOLETA B JOIN trabajo.DETALLE D ON B.ID_BOLETA=D.ID_BOLETA JOIN trabajo.PASAJE P ON P.ID_PASAJE=D.PASAJE JOIN trabajo.VUELO V ON V.ID_VUELO= P.VUELO JOIN trabajo.ITINERARIO I ON I.ID_ITINERARIO=V.ITINERARIO WHERE B.CLIENTE= :ID ORDER BY B.ID_BOLETA";
                    $stmt = oci_parse($c,$select);
                    oci_bind_by_name($stmt,':ID',$id_cliente);
                    oci_execute($stmt);
                    oci_fetch_all($stmt,$resultados);
                    for ($i=0; $i < count($resultados['ID_BOLETA']); $i++) { 
                        echo '<tr class="table-secondary">';
                            echo  '<td >'.$resultados['ID_BOLETA'][$i].'</td>';
                            echo  '<td >'.$resultados['FECHA'][$i].'</td>';
                            echo  '<td >'.$resultadosx['ORIGENX'][$i].'</td>';
                            echo  '<td >'.$resultadosxx['DESTINOX'][$i].'</td>';
                            echo  '<td >'.$resultados['FECHA_SALIDA'][$i].'</td>';
                            echo  '<td >'.$resultadosc['NUM_PASAJ'][$i].'</td>';
                            $caca=$resultados['FECHA_SALIDA'][$i];
                            $fecha_hoy = strtotime('now');
                            $fecha_otra = str_replace('/', '-', $caca);
                            $fecha_otra = strtotime($fecha_otra);
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
                    }   
                }  
                                                                          
            ?>
        </tbody>
    </table>
    <br><br>
    <?php
    if(count($resultados['ID_BOLETA'])==0){
        echo'<div class="container" style="display: flex; justify-content: center;align-items: center;">
        <br><br><br><br><div class="alert alert-danger" role="alert"><i style="transform: scale(1.5);" class="far fa-frown" ></i> &nbsp;&nbsp; Usted no posee compras por el momento, dirígase a comprar pasajes si lo desea. </div>
        </div>';
    }else{
    echo'<div >
        <button type="submit" class="btn btn-success float-right" style="width:200px;background-color: #041673;">Ver</button><br>
    </div >';
    }?>
</div>
</form>
<br><br><br><br><br><br>