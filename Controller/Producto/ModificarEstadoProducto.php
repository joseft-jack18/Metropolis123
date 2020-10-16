<?php

    require '../../Model/Producto.php';

    $obj = new Producto();

    $codigo = htmlspecialchars($_POST['codigo'], ENT_QUOTES, 'UTF-8');
    $estado = htmlspecialchars($_POST['estado'], ENT_QUOTES, 'UTF-8');

    $consulta = $obj->ModificarEstadoProducto($codigo,$estado);
    echo $consulta;

?>