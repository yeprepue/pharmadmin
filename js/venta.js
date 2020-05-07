_venta = (function () {

    var infoProducto = Array();

    var productosSelecionados = function (selProducto) {
        infoProducto.push(selProducto);
        $('#selProductos tbody').empty();

        infoProducto.forEach(function (element) {
            $('#selProductos tbody').append(`
            <tr>
                <td><i class="fas fa-times-circle text-danger"></i></td>
                <td><input type="number" minlength="1" name="cantidad" id="cantidad" value="1" class="form-control"></td>
                <td data-id="`+ element.id + `">` + element.producto + `</td>
                <td data-id="`+ element.id + `">` + element.tipo + `</td>
                <td data-id="`+ element.id + `">` + element.ntipo + `</td>
                <td data-id="`+ element.id + `">` + element.medida + `</td>
                <td data-id="`+ element.id + `">` + element.nmedida + `</td>
                <td data-id="`+ element.id + `">` + element.marca + `</td>
                <td data-id="`+ element.id + `">` + element.codigo + `</td>
            </tr>
        `);
        });
    }

    var buscarProducto = function () {
        let url = location.protocol + "//" + location.host + '/pharmadmin/';

        var formulario = $('#formVenta').serialize();

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
    }
    return {
        buscarProducto: buscarProducto,
        productosSelecionados: productosSelecionados
    }
})()

$("#ventaProducto").off("keyup").on("keyup", function () {
    _venta.buscarProducto();
})

$("#lstProductos tbody").off("click").on("click", function () {
    $(".dd-productos.dropdown-menu").removeClass("show");
    $("#ventaProducto").val("");
    $("#lstProductos").hide();
    var info = Array();
    var idproducto = $("a.sel").parents("tr").find("td").data('id')
    $("a.sel").parents("tr").find("td").each(function (index) {
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
        codigo: info[6]
    }
    _venta.productosSelecionados(selProducto);
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


