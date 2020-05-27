_modulo = (function () {
	var url = location.protocol + "//" + location.host + "/pharmadmin/";
	var tblModulosActivos = "";
	var tblModulosInactivos = "";

	var registrarModulo = function () {
		var formulario = $("#formModulo").serialize();

		$.ajax({
			url: url + "cmodulo/registrarModulo",
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
					$("#modulo").val("");
					$("#menlace").val("");
					$("#micono").val("");
					$("#morden").val("");
					consultarModulos(true);
				}
			},
			error: function (jqXhr, textStatus, errorThrown) {
				console.log(errorThrown);
			},
		});
	};

	function fxmodulosActivos(modulosActivos, reload) {
		if (reload) {
			tblModulosActivos.fnDestroy();
		}

		debugger;

		tblModulosActivos = $("#tblModulosActivos").dataTable({
			pageLength: 5,
			language: lenguajeDT,
			data: modulosActivos,
			columns: [
				{
					data: "idmodulo",
					render: function (data) {
						debugger;
						if (data.idsubmodulo !== null) {
							return `<i class="nav-icon fas fa-eye mx-auto"></i>`;
						}
					},
				},
				{ data: "idmodulo" },
				{ data: "modulo" },
				{ data: "menlace" },
				{ data: "micono" },
				{ data: "morden" },
				{ data: "mestado", visible: false },
				{
					data: "idmodulo",
					render: function (data) {
						return `<button type="button" class="btn btn-info btn-edt-modulo">Editar</button>
                        <button type="button" class="btn btn-danger btn-desac-modulo">Desactivar</button>`;
					},
				},
			],
		});
	}

	function fxmodulosInactivos(modulosInactivos, reload) {
		if (reload) {
			tblModulosInactivos.fnDestroy();
		}
		tblModulosInactivos = $("#tblModulosInactivos").dataTable({
			pageLength: 5,
			language: lenguajeDT,
			data: modulosInactivos,
			columns: [
				{ data: "idmodulo" },
				{ data: "modulo" },
				{ data: "menlace" },
				{ data: "micono" },
				{ data: "morden" },
				{ data: "mestado", visible: false },
				{
					data: "idmodulo",
					render: function (data) {
						return `<button type="button" class="btn btn-success btn-desac-modulo">Activar</button>`;
					},
				},
			],
		});
	}

	var actualizarModulo = function () {
		var parametros = {
			id: $("#idmodulo").val(),
			modulo: $("#modulo").val(),
			menlace: $("#menlace").val(),
			micono: $("#micono").val(),
			morden: $("#morden").val(),
		};

		$.ajax({
			url: url + "cmodulo/actualizarModulo",
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

					$("#modulo").val("");
					$("#menlace").val("");
					$("#micono").val("");
					$("#morden").val("");

					$("#rModulo").show();
					$("#amodulo").hide();
					$("#btnGuardarModulo").show();
					$("#btnActualizarModulo").hide();
					$("#idproducto").val("");
					consultarModulos(true);
				}
			},
			error: function (jqXhr, textStatus, errorThrown) {
				console.log(errorThrown);
			},
		});
	};

	var cambiarEstadoModulo = function (idmodulo) {
		var parametros = {
			id: idmodulo,
		};
		$.ajax({
			url: url + "cmodulo/cambiarEstadoModulo",
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

					consultarModulos(true);
					consultarModulosxRol(true);
				}
			},
			error: function (jqXhr, textStatus, errorThrown) {
				console.log(errorThrown);
			},
		});
	};

	var construirModulos = function (modulos, submodulos) {
		$("#modulo-item").empty();
		modulos.forEach(function (element, index) {
			$("#modulo-item").append(
				`<li class="nav-item" id="modulo` +
					element.idmodulo +
					`">
						<a href="` +
					url +
					element.menlace +
					`" class="nav-link">
										` +
					element.micono +
					`
							<p>
												` +
					element.modulo +
					`
							</p>
						</a>
					</li>
								`
			);
		});
		submodulos.forEach(function (element, subindex) {
			if (element.modulos_id !== null) {
				$("#modulo" + element.modulos_id + " p i").remove();

				$("#modulo" + element.modulos_id).append(
					`<ul class="nav nav-treeview" id="submodulo` +
						element.idsubmodulo +
						`">
									<li class="nav-item">
										<a href="` +
						url +
						element.smenlace +
						`" class="nav-link">
												` +
						element.smicono +
						`
									<span>
									` +
						element.submodulo +
						`
													</span>
												</a>
											</li>
										</ul>
								  </li>
										`
				);
				$("#modulo" + element.modulos_id + " p").append(
					`<i class="right fas fa-angle-left"></i>`
				);
			}
		});
	};

	var modulos_Submodulos = function (datos) {
		var modulos = Array();
		var submodulos = Array();
		var contsub = 0;
		datos.forEach(function (element, index) {
			modulos[index] = {
				idmodulo: element.idmodulo,
				modulo: element.modulo,
				menlace: element.menlace,
				micono: element.micono,
				morden: element.morden,
				mestado: element.mestado,
			};
			if (element.modulos_id !== null) {
				submodulos[contsub] = {
					idsubmodulo: element.idsubmodulo,
					submodulo: element.submodulo,
					smenlace: element.smenlace,
					smicono: element.smicono,
					smorden: element.smorden,
					smestado: element.smestado,
					modulos_id: element.modulos_id,
				};
				contsub = contsub + 1;
			}
		});

		info = {
			modulos: modulos,
			submodulos: submodulos,
		};

		return info;
	};

	var consultarModulosxRol = function (reload) {
		$.ajax({
			url: url + "cmodulo/consultarModulosxRol",
			type: "post",
			cache: false,
			success: function (request, textStatus, jQxhr) {
				var data = JSON.parse(request);

				if (data.status == 200) {
					var modulos = Array();
					var modulosActivos = Array();
					var modulosInactivos = Array();
					var conAct = 0;
					var conInac = 0;

					var infoMS = modulos_Submodulos(data.data);
					var hash = {};
					//Eliminamos duplicados
					modulos = infoMS.modulos.filter(function (modulo) {
						var exists = !hash[modulo.idmodulo];
						hash[modulo.idmodulo] = true;
						return exists;
					});

					construirModulos(modulos, infoMS.submodulos);
				}
			},
			error: function (jqXhr, textStatus, errorThrown) {
				console.log(errorThrown);
			},
		});
	};

	var cargarModulos = function () {
		$.ajax({
			url: url + "cmodulo/cargarModulos",
			type: "post",
			cache: false,
			success: function (request, textStatus, jQxhr) {
				var data = JSON.parse(request);
				if (data.status == 200) {
					data.data.forEach(function (element) {
						$("#selModulo").append(
							`
                            <option value="` +
								element.id +
								`">` +
								element.modulo +
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

	var consultarModulos = function (reload) {
		$.ajax({
			url: url + "cmodulo/consultarModulos",
			type: "post",
			cache: false,
			success: function (request, textStatus, jQxhr) {
				var data = JSON.parse(request);

				if (data.status == 200) {
					var modulos = Array();
					var modulosActivos = Array();
					var modulosInactivos = Array();
					var conAct = 0;
					var conInac = 0;

					var infoMS = modulos_Submodulos(data.data);
					var hash = {};
					//Eliminamos duplicados
					modulos = infoMS.modulos.filter(function (modulo) {
						var exists = !hash[modulo.idmodulo];
						hash[modulo.idmodulo] = true;
						return exists;
					});

					modulos.forEach(function (element, index) {
						if (element.mestado == 0) {
							modulosInactivos[index - conAct] = element;
							conInac = conInac + 1;
						} else {
							modulosActivos[index - conInac] = element;
							conAct = conAct + 1;
						}
					});

					fxmodulosActivos(modulosActivos, reload);
					fxmodulosInactivos(modulosInactivos, reload);
				}
			},
			error: function (jqXhr, textStatus, errorThrown) {
				console.log(errorThrown);
			},
		});
	};

	return {
		consultarModulosxRol: consultarModulosxRol,
		cargarModulos: cargarModulos,
		cambiarEstadoModulo: cambiarEstadoModulo,
		actualizarModulo: actualizarModulo,
		registrarModulo: registrarModulo,
		consultarModulos: consultarModulos,
	};
})();

$(document).ready(function () {
	_modulo.consultarModulosxRol();
	_modulo.consultarModulos();
	_modulo.cargarModulos();
});

$(document)
	.off("click", ".btn-desac-modulo")
	.on("click", ".btn-desac-modulo", function () {
		var info = Array();
		$(this)
			.parents("tr")
			.find("td")
			.each(function (index) {
				info[index] = $(this).html();
			});
		_modulo.cambiarEstadoModulo(info[0]);
	});

$(document)
	.off("click", ".btn-edt-modulo")
	.on("click", ".btn-edt-modulo", function () {
		var info = Array();
		$(this)
			.parents("tr")
			.find("td")
			.each(function (index) {
				info[index] = $(this).html();
			});
		var idmodulo = info[2].split("-")[0];
		$("#rModulo").hide();
		$("#aModulo").show();
		$("#btnGuardarModulo").hide();
		$("#btnActualizarModulo").show();
		$("#modulo").val(info[1]);
		$("#menlace").val(info[2]);
		$("#micono").val(info[3]);
		$("#morden").val(info[4]);
		$("#idmodulo").val(info[0]);
		$("#modulo").focus();
	});

$("#btnGuardarModulo")
	.off("click")
	.on("click", function () {
		if ($("#modulo").val() == "") {
			$("#divmsj-modulo").show();
			setTimeout(() => {
				$("#divmsj-modulo").hide();
			}, 3000);
		} else {
			_modulo.registrarModulo();
		}
	});

$("#btnActualizarModulo")
	.off("click")
	.on("click", function () {
		if ($("#modulo").val() == "") {
			$("#divmsj-modulo").show();
			setTimeout(() => {
				$("#divmsj-modulo").hide();
			}, 3000);
		} else {
			_modulo.actualizarModulo();
		}
	});
