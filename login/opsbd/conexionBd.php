<?php
    function conexionBd(){
        try{
            $conexion=null;
            $bbdd="mysql:host=localhost;dbname=nonecollab;charset=utf8";
            $usuario="root";
            $contraseña="";
            $conexion = new PDO($bbdd,$usuario,$contraseña);
            return $conexion;
        }
        catch (PDOException $e) {
            echo 'Falló la conexión: ' . $e->getMessage();
        }

    }
?>