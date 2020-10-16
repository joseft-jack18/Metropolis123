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

function RegistrarProducto(){
    var formData = new FormData($("#agregar_producto")[0]);

    var cod = $('#txtcodigo').val();
    var des = $('#txtdescripcion').val();
    var mar = $('#txtmarca').val();
    var tip = $('#txttipo').val();
    var pre = $('#txtprecio').val();
    var can = $('#txtcantidad').val();
    var fot = $('#txtimg').val();

    if(cod.length == 0 || des.length == 0 || mar.length == 0 || tip.length == 0 || pre.length == 0 || can.length == 0 || fot.length == 0){
        return Swal.fire("Mensaje de Advertencia", "Debe de llenar los campos vacios", "warning")
    }

    $.ajax({
        url: '../Controller/Producto/RegistrarProducto.php',
        type: 'POST',
        data: formData,
		cache: false,
		processData: false,
		contentType: false
    }).done(function(resp) {
        //alert(resp);
        if(resp > 0){
            if(resp == 1){
                $('#modal_registro').modal('hide');
                Swal.fire("Mensaje de Confirmacion", "Producto guardado correctamente!", "success")
                .then( ( value ) => {
                    LimpiarRegistro();
                    table.ajax.reload();
                });
            } else {
                return Swal.fire("Mensaje de Advertencia", "Lo sentimos, el producto ya se encuentra registrado.", "warning");
            }
        } else {
            Swal.fire("Mensaje de Error", "Lo sentimos, no se pudo guardar los datos.", "error");
        }
    });
}

function LimpiarRegistro(){
    $('#txtcodigo').val("");
    $('#txtdescripcion').val("");
    $('#txtmarca').val("");
    $('#txttipo').val("");
    $('#txtprecio').val("");
    $('#txtcantidad').val("");
    $('#txtimg').val("");
    $('#imgproducto').attr("src","../Admin/dist/img/box.png");
}

$('#tabla_productos').on('click', '.desactivar', function() {
    var data = table.row($(this).parents('tr')).data();
    if(table.row(this).child.isShown()){
        var data = table.row(this).data();
    }
    //alert(data.idUsu);
    Swal.fire({
        title: 'Esta seguro en deshabilitar al producto?',
        text: "Una vez hecho esto, el producto ya no estara disponible para el cliente!",
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
          ModificarEstadoProducto(data.codigo, 'A');
        }
      })
});

$('#tabla_productos').on('click', '.activar', function() {
    var data = table.row($(this).parents('tr')).data();
    if(table.row(this).child.isShown()){
        var data = table.row(this).data();
    }
    //alert(data.idUsu);
    Swal.fire({
        title: 'Esta seguro en habilitar al producto?',
        text: "Una vez hecho esto, el producto estará disponible para el cliente!",
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
          ModificarEstadoProducto(data.codigo, 'D');
        }
      })
});

function ModificarEstadoProducto(id,estado){
    var mensaje = "";

    if(estado == 'A'){
        mensaje = "inhabilitó";
    } else {
        mensaje = "habilitó";
    }

    $.ajax({
        url: '../Controller/Producto/ModificarEstadoProducto.php',
        type: 'POST',
        data: {
            codigo: id,
            estado: estado
        }
    }).done(function(resp) {
        if(resp > 0){
            Swal.fire("Mensaje de Confirmacion", "El producto se " + mensaje + " con exito!", "success")
                .then( ( value ) => {
                    table.ajax.reload();
                });
        } 
    });
}

$('#tabla_productos').on('click', '.editar', function() {
    var tip = "";
    var data = table.row($(this).parents('tr')).data();
    if(table.row(this).child.isShown()){
        var data = table.row(this).data();
    }

    $('#modal_editar').modal({backdrop:'static', keyboard:false})
    $('#modal_editar').modal('show');    

    if(data.tipo == 'A'){
        tip = "Accesorios";
    }
    if(data.tipo == 'C'){
        tip = "Cables de Luz";
    }
    if(data.tipo == 'L'){
        tip = "Luces y Flourescentes";
    }

    $('#txtecodigo').val(data.codigo);
    $('#txtedescripcion').val(data.descripcion);
    $('#txtemarca').val(data.marca);
    $('#txtetipo').val(tip);
    $('#txtecantidad').val(data.cantidad);
    $('#txteprecio').val(data.precioUnitario);
    $('#imgeproducto').attr("src","../ImgProductos/"+data.imagen);
});

function ModificarProducto(){
    var cod = $('#txtecodigo').val();
    var can = $('#txtecantidad').val();
    var pre = $('#txteprecio').val();

    if(can.length == 0 || pre.length == 0){
        return Swal.fire("Mensaje de Advertencia", "Debe de llenar los campos vacios", "warning")
    }

    $.ajax({
        url: '../Controller/Producto/ModificarProducto.php',
        type: 'POST',
        data: {
            codigo: cod,
            cantidad: can,
            precio: pre
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

//------------------------- visualizar la imagen en el img al agregar -----------------------
$('#txtimg').change(function(e) {
    addImage(e); 
});

function addImage(e){
    var file = e.target.files[0],
    imageType = /image.*/;

    if (!file.type.match(imageType))
    return;

    var reader = new FileReader();
    reader.onload = fileOnload;
    reader.readAsDataURL(file);
}

function fileOnload(e) {
    var result=e.target.result;
    $('#imgproducto').attr("src",result);
}
//------------------------- visualizar la imagen en el img al agregar -----------------------