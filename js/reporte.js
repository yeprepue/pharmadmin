_reporte = (function () {
	var tblReporteFacturas = "";
	var tblReportePedidos = "";

	function fxReporteFacturas(facturas, reload) {
		if (reload) {
			tblReporteFacturas.fnDestroy();
		}

		tblReporteFacturas = $("#tblReporteFacturas").dataTable({
			pageLength: 8,
			language: lenguajeDT,
			select: true,
			data: facturas,
			columns: [
				{ data: "id" },
				{ data: "fecha" },
				{ data: "estado", visible: false },
			],
		});
	}

	function fxReportePedidos(pedidos, reload) {
		if (reload) {
			tblReportePedidos.fnDestroy();
		}

		tblReportePedidos = $("#tblReportePedidos").dataTable({
			pageLength: 8,
			language: lenguajeDT,
			select: true,
			data: pedidos,
			columns: [
				{ data: "id" },
				{ data: "fecha" },
				{ data: "estado", visible: false },
			],
		});
	}

	// var consultarFacturas = function (reload) {
	// 	let url = location.protocol + "//" + location.host + "/pharmadmin/";

	// 	$.ajax({
	// 		url: url + "creporte/consultarFacturas",
	// 		type: "post",
	// 		cache: false,
	// 		success: function (request, textStatus, jQxhr) {
	// 			var data = JSON.parse(request);

	// 			fxReporteFacturas(data.data);
	// 		},
	// 		error: function (jqXhr, textStatus, errorThrown) {
	// 			console.log(errorThrown);
	// 		},
	// 	});
	// };

	var consultarPedidos = function (reload) {
		let url = location.protocol + "//" + location.host + "/pharmadmin/";

		$.ajax({
			url: url + "creporte/consultarPedidos",
			type: "post",
			cache: false,
			success: function (request, textStatus, jQxhr) {
				var data = JSON.parse(request);

				fxReportePedidos(data.data);
			},
			error: function (jqXhr, textStatus, errorThrown) {
				console.log(errorThrown);
			},
		});
	};

	var consultarFacturas = function (reload) {
		let url = location.protocol + "//" + location.host + "/pharmadmin/";

		var formulario = $("#frmFacturas").serialize();

		$.ajax({
			url: url + "creporte/consultarFacturas",
			type: "post",
			cache: false,
			data: formulario,
			success: function (request, textStatus, jQxhr) {
				var data = JSON.parse(request);

				fxReporteFacturas(data.data, reload);
			},
			error: function (jqXhr, textStatus, errorThrown) {
				console.log(errorThrown);
			},
		});
	};

	return {
		consultarFacturas: consultarFacturas,
		consultarPedidos: consultarPedidos,
	};
})();

$(document).ready(function () {
	_reporte.consultarFacturas(false);
	_reporte.consultarPedidos(false);
});

$("#btnRangoFechas")
	.off("click")
	.on("click", function () {
		_reporte.consultarFacturas(true);
	});
