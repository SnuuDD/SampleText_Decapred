<?php
    session_start();
    require_once("util.php");

    $valor1 = htmlspecialchars($_POST["Cuenta"]);
 
    $_SESSION["tablaC"] = consultaInfoN($valor1);
    header("location:infoCuenta.php");
?>