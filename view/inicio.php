<?php
if(isset($_SESSION['loged'])){ 
    $id= $_SESSION['rut'];
    $c = oci_connect('trabajo_cliente','trabajo_cliente','localhost/XE');
    if($c){
    $delete = "DELETE FROM trabajo.PASAJE WHERE ID_PASAJE IN (SELECT ID_PASAJE FROM trabajo.CARRITO)";
            $stmt = oci_parse($c,$delete);
            oci_execute($stmt);                    
    } 
}  
?>
<style type="text/css">

.texto-encima{
    position: absolute;
    top: 48%;
    left: 50%;
    transform: translate(-50%, -50%);
}      
</style>
<br><br>
<div style="height: 20rem;align-items: center;display: flex;justify-content: center;background-color: #041673;">
        <div class="container text-center" style="background-color: #041673;">
        <img src="logo_blanco.png"  WIDTH="400" HEIGHT="250" style="margin-top:1px;">
        <div class="texto-encima"><h4  style="color:white;font-family:'Trebuchet MS',sans-serif;"><i>El mejor lugar para que vayas donde quieras.</i></h4></div>
        </div>
    </div>
		<div class="carousel slide" id="main-carousel" data-ride="carousel" >
			<ol class="carousel-indicators">
				<li data-target="#main-carousel" data-slide-to="0" class="active"></li>
				<li data-target="#main-carousel" data-slide-to="1"></li>
				<li data-target="#main-carousel" data-slide-to="2"></li>
				<li data-target="#main-carousel" data-slide-to="3"></li>
			</ol><!-- /.carousel-indicators -->
			
			<div class="carousel-inner" >
				<div class="carousel-item active">
					<img class="d-block w-100" src="https://s19.postimg.cc/qzj5uncgj/slide1.jpg" alt="">
					<div class="carousel-caption d-none d-md-block">
                        <div class="row">
                            <div class="col-sm">
                                <div class="card border-info mb-3" style="width: 30rem;background-color: #041673;">
                                    <div class="card-header text-white">VUELOS</div>
                                    <div class="card-body">
                                        <form method="POST" action="?pagina=itinerario">
                                            <div class="form-group">
                                                <label for="ciudad_origen">Desde</label>
                                                <select class="form-control" name="ciudad_origen" id="ciudad_origen">
                                                <option value="">Seleccione un origen</option>
                                                <?php
                                                if(isset($_SESSION['loged'])){ 
                                                    $c = oci_connect('trabajo_cliente','trabajo_cliente','localhost/XE');
                                                }else{
                                                    $c = oci_connect('trabajo_visitante','trabajo_visitante','localhost/XE'); 
                                                }
                                                    if($c){
                                                    $select = "SELECT ID_CIUDAD,NOMBRE || '-' || PAIS AS ORIGENES FROM trabajo.CIUDAD";
                                                    $stmt = oci_parse($c,$select);
                                                    oci_execute($stmt);
                                                    oci_fetch_all($stmt,$resultados);
                                                        for ($i=0; $i < count($resultados['ORIGENES']); $i++) { 
                                                            echo '<option value="' .$resultados['ID_CIUDAD'][$i]. '">' .$resultados['ORIGENES'][$i].' </option>';
                                                        }   
                                                    }
                                                ?>
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label for="ciudad_destino">Hacia</label>
                                                <select class="form-control" name="ciudad_destino" id="ciudad_destino">
                                                <option value="">Seleccione un destino</option>               
                                                <?php
                                                    if(isset($_SESSION['loged'])){ 
                                                        $c = oci_connect('trabajo_cliente','trabajo_cliente','localhost/XE');
                                                    }else{
                                                        $c = oci_connect('trabajo_visitante','trabajo_visitante','localhost/XE'); 
                                                    }
                                                    if($c){
                                                    $select = "SELECT ID_CIUDAD,NOMBRE || '-' || PAIS AS ORIGENES FROM trabajo.CIUDAD";
                                                    $stmt = oci_parse($c,$select);
                                                    oci_execute($stmt);
                                                    oci_fetch_all($stmt,$resultados);
                                                        for ($i=0; $i < count($resultados['ORIGENES']); $i++) { 
                                                            echo '<option value="' .$resultados['ID_CIUDAD'][$i]. '">' .$resultados['ORIGENES'][$i].' </option>';
                                                        }   
                                                    }
                                                                                            
                                                ?>
                                                </select>
                                            </div>
                                            <div class="form-group text-white">
                                                <label for="fecha_partida">Fecha de salida</label>
                                                <input type="text" class="form-control" name="fecha_partida" id="fecha_partida" placeholder="DD/MM/AAAA">
                                            </div> 
                                            <div class="form-group text-white">
                                                <label for="n_pasajeros">Pasajeros</label>
                                                <input type="number" class="form-control" name="n_pasajeros" id="n_pasajeros" placeholder="Ingrese el número de pasajeros">
                                            </div>       
                                            <button class="btn btn-info btn-block" type="submit">Busca tu vuelo!</button>
                                        </form>
                                    </div><!-- /card body -->
                                </div>
                            </div>
                            <div class="col-sm"></div>
                        </div><!-- /row -->
					</div>
				</div>
				<div class="carousel-item">
					<img class="d-block w-100" src="https://s19.postimg.cc/lmubh3h0j/slide2.jpg" alt="">
					<div class="carousel-caption d-none d-md-block">
                        <div class="row">
                            <div class="col-sm">
                                <div class="card border-info mb-3" style="width: 30rem;background-color: #041673;">
                                    <div class="card-header text-white">VUELOS</div>
                                    <div class="card-body">
                                        <form method="POST" action="?pagina=itinerario">
                                            <div class="form-group">
                                                <label for="ciudad_origen">Desde</label>
                                                <select class="form-control" name="ciudad_origen" id="ciudad_origen">
                                                <option value="">Seleccione un origen</option>
                                                <?php
                                                    if(isset($_SESSION['loged'])){ 
                                                        $c = oci_connect('trabajo_cliente','trabajo_cliente','localhost/XE');
                                                    }else{
                                                        $c = oci_connect('trabajo_visitante','trabajo_visitante','localhost/XE'); 
                                                    }
                                                    if($c){
                                                    $select = "SELECT ID_CIUDAD,NOMBRE || '-' || PAIS AS ORIGENES FROM trabajo.CIUDAD";
                                                    $stmt = oci_parse($c,$select);
                                                    oci_execute($stmt);
                                                    oci_fetch_all($stmt,$resultados);
                                                        for ($i=0; $i < count($resultados['ORIGENES']); $i++) { 
                                                            echo '<option value="' .$resultados['ID_CIUDAD'][$i]. '">' .$resultados['ORIGENES'][$i].' </option>';
                                                        }   
                                                    }
                                                ?>
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label for="ciudad_destino">Hacia</label>
                                                <select class="form-control" name="ciudad_destino" id="ciudad_destino">
                                                <option value="">Seleccione un destino</option>               
                                                <?php
                                                if(isset($_SESSION['loged'])){ 
                                                    $c = oci_connect('trabajo_cliente','trabajo_cliente','localhost/XE');
                                                }else{
                                                    $c = oci_connect('trabajo_visitante','trabajo_visitante','localhost/XE'); 
                                                }
                                                    if($c){
                                                    $select = "SELECT ID_CIUDAD,NOMBRE || '-' || PAIS AS ORIGENES FROM trabajo.CIUDAD";
                                                    $stmt = oci_parse($c,$select);
                                                    oci_execute($stmt);
                                                    oci_fetch_all($stmt,$resultados);
                                                        for ($i=0; $i < count($resultados['ORIGENES']); $i++) { 
                                                            echo '<option value="' .$resultados['ID_CIUDAD'][$i]. '">' .$resultados['ORIGENES'][$i].' </option>';
                                                        }   
                                                    }
                                                                                            
                                                ?>
                                                </select>
                                            </div>
                                            <div class="form-group text-white">
                                                <label for="fecha_partida">Fecha de salida</label>
                                                <input type="text" class="form-control" name="fecha_partida" id="fecha_partida" placeholder="DD/MM/AAAA">
                                            </div> 
                                            <div class="form-group text-white">
                                                <label for="n_pasajeros">Pasajeros</label>
                                                <input type="number" class="form-control" name="n_pasajeros" id="n_pasajeros" placeholder="Ingrese el número de pasajeros">
                                            </div>       
                                            <button class="btn btn-info btn-block" type="submit">Busca tu vuelo!</button>
                                        </form>
                                    </div><!-- /card body -->
                                </div>
                            </div>
                            <div class="col-sm"></div>
                        </div><!-- /row -->
					</div>
				</div>
				<div class="carousel-item">
					<img class="d-block w-100" src="https://s19.postimg.cc/99hh9lr5v/slide3.jpg" alt="">
					<div class="carousel-caption d-none d-md-block">
                        <div class="row">
                            <div class="col-sm">
                                <div class="card border-info mb-3" style="width: 30rem;background-color: #041673;">
                                    <div class="card-header text-white">VUELOS</div>
                                    <div class="card-body">
                                        <form method="POST" action="?pagina=itinerario">
                                            <div class="form-group">
                                                <label for="ciudad_origen">Desde</label>
                                                <select class="form-control" name="ciudad_origen" id="ciudad_origen">
                                                <option value="">Seleccione un origen</option>
                                                <?php
                                                    if(isset($_SESSION['loged'])){ 
                                                        $c = oci_connect('trabajo_cliente','trabajo_cliente','localhost/XE');
                                                    }else{
                                                        $c = oci_connect('trabajo_visitante','trabajo_visitante','localhost/XE'); 
                                                    }
                                                    if($c){
                                                    $select = "SELECT ID_CIUDAD,NOMBRE || '-' || PAIS AS ORIGENES FROM trabajo.CIUDAD";
                                                    $stmt = oci_parse($c,$select);
                                                    oci_execute($stmt);
                                                    oci_fetch_all($stmt,$resultados);
                                                        for ($i=0; $i < count($resultados['ORIGENES']); $i++) { 
                                                            echo '<option value="' .$resultados['ID_CIUDAD'][$i]. '">' .$resultados['ORIGENES'][$i].' </option>';
                                                        }   
                                                    }
                                                ?>
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label for="ciudad_destino">Hacia</label>
                                                <select class="form-control" name="ciudad_destino" id="ciudad_destino">
                                                <option value="">Seleccione un destino</option>               
                                                <?php
                                                    if(isset($_SESSION['loged'])){ 
                                                        $c = oci_connect('trabajo_cliente','trabajo_cliente','localhost/XE');
                                                    }else{
                                                        $c = oci_connect('trabajo_visitante','trabajo_visitante','localhost/XE'); 
                                                    }
                                                    if($c){
                                                    $select = "SELECT ID_CIUDAD,NOMBRE || '-' || PAIS AS ORIGENES FROM trabajo.CIUDAD";
                                                    $stmt = oci_parse($c,$select);
                                                    oci_execute($stmt);
                                                    oci_fetch_all($stmt,$resultados);
                                                        for ($i=0; $i < count($resultados['ORIGENES']); $i++) { 
                                                            echo '<option value="' .$resultados['ID_CIUDAD'][$i]. '">' .$resultados['ORIGENES'][$i].' </option>';
                                                        }   
                                                    }
                                                                                            
                                                ?>
                                                </select>
                                            </div>
                                            <div class="form-group text-white">
                                                <label for="fecha_partida">Fecha de salida</label>
                                                <input type="text" class="form-control" name="fecha_partida" id="fecha_partida" placeholder="DD/MM/AAAA">
                                            </div> 
                                            <div class="form-group text-white">
                                                <label for="n_pasajeros">Pasajeros</label>
                                                <input type="number" class="form-control" name="n_pasajeros" id="n_pasajeros" placeholder="Ingrese el número de pasajeros">
                                            </div>       
                                            <button class="btn btn-info btn-block" type="submit">Busca tu vuelo!</button>
                                        </form>
                                    </div><!-- /card body -->
                                </div>
                            </div>
                            <div class="col-sm"></div>
                        </div><!-- /row -->
					</div>
				</div>
				<div class="carousel-item">
					<img src="https://s19.postimg.cc/nenabzsnn/slide4.jpg" alt="" class="d-block w-100">
					<div class="carousel-caption d-none d-md-block">
                        <div class="row">
                            <div class="col-sm">
                                <div class="card border-info mb-3" style="width: 30rem;background-color: #041673;">
                                    <div class="card-header text-white">VUELOS</div>
                                    <div class="card-body">
                                        <form method="POST" action="?pagina=itinerario">
                                            <div class="form-group">
                                                <label for="ciudad_origen">Desde</label>
                                                <select class="form-control" name="ciudad_origen" id="ciudad_origen">
                                                <option value="">Seleccione un origen</option>
                                                <?php
                                                    if(isset($_SESSION['loged'])){ 
                                                        $c = oci_connect('trabajo_cliente','trabajo_cliente','localhost/XE');
                                                    }else{
                                                        $c = oci_connect('trabajo_visitante','trabajo_visitante','localhost/XE'); 
                                                    }
                                                    if($c){
                                                    $select = "SELECT ID_CIUDAD,NOMBRE || '-' || PAIS AS ORIGENES FROM trabajo.CIUDAD";
                                                    $stmt = oci_parse($c,$select);
                                                    oci_execute($stmt);
                                                    oci_fetch_all($stmt,$resultados);
                                                        for ($i=0; $i < count($resultados['ORIGENES']); $i++) { 
                                                            echo '<option value="' .$resultados['ID_CIUDAD'][$i]. '">' .$resultados['ORIGENES'][$i].' </option>';
                                                        }   
                                                    }
                                                ?>
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label for="ciudad_destino">Hacia</label>
                                                <select class="form-control" name="ciudad_destino" id="ciudad_destino">
                                                <option value="">Seleccione un destino</option>               
                                                <?php
                                                    if(isset($_SESSION['loged'])){ 
                                                        $c = oci_connect('trabajo_cliente','trabajo_cliente','localhost/XE');
                                                    }else{
                                                        $c = oci_connect('trabajo_visitante','trabajo_visitante','localhost/XE'); 
                                                    }
                                                    if($c){
                                                    $select = "SELECT ID_CIUDAD,NOMBRE || '-' || PAIS AS ORIGENES FROM trabajo.CIUDAD";
                                                    $stmt = oci_parse($c,$select);
                                                    oci_execute($stmt);
                                                    oci_fetch_all($stmt,$resultados);
                                                        for ($i=0; $i < count($resultados['ORIGENES']); $i++) { 
                                                            echo '<option value="' .$resultados['ID_CIUDAD'][$i]. '">' .$resultados['ORIGENES'][$i].' </option>';
                                                        }   
                                                    }
                                                                                            
                                                ?>
                                                </select>
                                            </div>
                                            <div class="form-group text-white">
                                                <label for="fecha_partida">Fecha de salida</label>
                                                <input type="text" class="form-control" name="fecha_partida" id="fecha_partida" placeholder="DD/MM/AAAA">
                                            </div> 
                                            <div class="form-group text-white">
                                                <label for="n_pasajeros">Pasajeros</label>
                                                <input type="number" class="form-control" name="n_pasajeros" id="n_pasajeros" placeholder="Ingrese el número de pasajeros">
                                            </div>       
                                            <button class="btn btn-info btn-block" type="submit">Busca tu vuelo!</button>
                                        </form>
                                    </div><!-- /card body -->
                                </div>
                            </div>
                            <div class="col-sm"></div>
                        </div><!-- /row -->
						</div>
				</div>
			</div><!-- /.carousel-inner -->
			
			<a href="#main-carousel" class="carousel-control-prev" data-slide="prev">
				<span class="carousel-control-prev-icon"></span>
				<span class="sr-only" aria-hidden="true">Prev</span>
			</a>
			<a href="#main-carousel" class="carousel-control-next" data-slide="next">
				<span class="carousel-control-next-icon"></span>
				<span class="sr-only" aria-hidden="true">Next</span>
			</a>
		</div><!-- /.carousel -->
