    <!DOCTYPE html>
    <html>

    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>PharmAdmin | Registrarse</title>
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
            <div class="card" id="cardregistro">
                <div class="card-body login-card-body">
                    <h4 class="text-center">Registro</h4>
                    <form id="formPersona">
                        <div class="form-group">
                            <input type="text" name="nombres" id="nombres" class="form-control" placeholder="Ingrese nombres">
                        </div>
                        <div class="form-group">
                            <input type="text" name="apellidos" id="apellidos" class="form-control" placeholder="Ingrese apellidos">
                        </div>
                        <div class="form-group">
                            <input type="text" name="documento" id="documento" class="form-control" placeholder="Ingrese documento">
                        </div>
                        <div class="form-group">
                            <input type="text" name="fechanacimiento" id="fechanacimiento" class="form-control" placeholder="Ingrese fecha" onfocus="(this.type='date')" onblur="(this.type='text')">
                        </div>
                        <div class="form-group">
                            <input type="text" name="usuario" id="usuario" class="form-control" placeholder="Ingrese usuario">
                        </div>
                        <div class="form-group">
                            <input type="password" name="clave" id="clave" class="form-control" placeholder="Ingrese clave">
                        </div>
                        <div class="form-group">
                            <input type="text" name="direccion" id="direccion" class="form-control" placeholder="Ingrese dirección">
                        </div>
                        <div class="form-group">
                            <input type="text" name="correo" id="correo" class="form-control" placeholder="Ingrese correo">
                        </div>
                        <div class="form-group">
                            <input type="number" name="telefono" id="telefono" class="form-control" placeholder="Ingrese teléfono">
                        </div>
                        <div class="col-12 mt-4" id="msjerror" style="display: none">
                            <div class="form-group">
                                <label class="text-danger">* Debe completar todos los campos del formulario</label>
                            </div>
                        </div>
                        <div class="form-group">
                            <button id="btnRegistrarPersona" type="button" class="btn btn-danger btn-block">Registrarse</button>
                        </div>
                        <div class="form-group text-center">
                            <label class="label-control">¿Ya estás registrado?</label>
                            <a href="<?php echo base_url() ?>cpersona/formularioIngreso" class="form control btn btn-primary btn-block">Inicia sesión</a>
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
        <script src="<?php echo base_url(); ?>js/persona.js"></script>

    </body>
    <style>
        #cardregistro .login-card-body {
            border-radius: 10px;
            box-shadow: 0px 0px 5px 5px #a1a4a7;
        }

        #cardregistro {
            opacity: 0.85;
        }
    </style>

    </html>