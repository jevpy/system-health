<?php
include "./php/conexion.php";

// session_start();

// if (isset($_SESSION["usuario_id"]) && isset($_SESSION["session_id"]) && $_SESSION["session_id"] === session_id()) {
//   session_destroy();
// }
// header("Location: {$hostname}/loginEssalud.php");
// exit();



session_start();
session_destroy();
session_unset();
header("Location: {$hostname}/loginEssalud.php");
exit();



