<?php
    session_start();
    include("_header.html");
    include("_navbar.html");
    include("_infoCuentahead.html");
    include("_infoCuentaForm.html");

    if(isset($_SESSION["tablaC"])){
        echo $_SESSION["tablaC"];        
    }
    
    include("_infoCuentafoot.html");
    include("_footer.html");
    unset($_SESSION["tablaC"]);
?>