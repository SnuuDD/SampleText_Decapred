<?php
    session_start();
    require_once("../../util.php");
    $receta_id= htmlspecialchars($_GET["receta_id"]);

    if((isset($_GET["receta_id"]))) {
        if (delRecetasById($receta_id)) {
            $_SESSION["mensaje"] = "Se ha puesto inactiva la receta";
        } else {
            $_SESSION["warning"] = "Ocurrió un error al inhabilitar la receta";
        }
    }


    delRecetasById($receta_id);
    header("Status: 301 Moved Permanently");

    header("location:../../consultarRecetas.php?ingreso_id=".$_SESSION["ingreso_id"]."");
    exit;

?>