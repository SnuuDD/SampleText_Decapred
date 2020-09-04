<?php
    session_start();
    require_once("../../util.php");
   
        $nombre = htmlspecialchars($_POST["nombre"]);
        $telefono = htmlspecialchars($_POST['telefono']);
        $email = htmlspecialchars($_POST['email']);
        $identificacion = htmlspecialchars($_POST['identificacion']);
        $numeroI = htmlspecialchars($_POST['numeroI']);
        $institucion = htmlspecialchars($_POST['Institucion']);
        $cargo = htmlspecialchars($_POST['cargo']);
        $motivo = htmlspecialchars($_POST['motivo']);


        if (nuevoCanalizador($institucion,$nombre,$cargo,$telefono,$email,$identificacion,$numeroI,$motivo)) {
            $_SESSION["mensaje"] = "Se ha registrado el Canalizador";
            header("Status: 301 Moved Permanently");
            header("location:../../consultaCanalizador.php");
            exit;
        } else {
            $_SESSION["warning"] = "Ocurrió un error al registrar al Canalizador";
        }
    
?>