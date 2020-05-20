_farmacias = (function() {
    var tblFarmaciasActivas = "";
    var tblFarmaciasInactivas = "";

    var registrarFarmacias = function() {
        let url = location.protocol + "//" + location.host + "/pharmadmin/";
        var formulario = $("#formFarmacias").serialize();

        $.ajax({
            url: url + "cfarmacia/registrarFarmacias",
            type: "post",
            data: formulario,
            cache: false,
            success: function(request, textStatus, jQxhr) {
                var data = JSON.parse(request);
                if (data.status == 200) {
                    $.notify(data.msj, {
                        className: "success",
                        globalPosition: "top center",
                        autoHideDelay: 3000,
                    });
                    $("#farmacia").val("");
                    consultarFarmacias(true);
                }
            },
            error: function(jqXhr, textStatus, errorThrown) {
                console.log(errorThrown);
            },
        });
    };

    function fxfarmaciasActivas(farmaciasActivas, reload) {
        if (reload) {
            tblFarmaciasActivas.fnDestroy();
        }
        tblFarmaciasActivas = $("#tblFarmaciasActivas").dataTable({
            pageLength: 5,
            language: lenguajeDT,
            data: farmaciasActivas,
            columns: [
                { data: "id" },
                { data: "farmacia" },
                { data: "estado", visible: false },
                {
                    data: "id",
                    render: function(data) {
                        return `<button type="button" class="btn btn-info btn-edt-far">Editar</button>
                        <button type="button" class="btn btn-danger btn-desac-far">Desactivar</button>`;
                    },
                },
            ],
        });
    }

    function fxfarmaciasInactivas(farmaciasInactivas, reload) {
        if (reload) {
            tblFarmaciasInactivas.fnDestroy();
        }
        tblfarmaciasInactivas = $("#tblfarmaciasInactivas").dataTable({
            pageLength: 5,
            language: lenguajeDT,
            data: farmaciasInactivas,
            columns: [
                { data: "id" },
                { data: "farmacia" },
                { data: "estado", visible: false },
                {
                    data: "id",
                    render: function(data) {
                        return `<button type="button" class="btn btn-success btn-desac-far">Activar</button>`;
                    },
                },
            ],
        });
    }

    var consultarFarmacias = function(reload) {
        let url = location.protocol + "//" + location.host + "/pharmadmin/";
        $.ajax({
            url: url + "cfarmacia/consultarFarmacias",
            type: "post",
            cache: false,
            success: function(request, textStatus, jQxhr) {
                var data = JSON.parse(request);
                if (data.status == 200) {
                    var farmaciasActivas = Array();
                    var farmaciasInactivas = Array();
                    var conAct = 0;
                    var conInac = 0;
                    data.data.forEach(function(element, index) {
                        if (element.estado == 0) {
                            farmaciasInactivas[index - conAct] = element;
                            conInac = conInac + 1;
                        } else {
                            farmaciasActivas[index - conInac] = element;
                            conAct = conAct + 1;
                        }
                    });
                    fxfarmaciasActivas(farmaciasActivas, reload);
                    fxfarmaciasInactivas(farmaciasInactivas, reload);
                }
            },
            error: function(jqXhr, textStatus, errorThrown) {
                console.log(errorThrown);
            },
        });
    };


    var actualizarfarmacia = function() {
        let url = location.protocol + "//" + location.host + "/pharmadmin/";
        var parametros = {
            id: $("#idfarmacia").val(),
            farmacia: $("#farmacia").val(),
        };
        $.ajax({
            url: url + "cfarmacia/actualizarfarmacia",
            type: "post",
            data: parametros,
            cache: false,
            success: function(request, textStatus, jQxhr) {
                var data = JSON.parse(request);
                if (data.status == 200) {
                    $.notify(data.msj, {
                        className: "success",
                        globalPosition: "top center",
                        autoHideDelay: 3000,
                    });
                    $("#farmacia").val("");
                    $("#registrarFarmacia").show();
                    $("#actualizarFarmacia").hide();
                    $("#btnGuardarFarmacia").hide();
                    $("#btnActualizarFarmacia").show();
                    $("#idFarmacia").val("");
                    consultarFarmacias(true);
                }
            },
            error: function(jqXhr, textStatus, errorThrown) {
                console.log(errorThrown);
            },
        });
    };

    var cambiarEstadoFarmacia = function(id) {
        let url = location.protocol + "//" + location.host + "/pharmadmin/";
        var parametros = {
            id: id,
        };
        $.ajax({
            url: url + "cfarmacia/cambiarEstadoFarmacia",
            type: "post",
            data: parametros,
            cache: false,
            success: function(request, textStatus, jQxhr) {
                var data = JSON.parse(request);
                if (data.status == 200) {
                    $.notify(data.msj, {
                        className: "success",
                        globalPosition: "top center",
                        autoHideDelay: 3000,
                    });
                    consultarFarmacias(true);
                }
            },
            error: function(jqXhr, textStatus, errorThrown) {
                console.log(errorThrown);
            },
        });
    };
    return {
        registrarFarmacia: registrarFarmacia,
        consultarFarmacias: consultarFarmacias,
        actualizarFarmacia: actualizarFarmacia,
        cambiarEstadoFarmacia: cambiarEstadoFarmacia,
    };
})();

$("#btnGuardarFarmacia")
    .off("click")
    .on("click", function() {
        if ($("#farmacia").val() == "") {
            $("#divmsj-farmacia").show();
            setTimeout(() => {
                $("#divmsj-farmacia").hide();
            }, 3000);
        } else {
            _farmacia.registrarFarmacia;
        }
    });
$("#btnActualizarFarmacia")
    .off("click")
    .on("click", function() {
        if ($("#farmacia").val() == "") {
            $("#divmsj-farmacia").show();
            setTimeout(() => {
                $("#divmsj-farmacia").hide();
            }, 3000);
        } else {
            _farmacia.actualizarFarmacia();
        }
    });
$(document).ready(function() {
    _farmacia.consultarFarmacias(false);
});
$(document)
    .off("click", ".btn-edt-far")
    .on("click", ".btn-edt-far", function() {
        var info = Array();
        $(this)
            .parents("tr")
            .find("td")
            .each(function(index) {
                info[index] = $(this).html();
            });
        $("#registrarFarmacia").hide();
        $("#actualizarFarmacia").show();
        $("#btnGuardarFarmacia").hide();
        $("#btnActualizarFarmacia").show();
        $("#farmacia").val(info[1]);
        $("#idfarmacia").val(info[0]);
        $("#farmacia").focus();
    });

$(document)
    .off("click", ".btn-desac-far")
    .on("click", ".btn-desac-far", function() {
        var info = Array();
        $(this)
            .parents("tr")
            .find("td")
            .each(function(index) {
                info[index] = $(this).html();
            });
        _farmacia.cambiarEstadoFarmacia(info[0]);
    });