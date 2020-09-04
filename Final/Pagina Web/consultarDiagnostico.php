<?php
    session_start();
    if(isset($_SESSION["Rol"])){
    require_once("util.php");
    include("Partials/General/_head.html");
    include("Partials/General/_topBar.html");
    include("Partials/General/_sideBar.html");
    include("Partials/General/_topBody.html");
    if(($_SESSION["Consultar diagnóstico"]==1)){

    $ingreso_id = htmlspecialchars($_GET["ingreso_id"]);
    $_SESSION["idDiagnostico"] = $_GET["ingreso_id"];
    $_SESSION["idEx"] = $ingreso_id;
    include("Partials/ConsultaDiagnostico/_consultaDiagnosticoTitulo.html");
    echo"  
    <div id=\"mas\" class=\"col s6\">
      <a href=\"consultarExpediente.php?id=$ingreso_id\" class=\"waves-effect green lighten-3 btn \"><i class=\"material-icons right\">undo</i>Volver</a>
    </div>
    <div id=\"mas\" class=\"col s6\">
      <a href=\"altaDiagnostico.php?ingreso_id=$ingreso_id\" class=\"waves-effect waves-light right btn\"><i class=\"material-icons right\">control_point</i>Agregar</a>
    </div>
    <div id=\"mas\" class=\"col s12\">
    <hr>
    </div>
  
  ";
  include("Partials/ConsultaDiagnostico/_consultaDiagnosticoTitulo2.html");
  echo "  </div>
  ";

    echo "<div id=\"diagnosticos\">";
            echo getDiagnosticoByIdC($ingreso_id,NULL);
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