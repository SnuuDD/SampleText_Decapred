<?php
    session_start();
    require_once("../../util.php");
   
        $nombre = htmlspecialchars($_POST["nombre"]);
        $telefono = htmlspecialchars($_POST['telefono']);
        $email = htmlspecialchars($_POST['email']);
        $identificacion = htmlspecialchars($_POST['identificacion']);
        $numeroI = htmlspecialchars($_POST['numeroI']);
        $cargo = htmlspecialchars($_POST['cargo']);
        $institucion = htmlspecialchars($_POST['Institucion']);

        $idC = htmlspecialchars($_SESSION["idC"]); 
        $motivo = htmlspecialchars($_POST['motivo']);



        if (editarCanalizador($idC,$institucion,$nombre,$cargo,$telefono,$email,$identificacion,$motivo,$numeroI)) {
            $_SESSION["mensaje"] = "Se ha actualizado el Canalizador";
        } else {
            $_SESSION["warning"] = "Ocurrió un error al actualizado el Canalizador";
        }
        header("Status: 301 Moved Permanently");

        header("location:../../consultaCanalizador.php");
        
        exit;

    
?>