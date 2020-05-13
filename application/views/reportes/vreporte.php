<div class="container-fluid">
    <div class="row ml-2 mr-2">
        <div class="col-md-3 mt-4">
            <div class="card card-primary card-outline card-tabs">
                <div class="card-header">
                    <h3>Rango de fechas</h3>
                </div>
                <div class="card-body">
                    <form id="frmFacturas">
                        <div class="form-group">
                            <label>Fecha</label>
                            <input type="text" name="fechaInicial" id="fechaInicial" class="form-control" placeholder="Fecha inicial" onfocus="(this.type='date')" onblur="(this.type='text')">
                        </div>
                        <div class="form-group">
                            <label>Fecha</label>
                            <input type="text" name="fechaFinal" id="FechaFinal" class="form-control" placeholder="Fecha final" onfocus="(this.type='date')" onblur="(this.type='text')">
                        </div>
                        <div class="form-group">
                            <button id="btnRangoFechas" type="button" class="btn btn-success btn-block">Consultar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-md-9 mt-4">
            <div class="col-12 col-sm-12 col-lg-12">
                <div class="card card-primary card-outline card-tabs">
                    <div class="card-header p-0 pt-1 border-bottom-0">
                        <ul class="nav nav-tabs" id="custom-tabs-two-tab" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" id="custom-tabs-two-home-tab" data-toggle="pill" href="#custom-tabs-two-home" role="tab" aria-controls="custom-tabs-two-home" aria-selected="true">Reporte de ventas</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="custom-tabs-two-profile-tab" data-toggle="pill" href="#custom-tabs-two-profile" role="tab" aria-controls="custom-tabs-two-profile" aria-selected="false">Reporte de pedidos</a>
                            </li>
                        </ul>
                    </div>
                    <div class="card-body">
                        <div class="tab-content" id="custom-tabs-two-tabContent">
                            <div class="tab-pane fade show active" id="custom-tabs-two-home" role="tabpanel" aria-labelledby="custom-tabs-two-home-tab">
                                <div class="table-responsive">
                                    <!-- Tabla facturas -->
                                    <table id="tblReporteFacturas" style="width: 100%" class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
                                                <th scope="col"># factura</th>
                                                <th scope="col">Fecha</th>
                                                <th scope="col">Estado</th>
                                            </tr>
                                        </thead>
                                        <tbody>

                                        </tbody>
                                    </table>
                                    <!-- Fin tabla facturas -->
                                </div>
                            </div>
                            <div class="tab-pane fade" id="custom-tabs-two-profile" role="tabpanel" aria-labelledby="custom-tabs-two-profile-tab">
                                <table id="tblReportePedidos" style="width: 100%" class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th scope="col"># pedido</th>
                                            <th scope="col">Fecha</th>
                                            <th scope="col">Estado</th>
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