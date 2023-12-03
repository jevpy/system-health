<?php
include_once "./inc/header.php";
?>

<article class="container">
  <article class="modal">
    <?php
    include './php/conexion.php';
    $grupoid = $_GET['grupo'];
    $video_id = $_GET['id'];
    $sql = "SELECT nombre_video FROM video WHERE video_id = {$video_id}";
    try {
      $result = mysqli_query($conn, $sql);

    } catch (\Throwable $th) {
      header("location: $hostname/404.php");
    }

    if (mysqli_num_rows($result) > 0) {
      while ($row = mysqli_fetch_assoc($result)) {
        ?>
        <h2>Deseas eliminar el video: <br>
          <i>
            <?php echo $row['nombre_video']; ?>
          </i>
        </h2>
        <div>
          <a href='delete-inline.php?grupo=<?php echo $grupoid ?>&id=<?php echo $video_id ?>'>Si</a>
          <a href='./index.php?id=<?php echo $grupoid ?>'>No</a>
        </div>
        <?php
      }
    } else {

      header("location: $hostname/404.php");
    }
    ?>
  </article>
</article>

<script src="./js/index.js"></script>
</body>

</html>