<?php



$usuario_id = $_GET['id'];

include './php/conexion.php';

$sql = "DELETE FROM usuarios WHERE usuario_id = {$usuario_id}";
$sql1 = "DELETE FROM roles_x_usuario WHERE usuario = {$usuario_id}";

try {
  $result1 = mysqli_query($conn, $sql1) or die("Query Unsuccessful.");
  $result = mysqli_query($conn, $sql) or die("Query Unsuccessful.");
} catch (\Throwable $th) {
  header("location: {$hostname}/404.php");
}


header("Location: ./index.php");

mysqli_close($conn);

?>
