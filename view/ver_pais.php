<?php
    if(!isset($_SESSION['loged_admin'])){
        header('Location: index.php');
    }
?>

 <div class="pricing-header px-3 py-3 pt-md-5 pb-md-4 mx-auto text-center">
        <h1 class="display-4">PAISES</h1>
 </div>
<div class="container">
    <table class="table table-hover">
        <thead>
            <tr>
                <th scope="col">ID PAIS</th>
                <th scope="col">NOMBRE</th>
                <th scope="col">ACCION</th>
            </tr>
        </thead>

        <tbody>
            <?php
                $c = oci_connect('trabajo','trabajo','localhost/XE');
                if($c){
                    $select = "SELECT * FROM PAIS";
                    $stmt = oci_parse($c,$select);
                    oci_execute($stmt);
                    oci_fetch_all($stmt,$resultados);
                    for ($i=0; $i < count($resultados['ID_PAIS']); $i++) { 
                        echo '<tr class="table-secondary">';
                            echo  '<td >'.$resultados['ID_PAIS'][$i].'</td>';
                            echo  '<td >'.$resultados['NOMBRE'][$i].'</td>';
                            echo '<form action="?pagina=modificar_pais" method="POST">
                            <input type="hidden" name= "pais" id="pais" value="'.$resultados['ID_PAIS'][$i].'"/>  
                            <td> <button class="btn btn-success btn-block" type="submit" >Modificar</button> </td>
                            </form>';
                            echo '<form action="?pagina=eliminar_pais" method="POST">
                            <input type="hidden" name= "pais" id="pais" value="'.$resultados['ID_PAIS'][$i].'"/>  
                            <td> <button class="btn btn-danger btn-block" type="submit" >Eliminar</button> </td>
                            </form>';
                    }   
                }
                                                                                                
            ?>
        </tbody>
    </table>
    <div >
        <a type="button" class="btn btn-success" href='?pagina=pais'>Agregar País</a>
    </div >
</div>
<br><br>



