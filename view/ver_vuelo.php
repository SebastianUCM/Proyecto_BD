<?php
    if(!isset($_SESSION['loged_admin'])){
        header('Location: index.php');
    }
?>

<div class="pricing-header px-3 py-3 pt-md-5 pb-md-4 mx-auto text-center">
        <h1 class="display-4">Vuelos</h1>
 </div>
<div class="container">
    <table class="table table-hover">
        <thead>
            <tr>
                <th scope="col">ID VUELO</th>
                <th scope="col">CAPACIDAD</th>
                <th scope="col">AVION</th>
                <th scope="col">ITINERARIO</th>
                <th scope="col">VALOR</th>
                <th scope="col">ACCION</th>
            </tr>
        </thead>

        <tbody>
            <?php
                $c = oci_connect('trabajo','trabajo','localhost/XE');
                if($c){
                    $select = "SELECT * FROM VUELO";
                    $stmt = oci_parse($c,$select);
                    oci_execute($stmt);
                    oci_fetch_all($stmt,$resultados);
                    for ($i=0; $i < count($resultados['ID_VUELO']); $i++) { 
                        echo '<tr class="table-secondary">';
                            echo  '<td >'.$resultados['ID_VUELO'][$i].'</td>';
                            echo  '<td >'.$resultados['CAPACIDAD'][$i].'</td>';
                            echo  '<td >'.$resultados['AVION'][$i].'</td>';
                            echo  '<td >'.$resultados['ITINERARIO'][$i].'</td>';
                            echo  '<td >'.$resultados['VALOR'][$i].'</td>';
                            echo '<form method="POST" action="?pagina=modificar_vuelo" >
                            <input type="hidden" name= "vuelo" id="vuelo" value="'.$resultados['ID_VUELO'][$i].'"/>  
                            <td> <button class="btn btn-danger btn-block" type="submit" >Modificar</button> </td>
                            </form>';

                            echo '<form action="?pagina=eliminar_vuelo" method="POST">
                            <input type="hidden" name= "vuelo" id="vuelo" value="'.$resultados['ID_VUELO'][$i].'"/>  
                            <td> <button class="btn btn-danger btn-block" type="submit" >Eliminar</button> </td>
                            </form>';
                                                }   
                }                                                             
            ?>
        </tbody>
    </table>
    <div >
        <a type="button" class="btn btn-success" href='?pagina=vuelo'>Agregar Vuelo</a>
    </div >
</div><br><br><br>



