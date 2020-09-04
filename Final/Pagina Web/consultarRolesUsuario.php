<?php
    session_start();
    if(isset($_SESSION["Rol"])){
        require_once("util.php");
        include("Partials/General/_head.html");
        include("Partials/General/_topBar.html");
        include("Partials/General/_sideBar.html");
        include("Partials/General/_topBody.html");
        if(($_SESSION["Consultar roles de usuario del sistema"]==1) ){
            include("Partials/ConsultarRolesUsuarios/_RolesUsuariosTitulo.html");
            include("Partials/ConsultarRolesUsuarios/_fedback.html");
        
            echo "<div class=\"row\">";
                echo "<div class=\"col s12\">";
                include("Partials/ConsultarRolesUsuarios/_ConsultaRolesUsuariosHead.html");
                include("Partials/ConsultarRolesUsuarios/_ConsultaRolesUsuarios.html");    //cambio, para hacer nuestra tabla de Consultar de programas dinamica debemos partir en 2 partials este archivo
                $RolesUsuarios = "";
                echo"<div id='resultadosRolesUsuarios'>";
                echo getRolesUsuarios($RolesUsuarios);
                echo "</div>";
                include("Partials/ConsultarRolesUsuarios/_ConsultaRolesUsuariosFoot.html");
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
                <span class=\"card-title\">Usted no tiene permisos para acceder a esta sección</span>
            </div>
        </div>
    </div>
    </div>";
    }




    include("Partials/General/_endBody.html");
    include("Partials/General/_endPage.html");
?>