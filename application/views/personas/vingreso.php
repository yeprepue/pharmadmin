<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>PharmAdmin | Iniciar sesión</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/plugins/fontawesome-free/css/all.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/dist/css/adminlte.min.css">
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
</head>

<body class="hold-transition login-page" style='background-image: url("<?php echo base_url(); ?>img/farmacia3.jpg");background-size: cover;'>
  <div class="login-box">
    <div class="login-logo" style="text-shadow: 1px 1px #000;">
      <a href=""><b>Pharm<span class="text-danger">Admin</span></b></a>
    </div>
    <!-- /.login-logo -->
    <div class="card" id="cardlogin">
      <div class="card-body login-card-body">
        <h4 class="text-center">Inicio de sesión</h4>

        <form id="formIngreso">
          <div class="input-group mb-3">
            <input type="text" class="form-control" id="usuario" name="usuario" placeholder="Usuario">
            <div class="input-group-append">
              <div class="input-group-text">
                <span class="fas fa-user"></span>
              </div>
            </div>
          </div>
          <div class="input-group mb-3">
            <input type="password" class="form-control" id="clave" name="clave" placeholder="Contraseña">
            <div class="input-group-append">
              <div class="input-group-text">
                <span class="fas fa-lock"></span>
              </div>
            </div>
          </div>
          <div class="form-group" id="msjerror">
            <label class="text-danger">* Usuario o contraseña incorrecta</label>
          </div>
          <div class="row">
            <div class="col-12">
              <button type="button" id="btnIniciarSesion" class="btn btn-danger btn-block">Iniciar sesión</button>
            </div>
            <div class="col-12">
              <div class="icheck-primary">
                <input type="checkbox" id="remember">
                <p class="mb-1">
                  <a href="">Olvidé mi contraseña</a>
                </p>
              </div>
            </div>
            <div class="col-md-12 mx-auto">
              <div class="form-group text-center">
                <label class="label-control">¿No estás registrado?</label>
                <a href="<?php echo base_url(); ?>cpersona/formularioRegistro" class="text-center btn btn-primary btn-block">Regístrate</a>
              </div>
            </div>
          </div>
        </form>
        <p class="mb-0">

        </p>
      </div>
      <!-- /.login-card-body -->
    </div>
  </div>
  <!-- /.login-box -->

  <!-- jQuery -->
  <script src="<?php echo base_url(); ?>assets/plugins/jquery/jquery.min.js"></script>
  <!-- Bootstrap 4 -->
  <script src="<?php echo base_url(); ?>assets/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
  <!-- AdminLTE App -->
  <script src="<?php echo base_url(); ?>assets/dist/js/adminlte.min.js"></script>
  <!-- Notify -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/notify/0.4.2/notify.js"></script>
  <script src="<?php echo base_url(); ?>js/persona.js"></script>

</body>
<style>
  #cardlogin .login-card-body {
    border-radius: 10px;
    box-shadow: 0px 0px 5px 5px #a1a4a7;
  }

  #cardlogin {
    opacity: 0.85;
  }
</style>

</html>