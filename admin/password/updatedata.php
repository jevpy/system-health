<?php

session_start();
$usuario_id = $_SESSION["usuario_id"];

$rol = 2;

$passwordActual=trim($_POST['password']);
$newPassword=trim($_POST['newPassword']);
$newPasswordRepeat=trim($_POST['newPasswordRepeat']);



include './php/conexion.php';



if (empty($passwordActual) || empty($newPassword) || empty($newPasswordRepeat)) {
  header("Location: warning-edit.php?id=$usuario_id");
  die();
}

if ($newPassword!=$newPasswordRepeat) {
    header("Location: warning-edit.php?id=$usuario_id");
    die();
}

$sql4 = "SELECT * FROM usuarios WHERE usuario_id = $usuario_id";
$result4 = mysqli_query($conn, $sql4) or die("Query Unsuccesful");


if ($row4 = mysqli_fetch_assoc($result4)) {

    if ($passwordActual !== $row4['password']) {
        header("Location: warning-edit.php?id=$usuario_id");
        die();
    }
}


$sql = "UPDATE usuarios SET password = '{$newPassword}' WHERE usuario_id = {$usuario_id}";
$result = mysqli_query($conn, $sql) or die("Query Unsuccessful.");

/*$sql2 = "UPDATE roles_x_usuario SET rol = {$rol} WHERE usuario = {$usuario_id}";
$result = mysqli_query($conn, $sql2) or die("Query Unsuccessful.");*/


header("Location: ./index.php");

mysqli_close($conn);

?>