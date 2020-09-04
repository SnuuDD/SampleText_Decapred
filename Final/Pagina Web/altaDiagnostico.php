<?php
  session_start();
  if(isset($_SESSION["Rol"])){
    require_once("util.php");
    $id = htmlspecialchars($_GET["ingreso_id"]);
    include("Partials/General/_head.html");
    include("Partials/General/_topBar.html");
    include("Partials/General/_sideBar.html");
    include("Partials/General/_topBody.html");
    if(($_SESSION["Registrar diagnóstico"]==1)){
    include("Partials/AltaDiagnostico/_altaDiagnosticoTitulo.html");
    include("Partials/AltaDiagnostico/_altaDiagnosticoFormulario.html");
    echo " 
    <button class=\"waves-effect waves-light btn right\" type=\"submit\" name=\"action\">Registrar<i class=\"material-icons right\">add</i></button>
    <a  href=\"consultarDiagnostico.php?ingreso_id=$id\" class=\"waves-effect green lighten-3 btn right\">Volver<i class=\"material-icons right\">undo</i></a>
    </div>
    </div>
</form>
</div>
</div>
</div>
</div>
</div>
</div>


    ";
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