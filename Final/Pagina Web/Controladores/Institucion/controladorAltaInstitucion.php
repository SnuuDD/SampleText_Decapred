<?php
    session_start();
    require_once("../../util.php");
    

    $nombre = htmlspecialchars($_POST["nombre"]);

    
    
    if((isset($_POST["nombre"]))) {
        if (altaInstitucion($nombre)) {
            $_SESSION["mensaje"] = "Se ha agregado la Institucion";
            //echo "success";
        } else {
            $_SESSION["warning"] = "Ocurrió un error al agregar la Institucion";
        }
    }
    header("Status: 301 Moved Permanently");

    header("location:../../consultaInstitucion.php");
    exit;
    


?>