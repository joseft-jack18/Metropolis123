function ListarProductos(){
    var table = $("#tabla_productos").DataTable({
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
            {"defaultContent": "<button style='font-size:13px;' type='button' class='editar btn btn-primary'><i class='fa fa-edit'></i></button>"}
        ],

        "language": idioma_espanol,
        select: true
    });
}