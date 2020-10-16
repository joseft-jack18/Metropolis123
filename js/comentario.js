var table = "";

function ListarComentarios(){
    table = $("#tabla_comentarios").DataTable({
        "ordering": false,
        "paging": false,
        "searching": { "regex": true },
        "lengthMenu": [ [10, 25, 50, 100, -1], [10, 25, 50, 100, "All"] ],
        "pageLength": 100,
        "destroy": true,
        "async": false,
        "processing": true,
        "ajax": {
            "url": "../Controller/Comentario/ListarComentario.php",
            type: 'POST'
        },
        "columns": [
            {"data": "idComentario"},
            {"data": "nombre"},
            {"data": "contacto"},
            {"data": "descripcion"},
            {"data": "estado",
                render: function(data, type, row) {
                    if(data == "R") {
                        return "<span class='label label-success'>Respondido</span>";
                    } else {
                        return "<span class='label label-warning'>Pendiente</span>";
                    }
                }
            },
            {"defaultContent": "<button style='font-size:13px;' type='button' class='activar btn btn-primary'"
                                    +" id='btnactivar'><i class='fa fa-check'></i></button>&nbsp"
            }
        ],

        "language": idioma_espanol,
        select: true
    });

    document.getElementById("tabla_comentarios_filter").style.display = "none";

    $('input.global_filter').on('keyup click', function() {
        filterGlobal();
    });

    $('input.global_filter').on('keyup click', function() {
        filterColumn( $(this).parents('tr').attr('data-column') );
    });
}

function filterGlobal(){
    $('#tabla_comentarios').DataTable().search(
        $('#global_filter').val(),
    ).draw();
}

$('#tabla_comentarios').on('click', '.activar', function() {
    var data = table.row($(this).parents('tr')).data();
    if(table.row(this).child.isShown()){
        var data = table.row(this).data();
    }
    //alert(data.idUsu);
    Swal.fire({
        title: 'Esta seguro de haber respondido el comentario?',
        text: "Una vez hecho esto, el comentario pasara a RESPONDIDO!",
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
          ModificarEstadoComentario(data.idComentario, 'R');
        }
      })
});

function ModificarEstadoComentario(id,estado){
    $.ajax({
        url: '../Controller/Comentario/ModificarEstadoComentario.php',
        type: 'POST',
        data: {
            id: id,
            estado: estado
        }
    }).done(function(resp) {
        if(resp > 0){
            Swal.fire("Mensaje de Confirmacion", "El comentario fue respondido con exito!", "success")
                .then( ( value ) => {
                    table.ajax.reload();
                });
        } 
    });
}