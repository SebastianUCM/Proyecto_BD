<?php
    if(!isset($_SESSION['loged_admin'])){
        header('Location: index.php');
    }
?>

<div class="pricing-header px-3 py-3 pt-md-5 pb-md-4 mx-auto text-center">
        <h1 class="display-4">AVIONES</h1>
 </div>
<div class="container">
    <table class="table table-hover">
        <thead>
            <tr>
                <th scope="col">ID AVIÓN</th>
                <th scope="col">MODELO</th>
                <th scope="col">CAPACIDAD</th>
                <th scope="col">AÑO</th>
                <th scope="col">ACCION</th>
            </tr>
        </thead>

        <tbody>
            <?php
                $c = oci_connect('trabajo','trabajo','localhost/XE');
                if($c){
                    $select = "SELECT * FROM AVION";
                    $stmt = oci_parse($c,$select);
                    oci_execute($stmt);
                    oci_fetch_all($stmt,$resultados);
                    for ($i=0; $i < count($resultados['ID_AVION']); $i++) { 
                        echo '<tr class="table-secondary">';
                            echo  '<td >'.$resultados['ID_AVION'][$i].'</td>';
                            echo  '<td >'.$resultados['MODELO'][$i].'</td>';
                            echo  '<td >'.$resultados['CAPACIDAD'][$i].'</td>';
                            echo  '<td >'.$resultados['ANIO'][$i].'</td>';
                            echo '<form action="?pagina=eliminar_avion" method="POST">
                            <input type="hidden" name= "avion" id="avion" value="'.$resultados['ID_AVION'][$i].'"/>  
                            <td> <button class="btn btn-danger btn-block" type="submit" >Eliminar</button> </td>
                            </form>';
                    }   
                }
                                                                                                
            ?>
        </tbody>
    </table>
    <div >
        <a type="button" class="btn btn-success" href='?pagina=avion'>Agregar Avión</a>
    </div >
</div><br><br><br>



