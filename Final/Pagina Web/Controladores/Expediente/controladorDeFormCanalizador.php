<?php
  require_once("../../util.php");  
  $form = "";
  $form  .= "<br>
      <div class=\"col s12 align-center\">
            <!-- Elemento -->
            <div class=\"file-field input-field\">
              <div class=\"input-field col s12\">
                <i class=\"material-icons prefix\"> </i>
                <input placeholder=\"Juan Perez\" type=\"text\" class=\"validate\" name=\"nombreC\" id=\"nombre\"required>
                <label for=\"rol\"><strong>Nombre</strong></label>     
            </div>
            </div>
            <!-- Elemento -->
            <div class=\"file-field input-field\">
              <div class=\"input-field col s4\">
                <i class=\"material-icons prefix\"> </i>
                <input placeholder=\"Numero de telefono\" type=\"text\" class=\"validate\" name=\"telefono\" id=\"telefono\" required>
                <label for=\"rol\"><strong>Telefono</strong></label>     
              </div>
            </div>
            <!-- Elemento -->
            <div class=\"file-field input-field\">
              <div class=\"input-field col s8\">
                <i class=\"material-icons prefix\"> </i>
                <input placeholder=\"..@gmail.com\" type=\"text\" class=\"validate\" name=\"email\" id=\"email\" required>
                <label for=\"rol\"><strong>Correo Electronico</strong></label>     
              </div>
            </div>
           
  
          <!-- Elemento -->
            <div class=\"file-field input-field\">
              <div class=\"input-field col s4\">
                <i class=\"material-icons prefix\"> </i>
                <input placeholder=\"INE/Pasaporte\" type=\"text\" class=\"validate\" name=\"identificacion\" id=\"identificacion\" required>
                <label for=\"rol\"><strong>Identificacion</strong></label>     
              </div>
            </div> 
  
            <!-- Elemento -->
            <div class=\"file-field input-field\">
              <div class=\"input-field col s8\">
                <i class=\"material-icons prefix\"> </i>
                <input placeholder=\"A05848754154\" type=\"text\" class=\"validate\" name=\"numeroI\" id=\"numeroI\" required>
                <label for=\"rol\"><strong>Numero de identificacion</strong></label>     
              </div>
            </div>
             <!-- Elemento -->
             <div class=\"file-field input-field\">
              <div class=\"input-field col s4\">";
            $form .= crear_selectInstituciones("idInstitucion", "nombre", "Institucion");

            $form .= "</div>
            </div>
  
             <!-- Elemento -->
             <div class=\"file-field input-field\">
              <div class=\"input-field col s8\">
                <i class=\"material-icons prefix\"> </i>
                <input placeholder=\"Supervisor\" type=\"text\" class=\"validate\" name=\"cargo\" id=\"cargo\" required>
                <label for=\"rol\"><strong>Cargo</strong></label>     
              </div>
            </div>
          </div>
        </div>";
  echo $form;
?>