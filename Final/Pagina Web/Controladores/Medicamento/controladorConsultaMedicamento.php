<?php
    session_start();
    require_once("../../util.php");  
    $_POST["Nombre"] = htmlspecialchars($_POST["Nombre"]);
    showQueryMedicamentos(getMedicamentosPorNombre($_POST["Nombre"]),$_POST["Nombre"]);


?>