<?php

    require '../../Model/Producto.php';

    $obj = new Producto();

    $boton= $_POST['boton'];
    if($boton === 'guardar') {

        $codigo = $_POST['txtcodigo'];
        $descripcion = $_POST['txtdescripcion'];
        $tipo = $_POST['txttipo'];
        $marca = $_POST['txtmarca'];
        $cantidad = $_POST['txtcantidad'];
        $precio = $_POST['txtprecio'];

        $nombreimg = $codigo.$_FILES['txtimg']['name'];//obtiene el nombre de la imagen
        //$foto = $_FILES['txtimg']['tmp_name']; //contiene el archivo
        $ruta = "../../ImgProductos/".$nombreimg; //ruta donde se guardara la imagen

        move_uploaded_file($_FILES['txtimg']['tmp_name'], $ruta);

        $consulta = $obj->RegistrarProducto($codigo,$descripcion,$marca,$tipo,$precio,$cantidad,$nombreimg);
        echo $consulta;
    }

?>