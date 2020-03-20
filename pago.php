<?php
    session_start();
?>
<?php
    if(!isset($_SESSION['loged'])){
        header('Location: index.php');
    }
?>
<!doctype html>
<html lang="es">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css"
        integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

    <style>
        hr{
            visibility:hidden
        }
        body{
  background-color: #f3f3f3;
  
}
    </style>
      <!-- Bootstrap core CSS -->
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="css/scrolling-nav.css" rel="stylesheet">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">

    <title>Banco UCM</title>

<body>
    <div class="pricing-header px-3 py-3 pt-md-5 pb-md-4 mx-auto text-center">
        <h1 class="display-4">BANCO UCM </h1>
        <img class="mb-4" src="pago.png" alt="" width="72" height="72">
    </div>
    <div class="container">
            <div class="row">
                <div class="col-sm"> </div>
                <div class="col-sm">
                    <div class="card border-info mb-3" style="width: 30rem;">
                     <div class="card-header">PAGO</div>
                    <div class="card-body">

                    <label for="n_tarjeta">Número de tarjeta</label>
                    <div class="input-group form-group">
                    <div class="input-group-prepend">
					<span class="input-group-text"><i class="fas fa-credit-card"></i></i></span>
				</div>
                    <input type="text" class="form-control" name="n_tarjeta" id="n_tarjeta" placeholder="Ingresa tu número de tarjeta" required="">
                    </div> 

                    <div class="form-group">
                    <label for="t_tarjeta">Tipo tarjeta</label>
                    <select class="form-control" name="t_tarjeta" id="t_tarjeta" required>
                        <option value="">Seleccione...</option>
                                <option value="CREDITO">CRÉDITO</option>
                                <option value="DEBITO">DÉBITO</option>
                    </select>
                    </div> 

                    <div class="row ">
                        <div class="col-md-3 col-sm-3 col-xs-3">
                            <label for="cvv">CVV</label>
                            <input type="number" class="form-control" name="cvv" id="cvv" placeholder="CCV">
                        </div>
                        <div class="col-md-4 col-sm-3 col-xs-3">
                            <label for="mes">Mes expiración</label>
                            <input type="text" class="form-control" name="mes" id="mes" placeholder="Mes">
                        </div>
                        <div class="col-md-4 col-sm-3 col-xs-3">
                            <label for="anio">Año expiración</label>
                            <input type="number" class="form-control" name="anio" id="anio" placeholder="Año">
                        </div>
                    </div><!-- row -->
                    <br>
                    
                    <?php
                    $id= $_SESSION['rut'];
                    $c = oci_connect('trabajo_cliente','trabajo_cliente','localhost/XE');
                    if($c){
                    $procedimiento = 'DECLARE BEGIN trabajo.OBTENER_PAGO_TOTAL(:id,:valor); END;';
                        $stmt = oci_parse($c,$procedimiento);
                        oci_bind_by_name($stmt,':id',$id);
                        oci_bind_by_name($stmt,':valor', $valor,-1,OCI_B_INT);
                        oci_execute($stmt);                    
                    echo'
                   <div class="form-row">
                        <div class="col-md-12">
                        <div class="form-control total btn btn-info disabled" style="background-color: #041673;">Total: &nbsp; &nbsp;  <span class="amount">$'.$valor.'</span>  &nbsp;<i class="fas fa-coins"></i>';
                    }   
                    ?>
                        </div>
                        </div>
                    </div>
                    
                    <br>
                    <div class="row ">
                        <div class="col-md-6 col-sm-6 col-xs-6 pad-adjust">
                            <button type="submit"  class="btn btn-danger" value="CANCELAR" onclick="location.href='index.php'" >CANCELAR</button>
                        </div>
                        <div class="col-md-6 col-sm-6 col-xs-6 pad-adjust">
                            <button type="submit"  class="btn btn-warning btn-block" value="PAGAR" onclick="location.href='boleta.php'">PAGAR &nbsp;&nbsp;&nbsp;&nbsp;<i class="fas fa-lock"></i></button>
                        </div>
                    </div><!-- row -->
                    </div><!-- card-->
                </div> <!-- col -->
            </div><!-- row -->
            <div class="col-sm"> </div>  
    </div><!--container-->
<body>
<br><br><br>
