_modulos = (function () {
	var url = location.protocol + "//" + location.host + "/pharmadmin/";

	var construirModulos = function (datos) {
		var tamano = datos.length - 1;
		var cont = 1;
		datos.forEach(function (element, index) {
			if (tamano == index) {
				cont = -index;
			}
			if (datos[index + cont].idmodulo == element.idmodulo) {
			} else {
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
			}
		});
		datos.forEach(function (element, subindex) {
			if (element.modulos_id !== null) {
				$("#modulo" + element.modulos_id + " p i").remove();

				$("#modulo" + element.modulos_id).append(
					`<ul class="nav nav-treeview" id="submodulo` +
						element.idsubmodulo +
						`">
									<li class="nav-item">
										<a href="` +
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

	var consultarModulos = function (reload) {
		$.ajax({
			url: url + "cmodulo/consultarModulos",
			type: "post",
			cache: false,
			success: function (request, textStatus, jQxhr) {
				var data = JSON.parse(request);
				if (data.status == 200) {
					construirModulos(data.data);
				}
			},
			error: function (jqXhr, textStatus, errorThrown) {
				debugger;
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
