<?php
    session_start();
    require_once("../../util.php");
    $idI = htmlspecialchars($_SESSION["idI"]); 

    $nombre = htmlspecialchars($_POST["nombre"]);

    
    if((isset($_POST["nombre"]))) {
        if (editaInstitucion($idI, $nombre)) {
            $_SESSION["mensaje"] = "Se ha editado la Institucion con éxito";
            //echo "success";
        } else {
            $_SESSION["warning"] = "Ocurrió un error al editar la Institucion ";
        }
    }
    header("Status: 301 Moved Permanently");

    header("location:../../consultaInstitucion.php");
    exit;
    


?>