<?php

    class Producto {
        private $conexion;

        function __construct(){
            require_once 'Conexion.php';
            $this->conexion = new Conexion();
            $this->conexion->conectar();
        }

        function ListarProductos(){
            $sql = "call SP_LISTAR_PRODUCTO()";
            $arreglo = array();
            if($consulta = $this->conexion->conexion->query($sql)){
                while($row = mysqli_fetch_array($consulta)){
                    $arreglo["data"][] = $row;
                }
                return $arreglo;
                $this->conexion->cerrar();
            }
        }
    }

?>