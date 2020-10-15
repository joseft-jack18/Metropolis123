var table = "";

function ListarProductos(){
    table = $("#tabla_productos").DataTable({
        "ordering": false,
        "paging": false,
        "searching": { "regex": true },
        "lengthMenu": [ [10, 25, 50, 100, -1], [10, 25, 50, 100, "All"] ],
        "pageLength": 100,
        "destroy": true,
        "async": false,
        "processing": true,
        "ajax": {
            "url": "../Controller/Producto/ListarProductos.php",
            type: 'POST'
        },
        "columns": [
            {"data": "codigo"},
            {"data": "descripcion"},
            {"data": "marca"},
            {"data": "tipo",
                render: function(data, type, row) {
                    if(data == "L") {
                        return "Luces y Flourescentes";
                    } else if(data == "C") {
                        return "Cables de Luz";
                    } else if(data == "A") {
                        return "Accesorios";
                    }
                }
            },
            {"data": "precioUnitario"},
            {"data": "cantidad"},
            {"data": "estado",
                render: function(data, type, row) {
                    if(data == "D") {
                        return "<span class='label label-success'>Disponible</span>";
                    } else {
                        return "<span class='label label-danger'>Agotado</span>";
                    }
                }
            },
            {"data": "imagen"},
            {"defaultContent": "<button style='font-size:13px;' type='button' class='editar btn btn-warning'>"
                                    +"<i class='fa fa-edit'></i></button>&nbsp"
                                +"<button style='font-size:13px;' type='button' class='activar btn btn-primary'"
                                    +" id='btnactivar'><i class='fa fa-check'></i></button>&nbsp"
                                +"<button style='font-size:13px;' type='button' class='desactivar btn btn-danger'"
                                    +" id='btndesactivar'><i class='fa fa-trash'></i></button>"
            }
        ],

        "language": idioma_espanol,
        select: true
    });

    document.getElementById("tabla_productos_filter").style.display = "none";

    $('input.global_filter').on('keyup click', function() {
        filterGlobal();
    });

    $('input.global_filter').on('keyup click', function() {
        filterColumn( $(this).parents('tr').attr('data-column') );
    });
}

function filterGlobal(){
    $('#tabla_productos').DataTable().search(
        $('#global_filter').val(),
    ).draw();
}

function AbrirModalRegistro(){
    $('#modal_registro').modal({backdrop:'static', keyboard:false})
    $('#modal_registro').modal('show');
}

//falta editar desde aqui------------------------------------------------------------------
function RegistrarUsuario(){
    var nom = $('#txtnombres').val();
    var dir = $('#txtdireccion').val();
    var email = $('#txtemail').val();
    var pass = $('#txtpass').val();
    var rpass = $('#txtrpass').val();

    if(nom.length == 0 || dir.length == 0 || email.length == 0 || pass.length == 0 || rpass.length == 0){
        return Swal.fire("Mensaje de Advertencia", "Debe de llenar los campos vacios", "warning")
    } 

    if(pass != rpass){
        return Swal.fire("Mensaje de Advertencia", "Las contraseñas deben coincidir...", "warning")
    }

    $.ajax({
        url: '../Controller/Usuario/RegistrarUsuario.php',
        type: 'POST',
        data: {
            nombres: nom,
            direccion: dir,
            email: email,
            contra: pass
        }
    }).done(function(resp) {
        if(resp > 0){
            if(resp == 1){
                $('#modal_registro').modal('hide');
                Swal.fire("Mensaje de Confirmacion", "Datos almacenados correctamente!", "success")
                .then( ( value ) => {
                    LimpiarRegistro();
                    table.ajax.reload();
                });
            } else {
                return Swal.fire("Mensaje de Advertencia", "Lo sentimos, el usuario ya se encuentra registrado.", "warning");
            }
        } else {
            Swal.fire("Mensaje de Error", "Lo sentimos, no se pudo guardar los datos.", "error");
        }
    });
}

function LimpiarRegistro(){
    $('#txtnombres').val("");
    $('#txtdireccion').val("");
    $('#txtemail').val("");
    $('#txtpass').val("");
    $('#txtrpass').val("");
}

$('#tabla_usuarios').on('click', '.desactivar', function() {
    var data = table.row($(this).parents('tr')).data();
    if(table.row(this).child.isShown()){
        var data = table.row(this).data();
    }
    //alert(data.idUsu);
    Swal.fire({
        title: 'Esta seguro en deshabilitar al usuario?',
        text: "Una vez hecho esto, el usuario no tendra acceso al sistema!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Si!'
      }).then((result) => {
        if (result.isConfirmed) {
          /*Swal.fire(
            'Deleted!',
            'Your file has been deleted.',
            'success'
          )*/
          ModificarEstadoUsuario(data.idUsu, 'I');
        }
      })
});

$('#tabla_usuarios').on('click', '.activar', function() {
    var data = table.row($(this).parents('tr')).data();
    if(table.row(this).child.isShown()){
        var data = table.row(this).data();
    }
    //alert(data.idUsu);
    Swal.fire({
        title: 'Esta seguro en habilitar al usuario?',
        text: "Una vez hecho esto, el usuario tendra acceso al sistema!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Si!'
      }).then((result) => {
        if (result.isConfirmed) {
          /*Swal.fire(
            'Deleted!',
            'Your file has been deleted.',
            'success'
          )*/
          ModificarEstadoUsuario(data.idUsu, 'A');
        }
      })
});

function ModificarEstadoUsuario(id,estado){
    var mensaje = "";

    if(estado == 'A'){
        mensaje = "habilitó";
    } else {
        mensaje = "deshabilitó";
    }

    $.ajax({
        url: '../Controller/Usuario/ModificarEstadoUsuario.php',
        type: 'POST',
        data: {
            id: id,
            estado: estado
        }
    }).done(function(resp) {
        if(resp > 0){
            Swal.fire("Mensaje de Confirmacion", "El usuario se " + mensaje + " con exito!", "success")
                .then( ( value ) => {
                    table.ajax.reload();
                });
        } 
    });
}

$('#tabla_usuarios').on('click', '.editar', function() {
    var data = table.row($(this).parents('tr')).data();
    if(table.row(this).child.isShown()){
        var data = table.row(this).data();
    }

    $('#modal_editar').modal({backdrop:'static', keyboard:false})
    $('#modal_editar').modal('show');    

    $('#txteid').val(data.idUsu);
    $('#txtenombres').val(data.nomUsu);
    $('#txtedireccion').val(data.dirUsu);
    $('#txteemail').val(data.emailUsu);
});

function ModificarUsuario(){
    var id = $('#txteid').val();
    var dir = $('#txtedireccion').val();
    var email = $('#txteemail').val();

    if(dir.length == 0 || email.length == 0){
        return Swal.fire("Mensaje de Advertencia", "Debe de llenar los campos vacios", "warning")
    }

    $.ajax({
        url: '../Controller/Usuario/ModificarUsuario.php',
        type: 'POST',
        data: {
            id: id,
            direccion: dir,
            email: email
        }
    }).done(function(resp) {
        if(resp > 0){
            $('#modal_editar').modal('hide');
            Swal.fire("Mensaje de Confirmacion", "Datos modificados correctamente!", "success")
            .then( ( value ) => {
                table.ajax.reload();
            });
        } else {
            Swal.fire("Mensaje de Error", "Lo sentimos, no se pudo modificar los datos.", "error");
        }
    });
}