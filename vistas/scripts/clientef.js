//Declaración de variables necesarias para trabajar con el caso mayorista y sus detalles
var tabla;
//Funcion que se ejecuta al inicio
function init() {
    mostrarform(false);
    listar();
    $("#formulario").on("submit", function(e) {
        guardaryeditar(e);
    });
    //Cargamos  los items del selectLugar
    $.post("../ajax/clientef.php?op=selectLugar", function(r) {
        $("#idlugarrecepcion").html(r);
        $("#idlugarrecepcion").selectpicker('refresh');
    });
    //Cargamos  los items del selectLugar
    $.post("../ajax/clientef.php?op=selectEstado", function(r) {
        $("#idestado").html(r);
        $("#idestado").selectpicker('refresh');
    });
    //Ocultamos la imagen del formulario
    $("#imagenmuestra").hide();
    //Select guia
    guia();
}
//Funcion para limpiar los datos del formulario de registro y actualizacion
function limpiar() {
    $("#nombre").val("");
    $("#cedula").val("");
    $("#telefono").val("");
    $("#direccion").val("");
    $("#email").val("");
    $("#fecha_recepcion").val("");
    $("#fecha_entrega").val("");
    $("#idlugarrecepcion").val("");
    $("#idestado").val("");
    $("#garantia").val("");
    $("#observaciones").val("");
    $("#imagenmuestra").attr("src", "");
    $("#imagenactual").val("");
    $("#idusuario").val("");
    //Obtenemos la fecha actual
    var now = new Date();
    var day = ("0" + now.getDate()).slice(-2);
    var month = ("0" + (now.getMonth() + 1)).slice(-2);
    var today = now.getFullYear() + "-" + (month) + "-" + (day);
    $('#fecha_recepcion').val(today);
    //Eliminamos la filas de los detalles que no se necesitan
    $(".filas").remove();
}
//Funcion mostrar  formulario
function mostrarform(flag) {
    limpiar();
    if (flag) {
        $("#listadoregistros").hide();
        $("#formularioregistros").show();
        $("#btnGuardar").prop("disabled", false);
        $("#btnagregar").hide();
        $("#imagenmuestra").hide();
        listarProductos();
        guia();
        //Boton que llama a un modal para agregar los productos
        $("#agregarProducto").show();
    } else {
        $("#listadoregistros").show();
        $("#formularioregistros").hide();
        $("#btnagregar").show();
        guia();
    }
}
//Funcion para cancelar el registro y/o edición 
function cancelarform() {
    limpiar();
    mostrarform(false);
}
//Funcion para listar todos los datos tanto en la tabla como en el formulario de edición
function listar() {
    tabla = $('#tbllistado').dataTable({
        "aProcessing": true, //Activamos el procesamiento del datatables
        "aServerSide": true, //Paginacion y filtrado realizados por el servidor
        dom: 'Bfrtip', //Definimos los elementos del control de tabla
        buttons: [
            'copyHtml5',
            'excelHtml5',
            'csvHtml5',
            'pdf',
        ],
        "ajax": {
            url: '../ajax/clientef.php?op=listar',
            type: "get",
            dataType: "json",
            error: function(e) {
                console.log(e.responseText);
            }
        },
        "bDestroy": true,
        "iDisplayLength": 100, //Paginacion
        "order": [
                [0, "desc"]
            ] //Ordenar  (columna, orden)
    }).DataTable();
}
//Función Listar los productos que hay en la base de datos
function listarProductos() {
    tabla = $('#tblproductos').dataTable({
        "aProcessing": true, //Activamos el procesamiento del datatables
        "aServerSide": true, //Paginación y filtrado realizados por el servidor
        dom: 'Bfrtip', //Definimos los elementos del control de tabla
        buttons: [],
        "ajax": {
            url: '../ajax/clientef.php?op=listarProductos',
            type: "get",
            dataType: "json",
            error: function(e) {
                console.log(e.responseText);
            }
        },
        "bDestroy": true,
        "iDisplayLength": 5, //Paginación
        "order": [
                [0, "desc"]
            ] //Ordenar (columna,orden)
    }).DataTable();
}
//Funcion para guardar o editar
function guardaryeditar(e) {
    e.preventDefault(); //No se activará la acción predetarminada del evento
    $("#btnGuardar").prop("disabled", true);
    var formData = new FormData($("#formulario")[0]);

    $.ajax({
        url: "../ajax/clientef.php?op=guardaryeditar",
        type: "POST",
        data: formData,
        contentType: false,
        processData: false,

        success: function(datos) {
            bootbox.alert(datos);
            mostrarform(false);
            listar();
        }
    });
    limpiar();
}
//Funcion para ver individualmente un registro
function mostrar(idclientefinal) {
    $.post("../ajax/clientef.php?op=mostrar", { idclientefinal: idclientefinal }, function(data, status) {
            data = JSON.parse(data);
            mostrarform(true);
            $("#nombre").val(data.nombre);
            $("#tipo_documento").val(data.tipo_documento);
            $("#num_documento").val(data.num_documento);
            $("#telefono").val(data.telefono);
            $("#direccion").val(data.direccion);
            $("#email").val(data.email);
            $("#fecha_recepcion").val(data.fechar);
            $("#fecha_entrega").val(data.fecha_entrega);
            $("#idlugarrecepcion").val(data.idlugarrecepcion);
            $("#guia").val(data.guia);
            $("#idestado").val(data.idestado);
            $("#imagenmuestra").show();
            $("#imagenmuestra").attr("src", "../files/clientefinal/" + data.imagen);
            $("#imagenactual").val(data.imagen);
            $("#idusuario").val(data.idusuario);
            $("#idclientefinal").val(data.idclientefinal);
            $("#agregarProducto").hide();
            $("#btnGuardar").show();
        })
        //Listamos los detalles 
    $.post("../ajax/clientef.php?op=listarDetalle&id=" + idclientefinal, function(r) {
        $("#detalles").html(r);
    });
}

//Funcion para eliminar registros
function eliminar(idclientefinal) {
    bootbox.confirm("¿Esta seguro de eliminar el caso servicio tecnico?", function(result) {
        if (result) {
            $.post("../ajax/clientef.php?op=eliminar", { idclientefinal: idclientefinal }, function(e) {
                bootbox.alert(e);
                listar();
            });
        }
    })
}

//Declaración de variables necesarias para trabajar con los casos y sus detalles
var cont = 0;
var detalles = 0;

//Funcion para agregar productos al listado de detalles de la garantia
function agregarDetalle(idproducto, producto) {
    var cantidad = 1;
    var garantia = '';
    var observaciones = '';

    if (idproducto != "") {
        var fila = '<tr class="filas" id="fila' + cont + '">' +
            '<td><button type="button" class="btn btn-danger" onclick="eliminarDetalle(' + cont + ')">X</button></td>' +
            '<td><input type="hidden" class="form-control" name="idproducto[]" value="' + idproducto + '">' + producto + '</td>' +
            '<td><input type="number" class="form-control" name="cantidad[]" id="cantidad[]" value="' + cantidad + '"></td>' +
            '<td><input type="text" class="form-control" name="garantia[]" id="garantia[]" value="' + garantia + '"></td>' +
            '<td><input type="text" class="form-control" name="observaciones[]" id="observaciones[]" value="' + observaciones + '"></td>' +
            '</tr>';
        cont++;
        detalles = detalles + 1;
        $('#detalles').append(fila);

    } else {
        alert("Error al ingresar el detalle, revisar los datos del producto");
    }
}
//Funcion guia
function guia() {
    $("#idestado").change(function() {
        if ($("#idestado option:selected").text() == "guia") {
            $("#guiadiv").show();
        } else {
            $("#guiadiv").hide();
        }
    });
}

//Funcion para eliminar los detalles del caso
function eliminarDetalle(indice) {
    $("#fila" + indice).remove();
    detalles = detalles - 1;
}

//Funcion para imprimir 
$("#imprimir").click(function() {
    print($('#formContent'));
});

init();