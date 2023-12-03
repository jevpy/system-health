<?php
include "./php/conexion.php";

session_start();

$sql = "SELECT timesSession FROM usuarios WHERE username = 'admin'";
$result = mysqli_query($conn, $sql) or die('Error comando sql');

while ($row = mysqli_fetch_array($result)) {
  $timesSession = $row['timesSession'];
  if ($timesSession == '0') {
    if (!isset($_SESSION["usuario_id"]) || !isset($_SESSION['timesSession'])) {
      header("Location: {$hostname}/loginEssalud.php");
    }

  } else {
    if (!isset($_SESSION["usuario_id"])) {
      header("Location: {$hostname}/loginEssalud.php");
    }
  }
}


?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Sistema Pacientes</title>
  <link rel="stylesheet" href="./access.css">
</head>

<body>
  <article class="container">    
    <article class="warning">
      <h2>¡Lo sentimos, ha ocurrido un problema inesperado!</h2> 
      <p>Complete todos los campos del formulario o asegúrese de que coincidan las contraseñas</p>
      <a href="access.php">Ok</a>
    </article>
  </article>

  <script src="./js/index.js"></script>
</body>

</html> 