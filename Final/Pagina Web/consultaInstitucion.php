<?php
    session_start();
    if(isset($_SESSION["Rol"])){
    require_once("util.php");
    include("Partials/General/_head.html");
    include("Partials/General/_topBar.html");
    include("Partials/General/_sideBar.html");
    include("Partials/General/_topBody.html");
    if(($_SESSION["Consultar instituciones"]==1)){

    include("Partials/ConsultaInstitucion/_consultaInstitucionTitulo.html");
        echo "<div class=\"row\">";
            echo "<div class=\"col s12\">";
            include("Partials/ConsultaInstitucion/_consultaInstitucionHead.html");
            include("Partials/ConsultaInstitucion/_consultaInstitucion.html");    //cambio, para hacer nuestra tabla de consulta de Institucions dinamica debemos partir en 2 partials este archivo
            $nombre = "";
            
            echo getInstituciones($nombre);
            
            include("Partials/ConsultaInstitucion/_consultaInstitucionFoot.html");
            echo "</div>";
        echo "</div>";
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
    }else{
        echo "<div class=\"row\">
        <div class=\"col s12 m12 l12\">
            <div class=\"card red lighten-1\">
                <div class=\"card-content white-text\">
                    <span class=\"card-title\">Usted no ha iniciado sesión, por favor, hagalo</span>
                </div>
            </div>
        </div>
    </div>";
    }
    include("Partials/General/_endBody.html");
    include("Partials/General/_endPage.html");
?>