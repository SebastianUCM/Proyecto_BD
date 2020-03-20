<?php
    $pasajeros= $_POST['num_pasajeros'];
    $valor= $_POST['precio'];
    $id_v= $_POST['id_vuelo'];
    $total_pasajes= $valor*$pasajeros;
    $_SESSION['id_v']=$id_v;
?>

               

<hr/>
<nav class="navbar navbar-dark bg-dark justify-content-between">
<a class="navbar-brand"></a>
    <div class="dropdown">
        <button type="button" class="btn btn-success dropdown-toggle"  id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="width:300px;">
            Tu carrito &nbsp;&nbsp; <i class="fas fa-shopping-cart"></i>
        </button>
        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
            <div class="card" >
                <div class="card-body">
                    <h5 class="card-title">Carro</h5>
                    <?php echo '<li class="list-group-item d-flex justify-content-between lh-condensed">
                        <div>
                            <h6 class="my-0">Pasaje</h6>
                        </div>
                    <span class="text-muted">'.$pasajeros.'</span>
                    </li>';?>

                    <?php echo '<li class="list-group-item d-flex justify-content-between lh-condensed">
                        <div>
                            <h6 class="my-0">Valor Pasaje</h6>
                        </div>
                    <span class="text-muted">'.$valor.'</span>
                    </li>';?>
                    <?php echo '<li class="list-group-item d-flex justify-content-between">
                            <span>Total (CLP)</span>
                            <strong>'.$total_pasajes.'</strong> 
                            </li>';?>
                    <p class="card-text"> ¡Aprovecha y compra! Viaja cómodo y con más espacio con Aero Sky.</p>

                </div>
            </div>
        </div>
    </div>
  
</nav>

<style>
.texto-encima{
    position: absolute;
    top: 40%;
    left: 50%;
    transform: translate(-50%, -50%);
}
.texto-encima2{
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
}
</style>
<div style="margin: 50px 400px;height: 10rem;align-items: center;padding: 30px;display: flex;justify-content: center;">
<img src="nube2.png"  WIDTH="550" HEIGHT="200"/>
<div class="texto-encima"><h1  style="font-family:sans-serif;">Tarifas.</h1>
</div>
<h5 class="lead texto-encima2" >Escoge una de las 3 tarifas que tenemos para ti.</h5>
</div>


<div class="container">
<form method="POST" action="?pagina=asiento">
    <div class="card-deck mb-3 text-center">
        
            <div class="card mb-4 shadow-sm" style="border-color: #184D94; border-width:2px;">
                <div class="card-header">
                    <h4 class="my-0 font-weight-normal">Tarifa cero</h4>
                </div>
                <div class="card-body">
                    <h1 class="card-title pricing-card-title">$0</h1>
                    <ul class="list-unstyled mt-3 mb-4" align="left">
                    <li>&#x2705;Pasaje aéreo</li>
                    <li>&#x2705;1 Bolso de mano</li>
                    <li>&#10060;1 Equipaje de mano</li>
                    <li>&#10060;1 Equipaje de bodega</li>
                    </ul>
                </div>
                <div class="card-footer bg-transparent" style="border-color: #184D94; border-width:2px;">
                <label class="radio-inline"><input type="radio" name="tarifa" id="tarifa" value=1 checked> Opción 1</label>
                </div>
            </div><!-- /1 card -->

            <div class="card  mb-4 shadow-sm" style="border-color: #184D94; border-width:2px;">
                <div class="card-header">
                    <h4 class="my-0 font-weight-normal">Tarifa plus</h4>
                </div>
                <div class="card-body">
                    <h1 class="card-title pricing-card-title">$10.000</h1>
                    <ul class="list-unstyled mt-3 mb-4" align="left">
                    <li>&#x2705;Pasaje aéreo</li>
                    <li>&#x2705;1 Bolso de mano</li>
                    <li>&#x2705;1 Equipaje de mano</li>
                    <li>&#10060;1 Equipaje de bodega</li>
                    </ul>
                </div>
                <div class="card-footer bg-transparent" style="border-color: #184D94; border-width:2px;">
                <label class="radio-inline"><input type="radio" name="tarifa" id="tarifa" value=2 checked> Opción 2</label>
                </div>
            </div><!-- /2 card -->

            <div class="card  mb-4 shadow-sm" style="border-color: #184D94; border-width:2px;">
                <div class="card-header">
                    <h4 class="my-0 font-weight-normal">Tarifa pro</h4>
                </div>
                <div class="card-body">
                    <h1 class="card-title pricing-card-title">$25.000</h1>
                    <ul class="list-unstyled mt-3 mb-4" align="left">
                    <li>&#x2705;Pasaje aéreo</li>
                    <li>&#x2705;1 Bolso de mano</li>
                    <li>&#x2705;1 Equipaje de mano</li>
                    <li>&#x2705;1 Equipaje de bodega</li>
                    </ul>
                </div>
                <div class="card-footer bg-transparent" style="border-color: #184D94; border-width:2px;">
                <label class="radio-inline"><input type="radio" name="tarifa" id="tarifa" value=3 checked>  Opción 3</label>
                </div>
            </div><!-- /3 card -->
        
    </div>
    <?php echo '<input type="hidden" name="num_pasajeros" id="num_pasajeros" value="'. $pasajeros.'" />'; ?>
    <?php echo '<input type="hidden" name= "precio" id="precio" value="'.$valor.'" />';  ?>        
    <button type="submit" class="btn btn-success float-right" style="width:200px;background-color: #184D94; color: white;" name="enviar_tarifa">Continuar</button>
    <br><br>

    
    </form>
</div>




  




