_categoria = (function() {
            var tblCategoriasActivas = "";
            var tblCategoriasInactivas = "";
            var registrarCategoria = function() {
                    var registrarCategoria = function() {
                        let url = location.protocol + "//" + location.host + '/pharmadmin/';
                        // http://localhost/pharmadmin/
                        var formulario = $('#formCategoria').serialize();
                        $.ajax({
                            url: url + 'ccategoria/registrarCategoria',
                            type: 'post',
                            data: formulario,
                            cache: false,
                            success: function(request, textStatus, jQxhr) {
                                var data = JSON.parse(request);
                                if (data.status == 200) {
                                    $.notify(data.msj, {
                                        className: 'success',
                                        globalPosition: 'top center',
                                        autoHideDelay: 3000
                                    });
                                    $("#categoria").val("");
                                    consultarCategorias(true);
                                }
                            },
                            error: function(jqXhr, textStatus, errorThrown) {
                                console.log(errorThrown);
                            }
                        });
                    }
>>>>>>> 011f4f1e3cdaf70e6740f4c3f6262c87c1a07f0f

                    function fxcategoriasActivas(categoriasActivas, reload) {
                        if (reload) {
                            tblCategoriasActivas.fnDestroy();
                        }
                        tblCategoriasActivas = $('#tblCategoriasActivas').dataTable({
                            "pageLength": 5,
                            data: categoriasActivas,
                            columns: [
                                { "data": "id" },
                                { "data": "categoria" },
                                { "data": "estado", visible: false },
                                {
                                    data: 'id',
                                    render: function(data) {
                                        return `<button type="button" class="btn btn-info btn-edt-cat">Editar</button>
                        <button type="button" class="btn btn-danger btn-desac-cat">Desactivar</button>`
                                    }
                                },
                            ],
                        });
                    }

                    function fxcategoriasInactivas(categoriasInactivas, reload) {
                        if (reload) {
                            tblCategoriasInactivas.fnDestroy();
                        }
                        tblCategoriasInactivas = $('#tblCategoriasInactivas').dataTable({
                            "pageLength": 5,
                            data: categoriasInactivas,
                            columns: [
                                { "data": "id" },
                                { "data": "categoria" },
                                { "data": "estado", visible: false },
                                {
                                    data: 'id',
                                    render: function(data) {
                                        return `<button type="button" class="btn btn-info btn-edt-cat">Editar</button>
                        <button type="button" class="btn btn-success btn-desac-cat">Activar</button>`
                                    }
                                },
                            ],
                        });
                    } <<
                    <<
                    <<
                    <
                    HEAD
                    var consultarCategorias = function(reload) { ===
                            ===
                            =

                            var consultarCategorias = function(reload) { >>>
                                    >>>
                                    >
                                    4 aac000d7cf8ace995b66132336a9d98ba0aca12
                                    let url = location.protocol + "//" + location.host + '/pharmadmin/';
                                    $.ajax({
                                        url: url + 'ccategoria/consultarCategorias',
                                        type: 'post',
                                        cache: false,
                                        success: function(request, textStatus, jQxhr) {
                                            var data = JSON.parse(request);
                                            if (data.status == 200) {
                                                var categoriasActivas = Array();
                                                var categoriasInactivas = Array();
                                                var conAct = 0;
                                                var conInac = 0;
                                                data.data.forEach(function(element, index) {
                                                    if (element.estado == 0) {
                                                        categoriasInactivas[index - conAct] = element;
                                                        conInac = conInac + 1;
                                                    } else {
                                                        categoriasActivas[index - conInac] = element;
                                                        conAct = conAct + 1;
                                                    }
                                                });
                                                fxcategoriasActivas(categoriasActivas, reload);
                                                fxcategoriasInactivas(categoriasInactivas, reload);
                                            }
                                        },
                                        error: function(jqXhr, textStatus, errorThrown) {
                                            console.log(errorThrown);
                                        }
                                    });
                                } <<
                                <<
                                <<
                                <
                                HEAD
                            var actualizarCategoria = function() { ===
                                ===
                                =

                                var actualizarCategoria = function() { >>>
                                        >>>
                                        >
                                        4 aac000d7cf8ace995b66132336a9d98ba0aca12
                                        let url = location.protocol + "//" + location.host + '/pharmadmin/';
                                        var parametros = {
                                            //Acá había una error
                                            id: $("#idcategoria").val(),
                                            categoria: $("#categoria").val()
                                        }

                                        $.ajax({
                                            url: url + 'ccategoria/actualizarCategoria',
                                            type: 'post',
                                            data: parametros,
                                            cache: false,
                                            success: function(request, textStatus, jQxhr) {
                                                var data = JSON.parse(request);
                                                if (data.status == 200) {
                                                    $.notify(data.msj, {
                                                        className: 'success',
                                                        globalPosition: 'top center',
                                                        autoHideDelay: 3000
                                                    });
                                                    $("#categoria").val("");
                                                    $("#registrarCategoria").show();
                                                    $("#actualizarCategoria").hide();
                                                    $("#btnGuardarCategoria").hide();
                                                    $("#btnActualizarCategoria").show(); <<
                                                    <<
                                                    <<
                                                    <
                                                    HEAD
                                                        ===
                                                        ===
                                                        =
                                                        //Acá había una error
                                                        >>>
                                                        >>>
                                                        >
                                                        4 aac000d7cf8ace995b66132336a9d98ba0aca12
                                                    $("#idcategoria").val("");
                                                    consultarCategorias(true);
                                                }
                                            },
                                            error: function(jqXhr, textStatus, errorThrown) {
                                                console.log(errorThrown);
                                            }
                                        });
                                    } <<
                                    <<
                                    <<
                                    <
                                    HEAD
                                var cambiarEstadoCategoria = function(id) { ===
                                    ===
                                    =

                                    var cambiarEstadoCategoria = function(id) { >>>
                                        >>>
                                        >
                                        4 aac000d7cf8ace995b66132336a9d98ba0aca12
                                        let url = location.protocol + "//" + location.host + '/pharmadmin/';
                                        var parametros = {
                                            id: id
                                        }
                                        $.ajax({
                                            url: url + 'ccategoria/cambiarEstadoCategoria',
                                            type: 'post',
                                            data: parametros,
                                            cache: false,
                                            success: function(request, textStatus, jQxhr) {
                                                var data = JSON.parse(request);
                                                if (data.status == 200) {
                                                    $.notify(data.msj, {
                                                        className: 'success',
                                                        globalPosition: 'top center',
                                                        autoHideDelay: 3000
                                                    });
                                                    consultarCategorias(true);
                                                }
                                            },
                                            error: function(jqXhr, textStatus, errorThrown) {
                                                console.log(errorThrown);
                                            }
                                        });
                                    }
                                    return {
                                        registrarCategoria: registrarCategoria,
                                        consultarCategorias: consultarCategorias,
                                        actualizarCategoria: actualizarCategoria,
                                        cambiarEstadoCategoria: cambiarEstadoCategoria
                                    }
                                })()
                            $("#btnGuardarCategoria").off("click").on("click", function() {
                                    if ($("#categoria").val() == "") {
                                        $("#divmsj-categoria").show();
                                        setTimeout(() => {
                                            $("#divmsj-categoria").hide();
                                        }, 3000);
                                    } else {
                                        _categoria.registrarCategoria();
                                    }
                                }) <<
                                <<
                                <<
                                <
                                HEAD
                            $("#btnactualizarCategoria").off("click").on("click", function() { ===
                                        ===
                                        =
                                        $("#btnActualizarCategoria").off("click").on("click", function() { >>>
                                            >>>
                                            >
                                            4 aac000d7cf8ace995b66132336a9d98ba0aca12
                                            if ($("#categoria").val() == "") {
                                                $("#divmsj-categoria").show();
                                                setTimeout(() => {
                                                    $("#divmsj-categoria").hide();
                                                }, 3000);
                                            } else {
                                                _categoria.actualizarCategoria();
                                            }
                                        })
                                        $(document).ready(function() {
                                            _categoria.consultarCategorias(false);
                                        });
                                        $(document).off("click", ".btn-edt-cat").on("click", ".btn-edt-cat", function() {
                                            var info = Array();
                                            $(this).parents("tr").find("td").each(function(index) {
                                                info[index] = $(this).html();
                                            });
                                            $("#registrarCategoria").hide();
                                            $("#actualizarCategoria").show();
                                            $("#btnGuardarCategoria").hide();
                                            $("#btnActualizarCategoria").show();
                                            $("#categoria").val(info[1]);
                                            //Acá había una error
                                            $("#idcategoria").val(info[0]);
                                            $("#categoria").focus();
                                        })


                                        $(document).off("click", ".btn-desac-cat").on("click", ".btn-desac-cat", function() {
                                            var info = Array();
                                            $(this).parents("tr").find("td").each(function(index) {
                                                info[index] = $(this).html();
                                            });
                                            _categoria.cambiarEstadoCategoria(info[0]);
                                        })