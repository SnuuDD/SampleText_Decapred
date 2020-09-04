<?php
    session_start();
    include("_header.html");
    include("_navbar.html");
    include("_consultaTransMhead.html");
    include("_formConsultaTrans.html");

    if(isset($_SESSION["tablaR"])){
        echo $_SESSION["tablaR"];        
    }
    
    include("_consultaTransMfoot.html");
    include("_footer.html");
    unset($_SESSION["tablaR"]);
?>