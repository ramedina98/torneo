<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Verifica si se ha enviado el formulario a través del método POST

    // Recoge los datos del formulario
    $name = $_POST['name'];
    $last_p = $_POST['last_p'];
    $last_m = $_POST['last_m'];
    $username = $_POST['username'];
    $password = $_POST['password'];
    $password_conf = $_POST['password_conf'];
    $puesto = $_POST['puesto'];

    // Aquí puedes realizar la validación de los datos y el proceso de inserción en la base de datos

    // Por ejemplo, podrías realizar una conexión a la base de datos y realizar una consulta SQL para insertar los datos
    // Esto es un ejemplo básico, necesitarás ajustarlo según tu estructura de base de datos
    // $conexion = mysqli_connect("host", "usuario", "contraseña", "basededatos");
    // $query = "INSERT INTO tabla (nombre, apellido_paterno, apellido_materno, username, password, puesto) VALUES ('$name', '$last_p', '$last_m', '$username', '$password', '$puesto')";
    // mysqli_query($conexion, $query);

    // Simplemente imprime un mensaje para verificar si los datos están llegando correctamente
    echo '¡Datos recibidos!';

    // Cierra la conexión a la base de datos si estás utilizando una
    // mysqli_close($conexion);
} else {
    echo 'No se han recibido datos.';
}
?>