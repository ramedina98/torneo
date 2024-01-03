<!--Here is all the code to create a new employee account...-->
<!DOCTYPE html>
<html lang="es-MX">
<head>
    <!-- Todas estas son las meta etiquetas principales que debe de llebar una pagina web... -->
    <meta charset="UTF-8">
    <meta name="author" content="Ricardo Abraham Medina Martin Del Campo y Ivan Careaga Panduro">
    <meta name="description" content="Registra una nueva cuenta en Gym Torneos para acceder al sistema y gestionar tus datos. ¡Participa en actividades deportivas emocionantes!">
    <meta name="keywords" content="Gym Torneos, registro de cuenta, sistema de gestión, actividades deportivas, UNEDL, programación web, HTML5, CSS, JavaScript, PHP">
    <meta name="robots" content="index, follow">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="cache_control" content="no-cache">
    <!-- Here I have to writte an base tag -->
    <title>Crear cuenta nueva || Gym</title>
    <!--icon-->
    <!--TODO: verificar que el logo si se vea cuando este en el host...--> 
    <link rel="icon" href="/views/img/register.ico">
    <!--css-->
    <link rel="stylesheet" href="style/register.css">
    <!--JS-->
    <script src="logic/login.js" defer></script>
    <script src="logic/validacionRegister.js" defer></script>
    <!--Fonts of google and icons-->
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
</head>
<body>
    <form action="" method="POST">
        <div class="icono_user">
            <i class='bx bx-user-circle'></i>
        </div>
        <?php
            if(isset($errorSign)){
                echo $errorSign;
            }
        ?>
        <div class="bienvenida">
            <h2>Crea tu cuenta</h2>
        </div>

        <div class="name_last">
            <div class="n">
                <label>Nombre</label>
                <input type="text" name="name" placeholder="Ingrese su nombre(s)">
            </div>
            <div class="l">
                <label>Apellido Paterno</label>
                <input type="text" name="last_p" placeholder="Ingrese su primer apellido">
            </div>
            <div class="l">
                <label>Apellido Materno</label>
                <input type="text" name="last_m" placeholder="Ingrese su segundo apellido">
            </div>

            <div class="puesto_cont">
                <select name="puesto" id="puesto">
                    <option value="Gerente">Gerente</option>
                    <option value="Asistente">Asistente</option>
                    <option value="Administrador">Administrador</option>
                    <option value="Técnico">Técnico</option>
                </select>
            </div>
        </div>
            
        <!--user and password-->
        <div class="user_pass">
            <label>Nombre de usuario</label>
            <input type="text" name="username" placeholder="eje: luis_miguel">
            <label>Password</label>
            <input type="password" class="password_input" name="password" placeholder="eje: @unedl24">
            <div class="viewable_cont">
                <button class="viewable_btn" id="view_btn_1"><i class='bx bxs-face'></i> Ver contraseña</button>
            </div>
            <label>Confirmar password</label>
            <input type="password" class="password_input_conf" name="password_conf" placeholder="Confirme contraseña">
            <div class="viewable_cont">
                <button class="viewable_btn" id="view_btn_2"><i class='bx bxs-face'></i> Ver contraseña</button>
            </div>
        </div>

        <div class="btns">
            <input type="submit" value="Crear cuenta" name="register_button" class="btn">
            <a href="index.php" class="btn">Rregresar</a>
        </div>
    </form>
</body>
</html>