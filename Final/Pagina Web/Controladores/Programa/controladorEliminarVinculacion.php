<?php
    session_start();
    require_once("../../util.php");
    $programa_id= htmlspecialchars($_GET["programa_id"]);
    $id_ingreso = htmlspecialchars($_SESSION["ingreso_id"]);
    if((isset($_GET["programa_id"]))) {
        if (delVinculacionById($programa_id)) {
            $_SESSION["mensaje"] = "Se ha puesto inactivo la vinculacion de esta beneficiaria";
            //echo "success";
        } else {
            $_SESSION["warning"] = "Ocurrió un error al inhabilitar la vinculacion de esta beneficiaria";
            echo "fail";
        }
    }

    header("Status: 301 Moved Permanently");


    header("location:../../consultarProgramas.php?ingreso_id=".$_SESSION["ingreso_id"]."");
    exit;

?>