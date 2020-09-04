<?php
    session_start();
    require_once("../../util.php");  
    $_POST["Nombre"] = htmlspecialchars($_POST["Nombre"]);
    showQueryCanalizador(getCanalizadorPorNombre($_POST["Nombre"]),$_POST["Nombre"]);
?>