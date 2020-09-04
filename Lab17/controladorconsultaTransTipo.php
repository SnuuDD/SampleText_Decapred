<?php
    session_start();
    require_once("util.php");

    $valor1 = htmlspecialchars($_POST["valor1"]);
    
    $_SESSION["tablaR"] = consultaTransTipo($valor1);
    header("location:consultaTransTipo.php");
?>