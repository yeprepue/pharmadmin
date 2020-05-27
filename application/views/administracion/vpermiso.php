okkkk<div class="container-fluid">
    <div class="row ml-2 mr-2">
        <div class="col-md-4 mt-4">
            <div class="card card-primary card-outline">
                <div class="card-header text-center">
                    <h3 id="rRol">Nuevo producto</h3>
                    <h3 id="aRol" style="display: none">Actualizar producto</h3>
                </div>
                <div class="card-body">
                    <form id="formProducto">
                        <div class="form-group">
                            <input type="text" name="producto" id="producto" class="form-control" placeholder="Ingrese el nombre del producto">
                        </div>
                        <div class="form-group">
                            <select name="selCategoria" id="selCategoria" class="form-control">
                                <option value="">Seleccione una categoría</option>
                            </select>
                        </div>
                        <div id="divmsj-producto" class="form-group text-danger" style="display: none">
                            <label id="lblProducto">* Ingrese el nombre del producto</label>
                        </div>
                        <div class="form-group">
                            <button id="btnGuardarProducto" type="button" class="btn btn-success btn-block">Guardar</button>
                            <button id="btnActualizarProducto" style="display: none" type="button" class="btn btn-success btn-block">Actualizar</button>
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
                                    <table id="tblProductosActivos" style="width: 100%" class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
                                                <th scope="col">#</th>
                                                <th scope="col">Producto</th>
                                                <th scope="col">Categoría</th>
                                                <th scope="col">Estado</th>
                                                <th scope="col">Acciones</th>
                                            </tr>
                                        </thead>
                                    </table>
                                </div>
                                <!-- Fin tabla activos -->
                            </div>
                            <div class="tab-pane fade" id="custom-tabs-two-profile" role="tabpanel" aria-labelledby="custom-tabs-two-profile-tab">
                                <table id="tblProductosInactivos" style="width: 100%" class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th scope="col">#</th>
                                            <th scope="col">Producto</th>
                                            <th scope="col">Categoría</th>
                                            <th scope="col">Estado</th>
                                            <th scope="col">Acciones</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                    </tbody>
                                </table>
                            </div>
                            <input type="hidden" name="idproducto" id="idproducto">
                        </div>
                    </div>
                    <!-- /.card -->
                </div>
            </div>
        </div>
    </div>
</div>