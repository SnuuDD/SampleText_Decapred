<?php
    session_start();
    require_once("../../util.php");  
    $_POST["Id"] = htmlspecialchars($_POST["Id"]);
    echo selectCiudad($_POST["Id"]);
?>