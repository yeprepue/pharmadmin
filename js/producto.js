_producto = (function () {
	var url = location.protocol + "//" + location.host + "/pharmadmin/";
	var tblProductosActivos = "";
	var tblProductosInactivos = "";

	var cargarCategorias = function () {
		$.ajax({
			url: url + "cproducto/cargarCategorias",
			type: "post",
			cache: false,
			success: function (request, textStatus, jQxhr) {
				var data = JSON.parse(request);
				if (data.status == 200) {
					data.data.forEach(function (element) {
						$("#selCategoria").append(
							`
                            <option value="` +
								element.id +
								`">` +
								element.categoria +
								`</option>
                        `
						);
					});
				}
			},
			error: function (jqXhr, textStatus, errorThrown) {
				console.log(errorThrown);
			},
		});
	};

	var registrarProducto = function () {
		var formulario = $("#formProducto").serialize();

		$.ajax({
			url: url + "cproducto/registrarProducto",
			type: "post",
			data: formulario,
			cache: false,
			success: function (request, textStatus, jQxhr) {
				var data = JSON.parse(request);
				if (data.status == 200) {
					$.notify(data.msj, {
						className: "success",
						globalPosition: "top center",
						autoHideDelay: 3000,
					});
					$("#producto").val("");
					$("#selCategoria").val("");
					consultarProductos(true);
				}
			},
			error: function (jqXhr, textStatus, errorThrown) {
				console.log(errorThrown);
			},
		});
	};

	function fxProductosActivos(productosActivos, reload, url) {
		if (reload) {
			tblProductosActivos.fnDestroy();
		}

		tblProductosActivos = $("#tblProductosActivos").dataTable({
			pageLength: 5,
			language: lenguajeDT,
			data: productosActivos,
			columns: [
				{ data: "idproducto" },
				{ data: "producto" },
				{
					data: productosActivos,
					render: function (data, type, row) {
						return row.idcategoria + "-" + row.categoria;
					},
				},
				{ data: "estado", visible: false },
				{
					data: "id",
					render: function (data) {
						return `<button type="button" class="btn btn-info btn-edt-producto">Editar</button>
                        <button type="button" class="btn btn-danger btn-desac-producto">Desactivar</button>`;
					},
				},
			],
		});
	}

	function fxProductosInactivos(productosInactivos, reload) {
		if (reload) {
			tblProductosInactivos.fnDestroy();
		}
		tblProductosInactivos = $("#tblProductosInactivos").dataTable({
			pageLength: 5,
			language: lenguajeDT,
			data: productosInactivos,
			columns: [
				{ data: "idproducto" },
				{ data: "producto" },
				{
					data: productosInactivos,
					render: function (data, type, row) {
						return row.idcategoria + "-" + row.categoria;
					},
				},
				{ data: "estado", visible: false },
				{
					data: "id",
					render: function (data) {
						return `<button type="button" class="btn btn-success btn-desac-producto">Activar</button>`;
					},
				},
			],
		});
	}

	var consultarProductos = function (reload) {
		$.ajax({
			url: url + "cproducto/consultarProductos",
			type: "post",
			cache: false,
			success: function (request, textStatus, jQxhr) {
				var data = JSON.parse(request);
				if (data.status == 200) {
					var productosActivos = Array();
					var productosInactivos = Array();
					var conAct = 0;
					var conInac = 0;

					data.data.forEach(function (element, index) {
						if (element.estado == 0) {
							productosInactivos[index - conAct] = element;
							conInac = conInac + 1;
						} else {
							productosActivos[index - conInac] = element;
							conAct = conAct + 1;
						}
					});

					fxProductosActivos(productosActivos, reload, url);
					fxProductosInactivos(productosInactivos, reload);
				}
			},
			complete: function () {},
			error: function (jqXhr, textStatus, errorThrown) {
				console.log(errorThrown);
			},
		});
	};

	var actualizarProducto = function () {
		var parametros = {
			id: $("#idproducto").val(),
			producto: $("#producto").val(),
			idcategoria: $("#selCategoria").val(),
		};

		$.ajax({
			url: url + "cproducto/actualizarProducto",
			type: "post",
			data: parametros,
			cache: false,
			success: function (request, textStatus, jQxhr) {
				var data = JSON.parse(request);
				if (data.status == 200) {
					$.notify(data.msj, {
						className: "success",
						globalPosition: "top center",
						autoHideDelay: 3000,
					});
					$("#producto").val("");
					$("#selCategoria").val("");
					$("#rProducto").show();
					$("#aProducto").hide();
					$("#btnGuardarProducto").show();
					$("#btnActualizarProducto").hide();
					$("#idproducto").val("");
					consultarProductos(true);
				}
			},
			error: function (jqXhr, textStatus, errorThrown) {
				console.log(errorThrown);
			},
		});
	};

	var cambiarEstadoProducto = function (idrol) {
		var parametros = {
			id: idrol,
		};
		$.ajax({
			url: url + "cproducto/cambiarEstadoProducto",
			type: "post",
			data: parametros,
			cache: false,
			success: function (request, textStatus, jQxhr) {
				var data = JSON.parse(request);
				if (data.status == 200) {
					$.notify(data.msj, {
						className: "success",
						globalPosition: "top center",
						autoHideDelay: 3000,
					});

					consultarProductos(true);
				}
			},
			error: function (jqXhr, textStatus, errorThrown) {
				console.log(errorThrown);
			},
		});
	};

	return {
		registrarProducto: registrarProducto,
		consultarProductos: consultarProductos,
		actualizarProducto: actualizarProducto,
		cambiarEstadoProducto: cambiarEstadoProducto,
		cargarCategorias: cargarCategorias,
	};
})();

$("#btnGuardarProducto")
	.off("click")
	.on("click", function () {
		if ($("#producto").val() == "") {
			$("#divmsj-producto").show();
			setTimeout(() => {
				$("#divmsj-producto").hide();
			}, 3000);
		} else {
			_producto.registrarProducto();
		}
	});

$("#btnActualizarProducto")
	.off("click")
	.on("click", function () {
		if ($("#producto").val() == "") {
			$("#divmsj-producto").show();
			setTimeout(() => {
				$("#divmsj-producto").hide();
			}, 3000);
		} else {
			_producto.actualizarProducto();
		}
	});

$(document).ready(function () {
	_producto.consultarProductos(false);
	_producto.cargarCategorias();
});

$(document)
	.off("click", ".btn-edt-producto")
	.on("click", ".btn-edt-producto", function () {
		var info = Array();
		$(this)
			.parents("tr")
			.find("td")
			.each(function (index) {
				info[index] = $(this).html();
			});

		var idcategoria = info[2].split("-")[0];
		$("#rProducto").hide();
		$("#aProducto").show();
		$("#btnGuardarProducto").hide();
		$("#btnActualizarProducto").show();
		$("#producto").val(info[1]);
		$("#selCcategoria option[value=" + idcategoria + "]").prop(
			"selected",
			"selected"
		);
		$("#selCategoria").val(idcategoria);
		$("#idproducto").val(info[0]);
		$("#producto").focus();
	});

$(document)
	.off("click", ".btn-desac-producto")
	.on("click", ".btn-desac-producto", function () {
		var info = Array();
		$(this)
			.parents("tr")
			.find("td")
			.each(function (index) {
				info[index] = $(this).html();
			});
		_producto.cambiarEstadoProducto(info[0]);
	});
