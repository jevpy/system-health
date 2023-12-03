<?php
include_once "./inc/header.php";
include_once "./encrypt.php";
?>

<article class="container">
  <article class="modal">
    <?php
    include './php/conexion.php';
    $usuario_id = encryptor('decrypt', $_GET['id']);
    $sql = "SELECT username FROM usuarios WHERE usuario_id = {$usuario_id}";
    try {
      $result = mysqli_query($conn, $sql);

    } catch (\Throwable $th) {
      header("location: {$hostname}/404.php");
    }

    if (mysqli_num_rows($result) > 0) {
      while ($row = mysqli_fetch_assoc($result)) {
        ?>
        <h2>Deseas eliminar el usuario: <i>
            <?php echo $row['username']; ?>
          </i></h2>
        <div>
          <a href='delete-inline.php?id=<?php echo $usuario_id ?>'>Si</a>
          <a href='./index.php'>No</a>
        </div>
      <?php
      }
    } else {
      header("Location: $hostname/404.php");
    }
    ?>
  </article>
</article>

<script src="./js/index.js"></script>
</body>

</html>