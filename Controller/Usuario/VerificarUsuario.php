<?php

    require '../../Model/Usuario.php';

    $obj = new Usuario();

    $usuario = htmlspecialchars($_POST['user'], ENT_QUOTES, 'UTF-8');
    $contra = htmlspecialchars($_POST['pwd'], ENT_QUOTES, 'UTF-8');

    $consulta = $obj->VerificarUsuario($usuario,$contra);
    $data = json_encode($consulta);

    if(count($consulta) > 0) {
        echo $data;
    } else {
        echo 0;
    }

?>