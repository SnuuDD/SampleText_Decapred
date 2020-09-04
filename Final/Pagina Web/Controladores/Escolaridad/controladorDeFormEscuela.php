<?php
  require_once("../../util.php");  
  $_POST["SELECT"] = htmlspecialchars($_POST["SELECT"]);
  $form ="";
  if($_POST["SELECT"]==0){
    $form = "        

    <!--Elemento-->
        <div class=\"file-field input-field\">
          <div class=\"input-field col s12\">
            <i class=\"material-icons prefix\"> </i>
            <input placeholder=\"secundaria general 1\" type=\"text\"  name=\"escuela_nombre\" id=\"escuela_nombre\" required>

            <label for=\"rol\"><strong>Nombre de la escuela</strong></label>     
        </div>
        </div>
        <!--Elemento-->
        <div class=\"file-field input-field\">
          <div class=\"input-field col s12\">
            <i class=\"material-icons prefix\"> </i>
            <input placeholder=\"371 Jedidiah Extension\" type=\"text\"  name=\"direccion_nombre\" id=\"direccion_nombre\" required>

            <label for=\"rol\"><strong>Dirección</strong></label>     
        </div>
        </div>
        <!--Elemento-->
        <div class=\"file-field input-field\">
          <div class=\"input-field col s12\">
            <i class=\"material-icons prefix\"> </i>
            <input placeholder=\"Kathryne Kertzmann\" type=\"text\"  name=\"director_nombre\" id=\"directora_nombre\" required>

            <label for=\"rol\"><strong>Nombre del director</strong></label>     
        </div>
        </div>
          <!-- Elemento -->
          <div class=\"file-field input-field\">
            <div class=\"input-field col s6\">
              <i class=\"material-icons prefix\"> </i>
              <input placeholder=\"transmittin@gamil.com\" id=\"email\" type=\"email\" class=\"validate\" name=\"email\" id=\"email\">
              <label for=\"email\">Email</label>   
            </div>
            <div class=\"input-field col s6\">
              <i class=\"material-icons prefix\"></i>
              <input placeholder=\"468.100.2922 x272\" id=\"icon_telephone\" type=\"tel\" class=\"validate\" name=\"telefono\" id=\"telefono\">
              <label for=\"icon_telephone\">Telephone</label>
            </div>  
          </div>

  <br>
  ";
  }else{
    $form ="";
  }

  
  echo $form;
?>