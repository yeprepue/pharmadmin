<div class="container-fluid">
    <div class="row ml-2 mr-2">
        <div class="col-md-9 mt-4 mx-auto">
            <div class="card card-primary card-outline">
                <div class="card-header text-center">
                    <h3 id="rRol">Registro de ventas</h3>
                </div>
                <div class="card-body">
                    <form id="formfactura">
                        <div class="row">
                            <div class="col-md-12">
                                <input id="ventaProducto" name="ventaProducto" type="text" class="form-control" aria-label="Text input with dropdown button" placeholder="Ingrese nombre o código de barras">
                                <ul class="dd-productos dropdown-menu col-md-12" role="menu">
                                    <li>
                                        <div class="table-responsive col-md-12" id="lstProductos" style="display:none;">
                                            <table class="table table-bordered table-striped table-condensed">
                                                <thead>
                                                    <tr>
                                                        <th scope="col">Producto</th>
                                                        <th scope="col">Tipo</th>
                                                        <th scope="col">#tipo</th>
                                                        <th scope="col">Medida</th>
                                                        <th scope="col">#medida</th>
                                                        <th scope="col">Marca</th>
                                                        <th scope="col">Código</th>
                                                        <th scope="col">Precio</th>
                                                    </tr>
                                                </thead>
                                                <tbody>

                                                </tbody>
                                            </table>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <div id="divmsj-venta" class="form-group text-danger" style="display: none">
                            <label>* Ingrese el producto o el código</label>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <input type="hidden" id="idusuario" value="<?php echo $this->session->userdata('sIdusuario') ?>">
    </div>
    <div class="row">
        <div class="col-md-11 mt-2 mx-auto">
            <div class="table-responsive m-1" id="selProductos" style="display: none">
                <table class="table table-bordered table-striped table-sm">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th scope="col">Producto</th>
                            <th scope="col">Cantidad</th>
                            <th scope="col">Precio</th>
                            <th scope="col">Tipo</th>
                            <th scope="col">#tipo</th>
                            <th scope="col">Medida</th>
                            <th scope="col">#medida</th>
                            <th scope="col">Marca</th>
                            <th scope="col">Código</th>
                            <th scope="col"></th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="col-md-3 offset-md-2 mt-1" id="rowFacturar" style="display: none">
            <div class="form-group">
                <button id="btnFacturar" class="btn btn-facturar btn-block text-bold">Facturar</button>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="modalproductos">
        <div class="modal-dialog modal-lg">
            <div class="modal-content text-center">

                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title  mx-auto">Factura de venta <span id="facturaventa"># </span></h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>

                <!-- Modal body -->
                <div class="modal-body">
                    <table id="tblResumenProductos" class="table table-bordered table-sm">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Producto</th>
                                <th>Cantidad</th>
                                <th>Precio</th>
                            </tr>
                        </thead>
                        <tbody>

                        </tbody>
                    </table>
                </div>

                <!-- Modal footer -->
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary">Cerrar</button>
                    <button type="button" class="btn btn-success">Imprimir</button>
                </div>
            </div>
        </div>
    </div>
</div>
<style>
    #lstProductos tbody tr:hover {
        background-color: #c9d4de;
        cursor: pointer;
    }

    #selProductos {
        box-shadow: 2px 2px 2px 5px #bec2c5;
        border-radius: 10px;
    }

    #selProductos .elim-producto {
        cursor: pointer;
    }

    #selProductos .elim-producto:hover {
        color: red !important;
    }

    .cantvendida {
        width: 150px;
        border-radius: 5px;
        padding-left: 2px;
    }

    .totalvendido {
        border-radius: 5px;
        font-size: 18px;
        font-weight: bolder;
        width: 150px;
        padding-left: 2px;
    }

    .montopago {
        border-radius: 5px;
        font-size: 18px;
        width: 150px;
        padding-left: 2px;

    }

    .tr-totales {
        background-color: #45a98b !important;
    }

    .btn-facturar {
        background-color: #45a98b;
    }

    .btn-facturar:hover {
        background-color: #178866;
    }
</style>