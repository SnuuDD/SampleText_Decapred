<?php
    session_start();
    include("_header.html");
    include("_navbar.html");
    include("_consultatrabaFechaHead.html");
    include("_formtrabaFecha.html");

    if(isset($_SESSION["tablaR"])){
        echo $_SESSION["tablaR"];        
    }
    
    include("_consultatrabaFechaFoot.html");
    include("_footer.html");
    unset($_SESSION["tablaR"]);
?>