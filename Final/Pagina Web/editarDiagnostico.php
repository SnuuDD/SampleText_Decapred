<?php
    session_start();
    if(isset($_SESSION["Rol"])){
        include("util.php");
        include("Partials/General/_head.html");
        include("Partials/General/_topBar.html");
        include("Partials/General/_sideBar.html");
        include("Partials/General/_topBody.html");
        
        if(($_SESSION["Modificar diagnóstico"]==1)){
            include("Partials/EditarDiagnostico/_editarDiagnosticoTitulo.html");
            $id = htmlspecialchars($_GET["id_diagnostico"]);
            $especialidad = htmlspecialchars($_GET["e"]);
            $_SESSION["id_diagnosticoM"] = $_GET["id_diagnostico"];
            echo editDiagnostico($id);
            echo selectEspecialidad("idEspecialidad", "nombre", "Especialidad",$especialidad);
            echo editDiagnostico2($id);
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