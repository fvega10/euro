<?php
//Reanudamos la sesión 
session_start(); 
//Literalmente la destruimos 
session_destroy(); 
//Redireccionamos a index.php (al inicio de sesión) 
echo "<script type='text/javascript'>location.href = '../index.php'; </script>";
?>