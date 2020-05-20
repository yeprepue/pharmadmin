_modulos = (function () {
	var url = location.protocol + "//" + location.host + "/pharmadmin/";

	var construirModulos = function (modulos, submodulos) {
		var hash = {};
		//Eliminamos duplicados
		modulos = modulos.filter(function (modulo) {
			var exists = !hash[modulo.idmodulo];
			hash[modulo.idmodulo] = true;
			return exists;
		});

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
				mestado: element.mestado,
			};
			if (element.modulos_id !== null) {
				submodulos[contsub] = {
					idsubmodulo: element.idsubmodulo,
					submodulo: element.submodulo,
					smenlace: element.smenlace,
					smicono: element.smicono,
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

	var consultarModulos = function (reload) {
		$.ajax({
			url: url + "cmodulo/consultarModulos",
			type: "post",
			cache: false,
			success: function (request, textStatus, jQxhr) {
				var data = JSON.parse(request);

				if (data.status == 200) {
					debugger;
					var infoMS = modulos_Submodulos(data.data);
					construirModulos(infoMS.modulos, infoMS.submodulos);
				}
			},
			error: function (jqXhr, textStatus, errorThrown) {
				console.log(errorThrown);
			},
		});
	};

	return {
		consultarModulos: consultarModulos,
	};
})();

$(document).ready(function () {
	_modulos.consultarModulos();
});
