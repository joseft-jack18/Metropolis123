<?php

    require '../../Model/Producto.php';

    $obj = new Producto();

    $consulta = $obj->ListarProductos();
    if($consulta) {
        echo json_encode($consulta);
    } else {
        echo '{
            "sEcho": 1,
            "iTotalRecords": "0",
            "iTotalDisplayRecords": "0",
            "aaData": []
        }';
    }

?>