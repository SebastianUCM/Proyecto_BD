<?php
    if(!isset($_SESSION['loged'])){
        header('Location: index.php');
    }
?>
<?php
    $boleta_seleccionada=$_POST['boleta_escogida'];
    $origen= $_POST['ciudad_origen'];
    $destino= $_POST['ciudad_destino'];
    $partida= $_POST['fecha_partida'];
    $pasajeros= $_POST['n_pasajeros'];
?>
<br><br><br>
<form method="POST">
<div class="container mt-5" style="background:  #ffe0b8;">
  <div class="row" style="padding-top: 20px;">
    <div class="col-xs-12 col-sm-12 col-md-3">
        <h6 class="text-center" style="padding-left: 10px;padding-top: 38px;">Ingrese la fecha de partida:</h6>
    </div>
    <div class="col-xs-9 col-sm-9 col-md-9">
        <div class="col-xs-12 col-md-4">
          <label> Busca tu vuelo! </label>
          <div class="form-group">
            <div class="input-group">
                <input type="text" class="form-control input-md" name="fecha_vuelo" placeholder="DD/MM/YYYY">
                <div class="input-group-btn">
                <?php
              echo '<input type="hidden" name="boleta_escogida" id="boleta_escogida" value="'. $boleta_seleccionada.'" />';

                echo '<input type="hidden" name="n_pasajeros" id="n_pasajeros" value="'. $pasajeros.'" />';
            echo '<input type="hidden" name= "fecha_partida" id="fecha_partida" value="'.$partida.'" />';
            echo '<input type="hidden" name="ciudad_origen" id="ciudad_origen" value="'. $origen.'" />';
            echo '<input type="hidden" name="ciudad_destino" id="ciudad_destino" value="'. $destino.'" />';
            ?>      
            <button type="submit" class="btn btn-md btn-warning" name="boton"><span><i class="fas fa-search"></i></span></button>
                </div>
            </div>
          </div>
        </div>
    </div>
  </div>
</div>
</form>
<br><br><br>
<?php

    if(isset($_POST['boton'])){
      $fecha_vuelo=$_POST['fecha_vuelo'];
echo'
<form method="POST" action="?pagina=cliente_asiento">
<div class="container">
        <h5>Vuelos para la fecha: '.$fecha_vuelo.'</h5>
    <table class="table table-hover">
        <thead>
            <tr>
                <th scope="col">Vuelo</th>
                <th scope="col">Hora de salida</th>               
                <th scope="col">Fecha de llegada</th>
                <th scope="col">Hora de llegada</th>
                <th scope="col">Asientos disponibles</th>
                <th scope="col"></th>
            </tr>
        </thead>
        <tbody>';

                $c = oci_connect('trabajo_cliente','trabajo_cliente','localhost/XE');
                if($c){
                    $select = "SELECT V.ID_VUELO,I.HORA_SALIDA,I.HORA_LLEGADA, I.FECHA_LLEGADA, V.CAPACIDAD, V.VALOR FROM trabajo.ITINERARIO I JOIN trabajo.VUELO V ON  I.ID_ITINERARIO= V.ITINERARIO WHERE I.FECHA_SALIDA = :fecha_vuelo AND I.ORIGEN= (SELECT O.ID_ORIGEN FROM trabajo.ORIGEN O JOIN trabajo.AEROPUERTO A ON  O.AEROPUERTO= A.ID_AEROPUERTO JOIN trabajo.CIUDAD C ON C.ID_CIUDAD= A.CIUDAD WHERE C.ID_CIUDAD= :origen) AND I.DESTINO=(SELECT D.ID_DESTINO FROM trabajo.DESTINO D JOIN trabajo.AEROPUERTO A ON  D.AEROPUERTO= A.ID_AEROPUERTO JOIN trabajo.CIUDAD C ON C.ID_CIUDAD= A.CIUDAD WHERE C.ID_CIUDAD= :destino)  ORDER BY I.HORA_SALIDA,I.FECHA_LLEGADA";
                    $stmt = oci_parse($c,$select);
                    oci_bind_by_name($stmt,':fecha_vuelo',$fecha_vuelo);
                    oci_bind_by_name($stmt,':origen',$origen);
                    oci_bind_by_name($stmt,':destino',$destino);
                    oci_execute($stmt);
                    oci_fetch_all($stmt,$resultados);
                    for ($i=0; $i < count($resultados['ID_VUELO']); $i++) { 
                        echo '<tr class="table-secondary">';
                            echo  '<td >'.$resultados['ID_VUELO'][$i].'</td>';
                            echo  '<td >'.$resultados['HORA_SALIDA'][$i].'</td>';
                            echo  '<td >'.$resultados['FECHA_LLEGADA'][$i].'</td>';
                            echo  '<td >'.$resultados['HORA_LLEGADA'][$i].'</td>';
                            echo  '<td >'.$resultados['CAPACIDAD'][$i].'</td>';
                            echo '<td>';
                                if ($resultados['CAPACIDAD'][$i] >= $pasajeros):
                                    echo '<form method="POST" action="?pagina=tarifa">';  
                                        echo '<input type="hidden" name="num_pasajeros" id="num_pasajeros" value="'. $pasajeros.'" />';
                                        echo '<input type="hidden" name= "precio" id="precio" value="'.$resultados['VALOR'][$i].'" />';
                                        echo '<input type="hidden" name="id_vuelo" id="id_vuelo" value="'. $resultados['ID_VUELO'][$i].'" />';                                
                                        echo '<button class="btn btn-success btn-block" type="submit" style="background-color: #041673;"><span><i class="fas fa-share"></i></span></button>';
                                    echo '</form>';
                                else:
                                    echo '<h6 style="color:red;">No disponible</h6> ';
                                endif;
                            echo '</td>';
                        echo'</tr>';
                    }
                }
                                                                                                
          echo'
        </tbody>
    </table>';
    if(count($resultados['ID_VUELO'])==0){
        echo'<div class="container" style="display: flex; justify-content: center;align-items: center;">
        <br><br><br><br><div class="alert alert-danger" role="alert"> <i class="fas fa-ban"></i> No hay vuelos para la fecha ingresada, intente con otra fecha.</div>
        </div>';
    } 
echo'</div>
</form>';
    }
?>
<br><br><br><br><br><br><br><br><br>