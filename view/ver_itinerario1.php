<?php
    if(!isset($_SESSION['loged_admin'])){
        header('Location: index.php');
    }
?>

<div class="pricing-header px-3 py-3 pt-md-5 pb-md-4 mx-auto text-center">
        <h1 class="display-4">Itinerario</h1>
 </div>
<div class="container">
    <table class="table table-hover">
        <thead>
            <tr>
                <th scope="col">ID ITINERARIO</th>
                <th scope="col">FECHA SALIDA</th>
                <th scope="col">HORA SALIDA</th>
                <th scope="col">FECHA LLEGADA</th>
                <th scope="col">HORA LLEGADA</th>
                <th scope="col">ORIGEN</th>
                <th scope="col">DESTINO</th>
                <th scope="col">ACCION</th>
            </tr>
        </thead>

        <tbody>
            <?php
                $c = oci_connect('trabajo','trabajo','localhost/XE');
                if($c){
                    $select = "SELECT * FROM ITINERARIO";
                    $stmt = oci_parse($c,$select);
                    oci_execute($stmt);
                    oci_fetch_all($stmt,$resultados);
                    for ($i=0; $i < count($resultados['ID_ITINERARIO']); $i++) { 
                        echo '<tr class="table-secondary">';
                            echo  '<td >'.$resultados['ID_ITINERARIO'][$i].'</td>';
                            echo  '<td >'.$resultados['FECHA_SALIDA'][$i].'</td>';
                            echo  '<td >'.$resultados['HORA_SALIDA'][$i].'</td>';
                            echo  '<td >'.$resultados['FECHA_LLEGADA'][$i].'</td>';
                            echo  '<td >'.$resultados['HORA_LLEGADA'][$i].'</td>';
                            echo  '<td >'.$resultados['ORIGEN'][$i].'</td>';
                            echo  '<td >'.$resultados['DESTINO'][$i].'</td>';
                            echo '<form method="POST" action="?pagina=modificar_itinerario" >
                            <input type="hidden" name= "itinerario" id="itinerario" value="'.$resultados['ID_ITINERARIO'][$i].'"/>  
                            <td> <button class="btn btn-danger btn-block" type="submit" >Modificar</button> </td>
                            </form>';

                            echo '<form action="?pagina=eliminar_itinerario1" method="POST">
                            <input type="hidden" name= "itinerario" id="itinerario" value="'.$resultados['ID_ITINERARIO'][$i].'"/>  
                            <td> <button class="btn btn-danger btn-block" type="submit" >Eliminar</button> </td>
                            </form>';
                                                }   
                }                                                             
            ?>
        </tbody>
    </table>
    <div >
        <a type="button" class="btn btn-success" href='?pagina=itinerario1'>Agregar itinerario</a>
    </div >
</div><br><br><br>



