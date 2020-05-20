_farmacias = (function() {
    var tblFarmaciasActivas = "";
    var tblFarmaciasInactivas = "";

    var registrarFarmacias = function() {
        let url = location.protocol + "//" + location.host + "/pharmadmin/";
        var formulario = $("#formFramacias").serialize();
        debugger;
        $.ajax({
            url: url + "cfarmacias/registrarFarmacias",
            type: "post",
            data: formulario,
            cache: false,
            success: function(request, textStatus, jQxhr) {
                debugger;
                var data = JSON.parse(request);
                if (data.status == 200) {
                    $.notify(data.msj, {
                        className: "success",
                        globalPosition: "top center",
                        autoHideDelay: 3000,
                    });
                    $("#farmacia").val("");
                    consultarCategorias(true);
                }
            },
            error: function(jqXhr, textStatus, errorThrown) {
                debugger;
                console.log(errorThrown);
            },
        });
    };
    return {
        registrarFarmacias: registrarFarmacias,
    }

});
$("#btnGuardarFarmacia")
    .off("click")
    .on("click", function() {
        if ($("#farmacia").val() == "") {
            $("#divmsj-farmacia").show();
            setTimeout(() => {
                $("#divmsj-farmacia").hide();
            }, 3000);
        } else {
            _farmacias.registrarFarmacias();
        }
    });