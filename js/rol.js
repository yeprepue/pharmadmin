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
                    data.data.forEach(function (element) {
                        $('#tblRoles tbody').append(`
                        <tr>
                            <td>`+ element.id + `</td>
                            <td>`+ element.rol + `</td>
                            <td>
                            <i class="fas fa-edit mr-4 text-success"></i>
                            </td>
                        </tr>
                        `);
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