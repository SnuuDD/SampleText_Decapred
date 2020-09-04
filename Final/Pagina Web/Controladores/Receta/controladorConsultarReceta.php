<?php
    session_start();
    require_once("../../util.php");  
    $_POST["Nombre"] = htmlspecialchars($_POST["Nombre"]);
    $_POST["Ordernar"] = htmlspecialchars($_POST["Ordernar"]);
    
    echo getRecetaByIdC($_SESSION["ingreso_id"],$_POST["Nombre"],$_POST["Ordernar"]);
?>