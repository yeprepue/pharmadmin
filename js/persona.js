_persona = (function () {
	var validarCamposVacios = function () {
		var values = [];
		$("input").each(function (index) {
			values[index] = this.value;
		});

		var cont = 0;
		for (let x = 0; x < values.length; x++) {
			if (values[x] == "") {
				cont = cont + 1;
			}
		}
		return cont;
	};

	var iniciarSesion = function () {
		let url = location.protocol + "//" + location.host + "/pharmadmin/";
		var formulario = $("#formIngreso").serialize();

		$.ajax({
			url: url + "cpersona/iniciarSesion",
			type: "post",
			data: formulario,
			cache: false,
			success: function (request, textStatus, jQxhr) {
				var data = JSON.parse(request);
				if (data.status == 200) {
					location.href = url + "cpersona/inicio";
				} else {
					$("#msjerror").show();
					setTimeout(() => {
						$("#msjerror").hide();
					}, 4000);
				}
			},
			error: function (jqXhr, textStatus, errorThrown) {
				console.log(errorThrown);
			},
		});
	};

	var registrarPersona = function () {
		let url = location.protocol + "//" + location.host + "/pharmadmin/";

		var formulario = $("#formPersona").serialize();

		if (validarCamposVacios() == 0) {
			$.ajax({
				url: url + "cpersona/registrarUsuario",
				type: "post",
				data: formulario,
				cache: false,
				success: function (request, textStatus, jQxhr) {
					var data = JSON.parse(request);
					if (data.status == 200) {
						location.href = url + "cpersona";
					}
				},
				error: function (jqXhr, textStatus, errorThrown) {
					console.log(errorThrown);
				},
			});
		} else {
			$("#msjerror").show();
			setTimeout(() => {
				$("#msjerror").hide();
			}, 4000);
		}
	};
	return {
		iniciarSesion: iniciarSesion,
		registrarPersona: registrarPersona,
	};
})();

$("#btnRegistrarPersona")
	.off("click")
	.on("click", function () {
		_persona.registrarPersona();
	});

$("#btnIniciarSesion")
	.off("click")
	.on("click", function () {
		_persona.iniciarSesion();
	});

$(document).ready(function () {
	$("#msjerror").hide();
});
