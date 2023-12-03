<?php

$camilla_id = $_GET['id'];

include './php/conexion.php';

$sql = "DELETE FROM camillas WHERE camilla_id = {$camilla_id}";
// $sql1 = "DELETE FROM roles_x_usuario WHERE usuario = {$usuario_id}";

// $result1 = mysqli_query($conn, $sql1) or die("Query Unsuccessful.");
$result = mysqli_query($conn, $sql) or die("Query Unsuccessful.");


header("Location: ./index.php");

mysqli_close($conn);

?>
