<div class="container-fluid">
    <div class="row ml-2 mr-2">
        <div class="col-md-6 mt-4 mx-auto">
            <div class="card card-primary card-outline">
                <div class="card-header text-center">
                    <h3 id="rRol">Registro de ventas</h3>
                </div>
                <div class="card-body">
                    <form id="formVenta">
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
    </div>
    <div class="row">
        <div class="col-md-8 mt-2 mx-auto">
            <div class="table-responsive m-1" id="selProductos" style="display: none">
                <table class="table table-bordered table-striped table-condensed">
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
    </div>
</div>
<style>
    #lstProductos tbody tr:hover {
        background-color: #c9d4de;
        cursor: pointer;
    }

    #selProductos {
        box-shadow: 2px 2px 2px 5px #bec2c5;
    }

    #selProductos .elim-producto {
        cursor: pointer;
    }

    #selProductos .elim-producto:hover {
        color: red !important;
    }
</style>