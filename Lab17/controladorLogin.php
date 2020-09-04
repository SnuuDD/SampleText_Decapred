<?php
    session_start();
    require_once("util.php");

    $nombre = htmlspecialchars($_POST["nombre"]);
    $password = htmlspecialchars($_POST["password"]); 
    
    autenticar($nombre,$password);

    header("location:controlpanel.php");
    
?>