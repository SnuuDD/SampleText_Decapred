<?php
    session_start();
    include("_header.html");
    include("_navbar.html");
    require_once("util.php");

    //$_SESSION["AgregarAreaTrabajo"] = 1;
    echo "<a class=\"waves-effect waves-light btn\" href='consultarTrans.php'>Consulta de monto de transacción (entre un mínimo y un máximo)</a>";
    echo "<br>";
    echo "<a class=\"waves-effect waves-light btn\" href='transaccioNombre.php'> consulta de transacciones por nombre</a>";
    echo "<br>";
    echo "<a class=\"waves-effect waves-light btn\" href='#'>Personal habilitado por fechas</a>";
    echo "<br>";
    echo "<a class=\"waves-effect waves-light btn\" href='controladorconsultaArea.php'>Áreas de trabajo</a>";
    echo "<br>";
    echo "<a class=\"waves-effect waves-light btn\" href='consultaTransTipo.php'>Transacciones por tipo e Información de cuenta por nombre.</a>";

    include("_footer.html");
    


?>