<div class="container" id="registration-form">
    <div class="image"></div>
        <div class="frm">
            <h1></h1>
            <form method="POST">
            <div class="row">
        <div class="col-sm-3"></div>
        <div class="col-sm-6">
            <h1 class='text-center'>Login</h1>
            <hr>
            <label >Ingrese su email:</label><br>
            <div class="input-group form-group">
                
                <div class="input-group-prepend">
					<span class="input-group-text"><i class="fas fa-user"></i></span>
				</div>
                <input  type="text" class="form-control" name='email' id="email" required>
            </div>
            <hr>
            <label for="contrasena_login">Ingrese su contraseña:</label>

            <div class="input-group form-group">
                <div class="input-group-prepend">
					<span class="input-group-text"><i class="fas fa-key"></i></span>
				</div>
                <input  type="password" class="form-control" name='contrasena_login' id="contrasena_login" required>
            </div>

            <?php
                if(isset($_POST['email'])){
                    $correo = $_POST['email'];
                    $password = $_POST['contrasena_login'];
                    $c = oci_connect('trabajo_cliente','trabajo_cliente','localhost/XE');
                    if($c){
                        $procedimiento = 'DECLARE BEGIN trabajo.INICIAR_SESION(:corre,:pass,:res,:men,:rut); END;';
                        $stmt = oci_parse($c,$procedimiento);
                        oci_bind_by_name($stmt,':corre',$correo);
                        oci_bind_by_name($stmt,':pass',$password);
                        oci_bind_by_name($stmt,':res',$resultado,50);
                        oci_bind_by_name($stmt,':men',$mensaje,500);
                        oci_bind_by_name($stmt,':rut',$rut_cliente,500);
                        oci_execute($stmt);                       
                        if($resultado=='TRUE'){
                            $_SESSION['rut'] = $rut_cliente;
                            $_SESSION['loged'] = True;
                            header('Location: index.php');    
                        }
                        else{
                            echo '<div class="alert alert-warning alert-dismissible fade show" role="alert">
                                <strong> ¡Atención!</strong>'.$mensaje.'             
                             </div> ';
                        }
                    }
                }
            ?>
            <div >
                <a href="?pagina=login_admin" class="text-decoration-none">Iniciar Sesion como Administrador</a>
                <hr/>
            </div >
            <div >
              <button type="submit"  class='btn btn-dark btn-block' >Iniciar Sesion</button>
            </div >
        </div>
    </div>
            </form>
        </div>
</div>


    <hr/><hr/><hr/><hr/><hr/><hr/><hr/><hr/><hr/><hr/><hr/><hr/><hr/><hr/><hr/><hr/><hr/><hr/><hr/><hr/><hr/><hr/><hr/><hr/><hr/><hr/><hr/><hr/><hr/><hr/><hr/><hr/><hr/><hr/><hr/><hr/><hr/><hr/><hr/>

    <style>
    body{
  background-color: #f3f3f3;
}
.input-group-prepend span{
width: 50px;
background-color: #184D94;
color: white;
border:0 !important;
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