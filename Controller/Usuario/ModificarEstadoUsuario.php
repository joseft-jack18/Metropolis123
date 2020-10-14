<?php

    require '../../Model/Usuario.php';

    $obj = new Usuario();

    $idUsu = htmlspecialchars($_POST['id'], ENT_QUOTES, 'UTF-8');
    $estado = htmlspecialchars($_POST['estado'], ENT_QUOTES, 'UTF-8');

    $consulta = $obj->ModificarEstadoUsuario($idUsu,$estado);
    echo $consulta;

?>