<?php

include_once 'conexionBd.php';

if(isset($_POST['emailoReg']) &&  !empty($_POST['emailoReg'])
    && isset($_POST['passwordReg']) &&  !empty($_POST['passwordReg'])
    && isset($_POST['alias']) &&  !empty($_POST['alias'])
    && isset($_POST['nombre']) &&  !empty($_POST['nombre'])
    && isset($_POST['ape1']) &&  !empty($_POST['ape1'])
    && isset($_POST['ape2']) &&  !empty($_POST['ape2'])
    && isset($_POST['direccion']) &&  !empty($_POST['direccion'])
    && isset($_POST['ciudad']) &&  !empty($_POST['ciudad'])
    && isset($_POST['provincia']) &&  !empty($_POST['provincia'])
    && isset($_POST['zipo']) &&  !empty($_POST['zipo'])
    && isset($_POST['tel1']) &&  !empty($_POST['tel1'])
    && isset($_POST['tel2']) &&  !empty($_POST['tel2'])
)
{
    $email=$_POST['emailoReg'];
    $email=$email."@ikasle.egibide.org";
    $password=$_POST['passwordReg'];
    $alias=$_POST['alias'];
    $nombre=$_POST['nombre'];
    $apellido1=$_POST['ape1'];
    $apellido2=$_POST['ape2'];
    $calle=$_POST['direccion'];
    $localidad=$_POST['ciudad'];
    $provincia=$_POST['provincia'];
    $codigoPostal=$_POST['zipo'];
    $telefono1=$_POST['tel1'];
    $telefono2=$_POST['tel2'];

    nuevoUsuario($email,$password,$alias,$nombre,$apellido1,$apellido2,
        $calle,$localidad,$provincia,$codigoPostal,$telefono1,$telefono2);

}

if(isset($_POST['emailoReg']) &&  !empty($_POST['emailoReg'])) {
    $correo = $_POST['emailoReg'];
    $correo = $correo . "@ikasle.egibide.org";
    comprobarEmail($correo);
}

//FUNCIÓN PARA COMPROBAR LOGIN CORRECTO Y ACCEDER
function comprobarUsuario($user,$pass){
    $conexion=conexionBd();

    try{
        $conexion=conexionBd();
        $consulta=$conexion->prepare("SELECT idusuario,email,password,alias,nombre,nombre,apellido1,apellido2,calle,localidad,provincia,codigopostal,telefono1,telefono2,fecharegistro FROM usuario WHERE email=:correo and password= :pass");
        $consulta->execute(array(":correo"=>"$user",":pass"=>$pass));

        if($usuario=$consulta->fetchObject()){
            $_SESSION['usuario']=$usuario;
            return true;
        }else{
            return false;
        }
        $conexion=null;
    }
    catch (PDOException $e) {
        echo 'Falló la conexión: ' . $e->getMessage();
    }
}

//FUNCIÓN PARA COMPROBAR EMAIL (QUE EL USUARIO NO ESTA YA REGISTRADO)
function comprobarEmail($correo) {
    $conexion = conexionBd();
    $encontrado=false;

    //<<<<<<<<<<<<<<<<<<<<<<<<<<<<>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
    //DATOS A PASAR: este dato hay que pasarlo como argumento o sesion

    //<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>

    $consulta = $conexion->prepare('
            SELECT email
            FROM usuario
            WHERE email = :email');    
    $consulta->execute(array(
        'email' => $correo
    ));
    
    if($buscaEmail = $consulta->fetchColumn() != false) {
        //echo 'Ya existe un usuario registrado con este Email.';
        die($encontrado);
    }
    else {        
        /*echo 'NO SE HA ENCONTRADO ESTE EMAIL EN LA BD<br>
      rteetr  (AQUI HABRIA QUE MANDAR A LA VISTA DEL LOGIN DE NUEVO (DND ESTABA)).';
        */
        $encontrado=true;
        die($encontrado);
    }        
    $conexion = null;
}

//FUNCIÓN PARA REGISTRAR NUEVO USUARIO
function nuevoUsuario($email,$password,$alias,$nombre,$apellido1,$apellido2,$calle,$localidad
    ,$provincia,$codigoPostal,$telefono1,$telefono2) {
    $conexion = conexionBd();

    //<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
    //DATOS A PASAR: estos dtos se pasaran como argumento o en sesion


    $fecharegistro = date("Y-m-d");
    //<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>

    try {
        $insercion = $conexion->prepare('
        INSERT INTO usuario
        (email, password, alias, nombre, apellido1, apellido2, calle, localidad, provincia, codigopostal, telefono1, telefono2, fecharegistro)
        VALUES
        (:email, :password, :alias, :nombre, :apellido1, :apellido2, :calle, :localidad, :provincia, :codigopostal, :telefono1, :telefono2, :fecharegistro)'
        );
        $insercion->execute(array(
            'email' => $email,
            'password' => $password,
            'alias' => $alias,
            'nombre' => $nombre,
            'apellido1' => $apellido1,
            'apellido2' => $apellido2,
            'calle' => $calle,
            'localidad' => $localidad,
            'provincia' => $provincia,
            'codigopostal' => $codigoPostal,
            'telefono1' => $telefono1,
            'telefono2' => $telefono2,
            'fecharegistro' => $fecharegistro
        ));
        ?>
        <script>window.location.replace("../views/login.php");</script><?php
        return true;

    }
    catch (Exception $ex) {
        echo 'El nuevo usuario no ha podido ser registrado.<br>
        Inténtelo de nuevo más tarde.';
        ?>
        <script>window.location.replace("../index.php");</script>
        <?php
        return false;

    }
    $conexion = null;
}

//FUNCIÓN PARA ELIMINAR UN USUARIO (DARSE DE BAJA)
function eliminarUsuario() {
    $conexion = conexionBd();
    
    
    //<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
    //DATOS A PASAR: este dato se pasara como sea (como parametro o en sesion)
    $idusuario = 3;
    //<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
    
    
    
    try {
        $borrado = $conexion->prepare("DELETE FROM usuario WHERE idusuario = :idusuario");
        $borrado->execute(array(
            "idusuario" => $idusuario
        ));        
        echo 'El usuario ha sido dado de baja.';
        return true;    
        $conexion = null;
    }
    catch (Exception $e) {
        echo 'El usuario no ha podido ser dado de baja.<br>'
        . 'Inténtelo de nuevo más tarde.' . $e->getMessage();
        return false;
    }    
}

//FUNCIÓN PARA MODIFICAR LOS DATOS DEL USUARIO
function modificarPerfilUsuario() {
    $conexion = conexionBd();
    
    
    //<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
    //DATOS A PASAR: estos datos se pasaran como argumento o en sesion
    //EN SESION Y LOS QUE NO SE HAYAN MODIFICADO NO SE CAMBIARAN EN BD
    //(SI NO SE CAMBIA NINGUN CAMPO, DEVUELVE QUE NOS SE HA PODIDO HACER EL UPDATE
    //LOS DATOS PARA EL UPDATE QUE NO CAMBIEN SE DEBEN RECOGER DEL ANUNCIO SELECCIONADO PARA ACTUALIZAR
    //(HAY DATOS QUE NO SE PODRAN CAMBIA COMO idusuario, fecaharegistro o email¿?).
    $idusuario = 2;  //$_SESSION["usuario"]->idUsuario;
    $email = "ifonselgrande@ifons.org";
    $password = "ifons";
    $alias = "Ifons";
    $nombre = "Alfons";
    $apellido1 = "Nose";
    $apellido2 = "Nomeacuerdo";
    $calle = "La Calle de Alfonso";
    $localidad = "Miranda de Ebro";
    $provincia = "Burgos";
    $codigoPostal = "09700";
    $telefono1 = "666666667";
    $telefono2 = null;
    $fecharegistro = date("Y-m-d");
    //<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
    
    
    
    
    try {
        $modificacionPerfil = '
                UPDATE usuario
                SET idusuario = :idusuario,
                email = :email,
                password = :password,
                alias = :alias,
                nombre = :nombre,
                apellido1 = :apellido1,
                apellido2 = :apellido2,
                calle = :calle,
                localidad = :localidad,
                provincia = :provincia,
                codigopostal = :codigopostal,
                telefono1 = :telefono1,
                telefono2 = :telefono2,
                fecharegistro = :fecharegistro
                WHERE idusuario = :idusuario';
        $actualizacionPerfil = $conexion->prepare($modificacionPerfil);
        $actualizacionPerfil->execute(array(
            'idusuario' => $idusuario,
            'email' => $email,
            'password' => $password,
            'alias' => $alias,
            'nombre' => $nombre,
            'apellido1' => $apellido1,
            'apellido2' => $apellido2,
            'calle' => $calle,
            'localidad' => $localidad,
            'provincia' => $provincia,
            'codigopostal' => $codigoPostal,
            'telefono1' => $telefono1,
            'telefono2' => $telefono2,
            'fecharegistro' => $fecharegistro  
        ));
        //COMPROBAMOS QUE SE HA HECHO EL UPDATE
        if($actualizacionPerfil->rowCount() < 1) {
            echo 'La actualización de perfil no se ha podido realizar.<br>'
            . 'Inténtelo de nuevo más tarde.';
            return false;
        }
        else {
            echo "Perfil de usuario actualizado correctamente.";
            return true;
        }
    }
    catch (PDOException $e) {
        echo /*$modificacion. */"<br>" . $e->getMessage();
        return false;
    }
    $conexion = null; 
}

//FUNCIÓN PARA MOSTRAR LOS DATOS DEL VENDEDOR DESPUÉS DE COMPRAR EL PRODUCTO
function mostrarDatosVendedor() {
    $conexion = conexionBd();
    
    
    //<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
    //DATOS A PASAR: esta variable se pasara como  argumento o en sesion
    $idusuario = 1;
    //<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
    
    
    
    $consulta = $conexion->prepare('
            SELECT idusuario, email, alias, nombre, apellido1, apellido2, telefono1, telefono2
            FROM usuario
            WHERE idusuario = :idusuario');    
    $consulta->execute(array('idusuario' => $idusuario));    
    $vendedor = $consulta->fetchObject();    
    echo 'mostrarDatosVendedor() alias--> '. $vendedor->alias. '<br>';
    return $vendedor;  //(o en sesion)       
    $conexion = null;
}

//FUNCIÓN PARA MOSTRAR AL VENDEDOR LOS DATOS DEL COMPRADOR QUE HA COMPRADO EL PRODUCTO
function mostrarDatosComprador() {
    $conexion = conexionBd();
    
    
    //<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
    //DATOS A PASAR: esta variable se pasara como  argumento o en sesion
    $idusuario = 1;
    //<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
    
    
    
    $consulta = $conexion->prepare('
            SELECT idusuario, email, alias, nombre, apellido1, apellido2, calle, localidad, provincia, codigopostal, telefono1, telefono2
            FROM usuario
            WHERE idusuario = :idusuario');    
    $consulta->execute(array('idusuario' => $idusuario));    
    $comprador = $consulta->fetchObject();    
    echo 'mostrarDatosComprador() codigo postal--> '. $comprador->codigopostal. '<br>';
    return $comprador;  //(o en sesion)         
    $conexion = null;
}
