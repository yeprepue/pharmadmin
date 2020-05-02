<div class="container-fluid">
    <div class="row ml-2 mr-2">
        <div class="col-md-4 mt-4">
            <div class="card card-primary card-outline">
                <div class="card-header text-center">
                    <h3 id="rRol">Nuevo rol</h3>
                    <h3 id="aRol" style="display: none">Actualizar rol</h3>
                </div>
                <div class="card-body">
                    <form id="formRol">
                        <div class="form-group">
                            <input type="text" name="rol" id="rol" class="form-control" placeholder="Ingrese el nombre del rol">
                        </div>
                        <div class="form-group">
                            <button id="btnGuardarRol" type="button" class="btn btn-success btn-block">Guardar</button>
                            <button id="btnActualizarRol" style="display: none" type="button" class="btn btn-success btn-block">Actualizar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-md-8 mt-4">
            <div class="col-12 col-sm-12 col-lg-12">
                <div class="card card-primary card-outline card-tabs">
                    <div class="card-header p-0 pt-1 border-bottom-0">
                        <ul class="nav nav-tabs" id="custom-tabs-two-tab" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" id="custom-tabs-two-home-tab" data-toggle="pill" href="#custom-tabs-two-home" role="tab" aria-controls="custom-tabs-two-home" aria-selected="true">Activos</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="custom-tabs-two-profile-tab" data-toggle="pill" href="#custom-tabs-two-profile" role="tab" aria-controls="custom-tabs-two-profile" aria-selected="false">Inactivos</a>
                            </li>
                        </ul>
                    </div>
                    <div class="card-body">
                        <div class="tab-content" id="custom-tabs-two-tabContent">
                            <div class="tab-pane fade show active" id="custom-tabs-two-home" role="tabpanel" aria-labelledby="custom-tabs-two-home-tab">
                                <!-- Tabla activos -->
                                <table id="tblRolesActivos" style="width: 100%" class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th scope="col">#</th>
                                            <th scope="col">Rol</th>
                                            <th scope="col">Estado</th>
                                            <th scope="col">Acciones</th>
                                        </tr>
                                    </thead>
                                    <!-- <tbody>

                                    </tbody> -->
                                </table>
                                <!-- Fin tabla activos -->
                            </div>
                            <div class="tab-pane fade" id="custom-tabs-two-profile" role="tabpanel" aria-labelledby="custom-tabs-two-profile-tab">
                                <table id="tblRolesInactivos" style="width: 100%" class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th scope="col">#</th>
                                            <th scope="col">Rol</th>
                                            <th scope="col">Estado</th>
                                            <th scope="col">Acciones</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                    </tbody>
                                </table>
                            </div>
                            <input type="hidden" name="idrol" id="idrol">
                        </div>
                    </div>
                    <!-- /.card -->
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    .switch {
        position: relative;
        height: 26px;
        width: 120px;
        margin: auto;
        background: rgba(0, 0, 0, 0.25);
        border-radius: 3px;
        -webkit-box-shadow: inset 0 1px 3px rgba(0, 0, 0, 0.3), 0 1px rgba(255, 255, 255, 0.1);
        box-shadow: inset 0 1px 3px rgba(0, 0, 0, 0.3), 0 1px rgba(255, 255, 255, 0.1);
    }

    .switch-label {
        position: relative;
        z-index: 2;
        float: left;
        width: 58px;
        line-height: 26px;
        font-size: 11px;
        color: rgba(255, 255, 255, 0.35);
        text-align: center;
        text-shadow: 0 1px 1px rgba(0, 0, 0, 0.45);
        cursor: pointer;
    }

    .switch-label:active {
        font-weight: bold;
    }

    .switch-label-off {
        padding-left: 2px;
    }

    .switch-label-on {
        padding-right: 2px;
    }


    .switch-input {
        display: none;
    }

    .switch-input:checked+.switch-label {
        font-weight: bold;
        color: rgba(0, 0, 0, 0.65);
        text-shadow: 0 1px rgba(255, 255, 255, 0.25);
        -webkit-transition: 0.15s ease-out;
        -moz-transition: 0.15s ease-out;
        -ms-transition: 0.15s ease-out;
        -o-transition: 0.15s ease-out;
        transition: 0.15s ease-out;
        -webkit-transition-property: color, text-shadow;
        -moz-transition-property: color, text-shadow;
        -ms-transition-property: color, text-shadow;
        -o-transition-property: color, text-shadow;
        transition-property: color, text-shadow;
    }

    .switch-input:checked+.switch-label-on~.switch-selection {
        left: 60px;
        /* Note: left: 50%; doesn't transition in WebKit */
    }

    .switch-selection {
        position: absolute;
        z-index: 1;
        top: 2px;
        left: 2px;
        display: block;
        width: 58px;
        height: 22px;
        border-radius: 3px;
        background-color: #65bd63;
        background-image: -webkit-gradient(linear, left top, left bottom, color-stop(0%, #9dd993), color-stop(100%, #65bd63));
        background-image: -webkit-linear-gradient(top, #9dd993, #65bd63);
        background-image: -moz-linear-gradient(top, #9dd993, #65bd63);
        background-image: -ms-linear-gradient(top, #9dd993, #65bd63);
        background-image: -o-linear-gradient(top, #9dd993, #65bd63);
        background-image: linear-gradient(top, #9dd993, #65bd63);
        -webkit-box-shadow: inset 0 1px rgba(255, 255, 255, 0.5), 0 0 2px rgba(0, 0, 0, 0.2);
        box-shadow: inset 0 1px rgba(255, 255, 255, 0.5), 0 0 2px rgba(0, 0, 0, 0.2);
        -webkit-transition: left 0.15s ease-out;
        -moz-transition: left 0.15s ease-out;
        -ms-transition: left 0.15s ease-out;
        -o-transition: left 0.15s ease-out;
        transition: left 0.15s ease-out;
    }

    .switch-blue .switch-selection {
        background-color: #3aa2d0;
        background-image: -webkit-gradient(linear, left top, left bottom, color-stop(0%, #4fc9ee), color-stop(100%, #3aa2d0));
        background-image: -webkit-linear-gradient(top, #4fc9ee, #3aa2d0);
        background-image: -moz-linear-gradient(top, #4fc9ee, #3aa2d0);
        background-image: -ms-linear-gradient(top, #4fc9ee, #3aa2d0);
        background-image: -o-linear-gradient(top, #4fc9ee, #3aa2d0);
        background-image: linear-gradient(top, #4fc9ee, #3aa2d0);
    }

    .switch-yellow .switch-selection {
        background-color: #c4bb61;
        background-image: -webkit-gradient(linear, left top, left bottom, color-stop(0%, #e0dd94), color-stop(100%, #c4bb61));
        background-image: -webkit-linear-gradient(top, #e0dd94, #c4bb61);
        background-image: -moz-linear-gradient(top, #e0dd94, #c4bb61);
        background-image: -ms-linear-gradient(top, #e0dd94, #c4bb61);
        background-image: -o-linear-gradient(top, #e0dd94, #c4bb61);
        background-image: linear-gradient(top, #e0dd94, #c4bb61);
    }
</style>