<?php
    session_start();
    require_once("../../util.php");
    $id= htmlspecialchars($_GET["idMed"]);

    if((isset($_GET["idMed"]))) {
        if (estadoMedicamento($id)) {
            $_SESSION["mensaje"] = "Se ha borrado exitosamente el medicamento";
        } else {
            $_SESSION["warning"] = "Ocurrió un error al borrarel medicamento";
        }
    }

    header("Status: 301 Moved Permanently");


    header("location:../../consultaMedicamento.php");
    exit;

?>