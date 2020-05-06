_persona = (function () {

    var iniciarSesion = function () {

        let url = location.protocol + "//" + location.host + '/pharmadmin/';

        // var usuario = $('#usuario').val();
        // var clave = $('#clave').val();

        var formulario = $('#formIngreso').serialize();

        console.log(formulario);

        $.ajax({
            url: url + 'cpersona/iniciarSesion',
            type: 'post',
            data: formulario,
            cache: false,
            success: function (request, textStatus, jQxhr) {
                var data = JSON.parse(request);
                if (data.status == 200) {
                    if (data.data.roles_id == 1) {
                        location.href = url + 'cpersona/inicio';
                    } else if (data.data.roles_id == 2) {
                        location.href = url + 'cpersona/inicio2';
                    }

                } else {
                    $('#msjerror').show();
                    setTimeout(() => {
                        $('#msjerror').hide();
                    }, 4000);
                }
            },
            error: function (jqXhr, textStatus, errorThrown) {
                console.log(errorThrown);
            }
        });
    }

    var registrarPersona = function () {
        let url = location.protocol + "//" + location.host + '/pharmadmin/';

        var formulario = $('#formPersona').serialize();

        $.ajax({
            url: url + 'cpersona/registrarUsuario',
            type: 'post',
            data: formulario,
            cache: false,
            success: function (request, textStatus, jQxhr) {
                var data = JSON.parse(request);
                if (data.status == 200) {
                    location.href = url + 'cpersona';
                }
            },
            error: function (jqXhr, textStatus, errorThrown) {
                console.log(errorThrown);
            }
        });
    }
    return {
        iniciarSesion: iniciarSesion,
        registrarPersona: registrarPersona
    }
})()


$("#btnRegistrarPersona").off("click").on("click", function () {
    _persona.registrarPersona();
})

$("#btnIniciarSesion").off("click").on("click", function () {
    _persona.iniciarSesion();
})

$(document).ready(function () {
    $('#msjerror').hide();
}); 