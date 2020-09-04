<?php
session_start();
session_unset();
session_destroy();
header("Status: 301 Moved Permanently");

header("location:../../index.php");
exit;
?>