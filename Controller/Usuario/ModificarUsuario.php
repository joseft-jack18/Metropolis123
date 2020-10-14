<?php

    require '../../Model/Usuario.php';

    $obj = new Usuario();

    $id = htmlspecialchars($_POST['id'], ENT_QUOTES, 'UTF-8');
    $direccion = htmlspecialchars($_POST['direccion'], ENT_QUOTES, 'UTF-8');
    $email = htmlspecialchars($_POST['email'], ENT_QUOTES, 'UTF-8');

    $consulta = $obj->ModificarUsuario($id,$direccion,$email);
    echo $consulta;

?>