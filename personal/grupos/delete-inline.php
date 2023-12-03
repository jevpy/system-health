<?php

$grupo_id = $_GET['id'];

include './php/conexion.php';

$sql = "DELETE FROM grupo WHERE grupo_id = {$grupo_id}";


try {
  $result = mysqli_query($conn, $sql) or die("Query Unsuccessful.");
} catch (\Throwable $th) {
  header("location: ./error.php");
  die();
}


// $sql = "DELETE FROM grupo WHERE grupo_id = {$grupo_id}";

// $result = mysqli_query($conn, $sql) or die("Query Unsuccessful.");


header("Location: ./index.php");

mysqli_close($conn);

?>