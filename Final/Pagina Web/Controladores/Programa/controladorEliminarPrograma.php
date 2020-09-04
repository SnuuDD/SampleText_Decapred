<?php
    session_start();
    require_once("../../util.php");
    $programa_id= htmlspecialchars($_GET["programa_id"]);

    if((isset($_GET["programa_id"]))) {
        if (delProgramasById($programa_id)) {
            $_SESSION["mensaje"] = "Se ha puesto inactivo el programa";
        } else {
            $_SESSION["warning"] = "Ocurrió un error al inhabilitar el programa";
        }
    }


    delProgramasById($programa_id);
    header("Status: 301 Moved Permanently");

    header("location:../../consultaPrograma.php");
    exit;

?>