<?php

    $ID = $_POST['id'];
    $NOMBRE = $_POST['nombre'];
    $TIPO = $_POST['tipo'];

    session_start();

    $_SESSION['S_ID'] = $ID;
    $_SESSION['S_NOMBRE'] = $NOMBRE;
    $_SESSION['S_TIPO'] = $TIPO;

?>