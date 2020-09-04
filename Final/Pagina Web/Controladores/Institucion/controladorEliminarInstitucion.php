<?php
    session_start();
    require_once("../../util.php");
    $institucion_id= htmlspecialchars($_GET["institucion_id"]);

    if((isset($_GET["institucion_id"]))) {
        if (delInstitucionById($institucion_id)) {
            $_SESSION["mensaje"] = "Se ha borrado exitosamente la Institucion";
        } else {
            $_SESSION["warning"] = "Ocurrió un error al borrar la Institucion";
        }
    }

    header("Status: 301 Moved Permanently");


    header("location:../../consultaInstitucion.php");
    exit;

?>