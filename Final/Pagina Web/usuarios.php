<?php
    session_start();
    if(isset($_SESSION["Rol"])){
        require_once("util.php");
        include("Partials/General/_head.html");
        include("Partials/General/_topBar.html");
        include("Partials/General/_sideBar.html");
        include("Partials/General/_topBody.html");
        if(($_SESSION["Consultar usuarios del sistema"]==1)){
            include("Partials/ConsultarUsuarios/_UsuariosTitulo.html");
            include("Partials/ConsultarUsuarios/_fedback.html");
            echo "<div class=\"row\">";
                echo "<div class=\"col s12\">";
                include("Partials/ConsultarUsuarios/_ConsultaUsuariosHead.html");
                include("Partials/ConsultarUsuarios/_ConsultaUsuarios.html");    //cambio, para hacer nuestra tabla de Consultar de programas dinamica debemos partir en 2 partials este archivo
                $Usuarios = "";
                echo"<div id='resultadoUsuarios'>";

                echo getUsuario($Usuarios);
                echo"</div>";        

                include("Partials/ConsultarUsuarios/_ConsultaUsuariosFoot.html");
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