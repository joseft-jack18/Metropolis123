<?php

    require '../../Model/Producto.php';

    $obj = new Producto();

    $codigo = htmlspecialchars($_POST['codigo'], ENT_QUOTES, 'UTF-8');
    $cantidad = htmlspecialchars($_POST['cantidad'], ENT_QUOTES, 'UTF-8');
    $precio = htmlspecialchars($_POST['precio'], ENT_QUOTES, 'UTF-8');

    $consulta = $obj->ModificarProducto($codigo,$precio,$cantidad);
    echo $consulta;

?>