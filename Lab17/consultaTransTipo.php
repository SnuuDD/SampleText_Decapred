<?php
    session_start();
    include("_header.html");
    include("_navbar.html");
    include("_consultaTransTipoHead.html");
    include("_formconsultaTransTipo.html");

    if(isset($_SESSION["tablaR"])){
        echo $_SESSION["tablaR"];        
    }
    
    include("_consultaTransTipoFoot.html");
    include("_footer.html");
    unset($_SESSION["tablaR"]);
?>