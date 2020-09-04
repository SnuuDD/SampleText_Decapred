<?php
    session_start();
    require_once("../../util.php");  
    $_POST["Nombre"] = htmlspecialchars($_POST["Nombre"]);
    $_POST["Buscar"] = htmlspecialchars($_POST["Buscar"]);
    $_POST["Ordernar"] = htmlspecialchars($_POST["Ordernar"]);

    echo getEscolaridad($_POST["Nombre"],$_SESSION["ingreso_id"],$_POST["Ordernar"],$_POST["Buscar"]);
?>