<?php
$usuario_id = $_POST['usuario_id'];
$nombre = trim($_POST['name']);
$apellido = trim($_POST['surname']);
$username = trim($_POST['username']);
$correo = trim($_POST['correo']);
$rol = 2;

include './php/conexion.php';

if (empty($nombre) || empty($apellido) || empty($username) || empty($correo) || empty($rol)) {
  header("Location: warning-edit.php?id=$usuario_id");
  die();
}

try {
  $sql4 = "SELECT * FROM usuarios WHERE usuario_id != $usuario_id";
  $result4 = mysqli_query($conn, $sql4) or die("Query Unsuccesful");

  while ($row4 = mysqli_fetch_assoc($result4)) {
    if (($nombre == $row4['nombre'] && $apellido == $row4['apellido']) || $correo == $row4['correo'] || $username == $row4['username']) {
      header("Location: warning-edit.php?id=$usuario_id");
      die();
    }
  }


  $sql = "UPDATE usuarios SET nombre = '{$nombre}', apellido = '{$apellido}', username = '{$username}', correo = '{$correo}' WHERE usuario_id = {$usuario_id}";
  $result = mysqli_query($conn, $sql) or die("Query Unsuccessful.");

  $sql2 = "UPDATE roles_x_usuario SET rol = {$rol} WHERE usuario = {$usuario_id}";
  $result = mysqli_query($conn, $sql2) or die("Query Unsuccessful.");

} catch (\Throwable $th) {
  header("location: {$hostname}/404.php");
}



header("Location: ./index.php");

mysqli_close($conn);

?>