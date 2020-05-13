_venta = (function () {
	var infoProducto = Array();

	//Buscamos los productos dependindo del valor que se introduzca en el campo de texto
	var buscarProducto = function () {
		let url = location.protocol + "//" + location.host + "/pharmadmin/";

		var formulario = $("#formfactura").serialize();
		if (formulario.split("=")[1] !== "") {
			$.ajax({
				url: url + "cfactura/buscarProducto",
				type: "post",
				data: formulario,
				cache: false,
				success: function (request, textStatus, jQxhr) {
					var data = JSON.parse(request);
					$("#lstProductos tbody").empty();
					fxLstProductos(data);
				},
				error: function (jqXhr, textStatus, errorThrown) {
					console.log(errorThrown);
				},
			});
		} else {
			$("#lstProductos").hide();
			$(".dd-productos.dropdown-menu").removeClass("show");
		}
	};

	//Construimos una tabla con los productos encontrados
	var fxLstProductos = function (data) {
		data.data.forEach(function (element) {
			$("#lstProductos tbody").append(
				`
			<tr>
				<td data-id="` +
					element.id +
					`"><a class="sel">` +
					element.producto +
					`</a></td>
				<td data-id="` +
					element.id +
					`"><a class="sel">` +
					element.tipo +
					`</a></td>
				<td data-id="` +
					element.id +
					`"><a class="sel">` +
					element.numerotipo +
					`</a></td>
				<td data-id="` +
					element.id +
					`"><a class="sel">` +
					element.medida +
					`</a></td>
				<td data-id="` +
					element.id +
					`"><a class="sel">` +
					element.numeromedida +
					`</a></td>
				<td data-id="` +
					element.id +
					`"><a class="sel">` +
					element.marca +
					`</a></td>
				<td data-id="` +
					element.id +
					`"><a class="sel">` +
					element.codigobarras +
					`</a></td>
				<td data-id="` +
					element.id +
					`"><a class="sel">` +
					element.precioventa +
					`</a></td>
			</tr>
		`
			);
			$("#lstProductos").show();
			$(".dd-productos.dropdown-menu").addClass("show");
		});
	};

	//Seleccionamos los productos y los almacenamos en un arreglo
	var fxSelProductos = function (infoProducto) {
		//Almacenamos en localStorage
		localStorage.setItem("selproductos", JSON.stringify(infoProducto));
		//Construimos la tabla con los productos seleccionados
		infoProducto.forEach(function (element, index) {
			$("#selProductos tbody").append(
				`
            <tr>
                <td>` +
					(index + 1) +
					`</td>
                <td data-id="` +
					element.id +
					`">` +
					element.producto +
					`</td>
                <td><input id="cantvendida` +
					index +
					`" type="number" minlength="1" name="cantvendida" value="` +
					element.cantidad +
					`" data-pos="` +
					index +
					`" class="cantvendida"></td>
                <td><span class="lblprecio" id="precio` +
					index +
					`">` +
					element.precio * element.cantidad +
					`</span></td>
                <td data-id="` +
					element.id +
					`">` +
					element.tipo +
					`</td>
                <td data-id="` +
					element.id +
					`">` +
					element.ntipo +
					`</td>
                <td data-id="` +
					element.id +
					`">` +
					element.medida +
					`</td>
                <td data-id="` +
					element.id +
					`">` +
					element.nmedida +
					`</td>
                <td data-id="` +
					element.id +
					`">` +
					element.marca +
					`</td>
                <td data-id="` +
					element.id +
					`">` +
					element.codigo +
					`</td>
                <td><i class="fas fa-times-circle text-danger elim-producto"></i></td>
            </tr>
		`
			);
		});

		$("#ventaProducto").focus();

		//Construimos el footer de la table en donde van los totales
		$("#selProductos tbody").append(`
			<tr class="tr-totales">
				<td colspan="2"></td>
                c<td><strong>Total:</strong></td>
				<td colspan="8"><input id="totalventa" type="text" disabled class="totalvendido"></td>
			</tr>
			<tr class="tr-totales">
				<td colspan="2"></td>
				<td><strong>Monto de pago:</strong></td>
				<td colspan="8"><input id="montopago" type="text" class="montopago" placeholder="Ingrese el monto"></td>
			</tr>
			<tr class="tr-totales">
				<td colspan="2"></td>
				<td><strong>Devolución:</strong></td>
				<td colspan="8"><label></label><input id="devolucion" type="text" class="totalvendido" disabled></td>
			</tr>
		`);

		$("#totalcantidad").val(calcularCantidad(infoProducto));
		$("#totalventa").val(calcularVenta(infoProducto));
		$("#totalventa").number(true, 0);
		$("#montopago").number(true, 0);
		$(".lblprecio").number(true, 0);
	};

	/*Permite calcular la cantidad total de productos que pasan por la caja*/
	var calcularCantidad = function (infoProducto) {
		var total = 0;
		var cantidad = 0;
		for (let i = 0; i < infoProducto.length; i++) {
			cantidad = $("#cantvendida" + i).val();
			total = total + parseInt(cantidad);
		}
		return total;
	};

	/*Permite calcular el precio total de productos que pasan por la caja*/
	var calcularVenta = function (infoProducto) {
		var total = 0;
		var venta = 0;
		for (let i = 0; i < infoProducto.length; i++) {
			venta = $("#cantvendida" + i).val() * infoProducto[i].precio;
			total = total + parseFloat(venta);
		}
		return total;
	};

	//Calculamos el valor que debe devolverse al cliente
	var calcularDevolucion = function () {
		var devolucion = $("#montopago").val() - $("#totalventa").val();
		$("#devolucion").val(devolucion);
		$("#devolucion").number(true, 0);
	};

	//Operamos precios y cantidades y luego mostramos totales
	var mostrarTotales = function (pos) {
		localStorage.setItem("selproductos", JSON.stringify(infoProducto));
		var cantidad = $("#cantvendida" + pos).val();
		infoProducto[pos].cantidad = cantidad;
		var precio = infoProducto[pos].precio * cantidad;
		$("#precio" + pos).html(precio);
		$("#totalcantidad").val(calcularCantidad(infoProducto));
		$("#totalventa").val(calcularVenta(infoProducto));
		$(".lblprecio").number(true, 0);
		var devolucion = $("#montopago").val() - $("#totalventa").val();
		$("#devolucion").val(devolucion);
		$("#devolucion").number(true, 0);
	};

	/*Almacenamos en un arreglo los productos seleccionados con sus respectivas cantidades*/
	var productosSelecionados = function (selProducto, reload) {
		if (reload) {
			infoProducto = selProducto;
		} else {
			infoProducto.push(selProducto);
		}

		//Limpiamos la tabla
		$("#selProductos tbody").empty();

		//Cargamos los datos de la tabla de nuevo
		fxSelProductos(infoProducto);
	};

	//Eliminamos el producto del arreglo y de la vista
	var eliminarSelProducto = function (pos) {
		localStorage.setItem("selproductos", JSON.stringify(infoProducto));
		var pos = pos - 1;
		infoProducto.splice(pos, 1);
		if (infoProducto.length == 0) {
			$("#selProductos").hide();
			$("#rowFacturar").hide();
		}
		productosSelecionados(infoProducto, true);
	};

	var facturar = function () {
		lsSelProductos = JSON.parse(localStorage.getItem("selproductos"));
		let url = location.protocol + "//" + location.host + "/pharmadmin/";

		var datos = [];
		var objeto = {};

		lsSelProductos.forEach(function (element, index) {
			datos[index] = {
				precioventa: element.precio,
				cantidad: element.cantidad,
				montopago: parseFloat($("#montopago").val()),
				detalleproductos_id: element.id,
				personas_id: $("#idusuario").val(),
			};
		});

		objeto.datos = datos;

		var parametros = {
			data: JSON.stringify(objeto),
		};
		$.ajax({
			url: url + "cfactura/facturar",
			type: "post",
			data: parametros,
			cache: false,
			success: function (request, textStatus, jQxhr) {
				var data = JSON.parse(request);
				resumenFactura(data.data);
				infoProducto = [];
				$("#selProductos tbody").empty();
				$("#selProductos").hide();
				$("#rowFacturar").hide();
				localStorage.setItem("selproductos", JSON.stringify(infoProducto));
			},
			error: function (jqXhr, textStatus, errorThrown) {
				console.log(errorThrown);
			},
		});
	};

	var resumenFactura = function (numFactura) {
		$("#modalproductos").modal("show");
		$("#tblResumenProductos tbody").empty();
		var montopago = $("#montopago").val();
		var tmpResumen = 0;
		var totalResumen = 0;
		$("#facturaventa").append(numFactura);
		lsSelProductos = JSON.parse(localStorage.getItem("selproductos"));

		lsSelProductos.forEach(function (element, index) {
			var num = index + 1;

			$("#tblResumenProductos tbody").append(
				`
                <tr>
                <td>` +
					num +
					`</td>
                    <td>` +
					element.producto +
					` ` +
					element.marca +
					` ` +
					element.nmedida +
					` ` +
					element.medida +
					` ` +
					element.ntipo +
					` ` +
					element.tipo +
					`</td>
                    <td>` +
					element.cantidad +
					`</td>
                    <td>` +
					element.precio * element.cantidad +
					`</td>
                </tr>
            `
			);

			tmpResumen = parseFloat(element.precio) * parseInt(element.cantidad);
			totalResumen = totalResumen + tmpResumen;
		});

		$("#tblResumenProductos tbody").append(
			`
			<tr>
				<td colspan="5"></td>
            <tr>
				<td colspan="2"><span><strong>Devolución:</strong></span></td>
                <td><strong>Paga con:</strong></td>
                <td><strong>Total:</strong></td>
            </tr>
            <tr>
				<td colspan="2"><span class="resumen"><strong>` +
				(montopago - totalResumen) +
				`</strong></span></td>
            	<td><span class="resumen"><strong>` +
				montopago +
				`</strong></span></td>
            	<td><span class="resumen"><strong>` +
				totalResumen +
				`</strong></span></td>
            </tr>
        `
		);

		$(".resumen").number(true, 0);
	};

	return {
		buscarProducto: buscarProducto,
		productosSelecionados: productosSelecionados,
		eliminarSelProducto: eliminarSelProducto,
		calcularDevolucion: calcularDevolucion,
		mostrarTotales: mostrarTotales,
		facturar: facturar,
		resumenFactura: resumenFactura,
	};
})();

$(document)
	.off("keyup", ".montopago")
	.on("keyup", ".montopago", function () {
		_venta.calcularDevolucion();
	});

$(document)
	.off("change", ".montopago")
	.on("change", ".montopago", function () {
		_venta.calcularDevolucion();
	});

$(document)
	.off("keyup", ".cantvendida")
	.on("keyup", ".cantvendida", function () {
		var pos = $(this).data("pos");
		_venta.mostrarTotales(pos);
	});

$(document)
	.off("change", ".cantvendida")
	.on("change", ".cantvendida", function () {
		var pos = $(this).data("pos");
		_venta.mostrarTotales(pos);
	});

$("#ventaProducto")
	.off("keyup")
	.on("keyup", function () {
		_venta.buscarProducto();
	});

$(document)
	.off("click", "#lstProductos .sel")
	.on("click", "#lstProductos .sel", function () {
		$(".dd-productos.dropdown-menu").removeClass("show");
		$("#ventaProducto").val("");
		$("#lstProductos").hide();
		$("#selProductos").show();
		$("#rowFacturar").show();
		var info = Array();
		var idproducto = $(this).parents("tr").find("td").data("id");
		$(this)
			.parents("tr")
			.find("td")
			.each(function (index) {
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
			precio: info[7],
		};
		_venta.productosSelecionados(selProducto, false);
	});

$(document).ready(function () {
	$("#ventaProducto").focus();
	$("#dropdownMenuButton").hide();
	$(".lblprecio").number(true, 0);
});

$(document)
	.off("click", ".elim-producto")
	.on("click", ".elim-producto", function () {
		var info = Array();
		$(this)
			.parents("tr")
			.find("td")
			.each(function (index) {
				info[index] = $(this)[0].innerText;
			});
		_venta.eliminarSelProducto(info[0]);
		$(this).parents("tr").remove();
	});

$(document)
	.off("click", "#btnFacturar")
	.on("click", "#btnFacturar", function () {
		var tmpDevolucion = $("#devolucion").val();
		var tmpMontopago = $("#montopago").val();

		if (tmpMontopago == "") {
			$("#montopago").focus();
			swal(
				"¡Cuidado!",
				"Debe escribir el monto con el que paga el cliente",
				"error"
			);
		} else if (tmpDevolucion < 0) {
			$("#montopago").focus();
			swal(
				"¡Cuidado!",
				"El monto de pago debe ser mayor al total de la compra",
				"error"
			);
		} else {
			_venta.facturar();
		}
	});
