_rol = (function () {
	var tblRolesActivos = "";
	var tblRolesInactivos = "";
	var registrarRol = function () {
		let url = location.protocol + "//" + location.host + "/pharmadmin/";

		var formulario = $("#formRol").serialize();

		$.ajax({
			url: url + "crol/registrarRol",
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
					$("#rol").val("");
					consultarRoles(true);
				}
			},
			error: function (jqXhr, textStatus, errorThrown) {
				console.log(errorThrown);
			},
		});
	};

	function fxRolesActivos(rolesActivos, reload) {
		if (reload) {
			tblRolesActivos.fnDestroy();
		}

		tblRolesActivos = $("#tblRolesActivos").dataTable({
			pageLength: 5,
			language: lenguajeDT,
			data: rolesActivos,
			columns: [
				{ data: "id" },
				{ data: "rol" },
				{ data: "estado", visible: false },
				{
					data: "id",
					render: function (data) {
						return `<button type="button" class="btn btn-info btn-edt-rol">Editar</button>
                        <button type="button" class="btn btn-danger btn-desac-rol">Desactivar</button>`;
					},
				},
			],
		});
	}

	function fxRolesInactivos(rolesInactivos, reload) {
		if (reload) {
			tblRolesInactivos.fnDestroy();
		}
		tblRolesInactivos = $("#tblRolesInactivos").dataTable({
            pageLength: 5,
            language: lenguajeDT,
			data: rolesInactivos,
			columns: [
				{ data: "id" },
				{ data: "rol" },
				{ data: "estado", visible: false },
				{
					data: "id",
					render: function (data) {
						return `<button type="button" class="btn btn-success btn-desac-rol">Activar</button>`;
					},
				},
			],
		});
	}

	var consultarRoles = function (reload) {
		let url = location.protocol + "//" + location.host + "/pharmadmin/";

		$.ajax({
			url: url + "crol/consultarRoles",
			type: "post",
			cache: false,
			success: function (request, textStatus, jQxhr) {
				var data = JSON.parse(request);
				if (data.status == 200) {
					var rolesActivos = Array();
					var rolesInactivos = Array();
					var conAct = 0;
					var conInac = 0;

					data.data.forEach(function (element, index) {
						if (element.estado == 0) {
							rolesInactivos[index - conAct] = element;
							conInac = conInac + 1;
						} else {
							rolesActivos[index - conInac] = element;
							conAct = conAct + 1;
						}
					});
					fxRolesActivos(rolesActivos, reload);
					fxRolesInactivos(rolesInactivos, reload);
				}
			},
			error: function (jqXhr, textStatus, errorThrown) {
				console.log(errorThrown);
			},
		});
	};

	var actualizarRol = function () {
		let url = location.protocol + "//" + location.host + "/pharmadmin/";
		var parametros = {
			id: $("#idrol").val(),
			rol: $("#rol").val(),
		};

		$.ajax({
			url: url + "crol/actualizarRol",
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
					$("#rol").val("");
					$("#rRol").show();
					$("#aRol").hide();
					$("#btnGuardarRol").show();
					$("#btnActualizarRol").hide();
					$("#idrol").val("");
					consultarRoles(true);
				}
			},
			error: function (jqXhr, textStatus, errorThrown) {
				console.log(errorThrown);
			},
		});
	};

	var cambiarEstadoRol = function (idrol) {
		let url = location.protocol + "//" + location.host + "/pharmadmin/";
		var parametros = {
			id: idrol,
		};
		$.ajax({
			url: url + "crol/cambiarEstadoRol",
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

					consultarRoles(true);
				}
			},
			error: function (jqXhr, textStatus, errorThrown) {
				console.log(errorThrown);
			},
		});
	};

	return {
		registrarRol: registrarRol,
		consultarRoles: consultarRoles,
		actualizarRol: actualizarRol,
		cambiarEstadoRol: cambiarEstadoRol,
	};
})();

$("#btnGuardarRol")
	.off("click")
	.on("click", function () {
		if ($("#rol").val() == "") {
			$("#divmsj-rol").show();
			setTimeout(() => {
				$("#divmsj-rol").hide();
			}, 3000);
		} else {
			_rol.registrarRol();
		}
	});

$("#btnActualizarRol")
	.off("click")
	.on("click", function () {
		if ($("#rol").val() == "") {
			$("#divmsj-rol").show();
			setTimeout(() => {
				$("#divmsj-rol").hide();
			}, 3000);
		} else {
			_rol.actualizarRol();
		}
	});

$(document).ready(function () {
	_rol.consultarRoles(false);
});

$(document)
	.off("click", ".btn-edt-rol")
	.on("click", ".btn-edt-rol", function () {
		var info = Array();
		$(this)
			.parents("tr")
			.find("td")
			.each(function (index) {
				info[index] = $(this).html();
			});
		$("#rRol").hide();
		$("#aRol").show();
		$("#btnGuardarRol").hide();
		$("#btnActualizarRol").show();
		$("#rol").val(info[1]);
		$("#idrol").val(info[0]);
		$("#rol").focus();
	});

$(document)
	.off("click", ".btn-desac-rol")
	.on("click", ".btn-desac-rol", function () {
		var info = Array();
		$(this)
			.parents("tr")
			.find("td")
			.each(function (index) {
				info[index] = $(this).html();
			});
		_rol.cambiarEstadoRol(info[0]);
	});
