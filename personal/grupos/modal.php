<?php
include_once "./inc/header.php";
?>

<article class="container">
  <article class="modal">
    <?php
    include './php/conexion.php';
    $grupo_id = $_GET['id'];
    $sql = "SELECT nombre_grupo FROM grupo WHERE grupo_id = {$grupo_id}";

    try {
      $result = mysqli_query($conn, $sql);

    } catch (\Throwable $th) {
      header("location: {$hostname}/404.php");
    }

    if (mysqli_num_rows($result) > 0) {
      while ($row = mysqli_fetch_assoc($result)) {
        ?>
        <h2>Deseas eliminar el grupo: <i>
            <?php echo $row['nombre_grupo']; ?>
          </i></h2>
        <div>
          <a href='delete-inline.php?id=<?php echo $grupo_id ?>'>Si</a>
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