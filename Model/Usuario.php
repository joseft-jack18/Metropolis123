<?php

    class Usuario {
        private $conexion;

        function __construct(){
            require_once 'Conexion.php';
            $this->conexion = new Conexion();
            $this->conexion->conectar();
        }

        function VerificarUsuario($usuario, $contra){
            $sql = "call SP_VERIFICAR_USUARIO('$usuario')";
            $arreglo = array();
            if($consulta = $this->conexion->conexion->query($sql)){
                while($row = mysqli_fetch_array($consulta)){
                    if($contra == $row['pwdUsu']){
                        $arreglo[] = $row;
                    }
                }
                return $arreglo;
                $this->conexion->cerrar();
            }
        }

        function ListarUsuarios(){
            $sql = "call SP_LISTAR_USUARIO()";
            $arreglo = array();
            if($consulta = $this->conexion->conexion->query($sql)){
                while($row = mysqli_fetch_array($consulta)){
                    $arreglo["data"][] = $row;
                }
                return $arreglo;
                $this->conexion->cerrar();
            }
        }

        function RegistrarUsuario($nom, $dir, $email, $clave){
            $sql = "call SP_REGISTRAR_USUARIO('$nom','$dir','$email','$clave')";
            
            if($consulta = $this->conexion->conexion->query($sql)){
                if($row = mysqli_fetch_array($consulta)){
                    return $id = trim($row[0]);
                }
                $this->conexion->cerrar();
            }
        }

        function ModificarEstadoUsuario($id, $estado){
            $sql = "call SP_MODIFICAR_ESTADO_USUARIO('$id','$estado')";
            
            if($consulta = $this->conexion->conexion->query($sql)){
                //$id_retornado = mysqli_insert_ind($this->conexion->conexion);
                return 1;
            } else {
                return 0;
            }
        }

        function ModificarUsuario($id, $direccion, $email){
            $sql = "call SP_MODIFICAR_USUARIO('$id','$direccion','$email')";
            
            if($consulta = $this->conexion->conexion->query($sql)){
                return 1;
            } else {
                return 0;
            }
        }
    }

?>