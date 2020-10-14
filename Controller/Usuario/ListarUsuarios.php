<?php

    require '../../Model/Usuario.php';

    $obj = new Usuario();

    $consulta = $obj->ListarUsuarios();
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