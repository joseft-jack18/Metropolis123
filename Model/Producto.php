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

        function ModificarEstadoProducto($codigo, $estado){
            $sql = "call SP_MODIFICAR_ESTADO_PRODUCTO('$codigo','$estado')";
            
            if($consulta = $this->conexion->conexion->query($sql)){
                //$id_retornado = mysqli_insert_ind($this->conexion->conexion);
                return 1;
            } else {
                return 0;
            }
        }

        function RegistrarProducto($codigo,$descripcion,$marca,$tipo,$precio,$cantidad,$foto){
            //$sql = "call SP_REGISTRAR_PRODUCTO('$codigo','$descripcion','$marca','$tipo',$precio,$cantidad,'$foto')";
            $queryconsulta = "SELECT COUNT(*) FROM producto WHERE codigo = '$codigo'";
            $queryingreso = "INSERT INTO producto 
                              VALUES ('".$codigo."','".$descripcion."','".$marca."','".$tipo."',$precio,$cantidad,'D','".$foto."')";

            $consulta = $this->conexion->conexion->query($queryconsulta);
            $row = mysqli_fetch_array($consulta);
            if($row[0] == 0){
                $consulta2 = $this->conexion->conexion->query($queryingreso);
                return 1;
            } else {
                return 2;
            }
            $this->conexion->cerrar();
        }

        function ModificarProducto($codigo,$precio,$cantidad){
            $sql = "call SP_MODIFICAR_PRODUCTO('$codigo',$precio,$cantidad)";
            
            if($consulta = $this->conexion->conexion->query($sql)){
                return 1;
            } else {
                return 0;
            }
        }
    }

?>