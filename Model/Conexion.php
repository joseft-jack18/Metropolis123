<?php

    class Conexion {
        private $servidor;
        private $usuario;
        private $pass;
        private $bd;
        public $conexion;

        public function __construct(){
            $this->servidor = "localhost";
            $this->usuario = "root";
            $this->pass = "";
            $this->bd = "ventas";
        }

        function conectar(){
            $this->conexion = new mysqli($this->servidor,
                                         $this->usuario,
                                         $this->pass,
                                         $this->bd);
            $this->conexion->set_charset("utf8");
        }

        function cerrar(){
            $this->conexion->close();
        }
    }

?>