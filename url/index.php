<?php
include "./php/conexion.php";
include "./encrypt.php";
// session_start();

// if (!isset($_SESSION["usuario_id"]) || !isset($_SESSION["session_id"])){
//   header("Location: {$hostname}/loginPaciente.php");
// }

// $usuario_id = $_SESSION["usuario_id"];
// $grupo = $_SESSION["usuario_grupo"] ;

$camilla = $_GET['camilla'];
$newCamilla = encryptor('decrypt', $camilla);

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Sistema Pacientes</title>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="./css/index.css">
</head>

<body>
  <header class="header">
    <article class="container">
      <nav class="menu">
        <h3>Plataforma Tecnologica de orientacion</h3>
        <!-- <img src="../../images/essalud-azul-2.png" alt=""> -->
        <!-- <a href="./cerrar-sesion.php" class="btn-sesion">Cerrar Sesión</a> -->
      </nav>
    </article>
  </header>
  <main>
    <article class="glassmorphism">
      <article class="container">
        <!-- <h1>PLATAFORMA TECNOLÓGICA DE ORIENTACIÓN</h1> -->
        <p>¡Hola! A continuación, verás unos videos realizados por nuestro personal de salud con el objetivo de guiarte
          en tu recuperación.</p>
        <!-- <a href="" class="btn-main">INICIAR AHORA</a> -->
      </article>
    </article>
  </main>



  <section class="videos">
    <article class="container">
      <h2>Prevenciones</h2>
      <p>Di adiós a la incertidumbre y dile hola al tratamiento adecuado.</p>
      <article class="video-container">
        <?php

        $sql = "SELECT camillas.camilla_id, camillas.grupo ,grupo.grupo_id, grupo.nombre_grupo
      FROM camillas
      LEFT JOIN grupo ON grupo.grupo_id = camillas.grupo WHERE camilla_id = $newCamilla";
        try {
          $result = mysqli_query($conn, $sql) or die("Query Unsuccessful");
          //code...
        } catch (\Throwable $th) {
          header("location: $hostname/404.php");
          //throw $th;
        }

        if (mysqli_num_rows($result) > 0) {
          while ($row = mysqli_fetch_assoc($result)) {
            $grupo = $row["grupo_id"];

            if ($grupo == 4) { ?>
              <h3>Tu camilla no ha sido asignado a ningún grupo de videos</h3>
            <?php }
            $sql2 = "SELECT grupo.grupo_id, grupo.nombre_grupo, video.url, video.descripcion_video, grupo_x_video.grupo FROM  grupo_x_video LEFT JOIN grupo ON grupo.grupo_id = grupo_x_video.grupo
          LEFT JOIN video ON video.video_id = grupo_x_video.video 
          WHERE grupo_id = $grupo";
            try {
              $result2 = mysqli_query($conn, $sql2) or die("Query Unsuccessful");
            } catch (\Throwable $th) {
              header("Location: $hostname/404.php");
            }

            while ($row2 = mysqli_fetch_assoc($result2)) { ?>
              <article class="video-content">
                <iframe src="<?php echo substr_replace($row2['url'], 'preview', 66) ?>" class="iframe"
                  allow="autoplay"></iframe>
                <p>
                  <?php echo $row2['descripcion_video'] ?>
                </p>
              </article>
            <?php }
          }
        } else {
          header("location: $hostname/404.php");
        }

        mysqli_close($conn);
        ?>
      </article>
  </section>


</body>

</html>