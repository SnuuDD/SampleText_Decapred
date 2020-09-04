<?php
  require_once("../../util.php");  
  $_POST["SELECT"] = htmlspecialchars($_POST["SELECT"]);
  $form ="";
  if($_POST["SELECT"]==0){
    $form = "        <div class=\"file-field input-field\">
    <div class=\"input-field col s12\">
      <i class=\"material-icons prefix\"> </i>
      <input placeholder=\"Amputacion\" type=\"text\"  name=\"discapacidad_nombre\" id=\"discapacidad_nombre\" required>
  
      <label for=\"rol\"><strong>Nombre de la nueva discapacidad</strong></label>     
  </div>
  </div>
  <br>
  ";
  }else{
    $form ="";
  }

  
  echo $form;
?>