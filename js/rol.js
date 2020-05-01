_rol = (function () {
    var registrarRol = function () {
        let url = location.protocol + "//" + location.host + '/pharmadmin/';

        var formulario = $('#formRol').serialize();

        $.ajax({
            url: url + 'crol/registrarRol',
            type: 'post',
            data: formulario,
            cache: false,
            success: function (request, textStatus, jQxhr) {
                var data = JSON.parse(request);
                if (data.status == 200) {
                    $.notify(data.msj, {
                        className: 'success',
                        globalPosition: 'top center',
                        autoHideDelay: 3000
                    });
                    $("#rol").val("");
                }
            },
            error: function (jqXhr, textStatus, errorThrown) {
                console.log(errorThrown);
            }
        });
    }

    var consultarRoles = function () {
        let url = location.protocol + "//" + location.host + '/pharmadmin/';

        $.ajax({
            url: url + 'crol/consultarRoles',
            type: 'post',
            cache: false,
            success: function (request, textStatus, jQxhr) {
                var data = JSON.parse(request);
                if (data.status == 200) {

                    var rolesActivos = Array();
                    var rolesInactivos = Array();
                    var cont = 0;

                    data.data.forEach(function (element, index) {
                        if (element.estado == 0) {
                            rolesInactivos[index - cont] = element;
                        } else {
                            rolesActivos[index] = element;
                            cont = cont + 1;
                        }
                    });
                    $('#tblRolesActivos').dataTable({
                        // select: true,
                        data: rolesActivos,
                        columns: [
                            { "data": "id" },
                            { "data": "rol" },
                            {
                                data: 'id',
                                render: function (data) {
                                    return '<i class="fas fa-edit mr-4 text-success"></i>'
                                }
                            },
                        ],
                    });

                    $('#tblRolesInactivos').dataTable({
                        // select: true,
                        data: rolesInactivos,
                        columns: [
                            { "data": "id" },
                            { "data": "rol" },
                            {
                                data: 'id',
                                render: function (data) {
                                    return '<i class="fas fa-edit mr-4 text-success"></i>'
                                }
                            },

                        ],
                    });
                }
            },
            error: function (jqXhr, textStatus, errorThrown) {
                console.log(errorThrown);
            }
        });
    }

    var actualizarRol = function () {
        let url = location.protocol + "//" + location.host + '/pharmadmin/';
        var parametros = {
            id: $("#idrol").val(),
            rol: $("#rol").val()
        }

        $.ajax({
            url: url + 'crol/actualizarRol',
            type: 'post',
            data: parametros,
            cache: false,
            success: function (request, textStatus, jQxhr) {
                var data = JSON.parse(request);
                if (data.status == 200) {
                    $.notify(data.msj, {
                        className: 'success',
                        globalPosition: 'top center',
                        autoHideDelay: 3000
                    });
                    $("#rol").val("");
                    $("#rRol").show();
                    $("#aRol").hide();
                    $("#btnGuardarRol").show();
                    $("#btnActualizarRol").hide();
                    $("#idrol").val("");
                    $("#tblRolesActivos tbody").remove();

                    consultarRoles();
                }
            },
            error: function (jqXhr, textStatus, errorThrown) {
                console.log(errorThrown);
            }
        });
    }

    return {
        registrarRol: registrarRol,
        consultarRoles: consultarRoles,
        actualizarRol: actualizarRol
    }
})()

$("#btnGuardarRol").off("click").on("click", function () {
    _rol.registrarRol();
})

$("#btnActualizarRol").off("click").on("click", function () {
    _rol.actualizarRol();
})

$(document).ready(function () {
    _rol.consultarRoles();
});

$(document).off("click", ".fa-edit").on("click", ".fa-edit", function () {
    var info = Array();
    $(this).parents("tr").find("td").each(function (index) {
        info[index] = $(this).html();
    });
    $("#rRol").hide();
    $("#aRol").show();
    $("#btnGuardarRol").hide();
    $("#btnActualizarRol").show();
    $("#rol").val(info[1]);
    $("#idrol").val(info[0]);
    $("#rol").focus();
})

