<?php
    session_start();
    require_once("../../util.php");  
    $_POST["Nombre"] = htmlspecialchars($_POST["Nombre"]);
    $_POST["Orden"] = htmlspecialchars($_POST["Orden"]);
    echo getDiscapacidadesBeneficiaria($_POST["Nombre"], $_SESSION["ingreso_id"],$_POST["Orden"]);
?>