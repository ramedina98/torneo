<!DOCTYPE html>
<html lang="es-MX">
<head>
    <!-- Todas estas son las meta etiquetas principales que debe de llebar una pagina web... -->
    <meta charset="UTF-8">
    <meta name="author" content="Ricardo Abraham Medina Martin Del Campo y Ivan Careaga Panduro">
    <meta name="description" content="Accede al sistema de inicio de sesión de Gym Torneos para comenzar a gestionar tus datos y participar en actividades deportivas.">
    <meta name="keywords" content="Gym Torneos, inicio de sesión, gestión de datos, actividades deportivas, UNEDL, programación web, HTML5, CSS, JavaScript, PHP">
    <meta name="robots" content="index, follow">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="cache_control" content="no-cache">
    <!-- Here I have to writte an base tag -->
    <title>Inicio de session || Gym</title>
    <!--icon-->
    <!--TODO: verificar que el logo si se vea cuando este en el host...--> 
    <link rel="icon" href="img/inicio_session.ico">
    <!--css-->
    <link rel="stylesheet" href="style/login.css">
    <!--JS-->
    <script src="logic/login.js" defer></script>
    <!--Fonts of google and icons-->
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
</head>
<body>
    <form action="" method="POST">
        <div class="icono_user">
            <i class='bx bx-user-circle'></i>
        </div>
        <?php
            if(isset($errorLogin)){
                echo $errorLogin;
            }
        ?>
        <div class="bienvenida">
            <h2>Bienvenido de nuevo</h2>
        </div>
        <div class="inputs">
            <label>Nombre de usuario</label>
            <input type="text" name="username" placeholder="eje: luis_miguel">
            <label>Password</label>
            <input type="password" class="password_input" name="password" placeholder="eje: ********">
            <div class="viewable_cont">
                <button class="viewable_btn" id="view_btn_1"><i class='bx bxs-face'></i> Ver contraseña</button>
            </div>
        </div>
        <div class="btns">
            <input type="submit" value="Iniciar Sesión" class="btn">
            <a href="views/signUp.php" class="btn">Registrarse</a>
        </div>
    </form>
</body>
</html>