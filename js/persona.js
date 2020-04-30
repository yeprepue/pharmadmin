_persona = (function () {
    var iniciarSesion = function () {

        let url = location.protocol + "//" + location.host + '/pharmadmin/';

        var usuario = $('#usuario').val();
        var clave = $('#clave').val();

        $.ajax({
            url: url + 'cpersona/iniciarSesion',
            // dataType: 'json',
            type: 'post',
            data: {
                usuario: usuario,
                clave: clave
            },
            cache: false,
            success: function (data, textStatus, jQxhr) {
                var data = JSON.parse(data);
                debugger;
                if (data.status == 200) {
                    location.href = url + 'cpersona/inicio';
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
    return {
        iniciarSesion: iniciarSesion
    }
})()

$("#btnIniciarSesion").off("click").on("click", function () {
    _persona.iniciarSesion();
})

$(document).ready(function () {
    $('#msjerror').hide();
}); 