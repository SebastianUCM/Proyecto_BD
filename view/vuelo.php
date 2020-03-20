<?php
    if(!isset($_SESSION['loged_admin'])){
        header('Location: index.php');
    }
?>

<form method='POST'>
    <div class="pricing-header px-3 py-3 pt-md-5 pb-md-4 mx-auto text-center">
        <h1 class="display-4">Insertar Vuelo</h1>
    </div>
    <div class="row">
        <div class="col-sm-3"></div>
        <div class="col-sm-6">
            
            <div class="form-group">
                                                <label for="avion">Avion</label>
                                                <select class="form-control" name="avion" id="avion">
                                                <option value="">Seleccione un Avion</option>               
                                                <?php
                                                    $c = oci_connect('trabajo','trabajo','localhost/XE');
                                                    if($c){
                                                    $select = "SELECT ID_AVION FROM AVION";
                                                    $stmt = oci_parse($c,$select);
                                                    oci_execute($stmt);
                                                    oci_fetch_all($stmt,$resultados);
                                                        for ($i=0; $i < count($resultados['ID_AVION']); $i++) { 
                                                            echo '<option value="' .$resultados['ID_AVION'][$i]. '">' .$resultados['ID_AVION'][$i].' </option>';
                                                        }   
                                                    }                                        
                                                ?>
                                                </select>
                                            </div>

            <div class="form-group">
                                                <label for="itinerario">Itinerario</label>
                                                <select class="form-control" name="itinerario" id="itinerario">
                                                <option value="">Seleccione un itinerario</option>               
                                                <?php
                                                    $c = oci_connect('trabajo','trabajo','localhost/XE');
                                                    if($c){
                                                    $select = "SELECT ID_ITINERARIO FROM ITINERARIO";
                                                    $stmt = oci_parse($c,$select);
                                                    oci_execute($stmt);
                                                    oci_fetch_all($stmt,$resultados);
                                                        for ($i=0; $i < count($resultados['ID_ITINERARIO']); $i++) { 
                                                            echo '<option value="' .$resultados['ID_ITINERARIO'][$i]. '">' .$resultados['ID_ITINERARIO'][$i].' </option>';
                                                        }   
                                                    }
                                                                                            
                                                ?>
                                                </select>
                                            </div>
            <div class="form-group">
                <label for="valor">Valor</label>
                <input  type="number" class="form-control" name='valor' id="valor" required>
            </div>

            <?php
                if(isset($_POST['avion'])){
                    $avion = $_POST['avion'];
                    $itinerario = $_POST['itinerario'];
                    $valor = $_POST['valor'];                    
                    $c = oci_connect('trabajo','trabajo','localhost/XE');
                    if($c){
                        $procedimiento = 'DECLARE BEGIN INSERTAR_VUELO(:AVION,:ITINERARIO,:VALOR,:RESULTADO,:MENSAJE); END;';
                        $stmt = oci_parse($c,$procedimiento);
                        oci_bind_by_name($stmt,':AVION',$avion);
                        oci_bind_by_name($stmt,':ITINERARIO',$itinerario);
                        oci_bind_by_name($stmt,':VALOR',$valor);
                        oci_bind_by_name($stmt,':RESULTADO',$r,100);
                        oci_bind_by_name($stmt,':MENSAJE',$m,100);
                        oci_execute($stmt);
                        echo '<div class="alert alert-primary " role="alert">'.$m.'</div>';  
                    }
                }
            ?>
            
            <div >
              <button type="submit" class="btn btn-primary">Ingresar</button>
            </div >
        </div>
    </div>
</form>