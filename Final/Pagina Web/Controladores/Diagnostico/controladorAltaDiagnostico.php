<?php
    session_start();
    require_once("../../util.php");
   
        //$idDeIngreso=$_SESSION["idBD"];
        $especialidad = htmlspecialchars($_POST["Especialidad"]);
        $fecha = htmlspecialchars($_POST['fechaD']);
        $tratamiento = htmlspecialchars($_POST['tratamiento']);
        $descripcion = htmlspecialchars($_POST['descripcion']);
        $id=$_SESSION["idDiagnostico"];

        if (nuevoDiagnostico($id,$especialidad,$fecha,$tratamiento,$descripcion)) {
            $_SESSION["mensaje"] = "Se ha registrado el Diagnóstico";
            header("Status: 301 Moved Permanently");

            header("location:../../consultarDiagnostico.php?ingreso_id=$id.php");
            exit;
        } else {
            $_SESSION["warning"] = "Ocurrió un error al registrar el Diagnóstico";
        }
    
?>