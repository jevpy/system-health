<?php
include_once "./inc/header.php";
$id = $_GET["id"];

if (!$id || empty($id)) {
  header("location: /proyecto3/404.php");
}

?>

<main>
  <?php
  include './php/conexion.php';

  $sql = "SELECT video.video_id, video.nombre_video, video.url, video.descripcion_video,
  grupo.grupo_id, grupo.nombre_grupo
          FROM grupo_x_video 
          LEFT JOIN video ON video.video_id = grupo_x_video.video 
          LEFT JOIN grupo ON grupo.grupo_id = grupo_x_video.grupo WHERE grupo = {$id}
        ";
  $sql2 = "SELECT *
          FROM grupo WHERE grupo_id = {$id}
        ";

  try {
    $result = mysqli_query($conn, $sql) or die("Query Unsuccessful.");
    $result2 = mysqli_query($conn, $sql2) or die("Query Unsuccessful.");
  } catch (\Throwable $th) {
    header("location: $hostname/404.php");
  } ?>

  <div style="text-align: center;">
    <!-- <input class="btn_add" type="button" name="agregar" onclick="window.location.href = 'add.php'"
        value="Añadir video" /> -->
    <a href='add.php?grupo=<?php echo $id ?>' class="btn_add">Añadir video</a>
  </div>

  <?php
  if (mysqli_num_rows($result) > 0) {

    ?>
    <article class="container">
      <h1>
        <?php
        $row2 = mysqli_fetch_array($result2);
        echo $row2['nombre_grupo'];
        ?>
      </h1>
      <table class="table">
        <thead>
          <tr>
            <th>Nombre</th>
            <th>Url</th>
            <th>Descripcion</th>
            <th>Acciones</th>
          </tr>
        </thead>
        <tbody>
          <?php
          while ($row = mysqli_fetch_assoc($result)) {
            ?>
            <tr>
              <td data-label="Nombre_video">
                <?php echo $row['nombre_video']; ?>
              </td>
              <td data-label="Url"><a href="<?php echo $row['url']; ?>">
                  <?php echo $row['url']; ?>
                </a></td>
              <td data-label="Descripcion">
                <?php echo $row['descripcion_video']; ?>
              </td>
              <td data-label="Acciones">
                <div>
                  <a href='edit.php?grupo=<?php echo $id ?>&id=<?php echo $row['video_id']; ?>'>
                    <button class="btn-action">Editar
                      <svg class="svg" viewBox="0 0 512 512">
                        <path
                          d="M410.3 231l11.3-11.3-33.9-33.9-62.1-62.1L291.7 89.8l-11.3 11.3-22.6 22.6L58.6 322.9c-10.4 10.4-18 23.3-22.2 37.4L1 480.7c-2.5 8.4-.2 17.5 6.1 23.7s15.3 8.5 23.7 6.1l120.3-35.4c14.1-4.2 27-11.8 37.4-22.2L387.7 253.7 410.3 231zM160 399.4l-9.1 22.7c-4 3.1-8.5 5.4-13.3 6.9L59.4 452l23-78.1c1.4-4.9 3.8-9.4 6.9-13.3l22.7-9.1v32c0 8.8 7.2 16 16 16h32zM362.7 18.7L348.3 33.2 325.7 55.8 314.3 67.1l33.9 33.9 62.1 62.1 33.9 33.9 11.3-11.3 22.6-22.6 14.5-14.5c25-25 25-65.5 0-90.5L453.3 18.7c-25-25-65.5-25-90.5 0zm-47.4 168l-144 144c-6.2 6.2-16.4 6.2-22.6 0s-6.2-16.4 0-22.6l144-144c6.2-6.2 16.4-6.2 22.6 0s6.2 16.4 0 22.6z">
                        </path>
                      </svg>
                    </button>
                  </a>
                  <a href="modal.php?grupo=<?php echo $id ?>&id=<?php echo $row['video_id']; ?>">
                    <button class="btn-action delete">Eliminar
                      <svg class="svg" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                        <path
                          d="M24 20.188l-8.315-8.209 8.2-8.282-3.697-3.697-8.212 8.318-8.31-8.203-3.666 3.666 8.321 8.24-8.206 8.313 3.666 3.666 8.237-8.318 8.285 8.203z">
                        </path>
                      </svg>
                    </button>
                  </a>
                </div>
              </td>
            </tr>
          <?php } ?>
        </tbody>
      </table>
    <?php } else {
    echo "<h1 class='empty'>No se encontraron vídeos que mostrar</h1>";
  }
  mysqli_close($conn);
  ?>
  </article>
</main>

<script src="./js/index.js"></script>
</body>

</html>