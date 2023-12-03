<?php 
include_once ("../php/conexion.php");

?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Sistema Pacientes</title>
  <link rel="stylesheet" href="./css/recuperateAccount.css">
</head>

<body>
  <article class="container">
    <article class="warning">
      <h2>¡El correo ha sido enviado exitosamente!</h2>
      <p>Verifique su bandeja de entrada </p>
      <a href="<?php echo $hostname?>/loginEssalud.php">Ok</a>
    </article>
  </article>

</body>

</html>