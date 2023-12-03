<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistema Pacientes</title>
    <link rel="stylesheet" href="./login.css">
</head>
<body>

<article class="container">

    <div class="title">
        <img src="./images/essalud-azul-2.png" alt="Essalud">
        <!-- <img src="./images/essalud-azul-2.png" alt="Essalud"> -->
        <h1>¡Recuperación de cuenta</b> !</h1>
    </div>
    <div class="login-box">
        <p>RECUPERAR CUENTA</p>
        <form class="form_main" action="<?php $_SERVER['PHP_SELF']; ?>" method="POST" autocomplete="off">
            <div class="user-box">
                <input name="username" type="text" id="username" required>
                <label>Nombre de usuario</label>
            </div>

            <div class="user-box">
                <input name="password" type="password" id="password" required>
                <label>Ingrese la nueva contraseña</label>
                <div class="view"><p>mostrar</p></div>
            </div>
            <div class="user-box">
                <input name="password2" type="password" id="password" required>
                <label>Confirma la contraseña</label>
                <div class="view"><p>mostrar</p></div>
            </div>

            <button id="button" name="enviar" class="login">Enviar</button>
        </form>
    </div>

    <?php

    if(isset($_POST["enviar"])){

        include './php/conexion.php';

        $username = $_POST["username"];
        $password = $_POST["password"];
        $password2 = $_POST["password2"];

        if (empty($username) || empty($password)||empty($password2)) {
            echo '<div class="error"><h2 class="error__title">Ingrese nuevamente los datos</h2></div>';
            die();
        } else {
            $sql = "SELECT usuarios.usuario_id, usuarios.username, usuarios.password ,roles.rol_nombre FROM roles_x_usuario
        INNER JOIN usuarios ON roles_x_usuario.usuario = usuarios.usuario_id 
        INNER JOIN roles  ON roles_x_usuario.rol = roles.rol_id
        WHERE usuarios.username = '{$username}' AND rol_nombre = 'personal'";


            $result = mysqli_query($conn,$sql) or die('Error comando sql');

            if( mysqli_num_rows($result)>0){
                while($row = mysqli_fetch_assoc($result)){
                    if($row['password']=== $_POST['password']){
                        session_start();
                        $session_id = uniqid();
                        $_SESSION["session_id"] = $session_id;

                        $_SESSION["username"] = $row['username'];
                        $_SESSION["usuario_id"] = $row['usuario_id'];
                        $_SESSION["usuario_rol"] = 3;
                        $_SESSION["usuario_grupo"] = $row['grupo'];

                        header("Location: {$hostname}/vistas/paciente/index.php");
                    }
                }
            } else {
                echo ' <div class="error"><h2 class="error__title">Usuario no encontrado</h2></div>';
            }
        }
    }
    ?>
</article>
<script src="./index.js"></script>
</body>
</html>

