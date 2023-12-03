<?php
// include "./php/conexion.php";
// // session_start();
// // if (!isset($_SESSION["usuario_id"]) || !isset($_SESSION["session_id"])) {
// //   header("Location: {$hostname}/loginEssalud.php");
// // }

// session_start();

// if (!isset($_SESSION["usuario_id"])) {
//   header("Location: {$hostname}/loginEssalud.php");
// }

include "./php/conexion.php";
session_start();

$sql = "SELECT timesSession FROM usuarios WHERE username = 'admin'";
$result = mysqli_query($conn, $sql) or die('Error comando sql');

while ($row = mysqli_fetch_array($result)) {
  $timesSession = $row['timesSession'];
  if ($timesSession == '0' && !$_SESSION['access']) {

    if (!isset($_SESSION["usuario_id"]) || !isset($_SESSION['access'])) {
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
<html lang="es">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Sistema Pacientes</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@tabler/icons-webfont@latest/tabler-icons.min.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@mdi/font@7.2.96/css/materialdesignicons.min.css">
  <link rel="stylesheet" href="./css/index.css">
</head>

<body>
  <header class="header">
    <nav class="menu">
      <h1>Admin</h1>
      <!-- <nav class="nav"> -->
      <!-- <article class="menu"> -->
      <a href="../personal/index.php">
        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-report-medical" width="30"
          height="30" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round"
          stroke-linejoin="round">
          <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
          <path d="M9 5h-2a2 2 0 0 0 -2 2v12a2 2 0 0 0 2 2h10a2 2 0 0 0 2 -2v-12a2 2 0 0 0 -2 -2h-2"></path>
          <path d="M9 3m0 2a2 2 0 0 1 2 -2h2a2 2 0 0 1 2 2v0a2 2 0 0 1 -2 2h-2a2 2 0 0 1 -2 -2z"></path>
          <path d="M10 14l4 0"></path>
          <path d="M12 12l0 4"></path>
        </svg>
        <p>Personal</p>
      </a>
      <a href="../camillas/index.php">
        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-emergency-bed" width="24"
          height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round"
          stroke-linejoin="round">
          <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
          <path d="M16 18m-2 0a2 2 0 1 0 4 0a2 2 0 1 0 -4 0"></path>
          <path d="M8 18m-2 0a2 2 0 1 0 4 0a2 2 0 1 0 -4 0"></path>
          <path d="M4 8l2.1 2.8a3 3 0 0 0 2.4 1.2h11.5"></path>
          <path d="M10 6h4"></path>
          <path d="M12 4v4"></path>
          <path d="M12 12v2l-2.5 2.5"></path>
          <path d="M14.5 16.5l-2.5 -2.5"></path>
        </svg>
        <p>Camillas</p>
      </a>
      <a href="../grupos/index.php">
        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-users-group" width="44" height="44"
          viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" fill="none" stroke-linecap="round"
          stroke-linejoin="round">
          <path stroke="none" d="M0 0h24v24H0z" fill="none" />
          <path d="M10 13a2 2 0 1 0 4 0a2 2 0 0 0 -4 0" />
          <path d="M8 21v-1a2 2 0 0 1 2 -2h4a2 2 0 0 1 2 2v1" />
          <path d="M15 5a2 2 0 1 0 4 0a2 2 0 0 0 -4 0" />
          <path d="M17 10h2a2 2 0 0 1 2 2v1" />
          <path d="M5 5a2 2 0 1 0 4 0a2 2 0 0 0 -4 0" />
          <path d="M3 13v-1a2 2 0 0 1 2 -2h2" />
        </svg>

        <p>Grupos</p>
      </a>

      <!-- <a href="../password/index.php" class="btn-session">
            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-key" width="44" height="44"
                 viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                <path d="M16.555 3.843l3.602 3.602a2.877 2.877 0 0 1 0 4.069l-2.643 2.643a2.877 2.877 0 0 1 -4.069 0l-.301 -.301l-6.558 6.558a2 2 0 0 1 -1.239 .578l-.175 .008h-1.172a1 1 0 0 1 -.993 -.883l-.007 -.117v-1.172a2 2 0 0 1 .467 -1.284l.119 -.13l.414 -.414h2v-2h2v-2l2.144 -2.144l-.301 -.301a2.877 2.877 0 0 1 0 -4.069l2.643 -2.643a2.877 2.877 0 0 1 4.069 0z" />
                <path d="M15 9h.01" />
            </svg>

            <p>Cambiar Contraseña</p>
        </a> -->
      <!-- </article> -->
      <!-- </nav> -->
      <a href="cerrar-sesion.php" class="btn-session">
        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-logout" width="30" height="30"
          viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round"
          stroke-linejoin="round">
          <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
          <path d="M14 8v-2a2 2 0 0 0 -2 -2h-7a2 2 0 0 0 -2 2v12a2 2 0 0 0 2 2h7a2 2 0 0 0 2 -2v-2"></path>
          <path d="M9 12h12l-3 -3"></path>
          <path d="M18 15l3 -3"></path>
        </svg>
        <p>Salir</p>
        <!-- <form method="post" action="<?php $_SERVER['PHP_SELF']; ?>">
            <input type="submit" name="cerrar_sesion" value="Cerrar Sesión">
          </form> -->
      </a>
    </nav>
  </header>