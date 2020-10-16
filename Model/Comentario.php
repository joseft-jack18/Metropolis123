<?php

    class Comentario {
        private $conexion;

        function __construct(){
            require_once 'Conexion.php';
            $this->conexion = new Conexion();
            $this->conexion->conectar();
        }

        function ListarComentario(){
            $sql = "call SP_LISTAR_COMENTARIO()";
            $arreglo = array();
            if($consulta = $this->conexion->conexion->query($sql)){
                while($row = mysqli_fetch_array($consulta)){
                    $arreglo["data"][] = $row;
                }
                return $arreglo;
                $this->conexion->cerrar();
            }
        }

        function ModificarEstadoComentario($codigo, $estado){
            $sql = "call SP_MODIFICAR_ESTADO_COMENTARIO($codigo,'$estado')";
            
            if($consulta = $this->conexion->conexion->query($sql)){
                //$id_retornado = mysqli_insert_ind($this->conexion->conexion);
                return 1;
            } else {
                return 0;
            }
        }
    }

?>