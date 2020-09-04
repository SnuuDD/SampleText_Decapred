<?php
    session_start();
    include("_header.html");
    include("_navbar.html");
    include("_consultaAreaHead.html");
    include("_consultaAreaBody.html");

    if(isset($_SESSION["tablaR"])){
        echo $_SESSION["tablaR"];        
    }
    
    include("_consultaAreaFoot.html");
    include("_footer.html");
    unset($_SESSION["tablaR"]);
?>