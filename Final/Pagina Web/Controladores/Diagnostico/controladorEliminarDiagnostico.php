<?php
    session_start();
    require_once("../../util.php");
    $idDi= htmlspecialchars($_GET["idDi"]);
    $ingreso_id= htmlspecialchars($_GET["i"]);
    $xd=$_SESSION["idEx"];
    if((isset($_GET["idDi"]))) {
        if (eliminarDiagnostico($idDi)) {
            $_SESSION["mensaje"] = "Se ha borrado exitosamente";
            header("Status: 301 Moved Permanently");

            header("location:../../consultarDiagnostico.php?ingreso_id=$xd");
            exit;

            
        } else {
            $_SESSION["warning"] = "Ocurrió un error al borrar el diagnóstico";
        }
    }

?>