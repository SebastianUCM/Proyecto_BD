<div class="container" id="registration-form">
  <div class="image"></div>
  <div class="frm">
    <h1></h1>
    <form method="POST" action="formulario_admin.php">
      <div class="row">
        <div class="col-sm-3"></div>
        <div class="col-sm-6">
          <h1 class="text-center">Ingreso Administrador</h1>
          <hr />
          <label>Ingrese su nombre:</label><br />
          <div class="input-group form-group">
            <div class="input-group-prepend">
              <span class="input-group-text"><i class="fas fa-user"></i></span>
            </div>
            <input
              type="text"
              class="form-control"
              name="nombre"
              id="nombre"
              required
            />
          </div>
          <hr />
          <label for="contrasena_loginn">Ingrese su contraseña:</label>

          <div class="input-group form-group">
            <div class="input-group-prepend">
              <span class="input-group-text"><i class="fas fa-key"></i></span>
            </div>
            <input
              type="password"
              class="form-control"
              name="contrasena_loginn"
              id="contrasena_loginn"
              required
            />
          </div>
          <div>
            <button type="submit" class="btn btn-dark btn-block">
              Iniciar Sesion
            </button>
          </div>
        </div>
      </div>
    </form>
  </div>
</div>

<hr />
<hr />
<hr />
<hr />
<hr />
<hr />
<hr />
<hr />
<hr />
<hr />
<hr />
<hr />
<hr />
<hr />
<hr />
<hr />
<hr />
<hr />
<hr />
<hr />
<hr />
<hr />
<hr />
<hr />
<hr />
<hr />
<hr />
<hr />
<hr />
<hr />
<hr />
<hr />
<hr />
<hr />
<hr />
<hr />
<hr />
<hr />
<hr />

<style>
  body {
    background-color: #f3f3f3;
  }
  .input-group-prepend span {
    width: 50px;
    background-color: #184d94;
    color: white;
    border: 0 !important;
  }
  #registration-form {
    max-width: 1000px;
    margin: 80px auto;
  }

  #registration-form .image {
    float: left;
    background-image: url("desk2.jpg");
    height: 630px;
    width: 30%;
    background-size: cover;
    background-position: 25%;
  }
  #registration-form .frm {
    float: right;
    height: 630px;
    width: 70%;
    min-width: 250px;
    padding: 0 35px;
    background-size: 100% 100%;
    background-color: white;
  }

  #registration-form h1 {
    margin-top: 30px;
    margin-bottom: 20px;
  }
</style>
