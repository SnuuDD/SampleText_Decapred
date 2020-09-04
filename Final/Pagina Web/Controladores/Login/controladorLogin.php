<?php
  session_start();
  require_once("../../util.php");  
  $_POST["user"] = htmlspecialchars($_POST["user"]);
  $_POST["pwd"] = htmlspecialchars($_POST["pwd"]);
  if(isset($_POST["user"]) && isset($_POST["pwd"])) {
      if (login($_POST["user"],$_POST["pwd"])) {
        header("Status: 301 Moved Permanently");

        header("location:../../bienvenido.php");
        exit;
      } else {
        header("Status: 301 Moved Permanently");

        header("location:../../index.php");
        exit;
      }
  }
?>