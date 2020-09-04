<?php
    session_start();
    require_once("../../util.php");  
    $_POST["Nombre"] = htmlspecialchars($_POST["Nombre"]);
    
    $_POST["Rol"] = htmlspecialchars($_POST["Rol"]);

    echo getRolesUsuarios($_POST["Nombre"],$_POST["Rol"]);

?>