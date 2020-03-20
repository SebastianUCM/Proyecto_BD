<?php
    $origen= $_POST['ciudad_origen'];
    $destino= $_POST['ciudad_destino'];
    $partida= $_POST['fecha_partida'];
    $pasajeros= $_POST['n_pasajeros'];
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
<div class="texto-encima"><h2  style="font-family:sans-serif;">Escoge tu vuelo.</h2></div>
</div>
<div class="container">
    <table class="table table-hover">
        <thead>
            <tr>
                <th scope="col">Vuelo</th>
                <th scope="col">Hora de salida</th>
                <th scope="col">Hora de llegada</th>
                <th scope="col">Fecha de llegada</th>
                <th scope="col">Asientos disponibles</th>
                <th scope="col">Precio</th>
                <th scope="col"></th>
            </tr>
        </thead>
        <tbody>
            <?php
                if(isset($_SESSION['loged'])){ 
                    $c = oci_connect('trabajo_cliente','trabajo_cliente','localhost/XE');
                }else{
                    $c = oci_connect('trabajo_visitante','trabajo_visitante','localhost/XE'); 
                }
                if($c){
                    $select = "SELECT V.ID_VUELO,I.HORA_SALIDA,I.HORA_LLEGADA, I.FECHA_LLEGADA, V.CAPACIDAD, V.VALOR FROM trabajo.ITINERARIO I JOIN trabajo.VUELO V ON  I.ID_ITINERARIO= V.ITINERARIO WHERE I.FECHA_SALIDA ='$partida' AND I.ORIGEN= (SELECT O.ID_ORIGEN FROM trabajo.ORIGEN O JOIN trabajo.AEROPUERTO A ON  O.AEROPUERTO= A.ID_AEROPUERTO JOIN trabajo.CIUDAD C ON C.ID_CIUDAD= A.CIUDAD WHERE C.ID_CIUDAD= '$origen') AND I.DESTINO=(SELECT D.ID_DESTINO FROM trabajo.DESTINO D JOIN trabajo.AEROPUERTO A ON  D.AEROPUERTO= A.ID_AEROPUERTO JOIN trabajo.CIUDAD C ON C.ID_CIUDAD= A.CIUDAD WHERE C.ID_CIUDAD= '$destino')  ORDER BY I.HORA_SALIDA,I.FECHA_LLEGADA";
                    $stmt = oci_parse($c,$select);
                    oci_execute($stmt);
                    oci_fetch_all($stmt,$resultados);
                    for ($i=0; $i < count($resultados['ID_VUELO']); $i++) { 
                        echo '<tr class="table-secondary">';
                            echo  '<td >'.$resultados['ID_VUELO'][$i].'</td>';
                            echo  '<td >'.$resultados['HORA_SALIDA'][$i].'</td>';
                            echo  '<td >'.$resultados['HORA_LLEGADA'][$i].'</td>';
                            echo  '<td >'.$resultados['FECHA_LLEGADA'][$i].'</td>';
                            echo  '<td >'.$resultados['CAPACIDAD'][$i].'</td>';
                            echo  '<td >'.$resultados['VALOR'][$i].'</td>';
                            echo '<td>';
                                if ($resultados['CAPACIDAD'][$i] >= $pasajeros):
                                    echo '<form method="POST" action="?pagina=tarifa">';  
                                        echo '<input type="hidden" name="num_pasajeros" id="num_pasajeros" value="'. $pasajeros.'" />';
                                        echo '<input type="hidden" name= "precio" id="precio" value="'.$resultados['VALOR'][$i].'" />';
                                        echo '<input type="hidden" name="id_vuelo" id="id_vuelo" value="'. $resultados['ID_VUELO'][$i].'" />';                                
                                        echo '<button class="btn btn-success btn-block" type="submit" style="background-color: #041673;">Continuar</button>';
                                    echo '</form>';
                                else:
                                    echo '<h6 style="color:red;">No disponible</h6> ';
                                endif;
                            echo '</td>';
                        echo'</tr>';
                    }   
                }
                                                                                                
            ?>
        </tbody>
    </table>
</div>
<?php
if(count($resultados['ID_VUELO'])==0){
        echo'<div class="container" style="display: flex; justify-content: center;align-items: center;">
        <br><br><br><br><div class="alert alert-danger" role="alert"><i style="transform: scale(1.5);" class="far fa-frown" ></i> &nbsp;&nbsp; No existen vuelos para la fecha indicada, por favor intente con otra fecha si lo desea. </div>
        </div>';
    }?>
<br><br><br><br><br><br><br>

