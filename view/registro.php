<style>
    body{
  background-color: #f3f3f3;
}
#registration-form{
	max-width: 1000px;
	margin: 80px auto;
}

#registration-form .image{
	float:left;
	background-image: url("desk2.jpg");
	height: 630px;
	width: 30%;
	background-size: cover;
	background-position: 25%;
}  
#registration-form .frm{
	float:right;
	height: 630px;
    width: 70%;
    min-width: 250px;
    padding: 0 35px;
    background-size: 100% 100%;
    background-color: white;
}

#registration-form h1{
	margin-top: 30px;
	margin-bottom: 20px;
}    
</style>

<div class="container" id="registration-form">
    <div class="image"></div>
        <div class="frm">
            <h1>Registrate!</h1>
            <form method="POST">
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <div class="form-group">
                            <label for="nombrec">Nombre:</label>
                            <input type="text" class="form-control" id="nombrec" name="nombrec" placeholder="Ingrese su nombre" required>
                        </div>
                    </div>
                    <div class="col-md-6 mb-3">
                        <div class="form-group">
                            <label for="apellidoc">Apellido:</label>
                            <input type="text" class="form-control" id="apellidoc" name="apellidoc" placeholder="Ingrese su apellido" required>
                        </div>
                    </div>
                </div><!-- 1 row -->
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="tipo_doc">Tipo de documento:</label>
                        <select class="form-control" name="tipo_doc" id="tipo_doc" required>
                            <option value="">Seleccione...</option>
                            <option value="RUT">RUT</option>
                            <option value="DNI">DNI</option>
                            <option value="PASAPORTE">PASAPORTE</option>
                            <option value="RG">RG</option>
                        </select>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="num_doc">Número de documento:</label>
                        <input type="text" class="form-control" name="num_doc" id="num_doc" placeholder="Ingrese su número de documento" required>
                    </div>
                </div><!-- 2 row -->

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="generoc">Género:</label>
                            <select class="form-control" name="generoc" id="generoc" required>
                                <option value="">Seleccione...</option>
                                <option value="FEMENINO">FEMENINO</option>
                                <option value="MASCULINO">MASCULINO</option>
                            </select>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="nacimiento">Fecha de nacimiento:</label>
                        <input type="text" class="form-control" name="nacimiento" id="nacimiento" placeholder="DD/MM/YYYY" required>
                    </div>         
                </div><!-- 3 row -->
                <div class="row">
                    <div class="col-md-7 mb-3">
                        <div class="form-group">
                            <label for="email">Email:</label>
                            <input type="email" class="form-control" name="email" id="email" placeholder="ejemplo@ejemplo.com" required>
                        </div>
                    </div>
                    <div class="col-md-5 mb-3">
                        <div class="form-group">
                            <label for="telef">Teléfono: </label>
                            <input type="text" class="form-control" name="telef" id="telef" placeholder="Ingrese su nº de teléfono" required>
                        </div>
                    </div>
                </div><!-- 4 row -->
                <div class="row">
                    <div class="col-md-7 mb-3">
                        <div class="form-group">
                            <label for="pwd">Contraseña:</label>
                            <input type="password" name="pwd" id="pwd" class="form-control" placeholder="Ingrese su contraseña" aria-describedby="passwordHelpInline" required>
                        </div>
                    </div>
                    <div class="col-md-5 mb-3">
                        <small id="passwordHelpInline" class="text-muted"><hr/>

                            Debe contener de 8-20 caracteres.
                        </small>
                    </div>
                </div><!-- 5 row -->
                <div class="row">
                    <div class="col-md-8 mb-3"></div>
                    <div class="col-md-4 mb-3">
                    <button type="submit" class="btn btn-success" style="width:200px;background-color: #184D94; color: white;">Registrar</button>
                    </div>
                </div><!-- 4 row -->
                <?php
                
                if(isset($_POST['num_doc'])){            
                    $datos = [$_POST['num_doc'],
                            $_POST['nombrec'],
                            $_POST['apellidoc'],
                            $_POST['nacimiento'],
                            $_POST['generoc'],
                            $_POST['tipo_doc'],
                            $_POST['telef'],
                            $_POST['email'],
                            $_POST['pwd']];
                            
                    $conexion = oci_connect('trabajo_visitante','trabajo_visitante','localhost/XE');
                    if($conexion){
                        $procedimiento = 'DECLARE BEGIN trabajo.INSERTAR_CLIENTE(:num_doc,:nombrec,:apellidoc,:nacimiento,:generoc,:tipo_doc,:telef,:email,:pwd,:res,:men); END;';
                        $stmt = oci_parse($conexion,$procedimiento);
                        oci_bind_by_name($stmt,':num_doc',$datos[0]);
                        oci_bind_by_name($stmt,':nombrec',$datos[1]);
                        oci_bind_by_name($stmt,':apellidoc',$datos[2]);
                        oci_bind_by_name($stmt,':nacimiento',$datos[3]);
                        oci_bind_by_name($stmt,':generoc',$datos[4]);
                        oci_bind_by_name($stmt,':tipo_doc',$datos[5]);
                        oci_bind_by_name($stmt,':telef',$datos[6]);
                        oci_bind_by_name($stmt,':email',$datos[7]);
                        oci_bind_by_name($stmt,':pwd',$datos[8]);
                        oci_bind_by_name($stmt,':res',$resultado,50);
                        oci_bind_by_name($stmt,':men',$mensaje,500);
                        oci_execute($stmt);
                    }       
                }
                ?>
                
                
                
            </form>
        </div>
</div>

<?php echo '
<div class="container" style="display: flex; justify-content: center;align-items: center;margin-left:170px;">
<br><br><br><br><br><br><br><br><br><div class="alert alert-danger" role="alert"><i style="transform: scale(1.5);" class="far fa-frown" ></i> &nbsp;&nbsp;'.$mensaje.'</div></div>';
?>

<br><br>