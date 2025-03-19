<?php 
session_start();

session_destroy();

header("location:/plantilla-php-master/vista/login/login.php");
?>