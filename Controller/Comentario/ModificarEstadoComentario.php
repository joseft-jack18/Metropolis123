<?php

    require '../../Model/Comentario.php';

    $obj = new Comentario();

    $id = htmlspecialchars($_POST['id'], ENT_QUOTES, 'UTF-8');
    $estado = htmlspecialchars($_POST['estado'], ENT_QUOTES, 'UTF-8');

    $consulta = $obj->ModificarEstadoComentario($id,$estado);
    echo $consulta;

?>