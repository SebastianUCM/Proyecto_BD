<?php
    if(!isset($_SESSION['loged_admin'])){
        header('Location: index.php');
    }
?>

<div class="pricing-header px-3 py-3 pt-md-5 pb-md-4 mx-auto text-center">
        <h1 class="display-4">Ciudades</h1>
 </div>
<div class="container">
    <table class="table table-hover">
        <thead>
            <tr>
                <th scope="col">ID CIUDAD</th>
                <th scope="col">NOMBRE</th>
                <th scope="col">ID PAIS</th>
                <th scope="col">ACCION</th>
            </tr>
        </thead>

        <tbody>
            <?php
                $c = oci_connect('trabajo','trabajo','localhost/XE');
                if($c){
                    $select = "SELECT * FROM CIUDAD";
                    $stmt = oci_parse($c,$select);
                    oci_execute($stmt);
                    oci_fetch_all($stmt,$resultados);
                    for ($i=0; $i < count($resultados['ID_CIUDAD']); $i++) { 
                        echo '<tr class="table-secondary">';
                            echo  '<td >'.$resultados['ID_CIUDAD'][$i].'</td>';
                            echo  '<td >'.$resultados['NOMBRE'][$i].'</td>';
                            echo  '<td >'.$resultados['PAIS'][$i].'</td>';
                            echo '<form action="?pagina=eliminar_ciudad" method="POST">
                            <input type="hidden" name= "ciudad" id="ciudad" value="'.$resultados['ID_CIUDAD'][$i].'"/>  
                            <td> <button class="btn btn-danger btn-block" type="submit" >Eliminar</button> </td>
                            </form>';
                    }   
                }                                                             
            ?>
        </tbody>
    </table>
    <div >
        <a type="button" class="btn btn-success" href='?pagina=ciudad'>Agregar Ciudad</a>
    </div >
</div>
<br><br><br>



