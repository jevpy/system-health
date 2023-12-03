<?php
// include "./php/conexion.php";

// // session_start();
// // if (isset($_SESSION["usuario_id"]) && isset($_SESSION["session_id"]) && $_SESSION["session_id"] === session_id()) {
// //   session_destroy();
// // }
// // header("Location: {$hostname}/loginEssalud.php");
// // exit();


// session_start();
// session_destroy();
// session_unset();
// header("Location: {$hostname}/loginEssalud.php");
// exit();



include "./php/conexion.php";

session_start();

$sql2 = "SELECT timesSession FROM usuarios WHERE username = 'admin'";

$result2 = mysqli_query($conn, $sql2) or die("Query Unsuccessful.");

while ($row2 = mysqli_fetch_array($result2)) {
  $timesSession = $row2["timesSession"];

  if ($timesSession == 1 || $timesSession == 0) {
    $timesSession += 1;

    $sql = "UPDATE usuarios SET timesSession = $timesSession WHERE username = 'admin'";

    try {
      $result = mysqli_query($conn, $sql) or die("Query Unsuccessful.");

    } catch (\Throwable $th) {
      header("location: {$hostname}/404.php");
    }
  }
}

// if (!isset($_SESSION["usuario_id"])) {
session_destroy();
session_unset();
header("Location: {$hostname}/loginEssalud.php");
exit();
