<?php
    session_start();
    require_once("util.php");
    
    $_SESSION["tablaR"] = consultaArea();
    header("location:consultaArea.php");
?>