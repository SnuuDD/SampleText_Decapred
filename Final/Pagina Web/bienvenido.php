<?php
    session_start();
    if(isset($_SESSION["Rol"])){
        require_once("util.php");
        include("Partials/General/_head.html");
        include("Partials/General/_topBar.html");
        include("Partials/General/_sideBar.html");
        include("Partials/General/_topBody.html");
        print "<h2 id='titulo' class='center'>Bienvenido a SIDNEED</h2>";

        print "<h4 id='titulo' class='center'>".$_SESSION['Nombre']."</h4>";
        print"<br>";
        print"<p class='center'>Es el sistema de NEEDED encargado en administrar la información de seguimiento de las beneficiarias dentro de la institución. </p>";
        
    }else{
    echo "<div class=\"row\">
    <div class=\"col s12 m12 l12\">
        <div class=\"card red lighten-1\">
            <div class=\"card-content white-text\">
                <span class=\"card-title\">Usted no tiene permisos para acceder a esta sección</span>
            </div>
        </div>
    </div>
    </div>";
    }
    include("Partials/General/_endBody.html");
    include("Partials/General/_endPage.html");  
?>