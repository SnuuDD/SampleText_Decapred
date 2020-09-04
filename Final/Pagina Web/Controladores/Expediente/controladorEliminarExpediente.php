<?php
    session_start();
    require_once("../../util.php");
    $id= htmlspecialchars($_GET["id"]);

    if((isset($_GET["id"]))) {
        if (delExpedienteById($id)) {
            delExpedienteById($id);
            $_SESSION["mensaje"] = "Se ha puesto inactiva la beneficiaria";
        } else {
            $_SESSION["warning"] = "Ocurrió un error al momento de poner inactiva a la beneficiaria";
        }
    }


    
    header("Status: 301 Moved Permanently");

    header("location:../../expedientes.php");
    exit;

?>