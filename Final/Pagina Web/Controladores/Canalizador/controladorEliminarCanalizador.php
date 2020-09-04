<?php
    session_start();
    require_once("../../util.php");
    $canalizador_id= htmlspecialchars($_GET["canalizador_id"]);

    if((isset($_GET["canalizador_id"]))) {
        if (estadoCanalizador($canalizador_id)) {
            $_SESSION["mensaje"] = "Se ha borrado exitosamente";
            
        } else {
            $_SESSION["warning"] = "Ocurrió un error al borrar al canalizador";
        }
    }
    header("Status: 301 Moved Permanently");

    header("location:../../consultaCanalizador.php");
    exit;

?>