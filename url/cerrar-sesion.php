<?php
include "./php/conexion.php";

session_start();

  // if($_SESSION['usuario_rol'] === 3){
  //   header("Location: {$hostname}/loginPaciente.php");
  // } else{
  //   header("Location: {$hostname}/loginEssalud.php");
  // }

  // session_unset();
  
  // session_destroy();

if (isset($_SESSION["usuario_id"]) && isset($_SESSION["session_id"]) && $_SESSION["session_id"] === session_id()) {
  session_destroy();
}
header("Location: {$hostname}/loginPaciente.php");
exit();



