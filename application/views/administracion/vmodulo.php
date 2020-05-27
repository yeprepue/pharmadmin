<div class="container-fluid">
    <div class="row ml-2 mr-2">
        <div class="col-md-4 mt-4">
            <div class="card card-primary card-outline">
                <div class="card-header text-center">
                    <h3 id="rModulo">Nuevo módulo</h3>
                    <h3 id="aModulo" style="display: none">Actualizar módulo</h3>
                </div>
                <div class="card-body">
                    <form id="formModulo">
                        <div class="form-group">
                            <input type="text" name="modulo" id="modulo" class="form-control" placeholder="Ingrese el nombre del módulo">
                        </div>
                        <!-- <div class="form-group">
                            <select name="selModulo" id="selModulo" class="form-control">
                                <option value="">Seleccione un módulo</option>
                            </select>
                        </div> -->
                        <div class="form-group">
                            <input type="text" name="menlace" id="menlace" class="form-control" placeholder="Ingrese enlace">
                        </div>
                        <div class="form-group">
                            <input type="text" name="micono" id="micono" class="form-control" placeholder="Ingrese icono">
                        </div>
                        <div class="form-group">
                            <input type="number" name="morden" id="morden" class="form-control" placeholder="Ingrese orden">
                        </div>
                        <div id="divmsj-modulo" class="form-group text-danger" style="display: none">
                            <label id="lblModulo">* Ingrese el nombre del producto</label>
                        </div>
                        <div class="form-group">
                            <button id="btnGuardarModulo" type="button" class="btn btn-success btn-block">Guardar</button>
                            <button id="btnActualizarModulo" style="display: none" type="button" class="btn btn-success btn-block">Actualizar</button>
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
                                <div class="table-responsive">
                                    <table id="tblModulosActivos" style="width: 100%" class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
                                                <th scope="col">Submodulos</th>
                                                <th scope="col">#</th>
                                                <th scope="col">Modulo</th>
                                                <th scope="col">Enlace</th>
                                                <th scope="col">ícono</th>
                                                <th scope="col">Orden</th>
                                                <th scope="col">Estado</th>
                                                <th scope="col">Acciones</th>
                                            </tr>
                                        </thead>
                                    </table>
                                </div>
                                <!-- Fin tabla activos -->
                            </div>
                            <div class="tab-pane fade" id="custom-tabs-two-profile" role="tabpanel" aria-labelledby="custom-tabs-two-profile-tab">
                                <table id="tblModulosInactivos" style="width: 100%" class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th scope="col">#</th>
                                            <th scope="col">Modulo</th>
                                            <th scope="col">Enlace</th>
                                            <th scope="col">Ïcono</th>
                                            <th scope="col">Estado</th>
                                            <th scope="col">Orden</th>
                                            <th scope="col">Acciones</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                    </tbody>
                                </table>
                            </div>
                            <input type="hidden" name="idmodulo" id="idmodulo">
                        </div>
                    </div>
                    <!-- /.card -->
                </div>
            </div>
        </div>
    </div>
</div>