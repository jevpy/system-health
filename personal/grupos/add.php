<?php
    include_once "./inc/header.php";
  ?>

  
<div id="main-content">
    <form class="update-form" action="savedata.php" method="post">
      <div class="inputs">
        <div class="form-group">
            <label>Nombre del grupo</label>
            <input type="text" name="name" required/>
        </div>
      </div>
        <input class="submit" type="submit" name="agregar" value="Agregar"  />
    </form>
</div>
 <script src="./js/index.js"></script>
</body>

</html> 
