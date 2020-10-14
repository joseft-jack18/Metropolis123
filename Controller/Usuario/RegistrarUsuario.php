<?php

    require '../../Model/Usuario.php';

    $obj = new Usuario();

    $nombre = htmlspecialchars($_POST['nombres'], ENT_QUOTES, 'UTF-8');
    $direccion = htmlspecialchars($_POST['direccion'], ENT_QUOTES, 'UTF-8');
    $email = htmlspecialchars($_POST['email'], ENT_QUOTES, 'UTF-8');
    $clave = htmlspecialchars($_POST['contra'], ENT_QUOTES, 'UTF-8');

    $consulta = $obj->RegistrarUsuario($nombre,$direccion,$email,$clave);
    echo $consulta;

?>