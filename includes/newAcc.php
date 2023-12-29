<?php
    include_once('db.php');//here we have the connections to the databases
    $dbEmpleados = new DB_empleados();
    $conexionEmpleados = $dbEmpleados->connect();
    //check if the form has been sent through the post method...
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        //Collect data from the form...
        $name = $_POST['name'];
        $last_p = $_POST['last_p'];
        $last_m = $_POST['last_m'];
        $username = $_POST['username'];
        $password = $_POST['password'];
        $password_conf = $_POST['password_conf'];
        $puesto = $_POST['puesto'];

        //sql query to insert the data in the corresponding table...
        try{
            /*First I have to make suer that the employee exists in the
            employee table... */
            //query to search the employee in the employee table...
            $stmt_empleado = $conexionEmpleados->prepare('SELECT * FROM empleado WHERE nombre = :nom AND apellido_p = :last_p AND apellido_m = :last_m');
            $stmt_empleado->bindParam(':nom', $name); 
            $stmt_empleado->bindParam(':last_p', $last_p); 
            $stmt_empleado->bindParam(':last_m', $last_m); 
            $stmt_empleado->execute();
            $empleado_existente = $stmt_empleado->fetch();

            if(!$empleado_existente){
                //TODO: crear la vista html para cuando el empleado no existe...
                echo 'El empleado no existe... por ende no se puede registrar una cuenta';
            } else{
                /*If it does exist, now we must verify if the employee already has an 
                account, if not, we contunue to register him/her...*/
                $stmt_user = $conexionEmpleados->prepare("SELECT * FROM user WHERE user_name = :username");
                $stmt_user->bindParam(':username', $username);
                $stmt_user->execute();
                $usuario_existente = $stmt_user->fetch();

                if ($usuario_existente) {
                    //TODO: Hay que crear la vista HTML para este caso en el cual el empelado ya tiene una cuenta...
                    echo "El empleado ya tiene un registro en la base de datos de usuarios.";
                } else {
                    // Insertar el nuevo registro en la tabla user
                    echo 'Entramos en la zona donde se hace el registro'; 
                    //we encode the password before it is saved...
                    $passMd5 = md5($password);
                    //send the data to the user table...
                    $sql_insert = "INSERT INTO user (user_name, `password`, id_trabajador) VALUES (:username, :pass, :id_trabajador)";
                    $stmt_insert = $conexionEmpleados->prepare($sql_insert);
                    $stmt_insert->bindParam(':username', $username);
                    $stmt_insert->bindParam(':pass', $passMd5);
                    $stmt_insert->bindParam(':id_trabajador', $empleado_existente['id_empleado']);

                    try {
                        $stmt_insert->execute();
                        //TODO: crear la vista para este mensaje de exito, vista en HTML obvio...
                        echo "¡Registro insertado correctamente en la tabla user!";
                        //Go back to login page...
                        echo "<script>
                                setTimeout(function() {
                                    window.location.href = '../index.php';
                                }, 5000); // Redirigir después de 5 segundos
                            </script>";

                    } catch (PDOException $e) {
                        echo "Error al insertar el registro: " . $e->getMessage();
                    }
                }
            }


        }catch(PDOException $e){
            //Show error menssage if something went wrong
            echo "Error al buscar al empleado: " . $e->getMessage();
        }
        // Cierra la conexión a la base de datos si estás utilizando una
        // mysqli_close($conexion);
    } else {
        echo 'No se han recibido datos.';
    }
?>