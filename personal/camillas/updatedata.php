<?php
$camilla_id = $_POST['camilla_id'];
$nombre = trim($_POST['name']);
$grupo = $_POST['grupo'];

include './php/conexion.php';

if (empty($grupo)) {
  header("Location: warning-edit.php?id=$camilla_id");
  die();
}

// $sql4 = "SELECT * FROM camillas WHERE usuario_id != $usuario_id";
// $result4 = mysqli_query($conn, $sql4);

//  while ($row4 = mysqli_fetch_assoc($result4)) {
//   if ((($nombre == $row4['nombre'] && $apellido == $row4['apellido']) && $grupo == $row4['grupo']) || $password == $row4['password'] ) {
//     header("Location: warning-edit.php?id=$usuario_id");
//     die();

//   }
// }
$sql = "UPDATE camillas SET grupo = {$grupo} WHERE camilla_id = {$camilla_id}";
try {
  $result = mysqli_query($conn, $sql) or die("Query Unsuccessful.");

} catch (\Throwable $th) {
  header("location: {$hostname}/404.php");
}

header("Location: ./index.php");

mysqli_close($conn);


?>