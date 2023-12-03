<?php
include_once "./inc/header.php";
include_once("./encrypt.php");
?>
  <article class="container">    
    <article class="modal">
        <?php 
          include './php/conexion.php';
          $camilla_id = encryptor("decrypt",$_GET['id']);
          $sql="SELECT * FROM camillas WHERE camilla_id = {$camilla_id}";
          $result = mysqli_query($conn, $sql);
    
        if (mysqli_num_rows($result) > 0) {
          while ($row = mysqli_fetch_assoc($result)) {
            ?>
            <h2>¿Estás seguro que deseas eliminar?</i>?</h2>
            <div>
              <a href='delete-inline.php?id=<?php echo $camilla_id ?>'>Si</a>
              <a href='./index.php'>No</a>
            </div>
           <?php 
          }
        } else {
          header("Location: {$hostname}/404.php");
        }
        ?>
      </article>
  </article>

  <script src="./js/index.js"></script>
</body>

</html> 