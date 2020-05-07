_venta = (function () {

    var infoProducto = Array();

    //Buscamos los productos dependindo del valor que se introduzca en el campo de texto
    var buscarProducto = function () {
        let url = location.protocol + "//" + location.host + '/pharmadmin/';

        var formulario = $('#formVenta').serialize();
        if (formulario.split("=")[1] !== "") {
            $.ajax({
                url: url + 'cventa/buscarProducto',
                type: 'post',
                data: formulario,
                cache: false,
                success: function (request, textStatus, jQxhr) {
                    var data = JSON.parse(request);
                    $('#lstProductos tbody').empty();
                    data.data.forEach(function (element) {
                        $('#lstProductos tbody').append(`
                        <tr>
                            <td data-id="`+ element.id + `"><a class="sel">` + element.producto + `</a></td>
                            <td data-id="`+ element.id + `"><a class="sel">` + element.tipo + `</a></td>
                            <td data-id="`+ element.id + `"><a class="sel">` + element.numerotipo + `</a></td>
                            <td data-id="`+ element.id + `"><a class="sel">` + element.medida + `</a></td>
                            <td data-id="`+ element.id + `"><a class="sel">` + element.numeromedida + `</a></td>
                            <td data-id="`+ element.id + `"><a class="sel">` + element.marca + `</a></td>
                            <td data-id="`+ element.id + `"><a class="sel">` + element.codigobarras + `</a></td>
                            <td data-id="`+ element.id + `"><a class="sel">` + element.precioventa + `</a></td>
                        </tr>
                    `);
                        $("#lstProductos").show();
                        $(".dd-productos.dropdown-menu").addClass("show");
                    });


                },
                error: function (jqXhr, textStatus, errorThrown) {
                    console.log(errorThrown);
                }
            });
        } else {
            $("#lstProductos").hide();
            $(".dd-productos.dropdown-menu").removeClass("show");
        }

    }

    //Seleccionamos los productos y los almacenamos en un arreglo
    var fxSelProductos = function (infoProducto) {
        //Construimos la tabla con los productos seleccionados
        infoProducto.forEach(function (element, index) {
            $('#selProductos tbody').append(`
            <tr>
                <td>`+ (index + 1) + `</td>
                <td data-id="`+ element.id + `">` + element.producto + `</td>
                <td><input id="cantvendida`+ index + `" type="number" minlength="1" name="cantvendida" value="` + element.cantidad + `" data-pos="` + index + `" class="cantvendida"></td>
                <td><label id="precio`+ index + `">` + element.precio * element.cantidad + `</label></td>
                <td data-id="`+ element.id + `">` + element.tipo + `</td>
                <td data-id="`+ element.id + `">` + element.ntipo + `</td>
                <td data-id="`+ element.id + `">` + element.medida + `</td>
                <td data-id="`+ element.id + `">` + element.nmedida + `</td>
                <td data-id="`+ element.id + `">` + element.marca + `</td>
                <td data-id="`+ element.id + `">` + element.codigo + `</td>
                <td><i class="fas fa-times-circle text-danger elim-producto"></i></td>
            </tr>
        `);
        });

        //Construimos el footer de la table en donde van los totales
        $('#selProductos tbody').append(`
            <tr>
                <td colspan="2"></td>
                <td colspan="1">Cantidad productos: <input id="totalcantidad" type="number" disabled class="form-control cantvendida bg-primary"></td>
                <td colspan="2">Precio total: <input id="totalventa" type="number" disabled class="form-control bg-primary"></td>
                <td colspan="5"></td>
            </tr>
        `);
        $("#totalcantidad").val(calcularCantidad(infoProducto));
        $("#totalventa").val(calcularVenta(infoProducto));
    }

    /*Permite calcular la cantidad total de productos que pasan por la caja*/
    var calcularCantidad = function (infoProducto) {
        var total = 0;
        var cantidad = 0;
        for (let i = 0; i < infoProducto.length; i++) {
            cantidad = $("#cantvendida" + i).val();
            total = total + parseInt(cantidad);
        }
        return total;
    }

    /*Permite calcular el precio total de productos que pasan por la caja*/
    var calcularVenta = function (infoProducto) {
        var total = 0;
        var venta = 0;
        for (let i = 0; i < infoProducto.length; i++) {
            venta = $("#cantvendida" + i).val() * infoProducto[i].precio;
            total = total + parseInt(venta);
        }
        return total;
    }

    /*Almacenamos en un arreglo los productos seleccionados con sus respectivas cantidades*/
    var productosSelecionados = function (selProducto, reload) {
        if (reload) {
            infoProducto = selProducto;
        } else {
            infoProducto.push(selProducto);
        }

        //Limpiamos la tabla
        $('#selProductos tbody').empty();

        fxSelProductos(infoProducto);

        $(document).off("keyup", ".cantvendida").on("keyup", ".cantvendida", function () {
            var pos = $(this).data('pos');
            var cantidad = $("#cantvendida" + pos).val();
            infoProducto[pos].cantidad = cantidad;
            var precio = infoProducto[pos].precio * cantidad;
            $("#precio" + pos).html(precio);
            $("#totalcantidad").val(calcularCantidad(infoProducto));
            $("#totalventa").val(calcularVenta(infoProducto));
        })

        $(document).off("change", ".cantvendida").on("change", ".cantvendida", function () {
            var pos = $(this).data('pos');
            var cantidad = $("#cantvendida" + pos).val();
            infoProducto[pos].cantidad = cantidad;
            var precio = infoProducto[pos].precio * cantidad;
            $("#precio" + pos).html(precio);
            $("#totalcantidad").val(calcularCantidad(infoProducto));
            $("#totalventa").val(calcularVenta(infoProducto));
        })
    }

    //Eliminamos el producto del arreglo y de la vista
    var eliminarSelProducto = function (pos) {
        var pos = pos - 1;
        infoProducto.splice(pos, 1);
        if (infoProducto.length == 0) {
            $("#selProductos").hide();
        }
        productosSelecionados(infoProducto, true);
    }

    return {
        buscarProducto: buscarProducto,
        productosSelecionados: productosSelecionados,
        eliminarSelProducto: eliminarSelProducto
    }
})()

$("#ventaProducto").off("keyup").on("keyup", function () {
    _venta.buscarProducto();
})

$(document).off("click", "#lstProductos .sel").on("click", "#lstProductos .sel", function () {
    $(".dd-productos.dropdown-menu").removeClass("show");
    $("#ventaProducto").val("");
    $("#lstProductos").hide();
    $("#selProductos").show();
    var info = Array();
    var idproducto = $(this).parents("tr").find("td").data('id')
    $(this).parents("tr").find("td").each(function (index) {
        info[index] = $(this)[0].innerText;
    });
    var selProducto = {
        id: idproducto,
        producto: info[0],
        tipo: info[1],
        ntipo: info[2],
        medida: info[3],
        nmedida: info[4],
        marca: info[5],
        codigo: info[6],
        cantidad: 1,
        precio: info[7]
    }
    _venta.productosSelecionados(selProducto, false);
})

$("#btnActualizarRol").off("click").on("click", function () {
    if ($("#rol").val() == "") {
        $("#divmsj-rol").show();
        setTimeout(() => {
            $("#divmsj-rol").hide();
        }, 3000);
    } else {
        _venta.actualizarRol();
    }
})

$(document).ready(function () {
    $("#ventaProducto").focus();
    $("#dropdownMenuButton").hide();
});

$(document).off("click", ".elim-producto").on("click", ".elim-producto", function () {
    var info = Array();
    $(this).parents("tr").find("td").each(function (index) {
        info[index] = $(this)[0].innerText;
    });
    _venta.eliminarSelProducto(info[0]);
    $(this).parents("tr").remove();
})


