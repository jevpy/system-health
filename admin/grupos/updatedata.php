<?php
$grupo_id = $_POST['grupo_id'];
$name = trim($_POST['name']);

include './php/conexion.php';

if(empty($name)){
  header("Location: warning-edit.php?id=$grupo_id");
  die();
}

   $sql4 = "SELECT * FROM grupo WHERE grupo_id != $grupo_id";
  $result4 = mysqli_query($conn, $sql4) or die("Query Unsuccesful");

  while ($row4 = mysqli_fetch_assoc($result4)) {
    if (($name == $row4['nombre_grupo'])) {
      header("Location: ./warning-edit.php?id=$grupo_id");
      die();

    }
  }


  $sql = "UPDATE grupo SET nombre_grupo = '{$name}' WHERE grupo_id = {$grupo_id}";
  $result = mysqli_query($conn, $sql) or die("Query Unsuccessful.");




  header("Location: ./index.php");

  mysqli_close($conn);

?>
