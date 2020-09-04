<?php
  require_once("../../util.php");  
  $_POST["SELECT"] = htmlspecialchars($_POST["SELECT"]);
  $form ="";
  if($_POST["SELECT"]==0){
    $form = "                <div class=\"file-field input-field\">
    <div class=\"input-field col s12\">
      <i class=\"material-icons prefix\"> </i>
      <input placeholder=\"Primaria 1 grado\" type=\"text\" name=\"gradoEscolar_nombre\" id=\"gradoEscolar_nombre\" required>
      <label for=\"rol\"><strong>Nombre</strong></label>     
  </div>
  </div>
  <br>
  ";
  }else{
    $form ="";
  }

  
  echo $form;
?>