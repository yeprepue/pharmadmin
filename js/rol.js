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
                        debugger;
                        if (element.estado == 0) {
                            rolesInactivos[index - cont] = element;
                        } else {
                            rolesActivos[index] = element;
                            cont = cont + 1;
                        }
                    });
                    $('#tblRolesActivos').dataTable({
                        data: rolesActivos,
                        columns: [
                            { "data": "id" },
                            { "data": "rol" },
                            {
                                data: 'id',
                                render: function (data) {
                                    return '<td><i class="fas fa-edit mr-4 text-success"></i></td>'
                                }
                            },
                        ],
                    });

                    $('#tblRolesInactivos').dataTable({
                        data: rolesInactivos,
                        columns: [
                            { "data": "id" },
                            { "data": "rol" },
                            {
                                data: 'id',
                                render: function (data) {
                                    return '<td><i class="fas fa-edit mr-4 text-success"></i></td>'
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
    return {
        registrarRol: registrarRol,
        consultarRoles: consultarRoles
    }
})()

$("#btnGuardarRol").off("click").on("click", function () {
    _rol.registrarRol();
})

$(document).ready(function () {
    _rol.consultarRoles();
}); 