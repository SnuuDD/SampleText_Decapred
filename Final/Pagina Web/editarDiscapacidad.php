<?php
    session_start();
    if(isset($_SESSION["Rol"])){
    require_once("util.php");
    include("Partials/General/_head.html");
    include("Partials/General/_topBar.html");
    include("Partials/General/_sideBar.html");
    include("Partials/General/_topBody.html");
    if(($_SESSION["Editar discapacidad"]==1)){
        include("Partials/EditarDiscapacidad/_editarDiscapacidadTitulo.html");
        include("Partials/EditarDiscapacidad/_editarDiscapacidadFormularioHead.html");
            $discapacidad_id = htmlspecialchars($_GET["discapacidad_id"]);
            echo"<form action=\"Controladores\Discapacidad\controladorEditarDiscapacidad.php?discapacidad_id=$discapacidad_id\" method=\"post\">";
            echo textDiscapacidad($discapacidad_id);
        include("Partials/EditarDiscapacidad/_editarDiscapacidadFormularioFoot.html");
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