<?php

    //función para conectarnos a la BD
  
    function conectar_bd() {

    $conexion_bd = mysqli_connect("db5000559788.hosting-data.io","dbu932528","2020#SIDneeded","dbs537447");

    if ($conexion_bd == NULL) {
        
        die("No se pudo conectar con la base de datos");
    }
    $conexion_bd->set_charset("utf8");
    return $conexion_bd;
}

/*
function conectar_bd() {

  $conexion_bd = mysqli_connect("localhost","root","","needed");
  if ($conexion_bd == NULL) {
      
      die("No se pudo conectar con la base de datos");
  }
  $conexion_bd->set_charset("utf8");
  return $conexion_bd;
}

*/
//funcion para cerrar la base de datos.
function cerrar_bd($mysql){
    mysqli_close($mysql);
}

function getProgramas($nombre=""){
    $con = conectar_bd();
    
    $sql = "SELECT  p.idProgramaAtencion as idP, p.nombre as NombreP,a.nombre as NombreA,fechaInicial as fechaI, fechaFinal as fechaF, p.activo as activo
    FROM ProgramaAtencion as p, Coordinaciones as a  
    where p.idCoordinaciones = a.idCoordinaciones and p.activo = 1 ";
    if($nombre != ""){
        $sql .= " AND p.nombre like '%".$nombre."%'";
    }
    $result = mysqli_query($con, $sql);
    $tabla = "";
    
    if(!(mysqli_num_rows($result) == 0)){
      $tabla .= "<table class=\"highlight centered\">";
        $tabla .= "<thead><tr><th>Area</th><th>Nombre</th><th>Fecha de inicio</th><th>Fecha de fin</th><th colspan='3'> Acción</th></tr></thead>";
        while($row = mysqli_fetch_assoc($result)){   
            $tabla .= "<tr>";
            $tabla .= "<td>". $row["NombreA"]. "</td>";
            $tabla .= "<td>". $row["NombreP"]. "</td>";
            $tabla .= "<td>". date('d/m/Y',strtotime($row["fechaI"])). "</td>";
            $tabla .= "<td>". date('d/m/Y',strtotime($row["fechaF"])). "</td>";
            $tabla .= '<td><a class="waves-effect waves-light btn-small" title="Consultar datos del programa" href="consultarPrograma.php?programa_id='.$row['idP'].'">'."<i class=\"material-icons\">remove_red_eye</i>"."</a>";
            $tabla .= "</td>"; 
            $tabla .= '<td><a class="waves-effect waves-light btn-small" title="Editar datos del programa" href="editarPrograma.php?programa_id='.$row['idP'].'">'."<i class=\"material-icons\">create</i>"."</a>";
            $tabla .= "</td>"; 
            $tabla .= '<td><a class="waves-effect waves-light btn-small" title="Eliminar el programa" href="eliminarPrograma.php?programa_id='.$row['idP'].'">'."<i class=\"material-icons\">delete_forever</i>"."</a>";
            $tabla .= "</td>"; 
            $tabla .= "</tr>";
        }
        $tabla .= "</table>";
    }else{
      $tabla .= "<div class=\"row\">
      <div class=\"col s12 m12 l12\">
          <div class=\"card blue lighten-1\">
              <div class=\"card-content white-text\">
                  <span class=\"card-title\">No se encontró ningún resultado de \"".$nombre."\"</span>
              </div>
          </div>
      </div>
  </div>";
    }
    mysqli_free_result($result); //Liberar la memoria
    cerrar_bd($con);
    
    return $tabla;
  }



function getProgramasById($id){
    $con = conectar_bd();
    
    $sql = "SELECT  p.idProgramaAtencion as idP, p.nombre as NombreP,a.nombre as NombreA,fechaInicial as fechaI, fechaFinal as fechaF, p.objetivo as objetivo
    FROM ProgramaAtencion as p, Coordinaciones as a where p.idCoordinaciones = a.idCoordinaciones";
    $sql .= " AND p.idProgramaAtencion = '$id'";

    $result = mysqli_query($con, $sql);
    $resultado = "";
    
    
    while($row = mysqli_fetch_assoc($result)){
        $resultado .= "<br>
        <div class=\"card teal lighten-2\">
        <div class=\"card-content teal lighten-3\">
        <div class=\" center\" data-indicators=\"true\">
          <div class=\" teal lighten-5 \" href=\"#one!\" >
          <div class='row'>

            <div class=\"col s12 align-center\">
                <!-- Elemento -->
                <div class=\"file-field input-field\">
                  <div class=\"col s6 m6 l6\">
                    <label>Nombre del programa</label>
                    <p>".$row["NombreP"]."</p>
                </div>
                </div>
                <div class=\"file-field input-field\">
                    <div class=\"col s6 m6 l6\">
                        <label>Area a la que pertecene el programa</label>
                        <p>".$row["NombreA"]."</p>
                    </div>
                </div>
                <br>
                <div class=\"row\">
                  <div class=\"file-field input-field\">
                    <div class=\"col s6\">
                        <label>Fecha de inicio:</label>
                        <p>".date('d/m/Y',strtotime($row["fechaI"]))."</p>
                    </div>
                    <div class=\"col s6\">
                        <label>Fecha de termino:</label>
                        <p>".date('d/m/Y',strtotime($row["fechaF"]))."</p>
                    </div>
                  </div>
                  <br>
                </div>
                <div class=\"file-field input-field\">
                    <div class=\"col s12\">
                        <label>Objetivo del programa</label>
                        <p>".$row["objetivo"]."</p>
                    </div>
                </div>
                <br>
                <br>
                <br>
                <br>
                <div class=\"file-field input-field\">
                  <div class=\"input-field col s12 l12 left\">
                    <a id=\"confirmarEliminarPrograma\" href=\"Controladores\Programa\controladorEliminarPrograma.php?programa_id=".$id."\" class=\"waves-effect red deep-orange darken-4 btn right\">eliminar
                      <i class=\"material-icons right\">remove</i>
                    </a>
                    <a id=\"\" href=\"consultaPrograma.php\" class=\"waves-effect green lighten-3 btn right\">Volver<i class=\"material-icons right\">undo</i>
                    </a>
                </div>
                </div>
              </div>
          </div>
          </div>
        </div>
        </div>
        </div>";
    }
    mysqli_free_result($result); //Liberar la memoria
    cerrar_bd($con);
    
    return $resultado;

}

function getExpedientes($nombre=""){
  $con = conectar_bd();
  
  $sql = "SELECT  idDeIngreso as id, nombre, apellidoP, apellidoM,curp, noDeExpediente, noDisposicion
  from Beneficiaria where activo ='1' ";
  if($nombre != ""){
      $sql .= " AND CONCAT(nombre,' ',apellidoP,' ',apellidoM)  like '%".$nombre."%' ";
  }
  $result = mysqli_query($con, $sql);
  $tabla = "";
  
  if(!(mysqli_num_rows($result) == 0)){
    $tabla .= "<table class=\"highlight centered\">";
      $tabla .= "<thead><tr><th>Nombre(s)</th><th>Apellidos</th><th>CURP</th><th>No. Expediente</th><th>No. de disposición</th><th colspan='3'>Acción</th></tr></thead>";
      while($row = mysqli_fetch_assoc($result)){   
          $tabla .= "<tr>";
          $tabla .= "<td>". $row["nombre"]. "</td>";
          $tabla .= "<td>". $row["apellidoP"]." ". $row["apellidoM"]. "</td>";
          $tabla .= "<td>". $row["curp"]. "</td>";
          $tabla .= "<td>". $row["noDeExpediente"]. "</td>";
          $tabla .= "<td>". $row["noDisposicion"]. "</td>";
          /*if($row["activo"]==1){
              $tabla .= "<td>"."<i class=\"material-icons\">check</i>". "</td>";
          }else{
              $tabla .= "<td>"."<i class=\"material-icons\">block</i>". "</td>";
          }*/
          $tabla .= '<td><a class="waves-effect waves-light btn-small" title="Consultar el expediente" href="consultarExpediente.php?id='.$row['id'].'">'."<i class=\"material-icons\">remove_red_eye</i>"."</a>";
          $tabla .= "</td>"; 
          $tabla .= '<td><a class="waves-effect waves-light btn-small" title="Editar datos de la beneficiaria" href="editarExpediente.php?id='.$row['id'].'">'."<i class=\"material-icons\">create</i>"."</a>";
          $tabla .= "</td>"; 
          $tabla .= '<td><a class="waves-effect waves-light btn-small" title="Eliminar el expediente" href="eliminarExpediente.php?id='.$row['id'].'">'."<i class=\"material-icons\">delete_forever</i>"."</a>";
          $tabla .= "</td>"; 
          $tabla .= "</tr>";
      }
      $tabla .= "</table>";
  }else{
    $tabla .= "<div class=\"row\">
    <div class=\"col s12 m12 l12\">
        <div class=\"card blue lighten-1\">
            <div class=\"card-content white-text\">
                <span class=\"card-title\">No se encontró ningún resultado de \"".$nombre."\"</span>
            </div>
        </div>
    </div>
</div>";
  }
  mysqli_free_result($result); //Liberar la memoria
  cerrar_bd($con);
  
  return $tabla;
}

function getExpedientesCarrousel($nombre=""){
  $con = conectar_bd();
  
  $sql = "SELECT  idDeIngreso as id, nombre, apellidoP, apellidoM,curp, noDeExpediente, noDisposicion
  from Beneficiaria where activo ='1' ";
  if($nombre != ""){
      $sql .= " AND nombre like '%".$nombre."%' OR apellidoP like '%".$nombre."%'";
  }
  $result = mysqli_query($con, $sql);
  $tabla = "";
  
  if(!(mysqli_num_rows($result) == 0)){
    $tabla .= "<table class=\"highlight centered\">";
      $tabla .= "<thead><tr><th>Nombre(s)</th><th>Apellidos</th><th>CURP</th><th>No. Expediente</th><th>No. de disposición</th><th colspan='3'>Acción</th></tr></thead>";
      while($row = mysqli_fetch_assoc($result)){   
          $tabla .= "<tr>";
          $tabla .= "<td>". $row["nombre"]. "</td>";
          $tabla .= "<td>". $row["apellidoP"]." ". $row["apellidoM"]. "</td>";
          $tabla .= "<td>". $row["curp"]. "</td>";
          $tabla .= "<td>". $row["noDeExpediente"]. "</td>";
          $tabla .= "<td>". $row["noDisposicion"]. "</td>";
          /*if($row["activo"]==1){
              $tabla .= "<td>"."<i class=\"material-icons\">check</i>". "</td>";
          }else{
              $tabla .= "<td>"."<i class=\"material-icons\">block</i>". "</td>";
          }*/
          $tabla .= '<td><a class="waves-effect waves-light btn-small" href="consultarExpediente.php?id='.$row['id'].'">'."<i class=\"material-icons\">remove_red_eye</i>"."</a>";
          $tabla .= "</td>"; 
          $tabla .= '<td><a class="waves-effect waves-light btn-small" href="editarExpediente.php?id='.$row['id'].'">'."<i class=\"material-icons\">create</i>"."</a>";
          $tabla .= "</td>"; 
          $tabla .= '<td><a class="waves-effect waves-light btn-small" href="eliminarExpediente.php?id='.$row['id'].'">'."<i class=\"material-icons\">delete_forever</i>"."</a>";
          $tabla .= "</td>"; 
          $tabla .= "</tr>";
      }
      $tabla .= "</table>";
  }else{
    $tabla .= "<div class=\"row\">
    <div class=\"col s12 m12 l12\">
        <div class=\"card blue lighten-1\">
            <div class=\"card-content white-text\">
                <span class=\"card-title\">No se encontró ningún resultado de \"".$nombre."\"</span>
            </div>
        </div>
    </div>
</div>";
  }
  mysqli_free_result($result); //Liberar la memoria
  cerrar_bd($con);
  
  return $tabla;
}

function getExpedienteByIdC($id){
  $con = conectar_bd();
  
  $sql = "SELECT  b.idDeIngreso,b.fechaHoraIngreso,b.nombre as nombreB,b.apellidoP,b.apellidoM,
  b.curp, ts.nombre as nombreTS, b.ciudad, e.nombre as estado,b.fechaNacimiento,
  b.noDeExpediente, b.noDisposicion,
  b.ingresoConHermanos,b.motivoIngreso,b.consideracionesGenerales
  from Beneficiaria as b, Estado as e, TipoDeSangre as ts
  where b.idTipoSangre = ts. idTipoSangre 
  and b.idEstado = e.idEstado
and b.idDeIngreso = '$id'";

  $result = mysqli_query($con, $sql);
  $resultado = "";
  
  
  while($row = mysqli_fetch_assoc($result)){
      $resultado .= "<div class=\"row\">
    

      <div class=\"card teal lighten-2\">
        <div class=\"card-content teal lighten-5\">
            <ul class=\"collection with-header white\">
                <li>
                    <li class=\"col s2 l2 collection-item header teal lighten-4 center\"><h6><strong>ID:00".$row["idDeIngreso"]."</strong></h6></li>
                    <li class=\"col s4 l4 collection-item header\"><h6><strong>  </strong></h6></li>
                    <li class=\"col s6 l6 collection-item header center\"><h6>Fecha y Hora de Ingreso: <strong>".date('d/m/Y H:i',strtotime($row["fechaHoraIngreso"]))."</strong></h6></li>
                    </li>
                <li>
                <li class=\"col s4 l4 collection-item header center\"><h6>Nombre: <strong>".$row["nombreB"]."</strong></h6></li>
                <li class=\"col s4 l4 collection-item header center\"><h6>Apellido Paterno: <strong>".$row["apellidoP"]."</strong></h6></li>
                <li class=\"col s4 l4 collection-item header center\"><h6>Apellido Paterno: <strong>".$row["apellidoM"]."</strong></h6></li>
                </li>
                
                <li class=\"col s12 l12 collection-item header center\"><h6>CURP:<strong>".$row["curp"]."</strong></h6></li>
                <li>
                    <li class=\"col s3 l3 collection-item header center\"><h6>Tipo de Sangre <strong>".$row["nombreTS"]."</strong></h6></li>
                    <li class=\"col s5 l5 collection-item header center\"><h6>Lugar de Nacimiento: <strong>".$row["ciudad"].",".$row["estado"]."</strong></h6></li>
                    <li class=\"col s4 l4 collection-item header center\"><h6>Fecha de Nacimiento: <strong>".date('d/m/Y',strtotime($row["fechaNacimiento"]))."</strong></h6></li>
                </li>
                <li>
                    <li class=\"col s5 l5 center\"><h6>No. Expediente: <strong>".$row["noDeExpediente"]."</strong></h6></li>
                    <li class=\"col s4 l4  center\"><h6>No. de Disposición: <strong>".$row["noDisposicion"]."</strong></h6></li>
                    <li class=\"col s3 l3  center\"><h6>Hermanos: ";
                    if($row["ingresoConHermanos"] == 1){
                      $resultado .= "<span> Si </span> <i class=\"material-icons\">check</i></h6></li></li>";
                    }else{
                      $resultado .= "<span> Si </span> <i class=\"material-icons\">block</i></h6></li></li>";
                    }

              $resultado .= "<li class=\"col s12 l12 collection-item header \"><hr><strong><h6>Motivo de Ingreso: </strong>".$row["motivoIngreso"]."
              </h6></li>
              <li class=\"col s12 l12 collection-item header \"><strong><h6>Consideraciones Generales: </strong>".$row["consideracionesGenerales"]."
               </h6></li>
               </ul>
               <div class=\"row\ card-content teal lighten-5\ collection with-header white\">
                  <div class=\"col s6 center\">
                  <ul class=\"collection\">
                    <li class=\"collection-item header\"><h5>Médicamentos:</h5></li>
                    <li class=\"collection-item\">".getMedicamentosPorIdDeIngreso($row["idDeIngreso"])."</li>
                    <li class=\"collection-item header\"><h5>Último diagnóstico: </h5></li>
                    ".getDiagnosticoMasRecientePorId($row["idDeIngreso"])."
                    
                </ul>
                
          </div>
                  <div class=\"col s6 center\">
                  <ul class=\"collection\">
                    <li class=\"collection-item header\"><h5>Área escolar:</h5></li>".
                    getGradoEscolarBeneficiariaById($row["idDeIngreso"])."
                </ul>
                  </div>
                </div>
                
        </div>
      </div>
    </div>
  </div>";
  }
  mysqli_free_result($result); //Liberar la memoria
  cerrar_bd($con);
  
  return $resultado;
}

function getExpedienteByIdD($id){
  $con = conectar_bd();
  
  $sql = "SELECT  b.idDeIngreso,b.fechaHoraIngreso,b.nombre as nombreB,b.apellidoP,b.apellidoM,
  b.curp, ts.nombre as nombreTS, b.ciudad, e.nombre as estado,b.fechaNacimiento,
  b.noDeExpediente, b.noDisposicion,
  b.ingresoConHermanos,b.motivoIngreso,b.consideracionesGenerales
  from Beneficiaria as b, Estado as e, TipoDeSangre as ts
  where b.idTipoSangre = ts. idTipoSangre 
  and b.idEstado = e.idEstado
and b.idDeIngreso = '$id'";

  $result = mysqli_query($con, $sql);
  $resultado = "";
  
  
  while($row = mysqli_fetch_assoc($result)){
      $resultado .= "<div class=\"row\">
    

      <div class=\"card teal lighten-2\">
        <div class=\"card-content teal lighten-5\">
            <ul class=\"collection with-header white\">
                <li>
                    <li class=\"col s2 l2 collection-item header teal lighten-4 center\"><h6><strong>ID:00".$row["idDeIngreso"]."</strong></h6></li>
                    <li class=\"col s4 l4 collection-item header\"><h6><strong>  </strong></h6></li>
                    <li class=\"col s6 l6 collection-item header center\"><h6>Fecha y Hora de Ingreso: <strong>".date('d/m/Y H:i',strtotime($row["fechaHoraIngreso"]))."</strong></h6></li>
                    </li>
                <li>
                <li class=\"col s4 l4 collection-item header center\"><h6>Nombre: <strong>".$row["nombreB"]."</strong></h6></li>
                <li class=\"col s4 l4 collection-item header center\"><h6>Apellido Paterno: <strong>".$row["apellidoP"]."</strong></h6></li>
                <li class=\"col s4 l4 collection-item header center\"><h6>Apellido Paterno: <strong>".$row["apellidoM"]."</strong></h6></li>
                </li>
                
                <li class=\"col s12 l12 collection-item header center\"><h6>CURP:<strong>".$row["curp"]."</strong></h6></li>
                <li>
                    <li class=\"col s3 l3 collection-item header center\"><h6>Tipo de Sangre <strong>".$row["nombreTS"]."</strong></h6></li>
                    <li class=\"col s5 l5 collection-item header center\"><h6>Lugar de Nacimiento: <strong>".$row["ciudad"].",".$row["estado"]."</strong></h6></li>
                    <li class=\"col s4 l4 collection-item header center\"><h6>Fecha de Nacimiento: <strong>".date('d/m/Y',strtotime($row["fechaNacimiento"]))."</strong></h6></li>
                </li>
                <li>
                    <li class=\"col s5 l5 center\"><h6>No. Expediente: <strong>".$row["noDeExpediente"]."</strong></h6></li>
                    <li class=\"col s4 l4  center\"><h6>No. de Dispociscion: <strong>".$row["noDisposicion"]."</strong></h6></li>
                    <li class=\"col s3 l3  center\"><h6>Hermanos: ";
                    if($row["ingresoConHermanos"] == 1){
                      $resultado .= "<span> Si </span> <i class=\"material-icons\">check</i></h6></li></li>";
                    }else{
                      $resultado .= "<span> Si </span> <i class=\"material-icons\">block</i></h6></li></li>";
                    }

              $resultado .= "<li class=\"col s12 l12 collection-item header \"><hr><strong><h6>Motivo de Ingreso: </strong>".$row["motivoIngreso"]."
              </h6></li>
              <li class=\"col s12 l12 collection-item header \"><strong><h6>Consideraciones Generales: </strong>".$row["consideracionesGenerales"]."
               </h6></li>
               </ul>
               <div class=\"row\ card-content teal lighten-5\ collection with-header white\">
                  <div class=\"col s6 center\">
                  <ul class=\"collection\">
                    <li class=\"collection-item header\"><h5>Médicamentos:</h5></li>
                    <li class=\"collection-item\">".getMedicamentosPorIdDeIngreso($row["idDeIngreso"])."</li>
                    <li class=\"collection-item header\"><h5>Último diagnostico: </h5></li>
                    ".getDiagnosticoMasRecientePorId($row["idDeIngreso"])."
                    
                </ul>
                
          </div>
                  <div class=\"col s6 center\">
                  <ul class=\"collection\">
                    <li class=\"collection-item header\"><h5>Área escolar:</h5></li>".
                    getGradoEscolarBeneficiariaById($row["idDeIngreso"])."
                </ul>
                  </div>
                  
                  <a href=\"Controladores\Expediente\controladorEliminarExpediente.php?id=".$row["idDeIngreso"]."\"class=\"waves-effect waves-light red deep-orange darken-4 btn right\" type=\"submit\" name=\"action\">Eliminar
              <i class=\"material-icons right\">delete</i>
            </a>
            <a id=\"\" href=\"expedientes.php\" class=\"waves-effect green lighten-3 btn right\">Volver<i class=\"material-icons right\">undo</i>
            </a>        
                </div>
                
        </div>
      </div>
    </div>
  </div>";
  }
  mysqli_free_result($result); //Liberar la memoria
  cerrar_bd($con);
  
  return $resultado;
}

function altaBeneficiaria($sangre, $estado,  $ciudad, $fechahora, $nombre, $apellidoMaterno,  $apellidoPaterno, $fechaN, $curp, $nExpediente, $hermanos,$motivoI,$nDisposicion,$consideraciones,$idcanalizador){
  $activo = "1";
  $conexion_bd = conectar_bd();
    
  //Prepara la consulta
  $dml = 'INSERT INTO Beneficiaria 
  (`idTipoSangre`,`idEstado`,`idCanalizador`,`ciudad`,`fechaHoraIngreso`,`nombre`,`apellidoM`,`apellidoP`,`fechaNacimiento`,`curp`,`noDeExpediente`,`ingresoConHermanos`,`motivoIngreso`,`noDisposicion`,`consideracionesGenerales`,`activo`) 
  VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?)';
  if ( !($statement = $conexion_bd->prepare($dml)) ) {
      die("Error: (" . $conexion_bd->errno . ") " . $conexion_bd->error);
      return 0;
  }
    
  //Unir los parámetros de la función con los parámetros de la consulta   
  //El primer argumento de bind_param es el formato de cada parámetro
  if (!$statement->bind_param("ssssssssssssss",$sangre, $estado,$idcanalizador,  $ciudad, $fechahora, $nombre, $apellidoMaterno,  $apellidoPaterno, $fechaN, $curp, $nExpediente, $hermanos,$motivoI,$nDisposicion,$consideraciones,$activo)) {
      die("Error en vinculación: (" . $statement->errno . ") " . $statement->error);
      return 0;
  }
    
  //Executar la consulta
  if (!$statement->execute()) {
    die("Error en ejecución: (" . $statement->errno . ") " . $statement->error);
      return 0;
  }

  cerrar_bd($conexion_bd);
    return 1;
}

function editBeneficiaria($id,$sangre, $estado,  $ciudad, $fechahora, $nombre, $apellidoMaterno,  $apellidoPaterno, $fechaN, $curp, $nExpediente, $hermanos,$motivoI,$nDisposicion,$consideraciones){
  $activo = "1";
  $conexion_bd = conectar_bd();
    
  //Prepara la consulta
  $dml = 'UPDATE Beneficiaria SET
  `idTipoSangre`= (?), `idEstado` = (?),`ciudad` = (?),`fechaHoraIngreso` = (?),`nombre` = (?) ,`apellidoM` = (?),`apellidoP` = (?),`fechaNacimiento` = (?),`curp` = (?),`noDeExpediente`= (?),`ingresoConHermanos` = (?),`motivoIngreso`= (?),`noDisposicion`= (?),`consideracionesGenerales`= (?),`activo`= (?) 
  WHERE idDeIngreso = (?)';
  if ( !($statement = $conexion_bd->prepare($dml)) ) {
      die("Error: (" . $conexion_bd->errno . ") " . $conexion_bd->error);
      return 0;
  }
    
  //Unir los parámetros de la función con los parámetros de la consulta   
  //El primer argumento de bind_param es el formato de cada parámetro
  if (!$statement->bind_param("isssssssssssssss",$sangre, $estado,  $ciudad, $fechahora, $nombre, $apellidoMaterno,  $apellidoPaterno, $fechaN, $curp, $nExpediente, $hermanos,$motivoI,$nDisposicion,$consideraciones,$activo,$id)) {
      die("Error en vinculación: (" . $statement->errno . ") " . $statement->error);
      return 0;
  }
    
  //Executar la consulta
  if (!$statement->execute()) {
    die("Error en ejecución: (" . $statement->errno . ") " . $statement->error);
      return 0;
  }
  //mysqli_free_result($result); //Liberar la memoria
  cerrar_bd($conexion_bd);
    return 1;
}



function getMedicamentosPorIdDeIngreso($id){
  $conexion_bd = conectar_bd();
  $sql = "SELECT med.nombre
  from Medicamentos as med, Beneficiaria as b, Receta as r
  where med.idMedicamento = r.idMedicamento
  and r.idDeIngreso = b.idDeIngreso
  and r.idDeIngreso = '$id'";
  $resultado = "";
  $result = mysqli_query($conexion_bd, $sql);
  if(mysqli_num_rows ($result) > 0){
    while($row = mysqli_fetch_assoc($result)){
      $resultado .= $row["nombre"];
      $resultado .= ", ";
    }
  }
  if(mysqli_num_rows ($result) == 0){
      $resultado .= "Ninguno";
  }
  mysqli_free_result($result); //Liberar la memoria
  cerrar_bd($conexion_bd);
  return $resultado;
}

function getDiagnosticoMasRecientePorId($id){
  $conexion_bd = conectar_bd();
  $sql = "SELECT diag.idDeIngreso, diag.fecha as fecha, diag.descripcion, diag.tratamiento
  from Diagnostico as diag, Beneficiaria as b
  where diag.idDeIngreso = b.idDeIngreso
  and diag.idDeIngreso = '$id'
  order by fecha desc
  LIMIT 1";

  $resultado = "";

  $result = mysqli_query($conexion_bd, $sql);

  if(mysqli_num_rows ($result) >= 1){
    while($row = mysqli_fetch_assoc($result)){
      $resultado .= "<li class=\"collection-item\"> Fecha: ".date('d/m/Y',strtotime($row["fecha"]))."</li>";
      $resultado .= "<li class=\"collection-item\"> Descripción: ".$row["descripcion"]."</li>";
      $resultado .= "<li class=\"collection-item\"> Tratamiento: ".$row["tratamiento"]."</li>";
    }
  }
  if(mysqli_num_rows ($result) == 0){
      $resultado .= "Ninguno";
  }
  
  mysqli_free_result($result); //Liberar la memoria
  cerrar_bd($conexion_bd);
  return $resultado;
}

function getGradoEscolarBeneficiariaById($id){
  $conexion_bd = conectar_bd();
  $sql = "SELECT esc.nombre, ge.nombre as grado , e.fechaInicio as fechaI
  from Beneficiaria as b, Escolaridad as e, GradoEscolar as ge, Escuela as esc
  where b.idDeIngreso = e.idDeIngreso
  and e.idGradoEscolar = ge.idGradoEscolar
  and esc.idEscuela = e.idEscuela
  and b.idDeIngreso = '$id'
  group by b.idDeIngreso
  order by fechaFin";
  $resultado = "";
  $result = mysqli_query($conexion_bd, $sql);
  if(mysqli_num_rows ($result) > 0){
    while($row = mysqli_fetch_assoc($result)){
      $resultado .= "<li class=\"collection-item header\"><h5>Plan Educativo:</h5></li>";
      $resultado .= "<li class=\"collection-item\">".$row["grado"]."</li>";
      $resultado .= "<li class=\"collection-item header\"><h5>Escuela:</h5></li>";
      $resultado .= "<li class=\"collection-item\">".$row["nombre"]."</li>";
      $resultado .= "<li class=\"collection-item\"> Fecha de inicio: ".date('d/m/Y',strtotime($row["fechaI"]))."</li>";
    }
  }
  if(mysqli_num_rows ($result) == 0){
      $resultado .= "Sin Plan Educativo";
  }
  mysqli_free_result($result); //Liberar la memoria
  cerrar_bd($conexion_bd);
  return $resultado;

}



function getProgramasByIdC($id){
    $con = conectar_bd();
    
    $sql = "SELECT  p.idProgramaAtencion as idP, p.nombre as NombreP,a.nombre as NombreA,fechaInicial as fechaI, fechaFinal as fechaF, p.objetivo as objetivo
    FROM ProgramaAtencion as p, Coordinaciones as a where p.idCoordinaciones = a.idCoordinaciones";
    $sql .= " AND p.idProgramaAtencion = '$id'";

    $result = mysqli_query($con, $sql);
    $resultado = "";
    
    
    while($row = mysqli_fetch_assoc($result)){
        $resultado .= "<br>
        <div class=\"card teal lighten-2\">
        <div class=\"card-content teal lighten-3\">
        <div class=\" center\" data-indicators=\"true\">
          <div class=\" teal lighten-5 \" href=\"#one!\" >
          <div class='row'>

            <div class=\"col s12 align-center\">
                <!-- Elemento -->
                <div class=\"file-field input-field\">
                  <div class=\"col s6 m6 l6\">
                    <label>Nombre del programa</label>
                    <p>".$row["NombreP"]."</p>
                </div>
                </div>
                <div class=\"file-field input-field\">
                    <div class=\"col s6 m6 l6\">
                        <label>Area a la que pertecene el programa</label>
                        <p>".$row["NombreA"]."</p>
                    </div>
                </div>
                <br>
                <div class=\"row\">
                  <div class=\"file-field input-field\">
                    <div class=\"col s6\">
                        <label>Fecha de inicio:</label>
                        <p>".date('d/m/Y',strtotime($row["fechaI"]))."</p>
                    </div>
                    <div class=\"col s6\">
                        <label>Fecha de termino:</label>
                        <p>".date('d/m/Y',strtotime($row["fechaF"]))."</p>
                    </div>
                  </div>
                  <br>
                </div>
                <div class=\"file-field input-field\">
                    <div class=\"col s12\">
                        <label>Objetivo del programa</label>
                        <p>".$row["objetivo"]."</p>
                    </div>
                </div>

                <div class=\"file-field input-field\">
                  <div class=\"input-field col s12 l12 left\">
                    <a id=\"\" href=\"consultaPrograma.php\" class=\"waves-effect green lighten-3 btn right\">Volver<i class=\"material-icons right\">undo</i>
                    </a>
                </div>
                </div>
              </div>
          </div>
          </div>
        </div>
        </div>
        </div>";
    }
    mysqli_free_result($result); //Liberar la memoria
    cerrar_bd($con);
    
    return $resultado;

}

function getRecetaByIdC($id,$medicamento='',$orden=1){
  $con = conectar_bd();
  //tal vez agregar funcionabilidad de activo o inactivo (ajax)
  $sql = "SELECT r.*,b.Nombre as nombreB, b.apellidoP, b.apellidoM,m.nombre as med
  from Receta as r, Beneficiaria as b, Medicamentos as m
  where r.idDeIngreso = b.idDeIngreso
  and m.idMedicamento = r.idMedicamento
  and r.activo = '1' ";
  
  $sql .= " AND r.idDeIngreso = '$id'";
  
  if ($medicamento!=''){
    $sql .= " AND m.nombre  like '%".$medicamento."%' ";
  }
  
  
  if ($orden==0){
    $sql .= " Order by r.fechaIni DESC";
  }else{
    $sql .= " Order by r.fechaIni ASC";
  }
  
  $result = mysqli_query($con, $sql);
  $resultado = "";
if(mysqli_num_rows($result) > 0){
  $resultado = "<div class=\"row\">
    <div class=\"card teal lighten-2\">
      <div class=\"card-content teal lighten-5\">";
  while($row = mysqli_fetch_assoc($result)){
    $resultado .= "<ul class=\"collection with-header white\">
    <li>
        <li class=\"col s2 l2 collection-item header teal lighten-4 center\">
        <a title=\"Editar Receta\" href=\"editarReceta.php?receta_id=".$row['idReceta']."\" class=\"waves-effect waves-light btn-small\"><i class=\"material-icons\">edit</i></a>
        <a  title=\"Eliminar Receta\" href=\"eliminarReceta.php?receta_id=".$row['idReceta']."\" class=\"waves-effect waves-light btn-small red darken-4\"><i class=\"material-icons\">delete
        </i></a></li>
        <li class=\"col s5 l5 collection-item header right\"><h6>Fecha fin del tratamiento: <strong>".date('d/m/Y',strtotime($row["fechaFin"]))."</strong></h6></li>
        </li>
        <li class=\"col s5 l5 collection-item header right\"><h6>Fecha inicio del tratamiento: <strong>".date('d/m/Y',strtotime($row["fechaIni"]))."</strong></h6></li>
        </li>

    <li>
    <li class=\"col s12 l12 collection-item header \"><h6>Nombre: <strong>".$row["nombreB"]." ".$row["apellidoP"]." ".$row["apellidoM"]."</strong></h6></li>
    </li>                           
  
  <li class=\"col s12 l12 collection-item header \"><strong><h6>Descripcion: </strong>".$row["descripcion"]."
  </h6></li>
  <li class=\"col s12 l12 collection-item header \"><strong><h6>Dosis: </strong>".$row["dosis"]."
   </h6></li>
   <li class=\"col s12 l12 collection-item header \"><strong><h6>Medicamento: </strong>".$row["med"]."
   </h6></li>
   </ul>    
   <hr>";
    }
    $resultado .="</div>
      </div>
    </div>
  </div>";
  }else{
    $resultado.= "<div class=\"row\">
    <div class=\"col s12 m12 l12\">
        <div class=\"card blue lighten-1\">
            <div class=\"card-content white-text\">
                <span class=\"card-title\">No se encontró ninguna receta para esta beneficiaria</span>
            </div>
        </div>
    </div>
</div>";
  }
  
    mysqli_free_result($result); //Liberar la memoria
    cerrar_bd($con);
    
    return $resultado;

}


function getProgramasBeneficiariaByid($id,$nombre='',$orden=1){
  $con = conectar_bd();
  
  $sql = "SELECT pb.idProgramaAtencionBeneficiaria, pb.activo,p.idProgramaAtencion, p.nombre as nombreP,p.objetivo as objetivoP, b.idDeIngreso, pb.fechaRegistro, pb.motivo,pb.observaciones
  from ProgramaAtencion as p, ProgramaAtencionBeneficiaria as pb, Beneficiaria as b
  where p.idProgramaAtencion = pb.idProgramaAtencion
  and b.idDeIngreso = pb.idDeIngreso 
  and pb.activo='1'";
  $sql .= " AND b.idDeIngreso = '$id'";
  if($nombre != ""){
    $sql .= " and (p.Nombre like '%$nombre%')";
  }
  if ($orden==0){
    $sql .= " Order by pb.fechaRegistro DESC";
  }else{
    $sql .= " Order by pb.fechaRegistro ASC";
  }
  $result = mysqli_query($con, $sql);
  $resultado = "";
if(mysqli_num_rows($result) > 0){
  
  while($row = mysqli_fetch_assoc($result)){
    $resultado .= "<ul class=\"collection with-header white\">
    <li>
        <li class=\"col s2 l2 collection-item header teal lighten-4 center\">
        <a title=\"Editar vinculación con programa.\" href=\"editarVinculacionPrograma.php?idProgramaAtencionBeneficiaria=".$row["idProgramaAtencionBeneficiaria"]."\" class=\"waves-effect waves-light btn-small\"><i class=\"material-icons\">edit</i></a>
        <a title=\"Desvincular beneficiaria de programa.\" href=\"eliminarVinculacion.php?idProgramaAtencionBeneficiaria=".$row["idProgramaAtencionBeneficiaria"]."\" class=\"waves-effect waves-light btn-small red darken-4\"><i class=\"material-icons\">delete
        </i></a></li>
        <li class=\"col s10 l10 collection-item header right\"><h6>Fecha de registro en programa: <strong>".date('d/m/Y',strtotime($row["fechaRegistro"]))."</strong></h6></li>
        </li>
    <li>
    <li class=\"col s12 l12 collection-item header \"><h6>Programa: <strong>".$row["nombreP"]."</strong></h6></li>
    </li>                           
  
  <li class=\"col s12 l12 collection-item header \"><strong><h6>Motivo: </strong>".$row["motivo"]."
  </h6></li>
  <li class=\"col s12 l12 collection-item header \"><strong><h6>Observaciones: </strong>".$row["observaciones"]."
   </h6></li>
   </ul>    
   <hr>";
    }
    $resultado .="</div>
      </div>
    </div>
  </div>";
  }else{
    $resultado.= "<div class=\"row\">
    <div class=\"col s12 m12 l12\">
        <div class=\"card blue lighten-1\">
            <div class=\"card-content white-text\">
                <span class=\"card-title\">Esta beneficiaria no se encuentra dentro de ningún programa.</span>
            </div>
        </div>
    </div>
</div>";
  }
  
    mysqli_free_result($result); //Liberar la memoria
    cerrar_bd($con);
    
    return $resultado;

}

function getRecetaById($id,$ingreso_id){
  $con = conectar_bd();
  
  $sql = "SELECT r.*,b.Nombre as nombreB, b.apellidoP, b.apellidoM,m.nombre as med
  from Receta as r, Beneficiaria as b, Medicamentos as m
  where r.idDeIngreso = b.idDeIngreso
  and m.idMedicamento = r.idMedicamento";
  $sql .= " AND r.idReceta = '$id'";

  $result = mysqli_query($con, $sql);
  while($row = mysqli_fetch_assoc($result)){
    $resultado = "<br>
    <div class=\"card teal lighten-2\">
    <div class=\"card-content teal lighten-3\">
    <div class=\"center\" data-indicators=\"true\">
      <div class=\"teal lighten-5 \" href=\"#one!\" >
      <div class='row'>
        <div class=\"col s12 align-center\">
            <!-- Elemento -->
            <div class=\"row\">
            <div class=\"file-field input-field\">
              <div class=\"col s6 m6 l6\">
                <i class=\"material-icons prefix\"> </i>
                <label for=\"rol\"><strong>Paciente</strong></label>
                <p>".$row["nombreB"]." ".$row["apellidoP"]." ".$row["apellidoM"]."</p>     
            </div>
            </div>
            <div class=\"file-field input-field\">
              <div class=\"col s6 m6 l6\">
                <i class=\"material-icons prefix\"> </i>
                <label for=\"rol\"><strong>Medicamento</strong></label>    
                <p>".$row["med"]."</p> 
            </div>
            </div>
            </div>
            <div class=\"row\">
            <div class=\"file-field input-field\">
              <div class=\"col s6\">
                <i class=\"material-icons prefix\"> </i>
                <label for=\"rol\"><strong>Fecha de Inicio:</strong></label>   
                <p>".date('d/m/Y',strtotime($row["fechaIni"]))."</p>   
            </div>
            </div>
            <div class=\"file-field input-field\">
              <div class=\"col s6\">
                <i class=\"material-icons prefix\"> </i>
                <label for=\"rol\"><strong>Fecha de Termino:</strong></label>   
                <p>".date('d/m/Y',strtotime($row["fechaFin"]))."</p>   
            </div>
            </div>
            </div>
            <div class=\"row\">
              <div class=\"file-field input-field\">
                <div class=\"col s6\">
                  <i class=\"material-icons prefix\"> </i>
                  <label for=\"rol\"><strong>Indicaciones</strong></label>  
                  <p>".$row["descripcion"]."  </p>   
              </div>
              </div>
              <div class=\"file-field input-field\">
                <div class=\"col s6\">
                  <i class=\"material-icons prefix\"> </i>
                  <label for=\"rol\"><strong>Dosis</strong></label> 
                  <p>".$row["dosis"]."  </p>    
              </div>
              </div>
              </div>
            <div class=\"file-field input-field\">
              <div class=\"col s12 l12 left\">
              <a id=\"confirmarEliminarPrograma\" href=\"Controladores\Receta\controladorEliminarReceta.php?receta_id=".$id."\" class=\"waves-effect red deep-orange darken-4 btn right\">eliminar
                      <i class=\"material-icons right\">remove</i>
                    </a>
                    <a id=\"\" href=\"./consultarRecetas.php?ingreso_id=".$ingreso_id."\" class=\"waves-effect green lighten-3 btn right\">Volver<i class=\"material-icons right\">undo</i>
                    </a>
            </div>
            </div>
            
          
          </div>
    
    
          </div>
      </div>
    </div>
    </div>
    </div>";
    }
    mysqli_free_result($result); //Liberar la memoria
    cerrar_bd($con);
    
    return $resultado;

}

//función para editar un registro de programa de atencion haciendolo inactivo
//@param caso_id: id del programa que se va a editar

function delProgramasById($id){
    
    $conexion_bd = conectar_bd();
      
    //Prepara la consulta
    $dml = 'UPDATE ProgramaAtencion SET activo='."0".' WHERE idprogramaatencion=(?)';
    if ( !($statement = $conexion_bd->prepare($dml)) ) {
        die("Error: (" . $conexion_bd->errno . ") " . $conexion_bd->error);
        return 0;
    }
      
    //Unir los parámetros de la función con los parámetros de la consulta   
    //El primer argumento de bind_param es el formato de cada parámetro
    if (!$statement->bind_param("i", $id)) {
        die("Error en vinculación: (" . $statement->errno . ") " . $statement->error);
        return 0;
    }
      
    //Executar la consulta
    if (!$statement->execute()) {
      die("Error en ejecución: (" . $statement->errno . ") " . $statement->error);
        return 0;
    }
    
    cerrar_bd($conexion_bd);
      return 1;
  }

  function delRecetasById($id){
    
    $conexion_bd = conectar_bd();
      
    //Prepara la consulta
    $dml = 'UPDATE Receta SET activo='."0".' WHERE idReceta=(?)';
    if ( !($statement = $conexion_bd->prepare($dml)) ) {
        die("Error: (" . $conexion_bd->errno . ") " . $conexion_bd->error);
        return 0;
    }
      
    //Unir los parámetros de la función con los parámetros de la consulta   
    //El primer argumento de bind_param es el formato de cada parámetro
    if (!$statement->bind_param("i", $id)) {
        die("Error en vinculación: (" . $statement->errno . ") " . $statement->error);
        return 0;
    }
      
    //Executar la consulta
    if (!$statement->execute()) {
      die("Error en ejecución: (" . $statement->errno . ") " . $statement->error);
        return 0;
    }
    
    cerrar_bd($conexion_bd);
      return 1;
  }

  function delVinculacionById($programa_id){
    
    $conexion_bd = conectar_bd();
      
    //Prepara la consulta
    $dml = 'UPDATE ProgramaAtencionBeneficiaria SET activo='."0".' 
    WHERE idProgramaAtencionBeneficiaria=(?) ';
    if ( !($statement = $conexion_bd->prepare($dml)) ) {
        die("Error: (" . $conexion_bd->errno . ") " . $conexion_bd->error);
        return 0;
    }
      
    //Unir los parámetros de la función con los parámetros de la consulta   
    //El primer argumento de bind_param es el formato de cada parámetro
    if (!$statement->bind_param("s",$programa_id)) {
        die("Error en vinculación: (" . $statement->errno . ") " . $statement->error);
        return 0;
    }
      
    //Executar la consulta
    if (!$statement->execute()) {
      die("Error en ejecución: (" . $statement->errno . ") " . $statement->error);
        return 0;
    }
    
    cerrar_bd($conexion_bd);
      return 1;
  }

  function delExpedienteById($id){
    
    $conexion_bd = conectar_bd();
      
    //Prepara la consulta
    $dml = 'UPDATE Beneficiaria SET activo='."0".'  WHERE idDeIngreso=(?)';
    if ( !($statement = $conexion_bd->prepare($dml)) ) {
        die("Error: (" . $conexion_bd->errno . ") " . $conexion_bd->error);
        return 0;
    }
      
    //Unir los parámetros de la función con los parámetros de la consulta   
    //El primer argumento de bind_param es el formato de cada parámetro
    if (!$statement->bind_param("i", $id)) {
        die("Error en vinculación: (" . $statement->errno . ") " . $statement->error);
        return 0;
    }
      
    //Executar la consulta
    if (!$statement->execute()) {
      die("Error en ejecución: (" . $statement->errno . ") " . $statement->error);
        return 0;
    }

   
    cerrar_bd($conexion_bd);
      return 1;
  }

function selectEstados($id){
  $con = conectar_bd();
  
  $sql = "SELECT idEstado as id, nombre FROM Estado";
  
  $result = mysqli_query($con, $sql);
  $select = "";
  
  if(mysqli_num_rows($result)){
      $select .= "<select name=\"Estado\" id=\"Estado\" required >";
      if($id == ""){
          $select .= "<option value=\"\" disabled selected >Elija un Estado</option>";
      }
      while($row = mysqli_fetch_assoc($result)){   
          $select .= '<option ';
          if($id != ""){
              if($id == $row["id"]){
                  $select .= ' selected ';
              }
          }
          $select .= 'value="'.$row["id"].'">'.$row["nombre"].'</option>';
      }
      $select .= "</select>";
  }
  mysqli_free_result($result); //Liberar la memoria
  cerrar_bd($con);
  
  return $select;
}

function selectCanalizadores($id){
  $con = conectar_bd();
  
  $sql = "SELECT idCanalizador as id, nombre FROM Canalizador where Canalizador.activo=1";
  
    $result = mysqli_query($con, $sql);
    $select = "";
    
    if(mysqli_num_rows($result)){
        $select .= "<select name=\"Canalizador\" id=\"Canalizador\" required >";
        if($id == ""){
            $select .= "<option value=\"\" disabled selected >Elija un canalizador</option>";
        }
        while($row = mysqli_fetch_assoc($result)){   
            $select .= '<option ';
            if($id != ""){
                if($id == $row["id"]){
                    $select .= ' selected ';
                }
            }
            $select .= 'value="'.$row["id"].'">'.$row["nombre"].'</option>"';
        }
        $select .= "</select>";
    }
    mysqli_free_result($result); //Liberar la memoria
    cerrar_bd($con);
    
    return $select;
}

function selectInstitucion(){
  $con = conectar_bd();
  
  $sql = "SELECT idInstitucion as id, nombre FROM Institucion where Institucion.activo=1";
  
  $result = mysqli_query($con, $sql);
  $select = "";
  
  if(mysqli_num_rows($result)){
      $select .= "<select name=\"institucion\" id=\"institucion\" required >";
      $select .= "<option value=\"\" disabled selected >Elija una Institucion</option>";
      
      while($row = mysqli_fetch_assoc($result)){   
          $select .= '<option ';
          $select .= 'value="'.$row["id"].'">'.$row["nombre"].'</option>';
      }
      $select .= "</select>";
  }
  mysqli_free_result($result); //Liberar la memoria
  cerrar_bd($con);
  
  return $select;
}

function selectSangre(){

  $con = conectar_bd();
   $id=""; 
    
  $sql = "SELECT idTipoSangre as id, Nombre FROM TipoDeSangre";
    $result = mysqli_query($con, $sql);
    $select = "";
    
    if(mysqli_num_rows($result)){
        $select .= "<select name=\"Sangre\" id=\"Sangre\" required >";
        if($id == ""){
            $select .= "<option value=\"\" disabled selected >Elija un tipo de sangre</option>";
        }
        while($row = mysqli_fetch_assoc($result)){   
            $select .= '<option ';
            if($id != ""){
                if($id == $row["id"]){
                    $select .= ' selected ';
                }
            }
            $select .= 'value="'.$row["id"].'">'.$row["Nombre"].'</option>"';
        }
        $select .= "</select>";
    }

    mysqli_free_result($result); //Liberar la memoria
    cerrar_bd($con);
    
    return $select;
}

function selectSangre1($id=""){

  $con = conectar_bd();
    
  $sql = "SELECT idTipoSangre as id, Nombre FROM TipoDeSangre";
    $result = mysqli_query($con, $sql);
    $select = "";
    
    if(mysqli_num_rows($result)){
        $select .= "<select name=\"Sangre\" id=\"Sangre\" required >";
        if($id == ""){
            $select .= "<option value=\"\" disabled selected >Elija un tipo de sangre</option>";
        }
        while($row = mysqli_fetch_assoc($result)){   
            $select .= '<option ';
            if($id != ""){
                if($id == $row["id"]){
                    $select .= ' selected ';
                }
            }
            $select .= 'value="'.$row["id"].'">'.$row["Nombre"].'</option>"';
        }
        $select .= "</select>";
    }

    mysqli_free_result($result); //Liberar la memoria
    cerrar_bd($con);
    
    return $select;
}


function selectMedicamentos($id){
  $con = conectar_bd();
  
  $sql = "SELECT idMedicamento as id, nombre FROM Medicamentos Where Medicamentos.activo=1";
  
  $result = mysqli_query($con, $sql);
  $select = "";
  
  if(mysqli_num_rows($result)){
      $select .= "<select name=\"medicamento\" id=\"medicamento\" required >";
  
      $select .= "<option value=\"\" disabled selected >Elija un medicamento</option>";

      while($row = mysqli_fetch_assoc($result)){   
          $select .= '<option ';
          if($id != ""){
            if($id == $row["id"]){
                $select .= ' selected ';
            }
        }
          $select .= 'value="'.$row["id"].'">'.$row["nombre"].'</option>"';
      }
      $select .= "</select>";
  }
  mysqli_free_result($result);
  cerrar_bd($con);
  
  return $select;
}




function selectCoordinacioness($id){
    $con = conectar_bd();
    
    $sql = "SELECT idCoordinaciones as id, nombre FROM Coordinaciones Where Coordinaciones.activo=1 ";
    
    $result = mysqli_query($con, $sql);
    $select = "";
    
    if(mysqli_num_rows($result)){
        $select .= "<select name=\"Coordinacioness\" id=\"Coordinacioness\" required >";
        if($id == ""){
            $select .= "<option value=\"\" disabled selected >Elija un Coordinaciones</option>";
        }
        while($row = mysqli_fetch_assoc($result)){   
            $select .= '<option ';
            if($id != ""){
                if($id == $row["id"]){
                    $select .= ' selected ';
                }
            }
            $select .= 'value="'.$row["id"].'">'.$row["nombre"].'</option>"';
        }
        $select .= "</select>";
    }
    cerrar_bd($con);
    
    return $select;
}
function altaVinculacionPrograma($ingreso_id,$programa,$fechaR, $observaciones, $motivo){
  $activo = "1";
  $conexion_bd = conectar_bd();
    
  //Prepara la consulta
  $dml = 'INSERT INTO ProgramaAtencionBeneficiaria (idDeIngreso,idProgramaAtencion,fechaRegistro,observaciones,motivo,activo) 
  VALUES (?,?,?,?,?,?)';
  if ( !($statement = $conexion_bd->prepare($dml)) ) {
      die("Error: (" . $conexion_bd->errno . ") " . $conexion_bd->error);
      return 0;
  }
    
  //Unir los parámetros de la función con los parámetros de la consulta   
  //El primer argumento de bind_param es el formato de cada parámetro
  if (!$statement->bind_param("ssssss",$ingreso_id,$programa,$fechaR, $observaciones, $motivo, $activo)) {
      die("Error en vinculación: (" . $statement->errno . ") " . $statement->error);
      return 0;
  }
    
  //Executar la consulta
  if (!$statement->execute()) {
    die("Error en ejecución: (" . $statement->errno . ") " . $statement->error);
      return 0;
  }

  cerrar_bd($conexion_bd);
    return 1;
}


function altaExpediente($sangre, $estado,  $ciudad, $fechahora, $nombre, $apellidoMaterno,  $apellidoPaterno, $fechaN, $curp, $nExpediente, $hermanos,$motivoI,$nDisposicion,$consideraciones,$idcanalizador){
  $activo = "1";
  $conexion_bd = conectar_bd();
    
  //Prepara la consulta
  $dml = 'INSERT INTO Beneficiaria (idTipoSangre,idEstado,ciudad,fechaHoraIngreso,nombre,apellidoM,apellidoP,fechaNacimiento,curp,noDeExpediente,ingresoConHermanos,motivoIngreso,noDisposicion,consideracionesGenerales,activo) 
  VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?) ';
  if ( !($statement = $conexion_bd->prepare($dml)) ) {
      die("Error: (" . $conexion_bd->errno . ") " . $conexion_bd->error);
      return 0;
  }
    
  //Unir los parámetros de la función con los parámetros de la consulta   
  //El primer argumento de bind_param es el formato de cada parámetro
  if (!$statement->bind_param("sssssssssssssss",$sangre, $estado,  $ciudad, $fechahora, $nombre, $apellidoMaterno,  $apellidoPaterno, $fechaN, $curp, $nExpediente, $hermanos,$motivoI,$nDisposicion,$consideraciones, $activo)) {
      die("Error en vinculación: (" . $statement->errno . ") " . $statement->error);
      return 0;
  }
    
  //Executar la consulta
  if (!$statement->execute()) {
    die("Error en ejecución: (" . $statement->errno . ") " . $statement->error);
      return 0;
  }

  cerrar_bd($conexion_bd);
    return 1;
}


function altaPrograma($idCoordinaciones, $nombre, $fechaI, $fechaF, $objetivo){
    $activo = "1";
    $conexion_bd = conectar_bd();
      
    //Prepara la consulta
    $dml = 'INSERT INTO ProgramaAtencion (idCoordinaciones,nombre,fechaInicial,fechaFinal,objetivo,activo) VALUES (?,?,?,?,?,?)';
    if ( !($statement = $conexion_bd->prepare($dml)) ) {
        die("Error: (" . $conexion_bd->errno . ") " . $conexion_bd->error);
        return 0;
    }
      
    //Unir los parámetros de la función con los parámetros de la consulta   
    //El primer argumento de bind_param es el formato de cada parámetro
    if (!$statement->bind_param("ssssss",$idCoordinaciones,$nombre, $fechaI, $fechaF, $objetivo, $activo)) {
        die("Error en vinculación: (" . $statement->errno . ") " . $statement->error);
        return 0;
    }
      
    //Executar la consulta
    if (!$statement->execute()) {
      die("Error en ejecución: (" . $statement->errno . ") " . $statement->error);
        return 0;
    }

    cerrar_bd($conexion_bd);
      return 1;
}

function altaReceta($idbeneficiaria, $idmedicamento, $fechaI, $fechaF, $indicaciones,$dosis){
  $activo = "1";
  $conexion_bd = conectar_bd();
    
  //Prepara la consulta
  $dml = 'INSERT INTO Receta (`idDeIngreso`,`idMedicamento`,`fechaIni`,`fechaFin`,`descripcion`,`dosis`,`activo`) 
  VALUES (?,?,?,?,?,?,?)';
  if ( !($statement = $conexion_bd->prepare($dml)) ) {
      die("Error: (" . $conexion_bd->errno . ") " . $conexion_bd->error);
      return 0;
  }
    
  //Unir los parámetros de la función con los parámetros de la consulta   
  //El primer argumento de bind_param es el formato de cada parámetro
  if (!$statement->bind_param("sssssss",$idbeneficiaria,$idmedicamento, $fechaI, $fechaF, $indicaciones,$dosis, $activo)) {
      die("Error en vinculación: (" . $statement->errno . ") " . $statement->error);
      return 0;
  }
    
  //Executar la consulta
  if (!$statement->execute()) {
    die("Error en ejecución: (" . $statement->errno . ") " . $statement->error);
      return 0;
  }

  cerrar_bd($conexion_bd);
    return 1;
}


function ProgramasEdit($id){
    $con = conectar_bd();
    
    $sql = "SELECT  p.idCoordinaciones as idA ,p.idProgramaAtencion as idP, p.nombre as NombreP,a.nombre as NombreA,fechaInicial as fechaI, fechaFinal as fechaF, p.objetivo as objetivo
    FROM ProgramaAtencion as p, Coordinaciones as a where p.idCoordinaciones = a.idCoordinaciones";
    $sql .= " AND p.idProgramaAtencion = '$id'";

    $result = mysqli_query($con, $sql);
    $resultado = "";
    
    
    while($row = mysqli_fetch_assoc($result)){
        $resultado .= "<br>
<div class=\"card teal lighten-2\">
    <div class=\"card-content teal lighten-3\">
        <div class=\" center\" data-indicators=\"true\">
            <div class=\" teal lighten-5 \" href=\"#one!\" >
                    <form action=\"Controladores\Programa\controladorEditarPrograma.php\" method=\"POST\">
                        <!-- Elemento -->
                        <div class=\"file-field input-field\">
                            <div class=\"input-field col s6 l6\">
                                <i class=\"material-icons prefix\"> </i>
                                <input name=\"nombre\" type=\"text\" class=\"validate\" value=\"".$row["NombreP"]."\" required>
                                <label for=\"rol\"><strong>Nombre del Programa</strong></label>     
                            </div>
                        </div>
                        <div class=\"file-field input-field\">
                            <div class=\"input-field col s6 l6\">";
                                $resultado .= selectCoordinacioness($row["idA"]);
                                $resultado .= "<label for=\"rol\"><strong>Coordinaciones del Programa</strong></label>
                            </div>
                        </div>
                        <div class=\"row\">
                            <div class=\"file-field input-field\">
                                <div class=\"input-field col s6 l6\">
                                    <i class=\"material-icons prefix\"> </i>
                                    <input required id=\"fechaI\" type=\"date\" name=\"fechaI\" value=\"".date('Y-m-d',strtotime($row["fechaI"]))."\">
                                    <label for=\"rol\"><strong>Fecha de Inicio:</strong></label>     
                                </div>
                            </div>
                            <div class=\"file-field input-field\">
                                <div class=\"input-field col s6 l6\">
                                    <i class=\"material-icons prefix\"> </i>
                                    <input required id=\"fechaF\" type=\"date\" name=\"fechaF\" value=\"".date('Y-m-d',strtotime($row["fechaF"]))."\">
                                    <label for=\"rol\"><strong>Fecha de Termino:</strong></label>     
                                </div>
                            </div>
                        </div>
                        <div class=\"row\">
                        <div class=\"file-field input-field\">
                            <div class=\"input-field col s12 l12\">
                                <i class=\"material-icons prefix\"> </i>
                                <textarea required id=\"objetivo\" type=\"text\" name=\"objetivo\" placeholder=\"Ej. Lograr un nivel apto de lecturas para menores de 10 años\" type=\"text\" class=\"materialize-textarea\"
                                >".$row["objetivo"]."</textarea>
                                <label for=\"rol\"><strong>Objetivo del Programa</strong></label>     
                            </div>
                        </div>
                        </div>
                        <div class=\"row\">
                        <div class=\"file-field input-field\">
                            <div class=\"input-field col s12 l12 left\">
                                <button id=\"testFormPrograma\" class=\"waves-effect waves-light btn right\" type=\"submit\" name=\"action\">Registrar
                                <i class=\"material-icons right\">add</i>
                                </button>
                                <a id=\"confirmarEliminarPrograma\" href=\"consultaPrograma.php\" class=\"waves-effect green lighten-3 btn right\">Volver<i class=\"material-icons right\">undo</i>
                                </a>
                            </div>
                        </div>
                        </div>
                    </form>
            </div>
        </div>
    </div>
</div>";
    }

    cerrar_bd($con);
    
    return $resultado;
}

function BeneficiariaEdit($id){
  $con = conectar_bd();
  
  $sql = "SELECT *
  from Beneficiaria
  where idDeIngreso = '$id'";
  

  $result = mysqli_query($con, $sql);
  $resultado = "";
  
  
  while($row = mysqli_fetch_assoc($result)){
      $resultado .= "
      <div class='card teal lighten-2'>
      <div class='card-content teal lighten-3'>
        <div class=' center' data-indicators='true'>
            <form id='regForm' action=\"Controladores\Expediente\controladorEditarExpediente.php\" method='post'>
              <div  class='teal lighten-5' >


              <div class='tab'>
              <h4>Datos de la beneficiaria</h4>
                <div class='row'>
                <div class=\"col s12\">
                <!-- Elemento -->
                <div class=\"file-field input-field\">
                  <div class=\"input-field col s12\">
                    <i class=\"material-icons prefix\"> </i>
                    <input type=\"date\" name=\"fecha\" value=\"".date("Y-m-d", strtotime($row["fechaHoraIngreso"]))."\" >
                    <label for=\"rol\"><strong>Fecha de ingreso:</strong></label>     
                  </div>
                </div>
                <!-- Elemento -->
                <div class=\"file-field input-field\">
                  <div class=\"input-field col s12\">
                    <i class=\"material-icons prefix\"> </i>
                    <input type=\"time\" name=\"hora\" value=\"".date("h:i", strtotime($row["fechaHoraIngreso"]))."\">
                    <label for=\"rol\"><strong>Hora de ingreso</strong></label>     
                  </div>
                </div>
                <!-- Elemento -->
                <div class=\"file-field input-field\">
                  <div class=\"input-field col s12\">
                    <i class=\"material-icons prefix\"> </i>
                    <input placeholder=\"Maria\" type=\"text\"  name=\"nombre\" value=\"".$row["nombre"]."\">
                    <label for=\"rol\"><strong>Nombre</strong></label>     
                  </div>
                </div>
                <!-- Elemento -->
                <div class=\"file-field input-field\">
                  <div class=\"input-field col s12\">
                    <i class=\"material-icons prefix\"> </i>
                    <input placeholder=\"Garcia\" type=\"text\"  name=\"apellidoPaterno\" value=\"".$row["apellidoP"]."\" >
                    <label for=\"rol\"><strong>Apellido Paterno</strong></label>     
                </div>
                </div>
                <!-- Elemento -->
                <div class=\"file-field input-field\">
                  <div class=\"input-field col s12\">
                    <i class=\"material-icons prefix\"> </i>
                    <input placeholder=\"Perez\" type=\"text\"  name=\"apellidoMaterno\" value=\"".$row["apellidoM"]."\">
                    <label for=\"rol\"><strong>Apellido Materno</strong></label>     
                </div>
                </div>
            </div>

                </div>
              </div>


              <div class='tab'>
              <h4>Datos de la beneficiaria</h4>
                <div class='row'>
                <div class=\"col s12\">
                <!-- Elemento -->
                <div class=\"file-field input-field\">
                  <div class=\"input-field col s12\">
                    <i class=\"material-icons prefix\"> </i>
                    <input type=\"date\" oninput=\"this.className = ''\" name=\"fechaN\" value=\"".date("Y-m-d", strtotime($row["fechaNacimiento"]))."\">
                    <label class=\"formato2\" for=\"rol\"><strong>Fecha de nacimiento:</strong></label>     
                </div>
                </div>
        
                <!-- Elemento -->
                <div class=\"file-field input-field\">
                  <div class=\"input-field col s12\">
                    <i class=\"material-icons prefix\"> </i>";
                    
                    $resultado .= selectEstados($row["idEstado"]);
                    
                    $resultado .= " <label for=\"rol\"><strong>Estado</strong></label>     
                </div>
                </div>
                <!-- Elemento -->
                <div class=\"file-field input-field\">
                  <div class=\"input-field col s12\">
                    <i class=\"material-icons prefix\"> </i>
                    <input placeholder=\"Huatabampo\" oninput=\"this.className = ''\" name=\"ciudad\" type=\"text\" value=\"".$row["ciudad"]."\">
                    <label class=\"formato2\" for=\"rol\"><strong>Ciudad</strong></label>     
                </div>
                </div>
                <!-- Elemento -->
                <div class=\"file-field input-field\">
                  <div class=\"input-field col s12\">
                    <i class=\"material-icons prefix\"> </i>
                    <input placeholder=\"SAGR980910HSRNLL19\"  oninput=\"this.className = ''\" name=\"curp\" type=\"text\" value=\"".$row["curp"]."\">
                    <label for=\"rol\"><strong>CURP</strong></label>     
                </div>
                </div>
              
              </div>

                </div>
              </div>





              <div class='tab'>
              <h4>Datos de la beneficiaria</h4>
                <div class='row'>
                <div class=\"col s12\">
                <!-- Elemento -->
                <div class=\"file-field input-field\">
                  <div class=\"input-field col s12\">
                    <i class=\"material-icons prefix\"> </i>
                    <input placeholder=\"-\" oninput=\"this.className = ''\" name=\"nExpediente\" type=\"text\" value=\"".$row["noDeExpediente"]."\">
                    <label for=\"rol\"><strong>Número de expediente y/o carpeta de investiación</strong></label>     
                  </div>
                </div>
                <!-- Elemento -->
                <div class=\"file-field input-field\">
                  <div class=\"input-field col s6\">
                    <i class=\"material-icons prefix\"> </i>
                    <select name=\"hermanos\" id=\"\">
                      <option value=\"\">Seleccione (Sí/No)</option>";
                      if($row["ingresoConHermanos"] == 1){
                        $resultado .="
                      <option value=\"1\" selected>Sí</option>
                      <option value=\"0\">No</option>
                    </select>";
                      }else{
                        $resultado .="
                      <option value=\"1\">Sí</option>
                      <option value=\"0\" selected>No</option>
                    </select>";
                      }
                      $resultado .="<label for=\"rol\"><strong>Ingreso con hermanos</strong></label>     
                  </div>
                </div>
                <div class=\"file-field input-field\">
                  <div class=\"input-field col s6\">
                    <i class=\"material-icons prefix\"> </i>";
    
                    $resultado .= selectSangre1($row["idTipoSangre"]);
                    
                    $resultado .= "      
                    <label for=\"rol\"><strong>Tipo de sangre</strong></label>     
                  </div>
                </div>
                  <!-- Elemento -->
                  <div class=\"file-field input-field\">
                    <div class=\"input-field col s12\">
                      <i class=\"material-icons prefix\"> </i>
                      <input placeholder=\"-\" oninput=\"this.className = ''\" name=\"nDisposicion\" type=\"text\" value=\"".$row["noDisposicion"]."\">
                      <label for=\"rol\"><strong>No. Oficio Disposición</strong></label>     
                    </div>
                  </div>
                  
                </div>
                </div>
              </div>


            <div class='tab'>
            <h4>Datos de la beneficiaria</h4>

              <div class='row'>
              <div class=\"col s12\">
              <!-- Elemento -->
              <div class=\"file-field input-field\">
                <div class=\"input-field col s12\">
                  <i class=\"material-icons prefix\"> </i>
                  <textarea name=\"motivoI\" type=\"text\" class=\"materialize-textarea\" placeholder=\"Se presentaron problemas donde la menor...\" oninput=\"this.className = ''\" name=\"situacionJ\">".$row["motivoIngreso"]."</textarea>
                  <label for=\"rol\"><strong>Motivo de ingreso</strong></label> 
                </div>
              </div>
              <div class=\"file-field input-field\">
                <div class=\"input-field col s12\">
                  <i class=\"material-icons prefix\"> </i>
                  <textarea name=\"consideraciones\" type=\"text\" class=\"materialize-textarea\" placeholder=\"Se muestra de una manera donde\" oninput=\"this.className = ''\" name=\"situacionJ\">".$row["motivoIngreso"]."</textarea>
                  <label for=\"rol\"><strong>Consideraciones Generales</strong></label> 
                </div>

              </div>
            </div>
              </div>
            </div>

              <div style='overflow:auto;'>
                <div style='float:right;'>
                  <a type='button' id='volverBtn' href='expedientes.php' class='waves-effect green lighten-3 btn '>Volver<i class='material-icons right'>undo</i></a>
                  <button type='button' class='waves-effect green lighten-3 btn ' id='prevBtn' onclick='nextPrev(-1)'>Previo<i class='material-icons right'>arrow_back</i></button>
                  <button type='button' class='waves-effect waves-light btn ' id='nextBtn' onclick='nextPrev(1)'>Siguiente</button>
                </div>
              </div>
              <!-- Circles which indicates the steps of the form: -->
              <div style='text-align:center;margin-top:40px;'>
                <span class='step'></span>
                <span class='step'></span>
                <span class='step'></span>
                <span class='step'></span>
              </div>
            </form>
        </div>
      </div>
    </div> 

              
                  ";
  }

  cerrar_bd($con);
  
  return $resultado;
}


function RecetaEdit($id,$ingreso_id){
  $con = conectar_bd();
  
  $sql = "SELECT r.*,b.Nombre as nombreB, b.apellidoP, b.apellidoM,m.nombre as med
  from Receta as r, Beneficiaria as b, Medicamentos as m
  where r.idDeIngreso = b.idDeIngreso
  and m.idMedicamento = r.idMedicamento";
  $sql .= " AND idReceta = '$id'";

  $result = mysqli_query($con, $sql);
  $resultado = "";
  
  
  while($row = mysqli_fetch_assoc($result)){
      $resultado .= "<br>
      <div class=\"card teal lighten-2\">
      <div class=\"card-content teal lighten-3\">
      <div class=\" center\ data-indicators=\"true\">
        
        
        <form action=\"Controladores\Receta\controladorEditarReceta.php\" method=\"POST\">
        <div class=\" teal lighten-5\" href=\"#one!\" >
        <div class='row'>
          <div class=\"col s12 align-center\">

              <div class=\"file-field input-field\">
                <div class=\"input-field col s12\">
                  <i class=\"material-icons prefix\"> </i>
                  ".selectMedicamentos($row["idMedicamento"])."
                  <label for=\"rol\"><strong>Medicamento</strong></label>     
              </div>
              </div>
              </div>
              <div class=\"row\">
              <div class=\"file-field input-field\">
                <div class=\"input-field col s6\">
                  <i class=\"material-icons prefix\"> </i>
                  <input type=\"date\" name=\"fechaI\" value=\"".date('Y-m-d',strtotime($row["fechaIni"]))."\">
                  <label for=\"rol\"><strong>Fecha de Inicio:</strong></label>     
              </div>
              </div>
              <div class=\"file-field input-field\">
                <div class=\"input-field col s6\">
                  <i class=\"material-icons prefix\"> </i>
                  <input type=\"date\" name=\"fechaF\" value=\"".date('Y-m-d',strtotime($row["fechaFin"]))."\">
                  <label for=\"rol\"><strong>Fecha de Termino:</strong></label>     
              </div>
              </div>
              </div>
              <div class=\"row\">
                <div class=\"file-field input-field\">
                  <div class=\"input-field col s6\">
                    <i class=\"material-icons prefix\"> </i>
                    <input placeholder=\"Indicaciones\" value=\"".$row["descripcion"]."\" name=\"indicaciones\" type=\"text\" class=\"validate\">
                    <label for=\"rol\"><strong>Indicaciones</strong></label>     
                </div>
                </div>
                <div class=\"file-field input-field\">
                  <div class=\"input-field col s6\">
                    <i class=\"material-icons prefix\"> </i>
                    <input placeholder=\"Ej. 500 mg\" value=\"".$row["dosis"]."\" name=\"dosis\" type=\"text\" class=\"validate\">
                    <label for=\"rol\"><strong>Dosis</strong></label>     
                </div>
                </div>
                </div>
              <div class=\"file-field input-field\">
                <div class=\"input-field col s12 l12 left\">
                  <button title=\"Confirmar editar receta\" class=\"waves-effect waves-light btn right\" type=\"submit\" name=\"action\">Registrar
                    <i class=\"material-icons right\">add</i>
                  </button>
                  <a title=\"volver\" id=\"\" href=\"./consultarRecetas.php?ingreso_id=".$ingreso_id."\" class=\"waves-effect green lighten-3 btn right\">Volver<i class=\"material-icons right\">undo</i>
                    </a>
              </div>
              </div>
              
            
            </div>
      
      
          
        </div>
        
      </form>
      </div>
      </div>
      </div>
      </div>";
  }

  cerrar_bd($con);
  
  return $resultado;
}

function VinculacionEdit($id,$ingreso_id){
  $con = conectar_bd();
  
  $sql = "SELECT * from ProgramaAtencionBeneficiaria as p where p.idDeIngreso = $ingreso_id";
  $sql .= " AND p.idProgramaAtencionBeneficiaria = $id";

  $result = mysqli_query($con, $sql);
  $resultado = "";
  
  
  while($row = mysqli_fetch_assoc($result)){
      $resultado .= "
      <br>
      <div class=\"card teal lighten-2\">
      <div class=\"card-content teal lighten-3\">
      <div class=\"center\" data-indicators=\"true\">
      
        <div class=\" teal lighten-5 \" href=\"#one!\" >
        <div class='row'>
          <div class=\"col s12 align-center\">
            <form action=\"Controladores\Programa\controladorEditVincularPrograma.php\" method=\"POST\">
              <!-- Elemento -->
              <div class=\"file-field input-field\">
                <div class=\"input-field col s12 l12\">
                  <i class=\"material-icons prefix\"> </i>
                  ".selectProgramas($row["idProgramaAtencion"])."
                  <label for=\"rol\"><strong>Nombre del Programa</strong></label>     
              </div>
              </div>
              
              
              <div class=\"row\">
                <div class=\"file-field input-field\">
                  <div class=\"input-field col s6 l6\">
                    <i class=\"material-icons prefix\"> </i>
                    <textarea name=\"motivo\" placeholder=\"Ej. La menor no alancazo el nivel de lectura...\" type=\"text\" class=\"materialize-textarea\" required>".$row["motivo"]."</textarea>
                    <label for=\"rol\"><strong>Motivo para ingreso al programa:</strong></label>     
                </div>
                </div>
                <div class=\"file-field input-field\">
                  <div class=\"input-field col s6 l6\">
                    <i class=\"material-icons prefix\"> </i>
                    <textarea type=\"text\" name=\"observaciones\" placeholder=\"Ej. Se observó problemas de habla al momento de...\" type=\"text\" class=\"materialize-textarea\">".$row["observaciones"]."</textarea>
                    <label for=\"rol\"><strong>Observaciones sobre la menor:</strong></label>     
                </div>
                </div>
                </div>
              <div class=\"file-field input-field\">
                <div class=\"input-field col s12 l12\">
                  <i class=\"material-icons prefix\"> </i>
                  <input type=\"date\" name=\"fechaR\" required value=\"".date('Y-m-d',strtotime($row["fechaRegistro"]))."\">
                  <label for=\"rol\"><strong>Fecha de registro en el programa:</strong></label>     
              </div>
              </div>
              
              <div class=\"file-field input-field\">
                <div class=\"input-field col s12 l12 left\">
                  <button id=\"test\" class=\"waves-effect waves-light btn right\" type=\"submit\" name=\"action\">Registrar
                    <i class=\"material-icons right\">add</i>
                  </button>
                  <a title=\"volver\" id=\"\" href=\"./consultarProgramas.php?ingreso_id=$ingreso_id\"         
                  class=\"waves-effect green lighten-3 btn right\">Volver<i class=\"material-icons right\">undo</i></a>
                  
              </div>
              </div>
            </form>
            </div>
        </div>
        </div>
      </div>
      </div>
      </div>";
  }

  cerrar_bd($con);
  
  return $resultado;
}


function VinculacionDelete($id,$ingreso_id){
  $con = conectar_bd();
  
  $sql = "SELECT pb.*,p.nombre as nombreP
  from ProgramaAtencionBeneficiaria as pb,ProgramaAtencion as p
  where p.idProgramaAtencion = pb.idProgramaAtencion";
  $sql .= " AND pb.idProgramaAtencionBeneficiaria = '$id'";

  $result = mysqli_query($con, $sql);
  $resultado = "";
  
  
  while($row = mysqli_fetch_assoc($result)){
      $resultado .= "
      <br>
      <div class=\"card teal lighten-2\">
      <div class=\"card-content teal lighten-3\">
      <div class=\" center\" data-indicators=\"true\">

        <div class=\" teal lighten-5 \" href=\"#one!\" >
        <div class='row'>
          <div class=\"col s12 align-center\">
              <!-- Elemento -->
              <div class=\"file-field input-field\">
                <div class=\"input-field col s12 l12\">
                  <i class=\"material-icons prefix\"> </i>
                  "."<input type=\"text\" disabled value=\"".$row["nombreP"]."\">"."
                  <label for=\"rol\"><strong>Nombre del Programa</strong></label>     
              </div>
              </div>
              
              
              <div class=\"row\">
                <div class=\"file-field input-field\">
                  <div class=\"input-field col s6 l6\">
                    <i class=\"material-icons prefix\"> </i>
                    <textarea disabled name=\"motivo\" placeholder=\"Ej. La menor no alancazo el nivel de lectura...\" type=\"text\" class=\"materialize-textarea\" required>".$row["motivo"]."</textarea>
                    <label for=\"rol\"><strong>Motivo para ingreso al programa:</strong></label>     
                </div>
                </div>
                <div class=\"file-field input-field\">
                  <div class=\"input-field col s6 l6\">
                    <i class=\"material-icons prefix\"> </i>
                    <textarea disabled type=\"text\" name=\"observaciones\" placeholder=\"Ej. Se observó problemas de habla al momento de...\" type=\"text\" class=\"materialize-textarea\">".$row["observaciones"]."</textarea>
                    <label for=\"rol\"><strong>Observaciones sobre la menor:</strong></label>     
                </div>
                </div>
                </div>
              <div class=\"file-field input-field\">
                <div class=\"input-field col s12 l12\">
                  <i class=\"material-icons prefix\"> </i>
                  <input disabled type=\"date\" name=\"fechaR\" required value=\"".date('Y-m-d',strtotime($row["fechaRegistro"]))."\">
                  <label for=\"rol\"><strong>Fecha de registro en el programa:</strong></label>     
              </div>
              </div>
              
              <div class=\"file-field input-field\">
                <div class=\"input-field col s12 l12 left\">
                <a id=\"confirmarEliminarPrograma\" href=\"Controladores\Programa\controladorEliminarVinculacion.php?programa_id=$id\" class=\"waves-effect red deep-orange darken-4 btn right\">eliminar
                <i class=\"material-icons right\">remove</i>
              </a>
                  <a title=\"volver\" id=\"\" href=\"./consultarProgramas.php?ingreso_id=$ingreso_id\"         
                  class=\"waves-effect green lighten-3 btn right\">Volver<i class=\"material-icons right\">undo</i></a>
                  
              </div>
              </div>
            </div>
        </div>
        <!--  PANELES SIGUIENTES PARA USARSE EN LOS IGUIENTES FORMULARIOS DE SER NECESARIO UNU
        <div class=\"carousel-item amber white-text\" href=\"#two!\">
            <h2>2 Second Panel</h2>
            <p class=\"white-text\">This is your second panel</p>
        </div>
        <div class=\"carousel-item green white-text\" href=\"#three!\">
            <h2> 3 Third Panel</h2>
            <p class=\"white-text\">This is your third panel</p>
        </div>
        <div class=\"carousel-item blue white-text\" href=\"#four!\">
            <h2> 4 Fourth Panel</h2>
            <p class=\"white-text\">This is your fourth panel</p>
        </div>
        -->
      </div>
      </div>
      </div>
      </div>";
  }

  cerrar_bd($con);
  
  return $resultado;
}


function editaPrograma($idP,$idCoordinaciones, $nombre, $fechaI, $fechaF, $objetivo){
    $activo = "1";
    $conexion_bd = conectar_bd();
      
    //Prepara la consulta
    $dml = 'UPDATE  ProgramaAtencion 
    SET idCoordinaciones=(?),nombre=(?),fechaInicial=(?),fechaFinal=(?),objetivo=(?),activo=(?) 
    WHERE idProgramaAtencion=(?)';
    
    if ( !($statement = $conexion_bd->prepare($dml)) ) {
        die("Error: (" . $conexion_bd->errno . ") " . $conexion_bd->error);
        return 0;
    }
      
    //Unir los parámetros de la función con los parámetros de la consulta   
    //El primer argumento de bind_param es el formato de cada parámetro
    if (!$statement->bind_param("sssssss",$idCoordinaciones,$nombre, $fechaI, $fechaF, $objetivo, $activo,$idP)) {
        die("Error en vinculación: (" . $statement->errno . ") " . $statement->error);
        return 0;
    }
      
    //Executar la consulta
    if (!$statement->execute()) {
      die("Error en ejecución: (" . $statement->errno . ") " . $statement->error);
        return 0;
    }

    cerrar_bd($conexion_bd);
      return 1;
}

function editaReceta($idbeneficiaria, $idmedicamento, $fechaI, $fechaF, $indicaciones,$dosis,$idR){
  $activo = "1";
  $conexion_bd = conectar_bd();
    
  //Prepara la consulta
  $dml = 'UPDATE  Receta 
  SET idDeIngreso=(?),idMedicamento=(?),fechaIni=(?),fechaFin=(?),descripcion=(?),dosis=(?),activo=(?) 
  WHERE idReceta=(?)';
  
  if ( !($statement = $conexion_bd->prepare($dml)) ) {
      die("Error: (" . $conexion_bd->errno . ") " . $conexion_bd->error);
      return 0;
  }
    
  //Unir los parámetros de la función con los parámetros de la consulta   
  //El primer argumento de bind_param es el formato de cada parámetro
  if (!$statement->bind_param("ssssssss",$idbeneficiaria, $idmedicamento, $fechaI, $fechaF, $indicaciones,$dosis,$activo,$idR)) {
      die("Error en vinculación: (" . $statement->errno . ") " . $statement->error);
      return 0;
  }
    
  //Executar la consulta
  if (!$statement->execute()) {
    die("Error en ejecución: (" . $statement->errno . ") " . $statement->error);
      return 0;
  }

  cerrar_bd($conexion_bd);
    return 1;
}


function editVinculacionPrograma($id,$programa,$fechaR, $observaciones, $motivo){
  $activo = "1";
  $conexion_bd = conectar_bd();
    
  //Prepara la consulta
  $dml = 'UPDATE  ProgramaAtencionBeneficiaria 
  SET idProgramaAtencion=(?),fechaRegistro=(?),observaciones=(?),motivo=(?),activo=(?) 
  WHERE idProgramaAtencionBeneficiaria=(?) ';
  
  if ( !($statement = $conexion_bd->prepare($dml)) ) {
      die("Error: (" . $conexion_bd->errno . ") " . $conexion_bd->error);
      return 0;
  }
    
  //Unir los parámetros de la función con los parámetros de la consulta   
  //El primer argumento de bind_param es el formato de cada parámetro
  if (!$statement->bind_param("ssssss",$programa,$fechaR, $observaciones, $motivo,$activo, $id)) {
      die("Error en vinculación: (" . $statement->errno . ") " . $statement->error);
      return 0;
  }
    
  //Executar la consulta
  if (!$statement->execute()) {
    die("Error en ejecución: (" . $statement->errno . ") " . $statement->error);
      return 0;
  }

  cerrar_bd($conexion_bd);
    return 1;
}


// InstituciOwOnes Traer Todas las instituciones + Ajax

function getInstituciones($nombre=""){
    $con = conectar_bd();
    
    $sql = "SELECT  i.idInstitucion as idI, i.nombre as NombreI FROM Institucion as i WHERE i.activo=1 ";
    if($nombre != ""){
        $sql .= " and i.nombre LIKE '%".$nombre."%'";
    }
    $result = mysqli_query($con, $sql);
    $tabla = "";
    
    if(mysqli_num_rows($result)){
        $tabla .= "<table class=\"highlight centered\">";
        $tabla .= "<thead><tr><th>Id de institución</th><th>Nombre</th><th colspan='3'>Acción</th></tr></thead>";
        while($row = mysqli_fetch_assoc($result)){   
            $tabla .= "<tr>";
            $tabla .= "<td>". $row["idI"]. "</td>";
            $tabla .= "<td>". $row["NombreI"]. "</td>";

            $tabla .= '<td><a class="waves-effect waves-light btn-small" title="Editar datos de la institucion"  href="editarInstitucion.php?institucion_id='.$row['idI'].'">'."<i class=\"material-icons\">create</i>"."</a>";
            $tabla .= "</td>"; 
            $tabla .= '<td><a class="waves-effect waves-light btn-small" title="Eliminar institucion" href="eliminarInstitucion.php?institucion_id='.$row['idI'].'">'."<i class=\"material-icons\">delete_forever</i>"."</a>";
            $tabla .= "</td>"; 
            $tabla .= "</tr>";
        }
        $tabla .= "</table>";
    }
    cerrar_bd($con);
    
    return $tabla;
}

// Instituciones .::.::::.:::. 

function getInstitucionesByIdC($id){
    $con = conectar_bd();
    
    $sql = "SELECT  i.idInstitucion as idI, i.nombre as NombreI FROM Institucion as i";
    $sql .= " WHERE i.idInstitucion = '$id'";

    $result = mysqli_query($con, $sql);
    $resultado = "";
    
    
    while($row = mysqli_fetch_assoc($result)){
        $resultado .= "<br>
        <div class=\"card teal lighten-2\">
        <div class=\"card-content teal lighten-3\">
        <div class=\"carousel carousel-slider center\" data-indicators=\"true\">
          <div class=\"carousel-item teal lighten-5 \" href=\"#one!\" id=\"carousel-Docs\">
              <h2>Institucion numero #".$row["idI"]."</h2>
            <div class=\"col s12 align-center\">
                <!-- Elemento -->
                <div class=\"file-field input-field\">
                  <div class=\"col s12 m12 l12\">
                    <label>Nombre de la Institucion</label>
                    <p>".$row["NombreI"]."</p>
                </div>
                </div>
                <br>
                <br>
                <br>
                
                <br>
                <div class=\"file-field input-field\">
                  <div class=\"input-field col s12 l12 left\">
                    <a id=\"confirmarEliminarPrograma\" href=\"consultaInstitucion.php\" class=\"waves-effect green lighten-3 btn right\">Regresar<i class=\"material-icons right\">undo</i>
                    </a>
                </div>
                </div>
              </div>
          </div>
        </div>
        </div>
        </div>";
    }

    cerrar_bd($con);
    
    return $resultado;

}

function editInstitucion($id){
    $con = conectar_bd();
    
    $sql = "SELECT  i.idInstitucion as idI, i.nombre as NombreI FROM Institucion as i";
    $sql .= " WHERE i.idInstitucion = '$id'";

    $result = mysqli_query($con, $sql);
    $resultado = "";
    
    
    while($row = mysqli_fetch_assoc($result)){
        $resultado .= "
        <div class=\"card teal lighten-2\">
        <div class=\"card-content teal lighten-3\">
        <div class=\" center\" data-indicators=\"true\">
          <div class=\" teal lighten-5 \" href=\"#one!\"  id=\"carousel-Docs\" >
          <div class='row'>
          <div class=\"col s12 align-center\">
              <form action=\"Controladores\Institucion\controladorEditarInstitucion.php\" method=\"POST\">
                <!-- Elemento -->
                <div class='row'>

                <div class=\"file-field input-field\">
                  <div class=\"input-field col s12 l12\">
                    <i class=\"material-icons prefix\"> </i>
                    <input required name=\"nombre\" type=\"text\" class=\"validate\" value=\"".$row["NombreI"]."\">
                    <label for=\"rol\"><strong>Nombre de la Institucion</strong></label>     
                </div>
                </div>
                </div>
                <div class='row'>

                    
                <div class=\"file-field input-field\">
                <div class=\"input-field col s12 l12 left\">
                        <button class=\"waves-effect waves-light btn right\" type=\"submit\" name=\"action\">Registrar
                            <i class=\"material-icons right\">add</i>
                        </button>
                        <a id=\"confirmarEliminarPrograma\" href=\"consultaInstitucion.php\" class=\"waves-effect green lighten-3 btn right\">Volver<i class=\"material-icons right\">undo</i>
                    </a>
                    </div>
                </div>
                </div>
                </form>
                </div>
                </div>
                </div>
                </div>
                </div>
                </div>";
    }

    cerrar_bd($con);
    
    return $resultado;
}

// Instituciones Modificar

function editaInstitucion($idI, $nombre){
    
    $conexion_bd = conectar_bd();
      
    //Prepara la consulta
    $dml = 'UPDATE  Institucion SET nombre=(?)  WHERE idInstitucion=(?)';
    
    if ( !($statement = $conexion_bd->prepare($dml)) ) {
        die("Error: (" . $conexion_bd->errno . ") " . $conexion_bd->error);
        return 0;
    }
      
    //Unir los parámetros de la función con los parámetros de la consulta   
    //El primer argumento de bind_param es el formato de cada parámetro
    if (!$statement->bind_param("ss",$nombre,$idI)) {
        die("Error en vinculación: (" . $statement->errno . ") " . $statement->error);
        return 0;
    }
      
    //Executar la consulta
    if (!$statement->execute()) {
      die("Error en ejecución: (" . $statement->errno . ") " . $statement->error);
        return 0;
    }

    cerrar_bd($conexion_bd);
      return 1;
}

function getInstitucionesById($id){
    $con = conectar_bd();
    
    $sql = "SELECT  i.idInstitucion as idI, i.nombre as NombreI FROM Institucion as i";
    $sql .= " WHERE i.idInstitucion = '$id'";

    $result = mysqli_query($con, $sql);
    $resultado = "";
    
    
    while($row = mysqli_fetch_assoc($result)){
        $resultado .= "
        <div class=\"card teal lighten-2\">
        <div class=\"card-content teal lighten-3\">
        <div class=\" center\" data-indicators=\"true\">
          <div class=\" teal lighten-5 \" href=\"#one!\" id=\"carousel-Docs\">
          <div class='row'>

          <div class=\"col s12 align-center\">
          <div class='row'>

                <!-- Elemento -->
                <div class=\"file-field input-field\">
                  <div class=\"col s12 m12 l12\">
                    <label>Nombre de la Institucion</label>
                    <p>".$row["NombreI"]."</p>
                </div>
                </div>
                </div>
                <div class='row'>
                <div class=\"file-field input-field\">
                  <div class=\"input-field col s12 l12 left\">
                    <a id=\"confirmarEliminarPrograma\" href=\"Controladores\Institucion\controladorEliminarInstitucion.php?institucion_id=".$id."\" class=\"waves-effect red deep-orange darken-4 btn right\">eliminar
                      <i class=\"material-icons right\">remove</i>
                    </a>
                    <a id=\"\" href=\"consultaInstitucion.php\" class=\"waves-effect green lighten-3 btn right\">Volver<i class=\"material-icons right\">undo</i>
                    </a>

                </div>
                </div>
                </div>
              </div>
          </div>
          </div>
        </div>
        </div>
        </div>";
    }

    cerrar_bd($con);
    
    return $resultado;

}

function delInstitucionById($id){
  
  $conexion_bd = conectar_bd();
  //Prepara la consulta
  $dml = 'UPDATE Institucion SET Institucion.activo=0 WHERE Institucion.idInstitucion=(?)';
  if ( !($statement = $conexion_bd->prepare($dml)) ) {
      die("Error: (" . $conexion_bd->errno . ") " . $conexion_bd->error);
      return 0;
  }
    
  //Unir los parámetros de la función con los parámetros de la consulta   
  //El primer argumento de bind_param es el formato de cada parámetro
  if (!$statement->bind_param("i",$id)) {
      die("Error en vinculación: (" . $statement->errno . ") " . $statement->error);
      return 0;
  }
    
  //Executar la consulta
  if (!$statement->execute()) {
    die("Error en ejecución: (" . $statement->errno . ") " . $statement->error);
      return 0;
  }

  cerrar_bd($conexion_bd);
    return 1;
 
  }

  function altaInstitucion($nombre){
    $conexion_bd = conectar_bd();
      
    //Prepara la consulta
    $dml = 'INSERT INTO Institucion (nombre,activo)  VALUES (?,?)';
    $activo=1;
    if ( !($statement = $conexion_bd->prepare($dml)) ) {
        die("Error: (" . $conexion_bd->errno . ") " . $conexion_bd->error);
        return 0;
    }
      
    //Unir los parámetros de la función con los parámetros de la consulta   
    //El primer argumento de bind_param es el formato de cada parámetro
    if (!$statement->bind_param("ss",$nombre,$activo)) {
        die("Error en vinculación: (" . $statement->errno . ") " . $statement->error);
        return 0;
    }
      
    //Executar la consulta
    if (!$statement->execute()) {
      die("Error en ejecución: (" . $statement->errno . ") " . $statement->error);
        return 0;
    }

    cerrar_bd($conexion_bd);
      return 1;
}
function getEscuelas($nombre=""){
    $con = conectar_bd();
    $sql = "SELECT  E.idEscuela as idE, E.nombre as NombreE , E.correo as correoE, E.direccion as direccionE,  E.director as directorE,  E.telefono as telefonoE   
     FROM Escuela as E Where E.activo = 1";
    if($nombre != ""){
        $sql .= "  and    E.nombre like '%".$nombre."%'";
    }
    $sql .= "  Order by E.nombre ";
    $result = mysqli_query($con, $sql);
    $tabla = "";
    if(mysqli_num_rows($result)){
        $tabla .= "<table class=\"highlight centered\">";
        $tabla .= "<thead><tr><th>Nombre</th><th>Director</th><th>Dirección</th><th colspan='3'>Acción</th></thead>";
        while($row = mysqli_fetch_assoc($result)){   
            $tabla .= "<tr>";
            $tabla .= "<td>". $row["NombreE"]. "</td>";
            $tabla .= "<td>". $row["directorE"]. "</td>";
            $tabla .= "<td>". $row["direccionE"]. "</td>";
            $tabla .= '<td><a class="waves-effect waves-light btn-small" title="Consultar datos de la escuela" href="consultarEscuela.php?escuela_id='.$row['idE'].'">'."<i class=\"material-icons\">remove_red_eye</i>"."</a>";
            $tabla .= "</td>"; 
            $tabla .= '<td><a class="waves-effect waves-light btn-small" title="Editar datos de la escuela" href="editarEscuela.php?escuela_id='.$row['idE'].'">'."<i class=\"material-icons\">create</i>"."</a>";
            $tabla .= "</td>"; 
            $tabla .= '<td><a class="waves-effect waves-light btn-small" title="Eliminar escuela" href="eliminarEscuela.php?escuela_id='.$row['idE'].'">'."<i class=\"material-icons\">delete_forever</i>"."</a>";
            $tabla .= "</td>"; 
            $tabla .= "</tr>";
        }
        $tabla .= "</table>";
    }
    else{
      $tabla .= "
      <div class=\"row\">
      <div class=\"col s12 m12 l12\">
          <div class=\"card blue lighten-1\">
              <div class=\"card-content white-text\">
                  <span class=\"card-title\">No se encontró ningún resultado de ".$nombre."</span>
              </div>
          </div>
      </div>
  </div>
      ";
    }
    cerrar_bd($con);
    
    return $tabla;
}
function getEscuelaByIdC($id){
  $con = conectar_bd();
  $sql = "SELECT  E.idEscuela as idE, E.nombre as NombreE , E.correo as correoE, E.direccion as direccionE,  E.director as directorE,  E.telefono as telefonoE   
  FROM Escuela as E ";
  $sql .= " Where E.idEscuela = '".$id."'";

  $result = mysqli_query($con, $sql);
  $resultado = "";
  
  
  while($row = mysqli_fetch_assoc($result)){
    $resultado .= "<br>
    <div class=\"card teal lighten-2\">
    <div class=\"card-content teal lighten-3\">
    <div class=\" center\" data-indicators=\"true\">
      <div class=\" teal lighten-5 \" href=\"#one!\" >
      <div class='row'>

        <div class=\"col s12 align-center\">
            <!-- Elemento -->
            <div class=\"file-field input-field\">
              <div class=\"col s6\">
                <label>Nombre de la escuela</label>
                <p>".$row["NombreE"]."</p>
              </div>
              <div class=\"col s6\">
              <label>Director de la escuela</label>
              <p>".$row["directorE"]."</p>
            </div>
            </div>
            <!-- Elemento -->
            <div class=\"file-field input-field\">
              <div class=\"col s12\">
                <label>Direccion de la escuela</label>
                <p>".$row["direccionE"]."</p>
            </div>
            </div>
            <!-- Elemento -->
            <div class=\"file-field input-field\">
              <div class=\"col s6\">
                <label>Telefono</label>
                <p>".$row["telefonoE"]."</p>
              </div>
              <div class=\"col s6\">
              <label>Correo</label>
              <p>".$row["correoE"]."</p>
            </div>
            </div>
            <div class=\"file-field input-field\">
              <div class=\"input-field col s12 l12 left\">

                <a id=\"\" href=\"consultaEscuela.php\" class=\"waves-effect green lighten-3 btn right\">Volver<i class=\"material-icons right\">undo</i>
                </a>
            </div>
            </div>

          </div>
      </div>
      </div>
    </div>
    </div>
    </div>";
  }
  cerrar_bd($con);
  
  return $resultado;

}
function getEscuelaById($id){
    $con = conectar_bd();
    
    $sql = "SELECT  E.idEscuela as idE, E.nombre as NombreE , E.correo as correoE, E.direccion as direccionE,  E.director as directorE,  E.telefono as telefonoE   
    FROM Escuela as E ";
    $sql .= " Where E.idEscuela = '".$id."'";
  
    $result = mysqli_query($con, $sql);
    $resultado = "";
    
    
    while($row = mysqli_fetch_assoc($result)){
      $resultado .= "<br>
      <div class=\"card teal lighten-2\">
      <div class=\"card-content teal lighten-3\">
      <div class=\" center\" data-indicators=\"true\">
        <div class=\"teal lighten-5 \" href=\"#one!\" >
        <div class='row'>

          <div class=\"col s12 align-center\">
              <!-- Elemento -->
              <div class=\"file-field input-field\">
                <div class=\"col s6\">
                  <label>Nombre de la escuela</label>
                  <p>".$row["NombreE"]."</p>
                </div>
                <div class=\"col s6\">
                <label>Director de la escuela</label>
                <p>".$row["directorE"]."</p>
              </div>
              </div>
              <br>
              <!-- Elemento -->
              <div class=\"file-field input-field\">
                <div class=\"col s12\">
                  <label>Direccion de la escuela</label>
                  <p>".$row["direccionE"]."</p>
              </div>
              </div>
              <!-- Elemento -->
              <div class=\"file-field input-field\">
                <div class=\"col s6\">
                  <label>Telefono</label>
                  <p>".$row["telefonoE"]."</p>
                </div>
                <div class=\"col s6\">
                <label>Correo</label>
                <p>".$row["correoE"]."</p>
              </div>
              </div>
              <br>
              <br>
              <br>
              <br>
              <br>
              <div class=\"file-field input-field\">
                <div class=\"input-field col s12 l12 left\">
                  <a id=\"confirmarEliminarEscuela\" href=\"Controladores\Escuela\controladorEliminarEscuela.php?escuela_id=$id\" class=\"waves-effect red deep-orange darken-4 btn right\">eliminar
                    <i class=\"material-icons right\">remove</i>
                  </a>
                  <a id=\"\" href=\"consultaEscuela.php\" class=\"waves-effect green lighten-3 btn right\">Volver<i class=\"material-icons right\">undo</i>
                  </a>
              </div>
              </div>
              </div>
            </div>
        </div>
      </div>
      </div>
      </div>";
    }
    cerrar_bd($con);
    
    return $resultado;

}
function textEscuela($id=""){
    $con = conectar_bd();
        $sql = "SELECT  E.idEscuela as idE, E.nombre as NombreE
        FROM Escuela as E Where E.idEscuela = '".$id."'";
        $result = mysqli_query($con, $sql);

    $resultado = "<div class=\"file-field input-field\">
                            <div class=\"input-field col s12\">
                                <i class=\"material-icons prefix\"> </i>
                                <input placeholder=\"secundaria general 1\" type=\"text\"  name=\"escuela_nombre\" id=\"escuela_nombre\"
                                ";
        while($row = mysqli_fetch_assoc($result)){      
                $resultado .= " value=\"$row[NombreE]\"";
                    
        }
    $resultado .="
                    required>
                    <label for=\"rol\"><strong>Nombre</strong></label>     
                    </div>
                    </div>";
    cerrar_bd($con);
    return $resultado;

}
function textCoordinaciones($id=""){
  $con = conectar_bd();
      $sql = "SELECT  E.idCoordinaciones as idE, E.nombre as NombreE
      FROM Coordinaciones as E Where E.idCoordinaciones = '".$id."'";
      $result = mysqli_query($con, $sql);

  $resultado = "<div class=\"file-field input-field\">
                          <div class=\"input-field col s12\">
                              <i class=\"material-icons prefix\"> </i>
                              <input placeholder=\"secundaria general 1\" type=\"text\"  name=\"Coordinaciones_nombre\" id=\"Coordinaciones_nombre\"
                              ";
      while($row = mysqli_fetch_assoc($result)){      
              $resultado .= " value=\"$row[NombreE]\"";
                  
      }
  $resultado .="
                  required>
                  <label for=\"rol\"><strong>Nombre</strong></label>     
                  </div>
                  </div>";
  cerrar_bd($con);
  return $resultado;

}
function insertarEscuela($nombre,$direccion,$director,$telefono,$correo) {
    $conexion_bd = conectar_bd();
    $activo=1;
    //Prepara la consulta
    $dml = 'INSERT INTO Escuela (nombre, activo,direccion,director,telefono,correo) VALUES (?,?,?,?,?,?)';
    if ( !($statement = $conexion_bd->prepare($dml)) ) {
        die("Error: (" . $conexion_bd->errno . ") " . $conexion_bd->error);
        return 0;
    }
    //Unir los parámetros de la función con los parámetros de la consulta   
    //El primer argumento de bind_param es el formato de cada parámetro
    if (!$statement->bind_param("sissss", $nombre,$activo,$direccion,$director,$telefono,$correo)) {
        die("Error en vinculación: (" . $statement->errno . ") " . $statement->error);
        return 0;
    } 
    //Executar la consulta
    if (!$statement->execute()) {
      die("Error en ejecución: (" . $statement->errno . ") " . $statement->error);
        return 0;
    }
    cerrar_bd($conexion_bd);
      return 1;
  }


  function editarEscuela($Escuela_id,$nombre,$direccion,$director,$telefono,$correo) {
    $conexion_bd = conectar_bd();
      
    //Prepara la consulta
    $dml = 'UPDATE Escuela SET nombre=(?),direccion=(?),director=(?),telefono=(?),correo=(?) WHERE idEscuela=(?)';
    if ( !($statement = $conexion_bd->prepare($dml)) ) {
        die("Error: (" . $conexion_bd->errno . ") " . $conexion_bd->error);
        return 0;
    }
      
    //Unir los parámetros de la función con los parámetros de la consulta   
    //El primer argumento de bind_param es el formato de cada parámetro
    if (!$statement->bind_param("ssssss", $nombre,$direccion,$director,$telefono,$correo, $Escuela_id)) {
        die("Error en vinculación: (" . $statement->errno . ") " . $statement->error);
        return 0;
    }
      
    //Executar la consulta
    if (!$statement->execute()) {
      die("Error en ejecución: (" . $statement->errno . ") " . $statement->error);
        return 0;
    }

    cerrar_bd($conexion_bd);
      return 1;
  }
  function eliminarEscuela($escuela_id) {
    $conexion_bd = conectar_bd();
    //Prepara la consulta
    $dml = 'UPDATE Escuela SET Escuela.activo=0 WHERE Escuela.idEscuela=(?)';
    if ( !($statement = $conexion_bd->prepare($dml)) ) {
        die("Error: (" . $conexion_bd->errno . ") " . $conexion_bd->error);
        return 0;
    }
      
    //Unir los parámetros de la función con los parámetros de la consulta   
    //El primer argumento de bind_param es el formato de cada parámetro
    if (!$statement->bind_param("i",$escuela_id)) {
        die("Error en vinculación: (" . $statement->errno . ") " . $statement->error);
        return 0;
    }
      
    //Executar la consulta
    if (!$statement->execute()) {
      die("Error en ejecución: (" . $statement->errno . ") " . $statement->error);
        return 0;
    }

    cerrar_bd($conexion_bd);
      return 1;
  }



  















  function getGradoEscolar($nombre=""){
    $con = conectar_bd();
    
    $sql = "SELECT  G.idGradoEscolar as idG, G.nombre as NombreG
    FROM GradoEscolar as G  where G.activo";
    if($nombre != ""){
        $sql .= " and     G.nombre like '%".$nombre."%'";
    }
    $sql .= " Order by G.nombre";
    $result = mysqli_query($con, $sql);
    $tabla = "";
    if(!(mysqli_num_rows($result)==0)){
      if(mysqli_num_rows($result)){
        $tabla .= "<table class=\"highlight centered\">";
        $tabla .= "<thead><tr><th>Nombre</th><th colspan='2'>Acción</th></thead>";
        while($row = mysqli_fetch_assoc($result)){   
            $tabla .= "<tr>";
            $tabla .= "<td>". $row["NombreG"]. "</td>";

            $tabla .= '<td><a class="waves-effect waves-light btn-small" title="Editar datos del plan educativo" href="editarGradoEscolar.php?gradoEscolar_id='.$row['idG'].'">'."<i class=\"material-icons\">create</i>"."</a>";
            $tabla .= "</td>"; 
            $tabla .= '<td><a class="waves-effect waves-light btn-small" title="Eliminar plan educativo" href="eliminarGradoEscolar.php?gradoEscolar_id='.$row['idG'].'">'."<i class=\"material-icons\">delete_forever</i>"."</a>";
            $tabla .= "</td>"; 
            $tabla .= "</tr>";
        }
        $tabla .= "</table>";
      }
    }else{
      $tabla .= "
      <div class=\"row\">
      <div class=\"col s12 m12 l12\">
          <div class=\"card blue lighten-1\">
              <div class=\"card-content white-text\">
                  <span class=\"card-title\">No se encontró ningún resultado de ".$nombre."</span>
              </div>
          </div>
      </div>
  </div>
      ";
    }


    cerrar_bd($con);
    
    return $tabla;
}

function getGradoEscolarById($id){
    $con = conectar_bd();
    
    $sql = "SELECT  G.idGradoEscolar as idE, G.nombre as NombreG
    FROM GradoEscolar as G ";
    $sql .= " Where G.idGradoEscolar = '".$id."'";

    $result = mysqli_query($con, $sql);
    $resultado = "";
    
    
    while($row = mysqli_fetch_assoc($result)){
        $resultado .= "<br>
        <div class=\"card teal lighten-2\">
        <div class=\"card-content teal lighten-3\">
        <div class=\" center\" data-indicators=\"true\">
          <div class=\" teal lighten-5 \" href=\"#one!\" >
          <div class='row'>
          <div class=\"col s12 align-center\">
                <!-- Elemento -->
                <div class=\"file-field input-field\">
                  <div class=\"col s12\">
                    <label>Nombre del Plan Educativo</label>
                    <p>".$row["NombreG"]."</p>
                </div>
                </div>

                <div class=\"file-field input-field\">
                  <div class=\"input-field col s12 l12 left\">
                    <a id=\"confirmarEliminarGradoEscolar\" href=\"Controladores\GradoEscolar\controladorEliminarGradoEscolar.php?gradoEscolar_id=$id\" class=\"waves-effect red deep-orange darken-4 btn right\">eliminar
                      <i class=\"material-icons right\">remove</i>
                    </a>
                    <a id=\"\" href=\"consultaGradoEscolar.php\" class=\"waves-effect green lighten-3 btn right\">Volver<i class=\"material-icons right\">undo</i>
                    </a>
                </div>
                </div>
                </div>
              </div>
          </div>
        </div>
        </div>
        </div>";
    }
    cerrar_bd($con);
    
    return $resultado;

}
function textGradoEscolar($id=""){
    $con = conectar_bd();
        $sql = "SELECT  G.idGradoEscolar as idG, G.nombre as NombreG
        FROM GradoEscolar as G Where G.idGradoEscolar = '".$id."'";
        $result = mysqli_query($con, $sql);

    $resultado = "<div class=\"file-field input-field\">
                            <div class=\"input-field col s12\">
                                <i class=\"material-icons prefix\"> </i>
                                <input placeholder=\"Primaria 1 grado\" type=\"text\"  name=\"gradoEscolar_nombre\" id=\"gradoEscolar_nombre\"
                                ";
        while($row = mysqli_fetch_assoc($result)){      
                $resultado .= " value=\"$row[NombreG]\"";
                    
        }
    $resultado .="
                    required>
                    <label for=\"rol\"><strong>Nombre</strong></label>     
                    </div>
                    </div>";
    cerrar_bd($con);
    return $resultado;

}
function insertarGradoEscolar($nombre) {
    $conexion_bd = conectar_bd();
    $activo=1;
    //Prepara la consulta
    $dml = 'INSERT INTO GradoEscolar (nombre, activo) VALUES (?,?)';
    if ( !($statement = $conexion_bd->prepare($dml)) ) {
        die("Error: (" . $conexion_bd->errno . ") " . $conexion_bd->error);
        return 0;
    }
    //Unir los parámetros de la función con los parámetros de la consulta   
    //El primer argumento de bind_param es el formato de cada parámetro
    if (!$statement->bind_param("si", $nombre,$activo)) {
        die("Error en vinculación: (" . $statement->errno . ") " . $statement->error);
        return 0;
    } 
    //Executar la consulta
    if (!$statement->execute()) {
      die("Error en ejecución: (" . $statement->errno . ") " . $statement->error);
        return 0;
    }
    cerrar_bd($conexion_bd);
      return 1;
  }


  function editarGradoEscolar($id, $nombre) {
    $conexion_bd = conectar_bd();
      
    //Prepara la consulta
    $dml = 'UPDATE GradoEscolar SET nombre=(?) WHERE idGradoEscolar=(?)';
    if ( !($statement = $conexion_bd->prepare($dml)) ) {
        die("Error: (" . $conexion_bd->errno . ") " . $conexion_bd->error);
        return 0;
    }
      
    //Unir los parámetros de la función con los parámetros de la consulta   
    //El primer argumento de bind_param es el formato de cada parámetro
    if (!$statement->bind_param("ss", $nombre, $id)) {
        die("Error en vinculación: (" . $statement->errno . ") " . $statement->error);
        return 0;
    }
      
    //Executar la consulta
    if (!$statement->execute()) {
      die("Error en ejecución: (" . $statement->errno . ") " . $statement->error);
        return 0;
    }

    cerrar_bd($conexion_bd);
      return 1;
  }
function eliminarGradoEscolar($escuela_id) {
    $conexion_bd = conectar_bd();
    //Prepara la consulta
    $dml = 'UPDATE GradoEscolar SET GradoEscolar.activo=0 WHERE GradoEscolar.idGradoEscolar=(?)';
    if ( !($statement = $conexion_bd->prepare($dml)) ) {
        die("Error: (" . $conexion_bd->errno . ") " . $conexion_bd->error);
        return 0;
    }
      
    //Unir los parámetros de la función con los parámetros de la consulta   
    //El primer argumento de bind_param es el formato de cada parámetro
    if (!$statement->bind_param("i",$escuela_id)) {
        die("Error en vinculación: (" . $statement->errno . ") " . $statement->error);
        return 0;
    }
      
    //Executar la consulta
    if (!$statement->execute()) {
      die("Error en ejecución: (" . $statement->errno . ") " . $statement->error);
        return 0;
    }

    cerrar_bd($conexion_bd);
      return 1;
  }
  function getDiscapacidadesBeneficiaria($nombre="",$id, $orden=0){
    $con = conectar_bd();
    
    $sql = "SELECT  
     B.idDeIngreso as beneficiaria_Id, B.nombre as beneficiaria_nombre, B.apellidoP as beneficiaria_ap , B.apellidoM as beneficiaria_am ,
     DB.idDiscapacidadBeneficiaria as relacion_id,DATE_FORMAT(DB.fecha, '%d/%m/%Y')  as relacion_fecha, DB.activo as relacion_activo,DB.Tratamiento as relacion_tratamiento, 
     D.Nombre as discapacidad_nombre, D.idDiscapacidad as idDiscapacidad 
     from DiscapacidadBeneficiaria as DB, Discapacidad as D, Beneficiaria as B 
     where DB.idDeIngreso = B.idDeIngreso and DB.idDiscapacidad = D.idDiscapacidad and DB.activo = 1 and B.idDeIngreso=$id 
        ";
    if($nombre != ""){
        $sql .= " and (D.Nombre like '%$nombre%')";
    }
    if ($orden==0){
      $sql .= " Order by DB.fecha DESC";
    }else{
      $sql .= " Order by DB.fecha ASC";
    }
    
    $result = mysqli_query($con, $sql);
    $resultado = "";
    if(!(mysqli_num_rows($result)==0)){
      if(mysqli_num_rows($result)){
        $resultado .="<div class=\"row\">
        <div class=\"card teal lighten-2\">
          <div class=\"card-content teal lighten-5\">";
           while($row = mysqli_fetch_assoc($result)){   
          
              $resultado .= "
              <ul class=\"collection with-header white\">
                  <li>
                      <li class=\"col s2 l2 collection-item header teal lighten-4 center\">
                      <a title=\"Editar datos de la discapacidad de la beneficiaria\" href=\"editarDiscapacidadBeneficiaria.php?relacion_id=".$row['relacion_id'].'&&beneficiaria_id='.$row['beneficiaria_Id'].'&&discapacidad_id='.$row['idDiscapacidad'].'&&beneficiaria_id='.$row['beneficiaria_Id'].'&&discapacidad_tratamiento='.$row['relacion_tratamiento']."\" class=\"waves-effect waves-light btn-small\"><i class=\"material-icons\">edit</i></a>
                      <a title=\"Eliminar  la discapacidad de la beneficiaria\" href=\"eliminarDiscapacidadBeneficiaria.php?relacion_id=".$row['relacion_id']."\" class=\"waves-effect waves-light btn-small red darken-4\"><i class=\"material-icons\">delete</i></a>
                      </li>

                      <li class=\"col s10 l10 collection-item header right\"><h6>Fecha diagnosticado: <strong>".$row["relacion_fecha"]."</strong></h6></li>
                  </li>

                  <li>
                    <li class=\"col s12 l12 collection-item header\"><h6>Discapacidad: <strong>".$row["discapacidad_nombre"]."</strong></h6></li>
                  </li>
                  <li>
                    <li class=\"col s12 l12 collection-item header\"><h6><strong>Tratamiento:</strong> ".$row["relacion_tratamiento"]."</h6></li>
                  </li>
                  </li>
                 </ul>    
                 <hr>         
          ";
          
            }
          $resultado .="</div>
          </div>
        </div>
      </div>";
      }
    }else{
      $resultado .= "
      <div class=\"row\">
      <div class=\"col s12 m12 l12\">
          <div class=\"card blue lighten-1\">
              <div class=\"card-content white-text\">
                  <span class=\"card-title\">No se encontró ningún resultado con la discapacidad ".$nombre."</span>
              </div>
          </div>
      </div>
  </div>
      ";
    }
    cerrar_bd($con);
    
    return $resultado;
}

function getDiscapacidadByIdE($id){
  $con = conectar_bd();
  
  $sql = "SELECT  
  B.idDeIngreso as beneficiaria_Id, B.nombre as beneficiaria_nombre, B.apellidoP as beneficiaria_ap , B.apellidoM as beneficiaria_am ,
  DB.idDiscapacidadBeneficiaria as relacion_id,DATE_FORMAT(DB.fecha, '%d/%m/%Y')  as relacion_fecha, DB.activo as relacion_activo,DB.Tratamiento as relacion_tratamiento, 
  D.Nombre as discapacidad_nombre, D.idDiscapacidad as idDiscapacidad 
  from DiscapacidadBeneficiaria as DB, Discapacidad as D, Beneficiaria as B 
  where DB.idDeIngreso = B.idDeIngreso and DB.idDiscapacidad = D.idDiscapacidad   and DB.idDiscapacidadBeneficiaria = $id
     ";

  $result = mysqli_query($con, $sql);
  $resultado = "";
  
  
  while($row = mysqli_fetch_assoc($result)){
      $resultado .= "<br>
      <div class=\"card teal lighten-2\">
      <div class=\"card-content teal lighten-3\">
      <div class=\" center\" data-indicators=\"true\">
        <div class=\" teal lighten-5 \" href=\"#one!\" >
        <div class='row'>
          <div class=\"col s12 align-center\">
              <!-- Elemento -->
              <h5>Datos de la beneficiaria</h5>
              <div class=\"file-field input-field\">
                <div class=\"col s6\">
                <label>Id</label>
                  <p>". $row["beneficiaria_Id"]."</p>
                </div>
                <div class=\"col s6\">
                  <label>Beneficiaria</label>
                  <p>". $row["beneficiaria_nombre"]." ".$row["beneficiaria_ap"]." ".$row["beneficiaria_am"]." " ."</p>
                </div>

              </div>
              <br>
              <h5>Discapacidad</h5>
              <div class=\"file-field input-field\">
                <div class=\"col s6\">
                  <label>Discapacidad</label>
                  <p>". $row["discapacidad_nombre"]."</p>
                </div>
                <div class=\"col s6\">
                <label>Diagnosticado</label>
                <p>". $row["relacion_fecha"]." </p>
              </div>
              </div>
              <div class=\"file-field input-field\">
              <div class=\"col s12\">
                <label>Tratamiento</label>
                <p>". $row["relacion_tratamiento"]."</p>
              </div>
            </div>
              <div class=\"file-field input-field\">
                <div class=\"input-field col s12 l12 left\">
                  <a id=\"confirmarEliminarEscolaridad\" href=\"Controladores\DiscapacidadBeneficiaria\controladorElimarDiscapacidad.php?relacion_id=$id\" class=\"waves-effect red deep-orange darken-4 btn right\">eliminar
                    <i class=\"material-icons right\">remove</i>
                  </a>
                  <a id=\"\" href=\"consultarDiscapacidad.php\" class=\"waves-effect green lighten-3 btn right\">Volver<i class=\"material-icons right\">undo</i>
                  </a>
              </div>
              </div>
              </div>
            </div>
        </div>
      </div>
      </div>
      </div>";
  }
  cerrar_bd($con);
  
  return $resultado;
}
function eliminarDiscapacidadBenefciaria($relacion_id) {
  $conexion_bd = conectar_bd();
  //Prepara la consulta
  $dml = 'UPDATE DiscapacidadBeneficiaria SET DiscapacidadBeneficiaria.activo=0 WHERE DiscapacidadBeneficiaria.idDiscapacidadBeneficiaria=(?)';
  if ( !($statement = $conexion_bd->prepare($dml)) ) {
      die("Error: (" . $conexion_bd->errno . ") " . $conexion_bd->error);
      return 0;
  }
    
  //Unir los parámetros de la función con los parámetros de la consulta   
  //El primer argumento de bind_param es el formato de cada parámetro
  if (!$statement->bind_param("i",$relacion_id)) {
      die("Error en vinculación: (" . $statement->errno . ") " . $statement->error);
      return 0;
  }
    
  //Executar la consulta
  if (!$statement->execute()) {
    die("Error en ejecución: (" . $statement->errno . ") " . $statement->error);
      return 0;
  }
  cerrar_bd($conexion_bd);
    return 1;
}
function insertarDiscapacidadBeneficiaria($idIngreso,$idDiscapacidad,$fecha,$tratamiento) {
  $conexion_bd = conectar_bd();
  $activo=1;
  //Prepara la consulta
  $dml = 'INSERT INTO DiscapacidadBeneficiaria (idDeIngreso, idDiscapacidad,fecha,Tratamiento,activo) VALUES (?,?,?,?,?)';
  if ( !($statement = $conexion_bd->prepare($dml)) ) {
      die("Error: (" . $conexion_bd->errno . ") " . $conexion_bd->error);
      return 0;
  }
  //Unir los parámetros de la función con los parámetros de la consulta   
  //El primer argumento de bind_param es el formato de cada parámetro
  if (!$statement->bind_param("ssssi", $idIngreso,$idDiscapacidad,$fecha,$tratamiento,$activo)) {
      die("Error en vinculación: (" . $statement->errno . ") " . $statement->error);
      return 0;
  } 
  //Executar la consulta
  if (!$statement->execute()) {
    die("Error en ejecución: (" . $statement->errno . ") " . $statement->error);
      return 0;
  }
  cerrar_bd($conexion_bd);
    return 1;
}


function editarDiscapacidadBeneficiaria($idIngreso,$idDiscapacidad,$fecha,$id,$tratamiento) {
  $conexion_bd = conectar_bd();
    
  //Prepara la consulta

  $dml = 'UPDATE DiscapacidadBeneficiaria SET idDeIngreso = (?),idDiscapacidad=(?),fecha=(?), Tratamiento=(?) WHERE idDiscapacidadBeneficiaria=(?)';
  if ( !($statement = $conexion_bd->prepare($dml)) ) {
      die("Error: (" . $conexion_bd->errno . ") " . $conexion_bd->error);
      return 0;
  }
    
  //Unir los parámetros de la función con los parámetros de la consulta   
  //El primer argumento de bind_param es el formato de cada parámetro
  if (!$statement->bind_param("sssss",$idIngreso,$idDiscapacidad,$fecha,$tratamiento,$id)) {
      die("Error en vinculación: (" . $statement->errno . ") " . $statement->error);
      return 0;
  }
    
  //Executar la consulta
  if (!$statement->execute()) {
    die("Error en ejecución: (" . $statement->errno . ") " . $statement->error);
      return 0;
  }

  cerrar_bd($conexion_bd);
    return 1;
}



















  function getEscolaridad($nombre="",$id,$ordenar=0,$buscar=0){
    $con = conectar_bd();
    
    $sql = "SELECT  
    B.idDeIngreso as beneficiaria_Id, B.nombre as beneficiaria_nombre, B.apellidoP as beneficiaria_ap , B.apellidoM as beneficiaria_am ,  
    Es.idEscolaridad as escolaridad_Id,Es.nombreTutor as escolaridad_Tutor, Es.correoElectronico as escolaridad_correo, Es.telefono as escolirad_telefono, DATE_FORMAT(Es.fechaInicio, '%d/%m/%Y') as escolaridad_FechaIn ,DATE_FORMAT(Es.fechaFin, '%d/%m/%Y')    as escolaridad_FechaFin,
    E.nombre as escuela_nombre, E.idEscuela as escuela_id,
    G.nombre as gradoEscolar_nombre, G.idGradoEscolar as gradoEscolar_id
    from Escolaridad as Es, Escuela as E, GradoEscolar as G, Beneficiaria as B 
    where Es.idDeIngreso = B.idDeIngreso and Es.idEscuela = E.idEscuela and Es.idGradoEscolar = G.idGradoEscolar and Es.activo = 1 and B.idDeIngreso=$id 
        ";
    if($nombre != "" and $buscar==1){
        $sql .= " and (G.nombre like '%$nombre%')";
    }
    if($nombre != "" and $buscar==0){
      $sql .= " and (E.nombre like '%$nombre%')";
  }
    if ($ordenar == 1){
      $sql .= " Order by Es.fechaInicio ASC";
    }
    else{
      $sql .= " Order by Es.fechaInicio DESC";
    }
    $result = mysqli_query($con, $sql);
    $resultado = "";
    if(!(mysqli_num_rows($result)==0)){
      if(mysqli_num_rows($result)){
        $resultado .="<div class=\"row\">
        <div class=\"card teal lighten-2\">
          <div class=\"card-content teal lighten-5\">";
           while($row = mysqli_fetch_assoc($result)){   
          
              $resultado .= "
              <ul class=\"collection with-header white\">
                  <li>
                      <li class=\"col s2 l2 collection-item header teal lighten-4 center\">
                      <a title=\"Editar datos de la escolaridad\" href=\"editarEscolaridad.php?escolaridad_id=".$row['escolaridad_Id'].'&&beneficiaria_id='.$row['beneficiaria_Id'].'&&escuela_id='.$row['escuela_id'].'&&gradoEscolar_id='.$row['gradoEscolar_id']."\" class=\"waves-effect waves-light btn-small\"><i class=\"material-icons\">edit</i></a>
                      <a title=\"Eliminar  escolaridad\" href=\"eliminarEscolaridad.php?escolaridad_id=".$row['escolaridad_Id']."\" class=\"waves-effect waves-light btn-small red darken-4\"><i class=\"material-icons\">delete</i></a>
                      </li>
                      <li class=\"col s5 l5 collection-item header right\"><h6>Fecha de termino de los estudios: <strong>".$row["escolaridad_FechaFin"]."</strong></h6></li>

                      <li class=\"col s5 l5 collection-item header right\"><h6>Fecha de inicio de los estudios: <strong>".$row["escolaridad_FechaIn"]."</strong></h6></li>
                  </li>

                  <li>
                    <li class=\"col s6 l6 collection-item header\"><h6>Escuela: <strong>".$row["escuela_nombre"]."</strong></h6></li>
                    <li class=\"col s6 l6 collection-item header\"><h6>Grado escolar: <strong>".$row["gradoEscolar_nombre"]."</strong></h6></li>
                  </li>
                  <li>
                    <li class=\"col s12 l12 collection-item header\"><h6>Tutor: <strong>".$row["escolaridad_Tutor"]."</strong></h6></li>
                  </li>

                  <li>
                    <li class=\"col s6 l6 collection-item header\"><h6>Telefono: <strong>".$row["escolaridad_correo"]."</strong></h6></li>
                    <li class=\"col s6 l6 collection-item header\"><h6>Correo: <strong>".$row["escolirad_telefono"]."</strong></h6></li>
                  </li>
                  </li>
                 </ul>    
                 <hr>         
          ";
          
            }
          $resultado .="</div>
          </div>
        </div>
      </div>";
      }
    }else{
      $resultado .= "
      <div class=\"row\">
      <div class=\"col s12 m12 l12\">
          <div class=\"card blue lighten-1\">
              <div class=\"card-content white-text\">
                  <span class=\"card-title\">No se encontró ningún resultado con el plan de estudios ".$nombre."</span>
              </div>
          </div>
      </div>
  </div>
      ";
    }
    cerrar_bd($con);
    
    return $resultado;
}





function getEscolaridadByIdE($id){
    $con = conectar_bd();
    
    $sql = "SELECT  
    B.idDeIngreso as beneficiaria_Id, B.nombre as beneficiaria_nombre, B.apellidoP as beneficiaria_ap , B.apellidoM as beneficiaria_am ,  
    Es.idEscolaridad as escolaridad_Id,Es.nombreTutor as escolaridad_Tutor, Es.correoElectronico as escolaridad_correo, Es.telefono as escolirad_telefono, DATE_FORMAT(Es.fechaInicio, '%d/%m/%Y') as escolaridad_FechaIn ,DATE_FORMAT(Es.fechaFin, '%d/%m/%Y')    as escolaridad_FechaFin,
    Es.activo as activo,E.nombre as escuela_nombre, E.idEscuela as escuela_id,
    G.nombre as gradoEscolar_nombre, G.idGradoEscolar as gradoEscolar_id
    from Escolaridad as Es, Escuela as E, GradoEscolar as G, Beneficiaria as B 
    where Es.idDeIngreso = B.idDeIngreso and Es.idEscuela = E.idEscuela and Es.idGradoEscolar = G.idGradoEscolar
         ";
    $sql .= " and Es.idEscolaridad = '".$id."'";

    $result = mysqli_query($con, $sql);
    $resultado = "";
    
    
    while($row = mysqli_fetch_assoc($result)){
        $resultado .= "<br>
        <div class=\"card teal lighten-2\">
        <div class=\"card-content teal lighten-3\">
        <div class=\" center\" data-indicators=\"true\">
          <div class=\" teal lighten-5 \" href=\"#one!\" >
          <div class='row'>
            <div class=\"col s12 align-center\">
                <!-- Elemento -->
                <h5>Datos de la beneficiaria</h5>
                <div class=\"file-field input-field\">
                  <div class=\"col s6\">
                  <label>Id</label>
                    <p>". $row["beneficiaria_Id"]."</p>
                  </div>
                  <div class=\"col s6\">
                    <label>Beneficiaria</label>
                    <p>". $row["beneficiaria_nombre"]." ".$row["beneficiaria_ap"]." ".$row["beneficiaria_am"]." " ."</p>
                  </div>

                </div>
                <br>
                <h5>Escolaridad</h5>
                <div class=\"file-field input-field\">


                  <div class=\"col s6\">
                    <label>Escuela</label>
                    <p>". $row["escuela_nombre"]."</p>
                  </div>
                  <div class=\"col s6\">
                  <label>Plan Educativo</label>
                  <p>". $row["gradoEscolar_nombre"]." </p>
                </div>
                </div>
                <div class=\"file-field input-field\">

                <div class=\"col s6\">
                <label>Inicio</label>
                  <p>". $row["escolaridad_FechaIn"]."</p>
                </div>

                  <div class=\"col s6\">
                    <label>Termino</label>
                    <p>". $row["escolaridad_FechaFin"]."</p>
                  </div>
                </div>
                <h5>Tutor</h5>
                <div class=\"file-field input-field\">
                  <div class=\"col s4\">
                    <label>Nombre</label>
                    <p>". $row["escolaridad_Tutor"]."</p>
                   </div>
                   <div class=\"col s4\">
                   <label>Correo</label>
                   <p>". $row["escolaridad_correo"]."</p>
                  </div>
                  <div class=\"col s4\">
                  <label>Telefono</label>
                  <p>". $row["escolirad_telefono"]."</p>
                 </div>
                </div>
                <br>

                <div class=\"file-field input-field\">
                  <div class=\"input-field col s12 l12 left\">
                    <a id=\"confirmarEliminarEscolaridad\" href=\"Controladores\Escolaridad\controladorElimarEscolaridad.php?escolaridad_id=$id\" class=\"waves-effect red deep-orange darken-4 btn right\">eliminar
                      <i class=\"material-icons right\">remove</i>
                    </a>
                    <a id=\"\" href=\"consultaEscolaridad.php\" class=\"waves-effect green lighten-3 btn right\">Volver<i class=\"material-icons right\">undo</i>
                    </a>
                </div>
                </div>
              </div>
              </div>
          </div>
        </div>
        </div>
        </div>";
    }
    cerrar_bd($con);
    
    return $resultado;

}


function eliminarEscolaridad($escolridad_id) {
    $conexion_bd = conectar_bd();
    //Prepara la consulta
    $dml = 'UPDATE Escolaridad SET Escolaridad.activo=0 WHERE Escolaridad.idEscolaridad=(?)';
    if ( !($statement = $conexion_bd->prepare($dml)) ) {
        die("Error: (" . $conexion_bd->errno . ") " . $conexion_bd->error);
        return 0;
    }
      
    //Unir los parámetros de la función con los parámetros de la consulta   
    //El primer argumento de bind_param es el formato de cada parámetro
    if (!$statement->bind_param("i",$escolridad_id)) {
        die("Error en vinculación: (" . $statement->errno . ") " . $statement->error);
        return 0;
    }
      
    //Executar la consulta
    if (!$statement->execute()) {
      die("Error en ejecución: (" . $statement->errno . ") " . $statement->error);
        return 0;
    }
    cerrar_bd($conexion_bd);
      return 1;
  }

  function crear_select($id, $columna_descripcion, $tabla, $seleccion=0,$nuevo=1) {
    $conexion_bd = conectar_bd();  
      
    $resultado = '
    <div class="input-field">
      <select class="" id="'.$tabla.'" name="'.$tabla.'" >
        <option value="" disabled selected>Selecciona una opción</option>';
    if($nuevo==1){
      $resultado .= '<option value="0">Nuevo</option>';
    }
    $consulta = "SELECT T.$id as id, T.$columna_descripcion as columna_descripcion FROM $tabla as T where T.activo=1";
    $resultados = $conexion_bd->query($consulta);
    while ($row = mysqli_fetch_array($resultados, MYSQLI_BOTH)) {
        $resultado .= '<option value="'.$row["id"].'" ';
        if($seleccion == $row["id"]) {
            $resultado .= 'selected';
        }
        $resultado .= '>'.$row["columna_descripcion"].'</option>';
    }
        
    cerrar_bd($conexion_bd);
    $resultado .=  '</select><label>'.$tabla.'</label></div>';
    return $resultado;
  }
  function crear_selectR($id, $columna_descripcion, $tabla, $seleccion=0,$nuevo=1) {
    $conexion_bd = conectar_bd();  
      
    $resultado = '
    <div class="input-field">
      <select class="" id="'.$tabla.'" name="'.$tabla.'" required>
        <option value="" disabled selected>Selecciona una opción</option>';
    if($nuevo==1){
      $resultado .= '<option value="0">Nuevo</option>';
    }
    $consulta = "SELECT T.$id as id, T.$columna_descripcion as columna_descripcion , T.activo as activo FROM $tabla as T ";
    $resultados = $conexion_bd->query($consulta);
    while ($row = mysqli_fetch_array($resultados, MYSQLI_BOTH)) {
        if ($row["id"]==$seleccion or $row["activo"]==1)
        {
          $resultado .= '<option value="'.$row["id"].'" ';
          if($seleccion == $row["id"]) {
              $resultado .= 'selected';
          }
          $resultado .= '>'.$row["columna_descripcion"].'</option>';
        }

    }
        
    cerrar_bd($conexion_bd);
    $resultado .=  '</select><label>'.$tabla.'</label></div>';
    return $resultado;
  }
  function crear_selectB($id, $columna_descripcion, $tabla, $seleccion=0,$nuevo=1) {
    $conexion_bd = conectar_bd();  
      
    $resultado = '
      <select class="" id="'.$tabla.'" name="'.$tabla.'" required>
        <option value=""  selected>Todos</option>';
    if($nuevo==1){
      $resultado .= '<option value="0">Nuevo</option>';
    }
    $consulta = "SELECT T.$id as id, T.$columna_descripcion as columna_descripcion , T.activo as activo FROM $tabla as T ";
    $resultados = $conexion_bd->query($consulta);
    while ($row = mysqli_fetch_array($resultados, MYSQLI_BOTH)) {
        if ($row["id"]==$seleccion or $row["activo"]==1)
        {
          $resultado .= '<option value="'.$row["id"].'" ';
          if($seleccion == $row["id"]) {
              $resultado .= 'selected';
          }
          $resultado .= '>'.$row["columna_descripcion"].'</option>';
        }

    }
        
    cerrar_bd($conexion_bd);
    $resultado .=  '</select><label>'.$tabla.'</label>';
    return $resultado;
  }


  function crear_selectBeneficiaria($seleccion=0) {
    $conexion_bd = conectar_bd();  
      
    $resultado = '<div class="input-field"><select name="beneficiaria" required><option value="" disabled selected>Selecciona una opción</option>';
            
    $consulta = "SELECT 
    B.idDeIngreso as beneficiaria_Id, B.nombre as beneficiaria_nombre, B.apellidoP as beneficiaria_ap , B.apellidoM as beneficiaria_am
    from Beneficiaria as B ";
    $resultados = $conexion_bd->query($consulta);
    while ($row = mysqli_fetch_array($resultados, MYSQLI_BOTH)) {
        $resultado .= '<option value="'.$row["beneficiaria_Id"].'"';
        if($seleccion == $row["beneficiaria_Id"]) {
            $resultado .= 'selected';
        }
        $resultado .='>'.$row["beneficiaria_Id"].'.-'.$row["beneficiaria_nombre"].' '.$row["beneficiaria_ap"].' '.$row["beneficiaria_am"].'</option>';
        
    }
        
    cerrar_bd($conexion_bd);
    $resultado .=  '</select><label>'.'Beneficiaria'.'</label></div>';
    return $resultado;
  }

  function selectBeneficiaria($seleccion=0) {
    $conexion_bd = conectar_bd();  
      
    $resultado = '<select name="beneficiaria" required><option value="" disabled selected>Selecciona una opción</option>';
            
    $consulta = "SELECT 
    B.idDeIngreso as beneficiaria_Id, B.nombre as beneficiaria_nombre, B.apellidoP as beneficiaria_ap , B.apellidoM as beneficiaria_am
    from Beneficiaria as B ";
    $resultados = $conexion_bd->query($consulta);
    while ($row = mysqli_fetch_array($resultados, MYSQLI_BOTH)) {
        $resultado .= '<option value="'.$row["beneficiaria_Id"].'"';
        if($seleccion == $row["beneficiaria_Id"]) {
            $resultado .= 'selected';
        }
        $resultado .='>'.$row["beneficiaria_Id"].'.-'.$row["beneficiaria_nombre"].' '.$row["beneficiaria_ap"].' '.$row["beneficiaria_am"].'</option>';
        
    }
        
    cerrar_bd($conexion_bd);
    $resultado .=  '</select>';
    return $resultado;
  }
  function selectProgramas($seleccion=0) {
    $conexion_bd = conectar_bd();  
      
    $resultado = '<select name="programa" required><option value="" disabled selected>Selecciona una opción</option>';
            
    $consulta = "SELECT 
    p.idProgramaAtencion as programa_Id, p.nombre as programa_nombre
    from ProgramaAtencion as p ";
    $resultados = $conexion_bd->query($consulta);
    while ($row = mysqli_fetch_array($resultados, MYSQLI_BOTH)) {
        $resultado .= '<option value="'.$row["programa_Id"].'"';
        if($seleccion == $row["programa_Id"]) {
            $resultado .= 'selected';
        }
        $resultado .='>'.$row["programa_Id"].'.-'.$row["programa_nombre"].'</option>';
        
    }
        
    cerrar_bd($conexion_bd);
    $resultado .=  '</select>';
    return $resultado;
  }


  function insertarEscolaridad($idIngreso,$idEscuela,$idGrado,$tutorNombre,$telefono,$correo,$fechaInicio,$fechaFin ) {
    $conexion_bd = conectar_bd();
    $activo=1;
    //Prepara la consulta
    $dml = 'INSERT INTO Escolaridad (idDeIngreso, idEscuela,idGradoEscolar,nombreTutor,telefono,fechaInicio,fechaFin,correoElectronico,activo) VALUES (?,?,?,?,?,?,?,?,?)';
    if ( !($statement = $conexion_bd->prepare($dml)) ) {
        die("Error: (" . $conexion_bd->errno . ") " . $conexion_bd->error);
        return 0;
    }
    //Unir los parámetros de la función con los parámetros de la consulta   
    //El primer argumento de bind_param es el formato de cada parámetro
    if (!$statement->bind_param("ssssssssi", $idIngreso,$idEscuela,$idGrado,$tutorNombre,$telefono,$fechaInicio,$fechaFin,$correo,$activo)) {
        die("Error en vinculación: (" . $statement->errno . ") " . $statement->error);
        return 0;
    } 
    //Executar la consulta
    if (!$statement->execute()) {
      die("Error en ejecución: (" . $statement->errno . ") " . $statement->error);
        return 0;
    }
    cerrar_bd($conexion_bd);
      return 1;
  }


  function editarEscolaridad($id,$idIngreso,$idEscuela,$idGrado,$tutorNombre,$telefono,$correo,$fechaInicio,$fechaFin ) {
    $conexion_bd = conectar_bd();
      
    //Prepara la consulta
    $dml = 'UPDATE Escolaridad SET idDeIngreso = (?),idEscuela=(?),idGradoEscolar=(?),nombreTutor=(?),telefono=(?),fechaInicio=(?),fechaFin=(?),correoElectronico=(?) WHERE idEscolaridad=(?)';
    if ( !($statement = $conexion_bd->prepare($dml)) ) {
        die("Error: (" . $conexion_bd->errno . ") " . $conexion_bd->error);
        return 0;
    }
      
    //Unir los parámetros de la función con los parámetros de la consulta   
    //El primer argumento de bind_param es el formato de cada parámetro
    if (!$statement->bind_param("sssssssss",$idIngreso,$idEscuela,$idGrado,$tutorNombre,$telefono,$fechaInicio,$fechaFin,$correo,$id)) {
        die("Error en vinculación: (" . $statement->errno . ") " . $statement->error);
        return 0;
    }
      
    //Executar la consulta
    if (!$statement->execute()) {
      die("Error en ejecución: (" . $statement->errno . ") " . $statement->error);
        return 0;
    }

    cerrar_bd($conexion_bd);
      return 1;
  }



  function textCamp($idCheck,$table,$id="",$campo){
    $con = conectar_bd();
        $sql = "SELECT  T.$campo as resultado
        FROM $table as T Where T.$idCheck = '".$id."'";
        $result = mysqli_query($con, $sql);



    $resultado = "<i class=\"material-icons prefix\"> </i>
                    <div>
                      <label for=\"rol\"><strong>$table</strong></label>     
                    </div>
                    <textarea required  name=\"".$table."_"."$campo\"  wrap rows=\"10\" cols=\"30\">";
        while($row = mysqli_fetch_assoc($result)){      
                $resultado .= $row["resultado"];
        }
    $resultado .="</textarea>
                    ";
    cerrar_bd($con);
    return $resultado;
}

function textAreaG($idCheck,$table,$id="",$campo){
  $con = conectar_bd();
      $sql = "SELECT  T.$campo as resultado
      FROM $table as T Where T.$idCheck = '".$id."'";
      $result = mysqli_query($con, $sql);

  $resultado = "<i class=\"material-icons prefix\"> </i>
                  <input type=\"text\"required  name=\"".$table."_"."$campo\" ";
      while($row = mysqli_fetch_assoc($result)){      
              $resultado .= "value=\"$row[resultado]\"";
      }
  $resultado .="></input>
  <label for=\"rol\"><strong>$table $campo</strong></label>     ";
  cerrar_bd($con);
  return $resultado;
}
function emailCamp($idCheck,$table,$id="",$campo){
  $con = conectar_bd();
      $sql = "SELECT  T.$campo as resultado
      FROM $table as T Where T.$idCheck = '".$id."'";
      $result = mysqli_query($con, $sql);

  $resultado = "
                <i class=\"material-icons prefix\"> </i>
                <input type=\"email\" class=\"validate\"  name=\"".$table."_"."$campo\" id=\"".$table."_"."$campo\"
      ";
      while($row = mysqli_fetch_assoc($result)){      
              $resultado .= " value=\"$row[resultado]\"";
      }
  $resultado .="
                  >
                  <label for=\"".$table."_"."$campo\"><strong>Email</strong></label> ";
  cerrar_bd($con);
  return $resultado;
}
function telefonoCamp($idCheck,$table,$id="",$campo){
  $con = conectar_bd();
      $sql = "SELECT  T.$campo as resultado
      FROM $table as T Where T.$idCheck = '".$id."'";
      $result = mysqli_query($con, $sql);

  $resultado = "
                <i class=\"material-icons prefix\"> </i>
                <input type=\"tel\" class=\"validate\"  name=\"".$table."_"."$campo\" id=\"".$table."_"."$campo\"
      ";
      while($row = mysqli_fetch_assoc($result)){      
              $resultado .= " value=\"$row[resultado]\"";
      }
  $resultado .="
                  >
                  <label for=\"".$table."_"."$campo\"><strong>Telephone</strong></label> ";
  cerrar_bd($con);
  return $resultado;
}
function fechaCamp($idCheck,$table,$id="",$campo,$nombre){
  $con = conectar_bd();
      $sql = "SELECT  DATE_FORMAT(T.$campo,'%Y-%m-%d') as resultado
      FROM $table as T Where T.$idCheck = '".$id."'";
      $result = mysqli_query($con, $sql);

  $resultado = " 
                <input type=\"date\" class=\"validate\"  name=\"".$table."_"."$campo\" id=\"".$table."_"."$campo\"
      ";
      while($row = mysqli_fetch_assoc($result)){      
              $resultado .= " value=\"$row[resultado]\"";
      }
  $resultado .="
                  >
                  <label for=\"".$table."_"."$campo\"><strong>Fecha $nombre</strong></label> ";
  mysqli_free_result($result); //Liberar la memoria
  cerrar_bd($con);
  return $resultado;  
}

function getMedicamentos(){
    $conexion_bd = conectar_bd();
    $sql = "SELECT m.idMedicamento as id, m.nombre,ingredienteActivo,p.nombre as presentacion  
    FROM Medicamentos as m, Presentacion as p
    WHERE m.idPresentacion = p.idPresentacion
    ORDER BY m.idMedicamento ASC";
    $result = mysqli_query($conexion_bd, $sql);
    mysqli_free_result($result); //Liberar la memoria
    cerrar_bd($conexion_bd);

    return $result;
}

function getMedicamentosPorNombre($nombre=''){
    $conexion_bd = conectar_bd();
    $sql = "SELECT m.idMedicamento as id, m.nombre,ingredienteActivo,p.nombre as presentacion,p.idPresentacion  
     FROM Medicamentos as m, Presentacion as p 
     WHERE m.idPresentacion = p.idPresentacion 
     AND m.nombre LIKE '%".$nombre."%' 
     AND m.activo = 1
     ORDER BY m.idMedicamento ASC";
    $result = mysqli_query($conexion_bd, $sql);
     cerrar_bd($conexion_bd);

    return $result;
}

function nuevoMedicamento($nombre,$ingrediente,$presentacion){
    $conexion_bd = conectar_bd();
    $sql = "INSERT INTO `Medicamentos` (`nombre`,`ingredienteActivo`,`idPresentacion`,`activo`) VALUES
    ('$nombre','$ingrediente','$presentacion',1);";
    $result = mysqli_query($conexion_bd, $sql);
    //mysqli_free_result($result); //Liberar la memoria
    cerrar_bd($conexion_bd);

    return $result;
}

function eliminarMedicamento($id){
    $conexion_bd = conectar_bd();
    $sql = "DELETE FROM Medicamentos WHERE idMedicamento = '$id'";
    $result = mysqli_query($conexion_bd, $sql);
    cerrar_bd($conexion_bd);

    return $result;
}

function modificarMedicamento($id,$nombre,$ingrediente,$presentacion){
    $conexion_bd = conectar_bd();
    $sql = "UPDATE Medicamentos 
    SET nombre = '$nombre', ingredienteActivo='$ingrediente', idPresentacion = '$presentacion' 
    WHERE idMedicamento = '$id'";
    $result = mysqli_query($conexion_bd, $sql);
    cerrar_bd($conexion_bd);

    return $result;
}

function showQueryMedicamentos($result,$nombre){
    if(mysqli_num_rows($result) > 0){
        echo '<table class=\"highlight centered\><thead><tr>';
        echo '<th>'.'Nombre'.'</th>';
        echo '<th>'.'Ingrediente Activo'.'</th>';
        echo '<th>'.'Presentación'.'</th>';
        echo '<th colspan=\'3\'>Acción</th>';
        echo '</tr></thead>';
        while($row = mysqli_fetch_assoc($result)){
            echo '<tr>';
            echo '<td>'.$row['nombre'].'</td>';
            echo '<td>'.$row['ingredienteActivo'].'</td>';
            echo '<td>'.$row['presentacion'].'</td>';
            echo '<td><a class="waves-effect waves-light btn-small" title="Editar datos del medicamento" href="modificarMedicamento.php?medicamento_id='.$row['id'].'&p='.$row['idPresentacion'].'">'."<i class=\"material-icons\">create</i>"."</a>";
            echo "</td>"; 
            echo '<td><a class="waves-effect waves-light btn-small" title="Eliminar medicamento" href="eliminarMedicamento.php?medicamento_id='.$row['id'].'">'."<i class=\"material-icons\">delete_forever</i>"."</a>";
            echo "</td>"; 
            echo '</tr>';
        }
        echo '</table>';
    }
    else{
      echo "
      <div class=\"row\">
      <div class=\"col s12 m12 l12\">
          <div class=\"card blue lighten-1\">
              <div class=\"card-content white-text\">
                  <span class=\"card-title\">No se encontró ningún resultado de ".$nombre."</span>
              </div>
          </div>
      </div>
    </div>
      ";
    }
    mysqli_free_result($result);
}

function getMedicamentosByIdE($id){
  $con = conectar_bd();
  
  $sql = "SELECT  idMedicamento, nombre
  FROM Medicamentos
   WHERE idMedicamento = $id";

  $result = mysqli_query($con, $sql);
  $resultado = "";
  
  
  while($row = mysqli_fetch_assoc($result)){
      $resultado .= "<br>
      <div class=\"card teal lighten-2\">
      <div class=\"card-content teal lighten-3\">
      <div class=\" center\" data-indicators=\"true\">
        <div class=\" teal lighten-5 \" href=\"#one!\" id=\"carousel-Docs\">
        <div class='row'>
                  <div class=\"col s12 align-center\">
              <!-- Elemento -->
              <div class=\"file-field input-field\">
                <div class=\"col s12 m12 l12\">
                  <label>Nombre del Medicamento</label>
                  <p>".$row["nombre"]."</p>
              </div>
              </div>

              <div class=\"file-field input-field\">
                  <div class=\"input-field col s12 l12 left\">
                    <a id=\"confirmarEliminarEscolaridad\" href=\"Controladores\Medicamento\controladorEliminarMedicamento.php?idMed=".$id."\" class=\"waves-effect red deep-orange darken-4 btn right\">eliminar
                      <i class=\"material-icons right\">remove</i>
                    </a>
                    <a id=\"\"href=\"consultaMedicamento.php\" class=\"waves-effect green lighten-3 btn right\">Volver<i class=\"material-icons right\">undo</i>
                    </a>
                </div>
                </div>
           
            </div>
        </div>
        </div>
      </div>
      </div>
      </div>";
  }

  cerrar_bd($con);
  mysqli_free_result($result);
  return $resultado;

}

function getPresentacion(){
    $conexion_bd = conectar_bd();
    $sql = "SELECT *
    FROM Presentacion";
    $result = mysqli_query($conexion_bd, $sql);
    cerrar_bd($conexion_bd);

    return $result;
}

function showQueryPresentacion($result){
    if(mysqli_num_rows($result) > 0){
        echo '<table class=\"highlight centered\><tr>';
        echo '<th>'.'ID'.'</th>';
        echo '<th>'.'Nombre'.'</th>';
        echo '</tr>';
        while($row = mysqli_fetch_assoc($result)){
            echo '<tr>';
            echo '<td>'.$row['idPresentacion'].'</td>';
            echo '<td>'.$row['nombre'].'</td>';
            echo '<td><a class="waves-effect waves-light btn-small" title="Eliminar la presentacion" href="eliminarPresentacion.php?presentacion_id='.$row['idPresentacion'].'">'."<i class=\"material-icons\">delete_forever</i>"."</a>";
            echo "</td>"; 
            echo '</tr>';
        }
        echo '</table>';
    }
    mysqli_free_result($result);
}

function nuevaPresentacion($nombre){
    $conexion_bd = conectar_bd();
    $sql = "INSERT INTO `Presentacion` (`nombre`) VALUES
    ('$nombre');";
    $result = mysqli_query($conexion_bd, $sql);
    cerrar_bd($conexion_bd);

    return $result;
}

function eliminarPresentacion($id){
    $conexion_bd = conectar_bd();
    $sql = "DELETE FROM Presentacion WHERE idPresentacion = '$id'";
    $result = mysqli_query($conexion_bd, $sql);
    cerrar_bd($conexion_bd);

    return $result;
}

function crear_select1($id, $columna_descripcion, $tabla, $seleccion=0) {
  $conexion_bd = conectar_bd();  
    
  $resultado = '<div class="formato1"class="input-field"><select required name="'.$tabla.'" ><option value="" disabled selected>Selecciona una opción</option>';
          
  $consulta = "SELECT $id, $columna_descripcion FROM $tabla WHERE activo=1";
  $resultados = $conexion_bd->query($consulta);
  while ($row = mysqli_fetch_array($resultados, MYSQLI_BOTH)) {
      $resultado .= '<option value="'.$row["$id"].'" ';
      if($seleccion == $row["$id"]) {
          $resultado .= 'selected';
      }
      $resultado .= '>'.$row["$columna_descripcion"].'</option>';
  }
      
  cerrar_bd($conexion_bd);
  $resultado .=  '</select><label class="formato1" for="rol"><strong>Presentacion</strong></label></div>';
  return $resultado;
}













function getDiscapacidades($nombre=""){
  $con = conectar_bd();
  $sql = "SELECT  D.idDiscapacidad as idD, D.nombre as NombreD
  FROM Discapacidad as D where D.activo =1 ";
  if($nombre != ""){
      $sql .= "   and   D.nombre like '%".$nombre."%'";
  }
  $result = mysqli_query($con, $sql);
  $tabla = "";
  if(mysqli_num_rows($result)){
      $tabla .= "<table class=\"highlight centered\">";
      $tabla .= "<thead><tr><th>Nombre</th><th colspan='2'>Acción</th></thead>";
      while($row = mysqli_fetch_assoc($result)){   
          $tabla .= "<tr>";
          $tabla .= "<td>". $row["NombreD"]. "</td>";
          $tabla .= '<td><a class="waves-effect waves-light btn-small" title="Editar datos de la discapacidad" href="editarDiscapacidad.php?discapacidad_id='.$row['idD'].'">'."<i class=\"material-icons\">create</i>"."</a>";
          $tabla .= "</td>"; 
          $tabla .= '<td><a class="waves-effect waves-light btn-small" title="Eliminar discapacidad" href="eliminarDiscapacidad.php?discapacidad_id='.$row['idD'].'">'."<i class=\"material-icons\">delete_forever</i>"."</a>";
          $tabla .= "</td>"; 
          $tabla .= "</tr>";
      }
      $tabla .= "</table>";
  }
  else{
    $tabla .= "
    <div class=\"row\">
    <div class=\"col s12 m12 l12\">
        <div class=\"card blue lighten-1\">
            <div class=\"card-content white-text\">
                <span class=\"card-title\">No se encontró ningún resultado de ".$nombre."</span>
            </div>
        </div>
    </div>
</div>
    ";
  }
  cerrar_bd($con);
  
  return $tabla;
}

function getDiscapacidadById($id){
  $con = conectar_bd();
  
  $sql = "SELECT  D.idDiscapacidad as idD, D.nombre as NombreD, D.activo as activo
  FROM Discapacidad as D ";
  $sql .= " Where D.idDiscapacidad = '".$id."'";

  $result = mysqli_query($con, $sql);
  $resultado = "";
  
  
  while($row = mysqli_fetch_assoc($result)){
      $resultado .= "<br>
      <div class=\"card teal lighten-2\">
      <div class=\"card-content teal lighten-3\">
      <div class=\" center\" data-indicators=\"true\">
        <div class=\" teal lighten-5 \" href=\"#one!\" >
        <div class='row'>
        <div class=\"col s12 align-center\">
              <!-- Elemento -->
              <div class=\"file-field input-field\">
                <div class=\"col s12\">
                  <label>Nombre de la discapacidad</label>
                  <p>".$row["NombreD"]."</p>
              </div>
              </div>

              <div class=\"file-field input-field\">
                <div class=\"input-field col s12 l12 left\">
                  <a id=\"confirmarEliminarDiscapacidad\" href=\"Controladores\Discapacidad\controladorEliminarDiscapacidad.php?discapacidad_id=$id\" class=\"waves-effect red deep-orange darken-4 btn right\">eliminar
                    <i class=\"material-icons right\">remove</i>
                  </a>
                  <a id=\"\" href=\"consultaDiscapacidad.php\" class=\"waves-effect green lighten-3 btn right\">Volver<i class=\"material-icons right\">undo</i>
                  </a>
              </div>
              </div>
              </div>
            </div>
        </div>
      </div>
      </div>
      </div>";
  }
  cerrar_bd($con);
  
  return $resultado;

}
function textDiscapacidad($id=""){
  $con = conectar_bd();
      $sql = "SELECT  D.idDiscapacidad as idD, D.nombre as NombreD
      FROM Discapacidad as D Where D.idDiscapacidad = '".$id."'";
      $result = mysqli_query($con, $sql);

  $resultado = "<div class=\"file-field input-field\">
                          <div class=\"input-field col s12\">
                              <i class=\"material-icons prefix\"> </i>
                              <input placeholder=\"secundaria general 1\" type=\"text\"  name=\"discapacidad_nombre\" id=\"discapacidad_nombre\"
                              ";
      while($row = mysqli_fetch_assoc($result)){      
              $resultado .= " value=\"$row[NombreD]\"";
                  
      }
  $resultado .="
                  required>
                  <label for=\"rol\"><strong>Nombre</strong></label>     
                  </div>
                  </div>";
  cerrar_bd($con);
  return $resultado;

}
function insertarDiscapacidad($nombre) {
  $conexion_bd = conectar_bd();
  $activo=1;
  //Prepara la consulta
  $dml = 'INSERT INTO Discapacidad (nombre, activo) VALUES (?,?)';
  if ( !($statement = $conexion_bd->prepare($dml)) ) {
      die("Error: (" . $conexion_bd->errno . ") " . $conexion_bd->error);
      return 0;
  }
  //Unir los parámetros de la función con los parámetros de la consulta   
  //El primer argumento de bind_param es el formato de cada parámetro
  if (!$statement->bind_param("si", $nombre,$activo)) {
      die("Error en vinculación: (" . $statement->errno . ") " . $statement->error);
      return 0;
  } 
  //Executar la consulta
  if (!$statement->execute()) {
    die("Error en ejecución: (" . $statement->errno . ") " . $statement->error);
      return 0;
  }
  cerrar_bd($conexion_bd);
    return 1;
}
function getIdDiscapacidad() {
  $conexion_bd = conectar_bd();
  $sql = "SELECT  Max(D.idDiscapacidad) as idD 
  FROM Discapacidad as D ";
  $result = mysqli_query($conexion_bd, $sql);
  $id=-1 ;
  while($row = mysqli_fetch_assoc($result)){
    $id = $row['idD' ];
  }
  
  cerrar_bd($conexion_bd);
  return $id;
}
function getLastIdInsert($tabla,$campo) {
  $conexion_bd = conectar_bd();
  $sql = "SELECT  Max(t.$campo) as id 
  FROM $tabla as t ";
  $result = mysqli_query($conexion_bd, $sql);
  $id=-1 ;
  while($row = mysqli_fetch_assoc($result)){
    $id = $row['id' ];
  }
  
  cerrar_bd($conexion_bd);
  return $id;
}
function editarDiscapacidad($Discapacidad_id, $nombre) {
  $conexion_bd = conectar_bd();
    
  //Prepara la consulta
  $dml = 'UPDATE Discapacidad SET nombre=(?) WHERE idDiscapacidad=(?)';
  if ( !($statement = $conexion_bd->prepare($dml)) ) {
      die("Error: (" . $conexion_bd->errno . ") " . $conexion_bd->error);
      return 0;
  }
    
  //Unir los parámetros de la función con los parámetros de la consulta   
  //El primer argumento de bind_param es el formato de cada parámetro
  if (!$statement->bind_param("ss", $nombre, $Discapacidad_id)) {
      die("Error en vinculación: (" . $statement->errno . ") " . $statement->error);
      return 0;
  }
    
  //Executar la consulta
  if (!$statement->execute()) {
    die("Error en ejecución: (" . $statement->errno . ") " . $statement->error);
      return 0;
  }

  cerrar_bd($conexion_bd);
    return 1;
}
function eliminarDiscapacidad($discapacidad_id) {
  $conexion_bd = conectar_bd();
  //Prepara la consulta
  $dml = 'UPDATE Discapacidad SET Discapacidad.activo=0 WHERE Discapacidad.idDiscapacidad=(?)';
  if ( !($statement = $conexion_bd->prepare($dml)) ) {
      die("Error: (" . $conexion_bd->errno . ") " . $conexion_bd->error);
      return 0;
  }
    
  //Unir los parámetros de la función con los parámetros de la consulta   
  //El primer argumento de bind_param es el formato de cada parámetro
  if (!$statement->bind_param("i",$discapacidad_id)) {
      die("Error en vinculación: (" . $statement->errno . ") " . $statement->error);
      return 0;
  }
    
  //Executar la consulta
  if (!$statement->execute()) {
    die("Error en ejecución: (" . $statement->errno . ") " . $statement->error);
      return 0;
  }

  cerrar_bd($conexion_bd);
    return 1;
}

function getCoordinacioness($nombre=""){
  $con = conectar_bd();
  $sql = "SELECT  A.idCoordinaciones as idA, A.nombre as NombreA
  FROM Coordinaciones as A Where A.activo = 1 ";
  if($nombre != ""){
      $sql .= " AND A.nombre like '%".$nombre."%'";
  }
  $result = mysqli_query($con, $sql);
  $tabla = "";
  if(mysqli_num_rows($result)){
      $tabla .= "<table class=\"highlight centered\">";
      $tabla .= "<thead><tr><th>Nombre</th><th colspan='2'>Acción</th></thead>";
      while($row = mysqli_fetch_assoc($result)){   
          $tabla .= "<tr>";
          $tabla .= "<td>". $row["NombreA"]. "</td>";
          $tabla .= '<td><a class="waves-effect waves-light btn-small" title="Editar datos de la cordinacion" href="editarCoordinaciones.php?Coordinaciones_id='.$row['idA'].'">'."<i class=\"material-icons\">create</i>"."</a>";
          $tabla .= "</td>"; 
          $tabla .= '<td><a class="waves-effect waves-light btn-small" title="Eliminar cordinacion" href="eliminarCoordinaciones.php?Coordinaciones_id='.$row['idA'].'">'."<i class=\"material-icons\">delete_forever</i>"."</a>";
          $tabla .= "</td>"; 
          $tabla .= "</tr>";
      }
      $tabla .= "</table>";
  }
  else{
    $tabla .= "
    <div class=\"row\">
    <div class=\"col s12 m12 l12\">
        <div class=\"card blue lighten-1\">
            <div class=\"card-content white-text\">
                <span class=\"card-title\">No se encontró ningún resultado de ".$nombre."</span>
            </div>
        </div>
    </div>
</div>
    ";
  }
  cerrar_bd($con);
  
  return $tabla;
}

function getCoordinacionesById($id){
  $con = conectar_bd();
  
  $sql = "SELECT  A.idCoordinaciones as idA, A.nombre as NombreA, A.activo as activo
  FROM Coordinaciones as A ";
  $sql .= " Where A.idCoordinaciones = '".$id."'";

  $result = mysqli_query($con, $sql);
  $resultado = "";
  
  
  while($row = mysqli_fetch_assoc($result)){
      $resultado .= "<br>
      <div class=\"card teal lighten-2\">
      <div class=\"card-content teal lighten-3\">
      <div class=\" center\" data-indicators=\"true\">
        <div class=\"teal lighten-5 \" href=\"#one!\" >
        <div class='row'>

          <div class=\"col s12 align-center\">
              <!-- Elemento -->
              <div class=\"file-field input-field\">
                <div class=\"col s12\">
                  <label>Nombre de la Área</label>
                  <p>".$row["NombreA"]."</p>
              </div>
              </div>

              <div class=\"file-field input-field\">
                <div class=\"input-field col s12 l12 left\">
                  <a id=\"confirmarEliminarCoordinaciones\" href=\"Controladores\Coordinaciones\controladorEliminarCoordinaciones.php?Coordinaciones_id=$id\" class=\"waves-effect red deep-orange darken-4 btn right\">eliminar
                    <i class=\"material-icons right\">remove</i>
                  </a>
                  <a id=\"\" href=\"consultaCoordinaciones.php\" class=\"waves-effect green lighten-3 btn right\">Volver<i class=\"material-icons right\">undo</i>
                  </a>
              </div>
              </div>

            </div>
        </div>
      </div>
      </div>
      </div>
      </div>";
  }
  cerrar_bd($con);
  
  return $resultado;

}
function textarea($id=""){
  $con = conectar_bd();
      $sql = "SELECT  A.idCoordinaciones as idA, A.nombre as NombreA
      FROM Coordinaciones as A Where A.idCoordinaciones = '".$id."'";
      $result = mysqli_query($con, $sql);

  $resultado = "<div class=\"file-field input-field\">
                          <div class=\"input-field col s12\">
                              <i class=\"material-icons prefix\"> </i>
                              <input placeholder=\"secundaria general 1\" type=\"text\"  name=\"Coordinaciones_nombre\" id=\"Coordinaciones_nombre\"
                              ";
      while($row = mysqli_fetch_assoc($result)){      
              $resultado .= " value=\"$row[NombreA]\"";
                  
      }
  $resultado .="
                  required>
                  <label for=\"rol\"><strong>Nombre</strong></label>     
                  </div>
                  </div>";
  cerrar_bd($con);
  return $resultado;

}
function insertarCoordinaciones($nombre) {
  $conexion_bd = conectar_bd();
  $activo=1;
  //Prepara la consulta
  $dml = 'INSERT INTO Coordinaciones (nombre, activo) VALUES (?,?)';
  if ( !($statement = $conexion_bd->prepare($dml)) ) {
      die("Error: (" . $conexion_bd->errno . ") " . $conexion_bd->error);
      return 0;
  }
  //Unir los parámetros de la función con los parámetros de la consulta   
  //El primer argumento de bind_param es el formato de cada parámetro
  if (!$statement->bind_param("si", $nombre,$activo)) {
      die("Error en vinculación: (" . $statement->errno . ") " . $statement->error);
      return 0;
  } 
  //Executar la consulta
  if (!$statement->execute()) {
    die("Error en ejecución: (" . $statement->errno . ") " . $statement->error);
      return 0;
  }
  cerrar_bd($conexion_bd);
    return 1;
}


function editarCoordinaciones($Coordinaciones_id, $nombre) {
  $conexion_bd = conectar_bd();
    
  //Prepara la consulta
  $dml = 'UPDATE Coordinaciones SET nombre=(?) WHERE idCoordinaciones=(?)';
  if ( !($statement = $conexion_bd->prepare($dml)) ) {
      die("Error: (" . $conexion_bd->errno . ") " . $conexion_bd->error);
      return 0;
  }
    
  //Unir los parámetros de la función con los parámetros de la consulta   
  //El primer argumento de bind_param es el formato de cada parámetro
  if (!$statement->bind_param("ss", $nombre, $Coordinaciones_id)) {
      die("Error en vinculación: (" . $statement->errno . ") " . $statement->error);
      return 0;
  }
    
  //Executar la consulta
  if (!$statement->execute()) {
    die("Error en ejecución: (" . $statement->errno . ") " . $statement->error);
      return 0;
  }

  cerrar_bd($conexion_bd);
    return 1;
}
function eliminarCoordinaciones($Coordinaciones_id) {
  $conexion_bd = conectar_bd();
  //Prepara la consulta
  $dml = 'UPDATE Coordinaciones SET Coordinaciones.activo=0 WHERE Coordinaciones.idCoordinaciones=(?)';
  if ( !($statement = $conexion_bd->prepare($dml)) ) {
      die("Error: (" . $conexion_bd->errno . ") " . $conexion_bd->error);
      return 0;
  }
    
  //Unir los parámetros de la función con los parámetros de la consulta   
  //El primer argumento de bind_param es el formato de cada parámetro
  if (!$statement->bind_param("i",$Coordinaciones_id)) {
      die("Error en vinculación: (" . $statement->errno . ") " . $statement->error);
      return 0;
  }
    
  //Executar la consulta
  if (!$statement->execute()) {
    die("Error en ejecución: (" . $statement->errno . ") " . $statement->error);
      return 0;
  }

  cerrar_bd($conexion_bd);
    return 1;
}



function getEspecialidades($nombre=""){
  $con = conectar_bd();
  $sql = "SELECT  E.idEspecialidad as idE, A.idCoordinaciones as idA,A.nombre AS NombreA ,E.nombre as NombreE
  FROM Coordinaciones as A, Especialidad as E where E.idCoordinaciones = A.idCoordinaciones and E.activo = 1 ";
  if($nombre != ""){
      $sql .= "    and E.nombre like '%".$nombre."%'";
  }
  $result = mysqli_query($con, $sql);
  $tabla = "";
  if(mysqli_num_rows($result)){
      $tabla .= "<table class=\"highlight centered\">";
      $tabla .= "<thead><tr><th>Nombre Área</th><th>Nombre Especialidad</th><th colspan='2'>Acción</th></thead>";
      while($row = mysqli_fetch_assoc($result)){   
          $tabla .= "<tr>";
          $tabla .= "<td>". $row["NombreA"]. "</td>";
          $tabla .= "<td>". $row["NombreE"]. "</td>";
          $tabla .= '<td><a class="waves-effect waves-light btn-small" title="Editar datos de la especialidad" href="editarEspecialidad.php?especialidad_id='.$row['idE'].'&&Coordinaciones_id='.$row['idA'].'">'."<i class=\"material-icons\">create</i>"."</a>";
          $tabla .= "</td>"; 
          $tabla .= '<td><a class="waves-effect waves-light btn-small" title="Eliminar Especialidad" href="eliminarEspecialidad.php?especialidad_id='.$row['idE'].'">'."<i class=\"material-icons\">delete_forever</i>"."</a>";
          $tabla .= "</td>"; 
          $tabla .= "</tr>";
      }
      $tabla .= "</table>";
  }
  else{
    $tabla .= "
    <div class=\"row\">
    <div class=\"col s12 m12 l12\">
        <div class=\"card blue lighten-1\">
            <div class=\"card-content white-text\">
                <span class=\"card-title\">No se encontró ningún resultado de ".$nombre."</span>
            </div>
        </div>
    </div>
</div>
    ";
  }
  cerrar_bd($con);
  
  return $tabla;
}

function getEspecialidadById($id){
  $con = conectar_bd();
  
  $sql = "SELECT  E.idEspecialidad as idE,A.nombre AS NombreA ,E.nombre as NombreE, E.activo as activo
  FROM Coordinaciones as A, Especialidad as E ";
  $sql .= " Where E.idCoordinaciones = A.idCoordinaciones and E.idEspecialidad = '".$id."'";

  $result = mysqli_query($con, $sql);
  $resultado = "";
  
  
  while($row = mysqli_fetch_assoc($result)){
      $resultado .= "<br>
      <div class=\"card teal lighten-2\">
      <div class=\"card-content teal lighten-3\">
      <div class=\" center\" data-indicators=\"true\">
        <div class=\" teal lighten-5 \" href=\"#one!\" >
        <div class='row'>

          <div class=\"col s12 align-center\">
              <!-- Elemento -->
              <div class=\"file-field input-field\">
                <div class=\"col s12\">
                  <label>Nombre de la Área</label>
                  <p>".$row["NombreA"]."</p>
                </div>
              </div>
              <br>
              <br>
              <!-- Elemento -->
              <div class=\"file-field input-field\">
                <div class=\"col s12\">
                  <label>Nombre de la especialidad</label>
                  <p>".$row["NombreE"]."</p>
                </div>
              </div>
              <div class=\"file-field input-field\">
                <div class=\"input-field col s12 l12 left\">
                  <a id=\"confirmarEliminarEspecialidad\" href=\"Controladores\Especialidad\controladorEliminarEspecialidad.php?especialidad_id=$id\" class=\"waves-effect red deep-orange darken-4 btn right\">eliminar
                    <i class=\"material-icons right\">remove</i>
                  </a>
                  <a id=\"\" href=\"consultaEspecialidad.php\" class=\"waves-effect green lighten-3 btn right\">Volver<i class=\"material-icons right\">undo</i>
                  </a>
              </div>
              </div>
              </div>
            </div>
        </div>
      </div>
      </div>
      </div>";
  }
  cerrar_bd($con);
  
  return $resultado;

}
function textEspecialidad($id=""){
  $con = conectar_bd();
      $sql = "SELECT  E.idEspecialidad as idE, E.nombre as NombreE
      FROM Especialidad as E Where E.idEspecialidad = '".$id."'";
      $result = mysqli_query($con, $sql);

  $resultado = "<div class=\"file-field input-field\">
                          <div class=\"input-field col s12\">
                              <i class=\"material-icons prefix\"> </i>
                              <input placeholder=\"secundaria general 1\" type=\"text\"  name=\"especialidad_nombre\" id=\"especialidad_nombre\"
                              ";
      while($row = mysqli_fetch_assoc($result)){      
              $resultado .= " value=\"$row[NombreE]\"";
                  
      }
  $resultado .="
                  required>
                  <label for=\"rol\"><strong>Nombre</strong></label>     
                  </div>
                  </div>";
  cerrar_bd($con);
  return $resultado;

}
function insertarEspecialidad($nombre,$Coordinaciones) {
  $conexion_bd = conectar_bd();
  $activo=1;
  //Prepara la consulta
  $dml = 'INSERT INTO Especialidad (nombre,idCoordinaciones,activo) VALUES (?,?,?)';
  if ( !($statement = $conexion_bd->prepare($dml)) ) {
      die("Error: (" . $conexion_bd->errno . ") " . $conexion_bd->error);
      return 0;
  }
  //Unir los parámetros de la función con los parámetros de la consulta   
  //El primer argumento de bind_param es el formato de cada parámetro
  if (!$statement->bind_param("sii", $nombre,$Coordinaciones,$activo)) {
      die("Error en vinculación: (" . $statement->errno . ") " . $statement->error);
      return 0;
  } 
  //Executar la consulta
  if (!$statement->execute()) {
    die("Error en ejecución: (" . $statement->errno . ") " . $statement->error);
      return 0;
  }
  cerrar_bd($conexion_bd);
    return 1;
}


function editarEspecialidad($especialidad_id,$Coordinaciones_id, $nombre) {
  $conexion_bd = conectar_bd();
    
  //Prepara la consulta
  $dml = 'UPDATE Especialidad SET nombre=(?),  idCoordinaciones = (?)WHERE idEspecialidad=(?)';
  if ( !($statement = $conexion_bd->prepare($dml)) ) {
      die("Error: (" . $conexion_bd->errno . ") " . $conexion_bd->error);
      return 0;
  }
    
  //Unir los parámetros de la función con los parámetros de la consulta   
  //El primer argumento de bind_param es el formato de cada parámetro
  if (!$statement->bind_param("sss", $nombre, $Coordinaciones_id,$especialidad_id)) {
      die("Error en vinculación: (" . $statement->errno . ") " . $statement->error);
      return 0;
  }
    
  //Executar la consulta
  if (!$statement->execute()) {
    die("Error en ejecución: (" . $statement->errno . ") " . $statement->error);
      return 0;
  }

  cerrar_bd($conexion_bd);
    return 1;
}
function eliminarEspecialidad($especialidad_id) {
  $conexion_bd = conectar_bd();
  //Prepara la consulta
  $dml = 'UPDATE Especialidad SET Especialidad.activo=0 WHERE Especialidad.idEspecialidad=(?)';
  if ( !($statement = $conexion_bd->prepare($dml)) ) {
      die("Error: (" . $conexion_bd->errno . ") " . $conexion_bd->error);
      return 0;
  }
    
  //Unir los parámetros de la función con los parámetros de la consulta   
  //El primer argumento de bind_param es el formato de cada parámetro
  if (!$statement->bind_param("i",$especialidad_id)) {
      die("Error en vinculación: (" . $statement->errno . ") " . $statement->error);
      return 0;
  }
    
  //Executar la consulta
  if (!$statement->execute()) {
    die("Error en ejecución: (" . $statement->errno . ") " . $statement->error);
      return 0;
  }

  cerrar_bd($conexion_bd);
    return 1;
}

function crear_selectCoordinaciones($seleccion=0) {
  $conexion_bd = conectar_bd();  
    
  $resultado = '<div class="formato1" class="input-field"><select name="Coordinaciones" required><option value="" disabled selected>Selecciona una opción</option>';
          
  $consulta = "SELECT 
  A.idCoordinaciones as Coordinaciones_Id, A.nombre as Coordinaciones_nombre
  from Coordinaciones as A ";
  $resultados = $conexion_bd->query($consulta);
  while ($row = mysqli_fetch_array($resultados, MYSQLI_BOTH)) {
      $resultado .= '<option value="'.$row["Coordinaciones_Id"].'"';
      if($seleccion == $row["Coordinaciones_Id"]) {
          $resultado .= 'selected';
      }
      $resultado .='>'.$row["Coordinaciones_Id"].'.-'.$row["Coordinaciones_nombre"].'</option>';

  }
      
  cerrar_bd($conexion_bd);
  $resultado .=  '</select><label class="formato1" for="rol">'.'<strong>Área</strong>'.'...</label></div>';
  return $resultado;
}



//////////////////////////////canalizador


function getCanalizadorPorNombre($nombre=''){
  $conexion_bd = conectar_bd();
  $sql = "SELECT c.IdCanalizador, c.nombre,c.cargo,i.idInstitucion,i.nombre as Institucion,c.telefono,c.correoElectronico,c.tipoIdentificacion,c.numeroDeIdentificacion
  FROM Canalizador as c, Institucion as i
  WHERE i.idInstitucion = c.idInstitucion
  AND c.nombre LIKE '%".$nombre."%'
  AND c.activo = true";
  $result = mysqli_query($conexion_bd, $sql);
  cerrar_bd($conexion_bd);

  return $result;
}

function nuevoCanalizador($idInstitucion,$nombre,$cargo,$telefono,$correoElectronico,$tipoIdentificacion,$numeroDeIdentificacion,$motivo){
  $activo = "1";
    $conexion_bd = conectar_bd();
      
    //Prepara la consulta
    $dml = 'INSERT INTO `Canalizador` (`idInstitucion`,`nombre`,`cargo`,`telefono`,`correoElectronico`,`tipoIdentificacion`,`numeroDeIdentificacion`,`motivo`,`activo`) VALUES (?,?,?,?,?,?,?,?,?)';
    if ( !($statement = $conexion_bd->prepare($dml)) ) {
        die("Error: (" . $conexion_bd->errno . ") " . $conexion_bd->error);
        return 0;
    }
      
    //Unir los parámetros de la función con los parámetros de la consulta   
    //El primer argumento de bind_param es el formato de cada parámetro
    if (!$statement->bind_param("sssssssss",$idInstitucion,$nombre,$cargo,$telefono,$correoElectronico,$tipoIdentificacion,$numeroDeIdentificacion,$motivo, $activo)) {
        die("Error en vinculación: (" . $statement->errno . ") " . $statement->error);
        return 0;
    }
      
    //Executar la consulta
    if (!$statement->execute()) {
      die("Error en ejecución: (" . $statement->errno . ") " . $statement->error);
        return 0;
    }

    cerrar_bd($conexion_bd);
      return 1;
}

function eliminarCanalizador($id){
  $conexion_bd = conectar_bd();
  $sql = "DELETE FROM Canalizador WHERE IdCanalizador = '$id'";
  $result = mysqli_query($conexion_bd, $sql);
  cerrar_bd($conexion_bd);

  return $result;
}

function estadoCanalizador($id){
  $conexion_bd = conectar_bd();
  $sql = "UPDATE Canalizador 
  SET activo=false
  WHERE IdCanalizador = '$id'";
  $result = mysqli_query($conexion_bd, $sql);
  cerrar_bd($conexion_bd);

  return $result;
}

function editarCanalizador($idCanalizador,$idInstitucion,$nombre,$cargo,$telefono,$correoElectronico,$tipoIdentificacion,$motivo,$numeroDeIdentificacion){
  $conexion_bd = conectar_bd();
  $sql = "UPDATE Canalizador 
  SET idInstitucion = '$idInstitucion', nombre='$nombre', cargo = '$cargo', telefono='$telefono', correoElectronico='$correoElectronico', tipoIdentificacion='$tipoIdentificacion', numeroDeIdentificacion='$numeroDeIdentificacion', motivo='$motivo'
  WHERE IdCanalizador = '$idCanalizador'";
  $result = mysqli_query($conexion_bd, $sql);
  cerrar_bd($conexion_bd);

  return $result;
}

function showQueryCanalizador($result,$nombre){
  if(mysqli_num_rows($result) > 0){
      echo '<table class=\"highlight centered\><tr>';
      echo '<th>'.'Nombre'.'</th>';
      echo '<th>'.'Institución'.'</th>';
      echo '<th>'.'Teléfono'.'</th>';
      echo '<th>'.'Email'.'</th>';
      echo '<th>'.''.'</th>';

      echo '<th>'.'Acción'.'</th>';
      echo '<th>'.''.'</th>';
      echo '</tr>';
      while($row = mysqli_fetch_assoc($result)){
          echo '<tr>';
          echo '<td>'.$row['nombre'].'</td>';
          echo '<td>'.$row['Institucion'].'</td>';
          echo '<td>'.$row['telefono'].'</td>';
          echo '<td>'.$row['correoElectronico'].'</td>';
          echo '<td><a class="waves-effect waves-light btn-small" title="Consultar datos de la persona vinculada" href="consultarCanalizador.php?canalizador_id='.$row['IdCanalizador'].'">'."<i class=\"material-icons\">remove_red_eye</i>"."</a>";
          echo "</td>";
          echo '<td><a class="waves-effect waves-light btn-small" title="Editar datos de la persona vinculada" href="editarCanalizador.php?canalizador_id='.$row['IdCanalizador'].'&i='.$row['idInstitucion'].'">'."<i class=\"material-icons\">create</i>"."</a>";
          echo "</td>"; 
          echo '<td><a class="waves-effect waves-light btn-small" title="Eliminar persona vinculada" href="eliminarCanalizador.php?canalizador_id='.$row['IdCanalizador'].'">'."<i class=\"material-icons\">delete_forever</i>"."</a>";
          echo "</td>"; 
          echo '</tr>';
      }
      echo '</table>';
  }
  else{
    echo "
    <div class=\"row\">
    <div class=\"col s12 m12 l12\">
        <div class=\"card blue lighten-1\">
            <div class=\"card-content white-text\">
                <span class=\"card-title\">No se encontró ningún resultado de ".$nombre."</span>
            </div>
        </div>
    </div>
  </div>
    ";
  }
  mysqli_free_result($result);
}

function getCanalizadorByIdE($id){
$con = conectar_bd();

$sql = "SELECT  IdCanalizador, nombre
FROM Canalizador
 WHERE IdCanalizador = $id";

$result = mysqli_query($con, $sql);
$resultado = "";


while($row = mysqli_fetch_assoc($result)){
    $resultado .= "<br>
    <div class=\"card teal lighten-2\">
    <div class=\"card-content teal lighten-3\">
    <div class=\" center\" data-indicators=\"true\">
      <div class=\" teal lighten-5 \" href=\"#one!\" id=\"carousel-Docs\">
      <div class='row'>

      <div class=\"col s12 align-center\">
            <!-- Elemento -->
            <div class=\"file-field input-field\">
              <div class=\"col s12 m12 l12\">
                <label>Nombre del Canalizador</label>
                <p>".$row["nombre"]."</p>
            </div>
            </div>

            <div class=\"file-field input-field\">
                  <div class=\"input-field col s12 l12 left\">
                    <a id=\"confirmarEliminarEscolaridad\" href=\"Controladores\Canalizador\controladorEliminarCanalizador.php?canalizador_id=".$id."\" class=\"waves-effect red deep-orange darken-4 btn right\">eliminar
                      <i class=\"material-icons right\">remove</i>
                    </a>
                    <a id=\"\" href=\"consultaCanalizador.php\" class=\"waves-effect green lighten-3 btn right\">Volver<i class=\"material-icons right\">undo</i>
                    </a>
                </div>
                </div>
           
          </div>
      </div>
    </div>
    </div>
    </div>
    </div>";
}
mysqli_free_result($result);
cerrar_bd($con);

return $resultado;

}

function getCanalizadorByIdC($id){
  $con = conectar_bd();
  
  $sql = "SELECT c.IdCanalizador, c.nombre,c.cargo,i.nombre as Institucion,c.telefono,c.correoElectronico,c.tipoIdentificacion,c.numeroDeIdentificacion,c.motivo
  FROM Canalizador as c, Institucion as i
  WHERE i.idInstitucion = c.idInstitucion
  AND c.IdCanalizador =  '$id'";

  $result = mysqli_query($con, $sql);
  $resultado = "";
  
  
  while($row = mysqli_fetch_assoc($result)){
      $resultado .= "<br>
      <div class=\"card teal lighten-2\">
      <div class=\"card-content teal lighten-3\">
      <div class=\" center\" data-indicators=\"true\">
        <div class=\"teal lighten-5 \" href=\"#one!\" >
        <div class='row'>

          <div class=\"col s12 align-center\">
              <!-- Elemento -->
              <div class=\"file-field input-field\">
                <div class=\"col s6\">
                  <label>Nombre del Canalizador</label>
                  <p>".$row["nombre"]."</p>
              </div>
              </div>

              <div class=\"file-field input-field\">
                  <div class=\"col s6 m6 l6\">
                      <label>Institucion a la que pertecene</label>
                      <p>".$row["Institucion"]."</p>
                  </div>
              </div>
              <br>
              <div class=\"row\">
              <div class=\"col s12\">
                  <br>
                  </div>
                <div class=\"file-field input-field\">
                  <div class=\"col s6\">
                      <label>Telefono</label>
                      <p>".$row["telefono"]."</p>
                  </div>
                  
                  <div class=\"col s6\">
                    <label>Cargo</label>
                    <p>".$row["cargo"]."</p>
                  </div>
                </div>
                
                <div class=\"file-field input-field\">
                <div class=\"col s6\">
                    <label>Correo Electronico</label>
                    <p>".$row["correoElectronico"]."</p>
                </div>
            </div>
            <div class=\"file-field input-field\">
            <div class=\"col s6\">
                <label>Identificacion</label>
                <p>".$row["tipoIdentificacion"]." - ".$row["numeroDeIdentificacion"]."</p>
            </div>
        </div>

              </div>

             
              <div class=\"file-field input-field\">
              <div class=\"col s12\">
                  <label>Motivo de Vinculación</label>
                  <p>".$row["motivo"]."</p>
              </div>
          </div>
          <br>
              
              <br>
              <div class=\"file-field input-field\">
                <div class=\"input-field col s12 l12 left\">
                  <a id=\"\" href=\"consultaCanalizador.php\" class=\"waves-effect green lighten-3 btn right\">Volver<i class=\"material-icons right\">undo</i>
                  </a>
              </div>
              </div>
            </div>
        </div>
        </div>
      </div>
      </div>
      </div>";
  }

  cerrar_bd($con);
  mysqli_free_result($result);
  
  return $resultado;

}

function crear_selectInstituciones($id, $columna_descripcion, $tabla, $seleccion=0) {
  $conexion_bd = conectar_bd();  
    
  $resultado = '<div class="selectI"class="input-field"><select required name="'.$tabla.'" ><option value="" disabled selected>Selecciona una opción</option>';
          
  $consulta = "SELECT $id, $columna_descripcion FROM $tabla WHERE activo=1";
  $resultados = $conexion_bd->query($consulta);
  while ($row = mysqli_fetch_array($resultados, MYSQLI_BOTH)) {
      $resultado .= '<option value="'.$row["$id"].'" ';
      if($seleccion == $row["$id"]) {
          $resultado .= 'selected';
      }
      $resultado .= '>'.$row["$columna_descripcion"].'</option>';
  }
      
  cerrar_bd($conexion_bd);
  $resultado .=  '</select><label class="selectINombre" for="rol"><strong>Institución</strong></label></div>';
  return $resultado;
}

function editCanalizador($id){
  $con = conectar_bd();
  
  $sql = "SELECT c.IdCanalizador, c.nombre,c.cargo,i.nombre as Institucion,c.telefono,c.correoElectronico,c.tipoIdentificacion,c.numeroDeIdentificacion,c.motivo
  FROM Canalizador as c, Institucion as i
  WHERE i.idInstitucion = c.idInstitucion
  AND c.IdCanalizador =  '$id'";

  $result = mysqli_query($con, $sql);
  $resultado = "";
  
  
  while($row = mysqli_fetch_assoc($result)){
      $resultado .= "<br>
      <div class=\"card teal lighten-2\">
      <div class=\"card-content teal lighten-3\">
      <div class=\" center\" data-indicators=\"true\">
        <div class=\" teal lighten-5 \" href=\"#one!\" id=\"diagForm\">
        <div class='row'>

        <div class=\"col s12 align-center\">
            <form action=\"Controladores\Canalizador\controladorEditarCanalizador.php\" method=\"POST\">
                <!-- Elemento -->
                <div class=\"file-field input-field\">
                  <div class=\"input-field col s8\">
                    <i class=\"material-icons prefix\"> </i>
                    <input placeholder=\"Juan Perez\" type=\"text\" class=\"validate\" value=\"".$row["nombre"]."\" name=\"nombre\" id=\"nombre\"required>
                    <label for=\"rol\"><strong>Nombre</strong></label>     
                </div>
                </div>
                  <!-- Elemento -->
                 <div class=\"file-field input-field\">
                  <div class=\"input-field col s4\">
                    <i class=\"material-icons prefix\"> </i>
      "
                 ;
  }
  mysqli_free_result($result);
  cerrar_bd($con);
  
  return $resultado;
}


function editCanalizador2($id){
  $con = conectar_bd();
  
  $sql = "SELECT c.IdCanalizador, c.nombre,c.cargo,i.nombre as Institucion,c.telefono,c.correoElectronico,c.tipoIdentificacion,c.numeroDeIdentificacion,c.motivo
  FROM Canalizador as c, Institucion as i
  WHERE i.idInstitucion = c.idInstitucion
  AND c.IdCanalizador =  '$id'";

  $result = mysqli_query($con, $sql);
  $resultado = "";
  
  
  while($row = mysqli_fetch_assoc($result)){
      $resultado .= " </div>
      </div>
      <!-- Elemento -->
      <div class=\"file-field input-field\">
        <div class=\"input-field col s8\">
          <i class=\"material-icons prefix\"> </i>
          <input placeholder=\"..@gmail.com\" type=\"text\" class=\"validate\" value=\"".$row["correoElectronico"]."\" name=\"email\" id=\"email\" required>
          <label for=\"rol\"><strong>Correo Electrónico</strong></label>     
        </div>
      </div>

      <!-- Elemento -->
      <div class=\"file-field input-field\">
        <div class=\"input-field col s4\">
          <i class=\"material-icons prefix\"> </i>
          <input placeholder=\"Numero de telefono\" type=\"text\" class=\"validate\"value=\"".$row["telefono"]."\" name=\"telefono\" id=\"telefono\" required>
          <label for=\"rol\"><strong>Teléfono</strong></label>     
        </div>
      </div>
      <!-- Elemento -->
      <div class=\"file-field input-field\">
        <div class=\"input-field col s8\">
          <i class=\"material-icons prefix\"> </i>
          <input placeholder=\"A05848754154\" type=\"text\" class=\"validate\"value=\"".$row["numeroDeIdentificacion"]."\" name=\"numeroI\" id=\"numeroI\" required>
          <label for=\"rol\"><strong>Numero de identificación</strong></label>     
        </div>
      </div>

    <!-- Elemento -->
      <div class=\"file-field input-field\">
        <div class=\"input-field col s4\">
          <i class=\"material-icons prefix\"> </i>
          <input placeholder=\"INE/Pasaporte\" type=\"text\" class=\"validate\" value=\"".$row["tipoIdentificacion"]."\"name=\"identificacion\" id=\"identificacion\" required>
          <label for=\"rol\"><strong>Identificación</strong></label>     
        </div>
      </div> 
        <!-- Elemento -->
        <div class=\"file-field input-field\">
          <div class=\"input-field col s12\">
            <i class=\"material-icons prefix\"> </i>
            <input placeholder=\"Supervisor\" type=\"text\" class=\"validate\"value=\"".$row["cargo"]."\" name=\"cargo\" id=\"cargo\" required>
            <label for=\"rol\"><strong>Cargo</strong></label>     
          </div>
        </div>
      <!-- Elemento -->
      <div class=\"file-field input-field\">
        <div class=\"input-field col s12\">
          <i class=\"material-icons prefix\"> </i>
          <div>
            <label for=\"rol\"><strong>Motivo</strong></label>     
          </div>
          <textarea required name=\"motivo\"wrap rows=\"5\" cols=\"30\">".$row["motivo"]."</textarea>

      </div>
      </div>




    </div>
        <div class=\" col s12 l12 left\">
          <button class=\"waves-effect waves-light btn right\" type=\"submit\" name=\"action\">Registrar<i class=\"material-icons right\">add</i></button>
          <a  href=\"consultaCanalizador.php\" class=\"waves-effect green lighten-3 btn right\">Volver<i class=\"material-icons right\">undo</i></a>

        </div>
        



  </form>
  </div>
  </div>
</div>
</div>
</div>
</div>

<script>
$(document).ready(function () {
$('.carousel').carousel();
$('.carousel.carousel-slider').carousel({ fullWidth: true , noWrap: true});
$('.slide-prev').click(function (e) {
e.preventDefault();
e.stopPropagation();
$('.carousel').carousel('prev')
});
$('.slide-next').click(function (e) {
e.preventDefault();
e.stopPropagation();
$('.carousel').carousel('next')
});

});
</script>" ;
  }
  mysqli_free_result($result);
  cerrar_bd($con);
  
  return $resultado;
}

function estadoMedicamento($id){
  $conexion_bd = conectar_bd();
  $sql = "UPDATE Medicamentos 
  SET activo=false
  WHERE idMedicamento = '$id'";
  $result = mysqli_query($conexion_bd, $sql);
  cerrar_bd($conexion_bd);

  return $result;
}

function editMedicamento($id){
  $con = conectar_bd();
  
  $sql = "SELECT m.idMedicamento as id, m.nombre,ingredienteActivo  
  FROM Medicamentos as m
  WHERE m.idMedicamento = $id";

  $result = mysqli_query($con, $sql);
  $resultado = "";
  
  
  while($row = mysqli_fetch_assoc($result)){
      $resultado .= "<br>
      <div class=\"card teal lighten-2\">
      <div class=\"card-content teal lighten-3\">
      <div class=\" center\" data-indicators=\"true\">
      
        <div class=\" teal lighten-5 \" href=\"#one!\">
        <div class='row'>
          <div class=\"col s12 align-center\">
            <form action=\"Controladores\Medicamento\controladorModificarMedicamento.php\" method=\"POST\">
                <!-- Elemento -->
                <div class=\"file-field input-field\">
                  <div class=\"input-field col s8\">
                    <i class=\"material-icons prefix\"> </i>
                    <input placeholder=\"Paracetamol\" type=\"text\" class=\"validate\"value=\"".$row["nombre"]."\" name=\"nombre\" id=\"nombre\"required>
                    <label for=\"rol\"><strong>Nombre</strong></label>     
                </div>
                </div>
                          <!-- Elemento -->
                <div class=\"file-field input-field\">
                  <div class=\"input-field col s4\">
                    <i class=\"material-icons prefix\"> </i>
      "
                 ;
  }
  mysqli_free_result($result);

  cerrar_bd($con);
  
  return $resultado;
}


function editMedicamento2($id){
  $con = conectar_bd();
  
  $sql = "SELECT m.idMedicamento as id, m.nombre,ingredienteActivo  
  FROM Medicamentos as m
  WHERE m.idMedicamento = $id";

  $result = mysqli_query($con, $sql);
  $resultado = "";
  
  
  while($row = mysqli_fetch_assoc($result)){
      $resultado .= " </div>
      </div>
      <!-- Elemento -->
      <div class=\"file-field input-field\">
        <div class=\"input-field col s12\">
          <i class=\"material-icons prefix\"> </i>
          <input placeholder=\"Paracetamol\" type=\"text\" class=\"validate\"value=\"".$row["ingredienteActivo"]."\" name=\"ingrediente\" id=\"ingrediente\" required>
          <label for=\"rol\"><strong>Ingrediente Activo</strong></label>     
        </div>
      </div>



    </div>
    <div class=\"file-field input-field\">
    <div class=\"input-field col s12 l12 left\">

          <button class=\"waves-effect waves-light btn right\" type=\"submit\" name=\"action\">Registrar<i class=\"material-icons right\">add</i></button>
          <a  href=\"consultaMedicamento.php\" class=\"waves-effect green lighten-3 btn right\">Volver<i class=\"material-icons right\">undo</i></a>

        </div>
        </div>

  </form>
  </div>
</div>
</div>
</div>
</div>
</div>
" ;
  }
  mysqli_free_result($result);
  cerrar_bd($con);
  
  return $resultado;
}
function getNombres($nombre=''){
  $conexion_bd = conectar_bd();
  $sql = "SELECT idDeIngreso,nombre,apellidoP,apellidoM
  FROM Beneficiaria
  WHERE activo = true";
  if($nombre != ""){
    $sql .= " and ((nombre like '%$nombre%') OR (apellidoP like '%".$nombre."%') OR (apellidoM like '%$nombre%'))";
  }
  $result = mysqli_query($conexion_bd, $sql);
  cerrar_bd($conexion_bd);

  return $result;
}

function showQueryDiagnostico($result,$nombre){
  if(mysqli_num_rows($result) > 0){
      echo '<table class=\"highlight centered\><tr>';
      echo '<th>'.'Nombre'.'</th>';
      echo '</tr>';
      while($row = mysqli_fetch_assoc($result)){
          echo '<tr>';
          echo '<td>'.$row['nombre'].' '.$row['apellidoP'].' '.$row['apellidoM'].'</td>';
          echo '<td><a class="waves-effect waves-light btn-small" title="Consultar datos del diagnostico" href="consultarDiagnostico.php?ingreso_id='.$row['idDeIngreso'].'">'."<i class=\"material-icons\">remove_red_eye</i>"."</a>";
          echo "</td>";
          echo '<td><a class="waves-effect waves-light btn-small" title="Editar datos del diagnostico" href="editarDiagnostico.php?ingreso_id='.$row['idDeIngreso'].'&i='.$row['idDeIngreso'].'">'."<i class=\"material-icons\">create</i>"."</a>";
          echo "</td>"; 
          echo '<td><a class="waves-effect waves-light btn-small" title="Eliminar diagnostico" href="eliminarDiagnostico.php?ingreso_id='.$row['idDeIngreso'].'">'."<i class=\"material-icons\">delete_forever</i>"."</a>";
          echo "</td>"; 
          echo '</tr>';
      }
      echo '</table>';
  }
  else{
    echo "
    <div class=\"row\">
    <div class=\"col s12 m12 l12\">
        <div class=\"card blue lighten-1\">
            <div class=\"card-content white-text\">
                <span class=\"card-title\">No se encontró ningún resultado de ".$nombre."</span>
            </div>
        </div>
    </div>
  </div>
    ";
  }
  mysqli_free_result($result);
}

function getDiagnosticoByIdC($id,$Coordinaciones){
  $con = conectar_bd();
  
  $sql = "SELECT d.idDiagnostico,b.idDeIngreso,e.idEspecialidad,a.nombre AS nombreA,b.nombre,b.apellidoP,b.apellidoM,e.nombre AS Especialidad,d.fecha,d.tratamiento,d.descripcion
  FROM Diagnostico AS d,Especialidad AS e,Beneficiaria AS b,Coordinaciones AS a
  WHERE b.idDeIngreso=d.idDeIngreso AND e.idEspecialidad=d.idEspecialidad AND d.idDeIngreso ='$id'
  AND d.activo = true AND e.idCoordinaciones=a.idCoordinaciones ";
  if($Coordinaciones!= NULL){
    $sql.="AND e.idCoordinaciones='$Coordinaciones'";
  }
  
  $sql.= "ORDER BY d.fecha DESC";

  $result = mysqli_query($con, $sql);
  $resultado = "";
  if(mysqli_num_rows($result) > 0){
    $resultado .="<div class=\"row\">
    <div class=\"card teal lighten-2\">
      <div class=\"card-content teal lighten-5\">";
  
  while($row = mysqli_fetch_assoc($result)){
      $resultado .= "
            <ul class=\"collection with-header white\">
                <li>
                    <li class=\"col s2 l2 collection-item header teal lighten-4 center\">
                    <a title=\"Editar Diagnóstico\" href=\"editarDiagnostico.php?id_diagnostico=".$row['idDiagnostico']."&&e=".$row['idEspecialidad']."\" class=\"waves-effect waves-light btn-small\"><i class=\"material-icons\">edit</i></a>
                    <a title=\"Eliminar Diagnóstico\" href=\"eliminarDiagnostico.php?id_diagnostico=".$row['idDiagnostico']."&i=".$row['idDeIngreso']."\" class=\"waves-effect waves-light btn-small red darken-4\"><i class=\"material-icons\">delete
                    </i></a></li>
                    <li class=\"col s10 l10 collection-item header right\"><h6>Fecha del Diagnóstico: <strong>".date('d/m/Y',strtotime($row["fecha"]))."</strong></h6></li>
                    </li>
                <li>
                <li class=\"col s6 l6 collection-item header\"><h6>Área: <strong>".$row["nombreA"]."</strong></h6></li>
                <li class=\"col s6 l6 collection-item header\"><h6>Especialidad: <strong>".$row["Especialidad"]."</strong></h6></li>
                </li>
                <li>
                <li class=\"col s12 l12 collection-item header \"><h6>Nombre: <strong>".$row["nombre"]." ".$row["apellidoP"]." ".$row["apellidoM"]."</strong></h6></li>
                </li>                           
              
              <li class=\"col s12 l12 collection-item header \"><strong><h6>Tratamiento: </strong>".$row["tratamiento"]."
              </h6></li>
              <li class=\"col s12 l12 collection-item header \"><strong><h6>Descripción: </strong>".$row["descripcion"]."
               </h6></li>
               </ul>    
               <hr>         
        ";
  }
  $resultado .="</div>
      </div>
    </div>
  </div>";
}
else{
  echo "
  <div class=\"row\">
  <div class=\"col s12 m12 l12\">
      <div class=\"card blue lighten-1\">
          <div class=\"card-content white-text\">
              <span class=\"card-title\">No tiene ningún diagnóstico</span>
          </div>
      </div>
  </div>
</div>
  ";
}
mysqli_free_result($result);
  cerrar_bd($con);
  
  return $resultado;
}

function getDiagnosticoByIdC2($id,$Coordinaciones){
  $con = conectar_bd();
  
  $sql = "SELECT d.idDiagnostico,b.idDeIngreso,e.idEspecialidad,a.nombre AS nombreA,b.nombre,b.apellidoP,b.apellidoM,e.nombre AS Especialidad,d.fecha,d.tratamiento,d.descripcion
  FROM Diagnostico AS d,Especialidad AS e,Beneficiaria AS b,Coordinaciones AS a
  WHERE b.idDeIngreso=d.idDeIngreso AND e.idEspecialidad=d.idEspecialidad AND d.idDeIngreso ='$id'
  AND d.activo = true AND e.idCoordinaciones=a.idCoordinaciones ";
  if($Coordinaciones!= NULL){
    $sql.="AND e.idCoordinaciones='$Coordinaciones'";
  }
  
  $sql.= "ORDER BY d.fecha ASC";

  $result = mysqli_query($con, $sql);
  $resultado = "";
  if(mysqli_num_rows($result) > 0){
    $resultado .="<div class=\"row\">
    <div class=\"card teal lighten-2\">
      <div class=\"card-content teal lighten-5\">";
  
  while($row = mysqli_fetch_assoc($result)){
      $resultado .= "
            <ul class=\"collection with-header white\">
                <li>
                    <li class=\"col s2 l2 collection-item header teal lighten-4 center\">
                    <a href=\"editarDiagnostico.php?id_diagnostico=".$row['idDiagnostico']."&e=".$row['idEspecialidad']."\" class=\"waves-effect waves-light btn-small\"><i class=\"material-icons\">edit</i></a>
                    <a href=\"eliminarDiagnostico.php?id_diagnostico=".$row['idDiagnostico']."&i=".$row['idDeIngreso']."\" class=\"waves-effect waves-light btn-small red darken-4\"><i class=\"material-icons\">delete
                    </i></a></li>
                    <li class=\"col s10 l10 collection-item header right\"><h6>Fecha del Diagnóstico: <strong>".date('d/m/Y',strtotime($row["fecha"]))."</strong></h6></li>
                    </li>
                <li>
                <li class=\"col s6 l6 collection-item header\"><h6>Área: <strong>".$row["nombreA"]."</strong></h6></li>
                <li class=\"col s6 l6 collection-item header\"><h6>Especialidad: <strong>".$row["Especialidad"]."</strong></h6></li>
                </li>
                <li>
                <li class=\"col s12 l12 collection-item header \"><h6>Nombre: <strong>".$row["nombre"]." ".$row["apellidoP"]." ".$row["apellidoM"]."</strong></h6></li>
                </li>                           
              
              <li class=\"col s12 l12 collection-item header \"><strong><h6>Tratamiento: </strong>".$row["tratamiento"]."
              </h6></li>
              <li class=\"col s12 l12 collection-item header \"><strong><h6>Descripción: </strong>".$row["descripcion"]."
               </h6></li>
               </ul>    
               <hr>         
        ";
  }
  $resultado .="</div>
      </div>
    </div>
  </div>";
}
else{
  echo "
  <div class=\"row\">
  <div class=\"col s12 m12 l12\">
      <div class=\"card blue lighten-1\">
          <div class=\"card-content white-text\">
              <span class=\"card-title\">No tiene ningún diagnóstico</span>
          </div>
      </div>
  </div>
</div>
  ";
}
mysqli_free_result($result);
  cerrar_bd($con);
  
  return $resultado;
}

function crear_selectCoordinaciones1($id, $columna_descripcion, $tabla, $seleccion=0) {
  $conexion_bd = conectar_bd();  
    
  $resultado = '<div class="input-field col s9"><select id="CoordinacionesD" onchange="cambiarDiagnostico()" required name="'.$tabla.'" ><option value=""  selected>Selecciona una área</option>';
          
  $consulta = "SELECT $id, $columna_descripcion FROM $tabla";
  $resultados = $conexion_bd->query($consulta);
  while ($row = mysqli_fetch_array($resultados, MYSQLI_BOTH)) {
      $resultado .= '<option value="'.$row["$id"].'" ';
      if($seleccion == $row["$id"]) {
          $resultado .= 'selected';
      }
      $resultado .= '>'.$row["$columna_descripcion"].'</option>';
  }
      
  cerrar_bd($conexion_bd);
  $resultado .=  '</select></div>';
  return $resultado;
}

function selectEspecialidad($id, $columna_descripcion, $tabla, $seleccion=0) {
  $conexion_bd = conectar_bd();  
    
  $resultado = '<div class="especialidadS" class="input-field"><select required name="'.$tabla.'" ><option value="" disabled selected>Selecciona una Especialidad</option>';
          
  $consulta = "SELECT $id, $columna_descripcion FROM $tabla WHERE (activo=1 or $id=$seleccion)";
  $resultados = $conexion_bd->query($consulta);
  while ($row = mysqli_fetch_array($resultados, MYSQLI_BOTH)) {
      $resultado .= '<option value="'.$row["$id"].'" ';
      if($seleccion == $row["$id"]) {
          $resultado .= 'selected';
      }
      $resultado .= '>'.$row["$columna_descripcion"].'</option>';
  }
      
  cerrar_bd($conexion_bd);
  $resultado .=  '</select><label class="formatoE" for="rol"><strong>Especialidad</strong></label>     
  </div>';
  return $resultado;
}

function nuevoDiagnostico($idDeIngreso,$idEspecialidad,$fecha,$tratamiento,$descripcion){
  $conexion_bd = conectar_bd();
  $sql = "INSERT INTO `Diagnostico` (`idDeIngreso`,`idEspecialidad`,`fecha`,`tratamiento`,`descripcion`,`activo`) VALUES
  ('$idDeIngreso','$idEspecialidad','$fecha','$tratamiento','$descripcion',1);";
  $result = mysqli_query($conexion_bd, $sql);
  cerrar_bd($conexion_bd);

  return $result;
}

function getDiagnosticoByIdE($id,$idI){
  $con = conectar_bd();
  
  $sql = "SELECT  idDiagnostico,idDeIngreso
  FROM Diagnostico
   WHERE idDiagnostico = $id";

  $result = mysqli_query($con, $sql);
  $resultado = "";
  
  
  while($row = mysqli_fetch_assoc($result)){
      $resultado .= "<br>
      <div class=\"card teal lighten-2\">
      <div class=\"card-content teal lighten-3\">
      <div class=\" center\" data-indicators=\"true\">
        <div class=\" teal lighten-5 \" href=\"#one!\" id=\"carousel-Docs\">
        <div class='row'>
          <div class=\"col s12 align-center\">
              <!-- Elemento -->
              <div class=\"file-field input-field\">
                <div class=\"col s12 m12 l12\">
                  <h6><strong>¿Está seguro que desea eliminar este diagnóstico?</strong></h6>
              </div>
              </div>


              <div class=\"file-field input-field\">
                  <div class=\"input-field col s12 l12 left\">
                    <a id=\"confirmarEliminarEscolaridad\" href=\"Controladores\Diagnostico\controladorEliminarDiagnostico.php?idDi=$id&ingreso_id=$idI\" class=\"waves-effect red deep-orange darken-4 btn right\">eliminar
                      <i class=\"material-icons right\">remove</i>
                    </a>
                    <a id=\"\"href=\"consultarDiagnostico.php?ingreso_id=".$row["idDeIngreso"]."\" class=\"waves-effect green lighten-3 btn right\">Volver<i class=\"material-icons right\">undo</i>
                    </a>
                </div>
                </div>
           
            </div>
        </div>
      </div>
      </div>
      </div>
      </div>";
  }

  cerrar_bd($con);
  mysqli_free_result($result);
  return $resultado;

}

function estadoDiagnostico($id){
  $conexion_bd = conectar_bd();
  $sql = "UPDATE Diagnostico 
  SET activo=false
  WHERE idDiagnostico = '$id'";
  $result = mysqli_query($conexion_bd, $sql);
  cerrar_bd($conexion_bd);

  return $result;
}

function eliminarDiagnostico($id){
  $conexion_bd = conectar_bd();
  $sql = "DELETE FROM Diagnostico WHERE idDiagnostico = '$id'";
  $result = mysqli_query($conexion_bd, $sql);
  cerrar_bd($conexion_bd);

  return $result;
}

function editDiagnostico($id){
  $con = conectar_bd();
  
  $sql = "SELECT d.idDiagnostico,b.idDeIngreso,e.idEspecialidad,a.nombre AS nombreA,b.nombre,b.apellidoP,b.apellidoM,e.nombre AS Especialidad,d.fecha,d.tratamiento,d.descripcion
  FROM Diagnostico AS d,Especialidad AS e,Beneficiaria AS b,Coordinaciones AS a
  WHERE b.idDeIngreso=d.idDeIngreso AND e.idEspecialidad=d.idEspecialidad
  AND d.activo = true AND e.idCoordinaciones=a.idCoordinaciones AND d.idDiagnostico='$id'";

  $result = mysqli_query($con, $sql);
  $resultado = "";
  
  
  while($row = mysqli_fetch_assoc($result)){
      $resultado .= "<br>
      <div class=\"card teal lighten-2\">
      <div class=\"card-content teal lighten-3\">
      <div  class=\" center\" class=\"carousel2\" data-indicators=\"true\">
        <div class=\" teal lighten-5 \" href=\"#one!\"id=\"diagForm\">
        <div class='row'>
          <div class=\"col s12 align-center\">
            <form action=\"Controladores\Diagnostico\controladorEditarDiagnostico.php\" method=\"POST\">
                <!-- Elemento -->
                 <div class=\"file-field input-field\">
                  
                  <div class=\"input-field col s7\">
                    <i class=\"material-icons prefix\"> </i>";
  }
  mysqli_free_result($result);
  cerrar_bd($con);
  
  return $resultado;
}


function editDiagnostico2($id){
  $con = conectar_bd();
  
  $sql = "SELECT d.idDiagnostico,b.idDeIngreso,e.idEspecialidad,a.nombre AS nombreA,b.nombre,b.apellidoP,b.apellidoM,e.nombre AS Especialidad,d.fecha,d.tratamiento,d.descripcion
  FROM Diagnostico AS d,Especialidad AS e,Beneficiaria AS b,Coordinaciones AS a
  WHERE b.idDeIngreso=d.idDeIngreso AND e.idEspecialidad=d.idEspecialidad
  AND d.activo = true AND e.idCoordinaciones=a.idCoordinaciones AND d.idDiagnostico='$id'";

  $result = mysqli_query($con, $sql);
  $resultado = "";
  
  
  while($row = mysqli_fetch_assoc($result)){
      $resultado .= "</div>
      </div>  
    <!-- Elemento -->
      <div class=\"file-field input-field\">
        <div class=\"input-field col s5\">
          <i class=\"material-icons prefix\"> </i>
          <input type=\"date\" class=\"validate\" name=\"fechaD\" id=\"fechaD\" value=\"".$row["fecha"]."\" required>
          <label for=\"rol\"><strong>Fecha de Diagnóstico</strong></label>     
      </div>
      </div>
      <!-- Elemento -->
      <div class=\"file-field input-field\">
        <div class=\"input-field col s12\">
          <i class=\"material-icons prefix\"> </i>
          <div>
                <label for=\"rol\"><strong>Tratamiento</strong></label>     
              </div>
          <textarea  required name=\"tratamiento\"wrap rows=\"10\" cols=\"30\">".$row["tratamiento"]."</textarea>
      </div>
      </div>
    <!-- Elemento -->
      <div class=\"file-field input-field\">
        <div class=\"input-field col s12\">
          <i class=\"material-icons prefix\"> </i>
          <div>
            <label for=\"rol\"><strong>Descripción</strong></label>     
          </div>
          <textarea required name=\"descripcion\"wrap rows=\"10\" cols=\"30\">".$row["descripcion"]."</textarea>   
        </div>
      </div> 
     

    </div>
    <div class=\"file-field input-field\">
    <div class=\"input-field col s12 l12 left\">

          <button class=\"waves-effect waves-light btn right\" type=\"submit\" name=\"action\">Registrar<i class=\"material-icons right\">add</i></button>
          <a  href=\"consultarDiagnostico.php?ingreso_id=".$row["idDeIngreso"]."\" class=\"waves-effect green lighten-3 btn right\">Volver<i class=\"material-icons right\">undo</i></a>

        </div>
        </div>
  </form>
  </div>
</div>
</div>
</div>
</div>
</div>
" ;
  }
  mysqli_free_result($result);
  cerrar_bd($con);
  
  return $resultado;
}

function editarDiagnostico($idDiagnostico,$idEspecialidad,$fecha,$tratamiento,$descripcion){
  $conexion_bd = conectar_bd();
  $sql = "UPDATE Diagnostico 
  SET idEspecialidad = '$idEspecialidad', fecha='$fecha', tratamiento = '$tratamiento', descripcion='$descripcion'
  WHERE idDiagnostico = '$idDiagnostico'";
  $result = mysqli_query($conexion_bd, $sql);
  cerrar_bd($conexion_bd);

  return $result;
}

function botones($id){
      echo"<div class=\"row\">
      <div class=\"col s2\"><a class=\"waves-effect waves-light btn-small\" href=\"expedientes.php\">Volver<i class=\"material-icons right\">undo</i>
      </a></div>
      <div class=\"col s2\"><a class=\"waves-effect waves-light btn-small\" href=\"consultarDiagnostico.php?ingreso_id=$id\">Diagnósticos 
      </a></div>
      <div class=\"col s2\"><a class=\"waves-effect waves-light btn-small\" href=\"consultarProgramas.php?ingreso_id=$id\">Programas 
      </a></div>
      <div class=\"col s2\"><a class=\"waves-effect waves-light btn-small\" href=\"consultarRecetas.php?ingreso_id=$id\">Recetas 
      </a></div>
      <div class=\"col s2\"><a class=\"waves-effect waves-light btn-small\" href=\"consultaEscolaridad.php?ingreso_id=$id\">Escolaridad 
     </a></div>
      <div class=\"col s2\"><a class=\"waves-effect waves-light btn-small\" href=\"consultarDiscapacidad.php?ingreso_id=$id\">Discapacidad 
      </a></div>  
    </div>";

}
function login($usuario="",$contrasena=""){
  $con = conectar_bd();
  $sql = "SELECT  U.nombre as UsuarioNombre, U.password as contrasenia 
  FROM Usuario as U 
  where U.Usuario = '".$usuario."' ";
  $result = mysqli_query($con, $sql);

  if(mysqli_num_rows($result)){
    $constraseniaDB='';
    while($row = mysqli_fetch_assoc($result)){
      $constraseniaDB=$row['contrasenia'];
      $_SESSION["Nombre"]=$row['UsuarioNombre'];
    }
    if(password_verify($contrasena,$constraseniaDB)){
      
      $sql = "SELECT  R.nombre as Rol, P.nombre as privilegio 
      FROM Usuario as U, Rol as R,  UsuarioRol as UR, RolPrivilegios as RP, Privilegios as P 
      where UR.idUser = U.idUser and  UR.idRol = R.idRol and R.idRol=RP.idRol and RP.idPrivilegios = P.idPrivilegios 
      and U.Usuario = '".$usuario."'  ";
      $result = mysqli_query($con, $sql);
      if(mysqli_num_rows($result)){
        session_start();
        
        $_SESSION["Rol"]="";
        $_SESSION["Consultar privilegios"]=0;
        $_SESSION["Consultar usuarios del sistema"]=0;
        $_SESSION["Consultar usuario del sistema"]=0;
        $_SESSION["Consultar roles de usuario del sistema"]=0;
        $_SESSION["Consultar privilegios de los roles"]=0;
        $_SESSION["Asignar rol a usuario"]=0;
        $_SESSION["Consultar roles"]=0;
        $_SESSION["Cambiar rol de usuario"]=0;
        $_SESSION["Eliminar rol de usuario"]=0;
        $_SESSION["Eliminar rol"]=0;
        $_SESSION["Crear rol"]=0;
        $_SESSION["Crear usuario"]=0;
        $_SESSION["Modificar usuario"]=0;
        $_SESSION["Eliminar usuario"]=0;
        $_SESSION["Modificar privilegios de un rol"]=0;
        $_SESSION["Modificar rol"]=0;
        $_SESSION["Asignar privilegios de un rol"]=0;
        $_SESSION["Eliminar privilegios de un rol"]=0;
        $_SESSION["Registrar beneficiaria"]=0;
        $_SESSION["Modificar beneficiaria"]=0;
        $_SESSION["Consulta de beneficiarias"]=0;
        $_SESSION["Elimnar beneficiaria"]=0;
        $_SESSION["Consultar beneficiaria"]=0;
        $_SESSION["Crear receta"]=0;
        $_SESSION["Modificar receta"]=0;
        $_SESSION["Eliminar receta"]=0;
        $_SESSION["Consulta recetas"]=0;
        $_SESSION["Registrar medicamento"]=0;
        $_SESSION["Modificar medicamento"]=0;
        $_SESSION["Eliminar medicamento"]=0;
        $_SESSION["Consultar medicamentos"]=0;
        $_SESSION["Registrar un contacto en directorio"]=0;
        $_SESSION["Modificar un contacto en directorio"]=0;
        $_SESSION["Eliminar un contacto en directorio"]=0;
        $_SESSION["Consultar un contacto en directorio"]=0;
        $_SESSION["Consultar directorio"]=0;
        $_SESSION["Registrar institucion"]=0;
        $_SESSION["Modificar institucion"]=0;
        $_SESSION["Eliminar institucion"]=0;
        $_SESSION["Consultar instituciones"]=0;
        $_SESSION["Registrar escolaridad"]=0;
        $_SESSION["Modificar escolaridad"]=0;
        $_SESSION["Eliminar escolaridad"]=0;
        $_SESSION["Consulta escolaridad"]=0;
        $_SESSION["Registrar escuela"]=0;
        $_SESSION["Modificar escuela"]=0;
        $_SESSION["Eliminar escuela"]=0;
        $_SESSION["Consultar escuelas"]=0;
        $_SESSION["Consultar escuela"]=0;
        $_SESSION["Registrar plan educativo"]=0;
        $_SESSION["Modificar plan educativo"]=0;
        $_SESSION["Eliminar plan educativo"]=0;
        $_SESSION["Consultar plan educativos"]=0;
        $_SESSION["Registrar diagnóstico"]=0;
        $_SESSION["Modificar diagnóstico"]=0;
        $_SESSION["Eliminar diagnóstico"]=0;
        $_SESSION["Consultar diagnóstico"]=0;
        $_SESSION["Registrar área"]=0;
        $_SESSION["Modificar área"]=0;
        $_SESSION["Eliminar área"]=0;
        $_SESSION["Consultar áreas"]=0;
        $_SESSION["Registrar especialidad"]=0;
        $_SESSION["Eliminar especialidad"]=0;
        $_SESSION["Editar especialidad"]=0;
        $_SESSION["Consultar especialidades"]=0;
        $_SESSION["Registrar discapacidad"]=0;
        $_SESSION["Eliminar discapacidad"]=0;
        $_SESSION["Editar discapacidad"]=0;
        $_SESSION["Consultar discapacidades"]=0;
        $_SESSION["Registrar discapacidad a beneficiaria"]=0;
        $_SESSION["Eliminar discapacidad de beneficiaria"]=0;
        $_SESSION["Editar discapacidad de beneficiaria"]=0;
        $_SESSION["Consultar discapacidades de beneficiaria"]=0;
        $_SESSION["Registrar programa de atención"]=0;
        $_SESSION["Modificar programa de atención"]=0;
        $_SESSION["Eliminar programa de atención"]=0;
        $_SESSION["Consultar programa de atención"]=0;
        $_SESSION["Consultar programas de atención"]=0;
        $_SESSION["Consulta programa de atención"]=0;
        $_SESSION["Registrar programa de atención a beneficiaria"]=0;
        $_SESSION["Modificar vinculación de programa de atención con beneficiaria"]=0;
        $_SESSION["Eliminar programa de atención de beneficiaria"]=0;
        $_SESSION["Consultar programas de atención de beneficiaria"]=0;
        $_SESSION["Consulta escolaridades"]=0;
        while($row = mysqli_fetch_assoc($result)){
          $_SESSION["Rol"]=$row["Rol"];
          if ($row["privilegio"]=='Consultar privilegios'){
            $_SESSION["Consultar privilegios"]=1;
          }
          if ($row["privilegio"]=='Cambiar rol de usuario'){
            $_SESSION["Cambiar rol de usuario"]=1;
          }
          if ($row["privilegio"]=='Consultar roles'){
            $_SESSION["Consultar roles"]=1;
          }
          if ($row["privilegio"]=='Consultar privilegios de los roles'){
            $_SESSION["Consultar privilegios de los roles"]=1;
          }
          if ($row["privilegio"]=='Consultar roles de usuario del sistema'){
            $_SESSION["Consultar roles de usuario del sistema"]=1;
          }
          if ($row["privilegio"]=='Eliminar rol de usuario'){
            $_SESSION["Eliminar rol de usuario"]=1;
          }
          if ($row["privilegio"]=='Consultar usuario del sistema'){
            $_SESSION["Consultar usuario del sistema"]=1;
          }
          if ($row["privilegio"]=='Consultar usuarios del sistema'){
            $_SESSION["Consultar usuarios del sistema"]=1;
          }
          if ($row["privilegio"]=='Eliminar privilegios de un rol'){
            $_SESSION["Eliminar privilegios de un rol"]=1;
          }
          if ($row["privilegio"]=='Asignar rol a usuario'){
            $_SESSION["Asignar rol a usuario"]=1;
          }
          if ($row["privilegio"]=='Eliminar rol'){
            $_SESSION["Eliminar rol"]=1;
          }
          if ($row["privilegio"]=='Crear rol'){
            $_SESSION["Crear rol"]=1;
          }
          if ($row["privilegio"]=='Crear usuario'){
            $_SESSION["Crear usuario"]=1;
          }
          if ($row["privilegio"]=='Modificar usuario'){
            $_SESSION["Modificar usuario"]=1;
          }
          if ($row["privilegio"]=='Eliminar usuario'){
            $_SESSION["Eliminar usuario"]=1;
          }
          if ($row["privilegio"]=='Asignar privilegios de un rol'){
            $_SESSION["Asignar privilegios de un rol"]=1;
          }
          if ($row["privilegio"]=='Modificar privilegios de un rol'){
            $_SESSION["Modificar privilegios de un rol"]=1;
          }
          if ($row["privilegio"]=='Modificar rol'){
            $_SESSION["Modificar rol"]=1;
          }
          if ($row["privilegio"]=='Registrar beneficiaria'){
            $_SESSION["Registrar beneficiaria"]=1;
          }
          if ($row["privilegio"]=='Modificar beneficiaria'){
            $_SESSION["Modificar beneficiaria"]=1;
          }
          if ($row["privilegio"]=='Consulta de beneficiarias'){
            $_SESSION["Consulta de beneficiarias"]=1;
          }
          if ($row["privilegio"]=='Elimnar beneficiaria'){
            $_SESSION["Elimnar beneficiaria"]=1;
          }
          if ($row["privilegio"]=='Consultar beneficiaria'){
            $_SESSION["Consultar beneficiaria"]=1;
          }
          if ($row["privilegio"]=='Crear receta'){
            $_SESSION["Crear receta"]=1;
          }
          if ($row["privilegio"]=='Modificar receta'){
            $_SESSION["Modificar receta"]=1;
          }
          if ($row["privilegio"]=='Eliminar receta'){
            $_SESSION["Eliminar receta"]=1;
          }
          if ($row["privilegio"]=='Consulta recetas'){
            $_SESSION["Consulta recetas"]=1;
          }
          if ($row["privilegio"]=='Registrar medicamento'){
            $_SESSION["Registrar medicamento"]=1;
          }
          if ($row["privilegio"]=='Modificar medicamento'){
            $_SESSION["Modificar medicamento"]=1;
          }
          if ($row["privilegio"]=='Eliminar medicamento'){
            $_SESSION["Eliminar medicamento"]=1;
          }
          if ($row["privilegio"]=='Consultar medicamentos'){
            $_SESSION["Consultar medicamentos"]=1;
          }
          if ($row["privilegio"]=='Registrar un contacto en directorio'){
            $_SESSION["Registrar un contacto en directorio"]=1;
          }
          if ($row["privilegio"]=='Modificar un contacto en directorio'){
            $_SESSION["Modificar un contacto en directorio"]=1;
          }
          if ($row["privilegio"]=='Eliminar un contacto en directorio'){
            $_SESSION["Eliminar un contacto en directorio"]=1;
          }
          if ($row["privilegio"]=='Consultar un contacto en directorio'){
            $_SESSION["Consultar un contacto en directorio"]=1;
          }
          if ($row["privilegio"]=='Consultar directorio'){
            $_SESSION["Consultar directorio"]=1;
          }
          if ($row["privilegio"]=='Registrar institucion'){
            $_SESSION["Registrar institucion"]=1;
          }
          if ($row["privilegio"]=='Modificar institucion'){
            $_SESSION["Modificar institucion"]=1;
          }
          if ($row["privilegio"]=='Eliminar institucion'){
            $_SESSION["Eliminar institucion"]=1;
          }
          if ($row["privilegio"]=='Consultar instituciones'){
            $_SESSION["Consultar instituciones"]=1;
          }
          if ($row["privilegio"]=='Registrar escolaridad'){
            $_SESSION["Registrar escolaridad"]=1;
          }
          if ($row["privilegio"]=='Modificar escolaridad'){
            $_SESSION["Modificar escolaridad"]=1;
          }
          if ($row["privilegio"]=='Eliminar escolaridad'){
            $_SESSION["Eliminar escolaridad"]=1;
          }
          if ($row["privilegio"]=='Consulta escolaridades'){
            $_SESSION["Consulta escolaridades"]=1;
          }
          if ($row["privilegio"]=='Registrar escuela'){
            $_SESSION["Registrar escuela"]=1;
          }
          if ($row["privilegio"]=='Modificar escuela'){
            $_SESSION["Modificar escuela"]=1;
          }
          if ($row["privilegio"]=='Eliminar escuela'){
            $_SESSION["Eliminar escuela"]=1;
          }
          if ($row["privilegio"]=='Consultar escuelas'){
            $_SESSION["Consultar escuelas"]=1;
          }
          if ($row["privilegio"]=='Consultar escuela'){
            $_SESSION["Consultar escuela"]=1;
          }
          if ($row["privilegio"]=='Registrar plan educativo'){
            $_SESSION["Registrar plan educativo"]=1;
          }
          if ($row["privilegio"]=='Modificar plan educativo'){
            $_SESSION["Modificar plan educativo"]=1;
          }
          if ($row["privilegio"]=='Eliminar plan educativo'){
            $_SESSION["Eliminar plan educativo"]=1;
          }
          if ($row["privilegio"]=='Consultar planes educativos'){
            $_SESSION["Consultar plan educativos"]=1;
          }
          if ($row["privilegio"]=='Registrar diagnóstico'){
            $_SESSION["Registrar diagnóstico"]=1;
          }
          if ($row["privilegio"]=='Modificar diagnóstico'){
            $_SESSION["Modificar diagnóstico"]=1;
          }
          if ($row["privilegio"]=='Eliminar diagnóstico'){
            $_SESSION["Eliminar diagnóstico"]=1;
          }
          if ($row["privilegio"]=='Consultar diagnóstico'){
            $_SESSION["Consultar diagnóstico"]=1;
          }
          if ($row["privilegio"]=='Registrar área'){
            $_SESSION["Registrar área"]=1;
          }
          if ($row["privilegio"]=='Modificar área'){
            $_SESSION["Modificar área"]=1;
          }
          if ($row["privilegio"]=='Eliminar área'){
            $_SESSION["Eliminar área"]=1;
          }
          if ($row["privilegio"]=='Consultar áreas'){
            $_SESSION["Consultar áreas"]=1;
          }
          if ($row["privilegio"]=='Registrar especialidad'){
            $_SESSION["Registrar especialidad"]=1;
          }
          if ($row["privilegio"]=='Eliminar especialidad'){
            $_SESSION["Eliminar especialidad"]=1;
          }
          if ($row["privilegio"]=='Editar especialidad'){
            $_SESSION["Editar especialidad"]=1;
          }
          if ($row["privilegio"]=='Consultar especialidades'){
            $_SESSION["Consultar especialidades"]=1;
          }
          if ($row["privilegio"]=='Registrar discapacidad'){
            $_SESSION["Registrar discapacidad"]=1;
          }
          if ($row["privilegio"]=='Eliminar discapacidad'){
            $_SESSION["Eliminar discapacidad"]=1;
          }
          if ($row["privilegio"]=='Editar discapacidad'){
            $_SESSION["Editar discapacidad"]=1;
          }
          if ($row["privilegio"]=='Consultar discapacidades'){
            $_SESSION["Consultar discapacidades"]=1;
          }
          if ($row["privilegio"]=='Registrar discapacidad a beneficiaria'){
            $_SESSION["Registrar discapacidad a beneficiaria"]=1;
          }
          if ($row["privilegio"]=='Eliminar discapacidad de beneficiaria'){
            $_SESSION["Eliminar discapacidad de beneficiaria"]=1;
          }
          if ($row["privilegio"]=='Editar discapacidad de beneficiaria'){
            $_SESSION["Editar discapacidad de beneficiaria"]=1;
          }
          if ($row["privilegio"]=='Consultar discapacidad de beneficiaria'){
            $_SESSION["Consultar discapacidad de beneficiaria"]=1;
          }
          if ($row["privilegio"]=='Consultar discapacidades de beneficiaria'){
            $_SESSION["Consultar discapacidades de beneficiaria"]=1;
          }
          if ($row["privilegio"]=='Registrar programa de atención'){
            $_SESSION["Registrar programa de atención"]=1;
          }
          if ($row["privilegio"]=='Modificar programa de atención'){
            $_SESSION["Modificar programa de atención"]=1;
          }
          if ($row["privilegio"]=='Eliminar programa de atención'){
            $_SESSION["Eliminar programa de atención"]=1;
          }
          if ($row["privilegio"]=='Consultar programas de atención'){
            $_SESSION["Consultar programas de atención"]=1;
          }
          if ($row["privilegio"]=='Consultar programa de atención'){
            $_SESSION["Consultar programa de atención"]=1;
          }
          if ($row["privilegio"]=='Consulta programa de atención'){
            $_SESSION["Consulta programa de atención"]=1;
          }
          if ($row["privilegio"]=='Registrar programa de atención a beneficiaria'){
            $_SESSION["Registrar programa de atención a beneficiaria"]=1;
          }
          if ($row["privilegio"]=='Modificar vinculación de programa de atención con beneficiaria'){
            $_SESSION["Modificar vinculación de programa de atención con beneficiaria"]=1;
          }
          if ($row["privilegio"]=='Eliminar programa de atención de beneficiaria'){
            $_SESSION["Eliminar programa de atención de beneficiaria"]=1;
          }
          if ($row["privilegio"]=='Consultar programas de atención de beneficiaria'){
            $_SESSION["Consultar programas de atención de beneficiaria"]=1;
          }
        }

      cerrar_bd($con);
      return true;
      }else{
        cerrar_bd($con);
        return false;
      }
    }else{
      cerrar_bd($con);
      return false; 
    }
  }
  else{
    cerrar_bd($con);
    return false; 
  }
}

function crear_selectPresentacion($id, $columna_descripcion, $tabla, $seleccion=0) {
  $conexion_bd = conectar_bd();  
    
  $resultado = '<div class="selectP"class="input-field"><select required name="'.$tabla.'" ><option value="" disabled selected>Selecciona una opción</option>';
          
  $consulta = "SELECT $id, $columna_descripcion FROM $tabla WHERE activo=1";
  $resultados = $conexion_bd->query($consulta);
  while ($row = mysqli_fetch_array($resultados, MYSQLI_BOTH)) {
      $resultado .= '<option value="'.$row["$id"].'" ';
      if($seleccion == $row["$id"]) {
          $resultado .= 'selected';
      }
      $resultado .= '>'.$row["$columna_descripcion"].'</option>';
  }
      
  cerrar_bd($conexion_bd);
  $resultado .=  '</select><label class="selectPNombre" for="rol"><strong>Presentación</strong></label></div>';
  return $resultado;
}



function getUsuario($nombre=""){
  $con = conectar_bd();  
  $sql = "SELECT  U.idUser as idU, U.Usuario as UsuarioU, U.password as passwordU, U.nombre as NombreU, U.created_at as created_atU
  FROM Usuario as U  where U.activo = '1'";
  if($nombre != ""){
      $sql .= " and     U.nombre like '%".$nombre."%'";
  }
  $sql .= " Order by U.nombre";
  $result = mysqli_query($con, $sql);
  $tabla = "";
  if(!(mysqli_num_rows($result)==0)){
    if(mysqli_num_rows($result)){
      $tabla .= "<table class=\"highlight centered\">";
      $tabla .= "<thead><tr><th>Usuario</th><th>Nombre del usuario</th><th colspan='3'>Acción</th></thead>";
      while($row = mysqli_fetch_assoc($result)){   
          $tabla .= "<tr>";
          $tabla .= "<td>". $row["UsuarioU"]. "</td>";
          $tabla .= "<td>". $row["NombreU"]. "</td>";
          $tabla .= '<td><a class="waves-effect waves-light btn-small" title="Consultar datos de usuario" href="consultarUsuario.php?Usuario_id='.$row['idU'].'">'."<i class=\"material-icons\">remove_red_eye</i>"."</a>";
          $tabla .= "</td>"; 
          $tabla .= '<td><a class="waves-effect waves-light btn-small" title="Editar datos de usuario" href="editarUsuario.php?Usuario_id='.$row['idU'].'">'."<i class=\"material-icons\">create</i>"."</a>";
          $tabla .= "</td>"; 
          $tabla .= '<td><a class="waves-effect waves-light btn-small" title="Eliminar usuario" href="eliminarUsuario.php?Usuario_id='.$row['idU'].'">'."<i class=\"material-icons\">delete_forever</i>"."</a>";
          $tabla .= "</td>"; 
          $tabla .= "</tr>";
      }
      $tabla .= "</table>";
    }
  }else{
    $tabla .= "
    <div class=\"row\">
    <div class=\"col s12 m12 l12\">
        <div class=\"card blue lighten-1\">
            <div class=\"card-content white-text\">
                <span class=\"card-title\">No se encontró ningún resultado de ".$nombre."</span>
            </div>
        </div>
    </div>
</div>
    ";
  }


  cerrar_bd($con);
  
  return $tabla;
}
function getUsuarioById($id){
  $con = conectar_bd();
  
  $sql = "SELECT  U.idUser as idU, U.Usuario as UsuarioU, U.password as passwordU, U.nombre as NombreU, DATE_FORMAT(U.created_at,'%d/%m/%Y') as created_atU 
  FROM Usuario as U  where U.activo = '1' and U.idUser = '".$id."'";

  $result = mysqli_query($con, $sql);
  $resultado = "";
  
  
  while($row = mysqli_fetch_assoc($result)){
      $resultado .= "<br>
      <div class=\"card teal lighten-2\">
        <div class=\"card-content teal lighten-3\">
          <div class=\" center\" data-indicators=\"true\">
            <div class=\" teal lighten-5 \" href=\"#one!\" >
              <div class='row'>
              <div class=\"col s12 align-center\">
                <!-- Elemento -->
                <div class='row'>
                  <div class=\"file-field input-field\">
                    <div class=\"col s12\">
                      <label>Nombre del usuario</label>
                      <p>".$row["NombreU"]."</p>
                    </div>
                  </div>
                </div>
                <!-- Elemento -->
                <div class='row'>
                  <div class=\"file-field input-field\">
                    <div class=\"col s12\">
                      <label>Usuario</label>
                      <p>".$row["UsuarioU"]."</p>
                    </div>
                  </div>
                </div>
                <!-- Elemento -->
                <div class='row'>
                  <!-- Elemento -->
                  <div class=\"file-field input-field\">
                    <div class=\"col s12\">
                      <label>El usuario se creo el día</label>
                      <p>".$row["created_atU"]."</p>
                    </div>
                  </div>
                </div>
                <div class='row'>
                  <div class=\"file-field input-field\">
                    <div class=\"input-field col s12 l12 left\">

                      <a id=\"\" href=\"usuarios.php\" class=\"waves-effect green lighten-3 btn right\">Volver<i class=\"material-icons right\">undo</i>
                      </a>
                    </div>
                  </div>
              </div>
            </div>
            </div>
        </div>
      </div>
      </div>
      </div>";
  }
  cerrar_bd($con);
  
  return $resultado;

}
function getUsuarioByIdE($id){
  $con = conectar_bd();
  
  $sql = "SELECT  U.idUser as idU, U.Usuario as UsuarioU, U.password as passwordU, U.nombre as NombreU, DATE_FORMAT(U.created_at,'%d/%m/%Y') as created_atU 
  FROM Usuario as U  where U.activo = '1' and U.idUser = '".$id."'";

  $result = mysqli_query($con, $sql);
  $resultado = "";
  
  
  while($row = mysqli_fetch_assoc($result)){
      $resultado .= "<br>
      <div class=\"card teal lighten-2\">
        <div class=\"card-content teal lighten-3\">
          <div class=\" center\" data-indicators=\"true\">
            <div class=\" teal lighten-5 \" href=\"#one!\" >
              <div class='row'>
                <div class=\"col s12 align-center\">
                  <div class='row'>
                    <!-- Elemento -->
                    <div class=\"file-field input-field\">
                      <div class=\"col s12\">
                        <label>Nombre del usuario</label>
                        <p>".$row["NombreU"]."</p>
                      </div>
                    </div>
                  </div>
                  <div class='row'>
                    <!-- Elemento -->
                    <div class=\"file-field input-field\">
                      <div class=\"col s12\">
                        <label>Usuario</label>
                        <p>".$row["UsuarioU"]."</p>
                      </div>
                    </div>
                  </div>
                <div class='row'>
                  <!-- Elemento -->
                  <div class=\"file-field input-field\">
                    <div class=\"col s12\">
                      <label>El usuario se creo el día</label>
                      <p>".$row["created_atU"]."</p>
                    </div>
                  </div>
                </div>

                <div class='row'>
                  <!-- Elemento -->
                  <div class=\"file-field input-field\">
                    <div class=\"input-field col s12 l12 left\">
                      <a id=\"confirmarEliminarUsuario\" href=\"Controladores\Usuario\controladorEliminarUsuario.php?Usuario_id=$id\" class=\"waves-effect red deep-orange darken-4 btn right\">eliminar
                      <i class=\"material-icons right\">remove</i>
                    </a>

                      <a id=\"\" href=\"usuarios.php\" class=\"waves-effect green lighten-3 btn right\">Volver<i class=\"material-icons right\">undo</i>
                      </a>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>";
  }
  cerrar_bd($con);
  
  return $resultado;

}
function textUsuario($id=""){
  $con = conectar_bd();
      $sql = "SELECT  G.idUser as idG, G.nombre as NombreG
      FROM Usuario as G Where G.idUser = '".$id."'";
      $result = mysqli_query($con, $sql);

  $resultado = "<div class=\"file-field input-field\">
                          <div class=\"input-field col s12\">
                              <i class=\"material-icons prefix\"> </i>
                              <input placeholder=\"Eddie Murphy II\" type=\"text\"  name=\"Usuario_nombre\" id=\"Usuario_nombre\"
                              ";
      while($row = mysqli_fetch_assoc($result)){      
              $resultado .= " value=\"$row[NombreG]\"";
                  
      }
  $resultado .="
                  required>
                  <label for=\"rol\"><strong>Nombre del usuario</strong></label>     
                  </div>
                  </div>";
  cerrar_bd($con);
  return $resultado;

}
function insertarUsuario($nombre,$Usuario,$password) {
  $conexion_bd = conectar_bd();
  $activo=1;
  //Prepara la consulta
  $password=password_hash($password,PASSWORD_DEFAULT);
  $dml = 'INSERT INTO Usuario (Usuario,password,nombre,activo) VALUES (?,?,?,?)';
  if ( !($statement = $conexion_bd->prepare($dml)) ) {
      die("Error: (" . $conexion_bd->errno . ") " . $conexion_bd->error);
      return 0;
  }
  //Unir los parámetros de la función con los parámetros de la consulta   
  //El primer argumento de bind_param es el formato de cada parámetro
  if (!$statement->bind_param("sssi",$Usuario,$password, $nombre,$activo)) {
      die("Error en vinculación: (" . $statement->errno . ") " . $statement->error);
      return 0;
  } 
  //Executar la consulta
  if (!$statement->execute()) {
    die("Error en ejecución: (" . $statement->errno . ") " . $statement->error);
      return 0;
  }
  cerrar_bd($conexion_bd);
    return 1;
}


function editarUsuario($id,$nombre,$Usuario,$password) {
  $conexion_bd = conectar_bd();
  $password=password_hash($password,PASSWORD_DEFAULT);
  //Prepara la consulta
  $dml = 'UPDATE Usuario SET nombre=(?),Usuario=(?),password=(?)  WHERE idUser=(?)';
  if ( !($statement = $conexion_bd->prepare($dml)) ) {
      die("Error: (" . $conexion_bd->errno . ") " . $conexion_bd->error);
      return 0;
  }
    
  //Unir los parámetros de la función con los parámetros de la consulta   
  //El primer argumento de bind_param es el formato de cada parámetro
  if (!$statement->bind_param("ssss",$nombre,$Usuario,$password, $id)) {
      die("Error en vinculación: (" . $statement->errno . ") " . $statement->error);
      return 0;
  }
    
  //Executar la consulta
  if (!$statement->execute()) {
    die("Error en ejecución: (" . $statement->errno . ") " . $statement->error);
      return 0;
  }

  cerrar_bd($conexion_bd);
    return 1;
}
function eliminarUsuario($id) {
  $conexion_bd = conectar_bd();
  //Prepara la consulta
  $dml = 'UPDATE Usuario SET Usuario.activo=0 WHERE Usuario.idUser=(?)';
  if ( !($statement = $conexion_bd->prepare($dml)) ) {
      die("Error: (" . $conexion_bd->errno . ") " . $conexion_bd->error);
      return 0;
  }
    
  //Unir los parámetros de la función con los parámetros de la consulta   
  //El primer argumento de bind_param es el formato de cada parámetro
  if (!$statement->bind_param("i",$id)) {
      die("Error en vinculación: (" . $statement->errno . ") " . $statement->error);
      return 0;
  }
    
  //Executar la consulta
  if (!$statement->execute()) {
    die("Error en ejecución: (" . $statement->errno . ") " . $statement->error);
      return 0;
  }

  cerrar_bd($conexion_bd);
    return 1;
}

function contraseñaCamp($idCheck,$table,$id="",$campo){
  $con = conectar_bd();
      $sql = "SELECT  T.$campo as resultado
      FROM $table as T Where T.$idCheck = '".$id."'";
      $result = mysqli_query($con, $sql);
  $resultado = "
                <i class=\"material-icons prefix\"> </i>
                <input type=\"password\" class=\"validate\"  name=\"".$table."_"."$campo\" id=\"".$table."_"."$campo\"
      ";
      while($row = mysqli_fetch_assoc($result)){      
              $resultado .= " value=\"$row[resultado]\"";
      }
  $resultado .="
                  >
                  <label for=\"".$table."_"."$campo\"><strong>Contraseña</strong></label> ";
  cerrar_bd($con);
  return $resultado;
}
function getPrivilegios($nombre=""){
  $con = conectar_bd();  
  $sql = "SELECT U.nombre as nombre, U.descripcion as descripcion 
  FROM Privilegios as U  where U.activo = '1'";
  if($nombre != ""){
      $sql .= " and     U.nombre like '%".$nombre."%'";
  }
  $sql .= " Order by U.nombre";
  $result = mysqli_query($con, $sql);
  $tabla = "";
  if(!(mysqli_num_rows($result)==0)){
    if(mysqli_num_rows($result)){
      $tabla .= "<table class=\"highlight centered\">";
      $tabla .= "<thead><tr><th>Privilegio</th><th>Descripción</th></thead>";
      while($row = mysqli_fetch_assoc($result)){   
          $tabla .= "<tr>";
          $tabla .= "<td>". $row["nombre"]. "</td>";
          $tabla .= "<td>". $row["descripcion"]. "</td>";

          $tabla .= "</tr>";
      }
      $tabla .= "</table>";
    }
  }else{
    $tabla .= "
    <div class=\"row\">
    <div class=\"col s12 m12 l12\">
        <div class=\"card blue lighten-1\">
            <div class=\"card-content white-text\">
                <span class=\"card-title\">No se encontró ningún resultado de ".$nombre."</span>
            </div>
        </div>
    </div>
</div>
    ";
  }


  cerrar_bd($con);
  
  return $tabla;
}
function getRoles($nombre=""){
  $con = conectar_bd();  
  $sql = "SELECT  U.idRol as idU, U.nombre as nombreU, U.descripcion as descripcionU 
  FROM Rol as U  where U.activo = '1'";
  if($nombre != ""){
      $sql .= " and     U.nombre like '%".$nombre."%'";
  }
  $sql .= " Order by U.nombre";
  $result = mysqli_query($con, $sql);
  $tabla = "";
  if(!(mysqli_num_rows($result)==0)){
    if(mysqli_num_rows($result)){
      $tabla .= "<table class=\"highlight centered\">";
      $tabla .= "<thead><tr><th>Rol</th><th>Descripccion del rol</th><th colspan='2'>Acción</th></thead>";
      while($row = mysqli_fetch_assoc($result)){   
          $tabla .= "<tr>";
          $tabla .= "<td>". $row["nombreU"]. "</td>";
          $tabla .= "<td>". $row["descripcionU"]. "</td>";
          $tabla .= '<td><a class="waves-effect waves-light btn-small" title="Editar datos de Rol" href="editarRol.php?Rol_id='.$row['idU'].'">'."<i class=\"material-icons\">create</i>"."</a>";
          $tabla .= "</td>"; 
          $tabla .= '<td><a class="waves-effect waves-light btn-small" title="Eliminar Rol" href="eliminarRol.php?Rol_id='.$row['idU'].'">'."<i class=\"material-icons\">delete_forever</i>"."</a>";
          $tabla .= "</td>"; 
          $tabla .= "</tr>";
      }
      $tabla .= "</table>";
    }
  }else{
    $tabla .= "
    <div class=\"row\">
    <div class=\"col s12 m12 l12\">
        <div class=\"card blue lighten-1\">
            <div class=\"card-content white-text\">
                <span class=\"card-title\">No se encontró ningún resultado de ".$nombre."</span>
            </div>
        </div>
    </div>
</div>
    ";
  }


  cerrar_bd($con);
  
  return $tabla;
}

function getRolByIdE($id){
  $con = conectar_bd();
  
  $sql = "SELECT  U.idRol as idU, U.nombre as nombreU, U.descripcion as descripcionU 
  FROM Rol as U  where U.activo = '1' and U.idRol=$id";

  $result = mysqli_query($con, $sql);
  $resultado = "";
  
  
  while($row = mysqli_fetch_assoc($result)){
      $resultado .= "<br>
      <div class=\"card teal lighten-2\">
      <div class=\"card-content teal lighten-3\">
      <div class=\" center\" data-indicators=\"true\">
        <div class=\" teal lighten-5 \" href=\"#one!\" >
        <div class='row'>
        <div class=\"col s12 align-center\">
        <div class='row'>
              <!-- Elemento -->
              <div class=\"file-field input-field\">
                <div class=\"col s12\">
                  <label>Nombre del rol</label>
                  <p>".$row["nombreU"]."</p>
              </div>
              </div>
              </div>
              <!-- Elemento -->
              <div class='row'>
              <div class=\"file-field input-field\">
                <div class=\"col s12\">
                  <label>Descripcion del rol</label>
                  <p>".$row["descripcionU"]."</p>
              </div>
              </div>
              </div>
              <div class='row'>

              <div class=\"file-field input-field\">
                <div class=\"input-field col s12 l12 left\">
                  <a id=\"confirmarEliminarRol\" href=\"Controladores\Roles\controladorEliminarRol.php?Rol_id=$id\" class=\"waves-effect red deep-orange darken-4 btn right\">eliminar
                  <i class=\"material-icons right\">remove</i>
                </a>

                  <a id=\"\" href=\"consultarRoles.php\" class=\"waves-effect green lighten-3 btn right\">Volver<i class=\"material-icons right\">undo</i>
                  </a>
              </div>
              </div>
              </div>
            </div>
            </div>
        </div>
      </div>
      </div>
      </div>";
  }
  cerrar_bd($con);
  
  return $resultado;

}

function insertarRol($nombre,$descripcion) {
  $conexion_bd = conectar_bd();
  $activo=1;
  //Prepara la consulta
  $dml = 'INSERT INTO Rol (nombre,descripcion,activo) VALUES (?,?,?)';
  if ( !($statement = $conexion_bd->prepare($dml)) ) {
      die("Error: (" . $conexion_bd->errno . ") " . $conexion_bd->error);
      return 0;
  }
  //Unir los parámetros de la función con los parámetros de la consulta   
  //El primer argumento de bind_param es el formato de cada parámetro
  if (!$statement->bind_param("ssi",$nombre, $descripcion,$activo)) {
      die("Error en vinculación: (" . $statement->errno . ") " . $statement->error);
      return 0;
  } 
  //Executar la consulta
  if (!$statement->execute()) {
    die("Error en ejecución: (" . $statement->errno . ") " . $statement->error);
      return 0;
  }
  cerrar_bd($conexion_bd);
    return 1;
}


function editarRol($id,$nombre,$descripcion) {
  $conexion_bd = conectar_bd();
    
  //Prepara la consulta
  $dml = 'UPDATE Rol SET nombre=(?),descripcion=(?) WHERE idRol=(?)';
  if ( !($statement = $conexion_bd->prepare($dml)) ) {
      die("Error: (" . $conexion_bd->errno . ") " . $conexion_bd->error);
      return 0;
  }
    
  //Unir los parámetros de la función con los parámetros de la consulta   
  //El primer argumento de bind_param es el formato de cada parámetro
  if (!$statement->bind_param("sss",$nombre,$descripcion, $id)) {
      die("Error en vinculación: (" . $statement->errno . ") " . $statement->error);
      return 0;
  }
    
  //Executar la consulta
  if (!$statement->execute()) {
    die("Error en ejecución: (" . $statement->errno . ") " . $statement->error);
      return 0;
  }

  cerrar_bd($conexion_bd);
    return 1;
}
function eliminarRol($id) {
  $conexion_bd = conectar_bd();
  //Prepara la consulta
  $dml = 'UPDATE Rol SET Rol.activo=0 WHERE Rol.idRol=(?)';
  if ( !($statement = $conexion_bd->prepare($dml)) ) {
      die("Error: (" . $conexion_bd->errno . ") " . $conexion_bd->error);
      return 0;
  }
    
  //Unir los parámetros de la función con los parámetros de la consulta   
  //El primer argumento de bind_param es el formato de cada parámetro
  if (!$statement->bind_param("i",$id)) {
      die("Error en vinculación: (" . $statement->errno . ") " . $statement->error);
      return 0;
  }
    
  //Executar la consulta
  if (!$statement->execute()) {
    die("Error en ejecución: (" . $statement->errno . ") " . $statement->error);
      return 0;
  }

  cerrar_bd($conexion_bd);
    return 1;
}

function getRolesUsuarios($nombre="",$rol=""){
  $con = conectar_bd();  
  $sql = "SELECT DISTINCT U.idUser as UsId, U.nombre as nombreU
  FROM Usuario as U, Rol as R , UsuarioRol as UR where UR.idUser = U.idUser and UR.idRol = R.idRol and UR.activo = '1'
  ";
  if($nombre != ""){
    $sql .= " and     U.nombre like '%".$nombre."%'";
  }
  if($rol != ""){
    $sql .= " and     R.idRol=$rol ";
  }
  $sql .= " Order by U.nombre";
  $result1 = mysqli_query($con, $sql);
  $tabla = "";
  if(mysqli_num_rows($result1)){
    $tabla .= "<table class=\"highlight centered\">";
    $tabla .= "<thead>
                  <tr>
                      <th>Usuario</th>
                      <th>Rol</th>
                      <th colspan='2'>Acción</th>
                  </tr>    
              </thead>";
    while($row = mysqli_fetch_assoc($result1)){  
      $sql1 = "SELECT UR.idUsuarioRol as id 
      FROM Usuario as U, UsuarioRol as UR 
      where UR.idUser = U.idUser and UR.activo = '1' and U.idUser = ".$row["UsId"];
      $result2 = mysqli_query($con, $sql1);
      $result2C=0;
      if(mysqli_num_rows($result2)){
        while($row2 = mysqli_fetch_assoc($result2)){  
        $result2C++;
        }
      }
      $sql2 = "SELECT  R.nombre as nombreR,R.idRol as RId,U.idUser as UsId, U.nombre  as nombreU, UR.idUsuarioRol as id 
      FROM Usuario as U, Rol as R , UsuarioRol as UR where UR.idUser = U.idUser and UR.idRol = R.idRol and UR.activo = '1'
      and U.idUser = ".$row["UsId"];
      $sql2 .= " Order by R.nombre";
      $result3 = mysqli_query($con, $sql2);
          if(mysqli_num_rows($result3)){
    
            $result3C=0;
        while($row3 = mysqli_fetch_assoc($result3)){   
            $tabla .= "<tr>";
            if($result3C ==0){
              $tabla .= "<td rowspan='$result2C'>". $row3["nombreU"]. "</td>";
              $result3C++;
            }
            $tabla .= "<td>". $row3["nombreR"]. "</td>";
            $tabla .= '<td><a class="waves-effect waves-light btn-small" title="Editar datos de la relacion rol usuario" href="editarRolesUsuarios.php?Relacion_id='.$row3['id'].'&&Relacion1_id='.$row3['RId'].'&&Relacion2_id='.$row3['UsId'].'">'."<i class=\"material-icons\">create</i>"."</a>";
            $tabla .= "</td>"; 
            $tabla .= '<td><a class="waves-effect waves-light btn-small" title="Eliminar relacion rol usuario" href="eliminarRolesUsuarios.php?Relacion_id='.$row3['id'].'">'."<i class=\"material-icons\">delete_forever</i>"."</a>";
            $tabla .= "</td>"; 
            $tabla .= "</tr>";
        }
      }

    }
    $tabla .= "</table>";
  }else{
    $tabla .= "
    <div class=\"row\">
    <div class=\"col s12 m12 l12\">
        <div class=\"card blue lighten-1\">
            <div class=\"card-content white-text\">
                <span class=\"card-title\">No se encontró ningún resultado de ".$nombre."</span>
            </div>
        </div>
    </div>
</div>
    ";
  }
  cerrar_bd($con);
  return $tabla;
}

function getRolesPrivilegios1($nombre=""){
  $con = conectar_bd();  
  $sql = "SELECT  R.nombre as nombreR,R.idRol as RId,U.idPrivilegios as UsId, U.nombre  as nombreU, UR.idRolPrivilegios as id 
  FROM Privilegios as U, Rol as R , RolPrivilegios as UR where UR.idPrivilegios = U.idPrivilegios and UR.idRol = R.idRol and UR.activo = '1'
  ";
  if($nombre != ""){
      $sql .= " and     U.nombre like '%".$nombre."%'";
  }
  $sql .= " Order by R.nombre,U.nombre";
  $result = mysqli_query($con, $sql);
  $tabla = "";
  if(!(mysqli_num_rows($result)==0)){
    if(mysqli_num_rows($result)){
      $tabla .= "<table class=\"highlight centered\">";
      $tabla .= "<thead><tr><th>Rol</th><th>Privilegios</th><th colspan='2'>Acción</th></thead>";
      while($row = mysqli_fetch_assoc($result)){   
          $tabla .= "<tr>";
          $tabla .= "<td>". $row["nombreR"]. "</td>";
          $tabla .= "<td>". $row["nombreU"]. "</td>";
          $tabla .= '<td><a class="waves-effect waves-light btn-small" title="Editar datos de la relacion rol usuario" href="editarRolesPrivilegios.php?Relacion_id='.$row['id'].'&&Relacion1_id='.$row['RId'].'&&Relacion2_id='.$row['UsId'].'">'."<i class=\"material-icons\">create</i>"."</a>";
          $tabla .= "</td>"; 
          $tabla .= '<td><a class="waves-effect waves-light btn-small" title="Eliminar relacion rol usuario" href="eliminarRolesPrivilegios.php?Relacion_id='.$row['id'].'">'."<i class=\"material-icons\">delete_forever</i>"."</a>";
          $tabla .= "</td>"; 
          $tabla .= "</tr>";
      }
      $tabla .= "</table>";
    }
  }else{
    $tabla .= "
    <div class=\"row\">
    <div class=\"col s12 m12 l12\">
        <div class=\"card blue lighten-1\">
            <div class=\"card-content white-text\">
                <span class=\"card-title\">No se encontró ningún resultado de ".$nombre."</span>
            </div>
        </div>
    </div>
</div>
    ";
  }


  cerrar_bd($con);
  
  return $tabla;
}
function getRolesPrivilegios($nombre="",$rol=""){


  
  $con = conectar_bd();  

  $sql = "SELECT DISTINCT R.nombre as nombreR,R.idRol as RId
    FROM Privilegios as U, Rol as R , RolPrivilegios as UR where UR.idPrivilegios = U.idPrivilegios and UR.idRol = R.idRol and UR.activo = '1'
    ";
  if($nombre != ""){
    $sql .= " and     U.nombre like '%".$nombre."%'";
  }
  if($rol != ""){
    $sql .= " and     R.idRol=$rol ";
  }
  $sql .= " Order by R.nombre";
  $result1 = mysqli_query($con, $sql);
  $tabla = "";
  if(mysqli_num_rows($result1)){
    $tabla .= "<table class=\"highlight centered\">";
    $tabla .= "<thead>
                  <tr>
                      <th>Usuario</th>
                      <th>Rol</th>
                      <th colspan='2'>Acción</th>
                  </tr>    
              </thead>";
    while($row = mysqli_fetch_assoc($result1)){  


      $sql1 = "SELECT   UR.idRolPrivilegios as id 
      FROM  Rol as R , RolPrivilegios as UR 
      where UR.idRol = R.idRol and UR.activo = '1'and R.idRol  = ".$row["RId"];
      $result2 = mysqli_query($con, $sql1);
      $result2C=0;
      if(mysqli_num_rows($result2)){
        while($row2 = mysqli_fetch_assoc($result2)){  
        $result2C++;
        }
      }


      $sql2 = "SELECT  R.nombre as nombreR,R.idRol as RId,U.idPrivilegios as UsId, U.nombre  as nombreU, UR.idRolPrivilegios as id 
      FROM Privilegios as U, Rol as R , RolPrivilegios as UR where UR.idPrivilegios = U.idPrivilegios and UR.idRol = R.idRol and UR.activo = '1'
      and R.idRol = ".$row["RId"];
      $sql2 .= " Order by U.nombre";

      $result3 = mysqli_query($con, $sql2);
          if(mysqli_num_rows($result3)){
    
            $result3C=0;
        while($row3 = mysqli_fetch_assoc($result3)){   





            $tabla .= "<tr>";
            if($result3C ==0){
              $tabla .= "<td rowspan='$result2C'>". $row3["nombreR"]. "</td>";

              $result3C++;
            }
            $tabla .= "<td>". $row3["nombreU"]. "</td>";

            $tabla .= '<td><a class="waves-effect waves-light btn-small" title="Editar datos de la relacion rol usuario" href="editarRolesPrivilegios.php?Relacion_id='.$row3['id'].'&&Relacion1_id='.$row3['RId'].'&&Relacion2_id='.$row3['UsId'].'">'."<i class=\"material-icons\">create</i>"."</a>";
            $tabla .= "</td>"; 
            $tabla .= '<td><a class="waves-effect waves-light btn-small" title="Eliminar relacion rol usuario" href="eliminarRolesPrivilegios.php?Relacion_id='.$row3['id'].'">'."<i class=\"material-icons\">delete_forever</i>"."</a>";
            $tabla .= "</td>"; 
            $tabla .= "</tr>";
        }
      }

    }
    $tabla .= "</table>";
  }else{
    $tabla .= "
    <div class=\"row\">
    <div class=\"col s12 m12 l12\">
        <div class=\"card blue lighten-1\">
            <div class=\"card-content white-text\">
                <span class=\"card-title\">No se encontró ningún resultado de ".$nombre."</span>
            </div>
        </div>
    </div>
</div>
    ";
  }
  cerrar_bd($con);
  return $tabla;
}

function getRolesUsuariosByIdE($id){
  $con = conectar_bd();
  
  $sql = "SELECT  R.nombre as nombreR, U.nombre  as nombreU, UR.idUsuarioRol as id 
  FROM Usuario as U, Rol as R , UsuarioRol as UR where UR.idUser = U.idUser and UR.idRol = R.idRol and UR.activo = '1'
    and UR.idUsuarioRol = $id";

  $result = mysqli_query($con, $sql);
  $resultado = "";
  
  
  while($row = mysqli_fetch_assoc($result)){
      $resultado .= "
      <div class=\"card teal lighten-2\">
      <div class=\"card-content teal lighten-3\">
      <div class=\" center\" data-indicators=\"true\">
        <div class=\" teal lighten-5 \" href=\"#one!\" >
        <div class='row'>
        <div class=\"col s12 align-center\">
              <!-- Elemento -->
              <div class='row'>
              <div class=\"file-field input-field\">
                <div class=\"col s12\">
                  <label>Nombre del Rol</label>
                  <p>".$row["nombreR"]."</p>
              </div>
              </div>
              </div>
              <div class='row'>
              <!-- Elemento -->
              <div class=\"file-field input-field\">
                <div class=\"col s12\">
                  <label>Nombre del usuario</label>
                  <p>".$row["nombreU"]."</p>
              </div>
              </div>
              </div>
              <div class='row'>
              <div class=\"file-field input-field\">
                <div class=\"input-field col s12 l12 left\">
                  <a id=\"confirmarEliminarRol\" href=\"Controladores\RolesUsuarios\controladorEliminarRolesUsuarios.php?Relacion_id=$id\" class=\"waves-effect red deep-orange darken-4 btn right\">eliminar
                  <i class=\"material-icons right\">remove</i>
                </a>

                  <a id=\"\" href=\"consultarRolesUsuario.php\" class=\"waves-effect green lighten-3 btn right\">Volver<i class=\"material-icons right\">undo</i>
                  </a>
              </div>
              </div>
              </div>
            </div>
            </div>
        </div>
      </div>
      </div>
      </div>";
  }
  cerrar_bd($con);
  
  return $resultado;

}
function getRolesPrivilegiosByIdE($id){
  $con = conectar_bd();
  $sql = "SELECT  R.nombre as nombreR, U.nombre  as nombreU, UR.idRolPrivilegios as id 
  FROM Privilegios as U, Rol as R , RolPrivilegios as UR where UR.idPrivilegios = U.idPrivilegios and UR.idRol = R.idRol and UR.activo = '1'
   and UR.idRolPrivilegios = $id";

  $result = mysqli_query($con, $sql);
  $resultado = "";
  
  
  while($row = mysqli_fetch_assoc($result)){
      $resultado .= "<br>
      <div class=\"card teal lighten-2\">
      <div class=\"card-content teal lighten-3\">
      <div class=\" center\" data-indicators=\"true\">
        <div class=\"teal lighten-5 \" href=\"#one!\" >
        <div class='row'>
        <div class=\"col s12 align-center\">
              <!-- Elemento -->
              <div class='row'>

              <div class=\"file-field input-field\">
                <div class=\"col s12\">
                  <label>Nombre del Rol</label>
                  <p>".$row["nombreR"]."</p>
              </div>
              </div>
              </div>
              <div class='row'>
              <!-- Elemento -->
              <div class=\"file-field input-field\">
                <div class=\"col s12\">
                  <label>Nombre del prvilegio</label>
                  <p>".$row["nombreU"]."</p>
              </div>
              </div>
              </div>
              <div class='row'>
              <div class=\"file-field input-field\">
                <div class=\"input-field col s12 l12 left\">
                  <a id=\"confirmarEliminarRol\" href=\"Controladores\RolesPrivilegios\controladorEliminarRolesPrivilegios.php?Relacion_id=$id\" class=\"waves-effect red deep-orange darken-4 btn right\">eliminar
                  <i class=\"material-icons right\">remove</i>
                </a>

                  </a>
                  <a id=\"\" href=\"consultarRolesPrivilegios.php\" class=\"waves-effect green lighten-3 btn right\">Volver<i class=\"material-icons right\">undo</i>
                  </a>
              </div>
              </div>
              </div>
            </div>
        </div>
        </div>
      </div>
      </div>
      </div>";
  }
  cerrar_bd($con);
  
  return $resultado;

}

function insertarRolesUsuarios($idUser,$idRol) {
  $conexion_bd = conectar_bd();
  $activo=1;
  //Prepara la consulta
  $dml = 'INSERT INTO UsuarioRol (idUser,idRol,activo) VALUES (?,?,?)';
  if ( !($statement = $conexion_bd->prepare($dml)) ) {
      die("Error: (" . $conexion_bd->errno . ") " . $conexion_bd->error);
      return 0;
  }
  //Unir los parámetros de la función con los parámetros de la consulta   
  //El primer argumento de bind_param es el formato de cada parámetro
  if (!$statement->bind_param("ssi",$idUser, $idRol,$activo)) {
      die("Error en vinculación: (" . $statement->errno . ") " . $statement->error);
      return 0;
  } 
  //Executar la consulta
  if (!$statement->execute()) {
    die("Error en ejecución: (" . $statement->errno . ") " . $statement->error);
      return 0;
  }
  cerrar_bd($conexion_bd);
    return 1;
}

function insertarRolesPrivilegios($idPrivilegios,$idRol) {
  $conexion_bd = conectar_bd();
  $activo=1;
  //Prepara la consulta
  $dml = 'INSERT INTO RolPrivilegios (idPrivilegios,idRol,activo) VALUES (?,?,?)';
  if ( !($statement = $conexion_bd->prepare($dml)) ) {
      die("Error: (" . $conexion_bd->errno . ") " . $conexion_bd->error);
      return 0;
  }
  //Unir los parámetros de la función con los parámetros de la consulta   
  //El primer argumento de bind_param es el formato de cada parámetro
  if (!$statement->bind_param("ssi",$idPrivilegios, $idRol,$activo)) {
      die("Error en vinculación: (" . $statement->errno . ") " . $statement->error);
      return 0;
  } 
  //Executar la consulta
  if (!$statement->execute()) {
    die("Error en ejecución: (" . $statement->errno . ") " . $statement->error);
      return 0;
  }
  cerrar_bd($conexion_bd);
    return 1;
}


function editarRolesUsuarios($idUsuarioRol,$idUser,$idRol) {
  $conexion_bd = conectar_bd();
    
  //Prepara la consulta
  $dml = 'UPDATE UsuarioRol SET idUser=(?),idRol=(?) WHERE idUsuarioRol=(?)';
  if ( !($statement = $conexion_bd->prepare($dml)) ) {
      die("Error: (" . $conexion_bd->errno . ") " . $conexion_bd->error);
      return 0;
  }
    
  //Unir los parámetros de la función con los parámetros de la consulta   
  //El primer argumento de bind_param es el formato de cada parámetro
  if (!$statement->bind_param("sss",$idUser,$idRol, $idUsuarioRol)) {
      die("Error en vinculación: (" . $statement->errno . ") " . $statement->error);
      return 0;
  }
    
  //Executar la consulta
  if (!$statement->execute()) {
    die("Error en ejecución: (" . $statement->errno . ") " . $statement->error);
      return 0;
  }

  cerrar_bd($conexion_bd);
    return 1;
}
function editarRolesPrivilegios($idRolPrivilegios,$idPrivilegios,$idRol) {
  $conexion_bd = conectar_bd();
    
  //Prepara la consulta
  $dml = 'UPDATE RolPrivilegios SET idPrivilegios=(?),idRol=(?) WHERE idRolPrivilegios=(?)';
  if ( !($statement = $conexion_bd->prepare($dml)) ) {
      die("Error: (" . $conexion_bd->errno . ") " . $conexion_bd->error);
      return 0;
  }
    
  //Unir los parámetros de la función con los parámetros de la consulta   
  //El primer argumento de bind_param es el formato de cada parámetro
  if (!$statement->bind_param("sss",$idPrivilegios,$idRol, $idRolPrivilegios)) {
      die("Error en vinculación: (" . $statement->errno . ") " . $statement->error);
      return 0;
  }
    
  //Executar la consulta
  if (!$statement->execute()) {
    die("Error en ejecución: (" . $statement->errno . ") " . $statement->error);
      return 0;
  }

  cerrar_bd($conexion_bd);
    return 1;
}
function eliminarRolesUsuarios($id) {
  $conexion_bd = conectar_bd();
  //Prepara la consulta
  $dml = 'UPDATE UsuarioRol SET UsuarioRol.activo=0 WHERE UsuarioRol.idUsuarioRol=(?)';
  if ( !($statement = $conexion_bd->prepare($dml)) ) {
      die("Error: (" . $conexion_bd->errno . ") " . $conexion_bd->error);
      return 0;
  }
    
  //Unir los parámetros de la función con los parámetros de la consulta   
  //El primer argumento de bind_param es el formato de cada parámetro
  if (!$statement->bind_param("i",$id)) {
      die("Error en vinculación: (" . $statement->errno . ") " . $statement->error);
      return 0;
  }
    
  //Executar la consulta
  if (!$statement->execute()) {
    die("Error en ejecución: (" . $statement->errno . ") " . $statement->error);
      return 0;
  }

  cerrar_bd($conexion_bd);
    return 1;
}
function eliminarRolesPrivilegios($id) {
  $conexion_bd = conectar_bd();
  //Prepara la consulta
  $dml = 'UPDATE RolPrivilegios SET RolPrivilegios.activo=0 WHERE RolPrivilegios.idRolPrivilegios=(?)';
  if ( !($statement = $conexion_bd->prepare($dml)) ) {
      die("Error: (" . $conexion_bd->errno . ") " . $conexion_bd->error);
      return 0;
  }
    
  //Unir los parámetros de la función con los parámetros de la consulta   
  //El primer argumento de bind_param es el formato de cada parámetro
  if (!$statement->bind_param("i",$id)) {
      die("Error en vinculación: (" . $statement->errno . ") " . $statement->error);
      return 0;
  }
    
  //Executar la consulta
  if (!$statement->execute()) {
    die("Error en ejecución: (" . $statement->errno . ") " . $statement->error);
      return 0;
  }

  cerrar_bd($conexion_bd);
    return 1;
}
?>