<?php
    session_start();
    require_once("util.php");

    $valor1 = htmlspecialchars($_POST["valor1"]);
    $valor2 = htmlspecialchars($_POST["valor2"]); 
    
    $_SESSION["tablaR"] = consultaTransM($valor1,$valor2);
    header("location:consultarTrans.php");
?>